<?php
// This script and data application were generated by AppGini 5.71
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir = dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");

	handle_maintenance();

	header('Content-type: text/javascript; charset=' . datalist_db_encoding);

	$table_perms = getTablePermissions('invoices');
	if(!$table_perms[0]){ die('// Access denied!'); }

	$mfk = $_GET['mfk'];
	$id = makeSafe($_GET['id']);
	$rnd1 = intval($_GET['rnd1']); if(!$rnd1) $rnd1 = '';

	if(!$mfk){
		die('// No js code available!');
	}

	switch($mfk){

		case 'deceased':
			if(!$id){
				?>
				$j('#room<?php echo $rnd1; ?>').html('&nbsp;');
				$j('#relative<?php echo $rnd1; ?>').html('&nbsp;');
				<?php
				break;
			}
			$res = sql("SELECT `incoming_deceased`.`id` as 'id', `incoming_deceased`.`fullname` as 'fullname', `incoming_deceased`.`gender` as 'gender', `incoming_deceased`.`tag_number` as 'tag_number', `incoming_deceased`.`serial_number` as 'serial_number', IF(    CHAR_LENGTH(`relatives_info1`.`first_relative_full_name`), CONCAT_WS('',   `relatives_info1`.`first_relative_full_name`), '') as 'relative_name', IF(    CHAR_LENGTH(`relatives_info1`.`phone_number`), CONCAT_WS('',   `relatives_info1`.`phone_number`), '') as 'relative_number', IF(    CHAR_LENGTH(`rooms1`.`name`), CONCAT_WS('',   `rooms1`.`name`), '') as 'room', IF(    CHAR_LENGTH(`beds1`.`number`) || CHAR_LENGTH(`rooms2`.`name`), CONCAT_WS('',   `beds1`.`number`, ' Room: ', `rooms2`.`name`), '') as 'bed', if(`incoming_deceased`.`date`,date_format(`incoming_deceased`.`date`,'%m/%d/%Y'),'') as 'date' FROM `incoming_deceased` LEFT JOIN `relatives_info` as relatives_info1 ON `relatives_info1`.`id`=`incoming_deceased`.`relative_name` LEFT JOIN `rooms` as rooms1 ON `rooms1`.`id`=`incoming_deceased`.`room` LEFT JOIN `beds` as beds1 ON `beds1`.`id`=`incoming_deceased`.`bed` LEFT JOIN `rooms` as rooms2 ON `rooms2`.`id`=`beds1`.`room`  WHERE `incoming_deceased`.`id`='{$id}' limit 1", $eo);
			$row = db_fetch_assoc($res);
			?>
			$j('#room<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(array("\r", "\n"), '', nl2br($row['bed']))); ?>&nbsp;');
			$j('#relative<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(array("\r", "\n"), '', nl2br($row['relative_name'].'  Phone: '.$row['relative_number']))); ?>&nbsp;');
			<?php
			break;


	}

?>