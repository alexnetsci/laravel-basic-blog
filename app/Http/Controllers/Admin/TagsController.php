<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Session;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::orderBy('name', 'asc')->get();
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateTag = request()->validate([
            'name' => ['bail', 'required', 'string', 'unique:tags', 'max:255'],
        ]);

        $tag = new Tag($validateTag);
        $tag->save();
        Session::flash('success', 'Tag has been successfully created!');

        return redirect(route('admin.tags.index'));
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Tag  $tag
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Tag $tag)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $uniqueNameRule = Rule::unique('tags')->ignore($tag->id);
        $validatedTag = request()->validate([
            'name' => ['bail', 'required', 'string', 'max:255', $uniqueNameRule],
        ]);

        $tag->update($validatedTag);
        $tag->save();
        Session::flash('success', 'Tag has been successfully updated!');

        return redirect()->route('admin.tags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        Session::flash('success', 'Tag has been successfully deleted!');

        return redirect(route('admin.tags.index'));
    }

    public function getTags(Request $request)
    {
        if ($request->ajax())
        {
            $output = '';
            $data = Tag::all();
            $total_row = $data->count();

            $data = [
                'table_data'  => $output,
                'total_data'  => $total_row
            ];

            echo json_encode($data);
        }
    }
}
