<!DOCTYPE html>
<html lang="en">

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
    <link rel="stylesheet" href="{{ asset('css/manageorders.css') }}">
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
                <h3 class="{{ request()->routeIs('manage.Home_Manage', 'manage.search') ? 'active' : '' }}">
                    <a href="{{ route('manage.Home_Manage') }}">จัดการบัญชีผู้ใช้</a>
                </h3>
                <br>
                <h3 class="{{ request()->routeIs('searchmanga.Home_SearchManga') ? 'active' : '' }}">
                    <a href="{{ route('searchmanga.Home_SearchManga') }}">จัดการมังงะ</a>
                </h3>
                <br>
                <h3
                    class="{{ request()->routeIs('ManageOrders.Home_ManageOrders', 'ManageOrders.Search_Orders') ? 'active' : '' }}">
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
                <form id="searchForm" action="{{ route('ManageOrders.Search_Orders') }}" method="GET">
                    <div class="search-bar">
                        <input type="number" name="searchid" class="form-control" placeholder="กรอก ID คำสั่งเช่า"
                            value="{{ request('searchid') }}">
                        <button type="submit" class="btn btn-primary">ค้นหา</button>
                    </div>

                    <!-- Radio Button Order ที่ยังไม่มารับมังงะ -->
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="not-received" value="1"
                            {{ request('status') == '1' ? 'checked' : '' }}>
                        <label class="form-check-label" for="not-received">
                            Order ที่ยังไม่มารับมังงะ
                        </label>
                    </div>

                    <!-- Radio Button Order ที่มารับมังงะแล้ว -->
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="received" value="0"
                            {{ request('status') == '0' ? 'checked' : '' }}>
                        <label class="form-check-label" for="received">
                            Order ที่มารับมังงะแล้ว
                        </label>
                    </div>

                    <!-- Radio Button Order ที่ไม่มารับหนังสือเกิน 3 วัน -->
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="late-received" value="2"
                            {{ request('status') == '2' ? 'checked' : '' }}>
                        <label class="form-check-label" for="late-received">
                            Order ที่ไม่มารับหนังสือเกิน 3 วัน
                        </label>
                    </div>
                </form>

                <hr>


                <div class="table-container">
                    @if ($rentals->isNotEmpty())
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">สถานะ</th>
                                    <th class="text-center">ID Order</th>
                                    <th class="text-center">สั่งเช่าเมื่อ</th>
                                    <th class="text-center">เริ่มเช่า</th>
                                    <th class="text-center">ส่งคืน</th>
                                    <th class="text-center">รายละเอียด</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rentals as $rental)
                                    <tr id="order{{ $rental->id }}">
                                        <td class="text-center">
                                            <form action="{{ route('ManageOrders.Update_Orders') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $rental->id }}">
                                                <input type="hidden" name="update_status" value="0">
                                                <input type="checkbox" name="update_status" value="1"
                                                    onchange="this.form.submit()"
                                                    {{ $rental->date_keep ? 'checked' : '' }}>
                                            </form>
                                        </td>
                                        <td class="text-center">{{ $rental->id }}</td>
                                        <td class="order-date text-center">
                                            {{ \Carbon\Carbon::parse($rental->date_rent)->format('d/m/Y') }}
                                        </td>
                                        <td class="start-date text-center">
                                            {{ $rental->date_keep ? \Carbon\Carbon::parse($rental->date_keep)->format('d/m/Y') : '' }}
                                        </td>
                                        <td class="return-date text-center">
                                            {{ $rental->date_expire ? \Carbon\Carbon::parse($rental->date_expire)->format('d/m/Y') : '' }}
                                        </td>
                                        <td class="text-center">
                                            <a
                                                href="{{ route('OrderDetails.Home_OrderDetails', ['id' => $rental->id]) }}">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- {{ $rentals->links() }} --}}
                    @else
                        <h3 class="text-muted"><b>ไม่พบข้อมูลคำสั่งเช่า</b></h3>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
