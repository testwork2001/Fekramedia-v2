<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Service\StoreServiceRequest;
use App\Models\Category;
use App\Models\Service;
use App\Services\GenerateSlug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    private const AVAILABLE_STATUS = [0 => 'Not Active', 1 => 'Active'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services  = Service::with('category')->get();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.services.create', ['categories' => Category::where('status', '1')->get(), 'statuses' => self::AVAILABLE_STATUS]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceRequest $request)
    {
        DB::beginTransaction();
        try {
            $serviceData  = $request->safe()->service;
            $serviceData['slug'] = GenerateSlug::make($serviceData['name']);
            $serviceModel = Service::create($serviceData);
            $serviceModel->addMediaFromRequest('image')->toMediaCollection('services');
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('services.index')->with('error', 'Something went wroing!');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        DB::beginTransaction();
        try {
            $service->delete();
            DB::commit();
            return redirect()->route('services.index')->with('success', "it {$service->name} is Deleted Successfully!");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('services.index')->with('error', 'Something went Wroing!');
        }
    }
}
