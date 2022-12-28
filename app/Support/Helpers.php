<?php

use Illuminate\Support\Str;
use Illuminate\Http\Request;

if (!function_exists('redirectAccordingToRequest')) {
    function redirectAccordingToRequest(Request $request, $message = "Created Successfully")
    {
        if ($request->has('create_return')) {
            return redirect()->back()->with('success', $message);
        } else {
            $routeName = Str::replace('store', 'index', $request->route()->getName());
            return redirect()->route($routeName)->with('success', $message);
        }
    }
}
