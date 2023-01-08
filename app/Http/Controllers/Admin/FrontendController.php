<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Frontend;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class FrontendController extends Controller
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

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.dashboard.blog.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


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
        $blog = Post::findOrFail($id);

        $categories = Category::all();

        $tag_collection = array();
        foreach ($blog->tags as $tag){

            $tag_collection[] = $tag->name;
        }

        return view('admin.dashboard.blog.edit',compact('blog','categories','tag_collection'));
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
        $perm = perm_deny(Auth::user()->role_id,13);
        if($perm == false){
            Session::flash("danger","You don't have permission to do this");
            return redirect()->back();
        }
        $request->validate([
            'title'=>'required|max:255',
            'blog_content'=> 'required',
            'category_id'=> 'required|integer',
            'tag'=>'string|max:255'

        ]);



        $key = 'blog.post';

        $blog = Post::findOrFail($id);
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->content = $request->blog_content;
        $blog->category_id = $request->category_id;


        if($request->hasFile('contentPic')){
            if(file_exists($blog->image)){
                unlink($blog->image);
            }
            $pic = file_upload($request->contentPic,'uploads/images/','1300','1100');
            $request->merge(['image'=> $pic]);
        }


        $blog->save();


        Session::flash('success','You have updated a Post');
        return redirect()->back();
    }

    public function blog(){

        $blogs = Post::paginate(15);

        return view('admin.dashboard.blog.blogs',compact('blogs'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {

    }
}
