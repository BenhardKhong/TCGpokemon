@extends('layouts.app')

@section('content')

<h1 class="mb-5">

    🛒 Pokemon Marketplace

</h1>

@if(session('is_admin'))
    <div class="mb-4">
        <a href="/admin/products/create" class="btn btn-primary">Add Product</a>
        <a href="/admin/settings" class="btn btn-secondary">Admin Settings</a>
    </div>
@endif

<div class="row">

    @forelse($products as $product)

        <div class="col-lg-3 col-md-4 col-6 mb-4">

            <div class="
                        card
                        bg-dark
                        text-white
                        border-secondary
                        h-100
                    ">

                <!-- IMAGE -->

                <img src="/products/{{ $product->image }}"
                     class="card-img-top"
                     style="
                        height:300px;
                        object-fit:contain;
                        background:#111827;
                        padding:10px;
                     ">

                <!-- BODY -->

                <div class="card-body text-center">

                    <h5>

                        {{ $product->name }}

                    </h5>

                    <p class="text-secondary">

                        {{ $product->description }}

                    </p>

                    <!-- PRICE -->

                    <p class="
                                d-flex
                                justify-content-center
                                align-items-center
                            ">

                        <img src="/images/coin.png"
                             style="
                                width:25px;
                                height:25px;
                                margin-right:8px;
                             ">

                        {{ number_format(
                            $product->price
                        ) }}

                    </p>

                    <!-- STOCK -->

                    <p class="text-warning">

                        Stock:
                        {{ $product->stock }}

                    </p>

                    <!-- BUTTON -->

                    <div class="
                                d-flex
                                gap-2
                            ">

                        <!-- CART -->

                        <form action="
                                /cart/add/{{ $product->id }}
                            "
                            method="POST"
                            class="w-50">

                            @csrf

                            <button class="
                                        btn
                                        btn-outline-light
                                        w-100
                                    ">

                                🛒 Cart

                            </button>

                        </form>

                        <!-- BUY -->

                        <a href="/buy-now/{{ $product->id }}"
                        class="
                                btn
                                btn-warning
                                w-50
                        ">

                            Buy Now

                        </a>

                    </div>

                    @if(session('is_admin'))
                        <div class="mt-2">
                            <a href="/admin/products/{{ $product->id }}/edit" class="btn btn-sm btn-outline-light">Edit</a>
                        </div>
                    @endif

                </div>

            </div>

        </div>

    @empty

        <h3>

            Belum ada produk

        </h3>

    @endforelse

</div>

@endsection