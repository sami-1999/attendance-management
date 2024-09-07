<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Report</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-responsive {
            margin-top: 2rem;
        }

        .form-container {
            margin-bottom: 2rem;
        }

        .alert {
            margin-bottom: 2rem;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>

<body>

    <div class="container my-5">
        <h1 class="mb-4 text-center">Attendance Report</h1>git
        <!-- Display success message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Import CSV File Form -->
        <div class="form-container">
            <form action="{{ route('attendance.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="attendance_file" class="form-label">Import CSV File</label>
                    <input type="file" class="form-control" id="attendance_file" name="attendance_file" accept=".csv" required>
                </div>
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>

        <!-- Attendance Table -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Name</th>
                        <th>Checkin</th>
                        <th>Checkout</th>
                        <th>Total Working Hours</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attendanceData as $attendance)
                        <tr>
                            <td>{{ $attendance['name'] }}</td>
                            <td>{{ $attendance['checkin'] ?? 'N/A' }}</td>
                            <td>{{ $attendance['checkout'] ?? 'N/A' }}</td>
                            <td>{{ $attendance['total_hours'] ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>
