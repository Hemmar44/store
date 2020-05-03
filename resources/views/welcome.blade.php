@extends ('layouts.app')

@section ('content')
    <div class="content">
        <div class="title m-b-md">
            @auth
                Hi, {{auth()->user()->name}}
            @else
                Hi, guest
            @endauth
        </div>

        <div class="links">
            <a href="https://laravel.com/docs">Docs</a>
            <a href="https://laracasts.com">Laracasts</a>
            <a href="https://laravel-news.com">News</a>
        </div>
    </div>
@endsection
