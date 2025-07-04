@include('admin.componant.header')

<div class="main-panel bg-white">
    <div class="content bg-white">
        <div class="container-fluid bg-white">
            <h2>Job Applications Management</h2>

            <!-- Search Form -->
            <form action="{{ route('admin.job_applications.index') }}" method="GET" class="mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">All</option>
                            <option value="applied" {{ request('status') == 'applied' ? 'selected' : '' }}>Applied</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Accepted</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="job_offer_id">Job Offer</label>
                        <select name="job_offer_id" id="job_offer_id" class="form-control">
                            <option value="">All</option>
                            @foreach($jobOffers as $jobOffer)
                                <option value="{{ $jobOffer->id }}" {{ request('job_offer_id') == $jobOffer->id ? 'selected' : '' }}>{{ $jobOffer->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="company_id">Company</label>
                        <select name="company_id" id="company_id" class="form-control">
                            <option value="">All</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}" {{ request('company_id') == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>

            <!-- Applications Table -->
            <div class="table-responsive w-100">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Applicant Name</th>
                            <th>Job Title</th>
                            <th>Company</th>
                            <th>Status</th>
                            <th>Submitted At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($applications as $app)
                            <tr>
                                <td>{{ $app->profile->user->name ?? 'N/A' }}</td>
                                <td>{{ $app->jobOffer->title ?? 'N/A' }}</td>
                                <td>{{ $app->jobOffer->company->name ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge 
                                        @if($app->status == 'applied') bg-info
                                        @elseif($app->status == 'pending') bg-warning
                                        @elseif($app->status == 'accepted') bg-success
                                        @elseif($app->status == 'rejected') bg-danger
                                        @endif">
                                        {{ ucfirst($app->status) }}
                                    </span>
                                </td>
                                <td>{{ $app->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <!-- Status Actions -->
                                    {{-- @if($app->status == 'applied')
                                        <form action="{{ route('admin.job_applications.toggleStatus', ['id' => $app->id, 'newStatus' => 'pending']) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-warning btn-sm">Move to Pending</button>
                                        </form>
                                        <form action="{{ route('admin.job_applications.toggleStatus', ['id' => $app->id, 'newStatus' => 'rejected']) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                        </form>
                                    @elseif($app->status == 'pending')
                                        <form action="{{ route('admin.job_applications.toggleStatus', ['id' => $app->id, 'newStatus' => 'accepted']) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Accept</button>
                                        </form>
                                        <form action="{{ route('admin.job_applications.toggleStatus', ['id' => $app->id, 'newStatus' => 'rejected']) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                        </form>
                                    @elseif($app->status == 'accepted' || $app->status == 'rejected')
                                        <form action="{{ route('admin.job_applications.toggleStatus', ['id' => $app->id, 'newStatus' => 'pending']) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-warning btn-sm">Set to Pending</button>
                                        </form>
                                    @endif --}}

                                    <!-- Delete -->
                                    <form action="{{ route('admin.job_applications.destroy', $app->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete(event, {{ $app->id }})">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>

                                    <!-- Show -->
                                    <a href="{{ route('admin.job_applications.show', $app->id) }}" class="btn btn-info btn-sm">Show</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No job applications found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $applications->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

@include('admin.componant.footer')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(event, applicationId) {
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'This action cannot be undone!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.querySelector(`form[action*="${applicationId}"]`).submit();
            }
        });
    }
</script>
