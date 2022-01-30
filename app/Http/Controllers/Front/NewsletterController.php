<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\NewsletterSubscriber;

class NewsletterController extends Controller
{
    public function addSubscriber(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $subscriberCount = NewsletterSubscriber::where('email', $data['subscriber_email'])->count();
            if($subscriberCount > 0){
                return "exists";
            }else{
                // Add Newsletter subscriber email in newsletter_subscriber table
                $newsletter = new NewsletterSubscriber;
                $newsletter->email = $data['subscriber_email'];
                $newsletter->status = 1;
                $newsletter->save();
                return "inserted";
            }
        }
    }
}
