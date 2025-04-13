@include('company.component.header')

<div class="container py-5">
    <h2 class="text-center mb-4">Edit Job Offer</h2>

    <form method="POST" action="{{ route('company.job-offers.update', $jobOffer->id) }}" class="bg-white p-4 rounded shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $jobOffer->title) }}" class="form-control" required>
        </div>

        <div class="mb-4">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="5" required>{{ old('description', $jobOffer->description) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="location" class="form-label">Location</label>
            <input type="text" name="location" id="location" value="{{ old('location', $jobOffer->location) }}" class="form-control" required>
        </div>

        <div class="mb-4">
            <label for="work_hours" class="form-label">Work Hours</label>
            <input type="text" name="work_hours" id="work_hours" value="{{ old('work_hours', $jobOffer->work_hours) }}" class="form-control">
        </div>

        <div class="mb-4">
            <label for="salary" class="form-label">Salary</label>
            <input type="number" name="salary" id="salary" value="{{ old('salary', $jobOffer->salary) }}" class="form-control" step="0.01" min="0">
        </div>

        <div class="mb-4">
            <label for="requirements" class="form-label">Requirements</label>
            <textarea name="requirements" id="requirements" class="form-control" rows="4">{{ old('requirements', $jobOffer->requirements) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="deadline" class="form-label">Deadline</label>
            <input type="date" name="deadline" id="deadline" value="{{ old('deadline', $jobOffer->deadline ? \Carbon\Carbon::parse($jobOffer->deadline)->format('Y-m-d') : '') }}" class="form-control">
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('company.job-offers.index') }}" class="btn btn-secondary px-4 py-2">Back to List</a>
            <button type="submit" class="btn btn-primary px-4 py-2">Update</button>
           
        </div>
    </form>
</div>

@include('company.component.footer')
