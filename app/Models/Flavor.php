<?php

namespace App\Models;

use App\Http\Enums\TamanhoEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Flavor
 *
 * @package App\Models
 * @method static find(string $id)
 * @method static create(array $array)
 * @method static select(string $string, string $string1, string $string2, string $string3)
 */
class Flavor extends Model
{
    use HasFactory;

    protected  $casts = [
        'tamanho' =>  TamanhoEnum::class
    ];

    protected $fillable = [
        'sabor',
        'preco',
        'tamanho'
    ];
}
