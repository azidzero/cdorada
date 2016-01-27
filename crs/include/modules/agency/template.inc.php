<?php

$o = $_REQUEST["o"];
switch ($o) {
    case 0:
        ?>
        <table class="table table-condensed">
            <tr>
                <td width="50%" valign="top" align="left">
                    <button type="button" class="btn btn-primary pull-right"><i class="fa fa-globe"></i> Vista Previa</button>
                    <div class="input-group">
                        <span class="input-group-addon">Nueva Plantilla</span>
                        <input type="text" placeholder="Nombre del Documento" id="document_name" name="document_name" class="form-control" />
                    </div>
                    <table class="table table-condensed">
                        <tr>
                            <td><button onclick="addPage()" type="button" class="btn btn-primary"><i class="fa fa-pagelines"></i> Agregar Pagina</button></td>
                        </tr>
                    </table>
                    <div>
                        <ul id="pagestab" class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#page1" aria-controls="page1" role="tab" data-toggle="tab">Pagina 1</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div id="pages" class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="page1">
                                <textarea name="txtpage1" id="txtpage1"></textarea>
                            </div>
                        </div>
                    </div>
                    <script>
                        var pages = 1;
                        $(document).ready(function () {
                            $('#txtpage1').summernote({height: 240});
                        });
                        function addPage() {
                            var pageno = $('#pages').children('div');
                            console.log(pageno);
                            pageno = pageno.length + 1;
                            var ahtm = "<li role=\"presentation\" class=\"\"><a href=\"#page" + pageno + "\" aria-controls= \"page" + pageno + "\" role=\"tab\" data-toggle=\"tab\">Pagina " + pageno + "</a></li>";
                            $('#pagestab').append(ahtm);
                            var bhtm = "<div role=\"tabpanel\" class=\"tab-pane\" id=\"page" + pageno + "\">";
                            bhtm += "<textarea name=\"txtpage" + pageno + "\" id=\"txtpage" + pageno + "\"></textarea>";
                            bhtm += "</div>";                            
                            $('#pages').append(bhtm);
                            $('#txtpage' + pageno).summernote({height: 240});
                        }
                        function removePage() {

                        }
                    </script>
                </td>
                <td width="50%" valign="top" align="left">
                    <div id="preview">

                    </div>
                </td>
            </tr>
        </table>
        <?php

        break;
}