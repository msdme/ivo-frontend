<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="robots" content="noindex">

  <title>Memberships</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="assets/bootstrap.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" type="text/css" href="assets/datatables/datatables.min.css"/>

  <style type="text/css">

  </style>
  <script src="assets/jquery.js"></script>
  <script src="assets/bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/datatables/datatables.min.js"></script>
  <script type="text/javascript">
  
  var defaultCSS = document.getElementById('bootstrap-css');
  function changeCSS(css){
    if(css) $('head > link').filter(':first').replaceWith('<link rel="stylesheet" href="'+ css +'" type="text/css" />'); 
    else $('head > link').filter(':first').replaceWith(defaultCSS); 
  }
</script>
</head>
<body>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h4>Memberships</h4>
        <button class="btn btn-primary btn-xs" onClick="$.addDialog()" >Add New</button>
        <div class="table-responsive">
          <table id="mytable" class="table table-bordred table-striped">
            <thead>
              <th><input type="checkbox" id="checkall" /></th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Address</th>
              <th>Email</th>
              <th>Contact</th>
              <th>Edit</th>

              <th>Delete</th>
            </thead>
            <tbody>
 
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
      <form id="membersForm" action="operations.php?type=save">
        <div class="modal-header">
        <input type="hidden" name="_id">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
          <h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <input class="form-control " type="text" placeholder="[first_name]" name="first_name">
          </div>
          <div class="form-group">

            <input class="form-control " type="text" placeholder="[last_name]" name="last_name">
          </div>
          <div class="form-group">

            <input class="form-control " type="text" placeholder="[email]" name="email">
          </div>

          <div class="form-group">

            <input class="form-control " type="text" placeholder="[contact]" name="contact">
          </div>
          <div class="form-group">
            <textarea rows="2" name="address" class="form-control" placeholder="CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan"></textarea>
          </div>
        </div>
        <div class="modal-footer ">
          <button id="btnUpdate" type="submit" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
  </div>
  <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
          <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
        </div>
        <div class="modal-body">

          <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>

        </div>
        <div class="modal-footer ">
          <button type="button" data-id="" id="confirmDelete" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
        </div>
      </div>
      <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
  </div>
  <script type="text/javascript">
    $(document).ready(function(){
      $.addDialog = function(){
        $('#Heading').text("Add New Data");
        $('#edit input[name=first_name]').attr('placeholder','First Name');
        $('#edit input[name=last_name]').attr('placeholder','Last Name');
        $('#edit input[name=email]').attr('placeholder','Email');
        $('#edit input[name=contact]').attr('placeholder','Contact');
        $('#edit textarea[name=address]').attr('placeholder','Address');
        
        $('#edit input[name=first_name]').val('');
        $('#edit input[name=last_name]').val('');
        $('#edit input[name=email]').val('');
        $('#edit input[name=contact]').val('');
        $('#edit textarea[name=address]').html('');
        $('#edit input[name=_id]').val('');

        $('#btnUpdate').removeAttr('disabled');
        $('#btnUpdate').html('<span class="glyphicon glyphicon-ok-sign"></span>Save'); 
        $('#edit').modal();
      };
      $.deleteDialog=function(el){
        $('#confirmDelete').removeAttr('disabled');
        $('#confirmDelete').html('<span class="glyphicon glyphicon-ok-sign"></span>Yes');
        var rowData =  $(el).closest('tr');
        rowData=myTable.row(rowData).data();
        $('#confirmDelete').data('id',rowData._id);
        $('#delete').modal();
      }
      $.editDialog = function(el){
        $('#Heading').text("Edit Data");
        var rowData =  $(el).closest('tr');
        rowData=myTable.row(rowData).data();
        $('#edit input[name=first_name]').attr('placeholder',rowData.first_name);
        $('#edit input[name=last_name]').attr('placeholder',rowData.last_name);
        $('#edit input[name=email]').attr('placeholder',rowData.email);
        $('#edit input[name=contact]').attr('placeholder',rowData.contact);
        $('#edit textarea[name=address]').attr('placeholder',rowData.address);
        
        $('#edit input[name=first_name]').val(rowData.first_name);
        $('#edit input[name=last_name]').val(rowData.last_name);
        $('#edit input[name=email]').val(rowData.email);
        $('#edit input[name=contact]').val(rowData.contact);
        $('#edit textarea[name=address]').html(rowData.address);
        $('#edit input[name=_id]').val(rowData._id);

        $('#btnUpdate').removeAttr('disabled');
        $('#btnUpdate').html('<span class="glyphicon glyphicon-ok-sign"></span>Update'); 
        $('#edit').modal();
        
      };
      var myTable=$('#mytable').DataTable({
        serverSide:true,
        processing:true,
        ajax:{
          url:'get_data.php',
          type:'POST'
        },
        columns:[
          {data:"_id",sortable:false,render:function(data){
            return '<input type="checkbox" class="checkthis" value="'+data+'" />';
          }},
          {data:"first_name"},
          {data:"last_name"},
          {data:"address"},
          {data:"email"},
          {data:"contact"},
          {data:"_id",render:function(data) {

            return '<p data-id="'+data+'" data-placement="top" data-toggle="tooltip" title="Edit">'
              +'<button class="btn btn-primary btn-xs" data-title="Edit" onClick="$.editDialog(this);" data-target="#edit" >'
              +'<span class="glyphicon glyphicon-pencil"></span>'
              +'</button></p>';
          }},
          {data:"_id",render:function(data){
              return '<p data-id="'+data+'"data-placement="top" data-toggle="tooltip" title="Delete">'
              +'<button class="btn btn-danger btn-xs" data-title="Delete" onClick="$.deleteDialog(this);" data-target="#delete" >'
              +'<span class="glyphicon glyphicon-trash"></span></button></p>';
          }},
        ]
      });

      $("#mytable #checkall").click(function () {
        if ($("#mytable #checkall").is(':checked')) {
          $("#mytable input[type=checkbox]").each(function () {
            $(this).prop("checked", true);
          });

        } else {
          $("#mytable input[type=checkbox]").each(function () {
            $(this).prop("checked", false);
          });
        }
      });

      $("[data-toggle=tooltip]").tooltip();
      $('#confirmDelete').click(function(ev){
        var member_id = $(this).data('id');
        $(this).attr('disabled','disabled');
        
        $('#confirmDelete').html('<span class="glyphicon glyphicon-ok-sign"></span>Please Wait');
        $.ajax({
          url:'operations.php?type=delete',
          data:{
            _id:member_id
          },
          dataType:'JSON',
          type:'POST',
          success:function(response){
            if('failed'==response.status){
              alert(response.message);
            }
            myTable.ajax.reload();
          },

          complete:function(){
           $('#delete').modal('toggle'); 
          }
        })
        // 
      });
      $('#membersForm').submit(function(e){
        var form=$(this);
        var data=form.serialize();
        $('#btnUpdate').attr('disabled','disabled'); 
        $('#btnUpdate').html('<span class="glyphicon glyphicon-ok-sign"></span>Please Wait'); 
        $.ajax({
          url:form.attr('action'),
          type:'POST',
          dataType:'JSON',
          data:data,
          success:function(response){
            console.log(response);
            if(response.status=='failed'){
              alert(response.message);
            }
            $('#edit').modal('toggle');
            myTable.ajax.reload();
          },

        })
        e.preventDefault();
        return false;
      });

    });

  </script>
</body>
</html>
