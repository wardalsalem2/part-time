@include('admin.componant.header')

<div class="main-panel bg-light">
    <div class="content">
        <div class="container-fluid py-5">
            <div class="card shadow border-0">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0 text-center">Update Admin Profile</h4>
                </div>
                <div class="card-body px-4 py-5 bg-white">
                    <div id="formErrorContainer"></div>

                    <form id="form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label text-muted">Job Title</label>
                                <input type="text" class="form-control" name="job_title" value="{{ old('job_title', $profile->job_title) }}">
                                <div class="text-danger mt-1" id="jobTitleError"></div> 
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted">City</label>
                                <input type="text" class="form-control" name="city" value="{{ old('city', $profile->city) }}">
                                <div class="text-danger mt-1" id="cityError"></div> 
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted">Country</label>
                                <input type="text" class="form-control" name="country" value="{{ old('country', $profile->country) }}">
                                <div class="text-danger mt-1" id="countryError"></div> 
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted">Phone</label>
                                <input type="text" class="form-control" name="phone" value="{{ old('phone', $profile->phone) }}">
                                <div class="text-danger mt-1" id="phoneError"></div> 
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted">Profile Image</label>
                                <input type="file" class="form-control" name="image">
                                <div class="text-danger mt-1" id="imageError"></div> 
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted">Upload CV</label>
                                <input type="file" class="form-control" name="cv">
                                <div class="text-danger mt-1" id="cvError"></div> 
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-5">
                            <button type="submit" class="btn btn-success px-4">Save Changes</button>
                            <a href="{{ route('profile.show') }}" class="btn btn-outline-danger px-4">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('form');
        if (!form) return;

        form.addEventListener('submit', function (event) {
            let isValid = true;
            let errorMessages = [];

            // Hide previous errors
            const errorContainer = document.getElementById('formErrorContainer');
            errorContainer.innerHTML = '';
            errorContainer.style.display = 'none';

            // Helper function to show error messages under inputs
            function showError(input, message, errorId) {
                const errorElement = document.getElementById(errorId);
                errorElement.innerText = message;
            }

            // Validation for Job Title
            const jobTitle = form.querySelector('input[name="job_title"]');
            if (!jobTitle.value.trim()) {
                showError(jobTitle, 'Job Title is required.', 'jobTitleError');
                isValid = false;
            }

            // Validation for City
            const city = form.querySelector('input[name="city"]');
            if (!city.value.trim()) {
                showError(city, 'City is required.', 'cityError');
                isValid = false;
            }

            // Validation for Country
            const country = form.querySelector('input[name="country"]');
            if (!country.value.trim()) {
                showError(country, 'Country is required.', 'countryError');
                isValid = false;
            }

            // Validation for Phone (must be a number and 10 digits)
            const phone = form.querySelector('input[name="phone"]');
            const phonePattern = /^[0-9]{10}$/;
            if (!phone.value.trim() || !phonePattern.test(phone.value.trim())) {
                showError(phone, 'Phone number must be 10 digits.', 'phoneError');
                isValid = false;
            }

            // Validation for Profile Image (optional but required if provided)
            const profileImage = form.querySelector('input[name="image"]');
            if (profileImage.files.length > 0) {
                const file = profileImage.files[0];
                if (!file.type.startsWith('image/')) {
                    showError(profileImage, 'Profile image must be an image file.', 'imageError');
                    isValid = false;
                }
            }

            // Validation for CV (optional but required if provided)
            const cv = form.querySelector('input[name="cv"]');
            if (cv.files.length > 0) {
                const file = cv.files[0];
                if (!file.name.endsWith('.pdf')) {
                    showError(cv, 'CV must be a PDF file.', 'cvError');
                    isValid = false;
                }
            }

            // If not valid, prevent form submission and show errors
            if (!isValid) {
                event.preventDefault();
                errorContainer.innerHTML = `<ul>${errorMessages.map(msg => `<li>${msg}</li>`).join('')}</ul>`;
                errorContainer.style.display = 'block';
            }
        });
    });
</script>

@include('admin.componant.footer')
