<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <script src="../js/jquery-1.11.2.min.js"></script>
    </head>
    <body>
        <input class="autosave" type="number" id="a_1" data-catalog="1" data-addon="1" data-property="1" value="2" />
        
        <script>
            $(document).ready(function(){
                $('.autosave').blur(function(){
                   var c=$(this).attr('data-catalog');
                   var a=$(this).attr('data-addon');
                   var p=$(this).attr('data-property');
                   var v = $(this).val();
                   autosave(c,a,p,v);
                });
            });
            function autosave(catalog,addon,property,value){
                alert('En el catalogo ' + catalog + " para el addon " + addon + " asignado a la propiedad " + property + " sele ha asignado el valor " + value);
            }
            </script>
    </body>
</html>