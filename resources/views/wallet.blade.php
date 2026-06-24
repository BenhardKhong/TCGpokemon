@extends('layouts.app')

@section('content')

<div class="row justify-content-center">

    <div class="col-lg-8">

        <!-- WALLET -->

        <div class="machine-card mb-4 p-5 text-center">

                    <h1 class="mb-4">

                        My Wallet

                    </h1>

                    <div class="
                                d-flex
                                justify-content-center
                                align-items-center
                                mb-5
                            ">

                        <!-- COIN -->

                        <img src="/images/coin.png"
                            style="
                                width:55px;
                                height:55px;
                                object-fit:contain;
                                margin-right:15px;
                            ">

                        <!-- AMOUNT -->

                        <h2 class="text-warning m-0">

                            {{ number_format(
                                $user->wallet
                            ) }}

                        </h2>

                    </div>

                    <!-- TOPUP FORM -->
                    <form action="/wallet/topup"
            method="POST">

            @csrf

            <!-- =========================
                QUICK TOPUP
            ========================== -->

            <h4 class="mb-4">

                Quick Top Up

            </h4>

            <div class="
                        d-flex
                        flex-wrap
                        gap-3
                        justify-content-center
                        mb-5
                    ">

                <button type="button"
                        class="btn btn-outline-warning"
                        onclick="setAmount(50000)">

                    Rp 50.000

                </button>

                <button type="button"
                        class="btn btn-outline-warning"
                        onclick="setAmount(100000)">

                    Rp 100.000

                </button>

                <button type="button"
                        class="btn btn-outline-warning"
                        onclick="setAmount(150000)">

                    Rp 150.000

                </button>

                <button type="button"
                        class="btn btn-outline-warning"
                        onclick="setAmount(300000)">

                    Rp 300.000

                </button>

                <button type="button"
                        class="btn btn-outline-warning"
                        onclick="setAmount(500000)">

                    Rp 500.000

                </button>

            </div>

            <!-- =========================
                INPUT AMOUNT
            ========================== -->

            <div class="mb-4">

                <input type="number"
                    id="topupAmount"
                    name="amount"
                    class="form-control"
                    placeholder="Masukkan nominal">

            </div>

            <!-- =========================
                PAYMENT METHOD
            ========================== -->

            <div class="mb-4 text-start">

                <label class="mb-3">

                    Payment Method

                </label>

                <select class="form-select"
                        name="payment_method">

                    <option value="QRIS">

                        QRIS

                    </option>

                    <option value="DANA">

                        DANA

                    </option>

                    <option value="OVO">

                        OVO

                    </option>

                    <option value="GOPAY">

                        GOPAY

                    </option>

                    <option value="BANK">

                        BANK TRANSFER

                    </option>

                </select>

            </div>

            <!-- =========================
                BUTTON
            ========================== -->

            <button class="btn btn-warning w-100">

                Top Up Now

            </button>

        </form>

            

        </div>

        <!-- HISTORY -->

        <div class="machine-card p-4">

            <h3 class="mb-4">

                Transaction History

            </h3>

            @forelse($transactions as $trx)

                <div class="
                            d-flex
                            justify-content-between
                            mb-3">

                    <div>

                        {{ strtoupper(
                            $trx->type
                           ) }}

                     </div>

                      <div class="
                        text-warning
                        d-flex
                        align-items-center">

                <!-- COIN -->

                <img src="/images/coin.png"
                    style="
                        width:28px;
                        height:28px;
                        object-fit:contain;
                        margin-right:8px;
                    ">

                <!-- AMOUNT -->

                {{ number_format(
                    $trx->amount
                ) }}

            </div>

                </div>

            @empty

                <p>
                    Belum ada transaksi
                </p>

            @endforelse

        </div>

    </div>

</div>
<script>

    function setAmount(amount)
    {
        document.getElementById(
            'topupAmount'
        ).value = amount;
    }

</script>
@endsection