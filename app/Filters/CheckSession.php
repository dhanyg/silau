<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class CheckSession implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // check user session
        $session_id = session('id');
        $session_name = session('name');
        $session_role = session('role');
        // if doesn't has session, redirect to login page
        if (!$session_id or !$session_name or !$session_role) {
            return redirect()->to('/');
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
