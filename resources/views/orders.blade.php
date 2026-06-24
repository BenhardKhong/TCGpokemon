@extends('layouts.app')

@section('content')

<h1 class="mb-5">

    📦 Marketplace History

</h1>

<div class="row">

    @forelse($orders as $order)

        <div class="
                    col-lg-4
                    mb-4
                ">

            <a href="/orders/{{ $order->id }}"
               class="text-decoration-none">

                <div class="
                            machine-card
                            p-4
                            h-100
                        ">

                    <h4 class="mb-3">

                        Order #{{ $order->id }}

                    </h4>

                    <!-- STATUS -->

                    <div class="
                                badge
                                bg-warning
                                mb-3
                            ">

                        {{ strtoupper(
                            $order->status
                        ) }}

                    </div>

                    <!-- TOTAL -->

                    <h5 class="
                                d-flex
                                align-items-center
                            ">

                        <img src="/images/coin.png"
                             style="
                                width:25px;
                                height:25px;
                                margin-right:10px;
                             ">

                        {{ number_format(
                            $order->total_price
                        ) }}

                    </h5>

                    <!-- DATE -->

                    <p class="
                                text-secondary
                                mt-3
                            ">

                        {{ $order->created_at
                            ->format(
                                'd M Y H:i'
                            ) }}

                    </p>

                </div>

            </a>

        </div>

    @empty

        <h4>

            Belum ada order

        </h4>

    @endforelse

</div>

@endsection