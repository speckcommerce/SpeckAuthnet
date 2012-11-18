<?php
namespace SpeckAuthnet\Api;

class DefaultResponse extends AbstractResponse
{
	public function isSuccess()
	{
		return false;
	}
}