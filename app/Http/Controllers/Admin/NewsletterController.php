<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\subscribersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\NewsletterSubscriber;
use Session;

class NewsletterController extends Controller
{
    public function newsletterSubscribers(){
        Session::put('page', 'newsletter_subscribers');
        $newsletter_subscribers= NewsletterSubscriber::get()->toArray();
        // dd($newsletter_subscribers);
        return view('admin.subscribers.newsletter_subscribers')->with(compact('newsletter_subscribers'));
    }

    public function updateSubscriberStatus(Request $request){
        if($request->ajax()){
            $data= $request->all();
            // echo "<pre>"; print_r($data); die;
            if($data['status'] == "Active"){
                $status= 0;
            }else{
                $status = 1;
            }

            NewsletterSubscriber::where('id', $data['subscriber_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'subscriber_id'=> $data['subscriber_id']]);
        }
    }

    public function deleteSubscriber($id){
        // Delete NewsletterSubscriber
        NewsletterSubscriber::where('id', $id)->delete();
        $message = 'Subscriber been deleted successfully';
        session::flash('success_message', $message);
        return redirect()->back();
    }

    public function exportsNewsletterEmails(){
        return Excel::download(new subscribersExport, 'subscriber.xlsx');
    }
}
