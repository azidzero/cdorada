<section>
    <div class="alert alert-danger">
        <h1>ERROR</h1>
        <p>
            No existe o el modulo no se encuentra disponible: <?php echo $m; ?>/<?php echo $s; ?>/
        </p>
        <pre>
            <?php print_r($_REQUEST); ?>
        </pre>
    </div>
</section>