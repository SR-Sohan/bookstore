<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use CodeIgniter\API\ResponseTrait;

class AuthController extends BaseController
{
    protected $model;
    protected $session;
    use ResponseTrait;
    protected $format = 'json';
    public function __construct()
    {

        $this->session = session();
        $this->model = new UsersModel();
        helper("form");
        Header('Access-Control-Allow-Origin: *');
        Header('Access-Control-Allow-Headers: *');
        Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT,DELETE');
    }
    public function index()
    {
        if (!$this->request->is('post')) {
            return view("auth/login");
        }

        $email = $this->request->getPost('email');
        $pass = $this->request->getPost("password");
        $user = $this->model->where('email', $email)->first();
        if ($user) {
            if (password_verify($pass, $user['password'])) {
                $newdata = [
                    'id'  => $user['id'],
                    'username'  => $user['name'],
                    'email'     => $user['email'],
                    'role'     => $user['role'],
                    'logged_in' => true,
                ];

                $this->session->set($newdata);
                if ($user['role'] == 2) {
                    return redirect()->to("/admin");
                } elseif ($user['role'] == 1) {
                    return redirect()->to("/");
                } else {
                    return redirect()->to("/login");
                }
            } else {
                return redirect()->to("login");
            }
        }
    }

    public function register()
    {

        helper("request");
        if (!$this->request->is('post')) {
            return view("auth/register");
        }
        $data = [
            'name'  => $this->request->getPost('name'),
            'email'     => $this->request->getPost('email'),
            'role'     => '1',
            'password' =>  $this->request->getPost('password'),
            'active' => "1"
        ];
        if ($this->model->insert($data)) {
            return redirect()->to("login");
        } else {
            return redirect()->to("registration");
        }
    }

    public function logout(){
        $session = session();
        
        // Destroy the session
        $session->destroy();
        
        // Redirect to login or home page
        return redirect()->to('login');
    }
}
