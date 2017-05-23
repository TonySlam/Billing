<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = User::find(Auth::user()->id);
        $comments  = Post::where('user_id','=',$employee->id )
            ->OrderBy('created_at','DESC')
            ->paginate(1);
        $company = Company::find(Auth::user()->id);
        $num_user = User::select(count('id'))
            /*->where('company','=',$company->company)*/
            ->groupBy('company');

        $num = User::select(count('id'));
        $company = Company::select(count('id'));


        return view('/home',compact('comments','num_user','num','company'));
    }
}
