<?php
 @include '../config.php';


if(isset($_POST['edit'])){
    $id = mysqli_real_escape_string($conn , $_POST['id']);
    $name = mysqli_real_escape_string($conn ,$_POST['name']);


}


$query = "UPDATE subject
    SET
    name = '$name'
    WHERE
    id = $id;";
mysqli_query($conn, $query);




?>
<script type="text/javascript">
alert("Subject edited successfully.");
window.location.href = "subjects.php";
</script>