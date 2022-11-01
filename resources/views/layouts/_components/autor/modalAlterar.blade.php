@if(isset($autor))
 <div class="modal fade" id="alterarModal{{$autor->id}}" tabindex="-1" aria-labelledby="alterarModalLabel" aria-hidden="true">
 <div class="modal-dialog">
     <div class="modal-content">
      <form  method="post" action="{{route('autor.update',['autor'=>$autor->id])}}">
                 @csrf
                 @method('PUT')
         <div class="modal-header">
             <h5 class="modal-title" id="alterarModalLabel">Alterar Autor</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
         </div>
         <div class="modal-body">
            
               <div class="form-group">
                  <label for="tipo">Nome do autor</label>
                  <input name="nome" type="text" class="form-control" id="nome" value="{{$autor->nome}}" required>
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