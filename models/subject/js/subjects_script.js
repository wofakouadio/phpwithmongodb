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

    // show edit class modal to get class info
    $(".edit-class-modal").on("show.bs.modal", (e)=>{
        let str = $(e.relatedTarget);
        let id = str.data("id");
        let modal = $(".edit-class-modal")
        $.ajax({
            url:'../../models/class/server/class-data.php',
            method:'POST',
            data: {id:id},
            cache: false,
            success: (Response) =>{
                let response = JSON.parse(Response)
                
                if(response.status === 400){
                    $(".edit-class-modal").modal("hide");
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
                    modal.find("input[name=class-id]").val(response.data.id)
                    modal.find("input[name=class-name]").val(response.data.name)
                    modal.find("select[name=class-status]").val(response.data.status)
                }
            }
        })
    })

    // update class 
    $("#edit-class-form").on("submit", (e)=>{
        e.preventDefault()
        let formData = $("#edit-class-form").serialize()
        $.ajax({
            url:'../../models/class/server/update-class.php',
            method:'POST',
            data: formData,
            cache: false,
            success: (Response) =>{
                let response = JSON.parse(Response)
                if(response.status === 400){
                    $(".edit-class-modal").modal("hide");
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
                            $(".edit-class-modal").modal("hide");
                            $("#edit-class-form").trigger("reset");
                            $("#ClassesDataTables").DataTable().draw()
                        }
                    })
                }
            }
        })
        
    })

    // show delete class modal to get class info
    $(".delete-class-modal").on("show.bs.modal", (e)=>{
        let str = $(e.relatedTarget);
        let id = str.data("id");
        let modal = $(".delete-class-modal")
        $.ajax({
            url:'../../models/class/server/class-data.php',
            method:'POST',
            data: {id:id},
            cache: false,
            success: (Response) =>{
                let response = JSON.parse(Response)
                
                if(response.status === 400){
                    $(".edit-class-modal").modal("hide");
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
                    modal.find("input[name=class-id]").val(response.data.id)
                    modal.find("#class-notice").html("Are you sure of deleting " + response.data.name + " class ?")
                }
            }
        })
    })

    // delete class 
    $("#delete-class-form").on("submit", (e)=>{
        e.preventDefault()
        let formData = $("#delete-class-form").serialize()
        $.ajax({
            url:'../../models/class/server/delete-class.php',
            method:'POST',
            data: formData,
            cache: false,
            success: (Response) =>{
                let response = JSON.parse(Response)
                if(response.status === 400){
                    $(".delete-class-modal").modal("hide");
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
                            $(".delete-class-modal").modal("hide");
                            $("#delete-class-form").trigger("reset");
                            $("#ClassesDataTables").DataTable().draw()
                        }
                    })
                }
            }
        })
        
    })
})