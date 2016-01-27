<?php
switch ($o) {
    case 0:
        $lq = mysqli_query($CNN, "SELECT * from cms_translation_lang WHERE status=1");
        $language = array();
        while ($lr = mysqli_fetch_array($lq)) {
            $language[] = $lr['iso_639_1'];
        }
        ?>
        <form action="./?m=web&s=content&o=1" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="id" name="id" value="1" />
            <h4><small>&Aacute;rea</small> Propietarios</h4>
            <div>
                <ul class="nav nav-tabs" role="tablist">
                    <?php
                    foreach ($language as $L) {
                        ?>
                        <li role="presentation" class="<?php
                        if ($L == "es") {
                            echo "active";
                        }
                        ?>">
                            <a href="#tab_<?php echo $L; ?>" aria-controls="tab_<?php echo $L; ?>" role="tab" data-toggle="tab">
                                <?php echo $L; ?>
                                <?php if ($L == "es") { ?>
                                    <span class="label label-danger"><?php echo $lang->getString("activity", "post-label-required"); ?></span>
                                    <?php
                                }
                                ?>
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
                <div class="tab-content">
                    <?php
                    foreach ($language as $L) {
                        $q = mysqli_query($CNN, "SELECT * from web_content_translate WHERE uid='1' and lang='$L'") or die(mysqli_error($CNN));
                        $lan = Array(
                            'title' => '',
                            'content' => ''
                        );
                        $ln = mysqli_num_rows($q);
                        if ($ln > 0) {
                            while ($r = mysqli_fetch_array($q)) {
                                $lan['title'] = $r['title'];
                                $lan['content'] = $r['content'];
                            }
                        }
                        ?>
                        <div role="tabpanel" class="tab-pane <?php
                        if ($L == "es") {
                            echo "active";
                        }
                        ?>" id="tab_<?php echo $L; ?>">
                            <table class="table table-condensed">
                                <tr>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-addon">Titulo</span>
                                            <input type="text" id="post-title-<?php echo $L; ?>" name="post-title-<?php echo $L; ?>" class="form-control" value="<?php echo $lan["title"]; ?>" />
                                        </div>
                                    </td>                                
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-addon">Imagen de fondo</span>
                                            <input type="file" name="post-background-<?php echo $L; ?>" id="post-background-<?php echo $L; ?>" class="form-control" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <input type="hidden" id="post-content-<?php echo $L; ?>" name="post-content-<?php echo $L; ?>" />
                                        <strong><?php echo $lang->getString("activity", "post-content"); ?></strong>
                                        <div id="post-content-editor-<?php echo $L; ?>"><?php echo $lan["content"]; ?></div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="well well-sm">
                <button class="btn btn-primary" onclick="unifiyContent()"><?php echo $lang->getString("activity", "post-btn-save"); ?></button>
            </div>
        </form>        
        <script>
            function unifiyContent() {
                $('#post-content-es').val($('#post-content-editor-es').code());
                $('#post-content-en').val($('#post-content-editor-en').code());
                $('#post-content-fr').val($('#post-content-editor-fr').code());
                $('#post-content-ru').val($('#post-content-editor-ru').code());
            }
            $(document).ready(function () {
                $('#post-content-editor-es').summernote({height: 240});
                $('#post-content-editor-en').summernote({height: 240});
                $('#post-content-editor-fr').summernote({height: 240});
                $('#post-content-editor-ru').summernote({height: 240});
            });
            function showCat(lang) {
                $.ajax({
                    method: 'POST',
                    url: 'include/modules/web/cat.admin.php',
                    data: {language: lang}
                }).done(function (response) {
                    console.log(response);
                });
            }
        </script>
        <?php
        break;
    case 1:
        $id = filter_input(INPUT_POST, "id");
        $language = array();
        $lq = mysqli_query($CNN, "SELECT * from cms_translation_lang WHERE status=1");
        while ($lr = mysqli_fetch_array($lq)) {
            $language[] = $lr['iso_639_1'];
        }
        foreach ($language as $L) {
            $q = mysqli_query($CNN, "SELECT * from web_content_translate WHERE uid='$id' AND lang='$L'");
            $N = mysqli_num_rows($q);
            $title = filter_input(INPUT_POST, "post-title-" . $L);
            $content = filter_input(INPUT_POST, "post-content-" . $L);
            if ($N > 0) {
                //$title = mysqli_real_escape_string($CNN, $title);
                $content = mysqli_real_escape_string($CNN, $content);
                mysqli_query($CNN, "UPDATE web_content_translate SET title='$title',content='$content' WHERE uid='$id' AND lang='$L'") or die(mysqli_error($CNN));
                echo "<h4>Se ha actualizado la informacion para $title [$L]</h4>";
            } else {
                // $title = mysqli_real_escape_string($CNN, $title);
                $content = mysqli_real_escape_string($CNN, $content);
                mysqli_query($CNN, "INSERT INTO web_content_translate(uid,lang,title,content) VALUES('1','$L','$title','$content')") or die(mysqli_error($CNN));
                echo "<h4>Se ha creado la informacion para $title [$L]</h4>";
            }
            if ($_FILES["post-background-$L"]["error"] == 0) {
                $path = "../images/background-owner-$L.jpg";
                if (move_uploaded_file($_FILES['post-background-' . $L]['tmp_name'], $path)) {
                    echo "Imagen de fondo importada para <strong>[$L]</strong><br/>";
                } else {
                    echo "<b class=\"text-danger\">No se pudo actualizar la imagen de fondo para $L</b><br/>";
                }
            }
        }
        break;
    case 2:
        $lq = mysqli_query($CNN, "SELECT * from cms_translation_lang WHERE status=1");
        $language = array();
        while ($lr = mysqli_fetch_array($lq)) {
            $language[] = $lr['iso_639_1'];
        }
        ?>
        <form action="./?m=web&s=content&o=3" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="id" name="id" value="1" />
            <h4><small>&Aacute;rea</small> Quienes somos?</h4>
            <div>
                <ul class="nav nav-tabs" role="tablist">
                    <?php
                    foreach ($language as $L) {
                        ?>
                        <li role="presentation" class="<?php
                        if ($L == "es") {
                            echo "active";
                        }
                        ?>">
                            <a href="#tab_<?php echo $L; ?>" aria-controls="tab_<?php echo $L; ?>" role="tab" data-toggle="tab">
                                <?php echo $L; ?>
                                <?php if ($L == "es") { ?>
                                    <span class="label label-danger"><?php echo $lang->getString("activity", "post-label-required"); ?></span>
                                    <?php
                                }
                                ?>
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
                <div class="tab-content">
                    <?php
                    foreach ($language as $L) {
                        $q = mysqli_query($CNN, "SELECT * from web_content_translate WHERE uid='2' and lang='$L'") or die(mysqli_error($CNN));
                        $lan = Array(
                            'title' => '',
                            'content' => ''
                        );
                        $ln = mysqli_num_rows($q);
                        if ($ln > 0) {
                            while ($r = mysqli_fetch_array($q)) {
                                $lan['title'] = $r['title'];
                                $lan['content'] = $r['content'];
                            }
                        }
                        ?>
                        <div role="tabpanel" class="tab-pane <?php
                        if ($L == "es") {
                            echo "active";
                        }
                        ?>" id="tab_<?php echo $L; ?>">
                            <table class="table table-condensed">
                                <tr>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-addon">Titulo</span>
                                            <input type="text" id="post-title-<?php echo $L; ?>" name="post-title-<?php echo $L; ?>" class="form-control" value="<?php echo $lan["title"]; ?>" />
                                        </div>
                                    </td>                                
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-addon">Imagen de fondo</span>
                                            <input type="file" name="post-background-<?php echo $L; ?>" id="post-background-<?php echo $L; ?>" class="form-control" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <input type="hidden" id="post-content-<?php echo $L; ?>" name="post-content-<?php echo $L; ?>" />
                                        <strong><?php echo $lang->getString("activity", "post-content"); ?></strong>
                                        <div id="post-content-editor-<?php echo $L; ?>"><?php echo $lan["content"]; ?></div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="well well-sm">
                <button class="btn btn-primary" onclick="unifiyContent()"><?php echo $lang->getString("activity", "post-btn-save"); ?></button>
            </div>
        </form>        
        <script>
            function unifiyContent() {
                $('#post-content-es').val($('#post-content-editor-es').code());
                $('#post-content-en').val($('#post-content-editor-en').code());
                $('#post-content-fr').val($('#post-content-editor-fr').code());
                $('#post-content-ru').val($('#post-content-editor-ru').code());
            }
            $(document).ready(function () {
                $('#post-content-editor-es').summernote({height: 240});
                $('#post-content-editor-en').summernote({height: 240});
                $('#post-content-editor-fr').summernote({height: 240});
                $('#post-content-editor-ru').summernote({height: 240});
            });
            function showCat(lang) {
                $.ajax({
                    method: 'POST',
                    url: 'include/modules/web/cat.admin.php',
                    data: {language: lang}
                }).done(function (response) {
                    console.log(response);
                });
            }
        </script>
        <?php
        break;
    case 3:
        $id = filter_input(INPUT_POST, "id");
        $language = array();
        $lq = mysqli_query($CNN, "SELECT * from cms_translation_lang WHERE status=1");
        while ($lr = mysqli_fetch_array($lq)) {
            $language[] = $lr['iso_639_1'];
        }
        foreach ($language as $L) {
            $q = mysqli_query($CNN, "SELECT * from web_content_translate WHERE uid='2' AND lang='$L'");
            $N = mysqli_num_rows($q);
            $title = filter_input(INPUT_POST, "post-title-" . $L);
            $content = filter_input(INPUT_POST, "post-content-" . $L);
            if ($N > 0) {
                //$title = mysqli_real_escape_string($CNN, $title);
                $content = mysqli_real_escape_string($CNN, $content);
                mysqli_query($CNN, "UPDATE web_content_translate SET title='$title',content='$content' WHERE uid='2' AND lang='$L'") or die(mysqli_error($CNN));
                echo "<h4>Se ha actualizado la informacion para $title [$L]</h4>";
            } else {
                // $title = mysqli_real_escape_string($CNN, $title);
                $content = mysqli_real_escape_string($CNN, $content);
                mysqli_query($CNN, "INSERT INTO web_content_translate(uid,lang,title,content) VALUES('2','$L','$title','$content')") or die(mysqli_error($CNN));
                echo "<h4>Se ha creado la informacion para $title [$L]</h4>";
            }
            if ($_FILES["post-background-$L"]["error"] == 0) {
                $path = "../images/background-about-$L.jpg";
                if (move_uploaded_file($_FILES['post-background-' . $L]['tmp_name'], $path)) {
                    echo "Imagen de fondo importada para <strong>[$L]</strong><br/>";
                } else {
                    echo "<b class=\"text-danger\">No se pudo actualizar la imagen de fondo para $L</b><br/>";
                }
            }
        }
        break;
}