<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ประวัติการเช่า</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/csscustom.css') }}" rel="stylesheet">
    <style>

        .container {
            margin-top: 50px;
            max-width: 900px;
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
        
    
    <div class="container">
        <h1 class="text-center">ประวัติการเช่ามังงะ</h1>

        <div class="container">
    <h2>ประวัติคำสั่งซื้อ</h2>
    @if($orderDetails->isEmpty())
        <p>ยังไม่มีคำสั่งซื้อในประวัติ</p>
    @else
        @foreach($orderDetails as $id_rental => $details)
            <h3>หมายเลขการเช่า: {{ $id_rental }}</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>รูปภาพ</th>
                        <th>ชื่อเรื่อง</th>
                        <th>ราคาเช่า (Rent Price)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($details as $detail)
                    <tr>
                        <td>
                            <img src="{{($detail->volume->image_volume) }}" alt="รูปภาพมังงะ" width="200" height="300">
                        </td>
                        <td>{{  $detail->volume->volume_name  }}</td>
                        <td>{{ $detail->rent_price }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    @endif
</div>

    </div>

</body>

</html>
