@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                Lista de livros
                </div>
                <div class="card-body table-responsive">
                @if($msg !='')
                <div class="alert {{$classe}}" role="alert">
                {{$msg}}   
                </div>
                @elseif($errors->has('capa')!=null)
                 <div class="alert alert-danger" role="alert">
                 {{$errors->first('capa')}}  
                 </div>
                @endif
                 <form method="get" action="{{ route('livro.index') }}">
                 <div id="buscar" class="input-group mb-2 row-sm-6">
                    <input type="text" name="pesquisar"  v-model="pesquisar" class="form-control" placeholder="Informe um titulo" aria-label="Informe um titulo" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button  :class="classe"  type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                    </div>
                </form>
                 @if(sizeof($livros) == 0)
                Nenhum Resultado encontrado!
                @else
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                            <th scope="col">Titulo</th>
                            <th scope="col">Autor</th>
                            <th scope="col">Situação</th>
                            <th scope="col">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($livros as $livro )
                            @foreach ( $livro->autores as $autor)
       
                            <tr>
                            <th scope="row">{{$livro->titulo}}</th>
                            <td>{{$autor->nome}}</td>
                            <td>{{ $livro->situacao}}</td>
                            <td>
                            <button type="button" class="btn btn-outline-primary btn-lg" data-toggle="modal" data-target="#alterarModal{{$livro->id}}">
                            <i class="fa-solid fa-pen"></i>
                            </button>
                            <a href="{{route('livro.show',['livro'=>$livro->id])}}" type="button" class="btn btn-outline-info btn-lg">
                            <i class="fa-solid fa-circle-info"></i>
                            </a>
                            </td>
                            </tr>
                            @component('layouts._components.livro.modal',['livro'=>$livro])
                            @endcomponent 
                             @endforeach
                             @endforeach
                        </tbody>
                        
                        </table>
                   {{$livros->appends($resquest)->links()}}  
                
                 @endif
                </div>
                 <div class="card-footer"><a href="{{route('livro.create')}}"  type="button" class="btn btn-success" >Cadastrar</i></a></div>
            </div>
        </div>
    </div>
</div>
@endsection


