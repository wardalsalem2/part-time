@php
    $intro = "We are reaching out regarding the status of your job application.";
@endphp

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Job Application Status</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 30px;">
    <div style="background-color: #ffffff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); max-width: 600px; margin: auto;">
        <p style="font-size: 16px; color: #333;">Dear {{ $userName }},</p>

        <p style="font-size: 16px; color: #333;">{{ $intro }}</p>

        @if($status === 'pending')
            <p style="font-size: 16px; color: #333;">
                We are pleased to inform you that your application for the position 
                <strong>{{ $jobTitle }}</strong> at <strong>{{ $companyName }}</strong> has been shortlisted for an interview.
                Kindly check the company's official website within four days for further instructions and scheduling details.
            </p>
        @elseif($status === 'accepted')
            <p style="font-size: 16px; color: #333;">
                Congratulations! Your application for the position <strong>{{ $jobTitle }}</strong> at <strong>{{ $companyName }}</strong> has been approved, and you have been selected for the position.
                Please get in touch with the company to proceed with the onboarding process.
            </p>
        @elseif($status === 'rejected')
            <p style="font-size: 16px; color: #333;">
                We regret to inform you that your application for the position <strong>{{ $jobTitle }}</strong> at <strong>{{ $companyName }}</strong> has not been successful at this time.
            </p>

            @if($reason)
                <p style="font-size: 16px; color: #333;">
                    <strong>Reason for rejection:</strong> {{ $reason }}
                </p>
            @endif
        @else
            <p style="font-size: 16px; color: #333;">
                Current application status: <strong>{{ ucfirst($status) }}</strong>
            </p>
        @endif

        <p style="font-size: 16px; color: #333;">We appreciate your interest in the position and thank you for applying.</p>

        <p style="font-size: 16px; color: #333;">Best regards,<br><strong>The Recruitment Team</strong></p>
    </div>
</body>
</html>
