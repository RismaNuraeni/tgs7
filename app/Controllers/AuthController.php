<?php
namespace App\Controllers;
use App\Models\UserModel;
use App\Models\AktivitasModel;

class AuthController extends BaseController
{
    public function login()
    {
        if (session()->get('logged_in')) {
            return redirect()->to(base_url('dashboard'));
        }
        return view('auth/login');
    }

    public function loginProcess()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        if (empty($username) || empty($password)) {
            return redirect()->back()->withInput()
                ->with('error', 'Username dan password wajib diisi.');
        }

        $userModel = new UserModel();
        $user = $userModel->where('username', $username)
                          ->where('is_active', 1)
                          ->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()
                ->with('error', 'Username atau password salah.');
        }

        session()->set([
            'logged_in' => true,
            'user_id'   => $user['id'],
            'username'  => $user['username'],
            'nama'      => $user['nama'],
            'role'      => $user['role'],
        ]);

        $logModel = new AktivitasModel();
        $logModel->insert([
            'user_id'    => $user['id'],
            'aksi'       => 'Login ke sistem',
            'ip_address' => $this->request->getIPAddress(),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to(base_url('dashboard'))
            ->with('success', 'Selamat datang, ' . $user['nama'] . '!');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'))
            ->with('success', 'Berhasil logout.');
    }
}