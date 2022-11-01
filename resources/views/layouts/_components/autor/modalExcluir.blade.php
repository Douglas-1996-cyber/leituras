@if(isset($autor))
 <div class="modal fade" id="excluirModal{{$autor->id}}" tabindex="-1" aria-labelledby="excluirModalLabel" aria-hidden="true">
 <div class="modal-dialog">
     <div class="modal-content">
      <form  method="post" action="{{route('autor.destroy',['autor'=>$autor->id])}}">
                 @csrf
                 @method('DELETE')
         <div class="modal-header">
             <h5 class="modal-title" id="excluirModalLabel">Excluir Autor</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
         </div>
         <div class="modal-body">
            <span>Tem certeza que deseja excluir o autor(a) {{$autor->nome}}? </span>
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