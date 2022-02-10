<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Phones\InterestPhoneResource;
use App\Http\Resources\Phones\InterestPhoneResourceCollection;
use App\Models\InterestPhone;
use App\Traits\DataAPI;
use App\Traits\DataAPIFront;
use Illuminate\Http\Request;

class InterestPhoneController extends Controller
{
    use DataAPIFront;

    public function index(Request $request){
        return InterestPhoneResourceCollection::make($this->getAllPhones($request->search, $request->sort, $request->perPage));
    }

    public function show(Request $request){
        $interestPhone =$this->getPhone($request->interestPhone);
        return InterestPhoneResource::make($interestPhone);
    }
}
