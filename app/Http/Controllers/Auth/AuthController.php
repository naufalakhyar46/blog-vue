<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Penduduk;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Exception;

class AuthController extends Controller
{

    public function login(){
      if(session()->get('id')){
        return redirect()->back();
      }
      $judul = 'Login';
        return view('auth.login', compact('judul'));
    }

    public function regis()
    {
      if(session()->get('id')){
        return redirect()->back();
      }
      $judul = 'Register';
        return view('auth.register', compact('judul'));

    }

    public function reset_pass()
    {
      if(session()->get('id')){
        return redirect()->back();
      }
      $judul = 'Forgot Password';
        return view('auth.reset', compact('judul'));
    }
    public function _proses_login(Request $request){
        $username = $request->username;
        $password = $request->password;
        $next = $request->next;
        $menit = 525600;
        $remember = ($request->remember) ? true : false;
          $data = User::where('email',$username)->first();
        if($data){
            if($next == ''){
              if($data->role == 1){
                  $link = 'admin/dashboard';
              }else{
                  $link = 'tamu/profile';
              }
            }else{
              $link = $next;
            }
        }
        // if(!$token = auth()->setTTL(7200)->attempt(['email'=>$username,'password'=>$password])){
        //   return response()->json(['message'=>'invalid credentials'], 401);
        // }
        if($data){ //apakah email tersebut ada atau tidak
            if(Hash::check($password,$data->password)){
              $token = auth()->setTTL(7200)->attempt(['email'=>$username,'password'=>$password]);
                session()->put('id', $data->id);
                session()->put('name', $data->name);
                session()->put('email', $data->email);
                session()->put('photo', $data->photo);
               session()->put('token', $token);
                session()->put('login', True);
                if($remember == 1){
                  $response = new Response;
                  $response->withCookie(cookie('username', $username, $menit));
                    $status = [
                      'status' => true,
                      'data'=>$data,
                      'token'=>$token,
                      'message'=>'Berhasil login'
                  ];
                  return response()->json($status);
                	
                }else{
                    $status = [
                      'status' => true,
                      'data'=>$data,
                      'token'=>$token,
                      'message'=>'Berhasil login'
                  ];
                  return response()->json($status);
                	
                }
                
            }
            else{
                $status = [
                      'status' => false,
                      'message'=>'Password salah!'
              ];
              return response()->json($status);
              
            }
        }
        else{
              $status = [
                      'status' => false,
                      'message'=>'Email atau username tidak ditemukan!'
              ];
                  return response()->json($status);
                  // return redirect('login')->with(['gagal'=>'<script type="text/javascript">
            //                 $.toast({
            //                   heading   : "Gagal",
            //                   text    : "Email atau username tidak ditemukan!",
            //                   showHideTransition : "slide",
            //                   icon    : "warning",
            //                   hideAfter   : false,
            //                   position    : "bottom-right",
            //                   bgColor   : "#FF4859"
            //                 })
            //             </script>']);
        }
    }

    public function register(Request $request)
    {
        $rules = [
            'name'                  => 'min:3|max:100',
            'email'                 => 'email|unique:users,email',
            'password'              => 'min:6',
            'confirm_password'      => 'same:password',
        ];
 
        $messages = [
            'name.min'              => 'Nama lengkap minimal 3 karakter',
            'name.max'              => 'Nama lengkap maksimal 100 karakter',
            'email.email'           => 'Email tidak valid',
            'email.unique'          => 'Email sudah terdaftar',
            'password.min'          => 'Password minimal 6 huruf atau angka',
            'confirm_password.same' => 'Password dan Ulangi Password tidak sama',
        ];
 
        $validator = Validator::make($request->all(), $rules, $messages);
 
        if($validator->fails()){
              return response()->json([
                'status' => false,
                'message' => $validator->errors(),
            ], 403);
        }

        $user = new User;
        $user->name = ucwords(strtolower($request->name));
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if($user->save()){
            $status = [
                'status' => true,
                'message'=>'Anda berhasil registrasi, silahkan login untuk masuk'
                ];
            return response()->json($status);
        }else{
          $status = [
            'status' => false,
            'message'=>'Gagal, silahkan ulangi kembali'
            ];
          return response()->json($status);
        }
    }

    public function reset(Request $request)
    {
        
        $user = DB::table('users')->where('email', '=', $request->email)
            ->get();
        if(count($user) < 1) {
            return redirect()->back()->with(['gagal'=>'<script type="text/javascript">
                            $.toast({
                              heading   : "Gagal",
                              text    : "Email tidak ditemukan!",
                              showHideTransition : "slide",
                              icon    : "warning",
                              hideAfter   : false,
                              position    : "bottom-right",
                              bgColor   : "#FF4859"
                            })
                        </script>']);
        }

        $cari = new PasswordReset;
        $cari->email = $request->email;
        $cari->token = Str::random(60);
        $cari->created_at = now();
        $cari->save();


        if ($this->sendResetEmail($cari->email, $cari->token)) {
            return redirect()->back()->with(['sukses'=>'<script type="text/javascript">
                            $.toast({
                              heading   : "Sukses",
                              text    : "Berhasil, permintaan reset password sudah dikirim ke email anda!",
                              showHideTransition : "slide",
                              icon    : "success",
                              hideAfter   : false,
                              position    : "bottom-right",
                              bgColor   : "#2ECC71"
                            })
                        </script>']);
        } else {
            return redirect()->back()->with(['gagal'=>'<script type="text/javascript">
                            $.toast({
                              heading   : "Gagal",
                              text    : "Ada kesalahan, silahkan ulangi lagi!",
                              showHideTransition : "slide",
                              icon    : "warning",
                              hideAfter   : false,
                              position    : "bottom-right",
                              bgColor   : "#FF4859"
                            })
                        </script>']);
        }
       
    }

    private function sendResetEmail($email, $token)
        {
        //Retrieve the user from the database
        $user = DB::table('users')->where('email', $email)->select('name', 'email')->first();
        //Generate, the password reset link. The token generated is embedded in the link
        $link = url('/') . '/confirm-reset/' . $token . '?email=' . urlencode($user->email);

            try {
            //Here send the link with CURL with an external email API 
                Mail::send('auth.mail',['token' => $token,'link'=>$link,'data'=>$user], function($message) use ($user) {
                  $message->to($user->email);
                  $message->subject('Request Reset Password');
               });
                return true;
            } catch (\Exception $e) {
                return false;
            }
        }

    private function sendVerifyEmail($email)
        {
        //Retrieve the user from the database
        $user = DB::table('users')->where('email', $email)->select('name', 'email', 'id')->first();
        //Generate, the password reset link. The token generated is embedded in the link
        $link = url('/') . '/verify-email/' . urlencode($user->id);

            try {
            //Here send the link with CURL with an external email API 
                Mail::send('auth.verify_mail',['link'=>$link,'data'=>$user], function($message) use ($user) {
                  $message->to($user->email);
                  $message->subject('Verifikasi Email');
               });
                return true;
            } catch (\Exception $e) {
                return false;
            }
        }

    public function kirimVerifyEmail($id)
        {
        //Retrieve the user from the database
        $user = DB::table('users')->where('id', $id)->select('name', 'email','id')->first();
        //Generate, the password reset link. The token generated is embedded in the link
        $link = url('/') . '/verify-email/' . urlencode($user->id);
        try {
            //Here send the link with CURL with an external email API 
                Mail::send('auth.verify_mail',['link'=>$link,'data'=>$user], function($message) use ($user) {
                  $message->to($user->email);
                  $message->subject('Verifikasi Email');
               });
                return redirect()->back()->with(['sukses'=>'<script type="text/javascript">
                            $.toast({
                              heading   : "Sukses",
                              text    : "Berhasil, permintaan verifikasi sudah dikirim ke email anda!",
                              showHideTransition : "slide",
                              icon    : "success",
                              hideAfter   : false,
                              position    : "bottom-right",
                              bgColor   : "#2ECC71"
                            })
                        </script>']);
            } catch (\Exception $e) {
                return redirect()->back()->with(['gagal'=>'<script type="text/javascript">
                              $.toast({
                                heading   : "Gagal",
                                text    : "Ada kesalahan, silahkan ulangi lagi!",
                                showHideTransition : "slide",
                                icon    : "warning",
                                hideAfter   : false,
                                position    : "bottom-right",
                                bgColor   : "#FF4859"
                              })
                          </script>']);
            }
        }
    public function verifikasi_email($id)
    {
      $data = User::firstWhere('id',$id);
      $data->is_active = 1;
      $data->save();
      return redirect('/')->with(['sukses'=>'<script type="text/javascript">
                            $.toast({
                              heading   : "Sukses",
                              text    : "Akun anda berhasil diverifikasi!",
                              showHideTransition : "slide",
                              icon    : "success",
                              hideAfter   : false,
                              position    : "bottom-right",
                              bgColor   : "#2ECC71"
                            })
                        </script>']);
    }
    public function view_confirm(Request $request,$token)
    {
        if (Auth::check()) {
            return redirect()->back();
        }
        $token = $token;
        $judul = 'Perbarui Password';
        $email = $request->email;
        return view('auth.verify',compact('token','email','judul'));
    }

    public function save_reset(Request $request)
    {
        $rules = [
            'email'                 => 'email',
            'password'              => 'min:6',
            'confirm_password'      => 'same:password'
        ];
 
        $messages = [
            'email.email'           => 'Email tidak valid',
            'password.min'          => 'Password minimal 6 huruf atau angka',
            'confirm_password.same' => 'Password dan Ulangi Password tidak sama',
        ];
 
        $validator = Validator::make($request->all(), $rules, $messages);
 
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
        $cek_token = PasswordReset::where('token',$request->token)->where('email',$request->email)->first();
        if($request->token != $cek_token->token){
            return redirect()->back()->with(['gagal'=>'Token Salah']);
        }

        $user = User::where('email',$request->email)->first();
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $simpan = $user->save();

        if($simpan){
            return redirect()->route('login')->with(['sukses'=>'<script type="text/javascript">
                            $.toast({
                              heading   : "Sukses",
                              text    : "Password berhasil diperbarui!",
                              showHideTransition : "slide",
                              icon    : "success",
                              hideAfter   : false,
                              position    : "bottom-right",
                              bgColor   : "#2ECC71"
                            })
                        </script>']);
        }else{
            return redirect()->back()->with(['gagal'=>'<script type="text/javascript">
                            $.toast({
                              heading   : "Gagal",
                              text    : "Password gagal diperbarui!",
                              showHideTransition : "slide",
                              icon    : "warning",
                              hideAfter   : false,
                              position    : "bottom-right",
                              bgColor   : "#FF4859"
                            })
                        </script>']);
        }
    }

    public function logout(Request $request){
        try {
          JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['error'=>'token_expired'], 400);
            } else if ($e instanceof Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['error'=>'token_invalid'], 400);
            }else{
                return response()->json(['error'=>'token_not_found'], 401);
            }
        }
        $token = $request->header( 'Authorization' );
        JWTAuth::invalidate( $token );
        Session::flush();
        return response()->json( [
            'error'   => false,
            'message' => trans( 'Berhasil logout' )
        ] );
    }
}
