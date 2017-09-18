<?php
class Trello {
    public $ListIncubation = array();
    public $ListScheduling = array();
    public $ListScheduled = array();
    public $ListComplete = array();

    public function __construct() {
        $filename = "data/trello.json";
        $boardID "";
        $apiKey = "";
        $apiToken = "";

        if ((time()-filemtime($filename) > (60*60)) || (filesize($filename) < 10)) {
            // file older than 60 min
            // or file empty
            $json_current = file_get_contents("https://api.trello.com/1/boards/".$boardID."/cards?key=".$apiKey."&token=".$apiToken);
            
            $fh = fopen($filename, "w") or die("Unable to open file!");
            fwrite($fh, $json_current);
            fclose($fh);
        } else {
            // file younger than 15 min
            $json_current = file_get_contents($filename);
        }
        
        $current = json_decode($json_current);

        $i = 0;
        foreach($current as $c) {
            $card = array();
            $card["Name"] = $c->name;
            if($c->idList == "5811e6dd6125ce7c590295ef") { 
                $this->ListIncubation[] = $card;
            }
            if($c->idList == "5811e6e4a9eb9644e61fbbae") { 
                $this->ListScheduling[] = $card;
            }
            if($c->idList == "5811e7b1a123590fb546ec67") { 
                $this->ListScheduled[] = $card;
            }
            if($c->idList == "5811e6ec0f45aec56c0aefaa") { 
                $this->ListComplete[] = $card;
            }
        }
    }

    public function Draw($boardName) {
        echo '<div id="trello" style="font: 30px Georgia;">';
        echo "<img width='32' height='32' src='icons/Trello.png' style='margin-right:18px;'/>";
        echo "Trello ".$boardName;
        echo "<hr>";

        if($boardName == "Incubation") { $List = $this->ListIncubation;}
        if($boardName == "Scheduling") { $List = $this->ListScheduling;}
        if($boardName == "Scheduled") { $List = $this->ListScheduled;}
        if($boardName == "Complete") { $List = $this->ListComplete;}

        foreach($List as $c) {
            echo "<span style='font-size:24px;margin-left:10px;'>" . $c["Name"] . "</span><br/>";
        }
        echo "</div>";
    }
}
?>