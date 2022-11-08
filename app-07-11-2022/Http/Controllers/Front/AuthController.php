<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;
use App\Contracts\UserContract;
use Illuminate\Support\Carbon;
use App\Models\User;
use Illuminate\Support\Str;

class AuthController extends BaseController
{
    use AuthenticatesUsers;
    protected $userRepository;
    // protected $redirectTo = '/';

    public function __construct(UserContract $userRepository)
    {
        $this->middleware('guest:web')->except('logout');
        $this->userRepository = $userRepository;
    }

    public function login(Request $request) {
        return view('front.auth.login');
    }

    public function loginCheck(Request $request) {
        $request->validate([
            // 'email' => 'required|email|exists:users,email',
            'email'   => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('web')->attempt($credentials)) {
            // return $this->responseRedirect('front.dashboard.index','Login Successful','success',false,false);
			return redirect()->route('front.dashboard.index')->with('success', 'Login Successful');
        } else {
            //return redirect()->back()->with(['message' => 'Wrong password!']);
			return redirect()->back()->with('failure', 'Wrong Password');
        }
    }

    public function register(Request $request) {
        return view('front.auth.register');
    }

    public function create(Request $request) {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'mobile' => 'required|integer|digits:10',
            'password' => 'required|min:6|max:100',
        ]);

        $user = new User;
        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->mobile = $request['mobile'];

        // generate slug
        $full_name = $request['first_name'].' '.$request['last_name'];
        $slug = Str::slug($full_name, '-');
        $slugExistCount = User::where('slug', $slug)->count();
        if ($slugExistCount > 0) $slug = $slug . '-' . ($slugExistCount + 1);
        $user->slug = $slug;
        $user->save();

        if ($user) {
            return redirect()->route('front.user.login')->with('success', 'Account created successfully');
        } else {
            return redirect()->route('front.user.register')->withInput($request->all())->with('failure', 'Something happened');
        }
    }

    public function logout() {
        Auth::guard('web')->logout();
        return redirect()->route('front.index')->with('success', 'Logout successfull');
    }

}
