@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-md-10">
            <div class="card">
               <div class="card-header">Generos</div>
                <div class="card-body table-responsive">  
                    @if($msg !='')
                    <div class="alert {{$classe}}" role="alert">
                    {{$msg}}   
                    </div>
                    @endif
                 <form method="get" action="{{ route('genero.index') }}">
                 <div id="buscar" class="input-group mb-2 row-sm-6">
                    <input type="text" name="pesquisar"  v-model="pesquisar" class="form-control" placeholder="Informe um titulo" aria-label="Informe um titulo" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button  :class="classe"  type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                    </div>
                </form>
                 @if(sizeof($generos) == 0)
                Nenhum Resultado encontrado!
                @else
                  <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                <th scope="col">Genero</th>
                                <th scope="col">Ação</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                            @foreach ($generos as $genero )
                                <tr>
                                <td scope="row">{{$genero->nome}}</td>
                                <td>
                                <button type="button" class="btn btn-outline-primary btn-lg" data-toggle="modal" data-target="#alterarModalID{{$genero->id}}"><i class="fa-solid fa-pen"></i></button>
                                <button type="button" class="btn btn-outline-danger btn-lg"  data-toggle="modal" data-target="#excluirModalID{{$genero->id}}"><i class="fa-solid fa-trash"></i></button>
                                <button type="button" class="btn btn-outline-info btn-lg" data-toggle="modal" data-target="#showModalID{{$genero->id}}"><i class="fa-solid fa-circle-info"></i></button>
                                </td>
                                </tr>
                                       @component('layouts._components.genero.modalExcluir',['genero'=>$genero])
                                       @endcomponent  
                                        @component('layouts._components.genero.modalAlterar',['genero'=>$genero])
                                       @endcomponent  
                                        @component('layouts._components.genero.modalShow',['genero'=>$genero])
                                       @endcomponent  
                           @endforeach
                            </tbody>
                            
                    </table>
                     {{$generos->appends($resquest)->links()}}  
                     
                  @endif  
                </div>
                <div class="card-footer"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#cadastrarGeneroModal">Cadastrar</button></div> 
            </div>
        </div>
    </div>
    <!-- Modal Cadastrar -->
      @component('layouts._components.genero.modalCreate')
       <input type="hidden" name="rota" value="1">
     @endcomponent  
     <!--Fim Modal Cadastrar -->                    
</div>
@endsection
