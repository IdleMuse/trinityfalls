<?php

namespace App\Http\Controllers;

use App\Downtimepoint;
use App\Downtimeperiod;
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
