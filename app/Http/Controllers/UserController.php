<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate();
        return view('users.index', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.view', compact('user'));

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
        if($this->checkUser($id))
        {
            $user = User::findOrFail($id);
            return view('users.update', compact('user'));
        }
        else
        {
            session()->flash('status', 'Unautherized');
            return back();
        }

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
        //

        request()->validate([
            'name'     => 'required|min:4',
            'email'    => ['required', Rule::unique('users')->ignore($id)],
        ]);


        if(User::find($id)->update($request->all()))
            session()->flash('status', 'User updated successfully');
        else
            session()->flash('status', 'User updated failed');


        return $this->index();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::findOrFail($id);
        if ($user->delete()) {
            session()->flash('status', 'User deleted successfully');
        } else {
            session()->flash('status', 'Unable to delete user. Please try again');
        }

        return $this->index();
    }

    private function checkUser($id)
    {
        return (Auth::user()->authorizeRoles('admin')) || ($id == Auth::id());
    }
}
