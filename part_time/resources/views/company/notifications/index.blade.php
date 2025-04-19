@include('company.component.header')

<div class="container mt-4">
    <h3 class="mb-4">Notifications</h3>

    @forelse($notifications as $note)
        <div class="card mb-2 {{ $note->is_read ? '' : 'bg-light' }}">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1">{{ $note->message }}</p>
                    <small class="text-muted">{{ $note->created_at->diffForHumans() }}</small>
                </div>
                @if(!$note->is_read)
                <form method="POST" action="{{ route('company.notifications.read', $note->id) }}">
                    @csrf
                    <button class="btn btn-sm btn-primary">Mark as Read</button>
                </form>
                @endif
            </div>
        </div>
    @empty
        <p>No notifications yet.</p>
    @endforelse
</div>

@include('company.component.footer')
