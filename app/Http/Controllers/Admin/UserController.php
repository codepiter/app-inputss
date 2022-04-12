<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = User::where('user_type_id', 1)->paginate();
        $users = User::where('user_type_id', 2)->paginate();

        return view('inputlinks.users.index', compact('users', 'admins'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user)
    {
        $msj = '';
        if ($user->user_type_id == 1) {
            $user->user_type_id = 2;
            $user->nimda_si = 0;
            //$msj = 'El usuario \''.$user->email.'\' se actualizo a Cliente correctamente.';
            $msj = __('messages.advertisements.controller.user.update1', ['user_email' => $user->email]);
        }else{
            $user->user_type_id = 1;
            $user->nimda_si = 1;
            //$msj = 'El usuario \''.$user->email.'\' se actualizo a Administrador correctamente.';
            $msj = __('messages.advertisements.controller.user.update2', ['user_email' => $user->email]);
        }
        $user->save();

        // Si un mismo usuario se removio el rol de administrador, se redirigue a la vista home.
        if (\Auth::user()->id == $user->id && \Auth::user()->isAdmin()) {
            return redirect()->route('home');
        }

        return redirect()->route('admin.user.index')->with('status', $msj);
    }

    public function updateState (User $user){
        
        $this->authorize('updateState', User::class);

        $user->status = !$user->status;

        $user->save();

        $msj = "El usuario $user->email se actualizo el estado correctamente.";

        return redirect()->route('admin.user.index')->with('status', $msj);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //$msj = 'El usuario \''.$user->email.'\' se elimino correctamente.';
        $msj = __('messages.advertisements.controller.user.destroy', ['user_email' => $user->email]);
        $user->delete();

        return redirect()->route('admin.user.index')->with('status', $msj);
    }
}
