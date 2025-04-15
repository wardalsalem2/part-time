@include('company.component.header')

<div class="container my-5">
    <div class="card shadow-lg border-0 rounded-4 p-4">
        <h2 class="mb-4 text-primary">Create New Job Offer</h2>

        <form method="POST" action="{{ route('company.job-offers.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Title <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control rounded-3" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description <span class="text-danger">*</span></label>
                <textarea name="description" class="form-control rounded-3" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Location <span class="text-danger">*</span></label>
                <input type="text" name="location" class="form-control rounded-3" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Category <span class="text-danger">*</span></label>
                <select name="category" class="form-control rounded-3" required>
                    <option value="">Select Category</option>
                    <option value="IT">IT</option>
                    <option value="Marketing">Marketing</option>
                    <option value="Design">Design</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Work Hours</label>
                <input type="text" name="work_hours" class="form-control rounded-3" placeholder="e.g., 20 hours/week">
            </div>

            <div class="mb-3">
                <label class="form-label">Salary (Optional)</label>
                <input type="number" name="salary" class="form-control rounded-3" placeholder="e.g., 500 JD">
            </div>

            <div class="mb-3">
                <label class="form-label">Requirements</label>
                <textarea name="requirements" class="form-control rounded-3" rows="3" placeholder="List job requirements..."></textarea>
            </div>

            <div class="mb-4">
                <label class="form-label">Deadline</label>
                <input type="date" name="deadline" class="form-control rounded-3">
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('company.job-offers.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Back to List</a>
                <button type="submit" class="btn btn-primary rounded-pill px-4">Submit</button>
            </div>
        </form>
    </div>
</div>

@include('company.component.footer')
