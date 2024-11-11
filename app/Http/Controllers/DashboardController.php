<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Exception;
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
        return view('index');
    }

    public function data(Request $req) {
      try {
        $Columns = array("pasien_id", "pasien_nama", "pasien_jenis_kelamin", "pasien_tanggal_lahir", "pasien_alamat");
        $ColumnsWhere = array("pasien_nama", "pasien_jenis_kelamin", "pasien_tanggal_lahir", "pasien_alamat");

        // $users = RequestMahasiswa::all();
        $data = Pasien::select($Columns)
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

        if ($req->pasien_id == ''):
          $q = Pasien::create($data);
        else:
          $q = Pasien::where('pasien_id', $req->pasien_id)
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
        $Columns = array("pasien_id", "pasien_nama", "pasien_jenis_kelamin", "pasien_tanggal_lahir", "pasien_alamat", "pasien_no_handphone", "pasien_email");

        // $users = RequestMahasiswa::all();
        $data = Pasien::select($Columns)
                    ->where('pasien_id', '=', $req->pasien_id)
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
        $q = Pasien::where('pasien_id', '=', $req->pasien_id)
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
