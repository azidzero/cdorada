<div class="login-area">
    <div style="margin-top:-64px;">
        <img src="images/login.png" width="96" style="margin:16px;" />
    </div>
    <table class="table table-condensed">
        <tr>
            <td width="1" rowspan="3" style="text-align: center;">
                <img id="upicture" data-src="holder.js/96x96?theme=sky&text=USUARIO" class="img-circle" />
            </td>
            <td>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Nombre de Usuario" />
                </div>
            </td>
            <td>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input type="password" id="userpass" name="userpass" class="form-control" placeholder="Contrase&ntilde;a" />
                </div>
            </td>
        </tr>        
        <tr>
            <td colspan="2">
                <button class="btn btn-default btn-block" type="button" onclick="doLogin()">Iniciar Sesi&oacute;n</button>
            </td>
        </tr>
    </table>
    <input type="hidden" id="epassword" name="epassword" value="0" />
</div>
<script src="js/login.js"></script>