<?php

namespace App\models;

use App\db\Database;
use PDO;
use Exception;

class class_model
{
	private $db;

	public function __construct()
	{
		$this->db = Database::$db->getPDO();
	}

	public function login_student($username, $password)
	{
		$query = "SELECT * FROM `tbl_student` WHERE `username` = :username AND `password` = :password";
		$stmt = $this->db->prepare($query);
		$stmt->execute(['username' => $username, 'password' => $password]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		return [
			'student_id' => $result['student_id'] ?? null,
			'count' => $stmt->rowCount()
		];
	}

	public function student_account($student_id)
	{
		$query = "SELECT * FROM `tbl_student` WHERE `student_id` = :student_id";
		$stmt = $this->db->prepare($query);
		$stmt->execute(['student_id' => $student_id]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		return [
			'first_name' => $result['first_name'] ?? '',
			'last_name' => $result['last_name'] ?? ''
		];
	}

	public function fetchAll_document($student_id)
	{
		$query = "SELECT * FROM tbl_document WHERE `student_id` = :student_id";
		$stmt = $this->db->prepare($query);
		$stmt->execute(['student_id' => $student_id]);

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function add_document($document_name, $document_description, $image_size, $student_id)
	{
		$query = "INSERT INTO `tbl_document` (`document_name`, `document_description`, `image_size`, `student_id`) VALUES (:document_name, :document_description, :image_size, :student_id)";
		$stmt = $this->db->prepare($query);
		$stmt->execute([
			'document_name' => $document_name,
			'document_description' => $document_description,
			'image_size' => $image_size,
			'student_id' => $student_id
		]);
		return true;
	}

	public function edit_document($document_name, $document_description, $image_size, $student_id, $document_id)
	{
		$deleteQuery = "SELECT document_name FROM tbl_document WHERE document_id = :document_id";
		$stmt = $this->db->prepare($deleteQuery);
		$stmt->execute(['document_id' => $document_id]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($row) {
			$imagePath = '../../student/' . $row['document_name'];
			unlink($imagePath);
		}

		$updateQuery = "UPDATE `tbl_document` SET `document_name` = :document_name, `document_description` = :document_description, `image_size` = :image_size, `student_id` = :student_id WHERE `document_id` = :document_id";
		$stmt = $this->db->prepare($updateQuery);
		$stmt->execute([
			'document_name' => $document_name,
			'document_description' => $document_description,
			'image_size' => $image_size,
			'student_id' => $student_id,
			'document_id' => $document_id
		]);

		return true;
	}

	public function delete_document($document_id)
	{
		$deleteQuery = "SELECT document_name FROM tbl_document WHERE document_id = :document_id";
		$stmt = $this->db->prepare($deleteQuery);
		$stmt->execute(['document_id' => $document_id]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($row) {
			$imagePath = '../../student/' . $row['document_name'];
			unlink($imagePath);
		}

		$query = "DELETE FROM tbl_document WHERE document_id = :document_id";
		$stmt = $this->db->prepare($query);
		$stmt->execute(['document_id' => $document_id]);

		return true;
	}

	// public function count_numberoftotalpending($student_id)
	// {
	// 	$query = "SELECT COUNT(request_id) as count_pending FROM tbl_documentrequest WHERE student_id = ? AND status = 'Pending'";
	// 	$stmt = $this->db->prepare($query);
	// 	$stmt->bindParam("i", $student_id);
	// 	$stmt->execute();

	// 	return $stmt->fetch(PDO::FETCH_ASSOC);
	// }

	public function count_numberoftotalpending($student_id)
	{
		$sql = "SELECT COUNT(request_id) AS count_pending 
				FROM tbl_documentrequest 
				WHERE student_id = :student_id AND status = 'Pending'";
		$stmt = $this->db->prepare($sql);

		// Bind the parameter
		$stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);

		// Execute the statement
		$stmt->execute();

		// Fetch the results
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $data;
	}

	public function count_numberoftotalpaid($student_id)
	{
		$sql = "SELECT COUNT(request_id) AS count_paid 
            FROM tbl_documentrequest 
            WHERE student_id = :student_id AND status = 'Paid'";
		$stmt = $this->db->prepare($sql);

		// Bind the parameter
		$stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);

		// Execute the statement
		$stmt->execute();

		// Fetch the results
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $data;
	}

	public function count_numberoftotalreceived($student_id)
	{
		$sql = "SELECT COUNT(request_id) AS count_received 
            FROM tbl_documentrequest 
            WHERE student_id = :student_id AND status = 'Received'";
		$stmt = $this->db->prepare($sql);

		// Bind the parameter
		$stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);

		// Execute the statement
		$stmt->execute();

		// Fetch the results
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $data;
	}

	public function fetchAll_documentrequest($student_id)
	{
		$sql = "SELECT * FROM tbl_documentrequest WHERE student_id = :student_id";
		$stmt = $this->db->prepare($sql);

		// Bind the parameter
		$stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);

		// Execute the statement
		$stmt->execute();

		// Fetch the results
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $data;
	}

	public function student_profile($student_id)
	{
		try {
			$sql = "SELECT * FROM tbl_student WHERE student_id = :student_id";
			$stmt = $this->db->prepare($sql);

			// Bind the parameter
			$stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);

			// Execute the query
			$stmt->execute();

			// Fetch the result
			$fetch = $stmt->fetch(PDO::FETCH_ASSOC);

			if ($fetch) {
				return array(
					'student_id' => $fetch['student_id'],
					'studentID_no' => $fetch['studentID_no'],
					'first_name' => $fetch['first_name'],
					'middle_name' => $fetch['middle_name'],
					'last_name' => $fetch['last_name'],
					'course' => $fetch['course'],
					'gender' => $fetch['gender'],
					'year_level' => $fetch['year_level'],
					'email_address' => $fetch['email_address'],
					'complete_address' => $fetch['complete_address'],
					'mobile_number' => $fetch['mobile_number'],
					'username' => $fetch['username'],
					'password' => $fetch['password'],
					'date_created' => $fetch['date_created']
				);
			} else {
				return null; // Return null if no student is found
			}
		} catch (PDOException $e) {
			// Handle exceptions and errors
			die("Error: " . $e->getMessage());
		}
	}


}
