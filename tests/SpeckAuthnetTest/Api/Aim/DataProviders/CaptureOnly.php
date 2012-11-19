<?php
namespace SpeckAuthnetTest\Api\Aim\DataProviders;

class CaptureOnly
{
	public static function getCaptureOnlyData()
	{
		return array(
			'amount' => '20.00',
			'auth_code' => '1234567890',
			'card_num' => '4111111111111111',
			'exp_date' => '122012'
		);
	}
}