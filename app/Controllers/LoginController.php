<?php

namespace chatto\Controllers;

use Illuminate\Http\Request;
use Validator;
use chatto\Models\User;

class LoginController extends Controller
{
    /**
     * Przekierowanie po zalogowaniu.
     *
     * @var string
     */
    protected $redirectTo = '/chat';

    /**
     * LoginController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Widok główny strony startowej
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Waliduje i przełacza pomiędzy rejestracją i logowaniem.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function switcher(Request $request)
    {
        $this->validator($request->all(), $request->has('reserved'))->validate();

        if ($request->has('reserved'))
        {
            return $this->login($request);
        }
        else
        {
            return $this->register($request);
        }
    }

    /**
     * Walidacja fomularza logowania/rejestracji
     *
     * @param array $data
     * @param $reserved
     * @return \Illuminate\Validation\Validator
     */
    protected function validator(array $data, $reserved)
    {
        if ($reserved)
        {
            return Validator::make($data, [
                'nick' => 'required|min:4|max:24',
                'password' => 'required|min:4|max:64',
            ], [
                'nick.min' => 'Nick powinien być dłuższy niż 4 znaki.',
                'nick.max' => 'Nick powinien być krótszy niż 24 znaki.',
                'password.required' => 'Zaznaczyłeś, że masz zarezerwowany nick. Podaj hasło.',
                'password.min' => 'Hasło musi być dłuższe niż 4 znaki.',
                'password.max' => 'Hasło musi być krótsze niż 64 znaki.',
            ]);
        }
        else
        {
            return Validator::make($data, [
                'nick' => 'unique:users|required|min:4|max:24',
                'gender' => 'required',
            ], [
                'nick.min' => 'Nick musi być dłuższy niż 4 znaki.',
                'nick.max' => 'Nick musi być krótszy niż 24 znaki.',
                'gender.required' => 'Podanie płci jest wymagane.',
            ]);
        }
    }

    /**
     * Rejestracja nowego użytkownika.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        $request->request->add(['password' => str_random(32)]);

        User::create([
            'nick' => $request->get('nick'),
            'gender' => ($request->get('gender') == 'male') ? User::MALE : User::FEMALE,
            'reserved' => false,
            'password' => bcrypt($request->get('password'))
        ]);

        if (\Auth::attempt($request->only('nick', 'password'), true))
        {
            return $this->logged($request);
        }

        return redirect()->back()->withErrors(['global' => 'Chwilowy problem z wejściem, prosimy spróbować za chwilę.']);
    }

    /**
     * Logowanie użytkownika.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        if (\Auth::attempt($request->only('nick', 'password'), true))
        {
            return $this->logged($request);
        }

        return redirect()->back()->withErrors(['global' => \Lang::get('auth.failed')]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logged(Request $request)
    {
        $request->session()->regenerate();

        //broadcast(new UserLoggedEvent(\Auth::getUser()))->toOthers();

        return redirect()->intended($this->redirectTo);
    }

    /**
     * Wylogowanie użytkownika.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        \Auth::logout();

        $request->session()->flush();
        $request->session()->regenerate();

        return redirect('/');
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'gender.required' => 'Podanie płci jest wymagane.',
            'body.required'  => 'A message is required',
        ];
    }
}
