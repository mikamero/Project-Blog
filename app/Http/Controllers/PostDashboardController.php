<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->where('author_id', Auth::user()->id);

        if (request('keyword')) {
            $posts->where('title', 'LIKE', '%' . request('keyword') . '%');
        }

        return view('dashboard.index', ['posts' => $posts->paginate(10)->withQueryString()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:posts|min:4|max:255',
            'category_id' => 'required',
            'body' => 'required',
        ], [
            'category_id.required' => 'Pick one of the :attrribute',
        ], [
            'category_id' => 'category',
        ]);

//        Validator::make($request->all(), [
//            'title' => 'required|unique:posts|min:4|max:255',
//            'category_id' => 'required',
//            'body' => 'required',
//        ], [
//            'title.required' => 'field :attribute harus diisi!',
//            'category_id.required' => 'pilih salah satu :attribute!',
//            'body.required' => 'field :attribute tidak boleh kosong!',
//        ], [
//            'title' => 'judul',
//            'category_id' => 'kategori',
//            'body' => 'tulisan',
//        ])->validate();

        Post::create([
            'title' => $request->title,
            'author_id' => Auth::id(),
            'category_id' => $request->category_id,
            'slug' => Str::slug($request->title),
            'body' => $request->body
        ]);

        return redirect('/dashboard')->with(['success' => 'Your post has been saved!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('dashboard.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('dashboard.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|min:4|max:255|unique:posts,title' . $post->id,
            'category_id' => 'required',
            'body' => 'required',
        ], [
            'category_id.required' => 'Pick one of the :attrribute',
        ], [
            'category_id' => 'category',
        ]);

        $post->fill([
            'title' => $request->title,
            'author_id' => Auth::id(),
            'category_id' => $request->category_id,
            'slug' => Str::slug($request->title),
            'body' => $request->body,
        ]);

        if ($post->isClean()) {
            return back()->withErrors([
                'no_changes' => 'No changes were made.',
            ])->withInput();
        }

        $post->save();

        return redirect('dashboard')->with(['success' => 'Your post has been updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect('dashboard')->with(['success' => 'Your post has been deleted!']);
    }
}
