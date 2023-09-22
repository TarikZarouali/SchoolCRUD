<?php

class ClassesController extends Controller
{

    private $delay = 2;


    private $classModel;

    private $subjectModel;



    public function __construct()
    {
        $this->classModel = $this->model('classModel');
        $this->subjectModel = $this->model('subjectModel');
    }

    public function index($teacherId)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            //Class
            $detailsTeacher = $this->subjectModel->detailTeacher($teacherId);
            $getClassByTeacherId = $this->classModel->getClassByTeacherId($teacherId);

            $data = [
                'Class' => $getClassByTeacherId,
                'Teacher' => $detailsTeacher
            ];

            $this->view('classes/index', $data);
        }
    }

    public function create($teacherId = 0)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Handle the form submission
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $selectedTeacherId = $post['teacherId'];

            // Assuming you have a model for education (e.g., $this->educationModel)
            $createClass = $this->classModel->createClass($post, $selectedTeacherId);

            if ($createClass["success"] === true) {
                echo $createClass["message"];
                header("Refresh: $this->delay; url=" . URLROOT . 'classesController/index/' . $selectedTeacherId);
            } else {
                echo $createClass["message"];
                header("Refresh: $this->delay; url=" . URLROOT . 'classesController/index/' . $selectedTeacherId);
            }
        } else {
            $data = [
                'teacherId' => $teacherId
            ];
            // Display the form
            $this->view('classes/create', $data);
        }
    }

    public function delete($classId)
    {
        $Id = explode('+', $classId);

        if ($this->classModel->deleteClass($Id[0])) {
            header("Refresh:$this->delay; url=" . URLROOT . 'classesController/index/' . $Id[1]);
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


            // Update the class using the retrieved POST data

            $updateClass = $this->classModel->updateClass($Ids[0], $post);


            if ($updateClass["success"]) {
                // Redirect to the class details page after a delay
                header("Refresh: $this->delay; url=" . URLROOT . 'classesController/index/' . $Ids[1]);
                exit; // Stop execution to ensure the redirect takes place
            } else {
                // Handle the case where the update failed
                echo $updateClass["message"];
            }
        } else {
            // Retrieve the selected class data
            $selectedClass = $this->classModel->detailsClass($Ids[0]);

            if ($selectedClass) {
                $data = [
                    'class' => $selectedClass,
                    'classId' => $Ids[0],
                    'teacherId' => $Ids[1]
                ];

                // Load the update view with the selected class data
                $this->view('classes/update', $data);
            } else {
                // Handle the case where the class data couldn't be retrieved
                echo "Class not found";
            }
        }
    }
}
