<?php

class GradesController extends Controller
{

    private $delay = 2;

    private $gradeModel;

    private $studentModel;

    public function __construct()
    {
        $this->studentModel = $this->model('studentModel');
        $this->gradeModel = $this->model('gradeModel');
    }

    public function index($studentId)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $detailStudent = $this->studentModel->detailsStudent($studentId);
            $gradeStudent = $this->gradeModel->getGradesByStudentsId($studentId);
            $getAttendancies = $this->gradeModel->getAttendancies($studentId);

            $data = [
                'Student' => $detailStudent,
                'Grade' => $gradeStudent,
                'Attendancy' => $getAttendancies
            ];


            $this->view('grades/index', $data);
        }
    }

    public function create($studentId)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Handle the form submission
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $selectedStudentId = $post['studentId'];

            // Assuming you have a model for education (e.g., $this->educationModel)
            $createGrade = $this->gradeModel->createGrade($post, $selectedStudentId);

            if ($createGrade["success"] === true) {
                echo $createGrade["message"];
                header("Refresh: $this->delay; url=" . URLROOT . 'GradesController/create');
            } else {
                echo $createGrade["message"];
                header("Refresh: $this->delay; url=" . URLROOT . 'GradesController/index/' . $selectedStudentId);
            }
        } else {

            $data = [
                'studentId' => $studentId
            ];
            // Display the form
            $this->view('grades/create', $data);
        }
    }

    public function delete($gradeId)
    {
        if ($this->gradeModel->deleteGrade($gradeId)) {
            header("Refresh:$this->delay; url=" . URLROOT . 'gradesController/index/' . $gradeId);
        } else {
            echo "Er is iets fout gegaan"; // Corrected capitalization
        }
    }

    public function update($gradeId)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Filter and validate your POST data properly
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Update the student using the retrieved POST data
            $updateGrade = $this->gradeModel->updateGrade($gradeId, $post);

            if ($updateGrade["success"]) {
                // Redirect to the student details page after a delay
                header("Location: " . URLROOT . '/gradesController/index/' . $gradeId);
                exit; // Stop execution to ensure the redirect takes place
            } else {
                // Handle the case where the update failed
                echo $updateGrade["message"];
            }
        } else {
            // Retrieve the selected student data
            $selectedGrade = $this->gradeModel->detailsGrade($gradeId);

            if ($selectedGrade) {
                $data = [
                    'grade' => $selectedGrade
                ];

                // Load the update view with the selected student data
                $this->view('grades/update', $data);
            } else {
                // Handle the case where the student data couldn't be retrieved
                echo "Grade not found";
            }
        }
    }

    public function createAttendancy($studentId)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Handle the form submission
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $selectedStudentId = $post['studentId'];

            // Assuming you have a model for education (e.g., $this->educationModel)
            $createAttendancy = $this->gradeModel->createAttendancy($post, $selectedStudentId);

            if ($createAttendancy["success"] === true) {
                echo $createAttendancy["message"];
                header("Refresh: $this->delay; url=" . URLROOT . 'GradesController/createAttendancy');
            } else {
                echo $createAttendancy["message"];
                header("Refresh: $this->delay; url=" . URLROOT . 'GradesController/index/' . $selectedStudentId);
            }
        } else {

            $data = [
                'studentId' => $studentId
            ];
            // Display the form
            $this->view('attendancies/create', $data);
        }
    }

    public function deleteAttendancy($attendancyId)
    {
        if ($this->gradeModel->deleteAttendancy($attendancyId)) {
            header("Refresh:$this->delay; url=" . URLROOT . 'gradesController/index/' . $attendancyId);
        } else {
            echo "Er is iets fout gegaan"; // Corrected capitalization
        }
    }

    public function updateAttendancy($attendancyId)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Filter and validate your POST data properly
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Update the student using the retrieved POST data
            $updateAttendancy = $this->gradeModel->updateAttendancy($attendancyId, $post);

            if ($updateAttendancy["success"]) {
                // Redirect to the student details page after a delay
                header("Location: " . URLROOT . '/gradesController/index/' . $attendancyId);
                exit; // Stop execution to ensure the redirect takes place
            } else {
                // Handle the case where the update failed
                echo $updateAttendancy["message"];
            }
        } else {
            // Retrieve the selected student data
            $selectedAttendancy = $this->gradeModel->detailsAttendancy($attendancyId);

            if ($selectedAttendancy) {
                $data = [
                    'attendancy' => $selectedAttendancy
                ];

                // Load the update view with the selected student data
                $this->view('attendancies/update', $data);
            } else {
                // Handle the case where the student data couldn't be retrieved
                echo "attendancy not found";
            }
        }
    }
}
