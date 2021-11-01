<?php

namespace App\Http\Controllers\Admin;

use App\Currency;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CurrencyController extends Controller
{
    public function currencies(){
        Session::put('page', 'currencies');
        $currencies = Currency::get();
        return view('admin.currencies.currencies')->with(compact('currencies'));
    }

    public function updateCurrencyStatus(Request $request){
        if($request->ajax()){
            $data= $request->all();
            // echo "<pre>"; print_r($data); die;
            if($data['status'] == "Active"){
                $status= 0;
            }else{
                $status = 1;
            }

            Currency::where('id', $data['currency_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'currency_id'=> $data['currency_id']]);
        }
    }

    public function addEditCurrency(Request $request, $id = null){
        if($id == ""){
            $title = "Add Currency";
            $currency = new Currency;
            $message = "Currency Added Successfully!";
        }else{
            $title = "Edit Currency";
            $currency = Currency::find($id);
            $message = "Currency Updated Successfully";
        }

        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            // Currency Validations
            $rules = [
                'currency_code'=> 'required|regex:/^[\pL\s-]+$/u',
                'exchange_rate'=> 'required|integer',
               
            ];
            $customMessages = [
                'currency_code.required' => 'Currency Code is required',
                'currency_code.regex' => 'Valid Currency Code is required',
                'exchange_rate.required' => 'Exchange Rate is required',
                'exchange_rate.regex' => 'Valid Exchanege Rate is required',
            ];
            
            $this->validate($request, $rules, $customMessages);

            $currency->currency_code = $data['currency_code'];
            $currency->exchange_rate = $data['exchange_rate'];
            $currency->save();

            Session::flash('success_message', $message);
            return redirect('admin/currencies');
        }

        return view('admin.currencies.add_edit_currency')->with(compact('title', 'currency'));
    }

    public function deleteCurrency($id){
        // Delete Category
        Currency::where('id', $id)->delete();
        $message = 'Currency been deleted successfully';
        session::flash('success_message', $message);
        return redirect()->back();
    }
}
