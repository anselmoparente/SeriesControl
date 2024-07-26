<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;

class SeriesController extends Controller
{
    public function index()
    {
        $series = Series::all();
        $messageSuccess = session('message.success');

        return view('series.index')->with('series', $series)->with('messageSuccess', $messageSuccess);
    }

    public function create()
    {
        return view('series.create');
    }

    public function edit(Series $series)
    {
        return view('series.edit')->with('series', $series);
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();

        return to_route('series.index')->with('message.success', "Série '{$series->nome}' atualizada com sucesso");
    }

    public function store(SeriesFormRequest $request)
    {
        $series = Series::create($request->all());

        return to_route('series.index')->with('message.success', "Série '{$series->nome}' adicionada com sucesso");
    }

    public function destroy(Series $series)
    {
        $series->delete();

        return to_route('series.index')->with('message.success', "Série '{$series->nome}' removida com sucesso");
    }
}
