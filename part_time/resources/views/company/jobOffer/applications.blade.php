@include('company.component.header')

<div class="container my-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-0">
            <h5 class="mb-0">
                <i class="bi bi-people-fill me-2 text-primary"></i>
                Applicants for: <span class="text-dark">{{ $job->title }}</span>
            </h5>
        </div>
        <div class="card-body">
            @if($applications->count())
                <div class="list-group">
                    @foreach($applications as $app)
                        <div
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center flex-wrap py-3">
                            <div>
                                <h6 class="mb-1">{{ $app->profile->user->name }}</h6>
                                <small class="text-muted">{{ $app->user->email }}</small>
                                <div class="text-muted mt-1"><i class="bi bi-clock me-1"></i> Applied
                                    {{ $app->created_at->diffForHumans() }}
                                </div>
                            </div>
                            <div class="mt-2 mt-md-0">
                                <a href="{{ route('company.applications.show', $app->id) }}"
                                    class="btn btn-outline-primary btn-sm px-4 rounded-pill d-inline-flex align-items-center shadow-sm">
                                    <i class="bi bi-eye me-2"></i> View Details
                                </a>
                                @if($app->cover_letter)
                                    <a href="#" class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal"
                                        data-bs-target="#coverLetterModal-{{ $app->id }}">
                                        <i class="bi bi-file-earmark-text me-1"></i> View Cover Letter
                                    </a>
                                @endif
                                @if($app->resume)
                                    <a href="{{ asset('storage/' . $app->profile->cv_path) }}" target="_blank"
                                        class="btn btn-primary rounded-pill px-4">
                                        View CV
                                    </a>
                                @endif
                            </div>
                        </div>

                        <!-- Modal for Cover Letter -->
                        @if($app->cover_letter)
                            <div class="modal fade" id="coverLetterModal-{{ $app->id }}" tabindex="-1"
                                aria-labelledby="coverLetterModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="coverLetterModalLabel">Cover Letter - {{ $app->user->name }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>{{ $app->cover_letter }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @else
                <div class="alert alert-info mb-0">
                    <i class="bi bi-info-circle me-2"></i> No applicants found for this job offer.
                </div>
            @endif
        </div>
    </div>
</div>


@include('company.component.footer')