<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use Session;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$user = Auth::user();
        $users = User::all();

        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating/updating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage($id=0)
    {
        if (empty($id)) {
            $user = new User;
            $profile = new Profile;
            $user->profile = $profile;
        }

        return view('admin.users.manage')->with('user', $user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id = 0)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required',
            'avatar' => 'required|image',
            'about' => 'required',
            'facebook' => 'required',
            'youtube' => 'required'
        ]);

        if (empty($id)) {
            $user = new User;

        }
        else {
            $user = User::find($id);
            $profile= $user->profile;
        }

         if ($request->hasFile('avatar')) {
            $avatar = $request->avatar;
            $avatar_new_name = time().$avatar->getClientOriginalName();
            $avatar->move('uploads/users', $avatar_new_name);

        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        if (empty($id)) {
            $arr = array(
                'avatar' => $avatar_new_name,
                'about' => $request->about,
                'facebook' => $request->facebook,
                'youtube' => $request->youtube
            );
            $profile = new Profile($arr);

        }

        $user->save();
        $user->profile()->save($profile);

        Session::flash('Success', 'User saved successfully');

        return redirect()->route('users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
    }

    public function makeactive($id) {

    }
}
