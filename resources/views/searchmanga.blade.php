<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NekoManga - จัดการมังงะ</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&family=Jacquarda+Bastarda+9&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/searchmanga.css') }}">
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
                <h3
                    class="{{ request()->routeIs('searchmanga.Home_SearchManga', 'searchmanga.SearchManga') ? 'active' : '' }}">
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
                
                <form id="SearchManga" action="/searchmanga/search-manga" method="GET"
                    onsubmit="return validateForm();">
                    <div class="search-bar">
                        <input type="text" name="SearchManga" class="form-control"
                            placeholder="กรอกเลข ID มังงะ หรือชื่อเรื่องมังงะ" id="searchManga">
                        <button type="submit" class="btn btn-primary" name="SearchButton">ค้นหา</button>
                        <button type="submit" class="btn btn-warning" name="CreateManga"
                            value="1">มังงะทั้งหมด</button>
                    </div>
                </form>

                <form id="searchBlacklist" action="/createmanga" method="GET" style="display: inline;">
                    <div class="search-bar">
                        <button type="submit" class="btn btn-success" name="CreateManga"
                            value="1">สร้างรายการใหม่</button>
                    </div>
                </form>

                @if (isset($mangaResults) && count($mangaResults) > 0)
                    <div class="table-container">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">รูปเรื่องมังงะ</th>
                                    <th class="text-center">ชื่อมังงะ</th>
                                    <th class="text-center">ประเภทมังงะ</th>
                                    <th class="text-center">สำนักพิมพ์</th>
                                    <th class="text-center">รายละเอียด</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mangaResults as $manga)
                                    <tr>
                                        <td class="text-center"><img src="{{ asset($manga->image) }}" width="100"
                                                height="130" alt="{{ $manga->manga_title }}"></td>
                                        <td class="text-center">{{ $manga->manga_title }}</td>
                                        <td class="text-center">{{ $manga->type->tpye_name }}</td>
                                        <td class="text-center">{{ $manga->pubilsher->publisher_name }}</td>
                                        <td class="text-center"><a
                                                href="{{ route('viewmanga.show', ['id' => $manga->id]) }}">VIEW</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $mangaResults->links() }}
                    </div>
                @else
                    <div class="table-container">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">รูปเรื่องมังงะ</th>
                                    <th class="text-center">ชื่อมังงะ</th>
                                    <th class="text-center">ประเภทมังงะ</th>
                                    <th class="text-center">สำนักพิมพ์</th>
                                    <th class="text-center">รายละเอียด</th>
                                </tr>
                            </thead>
                            <tbody>
                                <td colspan="6">
                                    <h4 class="text-center">ไม่พบข้อมูลมังงะ</h4>
                                </td>
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    alert.classList.remove('show');
                });
            }, 3000);
        });
    </script>

    <script>
        function validateForm() {
            const searchManga = document.getElementById('searchManga').value.trim();
            const createMangaButton = document.querySelector('button[name="CreateManga"]');

            // ตรวจสอบว่าปุ่มที่กดคือปุ่ม "มังงะทั้งหมด" หรือไม่
            if (document.activeElement === createMangaButton) {
                return true; // อนุญาตให้ส่งแบบฟอร์ม
            }

            // ตรวจสอบว่ามีข้อมูลในช่องค้นหาหรือไม่
            if (!searchManga) {
                alert('กรุณาใส่ข้อมูลในช่องค้นหาก่อนทำการค้นหา');
                return false; // ยกเลิกการส่งแบบฟอร์ม
            }
            return true; // อนุญาตให้ส่งแบบฟอร์ม
        }
    </script>
</body>

</html>
