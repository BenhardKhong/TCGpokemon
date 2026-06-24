@extends('layouts.app')

@section('content')

<h1 class="mb-5">

    🛒 My Cart

</h1>

@if(session('success'))

    <div class="alert alert-success">

        {{ session('success') }}

    </div>

@endif

@if(session('error'))

    <div class="alert alert-danger">

        {{ session('error') }}

    </div>

@endif

<form action="/checkout"
      method="POST">

    @csrf

    <div class="row">

        <!-- LEFT -->

        <div class="col-lg-8">

            <!-- CART ITEMS -->

            <div class="
                        machine-card
                        p-4
                        mb-4
                    ">

                <h3 class="mb-4">

                    Cart Products

                </h3>

                @php
                    $total = 0;
                @endphp

                
                <div class="row">

                    @forelse($carts as $cart)

                        @php

                            $subtotal =
                            $cart->product->price
                            * $cart->quantity;

                            $total += $subtotal;

                        @endphp

                        <div class="
                                    col-lg-4
                                    col-md-6
                                    mb-4
                                ">

                            <label class="
                                        w-100
                                        selectable-card
                                    ">

                                <!-- CHECKBOX -->

                                <input type="checkbox"
                                    name="selected_cart[]"
                                    value="{{ $cart->id }}"
                                    data-price="
                                            {{ $subtotal }}
                                    "
                                    class="
                                            d-none
                                            product-checkbox
                                    ">

                                <!-- PRODUCT CARD -->

                                <div class="
                                            card
                                            bg-dark
                                            text-white
                                            border-secondary
                                            selectable-product-ui
                                        ">

                                    <!-- IMAGE -->

                                    <img src="
                                        /products/{{ $cart->product->image }}
                                    "
                                    class="card-img-top"
                                    style="
                                        height:260px;
                                        object-fit:contain;
                                        background:#111827;
                                        padding:10px;
                                    ">

                                    <!-- BODY -->

                                    <div class="
                                                card-body
                                                text-center
                                            ">

                                        <h5>

                                            {{ $cart->product->name }}

                                        </h5>

                                        <div class="
                                            d-flex
                                            align-items-center
                                            justify-content-center
                                            mt-3
                                        ">

                                    <!-- DECREASE -->

                                    <button type="button"
                                            class="btn btn-danger btn-sm cart-decrease"
                                            data-id="{{ $cart->id }}">

                                        -

                                    </button>

                                    <!-- QTY -->

                                    <div class="
                                                px-3
                                                fw-bold
                                            ">

                                        {{ $cart->quantity }}

                                    </div>

                                    <!-- INCREASE -->

                                    <button type="button"
                                            class="btn btn-success btn-sm cart-increase"
                                            data-id="{{ $cart->id }}">

                                        +

                                    </button>

                                </div>

                                        <!-- PRICE -->

                                        <p class="
                                                    d-flex
                                                    justify-content-center
                                                    align-items-center
                                                ">

                                            <img src="/images/coin.png"
                                                style="
                                                    width:22px;
                                                    height:22px;
                                                    margin-right:8px;
                                                ">

                                            {{ number_format(
                                                $cart->product->price
                                            ) }}

                                        </p>

                                        <!-- SUBTOTAL -->

                                        <h5 class="text-warning">

                                            {{ number_format(
                                                $subtotal
                                            ) }}

                                        </h5>

                                        <!-- REMOVE -->

                                        <div class="mt-3">
                                            <button type="button"
                                                    class="btn btn-danger w-100 cart-delete"
                                                    data-id="{{ $cart->id }}">

                                                🗑 Remove

                                            </button>
                                        </div>

                                    </div>

                                </div>

                            </label>

                        </div>

                    @empty

                        <h4>

                            Cart masih kosong

                        </h4>

                    @endforelse

                </div>

            </div>

            <!-- ATTACH CARD -->

            <!-- ATTACH CARD -->

            <div class="
                        machine-card
                        p-4
                    ">

                <h3 class="mb-4">

                    🎴 Attach Album Card

                </h3>

                <p class="text-secondary mb-4">

                    Pilih kartu yang ingin ikut dikirim
                    bersama booster pack.

                </p>

                <div class="row">

                    @forelse($cards as $card)

                        @php

                            $rarity =
                            $card->pokemonCard->rarity;

                            $border =
                            'border-secondary';

                            if($rarity == 'rare')
                            {
                                $border =
                                'border-primary';
                            }

                            if($rarity == 'epic')
                            {
                                $border =
                                'border-warning';
                            }

                        @endphp

                        <div class="
                                    col-lg-3
                                    col-md-4
                                    col-6
                                    mb-4
                                ">

                            <label class="
                                        w-100
                                        selectable-card
                                    ">

                                <!-- CHECKBOX -->

                                <input type="checkbox"
                                    name="cards[]"
                                    value="{{ $card->id }}"
                                    class="
                                            d-none
                                            card-checkbox
                                    ">

                                <!-- CARD -->

                                <div class="
                                            card
                                            bg-dark
                                            text-white
                                            {{ $border }}
                                            selectable-card-ui
                                        ">

                                    <!-- IMAGE -->

                                    <img src="
                                        {{ $card->pokemonCard->image }}
                                    "
                                    class="card-img-top"
                                    style="
                                        height:240px;
                                        object-fit:contain;
                                        background:#111827;
                                        padding:10px;
                                    ">

                                    <!-- BODY -->

                                    <div class="
                                                card-body
                                                text-center
                                            ">

                                        <h6>

                                            {{ $card->pokemonCard->name }}

                                        </h6>

                                        <!-- RARITY -->

                                        <span class="
                                                    badge
                                                    bg-warning
                                                ">

                                            {{ strtoupper(
                                                $card
                                                ->pokemonCard
                                                ->rarity
                                            ) }}

                                        </span>

                                    </div>

                                </div>

                            </label>

                        </div>

                    @empty

                        <h5>

                            Tidak ada kartu di album

                        </h5>

                    @endforelse

                </div>

            </div>

        </div>

        <!-- RIGHT -->

        <div class="col-lg-4">

            <!-- LOCATION -->

            <div class="
                        machine-card
                        p-4
                        mb-4
                    ">

                <h3 class="mb-4">

                    📍 Shipping Location

                </h3>

                <select name="location_id"
                        class="form-select">

                    @foreach($locations as $location)

                        <option value="
                                {{ $location->id }}
                            ">

                            {{ $location->location_name }}
                            -
                            {{ $location->city }}

                        </option>

                    @endforeach

                </select>

            </div>

            <!-- SUMMARY -->

            <div class="
                        machine-card
                        p-4
                    ">

                <h3 class="mb-4">

                    💳 Order Summary

                </h3>

                <!-- TOTAL -->

                <div class="
                            d-flex
                            justify-content-between
                            mb-4
                        ">

                    <h5>

                        Total

                    </h5>

                    <h4 class="
                                text-warning
                                d-flex
                                align-items-center
                            ">

                        <img src="/images/coin.png"
                             style="
                                width:28px;
                                height:28px;
                                margin-right:10px;
                             ">

                        <span id="cartTotal"> 
                            0 
                        </span>

                    </h4>

                </div>

                <!-- BUTTON -->

                <button class="
                            btn
                            btn-warning
                            w-100
                            btn-lg
                        ">

                    Checkout

                </button>

            </div>

        </div>

    </div>

</form>
<script>

    function updateCartTotal()
    {
        let total = 0;

        document.querySelectorAll(
            '.product-checkbox'
        ).forEach((checkbox) => {

            if(checkbox.checked)
            {
                total += Number(
                    checkbox.dataset.price
                );
            }
        });

        document.getElementById(
            'cartTotal'
        ).innerText =
        total.toLocaleString();
    }

    document.querySelectorAll(
        '.product-checkbox'
    ).forEach((checkbox) => {

        checkbox.addEventListener(
            'change',
            updateCartTotal
        );
    });

    // =========================
    // CART ACTIONS (increase/decrease/delete)
    // Use fetch to avoid nested form issues
    // =========================

    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute('content');

    async function postAction(url)
    {
        const res = await fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        if(res.ok){
            window.location.reload();
        } else {
            window.location.reload();
        }
    }

    document.querySelectorAll('.cart-increase')
        .forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.dataset.id;
                postAction('/cart/increase/' + id);
            });
        });

    document.querySelectorAll('.cart-decrease')
        .forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.dataset.id;
                postAction('/cart/decrease/' + id);
            });
        });

    document.querySelectorAll('.cart-delete')
        .forEach(btn => {
            btn.addEventListener('click', () => {
                if(!confirm('Hapus product dari cart?')) return;
                const id = btn.dataset.id;
                postAction('/cart/delete/' + id);
            });
        });

</script>

@endsection