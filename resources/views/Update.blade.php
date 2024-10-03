<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NekoManga - อัปเดตมังงะ</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&family=Jacquarda+Bastarda+9&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/update.css') }}">
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
                <h3 class="{{ request()->routeIs('Update.Home_Upate', 'Update.SearchVolumes') ? 'active' : '' }}">
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
                <!-- ค้นหาเล่มมังงะ -->
                <form id="SearchManga" action="{{ route('Update.SearchVolumes') }}" method="GET">
                    <h1 class="text-center">ค้นหามังงะที่ต้องการอัปเดตคืนร้าน NekoManga</h1>
                    <br>
                    <div class="search-bar">
                        <input type="text" name="SearchManga" class="se1 form-control" placeholder="กรอกชื่อเรื่องมังงะ"
                            id="searchManga" required>
                        <input type="number" name="SearchNumber" class="se2 form-control" placeholder="กรอกเลขเล่มมังงะ "
                            id="SearchNumber" required>
                        <button type="submit" class="btn1 btn btn-primary">ค้นหา</button>
                    </div>
                </form>
                <br>
                <!-- แสดงข้อความแจ้งเตือน -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('warning'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('warning') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- ตรวจสอบว่ามีการค้นหาและมีข้อมูลผู้ใช้หรือไม่ -->
                @if (isset($VolumeResults) && $VolumeResults->isNotEmpty())
                    <div class="table-container">
                        <h1 class="text-center">ร้าน NekoManga</h1>
                        <div class="d-flex justify-content-center">
                            @foreach ($VolumeResults as $volume)
                                <img src="{{ asset($volume->image_volume) }}" class="text-center" width="110" height="140"
                                    alt="{{ $volume->volume_name }}">
                            @endforeach
                        </div>
                        <br>
                        <table class="table table-bordered">
                            @foreach ($VolumeResults as $volume)
                                <tr>
                                    <td>เรื่อง</td>
                                    <td>{{ $volume->volume_name }}</td>
                                </tr>
                                <tr>
                                    <td>เล่มที่</td>
                                    <td>{{ $volume->No_volume }}</td>
                                </tr>
                                <tr>
                                    <td>สำนักพิมพ์</td>
                                    <td>{{ $volume->manga->pubilsher->publisher_name }}</td>
                                </tr>
                                <tr>
                                    <td>ประเภท</td>
                                    <td>{{ $volume->manga->type->tpye_name }}</td>
                                </tr>
                                <tr>
                                    <td>ราคาปก</td>
                                    <td>{{ $volume->Price }}</td>
                                </tr>
                                <tr>
                                    <td>ราคาเช่า</td>
                                    <td>{{ $volume->Price_Rental }}</td>
                                </tr>
                            @endforeach
                        </table>

                        <table class="table table-bordered">
                            <tr>
                                <th>จำนวนมังงงะ</th>
                            </tr>
                            <tr>
                                <td>{{ $volume->Amount }}</td>
                            </tr>
                        </table>
                        {{ $VolumeResults->links() }}

                        <!-- ปุ่มจัดการบัญชี -->
                        <div class="button-container">
                            <form action="{{ route('Update.UpdateVolumes', $volume->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">อัปเดตมังงะ</button>
                            </form>

                            <form action="{{ route('Update.Home_Upate') }}" method="get">
                                @csrf
                                <button type="submit" class="btn btn-danger">ยกเลิก</button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info text-center"
                        style="border: 1px solid #b2c9e1; border-radius: 5px; background-color: #f0f8ff; text-align: center;">
                        <img src="{{ asset('images/Neko/TT.png') }}" alt="No Data"
                            style="max-width: 350px; height: auto; margin-bottom: 10px;">
                    </div>

                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(function () {
                var alerts = document.querySelectorAll('.alert');
                alerts.forEach(function (alert) {
                    alert.classList.remove('show');
                });
            }, 3000);
        });
    </script>
</body>

</html>