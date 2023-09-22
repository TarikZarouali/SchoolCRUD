<?php

class schoolModel
{
  // Properties, fields
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }


  public function getSchools(): array
  {
    try {
      $getSchoolsquery = "SELECT schoolId, schoolName, schoolAdres 
                        FROM `schools`
                        WHERE schoolIsActive = 1";

      $this->db->query($getSchoolsquery);

      $result = $this->db->resultSet();

      return $result ?? [];
    } catch (PDOexception $ex) {
      error_log("Error : failed to get all schools from database in class schoolsmodel.");
      die('Error : failed to get all schools');
    }
  }

  public function getSchoolById($schoolId)
  {
    try {
      $selectSchool = "SELECT schoolId, schoolName, schoolAdres,schoolDescription
                         FROM schools
                         WHERE schoolId = :schoolId";

      $this->db->query($selectSchool);
      $this->db->bind(':schoolId', $schoolId);


      $result = $this->db->single();


      return $result;
    } catch (PDOException $ex) {
      error_log("ERROR: Failed to retrieve school by ID");
      die("ERROR: Failed to retrieve school by ID");
    }
  }

  public function updateSchool($selectedSchool)
  {
    try {
      $updateSchool = "UPDATE schools
                        SET schoolName = :newSchoolName, schoolAdres = :newSchoolAdres, schoolDescription = :newSchoolDescription
                        WHERE schoolId = :schoolId;";

      $this->db->query($updateSchool);

      $this->db->bind(':newSchoolName', $selectedSchool['schoolName']);
      $this->db->bind(':newSchoolAdres', $selectedSchool['schoolAdres']);
      $this->db->bind(':newSchoolDescription', $selectedSchool['schoolDescription']);
      $this->db->bind(':schoolId', $selectedSchool['schoolId']);

      $this->db->execute();

      if ($this->db->rowCount() > 0) {
        error_log("INFO: school has been modified");
        return true;
      } else {
        error_log("ERROR: No rows were affected. School may not exist.");
        return false;
      }
    } catch (PDOException $ex) {
      error_log("ERROR: " . $ex->getMessage());
      die("ERROR: " . $ex->getMessage());
    }
  }


  public function createSchool($newSchool)
  {
    global $var;

    $response = ["success" => false, "message" => ""];
    try {
      $createSchoolsquery = "INSERT INTO schools (schoolId, schoolName,        schoolAdres, schoolIsActive, schoolCreateDate, schoolDescription)
                          VALUES (:schoolId, :schoolName, :schoolAdres, 1, :schoolCreateDate, :schoolDescription);";

      $this->db->query($createSchoolsquery);

      $this->db->bind(':schoolId', $var['rand']);
      $this->db->bind(':schoolCreateDate', $var['timestamp']);
      $this->db->bind(':schoolName', $newSchool['schoolName']);
      $this->db->bind(':schoolAdres', $newSchool['schoolAdres']);
      $this->db->bind(':schoolDescription', $newSchool['schoolDescription']);

      if ($this->db->execute()) {
        error_log("INFO: New school has been created", 0);
        $response["success"] = true;
        $response["message"] = "School created successfully";
      } else {
        error_log("INFO: New school could not be created", 0);
        $response["message"] = "Failed to create school";
      }
    } catch (PDOException $ex) {
      error_log("Error: Failed to create school - " . $ex->getMessage());
      $response["message"] = "Error: Failed to create school";
    }

    return $response;
  }




  public function deleteSchool($schoolId)
  {
    try {
      $deleteSchool = "UPDATE schools 
                       SET schoolIsActive = 0 
                       WHERE schoolId = :schoolId ;";
      $this->db->query($deleteSchool);
      $this->db->bind(':schoolId', $schoolId);

      // Execute the query
      if ($this->db->execute()) {
        error_log("INFO: School has been deleted");
        return true;
      } else {
        error_log("ERROR: School could not be deleted");
        return false;
      }
    } catch (PDOException $ex) {
      error_log("ERROR: Exception occurred while deleting school: " . $ex->getMessage());
      return false;
    }
  }
}