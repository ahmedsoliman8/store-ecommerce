<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 9/19/2020
 * Time: 5:21 PM
 */

namespace App\Http\Interfaces;


interface RepositoryInterface
{
    public  function all();
    public  function create (array  $data);
    public  function update(array  $data,$id);
    public  function delete($id);
    public  function  show($id);


}
