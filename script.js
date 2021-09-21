$( document ).ready(function() {
    // Очищение полей для ввода при обновлении страницы
    let inputs = document.getElementsByClassName("input");
    for (let i = 0; i < inputs.length; i++) {
        inputs[i].value = "";
    }
    document.getElementById("date_count").value = "";
    
    // Появление поля для ввода суммы для ежемесячного пополнения
    let monthly_checkbox = document.getElementById("monthly_add_checkbox");
    let monthly_okellement = document.getElementById("ok_ellement");
    let add_sum = document.getElementById("sum_to_add");
    let add_sum_title = document.getElementById("sum_to_add_title");

    monthly_okellement.style.display = "none";

    monthly_checkbox.addEventListener("click", function() {
        if(monthly_okellement.style.display === "none") {
            monthly_okellement.style.display = "inline-block";
            add_sum.style.display = "inline-block";
            add_sum_title.style.display = "inline-block";
        }
        else {
            monthly_okellement.style.display = "none";
            add_sum.value = "";
            $("#sum_to_add").valid();
            add_sum.style.display = "none";
            add_sum_title.style.display = "none";
        }
    })


    // Сдвиг надписи-подсказки в полях формы при вводе информации
    let input_fields = document.getElementsByClassName("input_field");

    for (let i = 0; i < input_fields.length; i++) {
        let input_title = input_fields[i].querySelector("title");
        let input_element = input_fields[i].querySelector("input");

        document.addEventListener("click", function(evt) {
            if (evt.target === input_element) {
                input_title.style.marginTop = "10px";
            }
            else {
                if(input_element.value.length === 0){
                    input_title.style.marginTop = "20px";
                }
            }
        })
    }

    

    // Валидация полей формы
    $("form").validate(
        {
            rules: {
                datepicker: {
                    required: true
                },
                percent_input: {
                    required: true,
                    min: 3,
                    max: 100,
                    integer: true
                },
                sum_to_invest: {
                    required: true,
                    min: 1000,
                    max: 3000000,
                    number: true
                },
                date_count: {
                    required: true,
                    number: true
                },
                sum_to_add: {
                    min: 0,
                    max: 3000000
                }
            }
        }
    )

    function setDateFieldValidation() {
        if (document.getElementById("date_type").value == "year") {
            $("#date_count").rules("remove", "min max");
            $("#date_count").rules("add", {
                    min: 1,
                    max: 5
                }
            );
        }
        else {
            $("#date_count").rules("remove", "min max");
            $("#date_count").rules("add", {
                    min: 1,
                    max: 60
                }
            )
        }
    }
    setDateFieldValidation();
    document.getElementById("date_type").addEventListener("change", function() {
        setDateFieldValidation();
        $("#date_count").valid();
    })
});