<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function editShippingMethods($type)
    {
        if ($type === 'free') {
            $shipping = Setting::where('key', 'free_shipping_label')->first();
        } elseif ($type === 'local') {
            $shipping = Setting::where('key', 'local_shipping_label')->first();
        } elseif ($type === 'outer') {
            $shipping = Setting::where('key', 'outer_shipping_label')->first();
        } else {
            $shipping = Setting::where('key', 'free_shipping_label')->first();
        }
        return view('dashboard.settings.shippings.edit',compact('shipping'));
    }
    public function updateShippingMethods(Request $request,$id){
        return $request->all();
    }
}
