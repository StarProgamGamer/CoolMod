<?php
namespace CoolMod;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;


class CoolMod extends PluginBase {
	public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
		//List of commands for this plugin
		switch($cmd->getName()){
			//checkop command
			case 'checkop':
				//Checks if there is sufficient arguments
			 if(count($args) == 1){
			 	$name = $args[0];
			 	$targetPlayer = $this->getServer()->getPlayer($name);
			    //Checks if player is online
			 	if($targetPlayer instanceof Player){
			 		//Message when player is OP
			 		if($targetPlayer->isOp()){
			 			$sender->sendMessage(TextFormat::AQUA . $targetPlayer->getDisplayName() . " is OP!");
			 			return true;
			 		}
			 		//Message when player is not OP
			 		else{
			 			$sender->sendMessage(TextFormat::GREEN . $targetPlayer->getDisplayName() . " is not OP.");
			 			return true;
			 		}
			 	}
			  	//Message when the player isn't online
			 	else{
			 		$sender->sendMessage(TextFormat::RED . $args[0] . " is not online!");
			 		return true;
			 	}
			 }
			 //Message when player types insufficient arguments
			 else{
			  $sender->sendMessage(TextFormat::RED . "Usage: /checkop <player>");
			  return true;
			 }
			case 'bcast':
				if(count($args) >= 1){
					$sender->getServer()->broadcastMessage(TextFormat::BOLD . implode(" ",$args));
					return true;
				}
				elseif(count($args) === 0){
					$sender->sendMessage(TextFormat::RED . "Usage: /bcast <message>");
					return true;
				}
			case 'bpopup':
				if(count($args) >= 1){
					foreach($this->getServer()->getOnlinePlayers() as $name){
						$this->getServer()->broadcastPopup(TextFormat::BOLD . implode(" ", $args), $name);
						$message = $args;
						foreach($args as $message){
							$sender->sendMessage(TextFormat::GREEN . "You sent the popup: " . $message . " to all players!");
							return true;
						}
					}
				}
				elseif(count($args) === 0){
					$sender->sendMessage(TextFormat::RED . "Usage: /bpopup <message>");
					return true;
				}
		}
	}
}
