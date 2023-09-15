@php use Illuminate\Support\Facades\App; @endphp
@extends('layouts.app')

@section('content')

    <div class="row align-items-center">
        <div class="col">
            <h1>Referrals</h1>
        </div>
        <div class="col">
            @can('bulkCreate', 'App\Referral')
                @include('partials.createReferralButton')
            @endcan
        </div>
    </div>

    <div class="row">
        <div class="col">
            @include('partials.filterReferrals')
        </div>
    </div>

    <hr>

    <div class="row gx-5 gy-5">
            @foreach($referrals as $referral)
            <div class="col-md-4">
                <div class="card" >
                    <div class="card-header">
                        {{ $referral->country }} - {{ $referral->organisation }} - {{ $referral->reference_no }}
                    </div>
                    <div class="card-body">
                        <p href="#" class="border-bottom border-2">
                            Women Evaluation <br>
                            <span class="badge pull-right text-bg-success">{{ $referral->womens_evaluation }}</span>
                            <span class="badge pull-right text-bg-danger">{{ $referral->womens_evaluation }}</span>
                            <span class="badge pull-right text-bg-warning">{{ $referral->womens_evaluation }}</span>
                            <br>
                        </p>

                        <h4 class="text-body-tertiary">Facility </h4>
                        <h5 class="">{{ $referral->facility_name }}</h5>
                        <h5 class="">{{ $referral->facility_type }}</h5>

                        <p class="border-top border-2">
                            <h4 class="text-body-tertiary">Location Information</h4>

                            <b><i>Province:</i></b> {{ $referral->province }} </br>
                            <b><i>District:</i></b> {{ $referral->district }} </br>
                            <b><i>City:</i></b> {{ $referral->city }} </br>
                            <b><i>Address:</i></b> {{ $referral->street_address }}</br>
                            <b><i>Gps Location:</i></b> {{ $referral->gps_location }}</br>
                            <b><i>Position:</i></b> {{ $referral->position }}</br>
                        </p>



                        <p class="border-top border-2">
                            <h4 class="text-body-tertiary">Contact Information</h4>

                            <b><i>Phone:</i></b> {{ $referral->phone }} </br>
                            <b><i>Email:</i></b> {{ $referral->email }} </br>
                            <b><i>Website:</i></b> {{ $referral->website }} </br>
                        </p>

                        <p class="border-top border-2">
                            <h4>Pills Available</h4>
                            <span class="badge rounded-pill text-bg-primary">{{$referral->pills_available}}</span>
                            <h4>Code to Use</h4>
                            <span class="badge">{{ $referral->code_to_use }}</span>
                            <h4>Type of Service</h4>
                            <span>{{ $referral->type_of_service }}</span>
                        </p>

                        <p class="border-top border-2">
                            <h4>Note</h4>
                        <p>
                            {{ $referral->note }}
                        </p>



                    </div>
                    <ul class="list-group list-group-flush">

                        <li class="list-group-item">
                            <a href="{{route('referral.show', $referral->id)}}" class="card-link pull-right">View</a>
                        </li>
                    </ul>
                </div>
            </div>
            @endforeach


    </div>

    <div class="row pt-5">
        <div class="col text-center">
            {{ $referrals->links() }}
        </div>

    </div>


@endsection

