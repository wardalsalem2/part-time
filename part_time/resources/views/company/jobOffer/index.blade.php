@include('company.component.header')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container py-0">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="display-6 fw-bold text-dark mb-1">My Job Offers</h1>
            <p class="text-muted">Manage your career opportunities</p>
        </div>
        <a href="{{ route('company.job-offers.create') }}" class="btn btn-primary px-4 py-2 rounded-3">
            <i class="bi bi-plus-lg me-2"></i>New Offer
        </a>
    </div>

    <!-- Search Form -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white border-0">
            <h5 class="mb-0 d-flex align-items-center">
                <i class="bi bi-funnel me-2 text-primary"></i>
                Filter Job Offers
            </h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('company.job-offers.index') }}">
                <div class="row g-3 align-items-center">
                    <!-- Job Title -->
                    <div class="col-auto">
                        <input type="text" name="title" id="title"
                            class="form-control rounded-pill border shadow-sm ps-3" placeholder="Job Title"
                            value="{{ request('title') }}" aria-label="Job Title">
                    </div>

                    <!-- Location -->
                    <div class="col-auto">
                        <input type="text" name="location" id="location"
                            class="form-control rounded-pill border shadow-sm ps-3" placeholder="Location"
                            value="{{ request('location') }}" aria-label="Location">
                    </div>

                    <!-- Category -->
                    <div class="col-auto">
                        <div class="input-group shadow-sm">
                            <span class="input-group-text bg-white border-end-0 rounded-start-pill">
                                <i class="bi bi-tags text-primary"></i>
                            </span>
                            <select name="category" id="category" class="form-select border-start-0 rounded-end-pill">
                                <option value="">All Categories</option>
                                <option value="IT" {{ request('category') == 'IT' ? 'selected' : '' }}>IT</option>
                                <option value="Marketing" {{ request('category') == 'Marketing' ? 'selected' : '' }}>
                                    Marketing
                                </option>
                                <option value="Design" {{ request('category') == 'Design' ? 'selected' : '' }}>Design
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Reset Button -->
                    <div class="col-auto">
                        <a href="{{ route('company.job-offers.index') }}"
                            class="btn btn-outline-secondary rounded-pill px-4 py-2 d-flex align-items-center">
                            <i class="bi bi-x-circle me-1"></i> Reset
                        </a>
                    </div>

                    <!-- Search Button -->
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 d-flex align-items-center">
                            <i class="bi bi-search me-1"></i> Search
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Cards Grid -->
    <div class="row g-4">
        @foreach($jobOffers as $job)
            <div class="col-12 col-md-6 col-xl-4 pt-4">
                <div class="card border-0 shadow-lg h-100">
                    <!-- Card Header -->
                    <div class="card-header bg-white border-0 pb-0 d-flex justify-content-between align-items-center">
                        <span
                            class="badge rounded-pill bg-{{ $job->is_active ? 'success' : 'secondary' }} py-2 px-3 text-white">
                            <i class="bi bi-circle-fill me-1"></i>{{ $job->is_active ? 'Active' : 'Inactive' }}
                        </span>
                        <div class="dropdown">
                            {{-- <button class="btn btn-link text-muted" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button> --}}
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('company.job-offers.edit', $job->id) }}">
                                        <i class="bi bi-pencil-square me-2"></i>Edit
                                    </a></li>
                                <li><a class="dropdown-item" href="{{ route('company.job-offers.show', $job->id) }}">
                                        <i class="bi bi-eye me-2"></i>Preview
                                    </a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('company.job-offers.destroy', $job->id) }}">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-trash me-2"></i>Delete
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body pt-0">
                        <h3 class="h5 fw-bold mt-3 mb-2">{{ $job->title }}</h3>

                        <div class="text-muted mb-3">
                            <div>
                                <i class="bi bi-geo-alt me-1"></i>
                                <span>{{ $job->location ?? 'Remote' }}</span>
                            </div>

                            <div>
                                <i class="bi bi-tags me-1"></i>
                                <span>{{ $job->category ?? 'Remote' }}</span>
                            </div>

                            <div>
                                <i class="bi bi-cash me-1"></i>
                                <span>{{ number_format($job->salary) }} JD</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between bg-light rounded-pill px-3 py-2 mb-3">
                            <small class="text-muted">
                                <i class="bi bi-clock-history me-1"></i>
                                Posted {{ $job->created_at->diffForHumans() }}
                            </small>
                            <span class="badge bg-info rounded-pill px-3 text-white">
                                <i class="bi bi-people me-1"></i>
                                {{ $job->job_applications_count }} Applicants
                            </span>
                        </div>

                        <div class="d-grid">
                            <form method="POST" action="{{ route('company.job-offers.toggle-status', $job->id) }}">
                                @csrf
                                <button
                                    class="btn btn-{{ $job->is_active ? 'outline-warning' : 'outline-success' }} btn-sm w-100 mb-2">
                                    <i class="bi bi-toggle2-{{ $job->is_active ? 'off' : 'on' }} me-2"></i>
                                    {{ $job->is_active ? 'Deactivate' : 'Activate' }}
                                </button>
                            </form>

                            <div class="d-flex flex-column gap-2">

                                <a href="{{ route('company.job-offers.applications', $job->id) }}"
                                    class="btn btn-outline-info btn-sm w-100">
                                    <i class="bi bi-person-lines-fill me-1"></i> View Applicants
                                </a>


                                <div class="d-flex justify-content-between gap-2">
                                    <a href="{{ route('company.job-offers.show', $job->id) }}"
                                        class="btn btn-outline-primary btn-sm w-100">
                                        <i class="bi bi-eye"></i> Show
                                    </a>


                                    <a href="{{ route('company.job-offers.edit', $job->id) }}"
                                        class="btn btn-outline-secondary btn-sm w-100">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>


                                    <form method="POST" action="{{ route('company.job-offers.destroy', $job->id) }}"
                                        class="w-100" id="delete-form-{{ $job->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete({{ $job->id }})"
                                            class="btn btn-outline-danger btn-sm w-100">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Footer -->
                    <div class="card-footer bg-white border-0 pt-0">
                        <div class="d-flex justify-content-between text-muted small">
                            <span>ID: #{{ $job->id }}</span>
                            <span>Last updated: {{ $job->updated_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-5">
        {{ $jobOffers->links('pagination::bootstrap-5') }}
    </div>
</div>

@include('company.component.footer')

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<script>
    function confirmDelete(jobId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form if the user confirms
                document.getElementById('delete-form-' + jobId).submit();
            }
        });
    }
</script>