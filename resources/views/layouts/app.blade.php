<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    
    <meta name="csrf-token"
      content="{{ csrf_token() }}">

    <title>TCG Pokemon</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>

        body{
            background-color:#0f172a;
            color:white;
            overflow-x:hidden;
        }

        /* =========================
           NAVBAR
        ========================== */

        .navbar-custom{
            background-color:#111827;
            border-bottom:2px solid #ef4444;
        }
        /* =========================
   MACHINE DROPDOWN
========================= */

.machine-dropdown{

    position:relative;
}

.machine-btn{

    min-width:170px;

    font-weight:bold;
}

.machine-menu{

    position:absolute;

    top:100%;
    left:0;

    min-width:240px;

    background:#111827;

    border-radius:12px;

    overflow:hidden;

    display:none;

    box-shadow:
    0 10px 25px rgba(
        0,
        0,
        0,
        .5
    );

    z-index:99999;
}

.machine-menu a{

    display:block;

    color:white;

    text-decoration:none;

    padding:14px 18px;

    transition:.3s;
}

.machine-menu a:hover{

    background:#1f2937;

    color:#facc15;

    padding-left:25px;
}

.machine-dropdown:hover .machine-menu{

    display:block;
}

        /* =========================
           SIDEBAR
        ========================== */

        .sidebar{
            width:250px;
            height:100vh;
            background-color:#111827;

            position:fixed;

            top:0;
            left:-250px;

            transition:0.3s;

            z-index:999;

            padding-top:70px;
        }

        .sidebar.active{
            left:0;
        }

        .sidebar a{
            display:block;

            color:white;

            text-decoration:none;

            padding:15px 20px;
        }

        .main-content{

            transition:0.3s;

            margin-left:0;
        }

        .main-content.shift{

            margin-left:250px;
        }

        /* =========================
           MACHINE CARD
        ========================== */

        .machine-card{
            background-color:#1e293b;

            border-radius:15px;

            padding:20px;

            transition:0.3s;

            border:2px solid transparent;
        }

        .machine-card:hover{
            border:2px solid #ef4444;

            transform:translateY(-5px);
        }

        /* =========================
           BIG WIN
        ========================== */

        .big-win{
            color:gold;

            font-size:28px;

            font-weight:bold;
        }

        /* =========================
           HISTORY
        ========================== */

        .history-box{
            background-color:#1e293b;

            border-radius:10px;

            padding:15px;

            height:300px;

            overflow-y:auto;
        }

        /* =========================
           CARD
        ========================== */

        .pokemon-card{
            transition:0.3s;
        }

        .pokemon-card:hover{
            transform:scale(1.05);
        }

        .card{
            border-radius:15px;
            overflow:hidden;
        }

        .card img{
            height:300px;
            object-fit:cover;
        }

        .wallet-box{

            background:linear-gradient(
                135deg,
                #facc15,
                #f59e0b
            );

            color:#111827;

            border-radius:50px;

            box-shadow:
            0 0 15px rgba(250,204,21,0.7);

            transition:0.3s;
        }

        .wallet-box:hover{

            transform:scale(1.05);

            box-shadow:
            0 0 25px rgba(250,204,21,1);
        }

        .reveal-card{

            animation:
            revealAnimation 0.8s ease;

            max-height:500px;

            filter:
            drop-shadow(
                0 0 20px gold
            );
        }
        .push-notification{

            position:fixed;

            top:30px;

            right:-400px;

            background:#22c55e;

            color:white;

            padding:15px 30px;

            border-radius:15px;

            z-index:99999;

            font-weight:bold;

            transition:0.5s;

            box-shadow:
            0 0 20px rgba(
                34,
                197,
                94,
                0.5
            );
        }
        .selectable-card-ui{

            transition:0.3s;

            cursor:pointer;
        }

        .selectable-card-ui:hover{

            transform:
            translateY(-8px);

            box-shadow:
            0 0 20px rgba(
                255,
                255,
                255,
                0.2
            );
        }

        .card-checkbox:checked
        + .selectable-card-ui{

            border:3px solid gold !important;

            transform:scale(1.05);

            box-shadow:
            0 0 30px gold;
        }

        .push-notification.show{

            right:30px;
        }

        @keyframes revealAnimation{

            0%{

                transform:
                scale(0)
                rotate(-20deg);

                opacity:0;
            }

            50%{

                transform:
                scale(1.15)
                rotate(5deg);
            }

            100%{

                transform:
                scale(1)
                rotate(0deg);

                opacity:1;
            }
        }
        .selectable-product-ui{

            transition:0.3s;

            cursor:pointer;
        }

        .selectable-product-ui:hover{

            transform:
            translateY(-8px);

            box-shadow:
            0 0 20px rgba(
                255,
                255,
                255,
                0.2
            );
        }

        .product-checkbox:checked
        + .selectable-product-ui{

            border:3px solid gold !important;

            transform:scale(1.05);

            box-shadow:
            0 0 30px gold;
        }
        /* =========================
        SOCIAL BUTTON
        ========================= */

        .social-link{

            display:block;

            text-decoration:none;

            transition:0.3s;

            font-weight:bold;
        }

        /* INSTAGRAM */

        .instagram-link{

            color:white;
        }

        .instagram-link:hover{

            color:#ff4fd8;

            text-shadow:
            0 0 10px #ff4fd8,
            0 0 20px #ff4fd8;

            transform:translateX(5px)
                    scale(1.05);
        }

        /* TIKTOK */

        .tiktok-link{

            color:white;
        }

        .tiktok-link:hover{

            color:#00f7ff;

            text-shadow:
            0 0 10px #00f7ff,
            0 0 20px #00f7ff;

            transform:translateX(5px)
                    scale(1.05);
        }




    </style>

</head>

<body>

    <!-- NAVBAR -->
    @include('components.navbar')

    <!-- SIDEBAR -->
    @include('components.sidebar')

    <!-- MAIN CONTENT -->
    <div class="container mt-5 pt-5">

        @yield('content')

    </div>

<script>

    // =========================
    // TOGGLE SIDEBAR
    // =========================

    function toggleSidebar()
    {
        document.getElementById('sidebar')
        .classList.toggle('active');
    }

    // =========================
    // CHANGE MACHINE
    // =========================

   async function changeMachine(machine)
    {
        // =========================
        // JIKA BUKAN DI HOMEPAGE
        // =========================

        const form =
        document.getElementById(
            'gachaForm'
        );

        // REDIRECT KE HOME

        if(!form)
        {
            window.location.href =
            '/?machine=' + machine;

            return;
        }

        // =========================
        // UPDATE FORM
        // =========================

        form.action =
        '/gacha/' + machine;

        // =========================
        // UPDATE BUTTON TEXT + PRICE DISPLAY
        // =========================

        const gachaText = document.getElementById('gachaText');

        if(gachaText)
        {
            let name = 'NORMAL';
            if(machine == 150) name = 'ELITE';
            else if(machine == 300) name = 'PREMIUM';

            gachaText.innerText = 'START ' + name + ' GACHA';
        }

        // Update displayed price (if present)
        const priceBox = document.getElementById('currentPriceDisplay');
        const pricesEl = document.getElementById('machinePrices');

        if(priceBox && pricesEl)
        {
            const p50 = parseInt(pricesEl.dataset.price50 || '50000', 10);
            const p150 = parseInt(pricesEl.dataset.price150 || '150000', 10);
            const p300 = parseInt(pricesEl.dataset.price300 || '300000', 10);

            let price = p50;
            if(machine == 150) price = p150;
            else if(machine == 300) price = p300;

            priceBox.innerText = 'Rp ' + Number(price).toLocaleString();
        }

        // =========================
        // FETCH MACHINE CARD
        // =========================

        const response = await fetch('/api/machine/' + machine);

        const cards = await response.json();

        // =========================
        // CARD LIST
        // =========================

        const cardList = document.getElementById('cardList');

        if(cardList)
        {
            let html = '';

            cards.forEach(card => {

                let rarityColor = 'text-success';

                if(card.rarity == 'rare')
                {
                    rarityColor = 'text-primary';
                }

                if(card.rarity == 'epic')
                {
                    rarityColor = 'text-warning';
                }

                html += `

                <div class="col-md-4 mb-4">

                    <div class="
                                card
                                bg-dark
                                text-white
                                border-secondary
                            ">

                        <img src="${card.image}"
                            class="card-img-top"
                            style="
                                height:350px;
                                object-fit:contain;
                                background:#111827;
                            ">

                        <div class="
                                    card-body
                                    text-center
                                ">

                            <h5>
                                ${card.name}
                            </h5>

                            <p class="${rarityColor}">
                                ${card.rarity.toUpperCase()}
                            </p>

                            <p>
                                Rp ${Number(
                                    card.market_price
                                ).toLocaleString()}
                            </p>

                        </div>

                    </div>

                </div>

                `;
            });

            cardList.innerHTML = html;
        }
    }

   async function startGacha(event)
{
    event.preventDefault();

    // =========================
    // FORM
    // =========================

    const form =
    document.getElementById('gachaForm');

    // =========================
    // FETCH API
    // =========================

    const response = await fetch(form.action, {

        method: 'POST',

        headers: {

            'X-CSRF-TOKEN':
            document.querySelector(
            'meta[name="csrf-token"]'
            ).content,

            'Accept': 'application/json'
        }

    });

    // =========================
    // JSON
    // =========================

    const data = await response.json();

    // =========================
    // UPDATE WALLET
    // =========================

    document.getElementById('walletAmount')
    .innerText =
    Number(data.wallet)
    .toLocaleString();

    // =========================
    // UPDATE BIG WIN
    // =========================

    document.getElementById('bigWinChance')
    .innerText =
    Number(data.epic_chance)
    .toFixed(1) + '%';

    // =========================
    // UPDATE MODAL
    // =========================

    document.getElementById('resultImage')
    .src = data.card_image;

    document.getElementById('resultName')
    .innerText = data.card_name;

    document.getElementById('resultRarity')
    .innerText =
    data.card_rarity.toUpperCase();

    const cardImage =
    document.getElementById(
        'resultImage'
    );

    // RESET

    cardImage.style.filter = '';

    // EPIC

    if(data.card_rarity == 'epic')
    {
        cardImage.style.filter =
        'drop-shadow(0 0 30px gold)';
    }

    // RARE

    else if(data.card_rarity == 'rare')
    {
        cardImage.style.filter =
        'drop-shadow(0 0 25px #3b82f6)';
    }

    // UNCOMMON

    else if(data.card_rarity == 'uncommon')
    {
        cardImage.style.filter =
        'drop-shadow(0 0 20px #22c55e)';
    }

    document.getElementById('resultPrice')
    .innerText =
    'Rp ' +
    Number(data.card_price)
    .toLocaleString();

    // =========================
    // SHOW MODAL
    // =========================

    const modal =
    new bootstrap.Modal(
        document.getElementById('gachaModal')
    );

    modal.show();
}


    async function sellCard(id, button)
    {
        // =========================
        // FETCH SELL
        // =========================

        const response = await fetch('/sell/' + id, {

            method: 'POST',

            headers: {

                'X-CSRF-TOKEN':
                document.querySelector(
                'meta[name="csrf-token"]'
                ).content,

                'Accept': 'application/json'
            }

        });

        // =========================
        // JSON
        // =========================

        const data = await response.json();

        console.log(data);

        // =========================
        // SUCCESS
        // =========================

        if(data.success)
        {
            // =========================
            // UPDATE WALLET
            // =========================

            document.getElementById('walletAmount')
            .innerText =
            Number(data.wallet)
            .toLocaleString();

            // =========================
            // REMOVE CARD
            // =========================

            document.getElementById(
                'card-' + id
            ).remove();

            // =========================
            // ALERT
            // =========================

            showPushNotification('✅ Kartu berhasil dijual');
        }
    }

</script>
<script>
    function showPushNotification(message)
    {
        const notif =
        document.getElementById(
            'pushNotification'
        );

        // MESSAGE

        notif.innerText = message;

        // SHOW

        notif.classList.add('show');

        // HIDE

        setTimeout(() => {

            notif.classList.remove(
                'show'
            );

        }, 3000);
    }

    async function loadGlobalHistory()
    {
        // =========================
        // FETCH API
        // =========================

        const response =
        await fetch('/api/history');

        const data =
        await response.json();

        // =========================
        // CONTAINER
        // =========================

        let html = '';

        // =========================
        // LOOP
        // =========================

        data.forEach(history => {

            let color = 'text-success';

            // RARE

            if(
                history.pokemon_card.rarity
                == 'rare'
            )
            {
                color = 'text-primary';
            }

            // EPIC

            if(
                history.pokemon_card.rarity
                == 'epic'
            )
            {
                color = 'text-warning';
            }

            // HTML

            html += `

                <div class="mb-3">

                    <span class="fw-bold text-info">

                        ${history.user.username}

                    </span>

                    mendapatkan

                    <span class="${color} fw-bold">

                        ${history.pokemon_card.name}

                    </span>

                </div>

            `;
        });

        // =========================
        // RENDER
        // =========================

        document.getElementById(
            'globalHistory'
        ).innerHTML = html;
    }

    // =========================
    // LOAD FIRST
    // =========================

    loadGlobalHistory();

    // =========================
    // AUTO REFRESH
    // =========================

    setInterval(() => {

        loadGlobalHistory();

    }, 3000);

</script>


<!-- PUSH NOTIFICATION -->

<div id="pushNotification"
     class="push-notification">

    ✅ Success

</div>
</body>
</html>