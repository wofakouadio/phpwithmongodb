$(document).ready(()=>{

    const GetDepartmentInDropdown = () =>{
        $.ajax({
            url:'../../models/functions/server/get_department_in_dropdown.php',
            method: 'GET',
            cache:false,
            success: (Response)=>{
                $("#new-teacher-form select[name=teacher-department]").html(Response);
            }
        })
    }
    GetDepartmentInDropdown();
})