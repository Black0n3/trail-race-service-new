@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="p-3 bg-white mb-2 shadow-sm rounded-1">
                <h5>Sign in form for race: {{ $race->name }}</h5>
                <form action="{{ route('app.races.save_application') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>First name</label>
                            <input type="text" name="first_name" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Last name</label>
                            <input type="text" name="last_name" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label>Club</label>
                            <input type="text" name="club" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </div>
                    <input type="hidden" name="race_id" value="{{ $race->id }}">
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                </form>
            </div>
        </div>
    </div>
@endsection
