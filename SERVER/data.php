<?php
$filename = "data/data.txt";
header('Content-Type: application/json');

// figure out do we pull from db or file for set via opentrips
if (file_exists($filename)) {
    $json = file_get_contents($filename);
    $series = json_decode($json);
}
else {
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

    //closeDB();
}

if(!isset($_GET['extras'])) {
    // add in the extras that are not in opentrips
    // lat, long, count where GPS is decimal

    // NYC
    $series[] = "40.756667";
    $series[] = "-73.991111";
    $series[] = "5";
    // DC
    $series[] = "38.897222";
    $series[] = "-77.006389";
    $series[] = "5";
    // Philly
    $series[] = "39.955833";
    $series[] = "-75.181944";
    $series[] = "2";
}

echo json_encode($series);
?>