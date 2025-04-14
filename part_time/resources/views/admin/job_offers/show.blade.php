@include('admin.componant.header')
<div class="main-panel bg-white">
    <div class="content bg-white">
        <div class="container-fluid bg-white">

            <h2>Job Details</h2>

            <ul class="list-group">
                <li class="list-group-item"><strong>Title:</strong> {{ $job->title }}</li>
                <li class="list-group-item"><strong>Description:</strong> {{ $job->description }}</li>
                <li class="list-group-item"><strong>Company:</strong> {{ $job->company->name }}</li>
                <li class="list-group-item"><strong>Work Hours:</strong> {{ $job->work_hours }}</li>
                <li class="list-group-item"><strong>Salary:</strong> {{ $job->salary }}</li>
                <li class="list-group-item"><strong>Location:</strong> {{ $job->location }}</li>
                <li class="list-group-item"><strong>Requirements:</strong> {{ $job->requirements }}</li>
                <li class="list-group-item"><strong>Deadline:</strong> {{ $job->deadline }}</li>
                <li class="list-group-item"><strong>Status:</strong> {{ $job->is_active ? 'Active' : 'Inactive' }}</li>
            </ul>

            <a href="{{ route('admin.job_offers.index') }}" class="btn btn-secondary mt-3">Back</a>
        </div>

        @include('admin.componant.footer')