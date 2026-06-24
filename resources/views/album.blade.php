@extends('layouts.app')

@section('content')

<h1 class="mb-4">
    My Pokemon Album
</h1>

<div class="row">

    @forelse($cards as $card)

        <div class="col-lg-3 col-md-4 col-6 mb-4"
             id="card-{{ $card->id }}">

            <div class="card bg-dark text-white border-secondary">

                <img src="{{ $card->pokemonCard->image }}"
                     class="card-img-top"
                     style="
                        height:380px;
                        object-fit:contain;
                        background:#111827;
                        padding:10px;
                     ">

                <div class="card-body text-center">

                    <h5>
                        {{ $card->pokemonCard->name }}
                    </h5>

                    <p class="text-warning">

                        {{ strtoupper(
                            $card->pokemonCard->rarity
                        ) }}

                    </p>

                    <p class="
                                d-flex
                                justify-content-center
                                align-items-center
                            ">

                        <img src="/images/coin.png"
                             style="
                                width:25px;
                                height:25px;
                                object-fit:contain;
                                margin-right:8px;
                             ">

                        {{ number_format(
                            $card->pokemonCard->market_price
                        ) }}

                    </p>

                    <button class="btn btn-danger w-100"
                            onclick="
                                sellCard(
                                    {{ $card->id }}
                                )
                            ">

                        🔥 Turbo Sell

                    </button>

                </div>

            </div>

        </div>

    @empty

        <h4>
            Belum memiliki kartu
        </h4>

    @endforelse

</div>

<!-- SCRIPT -->

<script>

    async function sellCard(id)
    {
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

        if(data.success)
        {
            // REMOVE CARD

            document.getElementById(
                'card-' + id
            ).remove();

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
        }
    }

</script>

@endsection