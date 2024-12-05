<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
