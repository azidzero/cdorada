<?php
include("home.section.php");
echo '<div class="section"><i class="fa fa-chevron-circle-down"></i></div>';
// include("property.section.php");
// echo '<div class="section">&nbsp;</div>';
include("deal.section.php");
// echo '<div class="section">&nbsp;</div>';
// include("owner.section.php");
echo '<div class="section">&nbsp;';
echo '</div>';
// include("activity.section.php");
// echo '<div class="section">&nbsp;';
// echo '</div>';
// include("info.section.php");
// echo '<div class="section">&nbsp;';
// echo '</div>';
include("about.section.php");
echo '<div class="section">&nbsp;';
echo '</div>';
include("contact.section.php");
?>
<script>
    $(document).ready(function () {
        var h = $(window).height();
        //$('section.section').css('min-height', h + 'px');
    });
    $(window).resize(function () {
        var h = $(window).height();
        //$('section.section').css('min-height', h + 'px');
    });
</script>