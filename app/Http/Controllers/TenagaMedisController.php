<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\TenagaMedis;

class TenagaMedisController extends Controller
{
    //
    public function index(Request $req)
    {
        //
        return view('tenaga-medis');
    }

    public function data(Request $req) {
      try {
        $Columns = array("tm_id", "tm_nama", "tm_jenis_kelamin", "tm_tanggal_lahir", "tm_alamat");
        $ColumnsWhere = array("tm_nama", "tm_jenis_kelamin", "tm_tanggal_lahir", "tm_alamat");

        // $users = RequestMahasiswa::all();
        $data = TenagaMedis::select($Columns)
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
        $data = $req->all();

        if ($req->tm_id == ''):
          $q = TenagaMedis::create($data);
        else:
          $q = TenagaMedis::where('tm_id', $req->tm_id)
                          ->update($data);
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
        $Columns = array("tm_id", "tm_nama", "tm_jenis_kelamin", "tm_tanggal_lahir", "tm_alamat", "tm_no_handphone", "tm_email");

        // $users = RequestMahasiswa::all();
        $data = TenagaMedis::select($Columns)
                            ->where('tm_id', '=', $req->tm_id)
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
        $q = TenagaMedis::where('tm_id', '=', $req->tm_id)
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
