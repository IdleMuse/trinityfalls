<?php

namespace App\Http\Controllers;

use App\Menulink;
use Illuminate\Http\Request;
use Auth;

class MenulinkController extends Controller
{
    public function __construct(){
        $this->authorizeResource(Menulink::class);
    }

    public function index(){
        $menulinks = Menulink::all();
        return view('menulinks.index')->with('menulinks', $menulinks);
    }

    public function store(Request $request){
        $data = $request->validate([
            "name" => "required|string",
            "url" => "required|string",
            "icon" => "sometimes|nullable|string"
        ]);

        $menulink = Menulink::create($data);

        return back()->with('success', 'Link created!');
    }

    public function update(Request $request, Menulink $menulink){
        $data = $request->validate([
            "name" => "sometimes|string",
            "url" => "sometimes|string",
            "icon" => "sometimes|nullable|string"
        ]);

        $menulink->update($data);

        return back()->with('success', 'Link updated!');
    }

    public function destroy(Menulink $menulink){
        $menulink->delete();
        return back()->with('success', 'Link removed!');
    }
}
