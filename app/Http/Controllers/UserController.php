<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function index(){
        $response = Http::withHeaders([
            'api-token'=>'PrfBEWY3kWbcHQ586v2GDMpe75zGApMnidNjGpTucbmTKL6sRpLmmSnFFhfQIER1_nQ',
            'user-email'=>'rohit458285@gmail.com'
        ])->get('https://www.universal-tutorial.com/api/getaccesstoken');

        $data = (array)json_decode($response->body());

        //$data = (array)join($response->body());
        $auth_token = $data['auth_token'];



        $countryResponse = Http::withHeaders([
            'Authorization'=>'Bearer'.$auth_token,
        ])->get('https://www.universal-tutorial.com/api/countries/');

        $countries = (array)json_decode($countryResponse->body());


        return view('form',['token'=>$auth_token,'countries'=>$countries]);

    }

    public function getStates(Request $req){
        $stateResponse = Http::withHeaders([
            'Authorization'=>'Bearer'.$req->token,
        ])->get('https://www.universal-tutorial.com/api/states/'.$req->country);

        $states = $stateResponse->body();
        return $states;
    }

    public function getCites(Request $req){
        $citiesResponse = Http::withHeaders([
            'Authorization'=>'Bearer'.$req->token,
        ])->get('https://www.universal-tutorial.com/api/cities/'.$req->state);

        $cities = $citiesResponse->body();
        return $cities;
    }
}
