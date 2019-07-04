<?php

if (isset($_GET['class'])) {

    echo "<script>
      function ConfirmDelete()
      {
            if (confirm('Are you sure you want to delete?'))
            window.location.href = 'http://localhost/overwiew_page_new/index.php';	
      }
      ConfirmDelete();
      </script>";
}
$conn = mysqli_connect("localhost", "root", "", "stenden_helpdesk");
if (!$conn) {
    echo "Unable to connect to server";
}
$query_delete = "DELETE FROM incident WHERE incident_id=?";
if ($stmt = mysqli_prepare($conn, $query_delete)) {
    mysqli_stmt_bind_param($stmt, "i", $_GET["class"]);
    if (mysqli_stmt_execute($stmt)) {
        header("location:UserTickets.php");
        echo "";
    } else {
        echo "Error Deleteing " . mysqli_error($conn);
    }
} else {
    echo "Error Preparing the statement" . mysqli_error($conn);
}
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>