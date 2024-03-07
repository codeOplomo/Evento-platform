<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket for {{ $booking->event->title }}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .ticket-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .ticket-header {
            text-align: center;
            margin-bottom: 40px;
        }
        .ticket-info {
            margin-bottom: 20px;
        }
        .ticket-info span {
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="ticket-container">
        <div class="ticket-header">
            <h2>Event Ticket</h2>
            <p>{{ $booking->event->title }}</p>
        </div>
        <div class="ticket-info">
            <p><span>Event Date:</span> {{ $booking->event->event_date->format('F d, Y H:i') }}</p>
            <p><span>Location:</span> {{ $booking->event->location }}</p>
            <p><span>Tickets:</span> {{ $booking->number_of_tickets }}</p>
            <p><span>Booked On:</span> {{ $booking->created_at->format('F d, Y H:i') }}</p>
            <p><span>Current Date:</span> {{ now()->format('F d, Y H:i') }}</p>
        </div>
        <div class="ticket-footer text-center">
            <a href="{{ route('client.tickets.download', $booking->id) }}" class="btn btn-primary">Download PDF</a>
        </div>
    </div>
</div>
</body>
</html>
