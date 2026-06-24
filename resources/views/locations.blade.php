@extends('layouts.app')

@section('content')

<div class="row justify-content-center">

    <div class="col-lg-10">

        <!-- TITLE -->

        <div class="
                    d-flex
                    justify-content-between
                    align-items-center
                    mb-4
                ">

            <h1>

                📍 My Locations

            </h1>

            <button class="
                        btn
                        btn-warning
                    "
                    onclick="
                        showAddLocation()
                    ">

                + Add Location

            </button>

        </div>

        <!-- LOCATION LIST -->

        <div class="row">

            @forelse($locations as $location)

                <div class="col-lg-6 mb-4">

                    <div class="
                                machine-card
                                p-4
                                h-100
                            ">

                        <!-- TOP -->

                        <div class="
                                    d-flex
                                    justify-content-between
                                    align-items-center
                                    mb-3
                                ">

                            <h4 class="m-0">

                                {{ $location->location_name }}

                            </h4>

                            @if($location->is_default)

                                <span class="
                                            badge
                                            bg-success
                                        ">

                                    DEFAULT

                                </span>

                            @endif

                        </div>

                        <!-- RECEIVER -->

                        <p class="mb-2">

                            👤
                            {{ $location->receiver_name }}

                        </p>

                        <!-- PHONE -->

                        <p class="mb-2">

                            📞
                            {{ $location->phone }}

                        </p>

                        <!-- ADDRESS -->

                        <p class="mb-2">

                            📍
                            {{ $location->address }}

                        </p>

                        <!-- CITY -->

                        <p class="mb-2">

                            {{ $location->city }},
                            {{ $location->province }}

                        </p>

                        <!-- POSTAL -->

                        <p class="mb-4">

                            {{ $location->postal_code }}

                        </p>

                        <!-- BUTTON -->

                        @if(!$location->is_default)

                            <form action="
                                    /locations/default/{{ $location->id }}
                                  "
                                  method="POST">

                                @csrf

                                <button class="
                                            btn
                                            btn-outline-warning
                                            w-100
                                        ">

                                    Set As Default

                                </button>

                            </form>

                        @endif

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div class="
                                machine-card
                                p-5
                                text-center
                            ">

                        <h3>

                            Belum ada lokasi

                        </h3>

                    </div>

                </div>

            @endforelse

        </div>

    </div>

</div>

<!-- ========================================
     ADD LOCATION MODAL
======================================== -->

<div class="modal fade"
     id="locationModal"
     tabindex="-1">

    <div class="
                modal-dialog
                modal-lg
            ">

        <div class="
                    modal-content
                    bg-dark
                    text-white
                ">

            <div class="modal-header">

                <h3>

                    Add Location

                </h3>

                <button class="
                            btn-close
                            btn-close-white
                        "
                        data-bs-dismiss="modal">

                </button>

            </div>

            <div class="modal-body">

                <form action="/locations/add"
                      method="POST">

                    @csrf

                    <!-- LOCATION NAME -->

                    <div class="mb-3">

                        <label>

                            Location Name

                        </label>

                        <input type="text"
                               name="location_name"
                               class="form-control">

                    </div>

                    <!-- RECEIVER -->

                    <div class="mb-3">

                        <label>

                            Receiver Name

                        </label>

                        <input type="text"
                               name="receiver_name"
                               class="form-control">

                    </div>

                    <!-- PHONE -->

                    <div class="mb-3">

                        <label>

                            Phone

                        </label>

                        <input type="text"
                               name="phone"
                               class="form-control">

                    </div>

                    <!-- ADDRESS -->

                    <div class="mb-3">

                        <label>

                            Address

                        </label>

                        <textarea name="address"
                                  class="form-control"
                                  rows="3"></textarea>

                    </div>

                    <!-- CITY -->

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>

                                City

                            </label>

                            <input type="text"
                                   name="city"
                                   class="form-control">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>

                                Province

                            </label>

                            <input type="text"
                                   name="province"
                                   class="form-control">

                        </div>

                    </div>

                    <!-- POSTAL -->

                    <div class="mb-4">

                        <label>

                            Postal Code

                        </label>

                        <input type="text"
                               name="postal_code"
                               class="form-control">

                    </div>

                    <!-- BUTTON -->

                    <button class="
                                btn
                                btn-warning
                                w-100
                            ">

                        Save Location

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

<!-- SCRIPT -->

<script>

    function showAddLocation()
    {
        const modal =
        new bootstrap.Modal(
            document.getElementById(
                'locationModal'
            )
        );

        modal.show();
    }

</script>

@endsection