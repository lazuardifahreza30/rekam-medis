<?php

namespace App\Http\api;
use App\Http\Controllers\Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Pendaftaran;

class PendaftaranApi extends Controller
{
        //
        public function index() {
          // try {
            $users = Pendaftaran::all();
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
          try {
            $q = Pendaftaran::create($req->all());
          } catch(Exception $e) {
            return response()->json([
              'data' => [],
              'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
          }

          return response()->json([
            'message' => 'Succeed create'
          ], JsonResponse::HTTP_OK);
    }
}
