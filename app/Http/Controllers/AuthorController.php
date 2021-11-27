<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $items = Author::pagenate(4);
        $param = ['items' => $items, 'user' =>$user];
        return view('index', $param);
    }
}
