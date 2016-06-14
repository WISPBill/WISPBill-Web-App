<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Intervention\Image\Facades\Image as Image;
class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'skin' => 'required|in:skin-blue,skin-blue-light,skin-yellow,skin-yellow-light,skin-green,skin-green-light,skin-purple,skin-purple-light,skin-red,skin-red-light,skin-black,skin-black-light',
            'img' => 'image|mimes:jpeg',
            'phone' => 'required|regex:/\d{3}\-\d{3}\-\d{4}/',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
      if(isset($data['img'])){
        $extension = pathinfo($data['img'],PATHINFO_EXTENSION);
        $email = $data['email'];
        $number = rand(0,1000);
        $newname = "$email"."$number.jpg";
        $pubpath = public_path();
        move_uploaded_file($data['img'], "$pubpath/img/userimg/$newname");
        $img = Image::make("$pubpath/img/userimg/$newname");
        $img->resize(160, 160);
      }else{
          $newname = "user_default_img.jpg";
      }
      
      $usertotal = User::count();
      
      if($usertotal > 0){
          $role = 'No Access';
      }elseif($usertotal == 0){
          $role = 'admin';
      }else{
          abort(500, 'Issue with Database');
      }
          
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'skin' => $data['skin'],
            'img' => $newname,
            'role' => $role,
            'phone' => $data['phone'],
        ]);
    }
}
