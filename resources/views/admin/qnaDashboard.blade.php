@extends('layout/admin-layout')


@section('space-work')

<h2 class="mb-4">Q&A</h2>
<!-- Button trigger modal -->
<button style="margin-bottom: 3px;" type="button" class="btn btn-primary" data-toggle="modal"
    data-target="#addQnaModel">
    Add Q&A
</button>

<button style="margin-bottom: 3px;" type="button" class="btn btn-info" data-toggle="modal"
    data-target="#importQnaModel">
    Import Q&A
</button>

<table class="table">
    <thead>
        <th>#</th>
        <th>Question</th>
        <th>Answers</th>
        <th>Edit</th>
        <th>Delete</th>
    </thead>
    <tbody>
        @if(count($questions) > 0)
        @foreach($questions as $question)
        <tr>
            <td> {{ $question -> id}} </td>
            <td> {{ $question -> question}} </td>
            <td>
                <a href="#" class="ansButton" data-id="{{ $question->id }}" data-toggle="modal"
                    data-target="#showAnsModel">Xem đáp án </a>
            </td>
            <td>
                <button class="btn btn-info  editButton" data-id="{{ $question->id }}" data-toggle="modal"
                    data-target="#editQnaModel">Edit</button>
            </td>
            <td>
                <button class="btn btn-danger  deleteButton" data-id="{{ $question->id }}" data-toggle="modal"
                    data-target="#deleteQnaModel">Delete</button>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="3">Khong co cau hoi vaf tra loi nao </td>
        </tr>
        @endif
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="addQnaModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Q&A</h5>
                <button id="addAnswer" class="ml-5 btn btn-info btn-sm">Add Answer</button>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="addQna">
                @csrf
                <div class="modal-body addModalAnswers">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="w-100" name="question" placeholder="Enter Question" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span class="error" style="color:red;"></span>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Q&A</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Show answer Modal -->
<div class="modal fade" id="showAnsModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Show Answers</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <th>#</th>
                        <th>Answers</th>
                        <th>Is Correct</th>
                    </thead>
                    <tbody class="showAnswers ">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <span class="error" style="color:red;"></span>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!--Edit qna Modal -->
<div class="modal fade" id="editQnaModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Q&A</h5>
                <button id="addEditAnswer" class="ml-5 btn btn-info btn-sm">Add Answer</button>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="editQna">
                @csrf
                <div class="modal-body editModelAnswers">
                    <div class="row">
                        <div class="col">
                            <input type="hidden" name="question_id" id="question_id">
                            <input type="text" class="w-100" name="question" id="question" placeholder="Enter Question"
                                required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span class="editError" style="color:red;"></span>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Q&A</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Delete Qna Model -->
<div class="modal fade" id="deleteQnaModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Delete Q&A</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="deleteQna" action="">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="delete_qna_id">
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


<!--Import Qna Model -->
<div class="modal fade" id="importQnaModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Import Q&A</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="importQna" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="file" name="file" id="fileupload" require
                        accept=".csv,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet ,application/vnd.ms.excel">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Import Q&A </button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {

    // Form submission
    $("#addQna").submit(function(e) {
        e.preventDefault();

        if ($(".answers").length < 2) {
            $(".error").text("Please add a minimum of two answers.");
            setTimeout(function() {
                $(".error").text("");
            }, 2000);
        } else {
            var checkIsCorrect = false;

            for (let i = 0; i < $(".is_correct").length; i++) {
                if ($(".is_correct:eq(" + i + ")").prop('checked') == true) {
                    checkIsCorrect = true;
                    $(".is_correct:eq(" + i + ")").val($(".is_correct:eq(" + i + ")").next().find(
                        'input').val());
                }
            }

            if (checkIsCorrect) {
                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('addQna') }}",
                    type: "POST",
                    data: formData,
                    success: function(data) {

                        if (data.success == true) {
                            location.reload();
                        } else {
                            alert(data.msg);
                        }
                    }
                });


            } else {
                $(".error").text("phai chon dap an dung ");
                setTimeout(function() {
                    $(".error").text("");
                }, 2000);
            }


        }
    });

    // Add answers
    $("#addAnswer").click(function() {
        if ($(".answers").length >= 6) {
            $(".error").text("Theem duoc 6 cau tra loi thoi");
            setTimeout(function() {
                $(".error").text("");
            }, 2000);
        } else {
            var html = `
            <div class="row mt-2 answers" style="margin-left: 1px; margin-right: 1px;">
                <input type="radio" name="is_correct" class="is_correct">
                <div class="col">
                    <input type="text" class="w-100" name="answers[]" placeholder="Enter Answer" required>
                </div>
                <button type="button" class="btn btn-danger btn-sm removeButton">Remove</button>
            </div>
        `;

            $(".addModalAnswers").append(html);
        }
    });

    // Remove answers
    $(document).on("click", ".removeButton", function() {
        $(this).parent().remove();
    });

    //Show answer   
    $(".ansButton").click(function() {

        var questions = @json($questions);
        var qid = $(this).attr('data-id');
        var html = '';

        for (let i = 0; i < questions.length; i++) {
            if (questions[i]['id'] == qid) {

                var answersLength = questions[i]['answers'].length;
                for (let j = 0; j < answersLength; j++) {
                    let is_correct = 'No';
                    if (questions[i]['answers'][j]['is_correct'] == 1) {
                        is_correct = 'Yes';
                    }

                    html += `
                        <tr>
                            <td>` + (j + 1) + `</td>
                            <td>` + questions[i]['answers'][j]['answer'] + `</td>
                            <td>` + is_correct + `</td>
                        </tr>
                    `;
                }
                break;
            }

        }

        $('.showAnswers').html(html);

    });

    // Edit update Q&A
    $("#addEditAnswer").click(function() {
        if ($(".editAnswers").length >= 6) {
            $(".editError").text("Theem duoc 6 cau tra loi thoi");
            setTimeout(function() {
                $(".error").text("");
            }, 2000);
        } else {
            var html = `
            <div class="row mt-2 editAnswers ">
                <input type="radio" name="is_correct" class="edit_is_correct">
                <div class="col">
                    <input type="text" class="w-100" name="new_answers[]" placeholder="Enter Answer" required>
                </div>
                <button type="button" class="btn btn-danger btn-sm removeButton">Remove</button>
            </div>
        `;

            $(".editModelAnswers").append(html);
        }
    });

    $(".editButton").click(function() {

        var qid = $(this).attr('data-id');

        $.ajax({
            url: "{{ route('getQnaDetails') }}",
            type: "GET",
            data: {
                qid: qid
            },
            success: function(data) {

                var qna = data.data[0];
                $("#question_id").val(qna['id']);
                $("#question").val(qna['question']);

                $(".editAnswers").remove();
                var html = '';

                for (let i = 0; i < qna['answers'].length; i++) {
                    var checked = '';
                    if (qna['answers'][i]['is_correct'] == 1) {
                        checked = 'checked';
                    }

                    html += `
                        <div class="row mt-2 editAnswers ">
                            <input type="radio" name="is_correct" class="edit_is_correct" ` + checked + `>
                            <div class="col">
                                <input type="text" class="w-100" name="answers[` + qna['answers'][i]['id'] + `]"
                                    placeholder="Enter Answer" value="` + qna['answers'][i]['answer'] + `" required>
                            </div>
                            <button class="btn btn-danger btn-sm removeButton removeAnswer" data-id = "` + qna[
                        'answers'][i]['id'] + `">Remove</button>
                        </div>
                    `;
                }
                $(".editModelAnswers").append(html);
            }
        });

    });

    // update Qna submission
    $("#editQna").submit(function(e) {
        e.preventDefault();

        if ($(".editAnswers").length < 2) {
            $(".editError").text("Please add a miin of two answers.");
            setTimeout(function() {
                $(".editError").text("");
            }, 2000);
        } else {
            var checkIsCorrect = false;

            for (let i = 0; i < $(".edit_is_correct").length; i++) {
                if ($(".edit_is_correct:eq(" + i + ")").prop('checked') == true) {
                    checkIsCorrect = true;
                    $(".edit_is_correct:eq(" + i + ")").val($(".edit_is_correct:eq(" + i + ")").next()
                        .find(
                            'input').val());
                }
            }

            if (checkIsCorrect) {
                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('updateQna') }}",
                    type: "POST",
                    data: formData,
                    success: function(data) {
                        if (data.success == true) {
                            location.reload();
                        } else {
                            alert(data.msg);
                        }
                    }
                });

            } else {
                $(".editError").text("phai chon dap an dung ");
                setTimeout(function() {
                    $(".editError").text("");
                }, 2000);
            }

        }
    });

    //remove Answers
    $(document).on('click', '.removeAnswer', function() {
        var ansId = $(this).attr('data-id');
        $.ajax({
            url: "{{ route('deleteAns') }}",
            type: "GET",
            data: {
                id: ansId
            },
            success: function(data) {
                if (data.success == true) {
                    console.log(data.msg);
                } else {
                    alert(data.msg);
                }
            }
        });
    });


    //delete Q&A
    $('.deleteButton').click(function() {
        var id = $(this).attr('data-id');
        $('#delete_qna_id').val(id);
    });

    $('#deleteQna').submit(function(e) {
        e.preventDefault();

        var formData = $(this).serialize();
        $.ajax({
            url: "{{ route('deleteQna') }}",
            type: "POST",
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.msg);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('An error occurred. Please try again.');
            }
        });
    });

    // Import Qna
    $('#importQna').submit(function(e) {
        e.preventDefault();

        let formData = new FormData(this); // Sử dụng 'this' để tham chiếu đến form hiện tại

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{ route('importQna') }}", // Đảm bảo rằng đường dẫn này đúng
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.msg);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Đã xảy ra lỗi. Vui lòng thử lại.');
            }
        });
    });

});
</script>

@endsection