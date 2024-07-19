<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index()
    {
        $series = Serie::query()->orderBy('nome')->get();
        $messageSuccess = session('message.success');

        return view('series.index')->with('series', $series)->with('messageSuccess', $messageSuccess);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(Request $request)
    {
        Serie::create($request->all());
        session()->flash('message.success', 'Série adicionada com sucesso');

        return to_route('series.index');
    }

    public function destroy(Request $request)
    {
        Serie::destroy($request->series);
        session()->flash('message.success', 'Série removida com sucesso');

        return to_route('series.index');
    }
}
