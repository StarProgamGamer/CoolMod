<?php
namespace CoolMod;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\utils\TextFormat;
use pocketmine\Player;

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
			 			$sender->sendMessage(TextFormat::AQUA . $targetPlayer->getDisplayName() . "is OP!");
			 		}
			 		//Message when player is not OP
			 		else{
			 			$sender->sendMessage(TextFormat::GREEN . $targetPlayer->getDisplayName() . "is not OP.");
			 		}
			 	}
			  	//Message when the player isn't online
			 	else{
			 		$sender->sendMessage(TextFormat::RED . $args[0] . "is not online!");
			 	}
			 }
			 //Message when player types insufficient arguments
			 else{
			  $sender->sendMessage(TextFormat::RED . "Usage: /checkop <player>");
			  return true;
			 }
			//cpgms command
			case 'cpgms':
				//Checks if there is sufficient arguments
				if(count($args)== 1){
					//For survival mode
					if($args[0] == 0 and strlen($args[0])== 1){
					 foreach($this->getServer()->getOnlinePlayers() as $p){
                      if($p != $sender){
                       $p->setGamemode(0);
                       $sender->sendMessage(TextFormat::GREEN . "Succesfully changed all players to Survival!");
                       return true;
                      }
                     }
					}
				    //For creative mode
				    if($args[0] == 1 and strlen($args[0])== 1){
					 foreach($this->getServer()->getOnlinePlayers() as $p){
                      if($p != $sender){
                       $p->setGamemode(1);
                       $sender->sendMessage(TextFormat::GREEN . "Successfully changed all players to Creative!");
                       return true;
                      }
                     }
					}
			        //For adventure mode
			        if($args[0] == 2 and strlen($args[0])== 1){
					 foreach($this->getServer()->getOnlinePlayers() as $p){
                      if($p != $sender){
                       $p->setGamemode(2);
                       $sender->sendMessage(TextFormat::GREEN . "Successfully changed all players to Adventure Mode!");
                       return true;
                      }
                     }
					}
				   //For spectator mode
				    if($args[0] == 3 and strlen($args[0])== 1){      
					 foreach($this->getServer()->getOnlinePlayers() as $p){
                      if($p != $sender){
                       $p->setGamemode(3);
                       $sender->sendMessage(TextFormat::GREEN . "Successfully changed all players to Spectator Mode!");
                       return true;
                      }
                     }
					}
					//Message when command is run when there is only one player online
					elseif(count($p) < 2){
						$sender->sendMessage(TextFormat::RED . "There needs to be at least two players online for this to work (including yourself)");
						return true;
					}
					//Message when the statement above is false but the others are as well
					else{
						$sender->sendMessage(TextFormat::RED . "Gamemode needs to be 0 (Survival), 1 (Creative), 2 (Adventure), or 3 (Spectator).");
						return true;
					}
				}
				//Message when player types insufficient arguments
				else{
					$sender->sendMessage(TextFormat::RED . "Usage: /cpgms <gamemode>");
					return true;
				}
		}
	}
}
