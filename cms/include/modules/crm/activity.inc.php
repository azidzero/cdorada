
<?php
switch ($o) {
    case 0:
        ?>
        <form id="frmService" action="./?m=activities&s=activity&o=1" method="post" >
            <div class="row-fluid">
                <div  class="col-sm-6">
                    <strong>INFORMACI&Oacute;N DE LA ACTIVIDAD</strong>
                    <div class="row-fluid">
                
                    <table class="table table-condensed" style="font-size: 9pt;" >                   
                        <tbody>
                           <tr>
                                <td>
                                    
                                    <div class="input-group">
                                        <span class="input-group-addon">T&iacute;tulo de la actividad</span>
                                        <input type="text" id="title" name="title" class="form-control" placeholder="" />
                                    </div>
                                    
                                </td>
                                
                            </tr>
                            <tr>
                                <td>
                                    <div class="input-group">
                                        <span class="input-group-addon">Categor&iacute;a de la actividad</span>
                                        <select id="category" name="category" class="form-control">
                                            <option value="0">Llamada telefónica</option>
                                            <option value="1">Oportunidad</option>
                                            <option value="2">Demostración</option>
                                            <option value="3">Email</option>
                                            <option value="4">Fax</option>
                                            <option value="5">Ejecución de control</option>
                                            <option value="6">Almuerzo</option>
                                            <option value="7">Cita</option>
                                            <option value="8">Nota</option>
                                            <option value="9">Entrega</option>
                                            <option value="10">Redes sociales</option>
                                            <option value="11">Expresión de gratitud</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="input-group">
                                <span class="input-group-addon">Vincular con una empresa/persona:</span>
                                <select id="company" name="company" class="form-control">
                                             <?php
                                                function db_createlist($linkID,$default,$query,$blank)
                                                {
                                                    if($blank)
                                                    {
                                                        print("<option select value=\"0\">$blank</option>");
                                                    }

                                                    $resultID = mysqli_query($linkID,$query);
                                                    $num       = mysqli_num_rows($resultID);
                                                    
                                                    print("<option style='background-image:url(images/emp.png); background-repeat: no-repeat; background-position: right; font-weight: bold;'>Empresa</option>");

                                                    for ($i=0;$i<$num;$i++)
                                                    {
                                                        $row = mysqli_fetch_row($resultID);
                                                        if($row[1] == "emp"){
                                                            print("<option  value=\"$row[0]\">$row[0]</option>");
                                                        }
                                                        else {
                                                            break;
                                                        }
                                                    }
                                                    print("<option style='background-image:url(images/user.png); background-repeat: no-repeat; background-position: right; font-weight: bold;' >Contacto</option>");
                                                    
                                                    for($j=0;$j<$num;$j++){
                                                         $row1 = mysqli_fetch_row($resultID);
                                                        if($row1[1] == "cont"){
                                                             print("<option value=\"$row1[0]\">$row1[0]</option>");
                                                        }
                                                        else {
                                                            break;
                                                        }
                                                    }
                                                }
                                                ?> 
                                            <?php 
    // default is 0, no entry will be selected.
                                                db_createlist($CNN,0,
                                                        "select nom, tipo from (select name as nom, 'emp' AS tipo from crm_company UNION select name, 'cont' AS tipo from crm_contact) as g","Sleccione una persona...");
                                            ?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                             <tr>
                                <td>
                                    <div class="col-sm-6" style="z-index: 2;">
                                        <div class="input-group">
                                            <span class="input-group-addon">Fecha actividad:</span>
                                            <input type="text" id="datepicker" name="datepicker" >
                                            <span class="input-group-addon">Horario:</span>
                                            <select onchange="ASC.CRM.TaskActionView.changeTime(this);" style="width:45px;" id="taskDeadlineHours" name="taskDeadlineHours" class="comboBox"><option id="optDeadlineHours_-1" value="-1" selected="selected">--</option><option id="optDeadlineHours_0" value="0">00</option><option id="optDeadlineHours_1" value="1">01</option><option id="optDeadlineHours_2" value="2">02</option><option id="optDeadlineHours_3" value="3">03</option><option id="optDeadlineHours_4" value="4">04</option><option id="optDeadlineHours_5" value="5">05</option><option id="optDeadlineHours_6" value="6">06</option><option id="optDeadlineHours_7" value="7">07</option><option id="optDeadlineHours_8" value="8">08</option><option id="optDeadlineHours_9" value="9">09</option><option id="optDeadlineHours_10" value="10">10</option><option id="optDeadlineHours_11" value="11">11</option><option id="optDeadlineHours_12" value="12">12</option><option id="optDeadlineHours_13" value="13">13</option><option id="optDeadlineHours_14" value="14">14</option><option id="optDeadlineHours_15" value="15">15</option><option id="optDeadlineHours_16" value="16">16</option><option id="optDeadlineHours_17" value="17">17</option><option id="optDeadlineHours_18" value="18">18</option><option id="optDeadlineHours_19" value="19">19</option><option id="optDeadlineHours_20" value="20">20</option><option id="optDeadlineHours_21" value="21">21</option><option id="optDeadlineHours_22" value="22">22</option><option id="optDeadlineHours_23" value="23">23</option></select>
                                            <span class="input-group-addon">:</span>
                                            <select onchange="ASC.CRM.TaskActionView.changeTime(this);" style="width:45px;" id="taskDeadlineMinutes" name="taskDeadlineMinutes" class="comboBox"><option id="optDeadlineMinutes_-1" value="-1" selected="selected">--</option><option id="optDeadlineMinutes_0" value="0">00</option><option id="optDeadlineMinutes_1" value="1">01</option><option id="optDeadlineMinutes_2" value="2">02</option><option id="optDeadlineMinutes_3" value="3">03</option><option id="optDeadlineMinutes_4" value="4">04</option><option id="optDeadlineMinutes_5" value="5">05</option><option id="optDeadlineMinutes_6" value="6">06</option><option id="optDeadlineMinutes_7" value="7">07</option><option id="optDeadlineMinutes_8" value="8">08</option><option id="optDeadlineMinutes_9" value="9">09</option><option id="optDeadlineMinutes_10" value="10">10</option><option id="optDeadlineMinutes_11" value="11">11</option><option id="optDeadlineMinutes_12" value="12">12</option><option id="optDeadlineMinutes_13" value="13">13</option><option id="optDeadlineMinutes_14" value="14">14</option><option id="optDeadlineMinutes_15" value="15">15</option><option id="optDeadlineMinutes_16" value="16">16</option><option id="optDeadlineMinutes_17" value="17">17</option><option id="optDeadlineMinutes_18" value="18">18</option><option id="optDeadlineMinutes_19" value="19">19</option><option id="optDeadlineMinutes_20" value="20">20</option><option id="optDeadlineMinutes_21" value="21">21</option><option id="optDeadlineMinutes_22" value="22">22</option><option id="optDeadlineMinutes_23" value="23">23</option><option id="optDeadlineMinutes_24" value="24">24</option><option id="optDeadlineMinutes_25" value="25">25</option><option id="optDeadlineMinutes_26" value="26">26</option><option id="optDeadlineMinutes_27" value="27">27</option><option id="optDeadlineMinutes_28" value="28">28</option><option id="optDeadlineMinutes_29" value="29">29</option><option id="optDeadlineMinutes_30" value="30">30</option><option id="optDeadlineMinutes_31" value="31">31</option><option id="optDeadlineMinutes_32" value="32">32</option><option id="optDeadlineMinutes_33" value="33">33</option><option id="optDeadlineMinutes_34" value="34">34</option><option id="optDeadlineMinutes_35" value="35">35</option><option id="optDeadlineMinutes_36" value="36">36</option><option id="optDeadlineMinutes_37" value="37">37</option><option id="optDeadlineMinutes_38" value="38">38</option><option id="optDeadlineMinutes_39" value="39">39</option><option id="optDeadlineMinutes_40" value="40">40</option><option id="optDeadlineMinutes_41" value="41">41</option><option id="optDeadlineMinutes_42" value="42">42</option><option id="optDeadlineMinutes_43" value="43">43</option><option id="optDeadlineMinutes_44" value="44">44</option><option id="optDeadlineMinutes_45" value="45">45</option><option id="optDeadlineMinutes_46" value="46">46</option><option id="optDeadlineMinutes_47" value="47">47</option><option id="optDeadlineMinutes_48" value="48">48</option><option id="optDeadlineMinutes_49" value="49">49</option><option id="optDeadlineMinutes_50" value="50">50</option><option id="optDeadlineMinutes_51" value="51">51</option><option id="optDeadlineMinutes_52" value="52">52</option><option id="optDeadlineMinutes_53" value="53">53</option><option id="optDeadlineMinutes_54" value="54">54</option><option id="optDeadlineMinutes_55" value="55">55</option><option id="optDeadlineMinutes_56" value="56">56</option><option id="optDeadlineMinutes_57" value="57">57</option><option id="optDeadlineMinutes_58" value="58">58</option><option id="optDeadlineMinutes_59" value="59">59</option></select>
                                        </div>
                                        
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="col-sm-6" style="z-index: 2;">
                                        <div class="input-group">
                                            <span class="input-group-addon">Fin de la actividad:</span>
                                            <input type="text" id="dtpEndDateActivity" name="dtpEndDateActivity" >
                                            <span class="input-group-addon">Horario:</span>
                                            <select onchange="ASC.CRM.TaskActionView.changeTime(this);" style="width:45px;" id="taskDlHEndAct" name="taskDlHEndAct" class="comboBox"><option id="optDeadlineHours_-1" value="-1" selected="selected">--</option><option id="optDeadlineHours_0" value="0">00</option><option id="optDeadlineHours_1" value="1">01</option><option id="optDeadlineHours_2" value="2">02</option><option id="optDeadlineHours_3" value="3">03</option><option id="optDeadlineHours_4" value="4">04</option><option id="optDeadlineHours_5" value="5">05</option><option id="optDeadlineHours_6" value="6">06</option><option id="optDeadlineHours_7" value="7">07</option><option id="optDeadlineHours_8" value="8">08</option><option id="optDeadlineHours_9" value="9">09</option><option id="optDeadlineHours_10" value="10">10</option><option id="optDeadlineHours_11" value="11">11</option><option id="optDeadlineHours_12" value="12">12</option><option id="optDeadlineHours_13" value="13">13</option><option id="optDeadlineHours_14" value="14">14</option><option id="optDeadlineHours_15" value="15">15</option><option id="optDeadlineHours_16" value="16">16</option><option id="optDeadlineHours_17" value="17">17</option><option id="optDeadlineHours_18" value="18">18</option><option id="optDeadlineHours_19" value="19">19</option><option id="optDeadlineHours_20" value="20">20</option><option id="optDeadlineHours_21" value="21">21</option><option id="optDeadlineHours_22" value="22">22</option><option id="optDeadlineHours_23" value="23">23</option></select>
                                            <span class="input-group-addon">:</span>
                                            <select onchange="ASC.CRM.TaskActionView.changeTime(this);" style="width:45px;" id="taskDlMEndAct" name="taskDlMEndAct" class="comboBox"><option id="optDeadlineMinutes_-1" value="-1" selected="selected">--</option><option id="optDeadlineMinutes_0" value="0">00</option><option id="optDeadlineMinutes_1" value="1">01</option><option id="optDeadlineMinutes_2" value="2">02</option><option id="optDeadlineMinutes_3" value="3">03</option><option id="optDeadlineMinutes_4" value="4">04</option><option id="optDeadlineMinutes_5" value="5">05</option><option id="optDeadlineMinutes_6" value="6">06</option><option id="optDeadlineMinutes_7" value="7">07</option><option id="optDeadlineMinutes_8" value="8">08</option><option id="optDeadlineMinutes_9" value="9">09</option><option id="optDeadlineMinutes_10" value="10">10</option><option id="optDeadlineMinutes_11" value="11">11</option><option id="optDeadlineMinutes_12" value="12">12</option><option id="optDeadlineMinutes_13" value="13">13</option><option id="optDeadlineMinutes_14" value="14">14</option><option id="optDeadlineMinutes_15" value="15">15</option><option id="optDeadlineMinutes_16" value="16">16</option><option id="optDeadlineMinutes_17" value="17">17</option><option id="optDeadlineMinutes_18" value="18">18</option><option id="optDeadlineMinutes_19" value="19">19</option><option id="optDeadlineMinutes_20" value="20">20</option><option id="optDeadlineMinutes_21" value="21">21</option><option id="optDeadlineMinutes_22" value="22">22</option><option id="optDeadlineMinutes_23" value="23">23</option><option id="optDeadlineMinutes_24" value="24">24</option><option id="optDeadlineMinutes_25" value="25">25</option><option id="optDeadlineMinutes_26" value="26">26</option><option id="optDeadlineMinutes_27" value="27">27</option><option id="optDeadlineMinutes_28" value="28">28</option><option id="optDeadlineMinutes_29" value="29">29</option><option id="optDeadlineMinutes_30" value="30">30</option><option id="optDeadlineMinutes_31" value="31">31</option><option id="optDeadlineMinutes_32" value="32">32</option><option id="optDeadlineMinutes_33" value="33">33</option><option id="optDeadlineMinutes_34" value="34">34</option><option id="optDeadlineMinutes_35" value="35">35</option><option id="optDeadlineMinutes_36" value="36">36</option><option id="optDeadlineMinutes_37" value="37">37</option><option id="optDeadlineMinutes_38" value="38">38</option><option id="optDeadlineMinutes_39" value="39">39</option><option id="optDeadlineMinutes_40" value="40">40</option><option id="optDeadlineMinutes_41" value="41">41</option><option id="optDeadlineMinutes_42" value="42">42</option><option id="optDeadlineMinutes_43" value="43">43</option><option id="optDeadlineMinutes_44" value="44">44</option><option id="optDeadlineMinutes_45" value="45">45</option><option id="optDeadlineMinutes_46" value="46">46</option><option id="optDeadlineMinutes_47" value="47">47</option><option id="optDeadlineMinutes_48" value="48">48</option><option id="optDeadlineMinutes_49" value="49">49</option><option id="optDeadlineMinutes_50" value="50">50</option><option id="optDeadlineMinutes_51" value="51">51</option><option id="optDeadlineMinutes_52" value="52">52</option><option id="optDeadlineMinutes_53" value="53">53</option><option id="optDeadlineMinutes_54" value="54">54</option><option id="optDeadlineMinutes_55" value="55">55</option><option id="optDeadlineMinutes_56" value="56">56</option><option id="optDeadlineMinutes_57" value="57">57</option><option id="optDeadlineMinutes_58" value="58">58</option><option id="optDeadlineMinutes_59" value="59">59</option></select>
                                        </div>
                                        
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="4">
                                    <strong>Descripci&oacute;n de la actividad</strong>
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <textarea id="description" name="description" class="form-control" rows="5" placeholder="Descripción"></textarea>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                        <button type="submit" class="btn btn-success">Guardar datos</button>
                    </div>
                    <br>
                </div>
            </div>
        </form>
        <div class="row">
         <script>
            $(function() {
            $( "#datepicker" ).datepicker({
                 dateFormat: "yy-mm-dd"
            });
            });
            $(function() {
            $( "#dtpEndDateActivity" ).datepicker({
                 dateFormat: "yy-mm-dd"
            });
            });
        </script>
    </div>
        <?php
    break;
     case 1:
        $target_path = "content/upload/cms/temp.jpg";
         
        $title = filter_input(INPUT_POST, "title");
        $category = filter_input(INPUT_POST, "category");
        $company = filter_input(INPUT_POST, "company");
        $datepicker = filter_input(INPUT_POST, "datepicker");
        $taskDeadlineHours = filter_input(INPUT_POST, "taskDeadlineHours");
        $taskDeadlineMinutes = filter_input(INPUT_POST, "taskDeadlineMinutes");
        $dtpEndActivity = filter_input(INPUT_POST, "dtpEndDateActivity");
        $taskDlHEndAct = filter_input(INPUT_POST, "taskDlHEndAct");
        $taskDlMEndAct = filter_input(INPUT_POST, "taskDlMEndAct");
        $description = filter_input(INPUT_POST, "description");
        
        if($category == 0){
            $tipoC = "Llamada telefonica";
        } else if($category == 1) {
            $tipoC = "Oportunidad";
        } else if($category == 2) {
            $tipoC = "Demostración";
        } else if($category == 3) {
            $tipoC = "Email";
        } else if($category == 4) {
            $tipoC = "Fax";
        } else if($category == 5) {
            $tipoC = "Ejecucion de control";
        } else if($category == 6) {
            $tipoC = "Almuerzo";
        } else if($category == 7) {
            $tipoC = "Cita";
        } else if($category == 8) {
            $tipoC = "Nota";
        } else if($category == 9) {
            $tipoC = "Entrega";
        } else if($category == 10) {
            $tipoC = "Redes sociales";
        } else if($category == 11) {
            $tipoC = "Expresion de gratitud";
        } 
        
        $taskTime = $taskDeadlineHours.":".$taskDeadlineMinutes;
        $taskEndTime = $taskDlHEndAct.":".$taskDlMEndAct;
        
        $stmt = mysqli_prepare($CNN, "SELECT dato FROM (SELECT id AS dato FROM crm_company WHERE `name` = '$company' UNION SELECT id AS dato FROM crm_contact WHERE `name` = '$company') AS g");
		
	mysqli_stmt_execute($stmt);
				
	mysqli_stmt_bind_result($stmt, $dato);
		
	mysqli_stmt_fetch($stmt);
		
	mysqli_stmt_free_result($stmt);
        
        $stmt1 = mysqli_prepare($CNN, "SELECT tipo FROM (SELECT IF(id = NULL,'','company') AS tipo FROM crm_company WHERE `name` = '$company' UNION SELECT IF(id = NULL,'','contact') AS tipo FROM crm_contact WHERE `name` = '$company') AS g;");
       
		
	mysqli_stmt_execute($stmt1);
				
	mysqli_stmt_bind_result($stmt1, $tipoD);
		
	mysqli_stmt_fetch($stmt1);
		
	mysqli_stmt_free_result($stmt1);
		
        mysqli_query($CNN, "INSERT INTO crm_activities (title, category, idCompanyOrPerson, dateActivity, timeActivity, description, typeCompanyOrPerson, activo, endDateActivity, endTimeActivity) values('$title', '$tipoC', $dato, '$datepicker', '$taskTime', '$description', '$tipoD', 'SI','$dtpEndActivity','$taskEndTime')");
        $nid = str_pad(mysqli_insert_id($CNN), 8, "0", STR_PAD_LEFT);
        $nname = str_replace("temp.jpg", "featured-" . $nid . ".jpg", $target_path);
        if (!isset($e)) {
                ?>
            
                <div class="alert alert-success">
                    <h4>Se a Agregado el contacto en el Sistema <?php echo $title.$tipoC.$dato.$datepicker.$taskTime.$description.$tipoD; ?></h4>
                    
                    <div>
                    <form action="./?m=activities&s=admin&o=0" class="form" method="post" enctype="multipart/form-data" >
                    <button type="submit" class="btn btn-success">Regresar</button>
                    </form>
                        </div>
                    <div>
                     <form action="./?m=activities&s=activity&o=0" class="form" method="post" enctype="multipart/form-data" >
                    <button type="submit" class="btn btn-success">Regresar y generar un nuevo contacto</button>
                    </form>
                    </div>
                </div>
        <?php
        }
        break;
}