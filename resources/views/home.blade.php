@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Saudações</div>

                <div class="card-body">
                   Seja bem vindo(a) {{auth()->user()->name;}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
