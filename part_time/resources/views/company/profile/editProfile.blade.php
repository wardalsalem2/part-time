@include('company.component.header')

<div class="container py-5">
    <h2 class="text-center mb-4">Edit Company Profile</h2>

    <form action="{{ route('company.profile.update') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name', $company->name) }}" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $company->email) }}" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Phone</label>
            <input type="text" name="phone" value="{{ old('phone', $company->phone) }}" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Website</label>
            <input type="text" name="website" value="{{ old('website', $company->website) }}" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Industry</label>
            <input type="text" name="industry" value="{{ old('industry', $company->industry) }}" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>City</label>
            <input type="text" name="city" value="{{ old('city', $company->city) }}" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Address</label>
            <textarea name="address" class="form-control" required>{{ old('address', $company->address) }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label>Number of Employees</label>
            <input type="number" name="num_employees" value="{{ old('num_employees', $company->num_employees) }}" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" required>{{ old('description', $company->description) }}</textarea>
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">Update Profile</button>
            <a href="{{ route('company.profile') }}" class="btn btn-secondary">Back to Profile</a>
        </div>
    </form>
</div>

@include('company.component.footer')
