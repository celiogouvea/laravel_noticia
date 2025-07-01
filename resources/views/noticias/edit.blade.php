@extends('layouts.app', ['class' => 'bg-default'])

@section('content')

    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent pb-5">
                        <div class="text-muted text-center mt-2 mb-3"><h1>Edit News</h1></div>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form role="form" method="POST" action="{{ route('noticias.update', $noticia) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="titulo">Title</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-single-copy-04"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Título da Notícia" type="text" name="titulo" value="{{ old('titulo', $noticia->titulo) }}" required autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="conteudo">Content</label>
                                <textarea class="form-control form-control-alternative" rows="5" placeholder="Conteúdo da Notícia" name="conteudo" required>{{ old('conteudo', $noticia->conteudo) }}</textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4">Update News</button>
                                <a href="{{ route('noticias.index') }}" class="btn btn-secondary my-4">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
