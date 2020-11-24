<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\ToDo;

class PagesController extends Controller
{
    public function index(){
        $title = 'Vytajte u nas';
        return view('pages.index')->with('title', $title);
    }
    public function about(){
        $title = 'cavce mravce';

        return view('pages.about')->with('title',$title);
    }
    public function services(){
        $title = 'TO DO APP';
        $data = "";
        if (Auth::check())
        {
            $data = Auth::user()->todos;
        }        
        return view('pages.services')->with(["title" => $title, "data" => $data ]);
    }

    public function contact(){
        $data = array(
            'meno' => 'mato',
            'priezvisko' => 'kopec',
            'email' => 'root@root.com',
            'cislo' => '0000'
        );
        return view('pages.contact')->with($data);

    }

}
