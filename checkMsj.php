<?php 
session_start();
require_once "config/databaseObject.php";
include "funciones.php";
$conn = new Conex();
$user = $_SESSION["user_id"];
 
$sql = "SELECT * FROM notifications WHERE status_id = '0' AND user_id = '".$user."' AND name<>'Calendario'";
$c = mysqli_query($conn->getConn(),$sql);
$cantidadMsjNuevos = $c->num_rows;

$sql2 = "SELECT * FROM mm_events_users mm WHERE status_id = '0' AND invited =$user";
$calendar = mysqli_query($conn->getConn(),$sql2);
$cantidadMsjNuevosCalendar = $calendar->num_rows;
// $result = $conn->query($sql);

if($cantidadMsjNuevos != 0){ ?>
     <script>
     $("#notif").html("<?php echo $cantidadMsjNuevos; ?>");
     $("#notifSidebar").html("<?php echo $cantidadMsjNuevos; ?>");
     </script>
    <?php
}else{?>
	<script>
	$("#notif").html("<?php echo "0"; ?>");
	$("#notifSidebar").html("");
	</script>
<?php }
if($cantidadMsjNuevosCalendar != 0){ ?>
     <script>
     $("#notifCalendar").html("<?php echo $cantidadMsjNuevosCalendar; ?>");
     $("#notifSidebarCalendar").html("<?php echo $cantidadMsjNuevosCalendar; ?>");
     $("#notifSidebarCalendarListEvent").html("<?php echo $cantidadMsjNuevosCalendar; ?>");
     </script>
    <?php
}else{?>
	<script>
	$("#notifCalendar").html("<?php echo "0"; ?>");
	$("#notifSidebarCalendar").html("");
	$("#notifSidebarCalendarListEvent").html("");
	</script>
<?php }
?>
<script src="plugins/jquery/jquery-2.1.0.min.js"></script>