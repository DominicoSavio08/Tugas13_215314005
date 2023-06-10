<?php

namespace App\Controllers;

use App\Models\AsistenModel;

class AsistenController extends BaseController
{

    public function index()
    {
        $model1 = model(LoginModel::class);
        $session = session();
        if ($session->has('pengguna')) {
            $item = $session->get('pengguna');
            if ($model1->where('username', $item)) {
                $model = model(AsistenModel::class);
                $data = [
                    'list' => $model->getAsisten(),
                    'title' => 'Daftar Asisten'
                ];
                return view('asisten/AsistenView', $data);
            } else {
                return view('asisten/login');
            }
        } else {
            return view('asisten/login');
        }
    }

    public function simpan()
    {
        helper('form');

        if (!$this->request->is('post')) {
            return view('/asisten/simpan');
        }

        $post = $this->request->getPost([
            'nim', 'nama', "praktikum",
            "ipk"
        ]);
        // Mengakses Model untuk menyimpan data
        $model = model(AsistenModel::class);
        $model->simpan($post);
        return view('/asisten/success');
    }

    public function update()
    {
        $db = \config\Database::connect();
        $Builder = $db->table('asisten');

        helper('form');

        if (!$this->request->is('post')) {
            return view('/asisten/update');
        }
        $data = [
            'nama' => [$this->request->getPost('nama')],
            'praktikum' => [$this->request->getPost('praktikum')],
            'ipk' => [$this->request->getPost('ipk')]
        ];
        $Builder->where('nim', $this->request->getPost('nim'));
        $Builder->update($data);
        return view('/asisten/success');
    }

    public function delete()
    {
        $db = \config\Database::connect();
        $Builder = $db->table('asisten');

        helper('form');
        if (!$this->request->is('post')) {
            return view('/asisten/delete');
        }
        $nim = $this->request->getPost('nim');

        $result = $Builder->getWhere(['nim' => $nim])->getResult();
        if (count($result) == 0) {
            return "NIM tidak ditemukan.";
        }

        $Builder->where('nim', $nim);
        $Builder->delete();
        return view('/asisten/hapus');
    }

    public function search()
    {
        if (!$this->request->is('post')) {
            return view('/asisten/search');
        }
        $nim = $this->request->getPost('key');

        $model = model(AsistenModel::class);
        $asisten = $model->ambil($nim['key']);

        $data = ['hasil' => $asisten];
        return view('asisten/search', $data);
    }

    public function check()
    {
        $model1 = model(AsistenModel::class);
        $data = [
            'list' => $model1->getAsisten(),
            'title' => 'Daftar Asisten'
        ];
        $model = model(LoginModel::class);
        $post = $this->request->getPost(['usr', 'pwd']);
        $user = $model->where('username', $post['usr'])->first();
        $pass = $model->where('password', $post['pwd'])->first();
        if ($user && $pass) {
            $session = session();
            $session->set('pengguna', $post['usr']);
            return view('asisten/AsistenView', $data);
        } else {
            return view('login/fail');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy('');
        return view('asisten/login');
    }
}
