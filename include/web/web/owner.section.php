<?php
$swq = mysqli_query($CNN, "SELECT * from web_content_translate WHERE uid='1' AND lang='$lang'") or die(mysqli_error());
while ($swr = mysqli_fetch_array($swq)) {
    $setitle = $swr['title'];
    $secontent = $swr['content'];
}
?>
<section id="owner" style="background-image:url('images/background-owner-<?php echo $lang; ?>.jpg')">
    <div class="container">        
        <div class="row-fluid">
            <div class="col-sm-4">
                <h3><?php echo $setitle; ?></h3>
            </div>
            <div class="col-sm-8" style="background:rgba(255,255,255,0.5)"><?php echo $secontent; ?></div>
        </div>
    </div>
</section>