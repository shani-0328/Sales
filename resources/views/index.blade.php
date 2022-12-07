@extends('layout.default')
@section('content')
<div class="container">

    <table class="table table-bordered data-table">

        <thead>

            <tr>

                <th>Id</th>

                <th>Name</th>

                <th>Email</th>
                
                <th>Telephone</th>

                <th>Current Route</th>

                <th width="100px">Action</th>

            </tr>

        </thead>

        <tbody>

        </tbody>

    </table>

</div>

   
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="userDetails" name="userDetails" class="form-horizontal">
                    @csrf
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="form-group">
                        <label for="id" class="col-sm-2 control-label">ID</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="id" name="id" value="" maxlength="50" required="">
                        </div>
                        <label for="frst_nm" class="col-sm-2 control-label">First Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="frst_nm" name="frst_nm" value="" maxlength="50" required="">
                        </div>
                        <label for="eml" class="col-sm-2 control-label">Email Address</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="eml" name="eml" value="" maxlength="50" required="">
                        </div>
                        <label for="t_pn" class="col-sm-2 control-label">Telephone</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="t_pn" name="t_pn" value="" maxlength="50" required="">
                        </div>
                        <label for="t_pn" class="col-sm-2 control-label">JoinDate</label>
                        <div class="col-sm-12">
                            <input type="text" class="date form-control" id="joindate" name="j_date" value="" maxlength="50" required="">
                        </div>

                        <label for="rte" class="col-sm-2 control-label">Current Routes</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="rte" name="rte" value="" maxlength="50" required="">
                        </div>
                        <label for="cmnt" class="col-sm-2 control-label">Comments</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="cmnt" name="cmnt" value="" maxlength="50" required="">
                        </div>
                        <br>
                        <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
   
   
    
    $('body').on('click', '.viewDetails', function () {
        var user_id = $(this).data('id');
        $.get("{{ route('emp_dtls_vw') }}",{id:user_id}, function (data) {
            console.log(data);
            $('#modelHeading').html("View Details");
            $('#saveBtn').attr("hidden",true);
           
            $('#ajaxModel').modal('show');
            $('#id').val(data.Id);
            $('#frst_nm').val(data.FirstName);
            $('#eml').val(data.Email);
            $('#t_pn').val(data.Tele);
            $('#joindate').val(data.JoinDate);
            $('#rte').val(data.WorkingRoute);
            $('#cmnt').val(data.Comments);
           
        })
    });

    $('body').on('click', '.editDetails', function () {
        var user_id = $(this).data('id');
        $.get("{{ route('emp_dtls_vw') }}",{id:user_id}, function (data) {
            console.log(data);
            $('#saveBtn').attr("hidden",false);
            $('#modelHeading').html("Edit Details");
            $('#saveBtn').html("Save");
            $('#saveBtn').val("edit-user");
           
            $('#ajaxModel').modal('show');
            $('#id').val(data.Id);
            $('#frst_nm').val(data.FirstName);
            $('#eml').val(data.Email);
            $('#t_pn').val(data.Tele);
            $('#joindate').val(data.JoinDate);
            $('#rte').val(data.WorkingRoute);
            $('#cmnt').val(data.Comments);
           
        })
    });

    $('body').on('click', '.deleteDetails', function () {
        var user_id = $(this).data('id');
        console.log(user_id);
        var result=confirm("Are you sure ?");
        if(result){
            $.ajax({
                
                url: "{{ url('emp_dtls_dl') }}",
                data:{'id':user_id},
                success: function (data) {
                    table.draw();
                    location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }else{
            return false;
        }
    
    });


    
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
    
        $.ajax({
            data: $('#userDetails').serialize(),
            url: "{{ route('employees.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#userDetails').trigger("reset");
                $('#ajaxModel').modal('hide');
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save');
            }
        });
    });
    
});

$('.date').datepicker({  

format: 'mm-dd-yyyy'

}); 
</script>

<script type="text/javascript">

  $(function () {

    

    var table = $('.data-table').DataTable({

        processing: true,

        serverSide: true,

        ajax: "{{route('employees.index')}}",

        columns: [

            {data: 'Id', name: 'Id'},

            {data: 'FirstName', name: 'FirstName'},

            {data: 'Email', name: 'Email'},

            {data: 'Tele', name: 'Tele'},

            

            {data: 'WorkingRoute', name: 'WorkingRoute'},

            {data: 'action', name: 'action', orderable: false, searchable: false},

        ]

    });

    

  });

</script>


@endsection


