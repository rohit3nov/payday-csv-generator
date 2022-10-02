<?php

namespace Commands;

class GetSalaryDates
{
    private $args;
    private $csv;

    public function __construct(array $args, \Lib\CSV $csv)
    {
        $this->args = $args;
        $this->csv = $csv;
    }
    public function __invoke()
    {
        $year = date('Y');
        $month = date('m');

        if (isset($this->args[2])) {
            $year = (int)$this->args[2];
            $month = 1;
        }
        if ($year == 0 || $year < 1990 || $year > 2030) {
            echo "ERROR: Invalid argument '" . $this->args[2] . "' for command '" . $this->args[1] . "'.\n";
            exit;
        }

        $dateTime = new \DateTime();
        $this->csv->setHeader(["Month","Salary Payment Date","Bonus Payment Date"]);

        for ($month; $month <= 12; $month++) {
            $dateTime->setDate($year, $month, 15);
            $bonusDay = $this->getBonusDate($dateTime);
            $salaryDay = $this->getSalaryDate($dateTime->modify('last day of this month'));

            $this->csv->put([ $year . "-" . $dateTime->format('M') , $salaryDay , $bonusDay ]);
        }
        $this->csv->close();
    }

    public function getSalaryDate($dateTime)
    {
        $weekDay = date('N', $dateTime->getTimestamp()); // Get the day of week // 1=Monday, 7=Sunday

        if ($weekDay == 6 || $weekDay == 7) { // If day of week is Sat or Sun, then return Fri.
            $dateTime->sub(new \DateInterval('P' . $weekDay - 5 . 'D'));
        }
        return $dateTime->format('Y-m-d');
    }

    public function getBonusDate($dateTime)
    {
        $weekDay = date('N', $dateTime->getTimestamp()); // Get the day of week // 1=Monday, 7=Sunday

        if ($weekDay == 6 || $weekDay == 7) { // If day of week is Sat or Sun, then return next wednesday.
            $dateTime->add(new \DateInterval('P' . 10 - $weekDay . 'D'));
        }
        return $dateTime->format('Y-m-d');
    }
}
