<?php

namespace App\Controllers;

use App\Models\DashboardModel;
use CodeIgniter\HTTP\Files\UploadedFile;

class DashboardController extends BaseController
{
    public function index()
    {
        $dashboardModel = new DashboardModel();
        $data['dashboard'] = $dashboardModel->findAll();
        return view('dashboard/dashboard_view', $data);
    }


    public function save($field)
    {
        $dashboardModel = new DashboardModel();
   
        switch ($field) {
            case 'visi':
                $data = [
                    'visi' => $this->request->getPost('visi'),
                ];
                break;

            case 'misi':
                $data = [ 
                    'misi' => $this->request->getPost('misi'),
                ];
                break;
            case 'gambar':
                $dashboard_gambar = $this->request->getFile('dashboard_gambar');

                // Proses unggahan gambar
                $newName = $this->moveUploadedFile($dashboard_gambar);

                if (!$newName) {
                    return redirect()->to('/dashboard')->with('error', 'Gagal mengunggah gambar');
                }
                
                $data = ['dashboard_gambar'=>$newName,];
                break;
            default:
                throw new \RuntimeException('Invalid field');
                break;
        }        
        if (isset($data)) {
            $dashboardModel->insert($data);
            return redirect()->to('/dashboard')->with('success', 'Data berhasil ditambahkan');
        } else {
            return redirect()->to('/dashboard')->with('error', 'Invalid field');
        }
    }

    public function update($id, $field)
    {
        $dashboardModel = new DashboardModel();
        $dashboard = $dashboardModel->find($id);

        if (empty($dashboard)) {
            return redirect()->to('/dashboard')->with('error', 'Data tidak ditemukan');
        }

        $visi = $this->request->getPost('visi');
        $misi = $this->request->getPost('misi');
        $dashboard_gambar = $this->request->getFile('dashboard_gambar');

        switch ($field) {
            case 'visi':
                $data = [
                    'visi' => $visi
                ];
                break;
            case 'misi':
                $data = [
                    'misi' => $misi
                ];
                break;
            case 'gambar':
                if ($dashboard_gambar->isValid()) {
                    $newName = $this->moveUploadedFile($dashboard_gambar);

                    if (!$newName) {
                        return redirect()->to('/dashboard')->with('error', 'Gagal mengunggah gambar');
                    }

                    $data['dashboard_gambar'] = $newName;

                    // Hapus gambar lama
                    $this->deleteOldImage($dashboard['dashboard_gambar']);
                }
                break;
            default:
                return redirect()->to('/dashboard')->with('error', 'Field tidak ditemukan');
                break;
        }
        
        if (!empty($data)){
            $dashboardModel->update($id, $data);
        }else {
            return redirect()->to('/dashboard')->with('error', 'Data gagal diperbarui');
        }

        return redirect()->to('/dashboard')->with('success', 'Data berhasil diupdate');
    } 

    public function updateBatchVisi()
    {
        $dashboardModel = new DashboardModel();

        $visi = $this->request->getPost();
        $j = 1;

        foreach ($visi as $v => $vis) {   
            
            $id = explode("_",$v);
            if (count($id) == 3){
                $data['id_dashboard'] = $id['2'];
            }

            if (count($id) == 2){
                $updatedata['visi'] = $vis;
            }

            if($j % 2 == 0){
                // echo "id:".$data['id_dashboard'];
                // echo "visi:".$data['visi']."<br/>";
                $dashboardModel->update($data['id_dashboard'], $updatedata);
            }

            $j++;
        }

        return redirect()->to('/dashboard')->with('success', 'Data berhasil diupdate');
    }

    public function updateBatchMisi()
    {
        $dashboardModel = new DashboardModel();

        $misi = $this->request->getPost();
        $j = 1;

        foreach ($misi as $m => $mis) {   
            
            $id = explode("_",$m);
            if (count($id) == 3){
                $data['id_dashboard'] = $id['2'];
            }

            if (count($id) == 2){
                $updatedata['misi'] = $mis;
            }

            if($j % 2 == 0){
                // echo "id:".$data['id_dashboard'];
                // echo "visi:".$data['visi']."<br/>";
                $dashboardModel->update($data['id_dashboard'], $updatedata);
            }

            $j++;
        }

        return redirect()->to('/dashboard')->with('success', 'Data berhasil diupdate');
    }


    public function delete($id)
    {

        $dashboardModel = new DashboardModel();
        $dashboard = $dashboardModel->find($id);

        if (empty($dashboard)) {
            return redirect()->to('/dashboard')->with('error', 'Data tidak ditemukan');
        }

        $dashboardModel->delete($id);

        // Hapus gambar terkait
        $this->deleteOldImage($dashboard['dashboard_gambar']);

        return redirect()->to('/dashboard')->with('success', 'Data berhasil dihapus');
    }

    protected function moveUploadedFile(UploadedFile $file)
    {
        $customUploadPath = 'public/assets/images/uploads'; // Ganti dengan direktori penyimpanan yang Anda inginkan

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . $customUploadPath, $newName);
            return  '/assets/images/uploads/' . $newName;
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
