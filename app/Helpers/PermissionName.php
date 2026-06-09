<?php

namespace App\Helpers;

use App\Models\Permission;

class PermissionName
{
  public static function Verify($name)
  {
      $returnValue = '';
      if (in_array($name, Permission::ResourcesNames))
      {
          $returnValue = $name;
      }
      else
      {
          $returnValue = 'Error';
        //   throw new \Exception("Permission Name Not Found");
      }
      return $returnValue;
  }
}
