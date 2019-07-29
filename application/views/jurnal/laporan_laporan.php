<div>
    <legend>Pilih Laporan Untuk Ditampilkan</legend>
    <form method="POST" target="_blank" action="<?php echo site_url('jurnal/laporan') ?>">
        <table class="table" style="width: 75%">
            <tr>
                <td style="text-align: center">Periode 
                    <span class="glyphicon glyphicon-question-sign"
                    title="tanggal laporan akan dimulai dari tanggal 28 hingga tanggal 27 bulan selanjutnya. Contoh : Januari-Februari 2017. Maka 28 Januari 2017 hingga 27 Februari 2017"
                    ></span></td>
                    <td>Jenis Laporan</td>
                </tr>
                <tr>
                    <td>
                        <select class="form-control form-control-lg" name="bulan_dari" id="">
                            <?php
                            $cars = array(
                                "Januari",
                                "Februari",
                                "Maret",
                                "April",
                                "Mei",
                                "Juni",
                                "Juli",
                                "Agustus",
                                "September",
                                "Oktober",
                                "November",
                                "Desember"
                            );
                            $i = 0;
                            foreach ($cars as $values) {
                                ?>
                                <option value="<?php echo $i + 1; ?>"><?php echo $values; ?></option>
                                <?php
                                $i ++;
                            }
                            ?>
                        </select> 
                        <select class="form-control form-control-lg" name="tahun_dari" id="">
                            <?php foreach ($tahun as $thn) { ?>
                            <option value="<?php echo $thn->tahunTerakhir; ?>"><?php echo $thn->tahunTerakhir; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td><br /> 
                        <select class="form-control form-control-lg" name="jenis_laporan">
                            <?php
                            $cars = array(
                                "Laporan Penjualan",
                                "Laporan Jurnal Umum Berdasarkan Kelompok Akun",
                                "Laporan Jurnal Umum",
                                "Laporan Jurnal Umum by akun",
                                "Neraca",
                                "Laba Rugi",
                                "Finance Meter"
                            );
                            $i = 0;
                            foreach ($cars as $values) {
                                ?>
                                <option value="<?php echo $i + 1; ?>"><?php echo $values; ?></option>
                                <?php
                                $i ++;
                            }
                            ?>
                        </select></td>
                    </tr>
                    <tr style="text-align: center">
                        <td colspan=4>
                            <button class="btn btn-neutral" style="background: #68AE00; color: #fff">Tampilkan</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>

        <div>
            <legend>Laporan History Sumber Dana Per Periode</legend>
            <form method="POST" target="_blank" action="<?php echo site_url('jurnal/laporan_history_letak_uang') ?>">
                <table class="table" style="width: 75%">
                    <tr>
                        <td style="text-align: center">Periode 
                            <span class="glyphicon glyphicon-question-sign"
                            title="tanggal laporan akan dimulai dari tanggal 28 hingga tanggal 27 bulan selanjutnya. Contoh : Januari-Februari 2017. Maka 28 Januari 2017 hingga 27 Februari 2017"
                            ></span></td>
                            <td>Jenis Laporan</td>
                        </tr>
                        <tr>
                            <td>
                                <select class="form-control form-control-lg" name="bulan_dari" id="">
                                    <?php
                                    $cars = array(
                                        "Januari",
                                        "Februari",
                                        "Maret",
                                        "April",
                                        "Mei",
                                        "Juni",
                                        "Juli",
                                        "Agustus",
                                        "September",
                                        "Oktober",
                                        "November",
                                        "Desember"
                                    );
                                    $i = 0;
                                    foreach ($cars as $values) {
                                        ?>
                                        <option value="<?php echo $i + 1; ?>"><?php echo $values; ?></option>
                                        <?php
                                        $i ++;
                                    }
                                    ?>
                                </select> 
                                <select class="form-control form-control-lg" name="tahun_dari" id="">
                                    <?php foreach ($tahun as $thn) { ?>
                                    <option value="<?php echo $thn->tahunTerakhir; ?>"><?php echo $thn->tahunTerakhir; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td ><br /> 
                                <select class="form-control form-control-lg" name="sumber_dana">
                                    <?php
                                    $i = 0;
                                    foreach ($sumber_dana as $value) {
                                        ?>
                                        <option value="<?php echo $value->kode; ?>"><?php echo $value->nama_tempat; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr style="text-align: center">
                                <td colspan=4>
                                    <button class="btn btn-neutral" style="background: #68AE00; color: #fff">Tampilkan</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>

                <div>
                    <legend>Laporan History Sumber Dana </legend>
                    <form method="POST" target="_blank" action="<?php echo site_url('jurnal/seluruh_history_sumbe_Dana') ?>">
                        <table class="table" style="width: 75%">
                            <tr>
                                <td>Pilih History Sumber Dana yang Akan Ditamppilkan</td>
                            </tr>
                            <tr>
                                <td ><br /> 
                                    <select class="form-control form-control-lg" name="sumber_dana">
                                        <?php
                                        $i = 0;
                                        foreach ($sumber_dana as $value) {
                                            ?>
                                            <option value="<?php echo $value->kode; ?>"><?php echo $value->nama_tempat; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr style="text-align: center">
                                    <td colspan=4>
                                        <button class="btn btn-neutral" style="background: #68AE00; color: #fff">Tampilkan</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>

                    <div>
                        <legend>Laporan Berdasarkan Akun</legend>
                        <form method="POST" target="_blank" action="<?php echo site_url('jurnal/laporan_by_akun') ?>">
                            <table class="table" style="width: 75%">
                                <tr>
                                    <td>Pilih Akun yang Akan ditampilkan</td>
                                </tr>
                                <tr>
                                    <tr>
                                        <td>
                                            <select class="form-control form-control-lg" name="akun">
                                                <?php
                                                foreach ($akun as $value) {
                                                    ?>
                                                    <option
                                                    value="<?php echo $value->Kode; ?>"><?php echo $value->Akun; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr style="text-align: center">
                                        <td colspan=4>
                                            <button class="btn btn-neutral" style="background: #68AE00; color: #fff">Tampilkan</button>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>

