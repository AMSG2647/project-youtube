@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="card">
                    <div class="card-header">Editar {{$video->title}}</div>

                    <div class="card-body">
                        <form action="{{ route('update.video',['id'=> $video->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                @include('includes.message')
                            </div>
                            <div class="form-group">
                                <label for="title">Titulo</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{$video->title}}">

                                @if ($errors->has('title'))
                                    <span class="alert alert-danger" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <textarea class="form-control" id="description" name="description">{{$video->description}}</textarea>

                                @if ($errors->has('description'))
                                    <span class="alert alert-danger" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-1" style="margin-top: 10px;">
                                        <img src="{{route('view.image',['filename'=>$video->image])}}" width="50px" height="50px">
                                    </div>
                                    <div class="col-md-11">
                                        <label for="image">Miniatura</label>
                                        <input type="file" class="form-control" id="image" name="image">

                                        @if ($errors->has('image'))
                                            <span class="alert alert-danger" role="alert">
                                                <strong>{{ $errors->first('image') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                            </div>

                            <div class="form-group" style="margin-left:90%">
                                <input type="submit" class="btn bg-gray" value="Enviar">
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection