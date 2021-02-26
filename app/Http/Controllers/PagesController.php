<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Tag;

class PagesController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('pages.index', compact('categories', 'tags'));
    }

    public function myProfile() {
        return view('pages.myprofile');
    }
}
