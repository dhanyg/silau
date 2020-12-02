<?php

namespace App\Controllers;

use App\Models\Role;
use App\Models\User;

class UserController extends BaseController
{
    public function __construct()
    {
        $this->Role = new Role();
        $this->User = new User();
    }
    public function index()
    {
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $user = $this->User->searchUser($keyword);
        } else {
            $user = $this->User->getAllUsers();
        }

        $currentPage = $this->request->getVar('page');
        $data = [
            'title' => 'User Management',
            'header' => 'Browse User',
            'users' => $user->orderBy('users.display_name')->paginate(5),
            'pager' => $user->pager,
            'currentPage' => $currentPage ? $currentPage : 1,
            'perPage' => 5
        ];
        return view('users/index', $data);
    }

    public function create()
    {
        $data = [
            'validation' => service('validation'),
            'title' => 'User Management',
            'header' => 'Add User',
            'roles' => $this->Role->orderBy('display_name', 'ASC')->findAll()
        ];
        return view('users/create', $data);
    }

    public function save()
    {
        if (!$this->validate('userRules')) {
            return redirect()->to('/users/create')->withInput();
        }

        $data = [
            'role_id' => $this->request->getPost('role_id'),
            'username' => $this->request->getPost('username'),
            'display_name' => $this->request->getPost('display_name'),
            'email' => $this->request->getPost('email') ? $this->request->getPost('email') : null,
            'phone' => $this->request->getPost('phone') ? $this->request->getPost('phone') : null,
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];
        $this->User->save($data);

        session()->setFlashdata('success', 'Berhasil menambahkan user!');
        return redirect()->to('/users');
    }

    public function detail($userID)
    {
        $data = [
            'title' => 'User Management',
            'header' => 'Detail User',
            'user' => $this->User->getUserDetail($userID)->first()
        ];
        return view('users/detail', $data);
    }

    public function edit($userID)
    {
        $data = [
            'title' => 'User Management',
            'header' => 'Edit User',
            'validation' => service('validation'),
            'user' => $this->User->getUserDetail($userID)->first(),
            'roles' => $this->Role->findAll()
        ];
        return view('users/edit', $data);
    }

    public function update($userID)
    {
        if (!$this->validate($this->_rules($userID))) {
            return redirect()->to('/users/edit/' . $userID)->withInput();
        }

        $data = [
            'id' => $userID,
            'role_id' => $this->request->getPost('role_id'),
            'username' => $this->request->getPost('username'),
            'display_name' => $this->request->getPost('display_name'),
            'email' => $this->request->getPost('email') ? $this->request->getPost('email') : null,
            'phone' => $this->request->getPost('phone') ? $this->request->getPost('phone') : null,
        ];
        $this->User->save($data);

        session()->setFlashdata('success', 'Data berhasil diubah!');
        return redirect()->to('/users/detail/' . $userID);
    }

    public function delete($userID)
    {
        $this->User->delete($userID);
        session()->setFlashdata('success', 'User berhasil dihapus!');
        return redirect()->to('/users');
    }

    public function reset($userID)
    {
        $data = [
            'title' => 'Reset Password',
            'validation' => service('validation'),
            'user' => $this->User->select('id, username, display_name')->find($userID)
        ];
        return view('users/reset', $data);
    }

    public function changepass($userID)
    {
        if (!$this->validate([
            'password' => 'required|min_length[4]',
            'confirmation' => 'required|matches[password]',
        ])) {
            return redirect()->to('/users/reset/' . $userID)->withInput();
        }

        $this->User->update($userID, ['password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)]);

        session()->setFlashdata('success', 'Password berhasil diubah!');
        return redirect()->to('/users/detail/' . $userID);
    }

    private function _rules($id = null)
    {
        return [
            'role_id' => [
                'label' => 'role',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} is required!'
                ]
            ],
            'username' => [
                'rules' => "required|is_unique[users.username,id,$id]",
                'errors' => [
                    'required' => '{field} is required!',
                    'is_unique' => '{field} already exist!',
                ]
            ],
            'display_name' => [
                'label' => 'display name',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} is required!'
                ]
            ],
        ];
    }

    //--------------------------------------------------------------------

}
