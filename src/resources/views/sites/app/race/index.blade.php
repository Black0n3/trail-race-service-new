@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="p-3 bg-white mb-2 shadow-sm rounded-1">
                    List of races
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Distance</th>
                                <th class="col-sm-2 text-end">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($races as $race)
                            <tr>
                                <td>1.</td>
                                <td>{{ $race->name }}</td>
                                <td>{{ $race->distance->getTitle() }}</td>
                                <td class="text-end">
                                    <a class="btn btn-sm btn-primary" href="{{ route('app.races.new_application', $race->id ) }}">
                                        Sign in
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-2 text-center">
                                    No races in database
                                </td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
