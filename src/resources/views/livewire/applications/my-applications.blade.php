<div>

    <div class="p-2 mb-3 shadow-sm">
        <div class="row">
            <div class="col-sm-6">
                <label for="">Search by fist name:</label>
                <input name="first_name" wire:model.live="first_name" type="text" class="form-control">

            </div>
            <div class="col-sm-6">
                <label for="">Search by last name:</label>
                <input name="last_name" wire:model.live="last_name" type="text" class="form-control">
            </div>

        </div>


    </div>

    <table class="table table-sm table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Club</th>
            <th>Race</th>
            <th>Distance</th>
            <th class="col-sm-2 text-end">Options</th>
        </tr>
        </thead>
        <tbody>
        @forelse($my_applications as $application)
            <tr>
                <td>1.</td>
                <td>{{ $application->first_name }}</td>
                <td>{{ $application->last_name }}</td>
                <td>{{ $application->club }}</td>
                <td>{{ $application->race->name }}</td>
                <td>{{ $application->race->distance->getTitle() }}</td>
                <td class="text-end">
                    <form action="{{ route('app.applications.delete', $application->id) }}" method="post">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="p-2 text-center">No application in database!</td>
            </tr>
        @endforelse

        </tbody>
    </table>
</div>
