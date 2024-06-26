@extends('layout/admin-layout')


@section('space-work')

<h2 class="mb-4">Marks</h2>

<table class="table">
    <thead>
        <th>#</th>
        <th>Exam Name</th>
        <th>Marks/Q</th>
        <th>Total Marks</th>
        <th>Passing Marks</th>
        <th>Edit</th>
    </thead>
    <tbody>
        
        @if(count($exams) > 0)
        @php $x = 1; @endphp
            @foreach($exams as $exam)
                <tr>
                    <td>{{ $x++ }}</td>
                    <td>{{ $exam->exam_name }}</td>
                    <td>{{ $exam->marks }}</td>
                    <td>{{ count($exam->getQnaExam) * $exam->marks }}</td>
                    <td>{{ $exam->pass_marks }}</td>
                    <td>
                        <button class="btn btn-primary editMarks" data-id="{{ $exam->id }}" data-pass-marks="{{ $exam->pass_marks }}" data-marks="{{ $exam->marks }}" data-totalq="{{ count($exam->getQnaExam) }}" data-toggle="modal"
                    data-target="#editMarksModel">Edit</button>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="5">Exams not added!</td>
            </tr>
        @endif
    </tbody>
</table>

    <!-- Model -->

<div class="modal fade" id="editMarksModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Marks</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="editMarks" action="">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <label >Marks/Q</label>
                        </div>

                        <div class="col-sm-6">
                            <input type="hidden" name="exam_id" id="exam_id" >
                            <input type="text" 
                                onkeypress="return event.charCode >= 48 && event.charCode <=57 || event.charCode == 46"
                            name="marks" placeholder="Enter Maerks/Q" id="marks" required>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-sm-4">
                            <label >Total Marks</label>
                        </div>

                        <div class="col-sm-6">
                           
                            <input type="text" disabled  placeholder="Total Marks" id="tmarks"  >
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-sm-4">
                            <label >Passing Marks</label>
                        </div>

                        <div class="col-sm-6">
                           <input type="text" 
                                onkeypress="return event.charCode >= 48 && event.charCode <=57 || event.charCode == 46"
                            name="pass_marks" placeholder="Enter Passng Marks" id="pass_marks" required>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Marks</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    var totalQna = 0;

    $('.editMarks').click(function() {
        var exam_id = $(this).attr('data-id');
        var marks = $(this).attr('data-marks');
        var totalq = $(this).attr('data-totalq');

        $('#exam_id').val(exam_id);
        $('#marks').val(marks);
        $('#tmarks').val((marks * totalq).toFixed(1));

        totalQna = totalq;
        $('#pass_marks').val($(this).attr('data-pass-marks'));

    });

    $('#marks').keyup(function() {
        $('#tmarks').val(($(this).val() * totalQna).toFixed(1));
    });

    // Bắt sự kiện khi người dùng nhấn phím và thả phím trong input có id 'pass_marks'
    $('#pass_marks').keyup(function() {
        $('.pass-error').remove();

        // Lấy giá trị từ input có id 'tmarks'
        var tmarks = $('#tmarks').val();
        // Lấy giá trị từ input hiện tại (id 'pass_marks')
        var pmarks = $(this).val();

        // Kiểm tra nếu giá trị trong 'pass_marks' lớn hơn hoặc bằng 'tmarks'
        if (parseFloat(pmarks) >= parseFloat(tmarks)) {
            // Thêm một đoạn văn bản màu đỏ có nội dung 'X' vào phần tử cha của input hiện tại
            $(this).parent().append('<p style="color:red;" class="pass-error">Passing marks will be less than total mark</p>');
            setTimeout(() => {
                $('.pass-error').remove();
            }, 2000);
        }
    });


    $('#editMarks').submit(function(event) {
        event.preventDefault();

        $('.pass-error').remove();

        // Lấy giá trị từ input có id 'tmarks'
        var tmarks = $('#tmarks').val();
        // Lấy giá trị từ input hiện tại (id 'pass_marks')
        var pmarks = $('#pass_marks').val();

        // Kiểm tra nếu giá trị trong 'pass_marks' lớn hơn hoặc bằng 'tmarks'
        if (parseFloat(pmarks) >= parseFloat(tmarks)) {
            // Thêm một đoạn văn bản màu đỏ có nội dung 'X' vào phần tử cha của input hiện tại
            $('#pass_marks').parent().append('<p style="color:red;" class="pass-error">Passing marks will be less than total mark</p>');
            setTimeout(() => {
                $('.pass-error').remove();
            }, 2000);

            return false;
        }

        var formData = $(this).serialize();

        $.ajax({
            url: "{{ route('updateMarks') }}",
            type: "POST",
            data: formData,
            success: function(data) {
                if (data.success == true) {
                    location.reload();
                } else {
                    alert(data.msg);
                }
            },
            error: function(xhr, status, error) {
                alert('An error occurred: ' + xhr.responseText);
            }
        });
    });

});
</script>

@endsection