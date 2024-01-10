<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use App\Models\AdminModel;
use CodeIgniter\HTTP\Files\UploadedFile;

class AnggotaController extends BaseController
{
    public function index()
    {
        $anggotaModel = new AnggotaModel();

        // Periksa role user
        if (session('role') != 'admin') {
            // Ambil ID anggota dari sesi pengguna yang sedang aktif
            $loggedinid_anggota = $anggotaModel->select('id_anggota_baru')->where('id_anggota_baru', session('id_user'))->first();

            // Periksa apakah ID anggota ditemukan
            if (!$loggedinid_anggota) {
                return redirect()->to('/anggota')->with('error', 'Data anggota tidak ditemukan');
            }

            // Redirect langsung ke halaman detail anggota yang sedang login
            return redirect()->to('/anggota-detail/' . $loggedinid_anggota['id_anggota_baru']);
        }

        // Jika role adalah admin, tampilkan semua anggota
        $anggota = $anggotaModel->select('id_anggota_baru,nama_lengkap, nim, jurusan, email, no_telepon, pas_foto, posisi')
            ->where('nim >', 1)
            ->get()
            ->getResult();

        $data['anggota'] = $anggota;
        return view('anggota/anggota_view', $data);
    }


    public function detail($id)
    {
        $anggotaModel = new AnggotaModel();
        $anggota = $anggotaModel->where('id_anggota_baru', $id);
        $data['anggota'] = $anggota->get()->getResult();

        // Check if the record was found
        if ($data['anggota'] === null) {
            return redirect()->to('/anggota')->with('error', 'Data tidak ditemukan');
        }

        return view('anggota/anggota_detail_view', $data);
    }

    public function add()
    {
        return view("anggota/anggota_add_view");
    }

    public function save()
    {
        $anggotaModel = new AnggotaModel();		
		//tambahan ke admin
		$adminModel = new AdminModel();

        $nama_lengkap = $this->request->getPost("nama_lengkap");
        $jurusan = $this->request->getPost("jurusan");
        $nim = $this->request->getPost("nim");
        $tempat_lahir = $this->request->getPost("tempat_lahir");
        $tanggal_lahir = $this->request->getPost("tanggal_lahir");
        $jenis_kelamin = $this->request->getPost("jenis_kelamin");
        $agama = $this->request->getPost("agama");
        $email = $this->request->getPost("email");
        $no_telepon = $this->request->getPost("no_telepon");
        $alamat = $this->request->getPost("alamat");
        $posisi = $this->request->getPost("posisi");
        $pas_foto = $this->request->getFile("pas_foto");
		//tambahan untuk data ke tabel admin
		$Username = $this->request->getPost("nim");
		$Password = '123456789';

        $rules = [
            'nama_lengkap' => 'required|string',
            'jurusan' => 'required|string',
            'nim' => 'required|numeric',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|valid_date',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'email' => 'required|valid_email',
            'no_telepon' => 'required|numeric',
            'alamat' => 'required|string',
            'posisi' => 'required|string',
            'pas_foto' => 'uploaded[pas_foto]|max_size[pas_foto,1024]|is_image[pas_foto]',
        ];
		//tambahan baru untuk masukan data ke admin
		$adminData = [
            'Username' => $nim,
            'Password' => password_hash('123456789', PASSWORD_DEFAULT),
            'Role' => 'anggota',
        ];
        $adminModel->insert($adminData);

        if (!$this->validate($rules)) {
            return redirect()->to('/anggota')->with('error', 'Gagal menyimpan data');
        }

        $newName = $this->moveUploadedFile($pas_foto);

        if (!$newName) {
            return redirect()->to('/anggota')->with('error', 'Gagal mengunggah gambar');
        }

        $data = [
            'nama_lengkap' => $nama_lengkap,
            'jurusan' => $jurusan,
            'nim' => $nim,
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => $tanggal_lahir,
            'jenis_kelamin' => $jenis_kelamin,
            'agama' => $agama,
            'email' => $email,
            'no_telepon' => $no_telepon,
            'alamat' => $alamat,
            'posisi' => $posisi,
            'pas_foto' => $newName
        ];

        try {
            $anggotaModel->insert($data);
            return redirect()->to('/anggota'); // ini akan ditampilkan ketika user non admin halaman tambah user merupakan halaman utama user non admin (anonymous), ketika user admin akan di tampilkan halaman utama dashboard 
        } catch (\Exception $e) {
            return redirect()->to('/anggota')->with('error', 'Gagal memasukkan data' . $e);
        }
    }

    public function edit($id)
    {
        $anggotaModel = new AnggotaModel();
        $data['anggota'] = $anggotaModel->find($id);

        if (empty($data['anggota'])) {
            return redirect()->to('/anggota')->with('error', 'Data tidak ditemukan');
        }

        return view('anggota/anggota_edit_view', $data);
    }

    public function update($id)
    {
        $anggotaModel = new AnggotaModel();
        $anggota = $anggotaModel->find($id);

        if (empty($anggota)) {
            return redirect()->to('/anggota')->with('error', 'Data tidak ditemukan');
        }

        $nama_lengkap = $this->request->getPost("nama_lengkap");
        $jurusan = $this->request->getPost("jurusan");
        $nim = $this->request->getPost("nim");
        $tempat_lahir = $this->request->getPost("tempat_lahir");
        $tanggal_lahir = $this->request->getPost("tanggal_lahir");
        $jenis_kelamin = $this->request->getPost("jenis_kelamin");
        $agama = $this->request->getPost("agama");
        $email = $this->request->getPost("email");
        $no_telepon = $this->request->getPost("no_telepon");
        $alamat = $this->request->getPost("alamat");
        $posisi = $this->request->getPost("posisi");

        $pas_foto = $this->request->getFile("pas_foto");

        $rules = [
            'nama_lengkap' => 'required',
            'jurusan' => 'required',
            'nim' => 'required|numeric',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|valid_date',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'email' => 'required|valid_email',
            'no_telepon' => 'required',
            'alamat' => 'required|string',
            'posisi' => 'required|string',
            //'pas_foto' => 'uploaded[pas_foto]|max_size[pas_foto,1024]|is_image[pas_foto]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('error', 'Periksa kembali form yang anda masukkan');
            // return redirect()->back()->with('error', $this->validator->getErrors()->string());
        }

        $data = [
            'nama_lengkap' => $nama_lengkap,
            'jurusan' => $jurusan,
            'nim' => $nim,
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => $tanggal_lahir,
            'jenis_kelamin' => $jenis_kelamin,
            'agama' => $agama,
            'email' => $email,
            'no_telepon' => $no_telepon,
            'alamat' => $alamat,
            'posisi' => $posisi,
        ];

        // Proses unggahan gambar baru jika ada
        if ($pas_foto->isValid()) {
            $newName = $this->moveUploadedFile($pas_foto);

            if (!$newName) {
                return redirect()->to('/anggota' . $id)->with('error', 'Gagal mengunggah gambar');
            }

            $data['pas_foto'] = $newName;

            // Hapus gambar lama
            $this->deleteOldImage($anggota['pas_foto']);
        }

        $anggotaModel->update($id, $data);

        return redirect()->to('/anggota')->with('success', 'Data berhasil diupdate'); //tampilan admin
    }

    public function delete($id)
    {
        $anggotaModel = new anggotaModel();
        $anggota = $anggotaModel->find($id);
        $nim = $anggota['nim'];

        $datauser = new AdminModel();
        $datauser->where('Username', $nim);
        $datauser->delete($datauser->id);

        if (empty($anggota)) {
            return redirect()->to('/dashboard')->with('error', 'Data tidak ditemukan');
        }

        $anggotaModel->delete($id);

        // Hapus gambar terkait
        $this->deleteOldImage($anggota['pas_foto']);

        return redirect()->to('/anggota')->with('success', 'Data berhasil dihapus');
    }

    public function updatepassword($id){
        $oldinputpassword = $this->request->getPost('password_lama');
        $newinputpassword = $this->request->getPost('new_password');
        $confirmnewpassword = $this->request->getPost('confirm_new_password');
    
        $anggotaModel = new AnggotaModel(); // Pastikan penulisan model sesuai dengan kapitalisasi yang benar
        $user = $anggotaModel->find($id);
    
        if (empty($user)) {
            return redirect()->back()->with('error', 'User tidak ditemukan');
        }
    
        $adminModel = new AdminModel();
        $adminData = $adminModel->where('Username', $user['nim'])->get()->getRow();
    
        if (!$adminData) {
            return redirect()->back()->with('error', 'Data admin tidak ditemukan');
        }
    
        $oldpassword = $adminData->Password;
    
        // Verifikasi password lama
        if (!password_verify($oldinputpassword, $oldpassword)) {
            return redirect()->back()->with('error', 'Password lama tidak sesuai');
        }
    
        // Verifikasi password baru
        if ($newinputpassword != $confirmnewpassword) {
            return redirect()->back()->with('error', 'Password baru tidak cocok');
        }
    
        // Update password baru
        $hashedNewPassword = password_hash($newinputpassword, PASSWORD_DEFAULT);
        $adminModel->update($adminData->nim, ['Password' => $hashedNewPassword]);
    
        return redirect()->back()->with('success', 'Password berhasil diperbarui');
    }
    

    protected function moveUploadedFile(UploadedFile $file)
    {
        $customUploadPath = 'public/assets/images/uploads/pas'; // Ganti dengan direktori penyimpanan yang Anda inginkan

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . $customUploadPath, $newName);
            return '/assets/images/uploads/pas/' . $newName;
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
