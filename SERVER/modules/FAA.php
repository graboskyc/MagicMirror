<?php
class FAA {
    public $Delay = false;
    public $DelayType = "";
    public $Loc = "";
    public $MaxDelay = "";
    public $AvgDelay = "";

    public function __construct($aircode) {
        $this->Loc = $aircode;
        $filename = "data/FAA_".$aircode.".json";

        if (time()-filemtime($filename) > (60*15)) {
            // file older than 15 min
            $json_current = file_get_contents("http://services.faa.gov/airport/status/".$this->Loc."?format=application/json");
            
            $fh = fopen($filename, "w") or die("Unable to open file!");
            fwrite($fh, $json_current);
            fclose($fh);
        } else {
            // file younger than 15 min
            $json_current = file_get_contents($filename);
        }
        
        $current = json_decode($json_current);
        $this->Delay = $current->delay;
        $this->DelayType = $current->status->type;
        $this->MaxDelay = str_replace("and", "&amp;", str_replace("minute", "min", str_replace("hour", "hr", $current->status->maxDelay)));
        $this->AvgDelay = str_replace("and", "&amp;", str_replace("minute", "min", str_replace("hour", "hr", $current->status->avgDelay)));
    }

    public function Draw() {
        echo '<div id="faa_'.$this->Loc.'" style="font-size:32px;">';
        echo "<div style='float:left;width:45%;'><img width='24' height='24' src='icons/Plane.png' style='margin-right:10px;'/>".$this->Loc . "</div>";
        echo "<div style='float:left;width:55%;'>";

        $icon = "ThumbsUp.png";
        $msg = "";
        if ($this->Delay == "true") {
            if ($this->DelayType == "Airport Closure") { $icon = "Close.png"; $msg = "Closed"; }
            else if ($this->DelayType == "Ground Stop") { $icon = "Stop.png"; $msg = "Stop"; }
            else if ($this->DelayType == "Ground Delay") { $icon = "Timer.png"; $msg = "Del"; }
            else { $icon = "Question.png"; $msg = str_replace("Departure", "Dep", $this->DelayType);}

            if($this->MaxDelay !== "") { $msg = $msg . " " . $this->MaxDelay . " max";}
            else if  ($this->AvgDelay !== "") { $msg = $msg . " " . $this->AvgDelay . " avg";}
        }
        else {
            $msg = "";
        }
        
        echo "<img width='24' height='24' src='icons/".$icon."' style='margin-right:18px;'/><span style='font-size:12px;'>" . $msg . "</span>";
        echo "</div></div>";
    }
}
?>