<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
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
        $languages = Language::all();

        return view('admin.dashboard.language.index',compact('languages'));
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
        $request->validate([
            'icon' => 'image|mimes: jpg,jpeg,png',
            'name'=> 'required|max:100|unique:languages',
            'code'=> 'required|max:3|unique:languages',
            'direction' => 'required|integer|max:2|min:1',

        ]);
        $default = strtolower($request->default)  == "on" ? $default =1 : $default =0;

        $language = new Language();

        $language->name = $request->name;

        $language->code = strtolower($request->code);


        if($request->hasFile('icon')){
            $language->icon = file_upload($request->icon,'uploads/language/',110,98);
        }
        $language->text_decoration = $request->direction;

        if($request->default){
            $lanCheck = Language::where('is_default',1)->first();

            if(!empty($lanCheck)){
                $langFind = Language::find($lanCheck->id);
                $langFind->is_default =0;
                $langFind->save();
            }

            $language->is_default =1;
        }

        $file = resource_path('lang') .'\default.json';


        $json_file = resource_path('lang/') . strtolower($request->code).".json";

        $data = file_get_contents($file);

        if(file_exists($json_file)){
            Session::flash('danger','File is already exist');
            return redirect()->back();

        }
        else{

            fopen($json_file,"w+");
            File::put($json_file,$data);
            $language->source = $json_file;


        }
        $language->save();
        Session::flash('success','You added a Language');
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

        $language = Language::findOrFail($id);
        $source = resource_path('lang/').$language->code.".json";
        $json = file_get_contents($source);

        $words = json_decode($json);
        $list_lang = Language::all();




        return view('admin.dashboard.language.show',compact('language','words','list_lang'));
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
        $request->validate([
            'icon' => 'image|mimes: jpg,jpeg,png',
            'id'=> 'require|integer',
            'name'=> 'max:100',
            'code'=> 'max:3',
            'direction' => 'required|integer|max:2|min:1',

        ]);
        $default = strtolower($request->default)  == "on" ? $default =1 : $default =0;

        $id = $request->langUp;

        $language = Language::findOrFail($id);

        $source = resource_path('lang/').$language->code.".json";

        $name_check = Language::where('name',$request->name)->first();
        $code_check = Language::where('code',$request->code)->first();

        if(strtolower($language->name) != strtolower($request->name)){
            if(!empty($name_check) || $name_check != NULL){
                Session::flash('danger','This Language name is already exist');
                return redirect()->back();
            }

            $language->name = $request->name;
        }

        if(strtolower($language->code) != strtolower($request->code)){
            if(!empty($code_check) || $code_check !=NULL){
                Session::flash('danger','This Language code is already exist');
                return redirect()->back();
            }
        }

        if($request->hasFile('icon')){
            $language->icon = file_upload($request->icon,'uploads/language/',110,98);
        }
        $language->text_decoration = $request->direction;

        if($request->default){
            if($language->is_default ==1){
                $language->is_default = $default;
            }
            else{

                $lanCheck = Language::where('is_default',1)->first();

                if(!empty($lanCheck)){
                    $langFind = Language::find($lanCheck->id);
                    $langFind->is_default =0;
                    $langFind->save();
                }

                $language->is_default =1;

            }
        }
        if($request->code){
            if(strtolower($request->code) != strtolower($language->code)){

                $new_source = resource_path('lang/') . strtolower($request->code).".json";

                if(file_exists($source)){
                    rename($source,$new_source);
                }

                $language->source = $new_source;
            }
            $language->code = strtolower($request->code);

        }


        $language->save();
        Session::flash('success','You Updated a Language');
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
        $request->validate([
            'lang_id'=>'required|integer',
        ]);
        $language = Language::findOrFail($request->lang_id);
        $source = resource_path('lang/').$language->code.".json";

        if(strtolower($language->icon) != 'uploads/language/icon.png'){
            if(file_exists($language->icon)){
                unlink($language->icon);
            }
        }

        if(file_exists($source)){
            unlink($source);
        }
        Language::destroy($request->lang_id);
        Session::flash('success','You removed a Language');
        return redirect()->back();


    }

    public function langKey(Request $request,$id){
        $request->validate([
            'keys'=>'required|max:255',
            'keys.*'=>'required|max:255',
        ]);


        $language = Language::find($id);

        $content = json_encode($request->keys,JSON_UNESCAPED_UNICODE);

        $source = resource_path('lang/').$language->code.".json";

        file_put_contents($source,$content);

        Session::flash('success','Your Language Has been Added');

        return redirect()->back();

    }
}
