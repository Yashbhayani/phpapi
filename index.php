<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header('Content-type:application/json');


include 'DbConnect.php';
// $objDb = new DbConnect;
// $conn = $objDb->con();

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

switch ($method) {
    case "GET":
        /*      $headers = apache_request_headers();
                $token = $headers['auth-token'];
                echo $token;*/

        $sql = "SELECT * FROM `users`";
        $query = mysqli_query($con, $sql);
        $count = mysqli_num_rows($query);
        header('Content-type:application/json');
        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($query))
                $arr[] = $row;
            $response = ['status' => 1,  'message' => 'Record added successfully.', 'data' => $arr];
            echo json_encode($response);
        } else {
            $response = ['status' => 0, 'message' => 'Failed to create record.'];
            echo json_encode($response);
        }
        return 0;


    case "POST":
        $user = json_decode(file_get_contents('php://input'));
        $sql = "INSERT INTO `users`(`name`, `email`, `mobile`, `created_at`) VALUES('$user->name', '$user->email', '$user->mobile', '$user->created_at')";
        $query = mysqli_query($con, $sql) or exit("query faild");
        if ($query) {
            $response = ['status' => 1,  'message' => 'Record created successfully.'];
        } else {
            $response = ['status' => 0, 'message' => 'Failed to create record.'];
        }
        echo json_encode($response);
        return 0;

    case "PUT":
        $user_id = $_GET['id'];
        $user = json_decode(file_get_contents('php://input'));
        $sql = "UPDATE `users` SET `name`='$user->name',`email`='$user->email',`mobile`='$user->mobile',`created_at`='$user->created_at' WHERE `id`='$user_id'";
        $query = mysqli_query($con, $sql) or exit("query faild");
        if ($query) {
            $response = ['status' => 1,  'message' => 'Record update successfully.'];
        } else {
            $response = ['status' => 0, 'message' => 'Failed to create record.'];
        }
        echo json_encode($response);
        return 0;

    case "DELETE":
        $user_id = $_GET['id'];
        $sql = "DELETE FROM `users` WHERE `id`='$user_id'";
        $query = mysqli_query($con, $sql) or exit("query faild");
        if ($query) {
            $response = ['status' => 1,  'message' => 'Record delete successfully.'];
        } else {
            $response = ['status' => 0, 'message' => 'Failed to create record.'];
        }
        echo json_encode($response);
        return 0;
}

/*switch ($method) {
    case "GET":
        $sql = "SELECT * FROM users";
        $path = explode('/', $_SERVER['REQUEST_URI']);
        if (isset($path[3]) && is_numeric($path[3])) {
            $sql .= " WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $path[3]);
            if ($stmt->execute()) {
                $response = ['status' => 1, 'message' => 'Record created successfully.'];
            } else {
                $response = ['status' => 0, 'message' => 'Failed to create record.'];
            }
            $users = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $stmt = $conn->prepare($sql);
            if ($stmt->execute()) {
                $response = ['status' => 1, 'message' => 'Record created successfully.'];
            } else {
                $response = ['status' => 0, 'message' => 'Failed to create record.'];
            }
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // $headers = apache_request_headers();
        // $token = $headers['auth-token'];
        $data = [
            $users, $response
        ];
        echo json_encode($users);
        break;
    case "POST":
        $user = json_decode(file_get_contents('php://input'));
        $sql = "INSERT INTO users(id, name, email, mobile, created_at) VALUES(null, :name, :email, :mobile, :created_at)";
        $stmt = $conn->prepare($sql);
        $created_at = date('Y-m-d');
        $stmt->bindParam(':name', $user->name);
        $stmt->bindParam(':email', $user->email);
        $stmt->bindParam(':mobile', $user->mobile);
        $stmt->bindParam(':created_at', $created_at);

        if ($stmt->execute()) {
            $response = ['status' => 1, 'message' => 'Record created successfully.'];
        } else {
            $response = ['status' => 0, 'message' => 'Failed to create record.'];
        }
        echo json_encode($response);
        break;

    case "PUT":
        $user = json_decode(file_get_contents('php://input'));
        $sql = "UPDATE users SET name= :name, email =:email, mobile =:mobile, updated_at =:updated_at WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $updated_at = date('Y-m-d');
        $stmt->bindParam(':id', $user->id);
        $stmt->bindParam(':name', $user->name);
        $stmt->bindParam(':email', $user->email);
        $stmt->bindParam(':mobile', $user->mobile);
        $stmt->bindParam(':updated_at', $updated_at);

        if ($stmt->execute()) {
            $response = ['status' => 1, 'message' => 'Record updated successfully.'];
        } else {
            $response = ['status' => 0, 'message' => 'Failed to update record.'];
        }
        echo json_encode($response);
        break;

    case "DELETE":
        $sql = "DELETE FROM users WHERE id = :id";
        $path = explode('/', $_SERVER['REQUEST_URI']);

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $path[3]);

        if ($stmt->execute()) {
            $response = ['status' => 1, 'message' => 'Record deleted successfully.'];
        } else {
            $response = ['status' => 0, 'message' => 'Failed to delete record.'];
        }
        echo json_encode($response);
        break;
    }
*/
