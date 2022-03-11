<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use function Psy\debug;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function showRegistrationForm()
    {
        return view('registers', ['title' => 'Регистрация']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'login' => 'required|string|max:255|unique:users,login',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:3|confirmed',
        ]);
        $user = User::create([
            'name' => $request->login,
            'email' => $request->email,
            'login' => $request->login,
            'password' => bcrypt($request->password),
        ]);

        $role=3;  ///для проверки ввиду отсутствия админки
        if ($user->name=='admin') $role=1;
            elseif ($user->name=='moder') $role=2;
        DB::beginTransaction();
        try {
            DB::insert("INSERT INTO role_user (user_id,role_id) values (?,?)", [ $user->id, $role]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
        }

        session()->flash('success', 'Регистрация пройдена');
        Auth::login($user);
        return redirect()->home();
    }
}
