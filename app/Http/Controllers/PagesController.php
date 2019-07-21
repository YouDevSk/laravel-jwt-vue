<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dish;

class PagesController extends Controller
{
    public function __construct(){
        $this->middleware('guest');
    }

    public function home(){

        return view('pages.home');
    }

    public function menu(){

        $dishes = Dish::orderBy('name', 'ASC')->with('ingredients')->get();

        return view('pages.menu', compact('dishes'));
    }
}
