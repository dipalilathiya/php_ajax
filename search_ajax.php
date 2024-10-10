<?php 
 include("config.php");
 if(isset($_POST["email"])){
      $name=$_POST['name'];
      $email=$_POST['email'];     
      $password=$_POST['password'];
      $sql="insert into register (Name,Email,Password) values('$name','$email','$password')";
      mysqli_query($connection,$sql);    
 }
  //  ------------------------------------Search------------------------------
if(isset($_GET['srch']))
{
  $search=$_GET['srch'];
  // echo "how are you";
  $ser="select * from register where Name like '%$search%'";
  $result=mysqli_query($connection,$ser);
 }
 if(isset($_GET['did']))
 {
  $id=$_GET['did'];
  // echo "how are you";
  $result="delete register where Id=$id";
  $result=mysqli_query($connection,$result);
 }
  else
  {
  if(!isset($result)){
    $ser="select * from register ";
    $result=mysqli_query($connection,$ser);
 }

  while($row = mysqli_fetch_assoc($result))
  {
      $id=$row['Id'];
      $name=$row['Name'];
      $email=$row['Email'];
      $password=$row['Password'];
      ?>
      <tr>           
      <td><?php echo $id;?></td>
      <td><?php echo $name;?></td>
      <td><?php echo $email;?></td>
      <td><?php echo $password;?></td>
    
      </tr>
   <?php }}