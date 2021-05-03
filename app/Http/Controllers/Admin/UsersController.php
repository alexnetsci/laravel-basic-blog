<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Session;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function getUsers(Request $request)
    {
        if ($request->ajax())
        {
            $output = '';
            $data = User::all();
            $total_row = $data->count();

            $data = [
                'table_data'  => $output,
                'total_data'  => $total_row
            ];

            echo json_encode($data);
        }
    }
}
