<a title="Borrar" data-toggle="modal" data-target="#myModal" ><img src="{{ asset('img/delete.png') }}" alt="Borrar" style="width: 30px"></a>
<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Eliminar Video</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                ¡Si eliminas la video no podras recuperarla!
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn bg-light" data-dismiss="modal">Cerrar</button>
                <a href="{{-- route('video.delete', ['id'=>$video->id]) --}}" title="Borrar" class="btn btn-danger">Borrar</a>
            </div>

        </div>
    </div>
</div>