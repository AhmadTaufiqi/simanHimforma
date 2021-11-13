<?php
include_once('koneksi.php');
$json = array();
$show = mysqli_query($connect, "SELECT * FROM tb_absen");

while ($row = mysqli_fetch_assoc($show)) {
    if ($row['jenis'] == 'CUTI') {
        $json[] = array(
            'backgroundColor' => 'rgb(255,0,0)',
            'borderColor' => 'rgb(255,0,0)',
            'title' => $row['nama'] . ":" . $row['jenis'],
            'start' => $row['start'],
            'end' => $row['end']
        );
    } else {
        $json[] = array(
            'title' => $row['nama'] . ":" . $row['jenis'],
            'start' => $row['start'],
            'end' => $row['end']
        );
    }
}
echo json_encode($json);
