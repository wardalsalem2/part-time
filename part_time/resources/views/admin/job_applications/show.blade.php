@include('admin.componant.header')

<div class="main-panel bg-white">
    <div class="content bg-white py-4">
        <div class="container-fluid bg-white">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-dark fw-bold">Application Details</h2>
                <a href="{{ route('admin.job_applications.index') }}" class="btn btn-dark rounded-pill px-4">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>

            <div class="card shadow-sm rounded-4 border-0">
                <div class="card-header bg-white border-bottom-0">
                    <h5 class="fw-semibold mb-0 text-dark">Application Information</h5>
                </div>
                <div class="card-body">
                    
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label class="fw-semibold text-muted">Applicant Name</label>
                            <div class="fs-6">{{ $application->profile->user->name ?? 'N/A' }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-semibold text-muted">Job Title</label>
                            <div class="fs-6">{{ $application->jobOffer->title ?? 'N/A' }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-semibold text-muted">Company</label>
                            <div class="fs-6">{{ $application->jobOffer->company->name ?? 'N/A' }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-semibold text-muted">Status</label>
                            <div>
                                <span class="badge px-3 py-2 rounded-pill fs-6 
                                    @if($application->status === 'accepted') bg-success 
                                    @elseif($application->status === 'rejected') bg-danger 
                                    @elseif($application->status === 'pending') bg-warning text-dark 
                                    @else bg-info @endif">
                                    {{ ucfirst($application->status) ?: 'Not Set' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="fw-semibold text-muted d-block mb-1">Cover Letter</label>
                        <div class="border rounded-3 bg-light p-3">{{ $application->cover_letter ?? 'Not provided' }}</div>
                    </div>

                    <div class="mb-4">
                        <label class="fw-semibold text-muted d-block mb-1">Resume</label>
                        @if($application->resume)
                            <a href="{{ asset('storage/' . $application->resume) }}" class="btn btn-outline-primary rounded-pill px-4" target="_blank">
                                View Resume
                            </a>
                        @else
                            <span class="text-muted fst-italic">No resume uploaded</span>
                        @endif
                    </div>

                    <div class="mb-4">
                        <label class="fw-semibold text-muted d-block mb-1">Submitted At</label>
                        <span class="fs-6">{{ $application->created_at->format('Y-m-d H:i') }}</span>
                    </div>

                    <!-- Action Buttons -->
                    {{-- <div class="d-flex flex-wrap gap-3 mt-4">
                        @if($application->status === 'applied')
                            <form action="{{ route('admin.job_applications.toggleStatus', ['id' => $application->id, 'newStatus' => 'pending']) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-warning rounded-pill px-4">Move to Pending</button>
                            </form>
                            <form action="{{ route('admin.job_applications.toggleStatus', ['id' => $application->id, 'newStatus' => 'rejected']) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger rounded-pill px-4">Reject</button>
                            </form>
                        @elseif($application->status === 'pending')
                            <form action="{{ route('admin.job_applications.toggleStatus', ['id' => $application->id, 'newStatus' => 'accepted']) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success rounded-pill px-4">Accept</button>
                            </form>
                            <form action="{{ route('admin.job_applications.toggleStatus', ['id' => $application->id, 'newStatus' => 'rejected']) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger rounded-pill px-4">Reject</button>
                            </form>
                        @elseif(in_array($application->status, ['accepted', 'rejected']))
                            <form action="{{ route('admin.job_applications.toggleStatus', ['id' => $application->id, 'newStatus' => 'pending']) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-warning rounded-pill px-4">Set to Pending</button>
                            </form>
                        @endif
                    </div> --}}

                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.componant.footer')
