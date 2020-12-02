<?php

namespace App\Models;

use CodeIgniter\Model;

class Submenu extends Model
{
    protected $table      = 'submenu';
    protected $primaryKey = 'id';
    protected $allowedFields = ['menu_id', 'name', 'display_name', 'url', 'is_active'];

    public function getAllSubmenu()
    {
        $model = new Submenu();
        return $model
            ->select('submenu.*, menu.display_name as menu_name')
            ->join('menu', 'menu.id = submenu.menu_id');
    }

    public function searchSubmenu($keyword)
    {
        $model = new Submenu();
        return $model
            ->select('submenu.*, menu.display_name as menu_name')
            ->join('menu', 'menu.id = submenu.menu_id')
            ->like('menu.display_name', $keyword)
            ->orLike('menu.name', $keyword)
            ->orLike('submenu.name', $keyword)
            ->orLike('submenu.display_name', $keyword);
    }
}
