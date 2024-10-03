<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NekoManga - เพิ่มสำนักพิมพ์/ประเภทมังงะ</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&family=Jacquarda+Bastarda+9&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/pubilsher_type.css') }}">
</head>

<body>
    <!-- แถบด้านบน -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline hover"
                            style="color:white;font-size: 1.0rem;">
                            <img src="{{ asset('imageicon/user.png') }}" alt="Shopping Cart"
                                style="width: 30px; height: 30px;margin-left:6px;">
                            บัญชี</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- แถบด้านข้าง -->
            <div class="col-2 sidebar">
                <h1 class="text-white">NekoManga</h1>
                <br>
                <h3 class="{{ request()->routeIs('manage.Home_Manage') ? 'active' : '' }}">
                    <a href="{{ route('manage.Home_Manage') }}">จัดการบัญชีผู้ใช้</a>
                </h3>
                <br>
                <h3 class="{{ request()->routeIs('searchmanga.Home_SearchManga') ? 'active' : '' }}">
                    <a href="{{ route('searchmanga.Home_SearchManga') }}">จัดการมังงะ</a>
                </h3>
                <br>
                <h3 class="{{ request()->routeIs('ManageOrders.Home_ManageOrders') ? 'active' : '' }}">
                    <a href="{{ route('ManageOrders.Home_ManageOrders') }}">จัดการคำสั่งเช่า</a>
                </h3>
                <br>
                <h3 class="{{ request()->routeIs('Update.Home_Upate') ? 'active' : '' }}">
                    <a href="{{ route('Update.Home_Upate') }}">อัปเดตมังงะ</a>
                </h3>
                <br>
                <h3 class="{{ request()->routeIs('adders.Home_Pubilsher_Type') ? 'active' : '' }}">
                    <a href="{{ route('adders.Home_Pubilsher_Type') }}">สำนักพิมพ์ /<br />ประเภทมังงะ</a>
                </h3>
            </div>

            <div class="col-10 content">
                <!-- แสดงวันปัจจุบัน -->
                <div class="d-flex justify-content-end mb-3">
                    <p class="text-muted">วันปัจจุบันคือ {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
                </div>
                <h3 class="mb-4">เพิ่มประเภทมังงะและสำนักพิมพ์</h3>
                <div class="row">

                    <div class="col-md-6 mb-4">
                        <div class="card p-4">
                            <h5 class="card-title"><i class="bi bi-tags"></i> เพิ่มประเภทมังงะ</h5>
                            <form action="/adders/add-type/{id}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="tpye_name" class="form-label">ชื่อประเภทมังงะ</label>
                                    <input type="text" class="form-control" id="tpye_name" name="tpye_name"
                                        placeholder="กรอกชื่อประเภทมังงะ" required>
                                </div>
                                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-plus-circle"></i>
                                    เพิ่มประเภทมังงะ</button>
                            </form>
                        </div>
                    </div>


                    <div class="col-md-6 mb-4">
                        <div class="card p-4">
                            <h5 class="card-title"><i class="bi bi-building"></i> เพิ่มสำนักพิมพ์</h5>
                            <form action="/adders/add-publisher/{id}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="publisher_name" class="form-label">ชื่อสำนักพิมพ์</label>
                                    <input type="text" class="form-control" id="publisher_name" name="publisher_name"
                                        placeholder="กรอกชื่อสำนักพิมพ์" required>
                                </div>
                                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-plus-circle"></i>
                                    เพิ่มสำนักพิมพ์</button>
                            </form>
                        </div>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(function () {
                var alerts = document.querySelectorAll('.alert');
                alerts.forEach(function (alert) {
                    alert.style.display = 'none';
                });
            }, 3000);
        });
    </script>
</body>

</html>