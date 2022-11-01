@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-md-6">
            <div class="card">
               <div class="card-header">Livros do(a) {{$autor->nome}}</div>
                <div class="card-body">
                <div id="buscar"></div>
                  <table class="table table-bordered table-hover table-responsive-sm">
                         @if(sizeof($autor->livros) == 0)
                             Nenhum livro encontrado
                            @else
                            <thead>
                                <tr>
                                <th scope="col">Titulo</th>
                                <th scope="col">Situação</th>
                                </tr>
                            </thead>
                        <tbody>
                            @foreach ($autor->livros as $livro )
                                <tr>
                                <th scope="row">{{$livro->titulo}}</th>
                                <td>{{$livro->situacao}}</td>
                                </tr>
                             @endforeach
                            
                            </tbody>
                            @endif
                        </table>
                </div>
                <div class="card-footer"><a href="{{ url()->previous() }}" type="button" class="btn btn-danger">Voltar</a></div> 
            </div>
        </div>
    </div>
                
</div>
@endsection
