<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Tag;
use App\Setting;
use DB;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Session;
use Auth;

class ArticlesController extends Controller
{
    // Index
    public function index()
    {
        if (request('category')) {
            $articles = Category::where('name', request('category'))->firstOrFail()->articles;
        } elseif (request('tag')) {
            $articles = Tag::where('name', request('tag'))->firstOrFail()->articles;
        } else {
            $articles = Article::orderBy('updated_at', 'desc')->get();
        }

        $settings = Setting::latest('articles_title')->take(1)->get();

        return view('pages.articles.index', compact('articles', 'settings'));
    }

    // Create
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('pages.articles.create', compact('tags', 'categories'));
    }

    // Store
    public function store(Request $request)
    {
        $validateArticle = request()->validate([
            'title' => ['bail', 'required', 'string', 'unique:articles', 'max:255'],
            'body' => 'required',
            'category_id' => ['exists:categories,id', 'required'],
            'tags' => 'exists:tags,id',
            'article_img' => ['image', 'mimes:jpg,jpeg,png', 'max:2048', 'nullable']
        ]);

        if ($request->hasFile('article_img')) {
            $fileNameWithExt = $request->file('article_img')->getClientOriginalName();
            $extention = $request->file('article_img')->getClientOriginalExtension();
            $fileNameToStore = $fileNameWithExt.'_'.time().'.'.$extention;
            $path = Storage::putFileAs('public/article_img', $request->file('article_img'), $fileNameToStore);
            $url = Storage::url($path);
        } else {
            $url = null;
        }

        $article = new Article($validateArticle);
        $article->user_id = auth()->id();
        $article->article_img = $url;
        $article->save();
        $article->tags()->sync(request('tags'));
        Session::flash('success', 'Article Created Successfully!');

        return redirect(route('articles.index'));
    }

    // Show
    public function show(Article $article)
    {
        $category = Category::all();
        $tags = Tag::all();

        return view('pages.articles.show', compact('article', 'tags', 'category'));
    }

    // Edit
    public function edit(Article $article)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $selected_tags = array();
        foreach ($article->tags as $sel_tag)
        {
            array_push($selected_tags, $sel_tag->id);
        }

        if (Auth::user()->hasRole('admin')) {
            return view('pages.articles.edit', compact('article', 'tags', 'selected_tags', 'categories'));
        }

        if (auth()->user()->id !== $article->user_id) {
            return abort(403, 'Unauthorized action.');
        }

        return view('pages.articles.edit', compact('article', 'tags', 'selected_tags', 'categories'));
    }

    // Update
    public function update(Request $request, Article $article)
    {
        $uniqueTitleRule = Rule::unique('articles')->ignore($article->id);
        $validatedArticle = request()->validate([
            'title' => ['bail', 'required', 'string', 'max:255', $uniqueTitleRule],
            'body' => 'required',
            'category_id' => ['exists:categories,id', 'required'],
            'tags' => 'exists:tags,id',
            'article_img' => ['image', 'mimes:jpg,jpeg,png', 'max:2048', 'nullable']
        ]);

        if ($request->hasFile('article_img')) {
            $fileNameWithExt = $request->file('article_img')->getClientOriginalName();
            $extention = $request->file('article_img')->getClientOriginalExtension();
            $fileNameToStore = $fileNameWithExt.'_'.time().'.'.$extention;
            $path = Storage::putFileAs('public/article_img', $request->file('article_img'), $fileNameToStore);
            $url = Storage::url($path);
        } else {
            $url = $article->article_img;
        }

        $article->update($validatedArticle);
        $article->user_id = auth()->id();
        $article->article_img = $url;
        $article->save();
        $article->tags()->sync(request('tags'));
        Session::flash('success', 'Article Updated Successfully!');

        return redirect($article->path());
    }

    // Destroy
    public function destroy(Article $article)
    {
        if (Auth::user()->hasRole('admin')) {
            $article->delete();
        }

        if (auth()->user()->id !== $article->user_id) {
            return abort(403, 'Unauthorized action.');
        }

        if ($article->article_img != null) {
            Storage::delete('public/article_img'.$article->article_img);
        }

        $article->delete();
        Session::flash('success', 'Article Deleted Successfully!');

        return redirect(route('articles.index'));
    }

    /*
    * Custom Method for validateArticle if identical (both for store and update)
    *
    protected function validateArticle(){
        return request()->validate([
            'title' => ['bail', 'required', 'unique:articles', 'max:255'],
            'body' => 'required',
            'tags' => 'exists:tags,id'
        ]);
    }
    */
}
