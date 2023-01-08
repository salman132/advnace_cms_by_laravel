<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware('banned');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $new_order = Order::where('is_accepted',null)
            ->orderBy('created_at','DESC')
            ->with('payment_method')->with('product')->paginate(15);

        return view('admin.dashboard.orders.index',compact('new_order'));
    }

    /**
     * Accepting order.
     * @param Request $request
     *
     * @return void
     */
    public function approve(Request $request)
    {
        $request->validate([
            'order_id'=> 'required|integer|min:1'
        ]);

        $order = Order::find($request->order_id);
        if(!empty($order)){
            $order->is_accepted =1;
            $order->respond_by = Auth::id();
            $order->save();
        }
        Session::flash('success','Order marked as Completed');
        return redirect()->back();
    }

    /**
     * Show completed orders.
     *
     *
     * @return Response
     */
    public function completed_order()
    {
        $completed_order = Order::where('is_accepted',1)
            ->orderBy('created_at','DESC')
            ->with('payment_method')->with('product')->paginate(15);

        return view('admin.dashboard.orders.completed',compact('completed_order'));
    }

    /**
     * Display the specified resource.
     *
     *
     * @return Response
     */
    public function cancelled_order()
    {
        $cancelled_order = Order::where('is_accepted',0)
            ->orderBy('created_at','DESC')
            ->with('payment_method')->with('product')->paginate(15);
        return view('admin.dashboard.orders.cancelled',compact('cancelled_order'));
    }

    /**
     * Cancelling order.
     * @param Request $request
     * @
     * @return Response
     */
    public function cancel(Request $request)
    {
        $request->validate([
            'order_id'=> 'required|integer|min:1'
        ]);

        $order = Order::find($request->order_id);
        if(!empty($order)){
            $order->is_accepted =0;
            $order->respond_by = Auth::id();
            $order->save();
        }
        Session::flash('success','Order is cancelled');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'order_id'=>'required|integer|min:1'
        ]);
        Order::destroy($request->order_id);
        Session::flash('success','You deleted a Product');
        return redirect()->back();
    }
}
