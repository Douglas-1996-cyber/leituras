@if(isset($genero))
<div class="modal fade" id="alterarModalID{{$genero->id}}" tabindex="-1" aria-labelledby="alterarModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
     <form  method="post" action="{{route('genero.update',['genero'=>$genero->id])}}">
                @csrf
                @method('PUT')
        <div class="modal-header">
            <h5 class="modal-title" id="alterarModalLabel">Alterar Genero</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
           
              <div class="form-group">
                 <label for="tipo">Genero</label>
                 <input name="nome" type="text" class="form-control" id="nome" value="{{$genero->nome}}" required>
             </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-success">Alterar</button>
        </div>
    </form> 
    </div>
</div>
</div>
@endif 