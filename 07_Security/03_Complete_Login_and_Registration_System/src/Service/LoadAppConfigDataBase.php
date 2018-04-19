<?php
// src/Service/loadAppConfigDataBase.php
namespace App\Service;

use App\Entity\AppConfig;
use App\Entity\AppConfigOptions;  

class LoadAppConfigDataBase {
    public function existAppConfigDataBase($em) {
        $appConfig_repo = $em->getRepository(AppConfig::class);
        $appConfigOptions_repo = $em->getRepository(AppConfigOptions::class);
        $appConfig_dataBase = $appConfig_repo->findAll();
        $appConfigOptions_dataBase = $appConfigOptions_repo->findAll();
        if( count($appConfig_dataBase) === 0 && count($appConfigOptions_dataBase) === 0){
            $dataBase = $this->loadAppConfigDataBase();
            $createDataBase = $this->createDataBase($dataBase, $em);
            $message = true;
        }else{
            $message = false;
        }
        return $message;
    }
    public function loadAppConfigDataBase() {
        $appConfig = [
            "1"=>[
                "options"=>"1",
                "name"=>"app_name",
                "type"=>"text"
            ],
            "2"=>[
                "options"=>"2",
                "name"=>"keep_me_logged_in",
                "type"=>"options"
            ],
            "3"=>[
                "options"=>"5",
                "name"=>"register_new_user",
                "type"=>"options"
            ], 
            "4"=>[
                "options"=>"7",
                "name"=>"first_user",
                "type"=>"hidden"
            ]         
        ];
        $appConfigOptions = [
            "1"=>[
                "app_config"=>"1",
                "name"=>"AppExample"
            ],
            "2"=>[
                "app_config"=>"2",
                "name"=>"yes"
            ],
            "3"=>[
                "app_config"=>"2",
                "name"=>"no"
            ], 
            "4"=>[
                "app_config"=>"3",
                "name"=>"administrators_only"
            ],
            "5"=>[
                "app_config"=>"3",
                "name"=>"visitors"
            ],
            "6"=>[
                "app_config"=>"3",
                "name"=>"visitors_but_approval_is_required"
            ],
            "7"=>[
                "app_config"=>"4",
                "name"=>"first_user"
            ],        
        ];
        $dataBase = [
            "appConfig" => $appConfig, 
            "appConfigOptions" => $appConfigOptions
        ];
        return $dataBase;
    }
    public function createDataBase($dataBase, $em) {
        $appConfig_repo = $em->getRepository(AppConfig::class);
        $appConfigOptions_repo = $em->getRepository(AppConfigOptions::class);
        $appConfig_array = $dataBase["appConfig"];
        $appConfigOptions_array = $dataBase["appConfigOptions"];
        foreach($appConfig_array as $key=>$value){
            $appConfig = new AppConfig();
            $appConfig->setOptions($appConfigOptions_repo->findOneById($value["options"]));
            $appConfig->setName($value["name"]);
            $appConfig->setType($value["type"]);
            $em->persist($appConfig);
            $em->flush();
        }
        foreach($appConfigOptions_array as $key=>$value){
            $appConfigOptions = new AppConfigOptions();
            $appConfigOptions->setAppConfig($appConfig_repo->findOneById($value["app_config"]));
            $appConfigOptions->setName($value["name"]);
            $em->persist($appConfigOptions);
            $em->flush();
        }
        foreach($appConfig_array as $key=>$value){
            $appConfig = $appConfig_repo->findOneById($key);
            $appConfig->setOptions($appConfigOptions_repo->findOneById($value["options"]));
            $appConfig->setName($value["name"]);
            $appConfig->setType($value["type"]);
            $em->persist($appConfig);
            $em->flush();
        } 
    }
}