@extends('layouts.app', ['class' => 'bg-default'])

@section('content')

    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent pb-5">
                        <div class="text-muted text-center mt-2 mb-3"><h1>Detalhes da Notícia</h1></div>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <h2 class="card-title">{{ $noticia->titulo }}</h2>
                        <p class="card-text text-muted">Publicado por: {{ $noticia->user->name }} em {{ $noticia->created_at->format('d/m/Y H:i') }}</p>
                        <hr>
                        <p class="card-text">{{ $noticia->conteudo }}</p>
                        <div class="text-center mt-5">
                            <a href="{{ route('noticias.index') }}" class="btn btn-primary">Voltar para Minhas Notícias</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
