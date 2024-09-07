<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Report</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container my-5">
        <h1 class="mb-4">Attendance Report</h1>

        <a href="{{route('findArrayDuplicateElement')}}">Challange 2</a>

        <!-- Display success message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Import CSV File Form -->
        <form action="{{ route('attendance.upload') }}" method="POST" enctype="multipart/form-data" class="mb-4">
            @csrf
            <div class="mb-3">
                <label for="attendance_file" class="form-label">Import CSV File</label>
                <input type="file" class="form-control" id="attendance_file" name="attendance_file" accept=".csv" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>

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
                    @foreach($attendances as $attendance)
                        <tr>
                            <td>{{ $attendance->employee->name }}</td>
                            <td>{{ $attendance->checkin ?? 'N/A' }}</td>
                            <td>{{ $attendance->checkout ?? 'N/A' }}</td>
                            <td>{{ $attendance->total_hours ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
