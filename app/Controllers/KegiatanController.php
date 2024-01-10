<?php

namespace App\Controllers;

use App\Models\ImageKegiatan;
use App\Models\KegiatanModel;
use App\Controllers\BaseController;

use CodeIgniter\HTTP\Files\UploadedFile;


class KegiatanController extends BaseController
{
    public function index()
    {
        $kegiatanModel = new KegiatanModel();

        $imageModel = new ImageKegiatan();

        $data['kegiatan'] = $kegiatanModel
        ->select('kegiatan.*, gambar_kegiatan.*')
        ->join('gambar_kegiatan', 'kegiatan.id_kegiatan = gambar_kegiatan.id_kegiatan_table', 'left') // Menggunakan LEFT JOIN
        ->orderBy('kegiatan.id_kegiatan', 'ASC') 
        ->get()->getResultArray();

        $data['datakegiatan'] = $kegiatanModel->findAll();
        $data['dataimagekegiatan'] = $imageModel->findAll();

        return view('kegiatan/kegiatan_view', $data);
    }


    public function save()
    {
        $kegiatanModel = new KegiatanModel();

        $nama_kegiatan = $this->request->getPost('nama_kegiatan');
        $tanggal_kegiatan = $this->request->getPost('tanggal_kegiatan');
        $tempat_kegiatan = $this->request->getPost('tempat_kegiatan');
        $fotos = $this->request->getFileMultiple('foto_kegiatan');

        $rules = [
            'nama_kegiatan' => 'required|string',
            'tanggal_kegiatan' => 'required|valid_date',
            'tempat_kegiatan' => 'required|string',
            // 'foto_kegiatan' => 'uploaded[foto_kegiatan]|max_size[foto_kegiatan,1024]|is_image[foto_kegiatan]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/kegiatan')->with('error', 'Pastikan form terisi');
        }

        $data = [

            'nama_kegiatan' => $nama_kegiatan,
            'tanggal_kegiatan' => $tanggal_kegiatan,
            'tempat_kegiatan' => $tempat_kegiatan,
        ];

        $kegiatanModel->insert($data);

        $id_kegiatan = $kegiatanModel->getInsertID();

        $foto_kegiatan = new ImageKegiatan();

        try {
            if(!empty($foto)){
                foreach ($fotos as $foto) {
                    $newName = $this->moveUploadedFile($foto);
                    $foto_kegiatan->insert([
                        'foto_kegiatan' => $newName,
                        'id_kegiatan_table' => $id_kegiatan,
                    ]);
                }
            }
        } catch (\Exception $e) {
            if (!$newName) {
                return redirect()->to('/kegiatan')->with('error', 'Gagal mengunggah gambar');
            }
        }

        return redirect()->to('/kegiatan')->with('success', 'Data berhasil disimpan');

    }

    public function update($id)
    {
        $kegiatanModel = new KegiatanModel();
        $kegiatan = $kegiatanModel->find($id);

        if (empty($kegiatan)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['success' => false, 'message' => 'Data tidak ditemukan']);
            }

            return redirect()->to('/kegiatan')->with('error', 'Data tidak ditemukan');
        }


        $nama_kegiatan = $this->request->getPost('nama_kegiatan');
        $tanggal_kegiatan = $this->request->getPost('tanggal_kegiatan');
        $tempat_kegiatan = $this->request->getPost('tempat_kegiatan');

        $rules = [
            'nama_kegiatan' => 'required|string',
            'tanggal_kegiatan' => 'required|valid_date',
            'tempat_kegiatan' => 'required|string',
        ];

        if (!$this->validate($rules)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal menyimpan data']);
            }

            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data');
        }

        $data = [
            'nama_kegiatan' => $nama_kegiatan,
            'tanggal_kegiatan' => $tanggal_kegiatan,
            'tempat_kegiatan' => $tempat_kegiatan,
        ];

        $kegiatanModel->update($id, $data);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON(['success' => true, 'message' => 'Data berhasil diubah']);
        }

        return redirect()->to('/kegiatan')->with('success', 'Data berhasil diubah');
    }

    public function addnewimage($id)
    {
        $fotos = $this->request->getFileMultiple('foto_kegiatan');
        $rules = [
            'foto_kegiatan' => 'uploaded[foto_kegiatan]|max_size[foto_kegiatan,1024]|is_image[foto_kegiatan]',
        ];

        $foto_kegiatan = new ImageKegiatan();
        $fotos = $this->request->getFileMultiple('foto_kegiatan');

        try {
            foreach ($fotos as $foto) {
                $newName = $this->moveUploadedFile($foto); // Definisikan $newName di sini
                $foto_kegiatan->insert([
                    'foto_kegiatan' => $newName,
                    'id_kegiatan_table' => $id,
                ]);
            }
        } catch (\Exception $e) {
            if (!isset($newName) || !$newName) {
                return redirect()->to('/kegiatan')->with('error', 'Gagal mengunggah gambar');
            }
        }

        return redirect()->to('/kegiatan')->with('success', 'Data berhasil diubah');
    }


    public function updateKegiatanview($id)
    {
        $datakegiatan = new KegiatanModel();
        $data['datakegiatan'] = $datakegiatan->find($id);
        $gambar = new ImageKegiatan();
        $data['datagambarkegiatan'] = $gambar->where('id_kegiatan_table', $id)->get()->getResultArray();

        return view('kegiatan/kegiatan_update', $data);
    }

    public function updateGambarById($id)
    {
        $gambarModel = new ImageKegiatan();
        $gambar = $gambarModel->find($id);

        if (empty($gambar)) {
            return redirect()->to('/kegiatan')->with('error', 'Data tidak ditemukan');
        }

        $gambar_kegiatan = $this->request->getFile('foto_kegiatan');

        if ($gambar_kegiatan->isValid()) {
            $newName = $this->moveUploadedFile($gambar_kegiatan);

            if (!$newName) {
                return redirect()->to('/kegiatan')->with('error', 'Gagal mengunggah gambar');
            }

            $data['foto_kegiatan'] = $newName;

            // Hapus gambar lama
            $this->deleteOldImage($gambar['foto_kegiatan']);
        }

        $gambarModel->update($id, $data);

        return redirect()->to('/kegiatan')->with('success', 'Data berhasil diubah');
    }

    public function deleteGambarById($id)
    {

        $gambarModel = new ImageKegiatan();

        try {
            $gambar = $gambarModel->find($id);

            if (empty($gambar)) {
                return redirect()->to('/kegiatan')->with('error', 'Not Found !!');
            }
            $this->deleteOldImage($gambar['foto_kegiatan']);


            $gambarModel->delete($id);
        } catch (\Throwable $th) {
            return redirect()->to('/kegiatan')->with('error', 'Not Found !!');
        }


        return redirect()->to('/kegiatan')->with('success', 'Data berhasil dihapus');

    }

    public function delete($id)
    {
        $kegiatanModel = new KegiatanModel();
        $kegiatan = $kegiatanModel->find($id);

        if (empty($kegiatan)) {
            return redirect()->to('/kegitan')->with('error', 'Data tidak ditemukan');
        }

        //delete multiple file kegiatan
        $gambar = new ImageKegiatan();

        $get_gambar_names = $gambar->where('id_kegiatan_table', $id)->get()->getResult();

        foreach ($get_gambar_names as $gambar_name) {
            $this->deleteOldImage($gambar_name->foto_kegiatan);
        }

        $gambar->where('id_kegiatan_table', $id)->delete();

        $kegiatanModel->delete($id);

        return redirect()->to('/kegiatan')->with('success', 'Data berhasil dihapus');
    }

    protected function moveUploadedFile(UploadedFile $file)
    {
        $customUploadPath = 'public/assets/images/uploads/kegiatan/'; // Ganti dengan direktori penyimpanan yang Anda inginkan

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . $customUploadPath, $newName);
            return '/assets/images/uploads/kegiatan/' . $newName;
        }

        return null;
    }

    protected function deleteOldImage($filename)
    {
        $path = ROOTPATH . '/public' . $filename;
        if (is_file($path) && file_exists($path)) {
            unlink($path);
        }

    }
}


