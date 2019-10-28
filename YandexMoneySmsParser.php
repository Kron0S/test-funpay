<?php

require_once('YandexMoneySmsParserRule.php');
require_once('IYandexMoneySmsParserResult.php');
require_once('YandexMoneySmsParserResultFail.php');
require_once('YandexMoneySmsParserResultSuccess.php');

class YandexMoneySmsParser
{
	private $text;
	
	public static function getDefault () {
		return new YandexMoneySmsParser([
			new YandexMoneySmsParserRule('amount', '/[\d]+[,.]?[\d]{0,2}р\./'),
			new YandexMoneySmsParserRule('code', '/(?<![\d])[\d]{4}(?![\d,.])/'),
			new YandexMoneySmsParserRule('account', '/41001[\d]{8,11}/'),
		]);
	}

	public function __construct($rules)
	{
		$this->rules = $rules;
	}

	public function parse($message): IYandexMoneySmsParserResult
	{
		$results = [];
		foreach ($this->rules as $rule) {
			preg_match($rule->getPattern(), $message, $matches);
			if ($matches && $matches[0]) {
				$results[$rule->getName()] = $matches[0];
			} else {
				return new YandexMoneySmsParserResultFail();
			}
		}
		return new YandexMoneySmsParserResultSuccess($results);
	}
}
