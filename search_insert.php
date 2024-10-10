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
$query = "select * from register";
$result = mysqli_query($connection, $query);
?>
<form id="frm" method="post">
    <p>Name</p>
    <input type="text" name="name">
    <p>Email</p>
    <input type="email" name="email">
    <p>Password</p>
    <input type="password" name="password">
    <input type="submit" name="submit">
</form>
<!-- ---------------Search---------------------------- -->
<input type="search"  placeholder="Search" name="search" id="srch">
<table border="1"  Cellspacing="1" class="border border-black">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Password</th>
        <th>Delete</th>
    </tr>
    <tbody id="ans">
        <?php
        while ($row = mysqli_fetch_array($result)) {
            $id = $row['Id' ];
            $name = $row['Name'];
            $email = $row['Email'];
            $password = $row['Password'];
            ?>
            <tr>
                <td><?php echo $id; ?></td>
                <td><?php echo $name; ?></td>
                <td><?php echo $email; ?></td>
                <td><?php echo $password; ?></td>   
                <td><a href="javascript:void(0)" class="delete" att-id="<?php echo $id ?>">Delete</a></td>

            </tr>
        <?php } ?>
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
                url: "search_ajax.php",
                data: frm,
                success: function (res) { //success-> responce  mle a res name na variable ma store thai
                    $('#ans').html(res);
                }
            })
        })
          $(document).on('keyup' ,'#srch', function (){  
            var search = $('#srch').val();
            console.log(search)
            $.ajax({
                type: "get",
                url: "search_ajax.php",
                data:{'srch' : search},
                success: function(res) { //success-> responce  mle a res name na variable ma store thai
                    $('#ans').html(res);
                }
            })
        })
        $(document).on('clike','delete', function(){
            var id= $('#att-id').attr('#att-id')
            alert(id);
            $.ajax({
                type:'get',
                url:'search_ajax.php',
                data:{key:'did'},
                success:function(res){
                    $('#ans').html(res);
                }
            })    
        })
    })
</script>