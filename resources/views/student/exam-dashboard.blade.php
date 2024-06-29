@extends('layout/layout-common')
@section('space-work')
<div class="container">
    <p style="color: black;">Welcome, {{ Auth::user()->name }}</p>
    <h1 class="text-center">{{ $exam[0]['exam_name'] }}</h1>
    <!-- Khởi tạo biến đếm câu hỏi -->
    @php $qcount = 1; @endphp

    @if($success == true)

        <!-- Hiển thị câu hỏi và câu trả lời -->
        @if(count($qna) > 0)
            <form action="{{ route('examSubmit') }}" method="POST" class="mb-5" onsubmit="return isValid()">
                @csrf
                <input type="hidden" name="exam_id" value="{{ $exam[0]['id'] }}">

                @foreach($qna as $data)
                    <div>
                        <h5>Q{{ $qcount }}. {{ $data['question'][0]['question'] }}</h5>
                        <!-- Input ẩn để lưu ID câu hỏi -->
                        <input type="hidden" name="q[]" value="{{ $data['question'][0]['id'] }}">
                        <!-- Input ẩn để lưu ID câu trả lời đã chọn -->
                        <input type="hidden" name="ans_{{ $qcount }}" id="ans_{{ $qcount }}">

                        @php $acount = 1; @endphp
                        <!-- Duyệt qua danh sách câu trả lời -->
                        @foreach($data['question'][0]['answers'] as $answer)
                            <p><b>{{ $acount++ }}).</b> {{ $answer['answer'] }}
                                <!-- Input radio để chọn câu trả lời -->
                                <input type="radio" name="radio_{{ $qcount }}" data-id="{{ $qcount }}" class="select_ans" value="{{ $answer['id'] }}">
                            </p>
                        @endforeach
                    </div>
                    <br>
                    @php $qcount++ @endphp
                @endforeach

                <div class="text-center">
                    <input type="submit" class="btn btn-info">
                </div>
            </form>

        @else
            <h3 style="color:red;" class="text-center">Question and Answers not available!</h3>
        @endif

    @else
        <h3 style="color:red;" class="text-center">{{ $msg }}</h3>
    @endif
</div>

<script>
    $(document).ready(function() {
        // Script jQuery để xử lý sự kiện chọn câu trả lời
        $('.select_ans').click(function() {
            var no = $(this).attr('data-id');
            // Gán giá trị của câu trả lời vào input ẩn
            $('#ans_' + no).val($(this).val());
        });
    });

    function isValid() {
        var result = true;
        var qlength = {{ $qcount }} - 1;
        $('.error_msg').remove();
        for (let i = 1; i <= qlength; i++) {
            if ($('#ans_' + i).val() == "") {
                result = false;
                $('#ans_' + i).parent().append('<span style="color:red;" class="error_msg"> Bạn chưa chọn đáp án , điền bừa còn hơn bỏ sót </span>');
            }
        }
        return result;
    }
</script>
@endsection
