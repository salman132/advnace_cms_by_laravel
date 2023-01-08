<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PaymentsGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaymentMethodController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware('banned');


    }


    public function index()
    {

        $payments = PaymentsGateway::all();
        return view('admin.dashboard.payments.index',compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dashboard.payments.test');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $payment = PaymentsGateway::findOrFail($id);
        return view('admin.dashboard.payments.edit',compact('payment'));
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
        $perm = perm_deny(Auth::user()->role_id,10);
        if($perm == false){
            Session::flash("danger","You don't have permission to do this");
            return redirect()->back();
        }

        $request->validate([
            'account'=>'string|email',
            'client_id' => 'nullable|string|max:255',
            'client_secret' => 'nullable|string|max:255',
            'status'=> 'required|integer|min:0|max:1'
        ]);

        $payment = PaymentsGateway::findOrFail($id);
        $payment->account_name = $request->account !=NULL ? encrypt($request->account) : NULL;
        $payment->client_id =$request->client_id !=NULL ? encrypt($request->client_id) : NULL;
        $payment->client_secret =$request->client_secret !=NULL ? encrypt($request->client_secret) : NULL;
        $payment->status = $request->status;
        $payment->save();

        Session::flash('success','You updated the payment method');
        return redirect()->route('payments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
