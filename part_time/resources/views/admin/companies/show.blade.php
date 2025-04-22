@include('admin.componant.header')
<div class="main-panel bg-white">
    <div class="content bg-white">
        <div class="container-fluid bg-white">
            <h2>Company Details: {{ $company->name }}</h2>

            <div class="table-responsive">
                <table class="table table-bordered table-head-bg-light table-bordered-bd-light mt-4">
                    <tr>
                        <th>Company Name</th>
                        <td>{{ $company->name }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $company->description }}</td>
                    </tr>
                    <tr>
                        <th>Industry</th>
                        <td>{{ $company->industry }}</td>
                    </tr>
                    <tr>
                        <th>Website</th>
                        <td><a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a></td>
                    </tr>
                    <tr>
                        <th>Phone Number</th>
                        <td>{{ $company->phone }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $company->email }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $company->address }}</td>
                    </tr>
                    <tr>
                        <th>City</th>
                        <td>{{ $company->city }}</td>
                    </tr>
                    <tr>
                        <th>Number of Employees</th>
                        <td>{{ $company->num_employees }}</td>
                    </tr>
                    <tr>
                        <th>Creation Date</th>
                        <td>{{ $company->created_at->format('d M, Y') }}</td>
                    </tr>
                    <tr>
                        <th>Last Updated</th>
                        <td>{{ $company->updated_at->format('d M, Y') }}</td>
                    </tr>
                </table>
            </div>

            <a href="{{ route('admin.companies.edit', $company->id) }}" class="btn btn-warning">Edit Company</a>
            <a href="{{ route('admin.companies.index') }}" class="btn btn-dark">Back to list</a>

        </div>

        @include('admin.componant.footer')