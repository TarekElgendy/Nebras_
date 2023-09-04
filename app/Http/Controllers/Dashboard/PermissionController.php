<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
class PermissionController extends Controller
{
    public function index()
    {

      
        $permissions = Permission::latest()->get();
        return view('dashboard.admins.permissions.index', compact('permissions'));
    } //end of index_permissions
    public function create()
    {
        return view('dashboard.admins.permissions.create');
    } //end of create_permissions
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions',
        ]);
        $request_data = $request->except(['']);
        $patterns = ['delete', 'create', 'read', 'update'];
        for ($i = 0; $i <  count($patterns); $i++) {
            $name=$request->name.'-'.$patterns[$i];
            $display_name=ucfirst($request->name) .' '. ucfirst($patterns[$i]);
            $permission =  Permission::create(['name' =>  $name , 'display_name' => $display_name , 'description' =>   $display_name ]);
            DB::table('permission_role')->insert(['permission_id' => $permission->id, 'role_id' => 1]);
        }
        session()->flash('success', __('site.added_successfully'));
        return redirect()->back();
    } //end of store_permissions
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $permission = Permission::find($id);
        return view('dashboard.admins.permissions.edit', compact('permission'));
    } //end of edit_permissions
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' =>   ['required', Rule::unique('permissions')->ignore($permission->id),],
        ]); 
        $request_data = $request->except(['']);
        $permission->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->back();
    } //end of update_permissions
    public function destroy($id)
    {
         $permission = Permission::find($id);
        $permission->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->back();
    } //end of destroy_permissions
}
