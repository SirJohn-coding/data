<style>
    body {
        margin: 0;
        height: 10%; /* ใช้ความสูงของ viewport เพื่อให้เต็มหน้าจอ */
    }
    #container4link {
        background-color: white; /* ให้ container มีพื้นหลังสีขาว */
        height: 100%; /* ทำให้ยืดเต็มความสูง */
    }
    
</style>
<x-app-layout>
    <div class="py-0 " style="height:max;">
        
    <div id="container4link">
        <div class="box" style="margin-top:15px;"><a href="{{ url('/HomePage')}}" class="hover" id="linkbar"><img
                    src="{{ asset('imageicon/homeblack.png') }}" style="height:30px;width:30; margin-right:5px;"
                    alt="">หน้าแรก</a></div>
        <div class="box" style="margin-top:15px;"><a href="{{ url('/AllmangaPage')}}" id="linkbar"
                class="hover"><img src="{{ asset('imageicon/menu.png') }}"
                    style="height:30px;width:30; margin-right:5px;" alt="">มังงะทั้งหมด</a></div>
                    <div class="box" style="margin-top:15px;"><a href="{{ url('/History')}}" id="linkbar" class="hover">
            <img src="{{ asset('imageicon/clipboard.png') }}" style="height:30px;width:30px; margin-right:5px;"
                    alt="">ประวัติการสั่งซื้อ</a></div>
        <div class="box" style="margin-top:15px;"><a href="FAQ" id="linkbar" class="hover"><img
                    src="{{ asset('imageicon/help.png') }}" style="height:30px;width:30; margin-right:5px;"
                    alt="">FAQ</a></div>
    </div>
</div>
    <hr id="new" style="color:#23a3ff;">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8" style="margin-top:40px;">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h1 class="font-semibold text-gray-800 leading-tight" style="font-size:36;">
                ข้อมูลผู้ใช้
            </h1>
            <div class="mt-4" style="font-size:24;">
                <p><strong>ชื่อ:</strong> {{ Auth::user()->name }}</p>
                <p><strong>อีเมล:</strong> {{ Auth::user()->email }}</p>
                <p><strong>เบอร์โทร:</strong> {{ Auth::user()->Phone }}</p>
                <p><strong>เพศ:</strong> {{ Auth::user()->sex }}</p>
                <p><strong>ที่อยู่:</strong> {{ Auth::user()->Address }}</p>
                <p><strong>สถานะ</strong> 
                @if ( Auth::user()->role )
                แอดมิน
                @else
                ผู้ใช้
                @endif
            </div>
        </div>
    </div>
    
</div>
</x-app-layout>
