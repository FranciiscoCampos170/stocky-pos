<table>
    <thead>
    <tr>

        <th>Name</th>
        <th>Active</th>
        <th>Email</th>
        <th>Role</th>
        <th>Created At</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{$user->active === 1 ? "Yes" : "No"}}</td>
            <td>{{$user->email}}</td>
            <td>{{ $user->roles->pluck('name')->first() }}</td>
            <td>{{ $user->created_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
