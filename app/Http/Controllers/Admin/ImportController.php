<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;

class ImportController extends Controller
{
    public function updateCODPincodes(Request $request){
        Session::put('page', 'cod_pincodes');
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            
            // Import Pincodes Excel CSV to Pincode Folder
            if($request->hasFile('main_file')){
            // if($request->file('main_file') != null){
                // echo "test"; die;
                // echo $image_tmp = $request->file('main_file'); die;
                if($request->file('main_file')->isValid()){
                    // echo "test"; die;
                    $file = $request->file('main_file');
                    $destination = public_path('imports/pincodes');
                    $ext = $file->getClientOriginalExtension();
                    $filename = "pincodes-".rand().".".$ext;
                    $file->move($destination, $filename);
                }

                $file = public_path('/imports/pincodes/'.$filename);
                $pincodes = $this->csvToArray($file); // convert data to Array
                // echo "<pre>"; print_r($pincode); die;
                $latestPincodes = array();
                foreach ($pincodes as $key => $pincode) {
                    $latestPincodes[$key]['pincode'] =      $pincode['pincode'];
                    $latestPincodes[$key]['created_at'] =   date('Y-m-d H:i:s');
                    $latestPincodes[$key]['updated_at'] =   date('Y-m-d H:i:s');
                }
                
                DB::table('cod_pincodes')->delete();
                DB::update("Alter Table cod_pincodes AUTO_INCREMENT = 1;");
                DB::table('cod_pincodes')->insert($latestPincodes);
                $message = "COD Pincodes have been replaced Successfully!";
                Session::flash('success_message', $message);
                return redirect()->back();
            }
            // dd($request->all());
            // dd($request->file('main_file')->store("ddd", 'public'));
            // $path = $request->file('main_file')->store('imports/pincodes');
            // // dd($request);
            // return $path;
            
        }
        return view('admin.pincodes.update_cod_pincodes');
    }

    
    public function updatePrepaidPincodes(Request $request){
        Session::put('page', 'prepaid_pincodes');
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            
            // Import Pincodes Excel CSV to Pincode Folder
            if($request->hasFile('main_file')){
            // if($request->file('main_file') != null){
                // echo "test"; die;
                // echo $image_tmp = $request->file('main_file'); die;
                if($request->file('main_file')->isValid()){
                    // echo "test"; die;
                    $file = $request->file('main_file');
                    $destination = public_path('imports/pincodes');
                    $ext = $file->getClientOriginalExtension();
                    $filename = "pincodes-".rand().".".$ext;
                    $file->move($destination, $filename);
                }

                $file = public_path('/imports/pincodes/'.$filename);
                $pincodes = $this->csvToArray($file); // convert data to Array
                // echo "<pre>"; print_r($pincode); die;
                $latestPincodes = array();
                foreach ($pincodes as $key => $pincode) {
                    $latestPincodes[$key]['pincode'] =      $pincode['pincode'];
                    $latestPincodes[$key]['created_at'] =   date('Y-m-d H:i:s');
                    $latestPincodes[$key]['updated_at'] =   date('Y-m-d H:i:s');
                }
                
                DB::table('prepaid_pincodes')->delete();
                DB::update("Alter Table prepaid_pincodes AUTO_INCREMENT = 1;");
                DB::table('prepaid_pincodes')->insert($latestPincodes);
                $message = "Prepaid Pincodes have been replaced Successfully!";
                Session::flash('success_message', $message);
                return redirect()->back();
            }
            // dd($request->all());
            // dd($request->file('main_file')->store("ddd", 'public'));
            // $path = $request->file('main_file')->store('imports/pincodes');
            // // dd($request);
            // return $path;
            
        }
        return view('admin.pincodes.update_prepaid_pincodes');
    }

    public function csvToArray($filename = '', $delimeter= ','){
        if(!file_exists($filename) || !is_readable($filename))
            return false;
            $header = null;
            $data = array();
            if(($handle = fopen($filename, 'r')) !== false){
                while(($row = fgetcsv($handle, 1000, $delimeter)) !== false){
                    if(!$header)
                        $header = $row;
                    else 
                        $data[] = array_combine($header, $row);
                }
                fclose($handle);
            } 
        return $data;
    }
}
