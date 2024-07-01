<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $data['title'] }}</title>
</head>
<body>
    <p>
        <b>Hi {{ $data['name'] }},</b> Your Exam ({{ $data['exam_name'] }}) review passed,
        so now you can check your Marks.
    </p>
    <a href="{{ $data['url'] }}">Click here to go to the results page.</a>
    <p>Tnak you</p>
</body>
</html>
