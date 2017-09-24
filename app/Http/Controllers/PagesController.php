<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function index() {
        return view('pages.index');
    }

    public function about() {

        //This should be in config :)

        $firstname = 'Ovidiu-Mihai';
        $lastname = 'Belciug';

        $fullname = $firstname . ' ' . $lastname;
        $email = 'ovidiumihaibelciug@gmail.com';

        $data['email'] = $email;
        $data['fullname'] = $fullname;

        return view('pages.about')->withData($data);
    }

    public function services() {
        return view('pages.services');
    }

}
