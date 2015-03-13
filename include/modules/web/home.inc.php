<!-- START FEATURED -->   
<div id="home" class="section">
    <div id="feat-list" class="featured-list">
        <div class="featured-item holderjs" style="background-image:url('cms/content/upload/item_000000.jpg')" >
            <div class="featured-title">
                <h1>Titulo<br/><small>Sub titulo</small></h1>
            </div>                        
        </div>                    
    </div>    
</div><!-- ### EOF FEATURED -->
<div id="rent" class="section">
    <h4>Renta</h4>
</div><!-- ### EOF RENT -->
<div id="sale" class="section">
    <h4>Venta</h4>
</div><!-- ### EOF SALE -->
<div id="deal" class="section">
    <h4>Ofertas</h4>
</div><!-- ### EOF DEAL -->
<div id="owner" class="section">
    <h4>Propietarios</h4>
</div><!-- ### EOF OWNER -->
<div id="about" class="section">
    <h4>Quienes Somos</h4>
</div><!-- ### EOF ABOUT -->
<div id="contacto" class="section">
    <h4>Contacto</h4>
    <div class="container-fluid">
        <div class="row-fluid">            
            <div class="col-sm-8">
                <form method="post" action="enviocontacto.php" id="datos">
                    <input type="hidden" value="es" name="lang">
                    <input type="hidden" id="id_captcha_codigo" name="captcha_codigo">
                    <table class="table table-condensed">
                        <tbody><tr>
                                <td class="txt_form">Ref. alojamiento</td>
                                <td><input type="text" value="" size="10" maxlength="10" class="form-control" name="ref" id="ref_contact_form"></td>
                                <td class="txt_form">Nombre</td>
                                <td><input type="text" maxlength="256" size="25" class="form-control" name="NOMBRE" id="nombre_contact_form"></td>
                                <td class="txt_form">E-mail</td>
                                <td><input type="text" maxlength="256" size="25" class="form-control" name="EMAIL" id="email_contact_form"></td>
                            </tr>
                            <tr>
                                <td cols valign="top" class="txt_form">Mensaje</td>
                                <td colspan="5"><textarea rows="5" cols="40" class="form-control" name="CONTENIDO" id="contenido_contact_form"></textarea></td>
                            </tr>                
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="col-sm-4">
                <h4><?php echo $wlang->getString("contact", "atencion-titulo"); ?></h4><!--  -->
                Lunes - Viernes: 08.30h - 13.00h y 15.30h - 19.00h<br/>
                Sábados: 10.00h - 14.00h

                <h4>Telefono(s)</h4>
                0034 977 395 854

                <h4>Correo Electronico</h4>
                info@planetgoldholidays.com

                <h4>Oficinas</h4>
                <strong>OFICINA PRINCIPAL</strong><br/>
                Rambla Catalunya nº 24<br/>43480 Vila-seca (Tarragona)<br/>
                España
            </div>
        </div>
    </div>

</div><!-- ### EOF CONTACTO -->