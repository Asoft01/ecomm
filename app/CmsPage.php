<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsPage extends Model
{
    use HasFactory;

    // public static function cmsUrls(){
    //     $cmsUrls = CmsPage::select('url')->where('status', 1)->get()->pluck('url')->toArray();
    //     return $cmsUrls;
    // }
}
