@extends('layouts.app')

@section('content')

<div class="row">

    <!-- LEFT CONTENT -->
    <div class="col-lg-8">

        <!-- MACHINE -->
        <div class="machine-card text-center mb-4">

            <h2 class="mb-4">
                Pokemon Gacha Machine
            </h2>

            <!-- Gambar Mesin -->
            <img src="/images/mesin.png"
                class="img-fluid mb-4"
                style="max-height:350px;">

            <!-- Tombol Mesin -->
            <div class="d-flex justify-content-center gap-3 mb-4">

                <button class="btn btn-warning"
                        onclick="changeMachine(50)">
                    Normal
                </button>

                <button class="btn btn-primary"
                        onclick="changeMachine(150)">
                    Elite
                </button>

                <button class="btn btn-danger"
                        onclick="changeMachine(300)">
                    Premium
                </button>

            </div>

            <!-- Tombol Gacha -->
            <div class="mt-4">

                <div class="d-flex justify-content-center align-items-center gap-3">

                    <div id="currentPriceDisplay" class="h4 text-warning">
                        Rp {{ number_format(
                            (\App\Models\GlobalSetting::first()?->price_50) ?? 50000
                        ) }}
                    </div>

                    <form id="gachaForm"
                    onsubmit="startGacha(event)"
                    action="/gacha/50"
                    method="POST">

                        @csrf

                        <button class="btn btn-success btn-lg px-5">

                            <span id="gachaText">
                                START NORMAL GACHA
                            </span>

                        </button>  

                    </form>

                </div>

                <div id="machinePrices" style="display:none;"
                    data-price-50="{{ (\App\Models\GlobalSetting::first()?->price_50) ?? 50000 }}"
                    data-price-150="{{ (\App\Models\GlobalSetting::first()?->price_150) ?? 150000 }}"
                    data-price-300="{{ (\App\Models\GlobalSetting::first()?->price_300) ?? 300000 }}"
                ></div>

            </div>

        </div>

        <!-- CARD LIST -->
        <div class="machine-card">

            <h3 class="mb-4">
                Daftar Kartu Yang Bisa Didapat
            </h3>

            <!-- CARD LIST -->
            <div class="row" id="cardList">

                <!-- DEFAULT CARD -->

                <div class="col-md-4 mb-4">

                    <div class="card bg-dark text-white border-secondary">

                        <img src="https://images.pokemontcg.io/base1/4_hires.png"
                            class="card-img-top">

                        <div class="card-body text-center">

                            <h5>
                                Charizard
                            </h5>

                            <p class="text-warning">
                                Epic
                            </p>

                            <p>
                                Rp 450.000
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- RIGHT CONTENT -->
    <div class="col-lg-4">

        <!-- BIG WIN -->
        <div class="machine-card mb-4 text-center">

            <h3>
                BIG WIN CHANCE
            </h3>

            <div class="big-win"
                id="bigWinChance">

                {{ number_format(
                    $epicChance,
                    1
                ) }}%

            </div>

        </div>

        <!-- DROP RATE -->
        <div class="machine-card mb-4">

            <h4>
                Drop Rate
            </h4>

            <hr>

            <p>Common : 80%</p>

            <p>Uncommon : 15%</p>

            <p>Rare : 4%</p>

            <p>Epic : 1%</p>

        </div>

        <!-- HISTORY -->
        <div class="machine-card">

            <h4>
                Global History
            </h4>

            <div class="history-box mt-3"
     id="globalHistory">

                <p>Jason mendapatkan Charizard EX</p>

                <p>Michael mendapatkan Pikachu VMAX</p>

                <p>Andi mendapatkan Mewtwo GX</p>

            </div>

        </div>

    </div>

</div>

@endsection

<!-- GACHA RESULT MODAL -->

<div class="modal fade"
     id="gachaModal"
     tabindex="-1">

    <div class="
                modal-dialog
                modal-dialog-centered
            ">

        <div class="
                    modal-content
                    bg-dark
                    text-white
                    border-warning
                ">

            <div class="modal-body text-center p-5">

                <!-- TITLE -->

                <h2 class="mb-4">

                    🎉 YOU GOT!

                </h2>

                <!-- CARD -->

                <div id="cardReveal">

                    <img id="resultImage"
                         src=""
                         class="img-fluid mb-4 reveal-card">

                </div>

                <!-- NAME -->

                <h3 id="resultName"
                    class="fw-bold">

                </h3>

                <!-- RARITY -->

                <h4 id="resultRarity"
                    class="mt-3">

                </h4>

                <!-- PRICE -->

                <h5 id="resultPrice"
                    class="text-warning mt-3">

                </h5>

                <!-- BUTTON -->

                <button class="
                            btn
                            btn-warning
                            mt-4
                            px-5
                        "
                        data-bs-dismiss="modal">

                    AWESOME!

                </button>

            </div>

        </div>

    </div>

</div>
