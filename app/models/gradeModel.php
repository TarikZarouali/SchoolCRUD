<?php
class gradeModel
{
    // Properties, fields
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getGradesByStudentsId($studentId)
    {
        try {
            $getGradeQuery = "SELECT
                                    grades.gradeId,
                                    grades.gradeStudentId,
                                    grades.gradeName,
                                    grades.gradeGrade,
                                    grades.gradeCreateDate
                                FROM
                                    grades
                                INNER JOIN
                                    students
                                ON
                                    grades.gradeStudentId = students.studentId
                                WHERE
                                    students.studentId = :studentId AND grades.gradeIsActive = 1";

            $this->db->query($getGradeQuery);
            $this->db->bind(':studentId', $studentId);
            $result = $this->db->resultSet();

            return $result ?? [];
        } catch (PDOException $ex) {
            error_log("Error: Failed to get d data from the database in class EducationModel. Error: " . $ex->getMessage());
            die('Error: Failed to get s data');
        }
    }

    public function createGrade($newGrade, $studentId)
    {

        global $var;
        $response = ["success" => false, "message" => ""];

        try {
            // Insert education data into the 'grades' table
            $createGradeQuery = "INSERT INTO `grades` 
        (`gradeId`, `gradeStudentId`,`gradeName`, `gradeGrade`, `gradeCreateDate`, `gradeIsActive`) 
        VALUES (:gradeId, :gradeStudentId, :gradeName, :gradeGrade, :gradeCreateDate, 1)";

            $this->db->query($createGradeQuery);

            // Bind values
            $this->db->bind(':gradeId', $var['rand']);
            $this->db->bind(':gradeStudentId', $studentId);
            $this->db->bind(':gradeName', $newGrade['gradeName']);
            $this->db->bind(':gradeGrade', $newGrade['gradeGrade']);
            $this->db->bind(':gradeCreateDate', $var['timestamp']);

            $this->db->execute();

            $response["success"] = true;
            $response["message"] = "Grade created successfully";
        } catch (PDOException $ex) {
            error_log("Error: Failed to create grade - " . $ex->getMessage());
            $response["message"] = "Error: Failed to create grade";
        }

        return $response;
    }

    public function deleteGrade($gradeId)
    {
        try {
            $deleteGrade = "UPDATE `grades` 
                                SET `gradeIsActive` = '0' 
                                WHERE `grades`.`gradeId` = :gradeId;";
            $this->db->query($deleteGrade);
            $this->db->bind(':gradeId', $gradeId);

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

    public function detailsGrade($gradeId)
    {
        try {
            $detailsGrade = "SELECT gradeId, gradeStudentId, gradeName, gradeGrade FROM grades WHERE gradeId = :gradeId;";

            $this->db->query($detailsGrade);
            $this->db->bind(':gradeId', $gradeId);


            $result = $this->db->single();


            return $result;
        } catch (PDOException $ex) {
            error_log("Error: Failed to update grade - " . $ex->getMessage());
            $response["message"] = "Error: Failed to update grade";
        }
    }

    public function updateGrade($gradeId, $updatedGrade)
    {
        $response = ["success" => false, "message" => "Education not found"];

        try {
            $updateGradeQuery = "UPDATE `grades` 
            SET `gradeName` = :gradeName, 
                `gradeGrade` = :gradeGrade
            WHERE `gradeId` = :gradeId";

            $this->db->query($updateGradeQuery);

            $this->db->bind(':gradeId', $gradeId);

            $this->db->bind(':gradeName', $updatedGrade['gradeName']);
            $this->db->bind(':gradeGrade', $updatedGrade['gradeGrade']);

            if ($this->db->execute()) {
                $response["success"] = true;
                $response["message"] = "Education updated successfully";
            }
        } catch (PDOException $ex) {
            error_log("Error: Failed to update education - " . $ex->getMessage());
        }

        return $response;
    }

    public function getAttendancies()
    {
        try {
            $getAttendancyQuery = "SELECT
                                attendancy.attendancyId,
                                attendancy.attendancyStudentId,
                                attendancy.attendancyReason
                            FROM
                                attendancies AS attendancy
                            WHERE
                                attendancy.attendancyIsActive = 1";

            $this->db->query($getAttendancyQuery);
            $result = $this->db->resultSet();

            return $result ?? [];
        } catch (PDOException $ex) {
            error_log("Error: Failed to get attendance data from the database in class EducationModel. Error: " . $ex->getMessage());
            die('Error: Failed to get data');
        }
    }

    public function createAttendancy($newAttendancy, $studentId)
    {
        global $var;
        $response = ["success" => false, "message" => ""];

        try {
            // Insert education data into the 'grades' table
            $createAttendancyQuery = "INSERT INTO `attendancies` 
        (`attendancyId`, `attendancyStudentId`,`attendancyReason`, `attendancyIsActive`, `attendancyCreateDate`) 
        VALUES (:attendancyId, :attendancyStudentId, :attendancyReason, 1, :attendancyCreateDate)";

            $this->db->query($createAttendancyQuery);

            // Bind values
            $this->db->bind(':attendancyId', $var['rand']);
            $this->db->bind(':attendancyStudentId', $studentId);
            $this->db->bind(':attendancyReason', $newAttendancy['attendancyReason']);
            $this->db->bind(':attendancyCreateDate', $var['timestamp']);

            $this->db->execute();

            $response["success"] = true;
            $response["message"] = "Attendancy created successfully";
        } catch (PDOException $ex) {
            error_log("Error: Failed to create attendancy - " . $ex->getMessage());
            $response["message"] = "Error: Failed to create attendancy";
        }

        return $response;
    }

    public function deleteAttendancy($attendancyId)
    {
        try {
            $deleteAttendancy = "UPDATE `attendancies` 
                                SET `attendancyIsActive` = '0' 
                                WHERE `attendancies`.`attendancyId` = :attendancyId;";
            $this->db->query($deleteAttendancy);
            $this->db->bind(':attendancyId', $attendancyId);

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

    public function detailsAttendancy($attendancyId)
    {
        try {
            $detailsAttendancy = "SELECT attendancyId, attendancyStudentId, attendancyReason FROM attendancies WHERE attendancyId = :attendancyId;";

            $this->db->query($detailsAttendancy);
            $this->db->bind(':attendancyId', $attendancyId);

            $result = $this->db->single();

            return $result;
        } catch (PDOException $ex) {
            error_log("Error: Failed to fetch attendancy details - " . $ex->getMessage());
            $response["message"] = "Error: Failed to fetch attendancy details";
        }
    }

    public function updateAttendancy($attendancyId, $updatedAttendancy)
    {
        $response = ["success" => false, "message" => "Attendancy not found"];

        try {
            $updateAttendancyQuery = "UPDATE `attendancies` 
        SET `attendancyReason` = :attendancyReason
        WHERE `attendancyId` = :attendancyId";

            $this->db->query($updateAttendancyQuery);

            $this->db->bind(':attendancyId', $attendancyId);
            $this->db->bind(':attendancyReason', $updatedAttendancy['attendancyReason']);

            if ($this->db->execute()) {
                $response["success"] = true;
                $response["message"] = "Attendancy updated successfully";
            }
        } catch (PDOException $ex) {
            error_log("Error: Failed to update attendancy - " . $ex->getMessage());
        }

        return $response;
    }
}
