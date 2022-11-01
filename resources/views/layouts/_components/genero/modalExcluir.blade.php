<!-- Modal Excluir -->
@if(isset($genero))
<div class="modal fade" id="excluirModalID{{$genero->id}}" tabindex="-1" role="dialog" aria-labelledby="excluirModalLabel" aria-hidden="true">
    <form  id="form_{{ $genero->id}}" method="post" action=" {{route('genero.destroy',['genero'=>$genero->id])}} ">
                                        @method('DELETE')
                                        @csrf
                              
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="excluirModalLabel">Deseja Excluir?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                      O genero "{{$genero->nome}}" será excluido, tem certeza da operação?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        <button type="submit"  class="btn btn-danger">Excluir</button>
                                    </div>
                                    </div>
                                </div>
                            </form> 
                        </div>
@endif  
<!--Fim Modal Excluir -->