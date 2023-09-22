<?php

class studentModel
{
    // Properties, fields
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getStudentByClassId($classId)
    {
        try {
            $getStudentsQuery = "SELECT
                                    students.studentId,
                                    students.studentClassId,
                                    students.studentFirstName,
                                    students.studentLastName,
                                    students.studentAdres
                                  FROM
                                    students
                                INNER JOIN
                                    classes
                                ON
                                students.studentClassId = classes.classId
                                 WHERE classes.classId = :classId AND studentIsActive = 1";



            $this->db->query($getStudentsQuery);
            $this->db->bind(':classId', $classId);
            $result = $this->db->resultSet();

            return $result ?? [];
        } catch (PDOException $ex) {
            error_log("Error: Failed to get student data from the database in class studentModel. Error: " . $ex->getMessage());
            die('Error: Failed to get student data');
        }
    }

    public function createStudent($newStudent, $classId)
    {
        global $var;
        $response = ["success" => false, "message" => ""];

        try {
            // Insert education data into the 'educations' table
            $createStudentQuery = "INSERT INTO `students` 
            (`studentId`, `studentClassId`, `studentFirstName`, `studentLastName`, `studentAdres`, `studentIsActive`, `studentCreateDate`) 
            VALUES (:studentId, :studentClassId, :studentFirstName, :studentLastName, :studentAdres, 1,:studentCreateDate)";

            $this->db->query($createStudentQuery);

            // Bind values
            $this->db->bind(':studentId', $var['rand']);
            $this->db->bind(':studentClassId', $classId);
            $this->db->bind(':studentFirstName', $newStudent['studentFirstName']);
            $this->db->bind(':studentLastName', $newStudent['studentLastName']);
            $this->db->bind(':studentAdres', $newStudent['studentAdres']);
            $this->db->bind(':studentCreateDate', $var['timestamp']);

            $this->db->execute();
        } catch (PDOException $ex) {
            error_log("Error: Failed to create education - " . $ex->getMessage());
            $response["message"] = "Error: Failed to create education";
        }

        return $response;
    }

    public function deleteStudent($studentId)
    {
        try {
            $deleteStudent = "UPDATE `students` 
                                SET `studentIsActive` = '0' 
                                WHERE `students`.`studentId` = :studentId;";
            $this->db->query($deleteStudent);
            $this->db->bind(':studentId', $studentId);

            // Execute the query
            if ($this->db->execute()) {
                error_log("INFO: education has been deleted");
                return true;
            } else {
                error_log("ERROR: education could not be deleted");
                return false;
            }
        } catch (PDOException $ex) {
            error_log("ERROR: Exception occurred while deleting education: " . $ex->getMessage());
            return false;
        }
    }

    public function detailsStudent($studentId)
    {
        try {
            $detailStudentQuery = "SELECT studentId, studentClassid, studentFirstName, studentLastName, studentAdres FROM students WHERE studentId = :studentId;";

            $this->db->query($detailStudentQuery);
            $this->db->bind(':studentId', $studentId);

            $result = $this->db->single();

            if ($result) {
                return $result;
            } else {
                return false; // or an appropriate error message
            }
        } catch (PDOException $ex) {
            error_log("Error: Failed to fetch class details - " . $ex->getMessage());
            return false; // or an appropriate error message
        }
    }

    public function updateStudent($studentId, $updatedStudent)
    {
        $response = ["success" => false, "message" => "Education not found"];

        try {
            $updateStudentQuery = "UPDATE `students` 
                                   SET `studentFirstName` = :studentFirstName,
                                       `studentLastName` = :studentLastName,
                                       `studentAdres` = :studentAdres
                                    WHERE `studentId` = :studentId";


            $this->db->query($updateStudentQuery);

            $this->db->bind(':studentId', $studentId);
            $this->db->bind(':studentFirstName', $updatedStudent['studentFirstName']);
            $this->db->bind(':studentLastName', $updatedStudent['studentLastName']);
            $this->db->bind(':studentAdres', $updatedStudent['studentAdres']);

            if ($this->db->execute()) {
                $response["success"] = true;
                $response["message"] = "Education updated successfully";
            }
        } catch (PDOException $ex) {
            error_log("Error: Failed to update education - " . $ex->getMessage());
        }

        return $response;
    }
}
