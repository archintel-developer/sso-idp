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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function callback(Request $request)
    {
        $a = strlen($request->response);
        $i = strpos($request->response, '.', 0);
        $nameID = substr($request->response, 0, $i);
        $data = substr($request->response, $i, $a);
        
        $user = $this->getUser($nameID);

        if($request->as) {
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
        $a = base64_decode($nameID);
        $account = json_decode($a);
        
        $user = \App\User::whereEmail($account->email)->first();
        if(!$user) {
            $user = new \App\User;
            $user->email = $account->email;
            $user->name = $account->name;

            // $user->firstname = $account->firstname;
            // $user->lastname = $account->lastname;
            $user->password = \Hash::make('123Password_');

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
            
            // $name_start= strpos($redirect, '//');
            // $name_end  = strpos($redirect, '/', $name_start+2);
            // $hostname  = substr($redirect, $name_start+2, $name_end-$name_start-2);
            // $name      = (config('ssoidp.name') == '') ? $hostname : configssoidp('ssoassoidputh.name');

            // $dosso     = config('ssoidp.add_query.dosso');
            // $action    = config('ssoidp.add_query.action');

            return redirect()->away($idp_login.'?app_id='.$app_id.'&as='.base64_encode($client_secret) .'&RelayState='.$redirect);
        }
    }

    public function logout(Request $request)
    {
        $idp_logout = config('ssoidp.idp.logout_uri');
        auth()->logout();

        return redirect($idp_logout.'?previous='.$request->root().'/login');
    }

}
