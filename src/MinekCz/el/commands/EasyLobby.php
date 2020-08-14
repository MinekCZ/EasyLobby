<?php

namespace MinekCz\el\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\Player;
use pocketmine\plugin\Plugin;
use pocketmine\utils\TextFormat as TF;
use MinekCz\el\Main;


class EasyLobby extends Command implements PluginIdentifiableCommand {
    
    public $plugin;
    public $config;
    
    public function __construct(Main $plugin) {
        $this->plugin = $plugin;
        $this->config = $this->plugin->ConfigManager;
        parent::__construct("easylobby", "§7Easy§aLobby §7main command", \null, ["spawn", "lobby"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {

        if(!isset($args[0])) {
            if(!$sender->hasPermission($this->config->get("perm"))) {
                $sender->sendMessage($this->config->get("noperm"));
                return;
            }
            $sender->sendMessage("{$this->config->get("prefix")}:\n" .
                "§7/easylobby help\n".
                "§7/easylobby setlobby/setspawn/sethub");
            return;
        }

        switch ($args[0]) {
            case "help":
                if(!$sender->hasPermission($this->config->get("perm"))) {
                    $sender->sendMessage($this->config->get("noperm"));
                    break;
                }
                $sender->sendMessage("{$this->config->get("prefix")}:\n" .
                    "§7/easylobby help\n".
                    "§7/easylobby setlobby/setspawn/sethub");
                break;
            case "setlobby":
                if(!$sender->hasPermission($this->config->get("perm"))) {
                    $sender->sendMessage($this->config->get("noperm"));
                    break;
                }
                $level = $this->plugin->playerLevel($sender);
                $lobby = array($sender->getX(), $sender->getY(), $sender->getZ(), $level);
                $this->config->setArray("lobby", $lobby);
                $sender->sendMessage($this->config->get("lobby-done"));
                break;
            case "setspawn":
                if(!$sender->hasPermission($this->config->get("perm"))) {
                    $sender->sendMessage($this->config->get("noperm"));
                    break;
                }
                $level = $this->plugin->playerLevel($sender);
                $lobby = array($sender->getX(), $sender->getY(), $sender->getZ(), $level);
                $this->config->setArray("lobby", $lobby);
                $sender->sendMessage($this->config->get("lobby-done"));
                break;
            case "sethub":
                if(!$sender->hasPermission($this->config->get("perm"))) {
                    $sender->sendMessage($this->config->get("noperm"));
                    break;
                }
                $level = $this->plugin->playerLevel($sender);
                $lobby = array($sender->getX(), $sender->getY(), $sender->getZ(), $level);
                $this->config->setArray("lobby", $lobby);
                $sender->sendMessage($this->config->get("lobby-done"));
                break;
            default:
                if(!$sender->hasPermission($this->config->get("perm"))) {
                    $sender->sendMessage($this->config->get("noperm"));
                    break;
                }
                $player = $this->plugin->getServer()->getPlayer($args[0]);
                $this->plugin->teleport($player);
                break;
        }

    }

    public function getPlugin(): Plugin {
        return $this->plugin;
    }
}