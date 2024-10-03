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
    <link rel="stylesheet" href="{{ asset('css/createmanga.css') }}">
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
                <h3 class="{{ request()->routeIs('createmanga.Home_CreateManga') ? 'active' : '' }}">
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
                <form id="createmanga" action="{{ route('createmanga.CreateManga') }}" method="POST"
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
                                <input type="text" name="manganame" class="form-control"
                                    placeholder="ใส่ชื่อเรื่องมังงะ" id="manganame" required>
                            </div>

                            <!-- ประเภทมังงะ -->
                            <div class="mb-2">
                                <select name="manga_type" class="form-control" required>
                                    <option value="" disabled selected>เลือกประเภทมังงะ</option>
                                    @foreach ($mangaTypes as $type)
                                        <option value="{{ $type->id }}">{{ $type->tpye_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- สำนักพิมพ์ -->
                            <div class="mb-3">
                                <select name="publisher" class="form-control" required>
                                    <option value="" disabled selected>เลือกสำนักพิมพ์</option>
                                    @foreach ($pubilsher as $pub)
                                        <option value="{{ $pub->id }}">{{ $pub->publisher_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- เรื่องย่อมังงะ -->
                            <div class="mb-4">
                                <textarea name="summaryManga" class="form-control" rows="10" placeholder="เรื่องย่อมังงะ" id="summaryManga"
                                    required></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- ปุ่มบันทึกและยกเลิก -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-2">บันทึก</button>
                        <button type="button" class="btn btn-danger"
                            onclick="window.location.href='/searchmanga';">ยกเลิก</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ดึง element ที่มี id 'mangaImage' (input ชนิด file) และเพิ่ม event listener สำหรับการเปลี่ยนแปลง (change event)
        document.getElementById('mangaImage').addEventListener('change', function(event) {
            // ดึงไฟล์แรกที่ผู้ใช้เลือกจาก input file (event.target.files[0])
            const file = event.target.files[0];

            // ดึง element ที่มี id 'previewImage' (img element สำหรับแสดงภาพพรีวิว)
            const preview = document.getElementById('previewImage');

            // ตรวจสอบว่ามีไฟล์ถูกเลือกหรือไม่
            if (file) {
                // สร้าง object FileReader เพื่ออ่านข้อมูลจากไฟล์ที่เลือก
                const reader = new FileReader();

                // เมื่อ FileReader โหลดไฟล์สำเร็จ จะเรียกฟังก์ชันนี้เพื่อแสดงภาพพรีวิว
                reader.onload = function(e) {
                    // กำหนด src ของรูปภาพพรีวิวให้เป็นผลลัพธ์ของการอ่านไฟล์ (Data URL)
                    preview.src = e.target.result;
                    // แสดงรูปภาพพรีวิว (เปลี่ยน style display เป็น 'block')
                    preview.style.display = 'block';
                };

                // อ่านไฟล์เป็น Data URL (ข้อมูลเบส 64 ที่ใช้แสดงภาพ)
                reader.readAsDataURL(file);
            } else {
                // หากไม่มีไฟล์ถูกเลือก (หรือไฟล์ถูกลบออก), ซ่อนรูปภาพพรีวิว
                preview.src = ''; // ลบ src ของรูปภาพพรีวิว
                preview.style.display = 'none'; // ซ่อนรูปภาพโดยเปลี่ยน display เป็น 'none'
            }
        });
    </script>
</body>

</html>
