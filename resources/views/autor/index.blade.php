@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-md-8">
            <div class="card">
               <div class="card-header">Autores</div>
                <div class="card-body table-responsive">
                @if($msg !='')
                <div class="alert {{$classe}}" role="alert">
                {{$msg}}   
                </div>
                @endif
                 <form method="get" action="{{ route('autor.index') }}">
                  <div id="buscar" class="input-group mb-2 row-sm-6">
                    <input type="text" name="pesquisar"  v-model="pesquisar" class="form-control" placeholder="Informe um titulo" aria-label="Informe um titulo" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button  :class="classe"  type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                    </div>
                </form>
                @if(sizeof($autores) == 0)
                Nenhum Resultado encontrado!
                @else
                  <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($autores as $autor )
                                <tr>
                                <th scope="row">{{$autor->nome}}</th>
                                <td>
                                <button type="button" class="btn btn-outline-primary btn-lg" data-toggle="modal" data-target="#alterarModal{{$autor->id}}"><i class="fa-solid fa-pen"></i></button>
                                <button type="button" class="btn btn-outline-danger btn-lg" data-toggle="modal" data-target="#excluirModal{{$autor->id}}"><i class="fa-solid fa-trash"></i></button>
                                <a href="{{route('autor.show',['autor'=>$autor->id])}}" type="button" class="btn btn-outline-info btn-lg"><i class="fa-solid fa-circle-info"></i></a>
                                </td>
                                </tr>
                                <!-- Modal  -->
                                  @component('layouts._components.autor.modalExcluir',['autor'=>$autor])
                                       @endcomponent  
                                        @component('layouts._components.autor.modalAlterar',['autor'=>$autor])
                                       @endcomponent  
                                 <!--Fim Modal-->
                             @endforeach
                            </tbody>
                            </table>
                 @endif           
                </div>
                <div class="card-footer"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#cadastrarAutorModal">Cadastrar</button></div> 
            </div>
        </div>
    </div>

   @component('layouts._components.autor.modalCreate')
    <input type="hidden" name="rota" value="1">
   @endcomponent                           
</div>
@endsection
