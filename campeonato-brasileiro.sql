
CREATE DATABASE `campeonato-brasileiro`;

USE `campeonato-brasileiro`;


DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2019_08_19_000000_create_failed_jobs_table',1),
(2,'2021_03_30_200148_create_times',1),
(3,'2021_03_30_230144_create_rodadas',1),
(4,'2021_03_31_221237_create_posicao_time',1);

DROP TABLE IF EXISTS `posicao_time`;

CREATE TABLE `posicao_time` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `posicao` int(11) NOT NULL,
  `time_id` bigint(20) unsigned NOT NULL,
  `jogos` int(11) NOT NULL,
  `vitorias` int(11) NOT NULL,
  `empate` int(11) NOT NULL,
  `derrota` int(11) NOT NULL,
  `gols_pro` int(11) NOT NULL,
  `gols_contra` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `posicao_time_time_id_foreign` (`time_id`),
  CONSTRAINT `posicao_time_time_id_foreign` FOREIGN KEY (`time_id`) REFERENCES `times` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


insert  into `posicao_time`(`id`,`posicao`,`time_id`,`jogos`,`vitorias`,`empate`,`derrota`,`gols_pro`,`gols_contra`,`status`,`created_at`,`updated_at`) values 
(1,1,1,0,0,0,0,0,0,0,'2021-04-02 03:10:00','2021-04-02 03:10:00'),
(2,2,2,0,0,0,0,0,0,0,'2021-04-02 03:10:00','2021-04-02 03:10:00'),
(3,3,3,0,0,0,0,0,0,0,'2021-04-02 03:10:00','2021-04-02 03:10:00'),
(4,4,4,0,0,0,0,0,0,0,'2021-04-02 03:10:00','2021-04-02 03:10:00'),
(5,5,5,0,0,0,0,0,0,0,'2021-04-02 03:10:00','2021-04-02 03:10:00'),
(6,6,6,0,0,0,0,0,0,0,'2021-04-02 03:10:00','2021-04-02 03:10:00'),
(7,7,7,0,0,0,0,0,0,0,'2021-04-02 03:10:00','2021-04-02 03:10:00'),
(8,8,8,0,0,0,0,0,0,0,'2021-04-02 03:10:00','2021-04-02 03:10:00'),
(9,9,9,0,0,0,0,0,0,0,'2021-04-02 03:10:00','2021-04-02 03:10:00'),
(10,10,10,0,0,0,0,0,0,0,'2021-04-02 03:10:00','2021-04-02 03:10:00'),
(11,11,11,0,0,0,0,0,0,0,'2021-04-02 03:10:00','2021-04-02 03:10:00'),
(12,12,12,0,0,0,0,0,0,0,'2021-04-02 03:10:00','2021-04-02 03:10:00'),
(13,13,13,0,0,0,0,0,0,0,'2021-04-02 03:10:00','2021-04-02 03:10:00'),
(14,14,14,0,0,0,0,0,0,0,'2021-04-02 03:10:00','2021-04-02 03:10:00'),
(15,15,15,0,0,0,0,0,0,0,'2021-04-02 03:10:00','2021-04-02 03:10:00'),
(16,16,16,0,0,0,0,0,0,0,'2021-04-02 03:10:00','2021-04-02 03:10:00'),
(17,17,17,0,0,0,0,0,0,0,'2021-04-02 03:10:00','2021-04-02 03:10:00'),
(18,18,18,0,0,0,0,0,0,0,'2021-04-02 03:10:00','2021-04-02 03:10:00'),
(19,19,19,0,0,0,0,0,0,0,'2021-04-02 03:10:00','2021-04-02 03:10:00'),
(20,20,20,0,0,0,0,0,0,0,'2021-04-02 03:10:00','2021-04-02 03:10:00');


DROP TABLE IF EXISTS `rodadas`;

CREATE TABLE `rodadas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `time_casa` bigint(20) unsigned NOT NULL,
  `time_fora` bigint(20) unsigned NOT NULL,
  `gols_time_casa` int(11) NOT NULL,
  `gols_time_fora` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rodadas_time_casa_foreign` (`time_casa`),
  KEY `rodadas_time_fora_foreign` (`time_fora`),
  CONSTRAINT `rodadas_time_casa_foreign` FOREIGN KEY (`time_casa`) REFERENCES `times` (`id`),
  CONSTRAINT `rodadas_time_fora_foreign` FOREIGN KEY (`time_fora`) REFERENCES `times` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `times`;

CREATE TABLE `times` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


insert  into `times`(`id`,`name`,`logo`,`created_at`,`updated_at`) values 
(1,'América-MG','img/America-MG.png','2021-04-02 06:10:00','2021-04-02 06:10:00'),
(2,'Athletico-PR','img/Athletico-PR.png','2021-04-02 06:10:00','2021-04-02 06:10:00'),
(3,'Atlético-GO','img/atletico-go.png','2021-04-02 06:10:00','2021-04-02 06:10:00'),
(4,'Atlético-MG','img/atletico-mg.png','2021-04-02 06:10:00','2021-04-02 06:10:00'),
(5,'Bahia','img/bahia.png','2021-04-02 06:10:00','2021-04-02 06:10:00'),
(6,'Bragantino','img/rb-bragantino.png','2021-04-02 06:10:00','2021-04-02 06:10:00'),
(7,'Ceará','img/ceara.png','2021-04-02 06:10:00','2021-04-02 06:10:00'),
(8,'Chapecoense','img/chapecoense.png','2021-04-02 06:10:00','2021-04-02 06:10:00'),
(9,'Corinthians','img/Corinthians.png','2021-04-02 06:10:00','2021-04-02 06:10:00'),
(10,'Cuiabá','img/Cuiaba_EC.png','2021-04-02 06:10:00','2021-04-02 06:10:00'),
(11,'Flamengo','img/Flamengo.png','2021-04-02 06:10:00','2021-04-02 06:10:00'),
(12,'Fluminense','img/fluminense.png','2021-04-02 06:10:00','2021-04-02 06:10:00'),
(13,'Fortaleza','img/fortaleza.png','2021-04-02 06:10:00','2021-04-02 06:10:00'),
(14,'Grêmio','img/gremio.png','2021-04-02 06:10:00','2021-04-02 06:10:00'),
(15,'Internacional','img/internacional.png','2021-04-02 06:10:00','2021-04-02 06:10:00'),
(16,'Juventude','img/juventude.png','2021-04-02 06:10:00','2021-04-02 06:10:00'),
(17,'Palmeiras','img/Palmeiras.png','2021-04-02 06:10:00','2021-04-02 06:10:00'),
(18,'Santos','img/santos.png','2021-04-02 06:10:00','2021-04-02 06:10:00'),
(19,'São Paulo','img/sao-paulo.png','2021-04-02 06:10:00','2021-04-02 06:10:00'),
(20,'Sport','img/sport.png','2021-04-02 06:10:00','2021-04-02 06:10:00');
