
CREATE DATABASE`campeonato-brasileiro`;

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
) ENGINE=InnoDB AUTO_INCREMENT=277 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `times`;

CREATE TABLE `times` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
