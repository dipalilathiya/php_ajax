<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</head>
<body>   
<?php
include ("config.php");
$query = "select * from register1";
$result = mysqli_query($connection, $query);
?>
<form id="frm" method="post">
    <p class="mb-0">Name</p>
    <input class="mb-2" type="text" name="name">
    <p class="mb-0">Email</p>
    <input class="mb-2" type="email" name="email">
    <p class="mb-0">Password</p>
    <input class="mb-2" type="password" name="password">
    <input type="submit" name="submit">
</form>
<!-- ---------------Search---------------------------- -->
    <input type="search"  placeholder="Search" name="search" id="srch" class="my-3">
<!-- model -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="myfrm" method="post">
	      <div class="modal-body">
	      	<input type="hidden" name="u_id" id="u_id">
	       Name:<input type="text" name="update_name" id="uname"><br>
	       Email:<input type="email" name="update_email" id="uemail">
	      </div>
	      <div class="modal-footer">
	        <input type="submit" class="btn btn-primary" value="Save">
	      </div>
	   </form>
    </div>
  </div>
</div>
<!--  -->
<table border="1"  Cellspacing="1" class="border border-black">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Password</th>
        <th>delete</th>
        <th>Update</th>
    </tr>
    <tbody id="ans">
        <?php
        while ($row = mysqli_fetch_array($result)) {
            $id = $row['Id'];
            $name = $row['Name'];
            $email = $row['Email'];
            $password = $row['Password'];
            ?>
            <tr>
                <td><?php echo $id; ?></td>
                <td><?php echo $name; ?></td>
                <td><?php echo $email; ?></td>
                <td><?php echo $password; ?></td>
                <td><a href="javascript:void(0)" class='delete' attr-id=<?php echo $id ?>>delete</a></td>
                <td><a  href="javascript:void(0)" class='update' attr-id=<?php echo $id ?>>update</a></td>
                <!-- void(0) delete krva mate    -->
            </tr>
        <?php }
        ?>
    </tbody>
</table>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#frm').submit(function (e) {
            e.preventDefault()// preventDefault a biji activities ne blok kre
            var frm = $('#frm').serialize();//#frm  name ni  id na -> serialize data ne GET krave and frm name na variable ma store thai
            alert(frm);
            $.ajax({
                type: "post",
                url: "ajax.php",
                data: frm,
                success: function (res) { //success-> responce  mle a res name na variable ma store thai
                    $('#ans').html(res);
                }
            })
        })
        $(document).on('click','.delete', function () {
            var id = $(this).attr('attr-id'); //attr function atribute krva mate
            alert(id);
            $.ajax({
                type: "get",
                url: "ajax.php",
                data: { 'd_id': id },
                success: function (res) { //success-> responce  mle a res name na variable ma store thai
                    $('#ans').html(res);
                }
            })
        })
        $(document).on('click','.update',function(){
            var id = $(this).attr('attr-id');
            alert(id);
            $.ajax({
                type:"get",
                url:"ajax.php",
                dataType:"json",
                data:{'uid':id},
                success: function (res) { //success-> responce  mle a res name na variable ma store thai
                $('#uname').val(res.Name);
                $('#uemail').val(res.Email);
                $('#u_id').val(res.Id);
                $('#exampleModal').modal('show');
                // $('#hello').html(res)
               }
            })
        })
        $(document).on('submit' ,'#myfrm' ,function(e){
            e.preventDefault()// preventDefault a biji activities ne blok kre
            var frm_data = $('#myfrm').serialize();//#frm  name ni  id na -> serialize data ne GET krave and frm name na variable ma store thai
            alert(frm_data);
            $.ajax({
                type: "post",
                url: "ajax.php",
                data: frm_data,
                success: function (res) { //success-> responce  mle a res name na variable ma store thai
                    $('#ans').html(res);
                $('#exampleModal').modal('hide');
                }
            })
        })
          $(document).on('keyup' ,'#srch', function(){  
            var search = $('#srch').val();
            console.log(search)
            $.ajax({
                type: "get",
                url: "ajax.php",
                data:{'srch' : search},
                success: function(res) {   //success-> responce  mle a res name na variable ma store thai
                    $('#ans').html(res);
                }
            })
        })    
    }) 
</script>
</html>