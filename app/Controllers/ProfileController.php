<?php

namespace App\Controllers;

use App\Models\Role;
use App\Models\User;

class ProfileController extends BaseController
{
    public function __construct()
    {
        $this->User = new User();
    }

    public function show($id)
    {
        $user = $this->User->getUserDetail($id)->first();
        if (!$user) {
            return redirect()->to('/404');
        }
        $data = [
            'title' => 'Profile',
            'header' => 'User Profil',
            'user' => $user
        ];
        return view('users/profile', $data);
    }

    public function edit($id)
    {
        if (session('id') != $id) {
            return redirect()->to('/403');
        }
        $roles = new Role();
        $data = [
            'title' => 'Profile',
            'header' => 'Edit Profile',
            'user' => $this->User->getUserDetail($id)->first(),
            'validation' => service('validation'),
            'roles' => $roles->findAll()
        ];
        return view('users/edit_profile', $data);
    }

    public function update($id)
    {
        if (session('id') != $id) {
            return redirect()->to('/403');
        }
        if (!$this->validate($this->_profileRules($id))) {
            return redirect()->to('/profile/edit/' . $id)->withInput();
        }

        // dd($this->request->getPost());
        $data = [
            'id' => $id,
            'role_id' => $this->request->getPost('role_id'),
            'username' => $this->request->getPost('username'),
            'display_name' => $this->request->getPost('display_name'),
            'email' => $this->request->getPost('email') ? $this->request->getPost('email') : null,
            'phone' => $this->request->getPost('phone') ? $this->request->getPost('phone') : null,
        ];
        $this->User->save($data);

        session()->setFlashdata('success', 'Profil berhasil diubah!');
        return redirect()->to('/profile//' . $id);
    }

    public function editpass($id)
    {
        $data = [
            'title' => 'Profile',
            'header' => 'Change Password',
            'validation' => service('validation'),
            'user' => $this->User->find($id)
        ];
        return view('users/change_password', $data);
    }

    public function changepass($id)
    {
        if (!$this->validate($this->_passwordRules())) {
            return redirect()->to('/profile/changepass/' . $id)->withInput();
        }

        // check current password
        $old_password = $this->request->getPost('current');
        $user = $this->User->find($id);
        if (!password_verify($old_password, $user['password'])) {
            session()->setFlashdata('error', 'Wrong current password!');
            return redirect()->to('/profile/changepass/' . $id)->withInput();
        }

        // dd($this->request->getPost());
        $this->User->update($id, ['password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)]);

        session()->setFlashdata('success', 'Password berhasil diubah!');
        return redirect()->to('/profile//' . $id);
    }

    private function _profileRules($id = null)
    {
        return [
            'username' => [
                'rules' => "required|is_unique[users.username,id,$id]",
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'is_unique' => '{field} sudah dipakai!'
                ]
            ],
            'display_name' => [
                'label' => 'name',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi!',
                ]
            ],
            'role_id' => [
                'label' => 'role',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi!'
                ]
            ],
        ];
    }

    private function _passwordRules()
    {
        return [
            'current' => [
                'label' => 'current password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi!'
                ]
            ],
            'password' => [
                'label' => 'new password',
                'rules' => 'required|min_length[4]',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'min_length' => '{field} terlalu pendek! (minimal 4 karakter)'
                ]
            ],
            'confirmation' => [
                'label' => 'confirm password',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'matches' => '{field} tidak cocok!'
                ]
            ],
        ];
    }

    //--------------------------------------------------------------------

}
