@extends('layouts.public')

@section('content')
    <h2 class="mb-4">Public News</h2>

    <form action="{{ route('noticias.indexAll') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" value="{{ request('search') }}" class="form-control" placeholder="Search news..." name="search">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    @if ($noticias->isEmpty())
        <div class="alert alert-info text-center">No news found.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Title</th>
                        <th>Creation Date</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($noticias as $noticia)
                        <tr>
                            <td>{{ $noticia->titulo }}</td>
                            <td>{{ $noticia->created_at->format('d/m/Y H:i') }}</td>
                            <td class="text-right">
                                <a href="{{ route('noticias.show', $noticia) }}" class="btn btn-sm btn-info">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $noticias->links('pagination::bootstrap-4') }}
        </div>
    @endif
@endsection
