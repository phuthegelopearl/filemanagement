<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>User Type</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->userType }}</td>
            <td>
                <a href="{{ route('user.user-edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                <form action="{{ route('user.user-delete', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>