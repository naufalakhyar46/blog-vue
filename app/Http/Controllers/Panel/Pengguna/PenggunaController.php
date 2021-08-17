<?php

namespace App\Http\Controllers\Panel\Pengguna;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use JWTAuth;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PenggunaController extends Controller
{
    public function index(Request $request)
    {
        if ( $request->input('client') ) {
            return User::select('id', 'name', 'email', 'photo')->orderBy('id','asc')->get();
        }

        $columns = ['id','name', 'email', 'photo'];

        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        if($dir == null && $columns[$column] == null){
            $query = User::select('id', 'name', 'email', 'photo')->orderBy('id', 'desc');
        }else{
            $query = User::select('id', 'name', 'email', 'photo')->orderBy($columns[$column], $dir);
        }

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%')
                ->orWhere('email', 'like', '%' . $searchValue . '%');
            });
        }

        $projects = $query->paginate($length);
        
        return ['data' => $projects, 'draw' => $request->input('draw')];
    }

    public function show($id)
    {
        $data = User::firstWhere('id',$id);
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $rules = [
            'name'                  => 'min:3',
            'email'                 => 'email|unique:users,email',
        ];
 
        $messages = [
            'name.min'              => 'Nama lengkap minimal 3 karakter',
            'email.email'           => 'Email tidak valid',
            'email.unique'          => 'Email sudah terdaftar',
        ];
 
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
            ], 403);
        }
        $user = new User;
        if($request->photo != "null"){
            $path_img = 'image/profile/';
            $fileName = 'profile_'.time().'.'.$request->photo->getClientOriginalExtension();
            $user->photo = $fileName;
            $request->photo->move($path_img, $fileName);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(
            [
                'status'=>true,
                'message'=>'Data berhasil ditambahkan',
                'data'=>$user,
            ]
        );
    }

    public function change_pass(Request $request,$id)
    {
        $data = User::firstWhere('id',$id);
        if (!(Hash::check($request->get('password_lama'), $data->password))) {
            return response()->json(
                [
                    'status'=>false,
                    'message'=>'Password lama salah, silahkan coba lagi!',
                ]
            );
        }
        if(Hash::check($request->get('password_baru'), $data->password)){
            return response()->json(
                [
                    'status'=>false,
                    'message'=>'Password baru sama dengan password lama, silahkan masukkan password yang baru!',
                ]
            );
        }
        if($request->get('password_baru') != $request->get('konfirmasi_password')){
            return response()->json(
                [
                    'status'=>false,
                    'message'=>'Password baru dan ulangi password baru tidak sama, silahkan ulangi kembali!',
                ]
            );
        }

        $data->password = bcrypt($request->get('password_baru'));
        $data->save();

        return response()->json(
            [
                'status'=>true,
                'message'=>'Password berhasil diperbarui',
                'data'=>$data,
            ]
        );

    }

    public function profile(Request $request,$id)
    {
        $rules = [
            'name'                  => 'min:3',
            'email'                 => 'email',
        ];
 
        $messages = [
            'name.min'              => 'Nama lengkap minimal 3 karakter',
            'email.email'           => 'Email tidak valid',
        ];
 
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
            ], 403);
        }

        $user = User::firstWhere('id',$id);
        if($request->photo != "null"){
            $path_img = 'image/profile/';
            if($user->photo != null){
                unlink($path_img.$user->photo);
            }
            $fileName = 'profile_'.time().'.'.$request->photo->getClientOriginalExtension();
            $user->photo = $fileName;
            $request->photo->move($path_img, $fileName);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return response()->json(
            [
                'status'=>true,
                'message'=>'Profile berhasil diperbarui, silahkan login logout dan login kembali untuk melihat perubahan',
                'data'=>$user,
            ]
        );
    }

    public function update(Request $request,$id)
    {
        $rules = [
            'name'                  => 'min:3',
            'email'                 => 'email',
        ];
 
        $messages = [
            'name.min'              => 'Nama lengkap minimal 3 karakter',
            'email.email'           => 'Email tidak valid',
        ];
 
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
            ], 403);
        }

        $user = User::firstWhere('id',$id);
        if($request->photo != "null"){
            $path_img = 'image/profile/';
            if($user->photo != null){
                unlink($path_img.$user->photo);
            }
            $fileName = 'profile_'.time().'.'.$request->photo->getClientOriginalExtension();
            $user->photo = $fileName;
            $request->photo->move($path_img, $fileName);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return response()->json(
            [
                'status'=>true,
                'message'=>'Data berhasil diperbarui',
                'data'=>$user,
            ]
        );
    }

    public function destroy($id)
    {
        try{
            $data = JWTAuth::parseToken()->authenticate();
        }catch(Exception $e){
            if ($e instanceof Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['error'=>'token_expired'], 400);
            } else if ($e instanceof Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['error'=>'token_invalid'], 400);
            }else{
                return response()->json(['error'=>'token_not_found'], 401);
            }
        }
        $user = User::firstWhere('id',$id);
        $path_img = 'image/profile/';
        if($user->photo != null){
            unlink($path_img.$user->photo);
        }
        $user->delete();
        return response()->json(
            [
                'status'=>true,
                'message'=>'Data user berhasil dihapus'
            ]
        );
    }
}
