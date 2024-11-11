<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Dokter;

class DokterController extends Controller
{
    //
    public function index(Request $req)
    {
        //
        return view('dokter');
    }

    public function data(Request $req) {
      try {
        $Columns = array("dokter_id", "dokter_nama", "dokter_jenis_kelamin", "dokter_tanggal_lahir", "dokter_alamat");
        $ColumnsWhere = array("dokter_nama", "dokter_jenis_kelamin", "dokter_tanggal_lahir", "dokter_alamat");

        // $users = RequestMahasiswa::all();
        $data = Dokter::select($Columns)
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

        if ($req->dokter_id == ''):
          $q = Dokter::create($data);
        else:
          $q = Dokter::where('dokter_id', $req->dokter_id)
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
        $Columns = array("dokter_id", "dokter_nama", "dokter_jenis_kelamin", "dokter_tanggal_lahir", "dokter_alamat", "dokter_no_handphone", "dokter_email");

        // $users = RequestMahasiswa::all();
        $data = Dokter::select($Columns)
                    ->where('dokter_id', '=', $req->dokter_id)
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
        $q = Dokter::where('dokter_id', '=', $req->dokter_id)
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
