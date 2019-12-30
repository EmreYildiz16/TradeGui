<?php

namespace FurkanGM\Trade\form;

use FurkanGM\Trade\Main;
use Life\Core\Gui\TradeGui;
use dktapps\pmforms\ModalForm;
use pocketmine\Player;

class TradeRequestForm extends ModalForm
{

	/**
	 * TradeRequestForm constructor.
	 * @param Player $sender
	 */
	public function __construct(Player $sender)
	{
		parent::__construct(
			"Takas teklifiniz var",
			$sender->getName()." §7adlı oyuncunun takas teklifini kabul ediyormusun?",
			function (Player $player,bool $choice): void {
				if (isset(Main::getInstance()->tradeRequests[$player->getName()])){
					$sender = Main::getInstance()->tradeRequests[$player->getName()];
					$sender = $player->getServer()->getPlayer($sender);
					unset(Main::getInstance()->tradeRequests[$player->getName()]);
					if ($choice == true){
						if ($sender){
							$gui = new TradeGui($sender,$player);
							$gui->openTrade();
						}
						return;
					}else{
						$sender->sendMessage("§7» §e". $player->getName(). " §cAdlı oyuncu takas teklifinizi reddetti");
						return;
					}
				}else{
					$player->sendMessage("§7» Size yollanan mevcut takas teklifi yok.");
				}
			},
			"§aKABUL ET",
			"§cREDDET"
		);
	}

}