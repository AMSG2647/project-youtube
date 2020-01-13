@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Subir Video</div>

                <div class="card-body">

                    <form action="{{ url('/guardar-video') }}" method="POST" enctype="multipart/form-data"> 
                        
                        @csrf
                        
                        <div class="form-group">
                            <label for="title">Titulo</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">

                            @if ($errors->has('title'))
                                <span class="alert alert-danger" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif  
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>

                            @if ($errors->has('description'))
                                <span class="alert alert-danger" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="image">Miniatura</label>
                            <input type="file" class="form-control" id="image" name="image">

                            @if ($errors->has('image'))
                                <span class="alert alert-danger" role="alert">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="video">Video</label>
                            <input type="file" class="form-control" id="video" name="video">

                            @if ($errors->has('video'))
                                <span class="alert alert-danger" role="alert">
                                    <strong>{{ $errors->first('video') }}</strong>
                                </span>
                            @endif
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