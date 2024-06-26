@extends('layout/admin-layout')

@section('space-work')

<h2 class="mb-4">Exam</h2>
<!-- Button trigger modal -->
<button style="margin-bottom: 3px;" type="button" class="btn btn-primary" data-toggle="modal"
    data-target="#addExamtModel">
    Add Exam
</button>

<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Exam Name</th>
            <th>Subject</th>
            <th>Data</th>
            <th>Time</th>
            <th>Attempt</th>
            <th>Add Questions</th>
            <th>Edit</th>
            <th>Delete</th>

        </tr>
    </thead>
    <tbody>

        @if(count($exams) > 0)
        @foreach($exams as $exam)
        <tr>
            <td>{{ $exam->id }}</td>
            <td>{{ $exam->exam_name }}</td>
            <td>
                @if(isset($exam->subjects[0]))
                {{ $exam->subjects[0]['subject'] }}
                @else
                No subject assigned
                @endif
            </td>
            <td>{{ $exam->date }}</td>
            <td>{{ $exam->time }} Hrs</td>
            <td>{{ $exam->attempt }} Time</td>
            <td>
                <a href="#" data-id="{{ $exam->id }}" data-toggle="modal" data-target="#addQnaModel">Add Question</a>
            </td>

            <td>
                <button type="button" class="btn btn-info editButton" data-id="{{ $exam->id }}" data-toggle="modal"
                    data-target="#editExamtModel">
                    Edit
                </button>
            </td>
            <td>
                <button type="button" class="btn btn-danger deleteButton" data-id="{{ $exam->id }}" data-toggle="modal"
                    data-target="#deleteExamtModel">
                    Delete
                </button>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="5">Exams not found!</td>
        </tr>
        @endif
    </tbody>
</table>

<!-- Model -->
<div class="modal fade" id="addExamtModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Exam</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="addExam" action="">
                @csrf
                <div class="modal-body">

                    <input type="text" name="exam_name" placeholder="Enter Exam name" class="w-100" required>
                    <br><br>
                    <select name="subject_id" required class="w-100">
                        <option value="">Select Subject</option>
                        @if(count($subjects) > 0)
                        @foreach($subjects as $subject)
                        <option value="{{ $subject -> id }}">{{ $subject -> subject }}</option>
                        @endforeach
                        @endif
                    </select>

                    <br><br>
                    <input type="date" name="date" class="w-100" required min="@php echo date('Y-m-d'); @endphp">
                    <br><br>
                    <input type="time" name="time" class="w-100" required>
                    <br><br>
                    <input type="number" min="1" name="attempt" placeholder="Enter Exam attempt time" class="w-100"
                        required>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Exam</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Edit Model -->
<div class="modal fade" id="editExamtModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Exam</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="editExam" action="">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="exam_id" id="exam_id">
                    <input type="text" name="exam_name" id="exam_name" placeholder="Enter Exam name" class="w-100"
                        required>
                    <br><br>
                    <select name="subject_id" id="subject_id" required class="w-100">
                        <option value="">Select Subject</option>
                        @if(count($subjects) > 0)
                        @foreach($subjects as $subject)
                        <option value="{{ $subject -> id }}">{{ $subject -> subject }}</option>
                        @endforeach
                        @endif
                    </select>

                    <br><br>
                    <input type="date" name="date" id="date" class="w-100" required
                        min="@php echo date('Y-m-d'); @endphp">
                    <br><br>
                    <input type="time" name="time" id="time" class="w-100" required>
                    <br><br>
                    <input type="number" min="1" id="attempt" name="attempt" placeholder="Enter Exam attempt time"
                        class="w-100" required>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Delete Model -->
<div class="modal fade" id="deleteExamtModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Delete Exam</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="deleteExam" action="">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="exam_id" id="deleteExamId">
                    <p>Are u sure , u want to delete ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Add Answer Model -->
<div class="modal fade" id="addQnaModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Q&A</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="addQna" action="">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="exam_id" id="addExamId">
                    <br><br>
                    <select name="questions" multiple multiselect-search="true" multiselect-select-all="true"
                        onchange="console.log(this.selectedOptions)">
                        <option value="hii">Hii</option>
                        <option value="hii">Hai</option>
                        <option value="hii">kai</option>
                        <option value="hii">tuasd</option>
                        <option value="hii">acasdr</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Q&A</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
$(document).ready(function() {
    // Bắt sự kiện submit của form với id "addExam"
    $("#addExam").submit(function(e) {
        e.preventDefault(); // Ngăn chặn hành động submit mặc định của form

        var formData = $(this).serialize(); // Thu thập dữ liệu từ form và chuyển thành chuỗi

        // Gửi yêu cầu AJAX
        $.ajax({
            url: "{{ route('addExam') }}", // Đường dẫn tới route 'addExam'
            type: "POST", // Phương thức gửi dữ liệu
            data: formData, // Dữ liệu gửi đi
            success: function(data) { // Hàm xử lý khi yêu cầu thành công
                if (data.success == true) {
                    location.reload(); // Tải lại trang nếu thành công
                } else {
                    alert(data.msg); // Hiển thị thông báo lỗi nếu thất bại
                }
            }
        });
    });

    $(".editButton").click(function() {
        var id = $(this).attr('data-id'); // Fix here: $(this) instead of $this
        $("#exam_id").val(id);

        var url = '{{ route("getExamDetail", "id") }}'; // Placeholder for id
        url = url.replace('id', id); // Replace placeholder with actual id

        $.ajax({
            url: url,
            type: "GET",
            success: function(data) {
                if (data.success == true) {
                    var exam = data.data;
                    $("#exam_name").val(exam[0].exam_name);
                    $("#subject_id").val(exam[0].subject_id);
                    $("#date").val(exam[0].date);
                    $("#time").val(exam[0].time);
                    $("#attempt").val(exam[0].attempt);

                } else {
                    alert(data.msg);
                }

            }
        });
    });

    $("#editExam").submit(function(e) {
        e.preventDefault(); // Ngăn chặn hành động submit mặc định của form

        var formData = $(this).serialize(); // Thu thập dữ liệu từ form và chuyển thành chuỗi

        // Gửi yêu cầu AJAX
        $.ajax({
            url: "{{ route('updateExam') }}", // Đường dẫn tới route 'addExam'
            type: "POST", // Phương thức gửi dữ liệu
            data: formData, // Dữ liệu gửi đi
            success: function(data) { // Hàm xử lý khi yêu cầu thành công
                if (data.success == true) {
                    location.reload(); // Tải lại trang nếu thành công
                } else {
                    alert(data.msg); // Hiển thị thông báo lỗi nếu thất bại
                }
            }
        });
    });

    //Delete exam 

    $(document).ready(function() {
        $(".deleteButton").click(function() {
            var id = $(this).attr('data-id');
            $("#deleteExamId").val(id);
        });

        $("#deleteExam").submit(function(e) {
            e.preventDefault(); // Ngăn chặn hành động submit mặc định của form

            var formData = $(this)
                .serialize(); // Thu thập dữ liệu từ form và chuyển thành chuỗi
            $.ajax({
                url: "{{ route('deleteExam') }}",
                type: "POST",
                data: formData, // Dữ liệu gửi đi
                success: function(data) { // Hàm xử lý khi yêu cầu thành công
                    if (data.success == true) {
                        location.reload(); // Tải lại trang nếu thành công
                    } else {
                        alert(data.msg); // Hiển thị thông báo lỗi nếu thất bại
                    }
                }
            });
        });
    });

});
</script>


@endsection