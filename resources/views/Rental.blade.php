<!-- resources/views/rental.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Rental</title>
</head>
<body>
    <h1>Rental ID: {{ $rentalId }}</h1>
    
    <form action="{{ route('rental-details.store') }}" method="POST">
        @csrf
        <!-- เพิ่มฟิลด์ที่จำเป็นสำหรับการเพิ่ม rental_details -->
        <input type="hidden" name="id_rental" value="{{ $rentalId }}">
        <!-- ฟิลด์อื่น ๆ ตามที่จำเป็น เช่น id_user_manga, id_Manga, id_volume, rent_price, total_price, amount_manga -->
        
        <button type="submit">Add to Rental Details</button>
    </form>
</body>
</html>
