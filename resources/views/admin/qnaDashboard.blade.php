@extends('layout/admin-layout')

@section('space-work')

<h2 class="mb-4">Q&A</h2>
<!-- Button trigger modal -->
<button style="margin-bottom: 3px;" type="button" class="btn btn-primary" data-toggle="modal"
    data-target="#addQnaModel">
    Add Q&A
</button>

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
                <div class="modal-body">
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
            // Add your else condition code here
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
            <div class="row mt-2 answers">
                <input type="radio" name="is_correct" class="is_correct">
                <div class="col">
                    <input type="text" class="w-100" name="answers[]" placeholder="Enter Answer" required>
                </div>
                <button type="button" class="btn btn-danger btn-sm remove-answer">Remove</button>
            </div>
        `;

            $(".modal-body").append(html);
        }
    });

    // Remove answers
    $(document).on("click", ".remove-answer", function() {
        $(this).parent().remove();
    });
});
</script>

@endsection