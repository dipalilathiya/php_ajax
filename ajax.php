 <?php
  include("config.php");
  // Create Record
  if (isset($_POST["email"])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sql = "insert into register1 (Name,Email,Password) values('$name','$email','$password')";
    mysqli_query($connection, $sql);
  }

  //  ------------------------------------Search----------------------------------
  if (isset($_GET['srch'])) {
    $search = $_GET['srch'];
    $ser = "select * from register1 where Name like '%$search%'";
    $result = mysqli_query($connection, $ser);
  }
  //  ------------------------------------Update----------------------------------
  if (isset($_POST['update_name'])) {
    $u_id = $_POST['u_id'];
    $uname = $_POST['update_name'];
    $uemail = $_POST['update_email'];
    $query = "update register1 set name='$uname',email='$uemail' where Id=$u_id";
    mysqli_query($connection, $query);
  }
  //  ------------------------------------Delete----------------------------------
  if (isset($_GET['d_id'])) {
    $id = $_GET['d_id'];
    $id = "delete from register1 where Id=$id";
    mysqli_query($connection, $id);
  }
  // -----------------------pagination---------------------------
  if(isset($_GET["no"]))
  {
    $page_no=$_GET['no'];
    $limit=3;
    $offset=($page_no-1)*$limit;
    $query="select * from register1 limit $offset, $limit";
    mysqli_query($connection,$query);

    if(mysqli_num_rows($query)>0)
    {
        $total_records =mysqli_num_rows($query);
        $limit=3;
        $total_page =ceil($total_records/$limit);
        for($i=1;$i<=$total_page;$i++)
        {
            echo '<li><a href="selected.php?no='.$i.'"></a></li>';
        }
    }
  }
  // ---------------update---------------------
  if (isset($_GET['uid'])) {
    $id = $_GET['uid'];
    $que = "select * from register1 where Id=$id";
    $result1 = mysqli_query($connection, $que);
    $data = mysqli_fetch_assoc($result1);
    echo json_encode($data);
  } else {
 
    if(!isset($result)) {
      $ser = "select * from register1";
      $result = mysqli_query($connection, $ser);
    }
    while ($row = mysqli_fetch_assoc($result)) {
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
       <td><a href="javascript:void(0)" class='update' attr-id=<?php echo $id ?>>update</a></td>
     </tr>
 <?php }
  }
