@include('admin.componant.header')

<div class="main-panel bg-white">
    <div class="content bg-white">
        <div class="container-fluid bg-white">
            <h1>Edit User</h1>

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>

                <div class="form-group">
                    <label for="role_id">Role</label>
                    <select name="role_id" class="form-control" required>
                        <option value="">Select Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="job_title">Job Title</label>
                    <input type="text" name="job_title" class="form-control" value="{{ $user->profile->job_title ?? '' }}">
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ $user->profile->phone ?? '' }}">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>

            <!-- Go Back Button -->
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary mt-3">Back to Users List</a>
        </div>
    </div>
</div>

@include('admin.componant.footer')
