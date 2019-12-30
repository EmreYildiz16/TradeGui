<?php

namespace FurkanGM\Trade;

use FurkanGM\Trade\command\Trade;
use muqsit\invmenu\InvMenuHandler;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase
{

	/** @var array  */
	public $tradeRequests = [];

	/**
	 * @var
	 */
	public static $instance;

	/**
	 *
	 */
	public function onLoad()
	{
		self::$instance = $this;
	}

	/**
	 *
	 */
	public function onEnable()
	{
		if(!InvMenuHandler::isRegistered()){
			InvMenuHandler::register($this);
		}
		$this->getServer()->getCommandMap()->register("trade",new Trade());
	}

	/**
	 * @return Main
	 */
	public static function getInstance(): Main{
		return self::$instance;
	}

}