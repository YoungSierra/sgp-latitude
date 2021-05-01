-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-05-2021 a las 19:48:44
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sgp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgp_activity_log`
--

CREATE TABLE `sgp_activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgp_associates`
--

CREATE TABLE `sgp_associates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `identification` varchar(255) DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgp_contractors`
--

CREATE TABLE `sgp_contractors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgp_failed_jobs`
--

CREATE TABLE `sgp_failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgp_migrations`
--

CREATE TABLE `sgp_migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgp_model_has_permissions`
--

CREATE TABLE `sgp_model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgp_model_has_roles`
--

CREATE TABLE `sgp_model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sgp_model_has_roles`
--

INSERT INTO `sgp_model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgp_oauth_access_tokens`
--

CREATE TABLE `sgp_oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgp_oauth_auth_codes`
--

CREATE TABLE `sgp_oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgp_oauth_clients`
--

CREATE TABLE `sgp_oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgp_oauth_personal_access_clients`
--

CREATE TABLE `sgp_oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgp_oauth_refresh_tokens`
--

CREATE TABLE `sgp_oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgp_password_resets`
--

CREATE TABLE `sgp_password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgp_permissions`
--

CREATE TABLE `sgp_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sgp_permissions`
--

INSERT INTO `sgp_permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'add_user', 'web', '2021-03-09 01:00:56', '2021-03-09 01:00:56'),
(2, 'show_user', 'web', '2021-03-09 01:00:56', '2021-03-09 01:00:56'),
(3, 'edit_user', 'web', '2021-03-09 01:00:56', '2021-03-09 01:00:56'),
(4, 'delete_user', 'web', '2021-03-09 01:00:56', '2021-03-09 01:00:56'),
(5, 'add_role', 'web', '2021-03-09 01:00:56', '2021-03-09 01:00:56'),
(6, 'show_role', 'web', '2021-03-09 01:00:56', '2021-03-09 01:00:56'),
(7, 'edit_role', 'web', '2021-03-09 01:00:56', '2021-03-09 01:00:56'),
(8, 'delete_role', 'web', '2021-03-09 01:00:56', '2021-03-09 01:00:56'),
(9, 'add_permission', 'web', '2021-03-09 01:00:56', '2021-03-09 01:00:56'),
(10, 'show_permission', 'web', '2021-03-09 01:00:56', '2021-03-09 01:00:56'),
(11, 'edit_permission', 'web', '2021-03-09 01:00:56', '2021-03-09 01:00:56'),
(12, 'delete_permission', 'web', '2021-03-09 01:00:56', '2021-03-09 01:00:56'),
(13, 'add_associate', 'web', '2021-03-09 01:00:56', '2021-03-09 01:00:56'),
(14, 'show_associate', 'web', '2021-03-09 01:00:56', '2021-03-09 01:00:56'),
(15, 'edit_associate', 'web', '2021-03-09 01:00:56', '2021-03-09 01:00:56'),
(16, 'delete_associate', 'web', '2021-03-09 01:00:56', '2021-03-09 01:00:56'),
(17, 'add_contractor', 'web', '2021-03-09 01:00:57', '2021-03-09 01:00:57'),
(18, 'show_contractor', 'web', '2021-03-09 01:00:57', '2021-03-09 01:00:57'),
(19, 'edit_contractor', 'web', '2021-03-09 01:00:57', '2021-03-09 01:00:57'),
(20, 'delete_contractor', 'web', '2021-03-09 01:00:57', '2021-03-09 01:00:57'),
(21, 'add_policy', 'web', '2021-03-09 01:00:57', '2021-03-09 01:00:57'),
(22, 'show_policy', 'web', '2021-03-09 01:00:57', '2021-03-09 01:00:57'),
(23, 'edit_policy', 'web', '2021-03-09 01:00:57', '2021-03-09 01:00:57'),
(24, 'delete_policy', 'web', '2021-03-09 01:00:57', '2021-03-09 01:00:57'),
(25, 'add_project', 'web', '2021-03-09 01:00:57', '2021-03-09 01:00:57'),
(26, 'show_project', 'web', '2021-03-09 01:00:57', '2021-03-09 01:00:57'),
(27, 'edit_project', 'web', '2021-03-09 01:00:57', '2021-03-09 01:00:57'),
(28, 'delete_project', 'web', '2021-03-09 01:00:57', '2021-03-09 01:00:57'),
(29, 'add_tax', 'web', '2021-03-09 01:00:57', '2021-03-09 01:00:57'),
(30, 'show_tax', 'web', '2021-03-09 01:00:57', '2021-03-09 01:00:57'),
(31, 'edit_tax', 'web', '2021-03-09 01:00:57', '2021-03-09 01:00:57'),
(32, 'delete_tax', 'web', '2021-03-09 01:00:57', '2021-03-09 01:00:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgp_policies`
--

CREATE TABLE `sgp_policies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgp_projects`
--

CREATE TABLE `sgp_projects` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `tiempo` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `valorbruto` double NOT NULL DEFAULT 0,
  `iva` double NOT NULL DEFAULT 0,
  `iva_v` varchar(255) NOT NULL DEFAULT '0',
  `retfuente` double NOT NULL DEFAULT 0,
  `retfuente_v` varchar(255) NOT NULL DEFAULT '0',
  `ica` double NOT NULL DEFAULT 0,
  `ica_v` varchar(255) NOT NULL DEFAULT '0',
  `retiva` double NOT NULL DEFAULT 0,
  `retiva_v` varchar(255) NOT NULL DEFAULT '0',
  `estampillas` double NOT NULL DEFAULT 0,
  `estampillas_v` varchar(255) NOT NULL DEFAULT '0',
  `cree` double NOT NULL DEFAULT 0,
  `cree_v` varchar(255) NOT NULL DEFAULT '0',
  `ica_t` double NOT NULL DEFAULT 0,
  `ica_tv` varchar(255) NOT NULL DEFAULT '0',
  `retica` double NOT NULL DEFAULT 0,
  `retica_v` varchar(255) NOT NULL DEFAULT '0',
  `netopagar` varchar(255) NOT NULL DEFAULT '0',
  `totimpuesto` varchar(255) NOT NULL DEFAULT '0',
  `neto` varchar(255) NOT NULL DEFAULT '0',
  `valorbruto_c` varchar(255) NOT NULL DEFAULT '0',
  `impuestos` varchar(255) NOT NULL DEFAULT '0',
  `totpolizas` varchar(255) NOT NULL DEFAULT '0',
  `totcontratistas` varchar(255) NOT NULL DEFAULT '0',
  `subtotal` varchar(255) NOT NULL DEFAULT '0',
  `comisionreferido` double NOT NULL DEFAULT 0,
  `comisionreferido_v` varchar(255) NOT NULL DEFAULT '0',
  `imprevistos` double NOT NULL DEFAULT 0,
  `imprevistos_v` varchar(255) NOT NULL DEFAULT '0',
  `apalancamiento` double NOT NULL DEFAULT 0,
  `apalancamiento_v` varchar(255) NOT NULL DEFAULT '0',
  `obligafinancieras` double NOT NULL DEFAULT 0,
  `obligafinancieras_v` varchar(255) NOT NULL DEFAULT '0',
  `rse` double NOT NULL DEFAULT 0,
  `rse_v` varchar(255) NOT NULL DEFAULT '0',
  `costosexternos` varchar(255) NOT NULL DEFAULT '0',
  `nominafija` double NOT NULL DEFAULT 0,
  `nominafija_v` varchar(255) NOT NULL DEFAULT '0',
  `contratistalattitude` double NOT NULL DEFAULT 0,
  `contratistalattitude_v` varchar(255) NOT NULL DEFAULT '0',
  `arqejecutivofirma` double NOT NULL DEFAULT 0,
  `arqejecutivofirma_v` varchar(255) NOT NULL DEFAULT '0',
  `subtotcostosfijos` varchar(255) NOT NULL DEFAULT '0',
  `subtotcostosfijos_v` varchar(255) NOT NULL DEFAULT '0',
  `marcalattitude` double NOT NULL DEFAULT 0,
  `marcalattitude_v` varchar(255) NOT NULL DEFAULT '0',
  `tecnologia` double NOT NULL DEFAULT 0,
  `tecnologia_v` varchar(255) NOT NULL DEFAULT '0',
  `serviciospublicos` double NOT NULL DEFAULT 0,
  `serviciospublicos_v` varchar(255) NOT NULL DEFAULT '0',
  `subtotcostosplataforma` varchar(255) NOT NULL DEFAULT '0',
  `subtotcostosplataforma_v` varchar(255) NOT NULL DEFAULT '0',
  `recursoshumanos` double NOT NULL DEFAULT 0,
  `recursoshumanos_v` varchar(255) NOT NULL DEFAULT '0',
  `pryviaticos` double NOT NULL DEFAULT 0,
  `pryviaticos_v` varchar(255) NOT NULL DEFAULT '0',
  `comunicaciones` double NOT NULL DEFAULT 0,
  `comunicaciones_v` varchar(255) NOT NULL DEFAULT '0',
  `subtotrelacorporativas` varchar(255) NOT NULL DEFAULT '0',
  `subtotrelacorporativas_v` varchar(255) NOT NULL DEFAULT '0',
  `subtotnetogestora` varchar(255) NOT NULL DEFAULT '0',
  `subtotnetogestora_v` varchar(255) NOT NULL DEFAULT '0',
  `subtotnetoaejecutar` varchar(255) NOT NULL DEFAULT '0',
  `subtotnetoaejecutar_v` varchar(255) NOT NULL DEFAULT '0',
  `subtotoperaejecutar` varchar(255) NOT NULL DEFAULT '0',
  `subtotoperaejecutar_p` varchar(255) NOT NULL DEFAULT '0',
  `total` varchar(255) NOT NULL DEFAULT '0',
  `total_p` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgp_project_associates`
--

CREATE TABLE `sgp_project_associates` (
  `id` int(11) NOT NULL,
  `idproject` int(11) NOT NULL,
  `idassociate` int(11) NOT NULL,
  `valor` varchar(255) NOT NULL DEFAULT '0',
  `porcentaje` double NOT NULL DEFAULT 0,
  `fase1` double NOT NULL DEFAULT 0,
  `fase1ok` tinyint(1) DEFAULT 0,
  `fase2` double NOT NULL DEFAULT 0,
  `fase2ok` tinyint(1) DEFAULT 0,
  `fase3` double NOT NULL DEFAULT 0,
  `fase3ok` tinyint(1) DEFAULT 0,
  `totfases` varchar(255) DEFAULT '0',
  `partfinal_p` varchar(255) DEFAULT '0',
  `partfinal` varchar(255) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgp_project_contractors`
--

CREATE TABLE `sgp_project_contractors` (
  `id` int(11) NOT NULL,
  `idproject` int(11) NOT NULL,
  `idcontractor` int(11) NOT NULL,
  `valor` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgp_project_policies`
--

CREATE TABLE `sgp_project_policies` (
  `id` int(11) NOT NULL,
  `idproject` int(11) NOT NULL,
  `idpolicie` int(11) NOT NULL,
  `valor` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgp_roles`
--

CREATE TABLE `sgp_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sgp_roles`
--

INSERT INTO `sgp_roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'superadministrador', 'web', '2021-03-09 01:00:56', '2021-03-09 01:00:56'),
(2, 'administrador', 'web', '2021-03-09 01:00:56', '2021-03-09 01:00:56'),
(3, 'asociado', 'web', '2021-03-09 01:00:56', '2021-03-09 01:00:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgp_role_has_permissions`
--

CREATE TABLE `sgp_role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sgp_role_has_permissions`
--

INSERT INTO `sgp_role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(26, 3),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgp_sessions`
--

CREATE TABLE `sgp_sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgp_taxes`
--

CREATE TABLE `sgp_taxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgp_users`
--

CREATE TABLE `sgp_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `last_ip` varchar(255) DEFAULT NULL,
  `login_count` int(11) NOT NULL DEFAULT 0,
  `last_login` timestamp NULL DEFAULT NULL,
  `associate_id` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sgp_users`
--

INSERT INTO `sgp_users` (`id`, `first_name`, `last_name`, `password`, `email`, `status`, `last_ip`, `login_count`, `last_login`, `associate_id`, `email_verified_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super', 'Administrador', '$2y$10$mCjfUExyGHecqSj1G/BEMeC4rdWFfBhdf3O9FvlAurzKeaU9PHFOG', 'superadmin@lattitude.com', 1, NULL, 0, NULL, NULL, '2021-03-09 01:00:56', '2021-03-09 01:00:56', '2021-03-09 01:00:56', NULL),
(2, 'Administrador', 'User', '$2y$10$/UUuxxi/lwYLrwCLaVd6AORJwimyfkS7RmTyVHdh5iFm5LxWyZan6', 'admin@lattitude.com', 1, NULL, 0, NULL, NULL, '2021-03-09 01:00:56', '2021-03-09 01:00:56', '2021-03-09 01:00:56', NULL),
(3, 'Asociado', 'User', '$2y$10$qvbTKucBqlB8tDpb7yrV4eqmyT/uwUI3FCnRe/RQ9.g4f5PwhwwYS', 'asociado@lattitude.com', 1, NULL, 0, NULL, 1, '2021-03-09 01:00:56', '2021-03-09 01:00:56', '2021-03-25 20:48:41', NULL),
(4, 'CLAUDETTE', 'SANCHEZ', '$2y$10$WMqmB9pT8FsmxaAKUm48k.p80m5juPmC1.IenBDDd4fEgPyrMO3Eu', 'claudette@lattitude.com', 1, NULL, 0, NULL, 2, NULL, '2021-03-25 20:48:24', '2021-03-25 20:48:24', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `sgp_activity_log`
--
ALTER TABLE `sgp_activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sgp_activity_log_log_name_index` (`log_name`),
  ADD KEY `subject` (`subject_id`,`subject_type`),
  ADD KEY `causer` (`causer_id`,`causer_type`);

--
-- Indices de la tabla `sgp_associates`
--
ALTER TABLE `sgp_associates`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgp_contractors`
--
ALTER TABLE `sgp_contractors`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgp_failed_jobs`
--
ALTER TABLE `sgp_failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sgp_failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `sgp_migrations`
--
ALTER TABLE `sgp_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgp_model_has_permissions`
--
ALTER TABLE `sgp_model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `sgp_model_has_roles`
--
ALTER TABLE `sgp_model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `sgp_oauth_access_tokens`
--
ALTER TABLE `sgp_oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sgp_oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indices de la tabla `sgp_oauth_auth_codes`
--
ALTER TABLE `sgp_oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sgp_oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indices de la tabla `sgp_oauth_clients`
--
ALTER TABLE `sgp_oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sgp_oauth_clients_user_id_index` (`user_id`);

--
-- Indices de la tabla `sgp_oauth_personal_access_clients`
--
ALTER TABLE `sgp_oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgp_oauth_refresh_tokens`
--
ALTER TABLE `sgp_oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sgp_oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indices de la tabla `sgp_password_resets`
--
ALTER TABLE `sgp_password_resets`
  ADD KEY `sgp_password_resets_email_index` (`email`);

--
-- Indices de la tabla `sgp_permissions`
--
ALTER TABLE `sgp_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sgp_permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `sgp_policies`
--
ALTER TABLE `sgp_policies`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgp_projects`
--
ALTER TABLE `sgp_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgp_project_associates`
--
ALTER TABLE `sgp_project_associates`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgp_project_contractors`
--
ALTER TABLE `sgp_project_contractors`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgp_project_policies`
--
ALTER TABLE `sgp_project_policies`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgp_roles`
--
ALTER TABLE `sgp_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sgp_roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `sgp_role_has_permissions`
--
ALTER TABLE `sgp_role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `sgp_role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `sgp_sessions`
--
ALTER TABLE `sgp_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sgp_sessions_user_id_index` (`user_id`),
  ADD KEY `sgp_sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `sgp_taxes`
--
ALTER TABLE `sgp_taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sgp_users`
--
ALTER TABLE `sgp_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `sgp_activity_log`
--
ALTER TABLE `sgp_activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sgp_associates`
--
ALTER TABLE `sgp_associates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sgp_contractors`
--
ALTER TABLE `sgp_contractors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sgp_failed_jobs`
--
ALTER TABLE `sgp_failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sgp_migrations`
--
ALTER TABLE `sgp_migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sgp_oauth_clients`
--
ALTER TABLE `sgp_oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sgp_oauth_personal_access_clients`
--
ALTER TABLE `sgp_oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sgp_permissions`
--
ALTER TABLE `sgp_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `sgp_policies`
--
ALTER TABLE `sgp_policies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sgp_projects`
--
ALTER TABLE `sgp_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sgp_project_associates`
--
ALTER TABLE `sgp_project_associates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sgp_project_contractors`
--
ALTER TABLE `sgp_project_contractors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sgp_project_policies`
--
ALTER TABLE `sgp_project_policies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sgp_roles`
--
ALTER TABLE `sgp_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `sgp_taxes`
--
ALTER TABLE `sgp_taxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sgp_users`
--
ALTER TABLE `sgp_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `sgp_model_has_permissions`
--
ALTER TABLE `sgp_model_has_permissions`
  ADD CONSTRAINT `sgp_model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `sgp_permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `sgp_model_has_roles`
--
ALTER TABLE `sgp_model_has_roles`
  ADD CONSTRAINT `sgp_model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `sgp_roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `sgp_role_has_permissions`
--
ALTER TABLE `sgp_role_has_permissions`
  ADD CONSTRAINT `sgp_role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `sgp_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sgp_role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `sgp_roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
