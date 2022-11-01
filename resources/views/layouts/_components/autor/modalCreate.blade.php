 <div class="modal fade" id="cadastrarAutorModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="cadastrarAutorModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                      <form method="post" action="{{route('autor.store')}}">
                                  @csrf
                                 {{$slot}}
                          <div class="modal-header">
                              <h5 class="modal-title" id="cadastrarAutorModalLabel">Cadastrar Autor</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                          
                              <div class="form-group">
                                  <label for="tipo">Nome do autor</label>
                                  <input name="nome" type="text" class="form-control" id="nome" required>
                              </div>
              
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                              <button type="submit" class="btn btn-success">Cadastrar</button>
                          </div>
                      </form> 
                      </div>
                  </div>
                  </div>