@include('company.component.header')

<div class="container my-5">
    <div class="card shadow-lg border-0 rounded-4 p-4">
        <h2 class="mb-4 text-primary">Create New Job Offer</h2>

        <form id="jobOfferForm" method="POST" action="{{ route('company.job-offers.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Title <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control rounded-3">
                <div class="invalid-feedback" style="display: none;">Title is required.</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Description <span class="text-danger">*</span></label>
                <textarea name="description" class="form-control rounded-3" rows="4"></textarea>
                <div class="invalid-feedback" style="display: none;">Description is required.</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Location <span class="text-danger">*</span></label>
                <select name="location" class="form-control rounded-3">
                    <option value="">-- Select Location --</option>
                    <option value="Amman">Amman</option>
                    <option value="Zarqa">Zarqa</option>
                    <option value="Irbid">Irbid</option>
                    <option value="Aqaba">Aqaba</option>
                    <option value="Balqa">Balqa</option>
                    <option value="Mafraq">Mafraq</option>
                    <option value="Jerash">Jerash</option>
                    <option value="Ajloun">Ajloun</option>
                    <option value="Madaba">Madaba</option>
                    <option value="Karak">Karak</option>
                    <option value="Tafilah">Tafilah</option>
                    <option value="Ma'an">Ma'an</option>
                </select>
                <div class="invalid-feedback" style="display: none;">Location is required.</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Category <span class="text-danger">*</span></label>
                <select name="category" class="form-control rounded-3">
                    <option value="">Select Category</option>
                    <option value="IT">IT</option>
                    <option value="Marketing">Marketing</option>
                    <option value="Design">Design</option>
                </select>
                <div class="invalid-feedback" style="display: none;">Category is required.</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Work Hours</label>
                <input type="text" name="work_hours" class="form-control rounded-3" placeholder="e.g., 20 hours/week">
                <div class="invalid-feedback" style="display: none;">Work hours are required if provided.</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Salary (Optional)</label>
                <input type="number" name="salary" class="form-control rounded-3" placeholder="e.g., 500 JD">
                <div class="invalid-feedback" style="display: none;">Salary must be a valid number if provided.</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Requirements</label>
                <textarea name="requirements" class="form-control rounded-3" rows="3"
                    placeholder="List job requirements..."></textarea>
                <div class="invalid-feedback" style="display: none;">Requirements must be provided if entered.</div>
            </div>

            <div class="mb-4">
                <label class="form-label">Deadline</label>
                <input type="date" name="deadline" id="deadline" class="form-control rounded-3">
                <div class="invalid-feedback" style="display: none;">Please select a valid deadline if provided.</div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('company.job-offers.index') }}"
                    class="btn btn-outline-secondary rounded-pill px-4">Back to List</a>
                <button type="submit" class="btn btn-primary rounded-pill px-4">Submit</button>
            </div>
        </form>
    </div>
</div>

@include('company.component.footer')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('jobOfferForm');
        if (!form) return;

        form.addEventListener('submit', function (event) {
            let isValid = true;

            // Clear previous error messages
            const inputs = form.querySelectorAll('input, textarea, select');
            inputs.forEach(input => {
                input.classList.remove('is-invalid');
                const feedback = input.nextElementSibling;
                if (feedback && feedback.classList.contains('invalid-feedback')) {
                    feedback.style.display = 'none';
                }
            });

            // Title validation
            const title = form.querySelector('input[name="title"]');
            if (!title.value.trim()) {
                title.classList.add('is-invalid');
                title.nextElementSibling.style.display = 'block';
                isValid = false;
            }

            // Description validation
            const description = form.querySelector('textarea[name="description"]');
            if (!description.value.trim()) {
                description.classList.add('is-invalid');
                description.nextElementSibling.style.display = 'block';
                isValid = false;
            }

            // Location validation
            const location = form.querySelector('input[name="location"]');
            if (!location.value.trim()) {
                location.classList.add('is-invalid');
                location.nextElementSibling.style.display = 'block';
                isValid = false;
            }

            // Category validation
            const category = form.querySelector('select[name="category"]');
            if (!category.value) {
                category.classList.add('is-invalid');
                category.nextElementSibling.style.display = 'block';
                isValid = false;
            }

            // Work Hours validation (optional, but if filled, check if valid)
            const workHours = form.querySelector('input[name="work_hours"]');
            if (workHours.value.trim() && !/^\d+(\s*hours\/week)?$/.test(workHours.value.trim())) {
                workHours.classList.add('is-invalid');
                workHours.nextElementSibling.style.display = 'block';
                isValid = false;
            }

            // Salary validation (optional, but if filled, check if valid)
            const salary = form.querySelector('input[name="salary"]');
            if (salary.value && isNaN(salary.value)) {
                salary.classList.add('is-invalid');
                salary.nextElementSibling.style.display = 'block';
                isValid = false;
            }

            // Requirements validation (optional, but if filled, check if valid)
            const requirements = form.querySelector('textarea[name="requirements"]');
            if (requirements.value.trim() && !requirements.value.trim()) {
                requirements.classList.add('is-invalid');
                requirements.nextElementSibling.style.display = 'block';
                isValid = false;
            }

            // Deadline validation (optional, but if filled, check if valid)
            const deadline = form.querySelector('input[name="deadline"]');
            if (deadline.value && !Date.parse(deadline.value)) {
                deadline.classList.add('is-invalid');
                deadline.nextElementSibling.style.display = 'block';
                isValid = false;
            }


            // If form is invalid, prevent submission
            if (!isValid) {
                event.preventDefault();
            }
        });
    });
</script>

<script>
    // Set the minimum date for the deadline input to today
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('deadline').setAttribute('min', today);
</script>