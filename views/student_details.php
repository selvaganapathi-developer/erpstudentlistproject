<?php  // echo "<pre>updatedata";print_r($updatedata);exit(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/dataTables.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/jquery-ui.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/fontawesome.min.css'); ?>">
    
</head>
<style>

.error{
    color:red;
}
#top{
    margin-top:10px;
padding-top:-50px;
}

    th,td{
        text-align:left;
        border-bottom:1px solid #ddd;
    }
    th{
        background-color:#f2f2f2;
    }
    .fa-edit{
        color:blue;
        border:none;
    }
    .fa-trash{
        color:red;
        border:none;
    }
    .reports{
        padding-left:85%;
    }
    .home-page {
      max-width: 100%;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #dee2e6;
      border-radius: 5px;
      background-color: #ffffff;
      box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.3);
    }

    #logout {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 20px;
    width: 100px;
    cursor: pointer; 
}

#logout:hover {
    color: red; 
}
</style>
<body>

<h2 class="home-page">Welcome To Students Details Page <div><span id="logout"><a href="<?php echo base_url('userloginpage/logout'); ?>">Logout</a></span></div></h2>
    <div class="container mt-5">
        <form action="<?php echo base_url('index.php/crud_controller/students_details_save') ?>" method="POST" enctype="multipart/form-data" id="students_details">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <!-- select regulation -->
                        <label for="regulation">Regulation<span>*</span></label>
                        <select name="regulation" id="regulation" class="form-control" autofocus>
                            <option value="">Select Regulation</option>
                            <?php foreach ($data as $d){ ?>
                            <option value="<?php echo $d['regulation_name'] ?>"><?php echo $d['regulation_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="registerno">Register Number<span>*</span></label>
                        <input type="text" class="form-control" id="registerno" name="registerno" required placeholder="Enter Your Register Number">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="name">Student Name<span>*</span></label>
                        <input type="text" class="form-control" id="name" name="name" required placeholder="Enter Your Name">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="dob">Date of Birth<span>*</span></label>
                        <input id="dob" autocomplete="off" placeholder="DD-MM-YYYY" class="form-control" type="text" name="dob" />                
                    </div>
                            </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="email">Email Address<span>*</span></label>
                        <input type="email" class="form-control" id="email" name="email" required placeholder="yourmail@gmail.com">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="contact">Contact Number<span>*</span></label>
                        <input type="text" class="form-control" id="contact" name="contact" required placeholder="Enter Your Contact Number">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="csemester">Current Semester<span>*</span></label>
                        <select name="csemester" id="" class="form-control">
                            <option value="">Select Your Current Semester</option>
                            <?php foreach ($data as $d){ ?>
                            <option value="<?php echo $d['semester'] ?>"><?php echo $d['semester'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="percentage">Percentage<span>*</span></label>
                        <input type="text" class="form-control" id="percentage" name="percentage" required placeholder="Enter Your Contact Number">
                    </div>
                </div>
            </div>
        <div class="col-md-offset-5 col-md-9">
            <button type="submit" id="save" class="btn btn-success">Save</button>
            <button type="button" class="btn btn-danger">Cancel</button>
            <button type="button" class="btn btn-success hide-btn" ><a href="<?php echo base_url('index.php/crud_controller/listing_data') ?>">Listing Data</a></button> 
        </div>

        <div class="reports">
        <a class="btn bg-primary text-white" href="<?php echo base_url('crud_controller/downloadexcel'); ?>"><i class="pdf-icon fas fa-file-excel"></i>EXCEl</a>
        <a class="btn bg-primary text-white" href="<?php echo base_url('crud_controller/downloadpdf'); ?>"><i class="pdf-icon fas fa-file-pdf"></i>PDF</a>
        </div>

        </form>
    </div>
   

                <!--Boostrap Model Popup Boxes-->
                    <!-- The Modal -->
            <div class="modal" id="myModal">
            <div class="modal-dialog">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Students Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

            </div>

        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  
</div>



       <div id="top"></div>                         
    <table id="myTable" class="table table-striped table-bordered" >
        <thead>
            <tr>
                <th>S.no</th>
                <th>Regulation</th>
                <th>Register Number</th>
                <th>Student Name</th>
                <th>Date of birth</th>
                <th>Email Address</th>
                <th>Contact Number</th>
                <th>Current Semester</th>
                <th>Percentage</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1; ?>
           <?php foreach($studentdata as $row) { ?> 
     <tr>
        <?php //echo "<pre>";print_r($row);exit; ?>
        <td><?php echo $i ?></td>
        <td><?php echo $row['stud_regulation'] ?></td>
        <td><?php echo $row['stud_registration'] ?></td>
        <td><?php echo $row['stud_name'] ?></td>
        <td><?php echo $row['date_of_birth'] ?></td>
        <td><?php echo $row['stud_email'] ?></td>
        <td><?php echo $row['contact_number'] ?></td>
        <td><?php echo $row['current_sem'] ?></td>
        <td><?php echo $row['percentage'] ?></td>
        <td>
    <a data-toggle="modal" data-target="#myModal" data-id="<?php echo $row['id']; ?>" class="editBtn"><i class="fa fa-edit loader-click" title="edit"></i></a>
    <a href="<?php echo base_url('index.php/crud_controller/delete/' . $row['id']); ?>"><i class="fa fa-trash" title="delete"></i></a>
</td>

       </tr>
       
         <?php $i++;  } ?> 
        </tbody>
    </table>

</body>
</html>

<script src="<?php echo base_url('assets/jquery.min.js'); ?>"></script>
<!--jquery form validation-->
<script src="<?php echo base_url('assets/jqueryformvalidation.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/jquery-ui.js'); ?>"></script>
<script>
 // JavaScript code to initialize DataTable with custom options
$(document).ready(function() {
    let table = $('#myTable').DataTable({
         scrollY: '400px', // Set vertical scroll height
         lengthMenu: [100], // Set options for entries per page

    });
});

</script>
<script>
    $(document).ready(function() {
    $('.editBtn').click(function() {
        var id = $(this).data('id');
        $.ajax({
            url: "<?php echo base_url('index.php/crud_controller/updating/'); ?>" + id,
            type: 'GET',
            dataType: 'html',
            success: function(response) {
                $('#myModal .modal-body').html(response);
                $('#myModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});

</script>
<script>
    // let table = new DataTable('#myTable');
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    // Get the button element
    var button = document.querySelector(".hide-btn");
    // Hide the button by adding "d-none" class
    button.classList.add("d-none");
  });
 $( function() {
    $( "#dob" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat:'dd-mm-yy',
    yearRange: '2000:2010',
    });
  } );

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
