@include('company.component.header')

<div class="container my-5">
    <div class="col-md-6">
        <form method="GET" action="{{ route('company.applications.index') }}">
            <div class="input-group shadow-sm rounded-3 overflow-hidden">

                <!-- Search Input -->
                <input type="text" name="search" class="form-control" placeholder="Search by job title..."
                    value="{{ request('search') }}">

                <!-- Divider -->
                <span class="input-group-text">
                    <div style="width: 1px; height: 24px; background-color:rgb(0, 0, 0);"></div>
                </span>

                <!-- Status Filter -->
                <select name="status" class="form-select rounded-end-3">
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

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-0">
            <h5 class="mb-0">
                <i class="bi bi-people-fill me-2 text-primary"></i>
                @if(isset($job))
                    Applicants for: <span class="text-dark">{{ $job->title }}</span>
                @else
                    All Job Applications
                @endif
            </h5>
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

        {{--
        //-----------------------------------------------------------------------------------------------------------
        --}}

        <div class="card-body">
            @if($applications->count())
                <div class="list-group">
                    @foreach($applications as $app)
                        <div
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center flex-wrap py-3">
                            <div>
                                <h6 class="mb-1">{{ $app->profile->user->name }}</h6>
                                <small class="text-muted">{{ $app->user->email }}</small>
                                <div class="text-muted mt-1"><i class="bi bi-clock me-1"></i> Applied
                                    {{ $app->created_at->diffForHumans() }}
                                </div>
                            </div>
                            <div class="mt-2 mt-md-0">

                                @if($app->resume)
                                    <a href="{{ asset('storage/' . $app->profile->cv_path) }}" target="_blank"
                                        class="btn btn-primary rounded-pill px-4">
                                        View CV
                                    </a>
                                @endif
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

                        <!-- Modal for Cover Letter -->
                        @if($app->cover_letter)
                            <div class="modal fade" id="coverLetterModal-{{ $app->id }}" tabindex="-1"
                                aria-labelledby="coverLetterModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="coverLetterModalLabel">Cover Letter - {{ $app->user->name }}
                                            </h5>
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


@include('company.component.footer')

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
