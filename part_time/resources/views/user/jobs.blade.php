@include('component.header')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<style>
    body {
        background-color: #ffff;
        padding-top: 80px;
        font-family: 'Poppins', sans-serif;
    }

    .header {
        background-color: #1e2e3f !important;
        color: white !important;
    }

    h1 span {
        color: #6ec0c7;
    }

    .search-container {
        background: linear-gradient(135deg, #e3f2f9, #ffffff);
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        margin-top: 2rem;
        margin-bottom: 3rem;
    }

    .search-container input {
        border-radius: 12px;
        border: 1px solid #ccc;
        padding: 0.75rem 1rem;
        box-shadow: none;
        transition: border 0.3s ease;
    }

    .search-container input:focus {
        border-color: #6ec0c7;
        outline: none;
        box-shadow: 0 0 5px rgba(110, 192, 199, 0.3);
    }

    .btn-primary {
        background: linear-gradient(135deg, #6ec0c7, #3b8f94);
        border: none;
        border-radius: 30px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 16px rgba(110, 192, 199, 0.4);
    }

    .card {
        border: none;
        border-radius: 20px;
        background: white;
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease-in-out;
    }

    .card:hover {
        transform: translateY(-8px);
        box-shadow: 0 16px 32px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background: linear-gradient(135deg, #6ec0c7, #3b8f94);
        color: white;
        border-radius: 20px 20px 0 0;
        padding: 1.5rem;
        text-align: center;
    }

    .card-title {
        font-size: 1.4rem;
        font-weight: 700;
        margin: 0;
    }

    .card-body {
        padding: 2rem;
    }

    .job-meta p {
        margin-bottom: 10px;
        font-size: 0.95rem;
        color: #555;
    }

    .job-meta i {
        color: #6ec0c7;
    }

    .badge {
        background-color: #6ec0c7;
        color: white;
        padding: 0.4rem 0.8rem;
        font-size: 0.85rem;
        border-radius: 10px;
    }

    .text-truncate-3 {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
    }

    .pagination .page-link:hover {
        background-color: #6ec0c7 !important;
        border-color: #6ec0c7 !important;
    }

    .pagination .page-item.active .page-link {
        background-color: #6ec0c7 !important;
        border-color: #6ec0c7 !important;
    }

    @media (max-width: 768px) {
        .search-container {
            padding: 1.5rem;
        }

        .btn-primary {
            width: 100%;
        }

        .card-body {
            padding: 1.5rem;
        }
    }
</style>


<h1 class="text-center mt-5"
    style="font-family: 'Poppins', sans-serif; color: #2c3e50; font-size: 2.5rem; font-weight: 700;">
    Find Your<span style="color:#6ec0c7;"> Dream Job</span>
</h1>

<div class="container search-container">
    <form action="{{ route('jobOffersIndex') }}" method="GET">
        <div class="row g-3">
            <div class="col-md-3">
                <input type="text" name="title" class="form-control form-control-lg" placeholder="Job Title"
                    value="{{ request('title') }}">
            </div>
            <div class="col-md-3">
                <input type="text" name="location" class="form-control form-control-lg" placeholder="Location"
                    value="{{ request('location') }}">
            </div>
            <div class="col-md-2">
                <input type="number" name="work_hours" class="form-control form-control-lg" placeholder="Work Hours"
                    value="{{ request('work_hours') }}">
            </div>
            <div class="col-md-2">
                <input type="number" name="salary" class="form-control form-control-lg" placeholder="Salary"
                    value="{{ request('salary') }}" min="0">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-md w-100">
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
                <div class="card">
                    
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{ $job->title }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="job-meta">
                            <p class="mb-2">
                                <i class="fas fa-building me-2"></i>
                                {{ $job->company->name }}
                            </p>
                            <p class="mb-2">
                                <i class="fas fa-map-marker-alt me-2"></i>
                                {{ $job->location }}
                            </p>
                            <p class="mb-2">
                                <i class="fas fa-money-bill-wave me-2"></i>
                                ${{ number_format($job->salary, 2) }}
                            </p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge" style="background-color:#6ec0c7;">W.Hours:
                                {{ ucfirst($job->work_hours) }}</span>
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
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-5">
        {{ $jobOffers->links('pagination::bootstrap-5') }}
    </div>
</div>

@include('component.footer')