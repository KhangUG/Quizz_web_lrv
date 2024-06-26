@extends('layout/admin-layout')

@section('space-work')
<h2 class="mb-4">Subjects</h2>
<!-- Button trigger modal -->
<button style="margin-bottom: 3px;" type="button" class="btn btn-primary" data-toggle="modal"
    data-target="#addSubjectModel">
    Add Subject
</button>

<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Subject</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>

        @if(count($subjects) > 0)

        @foreach($subjects as $subject)
        <tr>
            <td>{{ $subject->id }}</td>
            <td>{{ $subject-> subject }}</td>
            <td>
                <button class="btn btn-info editButton" data-id="{{$subject->id }}"
                    data-subject="{{$subject->subject }}" data-toggle="modal"
                    data-target="#editSubjectModel">Edit</button>
            </td>
            <td>
                <button class="btn btn-danger deleteButton" data-id="{{$subject->id }}"
                    data-subject="{{$subject->subject }}" data-toggle="modal"
                    data-target="#deleteSubjectModel">Delete</button>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="4">Subjects not Found!</td>
        </tr>
        @endif

    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="addSubjectModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form id="addSubject" action="">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>Subject:</label>
                    <input type="text" name="subject" placeholder="Enter subject name" class="w-100" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </form>

    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editSubjectModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Subject</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="editSubject" action="">
                @csrf
                <div class="modal-body">
                    <label>Subject:</label>
                    <input type="text" name="subject" id="edit_subject" class="w-100" required>
                    <input type="hidden" name="id" id="edit_subject_id" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Delete Modal -->
<div class="modal fade" id="deleteSubjectModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Delete Subject</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="deleteSubject">
                @csrf
                <div class="modal-body">
                    <p>Are u sure , want to delete ?</p>
                    <input type="hidden" name="id" id="delete_subject_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // up zo data 
    $("#addSubject").submit(function(e) {
        e.preventDefault();


        var formData = $(this).serialize();
        $.ajax({
            url: "{{ route('addSubject') }}",
            type: "POST",
            data: formData,
            success: function(data) {
                if (data.success == true) {
                    location.reload();
                } else {
                    alert(data.msg);
                }
            },

        });
    });

    //edit subject
    // Xử lý sự kiện khi nhấn vào nút chỉnh sửa
    $(".editButton").click(function() {
        // Lấy giá trị id và subject từ các thuộc tính data-id và data-subject
        var subject_id = $(this).attr('data-id');
        var subject = $(this).attr('data-subject');

        // Gán giá trị subject vào trường input có id là edit_subject
        $("#edit_subject").val(subject);

        // Gán giá trị subject_id vào trường input có id là edit_subject_id
        $("#edit_subject_id").val(subject_id);


        $("#editSubject").submit(function(e) {
            e.preventDefault();

            var formData = $(this).serialize();
            $.ajax({
                url: "{{ route('editSubject') }}",
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
        });
    });

    //Delete subject
    $(".deleteButton").click(function() {
        var subject_id = $(this).attr('data-id');
        $("#delete_subject_id").val(subject_id);
    });

    $("#deleteSubject").submit(function(e) {
        e.preventDefault();

        var formData = $(this).serialize();
        
        $.ajax({
            url: "{{ route('deleteSubject') }}",
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
    });


});
</script>

@endsection