<?php

namespace nuta\Controllers;

use Illuminate\Http\Request;
use nuta\Events\InvitationEvent;

class ChatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('chat');
    }

    /**
     * @param Request $request
     */
    public function invite(Request $request)
    {
        broadcast((new InvitationEvent($request->get('sender'), $request->get('recipient'))));
    }
}
