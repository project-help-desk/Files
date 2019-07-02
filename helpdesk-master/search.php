<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Search</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
	<?php
   
    $conn = mysqli_connect("localhost", "root", "", "tutorial_search");
   
    if(mysqli_connect_errno()){
        echo "Failed to connect: " . mysqli_connect_error();
    }
 
    error_reporting(0);
 
    $output = '';
   
    if(isset($_POST['query']) && $_POST['query'] !== ' '){
        $searchq = $_POST['query'];
       
        $q = mysqli_query($conn, "SELECT * FROM search WHERE keywords LIKE '%$searchq%' OR title LIKE '%$searchq%'") or die(mysqli_error());
        $c = mysqli_num_rows($q);
        if($c == 0){
            $output = 'No search results for <b>"' . $searchq . '"</b>';
        } else {
            while($row = mysqli_fetch_array($q)){
                $id = $row['id'];
                $title = $row['title'];
                $desc = $row['description'];
                $link = $row['link'];
               
                $output .= '<a href="' . $link . '">
                            <h3>' . $title . '</h3>
                                <p>' . $desc . '</p>
                            </a>';
            }
        }
    } else {
        header("location: ./");
    }
    print("$output");
    mysqli_close($conn);
 
?>
</body>
</html>