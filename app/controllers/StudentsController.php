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

    public function index($ids)
    {
        $ids = explode("+", $ids);
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            //Class
            $detailsClass = $this->classModel->detailsClass($ids[0]);
            $getStudentByClassId = $this->studentModel->getStudentByClassId($ids[0]);

            $data = [
                'Class' => $detailsClass,
                'Student' => $getStudentByClassId,
                'TeacherId' => $ids[1]
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

    public function delete($Ids)
    {
        $Ids = explode('+', $Ids);
        if ($this->studentModel->deleteStudent($Ids[0])) {
            header("Refresh:$this->delay; url=" . URLROOT . 'studentsController/index/' . $Ids[1]);
        } else {
            echo "Er is iets fout gegaan"; // Corrected capitalization
        }
    }

    public function update($Ids)
    {
        $Ids = explode('+', $Ids);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Filter and validate your POST data properly
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Update the student using the retrieved POST data
            $updateStudent = $this->studentModel->updateStudent($Ids[0], $post);

            if ($updateStudent["success"]) {
                // Redirect to the student details page after a delay
                header("Refresh: $this->delay; url=" . URLROOT . 'studentsController/detailsStudent/' . $Ids[1]);
                exit; // Stop execution to ensure the redirect takes place
            } else {
                // Handle the case where the update failed
                echo $updateStudent["message"];
            }
        } else {
            // Retrieve the selected student data
            $selectedStudent = $this->studentModel->detailsStudent($Ids[0]);

            if ($selectedStudent) {
                $data = [
                    'student' => $selectedStudent,
                    'studentId' => $Ids[0],
                    'classId' => $Ids[1]
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
