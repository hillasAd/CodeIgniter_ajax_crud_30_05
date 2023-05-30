<?= $this->extend('layouts/frontend.php') ?>

<?= $this->section('content') ?>

<!-- Modal Add -->
<div class="modal fade" id="studentAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Students datas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Full Name</label> <span id="error_name" class="text-danger ms-3"></span>
                    <input type="text" class="form-control name" placeholder="Enter the full name">

                    <label>E-mail</label> <span id="error_email" class="text-danger ms-3"></span>
                    <input type="text" class="form-control email" placeholder="Enter e-mail">

                    <label>Phone</label> <span id="error_phone" class="text-danger ms-3"></span>
                    <input type="text" class="form-control phone" placeholder="Enter the number phone">

                    <label>Course</label> <span id="error_course" class="text-danger ms-3"></span>
                    <input type="text" class="form-control course" placeholder="Enter the course ">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success ajax-save">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal EDIT -->
<div class="modal fade" id="studentEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Students edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control id_std" id="id_edit">
                <div class="form-group">
                    <label>Full Name</label> <span id="error_name_e" class="text-danger ms-3"></span>
                    <input type="text" class="form-control name_e" id="name_edit">

                    <label>E-mail</label> <span id="error_email_e" class="text-danger ms-3"></span>
                    <input type="text" class="form-control email_e" id="email_edit">

                    <label>Phone</label> <span id="error_phone_e" class="text-danger ms-3"></span>
                    <input type="text" class="form-control phone_e" id="phone_edit">

                    <label>Course</label> <span id="error_course_e" class="text-danger ms-3"></span>
                    <input type="text" class="form-control course_e" id="course_edit">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success ajax-update">Save changes</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal view -->
<div class="modal fade" id="studentView" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Student view data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" id="id_delete">
                    <h6> ID: <span class="id_view"></span></h6>
                    <h6> Full Name: <span class="name_view"></span></h6>
                    <h6> E-mail: <span class="email_view"></span></h6>
                    <h6> Phone: <span class="phone_view"></span></h6>
                    <h6> Course: <span class="course_view"></span></h6>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark " data-bs-dismiss="modal">OK</button>
                <button type="button" class="btn btn-danger ajax-delete">Delete</button>
            </div>
        </div>
    </div>
</div>

<div class="container">

    <h4 class="text-center">jQuery Ajax CRUD Application - in Code Igniter 4.x</h4>
    <hr>
    <div class="row">
        <div class="col-2">
            <a href="#" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#studentAdd">Add new Student</a>
        </div>
    </div>
    <hr>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Phone</th>
                    <th>Course</th>
                    <th>Created_at</th>
                    <th>Acções</th>
                </tr>
            </thead>
            <tbody class="studentdata">

            </tbody>

        </table>
    </div>
</div>

<?= $this->endSection() ?>


<?= $this->section('scripts') ?>


<script>
    $(document).ready(function() {
        loadStudents();

        //VIEW
        $(document).on('click', '.viewBtn', function() {
            var stud_id = $(this).closest('tr').find('.stud_id').text();
            $('#id_delete').val(stud_id);
            $.ajax({
                method: "POST",
                url: "student/view",
                data: {
                    'stud_id': stud_id
                },
                success: function(response) {

                    $.each(response, function(key, studview) {
                        $('.id_view').text(studview['id']);
                        $('.name_view').text(studview['name']);
                        $('.email_view').text(studview['email']);
                        $('.phone_view').text(studview['phone']);
                        $('.course_view').text(studview['course']);
                        $('#studentView').modal('show');
                    });

                }
            });
        });


        //EDIT

        $(document).on('click', '.editBtn', function() {
            var stud_id = $(this).closest('tr').find('.stud_id').text();
            $.ajax({
                method: "POST",
                url: "student/view",
                data: {
                    'stud_id': stud_id
                },
                success: function(response) {
                    $.each(response, function(key, studview) {
                        $('#id_edit').val(studview['id']);
                        $('#name_edit').val(studview['name']);
                        $('#email_edit').val(studview['email']);
                        $('#phone_edit').val(studview['phone']);
                        $('#course_edit').val(studview['course']);
                        $('#studentEdit').modal('show');
                    });

                }
            });
        });


    });


    function loadStudents() {
        $.ajax({
            method: "GET",
            url: "/getAllStudents",
            success: function(response) {
                $.each(response.students, function(key, value) {
                    $('.studentdata').append('<tr>\
                        <td class="stud_id">' + value['id'] + '</td>\
                        <td>' + value['name'] + '</td>\
                        <td>' + value['email'] + '</td>\
                        <td>' + value['phone'] + '</td>\
                        <td>' + value['course'] + '</td>\
                        <td>' + value['created_at'] + '</td>\
                        <td>\
                            <a href="#" class="badge btn-info viewBtn"> VIEW</a>\
                            <a href="#" class="badge btn-primary editBtn"> EDIT</a>\                           \
                        </td>\
                        </tr>');
                });
            }
        });
    }

    $(document).ready(function() {
        $(document).on('click', '.ajax-save', function() {
            if ($.trim($('.name').val()).length == 0) {
                error_name = 'Please enter full name';
                $('#error_name').text(error_name);
            } else {
                error_name = '';
                $('#error_name').text(error_name);
            }

            if ($.trim($('.email').val()).length == 0) {
                error_email = 'Please enter email';
                $('#error_email').text(error_email);
            } else {
                error_email = '';
                $('#error_email').text(error_email);
            }

            if ($.trim($('.phone').val()).length == 0) {
                error_phone = 'Please enter number phone';
                $('#error_phone').text(error_phone);
            } else {
                error_phone = '';
                $('#error_phone').text(error_phone);
            }

            if ($.trim($('.course').val()).length == 0) {
                error_course = 'Please enter course';
                $('#error_course').text(error_course);
            } else {
                error_course = '';
                $('#error_course').text(error_course);
            }

            if (error_name != '' || error_email != '' || error_phone != '' || error_course != '') {
                return false;
            } else {
                var data = {
                    'name': $('.name').val(),
                    'email': $('.email').val(),
                    'phone': $('.phone').val(),
                    'course': $('.course').val(),
                }
                $.ajax({
                    method: "POST",
                    url: "/ajax-student/store",
                    data: data,
                    success: function(response) {
                        $('#studentAdd').modal('hide');
                        $('#studentAdd').find('input').val('');
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(response.status);
                        $('.studentdata').html("");
                        loadStudents();
                    }
                });
            }

        })

    });


    $(document).ready(function() {
        $(document).on('click', '.ajax-update', function() {
        
            if ($.trim($('.name_e').val()).length == 0) {
                error_name = 'Please enter full name';
                $('#error_name_e').text(error_name);
            } else {
                error_name = '';
                $('#error_name_e').text(error_name);
            }

            if ($.trim($('.email_e').val()).length == 0) {
                error_email = 'Please enter email';
                $('#error_email_e').text(error_email);
            } else {
                error_email = '';
                $('#error_email_e').text(error_email);
            }

            if ($.trim($('.phone_e').val()).length == 0) {
                error_phone = 'Please enter number phone';
                $('#error_phone_e').text(error_phone);
            } else {
                error_phone = '';
                $('#error_phone_e').text(error_phone);
            }

            if ($.trim($('.course_e').val()).length == 0) {
                error_course = 'Please enter course';
                $('#error_course_e').text(error_course);
            } else {
                error_course = '';
                $('#error_course_e').text(error_course);
            }

            if (error_name != '' || error_email != '' || error_phone != '' || error_course != '') {
                return false;
            } else {
     
                var data = {
                    'id_edit': $('#id_edit').val(),
                    'name': $('#name_edit').val(),
                    'email': $('#email_edit').val(),
                    'phone': $('#phone_edit').val(),
                    'course': $('#course_edit').val(),
                }
                $.ajax({
                    method: "POST",
                    url: "/ajax-student/update",
                    data: data,
                    success: function(response) {
                        $('#studentEdit').modal('hide');
                        $('#studentEdit').find('input').val('');
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(response.status);
                        $('.studentdata').html("");
                        loadStudents();
                    }
                });
            }

        })

    });



    $(document).ready(function() {
        $(document).on('click', '.ajax-delete', function() {
            var id_delete=  $('#id_delete').val();
                    
                $.ajax({
                    method: "POST",
                    url: "/ajax-student/delete",
                    data: {'id_delete':id_delete},
                    success: function(response) {
                        $('#studentView').modal('hide');
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(response.status);
                        $('.studentdata').html("");
                        loadStudents();
                    }
                });            
    });

}) 
</script>
<?= $this->endSection() ?>