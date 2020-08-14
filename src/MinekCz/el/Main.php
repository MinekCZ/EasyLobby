<?php

declare(strict_types = 1);

namespace MinekCz\el;


use pocketmine\event\Listener;

use pocketmine\level\Level;
use pocketmine\level\Position;

use pocketmine\Player;
use pocketmine\Server;

use pocketmine\plugin\PluginBase as Plugin;
use pocketmine\math\Vector3;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;

use pocketmine\utils\Config;

use MinekCz\el\commands\Lobby;
use MinekCz\el\commands\EasyLobby;

class Main extends Plugin implements Listener {

    //Managers
    public $SetupManager;
    public $ConfigManager;
  
    public $config;
  
    public function onEnable(): void {
  
      // Managers
  
      //$this->SetupManager = new managers\SetupManager($this);
      $this->ConfigManager = new ConfigManager($this);
      //$this->PortalManager = new managers\PortalManager($this);
  
      //$this->getServer()->getPluginManager()->registerEvents(new Events($this), $this);
      $this->getServer()->getCommandMap()->register("easylobby", new EasyLobby($this));
      $this->getServer()->getCommandMap()->register("lobby", new Lobby($this));
  
      $this->getConfig()->save();
  
      $this->config = $this->ConfigManager;
    }

    public function playerLevel(Player $player) :string {
        $level = $player->getLevel()->getFolderName();
        return $level;
    }

    public function teleport(Player $player) {
        $position = $this->config->getArray("lobby");
        $x = $position[0];
        $y = $position[1];
        $z = $position[2]; 
        if(!$this->getServer()->isLevelLoaded($position[3])) $this->getServer()->loadLevel($position[3]);
        $level = $this->getServer()->getLevelByName($position[3]);  
        $player->teleport($level->getSafeSpawn());
        $player->teleport(new Vector3($x, $y, $z));  
    }
}