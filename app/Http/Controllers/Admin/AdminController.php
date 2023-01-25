<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\StoreAdminRequest;
use App\Http\Requests\Admin\Admin\UpdateAdminRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    private const AVAILABLE_STATUS = ['0' => 'Not Active', '1' => 'Active', '2' => 'Block'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.admins.index', ['admins' => Admin::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admins.create', ['statuses' => self::AVAILABLE_STATUS]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->safe()->except('password', 'password_confirmation', 'email_verified_at');
            $data['password'] = Hash::make($request->safe()->password);
            $data['email_verified_at']  = $request->safe()->email_verified_at ? date('Y-m-d h:i:s') : null;
            $admin = Admin::create($data);
            isset($request->image) ? $admin->addMediaFromRequest('image')->toMediaCollection('admins') : false;
            DB::commit();
            return redirectAccordingToRequest($request);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admins.index')->with('error', 'Something Went Wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
     
        return view('admin.admins.edit', ['admin' => $admin, 'statuses' => self::AVAILABLE_STATUS]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        DB::beginTransaction();
        try {
            $data = $request->safe()->except('password', 'password_confirmation', 'email_verified_at');
            if (isset($request->password)) {
                $data['password'] = Hash::make($request->password);
            }
            $data['email_verified_at']  = $request->safe()->email_verified_at ? date('Y-m-d h:i:s') : null;
            $admin->update($data);
            isset($request->image) ? $admin->changeMedia('admins') : false;

            DB::commit();
            return redirect()->route('admins.index')->with('success', "{$admin->name} Updated Successfully");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admins.index')->with('error', 'Something Went Wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        DB::beginTransaction();
        try {
            $admin->delete();
            DB::commit();
            return redirect()->route('admins.index')->with('success', "{$admin->name} Deleted Successfully");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('services.index')->with('error', 'Something Went Wrong!');
        }
    }
}
