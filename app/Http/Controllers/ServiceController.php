<?php

namespace App\Http\Controllers;

use App\Rate;
use App\Service;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getService()
    {
        //
        
        $services = Service::all();
        $rates = Rate::all();
        return view('admin.service',compact('services','rates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postService(Request $request)
    {
        //
        //register new employee
        $service = new Service();
        $this->validate($request, [
            /*'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required|',*/

        ]);

        //Insert new user
        $service->service_no = $request->input('service_no');
        $service->description = $request->input('description');
        $service->unit = $request->input('unit');
        $service->rate = $request->input('rate');
       

        $service->save();


        Session::flash('flash_message', 'Service successfully added!');
        return redirect()->back()->with('success', 'Service Successfully Added');
    }

    public function postRate(Request $request)
    {
        //
        //register new employee
        $service = new Rate();
        $this->validate($request, [
            'title' => 'required|max:255',
            'rate' => 'required|numeric',


        ]);

        //Insert new rate
        $service->title = $request->input('title');
        $service->rate = $request->input('rate');


        $service->save();


        Session::flash('flash_message', 'Service successfully added!');
        return redirect()->back()->with('success', 'Service Successfully Added');
    }

    
    public function store(Request $request)
    {
        //
    }
    public function getEdit_Service($id)
    {
       
        $service = Service::findOrFail($id);
        
        return view('admin.edit_service',compact('service'));
    }

    public function getEdit_Rate($id)
    {
        $rate = Rate::findOrFail($id);
       

        return view('admin.edit_rate',compact('rate'));
    }
    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [



        ]);
        $service_no = Input::get('service_no');
        $description = Input::get('description');
        $unit = Input::get('unit');
        $rate = Input::get('rate');

        $update = Service::findOrFail($id);

        $update->service_no = $service_no ? $service_no : $update->servive_no;
        $update->description = $description ? $description : $update->description;
        $update->unit = $unit ? $unit : $update->unit;
        $update->rate = $rate ? $rate : $update->rate;

        $update->save();

        Session::flash('flash_message', 'Task successfully Updated!');
        return redirect()->back();
    }

    public function update_rate(Request $request, $id)
    {
        //
        $this->validate($request, [



        ]);

        $title = Input::get('title');
        $rate = Input::get('rate');

        $update = Rate::findOrFail($id);


        $update->title= $title? $title : $update->title;
        $update->rate = $rate ? $rate : $update->rate;

        $update->save();

        Session::flash('flash_message', 'Task successfully Updated!');
        return redirect()->back();
    }

   
    public function destroy($id)
    {
        //
        $deletes = Service::find($id);
        $deletes->delete();
        Session::flash('flash_message', 'Record deleted successfully !');
        return redirect()->back()->with('success', 'Record deleted successfully');
    }
    public function remove($id)
    {
        //
        $deletes = Rate::find($id);
        $deletes->delete();
        Session::flash('flash_message', 'Record deleted successfully !');
        return redirect()->back()->with('success', 'Record deleted successfully');
    }
}
