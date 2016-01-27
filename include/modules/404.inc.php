<section  id="ERROR404" style="margin-top:120px;">
    
    <div class="alert alert-danger">
        <h1>ERROR</h1>
        <p>
            No existe o el modulo no se encuentra disponible: <b><?php echo $m; ?>/<?php echo $s; ?></b>
        </p>
        <pre>
            <?php print_r($_REQUEST); ?>
        </pre>
    </div>
</section>