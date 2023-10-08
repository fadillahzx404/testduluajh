<?php
$row = $db->get_row("SELECT * FROM tb_alternatif WHERE kode_alternatif='$_GET[ID]'");
?>
<div class="page-header">
    <h1>Ubah Nilai Bobot &raquo; <small><?= $row->nama_alternatif ?></small></h1>
</div>
<div class="row">
    <div class="col-sm-4">
        <?php if ($_POST) include 'aksi.php' ?>
        <form method="post">
            <?php
            $rows = $nilai = $db->get_results("SELECT * FROM tb_nilai WHERE kode_guru='$_GET[ID]'");

            $nama_kriteria = $db->get_results("SELECT tb_nilai.kode_kriteria, tb_kriteria.nama_kriteria FROM tb_nilai INNER JOIN tb_kriteria ON tb_nilai.kode_kriteria=tb_kriteria.nama_kriteria WHERE kode_guru='$_GET[ID]'");

            var_dump($nama_kriteria);
            foreach ($nilai as $row) : ?>

                <div class="form-group">

                    <label>

                        <?php

                        foreach ($nama_kriteria as $nk) :
                        ?>
                            <?= $nk->nama_kriteria ?>

                        <?php endforeach; ?>
                    </label>
                    <input class="form-control" type="text" name="nilai[<?= $row->ID ?>]" value="<?= round($row->total_nilai, 2) ?>" />
                </div>
            <?php endforeach; ?>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=rel_alternatif"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>