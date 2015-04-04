<?php
include("home.section.php");
include("rent.section.php");
include("sale.section.php");
include("deal.section.php");
include("owner.section.php");
include("about.section.php");
include("content.section.php");
include("contact.section.php");
?>
<script>
    $(document).ready(function () {
        $(window).scroll(function () {
            var se = $("section");
            var n = se.length;
            for (i = 0; i < n; i++) {
                var el = $(se[i]).attr('id');
                var y = $(se[i]).offset().top;
                var h = $(se[i]).height();
                if (actualY >= y && actualY <= y + h) {
                    actualS = el;
                    if (el == "home") {
                        $('body').vegas('play');
                    } else {
                        $('body').vegas('pause');
                    }
                }

            }

        });
    });
</script>