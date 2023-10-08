<div class="page-header">
    <h1>Kuisioner</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <input type="hidden" name="m" value="user" />
            <div class="form-group">                
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?=$_GET['q']?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Cari</button>
            </div>
             <div class="form-group" style="margin-left: 610px;">
                <a href="aksi.php?act=hapus_semua_kuisioner" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>Kosongan Kuisioner</a>
            </div>

        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr class="nw">
                    <th>No</th>
                    <th>Nama</th>               
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php
            $q = esc_field($_GET['q']);   
                            
            $rows = $db->get_results("SELECT DISTINCT kode_guru FROM tb_kuisioner WHERE kode_guru LIKE '%$q%' ORDER BY kode_guru");                
            $nama = $db->get_results("SELECT DISTINCT tb_kuisioner.kode_guru, tb_alternatif.nama_alternatif FROM tb_kuisioner INNER JOIN tb_alternatif ON tb_kuisioner.kode_guru=tb_alternatif.kode_alternatif");       
                    
            $no = 0;
                    
            foreach($nama as $names):?>
            <tr>
                <td><?=++$no ?></td>
                <td><?= $names->nama_alternatif ?></td>
                <td class="nw">
                    <a class="btn btn-xs btn-success" href="?m=lihat_kuisioner&ID=<?=$names->kode_guru?>">Lihat Kusisioner <?=$row->nama_alternatif?></a>
                </td>
            </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>