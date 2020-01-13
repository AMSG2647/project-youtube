<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


use App\Video;
use App\Comment;
use Illuminate\Http\Response;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createVideo(){
        return view('video.createVideo');
    }

    public function saveVideo(Request $request){

        //validar formulario
        $validate = $this->validate($request, [
            'title'         => 'required',
            'description'   => 'required',
            'video'   => 'mimes:mp4|required',
            'image'   => 'mimes:jpg,png,bmp,jpeg'
        ]);

        $video  = new Video();
        $user   = \Auth::user();

        //subida de la miniatura
        $image = $request->file('image');

        if($image){
            $image_path = time().$image->getClientOriginalName();
            \Storage::disk('images')->put($image_path, \File::get($image));
            $video->image  = $image_path;
        }

        $videoField = $request->file('video');

        if($videoField){
            $video_path = time().$videoField->getClientOriginalName();
            \Storage::disk('videos')->put($video_path, \File::get($videoField));
            $video->video_path  = $video_path;
        }

        $video->user_id     = $user->id;
        $video->title       = $request->input('title');
        $video->description = $request->input('description');

        $video->save();

        return redirect()->route('home')->with(array(
            'message' => "Video subido correctamente"
        ));
    }

    public function getImage($filename){

        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }

    public function getVideo($filename){

        $file = Storage::disk('videos')->get($filename);
        return new Response($file, 200);
    }

    public function getVideoDetail($id){
        $video = Video::find($id);

        return view('video.detail', ['video'=>$video]);
    }

    public function delete($id){
        $user       = \Auth::user();
        $video      = Video::find($id);
        $comments   = Comment::where('video_id', $video->id)->get();

        if($user && $video->user_id == $user->id){

            if($comments && count($comments) >=1){
                foreach ($comments as $comment) {
                    $comment->delete();
                }
            }

            //eliminar ficheros
            Storage::disk('images')->delete($video->image);
            Storage::disk('videos')->delete($video->video_path);

            $video->delete();

            $message="Video eliminado con exito";
        }else{
            $message="Error al eliminar video";
        }

        return redirect()->route('home')
            ->with(['message'=>$message]);
    }

    public function edit($id){

        $user = \Auth::user();
        $video = Video::findOrFail($id);

        if ($user && $video->user_id == $user->id) {
            return view('video.edit', ['video' => $video]);
        }else{
            return redirect()->route('home');
        }
    }

    public function update($id, Request $request){

        $validate =$this->validate($request,
                                   ['title'         =>'required',
                                    'description'   =>'required',
                                    'image'         => 'mimes:jpg,png,bmp,jpeg']
                                    );

        $title      = $request->input('title');
        $description= $request->input('description');
        $image      = $request->file('image');

        $video              = Video::findOrFail($id);
        $video->title       = $title;
        $video->description = $description;

        if($image){
            $image_path = time().$image->getClientOriginalName();
            \Storage::disk('images')->put($image_path, \File::get($image));

            Storage::disk('images')->delete($video->image);
            $video->image  = $image_path;
        }

        $video->update();

        return redirect()->route('edit.video', ['id'=>$video->id])
                         ->with(['message'=>'Datos Actualizados']);
    }

    public function search ($search = null){

        if (is_null($search)){
            $search = \Request::get('search');
        }

        $videos = Video::where('title', 'LIKE' , '%'.$search.'%')->paginate(5);
        return view('video.search',['videos'=>$videos,
                                         'search' =>$search]);
    }
}
