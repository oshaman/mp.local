<?php

namespace Fresh\Medpravda\Http\Controllers;

use Fresh\Medpravda\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $user = User::where('id', 2)->with('role')->first();
        dd($user);
    }

    public function main()
    {
        return view('test')->with('content', 'welcome');
    }

    public function medicine($loc, $medicine, $act = null)
    {
        $act = $act ?? 'medicine';

        if ('ru' == $loc) {
            $content = 'RU-' . $act . '-' . $medicine;
        } else {
            $content = 'UA-' . $act . '-' . $medicine;
        }
        return view('test')->with('content', $content);
    }

    /*public function analog($loc, $medicine=null)
    {
        if ('ru' == $loc) {
            $content = 'RU-analog-'.$medicine;
        } else {
            $content = 'UA-analog-'.$medicine;
        }
        return view('test')->with('content', $content);
    }

    public function adaptive($loc, $medicine=null)
    {
        if ('ru' == $loc) {
            $content = 'RU-adaptive-'.$medicine;
        } else {
            $content = 'UA-adaptive-'.$medicine;
        }
        return view('test')->with('content', $content);
    }

    public function faqMed($loc, $medicine=null)
    {
        if ('ru' == $loc) {
            $content = 'RU-faq-'.$medicine;
        } else {
            $content = 'UA-faq-'.$medicine;
        }
        return view('test')->with('content', $content);
    }*/
}
