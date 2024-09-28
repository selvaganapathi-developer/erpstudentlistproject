<?php  //echo "<pre>data";print_r($data);exit; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Update Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/dataTables.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/jquery-ui.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/fontawesome.min.css'); ?>">
</head>
<style>
    .poperror{
        color:red;
    }
    .ui-datepicker {
    z-index: 1051 !important; /* Ensure it's higher than the modal (1050 by default in Bootstrap) */
}
</style>
<body>
    <div class="container mt-6">
        <form action="<?php  echo base_url("index.php/crud_controller/updated_data/") . $data['id']; ?>" method="POST" enctype="multipart/form-data" id="students_details">
            <div class="row">
            <div class="col-lg-6">
                    <div class="form-group">
                        <!-- select regulation -->
                        <label for="regulation">Regulations<span class="poperror">*</span></label>
                        <select name="regulation" id="regulation" class="form-control" autofocus>
                        <option value="">Select Regulation</option>
                        <?php foreach ($regulations as $r){ ?>
                        <option value="<?php echo $r['regulation_name']; ?>" <?php if($data['stud_regulation'] == $r['regulation_name']) echo 'selected'; ?>>
                        <?php echo $r['regulation_name']; ?>
                        </option>
                        <?php } ?>
                        </select>

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="registerno">Register Number<span class="poperror">*</span></label>
                        <input type="text" class="form-control" id="registerno" name="registerno" required placeholder="Enter Your Register Number" value="<?php echo $data['stud_registration'];  ?>">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name">Student Name<span class="poperror">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" required placeholder="Enter Your Name" value="<?php echo $data['stud_name'];  ?>">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="dob">Date of Birth<span class="poperror">*</span></label>
                        <input id="dob" autocomplete="off" placeholder="DD-MM-YYYY" class="form-control" type="text" name="dob"  value="<?php echo $data['date_of_birth'];  ?>" />                
                    </div>
                            </div>
                    <div class="col-lg-6">
                    <div class="form-group">
                        <label for="email">Email Address<span class="poperror">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" required placeholder="yourmail@gmail.com" value="<?php echo $data['stud_email'];  ?>">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="contact">Contact Number<span class="poperror">*</span></label>
                        <input type="text" class="form-control" id="contact" name="contact" required placeholder="Enter Your Contact Number" value="<?php echo $data['contact_number'];  ?>">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="csemester">Current Semester<span class="poperror">*</span></label>
                        <select name="csemester" id="" class="form-control">
                        <option value="">Select Your Current Semester</option>
                        <?php foreach ($regulations as $r){ ?>
                        <option value="<?php echo $r['semester']; ?>" <?php if($data['current_sem'] == $r['semester']) echo 'selected'; ?>>
                        <?php echo $r['semester']; ?>
                        </option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="percentage">Percentage<span class="poperror">*</span></label>
                        <input type="text" class="form-control" id="percentage" name="percentage" required placeholder="Enter Your Percentage" value="<?php echo $data['percentage'];  ?>">
                    </div>
                </div>
            </div>
        <div class="col-md-offset-5 col-md-9">
            <button type="submit" id="save" class="btn btn-info">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
        </form>
    </div>
</body>
</html>
<script src="<?php echo base_url('assets/jquery.min.js'); ?>"></script>
<!--jquery form validation-->
<script src="<?php echo base_url('assets/jqueryformvalidation.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/jquery-ui.js'); ?>"></script>

<script>
$(document).ready(function() {
    // Initialize datepicker when document is ready
    $('#dob').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd-mm-yy',
        yearRange: '2000:2010'
    });
});


      ///validation for first name capital
      $('#name').on('keyup', function () {
            var str = $(this).val();
            str = str.charAt(0).toUpperCase() + str.slice(1);
            $(this).val(str);
        });



        //validation for first name and last name
        $('#name').on('keypress', function (event) {
            var regex = new RegExp("^[a-zA-Z]+$");
            var key = String.fromCharCode(event.which);
            if (!regex.test(key)) {
                event.preventDefault();
            }
        });



        // validation for email
        $('#email').on('input', function () {
            var regex = new RegExp(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/);
            var inputVal = $(this).val();
            inputVal = inputVal.toLowerCase(); // Convert the input to lowercase
            $(this).val(inputVal); // Set the updated value back to the input field
            if (!regex.test(inputVal)) {
                $(this).css('border-color', 'red'); // Apply a red border color to indicate invalid input
            } else {
                $(this).css('border-color', ''); // Remove the border color if input is valid
            }
        });

        //validation for mobile  number 
        $(document).ready(function () {
            $('#contact').on('keypress', function (event) {
                var regex = new RegExp("^[6-9][0-9]*$");
                var key = String.fromCharCode(event.which);
                var inputVal = $(this).val() + key;
                if (!regex.test(inputVal) || inputVal.length > 10) {
                    event.preventDefault();
                }
            });

            $('#contact').on('input', function () {
                var regex = new RegExp("^[6-9][0-9]{0,9}$");
                var inputVal = $(this).val();
                if (!regex.test(inputVal)) {
                     $(this).val(inputVal.slice(0, 10));
                }
            });
        });

        $('#registerno').on('keypress', function (event) {
                var regex = new RegExp("^[0-9][0-9]*$");
                var key = String.fromCharCode(event.which);
                var inputVal = $(this).val() + key;
                if (!regex.test(inputVal) || inputVal.length > 10) {
                    event.preventDefault();
                }
            });



        $(document).ready(function(){
            $('#students_details').validate({
                rules:{
                    regulation:{
                        required:true,
                    },
                    registerno:{
                        required:true,
                    },
                    name:{
                        required:true,
                    },
                    dob:{
                        required:true,
                    },
                    email:{
                        required:true,
                    },
                    contact:{
                        required:true,digits:true,
                        min:10,
                    },
                    csemester:{
                        required:true,
                    },
                    percentage:{
                        required:true,
                        digits:true,
                        max:100,
                    },

                },
                messages:{
                    regulation:{
                        required:"Select Your regulation",
                    },
                    registerno:{
                        required:"Enter Your Register Number",
                    },
                    name:{
                        required:"Enter Your Name",
                    },
                    dob:{
                        required: "Select Your Date of birth",
                      
                    },
                    email:{
                        required:"Enter  Your Valid Email Address",
                    },
                    contact:{
                        required:"Enter  Your Contact Number",
                    },
                    csemester:{
                        required:"Select  Your Current Semester",
                    },
                    percentage:{
                        required:"Enter  Your Mark Percentage",
                    },
                },
            });
        });
</script>