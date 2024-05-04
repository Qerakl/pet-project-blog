<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::all();
        return view('articles/index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('articles/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255|min:1',
            'body' => 'required|max:255|min:1',
            'image' => 'required',
            
        ]);
        //добавление в бд
        $image = $request->file('image')->store('public');
        $image = $request->image->hashName();
        $user_id = session('user.id');
        $user = Article::create([
            'user_id' => $user_id,
            'title' => $request->title,
            'body' => $request->body,
            'image' => $image
        ]);
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    
    public function show(string $id)
    {
        $articles = Article::where('id', $id)->get();
        $comments = Comment::where('article_id', $id)->get();
        
        
        return view('articles/show', ['articles'=>$articles, 'comments'=>$comments]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $articles = Article::where('id', $id)->get();
        return view('articles/edit', ['articles'=>$articles ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $articles = Article::where('id', $id)->get();
        if(!empty($request->image)){
            
            $image = $request->file('image')->store('public');
            $image = $request->image->hashName();
            Article::where('id', $id)->update([
                'title' => $request->title,
                'body' => $request->body,
                'image' => $image,
            ]);
            foreach($articles as $article){
                Storage::delete('public/'.$article->image); //удаление файла фото статьи после успешного обновления
            }
            foreach($articles as $article){
                return redirect(route('articles.show', $article->id));
            }
        }
        Article::where('id', $id)->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);
        foreach($articles as $article){
            return redirect(route('articles.show', $article->id));
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $articles = Article::where('id', $id)->get();
        foreach($articles as $article){
            Storage::delete('public/'.$article->image); //удаление файла фото статьи
        }
        Comment::where('article_id', $id)->delete();
        Article::where('id', $id)->delete();
        return redirect('/');
    }
}
