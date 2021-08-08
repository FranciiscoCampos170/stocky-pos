<table>
    <thead>
    <tr>

        <th>Name</th>
        <th>Created At</th>
    </tr>
    </thead>
    <tbody>
    @foreach($roles as $role)
        <tr>
            <td>{{ $role->name }}</td>
            <td>{{ $role->created_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
