@include('admin.componant.header')

<div class="main-panel bg-white">
    <div class="content bg-white">
        <div class="container-fluid bg-white">
            <h2>Users List</h2>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Search Form -->
            <form action="{{ route('admin.users.index') }}" method="GET" class="mb-4 d-flex justify-content-between">
                <div class="input-group w-25 mr-2">
                    <input type="text" name="name" class="form-control" placeholder="Search by Name"
                        value="{{ request()->get('name') }}">
                </div>

                <div class="input-group w-25 mr-2">
                    <select name="status" class="form-control">
                        <option>Search by Status</option>
                        <option value="1" {{ request()->get('status') === '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ request()->get('status') === '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="input-group w-25 mr-2">
                    <select name="role" class="form-control">
                        <option value="">Search by Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ request()->get('role') == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Search</button>
            </form>

            <!-- Check if there are no results -->
            @if($users->isEmpty())
                <div class="alert alert-warning">No users found with the applied filters.</div>
            @endif

            <!-- Users Table -->
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-hover w-100">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role->name }}</td>
                                <td>
                                    @if($user->profile && $user->profile->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-info">View</a>
                                    {{-- <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">Edit</a> --}}

                                    <!-- Toggle Activation Button -->
                                    <form
                                        action="{{ $user->profile && $user->profile->is_active ? route('admin.users.deactivate', $user->id) : route('admin.users.activate', $user->id) }}"
                                        method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <button
                                            class="btn {{ $user->profile && $user->profile->is_active ? 'btn-dark' : 'btn-success' }}">
                                            {{ $user->profile && $user->profile->is_active ? 'Deactivate' : 'Activate' }}
                                        </button>
                                    </form>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                        style="display:inline;" id="delete-form-{{ $user->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger"
                                            onclick="confirmDelete({{ $user->id }})">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

@include('admin.componant.footer')

<!---------------------------------------- SweetAlert2 JS---------------------- -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.21/dist/sweetalert2.all.min.js"></script>

<script>
    // JavaScript function to confirm deletion with SweetAlert
    function confirmDelete(userId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, submit the deletion form   
                document.getElementById('delete-form-' + userId).submit();
            }
        });
    }
</script>