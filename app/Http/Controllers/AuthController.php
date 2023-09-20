<?php

namespace App\Http\Controllers;

use App\Services\Firebase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Auth\UserQuery;
use Kreait\Firebase\Exception\Auth\UserNotFound;

class AuthController extends Controller
{
    public $auth;
    public function __construct()
    {
        $this->auth = (new Firebase)->auth;
    }
    public function register(Request $request)
    {
        $this->auth->createUser([
            'email' => $request->email,
            'password' => $request->password,
        ]);

    }
    public function login(Request $request)
    {
        $user = $this->auth->signInWithEmailAndPassword($request->email, $request->password);
        // $login = $this->auth->signInWithRefreshToken('AMf-vBwi5fyjy_cbqTL8kYMFvQIUlo35nnw47OR109dYoEvnV17gt879Qhbb43yJfdjP6O68JVewQuwzVn_e_BPIOSihry01_yfVDb8um0IK0dX-L4kPWGOHLDySGzJ-nJEsZn8Y-IMbpDOc9bF_tQ2sYyF1hdXfo6RSFkm_tRmRBuD2QOVsgwAN26QKqd_JLKywBlDujCrU-a5OdLwdNwZ13bJwwWSORygO2BI7FWxC3rUcw0Q9pHU');
        // $login = $this->auth->signInAsUser('gyW2tz2BkFV0GIsDRGjx0WKBT2m1');
        // dd($login);
        return response()->json(['msg' => 'Logged In', 'user' => $user->data()]);
    }
    // public function update()
    // {
    //     $this->auth->updateUser('gyW2tz2BkFV0GIsDRGjx0WKBT2m1',
    //     [
    //         'email' => 'updated@mail.com',
    //         'password' => 'password'
    //     ]);
    //     return response()->json(['msg' => 'User Updated']);
        
    // }
    public function update(Request $request)
    {
        $this->auth->updateUser('gyW2tz2BkFV0GIsDRGjx0WKBT2m1',
        [
            'email' => $request->email,
            'password' => $request->password
        ]);
        return response()->json(['msg' => 'User Updated']);
        
    }
    public function disable()
    {
        $this->auth->disableUser('gyW2tz2BkFV0GIsDRGjx0WKBT2m1');
        return response()->json(['msg' => 'User Disabled']);
        
    }
    public function enable()
    {
        $this->auth->enableUser('gyW2tz2BkFV0GIsDRGjx0WKBT2m1');
        return response()->json(['msg' => 'User enabled']);
        
    }
    public function index()
    {
        // $users = $this->auth->listUsers();
        // // dd($users);
        // $users = collect($users);

        // $query = UserQuery::all()->with0ffset(1)->withLimit(100)->sortedBy(UserQuery::FIELD_CREATED_AT);
        // $users = $this->auth->queryUsers($query);
        
        
        $users = $this->auth->getUsers(['gyW2tz2BkFV0GIsDRGjx0WKBT2m1','2','3']);
        return response()->json(compact('users'));
    }
    public function show(Request $request)
    {
        try {
            $user = $this->auth->getUserByEmail($request->email);
        } catch (UserNotFound $th) {
            Log::info($th->getMessage());
            abort(404);
        }
        return response()->json(compact('user'));
    }
    public function delete()
    {
        // $user = $this->auth->deleteUser('');
        $user = $this->auth->deleteUsers(['vjt07aIQqNcqt021teO1S4bobAh1','gz7v1taKk5dJ2yCo2JuTi2924vJ3'],true);
        return response()->json();
    }
}
