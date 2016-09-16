<?php
require_once('util.php');

$conn = connectDB();
$sql = 'SELECT a.name, a.lat, a.longi, a.iata, count(*) as ct FROM flights f left join airports a on f.From_OID = a.oid group by f.From_OID order by ct desc';

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();
$series = array();
foreach($result as $r)
{
    if((strlen($r[1]) > 0) && (strlen($r[2]) > 0) && (strlen($r[4]) > 0)) {
        $series[] = $r[1];
        $series[] = $r[2];
        $series[] = $r[4];
    }   
}

header('Content-Type: application/json');

echo json_encode($series);

closeDB();
?>