<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class CommentController extends Controller
{
    public function index()
    {
        //
    }

    public  function newPost($id)
    {
        $post = User::findOrFail($id);
        return  View::make('comment.new_post',compact('post'));
    }

    public function createPost(Request $request)
    {
        $employee = User::find($request->input('user_id'));

        $post = new Post();

        $post->supervisor_id= Auth::user()->id;
        $post->superv_name = Auth::user()->name;
        $post->user_id = $employee->id;
        $post->content = nl2br(Input::get('editor1'));

        $post->save();

        Session::flash('flash_message', 'comment successfully added!');

        /*return redirect()->route('profile',array('id'=>$patient->id));*/
        return redirect()->back();
    }

    /**
     * @param $id
     * @return mixed
     */
    public  function createComment($id)
    {
        $post = Post::findOrFail($id);

        $comment = new Comment();
        $comment->name =Input::get('name');
        $comment->content = nl2br(Input::get('content'));

        $post->comments()->save($comment);
        Session::flash('flash_message', 'comment successfully added!');
        /* return Redirect::route('profile', array('id'=>Crypt::decrypt($post->id)));*/
        return redirect()->back();
    }


    public function viewPost($id)
    {
        //
        $post = Post::findOrFail($id);
        return view('comment.view',compact('post'));
    }


    public function store(Request $request)
    {
        //
    }


    public function show()
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
    }


    public function destroy($id)
    {
        //
    }
}
