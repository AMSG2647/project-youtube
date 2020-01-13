<form action="{{route('save.comment')}}" enctype="multipart/form-data" method="post">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <input type="hidden" name="video_id" id="video_id" value="{{$video->id}}" required>
                <p>
                    <textarea class="form-control" name="body" id="body"></textarea>
                </p>
            </div>

            <div class="col-md-2 pull-right" style="margin-top:10px;">
                <input type="submit" value="Comentar" class="btn btn-info text-white">
            </div>
        </div>
    </div>

</form>