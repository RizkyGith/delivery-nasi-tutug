<?php

namespace App\Library;

use Bono\App;
use Bono\Helper\URL;
use Norm\Norm;

class Month
{
	public function monthName($month)
	{
		switch ($month) {
            case "1":
                $month_name = "Januari";
                break;
            case "2":
                $month_name = "Februari";
                break;
            case "3":
                $month_name = "Maret";
                break;
            case "4":
                $month_name = "April";
                break;
            case "5":
                $month_name = "Mei";
                break;
            case "6":
                $month_name = "Juni";
                break;
            case "7":
                $month_name = "Juli";
                break;
            case "8":
                $month_name = "Agustus";
                break;
            case "9":
                $month_name = "September";
                break;
            case "10":
                $month_name = "Oktober";
                break;
            case "11":
                $month_name = "November";
                break;
            default:
                $month_name = "Desember";
                break;
        }
        return $month_name;
	}

	public function monthSortName($month)
	{
		switch ($month) {
            case "1":
                $month_sort_name = "Jan";
                break;
            case "2":
                $month_sort_name = "Feb";
                break;
            case "3":
                $month_sort_name = "Mar";
                break;
            case "4":
                $month_sort_name = "Apr";
                break;
            case "5":
                $month_sort_name = "Mei";
                break;
            case "6":
                $month_sort_name = "Jun";
                break;
            case "7":
                $month_sort_name = "Jul";
                break;
            case "8":
                $month_sort_name = "Ags";
                break;
            case "9":
                $month_sort_name = "Sep";
                break;
            case "10":
                $month_sort_name = "Okt";
                break;
            case "11":
                $month_sort_name = "Nov";
                break;
            default:
                $month_sort_name = "Des";
                break;
        }
        return $month_sort_name;
	}
}