<?php
namespace Projet\Model;

class Manager
{
	protected function dbConnect()
	{
		$request = new \PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME .';charset=utf8', DB_USERNAME, DB_MDP);
		return $request;
	}
	public function datesZone()
	{
		date_default_timezone_set('Europe/Paris');
		$dates= date("Y-m-d H:i:s");
		return $dates;
	}
}