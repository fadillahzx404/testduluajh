    <!-- Container -->
    <div class="container-fluid invoice-container">
        <!-- Header -->
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-2 mb-3">
                        <img id="logo" src="login.png" style="width: 120px" />
                    </div>
                    <div class="col-9 text-center" style="margin-top: 40px;">
                        <p class="text-lg-center text-center fs-5" style="margin-bottom: -2px">
                            <b>
                                SMK PURNAMA 1 JAKARTA
                            </b>
                        </p>
                        <p style="font-size: 12px">
                            Jl. Tirtayasa V No.3, RT.3/RW.2, Melawai, Kec. Keb. Baru, Kota
                            Jakarta Selatan<br />
                            Telepon: (021) 27506553
                        </p>
                    </div>
                </div>
            </div>
            <hr style="margin-top: -5px" />
        </header>
        <h1>Hasil Perhitungan</h1>
        <p style="color: grey;">Berikut masing-masing nama guru dan juga ranking dari setiap guru :</p>
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Kode</th>
                    <th>Nama Alternatif</th>
                    <th>Keterangan</th>
                    <th>Total</th>
                </tr>
            </thead>
            <?php

            $q = esc_field($_GET['q']);
            $rows = $db->get_results("SELECT * FROM tb_alternatif WHERE nama_alternatif LIKE '%$q%' ORDER BY total DESC");
            $no = 0;

            foreach ($rows as $row) : ?>
                <tr>

                    <td><?= $row->rank ?></td>
                    <td><?= $row->kode_alternatif ?></td>
                    <td><?= $row->nama_alternatif ?></td>
                    <td><?= $row->keterangan ?></td>
                    <td><?= round($row->total, 4) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <br />
    </div>