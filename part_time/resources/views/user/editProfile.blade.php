@include('component.header')

<style>
    .header {
        background-color: #1c2c3e !important;
        color: white !important;
    }

    body {
        background-color: #ffffff;
        padding-top: 80px;
    }

    .profile-image {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        margin-top: 10px;
    }

    .form-section {
        background-color: #ffffff;
        padding: 2rem;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    }

    .form-section h2 {
        font-weight: 700;
        color: #333;
    }

    .form-label {
        font-weight: 600;
    }

    .save-btn {
        border-radius: 25px;
        background-color: #6ec0c7;
        color: white;
        border: none;
        transition: background-color 0.3s ease;
    }

    .save-btn:hover {
        background-color:rgb(71, 125, 129);
        cursor: pointer;
    }
</style>

<div class="container mt-5 mb-5">
    <div class="form-section">
        <h2 class="mb-4 text-center">Edit Your Profile</h2>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="job_title" class="form-label">Job Title</label>
                    <input type="text" class="form-control @error('job_title') is-invalid @enderror" name="job_title"
                        value="{{ old('job_title', $profile->job_title) }}" required>
                    @error('job_title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="hourly_rate" class="form-label">Hourly Rate ($)</label>
                    <input type="number" class="form-control @error('hourly_rate') is-invalid @enderror"
                        name="hourly_rate" value="{{ old('hourly_rate', $profile->hourly_rate) }}">
                    @error('hourly_rate')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="available_hours" class="form-label">Available Hours/Week</label>
                    <input type="number" class="form-control @error('available_hours') is-invalid @enderror"
                        name="available_hours" value="{{ old('available_hours', $profile->available_hours) }}">
                    @error('available_hours')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="skills" class="form-label">Skills</label>
                    <textarea class="form-control @error('skills') is-invalid @enderror" name="skills"
                        rows="3">{{ old('skills', $profile->skills) }}</textarea>
                    @error('skills')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="experience" class="form-label">Experience</label>
                    <textarea class="form-control @error('experience') is-invalid @enderror" name="experience"
                        rows="3">{{ old('experience', $profile->experience) }}</textarea>
                    @error('experience')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control @error('city') is-invalid @enderror" name="city"
                        value="{{ old('city', $profile->city) }}" required>
                    @error('city')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="country" class="form-label">Country</label>
                    <input type="text" class="form-control @error('country') is-invalid @enderror" name="country"
                        value="{{ old('country', $profile->country) }}" required>
                    @error('country')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                        value="{{ old('phone', $profile->phone) }}" required>
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="cv" class="form-label">Upload CV (PDF only)</label>
                    <input type="file" class="form-control @error('cv') is-invalid @enderror" name="cv" accept=".pdf">
                    @error('cv')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if($profile->cv_path)
                        <a href="{{ Storage::url($profile->cv_path) }}" target="_blank" class="d-block mt-2">View Current
                            CV</a>
                    @endif
                </div>

                <div class="col-md-6">
                    <label for="image" class="form-label">Upload Profile Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                        accept="image/*">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <div class="text-center">
                        @if($profile->image_path)
                            <img src="{{ Storage::url($profile->image_path) }}" alt="Profile Image" class="profile-image">
                        @else
                            <img src="{{ asset('images/default-profile.png') }}" class="profile-image">
                        @endif
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="px-5 py-2 save-btn">Save Changes</button>
            </div>
        </form>
    </div>
</div>

@include('component.footer')