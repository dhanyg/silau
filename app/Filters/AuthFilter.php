<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function __construct()
    {
        // initialize database
        $this->db = \Config\Database::connect();
    }
    public function before(RequestInterface $request, $arguments = null)
    {
        // check user session
        $session_id = session('id');
        $session_name = session('name');
        $session_role = session('role');
        // if doesn't has session, redirect to login page
        if (!$session_id or !$session_name or !$session_role) {
            return redirect()->to('/');
        } else {
            // if has session, check role permission for accessing page
            $role_id = session('role');
            $segment = $request->uri->getSegment(1);
            $menu = $this->db->table('menu')->where('name', $segment)->get()->getRowArray();
            if (!$menu) {
                return redirect()->to('/404');
            } else {
                $menu_id = $menu['id'];
            }
            // if user doesn't has access, redirect to 403 page
            $has_access = $this->db->table('menu_roles')->where(['menu_id' => $menu_id, 'role_id' => $role_id])->get()->getRowArray();
            if (!$has_access) {
                return redirect()->to('/403');
            }
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
