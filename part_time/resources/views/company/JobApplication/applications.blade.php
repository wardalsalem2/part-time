@include('company.component.header')

<div class="container my-5">
    <!-- Filter & Search -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('company.applications.index') }}">
                <div class="row g-2 align-items-center">
                    <!-- Search -->
                    <div class="col-md-5">
                        <input type="text" name="search" class="form-control shadow-sm rounded-pill px-4 py-2"
                            placeholder="Search by job title..." value="{{ request('search') }}"
                            style="height: 45px;" />
                    </div>

                    <!-- Status Filter -->
                    <div class="col-md-4">
                        <select name="status" class="form-select shadow-sm rounded-pill px-4 py-2"
                            style="height: 45px;">
                            <option value="">Filter by Status</option>
                            <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Accepted</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="applied" {{ request('status') == 'applied' ? 'selected' : '' }}>Applied</option>
                        </select>
                    </div>

                    <!-- Search Button -->
                    <div class="col-md-3">
                        <button class="btn btn-primary w-100 shadow-sm rounded-pill px-4 py-2" type="submit"
                            style="height: 45px;">
                            <i class="bi bi-search me-1"></i> Search
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Applications Header -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-0">
            <h5 class="mb-0">
                <i class="bi bi-people-fill me-2 text-primary"></i>
                @if(isset($job))
                    Applicants for: <span class="fw-bold text-dark">{{ $job->title }}</span>
                @else
                    All Job Applications
                @endif
            </h5>
        </div>

        <!-- Session Messages -->
        @if(session('success'))
            <div class="alert alert-success rounded-0 m-0 px-4 py-3">
                {{ session('success') }}
            </div>
        @elseif(session('warning'))
            <div class="alert alert-warning rounded-0 m-0 px-4 py-3">
                {{ session('warning') }}
            </div>
        @endif

        <!-- Applications List -->
        <div class="card shadow-sm rounded-3 mb-4">
            <div class="card-body">
                @if($applications->count())
                    <div class="list-group">
                        @foreach($applications as $app)
                            <div
                                class="list-group-item py-4 border-0 border-bottom d-flex justify-content-between align-items-start flex-wrap">
                                <div class="me-3">
                                    <h6 class="mb-1">{{ $app->profile->user->name }}</h6>
                                    <p class="text-muted mb-1">{{ $app->user->email }}</p>
                                    <div class="text-muted"><i class="bi bi-clock me-1"></i> Applied
                                        {{ $app->created_at->diffForHumans() }}</div>
                                </div>
        
                                <div class="text-end">
                                    <div class="d-flex gap-2 justify-content-end flex-wrap align-items-center mt-5">
                                        @if($app->resume)
                                            <a href="{{ asset('storage/' . $app->profile->cv_path) }}" target="_blank"
                                                class="btn btn-outline-primary btn-sm shadow-sm px-3 rounded-pill"
                                                style="min-width: 110px;">
                                                <i class="bi bi-file-earmark-person me-1"></i> View CV
                                            </a>
                                        @endif
                                
                                        <a href="{{ route('company.applications.show', $app->id) }}"
                                            class="btn btn-outline-secondary btn-sm shadow-sm rounded-pill px-3"
                                            style="min-width: 110px;">
                                            <i class="bi bi-eye me-1"></i> Details
                                        </a>
                                
                                        <form method="POST" action="{{ route('company.applications.destroy', $app->id) }}"
                                            id="delete-form-{{ $app->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm shadow-sm rounded-pill px-3"
                                                onclick="confirmDelete('{{ $app->id }}')" style="min-width: 110px;">
                                                <i class="bi bi-trash me-1"></i> Remove
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
        
                            <!-- Cover Letter Modal -->
                            @if($app->cover_letter)
                                <div class="modal fade" id="coverLetterModal-{{ $app->id }}" tabindex="-1"
                                    aria-labelledby="coverLetterModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Cover Letter - {{ $app->user->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>{{ $app->cover_letter }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info mb-0">
                        <i class="bi bi-info-circle me-2"></i> No applicants found for this job offer.
                    </div>
                @endif
            </div>
        </div>
        
    </div>
</div>

@include('company.component.footer')

<!-- SweetAlert for Delete -->
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
