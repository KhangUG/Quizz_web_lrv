@extends('layout/student-layout')

@section('space-work')

<h2>Exams</h2>

<table class="table">
    <thead>
        <th>#</th>
        <th>Exam Name</th>
        <th>Subject Name</th>
        <th>Date</th>
        <th>Time</th>
        <th>Total Attempt</th>
        <th>Available Attempt</th>
        <th>Copy Link</th>

    </thead>

    <tbody>
        @if(count($exams) > 0)
        @php $count = 1; @endphp
        @foreach($exams as $exam)
        <tr>
            <td>{{ $count++}}</td>
            <td>{{ $exam->exam_name}}</td>
            <td>{{ $exam->subjects[0]['subject']}}</td>
            <td>{{ $exam->date}}</td>
            <td>{{ $exam->time }}Hrs</td>
            <td>{{ $exam->attempt}} Time</td>
            <td></td>
            <td>
                <a href="#" data-code="{{ $exam-> enterance_id}}" class="copy">
                    <i class="fa fa-copy"></i>
                </a>
            </td>

        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="8">No exam Available</td>
        </tr>
        @endif
    </tbody>
</table>

<script>
$(document).ready(function() {

    //tao ra doan ma de student click vao roi lay link ra bai kiem tra
    $('.copy').click(function() {
        // Thêm phần tử span với lớp "copied_text" và nội dung "Copied" vào trước phần tử cha của phần tử bị nhấn
        $(this).parent().prepend('<span class="copied_text">Copied</span>');

        // Lấy giá trị của thuộc tính data-code từ phần tử bị nhấn và lưu vào biến code
        var code = $(this).attr('data-code');
        // Tạo URL của bài thi bằng cách nối URL gốc với "/exam/" và mã của bài thi
        var url = "{{ URL::to('/') }}/exam/" + code;

        // Tạo một phần tử input tạm thời
        var $temp = $("<input>");
        // Thêm phần tử này vào body của tài liệu
        $("body").append($temp);
        // Đặt giá trị của phần tử input là URL và chọn giá trị đó
        $temp.val(url).select();
        // Sao chép giá trị được chọn vào clipboard
        document.execCommand("copy");
        // Loại bỏ phần tử input tạm thời
        $temp.remove();

        // Sử dụng setTimeout để đợi 1 giây (1000ms)
        setTimeout(() => {
            // Sau 1 giây, xóa phần tử span có lớp "copied_text" đã thêm ở trên
            $('.copied_text').remove();
        }, 1000);
    });
});
</script>

@endsection