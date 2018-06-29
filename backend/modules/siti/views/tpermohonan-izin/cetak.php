<?php
$idpizin = $PermohonanIzin->id;
$pegawai = backend\modules\siti\models\TKaryawan::findOne(['id' => $PermohonanIzin->id]);
$jabatan = \backend\modules\siti\models\TJabatan::findOne(['id_jabatan' => $pegawai->id_jabatan]);
$jizin = \backend\modules\siti\models\TJenisIzin::findOne(['id_jizin' => $PermohonanIzin->id_jizin]);
$detail = backend\modules\siti\models\TMasterCutiIzin::findOne(['id_karyawan' => $PermohonanIzin->id]);
$atasan = backend\modules\siti\models\TKaryawan::findOne(['id_jabatan' => $PermohonanIzin->id_atasan]);
?>
<html>
    <style font-size="20px";></style>

    <body>
        <p align="center"><h3>FORM PERMOHONAN CUTI DAN IZIN</h3><hr>

    <table class="good" border="1px" width="100%">
            <tr>
                <td width="280px"><table><tr>
                            <td width="120px"><font align="left">Nama</font></td>
                            <td width="20px">:</td>
                            <td width="200px"><font align="left"><?php echo $pegawai->nama; ?></font></td>
                        </tr></table>
                </td>
            </tr>

            <tr>
            <br><br>
                <td width="280px"><table><tr>
                            <td width="120px"><font align="left">Jabatan</font></td>
                            <td width="20px">:</td>
                            <td width="200px"><font align="left"><?php echo $jabatan->jabatan; ?></font></td>
                        </tr></table>
                </td>
                <td width="280px">
                </td>
                <td width="280px">
                </td>
            </tr>
            <tr>
                <td width="280px"><table><tr>
                            <td width="120px"><font align="left">NIDN</font></td>
                            <td width="20px">:</td>
                            <td width="200px"><font align="left"><?php echo $pegawai->nik; ?></font></td>
                        </tr></table>
                </td>
            </tr>

            <table align="center" width="100%">
		<tr>
                    <td width="460px" colspan="8"><font size="15" align="left"><b>IZIN</b></font>
                    </td>
                </tr>

                <tr>
                        <td width="120px"><font align="left"><?php echo $jizin->nama_izin;?></font></td>
                        <td width="20px">:</td>
                        <td width="70px"><font align="left"><?php echo $PermohonanIzin->lama_izin;
                        echo ' Hari';?></font></td>
                        <td width="50px"><font align="left">Dari :</font></td>
                        <td width="130px"><font align="center"><?php echo $PermohonanIzin->tgl_mulai_izin;?></font></td>
                        <td width="90px"><font align="left">Sampai :</font></td>
                        <td width="130px"><font align="center"><?php echo $PermohonanIzin->tgl_akhir_izin;?></font></td>
		</tr>
	</table>

            <tr>
                <td width="280px"><table><tr>
                            <td width="120px"><font align="left">Alasan Izin</font></td>
                            <td width="20px">:</td>
                            <td width="200px"><font align="left"><?php echo $PermohonanIzin->alasan_izin; ?></font></td>
                        </tr></table>
                </td>
            </tr>

            <tr>
                <td width="280px"><table><tr>
                            <td width="120px"><font align="left">Atasan</font></td>
                            <td width="20px">:</td>
                            <td width="200px"><font align="left"><?php echo $atasan->nama; ?></font></td>
                        </tr></table>
                </td>
            </tr>

            <tr>
                <td width="280px"><table><tr>
                            <td width="120px"><font align="left">Pengalihan Tugas</font></td>
                            <td width="20px">:</td>
                            <td width="200px"><font align="left"><?php echo $PermohonanIzin->pengalihan; ?></font></td>
                        </tr></table>
                </td>
            </tr>

            <tr>
                <td width="280px"><table><tr>
                            <td width="120px"><font align="left">Izin Diambil</font></td>
                            <td width="20px">:</td>
                            <td width="200px"><font align="left"><?php echo $PermohonanIzin->lama_izin; ?></font></td>
                        </tr></table>
                </td>
            </tr>

            <tr>
                <td width="280px"><table><tr>
                            <td width="120px"><font align="left">Sisa Izin Tahunan</font></td>
                            <td width="20px">:</td>
                            <td width="50px"><font align="left"><?php echo $detail->jlh_izin; ?></font></td>
                        </tr></table>
                </td>
            </tr>
            <br><br>


        <tr>
            <td>
                <table>
                    <tr>
                        <td width="90"><font align="center">Diajukan oleh</font></td>
                        <td width="90"><font align="center">Disetujui oleh</font></td>
                        <td width="90"><font align="center">Diketahui oleh</font></td>
                    </tr>
                    <tr>
                        <td width="90" height="90"><font align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pemohon</font></td>
                        <td width="90" height="90"><font align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Atasan</font></td>
                        <td width="90" height="90"><font align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;WR2</font></td>
                    </tr>

                    <tr><td></td></tr>
                    <tr>
                        <td width="90"><font align="center">(.........ttd.........)</font></td>
                        <td width="90"><font align="center">(.........ttd.........)</font></td>
                        <td width="90"><font align="center">(.........ttd.........)</font></td>
                    </tr>
                    <tr><td><br></td></tr>
                </table>
                <hr>
        <table>
            <tr><td><br></td></tr>
            <tr><td><font size="10" align="left">Institut Teknologi Del</font></td></tr>
            <tr><td><font size="10" align="left">Jl. Sisingamangaraja Sitoluama-Laguboti</font></td></tr>
            <tr><td><font size="10" align="left">Toba samosir 22381</font></td></tr>
            <tr><td><font size="10" align="left">Telp(0632)331234 (021)5455477</font></td></tr>
            <tr><td><font size="10" align="left">Fax (0632) 33116, <u>info@del.ac.id</u> <u>http://www.del.ac.id</u></font></td></tr>
        </table>
        </table>


</body>
</html>
