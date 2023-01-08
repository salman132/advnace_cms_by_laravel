<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TagController extends Controller
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
        $tags = Tag::paginate(60);
        return view('admin.dashboard.tags.index',compact('tags'));
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
    public function store(Request $request)
    {
        $perm = perm_deny(Auth::user()->role_id,3);
        if($perm == false){
            Session::flash("danger","You don't have permission to do this");
            return redirect()->back();
        }

        $request->validate([
            'name'=>'required|string|max:150|unique:tags'
        ]);
        $tag = new Tag();


        $tag->name = $request->name;
        $tag->save();
        Session::flash('success','You stored a Tag');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $perm = perm_deny(Auth::user()->role_id,3);
        if($perm == false){
            Session::flash("danger","You don't have permission to do this");
            return redirect()->back();
        }


        $request->validate([
            'tag_id'=> 'required|integer',
        ]);


        $tag = Tag::findOrFail($request->tag_id);
        if($request->tag_name != $tag->name){
            $tag_check = Tag::where('name',$request->tag_name)->first();

            if(!empty($tag_check)){
                Session::flash("danger","This {$request->tag_name} is already in use");
                return redirect()->back();
            }

        }
        $tag->name = $request->tag_name;
        $tag->save();
        Session::flash('success','Tag name updated');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

    }





}
