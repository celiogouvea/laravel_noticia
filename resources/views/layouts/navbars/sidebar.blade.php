<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">{{ __('WD') }}</a>
            <a href="#" class="simple-text logo-normal">{{ __('My News') }}</a>
        </div>
        <ul class="nav">
            {{-- Adicione o link para Notícias aqui --}}
            <li @if ($pageSlug=='noticias' ) class="active " @endif>
                <a href="{{ route('noticias.index') }}">
                    <i class="tim-icons icon-paper"></i> {{-- Ícone de papel, pode ser alterado --}}
                    <p>{{ __('My News') }}</p>
                </a>
            </li>
            {{-- Fim do link para Notícias --}}

            <li @if ($pageSlug=='profile' ) class="active " @endif>
                <a href="{{ route('profile.edit') }}">
                    <i class="tim-icons icon-single-02"></i>
                    <p>{{ __('User Profile') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>