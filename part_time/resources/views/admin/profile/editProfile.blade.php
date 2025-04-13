@include('admin.componant.header')

<div class="main-panel bg-light">
    <div class="content">
        <div class="container-fluid py-5">
            <div class="card shadow border-0">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0 text-center">Update Admin Profile</h4>
                </div>

                <div class="card-body px-4 py-5 bg-white">

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label text-muted">Job Title</label>
                                <input type="text" class="form-control" name="job_title" value="{{ old('job_title', $profile->job_title) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted">City</label>
                                <input type="text" class="form-control" name="city" value="{{ old('city', $profile->city) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted">Country</label>
                                <input type="text" class="form-control" name="country" value="{{ old('country', $profile->country) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted">Phone</label>
                                <input type="text" class="form-control" name="phone" value="{{ old('phone', $profile->phone) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted">Profile Image</label>
                                <input type="file" class="form-control" name="image">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted">Upload CV</label>
                                <input type="file" class="form-control" name="cv">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-5">
                            <button type="submit" class="btn btn-dark px-4">Save Changes</button>
                            <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary px-4">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.componant.footer')
