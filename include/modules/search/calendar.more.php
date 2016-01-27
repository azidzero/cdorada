<div class="container-fluid">
    <h3><?php echo $wlang->getString("moreinfo", "str-availability"); ?></h3>
    <div class="row">
        <?php

        class resCalendar {

            public $date_ini;
            public $date_end;
            public $SQL;

            function __construct() {
                
            }

            function render() {
                
            }

        }

        $y = date("Y");
        $mo = date("m");
        for ($i = $mo; $i < $mo + 12; $i++) {
            $w = date("w", mktime(0, 0, 0, $i, 1, $y));
            $t = date("t", mktime(0, 0, 0, $i, 1, $y));
            $cq = mysqli_query($CNN, "SELECT * FROM ");
            ?>
            <div class="col-sm-3">
                <div class="web-calendar">
                    <div class="web-calendar-h">
                        <h4><?php echo date("M", mktime(0, 0, 0, $i, 1, 2015)); ?></h4>
                    </div>
                    <div class="web-calendar-b">
                        <table class="table table-condensed table-bordered">
                            <thead style="text-align:center;background-color:#039;color:#FFF;">
                                <tr>
                                    <td>D</td>
                                    <td>L</td>
                                    <td>M</td>
                                    <td>I</td>
                                    <td>J</td>
                                    <td>V</td>
                                    <td>S</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                    for ($j = 0; $j < $w; $j++) {
                                        echo '<td class="disabled">&nbsp;</td>';
                                    }
                                    for ($j = 1; $j < $t + 1; $j++) {
                                        $wo = date("w", mktime(0, 0, 0, $i, $j, $y));
                                        $date = date("Y-m-d", mktime(0, 0, 0, $i, $j, $y));
                                        if ($wo == 0) {
                                            echo "</tr><tr>";
                                        }
                                        echo "<td>$j</td>";
                                    }
                                    for ($k = $wo + 1; $k < 7; $k++) {
                                        echo '<td class="disabled">&nbsp;</td>';
                                    }
                                    ?>                                                                                        
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php
            if ($i == $mo + 3) {
                echo "</div><div class=\"row\">";
            }
        }
        ?>
    </div>
</div>