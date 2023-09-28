<?php

class EducationsController extends Controller
{

    private $delay = 2;

    private $schoolModel;


    private $educationModel;

    public function __construct()
    {
        $this->educationModel = $this->model('educationModel');
        $this->schoolModel = $this->model('schoolModel');
    }



    public function index($schoolId)
    {

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $detailSchool = $this->schoolModel->getSchoolById($schoolId);
            $educationSchool = $this->educationModel->getEducationsBySchoolId($schoolId); // Make sure this is working
            $data = [
                'School' => $detailSchool,
                'Education' => $educationSchool
            ];

            // Debug: Output the data to see if it's populated correctly
            // var_dump($data);

            $this->view('educations/index', $data);
        }
    }

    public function create($schoolId = NULL)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Handle the form submission
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $selectedSchoolId = $post['schoolId'];

            // Assuming you have a model for education (e.g., $this->educationModel)
            $createEducation = $this->educationModel->createEducation($post, $selectedSchoolId);

            if ($createEducation["success"] === true) {
                echo $createEducation["message"];
                header("Refresh: $this->delay; url=" . URLROOT . 'educationscontroller/create');
            } else {
                echo $createEducation["message"];
                header("Refresh: $this->delay; url=" . URLROOT . 'educationscontroller/index/' . $selectedSchoolId);
            }
        } else {

            $data = [
                'schoolId' => $schoolId
            ];
            // Display the form
            $this->view('educations/create', $data);
        }
    }

    public function delete($educationId)
    {

        $schoolId = $this->educationModel->getSchoolId($educationId);

        if ($this->educationModel->deleteEducation($educationId)) {
            // Redirect to the index page with the selected schoolId after successful deletion
            header("Refresh:$this->delay; url=" . URLROOT . 'educationsController/index/' . $schoolId->schoolId);
        } else {
            echo "Er is iets fout gegaan"; // Corrected capitalization
        }
    }


    public function update($educationId)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Filter and validate your POST data properly
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Update the education using the retrieved POST data
            $updateResult = $this->educationModel->updateEducation($educationId, $post);
            $schoolId = $this->educationModel->getSchoolId($educationId);

            if ($updateResult["success"]) {
                // Redirect to the education index page after a delay
                header("Refresh:$this->delay; url=" . URLROOT . 'EducationsController/index/' . $schoolId->schoolId);
                exit; // Stop execution to ensure the redirect takes place
            } else {
                echo $updateResult["message"];
            }
        } else {
            // Retrieve the selected education data
            $selectedEducation = $this->educationModel->detailsEducation($educationId);

            $data = [
                'education' => $selectedEducation
            ];

            // Load the update view with the selected education data
            $this->view('educations/update', $data);
        }
    }
}
