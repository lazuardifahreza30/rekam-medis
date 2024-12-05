<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Pasien;
use App\Dokter;
use App\TenagaMedis;
use App\Pengguna;

class PenggunaController extends Controller
{
    //
    public function index(Request $req)
    {
        //
        if ($req->session()->has('username')):
          return view('pengguna', [
            'user_role' => $req->session()->get('user_jenis'),
            'user_nama' => $req->session()->get('nama')
          ]);
        else:
          return redirect('/signin');
        endif;
    }

    public function data(Request $req) {
      try {
        $Columns = array("user_id", "user_nama", "user_jenis", "user_username", "user_password");
        $ColumnsWhere = array("user_nama", "user_jenis", "user_username", "user_password");

        // $users = RequestMahasiswa::all();
        $data = Pengguna::select($Columns)
                    ->join('v_user_all', 'v_user_id', 'user_id')
                    ->orderBy($ColumnsWhere[$_POST['iSortCol_0']], $_POST['sSortDir_0'])
                    ->offset($_POST['iDisplayStart'])
                    ->limit($_POST['iDisplayLength'])
                    ->get();

        for ($i = 0; $i < count($data); $i++)
          $data[$i]['no'] = $i + 1;
      } catch(Exception $e) {
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

    public function create(Request $req) {
      try {
        // $data = $req->all();

        if ($req->user_id == ''):
          $q = Pengguna::create(array(
            'user_jenis' => $req->user_jenis,
            'user_username' => $req->user_username,
            'user_password' => $req->user_password,
            'user_created_date' => date("Y-m-d H:i:s")
          ));

          if ($req->user_jenis == '1'):
            $prefix = 'dokter';
            $data = array(
              'dokter_nama' => $req->user_nama,
              'dokter_user_id' => $q->id,
              'dokter_jenis_kelamin' => $req->user_jenis_kelamin,
              'dokter_tanggal_lahir' => $req->user_tanggal_lahir,
              'dokter_alamat' => $req->user_alamat,
              'dokter_no_handphone' => $req->user_no_handphone,
              'dokter_email' => $req->user_email,
              'dokter_created_date' => date("Y-m-d H:i:s")
            );

            $q2 = Dokter::create($data);
          elseif($req->user_jenis == '2'):
            $prefix = 'tm';
            $data = array(
              'tm_nama' => $req->user_nama,
              'tm_user_id' => $q->id,
              'tm_jenis_kelamin' => $req->user_jenis_kelamin,
              'tm_tanggal_lahir' => $req->user_tanggal_lahir,
              'tm_alamat' => $req->user_alamat,
              'tm_no_handphone' => $req->user_no_handphone,
              'tm_email' => $req->user_email,
              'tm_created_date' => date("Y-m-d H:i:s")
            );

            $q2 = TenagaMedis::create($data);
          else:
            $prefix = 'pasien';
            $data = array(
              'pasien_nama' => $req->user_nama,
              'pasien_user_id' => $q->id,
              'pasien_jenis_kelamin' => $req->user_jenis_kelamin,
              'pasien_tanggal_lahir' => $req->user_tanggal_lahir,
              'pasien_alamat' => $req->user_alamat,
              'pasien_no_handphone' => $req->user_no_handphone,
              'pasien_email' => $req->user_email,
              'pasien_created_date' => date("Y-m-d H:i:s")
            );

            $q2 = Pasien::create($data);
          endif;
        else:
          $data = array(
            'user_username' => $req->user_username,
            'user_password' => $req->user_password
          );
          $q = Pengguna::where('user_id', $req->user_id)
                        ->update($data);
        endif;

        $response['status'] = $q? 'succ' : 'fail';

        // $to = 'lazuardi.fahreza@widyatama.ac.id';
        $to = $req->user_email;

        $subject = 'Registrasi';

        $body = '<p>Anda telah berhasil melakukan registrasi, untuk mengakses <b>Rekam Medis Elektronik</b>, silakan masuk menggunakan akun ini.</p>';
        $body .= '<table class="table table-striped table-bordered" width="100%">';
        $body .= '<tr>';
        $body .= '<td>Username</td>';
        $body .= '<td>'.$req->user_username.'</td>';
        $body .= '</tr>';
        $body .= '<tr>';
        $body .= '<td>Password</td>';
        $body .= '<td>'.$req->user_password.'</td>';
        $body .= '</tr>';
        $body .= '</table>';

        $header  = 'MIME-Version: 1.0' . "\r\n";
        $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $header .= "To: <$to>" . "\r\n";
        $header .= 'From: lazuardifahreza853@gmail.com'."\r\n";

        if(mail($to,$subject,$body,$header))
            $response['status_email'] = "Your Mail is sent successfully.";
        else
            $response['status_email'] = "Your Mail is not sent. Try Again.";
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
        $Columns = array("user_id", "user_jenis", "user_nama", "user_username", "user_password");

        // $users = RequestMahasiswa::all();
        $data = Pengguna::select($Columns)
                    ->join('v_user_all', 'v_user_id', 'user_id')
                    ->where('user_id', '=', $req->user_id)
                    ->get();
      } catch(Exception $e) {
        return response()->json([
          'data' => [],
          'message' => $e->getMessage()
        ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
      }

      return response()->json($data, JsonResponse::HTTP_OK);
    }

    public function hapus(Request $req) {
      try {
        // $users = RequestMahasiswa::all();

        $Columns = array("user_id", "user_jenis");
        $data = Pengguna::select($Columns)
                          ->where('user_id', '=', $req->user_id)
                          ->get();

        if ($data[0]['user_jenis'] == '1'):
          $q = Dokter::where('dokter_user_id', '=', $data[0]['user_id'])
                        ->delete();
        elseif ($data[0]['user_jenis'] == '2'):
          $q = TenagaMedis::where('tm_user_id', '=', $data[0]['user_id'])
                        ->delete();
        else:
          $q = Pasien::where('pasien_user_id', '=', $data[0]['user_id'])
                        ->delete();
        endif;
        $response['status'] = $q? 'succ' : 'fail';

        $q2 = Pengguna::where('user_id', '=', $data[0]['user_id'])
                  ->delete();
        $response['status2'] = $q2? 'succ' : 'fail';
      } catch(Exception $e) {
        return response()->json([
          'data' => [],
          'message' => $e->getMessage()
        ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
      }

      return response()->json($response, JsonResponse::HTTP_OK);
    }
}
