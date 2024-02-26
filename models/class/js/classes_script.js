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

    // create new class
    $("#new-class-form").on("submit", (e)=>{
        e.preventDefault()
        let formData = $("#new-class-form").serialize()
        $.ajax({
            url:'../../models/class/server/new-class.php',
            method:'POST',
            data: formData,
            cache: false,
            success: (Response) =>{
                let response = JSON.parse(Response)
                if(response.status === 400){
                    $(".new-class-modal").modal("hide");
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
                            $(".new-class-modal").modal("hide");
                            $("#new-class-form").trigger("reset");
                            $("#ClassesDataTables").DataTable().draw()
                        }
                    })
                }
            }
        })
        
    })

    // show edit department modal to get department info
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

    // update department 
    $("#edit-department-form").on("submit", (e)=>{
        e.preventDefault()
        let formData = $("#edit-department-form").serialize()
        $.ajax({
            url:'../../models/department/server/update-department.php',
            method:'POST',
            data: formData,
            cache: false,
            success: (Response) =>{
                let response = JSON.parse(Response)
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
                    Swal.fire({
                        title: 'Notification',
                        html: response.msg,
                        icon: 'success',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        confirmButtonText: 'Close',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(".edit-department-modal").modal("hide");
                            $("#edit-department-form").trigger("reset");
                            $("#DepartmentsDataTables").DataTable().draw()
                        }
                    })
                }
            }
        })
        
    })

    // show delete department modal to get department info
    $(".delete-department-modal").on("show.bs.modal", (e)=>{
        let str = $(e.relatedTarget);
        let id = str.data("id");
        let modal = $(".delete-department-modal")
        $.ajax({
            url:'../../models/department/server/department-data.php',
            method:'POST',
            data: {id:id},
            cache: false,
            success: (Response) =>{
                let response = JSON.parse(Response)
                
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
                    modal.find("#department-notice").html("Are you sure of deleting " + response.data.name + " department ?")
                }
            }
        })
    })

    // delete department 
    $("#delete-department-form").on("submit", (e)=>{
        e.preventDefault()
        let formData = $("#delete-department-form").serialize()
        $.ajax({
            url:'../../models/department/server/delete-department.php',
            method:'POST',
            data: formData,
            cache: false,
            success: (Response) =>{
                let response = JSON.parse(Response)
                if(response.status === 400){
                    $(".delete-department-modal").modal("hide");
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
                            $(".delete-department-modal").modal("hide");
                            $("#delete-department-form").trigger("reset");
                            $("#DepartmentsDataTables").DataTable().draw()
                        }
                    })
                }
            }
        })
        
    })
})