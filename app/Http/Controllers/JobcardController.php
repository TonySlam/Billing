<?php

namespace App\Http\Controllers;

use App\Jobcard;
use App\Service;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class JobcardController extends Controller
{
    
    public function index()
    {
        //
        
    }
    public function findRate(Request $request)
    {
       $data = Service::select('rate')->where('id',$request->id)->first();
        return response()->json($data);
    }


    public function postTech(Request $request)
    {
        //
        $this->validate($request, [
            'date' => 'required|max:255',
            'qty' => 'required|max:255',
           
        ]);



            foreach ($request->productName as $key => $v) {
                $rate = Service::find($v);
                $data = array(
                    'user_id' => $request->input('user_id'),
                    'date' => $request->input('date'),
                    'service_id' => $v,
                    'user_rate' => $request->input('user_rate'),
                    'num_service' => $request->qty[$key],
                    'rate' => $rate->rate,
                    /*'amount'=>$request->amount[$key],*/
                    'amount' => $request->qty[$key] * $rate->rate,
                    'created_at' => date('Y-m-d H:s:i'),
                    'updated_at' => date('Y-m-d H:s:i')
                );

                Jobcard::insert($data);

            }

            Session::flash('flash_message', 'Service successfully added!');
            return redirect()->back()->with('success', 'Service Successfully Added');




        }
    
    
    public function postTechDyn(Request $request)
    {
        //
        $this->validate($request, [
            'date' => 'required|max:255',
            'qty' => 'required|max:255',

        ]);



        foreach ($request->qty as $key => $v)
        {
            $rate= Service::find($v);
            $data = array(
                'user_id'=>$request->input('user_id'),
                'date'=>$request->input('date'),
                'service_id'=>$v,
                'user_rate'=>$request->input('user_rate'),
                'num_service'=>$request->qty[$key],
                'rate'=>$rate->rate,
                /*'amount'=>$request->amount[$key],*/
                'amount'=>$request->qty[$key]*$rate->rate,
                'created_at'=>date('Y-m-d H:s:i'),
                'updated_at'=>date('Y-m-d H:s:i')
            );
        /*dd($data);*/
            Jobcard::insert($data);
        }
        Session::flash('flash_message', 'Service successfully added!');
        return redirect()->back()->with('success', 'Service Successfully Added');
    }


   
    public function store(Request $request)
    {
        //
    }

    
    public function getShow($id)
    {
        $user  = User::find($id);

        $total = Jobcard::select(count('amount'))
            ->where('date','=','2017-05-02')
            ->groupBy('date');


        $jobs = Jobcard::where('user_id','=',$user->id )
            ->Join('services', 'services.id', '=', 'jobcards.service_id')

            ->get();
        return view('company.view_jobs',compact('jobs','total','user'));
    }

    public function getTotal(Request $request,$id)
    {
        $this->validate($request, [
            'from' => 'required|date|max:255',
            'to' => 'required|date|max:255',
        ]);
        $user  = User::find($id);
        $rate = Jobcard::find($user->id);

            $search = DB::table('jobcards')
                ->Join('services', 'services.id', '=', 'jobcards.service_id')
                ->whereBetween('date', array($request->input('from'), $request->input('to')))
                ->where('user_id','=',$request->input('user_id'))
                ->get();

            return view('company.job_total', compact('search','user','rate'));


    }

   
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
