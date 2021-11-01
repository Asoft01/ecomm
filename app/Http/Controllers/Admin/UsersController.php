<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    public function users(){
        Session::put('page', 'users');
        $users = User::get();
        // $users = User::get()->toArray();
        // dd($users); die;
        return view('admin.users.users')->with(compact('users'));
    }

    public function updateUserStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();

            if($data['status'] == "Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            User::where('id', $data['user_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'user_id' => $data['user_id']]);
        }
    }

    public function viewUsersCharts(){
        //    echo $current_month_users = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count(); die;
        $current_month_users = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
        // The submonths is for the previous month
        $before_1_month_users = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(1))->count();
        $before_2_month_users = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(2))->count();
        $before_3_month_users = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(3))->count(); 

        // $usersCount[] = array($current_month_users, $before_1_month_users, $before_2_month_users, $before_3_month_users);
        $usersCount = array($current_month_users, $before_1_month_users, $before_2_month_users, $before_3_month_users);

        return view('admin.users.view_users_charts')->with(compact('usersCount'));
    }

    public function viewUsersCountries(){
        //  echo "<pre>"; print_r("Hello"); die;
        $getUserCountries = User::select('country', DB::raw('count(country) as count'))->groupBy('country')->get()->toArray();
        // dd($getUserCountries);
        return view('admin.users.view_users_countries')->with(compact('getUserCountries'));
    }
}
