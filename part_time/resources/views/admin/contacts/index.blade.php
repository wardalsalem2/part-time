@include('admin.componant.header')

<div class="main-panel bg-white">
    <div class="content bg-white">
        <div class="container-fluid bg-white">

            <h2>Contact Messages</h2>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts as $contact)
                        <tr>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->subject }}</td>
                            <td>{{ Str::limit($contact->message, 50) }}</td>
                            <td>
                                <a href="javascript:void(0);" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewMessageModal{{ $contact->id }}">View</a>
                                
                                <!-- Delete button -->
                                <button type="button" class="btn btn-danger btn-sm delete-contact" data-id="{{ $contact->id }}">Delete</button>
                            </td>
                        </tr>

                        <!-- Modal for Viewing Full Message -->
                        <div class="modal fade" id="viewMessageModal{{ $contact->id }}" tabindex="-1" aria-labelledby="viewMessageModalLabel{{ $contact->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewMessageModalLabel{{ $contact->id }}">Message Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <strong>Name:</strong> {{ $contact->name }}<br>
                                        <strong>Email:</strong> {{ $contact->email }}<br>
                                        <strong>Subject:</strong> {{ $contact->subject }}<br>
                                        <strong>Message:</strong> <p>{{ $contact->message }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No contact messages found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $contacts->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

@include('admin.componant.footer')

<!-- SweetAlert2 and JavaScript to confirm deletion -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Bind delete button with SweetAlert2
        const deleteButtons = document.querySelectorAll('.delete-contact');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const contactId = button.getAttribute('data-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This will permanently delete the message.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form for deletion
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = '/admin/contacts/' + contactId;
                        form.innerHTML = `
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        `;
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });
    });
</script>
