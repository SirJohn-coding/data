<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/csscustom.css') }}" rel="stylesheet">
    <title>Nekomanga</title>
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
                    <a href="{{ url('/ShowBasket') }}" class="hover"
                        style="font-size: 1.0rem; margin-left:6px;color:white;text-decoration: none;">
                        <img src="{{ asset('imageicon/shopping-cart.png') }}" alt="Shopping Cart"
                            style="width: 30px; height: 30px; margin-left:6px;">
                        ตะกร้า</a>
                    @if (Route::has('login'))
                        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                            @auth

                                <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline hover"
                                    style="color:white;font-size: 1.0rem;">
                                    <img src="{{ asset('imageicon/user.png') }}"
                                        alt="Shopping Cart"style="width: 30px; height: 30px;margin-left:6px;">
                                    บัญชี</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm text-gray-700 underline hover"
                                    style="color:white;margin-left:5px;">เข้าสู่ระบบ</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline hover"
                                        style="color:white;margin-left:5px;">สมัครสมาชิก</a>
                                @endif
                            @endauth
                    @endif
                </div>
            </div>
        </div>

    </header>
    <!-- ลิ้ง หน้าแรก ทั้งหมด รายการ FAQ -->
    <div id="container4link">
        <div class="box" style="margin-top:15px;display: inline-flex;"><a href="{{ url('/HomePage') }}"
                class="hover" id="linkbar">
                <img src="{{ asset('imageicon/homeblack.png') }}" style="height:30px;width:30px; margin-right:5px;"
                    alt="">หน้าแรก</a></div>
        <div class="box" style="margin-top:15px;"><a href="{{ url('/AllmangaPage') }}" id="linkbar"
                class="hover">
                <img src="{{ asset('imageicon/menu.png') }}" style="height:30px;width:30px; margin-right:5px;"
                    alt="">มังงะทั้งหมด</a></div>
        <div class="box" style="margin-top:15px;"><a href="{{ url('/History') }}" id="linkbar" class="hover">
                <img src="{{ asset('imageicon/clipboard.png') }}" style="height:30px;width:30px; margin-right:5px;"
                    alt="">ประวัติการสั่งซื้อ</a></div>
        <div class="box" style="margin-top:15px;"><a href="FAQ" id="linkbar" class="hover">
                <img src="{{ asset('imageicon/help.png') }}" style="height:30px;width:30px; margin-right:5px;"
                    alt="">FAQ</a></div>
    </div>
    <hr id="new" style="color:#23a3ff;">
    <div style="text-align: center;">
        <strong style="font-size:86px;">FAQ</strong>
    </div>

    <!-- คำถามที่ 1 -->
    <div
        style="padding: 15px; width: 70%; margin: 0 auto; border-radius: 5px; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.1);">
        <b>
            <h1>Q: คิดราคาค่าเช่าอย่างไร?</h1>
        </b><br>
        <b>
            <h3>A: ราคามังงะคิดที่ 10% ของราคาปก เช่น มังงะราคา 100 บาท จะคิดค่าเช่า 10 บาท</h3>
        </b>
    </div>

    <!-- คำถามที่ 2 -->
    <div
        style="padding: 15px; width: 70%; margin: 20px auto; border-radius: 5px; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.1);">
        <b>
            <h1>Q: ระยะเวลาในการเช่ามังงะคือเท่าไร?</h1>
        </b><br>
        <b>
            <h3>A: ลูกค้าสามารถเช่ามังงะได้เป็นระยะเวลา 1-7 วัน หากเกินกำหนดจะมีค่าปรับเพิ่มตามแต่ละวัน</h3>
        </b>
    </div>

    <!-- คำถามที่ 3 -->
    <div
        style="padding: 15px; width: 70%; margin: 20px auto; border-radius: 5px; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.1);">
        <b>
            <h1>Q: หากคืนมังงะช้าจะมีค่าปรับเท่าไร?</h1>
        </b><br>
        <b>
            <h3>A: ค่าปรับการคืนมังงะช้าคือ 5 บาทต่อวันต่อเล่ม</h3>
        </b>
    </div>

    <!-- คำถามที่ 4 -->
    <div
        style="padding: 15px; width: 70%; margin: 20px auto; border-radius: 5px; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.1);">
        <b>
            <h1>Q: มังงะเสียหายระหว่างการเช่าต้องทำอย่างไร?</h1>
        </b><br>
        <b>
            <h3>A: หากมังงะเสียหายระหว่างการเช่า ผู้เช่าจะต้องรับผิดชอบค่าเสียหายตามราคาปกมังงะ</h3>
        </b>
    </div>

    <!-- คำถามที่ 5 -->
    <div
        style="padding: 15px; width: 70%; margin: 20px auto; border-radius: 5px; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.1);">
        <b>
            <h1>Q: มีวิธีการชำระเงินอย่างไรบ้าง?</h1>
        </b><br>
        <b>
            <h3>A: เรารับชำระเงินผ่านการโอนเงินหรือเงินสด เมื่อมารับมังงะที่ร้าน</h3>
        </b>
    </div>

</body>

</html>
