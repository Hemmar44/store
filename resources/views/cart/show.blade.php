@extends ('layouts.app')

@section ('content')
    <cart-component
            :products="{{json_encode($products)}}"
    >
    </cart-component>

@endsection
