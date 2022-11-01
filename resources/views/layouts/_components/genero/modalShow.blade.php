 

 @if(isset($genero))
    <div class="modal fade" id="showModalID{{$genero->id}}" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
          
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel">Detalhes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <span>{{$genero->nome}} possui <b>{{sizeof($genero->livros)}}</b> livros cadastrados</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
        </div>
   @endif     


 