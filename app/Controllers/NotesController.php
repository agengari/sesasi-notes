<?php

namespace App\Controllers;

use \App\Models\NoteModel;
use \App\Models\UserModel;
use App\Controllers\BaseController;

class NotesController extends BaseController
{
    // Implementasi untuk menampilkan daftar catatan
    public function index()
    {
        $data['title'] = 'Sesasi Notes | Home';

        // Mengambil group_id dari sesi
        $session = session();
        $groupId = $session->get('group_id');

        // Menggunakan model, ambil catatan dari database
        $notesModel = new NoteModel();
        $data['notes'] = [];

        if ($groupId === "1") {
            // Jika pengguna adalah admin, tampilkan semua catatan
            $data['notes'] = $notesModel->findAll();
        } elseif ($groupId === "3") {
            // Jika pengguna adalah user biasa, tampilkan catatan sesuai user_id
            $userId = $session->get('user_id');
            $data['notes'] = $notesModel->where('user_id', $userId)->findAll();
        }

        // Mengambil data pengguna untuk mengaitkan dengan setiap catatan
        $userModel = new UserModel();
        $userNames = [];

        foreach ($data['notes'] as $note) {
            $user = $userModel->find($note['user_id']);
            $userNames[$note['user_id']] = $user['name'];
        }

        // Menambahkan data creator ke setiap catatan
        foreach ($data['notes'] as &$note) {
            $note['creator'] = $userNames[$note['user_id']];
        }

        // Tampilkan view
        return view('notes/index', $data);
    }

    // Implementasi untuk membuat catatan baru
    public function create()
    {
        if ($this->request->getMethod() === 'post') {
            $validation = \Config\Services::validation();
            $validation->setRules([
                'title' => 'required',
                'note' => 'required'
            ]);

            if ($validation->withRequest($this->request)->run()) {
                $notesModel = new NoteModel();
                $data = [
                    'user_id' => $this->request->getPost('user_id'),
                    'title' => $this->request->getPost('title'),
                    'note' => $this->request->getPost('note'),
                ];

                // Menggunakan model, tambahkan catatan ke database
                $notesModel->insert($data);

                // Setelah itu, arahkan pengguna ke halaman daftar catatan
                return redirect()->to('/api/notes');
            } else {
                return view('notes/create', ['validation' => $validation]);
            }
        }

        return view('notes/create');
    }

    public function show($id)
    {
        // Implementasi untuk menampilkan detail catatan
        // Menggunakan model, ambil catatan berdasarkan ID
        $notesModel = new NoteModel();
        $data['note'] = $notesModel->find($id);

        // Tampilkan view
        return view('notes/show', $data);
    }

    public function edit($id)
    {
        // Implementasi untuk mengedit catatan
        // Menggunakan model, ambil catatan berdasarkan ID
        $notesModel = new NoteModel();
        $data['note'] = $notesModel->find($id);

        // Tampilkan view edit catatan
        return view('notes/edit', $data);
    }

    // Implementasi untuk memperbarui catatan
    public function update($id)
    {
        if ($this->request->getMethod() === 'put') {
            $notesModel = new NoteModel();
            $data = [
                'title' => $this->request->getPost('title'),
                'note' => $this->request->getPost('note'),
            ];

            $notesModel->update($id, $data);

            return redirect()->to('api/notes');
        }
    }

    // Implementasi untuk menghapus catatan
    public function delete($id)
    {
        $notesModel = new NoteModel();
        $notesModel->delete($id);

        return redirect()->to('api/notes');
    }
}
