<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">

    <div class="container-fluid">

        <!-- Hamburger -->
        <button class="btn btn-danger me-3"
                onclick="toggleSidebar()">
            ☰
        </button>

        <!-- BRAND -->

<div class="
            d-flex
            align-items-center
            me-4
         ">

    <!-- LOGO 1 -->

    <img src="/images/logo1.png"
         style="
            width:60px;
            height:60px;
            object-fit:contain;
            margin-right:8px;
         ">

    <!-- LOGO 2 -->

    <img src="/images/logo2.png"
         style="
            width:150px;
            height:70px;logo
            object-fit:contain;
            margin-right:15px;
         ">

    <!-- SOCIAL -->

    <div class="
          text-white
          small
          lh-sm
    ">

        <!-- INSTAGRAM -->

        <a href="https://instagram.com/divisipokemon.sby"
        target="_blank"
        class="
                social-link
                instagram-link
            ">

            Instagram : 
            @divisipokemon.sby

        </a>

        <!-- TIKTOK -->

        <a href="https://www.tiktok.com/@divisipokemoncadangan"
        target="_blank"
        class="
                social-link
                tiktok-link
            ">

            TikTok : 
            @DIVISIPOKEMONSBY

        </a>

    </div>

</div>

        <!-- Menu Mesin -->
        <div class="d-flex gap-2">

            <div class="d-flex gap-2">

                <!-- 50K -->

                <button class="btn btn-warning"
                        onclick="changeMachine(50)">

                    Normal Machine

                </button>

                <!-- 150K -->

                <button class="btn btn-primary"
                        onclick="changeMachine(150)">

                    Elite Machine

                </button>

                <!-- 300K -->

                <button class="btn btn-danger"
                        onclick="changeMachine(300)">

                    Premium Machine

                </button>

            </div>

            



            <a href="/marketplace"
            class="
                    btn
                    btn-outline-light
            ">

                🛒 Marketplace

            </a>

        </div>
        <!-- Wallet -->
        <div class="d-flex align-items-center me-4">

            <a href="/wallet"
                class="
                        wallet-box
                        d-flex
                        align-items-center
                        px-3
                        py-2
                        text-decoration-none
                ">

                <!-- ICON -->

                <img src="/images/coin.png"
                    style="
                        width:40px;
                        height:40px;
                        object-fit:contain;
                        margin-right:10px;
                    ">

                <!-- AMOUNT -->

                <span id="walletAmount"
                    class="fw-bold">

                    @if(session()->has('user_id'))

                        {{ number_format(
                            \App\Models\User::find(
                                session('user_id')
                            )->wallet
                        ) }}

                    @else

                        0

                    @endif

                </span>

            </a>

        </div>


        <!-- CART -->

        <a href="/cart"
        class="
                btn
                btn-outline-warning
                me-3
        ">

            🛒 Cart

        </a>

        <!-- Profile -->
        

        @if(session('user_id'))

            @php

                $navbarUser =
                \App\Models\User::find(
                    session('user_id')
                );

            @endphp

            <div class="dropdown">

                <!-- BUTTON -->

                <button class="
                            btn
                            btn-dark
                            dropdown-toggle
                            d-flex
                            align-items-center
                        "
                        data-bs-toggle="dropdown">

                    <!-- PHOTO -->

                    @if($navbarUser->profile_photo)

                        <img src="/profiles/{{ $navbarUser->profile_photo }}"
                            style="
                                width:40px;
                                height:40px;
                                border-radius:50%;
                                object-fit:cover;
                                margin-right:10px;
                                
                            ">

                    @else

                        <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png"
                            style="
                                width:40px;
                                height:40px;
                                border-radius:50%;
                                object-fit:cover;
                                margin-right:10px;
                                border:2px solid gold;
                            ">

                    @endif

                    <!-- USERNAME -->

                    

                </button>

                <!-- DROPDOWN -->

                <ul class="dropdown-menu dropdown-menu-end">

                    <li>

                        <a class="dropdown-item"
                        href="/profile">

                            👤 My Profile

                        </a>

                    </li>

                    <li>

                        <a class="dropdown-item"
                        href="/album">

                            🎴 My Album

                        </a>

                    </li>

                    <li>

                        <a class="dropdown-item"
                        href="/orders">

                            📦 Orders History

                        </a>

                    </li>

                    <li>

                        <a class="dropdown-item"
                        href="/logout">

                            🚪 Logout

                        </a>

                    </li>

                </ul>

            </div>

        @else

            <div class="dropdown">

                <button class="btn btn-dark dropdown-toggle"
                        data-bs-toggle="dropdown">

                    👤 Profile

                </button>

                <ul class="dropdown-menu dropdown-menu-end">

                    <li>

                        <a class="dropdown-item"
                        href="/login">

                            Login

                        </a>

                    </li>

                    <li>

                        <a class="dropdown-item"
                        href="/register">

                            Register

                        </a>

                    </li>

                </ul>

            </div>

        @endif

    </div>

</nav>