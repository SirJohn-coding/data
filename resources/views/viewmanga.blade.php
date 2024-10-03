<!DOCTYPE html>
<html lang="th">

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
    <link rel="stylesheet" href="{{ asset('css/viewmanga.css') }}">
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
                <h3 class="{{ request()->routeIs('viewmanga.show', 'viewmanga.SearchManga') ? 'active' : '' }}">
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

            <!-- ส่วนเนื้อหา Manga ด้านขวา -->
            <div class="col-10 content">
                <!-- แสดงวันปัจจุบัน -->
                <div class="d-flex justify-content-end mb-3">
                    <p class="text-muted">วันปัจจุบันคือ {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
                </div>
                <div class="manga-details">

                    <!-- ข้อมูลมังงะ  -->
                    <div class="manga-info">
                        @if ($mangaResults)
                            <!-- ชื่อเรื่องมังงะ -->
                            <h1>{{ $mangaResults->manga_title }}</h1>

                            <!-- ภาพปกมังงะ  -->
                            <div class="image-section">
                                <img src="{{ asset($mangaResults->image) }}" width="140" height="170"
                                    alt="{{ $mangaResults->manga_title }}">
                            </div>
                            <br>

                            <!-- ประเภทของมังงะ -->
                            <p><strong>ประเภทมังงะ:</strong> {{ $mangaResults->type->tpye_name }}</p>

                            <!-- ผู้จัดพิมพ์ -->
                            <p><strong>ผู้จัดพิมพ์:</strong> {{ $mangaResults->pubilsher->publisher_name }}</p>

                            <!-- เรื่องย่อ -->
                            <h2>เรื่องย่อ</h2>
                            <p>{{ $mangaResults->manga_story }}</p>

                            <div style="text-align: right;">
                                <a href="{{ route('updatemanga.ShowManga', ['id' => $mangaResults->id]) }}"
                                    class="bi bi-pencil-square" style="color: #0896f5;"> แก้ไขข้อมูล</a>
                                <a href="{{ route('updatemanga.DeleteManga', ['id' => $mangaResults->id]) }}"
                                    class="bi bi-trash" style="color: #e74c3c;"> ลบข้อมูล</a>
                            </div>
                            <hr>
                        @endif
                    </div>
                </div>


                <form id="SearchManga" action="{{ route('viewmanga.SearchManga', ['id' => $mangaResults->id]) }}"
                    method="GET">
                    <div class="row mb-4">
                        <div class="col-auto ms-auto">
                            <input type="number" name="SearchManga" class="form-control"
                                placeholder="ค้นหาเลขเล่มมังงะที่ต้องการ" id="SearchManga" required>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">ค้นหา</button>
                            <a href="{{ route('viewmanga.Addshow', ['id' => $mangaResults->id]) }}"
                                class="btn btn-success">เพิ่มมังงะ</a>
                            <a href="{{ route('viewmanga.show', ['id' => $mangaResults->id]) }}"
                                class="btn btn-warning">มังงะทั้งหมด</a>
                        </div>
                    </div>
                </form>


                <!-- ตรวจสอบว่า $VolumeResults มีข้อมูลหรือไม่ -->
                @if (isset($VolumeResults) && $VolumeResults->count() > 0)
                    <div class="table-container">
                        <table class="table table-bordered text-center">
                            <!-- ใช้ text-center เพื่อจัดข้อความให้อยู่กลาง -->
                            <thead>
                                <tr>
                                    <th>รูปปก</th>
                                    <th>ชื่อเรื่องมังงะ</th>
                                    <th>เล่มที่</th>
                                    <th>ราคาปก</th>
                                    <th>ราคาเช่า</th>
                                    <th>จำนวนเล่ม</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($VolumeResults as $VResults)
                                    <tr class="line">
                                        <td><img src="{{ asset($VResults->image_volume) }}" width="100" height="130"
                                                alt="{{ $VResults->volume_name }}"></td>
                                        <td>{{ $VResults->volume_name }}</td>
                                        <td>{{ $VResults->No_volume }}</td>
                                        <td>{{ $VResults->Price }}</td>
                                        <td>{{ $VResults->Price_Rental }}</td>
                                        <td>{{ $VResults->Amount }}</td>
                                        <td>
                                            <a href="{{ route('updatevolumes.ShowVolumes', ['id' => $VResults->id]) }}"
                                                class="bi bi-pencil-square">
                                                แก้ไขข้อมูล
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $VolumeResults->links() }}
                    </div>
                @else
                    <div class="table-container">
                        <table class="table table-bordered text-center">
                            <!-- ใช้ text-center เพื่อจัดข้อความให้อยู่กลาง -->
                            <thead>
                                <tr>
                                    <th>รูปปก</th>
                                    <th>ชื่อเรื่องมังงะ</th>
                                    <th>เล่มที่</th>
                                    <th>ราคาปก</th>
                                    <th>ราคาเช่า</th>
                                    <th>จำนวนเล่ม</th>>
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
</body>

</html>