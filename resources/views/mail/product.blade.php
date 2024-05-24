<html>
<head>
    <title>Thông báo sản phẩm mới: {{ $product->translation->product_name }}</title>
</head>
<body>
    <h3>Thông báo sản phẩm mới: {{ $product->translation->product_name }}</h3>

    <p>Xin vui lòng truy cập vào link <a href="{{ route('detail', ['slug' => $product->translation->product_slug]) }}">Tại đây</a></p>

    <p>Nếu bạn muốn bỏ nhận tin, vui lòng nhấn vào link này: <a href="{{ route('subscribes.unsubscribe', ['email' => $email]) }}">Hủy theo dõi</a></p>
</body>
</html>