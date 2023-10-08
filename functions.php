<?php
error_reporting(~E_NOTICE);
session_start();

include'config.php';
include'includes/db.php';
$db = new DB($config['server'], $config['username'], $config['password'], $config['database_name']);
include'includes/general.php';    
include'includes/paging.php';  
include'func_ahp_saw.php';


$mod = $_GET['m'];
$act = $_GET['act'];


    

 
$nRI = array (
	1=>0,
	2=>0,
	3=>0.58,
	4=>0.9,
	5=>1.12,
	6=>1.24,
	7=>1.32, 
	8=>1.41,
	9=>1.46,
	10=>1.49,
    11=>1.51,
    12=>1.48,
    13=>1.56,
    14=>1.57,
    15=>1.59
);

$rows = $db->get_results("SELECT kode_alternatif, nama_alternatif FROM tb_alternatif ORDER BY kode_alternatif");
$ALTERNATIF = array();
foreach($rows as $row){
    $ALTERNATIF[$row->kode_alternatif] = $row->nama_alternatif;
}

$rows = $db->get_results("SELECT kode_kriteria, nama_kriteria, atribut FROM tb_kriteria ORDER BY kode_kriteria");
$KRITERIA = array();
foreach($rows as $row){
    $KRITERIA[$row->kode_kriteria] = $row;
}

function get_rel_kriteria(){
    global $db;
    $arr = array();
    $rows = $db->get_results("SELECT * FROM tb_rel_kriteria ORDER BY ID1, ID2");
    foreach($rows as $row){
        $arr[$row->ID1][$row->ID2] = $row->nilai;
    }
    return $arr;
}   

function get_kriteria_option($selected = 0){
    global $KRITERIA;  
    foreach($KRITERIA as $key => $val){
        if($key==$selected)
            $a.="<option value='$key' selected>$val->nama_kriteria</option>";
        else
            $a.="<option value='$key'>$val->nama_kriteria</option>";
    }
    return $a;
}

function get_atribut_option($selected = ''){
    $atribut = array('benefit'=>'Benefit', 'cost'=>'Cost');   
    foreach($atribut as $key => $val){
        if($selected==$key)
            $a.="<option value='$key' selected>$val</option>";
        else
            $a.= "<option value='$key'>$val</option>";
    }
    return $a;
}

function get_alternatif_option($selected = ''){
    global $db;
    $rows = $db->get_results("SELECT kode_alternatif, nama_alternatif FROM tb_alternatif ORDER BY kode_alternatif");
    foreach($rows as $row){
        if($row->kode_alternatif==$selected)
            $a.="<option value='$row->kode_alternatif' selected>$row->kode_alternatif - $row->nama_alternatif</option>";
        else
            $a.="<option value='$row->kode_alternatif'>$row->kode_alternatif - $row->nama_alternatif</option>";
    }
    return $a;
}

function get_nilai_option($selected = ''){
    $nilai = array(
        '1' => 'Sama penting dengan',
        '2' => 'Mendekati sedikit lebih penting dari',
        '3' => 'Sedikit lebih penting dari',
        '4' => 'Mendekati lebih penting dari',
        '5' => 'Lebih penting dari',
        '6' => 'Mendekati sangat penting dari',
        '7' => 'Sangat penting dari',
        '8' => 'Mendekati mutlak dari',
        '9' => 'Mutlak sangat penting dari',
    );
    foreach($nilai as $key => $val){
        if($selected==$key)
            $a.="<option value='$key' selected>$key - $val</option>";
        else
            $a.= "<option value='$key'>$key - $val</option>";
    }
    return $a;
}

function get_rel_alternatif(){
    global $db;
    $rows = $db->get_results("SELECT * FROM tb_rel_alternatif ORDER BY kode_alternatif, kode_kriteria");
    $arr = array();
    foreach($rows as $row){
        $arr[$row->kode_alternatif][$row->kode_kriteria] = $row->nilai;
    }
    return $arr;
}
/**
 * Membuat opsi level
 *
 * @param       string  $selected   Level terpilih 
 * @return      string  
 */
function get_level_option($selected = ''){    
    $arr = array(
        'admin' => 'Admin',
        'user' => 'User',
    );    
    $a = '';
    foreach($arr as $key => $val){
        if($selected==$key)
            $a.="<option value='$key' selected>$val</option>";
        else
            $a.= "<option value='$key'>$val</option>";
    }
    return $a;
}
