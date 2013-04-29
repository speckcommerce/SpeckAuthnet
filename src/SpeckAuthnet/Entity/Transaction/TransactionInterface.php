<?php

namespace SpeckAuthnet\Entity\Transaction;

interface TransactionInterface {

	public function execute();
	public function _getTransactionKey();
	public function _transformData($data);

}