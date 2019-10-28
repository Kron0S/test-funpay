<?php

require_once('IYandexMoneySmsParserResult.php');

class YandexMoneySmsParserResultSuccess implements IYandexMoneySmsParserResult
{
	private $results;
	public function __construct($results)
	{
		$this->results = $results;
	}
	public function isSuccess()
	{
		return true;
	}
	public function get($name)
	{
		return $this->results[$name];
	}
}
