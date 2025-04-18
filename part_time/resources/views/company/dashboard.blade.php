@include('company.component.header')

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <!-- Job Offers Count Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Job Offers</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jobOffersCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-briefcase fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Job Applications Count Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Job Applications</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jobApplicationsCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Accepted Applications Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Accepted Applications</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $acceptedApplications }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Applications Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending Applications</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingApplications }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hourglass-half fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <!-- Pie Chart -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card shadow mb-4 h-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Job Applications Overview</h6>
                </div>
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="chart-pie pt-4 pb-2" style="position: relative; height: 300px;">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small d-flex flex-wrap justify-content-center gap-2">
                        <span class="mr-3"><i class="fas fa-circle" style="color: #36b9cc;"></i> Applied</span>
                        <span class="mr-3"><i class="fas fa-circle" style="color: #1cc88a;"></i> Accepted</span>
                        <span class="mr-3"><i class="fas fa-circle" style="color: #f6c23e;"></i> Pending</span>
                        <span class="mr-3"><i class="fas fa-circle" style="color: #e74a3b;"></i> Rejected</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- End Page Content -->

@include('company.component.footer')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var monthlyEarnings = @json($monthlyEarnings);
    var revenueSources = @json($revenueSources);

    // Area Chart
    var ctxArea = document.getElementById('myAreaChart').getContext('2d');
    var myAreaChart = new Chart(ctxArea, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'Earnings Overview',
                data: monthlyEarnings,
                backgroundColor: 'rgba(78, 115, 223, 0.2)',
                borderColor: 'rgba(78, 115, 223, 1)',
                borderWidth: 2,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    // {{-----------------------------for Revenue Sources  -----------------------------------------}}
    // Pie Chart
    var ctxPie = document.getElementById('myPieChart').getContext('2d');
    var myPieChart = new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: ['Applied', 'Accepted', 'Pending', 'Rejected'],
            datasets: [{
                data: revenueSources,
                backgroundColor: ['#36b9cc', '#1cc88a', '#f6c23e', '#e74a3b'],
                borderWidth: 1,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false // مخفي لأنه ظاهر بالـ HTML تحت
                }
            }
        }
    });


</script>