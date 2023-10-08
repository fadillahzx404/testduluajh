<div class="page-header">
    <h1>Nilai Bobot Alternatif</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <input type="hidden" name="m" value="rel_alternatif" />
            <div class="form-group">
                <input class="form-control" type="text" name="q" value="<?= $_GET['q'] ?>" placeholder="Pencarian" />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Cari</button>
            </div>

            <div class="form-group" style="margin-left: 700px;">
                <a href="?act=pdf_nilai" target="_blank" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-download"></span>Simpan PDF</a>
            </div>

        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Alternatif</th>
                    <?php foreach ($KRITERIA as $key => $val) : ?>
                        <th>Rata-Rata <br><?= $val->nama_kriteria ?></th>
                    <?php endforeach; ?>


                </tr>
            </thead>
            <?php
            $q = esc_field($_GET['q']);
            $result = $db->get_results("SELECT tb_kuisioner.kode_guru, tb_alternatif.nama_alternatif FROM tb_kuisioner INNER JOIN tb_alternatif ON tb_kuisioner.kode_guru=tb_alternatif.kode_alternatif GROUP BY kode_guru");

            $nama_guru = $db->get_results("SELECT tb_kuisioner.kode_guru, tb_alternatif.nama_alternatif FROM tb_kuisioner INNER JOIN tb_alternatif ON tb_kuisioner.kode_guru=tb_alternatif.nama_alternatif ");
            $siswa = $db->get_row("SELECT COUNT(DISTINCT nama) as j_s FROM tb_kuisioner");

            $rel_alternatif = get_rel_alternatif();

            foreach ($result as $row) : ?>

                <tr>
                    <td><?= $row->kode_guru ?></td>
                    <td><?= $row->nama_alternatif ?></td>


                    <?php
                    foreach ($KRITERIA as $k) : ?>

<td>
    
    <?php $total_nilai = $db->get_results("SELECT SUM(nilai_kriteria)/$siswa->j_s as tnn  FROM tb_kuisioner WHERE kode_guru='$row->kode_guru' AND kode_kriteria='$k->kode_kriteria'"); 
                            foreach ($total_nilai as $tn) {
                                $db->query("INSERT INTO tb_rel_alternatif (kode_alternatif,kode_kriteria,nilai) 
                                SELECT * FROM (SELECT '$row->kode_guru', '$k->kode_kriteria', '$tn->tnn') AS tmp
                                WHERE NOT EXISTS (SELECT kode_alternatif,kode_kriteria FROM tb_rel_alternatif WHERE kode_alternatif = '$row->kode_guru'AND kode_kriteria='$k->kode_kriteria') LIMIT 1");
                                // $db->query("INSERT IGNORE INTO tb_nilai (kode_kriteria,kode_guru,total_nilai) VALUES ('$k->kode_kriteria','$row->kode_guru','$tn->tnn')");
                                $db->query("UPDATE tb_rel_alternatif SET nilai='$tn->tnn' WHERE kode_alternatif='$row->kode_guru' AND kode_kriteria='$k->kode_kriteria'");
                               
                            }

                            ?>

                            <?php $nilai = $db->get_results("SELECT nilai FROM tb_rel_alternatif WHERE kode_alternatif='$row->kode_guru' AND kode_kriteria='$k->kode_kriteria'");
                            

                            ?>

                            <?php foreach ($nilai as $n) : ?>

                                <?= round($n->nilai, 2) ?>
                            <?php endforeach; ?>

                        </td>
                    <?php endforeach; ?>




                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>