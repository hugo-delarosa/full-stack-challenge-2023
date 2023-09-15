@php use Illuminate\Support\Facades\App; @endphp
@extends('layouts.app')

@section('content')

    <div class="row mx-3 my-5">
        <h1 class="border-bottom">
            {{$referral->country}} - {{$referral->organisation}} - {{$referral->reference_no}}
        </h1>
    </div>

    <div class="row mx-3 my-5">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    General Information
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
                    <h4>Note</h4>
                    {{ $referral->note }}
                    </p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-header">
                    Location Information
                </div>
                <div class="card-body">
                    <p>
                        <b><i>Province:</i></b> {{ $referral->province }} </br>
                        <b><i>District:</i></b> {{ $referral->district }} </br>
                        <b><i>City:</i></b> {{ $referral->city }} </br>
                        <b><i>Address:</i></b> {{ $referral->street_address }}</br>
                        <b><i>Gps Location:</i></b> {{ $referral->gps_location }}</br>
                        <b><i>Position:</i></b> {{ $referral->position }}</br>
                    </p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-header">
                    Contact Information
                </div>
                <div class="card-body">
                    <p>
                        <b><i>Phone:</i></b> {{ $referral->phone }} </br>
                        <b><i>Email:</i></b> {{ $referral->email }} </br>
                        <b><i>Website:</i></b> {{ $referral->website }} </br>
                    </p>

                </div>
            </div>
        </div>
    </div>

    <div class="row mx-3 my-5">
        <h2 class="border-bottom">Comments</h2>
        @foreach($referral->comments as $comment)
            <div class="row my-2">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">
                            <p>{{$comment->text}}</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-body-secondary pull-right">Created by {{$comment->user->name}} {{\Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</small>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="row mx-2 my-5 px-2 py-4 bg-light">
            @include('errors')
            <form method="post" action="{{route('referral.comment', $referral->id)}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label ">New comment</label>
                    <textarea name="comment" rows="6" class="form-control" id="exampleInputPassword1"></textarea>
                </div>
                <button type="submit" class="btn btn-primary pull-right">Submit</button>
            </form>
        </div>


    </div>
@endsection
