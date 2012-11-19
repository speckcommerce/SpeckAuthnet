<?php
namespace SpeckAuthnet\Api;

interface ConfigAwareInterface
{
	public function setMode($mode);

	public function setLogin($login);

	public function setTranKey($tranKey);
}