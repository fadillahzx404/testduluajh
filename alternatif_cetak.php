<h1>Laporan Alternatif</h1>
<table>
    <thead><tr>
        <th>Kode</th>
        <th>Nama Alternatif</th>
        <th>Keterangan</th>
    </tr></thead>
    <?php
    $q = esc_field($_GET['q']);
    $rows = $db->get_results("SELECT * FROM tb_alternatif WHERE nama_alternatif LIKE '%$q%' ORDER BY kode_alternatif");    
    foreach($rows as $row):?>
    <tr>
        <td><?=$row->kode_alternatif?></td>
        <td><?=$row->nama_alternatif?></td>
        <td><?=$row->keterangan?></td>
    </tr>
    <?php endforeach?>
</table>