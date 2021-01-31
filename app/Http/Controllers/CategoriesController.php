<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;
use App\Http\Requests\Categories\CreatecategoryRequest;
use App\Http\Requests\Categories\UpdatecategoriesRequest;
class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
         return view('categories.index')->with('categories',Categories::all());
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
    public function store(CreatecategoryRequest $request)
    {
        
//static method
       Categories::create([
            'name'=>$request->name
        ]);
        session()->flash('success','Category Created');
        return redirect(route('categories.index'));
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
    public function edit(Categories $category)
    {
        return view('categories.create')->with('category',$category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecategoriesRequest $request, Categories $category)
    {
        $category->update([
            'name'=>$request->name
        ]);
        $category->save();
        session()->flash('success',' Category Updated Successfully');
        return redirect(route('categories.index'));        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categories $category)
    {
        if($category->posts->count()>0){
            session()->flash('error','Category cannot be deleted because it has posts');
            return redirect()->back();
        }
        $category->delete();
        session()->flash('success','Delete Successfully');
        return redirect(route('categories.index'));
    }
}
