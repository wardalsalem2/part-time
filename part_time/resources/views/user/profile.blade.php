@include('component.header')

<style>
    body {
        background-color: #ffff;
        padding-top: 80px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .profile-container {
        max-width: 1000px;
        margin: auto;
        padding: 30px 20px;
    }

    .profile-card {
        background: #ffffff;
        border-radius: 25px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        padding: 40px 30px;
        margin-bottom: 50px;
    }

    .profile-image-wrapper {
        width: 140px;
        height: 140px;
        margin: auto;
        position: relative;
    }

    .profile-image-wrapper::before {
        content: '';
        position: absolute;
        top: -5px;
        left: -5px;
        right: -5px;
        bottom: -5px;
        border-radius: 50%;
        background: linear-gradient(#6ec0c7);
        z-index: 1;
    }

    .profile-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #fff;
        position: relative;
        z-index: 2;
    }

    .profile-name {
        font-size: 1.6rem;
        font-weight: 700;
        color: #2c3e50;
        margin-top: 15px;
    }

    .job-title {
        font-size: 1rem;
        font-weight: 500;
        color: #64b9e1;
        margin-bottom: 20px;
    }

    .info-label {
        font-weight: 600;
        color: #6ec0c7;
    }

    .profile-info p {
        font-size: 1rem;
        margin-bottom: 10px;
        color: #333;
    }

    .edit-btn {
        background-color: #6ec0c7;
        color: white;
        padding: 10px 24px;
        border: none;
        border-radius: 30px;
        font-size: 15px;
        margin-top: 20px;
        transition: 0.3s;
    }

    .edit-btn:hover {
        background-color: #1a83c0;
    }

    .applications-card {
        background: #ffffff;
        border-radius: 25px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        padding: 30px 25px;
    }

    .applications-title {
        font-size: 1.4rem;
        font-weight: 600;
        text-align: center;
        margin-bottom: 25px;
        color: #2c3e50;
    }

    .table th,
    .table td {
        vertical-align: middle !important;
        font-size: 0.95rem;
    }

    .job-status-badge {
        padding: 6px 15px;
        border-radius: 30px;
        font-weight: 500;
        font-size: 14px;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn-cancel,
    .btn-view {
        border: none;
        border-radius: 25px;
        font-size: 14px;
        padding: 8px 16px;
        color: white;
    }

    .btn-cancel {
        background-color: red;
    }

    .btn-cancel:hover {
        background-color: #c0392b;
    }

    .btn-view {
        background-color: #6ec0c7;
    }

    .btn-view:hover {
        background-color: #1a83c0;
    }

    @media (max-width: 768px) {
        .profile-info p {
            font-size: 0.95rem;
        }

        .table th,
        .table td {
            font-size: 0.85rem;
        }

        .action-buttons {
            flex-direction: column;
        }
    }
</style>

<div class="profile-container">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="profile-card text-center">
        <div class="profile-image-wrapper">
            @if (!empty($profile->image_path) && Storage::disk('public')->exists($profile->image_path))
                <img src="{{ asset('storage/' . $profile->image_path) }}" alt="Profile Image" class="profile-image">
            @else
                <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile" class="profile-image">
            @endif
        </div>

        <h3 class="profile-name">{{ Auth::user()->name }}</h3>
        <p class="job-title">{{ $profile->job_title }}</p>

        <div class="profile-info text-start mt-4 mx-auto" style="max-width: 600px;">
            <p><span class="info-label">Hourly Rate:</span> ${{ $profile->hourly_rate }}</p>
            <p><span class="info-label">Available Hours:</span> {{ $profile->available_hours }} hours/week</p>
            <p><span class="info-label">Skills:</span> {{ $profile->skills }}</p>
            <p><span class="info-label">Experience:</span> {{ $profile->experience }}</p>
            <p><span class="info-label">Location:</span> {{ $profile->city }}, {{ $profile->country }}</p>
            <p><span class="info-label">Phone:</span> {{ $profile->phone }}</p>

            <p>
                <span class="info-label">CV:</span>
                @if($profile->cv_path)
                    <a href="{{ asset('storage/' . $profile->cv_path) }}" target="_blank"
                        class="btn btn-outline-primary btn-sm ms-2">Download CV</a>
                @else
                    <span class="text-danger ms-2">No CV uploaded</span>
                @endif
            </p>
        </div>

        <a href="{{ route('profile.edit') }}" class="edit-btn">Edit Profile</a>
    </div>

    <div class="applications-card">
        <h4 class="applications-title">Job Applications</h4>

        @if($jobApplications->isEmpty())
            <p class="text-muted text-center">No job applications submitted yet.</p>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Job Title</th>
                            <th>Applied On</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jobApplications as $application)
                                    <tr>
                                        <td>{{ $application->jobOffer->title }}</td>
                                        <td>{{ $application->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <span class="badge job-status-badge bg-{{ 
                                                        $application->status == 'accepted' ? 'success' :
                            ($application->status == 'rejected' ? 'danger' : 'warning') 
                                                    }}">
                                                {{ ucfirst($application->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <form action="{{ route('profile_user.cancelJobApplication', $application->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to cancel this application?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-cancel">Cancel</button>
                                                </form>
                                                <a href="{{ route('jobOffersDetails', $application->jobOffer->id) }}"
                                                    class="btn btn-view">View Job</a>
                                            </div>
                                        </td>
                                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

@include('component.footer')