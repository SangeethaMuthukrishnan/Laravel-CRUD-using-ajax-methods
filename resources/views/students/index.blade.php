@extends('students.layout')
@section('content')



    <!-- AddStudentModal begins -->

    <div class="modal fade" id="AddStudentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <ul id="saveform_errList"></ul>
                    <div class="form-group mb-3">
                        <label for=""> Name</label>
                        <input type="text" class="name form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">email</label>
                        <input type="text" class="email form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Phone</label>
                        <input type="text" class="phone form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Course</label>
                        <input type="text" class="course form-control">
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary add_student">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- AddStudentModal ens here -->



    <!-- EditStudentModal begins -->


    <div class="modal fade" id="EditStudentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit & Update student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <ul id="updateform_errList"></ul>

                    <input type="hidden" id="edit_stud_id">
                    <div class="form-group mb-3">
                        <label for=""> Name</label>
                        <input type="text" id="edit_name" class="name form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">email</label>
                        <input type="text" id="edit_email" class="email form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Phone</label>
                        <input type="text" id="edit_phone" class="phone form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Course</label>
                        <input type="text" id="edit_course" class="course form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary update_student">Update changes</button>
                </div>
            </div>
        </div>
    </div>






    <!-- EditStudentModal ends here-->


    <!-- Delete modal begins-->



    <div class="modal" id="DeleteStudentModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="delete_stud_id">
                    <p>Are sure you want to delete this data?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary delete_student_btn">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>







    <!-- Delete modal ends-->

   <!-- Showing records in the table-->

<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div id="success_message"></div>
            <div class="card">
                <div class="header">
                    <h4>Students Data
                    <a href="#" class="btn btn-primary float-end btn-sm" data-bs-toggle="modal" data-bs-target="#AddStudentModal">Add student</a>
                    </h4>
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Name</th>
                            <th scope="col">email</th>
                            <th scope="col">phone</th>
                            <th scope="col">course</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>




                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<!--table ends here-->



@section('scripts')

    <script>

        $(document).ready(function()
        {
            // fetch method

            fetch_student();

            function fetch_student()
            {
                $.ajax({
                    type:'GET',
                    url:"/fetch-students",
                    dataType:"json",
                    success: function(response)
                    {
                        $('tbody').html(" ");

                        $.each(response.students, function (key, item)
                        {
                            $('tbody').append(
                                '<tr>\
                                <td>'+item.id+'</td>\
                            <td>'+item.name+'</td>\
                            <td>'+item.email+'</td>\
                            <td>'+item.phone+'</td>\
                            <td>'+item.course+'</td>\
                            <td><button type="button" value="'+item.id+'" class="edit_student btn btn-primary btn-sm">Edit</button></td>\
                            <td><button type="button" value="'+item.id+'" class="delete_student btn btn-danger btn-sm">Delete</button></td>\
                        </tr>'
                            );
                        });
                    }
                });
            }
            //fetch method ends here

            //student_delete event starts here

            $(document).on('click','.delete_student', function(e){

                e.preventDefault();
                var stud_id = $(this).val();
                $('#delete_stud_id').val(stud_id);
                $('#DeleteStudentModal').modal('show');

            });

            $(document).on('click','.delete_student_btn',function(e){
                e.preventDefault();

                var stud_id = $('#delete_stud_id').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });


                $.ajax({
                    type:'DELETE',
                    url:"/delete-student/"+stud_id,
                    success: function(response){

                        $('#success_message').addClass('alert alert-danger');
                        $('#success_message').text(response.message);
                        $('#DeleteStudentModal').modal('hide');
                        fetch_student();

                    }

                });

            });

           //delete method ends here

           //student record update_event starts here

            $(document).on('click','.edit_student', function(e)
            {
                e.preventDefault();
                var stud_id = $(this).val();
                $('#EditStudentModal').modal('show');
                $.ajax({
                    type:'GET',
                    url:"/edit-student/"+stud_id,
                    success:function(response)
                    {
                        if(response.status==404)
                        {
                            $('#success_message').html(" ");
                            $('#success_message').addClass('alert alert-danger');
                            $('#success_message').text(response.message);

                        }
                        else
                        {
                            $('#edit_name').val(response.student.name);
                            $('#edit_email').val(response.student.email);
                            $('#edit_phone').val(response.student.phone);
                            $('#edit_course').val(response.student.course);
                            $('#edit_stud_id').val(stud_id);
                        }
                    }
                });
            });
            $(document).on('click','.update_student',function(e)
            {
                e.preventDefault();

                $(this).text("Updating");

                var stud_id=$('#edit_stud_id').val();

                var data = {
                    'name': $('#edit_name').val(),
                    'email': $('#edit_email').val(),
                    'phone': $('#edit_phone').val(),
                    'course': $('#edit_course').val(),
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type:'PUT',
                    url:"/update-student/"+stud_id,
                    data:data,
                    dataType:'json',
                    success: function(response)
                    {
                        if(response.status==400)
                        {
                            $('#updateform_errList').html('');
                            $('#updateform_errList').addClass('alert alert-danger');
                            $.each(response.errors, function (key, err_values)
                            {
                                $('#updateform_errList').append('<li>' + err_values + '<li>')
                            });
                            $('.update_student').text("Update");

                        }

                        else if(response.status==404)
                        {
                            $('#updateform_errList').html(" ");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $('.update_student').text("Update");
                        }

                        else
                        {
                            $('#updateform_errList').html(" ");
                            $('#success_message').html(" ");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);

                            $('#EditStudentModal').modal('hide');
                            $('.update_student').text("Update");
                            fetch_student();
                        }

                    }
                });
            });

            //update student data - ends here

            // adding student data_event starts here

            $(document).on('click','.add_student',function(e){
                e.preventDefault();


                var data={
                    'name': $('.name').val(),
                    'email': $('.email').val(),
                    'phone': $('.phone').val(),
                    'course': $('.course').val(),
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type:'POST',
                    url:'students',
                    data:data,
                    dataType:'json',
                    success: function(response)
                    {
                        if(response.status == 400) {
                            $('#saveform_errList').html('');
                            $('#saveform_errList').addClass('alert alert-danger');
                            $.each(response.errors, function (key, err_values) {
                                $('#saveform_errList').append('<li>' + err_values + '<li>')
                            });
                        }
                        else {

                            $('#saveform_errList').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $('#AddStudentModal').modal('hide');
                            $('#AddStudentModal').find('input').val("");

                            fetch_student();
                        }

                    }
                });


            });
        });

        //add student event ends here
    </script>
@endsection
