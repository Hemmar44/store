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
            <a href="/products">Products</a>
        </div>
    </div>
@endsection
