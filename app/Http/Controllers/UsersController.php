<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Rate;
use App\Service;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{

    public function getCompanyEmp($id)
    {
        //
        $emp = User::find($id);
        $employees  = User::where('company','=',$emp->company)->get();

        return view('company.company_emp',compact('employees'));
        
    }

    public function getEmployees()
    {
        //get employee according to company name

        $employees  = User::where('company','=',Auth::user()->company)->get();


        return view('company.employee',compact('employees'));
    }
    
    public function getCreateEmployee()
    {
        //get form create employee
       return view('company.create_emp'); 
    }
    public function getEmployee($id)
    {
        //get  employee Portal
     $serv = Service::all();
        $service = Service::find($id);
        $services = Service::lists('description','id');
        
        $employee = User::findorFail($id);
        
        return view('company.jobcard',compact('employee','services','service','serv'));
    }

    public function getEmployeeDyn($id)
    {
        //get  employee Portal
     $serv = Service::all();
        $service = Service::find($id);
        $services = Service::lists('description','id');

        $employee = User::findorFail($id);

        return view('company.dynamic',compact('employee','services','service','serv'));
    }

    public function postEmployee(Request $request)
    {
        //register new employee

        $this->validate($request, [
            /*'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required|',*/

        ]);

        $employer = Auth::user()->company;

        $employee = new User();

        //Insert new user
        $employee ->name = $request->input('name');
        $employee ->surname = $request->input('surname');
        $employee ->phone = $request->input('phone');
        $employee ->company= $employer;

        $employee ->email = $request->input('email');
        $employee ->password = bcrypt($request->input('password'));
        $employee ->role= 3;
        $employee ->save();

        $user= new Employee();
        $user ->name = $request->input('name');
        $user->user_id = $employee->id;
        $user->surname = $request->input('surname');
        $user ->phone = $request->input('phone');
        $user ->company= $employer;
        $user ->email = $request->input('email');

        $user ->save();
      

        Session::flash('flash_message', 'Service successfully added!');
        return redirect()->back()->with('success', 'Service Successfully Added');
    }


    public function getUser($id)
    {
        $rates = Rate::lists('rate','id');
    $user = User::findOrFail($id);
    return view('profile.user',compact('user','rates'));
}



    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'name' => 'max:255',
            'email' => 'email|max:255',
            'password' => 'min:6|confirmed',
            'mobile' => 'min:10',


        ]);
        $name = Input::get('name');
        $surname = Input::get('surname');
        $email = Input::get('email');
        $mobile = Input::get('phone');
        
        

        $password = bcrypt(Input::get('password'));
        $update = User::findOrFail($id);

        $update->name = $name ? $name : $update->name;
        $update->email = $email ? $email : $update->email;
        $update->phone = $mobile ? $mobile : $update->phone;
        $update->surname = $surname ? $surname : $update->surname;
        $update->password = $password ? $password : $update->password;

        $update->save();

        Session::flash('flash_message', 'Task successfully Updated!');
        return redirect()->back();
    }

    public function update_status(Request $request, $id)
    {
        //
        $this->validate($request, [



        ]);
       
        $role_id= Input::get('role');
        $update = User::findOrFail($id);
       
        $update->role = $role_id ? $role_id : $update->role;
        $update->save();

        Session::flash('flash_message', 'Task successfully Updated!');
        return redirect()->back();
    }

    public function update_rate(Request $request, $id)
    {
        //
        $this->validate($request, [
            /*'rate[]' => 'required',*/


        ]);
        foreach ($request->rate as $key => $v) {
            $rate = $request->rate[$key];
            $update = User::findOrFail($id);
            
            $update->rate = $rate ? $rate : $update->rate;
            $update->save();

            Session::flash('flash_message', 'Rate successfully Updated!');
            return redirect()->back();
        }
    }



    public function destroy($id)
    {
        //
    }
}
