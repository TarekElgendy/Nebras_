<?php

namespace App\Http\Controllers\FrontEndAuthentication\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\frontend\PromoCodeRequest;
use App\Order;
use App\Invoice;
use App\Mail\OrderMail;
use App\Mail\TicketMail;
use App\PromoCode;
use App\Ticket;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index(Request $request)
    {

        if (!$this->session_get_order_id()) {
            return redirect()->route('home');
        }
        if ($request->order_id) {
            session(['order_id' => $request->order_id]);

            // $order = Order::find($request->order_id);
        }
        if ($this->session_get_order_id()) {
            $order = Order::find($this->session_get_order_id());
        }
        if (!$order) {
            return redirect()->route('home');
        }
        return view('frontend.customer.profile.orders.index', compact('order'));
    } //end of index

    public function website_create(Request $request)
    {


        $info = $request->item_info;
        $info_period  = $info[0] . $info[1];     // get  mo OR yr
        $info_price = substr($info, 2);          // trim   mo OR yr
        $order = Order::create([
            'customer_country' => session()->get('country'),
            'package_id' => null,
            'service_id' => null,
            'product_id' =>  $request->product_id,
            'customer_id' => authCustomer()->id,
            'payment_type' => $info_period == 'mo' ? 'Monthly' : 'Yearly',
            'payment_method' => 'Online',
            'payment_status' => 'Not completed',
            'item_price' => $info_price,
            'total' => $info_price,
            'discount' => null,
            'fees' => null,
        ]);




        //save order and redirect to next page
        $this->session_create_order_id($order->id);

        // $ifram = $this->payOrderPage();


        //return view('frontend.customer.profile.orders.index', compact('order'));
        return redirect()->route('customer.order.index');
    } //end of website_create
    public function service_create(Request $request)
    {
        $info_period  = $request->info_period;     // get  mo OR yr Or once
        $info_price = $request->item_price;          // trim   mo OR yr
        $order = Order::create([
            'customer_country' => session()->get('country'),
            'package_id' => null,
            'service_id' => $request->service_id,
            'title_service_details' => $request->title_service_details,
            'product_id' =>  null,
            'customer_id' => authCustomer()->id,
            'payment_type' => $info_period,  //monthly - yealry
            'payment_method' => 'Online',
            'payment_status' => 'Not completed',
            'item_price' => $info_price,
            'total' => $info_price,
            'discount' => null,
            'fees' => null,
        ]);
        //save order and redirect to next page
        $this->session_create_order_id($order->id);

        return redirect()->route('customer.order.index');
    } //end of service_create
    public function app_create(Request $request)
    {
        $info_period  = $request->info_period;     // get  mo OR yr Or once
        $info_price = $request->item_price;          // trim   mo OR yr
        $order = Order::create([
            'customer_country' => session()->get('country'),
            'package_id' => $request->product_id,
            'service_id' => null,
            'title_service_details' => $request->title_service_details,
            'product_id' =>  null,
            'customer_id' => authCustomer()->id,
            'payment_type' => $info_period == 'month_short' ? 'Monthly' : 'Yearly',  //monthly - yealry
            'payment_method' => 'Online',
            'payment_status' => 'Not completed',
            'item_price' => $info_price,
            'total' => $info_price,
            'discount' => null,
            'fees' => null,
        ]);
        //save order and redirect to next page
        $this->session_create_order_id($order->id);

        return redirect()->route('customer.order.index');
    } //end of app-packages


    public function payment_method(Request  $request)
    {



        if ($request->payment_method == 'visa') {
            $ifram = $this->payOrderPage();
            return view('frontend.customer.profile.orders.payment.visa', compact('ifram'));
        } elseif ($request->payment_method == 'paypal') {
            $order = Order::find($this->session_get_order_id());
            if (session()->get('coupon')['discount']) {
                $total = $order->totalWithDiscount(session()->get('coupon')['discount']);
            } else {
                $total = $order->total();
            }
            $total_sum = $total;
            return view('frontend.customer.profile.orders.payment.paypal', compact('total_sum'));
        } else {
            dd('not avaliable this method');
        }
    }








    public function payOrderPage()
    {
        $order = Order::find($this->session_get_order_id());
        if (session()->get('coupon')['discount']) {
            $total = $order->totalWithDiscount(session()->get('coupon')['discount']);
        } else {
            $total = $order->total();
        }
        $url = url_link();
        $client = new \GuzzleHttp\Client();
        $success_url = success_url();
        $headers = [
            'Authorization' => 'x-api-key' . x_api_key_order(),
            'Accept'        => 'application/json',
        ];
        $response = $client->request('POST', $url, [
            'headers' => $headers,
            'json' => [
                "billing_data" => [
                    "name" => authCustomer()->full_name,
                    "email" =>  $order->id . 'info@customer.com',
                    "phone_number" => "+201112117402"
                ],
                "amount" => $total,
                "currency" => currency_payment(), // EGP  USD
                "variable_amount_id" => order_variable_amount_id(),
                "community_id" => comunityId(),
                "pay_using" => "card",
                "custom_fields" => [
                    [
                        "field_label" => 'order id',
                        "field_value" => $this->session_get_order_id()
                    ], [
                        "field_label" => 'customer id',
                        "field_value" => authCustomer()->id
                    ],
                ]

            ]
        ]);

        // $response = $response->getBody()->getContents();
        $data =  json_decode($response->getBody()->getContents());

        $iframe_url = $data->data->iframe_url;
        $transaction_uuid = $data->data->transaction_uuid;
        //dd($iframe_url);
        //  $order->update(['transaction_uuid' => $transaction_uuid]);
        $ifram = "<iframe src=" . $iframe_url . " width='100%' height='1000px'></iframe>";
        session()->flash('success', __('site.Success Operation'));
        $order = authCustomer()->orders()->latest()->first();
        return $ifram;
        //  return view('customer.payment', compact('order', 'session_id', 'ifram'));
    } // end of payOrderPage

    public function session_create_order_id($order_id)
    {
        $this->SendProgressEmail($order_id);
        session(['order_id' => $order_id]);
    } //end of session_create_order_id
    public function session_get_order_id()
    {
        return session()->get('order_id');
    } //end of session_order_id

    public function promoCode(PromoCodeRequest $request)
    {
        $promocode = PromoCode::where('code', $request->code)->first();
        $invoice = Order::where('id', $this->session_get_order_id())->where('customer_id', authCustomer()->id)->first();
        if ($invoice) {
            session()->put('coupon', [
                'name' => $promocode->code,
                'discount' => $promocode->discount($invoice->total),
                'subtotal' => $promocode->subtotal($invoice->total),
            ]);
            session()->flash('success', __('site.done_successfuly'));
        }
        return redirect()->back();
    } //end of promoCode

    public function removePromocode(Request $request)
    {
        $this->forget_session();
        return redirect()->back();
    } //end of update
    public function IncreasePromoUser($code)
    {
        PromoCode::where('code', $code)->increment('used');
    } //end IncreasePromoUser

    public function due_date($payment_type, $created_at)
    {
        if ($payment_type == 'Yearly') {
            $date = $created_at->addYear();
        } elseif ($payment_type == 'Monthly') {
            $date = $created_at->addMonth();
        } else {
            $date = null;
        } //end of if
        return $date;
    } //end of  due_date
    public function due_date2($payment_type, $created_at)
    {
        if ($payment_type == 'Yearly') {
            $date = $created_at->addYear();
        } elseif ($payment_type == 'Monthly') {
            $date = $created_at->addMonth();
        } else {
            $date = null;
        } //end of if
        return $date;
    } //end of  due_date2


    public function create_invoice()
    {

        $order = Order::find($this->session_get_order_id());
        $payment_type = $order->payment_type;  // Monthly  ==  Yearly  == Once
        $created_at = $order->created_at;
        $due_dateMain = $this->due_date($payment_type, $order->created_at);


        $discount = session()->get('coupon')['discount'];
        $coupon_code = session()->get('coupon')['name'];

        $payment_status_Step1 = 'completed';
        $status_Step1 = 'completed';

        $payment_status_Step2 = 'pending';
        $status_Step2 = 'Not renewed';




        /////////////////////////

        $invoic = Invoice::create([
            'order_id' => $this->session_get_order_id(),
            'invoice_number' =>  Invoice_slug() . $this->session_get_order_id(),
            'invoice_date' => $created_at,
            'due_date' => $this->due_date($payment_type, $order->created_at),
            'discount' => $discount,
            'coupon_code' => $coupon_code,
            'payment_status' => $payment_status_Step1,
            'customer_country' => $order->customer_country,
            'package_id' => $order->package_id,
            'service_id' => $order->service_id,
            'title_service_details' => $order->title_service_details,
            'product_id' => $order->product_id,
            'customer_id' => $order->customer_id,
            'payment_type' =>  $order->payment_type,  //monthly - yealry
            'payment_method' => $order->payment_method,
            'item_price' => $order->item_price,
            'total' => $order->total,
            'fees' =>  $order->fees,
            'status' => $status_Step1,
        ]); // End  First Create Invoice


        if ($payment_type != 'Once') {
            $invoic2 = Invoice::create([
                'order_id' => $this->session_get_order_id(),
                'invoice_number' =>  Invoice_slug() . $this->session_get_order_id() . $invoic->id,
                'invoice_date' =>  $this->due_date($payment_type, $order->created_at),
                'due_date' => $this->due_date2($payment_type, $invoic->due_date),
                'discount' => $discount,
                'coupon_code' => $coupon_code,
                'customer_country' => $order->customer_country,
                'package_id' => $order->package_id,
                'service_id' => $order->service_id,
                'title_service_details' => $order->title_service_details,
                'product_id' => $order->product_id,
                'customer_id' => $order->customer_id,
                'payment_type' =>  $order->payment_type,  //monthly - yealry
                'payment_method' => $order->payment_method,
                'item_price' => $order->item_price,
                'total' => $order->total,
                'fees' =>  $order->fees,
                'payment_status' => $payment_status_Step2,
                'status' => $status_Step2,
            ]); // End  Second Create Invoice


        } //end if payment_type!= once
    } //end of create_invoice

    public function SendProgressEmail($order_id)
    {
        SendProgressEmail($order_id);
    } //end of SendProgressEmail
    public function TicketEmail($ticket_id, $message)
    {
        OrderTicketEmail($ticket_id, $message);
    } //end of TicketEmail

    public function create_ticket()
    {
        $ticket = Ticket::create([
            'customer_id' => authCustomer()->id,
            'message' => '',
            'reply' => ticket_message(),
            'section' => 'order Support',
        ]);
        $this->TicketEmail($ticket->id, ticket_message());
    } //end of create_ticket
    public function orderSuccess()
    {
        $invoic = Order::find($this->session_get_order_id());
        $payment_type = $invoic->payment_type;  // Monthly  ==  Yearly  == Once
        $created_at = $invoic->created_at;
        $due_date = $this->due_date($payment_type, $created_at);

        $coupon_code = session()->get('coupon')['name'];

        $order = Order::where('id', $this->session_get_order_id())->update(
            [
                'invoice_number' => Invoice_slug() . $this->session_get_order_id(),
                'invoice_date' => $invoic->created_at,
                'due_date' => $due_date,
                'discount' => session()->get('coupon')['discount'],
                'coupon_code' => session()->get('coupon')['name'],
                'payment_status' => 'completed',
            ]
        );

        $this->create_ticket(); //create_ticket
        $this->create_invoice(); //create invoice
        $this->IncreasePromoUser(session()->get('coupon')['name']);  //increament count user coupon

        session()->flash('success', __('site.done_successfuly'));
        return redirect()->route('customer.order.congratulation');
    } //end of orderSuccess


    public function congratulation()
    {
        //  $order_id =  Invoice_slug() . $this->session_get_order_id();
        $order_id =   $this->session_get_order_id();
        //forget session
        $this->forget_session();
        return view('frontend.customer.profile.orders.done', compact('order_id'));
    }
    public function order_delete($id)
    {
        $item = Order::where('invoice_number', null)->find($id);
        if ($item) {
            $item->delete();
            $this->forget_session();
        }
        return redirect()->route('home');
    } //end of order_delete
    public function forget_session()
    {
        // session()->forget('order_id');
        session()->forget('coupon');
        //session()->flash('success', __('session forgeted'));
    } //end of forget_session

    ///////////////////////  invoices

    public function session_create_Invoice_id($invoice_id)
    {
        // $this->SendProgressEmail($invoice_id);
        session(['invoice_id' => $invoice_id]);
    } //end of session_create_Invoice_id
    public function session_create_Invoice_paymentMethod($payment_method)
    {
        session(['payment_method' => $payment_method]);
    } //end of session_create_Invoice_paymentMethod
    public function session_get_paymentMethod()
    {
        return session()->get('payment_method');
    } //end of session_get_paymentMethod
    public function session_get_invoice_id()
    {

        return session()->get('invoice_id');
    } //end of session_get_invoice_id


    public function invoiceRenewal($invoice_id)
    {


        $invoice = Invoice::find($invoice_id);
        if ($invoice) {
            $this->session_create_Invoice_id($invoice->id);
            return view('frontend.customer.profile.invoices.renewal.index', compact('invoice'));
        } else {
            return redirect()->back();
        }
    } ///end of invoiceRenewal


    public function renewalPayment(Request $request)
    {
        $validator =  $request->validate([
            'payment_method' => 'required|in:visa,paypal',
        ]);


        $invoice = Invoice::find($this->session_get_invoice_id());

        if (!$invoice) {
            return redirect()->back();
        }

        if ($request->payment_method == 'visa') {
            $ifram = $this->invoiceVisaRenew($invoice->id);
            $this->session_create_Invoice_paymentMethod('visa');
            return view('frontend.customer.profile.orders.payment.visa', compact('ifram'));
        } elseif ($request->payment_method == 'paypal') {

            $total_sum = $invoice->total;
            $this->session_create_Invoice_paymentMethod('paypal');
            return view('frontend.customer.profile.invoices.renewal.payment.paypal', compact('total_sum'));
        } else {
            dd('not avaliable this method');
        }
    } ///end of renewal




    public function invoiceSuccessRenew()
    {
        $invoice = Invoice::find($this->session_get_invoice_id());


        $payment_type = $invoice->payment_type;  // Monthly  ==  Yearly  == Once
        $invoice_date = $invoice->due_date;
        $due_date = $this->due_date($payment_type, $invoice->due_date);
        $discount = session()->get('coupon')['discount'];
        $coupon_code = session()->get('coupon')['name'];
        //update current invoice
        Invoice::where('id', $this->session_get_invoice_id())->update([
            'status' => 'Renovated',
            'payment_status' => 'completed',
        ]);
        //create   invoic
        $invoic = Invoice::create([
            'order_id' =>   $invoice->order_id,
            'invoice_date' => $invoice_date,
            'due_date' => $due_date,
            'customer_country' => $invoice->customer_country,
            'package_id' => $invoice->package_id,
            'service_id' => $invoice->service_id,
            'title_service_details' => $invoice->title_service_details,
            'product_id' => $invoice->product_id,
            'customer_id' => $invoice->customer_id,
            'payment_type' =>  $invoice->payment_type,  //monthly - yealry
            'payment_method' => $this->session_get_paymentMethod(),
            'item_price' => $invoice->item_price,
            'total' => $invoice->total,
            'fees' =>  $invoice->fees,
            'payment_status' => 'Not completed',
            'status' => 'Not renewed',
        ]); // End    Invoice
        Invoice::where('id', $invoic->id)->update([
            'invoice_number' =>  Invoice_slug()  . $invoic->id,
        ]);
        $this->forgetRenewSession();
        session()->flash('success', __('site.done_successfuly'));
        return view('frontend.customer.profile.invoices.renewal.done');
    } //end of invoiceSuccessRenew




    public function invoiceVisaRenew($invoice_id)
    {
        $invoice = Invoice::find($invoice_id);
        $total = $invoice->total;
        // $url = live_link();
        $url = url_link();
        $client = new \GuzzleHttp\Client();
        $success_url = success_renewInvoice_url_Invoice() . '/' . $invoice_id;
        $headers = [
            'Authorization' => 'x-api-key' . x_api_key_invoice_Invoice(),
            'Accept'        => 'application/json',
        ];
        $response = $client->request('POST', $url, [
            'headers' => $headers,
            'json' => [
                "billing_data" => [
                    "name" => authCustomer()->full_name . 'Ebakers',
                    "email" =>  $invoice->id . 'info@ebakers.com',
                    "phone_number" => "+201112117402"
                ],
                "amount" => $total,
                "currency" => currency_payment_Invoice(), // EGP  USD
                "variable_amount_id" => invoice_variable_amount_id_Invoice(),
                "community_id" => comunityId_Invoice(),
                "pay_using" => "card",
                "custom_fields" => [
                    [
                        "field_label" => 'order id',
                        "field_value" => $invoice->order_id
                    ], [
                        "field_label" => 'customer id',
                        "field_value" => authCustomer()->id
                    ],
                ]

            ]
        ]);

        // $response = $response->getBody()->getContents();
        $data =  json_decode($response->getBody()->getContents());

        $iframe_url = $data->data->iframe_url;
        $transaction_uuid = $data->data->transaction_uuid;
        //dd($iframe_url);
        //  $invoice->update(['transaction_uuid' => $transaction_uuid]);
        $ifram = "<iframe src=" . $iframe_url . " width='100%' height='1000px'></iframe>";
        session()->flash('success', __('site.Success Operation'));
        $order = authCustomer()->orders()->latest()->first();
        return $ifram;
        //  return view('customer.payment', compact('order', 'session_id', 'ifram'));

    } //end of invoiceVisaRenew




    public function forgetRenewSession()
    {
        session()->forget('payment_method');
        session()->forget('invoice_id');
    } //end of forgetRenewSession



}
