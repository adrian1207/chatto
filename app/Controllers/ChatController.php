<?php

namespace chatto\Controllers;

use chatto\Events\UpdateProfileEvent;
use chatto\Models\User;
use Illuminate\Http\Request;
use chatto\Events\InvitationEvent;
use chatto\Events\MessageEvent;
use Intervention\Image\Facades\Image;
use Validator;

class ChatController extends Controller
{
    /**
     * @var array
     */
    private $regions = [
        'Dolnośląskie',
        'Kujawsko-pomorskie',
        'Lubelskie',
        'Lubuskie',
        'Łódzkie',
        'Małopolskie',
        'Mazowieckie',
        'Opolskie',
        'Podkarpackie',
        'Podlaskie',
        'Pomorskie',
        'Śląskie',
        'Świętokrzyskie',
        'Warmińsko-mazurskie',
        'Wielkopolskie',
        'Zachodniopomorskie',
    ];

    /**
     * @var array
     */
    private $interests = [
        'Luźnej rozmowy',
        'Spotkania',
        'Seksu',
        'Związku',
        'Przyjaźni',
        'Niczego',
    ];
    
    /**
     * ChatController constructor.
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
        broadcast((new InvitationEvent($request->get('sender'), $request->get('recipient'))))->toOthers();
    }

    /**
     * @param Request $request
     */
    public function message(Request $request)
    {
        broadcast((new MessageEvent($request->get('channel'), $request->get('message'))))->toOthers();
    }

    /**
     * @param Request $request
     * @return void
     */
    public function update(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = User::find(\Auth::id());
        $user->age = $request->get('age');
        $user->about = $request->get('about');
        $user->interests = $request->get('interests');
        $user->region = $request->get('region');

        if ($request->hasFile('photo'))
        {
            $image = $request->file('photo');
            $filename  = time().'.'.$image->getClientOriginalExtension();
            $path = public_path('photos/'.$filename);
            Image::make($image->getRealPath())->save($path);
            $pathThumb = public_path('photos/thumbs/'.$filename);
            Image::make($image->getRealPath())->fit(210, 160)->save($pathThumb);
            $user->photo = $filename;
        }
        else
        {
            if ($request->get('photo') === '')
            {
                $user->photo = '';
            }
        }
        
        $user->save();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function reserve(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = User::find(\Auth::id());
        $user->reserved = 1;
        $user->password = bcrypt($request->get('password'));
        $user->save();
    }

    /**
     * Walidacja fomularzy aktualizacji użytkownika i rezerwacji nicku
     *
     * @param array $data
     * @return \Illuminate\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'age' => 'integer',
            'region' => 'in:'.implode(',', $this->regions),
            'interests.*' => 'in:'.implode(',', $this->interests),
            'about' => 'max:200',
            'password' => 'min:4|max:64',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }
}
