<?php 

function formatDate($timestamp, $format = 'D, d M Y') {
	$date = date_create($timestamp);
	$dateFormatted = date_format($date, $format);

	return $dateFormatted;
}

function formatRupiah($price) {
	return "Rp" . number_format($price, 2, ',', '.');
}

function strToSlug($str) {
	return str_replace(' ', '-', strtolower($str));
}

function slugToStr($slug) {
	return str_replace('-', ' ', $slug);
}