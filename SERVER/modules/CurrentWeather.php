<?php
class CurrentWeather {
    public $CurrIcon = "";
    public $CurrF = "";

    public function __construct() {
        $key = "";
        $loc = "NJ/Cherry_Hill";

        $filename = "data/CurrentWeather.json";

        if (time()-filemtime($filename) > (60*15)) {
            // file older than 15 min
            $json_current = file_get_contents("http://api.wunderground.com/api/".$key."/conditions/q/".$loc.".json");
            
            $fh = fopen($filename, "w") or die("Unable to open file!");
            fwrite($fh, $json_current);
            fclose($fh);
        } else {
            // file younger than 15 min
            $json_current = file_get_contents($filename);
        }
        
        $current = json_decode($json_current);

        $this->CurrIcon = $current->current_observation->icon;
        $this->CurrF = $current->current_observation->temp_f;
    }

    public function Draw() {
        echo "<img width='24' height='24' src='icons/weather/".$this->CurrIcon.".png' style='margin-right:18px;'/>";
        echo $this->CurrF . "&deg; F";
    }
}
?>