<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
 
class FirebaseController extends Controller
{
    public function index()
    {
        $firebase = (new Factory)
            ->withServiceAccount(__DIR__.'/ai-online-platform-firebase-adminsdk-vq30z-00959e602c.json')
            ->withDatabaseUri('https://ai-online-platform-default-rtdb.asia-southeast1.firebasedatabase.app/');
 
        $database = $firebase->createDatabase();
 
        $blog = $database
        ->getReference('blog');
 
        echo '<pre>';
        print_r($blog->getvalue());
        echo '</pre>';
    }
}