<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/csscustom.css') }}" rel="stylesheet">
    <title>ตะกร้าสินค้า</title>
    <link rel="stylesheet" href="{{ asset('css/basket.css') }}">
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

        <div class="cart">
            <form action="{{ route('Basketmanga.list') }}" method="POST">
                @csrf
                <h2>ตะกร้าสินค้า</h2>

                <!-- เช็คว่ามีสินค้าในตะกร้าหรือไม่ -->
                @if (isset($details) && $details->isNotEmpty())
                    @foreach ($details as $detail)
                        <div class="cart-item">
                            <!-- เช็คบ็อกซ์สำหรับเลือกสินค้าที่ต้องการ -->
                            <input type="checkbox" name="selected_items[]" value="{{ $detail->id_volume }}">

                            <!-- ลิงก์ไปยังรายละเอียดสินค้า -->
                            <a href="#">
                                {{-- <img src=" " alt="{{ $detail->volume->volume_name }}"> --}}
                            </a>

                            <!-- รายละเอียดสินค้า: ชื่อสินค้าและราคาเช่า -->
                            <div class="item-details">
                                <p>{{ $detail->volume->volume_name }} เล่ม {{ $detail->volume->No_volume }}</p>
                                <p class="text-red">฿{{ number_format($detail->volume->Price_Rental, 2) }}</span></p>
                            </div>

                            <!-- ปุ่มลบสินค้า -->
                            <a href="{{ route('Basketmanga.DeleteVolumes', $detail->id_volume) }}" class="remove"
                                onclick="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบ?');"><i class="bi bi-trash"></i></a>
                        </div>
                    @endforeach

                    <!-- สรุปยอดรวมที่ต้องชำระ -->
                    <div class="cart-summary">
                        <p>รวม <span class="text-red">฿{{ number_format($details->sum('volume.Price_Rental'), 2) }}</span>
                        </p>
                    </div>
                @else
                    <!-- ข้อความเมื่อไม่มีสินค้าที่เลือกไว้ในตะกร้า -->
                    <p>ไม่มีสินค้าที่เลือกไว้ในตะกร้า</p>
                @endif

                <!-- ปุ่มดำเนินการ: ย้อนกลับและยืนยันการเช่า -->
                <div class="buttons">
                    <a href="{{ url('/HomePage') }}" class="action-btn back-btn">ย้อนกลับ</a>
                    <button class="action-btn confirm-btn" type="submit" {{ isset($details) && $details->isEmpty() ? 'disabled' : '' }}>
                        เช่า
                    </button>
                </div>

            </form>
        </div>
    </div>
</body>

</html>