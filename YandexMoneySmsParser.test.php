<?php

require_once('YandexMoneySmsParser.php');

$testMessages = [<<<'EOD'
Пароль: 4583
Спишется 123,62р.
Перевод на счет 41001123456789
EOD
, <<<'EOD'
Пароль: 4583
Перевод на счет 41001123456789
Спишется 123р.
EOD
, <<<'EOD'
Кошелек Яндекс.Денег указан неверно.
EOD
];

$parser = YandexMoneySmsParser::getDefault();
foreach ($testMessages as $key => $testMessage) {
	print('Sample ' . $key . PHP_EOL);
	$result = $parser->parse($testMessage);
	if ($result->isSuccess()) {
		print('amount: ' . $result->get('amount') . PHP_EOL);
		print('code: ' . $result->get('code') . PHP_EOL);
		print('account: ' . $result->get('account') . PHP_EOL);
	} else {
		print('Parse error' . PHP_EOL);
	}
}
print('Finish' . PHP_EOL);
