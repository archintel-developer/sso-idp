<?php

namespace ArchintelDev\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SSOIDPController extends Controller
{

    public function __construct()
    {
        $this->middleware('web');
    }
    
    public function callback(Request $request)
    {
        // $a = strlen($request->response);
        // $i = strpos($request->response, '.', 0);
        // $nameID = substr($request->response, 0, $i);
        // $data = substr($request->response, $i, $a);

        $nameID = json_decode($request->response);
        
        $user = $this->getUser($nameID);

        $auth = str_replace('"', "", json_encode($nameID->auth));

        if($auth) {
            auth()->login($user);
            // return $user;
            if(\Auth::check()) {
                // return auth()->user();
                return redirect()->to(config('ssoidp.redirect_if_authenticated'));
            }

            return redirect()->to(config('ssoidp.redirect_if_authenticated'));
        }
    }

    protected function getUser($nameID)
    {
        $email = str_replace('"', "", json_encode($nameID->user->email));
        $firstname = str_replace('"', "", json_encode($nameID->user->firstname));
        $lastname = str_replace('"', "", json_encode($nameID->user->lastname));
        
        $user = \App\User::whereEmail($email)->first();
        if(!$user) {
            $user = new \App\User;

            $user->email = $email;
            $user->firstname = $firstname;
            $user->lastname = $lastname;
            $user->password = \Hash::make('123Password_');
            // $user->idp_token = str_replace('"', "", json_encode($nameID->idp_token));

            $user->save();
        }
        
        //do save to provider table if want
        return $user;
    }

    public function login()
    {
        if(\Auth::check()) {
            return redirect()->to(config('ssoidp.redirect_if_authenticated'));
        } else {
            $idp_login = config('ssoidp.idp.login_uri');
            $app_id = config('ssoidp.app_id');
            $client_secret   = config('ssoidp.client_secret');
            $redirect  = config('ssoidp.redirect_uri');

            return redirect()->away($idp_login.'?app_id='.$app_id.'&as='.base64_encode($client_secret) .'&RelayState='.$redirect);
        }
    }

    public function logout(Request $request)
    {
        $idp_logout = config('ssoidp.idp.logout_uri');
        $redirect_back = config('ssoidp.redirect_after_logout');
        auth()->logout();

        return redirect($idp_logout.'?previous='.($redirect_back == null ? $request->root().'/login' : $request->root().$redirect_back));
    }

}
