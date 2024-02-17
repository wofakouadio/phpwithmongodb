$(document).ready(()=>{

    $("#signin_form").on("submit", (e)=>{
        e.preventDefault();
        Swal.fire({
        title: 'Error!',
        text: 'Do you want to continue',
        icon: 'error',
        confirmButtonText: 'Cool'
      })
      console.log(1)
    })
    
})