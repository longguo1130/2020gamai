<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\SocialAccount;
use function GuzzleHttp\_current_time;
use function GuzzleHttp\Psr7\copy_to_string;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Auth;
use Exception;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/profile';

    protected $username;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
        $this->username = $this->findUsername();


    }
    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function findUsername()
    {
        $login = request()->input('login');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        request()->merge([$fieldType => $login]);

        return $fieldType;
    }
    /**
     * Get username property.
     *
     * @return string
     */
    public function username()
    {
        return $this->username;
    }

    /**
     * @param $provider
     * @return mixed
     * login with social ex: google, facebook egg
     */
    public function redirectToSocial($provider)
    {

        return Socialite::driver($provider)->redirect();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * social callback ex : google, facebook, egg
     */
    public function handleSocialCallback($provider)
    {
        try {

            $user = Socialite::driver($provider)->user();

            $finduser = User::where('provider', $provider)->where('provider_id', $user->id)->first();
            $socialiteuser = SocialAccount::where('provider', $provider)->where('provider_id', $user->id)->first();
            $finduser_email = User::where('email',$user->email)->first();

            if($finduser ){

                Auth::login($finduser);

                return redirect(route('home'));

            }elseif($socialiteuser){
                $user = User::where('id',$socialiteuser->user_id)->first();
                Auth::login($user);

                return redirect(route('home'));
            }
            else{
                if ($finduser_email){
                    SocialAccount::create([
                        'user_id' => $finduser_email->id,
                        'provider' => $provider,
                        'provider_id' => $user->id,
                        'token' => $user->token,
                    ]);
                    $finduser_email->update(['verify_status'=>$finduser_email->verify_status+10]);
                    if (Auth::user())
                        return redirect('profile');
                    else
                        Auth::login($finduser_email);

                }
                else{
                    if (Auth::user()){
                        SocialAccount::create([
                            'user_id' => Auth::user()->id,
                            'provider' => $provider,
                            'provider_id' => $user->id,
                            'token' => $user->token,
                        ]);
                        Auth::user()->update(['verify_status'=>Auth::user()->verify_status+10]);
                        return redirect('profile');
                    }
                    else{
                        $newUser = User::create([
                            'name' => $user->name,
                            'email' => $user->email,
                            'provider'=> $provider,
                            'provider_id'=> $user->id,
                            'avatar'=> $user->avatar,
                            'verify_status'=>20,
                            'bid_count'=>5000,

                        ]);
                        SocialAccount::create([
                            'user_id' => $newUser->id,
                            'provider' => $provider,
                            'provider_id' => $user->id,
                            'token' => $user->token,
                        ]);

                        Auth::login($newUser);

//                return redirect()->back();
                        return view('user.social_success' ,['user'=>$newUser]);
                    }

                }

            }

        } catch (Exception $e) {
            // todo unique email validate process
            return redirect('/login');
        }
    }


}
