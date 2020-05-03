@extends ('layouts.app')

@section ('content')
@foreach($products as $product)
<div class="list-group">
    <a href="/products/{{$product->id}}" class="list-group-item list-group-item-action flex-column align-items-start active">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">{{$product->name}}</h5>
            <small>{{$product->price_gross}}</small>
        </div>
        <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
    </a>
</div>
@endforeach
<div class="clearfix">
    <div class="float-right">
        {{ $products->links() }}
    </div>
</div>
@endsection


