<?php

use App\Models\MenuRole;

function checkAccess($menuId, $roleId)
{
    $menuRole = new MenuRole();
    $cek = $menuRole->where(['menu_id' => $menuId, 'role_id' => $roleId])->first();
    if ($cek)
    {
        return true;
    }
    return false;
}
