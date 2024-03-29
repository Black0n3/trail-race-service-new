<div>
    <table class="table table-sm table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Race name</th>
            <th>Distance</th>
            <th class="col-sm-2">Options</th>
        </tr>
        </thead>
        <tbody>
        @forelse($my_races as $race)
            <tr>
                <td>1.</td>
                <td>{{ $race->name }}</td>
                <td></td>
                <td><a href="" class="btn btn-sm btn-primary">View</a></td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="p-2 text-center">No races in database!</td>
            </tr>
        @endforelse

        </tbody>
    </table>
</div>
