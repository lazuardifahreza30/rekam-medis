<?php

namespace App\Http\Controllers;

use App\Users;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Requests;

class UsersController extends Controller
{
    //
    public function index(Request $req){
      $data = $req->session()->all();
      if (isset($data['username']) && $data['username'] != '')
        return redirect('../');
      else
        return view('login');
    }

    public function signup(Request $req) {
      return view('reg-akun');
    }

    public function createUser(Request $req) {
      $response = array();

      $data = $req->all();
      $data['user_is_active'] = '1';

      $dataUser = DB::select('SELECT user_role_id FROM v_user_all WHERE user_email = "'.$data['user_email'].'"');

      if (count($dataUser) == 1):
        $data['user_role_id'] = $dataUser[0]->user_role_id;

        $q = Users::create($data);
        $q2 = Requests::create([
          'request_email' => $data['user_email'],
          'request_role_id' => $data['user_role_id'],
          'request_created_date' => date('Y-m-d H:i:s')
        ]);

        $response['status'] = $q? 'succ' : 'fail';
        $response['status2'] = $q2? 'succ' : 'fail';
      endif;

      return response()->json($response,JsonResponse::HTTP_OK);
    }

    public function login(Request $req) {
      $data = Users::select(['user_email', 'user_role_id'])
                    ->where('user_email', '=', $req->email)
                    ->where('user_password', '=', $req->password)
                    ->get();

      if (count($data) > 0):
        // $req->session()->put('username', $req->email);
        if ($data[0]['user_role_id'] == 3):
          $data2 = DB::select('SELECT kaprodi_nama nama, kaprodi_prodi_id prodi_id FROM m_kaprodi WHERE kaprodi_email = "'.$req->email.'"');
        elseif ($data[0]['user_role_id'] == 2):
          $data2 = DB::select('SELECT dosen_nama nama, dosen_prodi_id prodi_id FROM m_dosen WHERE dosen_email = "'.$req->email.'"');
        elseif ($data[0]['user_role_id'] == 1):
          $data2 = DB::select('SELECT mahasiswa_nama nama, mahasiswa_prodi_id prodi_id FROM m_mahasiswa WHERE mahasiswa_email = "'.$req->email.'"');
        endif;

        session([
          'username' => $req->email,
          'nama' => $data[0]['user_role_id'] == 4? 'admin' : (isset($data)? $data2[0]->nama : ''),
          'role' => $data[0]['user_role_id'],
          'prodi_id' => isset($data2)? $data2[0]->prodi_id : ''
        ]);

        // return redirect('../');
      endif;

      return response()->json([
          'data' => $data,
          'message'=> 'Succeed'
      ],JsonResponse::HTTP_OK);
    }

    public function logout(Request $req) {
      $req->session()->flush();

      return redirect('../login');
    }

    public function create(Request $req){
        return dd ('buat user');
    }
}
