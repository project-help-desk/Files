<?php

$currentDate = date('Y-m-d');
$WeekDate = date('Y-m-d', strtotime('-7 days'));
$MonthDate = date('Y-m-d', strtotime('-30 days'));
$YearDate = date('Y-m-d', strtotime('-365 days'));
include_once 'includes/header.php';
$weekquery = "SELECT count(incident_id) 
FROM incident
WHERE
date_time BETWEEN '" . $WeekDate . "' AND '" . $currentDate . "'";
if ($statement = mysqli_prepare($conn, $weekquery)) {
    if (mysqli_stmt_execute($statement)) {
        mysqli_stmt_bind_result($statement, $weekcount);
        mysqli_stmt_store_result($statement);
        mysqli_stmt_fetch($statement);
    } else {
        echo "error inserting incident";
        die(mysqli_error($conn));
    }
    mysqli_stmt_close($statement);
} else {
    die(mysqli_error($conn));
}

$monthquery = "SELECT count(incident_id) 
FROM incident
WHERE
date_time BETWEEN '" . $MonthDate . "' AND '" . $currentDate . "'";
if ($statement = mysqli_prepare($conn, $monthquery)) {
    if (mysqli_stmt_execute($statement)) {
        mysqli_stmt_bind_result($statement, $monthcount);
        mysqli_stmt_store_result($statement);
        mysqli_stmt_fetch($statement);
    } else {
        echo "error inserting incident";
        die(mysqli_error($conn));
    }
    mysqli_stmt_close($statement);
} else {
    die(mysqli_error($conn));
}
$yearquery = "SELECT count(incident_id) 
FROM incident
WHERE
date_time BETWEEN '" . $YearDate . "' AND '" . $currentDate . "'";
if ($statement = mysqli_prepare($conn, $yearquery)) {
    if (mysqli_stmt_execute($statement)) {
        mysqli_stmt_bind_result($statement, $yearcount);
        mysqli_stmt_store_result($statement);
        mysqli_stmt_fetch($statement);
    } else {
        echo "error inserting incident";
        die(mysqli_error($conn));
    }
    mysqli_stmt_close($statement);
} else {
    die(mysqli_error($conn));
}
?>
