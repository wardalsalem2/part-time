@include('company.component.header')

<div class="container py-4">

    @section('content')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                
            </div>
        @endif
        <h2 class="mb-4">{{ $jobOffer->title }}</h2>

        <div class="card p-4">
            <p><strong>Description:</strong> {{ $jobOffer->description }}</p>
            <p><strong>Location:</strong> {{ $jobOffer->location }}</p>

            @if($jobOffer->work_hours)
                <p><strong>Work Hours:</strong> {{ $jobOffer->work_hours }}</p>
            @endif

            @if($jobOffer->salary)
                <p><strong>Salary:</strong> ${{ number_format($jobOffer->salary, 2) }}</p>
            @endif

            @if($jobOffer->requirements)
                <p><strong>Requirements:</strong> {{ $jobOffer->requirements }}</p>
            @endif

            @if($jobOffer->deadline)
                <p><strong>Deadline:</strong> {{ \Carbon\Carbon::parse($jobOffer->deadline)->format('F d, Y') }}</p>
            @endif

            <p><strong>Status:</strong> {{ $jobOffer->is_active ? 'Active' : 'Inactive' }}</p>

            <!-- عرض عدد المتقدمين -->
            <p><strong>Applicants:</strong> {{ $jobOffer->job_applications_count }}</p>
        </div>

        <a href="{{ route('company.job-offers.index') }}" class="btn btn-secondary mt-3 mb-4">Back to List</a>

        <a href="{{ route('company.job-offers.edit', $jobOffer->id) }}" class="btn btn-primary mt-3 mb-4">Edit</a>

    </div>

    @include('company.component.footer')