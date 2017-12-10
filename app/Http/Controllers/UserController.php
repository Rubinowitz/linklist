<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::latest()->paginate();
        return view('users.all', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, $this->rules(null));

        return $this->save($request, null);
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
        $user = User::findOrFail($id);
        return view('users.update', compact('user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user)
    {
        //
        $user->delete();
        $this->validate($request, $this->rules($user));

        return $this->save($request, $user);
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

        return back();
    }

    /**
     * @param null $user
     * @return array
     */
    private function rules($user) {
        $rules = [
            'name'     => 'required|min:4',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8'
        ];
        if ($user) {
            $rules['email']    = 'required|email|unique:users,id,'.$user['id'];
            $rules['password'] = 'sometimes|min:8';
        }
        return $rules;
    }

    /**
     * @param $request
     * @param null $user
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    private function save($request, $user) {
        $status = "update";
        if (!$user) {
            $user = new User;
            $status = "create";
        }
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->has('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        if ($user->save()) {
            session()->flash('status', 'User '.$status.'d successfully');
            return redirect(url('users'));
        }
        session()->flash('status', 'Unable to '.$status.' user. Please try again');
        return back()->withInput();
    }
}
