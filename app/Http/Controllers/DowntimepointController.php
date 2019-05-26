<?php

namespace App\Http\Controllers;

use App\Downtimepoint;
use App\Downtimeperiod;
use App\Skillrank;
use Illuminate\Http\Request;
use Auth;

class DowntimepointController extends Controller
{
    public function __construct(){
        $this->authorizeResource(Downtimepoint::class);
    }

    public function store(Request $request){
        $data = $request->validate([
            'downtime_id' => 'required|integer|exists:downtimes,id',
        ]);

        $data['order'] = Downtimepoint::where('downtime_id',$data['downtime_id'])->max('order') + 1;
        if($data['order'] > 10 && !Auth::user()->can('create',Downtimeperiod::class)){
            return back()->with('errors', 'Max Downtime points reached');
        }

        $downtimepoint = Downtimepoint::create($data);
        return back()->with('success', 'Downtime point added');
    }

    public function show(Downtimepoint $downtimepoint){
        return redirect()->route('downtimes.show',[
            "downtime" => $downtimepoint->downtime,
            "point" => $downtimepoint->order
        ]);
    }

    public function edit(Downtimepoint $downtimepoint){
        return redirect()->route('downtimes.edit',[
            "downtime" => $downtimepoint->downtime,
            "point" => $downtimepoint->order            
        ]);
    }

    public function update(Request $request, Downtimepoint $downtimepoint){
        $data = $request->validate([
            'text' => 'required|string|nullable',
            'response' => 'sometimes|string|nullable'
        ]);

        $downtimepoint->text = $data['text'];
        if(Auth::user()->is_admin && $request->has('response')){
            $downtimepoint->response = $data['response'];
        }

        if($downtimepoint->xp_spend_rejected == null && $downtimepoint->xpdelta_id == null && $request->has('purchaseable_id') && $request->purchaseable_id != 0){
            $skillrank = Skillrank::findOrFail($request->purchaseable_id);
            $delta = $downtimepoint->character->xpdeltas()->create([
                'delta' => -$skillrank->xp_cost,
                'is_approved' => Auth::user()->is_admin,
                'purchaseable_type' => "App\Skillrank",
                'purchaseable_id' => $skillrank->id,
                'note' => "Requested in Downtime opening ".$downtimepoint->downtimeperiod->opens_at,
                'variant' => $request->variant,
            ]);
            $downtimepoint->xpdelta_id = $delta->id;
        }

        $downtimepoint->save();

        return back()->with('success', 'Downtime point updated');
    }

    public function destroy(Downtimepoint $downtimepoint){
        $downtime = $downtimepoint->downtime;
        $order = $downtimepoint->order;
        $downtimepoint->delete();
        $downtime->reorder($order);
        return back()->with('success', 'Downtime point deleted');
    }
}
