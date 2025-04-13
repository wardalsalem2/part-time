@include('admin.componant.header')

<div class="main-panel">
    <div class="content">
        <div class="container">
            <h1>Edit Company: {{ $company->name }}</h1>

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Edit Form -->
            <form id="editCompanyForm" action="{{ route('admin.companies.update', $company->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Company Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $company->name) }}" required>
                    <div class="error" id="nameError" style="color: red; display: none;">This field is required.</div>
                </div>

                <div class="form-group">
                    <label for="description">Company Description</label>
                    <textarea name="description" class="form-control" id="description">{{ old('description', $company->description) }}</textarea>
                    <div class="error" id="descriptionError" style="color: red; display: none;">This field is required.</div>
                </div>

                <div class="form-group">
                    <label for="industry">Industry</label>
                    <input type="text" name="industry" class="form-control" id="industry" value="{{ old('industry', $company->industry) }}">
                    <div class="error" id="industryError" style="color: red; display: none;">This field is required.</div>
                </div>

                <div class="form-group">
                    <label for="website">Website</label>
                    <input type="url" name="website" class="form-control" id="website" value="{{ old('website', $company->website) }}">
                    <div class="error" id="websiteError" style="color: red; display: none;">Please enter a valid URL.</div>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" name="phone" class="form-control" id="phone" value="{{ old('phone', $company->phone) }}">
                    <div class="error" id="phoneError" style="color: red; display: none;">Please enter a valid phone number.</div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $company->email) }}">
                    <div class="error" id="emailError" style="color: red; display: none;">Please enter a valid email address.</div>
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" class="form-control" id="address" value="{{ old('address', $company->address) }}">
                    <div class="error" id="addressError" style="color: red; display: none;">This field is required.</div>
                </div>

                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" name="city" class="form-control" id="city" value="{{ old('city', $company->city) }}">
                    <div class="error" id="cityError" style="color: red; display: none;">This field is required.</div>
                </div>

                <div class="form-group">
                    <label for="num_employees">Number of Employees</label>
                    <input type="number" name="num_employees" class="form-control" id="num_employees" value="{{ old('num_employees', $company->num_employees) }}">
                    <div class="error" id="numEmployeesError" style="color: red; display: none;">This field is required and must be a valid number.</div>
                </div>

                <button type="submit" class="btn btn-primary">Update Company</button>
            </form>

            <a href="{{ route('admin.companies.index') }}" class="btn btn-dark mt-2">Back to list</a>
        </div>
    </div> 
</div>

@include('admin.componant.footer')

<script>
    document.getElementById('editCompanyForm').addEventListener('submit', function(event) {
        let isValid = true;

        // Reset all error messages
        const errorMessages = document.querySelectorAll('.error');
        errorMessages.forEach(error => {
            error.style.display = 'none';
        });

        // Validate company name
        const name = document.getElementById('name').value;
        if (!name) {
            document.getElementById('nameError').style.display = 'block';
            isValid = false;
        }

        // Validate description
        const description = document.getElementById('description').value;
        if (!description) {
            document.getElementById('descriptionError').style.display = 'block';
            isValid = false;
        }

        // Validate industry
        const industry = document.getElementById('industry').value;
        if (!industry) {
            document.getElementById('industryError').style.display = 'block';
            isValid = false;
        }

        // Validate website (URL)
        const website = document.getElementById('website').value;
        const websitePattern = /^(https?:\/\/)?([\w\-]+\.)+[\w\-]+(\/[\w\-\.\/?%&=]*)?$/;
        if (website && !websitePattern.test(website)) {
            document.getElementById('websiteError').style.display = 'block';
            isValid = false;
        }

        // Validate phone number
        const phone = document.getElementById('phone').value;
        const phonePattern = /^[0-9]{10}$/;
        if (phone && !phonePattern.test(phone)) {
            document.getElementById('phoneError').style.display = 'block';
            isValid = false;
        }

        // Validate email
        const email = document.getElementById('email').value;
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (email && !emailPattern.test(email)) {
            document.getElementById('emailError').style.display = 'block';
            isValid = false;
        }

        // Validate address
        const address = document.getElementById('address').value;
        if (!address) {
            document.getElementById('addressError').style.display = 'block';
            isValid = false;
        }

        // Validate city
        const city = document.getElementById('city').value;
        if (!city) {
            document.getElementById('cityError').style.display = 'block';
            isValid = false;
        }

        // Validate number of employees
        const numEmployees = document.getElementById('num_employees').value;
        if (!numEmployees || isNaN(numEmployees)) {
            document.getElementById('numEmployeesError').style.display = 'block';
            isValid = false;
        }

        // If not valid, prevent form submission
        if (!isValid) {
            event.preventDefault();
        }
    });
</script>
