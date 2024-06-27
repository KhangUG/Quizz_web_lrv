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
            <th>Show Questions</th>
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
                <a href="#" class="addQuestion" data-id="{{ $exam->id }}" data-toggle="modal"
                    data-target="#addQnaModel">Add Question</a>
            </td>

            <td>
                <a href="#" class="seeQuestions" data-id="{{ $exam->id }}" data-toggle="modal"
                    data-target="#seeQnaModel">Show Question</a>
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

<!--Add AQna Model -->
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
                    <input type="search" name="search" id="search" onkeyup="searchTable()" class="w-100"
                        placeholder="Search here">
                    <br><br>
                    <table class="table" id="questionsTable">
                        <thead>
                            <th>Select</th>
                            <th>Question</th>
                        </thead>
                        <tbody class="addBody">


                        </tbody>
                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Q&A</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--show Ques Model -->
<div class="modal fade" id="seeQnaModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Questions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">
                <table class="table">
                    <thead>
                        <th>S.no</th>
                        <th>Question</th>
                        <th>Delete</th>
                    </thead>
                    <tbody class="seeQuestionTable">



                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

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


    //add question vao exam 
    $('.addQuestion').click(function() {
        var id = $(this).attr('data-id');
        $('#addExamId').val(id);

        $.ajax({
            url: "{{ route('getQuestions') }}",
            type: "GET",
            data: {
                exam_id: id
            },
            success: function(data) {
                if (data.success == true) {
                    var questions = data.data;
                    var html = "";
                    if (questions.length > 0) {
                        for (let i = 0; i < questions.length; i++) {
                            html += `
                        <tr> 
                            <td><input type="checkbox" value="` + questions[i]['id'] + `" name="questions_ids[]"></td>
                            <td>` + questions[i]['questions'] + `</td>
                        </tr>
                        `;
                        }
                    } else {
                        html += `
                    <tr> 
                        <td colspan="2">Questions not Available!</td>
                    </tr>`;
                    }
                    $('.addBody').html(html);
                } else {
                    alert(data.msg);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
            }
        });
    });

    //add exam 

    $("#addQna").submit(function(e) {
        e.preventDefault(); // Ngăn chặn hành động submit mặc định của form

        var formData = $(this)
            .serialize(); // Thu thập dữ liệu từ form và chuyển thành chuỗi
        $.ajax({
            url: "{{ route('addQuestions') }}",
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

    // show question 
    $('.seeQuestions').click(function() {
        var id = $(this).attr('data-id');
        $.ajax({
            url: "{{ route('getExamQuestions') }}",
            type: "GET",
            data: {
                exam_id: id
            },
            success: function(data) {
                // console.log(data);
                var html = '';
                var questions = data.data;
                if (questions.length > 0) {
                    for (let i = 0; i < questions.length; i++) {
                        html += `
                            <tr >
                                <td>` + (i + 1) + `</td>
                                <td >` + questions[i]['question'][0]['question'] + `</td> 
                                <td >
                                    <button class="btn btn-danger deleteQuestion"  data-id = "` + questions[i]['id'] +
                            `"> Delete </button>
                                </td> 
                            </tr>
                        `;
                    }

                } else {
                    html += `
                        <tr >
                            <td colspan="1"> Question not avail </td> 
                        </tr>
                    `;
                }

                $('.seeQuestionTable').html(html);
            }
        });
    });

    //delete question dc giao  cho exam

    $(document).on('click', '.deleteQuestion', function() {
        // Lấy id từ thuộc tính data-id của phần tử được click
        var id = $(this).attr('data-id');
        // Lưu đối tượng jQuery của phần tử được click
        var obj = $(this);

        // Kiểm tra xem id có tồn tại hay không
        if (!id) {
            console.error('Không tìm thấy thuộc tính data-id');
            return;
        }

        // Thực hiện yêu cầu AJAX để xóa câu hỏi
        $.ajax({
            url: "{{ route('deleteExamQuestions') }}", // Đường dẫn đến route xử lý yêu cầu xóa
            type: "GET", // Phương thức GET
            data: {
                id: id // Dữ liệu gửi đi bao gồm id của câu hỏi
            },
            success: function(data) {
                // Nếu yêu cầu thành công và data.success là true
                if (data.success) {
                    // Xóa dòng <tr> chứa câu hỏi
                    obj.closest('tr').remove();
                } else {
                    // Hiển thị thông báo lỗi từ server
                    alert(data.msg);
                }
            },
            error: function(xhr, status, error) {
                // Xử lý lỗi nếu yêu cầu AJAX thất bại
                console.error('Lỗi khi xóa câu hỏi:', status, error);
                alert('Đã xảy ra lỗi khi xóa câu hỏi. Vui lòng thử lại sau.');
            }
        });
    });




});
</script>

<script>
function searchTable() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById('search');
    filter = input.value.toUpperCase();
    table = document.getElementById('questionsTable');
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }


}
</script>


@endsection