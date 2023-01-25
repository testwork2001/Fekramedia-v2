<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Price\StorePriceRequest;
use App\Http\Requests\Admin\Price\UpdatePricerRequest;
use App\Models\Price;
use App\Services\GenerateSlug;
use Illuminate\Support\Facades\DB;
use App\Services\Formater;

class PricingController extends Controller
{
    private const AVAILABLE_STATUS = [0 => 'Not Active', 1 => 'Active'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allPricing = Price::all();
        return view('admin.Pricing.index', compact('allPricing'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Pricing.create', ['statuses' => self::AVAILABLE_STATUS]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePriceRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->except('_token', 'create_return', 'features');
            $data['features'] =  json_encode(Formater::format($request->safe()->features));
            $data['slug'] = GenerateSlug::make($request->safe()->name);
            Price::create($data);
            DB::commit();
            return redirectAccordingToRequest($request);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('pricing.index')->with('error', 'something went wroing!');
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
        $price = Price::findOrFail($id);
        return view('admin.pricing.edit', ['statuses' => self::AVAILABLE_STATUS, 'price' => $price]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePricerRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $price = Price::findOrFail($id);
            $data = $request->except('_token', 'features');
            $data['features'] =  json_encode(Formater::format($request->safe()->features));
            $data['slug'] = GenerateSlug::make($request->safe()->name);
            $price->update($data);
            DB::commit();
            return redirect()->route('pricing.index')->with(['success' => 'Updated Successfilly!']);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->route('pricing.index')->with(['error' => 'Something went wroing!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $price = Price::findOrFail($id);
            $price->delete();
            DB::commit();
            return redirect()->route('pricing.index')->with(['success' => 'Deleted Successfilly!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('pricing.index')->with(['error' => 'Something went wroing!']);
        }
    }
}
