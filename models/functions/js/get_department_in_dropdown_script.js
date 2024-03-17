$(document).ready(()=>{

    // function to fetch department in select form input type
    const GetDepartmentInDropdown = () =>{
        $.ajax({
            url:'../../models/functions/server/get_department_in_dropdown.php',
            success: (Response)=>{
                $("#teacher-department").html(Response);
                // $("#new-teacher-form select[name=teacher-department]").html(Response);
            }
        })
    }
    GetDepartmentInDropdown();
})