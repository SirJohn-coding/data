
<x-app-layout>
    <!-- <div style="margin:auto;text-align: center;">Admin</div> -->
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8" style="margin-top:40px;">
        <a href="/manage" class="hover">จัดการระบบ</a>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h1 class="font-semibold text-gray-800 leading-tight" style="font-size:36;">
                ข้อมูลผู้ใช้
            </h1>
            <div class="mt-4" style="font-size:24;">
                <p><strong>ชื่อ:</strong> {{ Auth::user()->name }}</p>
                <p><strong>อีเมล:</strong> {{ Auth::user()->email }}</p>
                <p><strong>สถานะ</strong> 
                @if ( Auth::user()->role )
                แอดมิน
                @else
                ผู้ใช้
                @endif
            </p>
            </div>
        </div>
    </div>
    
</div>
</x-app-layout>
