<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="robots" content="noindex">

  <title>Memberships</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" type="text/css" href="assets/datatables/datatables.min.css"/>

  <style type="text/css">

  </style>
  <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<!-- 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script> -->
<script type="text/javascript" src="assets/datatables/datatables.min.js"></script>
<script type="text/javascript">
  window.alert = function(){};
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
              <tr>
                <td><input type="checkbox" class="checkthis" /></td>
                <td>Mohsin</td>
                <td>Irshad</td>
                <td>CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan</td>
                <td>isometric.mohsin@gmail.com</td>
                <td>+923335586757</td>
                <td>

                <p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p>
                </td>
                <td>

                <p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
          <h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input class="form-control " type="text" placeholder="Mohsin">
          </div>
          <div class="form-group">

            <input class="form-control " type="text" placeholder="Irshad">
          </div>
          <div class="form-group">
            <textarea rows="2" class="form-control" placeholder="CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan"></textarea>
          </div>
        </div>
        <div class="modal-footer ">
          <button type="button" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
        </div>
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
          <button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
        </div>
      </div>
      <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
  </div>
  <script type="text/javascript">
    $(document).ready(function(){
      $('#mytable').DataTable({
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
              +'<button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="x_modal" data-target="#edit" >'
              +'<span class="glyphicon glyphicon-pencil"></span>'
              +'</button></p>';
          }},
          {data:"_id",render:function(data){
              return '<p data-id="'+data+'"data-placement="top" data-toggle="tooltip" title="Delete">'
              +'<button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" >'
              +'<span class="glyphicon glyphicon-trash"></span></button></p>';
          }},
        ]
      });

      $('body').on('click', 'table button[data-toggle="x_modal"]', function() {
        alert($(this).data('title'));
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

    });

  </script>
</body>
</html>
