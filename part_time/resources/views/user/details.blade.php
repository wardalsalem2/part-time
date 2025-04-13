@include('component.header')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
    body {
        background-color: #ffff;
        padding-top: 80px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .text-primary {
        color: #6ec0c7 !important;
    }

    .card {
        border-radius: 15px;
    }

    .card h4,
    .card h5 {
        color: #6ec0c7;
    }

    .card ul {
        padding-left: 1.2rem;
    }

    .card ul li {
        color: #343a40;
        margin-bottom: 8px;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
        padding: 12px 25px;
        font-size: 1rem;
        border-radius: 25px;
        transition: background-color 0.3s ease;
    }

    .btn-success:hover {
        background-color: #1e7e34;
    }

    .btn-outline-primary {
        border-color: #6ec0c7;
        color: #6ec0c7;
        padding: 12px 25px;
        font-size: 1rem;
        border-radius: 25px;
        transition: background-color 0.3s ease;
    }

    .btn-outline-primary:hover {
        background-color: #6ec0c7;
        color: white;
    }

    @media (max-width: 768px) {
        .display-4 {
            font-size: 2rem;
        }

        .lead {
            font-size: 1rem;
        }
    }
</style>
<div class="container py-5">

    
    <div class="bg-white py-5 text-center rounded mb-4 shadow-sm">
        <h1 class="text-black">{{ $jobOffer->title }}</h1>
    </div>

    <!-- Job + Company Info -->

    <div class="row g-4">
        <!-- Job Details -->
        <div class="col-md-6 d-flex">
            <div class="card border-0 shadow-lg p-4 w-100">
                <h4 class="mb-3">Job Details</h4>
                <p><strong>Location:</strong>{{ $jobOffer->company->name }} - {{ $jobOffer->location }}</p>
                <p><strong>Salary:</strong> ${{ number_format($jobOffer->salary, 2) }}</p>
                <p><strong>Work Hours:</strong> {{ ucfirst($jobOffer->work_hours) }}</p>
                <p><strong>Deadline:</strong> {{ \Carbon\Carbon::parse($jobOffer->deadline)->format('d M, Y') }}</p>
                <hr>
                <h5 class="mt-4">Requirements</h5>
                <ul>
                    @foreach(explode(',', $jobOffer->requirements) as $requirement)
                        <li>{{ trim($requirement) }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Company Info -->
        <div class="col-md-6 d-flex">
            <div class="card border-0 shadow-lg p-4 w-100">
                <h5>🏢 Company Info</h5>
                <p><strong>Name:</strong> {{ $jobOffer->company->name }}</p>
                <p><strong>Email:</strong> {{ $jobOffer->company->email }}</p>
                <p><strong>Description:</strong>
                    {{ $jobOffer->company->description }}</p>
                <p><strong>Address:</strong> {{ $jobOffer->company->address }}
                </p>
                <p><strong>City:</strong> {{ $jobOffer->company->city }}</p>
                <p><strong>Website:</strong>
                    <a href="{{ $jobOffer->company->website }}" target="_blank">{{ $jobOffer->company->website }}</a>
                </p>
            </div>
        </div>
    </div>

    {{-- -------------------------------------------------------------------------------------- --}}

    {{-- Check if the user is authenticated --}}
    @auth
        @php
            // Get the currently authenticated user's profile
            $profile = auth()->user()->profile;

            // -----------------------------------------------------------------------------------------

            // Required fields to consider the profile complete
            $requiredFields = [
                'job_title',
                'hourly_rate',
                'available_hours',
                'skills',
                'experience',
                'city',
                'country',
                'cv_path',
                'image_path',
                'phone'
            ];

            // Flag to determine if the profile is incomplete
            $isProfileIncomplete = false;

            // Check if profile exists
            if ($profile) {
                // Loop through required fields and check if any are empty
                foreach ($requiredFields as $field) {
                    if (empty($profile->$field)) {
                        $isProfileIncomplete = true;
                        break;
                    }
                }
            } else {
                $isProfileIncomplete = true;
            }

        @endphp
    @endauth
    {{-- //-------------------------------------------------------------------------------------- --}}

    <!-- Application Buttons Section -->
    <div class="mt-5 d-flex flex-column align-items-center gap-3">
        @auth
                @php
                    $profile = auth()->user()->profile;

                    // Required fields for a complete profile
                    $requiredFields = [
                        'job_title',
                        'hourly_rate',
                        'available_hours',
                        'skills',
                        'experience',
                        'city',
                        'country',
                        'cv_path',
                        'image_path',
                        'phone'
                    ];

                    // Check if profile is incomplete
                    $isProfileIncomplete = false;

                    if ($profile) {
                        foreach ($requiredFields as $field) {
                            if (empty($profile->$field)) {
                                $isProfileIncomplete = true;
                                break;
                            }
                        }
                    } else {
                        $isProfileIncomplete = true;
                    }

                    // Check if the user has already applied to this job
                    $hasApplied = !$isProfileIncomplete && $profile
                        ? $profile->jobApplications()->where('job_offer_id', $jobOffer->id)->exists()
                        : false;
                @endphp

                {{-- If the profile is incomplete or not active --}}
                @if($isProfileIncomplete || !$profile || !$profile->is_active)
                <div class="mx-auto w-100" style="max-width: 700px;">
                    <div class="alert border-0 shadow-sm p-4 rounded-4 d-flex flex-column align-items-center text-center" style="background-color: #e6f4fa; color: #155b7c;">
                        <h5 class="mb-3"><i class="fas fa-exclamation-circle me-2"></i>Incomplete Profile</h5>
                        <p class="mb-3 fs-5">Please complete your profile before applying for jobs.</p>
                        <a href="{{ route('profile.show') }}" class="btn btn-outline-primary" style="border-radius: 25px;">
                            Complete Profile
                        </a>
                    </div>
                </div>
            @else
            
                    {{-- Show info if already applied --}}
                    @if($hasApplied)
                        <div class="alert alert-info" role="alert">
                            You have already applied for this job.
                        </div>
                    @else
                        {{-- Show apply button --}}
                        <a href="{{ route('jobApplications.create', ['id' => $jobOffer->id]) }}" class="btn btn-success">
                            Apply Now
                        </a>
                    @endif
                @endif
        @endauth

        @guest
            <div class="alert alert-warning" role="alert">
                You need to create an account before applying for jobs,
                please
                go to login page
            </div>
        @endguest

        {{-- Back to job listings --}}
        <a href="{{ route('jobOffersIndex') }}" class="btn btn-outline-primary">← Back to Listings</a>
    </div>




</div>

@include('component.footer')