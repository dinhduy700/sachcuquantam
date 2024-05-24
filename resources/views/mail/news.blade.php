<html>
<head>
    <title>Thông báo tin tức mới: {{ $news->translation->news_title }}</title>
</head>
<body>
    <h3>Thông báo tin tức mới: {{ $news->translation->news_title }}</h3>

    <p>Xin vui lòng truy cập vào link: <a href="{{ route('news.detail', ['slug' => $news->translation->news_slug]) }}">Tại đây</a></p>

    <p>Nếu bạn muốn bỏ nhận tin, vui lòng nhấn vào link này: <a href="{{ route('subscribes.unsubscribe', ['email' => $email]) }}">Hủy theo dõi</a></p>
</body>
</html>