<?php
// includes/models/Student.php

class Student {
    private $crudConn; // Uses CRUD operations DB
    
    public function __construct($crudDb) {
        $this->crudConn = $crudDb;
    }
  
    public function getAllStudents() {
        $query = "SELECT * FROM students";
        $result = $this->crudConn->query($query); 
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getStudentById($id) {
        $stmt = $this->crudConn->prepare("SELECT * FROM students WHERE id = ?"); 
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function createStudent($data) {
        $stmt = $this->crudConn->prepare("INSERT INTO students (first_name, last_name, age) VALUES (?, ?, ?)"); 
        $stmt->bind_param("ssi", $data['f_name'], $data['l_name'], $data['age']);
        return $stmt->execute();
    }

    public function updateStudent($id, $data) {
        $stmt = $this->crudConn->prepare("UPDATE students SET first_name = ?, last_name = ?, age = ? WHERE id = ?"); 
        $stmt->bind_param("ssii", $data['f_name'], $data['l_name'], $data['age'], $id);
        return $stmt->execute();
    }

    public function deleteStudent($id) {
        $stmt = $this->crudConn->prepare("DELETE FROM students WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}