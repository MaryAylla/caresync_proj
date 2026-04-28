<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SpecialDate;
use Illuminate\Support\Facades\Auth;

class SpecialDateController extends Controller
{
    public function store(Request $request) {
    $request->validate([
        'title' => 'required|string|max:100',
        'event_date' => 'required|date',
    ]);

    SpecialDate::create([
        'user_id' => Auth::id(),
        'title' => $request->title,
        'event_date' => $request->event_date,
        'category' => $request->category ?? 'Aniversário',
    ]);

    return redirect('/')->with('sucesso', 'Data especial cadastrada!');
}

public function create()
{
    return view('special_dates.create');
}
}
