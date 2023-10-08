<div class="page-header">
    <h1>Nilai Bobot Kriteria</h1>
</div>
<?php
if($_POST) include'aksi.php';
$rel_kriteria = get_rel_kriteria();
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline" action="?m=rel_kriteria" method="post">
            <div class="form-group">
                <select class="form-control" name="ID1">
                <?=get_kriteria_option($_POST['ID1'])?>
                </select>
            </div>
            <div class="form-group">
                <select class="form-control" name="nilai">
                <?=get_nilai_option($_POST['nilai'])?>
                </select>
            </div>
            <div class="form-group">
                <select class="form-control" name="ID2">
                <?=get_kriteria_option($_POST['ID2'])?>
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span> Ubah</button>
            </div>
        </form>
    </div>
    <div class="table-responsive">    
        <table class="table table-bordered table-hover table-striped">
            <thead><tr>
                <th>Kode</th>
                <th>Nama</th>
                <?php foreach($KRITERIA as $key => $val):?>
                <th><?=$key?></th>
                <?php endforeach?>
            </tr></thead>        
            <?php
            $no=1;
            $a=1;
            foreach($rel_kriteria as $key => $val):?>
            <tr>
                <td><?=$key?></td>
                <td><?=$KRITERIA[$key]->nama_kriteria?></td>
                <?php 
                $b = 1;
                foreach($val as $k => $v):?>
                <td class="<?=$a==$b ? 'success' : ($a < $b ? 'danger' : '')?>"><?=round($v, 3)?></td>
                <?php $b++; endforeach?>
            </tr>
            <?php $a++; endforeach?>
        </table>
    </div>
</div>