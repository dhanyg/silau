<?php

namespace App\Models;

use CodeIgniter\Model;

class Menu extends Model
{
    protected $table      = 'menu';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'display_name', 'type', 'url', 'icon', 'is_active'];

    public function searchMenu($keyword)
    {
        $model = new Menu();
        return $model->like('name', $keyword)
            ->orLike('display_name', $keyword);
    }
}
