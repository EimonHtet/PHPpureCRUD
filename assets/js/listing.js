// $(document).ready(function(){
//     alert("hello");
// });
var base_url = "http://localhost/crud_tuto/";
function checkValidation() {
    var full_name = $('#fullName').val();
    var email = $('#email').val();
    var salary = $('#salary').val();
    var city = $('#city').val();
    var error = false;
    if(full_name=="") {
        error =true;
        $('#fullNameValidationError').text("Please Fill Name");
        $('#fullNameValidationError').show();
    }
    else {
        
        if(validateName(full_name) == false) {
            error = true; 
            $('#fullNameValidationError').text("Invalid Name");
            $('#fullNameValidationError').show();  
        } else {
            
            $('#fullNameValidationError').hide();
        }
        
    }
    

    if(email=="") {
        error = true;
        $('#emailValidationError').text("Please Fill Email Address");
        $('#emailValidationError').show();
    } else {
        if(validateEmail(email) == false) {
            error = true; 
            $('#emailValidationError').text("Invalid email address");
            $('#emailValidationError').show();  
        } else {
            var chkEmail = checkUniqueEmail(email);
            //console.log(chkEmail.status);
            
            if (chkEmail != '200') {
                $('#emailValidationError').text("The email address is already exit");
                $('#emailValidationError').show();
                error = true;
            }
            else {
                $('#emailValidationError').hide();
            }
        }
    }

    if(salary=="") {
        error = true;
        $('#salaryValidationError').text("Please Fill Salary");
        $('#salaryValidationError').show();
    } else {
        if (isInt(parseInt(salary)) || isFloat(parseInt(salary))) {
            $('#salaryValidationError').hide();
        } else {
                error = true;
                $('#salaryValidationError').text("Only Number and decimal allow");
                $('#salaryValidationError').show();
            }
        
    }

    if(city=="") {
        error = true;
        $('#cityValidationError').show();
    }
    else {
        $('#cityValidationError').hide();
    }
    
    if(error == false) {    
        var id = $("#id").val();
        if(id == "") {
            insertEmployee(full_name,email,salary,city);
        }
        else {
            updateEmployee(id,full_name,email,salary,city);
        }

    }

}
function insertEmployee(full_name,email,salary,city) {
    $.ajax({
        url: base_url + "insert_employee.php",
        dataType: "JSON",
        type: "post",
        contentType:"application/x-www-form-urlencoded",
        data: {
            full_name: full_name,
            email: email,
            salary: salary,
            city: city,
        },
        success: function( response, textStatus, jQxhr ){
            if(response.status==200) {
                $('#fullName').val("");
                $('#email').val("");
                $('#salary').val("");
                $('#city').val("");
                asyncEmployee();
            }
            else {
                alert("Can not insert")
            }
         },
        error: function( jqXhr, textStatus, errorThrown ){
           // console.log( errorThrown );
        },
        
    });
}
function asyncEmployee() {
    $.ajax({
        url: base_url + "async_employee.php",
        dataType: "JSON",
        type: "get",
        contentType:"application/x-www-form-urlencoded",
        
        success: function( response, textStatus, jQxhr ){
            var html="";
            if(textStatus =='success') {
                document.getElementById("e-wrapper").innerHTML="";
                for(var i=0; i < response.length; i++) {
                    //console.log(response[i]);
                    html += "<tr>";
                    html += "<td>" + response[i].full_name + "</td>";
                    html += "<td>" + response[i].email + "</td>";
                    html += "<td>" + response[i].salary+"</td>";
                    html += "<td>" + response[i].city+"</td>";
                    html += "<td><button style='background:blue; color:white' onclick='editEmployee(\"" + response[i].id + "\")'>Edit</button> <button style='background:red; color:white' onclick='deleteEmployee(\"" + response[i].id + "\")'>Delete</button></td>";
                    html += "</tr>";
                     
                }
                document.getElementById("e-wrapper").innerHTML=html;
                } else {
                    alert("something wrong")
                }
        },
        error: function( jqXhr, textStatus, errorThrown ){
           // console.log( errorThrown );
        },
        
    });
}
function editEmployee(id) {
    //alert(id);
    $.ajax({
        url: base_url + "edit_employee.php?id="+id,
        dataType: "JSON",
        type: "get",
        contentType:"application/x-www-form-urlencoded",
        
        success: function( response, textStatus, jQxhr ){
            if(textStatus =='success') {
                
                    //console.log(response[0]);
                    var result = response[0];
                    $('#fullName').val(result.full_name);
                    $('#email').val(result.email);
                    $('#salary').val(result.salary);
                    $('#city').val(result.city);
                    $('#id').val(result.id);
                     
                } else {
                    alert("something wrong")
                }
        },
        error: function( jqXhr, textStatus, errorThrown ){
           // console.log( errorThrown );
        },
        
    });
}
function updateEmployee(id,full_name,email,salary,city) {
    //alert ("hello");
    $.ajax({
        url: base_url + "update_employee.php",
        dataType: "JSON",
        type: "post",
        contentType:"application/x-www-form-urlencoded",
        data: {
            id : id,
            full_name: full_name,
            email: email,
            salary: salary,
            city: city,
        },
        success: function( response, textStatus, jQxhr ){
            if(response.status==200) {
                $('#fullName').val("");
                $('#email').val("");
                $('#salary').val("");
                $('#city').val("");
                $('#id'). val("");
                asyncEmployee();
            }
            else {
                alert("Can not update")
            }
         },
        error: function( jqXhr, textStatus, errorThrown ){
           // console.log( errorThrown );
        },
        
    });
}
function deleteEmployee(id) {
    $.ajax({
        url: base_url + "delete_employee.php?id="+id,
        dataType: "JSON",
        type: "get",
        contentType:"application/x-www-form-urlencoded",
        
        success: function( response, textStatus, jQxhr ){
            if(textStatus =='success') {
                
                    //console.log(response[0]);
                    // var result = response[0];
                    // $('#fullName').val(result.full_name);
                    // $('#email').val(result.email);
                    // $('#salary').val(result.salary);
                    // $('#city').val(result.city);
                    // $('#id').val(result.id);
                    asyncEmployee();
                     
                } else {
                    alert("something wrong")
                }
        },
        error: function( jqXhr, textStatus, errorThrown ){
           // console.log( errorThrown );
        },
        
    });
}
function clearForm() {
    $('#fullName').val("");
    $('#email').val("");
    $('#salary').val("");
    $('#city').val("");
    $('#fullNameValidationError').hide();
    $('#emailValidationError').hide();
    $('#salaryValidationError').hide();
    $('#cityValidationError').hide();
}
function validateName(full_name) {
    // var regName = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
    // var regInt =/^([1-9]|[1-9]\d+)$/;
    
    // return regName.test(full_name) || regInt.test(full_name);

    var re =/^[A-Za-z]+$/ ;
    return re.test(full_name);

}
function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}
function isInt(n){
    return Number(n) === n && n % 1 === 0;
}

function isFloat(n){
    return Number(n) === n && n % 1 !== 0;
}

function checkUniqueEmail(email){
    // return JSON.parse(
        $.ajax({
            type: "post",
            data: {
                email: email,
            },
            url: base_url + "check_email.php",
            dataType: 'json',
            global : false,
            async : false,
            success: function(data){
                alert(data);
                return data;
            },
            error: function( jqXhr, textStatus, errorThrown ){
                console.log( errorThrown );
             },
        }
//    }).responseTest
 );
}
