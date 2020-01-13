<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function save(Request $request){

        $validate = $this->validate($request,
                                    ['body'     => 'required',
                                     'video_id' => 'required']);

        $user       = \Auth::user();
        $comment    = new Comment();

        $video_id   = $request->input('video_id');
        $body       = $request->input('body');
        $user_id    = $user->id;

        $comment->user_id   = $user_id;
        $comment->video_id  = $video_id;
        $comment->body      = $body;

        $comment->save();

        return redirect()->route('detail.video', ['id'=>$video_id])
               ->with(['message'=>'Tu comentario fue publicado con exito']);

    }

    public function delete($id){

        $user = \Auth::user();
        $comment = Comment::find($id);

        if($user && ($comment->user_id == $user->id || $comment->video->user_id == $user->id)){

            $comment->delete();

            return redirect()->route('detail.video', ['id'=>$comment->video_id])
                ->with(['message'=>'Tu comentario fue eliminado con exito']);
        }


    }

}
