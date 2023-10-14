<?php

namespace App\Controllers;

use \App\Models\UserModel;
use App\Controllers\BaseController;

class UsersController extends BaseController
{
    public function index()
    {
        $data['title'] = 'Sesasi Notes | Daftar User';

        // Menggunakan model, ambil catatan dari database
        $usersModel = new UserModel();
        $data['users'] = $usersModel->findAll();

        // Tampilkan view
        return view('users/index', $data);
    }

    public function show($id)
    {
        // Implementasi untuk menampilkan detail user
        // Menggunakan model, ambil catatan berdasarkan ID
        $usersModel = new UserModel();
        $data['user'] = $usersModel->find($id);

        // Tampilkan view
        return view('users/user', $data);
    }

    public function update($id)
    {
    }

    public function delete($id)
    {
        $usersModel = new UserModel();
        $usersModel->delete($id);

        return redirect()->to('/api/users/');
    }
}
