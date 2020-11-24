<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Todo;

class TODOController extends Controller
{
    public function __construct() {
        $this->middleware("auth");
    }

    public function store(){
        $data = request()->validate([
            "text" => "required"
        ]);
        Auth::user()->todos()->create($data);
        return Auth::user()->todos;
    }

    public function destroy($id)
    {
        if($id != 1)
        {return redirect("{{ url('/')}}")->with('error', 'blbe id');}
        $post = Todo::find($id);
        if($post->user_id !== auth()->user()->id){
            return redirect("{{ url('/')}}")->with('error', 'Neopravneny pristup');
        }

        $post->delete();
        return redirect("{{ url('/services')}}")->with('success', 'Prvok bol odstraneny');
    }
}
