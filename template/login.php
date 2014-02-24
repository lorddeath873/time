<?php
if (isset($_SESSION['mid'])) {
	$stmt = $mysqli->prepare("SELECT ber, logrp, lo, surname, geb, street, ort, imgs FROM ".USR." WHERE ma= ? LIMIT 1");
	$stmt->bind_param('s', $_SESSION['mid']);
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
        }
        if ($img =="") {
            $img=UIM."noavatar100.png";
        }
		$stmt->close();
        ?>
        <table class='outer-border' id='main'>
        <tr>    
        <td><img src="<? echo $img ?>" alt="imgs" width="100px" height="100px"/></td></tr>
        <tr>
        <td></td>
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
        <td class="tabhead"><? echo $locate ['108'] ?></td>
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
        </table>

        <?php
    }
} else {
    echo '<table class="outer-border" id="main"><tr><td class="failure">'.$locate['142'].'</td></tr></table>';
}
