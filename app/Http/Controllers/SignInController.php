<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Pengguna;

class SignInController extends Controller
{
    //
    public function index(Request $req) {
      if ($req->session()->has('username')):
        $path = '';
        switch ($req->session()->has('user_jenis')):
          case 1:
            // code...
            $path = '/';
            break;
          case 2:
            // code...
            $path = '/pasien';
            break;
          case 3:
            // code...
            $path = '/kunjungan';
            break;

          default:
            // code...
            break;
        endswitch;

        return redirect($path, [
          'user_role' => $req->session()->get('user_jenis')
        ]);
      else:
        return view('signin');
      endif;
    }

    public function registrasi(Request $req) {
      if ($req->session()->has('username')):
        $path = '';
        switch ($req->session()->has('user_jenis')):
          case 1:
            // code...
            $path = '/';
            break;
          case 2:
            // code...
            $path = '/pasien';
            break;
          case 3:
            // code...
            $path = '/kunjungan';
            break;

          default:
            // code...
            break;
        endswitch;

        return redirect($path, [
          'user_role' => $req->session()->get('user_jenis')
        ]);
      else:
        return view('registrasi');
      endif;
    }

    public function gantiPassword(Request $req) {
      return view('ganti-password');
    }

    public function periksaAkun(Request $req) {
      $q = Pengguna::select(['user_id'])
                    ->join('v_user_all', 'v_user_id', 'user_id')
                    ->where('user_username', '=', $req->user_username)
                    ->orWhere('user_email', $req->user_username)
                    ->get();

      // $qByUsername = $pengguna->where('user_username', '=', $req->user_username)->get();
      // $q = $qByUsername;

      // if (count($qByUsername) == 0):
      //   $qByEmail = $pengguna->orWhere('user_email', $req->user_username)->get();
      //   $q = $qByEmail;
      // endif;

      return json_encode(array("status" => count($q) > 0? 'succ' : 'fail', "data" => $req->user_username));
    }

    public function kirimEmail(Request $req) {
      $columns = array('user_id', 'user_username', 'user_email');

      $q = Pengguna::select($columns)
                    ->join('v_user_all', 'v_user_id', 'user_id')
                    ->where('user_username', '=', $req->user_username)
                    ->orWhere('user_email', $req->user_username)
                    ->get();

      // $response = array();
      // $response['pengguna'] = $q[0]->user_email;

      $to = $q[0]->user_email;

      $response = array();

      $subject = 'No. Verifikasi';

      $body = '<p>Untuk mengganti Password</b>, silakan gunakan no. verifikasi ini dan jangan berikan pada siapapun.</p>';
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

    public function gantiPassword2(Request $req) {
      try {
        $columns = array('user_id');

        $pengguna = Pengguna::select($columns)
                            ->join('v_user_all', 'v_user_id', 'user_id')
                            ->where('user_username', '=', $req->user_username)
                            ->orWhere('user_email', $req->user_username)
                            ->update([
                              'user_password' => $req->user_password
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

    public function login(Request $req) {
      $columns = array('user_id', 'user_jenis', 'user_nama', 'user_username', 'user_email', 'user_master_id');

      $q = Pengguna::select($columns)
                    ->join('v_user_all', 'v_user_id', 'user_id')
                    ->where('user_username', '=', $req->user_username)
                    ->where('user_password', '=', $req->user_password)
                    ->get();

      $response = array();

      $response['status'] = count($q) == 1? 'succ' : 'fail';

      if ($response['status'] == 'succ'):
        $arr_user_jenis = array('', 'Dokter', 'Tenaga Medis', 'Pasien');

        $req->session()->put('user_id', $q[0]['user_id']);
        $req->session()->put('username', $q[0]['user_username']);
        $req->session()->put('email', $q[0]['user_email']);
        $req->session()->put('nama', $q[0]['user_nama']);
        $req->session()->put('user_jenis', $q[0]['user_jenis']);
        $req->session()->put('user_master_id', $q[0]['user_master_id']);
        $req->session()->put('user_jenis_nama', $arr_user_jenis[$q[0]['user_jenis']]);

        $response['user_role'] = $q[0]['user_jenis'];
      else:
        $response['message'] = 'Username/ password kurang tepat!';

        $req->session()->flush();
      endif;

      return json_encode($response);
    }

    public function logout(Request $req) {
      $req->session()->flush();

      return redirect('/signin');
    }
}
