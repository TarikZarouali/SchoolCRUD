<?php

class educationModel
{
    // Properties, fields
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getEducationsBySchoolId($schoolId)
    {
        try {
            $getEducationQuery = "SELECT
                                    schoolhaseducations.schoolId,
                                    schoolhaseducations.educationId,
                                    educations.educationName,
                                    educations.educationDuration
                                  FROM
                                    schoolhaseducations
                                  INNER JOIN
                                    schools
                                  ON
                                    schoolhaseducations.schoolId = schools.schoolId
                                  INNER JOIN
                                    educations
                                  ON
                                    schoolhaseducations.educationId = educations.educationId
                                 WHERE schools.schoolId = :schoolId AND educationIsActive = 1;
                                ";



            $this->db->query($getEducationQuery);
            $this->db->bind(':schoolId', $schoolId);
            $result = $this->db->resultSet();

            return $result ?? [];
        } catch (PDOException $ex) {
            error_log("Error: Failed to get education data from the database in class EducationModel. Error: " . $ex->getMessage());
            die('Error: Failed to get education data');
        }
    }


    public function createEducation($newEducation, $schoolId)
    {
        global $var;
        $response = ["success" => false, "message" => ""];

        try {
            // Insert education data into the 'educations' table
            $createEducationQuery = "INSERT INTO `educations` 
            (`educationId`, `educationName`, `educationDuration`, `educationDescription`, `educationIsActive`) 
            VALUES (:educationId, :educationName, :educationDuration, :educationDescription, 1)";

            $this->db->query($createEducationQuery);

            // Generate a random educationId
            $educationId = $var['rand'];

            // Bind values
            $this->db->bind(':educationId', $educationId);
            $this->db->bind(':educationName', $newEducation['educationName']);
            $this->db->bind(':educationDuration', $newEducation['educationDuration']);
            $this->db->bind(':educationDescription', $newEducation['educationDescription']);
            $this->db->execute();
            // Execute the query
            // Insert the association into the 'schoolhaseducations' table
            $schoolHasEducationQuery = "INSERT INTO `schoolhaseducations` 
                (`schoolId`, `educationId`) 
                VALUES (:schoolId, :educationId)";

            $this->db->query($schoolHasEducationQuery);

            // Bind schoolId and educationId
            $this->db->bind(':schoolId', $schoolId);
            $this->db->bind(':educationId', $educationId);

            $this->db->execute();
        } catch (PDOException $ex) {
            error_log("Error: Failed to create education - " . $ex->getMessage());
            $response["message"] = "Error: Failed to create education";
        }

        return $response;
    }

    public function deleteEducation($educationId)
    {
        try {
            $deleteEducation = "UPDATE `educations` 
                                SET `educationIsActive` = '0' 
                                WHERE `educations`.`educationId` = :educationId;";
            $this->db->query($deleteEducation);
            $this->db->bind(':educationId', $educationId);

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



    public function detailsEducation($educationId)
    {
        try {
            $detailsEducation = "SELECT educationId, educationName, educationDuration, educationDescription FROM educations WHERE educationId = :educationId;";

            $this->db->query($detailsEducation);
            $this->db->bind(':educationId', $educationId);


            $result = $this->db->single();


            return $result;
        } catch (PDOException $ex) {
            error_log("Error: Failed to update education - " . $ex->getMessage());
            $response["message"] = "Error: Failed to update education";
        }
    }
    public function updateEducation($educationId, $updatedEducation)
    {
        $response = ["success" => false, "message" => "Education not found"];

        try {
            $updateEducationQuery = "UPDATE `educations` 
            SET `educationName` = :educationName, 
                `educationDuration` = :educationDuration, 
                `educationDescription` = :educationDescription 
            WHERE `educationId` = :educationId";

            $this->db->query($updateEducationQuery);

            $this->db->bind(':educationId', $educationId);

            $this->db->bind(':educationName', $updatedEducation['educationName']);
            $this->db->bind(':educationDuration', $updatedEducation['educationDuration']);
            $this->db->bind(':educationDescription', $updatedEducation['educationDescription']);

            if ($this->db->execute()) {
                $response["success"] = true;
                $response["message"] = "Education updated successfully";
            }
        } catch (PDOException $ex) {
            error_log("Error: Failed to update education - " . $ex->getMessage());
        }

        return $response;
    }

    public function getSchoolId($educationId)
    {
        try {
            $schoolIdQuery = "SELECT schoolId from schoolhaseducations WHERE educationId = :educationId";

            $this->db->query($schoolIdQuery);

            $this->db->bind(':educationId', $educationId);

            return $this->db->single();
        } catch (PDOException $ex) {
            error_log("Error: Failed to update education - " . $ex->getMessage());
        }
    }
}
