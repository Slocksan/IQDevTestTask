<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deposit Calculator</title>
    <link rel=stylesheet href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"> 
    <link href="assets/air-datepicker-master/dist/css/datepicker.min.css" rel="stylesheet" type="text/css">
</head>
<body>
    <header>
        <div class="header_content">
            <a href="#"><img class="header_logo" src="images/logo-light 1.png" alt="IQDev"></a>
            <a href="#" class="header_text">Deposit Calculator</a>
        </div>
    </header>
    <div class="content">
        <div class="content_text">
            <h1>Депозитный калькулятор</h1>
            <p>Калькулятор депозитов позволяет рассчитать ваши доходы после внесения суммы на счет в банке по опредленному тарифу.</p>
        </div>
        <form>
            <div class="form_row">
                <div class="input_field">
                    <input id="start_date" class="datepicker-here input" name="datepicker" type='text' readonly>
                    <title>Дата откытия</title>
                </div>
                <div class="input_field">
                    <input id="date_count" class="input_date_count required" name="date_count" type="text">
                    <title class="input_date_title">Срок вклада</title>
                    <div class="date_type_select custom-select">
                        <select id="date_type" class="input_date_type">
                            <option value="year">Год</option>
                            <option value="month">Месяц</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form_row">
                <div class="input_field">
                    <input id="sum_invest" class="input" name="sum_to_invest" type="text">
                    <title>Сумма вклада</title>
                </div>
                <div class="input_field">
                    <input id="percent" class="input" name="percent_input" type="text">
                    <title>Процентная ставка, % годовых</title>
                </div>
            </div>
            <div class="form_row">
                <div class="monthly_add">
                    <div id="monthly_add_checkbox" class="monthly_add_checkbox"><div id="ok_ellement"></div></div>
                    <span class="monthly_add_text">Ежемесячное пополнение вклада</span>
                </div>
                <div class="input_field">
                    <input id="sum_to_add" class="input" type="text" name="sum_to_add">
                    <title id="sum_to_add_title">Сумма пополнения вклада</title>
                </div>
            </div>
            <div class="form_row">
                <button type="button" class="to_count_button" >Рассчитать</button>
            </div>
            <div class="result_sum_block">
                <hr>
                <span>Сумма к выплате</span>
                <br>
                <span id="result_sum">₽ 0</span>
            </div>
        </form>
    </div>

    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/jquery.validate.js"></script>
    <script src="assets/js/additional-methods.js"></script>
    <script src="assets/air-datepicker-master/dist/js/datepicker.min.js"></script>
    <script src="script.js"></script>
</body>
</html>