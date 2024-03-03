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

    // create new subject
    $("#new-subject-form").on("submit", (e)=>{
        e.preventDefault()
        let formData = $("#new-subject-form").serialize()
        $.ajax({
            url:'../../models/subject/server/new-subject.php',
            method:'POST',
            data: formData,
            cache: false,
            success: (Response) =>{
                let response = JSON.parse(Response)
                if(response.status === 400){
                    $(".new-subject-modal").modal("hide");
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
                            $(".new-subject-modal").modal("hide");
                            $("#new-subject-form").trigger("reset");
                            $("#SubjectsDataTables").DataTable().draw()
                        }
                    })
                }
            }
        })
        
    })

    // show edit subject modal to get subject info
    $(".edit-subject-modal").on("show.bs.modal", (e)=>{
        let str = $(e.relatedTarget);
        let id = str.data("id");
        let modal = $(".edit-subject-modal")
        $.ajax({
            url:'../../models/subject/server/subject-data.php',
            method:'POST',
            data: {id:id},
            cache: false,
            success: (Response) =>{
                let response = JSON.parse(Response)
                
                if(response.status === 400){
                    $(".edit-subject-modal").modal("hide");
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
                    modal.find("input[name=subject-id]").val(response.data.id)
                    modal.find("input[name=subject-code]").val(response.data.code)
                    modal.find("input[name=subject-name]").val(response.data.name)
                    modal.find("textarea[name=subject-description]").val(response.data.description)
                    modal.find("select[name=subject-status]").val(response.data.status)
                }
            }
        })
    })

    // update subject 
    $("#edit-subject-form").on("submit", (e)=>{
        e.preventDefault()
        let formData = $("#edit-subject-form").serialize()
        $.ajax({
            url:'../../models/subject/server/update-subject.php',
            method:'POST',
            data: formData,
            cache: false,
            success: (Response) =>{
                let response = JSON.parse(Response)
                if(response.status === 400){
                    $(".edit-subject-modal").modal("hide");
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
                            $(".edit-subject-modal").modal("hide");
                            $("#edit-subject-form").trigger("reset");
                            $("#SubjectsDataTables").DataTable().draw()
                        }
                    })
                }
            }
        })
        
    })

    // show delete subject modal to get subject info
    $(".delete-subject-modal").on("show.bs.modal", (e)=>{
        let str = $(e.relatedTarget);
        let id = str.data("id");
        let modal = $(".delete-subject-modal")
        $.ajax({
            url:'../../models/subject/server/subject-data.php',
            method:'POST',
            data: {id:id},
            cache: false,
            success: (Response) =>{
                let response = JSON.parse(Response)
                
                if(response.status === 400){
                    $(".edit-subject-modal").modal("hide");
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
                    modal.find("input[name=subject-id]").val(response.data.id)
                    modal.find("#subject-notice").html("Are you sure of deleting " + response.data.name + " subject ?")
                }
            }
        })
    })

    // delete subject 
    $("#delete-subject-form").on("submit", (e)=>{
        e.preventDefault()
        let formData = $("#delete-subject-form").serialize()
        $.ajax({
            url:'../../models/subject/server/delete-subject.php',
            method:'POST',
            data: formData,
            cache: false,
            success: (Response) =>{
                let response = JSON.parse(Response)
                if(response.status === 400){
                    $(".delete-subject-modal").modal("hide");
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
                            $(".delete-subject-modal").modal("hide");
                            $("#delete-subject-form").trigger("reset");
                            $("#SubjectsDataTables").DataTable().draw()
                        }
                    })
                }
            }
        })
        
    })
})