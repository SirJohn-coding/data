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
    <link rel="stylesheet" href="{{ asset('css/updatevolumes.css') }}">
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
                <h3 class="{{ request()->routeIs('updatevolumes.ShowVolumes') ? 'active' : '' }}">
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
                <form id="editvolume" action="{{ route('updatevolumes.EditVolumes', $volume->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- ส่วนสำหรับอัปโหลดรูปภาพทางซ้าย -->
                        <div class="col-12 col-md-6 upload-container">
                            <div class="mb-3">
                                <h2>รูปปก</h2>
                                <img id="previewImage" src="{{ asset($volume->image_volume) }}" alt="Image preview"
                                    style="max-width: 300px; max-height: 300px; display: {{ $volume->image_volume ? 'block' : 'none' }};">
                            </div>

                            <div class="mb-3">
                                <label for="mangaImage" class="form-label">อัปโหลดรูปภาพ</label>
                                <input type="file" class="form-control" id="mangaImage" name="mangaImage"
                                    accept="image/*">
                            </div>
                        </div>

                        <!-- ส่วนสำหรับค้นหาและกรอกข้อมูลทางขวา -->
                        <div class="col-12 col-md-6">

                            <div style="text-align: right;">
                                <a href="{{ route('updatevolumes.DeleteVolumes', $volume->id) }}" class="bi bi-trash"
                                    style="color: #e74c3c;"> ลบมังงะ</a>
                            </div>

                            <!-- Hidden input สำหรับ ID มังงะ -->
                            <input type="hidden" name="idmanga" id="idmanga" value="{{ $volume->manga->id }}">

                            <div class="mb-1">
                                <label for="manganame">ID เรื่องมังงะ:</label>
                                <input type="text" name="manganame" class="form-control" id="manganame"
                                    value="{{ $volume->manga->manga_title }}" readonly>
                            </div>

                            <div class="mb-1">
                                <label for="manga_type">ประเภทมังงะ:</label>
                                <input type="text" name="manga_type" class="form-control" id="manga_type"
                                    value="{{ $volume->manga->type->tpye_name }}" readonly>
                            </div>

                            <div class="mb-1">
                                <label for="publisher">สำนักพิมพ์:</label>
                                <input type="text" name="publisher" class="form-control" id="publisher"
                                    value="{{ $volume->manga->pubilsher->publisher_name }}" readonly>
                            </div>

                            <div class="mb-4">
                                <label for="priceManga">ราคาปก:</label>
                                <input type="number" name="priceManga" class="form-control" placeholder="ราคามังงะ"
                                    id="priceManga" value="{{ $volume->Price }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="VolumeManga">เล่มที่:</label>
                                <input type="number" name="VolumeManga" class="form-control" placeholder="หมายเลขเล่ม"
                                    id="VolumeManga" value="{{ $volume->No_volume }}" required>
                            </div>

                            <div class="d-flex justify-content-end">
                                <table class="table table-bordered table-custom"
                                    style="width: 700px; height: 100px; background-color: #f8f9fa;">
                                    <tr>
                                        <th style="text-align: center; vertical-align: middle;">จำนวนมังงะที่เหลือ</th>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;">{{ $volume->Amount }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- ปุ่มบันทึกและยกเลิกและอัปเดตมังงะ -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-2">บันทึก</button>
                        <a href="{{ route('updatevolumes.UpdateVolumes', $volume->id) }}"
                            class="btn btn-success me-2">อัปเดตมังงะ</a>
                        <a href="{{ route('viewmanga.show', $volume->manga->id) }}" class="btn btn-danger">ยกเลิก</a>
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