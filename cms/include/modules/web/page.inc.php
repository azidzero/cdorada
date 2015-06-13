<?php
switch ($o) {
    case 0:
        ?>
        <h4>Crear P&aacute;gina</h4>
        <table class="table table-condensed">
            <tr>
                <td>
                    <div class="input-group">
                        <span class="input-group-addon">Titulo</span>
                        <input type="text" class="form-control" />
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div id="alerts"></div>
                    <div class="btn-toolbar" data-role="editor-toolbar" data-target="#editor">
                        <div class="btn-group">
                            <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" title="Font">
                                <i class="fa fa-font"></i><b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a data-edit="fontName Arial">Arial</a></li>
                                <li><a data-edit="fontName Monospace">Monospace</a></li>
                            </ul>
                        </div>
                        <div class="btn-group">
                            <a class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                               title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a data-edit="fontSize 5"><font size="5">H1</font></a></li>
                                <li><a data-edit="fontSize 4"><font size="4">H2</font></a></li>
                                <li><a data-edit="fontSize 3"><font size="3">H3</font></a></li>
                                <li><a data-edit="fontSize 2"><font size="2">H4</font></a></li>
                                <li><a data-edit="fontSize 1"><font size="1">H5</font></a></li>
                            </ul>
                        </div>
                        <div class="btn-group">
                            <a class="btn btn-default" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                            <a class="btn btn-default" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                            <a class="btn btn-default" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                            <a class="btn btn-default" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                        </div>
                        <div class="btn-group">
                            <a class="btn btn-default" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
                            <a class="btn btn-default" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
                            <a class="btn btn-default" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-outdent"></i></a>
                            <a class="btn btn-default" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
                        </div>
                        <div class="btn-group">
                            <a class="btn btn-default" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                            <a class="btn btn-default" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                            <a class="btn btn-default" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
                            <a class="btn btn-default" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
                        </div>
                        <div class="btn-group">
                            <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="fa fa-link"></i></a>
                            <div class="dropdown-menu input-append">
                                <input class="span2" placeholder="URL" type="text" data-edit="createLink" />
                                <button class="btn" type="button">Add</button>
                            </div>
                        </div>

                        <div class="btn-group">
                            <a class="btn btn-default" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
                            <a class="btn btn-default" title="Insert picture (or just drag & drop)" id="pictureBtn"> <i class="fa fa-picture-o"></i>
                                <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" /></a>
                        </div>
                        <div class="btn-group">
                            <a class="btn btn-default" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                            <a class="btn btn-default" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                        </div>
                        <input class="pull-right" type="text" data-edit="inserttext" id="voiceBtn" x-webkit-speech="" />
                    </div>
                    <div id="editor" class="lead" placeholder="Go ahead&hellip;"></div>
                </td>
            </tr>
        </table>
        <script type='text/javascript'>$('#editor').wysiwyg();</script>
        <?php
        break; /* NEW */
    case 1:break; /* ADD */
    case 2:break; /* ADMIN */
    case 3:break; /* EDIT */
    case 4:break; /* UPDATE */
    case 5:break; /* DEL */
    case 6:break; /* DELETE */
}