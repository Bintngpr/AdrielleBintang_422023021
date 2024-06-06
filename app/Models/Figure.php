<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use OpenApi\Annotations as OA;


/**
 * Class Figure.
 * 
 * @author  Bintang <adrielle.422023021@civitas.ukrida.ac.id>
 * 
 * @OA\Schema(
 *     description="Figure model",
 *     title="Figure model",
 *     required={"title", "author"},
 *     @OA\Xml(
 *         name="Figure"
 *     )
 * )
 */
class Figure extends Model
{
    // use HasFactory;
    use SoftDeletes;
    protected $table = 'figures';
    protected $fillable = [
        'title',
        'series',
        'publisher',
        'release_year',
        'category',
        'cover',
        'price',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];

    public function data_adder(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
