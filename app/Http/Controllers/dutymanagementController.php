<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class dutymanagementController extends Controller
{
    public function managemntPage(){
        return view(
            'components/dutyassingment/dutymanagement',
          );
    }

    public function dutymanagementForm(){
        return view(
            'Forms/dutyAssingmentForm',
          );
    }

    public function editUserForm($id){
        return view(
            'Forms/editUserForm', compact('id')
          );
    }

}
