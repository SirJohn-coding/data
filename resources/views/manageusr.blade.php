<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NekoManga - จัดการบัญชีผู้ใช้</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&family=Jacquarda+Bastarda+9&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/manageusr.css') }}">
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
                <h3 class="{{ request()->routeIs('manage.show') ? 'active' : '' }}">
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
                @if (isset($user) && $user)
                    <div class="table-container">
                        <h1>ข้อมูลส่วนตัว</h1>
                        <table class="table table-bordered">

                            <tr>
                                <td>เลขสมาชิก</td>
                                <td>{{ $user->id }}</td>
                            </tr>
                            <tr>
                                <td>ชื่อ</td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td>เพศ</td>
                                <td>{{ $user->sex }}</td>
                            </tr>
                            <tr>
                                <td>เบอร์โทร</td>
                                <td>{{ $user->Phone }}</td>
                            </tr>
                            <tr>
                                <td>อีเมล</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td>ที่อยู่</td>
                                <td>{{ $user->Address }}</td>
                            </tr>
                        </table>

                        <table class="table table-bordered">
                            <tr>
                                <th>ประวัติไม่มารับหนังสือ</th>
                            </tr>
                            <tr>
                                <td>{{ $user->Blacklist_count }}</td>
                            </tr>
                        </table>

                        <!-- ปุ่มจัดการบัญชี -->
                        <div class="button-container">
                            <form action="{{ route('user.delete', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">ลบบัญชี</button>
                            </form>

                            <form action="{{ route('user.ban', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-warning">แบนบัญชี</button>
                            </form>

                            <form action="{{ route('user.unban', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">ปลดแบน</button>
                            </form>
                        </div>

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