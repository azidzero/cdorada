<?php
$noq = mysqli_query($CNN, "SELECT * from cms_property_gallery WHERE pid='$id'") or die(mysqli_error($CNN));
$num = mysqli_num_rows($noq);
if ($num > 0) {
    ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title"><?php echo $wlang->getString("moreinfo", "str-photo"); ?></h4>    
        </div>
        <div class="panel-body">
            <div class="banner">
                <ul>
                    <?php
                    while ($or = mysqli_fetch_array($noq)) {
                        $ref = $or["name"] . "_b.jpg";
                        $file = '/cms/content/upload/property/' . $ref;
                        ?>
                        <li>
                            <img src="<?php echo $file; ?>" style="min-height: 240px;" width="100%" /></li>
                            <?php
                        }
                        ?>
                </ul>        
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.banner').unslider({
                autoplay: true, arrows: false, nav: false
            });
        });
    </script>
    <?php
} else {
    ?>
    <h4><?php echo $wlang->getString("moreinfo", "str-no-photo"); ?></h4>
    <?php
}
?>