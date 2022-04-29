<?php

namespace App\Http\Controllers;
use App\Models\Prescription;
use App\Models\Patient;
use Illuminate\Http\Request;

class PrescriptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Prescription::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $quota = Patient::where('id','=',$request->patient_id)->value('quota');
        $value = Prescription::where('patient_id','=',$request->patient_id)->sum('paidValue');

        while ($value+$request->paidValue <= $quota) {
            # code...
            $request->validate([
                'date'=>'required',
                'paidValue'=>'required'
            ]);
            return Prescription::create($request->all());
        }
        return response()->json(['error' => 'sorry... you reached your limit your total quota='.$quota.' and remaining value in your balance ='.$quota-$value],500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Prescription::find($id);
    }
    public function search($patient_id)
    {
        return Prescription::where('patient_id','=',$patient_id)->sum('paidValue');
    }

    public function prescriptionsValue($patient_id,$dateStart,$dateEnd)
    {
        return Prescription::where('patient_id','=',$patient_id)->whereBetween('date', [$dateStart." 00:00:00",$dateEnd." 23:59:59"])->sum('paidValue');
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
        $prescription = Prescription::find($id);
        $prescription->update($request->all());
        return $prescription;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Prescription::destroy($id);
    }
}
