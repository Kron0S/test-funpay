<?php

require_once('IYandexMoneySmsParserResult.php');

class YandexMoneySmsParserResultFail implements IYandexMoneySmsParserResult
{
	public function isSuccess()
	{
		return false;
	}
}
