@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">
                        <h4 class="card-title">Minhas Notícias</h4>
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <form action="{{ route('noticias.index') }}" method="GET">
                                    <div class="input-group no-border">
                                        <input type="text" value="{{ request('search') }}" class="form-control" placeholder="Pesquisar notícias..." name="search">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-sm ml-2">Pesquisar</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('noticias.create') }}" class="btn btn-primary btn-sm">Adicionar Nova Notícia</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($noticias->isEmpty())
                            <p class="text-center">Nenhuma notícia encontrada.</p>
                        @else
                            <div class="table-responsive">
                                <table class="table tablesorter" id="">
                                    <thead class=" text-primary">
                                        <tr>
                                            <th>Título</th>
                                            <th>Data de Criação</th>
                                            <th class="text-right">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($noticias as $noticia)
                                            <tr>
                                                <td>{{ $noticia->titulo }}</td>
                                                <td>{{ $noticia->created_at->format('d/m/Y H:i') }}</td>
                                                <td class="text-right">
                                                    <a href="{{ route('noticias.show', $noticia) }}" class="btn btn-info btn-sm">Ver</a>
                                                    <a href="{{ route('noticias.edit', $noticia) }}" class="btn btn-warning btn-sm">Editar</a>
                                                    <form action="{{ route('noticias.destroy', $noticia) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir esta notícia?');">Excluir</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                {{ $noticias->links('pagination::bootstrap-4') }} {{-- Usando o tema de paginação do Bootstrap 4 --}}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
