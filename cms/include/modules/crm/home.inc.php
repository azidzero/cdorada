<div class="input-group pull-right" style="width:240px;">
    <span class="input-group-addon"><i class="fa fa-search"></i></span>
    <input type="text" id="s" name="s" class="form-control" placeholder="buscador" />
</div>
<h4>Clientes Activos</h4>
<div id="clist" class="row-fluid"></div>
<script>
    $(document).ready(function () {
        getList("");
    });
    $('#s').keyup(function () {
        var s = $(this).val();
        getList(s);
    });
    function getList(str) {
        $.ajax({
            method: 'POST',
            url: 'include/modules/crm/filter.home.php',
            data: {search: str}
        }).done(function (response) {
            $('#clist').html(response);
        });
    }
</script><!-- -->