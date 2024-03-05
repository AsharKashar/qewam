<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Password;
use App\Model\Lesson;
use Illuminate\Http\Request;
use Alaouy\Youtube\Facades\Youtube;
use App\Model\User;
// require '{path_to_root_folder}/autoload.php';
use Vimeo\Vimeo;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    // public function test(request $request)
    // {

    //     return Lesson::getDetailsfromYoutubeURL($request->url);
    // }

    public function forgot(request $request) {
        return User::forgot($request->email);
    }
}
