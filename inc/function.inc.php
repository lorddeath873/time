<?php
function lang_getfrombrowser ($allowed_languages, $default_language, $lang_variable = null, $strict_mode = true)
{
    if ($lang_variable === null) {
        $lang_variable = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
    }
    if (empty($lang_variable)) {
        return $default_language;
    }
         $accepted_languages = preg_split('/,\s*/', $lang_variable);
         $current_lang = $default_language;
         $current_q = 0;
 
    foreach ($accepted_languages as $accepted_language) {
             $res = preg_match('/^([a-z]{1,8}(?:-[a-z]{1,8})*)'.'(?:;\s*q=(0(?:\.[0-9]{1,3})?|1(?:\.0{1,3})?))?$/i', $accepted_language, $matches);
 
        if (!$res) {
            continue;
        }
        $lang_code = explode('-', $matches[1]);

        if (isset($matches[2])) {
            $lang_quality = (float)$matches[2];
        } else {
            $lang_quality = 1.0;
        }
 
        while (count($lang_code)) {
            if (in_array(strtolower(join('-', $lang_code)), $allowed_languages)) {
                if ($lang_quality > $current_q) {
                    $current_lang = strtolower(join('-', $lang_code));
                    $current_q = $lang_quality;
                    break;
                }
            }
            if ($strict_mode) {
                break;
            }
            array_pop($lang_code);
        }
    }
    return $current_lang;
}

function date_differ($d1, $d2)
{
    if ($d1 < $d2) {
        $temp = $d2;
        $d2 = $d1;
        $d1 = $temp;
    } else {
        $temp = $d1;
    }
    $d1 = date_parse(date("Y-m-d H:i", $d1));
    $d2 = date_parse(date("Y-m-d H:i", $d2));
    if ($d1['minute'] >= $d2['minute']) {
        $diff['minute'] = $d1['minute'] - $d2['minute'];
    } else {
        $d1['hour']--;
        $diff['minute'] = 60-$d2['minute']+$d1['minute'];
    }
    if ($d1['hour'] >= $d2['hour']) {
        $diff['hour'] = $d1['hour'] - $d2['hour'];
    } else {
        $d1['day']--;
        $diff['hour'] = 24-$d2['hour']+$d1['hour'];
    }
    if ($d1['day'] >= $d2['day']) {
        $diff['day'] = $d1['day'] - $d2['day'];
    } else {
        $d1['month']--;
        $diff['day'] = date("t", $temp)-$d2['day']+$d1['day'];
    }
    if ($d1['month'] >= $d2['month']) {
        $diff['month'] = $d1['month'] - $d2['month'];
    } else {
        $d1['year']--;
        $diff['month'] = 12-$d2['month']+$d1['month'];
    }
    $diff['year'] = $d1['year'] - $d2['year'];
    return $diff;
}

class XTEA{

    var $key;
    var $cbc = 1;

    function XTEA($key)
    {
        $this->key_setup($key);
    }
    function encrypt($text)
    {
        $n = strlen($text);
        if ($n%8 != 0) $lng = ($n+(8-($n%8)));
        else $lng = 0;

        $text = str_pad($text, $lng, ' ');
        $text = $this->_str2long($text);
        if ($this->cbc == 1) {
            $cipher[0][0] = time();
            $cipher[0][1] = (double)microtime()*1000000;
        }

        $a = 1;
        for ($i = 0; $i<count($text); $i+=2) {
            if ($this->cbc == 1) {
                $text[$i] ^= $cipher[$a-1][0];
                $text[$i+1] ^= $cipher[$a-1][1];
            }

            $cipher[] = $this->block_encrypt($text[$i], $text[$i+1]);
            $a++;
        }

        $output = "";
        for ($i = 0; $i<count($cipher); $i++) {
            $output .= $this->_long2str($cipher[$i][0]);
            $output .= $this->_long2str($cipher[$i][1]);
        }

        return base64_encode($output);
    }
    function decrypt($text)
    {
        $plain = array();
        $cipher = $this->_str2long(base64_decode($text));

        if($this->cbc == 1)
            $i = 2;
        else
            $i = 0;

        for ($i; $i<count($cipher); $i+=2) {
            $return = $this->block_decrypt($cipher[$i], $cipher[$i+1]);
            if($this->cbc == 1)
                $plain[] = array($return[0]^$cipher[$i-2],$return[1]^$cipher[$i-1]);
            else
                $plain[] = $return;
    }

      for($i = 0; $i<count($plain); $i++) {
         $output .= $this->_long2str($plain[$i][0]);
         $output .= $this->_long2str($plain[$i][1]);
      }

      return $output;
   }
    function key_setup($key)
    {
        if (is_array($key))
            $this->key = $key;
        else if(isset($key) && !empty($key))
            $this->key = $this->_str2long(str_pad($key, 16, $key));
        else
            $this->key = array(0,0,0,0);
    }
    function benchmark($length=1000)
    {
        $string = str_pad("", $length, "text");
        $start1 = time() + (double)microtime();
        $xtea = new XTEA("key");
        $end1 = time() + (double)microtime();
        $start2 = time() + (double)microtime();
        $xtea->Encrypt($string);
        $end2 = time() + (double)microtime();
        echo "Encrypting ".$length." bytes: ".round($end2-$start2,2)." seconds (".round($length/($end2-$start2),2)." bytes/second)<br>";
    }
    function check_implementation()
    {
        $xtea = new XTEA("");
        $vectors = array(array(array(0x00000000,0x00000000,0x00000000,0x00000000), array(0x41414141,0x41414141), array(0xed23375a,0x821a8c2d)), array(array(0x00010203,0x04050607,0x08090a0b,0x0c0d0e0f), array(0x41424344,0x45464748), array(0x497df3d0,0x72612cb5)), );
        $correct = true;
        foreach ($vectors AS $vector) {
            $key = $vector[0];
            $plain = $vector[1];
            $cipher = $vector[2];

            $xtea->key_setup($key);
            $return = $xtea->block_encrypt($vector[1][0], $vector[1][1]);

            if((int)$return[0] != (int)$cipher[0] || (int)$return[1] != (int)$cipher[1])
                $correct = false;
        }

        return $correct;

    }
    function block_encrypt($y, $z)
    {
        $sum=0;
        $delta=0x9e3779b9;
        for ($i=0; $i<32; $i++) {
            $y      = $this->_add($y, $this->_add($z << 4 ^ $this->_rshift($z, 5), $z) ^ $this-> _add($sum, $this->key[$sum & 3]));
            $sum    = $this->_add($sum, $delta);
            $z      = $this->_add($z, $this->_add($y << 4 ^ $this->_rshift($y, 5), $y) ^ $this->_add($sum, $this->key[$this->_rshift($sum, 11) & 3]));

        }
        $v[0]=$y;
        $v[1]=$z;

        return array($y,$z);

    }

    function block_decrypt($y, $z)
    {
        $delta=0x9e3779b9;
        $sum=0xC6EF3720;
        $n=32;
        for ($i=0; $i<32; $i++) {
            $z      = $this->_add($z, -($this->_add($y << 4 ^ $this->_rshift($y, 5), $y) ^ $this->_add($sum, $this->key[$this->_rshift($sum, 11) & 3])));
            $sum    = $this->_add($sum, -$delta);
            $y      = $this->_add($y, -($this->_add($z << 4 ^ $this->_rshift($z, 5), $z) ^ $this->_add($sum, $this->key[$sum & 3])));

        }

        return array($y,$z);
    }




    function _rshift($integer, $n)
    {
        if (0xffffffff < $integer || -0xffffffff > $integer) {
            $integer = fmod($integer, 0xffffffff + 1);
        }
        if (0x7fffffff < $integer) {
            $integer -= 0xffffffff + 1.0;
        } elseif (-0x80000000 > $integer) {
            $integer += 0xffffffff + 1.0;
        }
        if (0 > $integer) {
            $integer &= 0x7fffffff;
            $integer >>= $n;
            $integer |= 1 << (31 - $n);
        } else {
            $integer >>= $n;
        }

        return $integer;
    }


    function _add($i1, $i2) {
        $result = 0.0;

        foreach (func_get_args() as $value) {
            if (0.0 > $value) {
                $value -= 1.0 + 0xffffffff;
            }

            $result += $value;
        }
        if (0xffffffff < $result || -0xffffffff > $result) {
            $result = fmod($result, 0xffffffff + 1);
        }
        if (0x7fffffff < $result) {
            $result -= 0xffffffff + 1.0;
        } elseif (-0x80000000 > $result) {
            $result += 0xffffffff + 1.0;
        }

        return $result;
    }
    function _str2long($data)
    {
        $n = strlen($data);
        $tmp = unpack('N*', $data);
        $data_long = array();
        $j = 0;

        foreach ($tmp as $value) $data_long[$j++] = $value;
            return $data_long;
   }
    function _long2str($l){
        return pack('N', $l);
    }
}
function check_data ($mqli)
{
	if ($mqli->num_rows == "0"){
	return false;
	} else {
		return true;
	}
}