<?php

class SchoolsController extends Controller
{
    private $delay = 2;

    private $schoolModel;

    public function __construct()
    {
        $this->schoolModel = $this->model('schoolModel');
    }
    public function index()
    {
        $schools = $this->schoolModel->getSchools();

        $data = ['Schools' => $schools];

        $this->view('school/index', $data);
    }



    public function create()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Handle the form submission
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);


            $createSchool = $this->schoolModel->createSchool($post);
            if ($createSchool["success"] === false) {
                echo $createSchool["message"];
                header("Refresh: $this->delay; url=" . URLROOT . 'schoolscontroller/create');
            } else {
                echo $createSchool["message"];
                header("Refresh: $this->delay; url=" . URLROOT . 'schoolscontroller/index');
            }

            // Display an error message
            $this->view('school/create');
        } else {
            // Display the form
            $this->view('school/create');
        }
    }

    public function update($schoolId)
    {
        // Retrieve the selected school data
        $selectedSchool = $this->schoolModel->getSchoolById($schoolId);

        $data = [
            'school' => $selectedSchool
        ];
        // Load the update view with the selected school data
        $this->view('school/update', $data);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Filter and validate your POST data properly
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Update the school using the retrieved POST data
            $this->schoolModel->updateSchool($post);
            // Redirect to the school index page after a delay
            header("Refresh:$this->delay; url=" . URLROOT . 'schoolscontroller/index');
        }
    }

    public function delete($schoolId)
    {
        if ($this->schoolModel->deleteSchool($schoolId)) {
            header("Refresh:$this->delay; url=" . URLROOT . 'schoolscontroller/index');
        } else {
            echo "Er is iets fout gegaan"; // Corrected capitalization
        }
    }
}