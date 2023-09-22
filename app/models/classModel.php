<?php
class classModel
{
    // Properties, fields
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getClassByTeacherId($teacherId)
    {
        try {
            $getClassQuery = "SELECT 
                                    classes.classId, 
                                    classes.classTeacherId, 
                                    classes.className 
                              FROM 
                                classes 
                              INNER JOIN 
                                teachers 
                              ON 
                                    classes.classTeacherId = teachers.teacherId 
                              WHERE teachers.teacherId = :teacherId AND classes.classIsActive = 1;";

            $this->db->query($getClassQuery);
            $this->db->bind(':teacherId', $teacherId);
            $result = $this->db->resultSet();

            return $result ?? [];
        } catch (PDOException $ex) {
            error_log("Error: Failed to get class data from the database in class classModel. Error: " . $ex->getMessage());
            die('Error: Failed to get class data');
        }
    }


    public function createClass($newClass, $selectedTeacherId)
    {
        global $var;
        $response = ["success" => false, "message" => ""];

        try {
            // Use the provided random classId

            // Insert class data into the 'classes' table
            $createClassQuery = "INSERT INTO 
                                `classes` 
                                (`classId`, `classTeacherId`, `className`, `classIsActive`) 
                                 VALUES (:classId, :classTeacherId, :className, 1)";

            $classId = $var['rand'];
            $this->db->query($createClassQuery);

            // Bind values
            $this->db->bind(':classId', $classId);
            $this->db->bind(':classTeacherId', $selectedTeacherId); // Updated binding
            $this->db->bind(':className', $newClass['className']);
            $this->db->execute();

            $response["success"] = true;
            $response["message"] = "Class created successfully.";
        } catch (PDOException $ex) {
            error_log("Error: Failed to create class - " . $ex->getMessage());
            $response["message"] = "Error: Failed to create class";
        }

        return $response;
    }

    public function deleteClass($classId)
    {
        try {
            $deleteClass = "UPDATE `classes` 
                                SET `classIsActive` = '0' 
                                WHERE `classes`.`classId` = :classId;";
            $this->db->query($deleteClass);
            $this->db->bind(':classId', $classId);

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

    public function updateClass($classId, $updatedClass)
    {
        $response = ["success" => false, "message" => "Education not found"];

        try {
            $updateClassQuery = "UPDATE `classes` 
                    SET `className` = :className 
                    WHERE `classId` = :classId";

            $this->db->query($updateClassQuery);

            $this->db->bind(':classId', $classId);
            $this->db->bind(':className', $updatedClass['className']);

            if ($this->db->execute()) {
                $response["success"] = true;
                $response["message"] = "Education updated successfully";
            }
        } catch (PDOException $ex) {
            error_log("Error: Failed to update education - " . $ex->getMessage());
        }

        return $response;
    }

    public function detailsClass($classId)
    {
        try {
            $detailClassQuery = "SELECT classId, classTeacherId, className, classIsActive FROM classes WHERE classId = :classId;";

            $this->db->query($detailClassQuery);
            $this->db->bind(':classId', $classId);

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
}
