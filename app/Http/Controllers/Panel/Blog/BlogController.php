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
        $data = Blog::orderBy('created_at','Desc')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                            $btn = '<button role="button" class="btn btn-warning tmbPindah" title="Edit" data-id="'.$row->id.'"><i class="fa fa-pencil"></i> </button>&nbsp;';
                           $btn.= '<a href="javascript:void(0)" data-id="'.$row->id.'" role="button" class="btn btn-danger tmbHapus" title="Hapus"><i class="fa fa-trash"></i> </a>&nbsp;';
                        
                            return $btn;
                    })
                    ->addColumn('image', function($row){
                        if($row['image'] != null){
                           $gambar = '<a href="'.url('image/blog',optional($row)->image).'" class="gambar_lt" data-toggle="lightbox" data-gallery="my-gallery" >
                          <img src="'.url('image/blog',optional($row)->image).'" class="gambar_lt" style="width:290px;height:170px;margin-bottom: 10px" width="" alt="'.optional($row)->image.'">
                          </a>';
                        }else{
                            $gambar = 'Gambar Kosong';
                        }
                        return $gambar;
                    })
                    ->addColumn('name', function($row){
                        $name = $row->user->name;
                        return $name;
                    })
                    ->addColumn('tanggal', function($row){
     
                        $tgl = $row['created_at']->isoFormat('DD MMMM YYYY');
    
                         return $tgl;
                    })

                    ->rawColumns(['action','image','name','tanggal'])
                    ->make(true);
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
