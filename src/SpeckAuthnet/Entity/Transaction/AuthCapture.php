<?php

namespace SpeckAuthnet\Entity\Transaction;

class AuthCapture extends \SpeckAuthnet\Entity\Transaction\Base
{
	public function _getTransactionKey() {
		return "profileTransAuthCapture";
	}

	public function _transformData($data) {
		return $data;
	}
}