<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-white-100 " >
<img src="{{ asset('images/icon/banner1.png') }}" alt="" style="width: 100%;height:400px;">
    <div style="text-align: center;">
    <div><img src="{{ asset('images/icon/Nekoicon.png') }}" alt="" style="height:300px;width:auto;"></div>
    <!-- <img src="{{ asset('images/banner1.png') }}" alt="" style="width: 100%;height:400px;"> -->
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
    {{ $slot }}
    </div>
</div>
