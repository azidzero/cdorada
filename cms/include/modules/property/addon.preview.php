<?php
echo "<b>VISTA PREVIA:</b>";
include("../../../inc/app.conf.php");
$op = filter_input(INPUT_POST, "op");
$med = filter_input(INPUT_POST, "med");
$ht = filter_input(INPUT_POST, "ht");
$adend = null;
$input = null;
if ($ht == 'true') {
    $input = "<input type'text' class='form-control' value='".random_lipsum()."' disabled>";
}
if ($med != null) {
    $adend = '<div class="input-group-addon">' . $med . '</div>' . $input;
}
else
{
     $adend = '<div class="input-group-addon"></div>' . $input;
}
if ($op != null) {
    switch ($op) {
        case 0:
            ?>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon text-uppercase">
                        <b><?php echo filter_input(INPUT_POST, "nm"); ?>:</b>
                        <input type="checkbox" value="1"checked>
                    </div>
                    
                    <?php echo $adend; ?>
                </div>
            </div>
            <?php
            break;
        case 1:
            ?>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon text-uppercase">
                        <b><?php echo filter_input(INPUT_POST, "nm"); ?>:</b>
                    </div>
                    <input type="number" class="form-control" value="<?php echo rand(0, 999); ?>">
                    <?php echo $adend; ?>
                </div>
            </div>
            <?php
            break;
        case 2:
            ?>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon alert-warning text-uppercase"><b><?php echo filter_input(INPUT_POST, "nm"); ?>:</b></div>
                    <input type="text" class="form-control" value="<?php echo random_lipsum(); ?>" readonly>
                    <?php echo $adend; ?>
                </div>
            </div>
            <?php
            break;
        case 3:
            ?>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon alert-warning text-uppercase">
                        <b><?php echo filter_input(INPUT_POST, "nm"); ?>:</b>
                    </div>
                    <select id="select_prueba" class="form-control" >
                        <option>case 1</option>
                        <option>case 1</option>
                        <option>case 1</option>
                    </select>
                    <?php echo $adend; ?>
                </div>
            </div>
            <?php
            break;
        case 4:
            ?>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon alert-warning text-uppercase"><b><?php echo filter_input(INPUT_POST, "nm"); ?>:</b></span>
                    <textarea id="texareaprueba" class="alert-warning"><?php echo random_lipsum(); ?></textarea>
                </div>
            </div>
            <?php
            break;
          case 5:
            ?>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon text-uppercase">
                        <b><?php echo filter_input(INPUT_POST, "nm"); ?>:</b>
                    </div>
                    <input type="number" class="form-control" value="<?php echo rand(0, 999); ?>">
                    <?php echo $adend; ?>
                </div>
            </div>
            <?php
            break;
    }
}