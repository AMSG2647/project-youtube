@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">

<div class="container">
        @include('includes.message')
            @if($videos)
                @foreach($videos as $video)
                    <div class="row">
                        <div class="bg-light card mb-3" style="width:100%;">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <a href="{{route('detail.video', ['id'=>$video->id])}}" class="video-link">
                                        <img src="{{ route('view.image' ,['filename'=>$video->image])}}" class="card-img" >
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$video->title}}</h5>
                                        <p class="card-text">{{$video->description}}</p>
                                        @if(Auth::check() && Auth::user()->id == $video->user->id)
                                            <a href="{{route('edit.video', ['id'=>$video->id])}}" class="btn btn-success text-white">Editar </a>
                                            <a href="{{ route('delete.video', ['id'=>$video->id]) }}" title="Borrar" class="btn btn-danger text-white">Eliminar</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
           @endif
        {{$videos->links()}}
</div>


@endsection
