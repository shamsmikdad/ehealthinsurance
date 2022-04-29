<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DoctorVisit;
use App\Models\Patient;
class DoctorVisitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DoctorVisit::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $a = Patient::where('id','=',$request->patient_id)->value('doctorVisits');
        $b = DoctorVisit::where('patient_id','=',$request->patient_id)->count();
 
        //return $a.' '.$b;
        while ($b < $a) {
            # code...
            $request->validate([
                'disease'=>'required',
                'fee'=>'required',
                'date'=>'required'
            ]);
            return DoctorVisit::create($request->all());
        }
        return response()->json(['error' => 'sorry... you reached your limit'],500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return DoctorVisit::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $doctorVisit = DoctorVisit::find($id);
        $doctorVisit->update($request->all());
        return $doctorVisit;
    }

    public function search($patient_id,$dateStart,$dateEnd)
    {
        return DoctorVisit::where('patient_id','=',$patient_id)->whereBetween('date', [$dateStart." 00:00:00",$dateEnd." 23:59:59"])->sum('fee');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return DoctorVisit::destroy($id);
    }
}
