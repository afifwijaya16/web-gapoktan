<?php

// auto load untuk library. Contoh: array("shl_helper","shl_pagination");
// untuk daftar library yang tersedia bisa di lihat pada directory /system/library/
$autoload['shl_framework']['library'] = ["shl_db","shl_pagination","shl_form","shl_upload","shl_session","shl_email", "meta"];


// autoload ntuk helper. Contoh ["shl_string","shl_ccokie"]
// untuk daftar library yang tersedia bisa di lihat pada directory /system/helper/
$autoload['shl_framework']['helper'] = ["shl_string","shl_array","tanggal", "general"];


// autoload untuk model. Contoh ["default_model"]
$autoload['shl_framework']['model'] = ["public/m_admin","public/m_front"];
?>