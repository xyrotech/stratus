<?php

namespace Xyrotech\Stratus\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Xyrotech\Stratus\Models\File;

class SetupController extends Controller
{
    public function index(){

        try{
            if(Schema::hasTable('stratus_files')){
                return view('stratus::login');
            } else {
                return view('stratus::setup');
            }
        }catch (QueryException $exception){
            return view('stratus::setup');
        }


    }
}


