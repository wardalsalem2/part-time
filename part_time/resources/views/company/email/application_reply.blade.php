Hello {{ $userName }},

We would like to inform you about the status of your job application.

@if($status === 'pending')
You have been shortlisted for interview.
Please check the company's website 4 days after receiving this message.
@elseif($status === 'accepted')
Congratulations! You have been selected for the job.
Please contact the company to begin work

@elseif($status === 'rejected')
    We regret to inform you that your application has not been successful.

    @if($reason)
        Reason for rejection: {{ $reason }}
    @endif

@else
    Current status: {{ $status }}
@endif

Best regards,  
The Recruitment Team.
