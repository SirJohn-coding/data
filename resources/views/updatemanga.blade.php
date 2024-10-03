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
    <link rel="stylesheet" href="{{ asset('css/updatemanga.css') }}">
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
                <h3 class="{{ request()->routeIs('updatemanga.ShowManga') ? 'active' : '' }}">
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

            <!-- เนื้อหาสำหรับแก้ไข -->
            <div class="col-10 content">
                <!-- แสดงวันปัจจุบัน -->
                <div class="d-flex justify-content-end mb-3">
                    <p class="text-muted">วันปัจจุบันคือ {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
                </div>
                <form id="createmanga" action="{{ route('updatemanga.EditManga', ['id' => $mangaResults->id]) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- ส่วนสำหรับอัปโหลดรูปภาพ -->
                        <div class="col-12 col-md-6 upload-container">
                            <div class="mb-3">
                                <h2>รูปปก</h2>
                                <img id="previewImage" src="{{ asset($mangaResults->image) }}" alt="Image preview"
                                    style="max-width: 300px; max-height: 300px; display: block;">
                            </div>
                            <div class="mb-3">
                                <label for="mangaImage" class="form-label">อัปโหลดรูปภาพ</label>
                                <input type="file" class="form-control" id="mangaImage" name="mangaImage"
                                    accept="image/*">
                            </div>
                        </div>

                        <!-- ส่วนสำหรับกรอกข้อมูล -->
                        <div class="col-12 col-md-6">
                            <input type="hidden" name="idmanga" id="idmanga" value="{{ $mangaResults->id }}">

                            <div class="mb-1">
                                <label for="manganame">เรื่องมังงะ:</label>
                                <input type="text" name="manganame" class="form-control"
                                    placeholder="ใส่ชื่อเรื่องมังงะ" id="manganame"
                                    value="{{ $mangaResults->manga_title }}" required>
                            </div>

                            <div class="mb-2">
                                <label for="manga_type">ประเภทมังงะ:</label>
                                <select name="manga_type" class="form-control" required>
                                    <option value="" disabled>เลือกประเภทมังงะ</option>
                                    @foreach ($mangaTypes as $type)
                                        <option value="{{ $type->id }}" {{ $type->id == $mangaResults->Id_type ? 'selected' : '' }}>
                                            {{ $type->tpye_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="publisher">สำนักพิมพ์:</label>
                                <select name="publisher" class="form-control" required>
                                    <option value="" disabled>เลือกสำนักพิมพ์</option>
                                    @foreach ($pubilsher as $pub)
                                        <option value="{{ $pub->id }}" {{ $pub->id == $mangaResults->Id_pubilsher ? 'selected' : '' }}>
                                            {{ $pub->publisher_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="summaryManga">เรื่องย่อ:</label>
                                <textarea name="summaryManga" class="form-control" rows="10"
                                    placeholder="เรื่องย่อมังงะ" id="summaryManga"
                                    required>{{ $mangaResults->manga_story }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- ปุ่มบันทึกและยกเลิก -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-2">บันทึก</button>
                        <button type="button" class="btn btn-danger"
                            onclick="window.location.href='{{ route('viewmanga.show', ['id' => $mangaResults->id]) }}';">ยกเลิก</button>
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