<?php

namespace App\Http\Controllers;

use App\Aptitude;
use Illuminate\Http\Request;
use Auth;

class AptitudeController extends Controller
{
    public function __construct(){
        $this->authorizeResource(Aptitude::class);
    }

    public function index(){
        return view('aptitudes.index')->with([
            "aptitudes" => Aptitude::all()->sortBy(function($aptitude){return (!empty($aptitude->aptitude)?"zzz":"").$aptitude->name;})
        ]);
    }

    public function store(Request $request){
        $fields = $request->validate([
            "name" => 'required|string|unique:aptitudes,name',
            "description" => 'sometimes|string|nullable',
            "aptitude_id" => 'sometimes|nullable|integer|exists:aptitudes,id'
        ]);

        $aptitude = Aptitude::create($fields);

        $aptitude->aptituderanks()->createMany([
            ["rank" => 1],
            ["rank" => 2],
            ["rank" => 3],
            ["rank" => 4],
            ["rank" => 5]
        ]);

        return redirect()->route('aptitudes.show',$aptitude)->with('success', 'Aptitude created!');
    }

    public function show(Aptitude $aptitude){
        return view('aptitudes.show')->with([
            "aptitude" => $aptitude
        ]);
    }

    public function update(Request $request, Aptitude $aptitude){
        $fields = $request->validate([
            "name" => 'required|string|unique:aptitudes,name,'.$aptitude->id.',id',
            "description" => 'sometimes|string|nullable',
            "aptitude_id" => 'sometimes|nullable|integer|exists:aptitudes,id'
        ]);

        $aptitude->fill($fields)->save();

        return redirect()->route('aptitudes.show',$aptitude)->with('success', 'Aptitude updated!');
    }

    public function destroy(Aptitude $aptitude){
        return back()->with('errors', 'Aptitudes cannot currently be deleted');
    }
}
