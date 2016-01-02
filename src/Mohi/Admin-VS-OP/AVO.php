<php?
use pocketmine\src\plugin\PluginBase;
use pocketmine\src\event\Listener;
use pocketmine\src\event\Command;
use pocketmine\src\event\Cancellable;

class AVO extends PluginBase implements Listener {
    private $adminList;
    
    public function onEnable() {

    }
    public function onDisable() {

    }
    public function onCommand(CommandSender $sender, Command $command, $label, array $args) {
        if(! $server->isOP($sender)) {
                $this->alert($sender,"이 명령어는 콘솔에서만 사용하실 수 있습니다");
                return true;
        }
        if(strtolower($args[0] == "avo") {
                if(
                switch(strtolower($args[1])) {
                    case "add":
                     //TODO: $args[2]를 $adminList에 추가
                    case "delete":
                     //TODO: $args[2]를 $adminList에서 제거

