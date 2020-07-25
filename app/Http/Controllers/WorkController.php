<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;

class WorkController extends Controller
{
    //
    public function index()
    {
        $values = Work::all();

        //dd($values);

        return view('works/work', compact('values'));

    }
}
