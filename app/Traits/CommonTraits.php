<?php

namespace App\Traits;

use App\Models\MembershipType as MembershipTypeModel;

trait CommonTraits
{
    public function getMembershipType()
    {
        $list = MembershipTypeModel::orderBy('id', 'desc')->where('status', '1')->get();

        return $list;
    }
}
