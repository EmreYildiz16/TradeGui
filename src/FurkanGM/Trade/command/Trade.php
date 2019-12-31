<?php

namespace FurkanGM\Trade\command;

use FurkanGM\Trade\compatibility\Command;
use FurkanGM\Trade\form\TradeRequestForm;
use FurkanGM\Trade\Main;
use pocketmine\command\CommandSender;
use pocketmine\network\mcpe\protocol\AvailableCommandsPacket;
use pocketmine\network\mcpe\protocol\types\CommandParameter;
use pocketmine\Player;

class Trade extends Command
{

    /**
     * @var Main
     */
    private $plugin;

    /**
     * Trade constructor.
     */
    public function __construct()
    {
        parent::__construct("trade", "Takas komutu", "/trade <player>", ["takas"]);
        $this->setParameter(new CommandParameter("player", AvailableCommandsPacket::ARG_TYPE_TARGET, false),0);
        $this->plugin = Main::getInstance();
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     * @return bool|mixed
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender instanceof Player){
            if (isset($args[0])){
                if (($player = $this->plugin->getServer()->getPlayer($args[0])) instanceof Player){
                    if ($player->getName() == $sender->getName()){
                    $sender->sendMessage("§7» §cKendinize takas isteği gönderemezsiniz.");
                    return false;
                    }else{
                    $this->plugin->tradeRequests[$player->getName()] = $sender->getName();
                    $sender->sendMessage("§7» §e" . $player->getName() . "§7 adlı oyuncuya takas isteği gönderildi.");
                    $player->sendForm(new TradeRequestForm($sender));
                    }
                }else{
                    $sender->sendMessage("§7» §cOyuncu bulunamadı.");
                }
            }else{
                $sender->sendMessage("Kullanım: /trade <player>");
            }
        }
        return true;
    }

}