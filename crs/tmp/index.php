<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="../css/custom-theme/jquery-ui-1.9.2.custom.css" />
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="../css/todc-bootstrap.min.css" />
        <link rel="stylesheet" href="../css/font-awesome.min.css" />

        <script type="text/javascript" src="../js/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="../js/jquery-ui-1.9.2.custom.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>

    </head>
    <body>

        <table class="table table-condensed">
            <thead>
                <tr>
                    <td>Caption 
                        <button onclick="showDetail('1')" id="btn-1" type="button" class="pull-right btn btn-xs btn-primary"><i class="fa fa-chevron-down"></i></button>
                        <!-- Single button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            </thead>
        </table>
        <script>
            function showDetail(id) {
                var a = $('#btn-' + id).hasClass('open');
                if (a == true) {
                    $('#btn-' + id).removeClass('open').html('<i class="fa fa-chevron-down"></i>');
                    $('#details-' + id).remove();
                } else {
                    $('#btn-' + id).addClass('open').html('<i class="fa fa-chevron-up"></i>');
                    $, ajax({
                        url: '',
                        data: {'id': id}
                    }).done(function (content) {
                        ctl = content;
                    });
                    $('#btn-' + id).parent().parent().after(ctl);
                }
            }
        </script>
    </body>
</html>