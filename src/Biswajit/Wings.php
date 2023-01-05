<?php

namespace Biswajit;

use pocketmine\command\Command;

use pocketmine\command\CommandSender;

use pocketmine\entity\Human;

use pocketmine\entity\Skin;

use pocketmine\event\entity\EntityDamageByEntityEvent;

use pocketmine\event\Listener;

use pocketmine\event\player\PlayerQuitEvent;

use pocketmine\event\server\DataPacketReceiveEvent;

use pocketmine\network\mcpe\protocol\LoginPacket;

use pocketmine\permission\DefaultPermissions;

use pocketmine\player\Player;

use pocketmine\network\mcpe\JwtUtils;

use pocketmine\network\mcpe\JwtException;

use pocketmine\network\PacketHandlingException;

use pocketmine\network\mcpe\protocol\types\login\ClientData;

use pocketmine\plugin\PluginBase;

use jojoe77777\FormAPI\SimpleForm;

use pocketmine\utils\TextFormat;

class Wings extends PluginBase implements Listener {

	

	/** @var self $instance */

    public static $instance;

    

    /** @var int*/

    public $json;

	

	public function onEnable(): void{

		self::$instance = $this;

    	$this->getServer()->getPluginManager()->registerEvents($this, $this);

    	$this->checkSkin();

    	$this->checkRequirement();

    	$this->getLogger()->info($this->json . " Geometry Skin Confirmed");

	}

	

	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {

		if($sender instanceof Player){

			if($cmd->getName() == "customwing"){

				$this->Form($sender, TextFormat::YELLOW . "Select Your Wings Please:");

				return true;

			}

		} else {

			$sender->sendMessage(TextFormat::RED . "You dont Have Permission to use this Command");

			return false;

		}

        return false;

	}

	

	public function dataReceiveEv(DataPacketReceiveEvent $ev)

    {

        $packet = $ev->getPacket();

        $player = $ev->getOrigin()->getPlayer();

        if ($packet instanceof LoginPacket) {

            $data = self::decodeClientData($packet->clientDataJwt);

            $name = $data->ThirdPartyName;

            if ($data->PersonaSkin) {

                if (!file_exists($this->getDataFolder() . "saveskin")) {

                    mkdir($this->getDataFolder() . "saveskin", 0777);

                }

                copy($this->getDataFolder()."steve.png",$this->getDataFolder() . "saveskin/{$name}.png");

                return;

            }

            if ($data->SkinImageHeight == 32) {

            }

            $saveSkin = new saveSkin();

            $saveSkin->saveSkin(base64_decode($data->SkinData, true), $name);

        }

    }

    

    public function onQuit(PlayerQuitEvent $ev)

    {

        $name = $ev->getPlayer()->getName();

        $willDelete = $this->getConfig()->getNested('DeleteSkinAfterQuitting');

        if ($willDelete) {

            if (file_exists($this->getDataFolder() . "saveskin/{$name}.png")) {

                unlink($this->getDataFolder() . "saveskin/{$name}.png");

            }

        }

    }

    

    public function Form($sender, string $txt){

    	$form = new SimpleForm(function (Player $sender, $data = null){

    		if($data === null){

    			return false;

    		}

    		switch($data){

    			case 0:

    			if($sender->hasPermission("kagunev1.wing") or $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){

    			    $setskin = new setSkin();

    			    $setskin->setSkin($sender, "kagunev1");

    			  } else {

    			    $this->Form($sender, TextFormat::RED . "You dont have Permission to Use This Wing");

    			  }

    			break;

    			case 1:

    			if($sender->hasPermission("kakujav1.wing") or $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){

    			    $setskin = new setSkin();

    			    $setskin->setSkin($sender, "kakujav1");

    			  } else {

    			    $this->Form($sender, TextFormat::RED . "You dont have Permission to Use This Wing");

    			  }

    			break;

    			case 2:

    			if($sender->hasPermission("kakujav2.wing") or $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){

    			    $setskin = new setSkin();

    			    $setskin->setSkin($sender, "kakujav2");

    			  } else {

    			    $this->Form($sender, TextFormat::RED . "You dont have Permission to Use This Wing");

    			  }

    			break;

    			case 3:

    			if($sender->hasPermission("mercyv1.wing") or $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){

    			    $setskin = new setSkin();

    			    $setskin->setSkin($sender, "mercyv1");

    			  } else {

    			    $this->Form($sender, TextFormat::RED . "You dont have Permission to Use This Wing");

    			  }

    			break;

    			case 4:

    			if($sender->hasPermission("mercyv2.wing") or $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){

    			    $setskin = new setSkin();

    			    $setskin->setSkin($sender, "mercyv2");

    			  } else {

    			    $this->Form($sender, TextFormat::RED . "You dont have Permission to Use This Wing");

    			  }

    			break;

    			case 5:

    			if($sender->hasPermission("balrogv1.wing") or $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){

    			    $setskin = new setSkin();

    			    $setskin->setSkin($sender, "balrogv1");

    			  } else {

    			    $this->Form($sender, TextFormat::RED . "You dont have Permission to Use This Wing");

    			  }

    			break;

    			case 6:

    			if($sender->hasPermission("balrogv2.wing") or $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){

    			    $setskin = new setSkin();

    			    $setskin->setSkin($sender, "balrogv2");

    			  } else {

    			    $this->Form($sender, TextFormat::RED . "You dont have Permission to Use This Wing");

    			  }

    			break;

    			case 7:

    			if($sender->hasPermission("blazingv1.wing") or $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){

    			    $setskin = new setSkin();

    			    $setskin->setSkin($sender, "blazingv1");

    			  } else {

    			    $this->Form($sender, TextFormat::RED . "You dont have Permission to Use This Wing");

    			  }

    			break;

    			case 8:

    			if($sender->hasPermission("blazingv2.wing") or $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){

    			    $setskin = new setSkin();

    			    $setskin->setSkin($sender, "blazingv2");

    			  } else {

    			    $this->Form($sender, TextFormat::RED . "You dont have Permission to Use This Wing");

    			  }

    			break;

    			case 9:

    			if($sender->hasPermission("aurorav1.wing") or $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){

    			    $setskin = new setSkin();

    			    $setskin->setSkin($sender, "aurorav1");

    			  } else {

    			    $this->Form($sender, TextFormat::RED . "You dont have Permission to Use This Wing");

    			  }

    			break;

    			case 10:

    			if($sender->hasPermission("aurorav2.wing") or $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){

    			    $setskin = new setSkin();

    			    $setskin->setSkin($sender, "aurorav2");

    			  } else {

    			    $this->Form($sender, TextFormat::RED . "You dont have Permission to Use This Wing");

    			  }

    			break;

    			case 11:

    			if($sender->hasPermission("davinciv1.wing") or $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){

    			    $setskin = new setSkin();

    			    $setskin->setSkin($sender, "davinciv1");

    			  } else {

    			    $this->Form($sender, TextFormat::RED . "You dont have Permission to Use This Wing");

    			  }

    			break;

    			case 12:

    			if($sender->hasPermission("davinciv2.wing") or $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){

    			    $setskin = new setSkin();

    			    $setskin->setSkin($sender, "davinciv2");

    			  } else {

    			    $this->Form($sender, TextFormat::RED . "You dont have Permission to Use This Wing");

    			  }

    			break;

    			case 13:

    			if($sender->hasPermission("devilv1.wing") or $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){

    			    $setskin = new setSkin();

    			    $setskin->setSkin($sender, "devilv1");

    			  } else {

    			    $this->Form($sender, TextFormat::RED . "You dont have Permission to Use This Wing");

    			  }

    			break;

    			case 14:

    			if($sender->hasPermission("devilv2.wing") or $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){

    			    $setskin = new setSkin();

    			    $setskin->setSkin($sender, "devilv2");

    			  } else {

    			    $this->Form($sender, TextFormat::RED . "You dont have Permission to Use This Wing");

    			  }

    			break;

    			case 15:

    			if($sender->hasPermission("diamondv1.wing") or $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){

    			    $setskin = new setSkin();

    			    $setskin->setSkin($sender, "diamondv1");

    			  } else {

    			    $this->Form($sender, TextFormat::RED . "You dont have Permission to Use This Wing");

    			  }

    			break;

    			case 16:

    			if($sender->hasPermission("knightv1.wing") or $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){

    			    $setskin = new setSkin();

    			    $setskin->setSkin($sender, "knightv1");

    			  } else {

    			    $this->Form($sender, TextFormat::RED . "You dont have Permission to Use This Wing");

    			  }

    			break;

    			case 17:

    			if($sender->hasPermission("knightv2.wing") or $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){

    			    $setskin = new setSkin();

    			    $setskin->setSkin($sender, "knightv2");

    			  } else {

    			    $this->Form($sender, TextFormat::RED . "You dont have Permission to Use This Wing");

    			  }

    			break;

    			case 18:

    			if($sender->hasPermission("monarchv1.wing") or $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){

    			    $setskin = new setSkin();

    			    $setskin->setSkin($sender, "monarchv1");

    			  } else {

    			    $this->Form($sender, TextFormat::RED . "You dont have Permission to Use This Wing");

    			  }

    			break;

    			case 19:

    			if($sender->hasPermission("monarchv2.wing") or $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){

    			    $setskin = new setSkin();

    			    $setskin->setSkin($sender, "monarchv2");

    			  } else {

    			    $this->Form($sender, TextFormat::RED . "You dont have Permission to Use This Wing");

    			  }

    			break;

    			case 20:

    			if($sender->hasPermission("razorv1.wing") or $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){

    			    $setskin = new setSkin();

    			    $setskin->setSkin($sender, "razorv1");

    			  } else {

    			    $this->Form($sender, TextFormat::RED . "You dont have Permission to Use This Wing");

    			  }

    			break;

    			case 21:

    			if($sender->hasPermission("razorv2.wing") or $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){

    			    $setskin = new setSkin();

    			    $setskin->setSkin($sender, "razorv2");

    			  } else {

    			    $this->Form($sender, TextFormat::RED . "You dont have Permission to Use This Wing");

    			  }

    			break;

    			case 22:

    			if($sender->hasPermission("roboticv1.wing") or $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){

    			    $setskin = new setSkin();

    			    $setskin->setSkin($sender, "roboticv1");

    			  } else {

    			    $this->Form($sender, TextFormat::RED . "You dont have Permission to Use This Wing");

    			  }

    			break;

    			case 23:

    			if($sender->hasPermission("roboticv2.wing") or $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){

    			    $setskin = new setSkin();

    			    $setskin->setSkin($sender, "roboticv2");

    			  } else {

    			    $this->Form($sender, TextFormat::RED . "You dont have Permission to Use This Wing");

    			  }

    			break;

    			case 24:

    			if($sender->hasPermission("angelv1.wing") or $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){

    			    $setskin = new setSkin();

    			    $setskin->setSkin($sender, "angelv1");

    			  } else {

    			    $this->Form($sender, TextFormat::RED . "You dont have Permission to Use This Wing");

    			  }

    			break;

    			case 25:

    			if($sender->hasPermission("angelv2.wing") or $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){

    			    $setskin = new setSkin();

    			    $setskin->setSkin($sender, "angelv2");

    			  } else {

    			    $this->Form($sender, TextFormat::RED . "You dont have Permission to Use This Wing");

    			  }

    			break;

    			case 26:

    			if($sender->hasPermission("angelv3.wing") or $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){

    			    $setskin = new setSkin();

    			    $setskin->setSkin($sender, "angelv3");

    			  } else {

    			    $this->Form($sender, TextFormat::RED . "You dont have Permission to Use This Wing");

    			  }

    			break;

    			case 27:

    			if($sender->hasPermission("angelv4.wing") or $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){

    			    $setskin = new setSkin();

    			    $setskin->setSkin($sender, "angelv4");

    			  } else {

    			    $this->Form($sender, TextFormat::RED . "You dont have Permission to Use This Wing");

    			  }

    			break;

    			case 28:

    			if($sender->hasPermission("angelv5.wing") or $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){

    			    $setskin = new setSkin();

    			    $setskin->setSkin($sender, "angelv5");

    			  } else {

    			    $this->Form($sender, TextFormat::RED . "You dont have Permission to Use This Wing");

    			  }

    			break;

    			case 29:

    			if($sender->hasPermission("angelv6.wing") or $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){

    			    $setskin = new setSkin();

    			    $setskin->setSkin($sender, "angelv6");

    			  } else {

    			    $this->Form($sender, TextFormat::RED . "You dont have Permission to Use This Wing");

    			  }

    			break;

    			case 30:

    			if($sender->hasPermission("dragonv1.wing") or $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){

    			    $setskin = new setSkin();

    			    $setskin->setSkin($sender, "dragonv1");

    			  } else {

    			    $this->Form($sender, TextFormat::RED . "You dont have Permission to Use This Wing");

    			  }

    			break;

    			case 31:

    			if($sender->hasPermission("dragonv2.wing") or $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){

    			    $setskin = new setSkin();

    			    $setskin->setSkin($sender, "dragonv2");

    			  } else {

    			    $this->Form($sender, TextFormat::RED . "You dont have Permission to Use This Wing");

    			  }

    			break;

    			case 32:

    			if($sender->hasPermission("dragonv3.wing") or $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){

    			    $setskin = new setSkin();

    			    $setskin->setSkin($sender, "dragonv3");

    			  } else {

    			    $this->Form($sender, TextFormat::RED . "You dont have Permission to Use This Wing");

    			  }

    			break;

    			case 33:

    			if($sender->hasPermission("dragonv4.wing") or $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){

    			    $setskin = new setSkin();

    			    $setskin->setSkin($sender, "dragonv4");

    			  } else {

    			    $this->Form($sender, TextFormat::RED . "You dont have Permission to Use This Wing");

    			  }

    			break;

    			case 34:

    			  $this->resetSkin($sender);

    			break;

    			case 35:

    			break;

    		}

            return false;

    	});

    	$form->setTitle(TextFormat::BLUE . "Custom" . TextFormat::WHITE . "Wing");

    	$form->setContent($txt);

    	$form->addButton("§eKagune Wing\n§7[ §fV1 §7]",0, "textures/ui/dressing_room_capes");

    	$form->addButton("§eKakuja Wing\n§7[ §fV1 §7]",0, "textures/ui/dressing_room_capes");

    	$form->addButton("§eKakuja Wing\n§7[ §aV2 §7]",0, "textures/ui/dressing_room_capes");

    	$form->addButton("§eMercy Wing\n§7[ §fV1 §7]",0, "textures/ui/dressing_room_capes");

    	$form->addButton("§eMercy Wing\n§7[ §aV2 §7]",0, "textures/ui/dressing_room_capes");

    	$form->addButton("§eBalrog Wing\n§7[ §fV1 §7]",0, "textures/ui/dressing_room_capes");

    	$form->addButton("§eBalrog Wing\n§7[ §aV2 §7]",0, "textures/ui/dressing_room_capes");

    	$form->addButton("§eBlazing Wing\n§7[ §fV1 §7]",0, "textures/ui/dressing_room_capes");

    	$form->addButton("§eBlazing Wing\n§7[ §aV2 §7]",0, "textures/ui/dressing_room_capes");

    	$form->addButton("§eAurora Wing\n§7[ §fV1 §7]",0, "textures/ui/dressing_room_capes");

    	$form->addButton("§eAurora Wing\n§7[ §aV2 §7]",0, "textures/ui/dressing_room_capes");

    	$form->addButton("§eDavinci Wing\n§7[ §fV1 §7]",0, "textures/ui/dressing_room_capes");

    	$form->addButton("§eDavinci Wing\n§7[ §aV2 §7]",0, "textures/ui/dressing_room_capes");

    	$form->addButton("§eDevil Wing\n§7[ §fV1 §7]",0, "textures/ui/dressing_room_capes");

    	$form->addButton("§eDevil Wing\n§7[ §aV2 §7]",0, "textures/ui/dressing_room_capes");

    	$form->addButton("§eDiamond Wing\n§7[ §fV1 §7]",0, "textures/ui/dressing_room_capes");

    	$form->addButton("§eKnight Wing\n§7[ §fV1 §7]",0, "textures/ui/dressing_room_capes");

    	$form->addButton("§eKnight Wing\n§7[ §aV2 §7]",0, "textures/ui/dressing_room_capes");

    	$form->addButton("§eMonarch Wing\n§7[ §fV1 §7]",0, "textures/ui/dressing_room_capes");

    	$form->addButton("§eMonarch Wing\n§7[ §aV2 §7]",0, "textures/ui/dressing_room_capes");

    	$form->addButton("§eRazor Wing\n§7[ §fV1 §7]",0, "textures/ui/dressing_room_capes");

    	$form->addButton("§eRazor Wing\n§7[ §aV2 §7]",0, "textures/ui/dressing_room_capes");

    	$form->addButton("§eRobotic Wing\n§7[ §fV1 §7]",0, "textures/ui/dressing_room_capes");

    	$form->addButton("§eRobotic Wing\n§7[ §aV2 §7]",0, "textures/ui/dressing_room_capes");

    	$form->addButton("§eAngel Wing\n§7[ §fV1 §7]",0, "textures/ui/dressing_room_capes");

    	$form->addButton("§eAngel Wing\n§7[ §aV2 §7]",0, "textures/ui/dressing_room_capes");

    	$form->addButton("§eAngel Wing\n§7[ §bV3 §7]",0, "textures/ui/dressing_room_capes");

    	$form->addButton("§eAngel Wing\n§7[ §6V4 §7]",0, "textures/ui/dressing_room_capes");

    	$form->addButton("§eAngel Wing\n§7[ §dV5 §7]",0, "textures/ui/dressing_room_capes");

    	$form->addButton("§eAngel Wing\n§7[ §cV6 §7]",0, "textures/ui/dressing_room_capes");

    	$form->addButton("§eDragon Wing\n§7[ §fV1 §7]",0, "textures/ui/dressing_room_capes");

    	$form->addButton("§eDragon Wing\n§7[ §aV2 §7]",0, "textures/ui/dressing_room_capes");

    	$form->addButton("§eDragon Wing\n§7[ §bV3 §7]",0, "textures/ui/dressing_room_capes");

    	$form->addButton("§eDragon Wing\n§7[ §6V4 §7]",0, "textures/ui/dressing_room_capes");

    	$form->addButton("§7Reset Skin",0, "textures/ui/dressing_room_capes");

    	$form->addButton("Exit",0, "textures/ui/cancel");

    	$form->sendToPlayer($sender);

    	return $form;

    }

    

    public function resetSkin(Player $player){

      $player->sendMessage("Reset To Original Skin Successfully");

      $reset = new resetSkin();

      $reset->setSkin($player);

    }

    

    public function checkSkin(){

      $Available = [];

      if(!file_exists($this->getDataFolder() . "skin")){

        mkdir($this->getDataFolder() . "skin");

      }

      $path = $this->getDataFolder() . "skin/";

      $allskin = scandir($path);

      foreach($allskin as $file){

          array_push($Available, preg_replace("/.json/", "", $file));

      }

      foreach($Available as $value){

        if(!in_array($value . ".png", $allskin)){

          unset($Available[array_search($value, $Available)]);

        }

      }

      $this->json = count($Available);

      $Available = [];

    }

    

    public function checkRequirement(){

      if(!extension_loaded("gd")){

        $this->getServer()->getLogger()->info("§6Clothes: Uncomment gd2.dll (remove symbol ';' in ';extension=php_gd2.dll') in bin/php/php.ini to make the plugin working");

        $this->getServer()->getPluginManager()->disablePlugin($this);

      }

      if(!class_exists(SimpleForm::class)){

        $this->getServer()->getLogger()->info("§6Clothes: FormAPI class missing,pls use .phar from poggit!");

        $this->getServer()->getPluginManager()->disablePlugin($this);

        return;

      }

      if (!file_exists($this->getDataFolder() . "steve.png") || !file_exists($this->getDataFolder() . "steve.json") || !file_exists($this->getDataFolder() . "config.yml")) {

            if (file_exists(str_replace("config.yml", "", $this->getResources()["config.yml"]))) {

                $this->recurse_copy(str_replace("config.yml", "", $this->getResources()["config.yml"]), $this->getDataFolder());

            } else {

                $this->getServer()->getLogger()->info("§6Clothes: Something wrong with the resources");

                $this->getServer()->getPluginManager()->disablePlugin($this);

                return;

            }

      }

    }

    

    public function recurse_copy($src, $dst)

    {

        $dir = opendir($src);

        @mkdir($dst);

        while (false !== ($file = readdir($dir))) {

            if (($file != '.') && ($file != '..')) {

                if (is_dir($src . '/' . $file)) {

                    $this->recurse_copy($src . '/' . $file, $dst . '/' . $file);

                } else {

                    copy($src . '/' . $file, $dst . '/' . $file);

                }

            }

        }

        closedir($dir);

    }

    public static function decodeClientData(string $clientDataJwt): ClientData{

        try{

            [, $clientDataClaims, ] = JwtUtils::parse($clientDataJwt);

        }catch(JwtException $e){

            throw PacketHandlingException::wrap($e);

        }

        $mapper = new \JsonMapper;

        $mapper->bEnforceMapType = false;

        $mapper->bExceptionOnMissingData = true;

        $mapper->bExceptionOnUndefinedProperty = true;

        try{

            $clientData = $mapper->map($clientDataClaims, new ClientData);

        }catch(\JsonMapper_Exception $e){

            throw PacketHandlingException::wrap($e);

        }

        return $clientData;

    }

}
