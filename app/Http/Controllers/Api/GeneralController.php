<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\City;
use App\Models\State;

class GeneralController extends Controller
{
    public function getStateList(){
        try {
            $state = State::where('country_id','101')->get();
            return $this->sendResponse($state, 'State retrieved successfully.');
        } catch (\Throwable $th) {
            return $this->sendError('Error.', ['error' => $th->getMessage()]);
        }
    }

    public function getCityList($id) {
        try {
            $city = City::where('state_id',$id)->get();
            return $this->sendResponse($city, 'City retrieved successfully.');
        } catch (\Throwable $th) {
            return $this->sendError('Error.', ['error' => $th->getMessage()]);
        }
    }

    
}
