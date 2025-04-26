@include('admin.componant.header')

<div class="main-panel">
    <div class="content bg-white">
        <div class="container-fluid bg-white">
        
            <h2>Job Offers Management</h2>

            <!-- Filters -->
            <form method="GET" action="{{ route('admin.job_offers.index') }}" class="row mb-4">
                <div class="col-12 col-md-3 mb-2">
                    <select name="status" class="form-control">
                        <option value="">All Statuses</option>
                        <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="col-12 col-md-3 mb-2">
                    <select name="company" class="form-control">
                        <option value="">All Companies</option>
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}" {{ request('company') == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Category Filter as Dropdown -->
                <div class="col-12 col-md-3 mb-2">
                    <select name="category" class="form-control">
                        <option value="">Select Category</option>
                        <option value="IT" {{ request('category') == 'IT' ? 'selected' : '' }}>IT</option>
                        <option value="Marketing" {{ request('category') == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                        <option value="Design" {{ request('category') == 'Design' ? 'selected' : '' }}>Design</option>
                    </select>
                </div>
                <div class="col-12 col-md-3 mb-2">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </form>

            <!-- Job Offers Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="text-truncate">Title</th>
                            <th class="text-truncate">Company</th>
                            <th>Status</th>
                            <th>Category</th>
                            <th>Deadline</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jobOffers as $offer)
                            <tr>
                                <td class="text-truncate">{{ $offer->title }}</td>
                                <td class="text-truncate">{{ $offer->company->name ?? '-' }}</td>
                                <td>
                                    <span class="badge {{ $offer->is_active ? 'badge-success' : 'badge-secondary' }}">
                                        {{ $offer->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="text-truncate">{{ $offer->category ?? 'N/A' }}</td>
                                <td>{{ $offer->deadline ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('admin.job_offers.show', $offer->id) }}" class="btn btn-sm btn-info">Show</a>
                                    
                                    <form method="POST" action="{{ route('admin.job_offers.toggle', $offer->id) }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm {{ $offer->is_active ? 'btn-dark' : 'btn-success' }}">
                                            {{ $offer->is_active ? 'Deactivate' : 'Activate' }}
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.job_offers.destroy', $offer->id) }}" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">No job offers found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $jobOffers->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

@include('admin.componant.footer')