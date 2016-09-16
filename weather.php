<?php
class Weather {
    public $CurrIcon = "";
    public $CurrF = "";

    public function __construct() {
        $key = "";
        $loc = "NJ/Cherry_Hill";
        #$json_current = file_get_contents("http://api.wunderground.com/api/".$key."/conditions/q/".$loc.".json");
        $json_current = file_get_contents("./current.json");
        $current = json_decode($json_current);

        $this->CurrIcon = $current->current_observation->icon;
        $this->CurrF = $current->current_observation->temp_f;
    }
}
?>