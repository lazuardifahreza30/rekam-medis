<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Kunjungan;
use App\Pengguna;
use App\Dokter;

class SettingController extends Controller
{
    //
    public function index(Request $req) {
      if ($req->session()->has('username')):
        return view('setting', [
          'user_role' => $req->session()->get('user_jenis'),
          'user_nama' => $req->session()->get('nama')
        ]);
      else:
        return redirect('/signin');
      endif;
    }

    public function dataPribadi(Request $req) {
      try {
        $pengguna = Pengguna::select(['user_nama', 'user_email', 'user_no_handphone'])
                            ->join('v_user_all', 'v_user_id', 'user_id')
                            ->where('user_master_id', '=', $req->session()->get('user_master_id'))
                            ->where('user_id', '=', $req->session()->get('user_id'))
                            ->get();
      } catch (\Exception $e) {
        return response()->json([
          'data' => [],
          'message' => $e->getMessage()
        ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
      }

      return response()->json([
        "pengguna" => $pengguna
      ], JsonResponse::HTTP_OK);
    }

    public function data(Request $req) {
      try {
        $columns = array('jk_id', 'jk_created_date', 'jk_jenis', 'jk_keluhan', 'dokter_nama');
        $ColumnsWhere = array('', 'jk_created_date', 'jk_jenis', 'jk_keluhan', 'dokter_nama');

        $data = Kunjungan::select($columns)
                          ->join('m_dokter', 'dokter_id', 'jk_dokter_id')
                          ->where('jk_pasien_id', '=', $req->session()->get('user_master_id'))
                          ->orderBy($ColumnsWhere[$_POST['iSortCol_0']], $_POST['sSortDir_0'])
                          ->offset($_POST['iDisplayStart'])
                          ->limit($_POST['iDisplayLength'])
                          ->get();

        $arr_jenis = array("", "Sehat", "Sakit");

        for ($i = 0; $i < count($data); $i++):
          $data[$i]['no'] = $i + 1;
          $data[$i]['jk_jenis'] = $arr_jenis[$data[$i]['jk_jenis']];
          $data[$i]['jk_created_date'] = date("d-m-Y H:i:s", strtotime($data[$i]['jk_created_date']));
        endfor;

        $pengguna = Pengguna::select(['user_nama', 'user_email', 'user_no_handphone'])
                            ->join('v_user_all', 'v_user_id', 'user_id')
                            ->where('user_master_id', '=', $req->session()->get('user_master_id'))
                            ->get();
      } catch (\Exception $e) {
        return response()->json([
          'data' => [],
          'message' => $e->getMessage()
        ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
      }

      return response()->json([
        "sEcho" => intval($_POST['sEcho']),
      	"iTotalRecords" => count($data),
      	"iTotalDisplayRecords" => count($data),
      	"aaData" => $data,
        "pengguna" => $pengguna
      ], JsonResponse::HTTP_OK);
    }

    public function getDetail(Request $req) {
      try {
        $columns = array("jk_diagnosa", "jk_resep", "jk_rencana_perawatan");
        $response = Kunjungan::select($columns)
                              ->where('jk_id', '=', $req->jk_id)
                              ->get();
      } catch (\Exception $e) {
        return response()->json([
          'data' => [],
          'message' => $e->getMessage()
        ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
      }

      return response()->json($response, JsonResponse::HTTP_OK);
    }

    public function kirimEmail(Request $req) {
      $to = $req->user_email;

      $response = array();

      $subject = 'No. Verifikasi';

      $body = '<p>Untuk mengganti E-mail</b>, silakan gunakan no. verifikasi ini dan jangan berikan pada siapapun.</p>';
      $body .= '<span style="font-size: 30px">'.$req->no_verifikasi.'</span>';

      $header  = 'MIME-Version: 1.0' . "\r\n";
      $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
      $header .= "To: <$to>" . "\r\n";
      $header .= 'From: lazuardifahreza853@gmail.com'."\r\n";

      if(mail($to,$subject,$body,$header))
        $response['status_email'] = "Your Mail is sent successfully.";
      else
        $response['status_email'] = "Your Mail is not sent. Try Again.";

      $response['status'] = $response['status_email'] == 'Your Mail is sent successfully.'? 'succ': 'fail';

      return response()->json($response, JsonResponse::HTTP_OK);
    }

    public function gantiEmail(Request $req) {
      try {
        $pengguna = Dokter::where('dokter_id', $req->session()->get('user_master_id'))
                            ->update([
                              'dokter_email' => $req->user_email
                            ]);

        $response['status'] = $pengguna? 'succ' : 'fail';
      } catch (\Exception $e) {
        return response()->json([
          'data' => [],
          'message' => $e->getMessage()
        ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
      }

      return response()->json($response, JsonResponse::HTTP_OK);
    }
}
