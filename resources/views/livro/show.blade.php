@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detalhes</div>

                <div class="card-body">
                 @if($msg !='')
                <div class="alert {{$classe}}" role="alert">
                {{$msg}}   
                </div>
                @endif
                <div id="buscar"></div>
                <div class="media">
                       <!---
                  Implementar no AWS
                    @if($livro->capa !=null)
                    <img class="align-self-center mr-4" src="/storage/{{$livro->capa}}"  height="150" width="120">
                    @else
                     <img class="align-self-center mr-4" src="/imagem/not.png"  height="150" width="120">
                    @endif
                    -->
                    <div class="media-body">
                        <h5 class="mt-0"><b>{{$livro->titulo}}</b></h5>
                        <p>Autor:
                        @foreach ($livro->autores as $autor )
                        <span>{{$autor->nome}}</span>
                        @endforeach
                        </p>
                        <p>Genero:
                        <span>{{$livro->genero->nome}}</span>
                        </p>
                        <p>Numero de paginas:
                        <span>{{$livro->num_pags}}</span>
                        </p>
                        <p>Numero de paginas lido:
                        <span>{{$livro->num_pags_lidos}}</span>
                        </p>
                        @if($livro->dt_inicial != null)
                         <p>Data do inicio:
                        <span>{{ date('d/m/Y',strtotime($livro->dt_inicial))}}</span>
                        </p>
                        @endif
                           @if($livro->dt_final != null)
                         <p>Data do final:
                        <span>{{ date('d/m/Y',strtotime($livro->dt_final))}}</span>
                        </p>
                        @endif
                        <p>
                        <div class="progress w-50">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{$livro->progresso}}%" aria-valuenow="{{$livro->progresso}}" aria-valuemin="0" aria-valuemax="100">{{$livro->progresso}}%</div>
                        </div>
                        </p>
                    </div>
                    </div>
                </div>
                <div class="card-footer">
                @if($livro->situacao == "Pendente" || $livro->situacao == "Abandonado")
                <a href="{{ route('livro.iniciar',['livro'=>$livro->id])}}" type="button" class="btn btn-success">Iniciar</a>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#excluirModal{{$livro->id}}">Excluir</button>
                @elseif($livro->situacao == "Concluido")
                <a href="{{ route('livro.index')}}" type="button" class="btn btn-danger">Voltar</a>
                <a href="{{ route('livro.reler',['livro'=>$livro->id])}}" class="btn btn-success">Reler</a>
                @elseif($livro->situacao == "Iniciado")
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#adicionarModal{{$livro->id}}">Adicionar paginas</button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#finalizarModal{{$livro->id}}">Finalizar</button>
                 <a href="{{ route('livro.desistir',['livro'=>$livro->id])}}" class="btn btn-danger">Desisitir</a>
                @endif
                
                </div>
                <!-- Modal  -->
                 @component('layouts._components.livro.modal',['livro' => $livro])
                 @endcomponent  
                 <!--Fim Modal-->
            </div>
        </div>
    </div>
</div>
@endsection
