<?php

namespace App\Http\Controllers;

use App\Services\Firebase;
use Illuminate\Http\Request;

class DatabaseController extends Controller
{
    protected $db;

    public function __construct()
    {
        $this->db = (new Firebase)->realtimeDatabase;
    }
    public function store(Request $request)
    {
        $ref = $this->db->getReference('users');

        // $ref->push([
        //     'status' => 'offline',
        //     'name' => 'ahmed'
        // ]);
        
        $ref->push($request->all());
        
        return response()->json();
    }
    public function index()
    {
        $ref = $this->db->getReference('users');

        // $users = $ref->getValue();
        // $users = $ref->orderByChild('status')->equalTo('offline')->limitToFirst(10)->getValue();
        // $users = $ref->orderByChild('status')->equalTo('online')->limitToLast(10)->getValue();
        // $users = $ref->orderByChild('age')->startAt('20')->limitToLast(10)->getValue();
        // $users = $ref->orderByChild('age')->equalTo('36')->limitToLast(10)->getValue();
        $users = $ref->orderByChild('age')->endAt('20')->limitToLast(10)->getValue();

        return response()->json(compact('users'));
    }
    public function update()
    {
        $ref = $this->db->getReference('users');
        $user = $ref->orderByChild('id')->equalTo('1')->getValue();
        // dd($user);
       
       
        $key = array_key_first($user);
        // dd($key);


        // $userRef = $this->db->getReference('users/'.$key);
        // $userRef->update([
        //     'status'=>'offline'
        // ]);

        $userRef = $this->db->getReference('users/'.$key.'/status');
        $userRef->set('online');

        return response()->json();
    }
    public function delete()
    {
        $ref = $this->db->getReference('users');
        // $ref->set(null);
        $user = $ref->orderByChild('id')->equalTo('2')->getValue();
       
        $key = array_key_first($user);

        $userRef = $this->db->getReference('users/'.$key);
        $userRef->remove();

        return response()->json(status:204);
    }


}
