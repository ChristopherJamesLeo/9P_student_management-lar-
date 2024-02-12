// start jquey area
$(document).ready(function(){
    // start show hide aside btn
    $(".aside_show_btn").click(function(){
        $(this).toggleClass("active");
        $("#left_side_container").toggleClass("active");
    })
    // end show hide aside btn

    // start noti 



})
// end jquery area
function showlist(){
    document.querySelector(".show_noti_list").classList.toggle("active");
}


function showProfileSet(){
    document.querySelector(".show_profile_setting").classList.toggle("active");
}

