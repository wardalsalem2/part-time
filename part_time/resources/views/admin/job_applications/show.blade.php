@include('admin.componant.header')

<div class="main-panel bg-white">
    <div class="content bg-white">
        <div class="container-fluid bg-white">
            
            <h2>Job Application Details</h2>
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Application Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <strong class="d-block mb-1">Applicant Name:</strong>
                            <span>{{ $application->profile->user->name ?? 'N/A' }}</span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong class="d-block mb-1">Job Title:</strong>
                            <span>{{ $application->jobOffer->title ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <strong class="d-block mb-1">Company:</strong>
                            <span>{{ $application->jobOffer->company->name ?? 'N/A' }}</span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong class="d-block mb-1">Status:</strong>
                            <span class="badge 
                                @if($application->status === 'accepted') bg-success 
                                @elseif($application->status === 'rejected') bg-danger 
                                @elseif($application->status === 'pending') bg-warning text-dark 
                                @else bg-secondary @endif">
                                {{ ucfirst($application->status) ?: 'Not Set' }}
                            </span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <strong class="d-block mb-1">Cover Letter:</strong>
                        <p class="border rounded p-3 bg-light">{{ $application->cover_letter ?? 'Not provided' }}</p>
                    </div>
                    <div class="mb-3">
                        <strong class="d-block mb-1">Resume:</strong>
                        <div>
                            @if($application->resume)
                                <a href="{{ asset('storage/' . $application->resume) }}" class="btn btn-sm btn-primary" target="_blank">View Resume</a>
                            @else
                                <span class="text-muted fst-italic">No resume uploaded</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3">
                        <strong class="d-block mb-1">Submitted At:</strong>
                        <span>{{ $application->created_at->format('Y-m-d H:i') }}</span>
                    </div>

                    @if($application->status === 'pending')
                        <div class="mt-4 d-flex gap-2">
                            <form action="{{ route('admin.job_applications.accept', $application->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success">Accept</button>
                            </form>

                            <form action="{{ route('admin.job_applications.reject', $application->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger">Reject</button>
                            </form>
                        </div>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('admin.job_applications.index') }}" class="btn btn-secondary">Back to Applications</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.componant.footer')
