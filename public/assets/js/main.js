$(document).ready(function() {
    
    // Hide form elements
    $("#admin_form").hide();

    // Form Show hide
    $("#adminBtn").click(function() {
        $("#admin_form").toggle(400);
        let icon = $("#icon");
        icon.toggleClass('fa-plus fa-minus');
    })

});