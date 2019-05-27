<?php

namespace App\Http\Controllers;

use App\Aptituderank;
use Illuminate\Http\Request;
use Auth;

class AptituderankController extends Controller
{
    public function store(Request $request){
        $fields = $request->validate([
            "aptitude_id" => 'required|integer|exists:aptitudes,id',
            "rank" => 'required|integer|min:0',
            "description" => 'sometimes|string|nullable',
            "hhp" => 'sometimes|integer',
            "biofocus" => 'sometimes|integer',
            "bf_cost" => 'sometimes|integer|min:0'
        ]);

        $aptituderank = Aptituderank::create($fields);

        return redirect()->route('aptitudes.show', $aptituderank->aptitude)->with('success', 'Aptitude Rank created!');
    }

    public function update(Request $request, Aptituderank $aptituderank){
        $fields = $request->validate([
            "rank" => 'required|integer|min:0',
            "description" => 'sometimes|string|nullable',
            "hhp" => 'sometimes|integer',
            "biofocus" => 'sometimes|integer',
            "bf_cost" => 'sometimes|integer|min:0'
        ]);

        $aptituderank->fill($fields)->save();

        return redirect()->route('aptitudes.show', $aptituderank->aptitude)->with('success', 'Aptitude Rank updated!');
    }

    public function destroy(Aptituderank $aptituderank){
        return back()->with('errors', 'Aptitudes cannot currently be deleted');
    }
}
