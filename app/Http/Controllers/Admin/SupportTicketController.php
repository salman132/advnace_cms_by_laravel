<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use App\Models\SupportTicketContents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SupportTicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware('banned');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = SupportTicket::orderBy('created_at','DESC')->with('user')->paginate(15);

        return view('admin.dashboard.tickets.index',compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function open(Request $request)
    {
        $perm = perm_deny(Auth::user()->role_id,8);
        if($perm == false){
            Session::flash("danger","You don't have permission to do this");
            return redirect()->back();
        }

        $request->validate([
            'ticket_id'=> 'required|integer|min:1'
        ]);

        $support = SupportTicket::findOrfail($request->ticket_id);

        $support->status = 1;
        $support->opened_by = Auth::id();
        $support->save();

        Session::flash('success','You opened the Ticket');
        return redirect()->back();


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function closed(Request $request)
    {
        $perm = perm_deny(Auth::user()->role_id,8);
        if($perm == false){
            Session::flash("danger","You don't have permission to do this");
            return redirect()->back();
        }

        $request->validate([
            'ticket_id'=> 'required|integer|min:1'
        ]);

        $support = SupportTicket::findOrfail($request->ticket_id);

        $support->status = 2;
        $support->closed_by = Auth::id();
        $support->save();

        Session::flash('success','You opened the Ticket');
        return redirect()->back();


    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contents = SupportTicketContents::orderBy('created_at','ASC')->where('ticket_id',$id)->get();
        $ticket = SupportTicket::findOrFail($id);

        if($ticket->status == 0){
            Session::flash('danger','Status is Pending');
            return redirect()->back();
        }

        return view('admin.dashboard.tickets.show',compact('contents','id'));
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
    public function destroy(Request $request)
    {
        $perm = perm_deny(Auth::user()->role_id,8);
        if($perm == false){
            Session::flash("danger","You don't have permission to do this");
            return redirect()->back();
        }

        $request->validate([
            'ticket_id'=> 'required|integer|min:1'
        ]);

        SupportTicket::destroy($request->ticket_id);
        Session::flash('success','You deleted a Ticket');
        return redirect()->back();
    }

    public function chat(Request $request,$id){

       if($request->ajax()){
          $request->validate([
              'file.*'=> 'nullable|mimes:jpg,jpeg,png,pdf,doc,xlx'
          ]);

          $ticket = new SupportTicketContents();
          $ticket->ticket_id = $id;
          $ticket->user_id = Auth::id();
          $ticket->role_id = Auth::user()->role_id;
          $ticket->message = $request->text;
          if($request->hasFile('file')){
              $ticket->attachments =file_upload($request->file,'uploads/chat/','850','800');

          }
          $ticket->save();



       }
    }

    public function get_chat(Request $request,$id){
        if($request->ajax()){
            $contents = SupportTicketContents::orderBy('created_at','ASC')->where('ticket_id',$id)->with('user')->get();

            return response()->json($contents);
        }
        $contents = SupportTicketContents::orderBy('created_at','ASC')->where('ticket_id',$id)->with('user')->get();

        return response()->json($contents);
    }

    public function get_chat_attach(Request $request,$id){
        $attachments = SupportTicketContents::orderBy('created_at','ASC')
            ->where('ticket_id',$id)
            ->where('attachments','<>','NULL')->get(['attachments']);

        return view('admin.dashboard.tickets.attachments',compact('attachments'))->render();;
    }
}
