<?php
require_once'functions.php';

if($act=='login'){
    $user = esc_field($_POST['user']);
    $pass = esc_field($_POST['pass']);
    
    $row = $db->get_row("SELECT * FROM tb_user WHERE user='$user' AND pass='$pass'");
    if($row){
        $_SESSION['login'] = $row->user;
        $_SESSION['level'] = strtolower($row->level);
        
        redirect_js("index.php");
    } else{
        print_msg("Salah kombinasi username dan password.");
    } 
}elseif ($mod=='password'){
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $pass3 = $_POST['pass3'];
    
    $row = $db->get_row("SELECT * FROM tb_user WHERE user='$_SESSION[login]' AND pass='$pass1'");        
    
    if($pass1=='' || $pass2=='' || $pass3=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif(!$row)
        print_msg('Password lama salah.');
    elseif($pass2!=$pass3)
        print_msg('Password baru dan konfirmasi password baru tidak sama.');
    else{        
        $db->query("UPDATE tb_user SET pass='$pass2' WHERE user='$_SESSION[login]'");                    
        print_msg('Password berhasil diubah.', 'success');
    }
}elseif($act=='logout'){
    unset($_SESSION['login'], $_SESSION['level']);
    header("location:login.php");
} 
/** user */
elseif($mod=='user_tambah'){
    $kode_user = $_POST['kode_user'];
    $nama_user = $_POST['nama_user'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $level = $_POST['level'];
            
    if($kode_user=='' || $user=='' || $pass=='' || $nama_user=='' || $level=='')
        print_msg("Field yang bertanda * tidak boleh kosong!");
    elseif($db->get_row("SELECT * FROM tb_user WHERE kode_user='$kode_user' AND kode_user<>'$_GET[ID]'")){
        print_msg("Kode sudah ada!");    
    }elseif($db->get_row("SELECT * FROM tb_user WHERE user='$user' AND kode_user<>'$_GET[ID]'")){
        print_msg("User sudah ada!");    
    }else{
        $db->query("INSERT INTO tb_user (kode_user, user, pass, nama_user, level) 
                                    VALUES ('$kode_user', '$user', '$pass', '$nama_user', '$level')");                                                           
        redirect_js("index.php?m=user");
    }
} else if($mod=='user_ubah'){
    $kode_user = $_POST['kode_user'];
    $nama_user = $_POST['nama_user'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $level = $_POST['level'];
            
    if($kode_user=='' || $user=='' || $pass=='' || $nama_user=='' || $level=='')
        print_msg("Field yang bertanda * tidak boleh kosong!");
    elseif($db->get_row("SELECT * FROM tb_user WHERE user='$user' AND kode_user<>'$_GET[ID]'")){
        print_msg("User sudah ada!");   
    }else{
        $db->query("UPDATE tb_user SET 
                user='$user', 
                pass='$pass', 
                nama_user='$nama_user',                                         
                level='$level'
            WHERE kode_user='$_GET[ID]'");
        redirect_js("index.php?m=user");
    }
} else if ($act=='user_hapus'){
    $db->query("DELETE FROM tb_user WHERE kode_user='$_GET[ID]'");
    header("location:index.php?m=user");                    
} 
/** alternatif */
elseif($mod=='alternatif_tambah'){
    $kode_alternatif = $_POST['kode_alternatif'];
    $nama_alternatif = $_POST['nama_alternatif'];
    $keterangan = $_POST['keterangan'];
    if($kode_alternatif=='' || $nama_alternatif=='')
        print_msg("Field yang bertanda * tidak boleh kosong!");
    elseif($db->get_results("SELECT * FROM tb_alternatif WHERE kode_alternatif='$kode_alternatif'"))
        print_msg("Kode sudah ada!");
    else{
        $db->query("INSERT INTO tb_alternatif (kode_alternatif, nama_alternatif, keterangan) 
            VALUES ('$kode_alternatif', '$nama_alternatif', '$keterangan')");
        
        $db->query("INSERT INTO tb_rel_alternatif(kode_alternatif, kode_kriteria, nilai) 
            SELECT '$kode_alternatif', kode_kriteria, -1 FROM tb_kriteria");       
        redirect_js("index.php?m=alternatif");
    }
} else if($mod=='alternatif_ubah'){
    $kode_alternatif = $_POST['kode_alternatif'];
    $nama_alternatif = $_POST['nama_alternatif'];
    $keterangan = $_POST['keterangan'];
    if($kode_alternatif=='' || $nama_alternatif=='')
        print_msg("Field yang bertanda * tidak boleh kosong!");
    else{
        $db->query("UPDATE tb_alternatif SET nama_alternatif='$nama_alternatif', keterangan='$keterangan' 
            WHERE kode_alternatif='$_GET[ID]'");
        redirect_js("index.php?m=alternatif");
    }
} else if ($act=='alternatif_hapus'){
    $db->query("DELETE FROM tb_alternatif WHERE kode_alternatif='$_GET[ID]'");
    $db->query("DELETE FROM tb_rel_alternatif WHERE kode_alternatif='$_GET[ID]'");
    header("location:index.php?m=alternatif");
} 

/** kriteria */    
elseif($mod=='kriteria_tambah'){
    $kode_kriteria = $_POST['kode_kriteria'];
    $nama_kriteria = $_POST['nama_kriteria'];
    $atribut = $_POST['atribut'];
    
    if($kode_kriteria=='' || $nama_kriteria=='' || $atribut=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif($db->get_results("SELECT * FROM tb_kriteria WHERE kode_kriteria='$kode_kriteria'"))
        print_msg("Kode sudah ada!");
    else{
        $db->query("INSERT INTO tb_kriteria (kode_kriteria, nama_kriteria) 
            VALUES ('$kode_kriteria', '$nama_kriteria')");
        $db->query("INSERT INTO tb_rel_kriteria(ID1, ID2, nilai) 
            SELECT '$kode_kriteria', kode_kriteria, 1 FROM tb_kriteria");
        $db->query("INSERT INTO tb_rel_kriteria(ID1, ID2, nilai) 
            SELECT kode_kriteria, '$kode_kriteria', 1 FROM tb_kriteria WHERE kode_kriteria<>'$kode'");
        
        $db->query("INSERT INTO tb_rel_alternatif(kode_alternatif, kode_kriteria, nilai) 
            SELECT kode_alternatif, '$kode_kriteria', -1  FROM tb_alternatif");
                   
        redirect_js("index.php?m=kriteria");
    }    
} else if($mod=='kriteria_ubah'){
    $kode_kriteria = $_POST['kode_kriteria'];
    $nama_kriteria = $_POST['nama_kriteria'];
    $atribut = $_POST['atribut'];
    
    if($kode_kriteria=='' || $nama_kriteria=='' || $atribut=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif($db->get_results("SELECT * FROM tb_kriteria WHERE kode_kriteria='$kode_kriteria' AND kode_kriteria<>'$_GET[ID]'"))
        print_msg("Kode sudah ada!");
    else{
        $db->query("UPDATE tb_kriteria SET kode_kriteria='$kode_kriteria', nama_kriteria='$nama_kriteria', atribut='$atribut' WHERE kode_kriteria='$_GET[ID]'");
        redirect_js("index.php?m=kriteria");
    }    
} else if ($act=='kriteria_hapus'){
    $db->query("DELETE FROM tb_kriteria WHERE kode_kriteria='$_GET[ID]'");
    $db->query("DELETE FROM tb_rel_kriteria WHERE ID1='$_GET[ID]' OR ID2='$_GET[ID]'");
    $db->query("DELETE FROM tb_rel_alternatif WHERE kode_kriteria='$_GET[ID]'");
    header("location:index.php?m=kriteria");
} 

/** crips */    
elseif($mod=='crips_tambah'){
    $nilai = $_POST['nilai'];
    $keterangan = $_POST['keterangan'];
    
    if($nilai=='' || $keterangan=='')
        print_msg("Nilai dan nama tidak boleh kosong!");
    else{
        $db->query("INSERT INTO tb_crips (kode_kriteria, nilai, keterangan) VALUES ('$_POST[kode_kriteria]', '$nilai', '$keterangan')");           
        redirect_js("index.php?m=crips&kode_kriteria=$_GET[kode_kriteria]");
    }                  
} else if($mod=='crips_ubah'){
    $nilai = $_POST['nilai'];
    $keterangan = $_POST['keterangan'];
    
    if($nilai=='' || $keterangan=='')
        print_msg("Nilai dan nama tidak boleh kosong!");
    else{
        $db->query("UPDATE tb_crips SET nilai='$nilai', keterangan='$keterangan' WHERE kode_crips='$_GET[ID]'");
        redirect_js("index.php?m=crips&kode_kriteria=$_GET[kode_kriteria]");
    }   
} else if ($act=='crips_hapus'){
    $db->query("DELETE FROM tb_crips WHERE kode_crips='$_GET[ID]'");
    header("location:index.php?m=crips&kode_kriteria=$_GET[kode_kriteria]");
} 

/** rel_alternatif */ 
else if ($mod=='rel_alternatif_ubah'){
    foreach($_POST['nilai'] as $key => $val){        
        $db->query("UPDATE tb_rel_alternatif SET nilai='$val' WHERE ID='$key'");
    }
    redirect_js("index.php?m=rel_alternatif");
} 

/** rel_kriteria */
else if ($mod=='rel_kriteria'){
    $ID1 = $_POST['ID1'];
    $ID2 = $_POST['ID2'];
    $nilai = abs($_POST['nilai']);
    
    if($ID1==$ID2 && $nilai<>1)
        print_msg("Kriteria yang sama harus bernilai 1.");
    else{
        $db->query("UPDATE tb_rel_kriteria SET nilai=$nilai WHERE ID1='$ID1' AND ID2='$ID2'");
        $db->query("UPDATE tb_rel_kriteria SET nilai=1/$nilai WHERE ID2='$ID1' AND ID1='$ID2'");
        print_msg("Nilai kriteria berhasil diubah.", 'success');
    }
}
elseif ($act=='valid_nama') {
   

        $res = $db->get_results("SELECT nama FROM tb_kuisioner");
        
        $que = $db->query("SELECT nama FROM tb_kuisioner WHERE nama='$_POST[nama]'");
		$row = $que->num_rows;
        
        if ($row>0) {
            echo '<script type="text/javascript">alert("Maaf Nama Pengisi Kuisioner Telah ada");</script>';
             redirect_js('login.php');
        }
        else { 
            $a['data'] = 'tidak';
            $_SESSION['nama'] = $_POST['nama'];  
            redirect_js('isi_kuisioner.php'); 
                       
                  
            }
        redirect('login.php');
            
        
    
}

/** rel_kuisioner */
else if ($act=='tambah_kuisioner') {
    
    
    foreach ($_POST['kode_guru'] as $key => $val) {
        var_dump($_POST);
        
        
        $k['nama_siswa'] = $_POST['nama_siswa'];
        $k['kode_guru'] = $val;
        $k['kode_kriteria'] = $_POST['kode_kriteria'][$key];
        $k['nilai_kriteria'] = $_POST['nilai_kriteria'][$key];

            var_dump($k);
            // $db->query("INSERT INTO tb_kuisioner (nama, kode_guru, kode_kriteria, nilai_kriteria) VALUES ('$k[nama_siswa]', '$k[kode_guru]', '$k[kode_kriteria]','$k[nilai_kriteria]')"); 
        
            
        
        
        
    }

    redirect_js("login.php");
}
else if ($act=='hapus_semua_kuisioner') {
   $db->query("DELETE FROM tb_kuisioner");
   redirect_js('index.php?m=kuisioner');
}