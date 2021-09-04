<?php
namespace App\Traits;

use App\Models\Community;

trait CommunityProvince {

    public function getComunidades(){
        return Community::withCount('provincias')->get();
    }

}
