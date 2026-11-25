    <?php
	$status_msg = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_message'])) {
		$email = trim($_POST['email']);
		// Since 'message' allows NULL in your DB, set to null if left empty
		$message = !empty(trim($_POST['message'])) ? trim($_POST['message']) : null;

		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$stmt = $conn->prepare("INSERT INTO contact_info (email, message) VALUES (?, ?)");
			$stmt->bind_param("ss", $email, $message);

			if ($stmt->execute()) {
				$status_msg = "Thank you! Your message has been sent.";
			} else {
				$status_msg = "Error saving your message. Please try again.";
			}
			$stmt->close();
		} else {
			$status_msg = "Please enter a valid email address.";
		}
	}