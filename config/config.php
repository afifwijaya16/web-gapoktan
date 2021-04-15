<?php
// mengatur base url website yang digunakan
$config['shl_framework']['base_url'] = "http://localhost/gapoktan";

// mengatur timezone
$config['shl_framework']['timezone'] = "Asia/Jakarta";

// error reporting
/*
Default Value: E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED
Development Value: E_ALL 
Production Value: E_ALL & ~E_DEPRECATED & ~E_STRICT
Turn off all error reporting: 0
*/
$config['shl_framework']['error_reporting'] = E_ALL & ~E_DEPRECATED & ~E_NOTICE;


// pengaturan untuk library shl_pagination
$config['shl_framework']['pagination']['strnextpage'] = "";
$config['shl_framework']['pagination']['strprevpage'] = "";
$config['shl_framework']['pagination']['strfirstpage'] = "<i class='fa fa-long-arrow-left'></i> First";
$config['shl_framework']['pagination']['strlastpage'] = "Last <i class='fa fa-long-arrow-right'></i>";
$config['shl_framework']['pagination']['resultperpage'] = "10";
$config['shl_framework']['pagination']['numberofpages'] = "5";
$config['shl_framework']['pagination']['usepagenumber'] = "TRUE";
$config['shl_framework']['pagination']['fulltagopen'] = "<ul class='pagination pagination-sm no-margin pull-right'>";
$config['shl_framework']['pagination']['fulltagclose'] = "</ul>";
$config['shl_framework']['pagination']['tagopen'] = '<li>';
$config['shl_framework']['pagination']['tagclose'] = '</li>';
$config['shl_framework']['pagination']['activetagopen'] = '<li class="active"><a href="#">';
$config['shl_framework']['pagination']['activetagclose'] = '</a></li>'; 



// pengaturan untuk library shl_email
$config['shl_framework']['email']['mimeversion'] = "1.0";
$config['shl_framework']['email']['contenttype'] = "text/html";
$config['shl_framework']['email']['charset'] = "iso-8859-1";
$config['shl_framework']['email']['wordwrap'] = 'FALSE';



// pengaturan untuk mengatur pesan validasi shl_form
$config['shl_framework']['form']['openerrortag'] = "<label class='control-label text-danger'><b>";
$config['shl_framework']['form']['enderrortag'] = "</label></b>";
$config['shl_framework']['form']['required'] = "(@name tidak boleh kosong)";
$config['shl_framework']['form']['maxlength'] = "(@name tidak boleh melebihi dari @length karakter)";
$config['shl_framework']['form']['minlength'] = "(@name tidak boleh kurang dari @length karakter)";
$config['shl_framework']['form']['email'] = "(@name tidak valid)";
$config['shl_framework']['form']['url'] = "(@name tidak valid)";
$config['shl_framework']['form']['numeric'] = "(@name hanya bisa diisi angka)";
$config['shl_framework']['form']['alphabetic'] = "(@name hanya bisa diisi huruf)";
$config['shl_framework']['form']['alphanumeric'] = "(@name hanya bisa diisi huruf dan angka)";
$config['shl_framework']['form']['boolean'] = "@name hanya bisa di isi dengan boolean";
$config['shl_framework']['form']['filerequired'] = "(File @name tidak boleh kosong)";
$config['shl_framework']['form']['fileallowedtype'] = "(File @name hanya boleh berextensi @type)";

$config['shl_framework']['form']['dropdown_month'] = ["Januari", "Febuari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
$config['shl_framework']['form']['dropdown_day'] = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];


// pengaturan untuk mengatur shl_upload
$config['shl_framework']['upload']['openerrortag'] = "<label class='control-label text-danger'>";
$config['shl_framework']['upload']['enderrortag'] = "</label>";
$config['shl_framework']['upload']['maxwidth'] = "1024";
$config['shl_framework']['upload']['maxheight'] = "768";
$config['shl_framework']['upload']['maxsize'] = "100480000";
$config['shl_framework']['upload']['allowedtype'] = "jpg,jpeg,png,gif,pdf,mp4,rar,zip";
$config['shl_framework']['upload']['type'] = "jpg";
$config['shl_framework']['upload']['path'] = "";
$config['shl_framework']['upload']['encrypt'] = 'TRUE';


?>
