$( document ).ready(function() {
    // Появление поля для ввода суммы для ежемесячного пополнения
    let monthly_checkbox = document.getElementById("monthly_add_checkbox");
    let monthly_okellement = document.getElementById("ok_ellement");
    let sum_to_add = document.getElementById("sum_to_add");
    let sum_to_add_title = document.getElementById("sum_to_add_title");

    monthly_okellement.style.display = "none";

    monthly_checkbox.addEventListener("click", function() {
        console.log(monthly_okellement.style)
        if(monthly_okellement.style.display === "none") {
            monthly_okellement.style.display = "inline-block";
            sum_to_add.style.display = "inline-block";
            sum_to_add_title.style.display = "inline-block"
        }
        else {
            monthly_okellement.style.display = "none";
            sum_to_add.style.display = "none";
            sum_to_add_title.style.display = "none";
        }
    })


});