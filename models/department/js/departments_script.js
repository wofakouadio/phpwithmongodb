/**
 *  Author : Francis Bennett Kouadio K.
 *  Frameworks Used : JQuery to handle form submission from html to PHP
 * 
 * 
**/ 

$(document).ready(()=>{

    //function to reload / refresh a page
    const RefreshPage = () =>{
        window.location.reload()
    }

    // create new department
    $("#new-department-form").on("submit", (e)=>{
        e.preventDefault()
        let formData = $("#new-department-form").serialize()
        $.ajax({
            url:'../../models/department/server/new-department.php',
            method:'POST',
            data: formData,
            cache: false,
            success: (Response) =>{
                let response = JSON.parse(Response)
                if(response.status === 400){
                    $(".new-department-modal").modal("hide");
                    Swal.fire({
                        title: 'Notification',
                        html: response.msg,
                        icon: 'error',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        confirmButtonText: 'Close',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            RefreshPage()
                        }
                    })
                }
                else if(response.status === 201){
                    Swal.fire({
                        title: 'Notification',
                        html: response.msg,
                        icon: 'warning',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        confirmButtonText: 'Close',
                    })
                }
                else{
                    Swal.fire({
                        title: 'Notification',
                        html: response.msg,
                        icon: 'success',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        confirmButtonText: 'Close',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(".new-department-modal").modal("hide");
                            $("#new-department-form").trigger("reset");
                            $("#DepartmentsDataTables").DataTable().draw()
                        }
                    })
                }
            }
        })
        
    })

    // get department info
    $(".edit-department-modal").on("show.bs.modal", (e)=>{
        let str = $(e.relatedTarget);
        let id = str.data("id");
        let modal = $(".edit-department-modal")
        $.ajax({
            url:'../../models/department/server/department-data.php',
            method:'POST',
            data: {id:id},
            cache: false,
            success: (Response) =>{
                let response = JSON.parse(Response)
                console.log(response)
                if(response.status === 400){
                    $(".edit-department-modal").modal("hide");
                    Swal.fire({
                        title: 'Notification',
                        html: response.msg,
                        icon: 'error',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        confirmButtonText: 'Close',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            RefreshPage()
                        }
                    })
                }
                else if(response.status === 201){
                    Swal.fire({
                        title: 'Notification',
                        html: response.msg,
                        icon: 'warning',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        confirmButtonText: 'Close',
                    })
                }
                else{
                    modal.find("input[name=department-id]").val(response.data.id)
                    modal.find("input[name=department-name]").val(response.data.name)
                    modal.find("textarea[name=department-description]").val(response.data.description)
                    modal.find("select[name=department-status]").val(response.data.status)
                }
            }
        })
    })
})