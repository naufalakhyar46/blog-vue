<?php

namespace App\Http\Controllers\Api\Konfigurasi;

use App\Models\User;
use App\Models\Konfigurasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use Exception;

class KonfigurasiController extends Controller
{
    public function show()
    {
        $data = Konfigurasi::first();
        return response()->json($data);
    }

    public function update(Request $request)
    {
        try{
            $cek = JWTAuth::parseToken()->authenticate();
        }catch(Exception $e){
            if ($e instanceof Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['error'=>'token_expired'], 400);
            } else if ($e instanceof Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['error'=>'token_invalid'], 400);
            }else{
                return response()->json(['error'=>'token_not_found'], 401);
            }
        }
        $token = auth()->setTTL(7200)->attempt(['email'=>$cek->email,'password'=>$cek->password]);
        $user = User::firstWhere('id',$cek->id);
        
        $layanan = Konfigurasi::first();
        $cek_no = substr($request->nohp,0,-10);
        if($cek_no == '08'){
            $nohp = '62'.substr($request->nohp,-11);
        }else{
            $nohp = '62'.$request->nohp;
        }
        if($request->icon !== "null"){
            $path_img = 'image/konfigurasi/';
            if($layanan->icon != null){
                unlink($path_img.$layanan->icon);
            }
            $fileName = 'icon_'.time().'.'.$request->icon->getClientOriginalExtension();
            $layanan->icon = $fileName;
            $request->icon->move($path_img, $fileName);
        }
        $layanan->email = $request->email;
        $layanan->website = $request->website;
        $layanan->ig = $request->ig;
        $layanan->fb = $request->fb;
        $layanan->tw = $request->tw;
        $layanan->nohp = $nohp;
        $layanan->map = $request->map;
        $layanan->nama_dashboard = $request->nama_dashboard;
        $layanan->nama_dashboard_singkatan = $request->nama_dashboard_singkatan;
        $layanan->nama_portal = $request->nama_portal;
        $layanan->alamat = $request->alamat;
        $layanan->metatext = $request->metatext;
        $layanan->deskripsi = $request->deskripsi;
        $layanan->save();

        return response()->json(
            [
                'status'=>true,
                'message'=>'Data berhasil diperbarui',
                'data'=>$layanan,
                'token'=>$token,
                'user'=>$user,
            ]
        );
    }
}
