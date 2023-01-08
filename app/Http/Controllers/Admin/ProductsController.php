<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Imports\ProductsImport;
use App\Products;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports;

class ProductsController extends Controller
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

        $products = Products::with('category')->paginate(15);
        $categories = Category::all(['id','category_name']);

        return view('admin.dashboard.products.index',compact('products','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.dashboard.products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $perm = perm_deny(Auth::user()->role_id,4);
        if($perm == false){
            Session::flash("danger","You don't have permission to do this");
            return redirect()->back();
        }

        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|integer|min:0',
            'product_description' => 'nullable',
            'category_id' => 'required|integer',
            'stock' => 'required|min:2:max:3',
            'product_type' => 'required|integer|min:0|max:1',
            'tags' => 'required|string|max:255',
            'contentPic'=> 'image|mimes:jpg,png,jpeg',
            'gallery.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);
        //If the product type is downloadable
        if($request->product_type ==0){
            $request->validate([
                'download_url' => 'required|url'
            ]);
        }



        $product = new Products();
        $product->product_name  = $request->product_name;
        $product->product_slug = Str::slug($request->product_name)."-".date('Y-m-d-his');
        $product->product_price = $request->product_price;
        $product->product_description = $request->product_description;
        $product->category_id = $request->category_id;
        $product->stock = strtolower($request->stock) == "on" ? 1 : 0;
        $product->type = $request->product_type;
        if(!empty($request->download_url) && $request->product_type ==0){
            $product->download_url = $request->download_url;
        }

        if($request->hasFile('contentPic')){
            $product->contentPic = file_upload($request->contentPic,'uploads/products/');
        }
        if($request->hasFile('gallery')){
           $galleries = array();
           foreach ($request->gallery as $gallery){
               $galleries[] = file_upload($gallery,'uploads/products/');

           }
           $product->gallery = (object)$galleries;
        }
        $product->save();

        // Tag Storing
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

                $product->tags()->sync($all_tag);

            }
        }

        // Tag Storing Ends

        Session::flash('success','Your Product is stored');
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
     * @param $slug
     * @return void
     */
    public function edit($slug)
    {
        $perm = perm_deny(Auth::user()->role_id,4);
        if($perm == false){
            Session::flash("danger","You don't have permission to do this");
            return redirect()->back();
        }

        $product = Products::where('product_slug',$slug)->first();
        $categories = Category::all();
        $tag_collection = array();
        foreach ($product->tags as $tag){

            $tag_collection[] = $tag->name;
        }

        if(!empty($product)){
            return view('admin.dashboard.products.edit',compact('product','categories','tag_collection'));
        }
        else{
            return redirect()->back();
        }
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
        $perm = perm_deny(Auth::user()->role_id,4);
        if($perm == false){
            Session::flash("danger","You don't have permission to do this");
            return redirect()->back();
        }

        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|integer|min:0',
            'product_description' => 'nullable',
            'category_id' => 'required|integer',
            'stock' => 'required|min:2:max:3',
            'product_type' => 'required|integer|min:0:max:1',
            'tags' => 'required|string|max:255',
            'contentPic'=> 'image|mimes:jpg,png,jpeg',
            'gallery.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'old_gallery.*' => 'string|max:255',
        ]);


        $product = Products::findOrFail($id);
        if($product->product_name != $request->product_name) {
            $product->product_name  = $request->product_name;
            $product->product_slug = Str::slug($request->product_name)."-".date('Y-m-d-his');

        }

        $product->product_price = $request->product_price;
        $product->product_description = $request->product_description;
        $product->category_id = $request->category_id;
        $product->stock = strtolower($request->stock) == "on" ? 1 : 0;
        $product->type = $request->product_type;
        if(!empty($request->download_url) && $request->product_type ==0){
            $product->download_url = $request->download_url;
        }

        if($request->hasFile('contentPic')){
            $product->contentPic = file_upload($request->contentPic,'uploads/products/');
        }

        $galleries = array();

        if($request->old_gallery){

            foreach ($request->old_gallery as $old){
                $galleries[] = $old;
            }

            // Deleting Unchecked Photo
            $gallery_data = (array)$product->gallery;



            foreach ($gallery_data as $gallery){
                if(!in_array($gallery,$galleries)){
                    if(file_exists($gallery)){
                        unlink($gallery);
                    }
                }
            }

        }
        else{
            $gallery_data = (array)$product->gallery;
            foreach ($gallery_data as $gallery){

                if(file_exists($gallery)){
                    unlink($gallery);
                }
            }
        }


        if($request->hasFile('gallery')){

            foreach ($request->gallery as $gallery){
                $galleries[] = file_upload($gallery,'uploads/products/');

            }

        }

        $product->gallery = (object)$galleries;



        $product->save();

        // Tag Storing
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

                $product->tags()->sync($all_tag);

            }
        }

        // Tag Storing Ends

        Session::flash('success','Your Product is Updated');
        return redirect()->route('products.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $perm = perm_deny(Auth::user()->role_id,4);
        if($perm == false){
            Session::flash("danger","You don't have permission to do this");
            return redirect()->back();
        }

        $request->validate([
            'product_id'=> 'required|integer',
        ]);

        $product = Products::findOrFail($request->product_id);

        $product->tags()->wherePivot('products_id','=',$product->id)->detach();


        if(file_exists($product->contentPic)){
            unlink($product->contentPic);
        }


        if(!empty($product->gallery)){
            foreach ($product->gallery as $gallery){
                if(file_exists($gallery)){
                    unlink($gallery);
                }
            }
        }
        $product->delete();

        Session::flash('success','You deleted a Post');

        return redirect()->back();
    }

    public function export(){

        $export = new Exports\ProductsExport();

        return $export->download('products.xlsx');
    }

    public function excelUpload(Request $request){
        $request->validate([
            'file'=>'required|mimes:xlsx'
        ]);



        $file_name = $request->file;
        $file_new_name = date('Y-m-d').time().$file_name->getClientOriginalName();
        $file_name->move('uploads/files/',$file_new_name);
        $file_final_name = 'uploads/files/'.$file_new_name;

        $import = new ProductsImport();

        $data = Excel::import($import ,$file_final_name);

        if(file_exists($file_final_name)){
            unlink($file_final_name);
        }

        return redirect()->back();


    }

    public function custom_search(Request $request){
        $request->validate([
            'product_name' => 'nullable|string|max:255',
            'product_category' => 'nullable|integer|min:1',
            'in_stock' => 'nullable|integer|min:0|max:1',

        ]);


        $product = new Products();

        if(!empty($request->product_name)){
            $product = $product->where('product_name','LIKE',"%".$request->product_name."%");
        }
        if(!empty($request->product_category)){
            $product = $product->where('category_id',$request->product_category);
        }
        if(!empty($request->in_stock)){
            $product = $product->where('stock',$request->in_stock);
        }
        if($request->price_from !=null && $request->price_to !=null){


            $product = $product->whereBetween('product_price',[$request->price_from,$request->price_to]);
        }
        $products = $product->paginate(15);

        $categories = Category::all();

        return view('admin.dashboard.products.index',compact('products','categories'));

    }




}
