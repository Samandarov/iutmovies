<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
use App\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        // var_dump($request);
        // print($request->user_id);
        // die;
        $this->validate($request, [
            'body' => 'required',
            'user_id' => ['required','min:1','numeric'],
        ]);
        $comment = new Comment;
        $comment->body = $request->body;
        $comment->user_id = auth()->user()->id;
        $comment->movie_id = $request->movie_id;
        $comment->series_id = $request->series_id;
        
        if(!empty($request->movie_id))
        {    
            $type = "movies";
            $smid = $request->movie_id;
        }
        else if(!empty($request->series_id))
        {    
            $type = "series";
            $smid = $request->series_id;
        }
        $comment->type = $type;
        $comment->save();
        return redirect('/'.$type.'/'.$smid)->with('success', 'A Comment added');
    }
    
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $type = $comment->type;
        if($type == "movies")
            $smid = $comment->movie_id;
        else if($type == "series")
            $smid = $comment->series_id;

        if (auth()->user()->id != $comment->user->id) {
            return redirect('/'.$type.'/'.$smid)->with('error', 'Unauthorized Page');
        }
        $comment->delete();
        return redirect('/'.$type.'/'.$smid)->with('success', 'Comment Removed');
    }
}