<?

function handler(string $request) 
{
	$wallet_in_str = preg_match('/[0-9]{13,16}/', $request, $wallet_matches);
	$wallet = $wallet_matches[0] ? 'Кошелек: ' . $wallet_matches[0] : 'Ошибка при получении кошелька.';

	$amount_in_str = preg_match('/[0-9]{1,}[.,][0-9]{1,}/', $request, $amount_matches);
	$amount = $amount_matches[0] ? 'Сумма: ' . $amount_matches[0] : 'Ошибка при получении суммы.';

	$code_in_str = preg_match('/[0-9]{4,6}/', $request, $code_matches);
	$code = $code_matches[0] ? 'Код подтверждения: ' . $code_matches[0] : 'Ошибка при получении кода подтверждения.';

	return [
		'wallet' => $wallet,
		'amount' => $amount,
		'code' => $code,
	];
}

$requests = [
	'Пароль: 9524Спишется 1,01р.Перевод на счет 4100110011352223',
	'Кошелек Яндекс.Денег указан неверно.',
	'Пароль: 7733Спишется 30,16р.Перевод на счет 4100110011352223',
	'Никому не говорите пароль! Его спрашивают только мошенники.Пароль: 28916Перевод на счет 4100110011352223Вы потратите 5025,13р.',
	'Никому не говорите пароль! Его спрашивают только мошенники.Пароль: 76063Перевод на счет 4100110011352223Вы потратите 5746,74р.',
	'Недостаточно средств.',
	'Пароль: 4514<br>Спишется 780,91р.<br>Перевод на счет 4100110011352223',
];

foreach ($requests as $request) {
	$result = handler($request);
	echo "<b>Искомая строка:</b> " . $request . "<br><br>";
	echo "<b>Результат:</b><br><br>";
	echo $result['wallet'] . "<br>";
	echo $result['amount'] . "<br>";
	echo $result['code'] . "<br><br>";
	echo "<hr>";
}

