<?php

include "../koneksi.php";

    function validasiNama($field){
        $hasil = true;
        $pattern = "/^[a-zA-Z ]+$/"; 
		if(!preg_match($pattern, $field)){
			$hasil = false;
		}
        return $hasil;
    }

    function cekNik($nik){
        $hasil = true;
        if (strlen($nik) != 16) {
            $hasil = false;
        }
        return $hasil;
    }

    function cekKesamaan($pw1, $pw2){
        $hasil = false;
        if ($pw1 == $pw2) {
            $hasil = true;
        }
        return $hasil;
    }
    
    function cekValidasiPw($pw2){
        $hasil = true;
        $alpha = "/[a-zA-Z]/";
            $num = "/[0-9]/";
            $antisimbol = "/^[a-zA-Z0-9]+$/";
            if(!(preg_match($alpha, $pw2) && preg_match($num, $pw2) && preg_match($antisimbol, $pw2)) || strlen($pw2) < 8){
                $hasil = false; 
            }
            return $hasil;
    }

?>