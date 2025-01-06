<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class ReportController extends ResourceController
{
    protected $modelName = 'App\\Models\\ReportModel';
    protected $format    = 'json';

    public function create()
    {
        $rules = [
            'problem_type'  => 'required',
            'description'   => 'required',
            'room_location' => 'required',
            'photo'         => 'uploaded[photo]|max_size[photo,2048]|is_image[photo]', 
        ];
    
        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }
    
        $userId = $this->getUserIdFromToken(); // Ambil user_id dari token
        if (!$userId) {
            return $this->failUnauthorized('Invalid or missing token.');
        }
    
        $file = $this->request->getFile('photo');
        if ($file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move('uploads', $fileName);
            $photoPath = 'uploads/' . $fileName;
        } else {
            return $this->fail('Error uploading photo.');
        }
    
        $data = [
            'problem_type'   => $this->request->getPost('problem_type'),
            'description'    => $this->request->getPost('description'),
            'room_location'  => $this->request->getPost('room_location'),
            'photo'          => $photoPath,
            'status'         => 'pending',
            'user_id'        => $userId, // Tambahkan user_id
            'created_at'     => date('Y-m-d H:i:s'),
        ];
    
        if ($this->model->insert($data)) {
            return $this->respondCreated(["message" => "Report berhasil disubmit."]);
        } else {
            return $this->failServerError("Gagal dalam membuat report.");
        }
    }    

    private function getUserIdFromToken()
    {
        $authHeader = $this->request->getHeaderLine('Authorization');
        
        if (!$authHeader || strpos($authHeader, 'Bearer ') !== 0) {
            return null; // Tidak ada token
        }

        $token = substr($authHeader, 7); // Hilangkan "Bearer "
        
        try {
            // Dekode token. Gunakan library JWT jika diperlukan.
            $decoded = base64_decode($token);

            if (!$decoded) {
                throw new \Exception('Invalid token.');
            }

            // Misalnya, token adalah JSON dengan user_id
            $payload = json_decode($decoded, true);
            if (isset($payload['user_id'])) {
                return $payload['user_id']; // Ambil user_id dari token
            }

            throw new \Exception('Invalid payload structure.');
        } catch (\Exception $e) {
            return null; // Jika terjadi kesalahan, return null
        }
    }


    public function index()
    {
        $reports = $this->model->getReportsWithUsernames();
    
        foreach ($reports as &$report) {
            $report['photo_url'] = base_url($report['photo']);
        }
    
        return $this->respond($reports);
    }      

    // Update report status
    public function updateStatus($id = null)
    {
        $data = $this->request->getJSON(true); 

        $report = $this->model->find($id);
        if (!$report) {
            return $this->failNotFound("Report not found.");
        }

        $rules = [
            'status' => 'required|in_list[pending,in_process,completed]',
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        if ($this->model->update($id, $data)) {
            return $this->respondUpdated(["message" => "Report status updated."]);
        } else {
            return $this->failServerError("Failed to update report status.");
        }
    }
  
    public function getByStatus($status = null)
    {
        $reports = $this->model->where('status', $status)->findAll();
    
        // Tetap kembalikan array kosong jika tidak ada laporan
        if (empty($reports)) {
            return $this->respond([
                'message' => "No reports found with status: $status",
                'data'    => []
            ], 200); // Kode HTTP 200
        }
    
        // Kembalikan laporan jika ada
        return $this->respond([
            'message' => "Reports found with status: $status",
            'data'    => $reports
        ], 200); // Kode HTTP 200
    }
    
    public function stats()
    {
        $stats = [
            'total_reports' => $this->model->countAll(),
            'pending'       => $this->model->where('status', 'pending')->countAllResults(),
            'in_process'    => $this->model->where('status', 'in_process')->countAllResults(),
            'completed'     => $this->model->where('status', 'completed')->countAllResults(),
        ];
        return $this->respond($stats);
    }

    public function deleteReport($id = null)
    {
        $report = $this->model->find($id);

        if (!$report) {
            return $this->failNotFound("Report not found.");
        }

        if (!empty($report['photo']) && file_exists(FCPATH . $report['photo'])) {
            unlink(FCPATH . $report['photo']); 
        }

        if ($this->model->delete($id)) {
            return $this->respondDeleted(["message" => "Report deleted successfully."]);
        } else {
            return $this->failServerError("Failed to delete report.");
        }
    }

    public function home()
    {
        return view('report_view'); // Menampilkan halaman manajemen laporan
    }

}
