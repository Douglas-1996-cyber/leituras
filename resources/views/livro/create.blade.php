@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cadastrar livros</div>

            <div class="card-body">
                @if($msg !='')
                <div class="alert {{$classe}}" role="alert">
                {{$msg}}  
                </div>
                @elseif($errors->has('capa')!=null)
                 <div class="alert alert-danger" role="alert">
                 {{$errors->first('capa')}}  
                 </div>
                @endif
                <div id="buscar"></div>
                   <form method="post" action="{{route('livro.store')}}">
                    @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="titulo">Titulo</label>
                            <input type="text"  class="form-control" id="titulo" placeholder="titulo" name="titulo"  required>
                          
                            </div>
                            <div class="form-group col-md-6">
                            <label for="num_pags">Numero de Paginas</label>
                            <input type="number" class="form-control" id="num_pags" placeholder="Numero de paginas" min="0" name="num_pags" required>
                            </div>
                        </div>
                        <div class="form-row">
                           
                            <div class="form-group col-md-6">
                            <label for="autor">Autor</label>
                            <select id="autor" class="form-control" name="autor_id" required>
                            <option selected value="" >Escolha um autor</option>
                            @foreach ($autores as $autor)
                              <option value="{{$autor->id}}">{{$autor->nome}}</option>
                            @endforeach
                            </select>
                            </div>
                            <div class="form-group col-md-6">
                            <label for="genero">Genero</label>
                            <select id="genero" class="form-control" name="genero_id" required>
                            <option selected value="">Escolha um genero</option>
                            @foreach ($generos as $genero)
                              <option value="{{$genero->id}}">{{$genero->nome}}</option>
                            @endforeach
                            </select>
                            </div>
                            <div class="form-group col-md-4">
                            <label for="lido">Já leu?</label>
                            <input  type="checkbox" id="lido" name="lido">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Cadastrar</button> 
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cadastrarAutorModal">Adicionar Autor</button>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cadastrarGeneroModal">Adicionar Genero</button>
                        </form>
                    
                        @component('layouts._components.autor.modalCreate')
                            <input type="hidden" name="rota" value="2">
                        @endcomponent     
                         @component('layouts._components.genero.modalCreate')
                        <input type="hidden" name="rota" value="2">
                        @endcomponent   
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
