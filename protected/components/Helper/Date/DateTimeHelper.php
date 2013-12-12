<?php
class DateTimeHelper{
	public static function convertToCommonDateTimeFormat($datetime){
		if($datetime){
			try {
				$date = date_create($datetime);
				return date_format($date, Yii::app()->params['DATE_FORMAT']);
			} catch (Exception $e) {
				return null;
			}
		}
	
		return null;
	}
	
	public static function convertToCommonDateTimeFormatWithEndOfDay($datetime){
		if($datetime){
			try {
				$date = date_create($datetime);
				date_time_set($date, 23, 59, 59);
				return date_format($date, Yii::app()->params['DATE_FORMAT']);
			} catch (Exception $e) {
				return null;
			}
		}
	
		return null;
	}
	
	public static function date(){
		return date(Yii::app()->params['DATE_FORMAT']);
	}
	
	public static function dateOnlyFromDateTimeString($datetimeString){
		if($datetimeString){
			try {
				$date = date_create($datetimeString);
				return date_format($date, Yii::app()->params['DATE_FORMAT_DATE_ONLY']);
			} catch (Exception $e) {
				return null;
			}
		}
	
		return "";
	}
}