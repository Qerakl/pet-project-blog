<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function add_comment(Request $request, string $id){
        $validated = $request->validate([
            'body' => 'required|min:1'
        ]);
        //добавление в бд
        $user_name = session('user.name');;
        $user_id = session('user.id');
        $user = Comment::create([
            'user_id' => $user_id,
            'user_name' => $user_name,
            'article_id' => $id,
            'body' => $request->body
        ]);
        return redirect('/articles/'.$id);
    }
    public function edit(string $id)
    {
        $comments = Comment::where('id', $id)->get();
        return view('comments/edit', ['comments'=>$comments ]);
    }
    public function update(Request $request, string $id)
    {
        $comments = Comment::where('id', $id)->get();
        
        Comment::where('id', $id)->update([
            'body' => $request->body,
        ]);
            foreach($comments as $comment){
                return redirect(route('articles.show', $comment->article_id));
            }
        
    }
    public function destroy(string $id)
    {
        $comments = Comment::where('id', $id)->get();
        Comment::where('id', $id)->delete();
        foreach($comments as $comment){
            return redirect(route('articles.show', $comment->article_id));
        }
    }
}
