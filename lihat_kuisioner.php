<div class="page-header">
    <?php
    $nama_g = $db->get_row("SELECT tb_kuisioner.kode_guru, tb_alternatif.nama_alternatif FROM tb_kuisioner INNER JOIN tb_alternatif ON tb_kuisioner.kode_guru=tb_alternatif.kode_alternatif WHERE kode_guru='$_GET[ID]'");

    ?>
    <h1>Lihat Kuisioner <?= $nama_g->nama_alternatif ?></h1>
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
            <div class="form-group" style="margin-left: 10px;">
                <?php
                $result = $db->get_row("SELECT SUM(nilai_kriteria) as sum FROM tb_kuisioner WHERE kode_guru='$_GET[ID]'");
                ?>

                <li class="list-group-item">
                    <span class="badge" style="margin-left: 20px;"><?= $result->sum ?></span>
                    Jumlah Nilai <?= $nama_g->nama_alternatif ?>
                </li>

            </div>

        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>

                    <th>Nomor</th>
                    <th>Nama Pengisi</th>
                    <th>Aksi</th>



                </tr>

            </thead>
            <?php
            $q = esc_field($_GET['q']);
            $rows = $db->get_results("SELECT * FROM tb_kuisioner WHERE kode_guru='$_GET[ID]'");
            $nama = $db->get_results("SELECT DISTINCT nama FROM tb_kuisioner WHERE kode_guru='$_GET[ID]'");



            $no = 0; ?>
            <tbody>
                <?php
                foreach ($nama as $name) : ?>
                    <tr>
                        <td><?= ++$no  ?></td>
                        <td><?= $name->nama ?></td>
                        <?php

                        $namaa = preg_replace('/\s+/', '', $name->nama);
                        ?>
                        <td>
                            <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#Modal-<?= $namaa ?>">Lihat Detail</a>
                        </td>

                    </tr>


                    <div class="modal fade bs-example-modal-md" tabindex="-1" id="Modal-<?= $namaa ?>" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Penilaian <b><?= $nama_g->nama_alternatif ?></b> oleh siswa </b><?= $name->nama; ?></b></h4>
                                </div>
                                <div class="modal-body">
                                    <?php $kriteria = $db->get_results("SELECT tb_kriteria.nama_kriteria,tb_kuisioner.kode_kriteria,tb_kuisioner.nilai_kriteria FROM tb_kuisioner INNER JOIN tb_kriteria ON tb_kuisioner.kode_kriteria=tb_kriteria.kode_kriteria WHERE nama='$name->nama' AND kode_guru='$_GET[ID]' ORDER BY kode_kriteria ASC");
                                    // var_dump($kriteria);
                                    foreach ($kriteria as $k) :
                                    ?>
                                        <div class="row kriteria">
                                            <div class="col-md-6">
                                                <label for="kriteria"><?= $k->nama_kriteria ?></label>

                                            </div>
                                            <div class="col-md-6">
                                                <input type="number" class="form-control" placeholder="Nilai" value="<?= $k->nilai_kriteria ?>" readonly />
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </tbody>

        </table>
    </div>
</div>