@extends ('layouts.app')

@section ('content')
    <product-component
        :product="{{json_encode($product)}}"
    >
    </product-component>

    @if(!empty($cart))
        <a href="/cart">
            <button class="btn btn-primary">
                Go to cart
            </button>
        </a>
    @endif

@endsection
