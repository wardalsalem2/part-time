Hello {{ $userName }},

We would like to inform you about the status of your job application.

@if($status === 'pending')
    Your application is currently under review. You have been shortlisted for an interview.
    Please review the status of your application on the company website after 4 days from receiving this message.

@elseif($status === 'accepted')
    Congratulations! You have been selected for an interview.
    We will contact you shortly to schedule a date.

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
