<?php
include_once '../../models/db.php';

//$user = new User($phoneNumber); //$isRegistered = true;
$db = new DBConnector();
$pdo = $db->connectToDB();

$stmt1 = $pdo->prepare("select planName, count(planName) as freq from subscriptionplans WHERE planName = 'Daily'");
$stmt2 = $pdo->prepare("select planName, count(planName) as freq from subscriptionplans WHERE planName = 'Weekly'");
$stmt3 = $pdo->prepare("select planName, count(planName) as freq from subscriptionplans WHERE planName = 'Monthly'");
$stmt1->execute();
$stmt2->execute();
$stmt3->execute();
$result1 = $stmt1->fetchAll();
$result2 = $stmt2->fetchAll();
$result3 = $stmt3->fetchAll();




//loop through the returned data
$data1 = array();
foreach ($result1 as $row) {
  $data1[] = $row;
}

$data2 = array();
foreach ($result2 as $row) {
  $data2[] = $row;
}

$data3 = array();
foreach ($result3 as $row) {
  $data3[] = $row;
}

$finalData = array_merge($data1, $data2, $data3);
//$object = (object) $finalData;

//free memory associated with result
// $result1->close();
// $result2->close();
// $result3->close();

$pdo = null;

//now print the data
// print json_encode($data1);
// print json_encode($data2);
// print json_encode($data3);
print json_encode($finalData);


?>