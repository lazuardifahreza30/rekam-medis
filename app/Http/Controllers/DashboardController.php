<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Exception;
use App\Kunjungan;
use App\Pasien;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        //
        if ($req->session()->has('username')):
          return view('index', [
            'user_role' => $req->session()->get('user_jenis'),
            'user_nama' => $req->session()->get('nama')
          ]);
        else:
          return redirect('/signin');
        endif;
    }

    public function data(Request $req) {
      try {
        $Columns = array("jk_created_date", "jk_pasien_id", "pasien_nama", "jk_keluhan");
        $ColumnsWhere = array("", "jk_created_date", "jk_pasien_id", "pasien_nama", "jk_keluhan");

        // $users = RequestMahasiswa::all();
        $data = Kunjungan::select($Columns)
                          ->join('m_pasien', 'pasien_id', 'jk_pasien_id')
                          ->where('jk_status', '=', 1)
                          ->orderBy($ColumnsWhere[$_POST['iSortCol_0']], $_POST['sSortDir_0'])
                          ->offset($_POST['iDisplayStart'])
                          ->limit($_POST['iDisplayLength'])
                          ->get();

        for ($i = 0; $i < count($data); $i++):
          $data[$i]['no'] = $i + 1;
          $data[$i]['jk_created_date'] = date("d-m-Y H:i:s", strtotime($data[$i]['jk_created_date']));
        endfor;

        $pasien = Pasien::select(['pasien_id'])->get();
        $kunjungan = Kunjungan::select(['jk_id'])
                              ->where('jk_status', '=', 1)
                              ->get();
        $query = 'SELECT
                    COUNT(jk_id) total_kunjungan
                  FROM
                    t_jadwal_kunjungan
                  WHERE jk_status = 1
                  AND MONTH(jk_created_date) = MONTH(CURDATE())';
        $kunjungan_bulan_ini = DB::select($query);
        $kunjungan_sehat = Kunjungan::select(['jk_id'])
                              ->where('jk_status', '=', 1)
                              ->where('jk_jenis', '=', 1)
                              ->get();
        $kunjungan_sakit = Kunjungan::select(['jk_id'])
                                    ->where('jk_status', '=', 1)
                                    ->where('jk_jenis', '=', 2)
                                    ->get();

        $total = array(
          "pasien" => count($pasien),
          "kunjungan" => count($kunjungan),
          "kunjungan_bulan_ini" => $kunjungan_bulan_ini[0]->total_kunjungan,
          "kunjungan_sehat" => count($kunjungan_sehat),
          "kunjungan_sakit" => count($kunjungan_sakit)
        );
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
      	"aaData" => $data,
        "total" => $total
      ], JsonResponse::HTTP_OK);
    }
}
