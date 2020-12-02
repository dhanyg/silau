<?php

namespace App\Controllers;

use App\Models\Role;

class RoleController extends BaseController
{
    public function __construct()
    {
        $this->Role = new Role();
    }

    public function index()
    {
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $role = $this->Role->like('name', $keyword)->orLike('display_name', $keyword);
        } else {
            $role = $this->Role;
        }

        $currentPage = $this->request->getVar('page');
        $data = [
            'title' => 'Roles Management',
            'header' => 'Browse Roles',
            'roles' => $role->orderBy('name', 'ASC')->paginate(5),
            'pager' => $role->pager,
            'currentPage' => $currentPage ? $currentPage : 1,
            'perPage' => 5
        ];
        return view('roles/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Roles Management',
            'header' => 'Add Role',
            'validation' => service('validation')
        ];
        return view('roles/create', $data);
    }

    public function save()
    {
        if (!$this->validate('roleRules')) {
            return redirect()->to('/roles/create')->withInput();
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'display_name' => $this->request->getPost('display_name'),
        ];
        $this->Role->save($data);

        session()->setFlashdata('success', 'Data berhasil disimpan!');
        return redirect()->to('/roles');
    }

    public function detail($roleID)
    {
        $data = [
            'title' => 'Roles Management',
            'header' => 'Role Detail',
            'role' => $this->Role->find($roleID)
        ];
        return view('roles/detail', $data);
    }

    public function edit($roleID)
    {
        $data = [
            'title' => 'Roles Management',
            'header' => 'Edit Role',
            'role' => $this->Role->find($roleID),
            'validation' => service('validation')
        ];
        return view('roles/edit', $data);
    }

    public function update($roleID)
    {
        if (!$this->validate($this->_rules($roleID))) {
            return redirect()->to('/roles/edit/' . $roleID)->withInput();
        }

        $data = [
            'id' => $roleID,
            'name' => $this->request->getPost('name'),
            'display_name' => $this->request->getPost('display_name')
        ];
        $this->Role->save($data);

        session()->setFlashdata('success', 'Data berhasil diubah!');
        return redirect()->to('/roles/detail/' . $roleID);
    }

    public function delete($roleID)
    {
        $this->Role->delete($roleID);
        session()->setFlashdata('success', 'Data berhasil dihapus!');
        return redirect()->to('/roles');
    }

    private function _rules($id = null)
    {
        return [
            'name' => [
                'label' => 'role name',
                'rules' => "required|regex_match[/^[a-z-]*$/]|is_unique[roles.name,id,$id]",
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
            ]
        ];
    }

    //--------------------------------------------------------------------

}
