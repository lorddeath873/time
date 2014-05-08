<?php
if (isset($_SESSION['mid'])) {
	$stmt = $mysqli->prepare("SELECT id, ber, logrp, lo, surname, geb, street, ort, imgs, url, reurl, tel, mob FROM ".USR." WHERE ma = ? LIMIT 1");
	$stmt->bind_param('i', $_SESSION['mid']);
	$stmt->execute();
	$result = $stmt->get_result();
    if (!check_data($result)){
        echo '<table class="outer-border" id="main"><tr><td class="failure">'.$locate['102'].'</td></tr></table>';
    } else {
        while ($urs = $result->fetch_array()) {
            $ber=$urs['ber'];
            $logrp=$urs['logrp'];
            $lo=$urs['lo'];
            $name=$urs['surname'];
            $geb=$urs['geb'];
            $street=$urs['street'];
            $ort=$urs['ort'];
            $img=$urs['imgs'];
            $ul=$urs['url'];
            $rul=$urs['reurl'];
            $tel=$urs['tel'];
            $mob=$urs['mob'];
        }
		$stmt->close();
        if ($img =="") {
            $img=UIM."noavatar150.png";
        }
        ?>
        <form method="post" action="<? $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
        <table class='outer-border' id='hori'>
        <tr>    <td> <img src="<? echo $img ?>" alt="img" width="150" height="150"/></td>
        </tr>
        <tr>
		        <td class="table-body"><input class="button" name="image" type="file"></td>
        </tr>
        <tr>
		        <td class="table-body"><input class="button" name="submit" type="submit" value="<? echo $locate['222'] ?>" /></td>
        </tr>

        <tr>
		        <td class="tabhead"><? echo $locate ['109'] ?></td>
        </tr>
        <tr>
		        <td class="table-body"><? echo $_SESSION['na'] ?></td>
        </tr>
        <tr>
		        <td class="tabhead"><? echo $locate ['110'] ?></td>
        </tr>
        <tr>		
		        <td class="table-body"><? echo $name ?></td>
        </tr>
        <tr>
		        <td class="tabhead"><? echo $locate ['111'] ?></td>
        </tr>
        <tr>		
		        <td class="table-body"><? echo $geb ?></td>
        </tr>
        <tr>
		        <td class="tabhead"><? echo $locate ['114'] ?></td>
        </tr>
        <tr>		
		        <td class="table-body"><? echo $street ?></td>
        </tr>
        <tr>
		        <td class="tabhead"><? echo $locate ['113'] ?></td>
        </tr>
        <tr>		
		        <td class="table-body"><? echo $ort ?></td>
        </tr>

        <tr>		
		        <td class="tabhead"><? echo $locate ['120'] ?></td>
        </tr>
        <tr>
		        <td class="table-body"><? echo $ber ?></td>
        </tr>
        <tr>
		        <td class="tabhead "><? echo $locate ['108'] ?></td>
        </tr>
        <tr>		
		        <td class="table-body"><? echo $logrp ?></td>
        </tr>
        <tr>
		        <td class="tabhead"><? echo $locate ['107'] ?></td>
        </tr>
        <tr>		
		        <td class="table-body"><? echo $lo ?></td>
        </tr>
        <tr>
		        <td class="tabhead"><? echo $locate ['139'] ?></td>
        </tr>
        <tr>		
		        <td class="table-body"><? echo $ul ?></td>
        </tr>
        <tr>
		        <td class="tabhead"><? echo $locate ['140'] ?></td>
        </tr>
        <tr>		
		        <td class="table-body"><? echo $rul ?></td>
        </tr>
        <tr>
		        <td class="tabhead"><? echo $locate ['115'] ?></td>
        </tr>
        <tr>		
		        <td class="table-body"><? echo $tel ?></td>
        </tr>
        <tr>
		        <td class="tabhead"><? echo $locate ['116'] ?></td>
        </tr>
        <tr>		
		        <td class="table-body"><? echo $mob ?></td>
        </tr>

        </table>
        </form>
		<?php
    }
    if (isset($_REQUEST['submit'])) {
        $uploaddir = UIM.$uploaddirb.$_SESSION['mid']."/";
        function resizeimage($filename, $outfile, $new_img_max_x, $new_img_max_y)
        {

            global $image_prop;

            if (@imagecreatetruecolor(1, 1)) {
                $GDLIB_VERS = 2;
            } else {
                $GDLIB_VERS = 1;
            }


            $file = basename($filename);
            $image_ext = explode(".", $file);

            if ($image_ext[1] == "gif" || $image_ext[1] == "GIF") {

                if (function_exists("ImageCreateFromGIF")) {
                    $imgA = ImageCreateFromGIF($filename);
                    $org_x = ImageSX($imgA);
                    $org_y = ImageSY($imgA);

                    if ($org_x >= $org_y && $image_prop == "ja") {
                        $new_img_max_x = $new_img_max_x;
                        $new_img_max_y = $org_y / ($org_x / $new_img_max_x);
                        $new_img_max_y = floor($new_img_max_y);
                    }

                    if ($org_x < $org_y && $image_prop == "ja") {
                        $new_img_max_y = $new_img_max_y;
                        $new_img_max_x = $org_x / ($org_y / $new_img_max_y);
                        $new_img_max_x = floor($new_img_max_x);
                    }

                    if ($GDLIB_VERS == 2) {
                        $imgB = imagecreatetruecolor($new_img_max_x, $new_img_max_y);
                        imagecopyresampled($imgB, $imgA, 0, 0, 0, 0, $new_img_max_x, $new_img_max_y, $org_x, $org_y);
                    }

                    if ($GDLIB_VERS == 1) {
                        $imgB = imagecreate($new_img_max_x, $new_img_max_y);
                        imagecopyresized($imgB, $imgA, 0, 0, 0, 0, $new_img_max_x, $new_img_max_y, $org_x, $org_y);
                    }
                    if ($imgB) {
                        imagegif($imgB, $outfile);
                    }

                } else {
                    return false;
                }
            }

            if ($image_ext[1] == "jpg" || $image_ext[1] == "jpeg" || $image_ext[1] == "JPG" || $image_ext[1] == "JPEG") {

                if (function_exists("ImageCreateFromJPEG")) {
                    $imgA = ImageCreateFromJPEG($filename);
                    $org_x = ImageSX($imgA);
                    $org_y = ImageSY($imgA);

                    if ($org_x >= $org_y && $image_prop == "ja") {
                        $new_img_max_x = $new_img_max_x;
                        $new_img_max_y = $org_y / ($org_x / $new_img_max_x);
                        $new_img_max_y = floor($new_img_max_y);
                    }

                    if ($org_x < $org_y && $image_prop == "ja") {
                        $new_img_max_y = $new_img_max_y;
                        $new_img_max_x = $org_x / ($org_y / $new_img_max_y);
                        $new_img_max_x = floor($new_img_max_x);
                    }

                    $quality = 100;

                    if ($GDLIB_VERS == 2) {
                        $imgB = imagecreatetruecolor($new_img_max_x, $new_img_max_y);
                        imagecopyresampled($imgB, $imgA, 0, 0, 0, 0, $new_img_max_x, $new_img_max_y, $org_x, $org_y);
                    }

                    if ($GDLIB_VERS == 1) {
                        $imgB = imagecreate($new_img_max_x, $new_img_max_y);
                        imagecopyresized($imgB, $imgA, 0, 0, 0, 0, $new_img_max_x, $new_img_max_y, $org_x, $org_y);
                    }
                    imagejpeg($imgB, $outfile, $quality);

                } else {
                    return false;
                }
            }

            if ($image_ext[1] == "png" || $image_ext[1] == "PNG") {

                if (function_exists("ImageCreateFromPNG")) {
                    $imgA = ImageCreateFromPNG($filename);
                    $org_x = ImageSX($imgA);
                    $org_y = ImageSY($imgA);

                    if ($org_x >= $org_y && $image_prop == "ja") {
                        $new_img_max_x = $new_img_max_x;
                        $new_img_max_y = $org_y / ($org_x / $new_img_max_x);
                        $new_img_max_y = floor($new_img_max_y);
                    }

                    if ($org_x < $org_y && $image_prop == "ja") {
                        $new_img_max_y = $new_img_max_y;
                        $new_img_max_x = $org_x / ($org_y / $new_img_max_y);
                        $new_img_max_x = floor($new_img_max_x);
                    }

                    if ($GDLIB_VERS == 2) {
                        $imgB = imagecreatetruecolor($new_img_max_x, $new_img_max_y);
                        imagecopyresampled($imgB, $imgA, 0, 0, 0, 0, $new_img_max_x, $new_img_max_y, $org_x, $org_y);
                    }

                    if ($GDLIB_VERS == 1) {
                        $imgB = imagecreate($new_img_max_x, $new_img_max_y);
                        imagecopyresized($imgB, $imgA, 0, 0, 0, 0, $new_img_max_x, $new_img_max_y, $org_x, $org_y);
                    }
                    imagepng($imgB, $outfile);

                } else {
                    return false;
                }
            } if (!$imgA) {
                return false;
            }

            return true;
        }


        $error = "";
        $hinweis = "";

        if (count($allowedfiletype) > 1) {
            $msg = "$txt_dateitypen";
            $msg .= implode(', ', $allowedfiletype);
        }
elseif  (count($allowedfiletype) == 1) $action = "isp_resize_form";


        if (is_dir($uploaddir)) {
            
        } else {
            mkdir($uploaddir);
        }
        $leer = true;
        if ($d = dir($uploaddir)) {
            while ($n = $d->read()) {
                if ($n == '.' OR $n == '..') {
                    continue;
                }
                $da=$uploaddir."".$n;
                unlink($da);
            }
            $d->close();
        } else {
            print $locate['223'].": $uploaddir ".$locate['224'];
        }

        $ok=1;
        if ($_FILES['image']['error'] == 1 and $ok == 1) {
            $ok = 0;
            $error = "$txt_error_1";
        }

        if ($_FILES['image']['error'] == 3 and $ok == 1) {
            $ok = 0;
            $error = "$txt_error_3";
        }

        if ($_FILES['image']['error'] == 4 and $ok == 1) {
            $ok = 0;
            $error = "$txt_error_4";
        }

        if ($ok == 1) {
            $filename = $_FILES["image"]["name"];
            $fileext = explode(".", $filename);
            $fileext_1 = $fileext[1];
            $fileext_1 = strtolower($fileext_1);

            if (!in_array($fileext_1, $allowedfiletype)) {

                if (count($allowedfiletype) > 1) {
                    $bild_typ = implode(', ', $allowedfiletype);
                }
elseif (count($allowedfiletype) == 1) $bild_typ = $allowedfiletype[0];
                $ok = 0;
                $error = "$txt_error_file_typ";
            }
        }

        if (filesize($_FILES['image']['tmp_name'])/1024/1024 >= $maxfilesize and $ok == 1) {
            $ok = 0;
            $error = "$txt_error_size";
        }

        if ($ok) {
            $image_file_pfad = "{$uploaddir}/{$filename}";
            move_uploaded_file($_FILES['image']['tmp_name'], $image_file_pfad);
            $size = @GetImageSize($image_file_pfad);
            $width = $size[0];
            $height = $size[1];
            $value = true;



            if ($width <> $uploadMaxWidth || $height <> $uploadMaxHeight) {
                $value = ResizeImage($image_file_pfad, $image_file_pfad, $uploadMaxWidth, $uploadMaxHeight);
            }

            if ($value == true) {
                $hinweis = "$txt_hinweis_1";
            } else {
                unlink($image_file_pfad);
                $hinweis .= "$txt_hinweis_2";
            }
        } else {
        }
    }


    if (empty($filename) or  $filename == "") {
        $outimage = "";
    } else {
        $outimage = "<img src=\"$uploaddir/$filename\" border=\"0\">";
        $pis= $uploaddir."".$filename;
		$stmt = $mysqli->prepare("UPDATE ".USR." SET imgs = ? WHERE ma = ? LIMIT 1");
		$stmt->bind_param('si', $pis, $_SESSION['mid']);
		$stmt->execute();
		$stmt->close();

    }

    if (isset($error) OR isset($hinweiß)) {
        echo '<table class="outer-border" id="main"><tr><td class="failure">'.$error.'</td></tr><tr><td class="failure">'.$hinweis.'</td></tr></table>';
    } else {
        echo '<table cellpadding="0"><tr><td class="table-body">'.$outimage.'</td></tr></table>';
    }
} else {
    echo '<table class="outer-border" id="main"><tr><td class="failure">'.$locate['142'].'</td></tr></table>';
}