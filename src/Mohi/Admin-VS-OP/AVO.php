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
                $this->alert($sender,"�� ��ɾ�� �ֿܼ����� ����Ͻ� �� �ֽ��ϴ�");
                return true;
        }
        if(strtolower($args[0] == "avo") {
                if(
                switch(strtolower($args[1])) {
                    case "add":
                     //TODO: $args[2]�� $adminList�� �߰�
                    case "delete":
                     //TODO: $args[2]�� $adminList���� ����

