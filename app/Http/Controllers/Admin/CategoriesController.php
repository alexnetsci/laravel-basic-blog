<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Session;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateCategory = request()->validate([
            'name' => ['bail', 'required', 'string', 'unique:categories', 'max:255'],
        ]);

        $category = new Category($validateCategory);
        $category->save();
        Session::flash('success', 'Category has been successfully created!');

        return redirect(route('admin.categories.index'));
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Category  $category
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Category $category)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $uniqueNameRule = Rule::unique('categories')->ignore($category->id);
        $validateCategory = request()->validate([
            'name' => ['bail', 'required', 'string', 'max:255', $uniqueNameRule],
        ]);

        $category->update($validateCategory);
        $category->save();
        Session::flash('success', 'Category has been successfully updated!');

        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        Session::flash('success', 'Category has been successfully deleted!');

        return redirect(route('admin.categories.index'));
    }

    public function getCategories(Request $request)
    {
        if ($request->ajax())
        {
            $output = '';
            $data = Category::all();
            $total_row = $data->count();

            $data = [
                'table_data'  => $output,
                'total_data'  => $total_row
            ];

            echo json_encode($data);
        }
    }
}
