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
    <link rel="stylesheet" href="{{ asset('css/addmanga.css') }}">
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
                <h3 class="{{ request()->routeIs('viewmanga.Addshow') ? 'active' : '' }}">
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
                <form id="createmanga" action="{{ route('addmanga.AddManga') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- ส่วนสำหรับอัปโหลดรูปภาพทางซ้าย -->
                        <div class="col-12 col-md-6 upload-container">

                            <div class="mb-3">
                                <h2>รูปปก</h2>
                                <img id="previewImage" src="" alt="Image preview"
                                    style="max-width: 300px; max-height: 300px; display: none;">
                            </div>

                            <div class="mb-3">
                                <label for="mangaImage" class="form-label">อัปโหลดรูปภาพ</label>
                                <input type="file" class="form-control" id="mangaImage" name="mangaImage"
                                    accept="image/*">
                            </div>
                        </div>

                        <!-- ส่วนสำหรับค้นหาและกรอกข้อมูลทางขวา -->
                        <div class="col-12 col-md-6">
                            <div class="mb-1">
                                <input type="hidden" name="idmanga" id="idmanga" value="{{ $mangaResults->id }}">
                            </div>
                            <br>
                            <div class="mb-1">
                                <input type="text" name="manganame" class="form-control" id="manganame"
                                    value="{{ $mangaResults->manga_title }}" readonly>
                            </div>
                            <br>
                            <div class="mb-1">
                                <input type="text" name="manga_type" class="form-control" id="manga_type"
                                    value="{{ $mangaResults->type->tpye_name }}" readonly>
                            </div>
                            <br>
                            <div class="mb-1">
                                <input type="text" name="publisher" class="form-control" id="publisher"
                                    value="{{ $mangaResults->pubilsher->publisher_name }}" readonly>
                            </div>
                            <br>
                            <div class="mb-4">
                                <input type="number" name="priceManga" class="form-control" rows="10"
                                    placeholder="ราคาปกมังงะ" id="priceManga" required></input>
                            </div>
                            <br>
                            <div class="mb-4">
                                <input type="number" name="VolumeManga" class="form-control" rows="10"
                                    placeholder="เล่มที่" id="VolumeManga" required></input>
                            </div>

                        </div>
                    </div>

                    <!-- ปุ่มบันทึกและยกเลิก -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-2">บันทึก</button>
                        <a href="{{ route('viewmanga.show', ['id' => $mangaResults->id]) }}"
                            class="btn btn-danger">ยกเลิก</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('mangaImage').addEventListener('change', function (event) {
            const file = event.target.files[0];
            const preview = document.getElementById('previewImage');

            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        });
    </script>
</body>

</html>