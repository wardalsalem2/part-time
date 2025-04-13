@include('admin.componant.header')

<div class="main-panel bg-white">
    <div class="content bg-white">
        <div class="container-fluid bg-white">
        
            <div class="row">
                <!-- Total Users Card -->
                <div class="col-md-3">
                    <div class="card card-stats card-warning">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="la la-users"></i>
                                    </div>
                                </div>
                                <div class="col-7 d-flex align-items-center">
                                    <div class="numbers">
                                        <p class="card-category">Total Users</p>
                                        <h4 class="card-title">{{ $userCount }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Today Users Card -->
                <div class="col-md-3">
                    <div class="card card-stats card-success">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="la la-user-plus"></i>
                                    </div>
                                </div>
                                <div class="col-7 d-flex align-items-center">
                                    <div class="numbers">
                                        <p class="card-category">Users Signed Today</p>
                                        <h4 class="card-title">{{ $todayUsersCount }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Inactive Companies Card -->
                <div class="col-md-3">
                    <div class="card card-stats card-danger">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="la la-building"></i>
                                    </div>
                                </div>
                                <div class="col-7 d-flex align-items-center">
                                    <div class="numbers">
                                        <p class="card-category">Total Companies</p>
                                        <h4 class="card-title">{{ $companyCount }}</h4>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Job Offers Card -->
                <div class="col-md-3">
                    <div class="card card-stats card-primary">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="la la-newspaper-o"></i>
                                    </div>
                                </div>
                                <div class="col-7 d-flex align-items-center">
                                    <div class="numbers">
                                        <p class="card-category">Total Job Offers</p>
                                        <h4 class="card-title">{{ $jobOfferCount }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Most Applied Jobs Table -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Most Applied Jobs</h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Job Title</th>
                                        <th>Company</th>
                                        <th>Applications Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($mostAppliedJobs as $job)
                                    <tr>
                                        <td>{{ $job->title }}</td>
                                        <td>{{ $job->company->name }}</td>
                                        <td>{{ $job->job_applications_count }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Job Applications Status Card -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-stats card-info">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="la la-clock"></i>
                                    </div>
                                </div>
                                <div class="col-7 d-flex align-items-center">
                                    <div class="numbers">
                                        <p class="card-category">Pending Job Applications</p>
                                        <h4 class="card-title">{{ $pendingJobApplications }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-stats card-success">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="la la-check-circle"></i>
                                    </div>
                                </div>
                                <div class="col-7 d-flex align-items-center">
                                    <div class="numbers">
                                        <p class="card-category">Accepted Job Applications</p>
                                        <h4 class="card-title">{{ $acceptedJobApplications }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
    
            </div>

            <div class="d-flex justify-content-between ">
                <div class="card shadow mb-4 col-md-8">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Companies Overview</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area h-100">
                            <canvas id="companyAreaChart"></canvas>
                        </div>
                    </div>
                </div>
                
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Company Status</h6>
                        </div>
                    
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2">
                                <canvas id="companyStatusPieChart"></canvas>
                            </div>
                            <div class="mt-4 text-center small">
                                <span class="mr-2">
                                    <i class="fas fa-circle text-success"></i> Active Companies
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-danger"></i> Inactive Companies
                                </span>
                            </div>
                        </div>
                    </div>
            </div>

            
        </div>
    </div>
</div>

@include('admin.componant.footer')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById("companyStatusPieChart").getContext('2d');
    const companyStatusPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ["Active Companies", "Inactive Companies"],
            datasets: [{
                data: [{{ $activeCompanies }}, {{ $inactiveCompanies }}],
                backgroundColor: ['#1cc88a', '#e74a3b'],
                hoverBackgroundColor: ['#17a673', '#be2617'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: true,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            cutoutPercentage: 0,
        },
    });
</script>


{{------------------ for area chart ---------------------------}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Pie Chart
    const ctx1 = document.getElementById("companyStatusPieChart").getContext('2d');
    const companyStatusPieChart2 = new Chart(ctx1, {
        type: 'pie',
        data: {
            labels: ["Active Companies", "Inactive Companies"],
            datasets: [{
                data: [{{ $activeCompanies }}, {{ $inactiveCompanies }}],
                backgroundColor: ['#1cc88a', '#e74a3b'],
                hoverBackgroundColor: ['#17a673', '#be2617'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: { display: true },
                tooltip: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                }
            }
        },
    });

    // Area Chart
    const ctx2 = document.getElementById("companyAreaChart").getContext('2d');
    const companyAreaChart = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: @json(array_keys($monthlyCompanies)),
            datasets: [{
                label: "New Companies",
                data: @json(array_values($monthlyCompanies)),
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                x: { title: { display: true, text: "Month" } },
                y: { beginAtZero: true, title: { display: true, text: "New Companies" } }
            },
            plugins: {
                legend: { display: true },
                tooltip: { enabled: true }
            }
        }
    });
</script>

