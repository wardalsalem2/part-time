@include('component.header')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/jobs.css') }}">

<h1 class="text-center mt-5"
    style="font-family: 'Poppins', sans-serif; color: #2c3e50; font-size: 2.5rem; font-weight: 700;">
    Find Your<span style="color:#6ec0c7;"> Dream Job</span>
</h1>

<div class="container search-container my-3">
    <form action="{{ route('jobOffersIndex') }}" method="GET">
        {{-- First Row --}}
        <div class="row g-3 mb-3">
            <div class="col-md-4">
                <input type="text" name="title" class="form-control" placeholder="Job Title"
                    value="{{ request('title') }}">
            </div>
            <div class="col-md-4">
                <select name="location" class="form-select">
                    <option value="">Select Location</option>
                    @php
                        $governorates = [
                            'Amman', 'Zarqa', 'Irbid', 'Aqaba', 'Balqa',
                            'Madaba', 'Mafraq', 'Jerash', 'Ajloun',
                            'Karak', 'Tafilah', 'Ma\'an'
                        ];
                    @endphp
                    @foreach($governorates as $gov)
                        <option value="{{ $gov }}" {{ request('location') == $gov ? 'selected' : '' }}>
                            {{ $gov }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <select name="category" class="form-select">
                    <option value="">Select Category</option>
                    <option value="IT" {{ request('category') == 'IT' ? 'selected' : '' }}>IT</option>
                    <option value="Marketing" {{ request('category') == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                    <option value="Design" {{ request('category') == 'Design' ? 'selected' : '' }}>Design</option>
                </select>
            </div>
        </div>

        {{-- Second Row --}}
        <div class="row g-3">
            <div class="col-md-4">
                <input type="number" name="work_hours" class="form-control" placeholder="Work Hours"
                    value="{{ request('work_hours') }}">
            </div>
            <div class="col-md-4">
                <input type="number" name="salary" class="form-control" placeholder="Salary"
                    value="{{ request('salary') }}" min="0">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary w-100 h-100">
                    <i class="fas fa-search me-2"></i> Search
                </button>
            </div>
        </div>
    </form>
</div>


<div class="container py-5">
    <div class="row g-3">
        @foreach ($jobOffers as $job)
            <div class="col-lg-4 col-md-6">
                <div class="card position-relative">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">{{ $job->title }}</h5>
                    </div>

                    <div class="card-body">
                        <div class="job-meta" style="border-radius: 20px 20px 0 0;">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <p class="mb-0">
                                    <i class="fas fa-building me-2"></i>
                                    {{ $job->company->name }}
                                </p>
                                @auth
                                    @if(auth()->user()->favoriteJobs && auth()->user()->favoriteJobs->contains($job))
                                        <form action="{{ route('favorites.destroy', $job->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link p-0 text-danger" title="Remove from Favorites">
                                                <i class="fas fa-heart"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('favorites.store', $job->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-link p-0 text-muted" title="Add to Favorites">
                                                <i class="far fa-heart"></i>
                                            </button>
                                        </form>
                                    @endif
                                @endauth
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
                        <p class="mt-3 text-truncate-3">{{ Str::limit($job->description, 30) }}</p>
                        <a href="{{ route('jobOffersDetails', $job->id) }}" class="btn btn-primary mt-3 w-100">
                            View Details <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-5">
        {{ $jobOffers->links('pagination::bootstrap-5') }}
    </div>
</div>
@include('component.footer')