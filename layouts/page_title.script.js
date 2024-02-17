$(document).ready(()=>{
    // get current page filename
    let page_title = location.pathname.split("/").slice(-1)[0];
    // check if current page against various filenames
    if(page_title == "dashboard"){
        $("#page_title").html("Dashboard")
        $("#dash_page_name").html("Dashboard")
    }
    else if(page_title == "add-user"){
        $("#page_title").html("Users")
        $("#dash_page_name").html("New User")
        $("#breadcrumb-header").html("Users")
        $("#breadcrumb-title").html("New User")
    }
    else if(page_title == "add-permission"){
        $("#page_title").html("Permissions")
        $("#dash_page_name").html("New Permission")
        $("#breadcrumb-header").html("Permissions")
        $("#breadcrumb-title").html("New Permission")
    }
    else if(page_title == "departments"){
        $("#page_title").html("Departments")
        $("#dash_page_name").html("Departments")
        $("#breadcrumb-header").html("Departments")
        $("#breadcrumb-title").html("ListView")
    }
    
})