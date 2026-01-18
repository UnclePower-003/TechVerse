<a href="{{ route('hero-header.create') }}" class="btn btn-primary mb-3">
    Add Hero Header
</a>

<table class="table">
    <thead>
        <tr>
            <th>Badge</th>
            <th>Title</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($headers as $header)
            <tr>
                <td>{{ $header->badge_text }}</td>
                <td>{{ $header->title_main }}</td>
                <td>{{ $header->is_active ? 'Active' : 'Inactive' }}</td>
                <td>
                    <a href="{{ route('hero-header.edit', $header) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('hero-header.destroy', $header) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
