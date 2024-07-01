@extends('layout/admin-layout')


@section('space-work')

<h2 class="mb-4">Students</h2>
<button style="margin-bottom: 3px;" type="button" class="btn btn-primary" data-toggle="modal"
    data-target="#addStudentModel">
    Add Student
</button>

<a href="{{ route('exportStudents') }}" class="btn btn-warning"> Export Students</a>

<table class="table">
    <thead>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Edit</th>
        <th>Delete</th>
    </thead>
    <tbody>
        @if(count($students) > 0)
        @foreach($students as $student)
        <tr>
            <td> {{ $student -> id}} </td>
            <td> {{ $student -> name}} </td>
            <td> {{ $student -> email}} </td>
            <td>
                <button style="margin-bottom: 3px;" type="button" data-id="{{ $student->id }}"
                    data-name="{{ $student->name }}" data-email="{{ $student->email }}" class="btn  btn-info editButton"
                    data-toggle="modal" data-target="#editStudentModel">
                    Edit
                </button>
            </td>

            <td>
                <button style="margin-bottom: 3px;" type="button" data-id="{{ $student->id }}"
                    class="btn  btn-danger deleteButton" data-toggle="modal" data-target="#deleteStudentModel">
                    Delete
                </button>
            </td>

        </tr>

        @endforeach
        @else
        <tr>
            <td colspan="3">Khong co hoc sinh nao </td>
        </tr>
        @endif
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="addStudentModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="addStudent">
                @csrf
                <div class="modal-body ">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="w-100" name="name" placeholder="Enter Student Name" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <input type="text" class="w-100" name="email" placeholder="Enter Email" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span class="error" style="color:red;"></span>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Student</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editStudentModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="editStudent">
                @csrf
                <div class="modal-body ">
                    <div class="row">
                        <div class="col">
                            <input type="hidden" name="id" id="id">
                            <input type="text" class="w-100" name="name" id="name" placeholder="Enter Student Name"
                                required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <input type="text" class="w-100" name="email" id="email" placeholder="Enter Email" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span class="error" style="color:red;"></span>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary updateButton">Update Student</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- delete Modal -->
<div class="modal fade" id="deleteStudentModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Delete Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="deleteStudent">
                @csrf
                <div class="modal-body ">
                    <p>Are you sure you want to delete this student?</p>
                    <input type="hidden" name="id" id="student_id">
                </div>
                <div class="modal-footer">
                    <span class="error" style="color:red;"></span>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    $("#addStudent").submit(function(e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: "{{ route('addStudent') }}",
            type: "POST",
            data: formData,
            success: function(data) {
                if (data.success === true) {
                    location.reload();
                } else {
                    alert(data.msg);
                }
            }
        });
    });

    //Edit btn click and show value
    $(".editButton").click(function(e) {
        $("#id").val($(this).attr('data-id'));
        $("#name").val($(this).attr('data-name'));
        $("#email").val($(this).attr('data-email'));
    });

    //edit student
    $("#editStudent").submit(function(e) {
        e.preventDefault();
        $('.updateButton').prop('disabled', true);

        var formData = $(this).serialize();

        $.ajax({
            url: "{{ route('editStudent') }}",
            type: "POST",
            data: formData,
            success: function(data) {
                if (data.success === true) {
                    location.reload();
                } else {
                    alert(data.msg);
                }
            }
        });
    });

    //delete student
    $(".deleteButton").click(function() {
        var id = $(this).attr('data-id');
        $("#student_id").val(id);
    });

    $("#deleteStudent").submit(function(e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: "{{ route('deleteStudent') }}",
            type: "POST",
            data: formData,
            success: function(data) {
                if (data.success === true) {
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