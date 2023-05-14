<?php
@include('../config.php');

$studentFilter = isset($_POST["studentFilter"]) ? $_POST["studentFilter"] : '';


$sql = "select Id, Concat(FirstName, ' ', LastName) as StudentName, Email, Status from users  where 
  Email like '{$studentFilter}' and UserType = '1' and Status = '1' ";


 $result = mysqli_query($conn, $sql);
 


 $tableRows = '';

    if(mysqli_num_rows($result) == 0){
        echo '<div style="margin-bottom:10px;"><span style="font-size:1.5rem; border-bottom:3px solid #f7b092;">Online Students</span></div>';
        echo '<span class="text-danger">No online students</span>';
    }
    else{
    while($row = mysqli_fetch_array($result)) {
        $tableRows .= '<tr data-id="' . $row['Id'] . '">';
        
        $tableRows .= '<td>' . $row['Id'] . '</td>';
        $tableRows .= '<td>' . $row['StudentName'] . '</td>';
        $tableRows .= '<td>' . $row['Email'] . '</td>';
        $tableRows .= '<td><span>';
        if ($row['Status'] == '0') {
            $tableRows .= 'Offline';
        } elseif ($row['Status'] == '1') {
            $tableRows .= 'Online';
        } 
        $tableRows .= '</span> </td>';
        
       
        $tableRows .= '</tr>';
    }

    // Generate HTML table
    $table = '<table>';
    $table .= '<thead>';
    $table .= '<tr>';
    $table .= '<th></th>';
    $table .= '<th>ID</th>';
    $table .= '<th>Student Name</th>';
    $table .= '<th>Email</th>';
    $table .= '<th>Status</th>';
    $table .= '</tr>';
    $table .= '</thead>';
    $table .= '<tbody >';
    $table .= $tableRows;
    $table .= '</tbody>';
    $table .= '</table>';

        echo '<div><span style="font-size:1.5rem; border-bottom:3px solid #f7b092;">Online Students</span></div>';
        echo $table;
    }







?>