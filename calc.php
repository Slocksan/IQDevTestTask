<?php
    $start_date = $_POST["startDate"];
    $sum = 0;
    $term = 0;
    $percent = 0;
    $sumAdd = $_POST["sumAdd"];

    function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    function isfloat($f) { return ($f == (string)(float)$f);};

    function isint($i) { return ($i == (string)(int)$i);};

    // Валидация даты
    if(!validateDate($start_date, "d.m.Y")){
        header(':', true, 400);
        echo ("Неверный формат даты");
    }

    // Валидация суммы вклада
    if (isfloat($_POST["sum"])) {
        $sum = floatval($_POST["sum"]);
    }
    elseif (isint($_POST["sum"])) {
        $sum = intval($_POST["sum"]);
    }
    else {
        header(':', true, 400);
        echo("Сумма вклада должна быть числом");
    }

    if(!($sum >= 1000) || !($sum <= 3000000)) {
        header(':', true, 400);
        echo("Сумма вклада должна находится в промежутке от 1000 до 3000000");
    }

    // Валидация количества месяцев
    if (isint($_POST["term"])) {
        $term = intval($_POST["term"]);
    }
    else {
        header(':', true, 400);
        echo("Количество месяцев должно быть целым числом");
    }

    if(!($term >= 1) || !($term <= 60)) {
        header(':', true, 400);
        echo("Количество месяцев должно быть в промежутке от 1 до 60 (От 1 до 5 лет)");
    }

    // Валидация процентов

    if (isint($_POST["percent"])) {
        $percent = intval($_POST["percent"]);
    }
    else {
        header(':', true, 400);
        echo("Проценты должны быть представлены в виде целого числа");
    }

    if(!($percent >= 3) || !($percent <= 100)) {
        header(':', true, 400);
        echo("Проценты должны быть в промежутке от 3 до 100");
    }

    // Валидация суммы ежем. пополнения

    if (isfloat($_POST["sumAdd"])) {
        $sumAdd = floatval($_POST["sumAdd"]);
    }
    elseif (isint($_POST["sumAdd"])) {
        $sumAdd = intval($_POST["sumAdd"]);
    }
    else {
        header(':', true, 400);
        echo("Сумма ежемесячного пополнения должна быть числом");
    }

    if(!($sum >= 0) || !($sum <= 3000000)) {
        header(':', true, 400);
        die("Сумма ежемесячного пополнения должна находится в промежутке от 0 до 3000000");
    }

    // Расчет итоговой суммы

    function cal_days_in_year($year)
    {
        $days = 0;
        for ($month = 1; $month <= 12; $month++) {
            $days = $days + cal_days_in_month(CAL_GREGORIAN, $month, $year);
        }
        return $days;
    }

    function MonthShifter (DateTime $aDate,$months){
        $dateA = clone($aDate);
        $dateB = clone($aDate);
        $plusMonths = clone($dateA->modify($months . ' Month'));
        //check whether reversing the month addition gives us the original day back
        if($dateB != $dateA->modify($months*-1 . ' Month')){
            $result = $plusMonths->modify('last day of last month');
        } elseif($aDate == $dateB->modify('last day of this month')){
            $result =  $plusMonths->modify('last day of this month');
        } else {
            $result = $plusMonths;
        }
        return $result;
    }

    $result_sum = $sum;

    $current_date = DateTime::createFromFormat("d.m.Y", $start_date);

    for ($i = 0; $i < $term; $i++) {
        $next_date = MonthShifter($current_date, 1);

        if ($i != 0) {
            $result_sum += $sumAdd;
        }

        $result_sum = $result_sum + ($result_sum) *
            ((cal_days_in_month(CAL_GREGORIAN, intval($current_date -> format("n")),
                        intval($current_date -> format("Y"))) - intval($current_date -> format("j"))) +
                            intval($next_date -> format("j")))
        * ($percent / 100) / cal_days_in_year(intval(MonthShifter($current_date, 1) -> format("Y")));
        $current_date = $next_date;
    }

    $result_sum = round($result_sum, 2);
    echo json_encode(array("sum" => " $result_sum"));
