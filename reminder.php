<?php
include("public/php/config.php");
include("public/php/result.php");

$obj = new config();

$counter = 0;
$columns = array("jk_id", "jk_no_antrian", "jk_status", "pasien_nama", "pasien_email");
$condition = array(
  "jk_status" => array(
    "type" => "equal", "value" => 0
  )
);
$join = " t1 JOIN m_pasien t2 ON t2.pasien_id = t1.jk_pasien_id ";
$pagination = array(
  "column_order" => "jk_no_antrian",
  "dir_order" => "ASC",
  "page" => 0,
  "limit" => 3
);

$response = array();

while($counter < 4):
  // echo "\nTest ".$counter;

  $data = $obj->selectData("t_jadwal_kunjungan",
                            $columns,
                            $condition,
                            $join, "", $pagination);
  // print(json_encode($data));

  if (count($data) > 0):
    $to = $data[0]['pasien_email'];

    $subject = 'Pengingat';

    $body = '<p>Saat ini no. antrian sudah mencapai '.$data[0]['jk_no_antrian'].', Silakan segera masuk ke Ruang Dokter untuk melakukan pemeriksaan.</p>';

    $header  = 'MIME-Version: 1.0' . "\r\n";
    $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $header .= "To: <$to>" . "\r\n";
    $header .= 'From: lazuardifahreza853@gmail.com'."\r\n";

    if(mail($to,$subject,$body,$header)):
      $response['status_email'] = "Your Mail is sent successfully.";
    else:
      $response['status_email'] = "Your Mail is not sent. Try Again.";
    endif;

    echo "\nFrom: lazuardifahreza853@gmail.com";
    echo "\nTo: ".$data[0]['pasien_email'];
    echo "\nStatus: ".$response['status_email'];
  endif;
  sleep(40);

  if ($counter == 3)
    $counter = 0;
  else
    $counter++;
endwhile;
?>
