{{-- resources/views/mangas.blade.php --}}
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เลือกมังงะ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
        body {
            background-color: #e9ecef;
        }

        .container {
            margin-top: 50px;
        }

        h1 {
            color: #5a6268;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .card {
            border: 1px solid #007bff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center mb-4">เลือกมังงะ</h1>
        <div class="card">
            @foreach ($mangas as $manga)
            <form action="{{ route('mangas.showVolumes', $manga->id) }}" method="GET" class="mb-3">
                    <h5>{{ $manga->manga_title }}</h5>
                    <button type="submit" class="btn btn-primary">เลือก</button>
                </form>
            @endforeach

        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>
