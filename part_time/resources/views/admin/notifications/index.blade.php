@include('admin.componant.header')
<div class="main-panel bg-white">
    <div class="content bg-white">
        <div class="container-fluid p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4 border">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4 border">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            <h2 class="mb-4">Admin Notifications</h2>

            <div class="alert alert-info">
                There are {{ $unreadCount }} unread notifications
            </div>

            <!-- Notifications table -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Message</th>
                        <th>Notification Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notifications as $notification)
                        <tr>
                            <td>{{ $notification->message }}</td>
                            <td>{{ $notification->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                @if ($notification->is_read)
                                    <span class="badge bg-success">Read</span>
                                @else
                                    <span class="badge bg-warning">Unread</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.notifications.markAsRead', $notification->id) }}"
                                    class="btn btn-sm btn-primary">Mark as Read</a>
                                @if ($notification->company_id)
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @include('admin.componant.footer')