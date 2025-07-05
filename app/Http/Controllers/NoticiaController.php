<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importar Auth
use Illuminate\Support\Facades\Gate; // Importar Gate

class NoticiaController extends Controller
{
    /**
     * Construtor para aplicar o middleware de autenticação.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Exibe uma listagem das notícias do usuário autenticado, com pesquisa.
     */
    public function index(Request $request)
    {
        $query = Noticia::where('user_id', Auth::id()); // Filtrar por user_id

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('titulo', 'like', '%' . $search . '%')
                  ->orWhere('conteudo', 'like', '%' . $search . '%');
            });
        }

        $noticias = $query->orderBy('created_at', 'desc')->paginate(10);

        // Adiciona 'pageSlug' para ativar o link no sidebar
        return view('noticias.index', compact('noticias'))->with('pageSlug', 'noticias');
    }


    /**
     * Exibe uma listagem das notícias, com pesquisa.
     */
    public function indexAll(Request $request)
    {
        $query = Noticia::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('titulo', 'like', "%$search%")
                ->orWhere('conteudo', 'like', "%$search%");
            });
        }

        $noticias = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('noticias.public', compact('noticias'));
    }

    /**
     * Mostra o formulário para criar uma nova notícia.
     */
    public function create()
    {
        // Adiciona 'pageSlug' para ativar o link no sidebar
        return view('noticias.create')->with('pageSlug', 'noticias');
    }

    /**
     * Armazena uma notícia recém-criada no banco de dados.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'conteudo' => 'required|string',
        ]);

        Noticia::create([
            'titulo' => $request->titulo,
            'conteudo' => $request->conteudo,
            'user_id' => Auth::id(), // Atribuir a notícia ao usuário autenticado
        ]);

        return redirect()->route('noticias.index')->with('success', 'Notícia criada com sucesso!');
    }

    /**
     * Exibe a notícia especificada.
     */
    public function show(Noticia $noticia)
    {
        // Verifica se o usuário autenticado é o dono da notícia
        if (Gate::denies('view-noticia', $noticia)) {
            abort(403, 'Acesso não autorizado. Você não tem permissão para visualizar esta notícia.');
        }

        // Adiciona 'pageSlug' para ativar o link no sidebar
        return view('noticias.show', compact('noticia'))->with('pageSlug', 'noticias');
    }

    /**
     * Mostra o formulário para editar a notícia especificada.
     */
    public function edit(Noticia $noticia)
    {
        // Verifica se o usuário autenticado é o dono da notícia
        if (Gate::denies('update-noticia', $noticia)) {
            abort(403, 'Acesso não autorizado. Você não tem permissão para editar esta notícia.');
        }

        // Adiciona 'pageSlug' para ativar o link no sidebar
        return view('noticias.edit', compact('noticia'))->with('pageSlug', 'noticias');
    }

    /**
     * Atualiza a notícia especificada no banco de dados.
     */
    public function update(Request $request, Noticia $noticia)
    {
        // Verifica se o usuário autenticado é o dono da notícia
        if (Gate::denies('update-noticia', $noticia)) {
            abort(403, 'Acesso não autorizado. Você não tem permissão para atualizar esta notícia.');
        }

        $request->validate([
            'titulo' => 'required|string|max:255',
            'conteudo' => 'required|string',
        ]);

        $noticia->update([
            'titulo' => $request->titulo,
            'conteudo' => $request->conteudo,
        ]);

        return redirect()->route('noticias.index')->with('success', 'Notícia atualizada com sucesso!');
    }

    /**
     * Remove a notícia especificada do banco de dados.
     */
    public function destroy(Noticia $noticia)
    {
        // Verifica se o usuário autenticado é o dono da notícia
        if (Gate::denies('delete-noticia', $noticia)) {
            abort(403, 'Acesso não autorizado. Você não tem permissão para excluir esta notícia.');
        }

        $noticia->delete();

        return redirect()->route('noticias.index')->with('success', 'Notícia excluída com sucesso!');
    }
}
