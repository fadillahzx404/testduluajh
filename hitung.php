<div class="page-header">
    <h1>Perhitungan</h1>
</div>
<?php    
    $c = $db->get_results("SELECT * FROM tb_rel_alternatif WHERE nilai>0");
    if (!$ALTERNATIF|| !$KRITERIA):
        echo "Tampaknya anda belum mengatur alternatif dan kriteria. Silahkan tambahkan minimal 3 alternatif dan 3 kriteria.";
    elseif (!$c):
        echo "Tampaknya anda belum mengatur nilai alternatif. Silahkan atur pada menu <strong>Nilai Bobot</strong> > <strong>Nilai Bobot Alternatif</strong>.";
    else:
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Mengukur Konsistensi Kriteria (AHP)</h3>
    </div>
    <div class="panel-body">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#c11" aria-expanded="false" aria-controls="c11">
                        Matriks Perbandingan Kriteria
                    </a>
                </h3>
            </div>
            <div class="table-responsive collapse" id="c11">
                <table class="table table-bordered table-striped table-hover">
                    <thead><tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <?php foreach($KRITERIA as $key => $val):?>
                        <th><?=$key?></th>
                        <?php endforeach?>
                    </tr></thead>
                    <?php 
                    $rel_kriteria = get_rel_kriteria();   
                    $ahp = new AHP($rel_kriteria);
                    foreach($ahp->data as $key => $val):?>
                    <tr>
                        <td><?=$key?></td>
                        <td><?=$KRITERIA[$key]->nama_kriteria?></td>
                        <?php foreach($val as $k => $v):?>
                        <td><?=round($v, 4)?></td>
                        <?php endforeach?>
                    </tr>
                    <?php endforeach?>
                    <tfoot><tr class="text-primary">
                        <td colspan="2" class="text-right">Total</td>
                        <?php foreach($ahp->baris_total as $key => $val):?>
                        <td><?=round($val, 4)?></td>
                        <?php endforeach?>
                    </tr></tfoot>                
                </table>            
            </div>        
        </div>        
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#c12" aria-expanded="false" aria-controls="c12">
                        Matriks Bobot Prioritas Kriteria
                    </a>
                </h3>
            </div>
            <div class="table-responsive collapse" id="c12">
                <table class="table table-bordered table-striped table-hover">
                    <thead><tr>
                        <th>Kode</th>
                        <?php foreach($KRITERIA as $key => $val):?>
                        <th><?=$key?></th>
                        <?php endforeach?>
                        <th>Prioritas</th>
                        <th>Consistency Measure</th>
                    </tr></thead>
                    <?php foreach($ahp->normal as $key => $val):?>
                    <tr>
                        <td><?=$key?></td>
                        <?php foreach($val as $k => $v):?>
                        <td><?=round($v, 4)?></td>
                        <?php endforeach?>
                        <td><?=round($ahp->prioritas[$key], 4)?></td>
                        <td><?=round($ahp->cm[$key], 4)?></td>
                    </tr>
                    <?php endforeach?>
                </table> 
            </div>
        </div>        
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#c13" aria-expanded="false" aria-controls="c13">
                        Konsistensi Kriteria
                    </a>
                </h3>
            </div>
            <div class="panel-body collapse" id="c13">        
                <p>Berikut tabel ratio index berdasarkan ordo matriks.</p>    
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Ordo matriks</th>
                            <?php
                                foreach($nRI as $key => $value){
                                    if(count($rel_kriteria)==$key)
                                        echo "<td class='text-primary'>$key</td>";
                                    else
                                        echo "<td>$key</td>";
                                }
                            ?>
                        </tr>
                        <tr>
                            <th>Ratio index</th>
                            <?php
                                foreach($nRI as $key => $value){
                                    if(count($rel_kriteria)==$key)
                                        echo "<td class='text-primary'>$value</td>";
                                    else
                                        echo "<td>$value</td>";
                                }
                            ?>
                        </tr>
                    </table>
                </div>        
            </div>
            <div class="panel-footer">
            <?php
                $cm = $ahp->cm;
                $CI = ((array_sum($cm)/count($cm))-count($cm))/(count($cm)-1);	
            	$RI = $nRI[count($rel_kriteria)];
            	$CR = $CI/$RI;
            	echo "<p>Consistency Index: ".round($CI, 3)."<br />";	
            	echo "Ratio Index: ".round($RI, 3)."<br />";
            	echo "Consistency Ratio: ".round($CR, 3);
            	if($CR>0.1){
            		echo " (Tidak konsisten)<br />";	
            	} else {
            		echo " (Konsisten)<br />";
            	}
            ?>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Perhitungan SAW</h3>
    </div>
    <div class="panel-body">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <a data-toggle="collapse" href="#alt_krit_<?=$key_ahp?>">
                        Alternatif Kriteria
                    </a>
                </h3>
            </div>
            <div class="table-responsive collapse" id="alt_krit_<?=$key_ahp?>">
                <table class="table table-bordered table-striped table-hover">
                    <thead><tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <?php foreach($KRITERIA as $key => $val):?>
                        <th><?=$val->nama_kriteria?></th>
                        <?php endforeach?>
                    </tr></thead>
                    <?php 
                    $atribut = array();
                    foreach($KRITERIA as $key => $val){
                        $atribut[$key] = $val->atribut;
                    }
                    $rel_alternatif = get_rel_alternatif();
                    $saw = new SAW($rel_alternatif, $atribut, $ahp->prioritas);
                    $minmax = array();
                    foreach($saw->data as $key => $val):?>
                    <tr>
                        <td><?=$key?></td>
                        <td><?=$ALTERNATIF[$key]?></td>
                        <?php foreach($val as $k => $v): $minmax[$k][$key] = $v?>
                        <td><?=round($v, 3)?></td>
                        <?php endforeach?>
                    </tr>
                    <?php endforeach?>
                    <tfoot><tr>
                        <td colspan="2" class="text-right">Max</td>
                        <?php foreach($saw->minmax as $key => $val):?>
                        <td><?=round($val['max'], 3)?></td>
                        <?php endforeach?>
                    </tr><tr>
                        <td colspan="2" class="text-right">Min</td>
                        <?php foreach($saw->minmax as $key => $val):?>
                        <td><?=round($val['min'], 3)?></td>
                        <?php endforeach?>
                    </tr></tfoot>
                </table>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <a data-toggle="collapse" href="#fij_<?=$key_ahp?>">
                        Normalisasi Matriks
                    </a>
                </h3>
            </div>
            <div class="table-responsive collapse" id="fij_<?=$key_ahp?>">
                <table class="table table-bordered table-striped table-hover">
                    <thead><tr>
                        <th>&nbsp;</th>
                        <?php foreach($KRITERIA as $key => $val):?>
                        <th><?=$key?></th>
                        <?php endforeach?>
                    </tr><tr>
                        <th>Bobot</th>
                        <?php foreach($KRITERIA as $key => $val):?>
                        <th><?=$val->atribut?></th>
                        <?php endforeach?>
                    </tr></thead>
                    <?php foreach($saw->normal as $key => $val):?>
                    <tr>
                        <td><?=$key?></td>
                        <?php foreach($val as $k => $v):?>
                        <td><?=round($v, 3)?></td>
                        <?php endforeach?>
                    </tr>
                    <?php endforeach?>
                </table>
            </div>
        </div>

        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <a data-toggle="collapse" href="#terbobot_<?=$key_ahp?>">
                        Terbobot
                    </a>
                </h3>
            </div>
            <div class="table-responsive collapse" id="terbobot_<?=$key_ahp?>">
                <table class="table table-bordered table-striped table-hover">
                    <thead><tr>
                        <th>&nbsp;</th>
                        <?php foreach($KRITERIA as $key => $val):?>
                        <th><?=$key?></th>
                        <?php endforeach?>
                    </tr><tr>
                        <th>Bobot</th>
                        <?php foreach($saw->bobot as $key => $val):?>
                        <th><?=round($val, 4)?></th>
                        <?php endforeach?>
                    </tr></thead>
                    <?php foreach($saw->terbobot as $key => $val):?>
                    <tr>
                        <td><?=$key?></td>
                        <?php foreach($val as $k => $v):?>
                        <td><?=round($v, 4)?></td>
                        <?php endforeach?>
                    </tr>
                    <?php endforeach?>
                </table>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <a data-toggle="collapse" href="#rank">
                        Perangkingan
                    </a>
                </h3>
            </div>
            <div class="table-responsive collapse in" id="rank">
                <table class="table table-bordered table-striped table-hover">
                    <thead><tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Total</th>
                        <th>Rank</th>
                    </tr></thead>
                        <?php foreach($saw->rank as $key => $val):
                            $db->query("UPDATE `tb_alternatif` SET `total`='{$saw->total[$key]}',`rank`='$val' WHERE kode_alternatif='$key'");
                            
                            ?>
                    <tr>
                        <td><?=$key?></td>
                        <td><?=$ALTERNATIF[$key]?></td>
                        <td><?=round($saw->total[$key], 3)?></td>
                        <td><?=round($saw->rank[$key], 3)?></td>
                    </tr>
                    <?php endforeach?>
                </table>
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <a class="btn btn-default" href="cetak.php?m=hitung" target="_blank"><span class="glyphicon glyphicon-print"></span> Cetak</a>
    </div>
</div>
<?php endif?>
