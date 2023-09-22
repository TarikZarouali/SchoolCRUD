<?php

class StudentsController extends Controller
{

    private $delay = 2;


    private $classModel;

    private $studentModel;



    public function __construct()
    {
        $this->classModel = $this->model('classModel');
        $this->studentModel = $this->model('studentModel');
    }

    public function index($classId)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            //Class
            $detailsClass = $this->classModel->detailsClass($classId);
            $getStudentByClassId = $this->studentModel->getStudentByClassId($classId);

            $data = [
                'Class' => $detailsClass,
                'Student' => $getStudentByClassId
            ];

            $this->view('students/index', $data);
        }
    }

    public function create($classId = NULL)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Handle the form submission
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $selectedClassId = $post['classId'];

            // Assuming you have a model for education (e.g., $this->educationModel)
            $createStudent = $this->studentModel->createStudent($post, $selectedClassId);

            if ($createStudent["success"] === true) {
                echo $createStudent["message"];
                header("Refresh: $this->delay; url=" . URLROOT . 'studentsController/create');
            } else {
                echo $createStudent["message"];
                header("Refresh: $this->delay; url=" . URLROOT . 'studentsController/index/' . $selectedClassId);
            }
        } else {

            $data = [
                'classId' => $classId
            ];
            // Display the form
            $this->view('students/create', $data);
        }
    }

    public function delete($studentId)
    {
        if ($this->studentModel->deleteStudent($studentId)) {
            header("Refresh:$this->delay; url=" . URLROOT . 'classesController/index/' . $studentId);
        } else {
            echo "Er is iets fout gegaan"; // Corrected capitalization
        }
    }

    public function update($studentId)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Filter and validate your POST data properly
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Update the student using the retrieved POST data
            $updateStudent = $this->studentModel->updateStudent($studentId, $post);

            if ($updateStudent["success"]) {
                // Redirect to the student details page after a delay
                header("Refresh: $this->delay; url=" . URLROOT . 'studentsController/detailsStudent/' . $studentId);
                exit; // Stop execution to ensure the redirect takes place
            } else {
                // Handle the case where the update failed
                echo $updateStudent["message"];
            }
        } else {
            // Retrieve the selected student data
            $selectedStudent = $this->studentModel->detailsStudent($studentId);

            if ($selectedStudent) {
                $data = [
                    'student' => $selectedStudent
                ];

                // Load the update view with the selected student data
                $this->view('students/update', $data);
            } else {
                // Handle the case where the student data couldn't be retrieved
                echo "Student not found";
            }
        }
    }
}
