@include('admin.componant.header')

<div class="main-panel bg-white">
    <div class="content bg-white">
        <div class="container-fluid bg-white">
            <h2>User Details: {{ $user->name }}</h2>

            <div class="card mt-3">
                <div class="card-header">
                    <h3>User Information</h3>
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Registration Date:</strong> {{ $user->created_at->format('Y-m-d') }}</p>
                    <p><strong>Status:</strong> 
                        @if($user->profile->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </p>
                    <p><strong>Phone Number:</strong> {{ $user->profile->phone }}</p>
                    <p><strong>CV Link:</strong> 
                        <a href="{{ asset('storage/' . $user->profile->cv_path) }}" download="{{ basename($user->profile->cv_path) }}">Download CV</a>
                    </p>

                    <form action="{{ route('admin.users.activate', $user->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success btn-sm">Activate User</button>
                    </form>

                    <form action="{{ route('admin.users.deactivate', $user->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-danger btn-sm">Deactivate User</button>
                    </form>
                </div>
            </div>

            <!-- Go Back Button -->
            <div class="mt-3">
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">Back to Users List</a>
            </div>
        </div>
    </div>
</div>

@include('admin.componant.footer')
