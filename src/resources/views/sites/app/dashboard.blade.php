@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mb-2">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif

            <div class="alert alert-info">
                <div class="">
                    {{ __('Welcome back') }} {{ auth()->user()->role->title() }}!
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="p-3 bg-white rounded shadow-sm">
                <h5 class="mb-2">My applications</h5>
                @livewire('applications.my-applications')
            </div>
        </div>
    </div>
</div>
@endsection
