@include('admin.componant.header')

<div class="main-panel bg-white">
    <div class="content bg-white">
        <div class="container-fluid bg-white p-4 rounded shadow-sm">
            <h1 class="mb-4">Company Management</h1>

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Search Form -->
            <form action="{{ route('admin.companies.index') }}" method="GET" class="mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="name" class="form-control" placeholder="Search by company name" value="{{ request('name') }}">
                    </div>
                    <div class="col-md-4">
                        <select name="status" class="form-control">
                            <option>All statuses</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Approved</option>
                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Not Approved</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary w-100">Search</button>
                    </div>
                </div>
            </form>

            <!-- Companies Table -->
            <table class="table table-bordered table-hover mt-3">
                <thead class="thead-light">
                    <tr>
                        <th>Company Name</th>
                        <th>Company Owner</th>
                        <th>Company Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($companies as $company)
                        <tr>
                            <td>{{ $company->name }}</td>
                            <td>{{ $company->user->name }}</td>
                            <td>
                                <span class="badge {{ $company->is_active ? 'badge-success' : 'badge-danger' }}">
                                    {{ $company->is_active ? 'Approved' : 'Not Approved' }}
                                </span>
                            </td>
                            <td>
                                <!-- Show -->
                                <a href="{{ route('admin.companies.show', $company->id) }}" class="btn btn-info btn-sm">Show</a>

                                <!-- Edit -->
                                <a href="{{ route('admin.companies.edit', $company->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                <!-- Approve/Disable -->
                                @if(!$company->is_active)
                                    <form action="{{ route('admin.companies.approve', $company->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.companies.disable', $company->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-dark btn-sm">Disable</button>
                                    </form>
                                @endif

                                <!-- Delete -->
                                <form action="{{ route('admin.companies.destroy', $company->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $company->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $company->id }})">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No companies found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $companies->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

@include('admin.componant.footer')

<!-- SweetAlert Delete Confirmation -->
<script>
    function confirmDelete(companyId) {
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
                document.getElementById('delete-form-' + companyId).submit();
            }
        });
    }
</script>
