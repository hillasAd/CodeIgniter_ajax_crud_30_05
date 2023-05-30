<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Student as ModelsStudent;

class Student extends BaseController
{

    private $student;

    public function __construct()
    {
        $this->student = new ModelsStudent();
    }

    public function index()
    {
        $data['students'] = $this->student->findAll();
        return $this->response->setJSON($data);
    }

    public function store()
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'course' => $this->request->getPost('course'),
        ];
        $this->student->save($data);
        $data = ['status' => 'Student saved successfully!'];
        return $this->response->setJSON($data);
    }

    public function update()
    {

        $student_id = $this->request->getPost('id_edit');
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'course' => $this->request->getPost('course'),
        ];
        $this->student->update($student_id, $data);
        $message = ['status' => 'Student updated successfully!'];
        return $this->response->setJSON($message);
    }


    public function delete()
    {
        $student_id = $this->request->getPost('id_delete');
        $this->student->delete($student_id);
        $message = ['status' => 'Student deleted successfully!'];
        return $this->response->setJSON($message);
    }

    public function view()
    {
        $student_id = $this->request->getPost('stud_id');
        $data['students'] = $this->student->find($student_id);
        return $this->response->setJSON($data);
    }
}
