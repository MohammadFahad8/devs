<?php
namespace App\Contracts;
interface BookContract{

  public function fetchAll();

  public function fetchById($id);
}
