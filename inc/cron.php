<?
require "config.inc.php";
include "dbconn.inc.php";
function count_workdays($date1,$date2){ 
$firstdate = strtotime($date1); 
$lastdate = strtotime($date2); 
$firstday = date(w,$firstdate); 
$lastday = date(w,$lastdate); 
$totaldays = intval(($lastdate-$firstdate)/86400)+1; 

//check for one week only 
if ($totaldays<=7 && $firstday<=$lastday){ 
$workdays = $lastday-$firstday+1; 
//check for weekend 
if ($firstday==0){ 
$workdays = $workdays-1; 
} 
if ($lastday==6){ 
$workdays = $workdays-1; 
} 

}else { //more than one week 

//workdays of first week 
if ($firstday==0){ 
//so we don't count weekend 
$firstweek = 5; 
}else { 
$firstweek = 6-$firstday; 
} 
$totalfw = 7-$firstday; 

//workdays of last week 
if ($lastday==6){ 
//so we don't count sat, sun=0 so it won't be counted anyway 
$lastweek = 5; 
}else { 
$lastweek = $lastday; 
} 
$totallw = $lastday+1; 

//check for any mid-weeks 
if (($totalfw+$totallw)>=$totaldays){ 
$midweeks = 0; 
} else { //count midweeks 
$midweeks = (($totaldays-$totalfw-$totallw)/7)*5; 
} 

//total num of workdays 
$workdays = $firstweek+$midweeks+$lastweek; 

} 

return ($workdays); 
} //end funtion count_workdays() 

$stmt= $mysqli->prepare("SELECT ma, uestd, soll FROM ".USR."");
$stmt->execute();
$result = $stmt->get_result();
while ($resu = $result->fetch_array())
{
	$ma = "tt".$resu['ma'];
	$soll = $resu['soll'];
	$ue = $resu['uestd'];
	$stmts = $mysqli->prepare("SELECT SUM(start) AS start FROM ".$ma."");
	$stmts->execute();
	$stmts->bind_result($start);
	$stmts->fetch();
	$stmts->close();
	$stmti = $mysqli->prepare("SELECT SUM(end) AS end FROM ".$ma."");
	$stmti->execute();
	$stmti->bind_result($end);
	$stmti->fetch();
	$stmti->close();
	$diff=date_differ($start, $end);
	$stmts = $mysqli->prepare("SELECT start, end FROM ".$ma."");
	$stmts->execute();
	$re = $stmts->get_result();
	while ($r = $re->fetch_array())
	{
		$FromDate = date('Y-m-d', $r['start']); 
		$ToDate = date('Y-m-d', $r['end']); 
		$date1 = $FromDate; 
		$date2 = $ToDate; 

		echo "There are ".count_workdays($date1,$date2)." work days from $date1 to $date2";
	}
}
		 