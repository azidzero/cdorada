<?php
include("../config.php");
$id = $_REQUEST["id"];
$sq = mysql_query("select * from pos_service where id=$id");
while ($sr = mysql_fetch_array($sq)) {
    ?>
    <table <?php echo TBLcss; ?>>
        <tr>
            <td colspan="6">
                Atendio: <?php
    if ($sr["uid"] != "0") {
        $tq = mysql_query("select * from pos_users where id={$sr["uid"]}");
        while ($tr = mysql_fetch_array($tq)) {
            $uname = $tr[3] . " " . $tr[4];
        }
        echo $uname;
    }
    ?>
            </td>
        </tr>
        <tr>
            <td width="1">#</td>
            <td><?php echo $sr[0]; ?></td>
            <td width="1"><i class="icon-calendar"></i></td>
            <td><?php echo $sr[2]; ?></td>
            <td width="1"><i class="icon-cog"></i></td>
            <td><?php if ($sr[3] == 0) {
                echo "<i class=\"icon-mobile-phone\"></i>";
            } else {
                echo "<i class=\"icon-desktop\"></i>";
            } ?></td>
        </tr>
        <tr>
            <td width="1"><i class="icon-bookmark"></i></td>
            <td><?php echo $sr[7]; ?></td>
            <td width="1"><i class="icon-bookmark-empty"></i></td>
            <td><?php echo $sr[8]; ?></td>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td width="1"><i class="icon-user"></i></td>
            <td><?php echo $sr[4]; ?></td>
            <td width="1"><i class="icon-phone"></i></td>
            <td><?php echo $sr[5]; ?></td>
            <td width="1"><i class="icon-envelope-alt"></i></td>
            <td><?php echo $sr[6]; ?></td> 
        </tr>
        <tr class="success">
            <td><i class="icon-info-sign"></i></td>
            <td colspan="5"><?php echo $sr[9]; ?></td>
        </tr>
        <tr class="info">
            <td><i class="icon-info-sign"></i></td>
            <td colspan="5"><?php echo $sr[10]; ?></td>
        </tr>
        <tr class="error">
            <td><i class="icon-info-sign"></i></td>        
            <td colspan="5"><?php echo $sr[11]; ?></td>
        </tr>
        <tr>
            <td><i class="icon-info-sign"></i></td>
            <td colspan="5"><?php echo $sr[12]; ?></td>
        </tr>        
        <tr>
            <td width="1"><i class="icon-shopping-cart"></i></td>            
            <td><?php echo number_format($sr[14], 2); ?></td>
            <td width="1"><i class="icon-calendar"></i></td>
            <td><?php echo $sr[15]; ?></td>            
            <td width="1"><i class="icon-warning-sign"></i></td>
            <td><?php echo $sr[16]; ?></td>            
        </tr>
    </table>
    <?php
}
?>
