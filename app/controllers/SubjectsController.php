<?php

class SubjectsController extends Controller
{

    private $delay = 2;

    private $subjectModel;

    private $educationModel;


    public function __construct()
    {
        $this->educationModel = $this->model('educationModel');
        $this->subjectModel = $this->model('subjectModel');
    }

    public function index($educationId)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $educationSchool = $this->educationModel->detailsEducation($educationId);
            $subjectEducation = $this->subjectModel->getSubjectsByEducationId($educationId);
            //TEACHER
            $getTeachersBySubjectId = $this->subjectModel->getTeachersBySubjectId($educationId);
            // Make sure this is working

            $data = [
                'Education' => $educationSchool,
                'Subject' => $subjectEducation,
                'Teacher' => $getTeachersBySubjectId
            ];

            // Debug: Output the data to see if it's populated correctly
            // var_dump($data);

            $this->view('subjects/index', $data);
        }
    }

    public function create($educationId = NULL)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Handle the form submission
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $selectedEducationId = $post['educationId'];


            // Assuming you have a model for education (e.g., $this->educationModel)
            $createSubject = $this->subjectModel->createSubject($post, $selectedEducationId);

            if ($createSubject["success"] === true) {
                echo $createSubject["message"];
                header("Refresh: $this->delay; url=" . URLROOT . 'subjectscontroller/create');
            } else {
                echo $createSubject["message"];
                header("Refresh: $this->delay; url=" . URLROOT . 'subjectscontroller/index/' . $selectedEducationId);
            }
        } else {

            $data = [
                'educationId' => $educationId
            ];
            // Display the form
            $this->view('subjects/create', $data);
        }
    }

    public function delete($subjectId)
    {
        $id = explode('+', $subjectId);
        if ($this->subjectModel->deleteSubject($id[0])) {
            header("Refresh:$this->delay; url=" . URLROOT . 'subjectsController/index/' . $id[1]);
        }
    }

    public function update($subjectId)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Filter and validate your POST data properly
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Update the education using the retrieved POST data
            $updateSubject = $this->subjectModel->updatesubject($subjectId, $post);
            $educationId = $this->subjectModel->getEducationId($subjectId);

            if ($updateSubject["success"]) {
                // Redirect to the subject index page after a delay
                header("Refresh:$this->delay; url=" . URLROOT . 'subjectsController/index/' . $educationId->educationId);
                exit; // Stop execution to ensure the redirect takes place
            } else {
                echo $updateSubject["message"];
            }
        } else {
            // Retrieve the selected subject data
            $selectedsubject = $this->subjectModel->detailSubject($subjectId);

            $data = [
                'subject' => $selectedsubject
            ];

            // Load the update view with the selected subject data
            $this->view('subjects/update', $data);
        }
    }

    public function deleteTeacher($teacherId)
    {
        // $id = explode('+', $teacherId);
        if ($this->subjectModel->deleteTeacher($teacherId)) {
            header("Refresh:$this->delay; url=" . URLROOT . 'subjectsController/index/' . $teacherId);
        } else {
            echo "Er is iets fout gegaan"; // Corrected capitalization
        }
    }

    public function createTeacher($educationId = NULL)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Handle the form submission
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $selectedEducationId = $post['educationId'];


            // Assuming you have a model for education (e.g., $this->educationModel)
            $createTeacher = $this->subjectModel->createTeacher($post, $selectedEducationId);

            if ($createTeacher["success"] === true) {
                echo $createTeacher["message"];
                header("Refresh: $this->delay; url=" . URLROOT . 'subjectscontroller/createTeacher');
            } else {
                echo $createTeacher["message"];
                header("Refresh: $this->delay; url=" . URLROOT . 'subjectscontroller/index/' . $selectedEducationId);
            }
        } else {

            $data = [
                'educationId' => $educationId
            ];
            // Display the form
            $this->view('teachers/create', $data);
        }
    }

    public function updateTeacher($Ids)
    {
        $Ids = explode('+', $Ids);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Filter and validate your POST data properly
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Update the education using the retrieved POST data
            $updateTeacher = $this->subjectModel->updateTeacher($Ids[0], $post);

            if ($updateTeacher["success"]) {
                // Redirect to the subject index page after a delay
                header("Refresh:$this->delay; url=" . URLROOT . 'subjectsController/index/' . $Ids[1]);
                exit; // Stop execution to ensure the redirect takes place
            } else {
                echo $updateTeacher["message"];
            }
        } else {
            // Retrieve the selected subject data
            $selectedTeacher = $this->subjectModel->detailTeacher($Ids[0]);

            $data = [
                'Teacher' => $selectedTeacher,
                'teacherId' => $Ids[0],
                'educationId' => $Ids[1]
            ];

            // Load the update view with the selected subject data
            $this->view('teachers/update', $data);
        }
    }
}