<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingsRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function editShippingMethods($type)
    {
        if ($type === 'free') {
            $shipping = Setting::where('key', 'free_shipping_label')->first();
          //  return $shipping;
        } elseif ($type === 'local') {
            $shipping = Setting::where('key', 'local_shipping_label')->first();
        } elseif ($type === 'outer') {
            $shipping = Setting::where('key', 'outer_shipping_label')->first();
        } else {
            $shipping = Setting::where('key', 'free_shipping_label')->first();
        }
        return view('dashboard.settings.shippings.edit',compact('shipping'));
    }
    public function updateShippingMethods(ShippingsRequest $request,$id){
      try{
          $shipping_method=Setting::find($id);
          DB::beginTransaction();
          $shipping_method->update([
              'plain_value'=>$request->plain_value
          ]);
          $shipping_method->value=$request->value;
          $shipping_method->save();
          DB::commit();
          return redirect()->back()->with([
              'success'=>'تم تحديث  البيانات بنجاح'
          ]);
      }
      catch (\Exception $ex){
          DB::rollBack();
          return redirect()->back()->with([
              'error'=>'هناك خطأ ما يرجى المحاولة مرة أخرى'
          ]);
      }

    }
}
