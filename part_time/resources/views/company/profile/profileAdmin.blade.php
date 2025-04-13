@include('company.component.header')

<div class="container py-5">
    <h2 class="text-center mb-4">Company Profile</h2>
    
    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm p-4">
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Name:</strong> {{ $company->name }}</li>
            <li class="list-group-item"><strong>Email:</strong> {{ $company->email }}</li>
            <li class="list-group-item"><strong>Phone:</strong> {{ $company->phone }}</li>
            <li class="list-group-item"><strong>Website:</strong> {{ $company->website }}</li>
            <li class="list-group-item"><strong>City:</strong> {{ $company->city }}</li>
            <li class="list-group-item"><strong>Industry:</strong> {{ $company->industry }}</li>
            <li class="list-group-item"><strong>Description:</strong> {{ $company->description }}</li>
        </ul>
    </div>

    <div class="d-flex justify-content-center mt-4">
        <a href="{{ route('company.profile.edit') }}" class="btn btn-primary px-4 py-2">Edit Profile</a>
    </div>
</div>

@include('company.component.footer')
