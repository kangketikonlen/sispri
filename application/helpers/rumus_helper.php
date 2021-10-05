<?php defined('BASEPATH') or exit('No direct script access allowed');

function count_date($tgl_awal, $tgl_akhir)
{
	$startDate = new DateTime($tgl_awal);
	$endDate = new DateTime($tgl_akhir);
	$difference = $endDate->diff($startDate);
	return $difference->format("%a");
}

function bor($tgl_awal, $tgl_akhir, $total_bed)
{
	$periode = count_date($tgl_awal, $tgl_akhir);
	$hari_perawatan = count_date($tgl_awal, $tgl_akhir);
	// 
	return round(($periode / ($total_bed * $hari_perawatan)) * 100, 2);
}

function avlos($lama_dirawat, $jumlah_pasien_keluar)
{
	if (!empty($lama_dirawat) || !empty($jumlah_pasien_keluar)) {
		return round($lama_dirawat / $jumlah_pasien_keluar);
	} else {
		return 0;
	}
}

function toi($tgl_awal, $tgl_akhir, $jumlah_bed, $jumlah_pasien_keluar)
{
	if (!empty($jumlah_pasien_keluar)) {
		$periode = count_date($tgl_awal, $tgl_akhir);
		$hari_perawatan = count_date($tgl_awal, $tgl_akhir);
		return round((($jumlah_bed * $periode) - $hari_perawatan) / $jumlah_pasien_keluar);
	} else {
		return 0;
	}
}

function bto($jumlah_pasien_keluar, $kapasitas)
{
	return round($jumlah_pasien_keluar / $kapasitas);
}
