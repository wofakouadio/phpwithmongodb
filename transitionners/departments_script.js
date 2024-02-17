$(document).ready(()=>{
    $("#new-department-form").on("submit", (e)=>{
        e.preventDefault()
        let formData = $("#new-department-form").serialize()
        console.log(formData)
    })
})