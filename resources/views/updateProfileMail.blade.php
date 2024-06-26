<!DOCTYPE html>
<html lang="en">

<head>

    <title>{{ $data['title'] }}</title>
</head>

<body>
    <table>
        <tr>
            <th>Name</th>
            <th>{{ $data['name'] }}</th>
        </tr>
        <tr>
            <th>Email</th>
            <th>{{ $data['email'] }}</th>
        </tr>

    </table>
    <p> <b>Note:-</b> sử dụng mật khẩu cũ để đăng nhập </p>
    <a href="{{ $data['url'] }}">Click here to login</a>
    <p>thankiiu</p>
</body>

</html>