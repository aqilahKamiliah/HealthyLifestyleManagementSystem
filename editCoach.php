<?php 
include("headerAdmin.php");
include("connection.php");

// 1. Get the ID from the URL and fetch existing data
if(isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $query = "SELECT u.name, u.email, c.specialization, c.experience_years 
              FROM users u 
              JOIN coach c ON u.user_id = c.user_id 
              WHERE u.user_id = $id";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
}

// 2. Handle the Update Request
if(isset($_POST['update'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $spec = mysqli_real_escape_string($conn, $_POST['specialization']);
    $exp = (int)$_POST['experience'];

    // Update Users table (Name)
    $updateUser = "UPDATE users SET name = '$name' WHERE user_id = $id";
    
    // Update Coach table (Specialization and Experience)
    $updateCoach = "UPDATE coach SET specialization = '$spec', experience_years = $exp WHERE user_id = $id";

    if(mysqli_query($conn, $updateUser) && mysqli_query($conn, $updateCoach)) {
        echo "<script>alert('Coach updated successfully!'); window.location.href='listCoach.php';</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<section>
    <div class="container">
        <div class="coachContainer">
            <h3 class="center">Edit Coach Information</h3>
            <form method="POST">
                <table>
                    <tr>
                        <td>Name</td>
                        <td><input type="text" name="name" value="<?php echo htmlspecialchars($data['name']); ?>" required /></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input type="text" value="<?php echo htmlspecialchars($data['email']); ?>" disabled style="background-color: #eee;" /></td>
                    </tr>
                    <tr>
                        <td>Specialization</td>
                        <td><input type="text" name="specialization" value="<?php echo htmlspecialchars($data['specialization']); ?>" required /></td>
                    </tr>
                    <tr>
                        <td>Experience (Years)</td>
                        <td><input type="number" name="experience" value="<?php echo htmlspecialchars($data['experience_years']); ?>" required /></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <br>
                            <input name="update" type="submit" value="Update Information"/>     
                            <input type="button" value="Cancel" onclick="window.location.href='listCoach.php'"/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</section>