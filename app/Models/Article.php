<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id'
    ];


       /**
     * Get the products image.
     *
     * @return string
     */
    public function getImageUrl()
    {
        if (!empty($this->img)) {
            $image_url = asset('/storage/images/' . $this->img);
        } else {
            $image_url = asset('/storage/images/default.png');
        }
        return $image_url;
    }

}
