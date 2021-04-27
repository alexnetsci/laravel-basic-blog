<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Role;
use App\Article;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $userRoles = Auth::user()->roles->pluck('name');
        if (!$userRoles->contains('admin')) {
            return redirect()->route('permission_denied');
        }

        $categories = Category::all();
        $tags = Tag::all();

        if (request('category')) {
            $articles = Category::where('name', request('category'))->firstOrFail()->articles;
        } elseif (request('tag')) {
            $articles = Tag::where('name', request('tag'))->firstOrFail()->articles;
        } else {
            $articles = Article::orderBy('updated_at', 'desc')->paginate(3);
        }

        return view('admin.dashboard', compact('articles', 'categories', 'tags'));
    }

    public function giveAdmin($userId)
    {
        $user = User::where('id', $userId)->firstOrFail();
        $adminRole = Role::where('name', 'admin')->firstOrFail();
        $user->roles()->attach($adminRole->id);

        return redirect()->route('admin.manage_users');
    }

    public function removeAdmin($userId)
    {
        $user = User::where('id', $userId)->firstOrFail();
        $adminRole = Role::where('name', 'admin')->firstOrFail();
        $user->roles()->detach($adminRole->id);

        return redirect()->route('admin.manage_users');
    }

    public function manageUsers()
    {
        $users = User::with('roles')->get();

        return view('auth.admin.manage_users', compact('users'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
