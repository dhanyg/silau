<?php

namespace App\Controllers;

use App\Models\Menu;

class MenuController extends BaseController
{
    public function __construct()
    {
        $this->Menu = new Menu();
    }
    public function index()
    {
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $menu = $this->Menu->searchMenu($keyword);
        } else {
            $menu = $this->Menu;
        }
        $currentPage = $this->request->getVar('page');
        $data = [
            'title' => 'Menu Management',
            'header' => 'Browse Menu',
            'all_menu' => $menu->orderBy('display_name', 'ASC')->paginate(5),
            'pager' => $menu->pager,
            'currentPage' => $currentPage ? $currentPage : 1,
            'perPage' => 5
        ];
        return view('menu/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Menu Management',
            'header' => 'Add Menu',
            'validation' => service('validation')
        ];
        return view('menu/create', $data);
    }

    public function save()
    {
        if (!$this->validate('menuRules')) {
            return redirect()->to('/tools/menu/create')->withInput();
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'display_name' => $this->request->getPost('display_name'),
            'type' => $this->request->getPost('type'),
            'url' => $this->request->getPost('url') ? $this->request->getPost('url') : null,
            'icon' => $this->request->getPost('icon') ? $this->request->getPost('icon') : null,
            'is_active' => ($this->request->getPost('is_active')) ? 1 : 0
        ];
        $this->Menu->save($data);

        session()->setFlashdata('success', 'Data berhasil ditambahkan!');
        return redirect()->to('/tools/menu');
    }

    public function edit($menuID)
    {
        $data = [
            'title' => 'Menu Management',
            'header' => 'Menu Detail',
            'menu' => $this->Menu->find($menuID),
            'validation' => service('validation')
        ];
        return view('menu/edit', $data);
    }

    public function update($menuID)
    {
        if (!$this->validate($this->_rules($menuID))) {
            return redirect()->to('/tools/menu/edit/' . $menuID)->withInput();
        }

        $data = [
            'id' => $menuID,
            'name' => $this->request->getPost('name'),
            'display_name' => $this->request->getPost('display_name'),
            'type' => $this->request->getPost('type'),
            'url' => $this->request->getPost('url') ? $this->request->getPost('url') : null,
            'icon' => $this->request->getPost('icon') ? $this->request->getPost('icon') : null,
            'is_active' => ($this->request->getPost('is_active')) ? 1 : 0
        ];
        $this->Menu->save($data);

        session()->setFlashdata('success', 'Data berhasil diubah!');
        return redirect()->to('/tools/menu');
    }

    public function delete($menuID)
    {
        $this->Menu->delete($menuID);
        session()->setFlashdata('success', 'Data berhasil dihapus!');
        return redirect()->to('/tools/menu');
    }

    private function _rules($id = null)
    {
        return [
            'name' => [
                'label' => 'menu name',
                'rules' => "required|regex_match[/^[a-z-]*$/]|is_unique[menu.name,id,$id]",
                'errors' => [
                    'required' => '{field} is required!',
                    'regex_match' => '{field} must be only lowercase letter and can contain dash (-).',
                    'is_unique' => '{field} already exist!'
                ]
            ],
            'display_name' => [
                'label' => 'display name',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} is required!'
                ]
            ],
            'type' => 'required',
        ];
    }

    //--------------------------------------------------------------------

}
