<?php


class StudentController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function index() {
        return $this->model->getAllStudents();
    }

    public function show($id) {
        return $this->model->getStudentById($id);
    }

    public function create($data) {
        if (empty($data['f_name']) || empty($data['l_name']) || empty($data['age'])) {
            return "You need to fill all the credentials!";
        }
        return $this->model->createStudent($data);
    }

    public function update($id, $data) {
        return $this->model->updateStudent($id, $data);
    }

    public function delete($id) {
        return $this->model->deleteStudent($id);
    }
}