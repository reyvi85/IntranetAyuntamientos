<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Phones\InterestPhoneResource;
use App\Http\Resources\Phones\InterestPhoneResourceCollection;
use App\Models\InterestPhone;
use App\Traits\DataAPI;
use Illuminate\Http\Request;

class InterestPhoneController extends Controller
{
    use DataAPI;

    public function index(Request $request){
        return InterestPhoneResourceCollection::make($this->getAllPhones(null, null, null));
    }

    public function show(InterestPhone $interestPhone){
        return InterestPhoneResource::make($interestPhone);
    }
}
