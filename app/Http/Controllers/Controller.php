<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use App\Models\Message;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Main page routing
     *
     * @return mixed
     */
    function main():mixed
    {
        $user=session('user');
        if ($user) {
            return view('room');
        }
        return $this->login();
    }

    /**
     * Login page
     *
     * @return mixed
     */
    function login():mixed
    {
        return view('login');
    }

    /**
     * Login action
     *
     * @param Request $r request
     * 
     * @return mixed
     */
    function loginAction(Request $r):mixed
    {
        $validator= Validator::make(
            $r->all(),
            [
            'name' => 'string|min:2|max:50|required'
            ]
        );
        if ($validator->fails()) {
            return view(
                'login'
            )->withErrors($validator->errors());
        }
        $valid=$validator->validated();
        // set name 
        $r->session()->put('name', $valid['name']);
        return $this->room();
    } 

    /**
     * Chat room view
     *
     * @return mixed
     */
    function room():mixed
    {
        $name=$this->_getUser();
        if (!$name) {
            return $this->login();
        }
        return view(
            'room', 
            [
                'name' => $name
            ]
        );
    }

    private function _getUser():string
    {   
        return session('name');
    }

    /**
     * Messages
     *
     * @return mixed
     */
    function messages():mixed
    {
        return view(
            'messages', 
            [
                'messages' => Message::latest()->take(25)->get()->reverse()->values(),
                'user' => $this->_getUser()
            ]
        );
    }


    /**
     * Returns last update
     *
     * @return mixed
     */
    function lastUpdate():mixed 
    {
        return Cache::get('lastUpdate');
    }


    /**
     * Send message
     *
     * @param Request $r request
     * 
     * @return void
     */
    function sendMessage(Request $r)
    {

        Cache::put('lastUpdate', time());
        Message::create(
            [
            'name' => $this->_getUser(),
            'message' => $r->message
            ]
        );
        return view('messageSend');
    }
}
