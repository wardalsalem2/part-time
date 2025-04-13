@include('component.header')

<style>
    .header {
        background-color: #1e2e3f !important;
        color: white !important;
    }

    body {
        background-color: #ffffff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding-top: 80px;
    }

    .job-details-section {
        background: #ffffff;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        padding: 30px;
        max-width: 800px;
        margin: 0 auto;
    }

    .job-details-title {
        font-size: 2rem;
        font-weight: 700;
        color: #1e2e3f;
        text-align: center;
        margin-bottom: 15px;
    }

    .text-muted {
        text-align: center;
        font-size: 1.1rem;
        color: #6c757d;
        margin-bottom: 30px;
    }

    .form-label {
        font-size: 1.1rem;
        font-weight: 600;
        color: #343a40;
    }

    .form-control {
        border: 2px solid #ced4da;
        border-radius: 10px;
        padding: 15px;
        font-size: 1rem;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 8px rgba(13, 110, 253, 0.25);
    }

    .btn-success {
        background-color: #0d6efd; 
        border: none;
        border-radius: 10px;
        padding: 12px 30px;
        font-size: 1.1rem;
        font-weight: 600;
        color: #fff;
        transition: background-color 0.3s ease;
    }

    .btn-success:hover {
        background-color: #0b5ed7; 
    }

    .alert {
        border-radius: 10px;
        padding: 15px;
        font-size: 1rem;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    @media (max-width: 768px) {
        .job-details-title {
            font-size: 1.5rem;
        }

        .text-muted {
            font-size: 1rem;
        }
    }
</style>

<div class="container py-5 mt-5">
    <div class="job-details-section">
        <h3 class="job-details-title">Apply for {{ $jobOffer->title }}</h3>
        <p class="text-muted">Company: {{ $jobOffer->company->name }}</p>

        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('jobApplications.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="job_offer_id" value="{{ $jobOffer->id }}">

            <div class="mb-4">
                <label for="cover_letter" class="form-label">Cover Letter</label>
                <textarea name="cover_letter" id="cover_letter" class="form-control" rows="5" placeholder="Write your cover letter here..." required></textarea>
            </div>

            <div class="mb-4">
                <label for="resume" class="form-label">Upload Resume (PDF only)</label>
                <input type="file" name="resume" id="resume" class="form-control" accept=".pdf" required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">Submit Application</button>
            </div>
        </form>
    </div>
</div>

@include('component.footer')