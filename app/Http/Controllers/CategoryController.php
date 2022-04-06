<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $categories = Category::orderBy('id', 'desc');

        // if ($request->has('search')) {
        //     $sort_search = $request->search;
        //     $categories = $categories->where('name->' . Session::get('locale'), 'like', '%' . $request->search . '%');
        // }

        $categories = $categories->paginate(15);
        return view('backend.categories.index', compact('categories', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $category = Category::create($input);
        if($category){
            flash('Category has been inserted successfully')->success();
            return redirect()->route('categories.index');
        }
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view("backend.category.edit", compact('category', 'branches'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $input = $request->all();
        $op = $category->update($input);
        if ($op) {
            
            flash(trans('category has been Updated successfully'))->success();
            return redirect()->route('categories.index');
        } else {
            
            flash(trans('category has been error'))->error();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $op = $category->delete();

        if ($op) {
            flash(trans('category has been deleted successfully'))->success();
            return redirect()->route('categories.index');
        } else
            flash(trans('category has not been deleted'))->error();
        return redirect()->route('categories.index');
    }
}
