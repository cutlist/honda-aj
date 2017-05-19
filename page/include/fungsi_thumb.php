<?php
function rand_string( $length ) {
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	

	$size = strlen( $chars );
	for( $i = 0; $i < $length; $i++ ) {
		$str .= $chars[ rand( 0, $size - 1 ) ];
	}

	return $str;
}

function UploadSurjal($fupload_name){
  $vdir_upload = "../foto/suratjalan/";
  $vfile_upload = $vdir_upload . $fupload_name;
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
  
  //identitas file asli
  $im_src = imagecreatefromjpeg($vfile_upload);
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);
  
  //Simpan dalam versi small 110 pixel, Set ukuran gambar hasil perubahan
  $dst_width = 80;
  $dst_height = ($dst_width/$src_width)*$src_height;
  
  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

  //Simpan gambar
  imagejpeg($im,$vdir_upload . "sj_" . $fupload_name);
  
  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
  unlink($vfile_upload);
}

function UploadKaryawanH1($fupload_name){
  $vdir_upload = "../foto/H1/";
  $vfile_upload = $vdir_upload . $fupload_name;
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
  
  //identitas file asli
  $im_src = imagecreatefromjpeg($vfile_upload);
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);
  
  //Simpan dalam versi small 110 pixel, Set ukuran gambar hasil perubahan
  $dst_width = 110;
  $dst_height = ($dst_width/$src_width)*$src_height;
  
  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

  //Simpan gambar
  imagejpeg($im,$vdir_upload . "H1_" . $fupload_name);
  
  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
  unlink($vfile_upload);
}

function UploadKaryawanH2H3($fupload_name){
  $vdir_upload = "../foto/H2H3/";
  $vfile_upload = $vdir_upload . $fupload_name;
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
  
  //identitas file asli
  $im_src = imagecreatefromjpeg($vfile_upload);
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);
  
  //Simpan dalam versi small 110 pixel, Set ukuran gambar hasil perubahan
  $dst_width = 110;
  $dst_height = ($dst_width/$src_width)*$src_height;
  
  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

  //Simpan gambar
  imagejpeg($im,$vdir_upload . "H2H3_" . $fupload_name);
  
  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
  unlink($vfile_upload);
}

?>
