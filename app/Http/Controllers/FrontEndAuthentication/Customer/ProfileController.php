<?php

namespace App\Http\Controllers\FrontEndAuthentication\Customer;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\Mail\TicketMail;
use App\Ticket;
use App\TicketDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class ProfileController extends Controller
{
    ////////////////////// Start Customer  Profile ////////////////////
    public function index()
    {
        return view('frontend.customer.profile.index');
    } //end of index
    public function edit(Request  $request, $id)
    {
        $customer = authCustomer();
        $validator =  $request->validate([
            'full_name' => 'required|string|max:200',
            'gender' => 'required|in:male,female',
            'phone' => 'required|unique:customers,phone,' . $customer->id,
        ]);
        $request_data = $request->except(['image']);
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/customers/', 600);
        } // end of if
        $customer->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->back();
    } //end of edit
    public function edit_password(Request  $request, $id)
    {
        $validator =  $request->validate([
            'old_password' => 'required',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|same:password|min:6',
        ]);
        $customer = authCustomer();
        $credentials = ['email' => $customer->email, 'password' => $request->old_password];
        if (!auth()->guard('customer')->attempt($credentials)) {
            session()->flash('success', __('site.Old Password Not Correct'));
        } else {
            $customer->update(['password' => bcrypt($request->password)]);
            session()->flash('success', __('site.updated_successfully'));
        }
        return redirect()->back();
    } //end of edit_password
    public function logout()
    {
        auth()->guard('customer')->logout();
        return view('frontend.customer.auth.login');
    } //end of logout
    ////////////////////// End  Customer  Profile ////////////////////


    ////////////////////// Start Ticket Support ////////////////////
    public function tickets()
    {
        $tickets = Ticket::where('customer_id', authCustomer()->id)->latest()->get();
        return view('frontend.customer.profile.tickets.index', compact('tickets'));
    } //end of index
    public function tickets_details($id)
    {

        $ticket = Ticket::where('id', $id)->where('customer_id', authCustomer()->id)->first();
        $tickets_details = TicketDetail::where('ticket_id', $id)->get();
        return view('frontend.customer.profile.tickets.chat', compact('ticket', 'tickets_details'));
    } //end of tickets_details
    public function chat_create(Request $request)
    {
        $validator =  $request->validate([
            'ticket_id' => 'required',
            'message' => 'required',
        ]);
        TicketDetail::create([
            'message' => $request->message,
            'ticket_id' => $request->ticket_id,
            'customer_id' => authCustomer()->id,
        ]);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->back();
    } //end of chat_create
    public function tickets_create(Request $request)
    {
        $customer = authCustomer();
        $validator =  $request->validate([
            'section' => 'required',
            'type' => 'required',
            'message' => 'required',
        ]);
        $request_data = $request->except(['customer_id']);
        $request_data['customer_id'] = $customer->id;
        $ticket = Ticket::create($request_data);

        RequestTicketEmail($ticket->id, $ticket->message);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->back();
    } //end of tickets_create

    ////////////////////// End Ticket Support ////////////////////

    ////////////////////// Start Order ////////////////////
    public function order_lists()
    {
        $orders = authCustomer()->orders()->where('payment_status', 'completed')->get();
        return view('frontend.customer.profile.invoices.order_lists', compact('orders'));
    } //end of order_lists
    public function notCompleted()
    {
        $orders = authCustomer()->orders()->where('payment_status', '!=', 'completed')->get();
        return view('frontend.customer.profile.invoices.orderNotCompleted_lists', compact('orders'));
    } //end of notCompleted
    public function order_details($id)
    {
        $breadcurmb = 'order_lists';
        $order = authCustomer()->orders()->where('id', $id)->first();
        return view('frontend.customer.profile.invoices.order_detail', compact('order', 'breadcurmb'));
    } //end of order_detail

    ////////////////////// End Order ////////////////////
    public function invoice_lists()
    {
        $orders = authCustomer()->invoices()->where('payment_status', 'completed')->get();

        return view('frontend.customer.profile.invoices.invoice_lists', compact('orders'));
    } //end of invoice_lists
    public function invoice_lists_due()
    {

        $date = Carbon::now();
        //where due_date == current date list all invoice

        // $orders = authCustomer()->invoices()->where('payment_status', '!=',  'completed')->where('payment_type', '!=', 'Once')->where('due_date', '<=', $date->toDateString())->get();
        $orders = authCustomer()->invoices()->where('payment_status', '!=',  'completed')->where('payment_type', '!=', 'Once')->get();

        return view('frontend.customer.profile.invoices.invoice_lists_due', compact('orders'));
    } //end of invoice_lists

    public function invoice_details($id)
    {
        $breadcurmb = 'invoices';
        $order = authCustomer()->invoices()->where('id', $id)->first();
        return view('frontend.customer.profile.invoices.invoice_detail', compact('order', 'breadcurmb'));
    } //end of invoice_details


    public function order_websites()
    {
        //  $invoices = authCustomer()->invoices()->where('product_id', '!=', null)->get();
        $orders = authCustomer()->orders()->where('product_id', '!=', null)->get();

        return view('frontend.customer.profile.invoices.websites', compact('orders'));
    }
    public function order_websites_details($id)
    {
        $breadcurmb = 'websites';
        $order = authCustomer()->orders()->where('product_id', '!=', null)->where('id', $id)->first();
        return view('frontend.customer.profile.invoices.print', compact('order', 'breadcurmb'));
    }

    public function invoices_websites($id)
    {
        $invoices = Invoice::where('order_id', $id)->get();
        dd($invoices);
    } //end of
    public function order_services()
    {

        $invoices = authCustomer()->orders()->where('service_id', '!=', null)->get();


        return view('frontend.customer.profile.invoices.services', compact('invoices'));
    }
    public function order_services_details($id)
    {
        $breadcurmb = 'services';
        $order = authCustomer()->orders()->where('service_id', '!=', null)->where('id', $id)->first();
        return view('frontend.customer.profile.invoices.print', compact('order', 'breadcurmb'));
    }

    public function order_apps()
    {
        $invoices = authCustomer()->orders()->where('package_id', '!=', null)->get();

        return view('frontend.customer.profile.invoices.apps', compact('invoices'));
    }
}
