<?php
require ('config/check_login.php');
require ('template/header.php');

?>

	<h1><center>JavaScript CRUD Example Tutorial</center></h1>
	<hr>
			<div class="employee-form">
                <form  autocomplete="off">
                    <div>
                        <label>Full Name*</label><label class="validation-error hide" id="fullNameValidationError"></label>
                        <input type="text" name="fullName" id="fullName" value="">
                    </div>
                    <div>
                        <label>Email Id</label><label class="validation-error hide" id="emailValidationError"></label>
                        <input type="text" name="email" id="email">
                    </div>
                    <div>
                        <label>Salary</label><label class="validation-error hide" id="salaryValidationError"></label>
                        <input type="text" name="salary" id="salary">
                    </div>
                    <div>
                        <label>City</label><label class="validation-error hide" id="cityValidationError">The city field is required.</label>
                        <input type="text" name="city" id="city">
                    </div>
                    <div  class="form-action-buttons">
                        <input type="button" value="Clear" onclick="clearForm();" style="background:#014242">
                        <input type="button" value="Submit" onclick="checkValidation();">
                        <input type="hidden" value="" name='id' id="id" >
                    </div>
                </form>
		</div>
		<br/>
		<div class = "employees-table">
                <table class="list" id="employeeList">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Email Id</th>
                            <th>Salary</th>
                            <th>City</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="e-wrapper">
                        <?php
                            $sql = "SELECT `id`,`full_name`,`email`,`salary`,`city` FROM `employee` WHERE deleted_at IS NULL";
                            $result = mysqli_query($conn,$sql);
                                if(mysqli_num_rows($result)>0){
                                    while($row = mysqli_fetch_assoc($result)) {
                                        $id = $row['id'];
                                        $full_name = $row['full_name'];
                                        $email = $row ['email'];
                                        $salary = $row ['salary'];
                                        $city = $row['city'];
                        ?>
                                        <tr>
                                            <td><?php echo $full_name; ?></td>
                                            <td><?php echo $email; ?></td>
                                            <td><?php echo $salary; ?></td> 
                                            <td><?php echo $city; ?></td>
                                            <td>
                                                <button style =" background:blue; color:white" onclick="editEmployee('<?php echo $id ?>');">Edit</button>
                                                <button style="background:red; color:white" onclick="deleteEmployee('<?php echo $id ?>');">Delete</button>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                }
                        ?>
                    </tbody>
                </table>
        </div>
    <script src="<?php echo $base_url; ?>assets/js/listing.js"></script>
<?php require('template/footer.php');