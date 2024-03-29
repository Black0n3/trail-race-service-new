@extends('layouts.app')

@section('content')
    <div class="container">

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
