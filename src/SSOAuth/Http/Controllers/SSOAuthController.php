<?php

namespace SSOAuth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SSOAuthController extends Controller
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

        auth()->login($user);
        // return $user;
        if(\Auth::check()) {
            // return auth()->user();
            return redirect()->to('/home');
        }

        return redirect()->to('/home');
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
            $user->password = \Hash::make('123Password');

            $user->save();
        }
        //do save to provider table if want
        return $user;
    }

    public function redirect()
    {
        $idp_login = config('ssoauth.idp.login_uri');
        $client_id = config('ssoauth.client_id');
        $api_key   = config('ssoauth.api_key');
        $redirect  = config('ssoauth.redirect_uri');
        $name      = config('ssoauth.name');

        $dosso     = config('ssoauth.add_query.dosso');
        $action    = config('ssoauth.add_query.action');

        return redirect()->away($idp_login.'?client_id='.$client_id.'&as='.base64_encode($api_key).'&name='.$name.'&dosso='.$dosso.'&RelayState='.$redirect.'&action='.$action);
    }

}
