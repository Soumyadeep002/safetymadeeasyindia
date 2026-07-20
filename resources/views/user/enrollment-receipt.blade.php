<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Receipt — {{ $enrollment->course->course_title ?? 'Training' }}</title>
    <link rel="stylesheet" href="{{ url('assets/css/vendor/bootstrap.min.css') }}">
    <style>
        body { font-family: Arial, sans-serif; color: #222; padding: 24px; max-width: 700px; margin: 0 auto; }
        .receipt-header { border-bottom: 2px solid #578f1e; padding-bottom: 16px; margin-bottom: 24px; }
        .receipt-header h1 { font-size: 1.4rem; color: #578f1e; margin: 0; }
        @media print { .no-print { display: none !important; } }
    </style>
</head>
<body>
    <div class="no-print mb-3">
        <button onclick="window.print()" class="btn btn-success btn-sm">Print / Save PDF</button>
        <a href="{{ route('user.dashboard') }}#tab-enrollments" class="btn btn-outline-secondary btn-sm">Back to Dashboard</a>
    </div>

    <div class="receipt-header">
        <h1>{{ config('app.name') }}</h1>
        <p class="text-muted mb-0">Training Enrollment Confirmation</p>
    </div>

    <p><strong>Receipt #:</strong> ENR-{{ date('Y') }}-{{ str_pad($enrollment->id, 6, '0', STR_PAD_LEFT) }}</p>
    <p><strong>Date:</strong> {{ $enrollment->created_at->format('d M Y, h:i A') }}</p>
    <hr>
    <p><strong>Student:</strong> {{ $enrollment->user->name }}</p>
    <p><strong>Email:</strong> {{ $enrollment->user->email }}</p>
    <hr>
    <p><strong>Training:</strong> {{ $enrollment->course->course_title ?? 'N/A' }}</p>
    <p><strong>Subject:</strong> {{ $enrollment->course->subject ?? '—' }}</p>
    <p><strong>Duration:</strong> {{ $enrollment->course->duration ?? '—' }}</p>
    <hr>
    <p class="text-muted small mb-0">This confirms your enrollment. No payment is required for this registration record.</p>
</body>
</html>
