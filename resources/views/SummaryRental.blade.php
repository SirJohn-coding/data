<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>สรุปรายการเช่า</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/csscustom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/summaryrental.css">
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
        
    <div class="container">

        <div class="rental-summary">
            <h2>สรุปรายการเช่า</h2>


            <div class="rental-info">
            <form action="{{ route('summaryrental.ConfirmRental') }}" method="POST">
    @csrf
    @foreach ($volumes as $volume)
    <div class="rental-item">
        <img src="{{ asset($volume->image_volume) }}" alt="{{ $volume->volume_name }}">
        <div class="item-details">
            <h3>{{ $volume->volume_name }}</h3>
            <p>ราคามังงะ: คิด 10% จากราคาปก</p>
            <p class="price">฿{{ number_format($volume->Price_Rental, 2) }}</p>
        </div>

        <!-- ส่ง id_volume และ total_price สำหรับแต่ละเล่ม -->
        <input type="hidden" name="id_volume[]" value="{{ $volume->id }}">
        <input type="hidden" name="total_price[]" value="{{ $volume->Price_Rental }}">
    </div>
    @endforeach

    <div class="payment-info">
        <label for="rental-quantity"><h2 class="text-blue">เลือกจำนวนวันเช่า 1-7 วัน :</h2></label>
        <input id="rental-quantity" name="rental_days" type="number" min="1" max="7" value="1" required>
        <h2 class="text-blue">วัน</h2>

        <!-- ส่ง id_user_manga ผ่านฟอร์ม -->
        <input type="hidden" name="id_user_manga" value="{{ $user->id }}">

        <h3>ยอดรวม <span class="text-red">฿{{ number_format($total, 2) }}</span></h3>
    </div>

    <div class="buttons">
        <a href="{{ route('Basketmanga.ShowBasket') }}" class="action-btn back-btn">ย้อนกลับ</a>
        <button type="submit" class="action-btn confirm-btn">ยืนยัน</button>
    </div>
    <div class="map">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3826.0222641727078!2d102.81944937479453!3d16.474410284265254!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31228a8eb01c96f3%3A0xf6a47b89e419df87!2z4Lih4Lir4Liy4Lin4Li04LiX4Lii4Liy4Lil4Lix4Lii4LiC4Lit4LiZ4LmB4LiB4LmI4LiZ!5e0!3m2!1sth!2sth!4v1726658150600!5m2!1sth!2sth"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
</form>
            </div>
        </div>
    </div>
</body>

</html>
