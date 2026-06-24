@extends('layouts.app')

@section('content')

<h1 class="mb-5">

    📦 Order Detail

</h1>

<!-- SUMMARY -->

<div class="
            machine-card
            p-4
            mb-5
        ">

    <h3>

        Order #{{ $order->id }}

    </h3>

    <div class="
                badge
                bg-warning
                mt-3
            ">

        {{ strtoupper(
            $order->status
        ) }}

    </div>

    <h4 class="
                mt-4
                d-flex
                align-items-center
            ">

        <img src="/images/coin.png"
             style="
                width:30px;
                height:30px;
                margin-right:10px;
             ">

        {{ number_format(
            $order->total_price
        ) }}

    </h4>

</div>

<!-- PRODUCTS -->

<div class="
            machine-card
            p-4
            mb-5
        ">

    <h3 class="mb-4">

        🛒 Products

    </h3>

    <div class="row">

        @foreach($order->items as $item)

            <div class="
                        col-lg-4
                        mb-4
                    ">

                <div class="
                            card
                            bg-dark
                            text-white
                            border-secondary
                        ">

                    <img src="
                        /products/{{ $item->product->image }}
                    "
                    class="card-img-top"
                    style="
                        height:260px;
                        object-fit:contain;
                        background:#111827;
                    ">

                    <div class="
                                card-body
                                text-center
                            ">

                        <h5>

                            {{ $item->product->name }}

                        </h5>

                        <p>

                            Qty:
                            {{ $item->quantity }}

                        </p>

                    </div>

                </div>

            </div>

        @endforeach

    </div>

</div>

<!-- ATTACHED CARDS -->

<!-- ATTACHED CARDS -->

<div class="
            machine-card
            p-4
        ">

    <h3 class="mb-4">

        🎴 Attached Cards

    </h3>

    <div class="row">

        @forelse($order->cards as $card)

            <div class="
                        col-lg-3
                        col-md-4
                        col-6
                        mb-4
                    ">

                <div class="
                            card
                            bg-dark
                            text-white
                            border-warning
                        ">

                    <!-- IMAGE -->

                    @if($card->userCard)

                        <img src="
                            {{ $card
                               ->userCard
                               ->pokemonCard
                               ->image }}
                        "
                        class="card-img-top"
                        style="
                            height:240px;
                            object-fit:contain;
                            background:#111827;
                        ">

                    @else

                        <div class="
                                    d-flex
                                    align-items-center
                                    justify-content-center
                                    text-secondary
                                "
                             style="
                                height:240px;
                                background:#111827;
                             ">

                            Card Already Sent

                        </div>

                    @endif

                    <!-- BODY -->

                    <div class="
                                card-body
                                text-center
                            ">

                        <h6>

                            @if($card->userCard)

                                {{ $card
                                   ->userCard
                                   ->pokemonCard
                                   ->name }}

                            @else

                                Kartu sudah tidak tersedia

                            @endif

                        </h6>

                    </div>

                </div>

            </div>

        @empty

            <h5>

                Tidak ada kartu dikirim

            </h5>

        @endforelse

    </div>

</div>

@endsection