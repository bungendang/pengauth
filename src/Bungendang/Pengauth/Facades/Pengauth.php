<?php
namespace Bungendang\Pengauth\Facades;
use Illuminate\Support\Facades\Facade;


class Pengauth extends Facade{
	protected static function getFacadeAccessor()
	{
		return 'pengauth';
	}
}