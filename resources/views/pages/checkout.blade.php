@extends('layouts.checkout')

@section('title', 'Checkout')

@section('content')
<main>
    <section class="section-details-header"></section>
    <section class="section-details-content">
    <div class="container">
        <div class="row">
        <div class="col p-0 pl-3 pl-lg-0">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page">
                Paket Travel
                </li>
                <li class="breadcrumb-item" aria-current="page">
                Details
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                Checkout
                </li>
            </ol>
            </nav>
        </div>
        </div>
        <div class="row">
        <div class="col-lg-8 pl-lg-0">
            <div class="card card-details mb-3">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            <h1>Who is Going?</h1>
            <p>
                Trip to {{  $item->tour_package->title }}, {{ $item->tour_package->location }}
            </p>
            <div class="attendee">
                <table class="table table-responsive-sm text-center">
                    <thead>
                        <tr>
                        <td scope="col">Picture</td>
                        <td scope="col">Name</td>
                        <td scope="col">Region</td>
                        <td scope="col">No.Hp</td>
                        <td scope="col"></td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($item->details as $detail)
                            <tr>
                                <td>
                                    <img
                                    src="https://ui-avatars.com/api/?name={{ $detail->username }}" height="60" class="rounded-circle"
                                    />
                                </td>
                                <td class="align-middle">{{ $detail->username }}</td>
                                <td class="align-middle">{{ $detail->region }}</td>
                                <td class="align-middle">{{ $detail->no_hp }}</td>
                                <td class="align-middle">
                                    <a href="{{ route('checkout_remove', $detail->id) }}">
                                    <img src="{{ url('frontend/images/ic_remove.png') }}" alt="" />
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    No Visitor
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="member mt-3">
                <h2>Add Member</h2>
                <form class="form-inline" method="POST" action="{{ route('checkout_create', $item->id) }}">
                    @csrf
                    <label class="sr-only" for="username">Name</label>
                    <input
                        type="text"
                        name="username"
                        class="form-control mb-2 mr-sm-2"
                        id="username"
                        required
                        placeholder="Username"
                    />

                    <label class="sr-only" for="region">Region</label>
                    <input
                        type="text"
                        class="form-control mb-2 mr-sm-2"
                        name="region"
                        required
                        id="region"
                        placeholder="Region"
                    />

                    <label class="sr-only" for="no_hp">No HP</label>
                    <input
                        type="text"
                        class="form-control mb-2 mr-sm-2"
                        name="no_hp"
                        id="no_hp"
                        required
                        placeholder="No HP"
                    />

                    <button type="submit" class="btn btn-add-now mb-2 px-4">
                        Add Now
                    </button>
                </form>
                <h3 class="mt-2 mb-0">Note</h3>
                <p class="disclaimer mb-0">
                You are only able to invite member that has registered in
                Nomads.
                </p>
            </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-details card-right">
            <h2>Checkout Information</h2>
            <table class="trip-informations">
                <tr>
                <th width="50%">Members</th>
                <td width="50%" class="text-right">{{ $item->details->count() }} person</td>
                </tr>
                <tr>
                <th width="50%">Trip Price</th>
                <td width="50%" class="text-right">$ {{ $item->tour_package->price }},00 / person</td>
                </tr>
                <tr>
                <th width="50%">Sub Total</th>
                <td width="50%" class="text-right">$ {{ $item->transaction_total }},00</td>
                </tr>
                <tr>
                <th width="50%">Total (+Unique)</th>
                <td width="50%" class="text-right text-total">
                    <span class="text-blue">$ {{ $item->transaction_total }},</span
                    ><span class="text-orange">{{ mt_rand(0,99) }}</span>
                </td>
                </tr>
            </table>

            <hr />
            <h2>Payment Instructions</h2>
            <p class="payment-instructions">
                Please complete your payment before to continue the wonderful
                trip
            </p>
            <div class="bank">
                <div class="bank-item pb-3">
                <img
                    src="{{ url('frontend/images/ic_bank.png') }}"
                    alt=""
                    class="bank-image"
                />
                <div class="description">
                    <h3>PT Tour ID</h3>
                    <p>
                    0853 9993 7610
                    <br />
                    Bank Central Asia
                    </p>
                </div>
                <div class="clearfix"></div>
                </div>
                <div class="bank-item">
                <img
                    src="{{ url('frontend/images/ic_bank.png') }}"
                    alt=""
                    class="bank-image"
                />
                <div class="description">
                    <h3>PT Tour ID</h3>
                    <p>
                    0853 9993 7610
                    <br />
                    Bank AMKMJ
                    </p>
                </div>
                <div class="clearfix"></div>
                </div>
            </div>
            </div>
            <div class="join-container">
            <a
                href="{{ route('checkout_success', $item->id) }}"
                class="btn btn-block btn-join-now mt-3 py-2"
                >I Have Made Payment</a
            >
            </div>
            <div class="text-center mt-3">
            <a href="{{ route('detail', $item->tour_package->slug) }}" class="text-muted">Cancel Booking</a>
            </div>
        </div>
        </div>
    </div>
    </section>
</main>
@endsection

@push('prepend-style')
<link rel="stylesheet" href="{{ url('frontend/libraries/gijgo/css/gijgo.min.css') }}" />
@endpush

@push('addon-script')
<script src="{{ url('frontend/libraries/gijgo/js/gijgo.min.js') }}"></script>
<script>
    $(document).ready(function() {
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        uiLibrary: 'bootstrap4',
        icons: {
        rightIcon: '<img src="{{ url('frontend/images/ic_doe.png') }}" alt="" />'
        }
    });
    });
</script>
@endpush
