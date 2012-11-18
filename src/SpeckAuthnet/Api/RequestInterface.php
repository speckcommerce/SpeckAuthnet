<?php
namespace SpeckAuthnet\Api;

interface RequestInterface
{
	public function getEndpoint();

	public function setMode($mode);

	public function getMode();
}