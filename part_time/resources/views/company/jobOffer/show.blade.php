@include('company.component.header')

<style>
    .job-details-card {
        border: none;
        border-radius: 20px;
        background: #fff;
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
        padding: 2.5rem;
    }

    .job-details-card .card-title {
        font-size: 1.8rem;
        font-weight: 700;
        
        border-bottom: 2px solid #6ec0c7;
        padding-bottom: 1rem;
        margin-bottom: 2rem;
    }

    .job-details-card p {
        font-size: 1rem;
        margin-bottom: 1rem;
        color: #444;
    }

    .job-details-card p strong {
        color: #333;
        min-width: 140px;
        display: inline-block;
    }

    .job-details-card .badge {
        font-size: 0.85rem;
        padding: 0.4rem 0.8rem;
        border-radius: 10px;
    }

    .job-details-actions {
        margin-top: 2rem;
    }

    .job-details-actions .btn {
        padding: 0.6rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
    }

    .alert {
        border-radius: 12px;
        padding: 1rem 1.5rem;
    }
</style>

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

    <div class="job-details-card">
        <h4 class="card-title">Job Offer Details</h4>

        <p><strong>Job Name:</strong> {{ $jobOffer->title }}</p>

        @if($jobOffer->salary)
            <p><strong>Salary:</strong> {{ number_format($jobOffer->salary, 2) }} JD</p>
        @endif

        @if($jobOffer->requirements)
            <p><strong>Requirements:</strong> {{ $jobOffer->requirements }}</p>
        @endif

        @if($jobOffer->description)
            <p><strong>Description:</strong> {{ $jobOffer->description }}</p>
        @endif

        @if($jobOffer->location)
            <p><strong>Location:</strong> {{ $jobOffer->location }}</p>
        @endif

        @if($jobOffer->work_hours)
            <p><strong>Work Hours:</strong> {{ ucfirst($jobOffer->work_hours) }}</p>
        @endif

        @if($jobOffer->category)
            <p><strong>Category:</strong> {{ $jobOffer->category }}</p>
        @endif

        <p><strong>Status:</strong>
            <span class="badge {{ $jobOffer->is_active ? 'bg-success' : 'bg-danger' }}">
                {{ $jobOffer->is_active ? 'Active' : 'Inactive' }}
            </span>
        </p>

        <p><strong>Applicants:</strong> {{ $jobOffer->job_applications_count }}</p>

        @if($jobOffer->deadline)
            <p><strong>Deadline:</strong> {{ \Carbon\Carbon::parse($jobOffer->deadline)->format('F d, Y') }}</p>
        @endif

        <div class="d-flex justify-content-end gap-3 job-details-actions">
            <a href="{{ route('company.job-offers.index') }}" class="btn btn-outline-secondary">Back to List</a>
            <a href="{{ route('company.job-offers.edit', $jobOffer->id) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
</div>

@include('company.component.footer')
