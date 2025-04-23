@include('admin.componant.header')

<div class="main-panel bg-white">
    <div class="content bg-white">
        <div class="container-fluid bg-white">
            <h2>Edit User</h2>

            <form id="form" action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                    <div class="text-danger mt-1" id="nameError"></div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                    <div class="text-danger mt-1" id="emailError"></div>
                </div>

                <div class="form-group">
                    <label for="role_id">Role</label>
                    <select name="role_id" class="form-control">
                        <option value="">Select Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                    <div class="text-danger mt-1" id="roleError"></div>
                </div>

                <div class="form-group">
                    <label for="job_title">Job Title</label>
                    <input type="text" name="job_title" class="form-control" value="{{ $user->profile->job_title ?? '' }}">
                    <div class="text-danger mt-1" id="jobTitleError"></div> 
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ $user->profile->phone ?? '' }}">
                    <div class="text-danger mt-1" id="phoneError"></div>
                </div>

                <button type="submit" class="btn btn-success">Update</button>
            </form>

            <!-- Go Back Button -->
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary mt-3">Back to Users List</a>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById('form');

        if (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();

                let isValid = true;

                // Remove all previous error messages
                form.querySelectorAll('.text-danger').forEach(el => el.innerText = '');

                // Helper function to show error below an input
                function showError(input, message, errorId) {
                    const errorElement = document.getElementById(errorId);
                    errorElement.innerText = message;
                }

                // Validate Name
                const name = form.querySelector('input[name="name"]');
                if (!name.value.trim()) {
                    showError(name, 'Name is required.', 'nameError');
                    isValid = false;
                }

                // Validate Email
                const email = form.querySelector('input[name="email"]');
                const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                if (!email.value.trim()) {
                    showError(email, 'Email is required.', 'emailError');
                    isValid = false;
                } else if (!emailPattern.test(email.value.trim())) {
                    showError(email, 'Valid email is required.', 'emailError');
                    isValid = false;
                }

                // Validate Role
                const role = form.querySelector('select[name="role_id"]');
                if (!role.value) {
                    showError(role, 'Role is required.', 'roleError');
                    isValid = false;
                }

                // Validate Job Title
                const jobTitle = form.querySelector('input[name="job_title"]');
                if (!jobTitle.value.trim()) {
                    showError(jobTitle, 'Job Title is required.', 'jobTitleError');
                    isValid = false;
                }

                // Validate Phone
                const phone = form.querySelector('input[name="phone"]');
                const phonePattern = /^[0-9]{10}$/;
                if (!phone.value.trim()) {
                    showError(phone, 'Phone is required.', 'phoneError');
                    isValid = false;
                } else if (!phonePattern.test(phone.value.trim())) {
                    showError(phone, 'Phone number must be 10 digits.', 'phoneError');
                    isValid = false;
                }

                if (isValid) {
                    form.submit();
                }
            });
        }
    });
</script>

@include('admin.componant.footer')
