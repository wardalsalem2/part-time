@include('company.component.header')

<div class="container py-4">
    @if(session('success'))
        <div class="alert alert-success mt-4">
            <strong>Success!</strong> {{ session('success') }}
        </div>
    @endif

    @if(session('warning'))
        <div class="alert alert-warning mt-4">
            <strong>Warning!</strong> {{ session('warning') }}
        </div>
    @endif

            @if($jobOffer->salary)
                <p><strong>Salary:</strong> {{ number_format($jobOffer->salary, 2) }} JD</p>
            @endif

            @if($jobOffer->requirements)
                <p><strong>Requirements:</strong> {{ $jobOffer->requirements }}</p>
            @endif

            @if($jobOffer->deadline)
                <p><strong>Deadline:</strong> {{ \Carbon\Carbon::parse($jobOffer->deadline)->format('F d, Y') }}</p>
            @endif

            <p><strong>Status:</strong> {{ $jobOffer->is_active ? 'Active' : 'Inactive' }}</p>

            <p><strong>Applicants:</strong> {{ $jobOffer->job_applications_count }}</p>
        </div>

        <a href="{{ route('company.job-offers.index') }}" class="btn btn-secondary mt-3 mb-4">Back to List</a>

        <a href="{{ route('company.job-offers.edit', $jobOffer->id) }}" class="btn btn-primary mt-3 mb-4">Edit</a>

    </div>

    @include('company.component.footer')