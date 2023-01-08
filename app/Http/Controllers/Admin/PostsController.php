<?php

namespace App\Http\Controllers\Admin;

use App\Models\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PostsController extends Controller
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
        //
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
        $perm = perm_deny(Auth::user()->role_id,13);
        if($perm == false){
            Session::flash("danger","You don't have permission to do this");
            return redirect()->back();
        }

        $request->validate([
            'title'=>'required|max:255',
            'blog_content'=> 'required',
            'contentPic'=>'required|image|mimes:jpg,jpeg,png',
            'category_id'=> 'required|integer',
            'tags'=>'string|max:255',
        ]);


        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->content = $request->blog_content;
        $post->category_id = $request->category_id;
        if($request->hasFile('contentPic')){
            $post->image = file_upload($request->contentPic,'uploads/images/','1300','1100');

        }
        $post->save();

        $tags = $request->tags;


        if(!empty($tags)){
            if(strpos($tags,",") != false){
                $tag_list = explode(',',$tags);
                $all_tag = array();
                foreach ($tag_list as $tag){
                    $tag_find = Tag::where('name',$tag)->get();


                    if(empty($tag_find) || count($tag_find) == 0){

                        $tag_store = new Tag();
                        $tag_store->name = $tag;
                        $tag_store->save();

                        $all_tag[] = $tag_store->id;
                    }
                    else{
                        $tag_search = Tag::where('name',$tag)->get();

                        foreach ($tag_search as $t){
                            $all_tag[] = $t->id;
                        }
                    }



                }

                $post->tags()->sync($all_tag);

            }
        }

        Session::flash('success','Your Post is stored');
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
            'contentPic'=>'image|mimes:jpg,jpeg,png',
            'category_id'=> 'required|integer',
            'tags'=>'string|max:255',
        ]);



        $post = Post::findOrFail($id);
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->content = $request->blog_content;
        $post->category_id = $request->category_id;
        if($request->hasFile('contentPic')){
            if(file_exists($post->image)){
                unlink($post->image);
            }
            $post->image = file_upload($request->contentPic,'uploads/images/','1300','1100');

        }
        $post->save();

        $tags = $request->tags;

        if(!empty($tags)){
            if(strpos($tags,",") != false){
                $tag_list = explode(',',$tags);
                $all_tag = array();
                foreach ($tag_list as $tag){
                    $tag_find = Tag::where('name',$tag)->get();

                    if(empty($tag_find) || count($tag_find) == 0){

                        $tag_store = new Tag();
                        $tag_store->name = $tag;
                        $tag_store->save();

                        $all_tag[] = $tag_store->id;
                    }
                    else{
                        $tag_search = Tag::where('name',$tag)->get();
                        foreach ($tag_search as $t){
                            $all_tag[] = $t->id;
                        }
                    }
                }

                $post->tags()->sync($all_tag);

            }
        }





        Session::flash('success','You Updated The Post');
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
        $perm = perm_deny(Auth::user()->role_id,13);
        if($perm == false){
            Session::flash("danger","You don't have permission to do this");
            return redirect()->back();
        }

        $request->validate([
            'blog_id'=> 'required|integer'
        ]);

        $blogs = Post::findOrFail($request->blog_id);

        $blogs->tags()->wherePivot('post_id','=',$blogs->id)->detach();

        if($blogs->image != "uploads/thumbnails/default.png"){
            if(file_exists($blogs->image)){
                unlink($blogs->image);
            }
        }
        $blogs->delete();

        Session::flash('success','You deleted a Post');

        return redirect()->back();
    }
}
