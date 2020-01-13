@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">

    <div class="container">
        @include('includes.message')
                <div class="row">
                    <div class="card col-md-12" style="padding:0">
                        <video id="videoPanel" class="card-img-top" poster="{{--route('view.image' ,['filename'=>$video->image])--}}" width="80%" height="auto" controls>
                            <source src="{{ route('view.video' ,['filename'=>$video->video_path])}}">
                        </video>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-10">
                                    <h5 class="card-title"><strong>{{$video->title}}</strong></h5>
                                    <p class="card-text">{{$video->description}}</p>
                                    <p class="card-text text-info"><strong>Subido {{ \FormatTime::LongTimeFilter($video->created_at) }}
                                            por {{$video->user->name}}</strong>
                                    </p>
                                </div>
                                <div class="col-md-2">
                                    @if(Auth::check() && Auth::user()->id == $video->user->id)
                                        <div style="margin-left: 60px;">
                                            <a href="#" title="Editar"><img src="{{ asset('img/edit.png') }}" alt="Editar" style="width: 30px"></a>
                                            <a href="{{ route('delete.video', ['id'=>$video->id]) }}" title="Borrar"  ><img src="{{ asset('img/delete.png') }}" alt="Borrar" style="width: 30px"></a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{--Comentarios--}}
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">@include('video.comments')</li>
                            <li class="list-group-item text-white bg-info"><strong>Comentarios</strong>:</li>
                            @if(isset($video->comments))
                                @foreach($video->comments as $comment)

                                    <li class="list-group-item">
                                        <div class="row">
                                        <div class="col-md-1" style="margin-top: 12px;">
                                            <img src="{{asset('img/user-account.png')}}" style="width: 70px; height: 70px;">
                                        </div>
                                            <div class="col-md-10" style="margin-left: 15px;">
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <p><strong>{{$comment->user->name." ".$comment->user->surname}}:</strong></p>
                                                        <p>{{$comment->body}}</p>
                                                        <p class="text-info">({{\FormatTime::LongTimeFilter($comment->created_at)}})</p>
                                                    </div>
                                                    @if(Auth::check() && (Auth::user()->id == $comment->user_id || Auth::user()->id == $video->user_id))
                                                        <div class="col-md-1 pull-right">
                                                            <a href="{{ route('delete.comment', ['id'=>$comment->id]) }}" title="Borrar" class="btn btn-danger text-white">Eliminar</a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                        <div class="card-footer text-muted align-content-center">
                            @ViAngels derechos reservados por la compañia.
                        </div>
                    </div>
                </div>
    </div>
@endsection
