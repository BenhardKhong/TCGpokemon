@extends('layouts.app')

@section('content')

<h1 class="mb-5">

    ⚡ Buy Now

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

<form action="/buy-now/checkout/{{ $product->id }}"
      method="POST">

    @csrf

    <div class="row">

        <!-- LEFT -->

        <div class="col-lg-8">

            <!-- PRODUCT -->

            <div class="
                        machine-card
                        p-4
                        mb-4
                    ">

                <h3 class="mb-4">

                    Product

                </h3>

                <div class="
                            d-flex
                            align-items-center
                            justify-content-between
                            bg-dark
                            rounded
                            p-3
                        ">

                    <!-- LEFT -->

                    <div class="
                                d-flex
                                align-items-center
                            ">

                        <img src="
                            /products/{{ $product->image }}
                        "
                        style="
                            width:120px;
                            height:150px;
                            object-fit:contain;
                            margin-right:20px;
                        ">

                        <div>

                            <h4>

                                {{ $product->name }}

                            </h4>

                            <p class="text-secondary">

                                {{ $product->description }}

                            </p>

                            <p class="
                                        d-flex
                                        align-items-center
                                    ">

                                <img src="/images/coin.png"
                                     style="
                                        width:22px;
                                        height:22px;
                                        margin-right:8px;
                                     ">

                                {{ number_format(
                                    $product->price
                                ) }}

                            </p>

                        </div>

                    </div>

                    <!-- RIGHT -->

                    <div class="text-end">

                        <h5 class="text-warning">

                            x1

                        </h5>

                    </div>

                </div>

            </div>

            <!-- ATTACH CARD -->

            <div class="
                        machine-card
                        p-4
                    ">

                <h3 class="mb-4">

                    🎴 Attach Album Card

                </h3>

                <p class="text-secondary mb-4">

                    Pilih kartu yang ingin ikut dikirim.

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

                                <input type="checkbox"
                                       name="cards[]"
                                       value="{{ $card->id }}"
                                       class="
                                            d-none
                                            card-checkbox
                                       ">

                                <div class="
                                            card
                                            bg-dark
                                            text-white
                                            {{ $border }}
                                            selectable-card-ui
                                        ">

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

                                    <div class="
                                                card-body
                                                text-center
                                            ">

                                        <h6>

                                            {{ $card->pokemonCard->name }}

                                        </h6>

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

                        {{ number_format(
                            $product->price
                        ) }}

                    </h4>

                </div>

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

@endsection