  <!-- Modal Adicionar Paginas -->
  @if(isset($livro))
    <div class="modal fade" id="adicionarModal{{$livro->id}}" tabindex="-1" aria-labelledby="adicionarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
         <form  method="post" action="{{route('livro.addPaginas',['livro'=>$livro->id])}}">
                    @csrf
                    @method('PATCH')
            <div class="modal-header">
                <h5 class="modal-title" id="alterarModalLabel">Adicionar Paginas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               
                  <div class="form-group">
                     <label for="tipo">Numero de paginas</label>
                     <input name="numPaginas" type="number" class="form-control" id="numPaginas" min="0" required>
                 </div>
    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-success">Adicionar</button>
            </div>
        </form> 
        </div>
    </div>
    </div>
@endif
<!--Fim Modal Adicionar Paginas -->
<!-- Modal Excluir -->
 @if(isset($livro))
    <div class="modal fade" id="excluirModal{{$livro->id}}" tabindex="-1" aria-labelledby="excluirModalLabel" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
              <form  method="post" action="{{route('livro.destroy',['livro'=>$livro->id])}}">
                         @csrf
                         @method('DELETE')
                 <div class="modal-header">
                     <h5 class="modal-title" id="excluirModalLabel">Excluir Livro</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                    <span>Tem certeza que deseja excluir o livro {{$livro->titulo}}? </span>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-primary" data-dismiss="modal">Não</button>
                     <button type="submit" class="btn btn-danger">Sim</button>
                 </div>
             </form> 
             </div>
         </div>
    </div>
 @endif   
<!--Fim Modal Excluir -->

  <!-- Modal Finalizar -->
  @if(isset($livro))
    <div class="modal fade" id="finalizarModal{{$livro->id}}" tabindex="-1" aria-labelledby="finalizarMModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
         <form  method="post" action="{{route('livro.addPaginas',['livro'=>$livro->id])}}">
                    @csrf
                    @method('PATCH')
              <input type="hidden" name="numPaginas" value="{{$livro->num_pags - $livro->num_pags_lidos}}">      
            <div class="modal-header">
                <h5 class="modal-title" id="alterarModalLabel">Finalizar livro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
             Falta {{$livro->num_pags - $livro->num_pags_lidos}} para terminar o livro. Tem certeza da operação?  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-success">Finalizar</button>
            </div>
        </form> 
        </div>
    </div>
    </div>
@endif
<!--Fim Modal Finalizar -->
<!--Modal alterar -->
 @if(isset($livro))
    <div class="modal fade" id="alterarModal{{$livro->id}}" tabindex="-1" aria-labelledby="alterarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
         <form  method="post" action="{{route('livro.update',['livro'=>$livro->id])}}">
                    @csrf
                    @method('PATCH')    
            <div class="modal-header">
                <h5 class="modal-title" id="alterarModalLabel">Alterar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
               
                  <input type="hidden" value="{{$livro->autores}}" name="autor">
                  <label for="tipo">Titulo:</label>
                  <input name="titulo" type="text" class="form-control" id="titulo" value="{{$livro->titulo}}" required>
                  <!---
                  Implementar no AWS
                  <label for="capa">Capa:</label>
                  <input type="file" class="form-control" name="capa">-->
                 
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
<!--Fim Modal alterar -->