<!DOCTYPE html>
<html>
<body>
    <?php
    $qid = $_REQUEST["id"];
    $ids = array("Visits", "Recenter", "Location", "Directions", "MyLocation", "CenterAll");
    $statsfile = fopen("stats.json", "r") or die("Unable to open file!");
    $jsonData = fread($statsfile, filesize("stats.json"));
    fclose($statsfile);
    if ($_SERVER['HTTP_X_GUID'] != '') {
        if (in_array($qid, $ids)) {
            $jsonObj = json_decode($jsonData, true);
            $jsonObj[$qid] = $jsonObj[$qid] + 1;
            $jsonObj["LastUpdate"] = gmdate("d.m.Y H:i:s");
            $jsonObj = json_encode($jsonObj, JSON_PRETTY_PRINT);
            $statsfile = fopen("stats.json", "w") or die("Unable to open file!");
            fwrite($statsfile, $jsonObj);
            fclose($statsfile);
            echo $jsonObj;
            //echo "The '{$qid}' property was updated successfully!<br><br>Statistics:<br>{$jsonObj}";
        }
        else {
            echo $jsonData;
        }
    }
    else {
        echo $jsonData;
    }
    ?>
</body>
</html>