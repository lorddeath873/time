<? 
include "config.inc.php";
$string= explode(".",$_POST['id']);
$field = $string[1];
$id = $string[0];
$tb = $string [2];
$content = $_POST['value'];
$stmt = $mysqli->prepare("UPDATE ".$tb." SET ".$field."= ? WHERE id= ? LIMIT 1");
$stmt->bind_param('si', $content, $id);
$stmt->execute();
$stmt->close();
echo stripslashes(strip_tags($content,"<br><p><img><a><br /><strong><em>"));
?>