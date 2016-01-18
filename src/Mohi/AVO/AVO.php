<?php

namespace Mohi\AVO;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerCommandPreprocessEvent;
use pocketmine\utils\Config;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\Player;

class AVO extends PluginBase implements Listener {
	private $adminList;
	public function onEnable() {
		$this->LoadAdminList ();
		$this->getServer ()->getPluginManager ()->registerEvents ( $this, $this );
	}
	public function onDisable() {
		$this->saveAdminList ();
	}
	public function LoadAdminList() {
		$this->adminList = (new Config ( $this->getDataFolder () . "AdminList.json", Config::JSON ))->getAll ();
	}
	public function saveAdminList() {
		$db = (new Config ( $this->getDataFolder () . "AdminList.json", Config::JSON ));
		$db->setAll ( $this->adminList );
		$db->save ();
	}
	public function onPlayerCommand(PlayerCommandPreprocessEvent $event) {
		$message = $event->getMessage ();
		$player = $event->getPlayer();
		if(!$player instanceof Player) {
			return true;
		}
		if ($message {0} == '/') {
			substr ( $message, 1 );
			$message = explode ( " ", $message );
			if ($message [0] == "op") {
				if (!$this->is_Admin($player)) {
					$player->sendMessage('당신은 이 명령어을 실행할 권한이 없습니다.');
					$event->setCancelled();
				}
			}
		}
	}
	public function onCommand(CommandSender $sender, Command $command, $label, Array $args) {
		if (strtolower ( $command == 'avo' )) {
			if ($sender instanceof Player) {
				$sender->sendMessage ( "이 명령어는 콘솔에서만 사용하실 수 있습니다." );
				return true;
			}
			if (! isset ( $args [0] )) {
				$sender->sendMessage ( '/avo add <플레이어명>' );
				$sender->sendMessage ( '/avo delete <플레이어명>' );
				return true;
			}
			switch (strtolower ( $args [0] )) {
				case 'add' :
					if (! isset ( $args [1] )) {
						$sender->sendMessage ( '/avo add <플레이어명>' );
						break;
					}
					if (! isset ( $this->adminList ['adminlist'] ))
						$this->adminList ['adminlist'] = [ ];
					array_push ( $this->adminList, $args [1] );
					$sender->sendMessage ( $args [1] . "을 어드민에 추가했습니다." );
					break;
				case 'delete' :
					if (! isset ( $args [1] )) {
						$sender->sendMessage ( '/avo delete <플레이어명>' );
						break;
					}
					if ($this->is_Admin ( $sender )) {
						unset ( $this->adminList ['adminlist'] [$args [1]] );
						$sender->sendMessage ( $args [1] . "을 어드민에서 삭제했습니다." );
					} else {
						$sender->sendMessage ( $args [1] . "은 어드민이 아닙니다." );
					}
					break;
				default :
					$sender->sendMessage ( '/avo add <플레이어명>' );
					$sender->sendMessage ( '/avo delete <플레이어명>' );
			}
		}
		return true;
	}
	public function is_Admin($player) {
		if ($player instanceof Player) {
			$player = $player->getName ();
		}
		if (isset ( $this->adminList ['adminlist'] [$player] )) {
			return true;
		} else {
			return false;
		}
	}
}
?>