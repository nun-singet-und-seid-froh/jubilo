<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Role;
use Illuminate\Support\Facades\Log;
use Auth;

class AdminController extends Controller
{
    public function showUsers() {
        $data['users'] = User::get();
        $data['roles'] = Role::get();
        return view('admin.showUsers', ['data' => $data]);
    }
    
    public function updateUsers(Request $request) {
        $admin = Auth::user();
        Log::info ('ADMIN ' . $admin['email'] . ' @@ updateUsers@AdminController ...');
        $updateUsers = json_decode($request['users'], true);
        foreach ( $updateUsers as $userID => $updateRoles ) {

            $user = User::where('id', $userID)->first();
            if ( $user ) {
                Log::info('user ' . $user['email'] . ' is getting roles ' . implode(" and ", $updateRoles));
                $user->roles()->sync( $updateRoles );

                $response = [
                    'status' => 'success',
                ];                  
            }
            else {
                $response = [
                    'status' => 'error',
                    'errors' => ['user no. ' . $userID . 'not found in database!'],
                ];
            }
        }
        


        
        return response()->json($response);
    }
}
