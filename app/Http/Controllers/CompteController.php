<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use Illuminate\Http\Request;

class CompteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming update request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateUpdate(array $datas){
        $user = auth()->user();
        return \Illuminate\Support\Facades\Validator::make($datas, [
            'pseudo' => ['required', 'string', 'max:80', 'unique:nestix_utilisateur,pseudo_utilisateur,'.$user->id_utilisateur.',id_utilisateur'],
            'email' => ['required', 'string', 'email', 'max:190', 'unique:nestix_utilisateur,email_utilisateur,'.$user->email_utilisateur.',email_utilisateur'],
            'dob' => ['nullable', 'date']
        ]);
    }
    /**
     * Get a validator for an incoming update request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validatePassword(array $datas){
        return \Illuminate\Support\Facades\Validator::make($datas, [
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
    }


    /**
     * Show the editing form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(){
        $user = auth()->user();
        $collections = $user->collections;
        return view('compte', compact('user', 'collections'));
    }

    /**
     * Update the user
     *
     * @return Response
     */
    public function update(Request $request){
        $datas = $request->all();

        $validator = CompteController::validateUpdate($datas);

        // dd($validator->messages());
        if($validator->fails()){
            return redirect(route('profil'))->withErrors($validator->errors());
        }else{
            $user = auth()->user();
            $user->update([
                'pseudo_utilisateur' => $datas['pseudo'],
                'email_utilisateur' => $datas['email'],
                'dob_utilisateur' => $datas['dob']
            ]);
            return redirect(route('profil'));
        }
    }
    /**
     * Update the password user
     *
     * @return Response
     */
    public function updatePassword(Request $request){
        $datas = $request->all();

        $validator = CompteController::validatePassword($datas);

        if($validator->fails()){
            return redirect(route('profil'))->withErrors($validator->errors());
        }else{
            $user = auth()->user();
            $user->update([
                'mdp_utilisateur' => \Illuminate\Support\Facades\Hash::make($datas['password'])
            ]);

            return redirect(route('profil'));
        }
    }

}
