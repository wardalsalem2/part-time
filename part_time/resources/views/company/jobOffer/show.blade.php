@include('company.component.header')

<div class="container py-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Warning!</strong> {{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <h4 class="card-title mb-4 text-primary">Job Offer Details</h4>

            @if($jobOffer->salary)
                <p><strong>Salary:</strong> {{ number_format($jobOffer->salary, 2) }} JD</p>
            @endif

            @if($jobOffer->requirements)
                <p><strong>Requirements:</strong> {{ $jobOffer->requirements }}</p>
            @endif

            @if($jobOffer->deadline)
                <p><strong>Deadline:</strong> {{ \Carbon\Carbon::parse($jobOffer->deadline)->format('F d, Y') }}</p>
            @endif

            <p><strong>Status:</strong>
                <span class="badge {{ $jobOffer->is_active ? 'bg-success' : 'bg-danger' }}">
                    {{ $jobOffer->is_active ? 'Active' : 'Inactive' }}
                </span>
            </p>

            <p><strong>Applicants:</strong> {{ $jobOffer->job_applications_count }}</p>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('company.job-offers.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Back to List</a>
                <a href="{{ route('company.job-offers.edit', $jobOffer->id) }}" class="btn btn-primary rounded-pill px-4">Edit</a>
            </div>
        </div>
    </div>
</div>

@include('company.component.footer')
