<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nekomanga</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/csscustom.css') }}" rel="stylesheet">
    <style>
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
        <div class="box" style="margin-top:15px;"><a href="{{ url('/HomePage')}}" class="hover" id="linkbar"><img
                    src="{{ asset('imageicon/homeblack.png') }}" style="height:30px;width:30; margin-right:5px;"
                    alt="">หน้าแรก</a></div>
        <div class="box" style="margin-top:15px;"><a href="{{ url('/AllmangaPage')}}" id="linkbar" class="hover"><img
                    src="{{ asset('imageicon/menu.png') }}" style="height:30px;width:30; margin-right:5px;"
                    alt="">มังงะทั้งหมด</a></div>
        <div class="box" style="margin-top:15px;"><a href="FAQ" id="linkbar" class="hover"><img
                    src="{{ asset('imageicon/help.png') }}" style="height:30px;width:30; margin-right:5px;"
                    alt="">FAQ</a></div>
    </div>
    <hr id="new" style="color:#23a3ff;">
</body>

</html>
<div style="text-align: center;"><img src="{{ asset($manga->image) }}" alt="{{ $manga->manga_title }}"
        style="height:400px;border-radius: 8px;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);margin:20px;"></div>
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
                            <p style="text-align: center;"><a href="/manga/{{$manga->id}}/volumes"
                                    style="text-align: center;font-size: 18px;">เลือกเช่า</a></p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>