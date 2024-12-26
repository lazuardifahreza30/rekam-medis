<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Kunjungan;
use App\Dokter;

class KunjunganController extends Controller
{
    //
    public function index(Request $req) {
      if ($req->session()->has('username')):
        return view('kunjungan', [
          'pasien_id' => $req->session()->get('user_master_id'),
          'dokter_id' => $req->session()->get('user_master_id'),
          'user_role' => $req->session()->get('user_jenis'),
          'user_nama' => $req->session()->get('nama')
        ]);
      else:
        return redirect('/signin');
      endif;
    }

    public function data(Request $req) {
      try {
        $columns = array('jk_id', 'jk_pasien_id', 'pasien_nama', 'jk_dokter_id', 'dokter_nama', 'jk_no_antrian', 'jk_diagnosa', 'jk_created_date');
        $ColumnsWhere = array('', 'jk_no_antrian', 'jk_created_date', 'pasien_nama', 'dokter_nama');

        $fieldCond = $req->session()->get('user_jenis') == 3? 'jk_pasien_id' : 'jk_dokter_id';
        $data = Kunjungan::select($columns)
                          ->join('m_dokter', 'dokter_id', 'jk_dokter_id')
                          ->join('m_pasien', 'pasien_id', 'jk_pasien_id')
                          ->where($fieldCond, '=', $req->session()->get('user_master_id'))
                          ->orderBy($ColumnsWhere[$_POST['iSortCol_0']], $_POST['sSortDir_0'])
                          ->offset($_POST['iDisplayStart'])
                          ->limit($_POST['iDisplayLength'])
                          ->get();

        for ($i = 0; $i < count($data); $i++):
          $data[$i]['no'] = $i + 1;
          $data[$i]['jk_waktu_kunjungan'] = date("d-m-Y H:i:s", strtotime($data[$i]['jk_waktu_kunjungan']));
          $data[$i]['jk_created_date'] = date("d-m-Y H:i:s", strtotime($data[$i]['jk_created_date']));
        endfor;
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
      	"aaData" => $data
      ], JsonResponse::HTTP_OK);
    }

    public function dataDokter() {
      $columns = array('dokter_id', 'dokter_nama');
      $response = Dokter::select($columns)
                        ->get();

      return response()->json($response, JsonResponse::HTTP_OK);
    }

    public function create(Request $req) {
      try {
        $data = $req->all();

        if ($req->jk_id == ''):
          $query = "SELECT
                      jk_no_antrian
                    FROM
                      t_jadwal_kunjungan
                    WHERE DATE(jk_created_date) = CURDATE()
                    ORDER BY jk_no_antrian
                    DESC LIMIT 1";
          $qData = DB::select($query);
          $data['jk_no_antrian'] = count($qData) == 0? 1 : $qData[0]->jk_no_antrian + 1;
          $data['jk_status'] = 0;

          $q = Kunjungan::create($data);

          if ($q):
            $to = $req->session()->get('email');

            $subject = 'Kunjungan';

            $body = '<p>Anda telah berhasil membuat kunjungan, nomor antrian Anda:</p>';
            $body .= '<div style="width: 50px; height: auto; font-weight: bold">'.$data['jk_no_antrian'].'</div>';

            $header  = 'MIME-Version: 1.0' . "\r\n";
            $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $header .= "To: <$to>" . "\r\n";
            $header .= 'From: lazuardifahreza853@gmail.com'."\r\n";

            if(mail($to,$subject,$body,$header)):
              $response['status_email'] = "Your Mail is sent successfully.";
            else:
              $response['status_email'] = "Your Mail is not sent. Try Again.";
            endif;
          endif;
        else:
          unset($data['jk_id']);
          $data['jk_status'] = 1;
          $q = Kunjungan::where('jk_id', $req->jk_id)
                        ->update($data);

          if ($q):
            $qKunjungan = Kunjungan::select(['pasien_email'])
                                    ->join('m_pasien', 'pasien_id', 'jk_pasien_id')
                                    ->where('jk_id', '=', $req->jk_id)
                                    ->get();
            $to = $qKunjungan[0]['pasien_email'];

            $subject = 'Pemeriksaan';

            $body = '<p>Anda telah melakukan pemeriksaan, dengan detail pemeriksaan seperti ini:</p>';
            $body .= '<table class="table table-striped table-bordered" width="100%">';
            $body .= '<tr>';
            $body .= '<td>Diagnosa</td>';
            $body .= '<td>'.$req->jk_diagnosa.'</td>';
            $body .= '</tr>';
            $body .= '<tr>';
            $body .= '<td>Resep</td>';
            $body .= '<td>'.$req->jk_resep.'</td>';
            $body .= '</tr>';
            $body .= '<tr>';
            $body .= '<td>Rencana Perawatan</td>';
            $body .= '<td>'.$req->jk_rencana_perawatan.'</td>';
            $body .= '</tr>';
            $body .= '</table>';

            $header  = 'MIME-Version: 1.0' . "\r\n";
            $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $header .= "To: <$to>" . "\r\n";
            $header .= 'From: lazuardifahreza853@gmail.com'."\r\n";

            if(mail($to,$subject,$body,$header)):
              $response['status_email'] = "Your Mail is sent successfully.";
            else:
              $response['status_email'] = "Your Mail is not sent. Try Again.";
            endif;
          endif;
        endif;

        $response['status'] = $q? 'succ' : 'fail';
      } catch(Exception $e) {
        return response()->json([
          'data' => [],
          'message' => $e->getMessage()
        ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
      }

      return response()->json($response, JsonResponse::HTTP_OK);
    }

    public function getData(Request $req) {
      try {
        $columns = array("jk_diagnosa", "jk_resep", "jk_rencana_perawatan");
        $response = Kunjungan::select($columns)
                                      ->where('jk_id', '=', $req->jk_id)
                                      ->get();
      } catch (Exception $e) {
        return response()->json([
          'data' => [],
          'message' => $e->getMessage()
        ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
      }

      return response()->json($response, JsonResponse::HTTP_OK);
    }

    public function hapus(Request $req) {
      try {
        // $users = RequestMahasiswa::all();
        $q = Kunjungan::where('jk_id', '=', $req->jk_id)
                      ->delete();
        $response['status'] = $q? 'succ' : 'fail';
      } catch(Exception $e) {
        return response()->json([
          'data' => [],
          'message' => $e->getMessage()
        ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
      }

      return response()->json($response, JsonResponse::HTTP_OK);
    }
}
