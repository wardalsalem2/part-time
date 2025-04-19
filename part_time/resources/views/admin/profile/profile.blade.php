@include('admin.componant.header')

<div class="main-panel bg-white">
    <div class="content bg-white">
        <div class="container-fluid p-4">
            <!-- التنبيهات -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4 border">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4 border">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card border shadow-sm">
                <div class="card-header bg-white border-bottom py-3">
                    <h3 class="mb-0 text-center text-dark">
                        <i class="bi bi-person-lines-fill me-2"></i>
                        Profile Details
                    </h3>
                </div>
                <div class="card-body p-4">

                    <div class="text-center mb-4">
                        <img src="{{ $profile->image_path ? asset('storage/' . $profile->image_path) : asset('images/default-profile.png') }}"
                            class="img-thumbnail rounded-circle border" style="width: 150px; height: 150px;">
                        <h2 class="mt-3 fw-bold text-dark">{{ $profile->user->name }}</h2>
                        <p class="text-muted mb-4">{{ $profile->user->email }}</p>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="p-3 border rounded h-100">
                                <dl>
                                    <dt class="text-dark"><i class="bi bi-briefcase me-2"></i>Job Title</dt>
                                    <dd class="mb-3">{{ $profile->job_title ?: 'N/A' }}</dd>

                                    <dt class="text-dark"><i class="bi bi-cash me-2"></i>Hourly Rate</dt>
                                    <dd class="mb-3">{{ $profile->hourly_rate ? '$' . $profile->hourly_rate : 'N/A' }}
                                    </dd>

                                    <dt class="text-dark"><i class="bi bi-clock-history me-2"></i>Available Hours</dt>
                                    <dd class="mb-3">{{ $profile->available_hours }} hrs/week</dd>

                                    <dt class="text-dark"><i class="bi bi-tools me-2"></i>Skills</dt>
                                    <dd>{{ $profile->skills ?: 'N/A' }}</dd>
                                </dl>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 border rounded h-100">
                                <dl>
                                    <dt class="text-dark"><i class="bi bi-award me-2"></i>Experience</dt>
                                    <dd class="mb-3">{{ $profile->experience ?: 'N/A' }}</dd>

                                    <dt class="text-dark"><i class="bi bi-geo-alt me-2"></i>Location</dt>
                                    <dd class="mb-3">{{ $profile->city ?: 'N/A' }}, {{ $profile->country }}</dd>

                                    <dt class="text-dark"><i class="bi bi-telephone me-2"></i>Phone</dt>
                                    <dd class="mb-3">{{ $profile->phone ?: 'N/A' }}</dd>

                                    <dt class="text-dark"><i class="bi bi-file-earmark-pdf me-2"></i>CV</dt>
                                    <dd>
                                        @if($profile->cv_path)
                                            <a href="{{ asset('storage/' . $profile->cv_path) }}"
                                                class="btn btn-outline-info btn-sm" target="_blank">
                                                Download CV
                                            </a>
                                        @else
                                            <span class="text-muted">No CV uploaded</span>
                                        @endif
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>

                    <!-- زر التعديل -->
                    <div class="text-center mt-4">
                        <a href="{{ route('profile.edit') }}" class="btn btn-warning btn-lg px-5">
                            <i class="bi bi-pencil-square me-2"></i>Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.componant.footer')