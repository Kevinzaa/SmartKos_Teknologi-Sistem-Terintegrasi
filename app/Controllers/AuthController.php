<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class AuthController extends ResourceController
{
    protected $modelName = 'App\\Models\\UserModel';
    protected $format    = 'json';

    public function register()
    {
        $data = $this->request->getJSON(true); 
    
        $rules = [
            'username' => 'required|is_unique[users.username]',
            'password' => 'required|min_length[6]',
        ];
    
        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }
    
        if (empty($data['username']) || empty($data['password'])) {
            return $this->failValidationErrors(['error' => 'Username and password are required.']);
        }
    
        $user = [
            'username' => $data['username'],
            'password' => password_hash($data['password'], PASSWORD_BCRYPT),
        ];
    
        if ($this->model->insert($user)) {
            return $this->respondCreated(['message' => 'User registered successfully.']);
        } else {
            return $this->failServerError('Failed to register user.');
        }
    }
    
    public function login()
    {
        $data = $this->request->getJSON(true); 
    
        if (empty($data['username']) || empty($data['password'])) {
            return $this->failValidationErrors(['error' => 'Username and password are required.']);
        }
    
        $user = $this->model->where('username', $data['username'])->first();
    
        if (!$user || !password_verify($data['password'], $user['password'])) {
            return $this->failUnauthorized('Invalid username or password.');
        }
    
        // Buat payload token dengan user_id
        $payload = [
            'user_id' => $user['id'],
            'username' => $user['username'],
            'iat' => time(), // Waktu token dibuat
            'exp' => time() + (60 * 60), // Waktu kedaluwarsa (1 jam)
        ];
    
        // Encode payload sebagai token (gunakan JWT library jika memungkinkan)
        $token = base64_encode(json_encode($payload));
    
        return $this->respond([
            'message' => 'Login successful.',
            'token' => $token
        ]);
    }
     
    public function registerView()
    {
        return view('auth_view');
    }

}
