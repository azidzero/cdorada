<!-- ##### START HOME -->
<section class="section" id="home">    
    <div class="container">
        <div id="sucon">
            <?php
            for ($i = 0; $i < 6; $i++) {
                ?>
                <div id="su_<?php echo $i; ?>" class="su">
                    <h1>Titulo <?php echo $i; ?>! <small>Autor</small></h1>
                    <table class="table table-condensed">
                        <tr>
                            <td><i class="fa fa-group"></i> <strong>4</strong></td>
                            <td><i class="fa fa-bed"></i> <strong>2</strong></td>
                            <td><i class="fa fa-angle-double-up"></i> <strong>2</strong></td>
                            <td><i class="fa fa-map-marker"></i> <strong>Lugar en el que se encuentra</strong></td>
                        </tr>
                    </table>
                    <p style="text-align: justify;">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at ornare orci. 
                        Sed dignissim pulvinar accumsan. Maecenas ut orci non arcu porta posuere eget et sapien. 
                        Nam consequat ex vel congue vehicula. Integer tristique dolor id quam viverra, eu laoreet 
                        ligula eleifend. Interdum et malesuada fames ac ante ipsum primis in faucibus.
                    </p>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        $('body').vegas({
            slides: [
                {src: 'cms/content/upload/item_000001.jpg', delay: 4000}, // STR_PAD 6 de ID; Delay
                {src: 'cms/content/upload/item_000002.jpg', delay: 4000},
                {src: 'cms/content/upload/item_000003.jpg', delay: 4000},
                {src: 'cms/content/upload/item_000004.jpg', delay: 4000},
                {src: 'cms/content/upload/item_000005.jpg', delay: 4000}
            ],
            animation: ['kenburnsUp', 'kenburnsDown', 'kenburnsLeft', 'kenburnsRight'],
            transition: ['fade', 'zoomOut', 'swirlLeft', 'zoomIn', 'swirlRight'],
            walk: function (index, slideSettings) {
                $('.su').css('right', '-100%').css('display','none');
                $('#su_' + index).css('right', '0px').css('display','block');
            }
        });
    });
</script><!-- ##### EOF HOME -->