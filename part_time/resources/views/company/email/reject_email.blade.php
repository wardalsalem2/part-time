@include('company.component.header')

<div class="container mt-5 mb-5">
    <div class="card shadow-lg rounded-4">
        <div class="card-header bg-danger text-white text-center rounded-top-4">
            <h3>Send Rejection Email</h3>
        </div>
        <div class="card-body p-4">
            <form method="POST" action="{{ route('company.applications.sendRejectEmail', $application->id) }}">
                @csrf
                <div class="form-group mb-3">
                    <label for="reason" class="form-label fw-bold">Reason for Rejection</label>
                    <textarea name="reason" id="reason" class="form-control" rows="4" placeholder="Explain why the application was rejected..." required></textarea>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-danger px-4">Send Email</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('company.component.footer')
