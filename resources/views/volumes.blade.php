<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $manga->manga_title ?? 'รายละเอียดมังงะ' }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/csscustom.css') }}" rel="stylesheet">
    <style>
        body {
            /* background-color: #f4f7fa; สีพื้นหลังที่นุ่มนวล */
            color: #333; /* สีตัวอักษรหลัก */
            font-family: 'Arial', sans-serif; /* ฟอนต์ที่เรียบง่าย */
        }

        .container {
            margin-top: 50px; /* ระยะห่างด้านบน */
            max-width: 1200px; /* ความกว้างสูงสุดของคอนเทนเนอร์ */
        }

        .manga-title {
            color: #23a3ff; /* สีฟ้า */
            margin-bottom: 20px;
            text-align: center; /* จัดกลาง */
            font-weight: bold; /* น้ำหนักตัวอักษร */
            font-size: 2.5rem; /* ขนาดตัวอักษร */
        }

        .card {
            background-color: #ffffff;
            border: none; /* เอากรอบออก */
            border-radius: 0.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* เพิ่มเงา */
            transition: box-shadow 0.3s ease; /* นุ่มนวลเมื่อเปลี่ยน */
        }

        .card:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2); /* เงาเมื่อโฮเวอร์ */
        }

        .image-container {
            max-width: 450px; /* เพิ่มความกว้างสูงสุดของรูปภาพ */
            margin-right: 20px; /* ระยะห่างขวาจากรูปภาพ */
            border: 3px solid #23a3ff; /* กรอบสีฟ้า */
            border-radius: 0.5rem; /* มุมมน */
            overflow: hidden; /* ซ่อนส่วนที่เกิน */
        }

        .image-container img {
            width: 100%;
            height: auto; /* รักษาสัดส่วน */
            border-radius: 0.5rem; /* มุมมน */
            object-fit: cover; /* ปรับรูปภาพให้เต็มพื้นที่ */
        }

        .details-container {
            flex: 1;
            text-align: left; /* ข้อความอยู่ด้านซ้าย */
        }

        .volume-select {
            background-color: #e9ecef; /* สีพื้นหลังของฟอร์ม */
            padding: 20px;
            border-radius: 0.5rem;
            margin-top: 20px; /* เพิ่มระยะห่างด้านบน */
        }

        .table th {
            background-color: #23a3ff; /* สีฟ้า */
            color: #ffffff;
            text-align: center; /* จัดกลาง */
        }

        .table td {
            background-color: #f8f9fa; /* สีพื้นหลัง */
            text-align: center; /* จัดกลาง */
        }

        .btn-success {
            background-color: #3d4756; /* สีเข้ม */
            border-color: #3d4756; /* สีเข้ม */
            transition: background-color 0.3s ease; /* นุ่มนวลเมื่อเปลี่ยน */
        }

        .btn-success:hover {
            background-color: #23a3ff; /* สีฟ้าสำหรับ hover */
            border-color: #23a3ff; /* สีฟ้าสำหรับ hover */
        }

        footer {
            text-align: center; /* จัดกลาง */
            margin-top: 40px; /* ระยะห่างด้านบน */
            font-size: 0.9rem; /* ขนาดฟอนต์ */
            color: #a1acbd; /* สีเทา */
        }
        .manga-thumbnail {
            background-color: #ffffff;
            /* สีพื้นหลัง */
            border: 1px solid #ddd;
            /* ขอบของกล่อง */
            border-radius: 8px;
            /* มุมกลม */
            padding: 20px;
            /* ระยะห่างภายใน */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* เงา */
            transition: transform 0.3s;
            /* เพิ่มการเปลี่ยนแปลง */
            margin: 40px;
        }

        .manga-container {
            background-color: #ffffff;
            /* สีพื้นหลัง */
            border: 1px solid #ddd;
            /* ขอบของกรอบ */
            border-radius: 8px;
            /* มุมกลม */
            padding: 40px;
            /* ระยะห่างภายใน */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* เงา */
            margin: 20px auto;
            /* ระยะห่างด้านบนและด้านล่าง */
            width: 80%;

        }
    </style>
</head>

<body>
    <!-- แถบ<head> -->
    <header class="p-3 text-bg" style="background-color:#23a3ff;">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between">
                <!-- ข้อความ "เหมียวง่ะ" อยู่ทางซ้าย -->
                <span class="me-3 text-white" style="font-size: 2.7rem;">Nekomanga</span>

                <!-- กลุ่มค้นหาและลิงค์ตะกร้าอยู่ทางขวา -->
                <div class="d-flex align-items-center">
                    <!-- form searchbar -->
                    <form method="GET" action="{{ url('/Search') }}" style="width: 500px;">
                        <div class="form-group d-flex">
                            <input type="text" name="search" class="form-control" placeholder="ค้นหามังงะ..."
                                style="flex:1;margin-right: 10px;">
                            <button type="submit" class="btn btn-primary">ค้นหา</button>
                        </div>
                    </form>
                    <a href="{{ url('/ShowBasket')}}" class="hover" style="font-size: 1.0rem; margin-left:6px;color:white;text-decoration: none;">
                        <img src="{{ asset('imageicon/shopping-cart.png') }}" alt="Shopping Cart"
                            style="width: 30px; height: 30px; margin-left:6px;">
                        ตะกร้า</a>
                    @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                    
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline hover" style="color:white;font-size: 1.0rem;">
                            <img src="{{ asset('imageicon/user.png') }}" alt="Shopping Cart"style="width: 30px; height: 30px;margin-left:6px;">
                            บัญชี</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline hover" style="color:white;margin-left:5px;">เข้าสู่ระบบ</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline hover" style="color:white;margin-left:5px;">สมัครสมาชิก</a>
                        @endif
                    @endauth
                    @endif
                </div>
            </div>
        </div>
        
    </header>
    <!-- ลิ้ง หน้าแรก ทั้งหมด รายการ FAQ -->
    <div id="container4link">
        <div class="box" style="margin-top:15px;display: inline-flex;"><a href="{{ url('/HomePage')}}" class="hover" id="linkbar">
            <img src="{{ asset('imageicon/homeblack.png') }}" style="height:30px;width:30px; margin-right:5px;"
                    alt="">หน้าแรก</a></div>
        <div class="box" style="margin-top:15px;"><a href="{{ url('/AllmangaPage')}}" id="linkbar" class="hover">
            <img src="{{ asset('imageicon/menu.png') }}" style="height:30px;width:30px; margin-right:5px;"
                    alt="">มังงะทั้งหมด</a></div>
        <div class="box" style="margin-top:15px;"><a href="{{ url('/History')}}" id="linkbar" class="hover">
            <img src="{{ asset('imageicon/clipboard.png') }}" style="height:30px;width:30px; margin-right:5px;"
                    alt="">ประวัติการสั่งซื้อ</a></div>
        <div class="box" style="margin-top:15px;"><a href="FAQ" id="linkbar" class="hover">
            <img src="{{ asset('imageicon/help.png') }}" style="height:30px;width:30px; margin-right:5px;"
                    alt="">FAQ</a></div>
    </div>
    <hr id="new" style="color:#23a3ff;">
        
        <!-- แสดง -->
<div class="manga-container">
    <div class="">
        <div class="">
            <div class="container">
                <section class="row between-xs">
                    <div class="col-xs-12 col-md-8">
                        <h2 style="text-align: center;"><span
                                style="font-size: 32px;"><strong>{{ $manga->manga_title }}</strong></span></h2>
                        <p>&nbsp;</p>
                        <p style="text-align: center;"><span style="font-size: 18px;"><strong>เรื่องย่อ:</strong></span>
                        </p>
                        <p style="text-align: center;"><span style="font-size: 16px;">{{ $manga->manga_story }} </span>
                        </p>
                        <p style="">&nbsp;</p>
                        <p style="text-align: center;"><span style="font-size: 16px;">แนว:
                                {{ $manga->type->tpye_name }}</span></a></span></p>
                        <p style="text-align: center;"><span style="font-size: 16px;">สำนักพิมพ์:
                                {{ $manga->pubilsher->publisher_name }}</span></a></span></p>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <div class="manga-thumbnail">
                            <p style="text-align: center;"><img src="{{ asset( $manga->image) }}"
                                    alt="{{ $manga->manga_title }}" width="211" height="300"></p>
                            <h2 style="text-align: center;"><span
                                    style="font-size: 24px;"><strong>{{ $manga->manga_title }}</strong></span></h2>
                            
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
    <div class="container">
        @if ($manga)
            <!-- <h1 class="manga-title">{{ $manga->manga_title }}</h1>
            <div class="d-flex align-items-start mb-4"> 
                <div class="image-container"> 
                    <img src="{{ asset($manga->image)}}" alt="Cover Image" class="img-fluid">
                </div>
                <div class="details-container">
                    <div class="card p-4"> 
                        <h2>รายละเอียดมังงะ</h2>
                        <p><strong>ประเภท:</strong> {{ $manga->type->type_name ?? 'ไม่พบข้อมูล' }}</p>
                        <p><strong>ผู้แต่ง:</strong> {{ $manga->publisher->publisher_name ?? 'ไม่พบข้อมูล' }}</p>
                        <p><strong>รายละเอียด:</strong> {{ $manga->manga_story }}</p>
                    </div>
                    
                </div>
            </div> -->
            <h2 class="mt-4">รายเล่มทั้งหมด:</h2>
            <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th>ปกหนังสือ</th>
                                <th>หมายเลขตอน</th>
                                <th>ชื่อเล่ม</th>
                                <th>ราคาปก</th>
                                <th>ราคาเช่า</th>
                                <th>สถานะ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($manga->volumes as $volume)
                                <tr>
                                <td><img src="{{asset($volume->image_volume)}}" alt="" style="height:300px;weight:200px;"></td>
                                    <td>{{ $volume->No_volume }}</td>
                                    <td>{{ $volume->volume_name }}</td>
                                    <td>{{ $volume->Price }} บาท</td>
                                    <td>{{ $volume->Price_Rental }} บาท</td>
                                    <td >@if ( $volume->Amount  == 1)
                                           <div class="badge bg-success">พร้อมเช่า</div> 
                                        @else
                                        <div class="badge bg-danger">ไม่พร้อมเช่า</div> 
                                    @endif
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
        @else
            <h1 class="text-center">ไม่พบข้อมูลมังงะ</h1>
        @endif
        
    </div>
    <div class="container">
    <h2 class="mt-4">เลือกเล่ม:</h2>
                    <form action="{{ route('rentals.store') }}" method="POST" class="volume-select mb-4">
                        @csrf
                        <div class="mb-3">
                            <label for="volume" class="form-label">เลือกเล่ม:</label>
                            <select name="Id_volume" id="volume" class="form-select" required>
                                <option value="">-- กรุณาเลือก --</option>
                                @foreach ($manga->volumes as $volume)
                                @if ($volume->Amount  == 1)
                                    <option name="volume" value="{{ $volume->id }}">
                                        {{ $volume->volume_name }} (เล่มที่ {{ $volume->No_volume }})
                                    </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">เพิ่มไปยังการเช่า</button>
                    </form>
                    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>
