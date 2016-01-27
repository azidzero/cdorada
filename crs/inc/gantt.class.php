<?php

class gantt {

    function __construct() {
        
    }

    function render() {
        ?>
        <div>
            <div style="float:left;;width:40vw;overflow:auto;position: relative;font-size: 7pt;">
                <table cellpadding="0" cellspacing="0" width="100%;">
                    <thead>
                        <tr>
                            <td>&nbspM</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Propiedad 1</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="display: inline-table;width:50vw;overflow:auto;position: relative;">
                <?php
                $da = new DateTime("2015-02-22");
                $x = $da->format("z");
                $x = $x*24;
                $w = 7*24;
                $y = 24;
                ?>
                <div style="z-index:99;top:<?php echo $y;?>px;left:<?php echo $x;?>px;width:<?php echo $w;?>px;position:absolute;height:24px;border-radius:4px;background-color:#9F0;">Prueba</div>
                <table cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <?php
                            $ini = mktime(0, 0, 0, 01, 01, 2015);
                            $end = mktime(0, 0, 0, 12, 31, 2015);
                            $d = ($end - $ini) / (86400);
                            for ($col = 0; $col < $d; $col++) {
                                if ($col % 2 == 0) {
                                    $strip = "#39F";
                                } else {
                                    $strip = "#CCC";
                                }
                                $date = date("m-d", mktime(0, 0, 0, 1, 1 + $col, 2015));
                                ?>
                                <td style="margin:0px;padding:0px;width:24px !important;height:24px;background-color:#EFEFEF;font-size:7pt;">
                                    <div style="width:24px;height:24px;float:left;"><?php echo $date;?></div></td>
                                <?php
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    for ($i = 0; $i < 10; $i++) {
                        ?>
                        <tr>
                            <?php
                            $ini = mktime(0, 0, 0, 01, 01, 2015);
                            $end = mktime(0, 0, 0, 12, 31, 2015);
                            $d = ($end - $ini) / (86400);
                            for ($col = 0; $col < $d; $col++) {
                                if ($col % 2 == 0) {
                                    $strip = "#39F";
                                } else {
                                    $strip = "#CCC";
                                }
                                $date = date("m-d", mktime(0, 0, 0, 1, 1 + $col, 2015));
                                ?>
                                <td style="margin:0px;padding:0px;width:24px !important;height:24px;background-color:<?php echo $strip; ?>">
                                    <div style="width:24px;height:24px;float:left;"></div></td>
                                <?php
                            }
                            ?>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
    }

}

$gantt = new gantt;
$gantt->render();
