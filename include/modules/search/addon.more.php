<div class="container-fluid">
    <div class="row-fluid">
        <h4><?php echo $wlang->getString("moreinfo", "str-detail"); ?></h4>
        <?php
        $q = mysqli_query($CNN, "SELECT * from cms_catalog");
        while ($r = mysqli_fetch_array($q)) {
            if ($lang == "es") {
                $str = $r["common"];
            } else {
                $str = getData("cms_catalog_translate", array("aid", "lang"), array($r["id"], $lang), "caption");
            }
            ?>
            <div class="panel panel-primary" style="font-size: 8pt;">
                <div class="panel-heading">
                    <h4 class="panel-title"><small>&Aacute;REA</small> <?php echo $str; ?></h4>
                </div>
                <div class="panel-body">
                    <?php
                    echo "<div class=\"row\">";
                    $sq = mysqli_query($CNN, "SELECT * from cms_addons WHERE cid='{$r["id"]}'");
                    while ($sr = mysqli_fetch_array($sq)) {
                        
                        $label = getData('cms_addon_translate', array('aid', 'lang'), array($sr["id"], $lang), 'caption');
                        echo "<div class=\"col-sm-3\">";
                        switch ($sr["tipo"]) {
                            case 0: // Si / No
                                if($sr["valor"]=="0"){
                                    echo "<span class=\"label label-default pull-right\"><i class=\"fa fa-check disabled\"></i></span>";                                
                                }else{
                                    echo "<span class=\"label label-primary pull-right\"><i class=\"fa fa-check\"></i></span>";                                
                                }
                                break;
                            case 1: // Numerico
                                echo "<span class=\"label label-primary pull-right\">{$sr["valor"]}</span>";                                
                                break;
                            case 2: // String
                                echo "<span class=\"label label-primary pull-right\">{$sr["valor"]}</span>";                                
                                break;
                            
                        }
                        echo $label;
                        echo "</div>";
                    }
                    echo "</div>";
                    ?>
                </div>
            </div>
            <?php
        }
        ?>

        <?php
        /*
          $q = mysqli_query($CNN, "SELECT * from cms_catalog");
          while ($r = mysqli_fetch_array($q)) {

          ?>
          <p><b><?php echo $str; ?></b></p>
          <table class="table table-condensed">
          <tr>
          <?php
          $nox = 0;
          $sq = mysqli_query($CNN, "SELECT * from cms_addons WHERE cid='{$r["id"]}'");
          while ($sr = mysqli_fetch_array($sq)) {
          $label = getData("cms_addon_translate", array('aid', 'lang'), array($sr["id"], $lang), "caption");
          $ot = $sr["tipo"];
          ?>
          <td width="1">
          <?php
          if ($ot != "0") {
          echo "<span class=\"label label-invert\">{$or["valor"]}</span>";
          } else {
          switch ($or["valor"]) {
          case '0': echo "<i class=\"fa fa-minus-square text-danger\"></i>";
          break;
          case '1': echo "<i class=\"fa fa-check-square text-success\"></i>";
          break;
          }
          }
          ?>
          </td>
          <td><?php echo $label; ?></td>
          <?php
          if ($nox % 4 == 0) {
          echo "</tr><tr>";
          $nox = 1;
          } else {
          $nox++;
          }
          }
          }
          ?>
          </tr>
          </table>
          <?php ?>
         */
        ?>
    </div>
</div>