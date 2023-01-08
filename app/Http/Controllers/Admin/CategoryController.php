<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
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
        $categories = Category::paginate(30);

        return view('admin.dashboard.categories.index',compact('categories'));
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

        $perm = perm_deny(Auth::user()->role_id,2);

        if($perm == false){
            Session::flash("danger","You don't have permission to do this");
            return redirect()->back();
        }
        $request->validate([
          'category_name'=> 'required|max:80|unique:categories'
        ]);

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->save();

        Session::flash('success','You have created a Category');
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
        $perm = perm_deny(Auth::user()->role_id,2);
        if($perm == false){
            Session::flash("danger","You don't have permission to do this");
            return redirect()->back();
        }

        $request->validate([
            'category_name'=> 'required|max:120',
            'category_id' => 'required|integer'
        ]);


        $category = Category::findOrFail($request->category_id);

        if(strtolower($category->category_name) != strtolower($request->category_name)){
            $cat_check = Category::where('category_name',$request->category_name)->first();

            if(!empty($cat_check) >0){
                Session::flash("danger","This {$request->category_name} is already in use");
                return redirect()->back();
            }
        }
        $category->category_name = $request->category_name;
        $category->save();
        Session::flash('success','You Updated Category Name');
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
        $perm = perm_deny(Auth::user()->role_id,2);
        if($perm == false){
            Session::flash("danger","You don't have permission to do this");
            return redirect()->back();
        }
        $request->validate([
            'category_id'=>'required|integer',
        ]);


        $category = Category::findOrFail($request->category_id);
        $category->delete();

        Session::flash('success','You Deleted a Category');

        return redirect()->back();
    }



}
