@include('company.component.header')

<div class="container py-5">
    <div class="card border-0 shadow-sm rounded-4 p-4 mb-5 bg-light">
        <div class="row align-items-center">
            <!-- Title Section -->
            <div class="col-md-6 mb-3 mb-md-0">
                <h3 class="text-dark fw-bold mb-0 d-flex align-items-center">
                    <i class="bi bi-briefcase-fill me-2"></i> Job Applications
                </h3>
            </div>
    
            <!-- Search and Filter Section -->
            <div class="col-md-6">
                <form method="GET" action="{{ route('company.applications.index') }}">
                    <div class="input-group shadow-sm rounded-3 overflow-hidden">
                        
                        <!-- Search Input -->
                        <input type="text" name="search"
                            class="form-control"
                            placeholder="Search by job title..."
                            value="{{ request('search') }}">

                        <!-- Divider -->
                        <span class="input-group-text">
                            <div style="width: 1px; height: 24px; background-color:rgb(0, 0, 0);"></div>
                        </span>
            
                        <!-- Status Filter -->
                        <select name="status"
                            class="form-select rounded-end-3">
                            <option value="">Filter by Status</option>
                            <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Accepted</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="applied" {{ request('status') == 'applied' ? 'selected' : '' }}>Applied</option>
                        </select>
            
                        <!-- Search Button -->
                        <button class="btn btn-primary rounded-end-3" type="submit">
                            <i class="bi bi-search">Search</i>
                        </button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
    

    <!-- Display success or warning messages here -->
    @if(session('success'))
        <div class="alert alert-success rounded-4 mb-4">
            {{ session('success') }}
        </div>
    @elseif(session('warning'))
        <div class="alert alert-warning rounded-4 mb-4">
            {{ session('warning') }}
        </div>
    @endif

    @forelse ($applications as $app)
        <div class="card shadow-sm border-0 rounded-4 mb-4">
            <div
                class="card-body d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center px-4 py-3">
                <div class="mb-3 mb-md-0">
                    <h5 class="fw-bold text-dark mb-1">
                        <i class="bi bi-person-circle me-2 text-primary"></i>
                        {{ $app->profile->user->name }}
                    </h5>
                    <p class="mb-1 text-muted">
                        <i class="bi bi-briefcase-fill me-1 text-secondary"></i>
                        Applied for: <span class="fw-semibold text-dark">{{ $app->jobOffer->title }}</span>
                    </p>
                    <span class="badge px-3 py-1 fs-6 text-white
                            {{ $app->status === 'accepted' ? 'bg-success' :
            ($app->status === 'rejected' ? 'bg-danger' : 
            ($app->status === 'pending' ? 'bg-warning' : 'bg-info')) }}">
                        <i
                            class="bi {{ $app->status === 'accepted' ? 'bi-check-circle' :
        ($app->status === 'rejected' ? 'bi-x-circle' :
        ($app->status === 'pending' ? 'bi-hourglass-split' : 'bi-file-earmark-check')) }} me-1"></i>
                        {{ ucfirst($app->status) }}
                    </span>
                </div>
                <div>
                    <a href="{{ route('company.applications.show', $app->id) }}"
                        class="btn btn-outline-primary btn-sm px-4 rounded-pill d-inline-flex align-items-center shadow-sm">
                        <i class="bi bi-eye me-2"></i> View Details
                    </a>
                    
                    <!-- Delete Button with SweetAlert confirmation -->
                    <form method="POST" action="{{ route('company.applications.destroy', $app->id) }}" style="display:inline;" id="delete-form-{{ $app->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm px-4 rounded-pill shadow-sm"
                                onclick="confirmDelete('{{ $app->id }}')">
                            <i class="bi bi-trash me-2"></i> Remove Employee
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info rounded-4 d-flex align-items-center shadow-sm">
            <i class="bi bi-info-circle-fill fs-4 me-3"></i>
            <div>
                <h5 class="mb-1">No Applications Found</h5>
                <p class="mb-0">Try adjusting your search or check back later.</p>
            </div>
        </div>
    @endforelse

    <div class="mt-4 d-flex justify-content-center">
        {{ $applications->appends(request()->query())->links() }}
    </div>
</div>

@include('company.component.footer')

<!-- SweetAlert2 script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(applicationId) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'This action will remove the employee from the job!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, remove it!',
            cancelButtonText: 'No, keep it'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + applicationId).submit();
            }
        });
    }
</script>
