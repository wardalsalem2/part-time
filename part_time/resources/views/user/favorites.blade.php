@include('component.header')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/favorites.css') }}">
<h1 class="text-center mt-5"
    style="font-family: 'Poppins', sans-serif; color: #2c3e50; font-size: 2.5rem; font-weight: 700;">
    Favorite Jobs <span style="color:#6ec0c7;">List</span>
</h1>
<div class="container py-5">
    <div class="row g-3">
        @forelse ($favorites as $job)
            <div class="col-lg-4 col-md-6">
                <div class="card position-relative">
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{ $job->title }}</h5>
                    </div>

                    <div class="card-body">
                        <div class="job-meta">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <p class="mb-0">
                                    <i class="fas fa-building me-2"></i>
                                    {{ $job->company->name }}
                                </p>
                                <form action="{{ route('favorites.destroy', $job->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link p-0 text-danger"
                                        title="Remove from Favorites">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </form>
                            </div>

                            <p class="mb-2">
                                <i class="fas fa-map-marker-alt me-2"></i>
                                {{ $job->location }}
                            </p>
                            <p class="mb-2">
                                <i class="bi bi-tags me-2"></i>
                                {{ $job->category }}
                            </p>
                            <p class="mb-2">
                                <i class="fas fa-money-bill-wave me-2"></i>
                                {{ number_format($job->salary, 2) }} JD
                            </p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge" style="background-color:#6ec0c7;">
                                W.Hours: {{ ucfirst($job->work_hours) }}
                            </span>
                            <small class="text-muted">
                                <i class="fas fa-clock me-1"></i>
                                Deadline: {{ \Carbon\Carbon::parse($job->deadline)->format('d M, Y') }}
                            </small>
                        </div>
                        <p class="mt-3 text-truncate-3">{{ Str::limit($job->description, 150) }}</p>
                        <a href="{{ route('jobOffersDetails', $job->id) }}" class="btn btn-primary mt-3 w-100">
                            View Details <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p>No favorite jobs found.</p>
        @endforelse
    </div>
    <div class="d-flex justify-content-center mt-5">
        {{ $favorites->links('pagination::bootstrap-5') }}
    </div>
</div>



@include('component.footer')