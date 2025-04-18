<form method="POST" action="{{ route('company.applications.sendRejectEmail', $application->id) }}">
    @csrf
    <div class="form-group">
        <label for="reason">سبب الرفض</label>
        <textarea name="reason" id="reason" class="form-control" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-danger">إرسال الإيميل</button>
</form>
