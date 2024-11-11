<?php

namespace App\Http\api;
use App\Http\Controllers\Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\RegisAkun;


class RegisAkunApi extends Controller
{
    //
    public function index() {
      // try {
        $users = RegisAkun::all();
      // } catch(Exception $e) {
      //   return response()->json([
      //     'data' => [],
      //     'message' => $e->getMessage()
      //   ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
      // }
      
      return response()->json([
        'data' => $users,
        'message' => 'Succeed'
      ], JsonResponse::HTTP_OK);
    }


    public function create(Request $req) {
      return response()->json([
        'message' => 'Succeed create'
      ], JsonResponse::HTTP_OK);
}
}
