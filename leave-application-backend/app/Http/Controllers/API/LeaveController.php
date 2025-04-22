<?php

namespace App\Http\Controllers\API;

use App\Models\Leave;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function index(){
        $leaves=Leave::where('user_id',Auth::id())->get();
        return response()->json($leaves);
    }
    public function store(Request $request){
        $request->validate([
            'leave_type'=>'required|string',
            'start_date'=>'required|date',
            'end_date'=>'required|date',
            'reason'=>'required|string',
        ]);
        $leave=Leave::create([
            'user_id'=>Auth::id(),
            'leave_type'=>$request->leave_type,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'reason'=>$request->reason,
            'status'=>'Pending',
        ]);
        return response()->json([
            'message'=>'Leave Application submitted successfully',
            'leave'=>$leave
        ]);        
    }
}
