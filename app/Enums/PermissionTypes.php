<?php

namespace App\Enums;

enum PermissionTypes: string
{
    case General = 'General';
    case CRUD = 'CRUD';
}
