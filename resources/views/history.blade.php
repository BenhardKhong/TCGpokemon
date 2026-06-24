@extends('layouts.app')

@section('content')

<h1 class="mb-5 text-center">

    📜 Gacha History

</h1>

<div class="machine-card p-4">

    @forelse($histories as $history)

        <a href="/history/{{ $history->id }}"
           class="
                text-decoration-none
                text-white
           ">

            <div class="
                        d-flex
                        align-items-center
                        justify-content-between
                        bg-dark
                        p-3
                        rounded
                        mb-3
                    ">

                <!-- LEFT -->

                <div class="
                            d-flex
                            align-items-center
                        ">

                    <img src="
                        {{ $history->pokemonCard->image }}
                    "
                    style="
                        width:80px;
                        height:110px;
                        object-fit:contain;
                        margin-right:20px;
                    ">

                    <div>

                        <h5>

                            {{ $history->pokemonCard->name }}

                        </h5>

                        <p class="m-0 text-secondary">

                            {{ strtoupper(
                                $history
                                ->pokemonCard
                                ->rarity
                            ) }}

                        </p>

                    </div>

                </div>

                <!-- RIGHT -->

                <div class="text-end">

                    <div class="text-warning">

                        Machine:
                        {{ number_format(
                            $history
                            ->machine_price
                        ) }}

                    </div>

                    <small class="text-secondary">

                        {{ $history->created_at
                            ->format(
                                'd M Y H:i'
                            ) }}

                    </small>

                </div>

            </div>

        </a>

    @empty

        <h4 class="text-center">

            Belum ada history

        </h4>

    @endforelse

</div>

@endsection