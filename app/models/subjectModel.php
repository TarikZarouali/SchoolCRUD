<?php
class subjectModel
{
    // Properties, fields
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getSubjectsByEducationId($educationId)
    {
        try {
            $getSubjectQuery = "SELECT
                                    educationhassubjects.educationId,
                                    educationhassubjects.subjectId,
                                    subjects.subjectName
                                FROM
                                    educationhassubjects
                                INNER JOIN
                                    educations
                                ON
                                    educationhassubjects.educationId = educations.educationId
                                INNER JOIN
                                    subjects
                                ON
                                    educationhassubjects.subjectId = subjects.subjectId
                                WHERE
                                    educations.educationId = :educationId AND subjects.subjectIsActive = 1";

            $this->db->query($getSubjectQuery);
            $this->db->bind(':educationId', $educationId);
            $result = $this->db->resultSet();

            return $result ?? [];
        } catch (PDOException $ex) {
            error_log("Error: Failed to get education data from the database in class EducationModel. Error: " . $ex->getMessage());
            die('Error: Failed to get education data');
        }
    }

    public function createSubject($newSubject, $educationId)
    {
        global $var;
        $response = ["success" => false, "message" => ""];

        try {
            // Insert education data into the 'educations' table
            $createSubject = "INSERT INTO `subjects` 
            (`subjectId`, `subjectName`, `subjectDescription`, `subjectIsActive`) 
            VALUES (:subjectId, :subjectName, :subjectDescription, 1)";

            $this->db->query($createSubject);

            // Generate a random educationId
            $subjectId = $var['rand'];

            // Bind values
            $this->db->bind(':subjectId', $subjectId);
            $this->db->bind(':subjectName', $newSubject['subjectName']);
            $this->db->bind(':subjectDescription', $newSubject['subjectDescription']);
            $this->db->execute();
            // Execute the query
            // Insert the association into the 'schoolhaseducations' table
            $educationHasSubjectsQuery = "INSERT INTO `educationhassubjects` 
                (`subjectId`, `educationId`) 
                VALUES (:subjectId, :educationId)";

            $this->db->query($educationHasSubjectsQuery);

            // Bind schoolId and educationId
            $this->db->bind(':educationId', $educationId);
            $this->db->bind(':subjectId', $subjectId);

            $this->db->execute();
        } catch (PDOException $ex) {
            error_log("Error: Failed to create education - " . $ex->getMessage());
            $response["message"] = "Error: Failed to create education";
        }

        return $response;
    }

    public function deleteSubject($subjectId)
    {
        try {
            $deleteSubject = "UPDATE `subjects` 
                                SET `subjectIsActive` = '0' 
                                WHERE `subjects`.`subjectId` = :subjectId;";
            $this->db->query($deleteSubject);
            $this->db->bind(':subjectId', $subjectId);

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

    public function updateSubject($subjectId, $updatedSubject)
    {
        $response = ["success" => false, "message" => "Education not found"];

        try {
            $updateSubjectQuery = "UPDATE `subjects` 
            SET `subjectName` = :subjectName, 
                `subjectDescription` = :subjectDescription 
            WHERE `subjectId` = :subjectId";

            $this->db->query($updateSubjectQuery);

            $this->db->bind(':subjectId', $subjectId);

            $this->db->bind(':subjectName', $updatedSubject['subjectName']);
            $this->db->bind(':subjectDescription', $updatedSubject['subjectDescription']);

            if ($this->db->execute()) {
                $response["success"] = true;
                $response["message"] = "subject updated successfully";
            }
        } catch (PDOException $ex) {
            error_log("Error: Failed to update subject - " . $ex->getMessage());
        }

        return $response;
    }

    public function getEducationId($subjectId)
    {
        try {
            $educationIdQuery = "SELECT educationId from educationhassubjects WHERE subjectId = :subjectId";

            $this->db->query($educationIdQuery);

            $this->db->bind(':subjectId', $subjectId);

            return $this->db->single();
        } catch (PDOException $ex) {
            error_log("Error: Failed to update education - " . $ex->getMessage());
        }
    }

    public function detailSubject($subjectId)
    {
        try {
            $detailSubject = "SELECT subjectId, subjectName, subjectDescription FROM subjects WHERE subjectId = :subjectId;";

            $this->db->query($detailSubject);
            $this->db->bind(':subjectId', $subjectId);


            $result = $this->db->single();


            return $result;
        } catch (PDOException $ex) {
            error_log("Error: Failed to update education - " . $ex->getMessage());
            $response["message"] = "Error: Failed to update education";
        }
    }

    //TEACHER
    public function getTeachersBySubjectId($educationId)
    {
        try {
            $getTeacherQuery = "SELECT
                                    educationhasteachers.educationId,
                                    educationhasteachers.teacherId,
                                    teachers.teacherFirstName,
                                    teachers.teacherLastName
                                FROM
                                    educationhasteachers
                                INNER JOIN
                                    educations
                                ON
                                    educationhasteachers.educationId = educations.educationId
                                INNER JOIN
                                    teachers
                                ON
                                    educationhasteachers.teacherId = teachers.teacherId
                                WHERE
                                    educations.educationId = :educationId
                                    AND teachers.teacherIsActive = 1";


            $this->db->query($getTeacherQuery);
            $this->db->bind(':educationId', $educationId);
            $result = $this->db->resultSet();

            return $result ?? [];
        } catch (PDOException $ex) {
            error_log("Error: Failed to get education data from the database in class EducationModel. Error: " . $ex->getMessage());
            die('Error: Failed to get education data');
        }
    }

    public function deleteTeacher($teacherId)
    {
        try {
            $deleteTeacher = "UPDATE `teachers` 
                                SET `teacherIsActive` = '0' 
                                WHERE `teachers`.`teacherId` = :teacherId;";
            $this->db->query($deleteTeacher);
            $this->db->bind(':teacherId', $teacherId);

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

    public function createTeacher($newTeacher, $educationId)
    {
        global $var;
        $response = ["success" => false, "message" => ""];

        try {
            // Insert education data into the 'educations' table
            $createTeacher = "INSERT INTO `teachers` 
            (`teacherId`, `teacherFirstName`, `teacherLastName`, `teacherAdres`, `teacherIsActive`, `teacherCreateDate`) 
            VALUES (:teacherId, :teacherFirstName, :teacherLastName, :teacherAdres, 1, :teacherCreateDate )";

            $this->db->query($createTeacher);

            // Generate a random educationId
            $teacherId = $var['rand'];


            // Bind values
            $this->db->bind(':teacherId', $teacherId);
            $this->db->bind(':teacherFirstName', $newTeacher['teacherFirstName']);
            $this->db->bind(':teacherLastName', $newTeacher['teacherLastName']);
            $this->db->bind(':teacherAdres', $newTeacher['teacherAdres']);
            $this->db->bind(':teacherCreateDate', $var['timestamp']);
            $this->db->execute();
            // Execute the query
            // Insert the association into the 'schoolhaseducations' table
            $educationHasTeachersQuery = "INSERT INTO `educationhasteachers` 
                (`teacherId`, `educationId`) 
                VALUES (:teacherId, :educationId)";

            $this->db->query($educationHasTeachersQuery);

            // Bind schoolId and educationId
            $this->db->bind(':educationId', $educationId);
            $this->db->bind(':teacherId', $teacherId);

            $this->db->execute();
        } catch (PDOException $ex) {
            error_log("Error: Failed to create education - " . $ex->getMessage());
            $response["message"] = "Error: Failed to create education";
        }

        return $response;
    }

    public function detailTeacher($teacherId)
    {
        try {
            $detailTeacher = "SELECT teacherId, teacherFirstName, teacherLastName, teacherAdres FROM teachers WHERE teacherId = :teacherId;";

            $this->db->query($detailTeacher);
            $this->db->bind(':teacherId', $teacherId);


            $result = $this->db->single();


            return $result;
        } catch (PDOException $ex) {
            error_log("Error: Failed to update education - " . $ex->getMessage());
            $response["message"] = "Error: Failed to update education";
        }
    }

    public function updateTeacher($teacherId, $updatedTeacher)
    {
        $response = ["success" => false, "message" => "Education not found"];

        try {
            $updateTeacherQuery = "UPDATE `teachers` 
            SET `teacherFirstName` = :teacherFirstName, 
                `teacherLastName` = :teacherLastName,
                `teacherAdres`  = :teacherAdres
            WHERE `teacherId` = :teacherId";

            $this->db->query($updateTeacherQuery);

            $this->db->bind(':teacherId', $teacherId);

            $this->db->bind(':teacherFirstName', $updatedTeacher['teacherFirstName']);
            $this->db->bind(':teacherLastName', $updatedTeacher['teacherLastName']);
            $this->db->bind(':teacherAdres', $updatedTeacher['teacherAdres']);

            if ($this->db->execute()) {
                $response["success"] = true;
                $response["message"] = "subject updated successfully";
            }
        } catch (PDOException $ex) {
            error_log("Error: Failed to update subject - " . $ex->getMessage());
        }

        return $response;
    }
}
