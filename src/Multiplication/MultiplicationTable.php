<?php

class MultiplicationTable {
    public function disp() {

        echo "<table border=\"1\">";
        for ($i = 1; $i <= 9; $i++){
            echo "<tr>\n";

            for ($j = 1; $j <= 9; $j++){

                $color = "";
                if (($i%2 === 0) && ($j%2 === 0)){
                    $color = "#ffffff";
                }else{
                    $color = "#ccccff";
                }

                echo "<td align=\"right\" style=\"background:".$color.";width:30px\">\n";
                echo $i * $j;
                echo "</td>\n";
            
            }
            echo "</tr>\n";
        }
        echo "</table>\n";
    }
}
?>
