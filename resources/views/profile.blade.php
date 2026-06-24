@extends('layouts.app')

@section('content')

<div class="row justify-content-center">

    <div class="col-lg-8">

        <div class="machine-card p-5">

            <!-- =========================
                 PROFILE VIEW
            ========================== -->

            <div id="profileView">

                <!-- PHOTO -->

                <div class="text-center mb-5">

                    @if($user->profile_photo)

                        <img src="/profiles/{{ $user->profile_photo }}"
                             style="
                                width:150px;
                                height:150px;
                                border-radius:50%;
                                object-fit:cover;
                                border:5px solid gold;
                             ">

                    @else

                        <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png"
                             style="
                                width:150px;
                                height:150px;
                                border-radius:50%;
                                object-fit:cover;
                                border:5px solid gold;
                             ">

                    @endif

                    <h2 class="mt-4">

                        {{ $user->username }}

                    </h2>

                    <p class="text-secondary">

                        {{ $user->email }}

                    </p>

                </div>

                <!-- STATS -->

                <div class="row text-center">

                    <!-- WALLET -->

                    <div class="col-md-4 mb-4">

                        <div class="bg-dark p-4 rounded">

                            <h5>
                                Wallet
                            </h5>

                            <h3 class="text-warning">

                                🪙
                                {{ number_format(
                                    $user->wallet
                                ) }}

                            </h3>

                        </div>

                    </div>

                    <!-- TOTAL CARD -->

                    <div class="col-md-4 mb-4">

                        <div class="bg-dark p-4 rounded">

                            <h5>
                                Total Card
                            </h5>

                            <h3 class="text-info">

                                {{ $totalCards }}

                            </h3>

                        </div>

                    </div>

                    <!-- TOTAL GACHA -->

                    <div class="col-md-4 mb-4">

                        <div class="bg-dark p-4 rounded">

                            <h5>
                                Total Gacha
                            </h5>

                            <h3 class="text-success">

                                {{ $totalGacha }}

                            </h3>

                        </div>

                    </div>

                </div>

                <!-- BUTTON -->

                <div class="text-center mt-5">

                    <button class="btn btn-warning px-5"
                            onclick="showEditProfile()">

                        Edit Profile

                    </button>

                </div>

            </div>

            <!-- =========================
                 EDIT PROFILE
            ========================== -->

            <div id="editProfile"
                 style="display:none;">

                <form action="/profile/update"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf

                    <!-- PHOTO -->

                    <div class="text-center mb-4">

                        @if($user->profile_photo)

                            <img src="/profiles/{{ $user->profile_photo }}"
                                 style="
                                    width:150px;
                                    height:150px;
                                    border-radius:50%;
                                    object-fit:cover;
                                    border:5px solid gold;
                                 ">

                        @else

                            <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png"
                                 style="
                                    width:150px;
                                    height:150px;
                                    border-radius:50%;
                                    object-fit:cover;
                                    border:5px solid gold;
                                 ">

                        @endif

                    </div>

                    <!-- UPLOAD -->

                    <div class="mb-4">

                        <label>
                            Profile Photo
                        </label>

                        <input type="file"
                               name="profile_photo"
                               class="form-control">

                    </div>

                    <!-- USERNAME -->

                    <div class="mb-4">

                        <label>
                            Username
                        </label>

                        <input type="text"
                               name="username"
                               class="form-control"
                               value="{{ $user->username }}">

                    </div>

                    <!-- EMAIL -->

                    <div class="mb-4">

                        <label>
                            Email
                        </label>

                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{ $user->email }}">

                    </div>

                    <!-- PASSWORD -->

                    <div class="mb-4">

                        <label>
                            Password Baru
                        </label>

                        <input type="password"
                               name="password"
                               class="form-control">

                    </div>

                    <!-- BUTTON -->

                    <div class="d-flex gap-3">

                        <button class="btn btn-success w-100">

                            Save Changes

                        </button>

                        <button type="button"
                                class="btn btn-danger w-100"
                                onclick="hideEditProfile()">

                            Cancel

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<script>

    function showEditProfile()
    {
        document.getElementById(
            'profileView'
        ).style.display = 'none';

        document.getElementById(
            'editProfile'
        ).style.display = 'block';
    }

    function hideEditProfile()
    {
        document.getElementById(
            'profileView'
        ).style.display = 'block';

        document.getElementById(
            'editProfile'
        ).style.display = 'none';
    }

</script>

@endsection