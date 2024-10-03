<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NekoManga - จัดการคำสั่งเช่า</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&family=Jacquarda+Bastarda+9&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/orderdetails.css') }}">
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
                <h3 class="{{ request()->routeIs('OrderDetails.Home_OrderDetails') ? 'active' : '' }}">
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

                <!-- ส่วนของเนื้อหา -->
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <!-- รายละเอียดคำสั่งเช่า -->
                <div class="order-info d-flex justify-content-between align-items-center">
                    @if ($DetailResult->isEmpty())
                        <h5>ไม่มีข้อมูลคำสั่งเช่า</h5>
                    @else
                        <h5>ID Rental : {{ $UserResult->id_rental }} | User : {{ $UserResult->id_user_manga }} -
                            {{ $UserResult->user->name }}
                        </h5>
                        <div class="ms-auto">
                            <a href="{{ route('OrderDetails.CancelOrder', ['id' => $UserResult->id_rental]) }}"
                                class="btn btn-danger"
                                onclick="return confirm('คุณต้องการยกเลิกคำสั่งเช่าของ {{ $UserResult->user->name }} จริงหรือไม่?');">
                                ยกเลิกคำสั่งเช่า
                            </a>
                        </div>
                    @endif
                </div>
                <br>

                <!-- ตารางข้อมูลมังงะในคำสั่งเช่า -->
                <div class="table-container">
                    <table class="table table-bordered text-center">
                        <thead class="table-light">
                            <tr>
                                <th>ลำดับ</th>
                                <th>รหัสมังงะ</th>
                                <th>ชื่อเรื่อง</th>
                                <th>เล่มที่</th>
                                <th>จำนวน</th>
                                <th>ค่าเช่า</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($DetailResult->isEmpty())
                                <tr>
                                    <td colspan="6">ไม่มีข้อมูลมังงะในคำสั่งเช่า</td>
                                </tr>
                            @else
                                @php    $index = 1; @endphp
                                @foreach ($DetailResult as $Detail)
                                    <tr>
                                        <td>{{ $index }}</td>
                                        <td>{{ $Detail->id_Manga }}</td>
                                        <td>{{ $Detail->manga->manga_title }}</td>
                                        <td>{{ $Detail->volume->No_volume }}</td>
                                        <td>1</td>
                                        <td>{{ $Detail->volume->Price_Rental }}</td>
                                    </tr>
                                    @php        $index++; @endphp
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{ $DetailResult->links() }}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>