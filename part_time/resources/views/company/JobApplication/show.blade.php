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

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-dark">Application Details</h2>
        <a href="{{ route('company.applications.applications',$job) }}" class="btn btn-outline-secondary rounded-pill px-4">
            ← Back
        </a>
    </div>  

    <div class="card shadow-lg border-0 rounded-4 p-4">
        <div class="row">
            <div class="col-md-4 text-center mb-4 mb-md-0">
                @if($application->profile->image_path)
                    <img src="{{ asset('storage/' . $application->profile->image_path) }}" alt="Profile Image"
                        class="img-fluid rounded-circle shadow" style="width: 150px; height: 150px; object-fit: cover;">
                @else
                    <div class="text-muted">No image available</div>
                @endif
            </div>

            <div class="col-md-8">
                <h5 class="text-dark fw-semibold">{{ $application->profile->user->name }}</h5>
                <p><strong>Email:</strong> {{ $application->profile->user->email }}</p>
                <p><strong>Phone:</strong> {{ $application->profile->phone ?? 'N/A' }}</p>
                <p><strong>Job Title:</strong> {{ $application->jobOffer->title }}</p>
                <p><strong>Status:</strong>
                    <span class="badge text-white 
                        {{ $application->status === 'accepted' ? 'bg-success' :
    ($application->status === 'rejected' ? 'bg-danger' :
        ($application->status === 'pending' ? 'bg-warning' : 'bg-info')) }}">
                        {{ ucfirst($application->status) }}
                    </span>
                </p>
                <p><strong>Applied At:</strong> {{ $application->created_at->format('F d, Y h:i A') }}</p>
            </div>
        </div>

        <hr class="my-4">

        <div>
            <h6 class="text-secondary">Cover Letter:</h6>
            <p class="text-dark">{{ $application->cover_letter }}</p>
        </div>

        <div class="mt-4">
            <h6 class="text-secondary">CV:</h6>
            @if($application->resume)
            <a href="{{ asset('storage/' . $application->resume) }}" target="_blank"
                class="btn btn-primary rounded-pill px-4">
                View CV
            </a>
        
            <a href="{{ asset('storage/' . $application->resume) }}" download class="btn btn-success rounded-pill px-4">
                Download CV
            </a>
        @else
            <p class="text-muted">No CV uploaded</p>
        @endif
        
        </div>
        

        {{-- Actions Based on Status --}}
        
        @if($application->status === 'applied')
            <div class="mt-5 d-flex gap-2">
                <form method="POST" action="{{ route('company.applications.setPending', $application->id) }}">
                    @csrf
                    <button class="btn btn-warning px-4 rounded-pill">Move to Interview</button>
                </form>

                <form method="POST" action="{{ route('company.applications.reject', $application->id) }}">
                    @csrf
                    <input type="hidden" name="confirm_reject" value="1">
                    <button class="btn btn-danger px-4 rounded-pill">
                        Reject
                    </button>
                </form>
            </div>
        @elseif($application->status === 'pending')
            <div class="mt-5 d-flex gap-2">
                <form method="POST" action="{{ route('company.applications.accept', $application->id) }}">
                    @csrf
                    <button class="btn btn-success px-4 rounded-pill">Accept</button>
                </form>

                <form method="POST" action="{{ route('company.applications.reject', $application->id) }}">
                    @csrf
                    <input type="hidden" name="confirm_reject" value="1">
                    <button class="btn btn-danger px-4 rounded-pill">
                        Reject
                    </button>
                </form>
            </div>
        @else
            <div class="alert alert-info mt-4">
                <strong>Notice:</strong> This application has already been
                {{ $application->status === 'accepted' ? 'accepted' : 'rejected' }}.
            </div>
        @endif
    </div>
</div>

@include('company.component.footer')