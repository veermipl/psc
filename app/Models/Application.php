<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $guarded = [''];
    protected $table = 'application_member';

    public function user() {
        return $this->belongsTo(User::class, 'id', 'member_id');
    }

   public function busibessType() {
        return $this->belongsTo(BusinessTypes::class, 'application_type_id', 'id');

    }

    public function legalStatus(){
        return $this->belongsTo(LegalStatus::class, 'legal_status', 'id');
    }

    public function sectors(){
        return $this->belongsTo(Sector::class, 'sector', 'id');
    }
    public function corporate(){
        return $this->belongsTo(CorporateMemnership::class, 'membership_id', 'id');
    }



}