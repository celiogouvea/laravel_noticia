@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-8 mx-auto"> {{-- Centraliza o formulário --}}
                <div class="card ">
                    <div class="card-header">
                        <h4 class="card-title">Criar Nova Notícia</h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('noticias.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="titulo">Título</label>
                                <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo') }}" placeholder="Título da Notícia" required autofocus>
                            </div>
                            <div class="form-group">
                                <label for="conteudo">Conteúdo</label>
                                <textarea class="form-control" id="conteudo" name="conteudo" rows="7" placeholder="Conteúdo da Notícia" required>{{ old('conteudo') }}</textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4">Salvar Notícia</button>
                                <a href="{{ route('noticias.index') }}" class="btn btn-secondary my-4">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
