<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
public function post($id){
    return "Its Working id is: " .$id;
}
    //
}
