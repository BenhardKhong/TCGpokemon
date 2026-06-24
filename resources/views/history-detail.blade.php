@extends('layouts.app')

@section('content')

<div class="row justify-content-center">

    <div class="col-lg-8">

        <div class="
                    machine-card
                    p-5
                    text-center
                ">

            <h1 class="mb-5">

                🎴 Gacha Detail

            </h1>

            <!-- IMAGE -->

            <img src="{{ $history->pokemonCard->image }}"
                 style="
                    max-height:500px;
                    object-fit:contain;
                 "
                 class="mb-5">

            <!-- INFO -->

            <h2>

                {{ $history->pokemonCard->name }}

            </h2>

            <h4 class="text-warning mt-3">

                {{ strtoupper(
                    $history->pokemonCard->rarity
                ) }}

            </h4>

            <h5 class="mt-4">

                Market Price:
                {{ number_format(
                    $history->pokemonCard->market_price
                ) }}

            </h5>

            <h5 class="mt-3">

                Machine Price:
                {{ number_format(
                    $history->machine_price
                ) }}

            </h5>

            <h5 class="mt-3">

                Date:
                {{ $history->created_at
                    ->format(
                        'd M Y H:i:s'
                    ) }}

            </h5>

            <!-- SELL BUTTON -->
            <!-- STATUS -->

            <div class="mt-4">

                @if($userCard)

                    <div class="
                                alert
                                alert-success
                                fw-bold
                            ">

                        ✅ Status:
                        Kartu masih ada di Album

                    </div>

                @else

                    <div class="
                                alert
                                alert-danger
                                fw-bold
                            ">

                        ❌ Status:
                        Kartu sudah terjual

                    </div>

                @endif

            </div>

            <!-- SELL BUTTON -->

            <div class="mt-4">

                @if($userCard)

                    <form action="/sell/{{ $userCard->id }}"
                        method="POST"
                        onsubmit="
                            return sellFromHistory(
                                event,
                                {{ $userCard->id }}
                            )
                        ">

                        @csrf

                        <button class="
                                    btn
                                    btn-danger
                                    btn-lg
                                    px-5
                                ">

                            🔥 Turbo Sell

                        </button>

                    </form>

                @else

                    <button class="
                                btn
                                btn-secondary
                                btn-lg
                                px-5
                            "
                            onclick="
                                showPushNotification('❌ Kartu sudah terjual')
                            ">

                        ❌ Sudah Terjual

                    </button>

                @endif

            </div>

            

        </div>

    </div>

</div>

<!-- SCRIPT -->

<script>

    async function sellFromHistory(event, id)
    {
        event.preventDefault();

        // =========================
        // FETCH
        // =========================

        const response = await fetch(
            '/sell/' + id,
            {

                method: 'POST',

                headers: {

                    'X-CSRF-TOKEN':
                    document.querySelector(
                    'meta[name="csrf-token"]'
                    ).content,

                    'Accept': 'application/json'
                }

            }
        );

        // =========================
        // JSON
        // =========================

        const data =
        await response.json();

        // =========================
        // SUCCESS
        // =========================

        if(data.success){
            // UPDATE WALLET

            document.getElementById(
                'walletAmount'
            ).innerText =
            Number(data.wallet)
            .toLocaleString();

            // PUSH NOTIFICATION

            showPushNotification(
                '✅ Kartu berhasil dijual'
            );

            // REDIRECT

            setTimeout(() => {

                window.location.href =
                '/history';

            }, 1200);
        }
    }

</script>

@endsection