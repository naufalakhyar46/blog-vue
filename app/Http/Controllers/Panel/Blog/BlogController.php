<?php

namespace App\Http\Controllers\Panel\Blog;

use JWTAuth;
use Exception;
use DataTables;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        if ( $request->input('client') ) {
            return Blog::with(['user'])->orderBy('id','asc')->get();
        }

        $columns = ['id','title', 'image', 'name','created_at'];

        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        if($dir == null && $columns[$column] == null){
            $query = Blog::with('user')->orderBy('id', 'desc');
        }else{
            $query = Blog::with('user')->orderBy($columns[$column], $dir);
        }

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('title', 'like', '%' . $searchValue . '%')
                ->orWhere('created_at', 'like', '%' . $searchValue . '%');
            });
        }

        $projects = $query->paginate($length);
        
        return ['data' => $projects, 'draw' => $request->input('draw')];
    }

    public function show($id)
    {
        $data = Blog::firstWhere('id',$id);
        return response()->json($data);
    }

    public function store(Request $request)
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
        $data = new Blog;
        if($request->image != "null"){
            $path_img = 'image/blog/';
            $fileName = 'blog_'.time().'.'.$request->image->getClientOriginalExtension();
            $data->image = $fileName;
            $request->image->move($path_img, $fileName);
        }
        $data->id_user = $user->id;
        $data->title = $request->title;
        $data->slug = Str::slug($request->title);
        $data->deskripsi = $request->deskripsi;
        $data->save();

        return response()->json(
            [
                'status'=>true,
                'message'=>'Data berhasil ditambahkan',
                'data'=>$data,
                'token'=>$token,
                'user'=>$user,
            ]
        );
    }

    public function update(Request $request,$id)
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
        $data = Blog::firstWhere('id',$id);
        if($request->image !== "null"){
            $path_img = 'image/blog/';
            if($data->image != null){
                unlink($path_img.$data->image);
            }
            $fileName = 'blog_'.time().'.'.$request->image->getClientOriginalExtension();
            $data->image = $fileName;
            $request->image->move($path_img, $fileName);
        }
        $data->id_user = $user->id;
        $data->title = $request->title;
        $data->slug = Str::slug($request->title);
        $data->deskripsi = $request->deskripsi;
        $data->save();

        return response()->json(
            [
                'status'=>true,
                'message'=>'Data berhasil diperbarui',
                'data'=>$data,
                'token'=>$token,
                'user'=>$user,
            ]
        );
    }

    public function destroy($id)
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
        $data = Blog::firstWhere('id',$id);
        $path_img = 'image/blog/';
        if($data->image != null){
            unlink($path_img.$data->image);
        }
        $data->delete();
        return response()->json(
            [
                'status'=>true,
                'message'=>'Data berhasil dihapus',
                'token'=>$token,
                'user'=>$user,
            ]
        );
    }
}
