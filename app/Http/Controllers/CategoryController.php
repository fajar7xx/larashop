<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\support\facades\Gate;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request, $next){

            if(Gate::allows('manage-categories'))return $next($request);
            
            abort(403, 'Anda tidak memiliki hak akses');
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return "categoriesnya sayang";
        $categories = \App\Category::paginate(10);

        $filterKeyword = $request->get('keyword');

        if($filterKeyword){
            $categories = \App\Category::where("name", "LIKE", "%$filterKeyword%")->paginate(10);
        }


        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // var_dump($_POST);
        // var_dump($_FILES);
        $name = $request->get('name');

        $new_category = new \App\Category;
        $new_category->name = $name;

        if($request->file('image')){
            $image_path = $request->file('image')
                            ->store('category_images', 'public');
            $new_category->image = $image_path;
        }

        $new_category->created_by = \Auth::user()->id;
        $new_category->slug = \Str::slug($name, '-');
        
        // simpan ke db
        $new_category->save();

        return redirect()->route('categories.create')->with('status', 'Category Succesfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = \App\Category::findOrFail($id);

        return view('categories.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category_edit = \App\Category::findOrFail($id);
        return view('categories.edit', ['category' => $category_edit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name = $request->get('name');
        $slug = $request->get('slug');


        $category_update = \App\Category::findOrFail($id);

        $category_update->name = $name;
        $category_update->slug = \Str::slug($slug, '-');

        if($request->file('image')){
            if($category_update->image && file_exists(storage_path('app/public/' . $category_update->image))){
                \Storage::delete('public/' . $category_update->name);
            }

            $new_image = $request->file('image')->store('category_images', 'public');

            $category_update->image = $new_image;
        }
        $category_update->updated_by = \Auth::user()->id;

        $category_update->save();

        return redirect()->route('categories.index')->with('status', 'Category has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = \App\Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')
        ->with('status', 'Category succesfully moved to trash');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(){
        $del_cat = \App\Category::onlyTrashed()->paginate(10);
        return view('categories.trash', ['categories' => $del_cat]);
    }

    public function restore($id){
        $category = \App\Category::withTrashed()->findOrFail($id);

        if($category->trashed()){
            $category->restore();
        }else{
            return redirect()->route('categories.index')->with('status', 'Category is not in trash');
        }

        return redirect()->route('categories.index')->with('status', 'Category successfully restored');
    }

    public function deletePermanent($id){
        $category = \App\Category::withTrashed()->findOrFail($id);

        if(!$category->trashed()){
            return redirect()->route('categories.index')
            ->with('status', 'Cant Delete permanently for active category');
        }else{
            $category->forceDelete();

            return redirect()->route('categories.index')
            ->with('status', 'Category permantly delete');
        }
    }

    // untuk search mengugnakan select2.js
    public function ajaxSearch(Request $request){
        $keyword = $request->get('kw');

        $categories = \App\Category::where("name", "LIKE", "%$keyword%")->get();

        return $categories;
    }
}
