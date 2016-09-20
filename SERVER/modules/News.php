<?php
class News {
    public $StoryList = array();

    public function __construct() {
        $this->StoryList = array();

        $key = "";
        $section = "world";
        $storyCt = 5;

        $filename = "data/News.json";

        if (time()-filemtime($filename) > (60*15)) {
            // file older than 15 min
            $json_current = file_get_contents("https://api.nytimes.com/svc/topstories/v2/".$section.".json?api-key=".$key);
            
            $fh = fopen($filename, "w") or die("Unable to open file!");
            fwrite($fh, $json_current);
            fclose($fh);
        } else {
            // file younger than 15 min
            $json_current = file_get_contents($filename);
        }
        
        $current = json_decode($json_current);

        $i = 0;
        foreach($current->results as $r) {
            if ($i < $storyCt) {
                $this->StoryList[] = $r->title;
                $i++;
            }
        }
    }

    public function Draw() {
        echo "<img width='32' height='32' src='icons/News.png' style='margin-right:18px;'/>";
        echo "NYT World News";
        echo "<hr>";
        foreach($this->StoryList as $s) {
            echo "<span style='font-size:14px;'>" . $s . "</span><br/><br/>";
        }
    }
}
?>