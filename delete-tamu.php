<?php
  require_once("session.php");
?>
<?php
require_once("class.user.php");
$auth_user = new USER();

include_once 'dbconfigcrud.php';
include_once 'class.crud.tamu.php';

$crud = new crud($DB_con);

if(isset($_GET['delete_id']))
{
 $id = $_GET['delete_id'];
 extract($crud->getID($id)); 
}

if(isset($_POST['btn-del']))
{
  if ($_POST['csrf-token'] == $_SESSION['token']){
    if ($_SESSION['user_session'] == $userId){
       $id_del = $_GET['delete_id'];
       $crud->delete($id_del);
       header("Location: delete-tamu.php?deleted"); 
    }else {
          exit("Delete Error! Wrong Author");
    }
  }exit("Error! Wrong Token");
}

?>

<?php include_once 'header.php'; ?>
<link rel="stylesheet" href="styletamu.css" type="text/css">

<div class="clearfix"></div>

<div class="container">

 <?php
 if(isset($_GET['deleted']))
 {
  ?>
        <div class="alert alert-success">
     <strong>Success!</strong> record was deleted... 
  </div>
        <?php
 }
 else
 {
  ?>
        <div class="alert alert-danger">
     <strong>Sure !</strong> remove the following record ? 
  </div>
        <?php
 }
 ?> 
</div>

<div class="clearfix"></div>

<div class="container">
  
  <?php
  if(isset($_GET['delete_id']))
  {
   ?>
         <table class='table table-bordered'>
         <tr>
           <th class="col-sm-1">Nama Penulis</th>
           <th class="col-sm-2">Nama</th>
           <th class="col-sm-5">Email</th>
           <th class="col-sm-2">Alamat</th>
         </tr>
             <tr>
                <td><?php echo $usernamepenulis ?></td>
                <td><?php echo $tamuNama ?></td>
                <td><?php echo $tamuEmail ?></td>
                <td><?php echo $tamuAlamat ?></td>
             </tr>
         </table>
         <?php
  }
  ?>
</div>

<div class="container">
<p>
<?php
if(isset($_GET['delete_id']))
{
 ?>
   <form method="post">
   <input type="hidden" name="csrf-token" value="<?php echo $_SESSION['token'] ?>">
    <input type="hidden" name="id" value="<?php echo $id ?>" />
    <button class="btn btn-large btn-primary" type="submit" name="btn-del"><i class="glyphicon glyphicon-trash"></i> &nbsp; YES</button>
    <a href="listtamu.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; NO</a>
    </form>  
 <?php
}
else
{
 ?>
    <a href="listtamu.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
    <?php
}
?>
</p>
</div> 
<?php include_once 'footer.php'; ?>