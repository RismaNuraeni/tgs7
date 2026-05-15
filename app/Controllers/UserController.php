<?php
namespace App\Controllers;
use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {
        return view('users/index', [
            'title' => 'Manajemen User',
            'users' => (new UserModel())->findAll(),
        ]);
    }

    public function create()
    {
        return view('users/form', ['title' => 'Tambah User', 'user' => null]);
    }

    public function store()
    {
        if (!$this->validate([
            'username' => 'required|min_length[4]|is_unique[users.username]',
            'nama'     => 'required|min_length[3]',
            'password' => 'required|min_length[6]',
            'role'     => 'required|in_list[super_admin,bupati]',
        ])) {
            return redirect()->back()->withInput()
                ->with('error', implode('<br>', $this->validator->getErrors()));
        }

        (new UserModel())->insert([
            'username'   => $this->request->getPost('username'),
            'nama'       => $this->request->getPost('nama'),
            'email'      => $this->request->getPost('email'),
            'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'       => $this->request->getPost('role'),
            'is_active'  => 1,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to(base_url('users'))->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        $user = (new UserModel())->find($id);
        if (!$user) return redirect()->to(base_url('users'))->with('error', 'User tidak ditemukan.');
        return view('users/form', ['title' => 'Edit User', 'user' => $user]);
    }

    public function update(int $id)
    {
        $userModel = new UserModel();
        if (!$userModel->find($id)) return redirect()->to(base_url('users'))->with('error', 'User tidak ditemukan.');

        $data = [
            'nama'       => $this->request->getPost('nama'),
            'email'      => $this->request->getPost('email'),
            'role'       => $this->request->getPost('role'),
            'is_active'  => $this->request->getPost('is_active') ?? 1,
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        if ($pass = $this->request->getPost('password')) {
            $data['password'] = password_hash($pass, PASSWORD_DEFAULT);
        }

        $userModel->update($id, $data);
        return redirect()->to(base_url('users'))->with('success', 'User berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        if (session()->get('user_id') == $id) {
            return redirect()->to(base_url('users'))->with('error', 'Tidak bisa hapus akun sendiri.');
        }
        (new UserModel())->delete($id);
        return redirect()->to(base_url('users'))->with('success', 'User berhasil dihapus.');
    }

    public function toggleActive(int $id)
    {
        $model = new UserModel();
        $user  = $model->find($id);
        if (!$user) return $this->response->setJSON(['error' => 'Not found']);
        $model->update($id, ['is_active' => $user['is_active'] ? 0 : 1]);
        return $this->response->setJSON(['success' => true]);
    }
}