<?php    
define('UPLOAD_DIR', '/home/holo269/web/semizeu.ro/public_html/');
$img = $_POST['imgBase64'];
$img  = str_replace('data:image/png;base64,', '', $img);
$img  = str_replace(' ', '+', $img);
$data = base64_decode($img);
$file = UPLOAD_DIR . "statia3" . '.png';
$success = file_put_contents($file, $data);
print $success ? $file : 'Unable to save the file.';
?> 