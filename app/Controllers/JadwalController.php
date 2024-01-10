<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JadwalModel;

class JadwalController extends BaseController
{
    public function index()
    {
        $jadwal = new JadwalModel;
        try {
            $data['jadwals'] = $jadwal->findAll();
        } catch (\Exception $e) {
            return view('jadwal/jadwal_view');
        }
        return view('jadwal/jadwal_view', $data);
    }

    public function add()
    {
        return view('jadwal/jadwal_add_view');
    }
    public function save()
    {
        $jadwalModel = new JadwalModel();

        $pengumuman = $this->request->getPost('pengumuman');
        $tanggal_jadwal = $this->request->getPost('tanggal_jadwal');
        $keterangan = $this->request->getPost('keterangan');

        $rules = [
            'pengumuman' => 'required',
            'tanggal_jadwal' => 'required',
            'keterangan' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/jadwal')->with('error', 'Semua bidang harus diisi dan gambar harus diunggah dengan benar');
        }

        $data = [
            'pengumuman' => $pengumuman,
            'tanggal_jadwal' => $tanggal_jadwal,
            'keterangan' => $keterangan,
        ];

        $jadwalModel->insert($data);


        return redirect()->to('/jadwal')->with('success', 'data berhasil disimpan');

    }
    //public function detail($id){

    // }
    public function edit($id)
    {
        $jadwalModel = new JadwalModel();
        $data['jadwal'] = $jadwalModel->find($id);

        if (empty($data['jadwal'])) {
            return redirect()->to('/jadwal')->with('error', 'Data tidak ditemukan');
        }

        return view('jadwal/jadwal_edit_view', $data);
    }

    public function update($id)
    {
        $jadwalModel = new JadwalModel();
        $jadwal = $jadwalModel->find($id);

        if (empty($jadwal)) {
            return redirect()->to('/jadwal')->with('error', 'Data tidak ditemukan');
        }

        $pengumuman = $this->request->getPost('pengumuman');
        $tanggal_jadwal = $this->request->getPost('tanggal_jadwal');
        $keterangan = $this->request->getPost('keterangan');

        $rules = [
            'pengumuman' => 'required',
            'tanggal_jadwal' => 'required',
            'keterangan' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        $data = [
            'pengumuman' => $pengumuman,
            'tanggal_jadwal' => $tanggal_jadwal,
            'keterangan' => $keterangan,
        ];

        $jadwalModel->update($id, $data);

        return redirect()->to('/jadwal')->with('success', 'Data berhasil diupdate');
    }

    public function doneKegiatan($id)
    {
        $jadwal_model = new JadwalModel();
        $jadwal = $jadwal_model->find($id);

        $data = [
            'pengumuman' => $jadwal['pengumuman'],
            'tanggal_jadwal' => $jadwal['tanggal_jadwal'],
            'keterangan' => $jadwal['keterangan'],
            'status' => 'Terlaksana',
        ];

        $jadwal_model->update($id, $data);

        return redirect()->to('jadwal');
    }

    public function delete($id)
    {
        $jadwalModel = new JadwalModel();
        $data['jadwal'] = $jadwalModel->find($id);

        if (empty($data['jadwal'])) {
            return redirect()->to('/jadwal')->with('error', 'Data tidak ditemukan');
        }

        $jadwalModel->delete($id);

        return redirect()->to('/jadwal')->with('success', 'Data berhasil dihapus');
    }
}
