<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 9/19/2020
 * Time: 4:41 PM
 */

namespace App\Http\Enumerations;


use Spatie\Enum\Enum;

final class CategoryType extends Enum
{
    const  mainCategory=1;
    const subCategory=2;

}
