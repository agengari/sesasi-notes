<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function index()
    {
        // Tampilkan halaman login
        return view('auth/login');
    }

    public function auth()
    {
        $session = session();
        $model = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $data = $model->where('user', $username)->first();

        if ($data) {
            if ($data['pass'] == $password) {
                $group_id = $this->getGroupIdForUser($data['user_id']); // Memanggil fungsi getGroupIdForUser
                $ses_data = [
                    'user_id'       => $data['user_id'],
                    'name'          => $data['name'],
                    'user'          => $data['user'],
                    'group_id'      => $group_id,
                    'logged_in'     => TRUE
                ];
                // dd($ses_data);
                $session->set($ses_data);
                return redirect()->to('/api/notes/');
            } else {
                $session->setFlashdata('msg', 'Wrong Password');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'Email not Found');
            return redirect()->to('/login');
        }
    }

    // Fungsi untuk mendapatkan group_id berdasarkan user_id
    private function getGroupIdForUser($user_id)
    {
        $db = \Config\Database::connect();
        $query = $db->table('auth_group_user')
            ->where('user_id', $user_id)
            ->get();

        // Pastikan hasil query ada
        if ($query->getResult()) {
            return $query->getRow()->group_id;
        } else {
            return 0; // Nilai default jika user tidak memiliki grup
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }

    public function register()
    {
        if ($this->request->getMethod() === 'post') {
            $validation = \Config\Services::validation();

            // Set aturan validasi untuk proses registrasi
            $validation->setRules([
                'name' => 'required',
                'username' => 'required|is_unique[users.user]',
                'password' => 'required|min_length[6]',
            ]);

            if ($validation->withRequest($this->request)->run()) {
                // Data dari formulir valid, lanjutkan dengan proses registrasi
                $userModel = new UserModel();
                $data = [
                    'name' => $this->request->getPost('name'),
                    'user' => $this->request->getPost('username'),
                    'pass' => $this->request->getPost('password'),
                ];
                $userModel->save($data);

                // Setelah menyimpan pengguna baru, tambahkan pengguna ke grup "user biasa" (group_id 3)
                $userId = $userModel->insertID();
                $userModel->addUserToGroup($userId);

                $session = session();
                $session->setFlashdata('success', 'Registration successful, please login with your account');
                return redirect()->to('/login');
            } else {
                // Validasi gagal, kembali ke halaman registrasi dengan pesan kesalahan
                return view('auth/register', ['validation' => $validation]);
            }
        }

        // Tampilkan halaman registrasi
        return view('auth/register');
    }
}
