@include('company.component.header')

<div class="container py-5">
    <h2 class="text-center mb-4">Edit Job Offer</h2>

    <form method="POST" action="{{ route('company.job-offers.update', $jobOffer->id) }}" id="jobOfferForm"
        class="bg-white p-4 rounded shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
            <input type="text" name="title" id="title" value="{{ old('title', $jobOffer->title) }}"
                class="form-control">
            <div class="text-danger" id="titleError"></div>
        </div>

        <div class="mb-4">
            <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
            <textarea name="description" id="description" class="form-control"
                rows="5">{{ old('description', $jobOffer->description) }}</textarea>
            <div class="text-danger" id="descriptionError"></div>
        </div>

        <div class="mb-4">
            <label for="location" class="form-label">Location <span class="text-danger">*</span></label>
            <input type="text" name="location" id="location" value="{{ old('location', $jobOffer->location) }}"
                class="form-control">
            <div class="text-danger" id="locationError"></div>
        </div>

        <div class="mb-4">
            <label for="work_hours" class="form-label">Work Hours</label>
            <input type="text" name="work_hours" id="work_hours" value="{{ old('work_hours', $jobOffer->work_hours) }}"
                class="form-control">
            <div class="text-danger" id="workHoursError"></div>
        </div>

        <div class="mb-4">
            <label for="salary" class="form-label">Salary</label>
            <input type="number" name="salary" id="salary" value="{{ old('salary', $jobOffer->salary) }}"
                class="form-control" step="0.01" min="0">
            <div class="text-danger" id="salaryError"></div>
        </div>

        <div class="mb-4">
            <label for="requirements" class="form-label">Requirements</label>
            <textarea name="requirements" id="requirements" class="form-control"
                rows="4">{{ old('requirements', $jobOffer->requirements) }}</textarea>
            <div class="text-danger" id="requirementsError"></div>
        </div>

        <div class="mb-4">
            <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
            <select name="category" id="category" class="form-control rounded-3">
                <option value="">Select Category</option>
                <option value="IT" {{ old('category', $jobOffer->category) == 'IT' ? 'selected' : '' }}>IT</option>
                <option value="Marketing" {{ old('category', $jobOffer->category) == 'Marketing' ? 'selected' : '' }}>
                    Marketing</option>
                <option value="Design" {{ old('category', $jobOffer->category) == 'Design' ? 'selected' : '' }}>Design
                </option>
            </select>
            <div class="text-danger" id="categoryError"></div>
        </div>

        <div class="mb-4">
            <label for="deadline" class="form-label">Deadline</label>
            <input type="date" name="deadline" id="deadline"
                value="{{ old('deadline', $jobOffer->deadline ? \Carbon\Carbon::parse($jobOffer->deadline)->format('Y-m-d') : '') }}"
                class="form-control">
            <div class="text-danger" id="deadlineError"></div>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('company.job-offers.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Back</a>
            <button type="submit" class="btn btn-primary rounded-pill px-4">Update</button>
        </div>
    </form>
</div>

@include('company.component.footer')

<script>
    document.getElementById('jobOfferForm').addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent form submission to handle validation

        let isValid = true;

        // Clear previous errors
        document.querySelectorAll('.text-danger').forEach(function (el) {
            el.textContent = '';
        });

        // Validate Title
        const title = document.getElementById('title').value.trim();
        if (!title) {
            document.getElementById('titleError').textContent = 'Title is required.';
            isValid = false;
        }

        // Validate Description
        const description = document.getElementById('description').value.trim();
        if (!description) {
            document.getElementById('descriptionError').textContent = 'Description is required.';
            isValid = false;
        }

        // Validate Location
        const location = document.getElementById('location').value.trim();
        if (!location) {
            document.getElementById('locationError').textContent = 'Location is required.';
            isValid = false;
        }

        // Validate Work Hours
        const workHours = document.getElementById('work_hours').value.trim();
        if (workHours === '') {
            document.getElementById('workHoursError').textContent = ''; // لا تظهر الرسالة في حال كانت فارغة
        } else if (!/^[0-9]+$/.test(workHours)) {
            document.getElementById('workHoursError').textContent = 'Work Hours should be a valid number.';
            isValid = false;
        }

        // Validate Salary
        const salary = document.getElementById('salary').value.trim();
        if (salary && (isNaN(salary) || parseFloat(salary) <= 0)) {
            document.getElementById('salaryError').textContent = 'Salary should be a positive number.';
            isValid = false;
        }

        // Validate Requirements
        const requirements = document.getElementById('requirements').value.trim();
        if (requirements && requirements.length < 10) {
            document.getElementById('requirementsError').textContent = 'Requirements should be at least 10 characters.';
            isValid = false;
        }

        // Validate Category
        const category = document.getElementById('category').value;
        if (!category) {
            document.getElementById('categoryError').textContent = 'Category is required.';
            isValid = false;
        }

        // Validate Deadline
        const deadline = document.getElementById('deadline').value;
        if (deadline && new Date(deadline) < new Date()) {
            document.getElementById('deadlineError').textContent = 'Deadline cannot be in the past.';
            isValid = false;
        }

        // Submit form if all fields are valid
        if (isValid) {
            this.submit();
        }
    });
</script>