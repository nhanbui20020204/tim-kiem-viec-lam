<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận phỏng vấn - [WEB SITE HỖ TRỢ SINH VIÊN TÌM KIẾM VIỆC LÀM]</title>
    <link rel="stylesheet" href="style.css">
    <style>
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div style="max-width: 600px; margin: 0 auto;">
        <h1>Công Ty: {{ $data['ten_cong_ty'] }} </h1>
        <p>Kính gửi: Anh / Chị <b>{{ $data['ten_sinh_vien'] }}</b></p>
        <p>Email: <b>{{ $data['email'] }}</b></p>
        <p>Số điện thoại: <b> {{ $data['so_dien_thoai'] }}</b></p>
        <p>Nội dung: <b>{{ $data['noi_dung'] }}</b></p>
        <p>
        <h3>Kính mời quý Anh / Chị tham dự buổi trao đổi đầu vào tại công ty của chúng tôi với thời gian, địa điểm và
            nội dung như sau: </h3>
        </p>
        <p>Thời gian: <b>{{ $data['thoi_gian'] }}</b></p>
        <p>Địa chỉ: <b>{{ $data['dia_chi'] }}</b></p>
        <!-- <p>Facebook : <b>{{ $data['facebook'] }}</b></p> -->
        <p>Website: <b>{{ $data['website'] }}</b></p>
        <p>Vui lòng xác nhận tham gia hoặc không tham gia bằng cách nhấn vào đường link bên dưới.</p>
        <a target="_blank" href="{{ $data->link_dong_y }}"
            style="color: white; font-size: 24px; cursor: pointer;display:inline-block;padding: 5px 10px;background-color: green";>Xác
            nhận tại đây</a>
        <br>
        <a target="_blank" href="{{ $data->link_tu_choi }}"
            style="color: white; font-size: 24px; cursor: pointer;display:inline-block;padding: 5px 10px;background-color: red;">Từ
            chối phỏng vấn</a>
        <p>Mong Anh/Chị thu xếp thời gian và tham dự đúng giờ.</p>
        <p>Trân trọng cảm ơn.</p>
    </div>
</body>

</html>
