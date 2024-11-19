-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 08, 2024 at 07:49 PM
-- Server version: 10.11.9-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u546787212_korbit`
--

-- --------------------------------------------------------

--
-- Table structure for table `academy_orders`
--

CREATE TABLE `academy_orders` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `amount` decimal(16,4) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `academy_orders`
--

INSERT INTO `academy_orders` (`id`, `user_id`, `order_id`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(10, 82, 'rI87Y44Ur653A979', 300.0000, 'pending', '2024-10-02 09:30:41', '2024-10-02 09:30:41'),
(11, 79, '29311dyb25wd60X4', 300.0000, 'pending', '2024-10-03 11:43:47', '2024-10-03 11:43:47'),
(12, 79, 'klv9OP39s3Ij8fl1', 300.0000, 'pending', '2024-10-03 11:52:29', '2024-10-03 11:52:29'),
(13, 79, 'eI5264fh44wVxkk4', 300.0000, 'pending', '2024-10-03 14:58:05', '2024-10-03 14:58:05'),
(14, 79, '344G25k7Zc794H48', 300.0000, 'pending', '2024-10-03 15:13:56', '2024-10-03 15:13:56');

-- --------------------------------------------------------

--
-- Table structure for table `arbitrage_sessions`
--

CREATE TABLE `arbitrage_sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `restart_timer` varchar(255) NOT NULL,
  `number_of_response_left` int(11) NOT NULL,
  `total_responses` int(11) NOT NULL,
  `error_json_chance` int(11) DEFAULT NULL,
  `error_data_chance` int(11) DEFAULT NULL,
  `not_found_chance` int(11) DEFAULT NULL,
  `success_chance` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `arbitrage_sessions`
--

INSERT INTO `arbitrage_sessions` (`id`, `user_id`, `restart_timer`, `number_of_response_left`, `total_responses`, `error_json_chance`, `error_data_chance`, `not_found_chance`, `success_chance`, `created_at`, `updated_at`) VALUES
(20, '82', '1728325593', 15, 16, 3, 2, 2, 8, '2024-10-05 10:51:03', '2024-10-06 18:27:31'),
(21, '79', '1728326828', 5, 15, 2, 0, 1, 2, '2024-10-06 18:47:08', '2024-10-07 04:39:34');

-- --------------------------------------------------------

--
-- Table structure for table `currency_rates`
--

CREATE TABLE `currency_rates` (
  `id` int(11) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `price` decimal(16,4) NOT NULL,
  `old_price` decimal(15,6) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currency_rates`
--

INSERT INTO `currency_rates` (`id`, `currency`, `price`, `old_price`, `created_at`, `updated_at`) VALUES
(1, 'DAI', 0.9679, 0.968100, '2023-11-02 23:00:03', '2024-10-08 19:30:03'),
(2, 'BUSD', 1.0020, 1.000900, '2023-11-02 23:00:03', '2024-10-08 19:30:03'),
(3, 'USDT', 1.0004, 1.000900, '2023-11-02 23:00:03', '2024-10-08 19:30:03');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `license_orders`
--

CREATE TABLE `license_orders` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `amount` decimal(16,4) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `license_orders`
--

INSERT INTO `license_orders` (`id`, `user_id`, `order_id`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(20, 79, 'K67x4CT8862hw372', 21.0000, 'cancelled', '2024-09-29 05:42:16', '2024-09-29 05:42:16'),
(21, 80, 'M6H116G21I36hRZ5', 21.0000, 'cancelled', '2024-09-30 13:36:15', '2024-09-30 13:36:15'),
(22, 82, 'K04Co4yj76v1aKdb', 21.0000, 'completed', '2024-09-30 14:16:52', '2024-09-30 14:16:52'),
(23, 79, 'g651528W640e64O5', 21.0000, 'cancelled', '2024-10-03 16:58:16', '2024-10-03 16:58:16');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nfts`
--

CREATE TABLE `nfts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `meta_data` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `blockchain` varchar(255) DEFAULT NULL,
  `marketplace` varchar(255) DEFAULT NULL,
  `status` enum('available','sold','reserved') DEFAULT 'available',
  `price` decimal(16,4) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nfts`
--

INSERT INTO `nfts` (`id`, `name`, `image`, `meta_data`, `created_at`, `updated_at`, `blockchain`, `marketplace`, `status`, `price`, `description`) VALUES
(6, 'Promised Land', 'nfts/bDivK4OxSkhRIzsXBkMhMSsVopbA02-metaUHJvbWlzZWQgTGFuZC5wbmc=-.png', 'X7RM2O', '2024-02-03 23:41:49', '2024-02-07 01:37:24', 'Solana', NULL, 'available', 6.7820, 'Promised Land is the Genesis collection of Sower, a tool to change airdrop farming while also changing your life.'),
(7, 'Tensorians', 'nfts/cY2Xdp6E7EihQMzY777oac1DbqjXAV-metaVGVuc29yaWFucy5wbmc=-.png', 'SMJ7T8', '2024-02-03 23:43:49', '2024-02-07 01:37:44', 'Solana', NULL, 'available', 91.9507, 'Tensorians (TENSORIANS) is an NFT collection.'),
(8, 'Froganas', 'nfts/4CTvvQRq2CtrEJNTDbfmHGA4VwCf9q-metaRnJvZ2FuYXMucG5n-.png', 'SGXBXM', '2024-02-03 23:45:14', '2024-02-07 01:38:03', 'Solana', NULL, 'available', 14.9701, 'Froganas are frogs mutated by mysterious environmental changes. They dress, speak and act like humans. They live on an island filled with their kind and are welcoming to new members. Froganas are very intelligent creatures, resourceful and they are very good at crafting tools and maintaining a unique connection with the swamp ecosystem on their island.'),
(9, 'BoDoggos', 'nfts/4ssyw8Z7DooBKyBO1RjXLrU9rgTjKZ-metaQm9Eb2dnb3MucG5n-.png', '3TN2RL', '2024-02-03 23:46:25', '2024-02-07 01:38:22', 'Solana', NULL, 'available', 8.1562, 'The Residents of Cash City.'),
(10, 'Dogwifhat', 'nfts/IaGlgOcpGmiQEsVSa4bCW1fzw73q9y-metaRG9nd2lmaGF0LmpwZWc=-.jpg', 'FAW3GZ', '2024-02-07 00:19:21', '2024-02-07 01:38:41', 'Solana', NULL, 'available', 2.6628, 'just a dog wif a hat.'),
(11, 'BONKz', 'nfts/ymrLFHGCzppSo8rzyqDNzAq40dItOj-metaQk9OS3oucG5n-.png', 'CMRZXL', '2024-02-07 00:22:17', '2024-02-07 01:39:42', 'Solana', NULL, 'available', 1.0642, 'BONKz doggos are on a mission to spread good vibes across the world.'),
(12, 'Exiled DeGods', 'nfts/tj0zHPBMxtxLYr6zuHIDe2XsU1p6un-metaRXhpbGVkIERlR29kcy5wbmc=-.png', 'RJG491', '2024-02-07 00:24:03', '2024-02-07 01:40:03', 'Solana', NULL, 'available', 7.7761, '2500 Exiled DeGods left on Solana'),
(13, ' Heroes of Elumia', 'nfts/vWjvsGN5QWBJ4R8RFCHfs3pxqrugRa-metaSGVyb2VzIG9mIEVsdW1pYS5wbmc=-.png', 'YS2CJQ', '2024-02-07 00:26:41', '2024-02-07 01:40:23', 'Solana', NULL, 'available', 2.2573, 'Be part of an EXCLUSIVE club of Elumia hero owners, each character is a unique, hand-crafted NFT. The Legends of Elumia world has gold or glory to be gained! The choice is yours....'),
(14, 'Namaste', 'nfts/eC9Hc2442IIrHy7ty8b7JIyY2j6L28-metaTmFtYXN0ZS5wbmc=-.png', 'GR2EID', '2024-02-07 00:29:20', '2024-02-07 01:40:44', 'Solana', NULL, 'available', 13.9141, 'Namaste is a declaration of love, a tribute to life, and a reminder that the most precious things in life are free: love, wisdom, and awareness. Solana Sensei\'s heartfelt messages are captured in 1,111 unique pieces, with whitelist spots handpicked by Solana Sensei himself.'),
(15, 'mackerel', 'nfts/dh4QrpZjpk6RMDYW2J2ylzWbWkM5wA-metabWFja2VyZWwuanBlZw==-.jpg', 'LAN206', '2024-02-07 00:31:03', '2024-02-07 01:41:02', 'Solana', NULL, 'available', 0.0143, '21000-mackerel_spl20'),
(16, 'Bonk SPL20', 'nfts/jcvoLRFEXcCSp8BsferPGbs0v3KrF6-metaQm9uayBTUEwyMC53ZWJw-.webp', 'WBK3RY', '2024-02-07 00:32:25', '2024-02-07 01:41:26', 'Solana', NULL, 'available', 0.2232, ' From community to community.'),
(17, 'SMB Gen3 Barrel', 'nfts/GTkMWxn28eoebLfWpnOK2AKmVM9mex-metaU01CIEdlbjMgQmFycmVsLmdpZg==-.gif', '0EP2WU', '2024-02-07 00:34:32', '2024-02-07 01:41:42', 'Solana', NULL, 'available', 3.5859, 'Inside every SMB barrel is a Gen3 monke waiting to escape. When will you help your monke break free?'),
(18, 'Taiyo Robotics', 'nfts/hOb0wIWBkBFhMecgO47HzrnUOptoNY-metaVGFpeW8gUm9ib3RpY3Mud2VicA==-.webp', '70JKFL', '2024-02-07 00:36:29', '2024-02-07 01:41:58', 'Solana', NULL, 'available', 43.8721, 'Taiyo Robotics are 2,121 Robots that have been manufactured on the Solana blockchain. They have been created to protect the world against giant monsters that have plagued earth.'),
(19, 'Solana Owl Society', 'nfts/8QRBNi03ZlscTyqpxTfxlq915WPJpL-metaU29sYW5hIE93bCBTb2NpZXR5LndlYnA=-.webp', 'DPNM59', '2024-02-07 00:37:57', '2024-02-07 01:42:23', 'Solana', NULL, 'available', 0.5981, 'Solana Owl society consisting of 25 Owls in total. A Collection of unique and one of a kind hand crafted collectibles that only exist in Solana BLOCKCHAIN. Each Owl card has unique and distinctive features.'),
(20, 'Degenerate Trash Pandas', 'nfts/TkwDht0OJXUpjarGIeCcqsTsw7lqcb-metaRGVnZW5lcmF0ZSBUcmFzaCBQYW5kYXMucG5n-.png', '51LWEO', '2024-02-07 00:39:34', '2024-02-07 01:42:43', 'Solana', NULL, 'available', 2.0791, 'Inhabiting their own underworld society, the Degenerate Trash Pandas are governed by no individuals and live by no rules. What they have is their trash, and their trash is their treasure. They’ll do whatever they can to get their dirty little paws on it. '),
(21, 'Blessed Dogs', 'nfts/fFT5RY7b3GK3JcwQj6mt1S3g2XCn83-metaQmxlc3NlZCBEb2dzLmpwZWc=-.jpg', 'W5T2N0', '2024-02-07 00:41:45', '2024-02-07 01:43:05', 'Solana', NULL, 'available', 0.1211, 'Not your typical collection MIПƬΣD FӨЯ 0.05 IП 09.03.2023'),
(22, 'Zeta Cards', 'nfts/N3c6psMwhgWCODDNVGP1vuSuAo1jdc-metaWmV0YSBDYXJkcy5wbmc=-.png', 'F5A8IZ', '2024-02-07 00:43:34', '2024-02-07 01:43:25', 'Solana', NULL, 'available', 0.5594, 'Collectibles that grant certain privileges to traders on Zeta.'),
(23, 'Boryoku Dragonz', 'nfts/RTRW4iPh5tN3NFUpRMHIQGsk0jfbHT-metaQm9yeW9rdSBEcmFnb256LnBuZw==-.png', 'H8VFXW', '2024-02-07 00:46:52', '2024-02-07 01:43:44', 'Solana', NULL, 'available', 27.4711, 'Bōryoku Dragonz are an exclusive collection of 1,111 Dragon NFT\'s on the Solana blockchain, backed by a top team of NFT collectors, designers, community builders, and artists. The project brings a fresh design to Solana with daily token airdrops, a breeding game with token burning mechanics, and a multi-chain community that completely transcends a simple PFP offering.\n'),
(24, 'Mad Lads', 'nfts/UZm0AI7VrU7poj9zhOXMxondkkabn8-metaWmV0YSBDYXJkcy5wbmc=-.png', 'J7EUQ0', '2024-02-07 00:48:24', '2024-02-07 01:44:06', 'Solana', NULL, 'available', 144.7201, 'Fock it.'),
(25, 'Gas Hero Coupon NFT', 'nfts/oI6ljYQgsK5e5GZNFaRd9hOinsftiL-metaR2FzIEhlcm8gQ291cG9uIE5GVC5wbmc=-.png', 'YTMAG3', '2024-02-07 00:52:50', '2024-02-07 01:44:28', 'Polygon', NULL, 'available', 198.4801, 'Redeemable Gas Hero Coupon NFT'),
(26, 'Zed Run', 'nfts/ZAPvqGpRKqfLFHykhmOuIfYDR2ChPI-metaWmVkIFJ1bi5wbmc=-.png', '854X7C', '2024-02-07 00:54:24', '2024-02-07 01:44:48', 'Polygon', NULL, 'available', 0.0016, 'ZED RUN is the first digital horse racing game on the blockchain.'),
(27, 'The Legend of CryptoTab: Age of Eggs III', 'nfts/6A0PjcQF7knI81P1unkOMxbwSXkvOZ-metaVGhlIExlZ2VuZCBvZiBDcnlwdG9UYWJfIEFnZSBvZiBFZ2dzIElJSS5wbmc=-.png', 'GX7OZE', '2024-02-07 01:05:04', '2024-02-07 01:45:07', 'Polygon', NULL, 'available', 54.4905, ' Legend has it that after the first Ages of Eggs, the most powerful code-wizards across the realms united to create artifacts of the ultimate might. They crackle with the force contained within, but still grow more and more powerful!'),
(28, 'Meta Toy Dragonz - P', 'nfts/g7SYhFmM14vyQOE7wHqkZ7lH7KQMpb-metaTWV0YSBUb3kgRHJhZ29ueiAtIFAucG5n-.png', 'W3QJNC', '2024-02-07 01:08:31', '2024-02-07 01:45:27', 'Polygon', NULL, 'available', 124.4891, 'Meta Toy DragonZ(MTDZ) is a collection of 9,999 toy dragons living in Meta Toy World. Enjoy Web3 games and metaverse with Meta Toy DragonZ'),
(29, 'BoomLand - Hunters', 'nfts/WyVLmlniIC681WTvhkOzbMHsv74Zzc-metaQm9vbUxhbmQgLSBIdW50ZXJzLmdpZg==-.gif', 'V3U5X6', '2024-02-07 01:10:11', '2024-02-07 01:45:55', 'Polygon', NULL, 'available', 1.8989, ' Hunters are digital assets that give you access to Hunters On-Chain. They come with many different traits and in different rarities, there won’t be two identical Hunters...ever!\nWhich hunter will you choose to take to The Hunting Grounds?'),
(30, 'BLOCKLORDS HEROES', 'nfts/io9ZhtfTJdRA3pxzIMInsmJfit3XcQ-metaQkxPQ0tMT1JEUyBIRVJPRVMuZ2lm-.gif', 'LN6O89', '2024-02-07 01:12:00', '2024-02-07 01:46:24', 'Polygon', NULL, 'available', 2.6354, 'BLOCKLORDS is a player-driven medieval grand strategy game where your decisions and skills shape the world and narrative. Choose from several playstyles, including farming, fighting, resource management, and ruling, and forge your own destiny as your hero.'),
(31, 'Treevolve Tree', 'nfts/6x0f88KYkCEFM4NWizutZn6I5m2onz-metaVHJlZXZvbHZlIFRyZWUuanBlZw==-.jpg', 'JHMOTG', '2024-02-07 01:14:19', '2024-02-07 01:46:46', 'Polygon', NULL, 'available', 22.2863, 'Treevolve are mystical trees that grow and change as they get traded. Nurture and keep the tree to mine $WOMBAT tokens or stake it for additional rewards in the Dungeon Master game.'),
(32, 'BellyLand', 'nfts/05iiHKWwU5MHkm4nXR91HVF7ST1bS7-metaQmVsbHlMYW5kLmpwZWc=-.jpg', 'AO1TNF', '2024-02-07 01:16:33', '2024-02-07 01:47:07', 'Polygon', NULL, 'available', 128.0031, '“BellyLand” represents the second collection featuring Bellygom, an immensely popular IP character in Korea that was created by Lotte Group, one of South Korea’s leading conglomerates. BellyLand showcases Bellygom’s next journey into an exciting adventure. Through the world of Bellygom and BellyLand, you will unlock the vision of Lotte Group’s web3 and gain access to the future with Lotte Group.'),
(33, 'Crypto Unicorns: Shadowcorns Market', 'nfts/PfQtBqppA0u0W72a2Io4iGIO1QOTAZ-metaQ3J5cHRvIFVuaWNvcm5zXyBTaGFkb3djb3JucyBNYXJrZXQuanBlZw==-.jpg', 'HI6SW5', '2024-02-07 01:18:04', '2024-02-07 01:47:25', 'Polygon', NULL, 'available', 0.0799, 'Shadowcorns are the dark, brooding cousins of the frolicking, carefree heroes of Crypto Unicorns - a blockchain game in which you can collect, hatch, and breed your very own Crypto Unicorns to participate in Farming your Land NFTs, Gathering resources, and joining in an ever-expanding list of activities like Jousting, Racing, and Team RPG Battle! The 3,000 Shadowcorns hatched from Common, Rare, and Mythic Shadowcorn Eggs form the foundation of the long-term PvE gameplay in Crypto Unicorns, being the key to the domination and production of Shadowcorn Minions!'),
(34, 'GREEVER Car', 'nfts/KurPLZG7hgTqNEBE7jazC9sZYl96Uu-metaR1JFRVZFUiBDYXIucG5n-.png', 'JSLYXV', '2024-02-07 01:20:56', '2024-02-07 01:47:44', 'Polygon', NULL, 'available', 280.1180, 'GREEVER'),
(35, 'COIN Pickaxes (Powered by XYO)', 'nfts/CBIC9i80YHU073QcYZ0Jbc4xoWTnpD-metaQ09JTiBQaWNrYXhlcyAoUG93ZXJlZCBieSBYWU8pLnBuZw==-.png', 'U84FG2', '2024-02-08 10:46:43', '2024-02-08 10:46:43', 'Polygon', NULL, 'available', 2.8639, 'Welcome to the world of COIN Pickaxes (powered by XYO). COIN Pickaxes are functional NFTs which give Geomining related benefits when equipped in the COIN app (https://coinapp.co). There are five tiers of COIN Pickaxes that provide increasing levels of these benefits: Common, Uncommon, Rare, Epic, and Legendary. Enjoy!\n'),
(36, 'Ronin-Samurai', 'nfts/czOvPaoRi87Pbi8BjHJjVFaQVwtx8Q-metaUm9uaW4tU2FtdXJhaS5qcGVn-.jpg', '2G10AB', '2024-02-08 10:49:30', '2024-02-08 10:49:30', 'Polygon', NULL, 'available', 400.0000, 'The Ronin-Samurai collection is my creation which is an exciting and engaging series of digital artworks that pays homage to Japan\'s rich cultural heritage and iconic warrior traditions. Each NFT in this collection is a stunningly detailed depiction of a samurai warrior, each one unique and special in its own way'),
(37, 'Chumbi Valley Official', 'nfts/kk6VmmEyPKQ6zjIJzRriyIaix3AAEl-metaQ2h1bWJpIFZhbGxleSBPZmZpY2lhbC5wbmc=-.png', 'R5Z7NT', '2024-02-08 10:56:20', '2024-02-08 10:56:20', 'Polygon', NULL, 'available', 0.0844, 'Chumbi Valley is an enchanting RPG Play-to-Earn game being built on BSC & Polygon. Chumbi Valley features NFT creatures and original art inspired by Pokemon, and Studio Ghibli.\n'),
(38, 'Gambulls', 'nfts/zE6so4CDzJQJ0raVXjSnGl2Mkjuft8-metaR2FtYnVsbHMucG5n-.png', ' 355.4409 ', '2024-02-08 11:00:48', '2024-02-08 11:00:48', 'Polygon', NULL, 'available', 355.4409, 'Gambulls is a fully licensed crypto casino offering your favourite slots, live games & sportsbook including E-Sports! Future plans are already in place for the Metaverse & our very own NFT Marketplace, alongside our current Bonuses, Jackpots, and Tournaments!'),
(39, 'SHOCK&BURN', 'nfts/eGtQMagPh8Gp76QAt2c8957omdccWc-metaU0hPQ0smQlVSTi5qcGVn-.jpg', 'KGR9SL', '2024-02-08 11:15:27', '2024-02-08 11:15:27', 'Polygon', NULL, 'available', 70.6205, ' Introducing our stunning SHOCK&BURN collection, a mesmerizing and otherworldly set of digital works that capture the ethereal beauty of these amazing creatures. From their translucent tentacles to their shimmering colors, these jellyfish are truly a natural wonder.\n\nBut this collection is more than just a tribute to the beauty of the ocean. We are proud to announce that a portion of the proceeds from the sale of this NFT collection will be donated to environmental foundations dedicated to preserving our oceans and marine life. In addition, a portion of the proceeds will be used to fund and support emerging startups developing new technologies and strategies to clean up the oceans.\n\nSo by purchasing one of these unique and fascinating NFTs, you will not only add a stunning work of art to your collection, but also contribute to the important work of protecting our planet\'s oceans for future generations.'),
(40, 'cryptokhat', 'nfts/KLWf7iK5QttInG4dwdi1AUtJAI6jIo-metaY3J5cHRva2hhdC5qcGVn-.jpg', 'F7PIG4', '2024-02-08 11:24:09', '2024-02-08 11:24:09', 'Polygon', NULL, 'available', 0.5997, 'Cryptokhat is a collection of 10,000 unique NFTs of Arabic calligraphy art inspired by the Quran. The community of Cryptokhat believes in using art to remind, understand and spread love of the Quran\'s meaning and purpose to everyone.'),
(41, 'Orbiter Ace-Pilot NFT', 'nfts/0agOh9qpns7QVTJ7uXHn4vCAttppPH-metaT3JiaXRlciBBY2UtUGlsb3QgTkZULnBuZw==-.png', NULL, '2024-02-08 11:30:52', '2024-02-08 11:30:52', 'Polygon', NULL, 'available', 0.1521, ' No Description.'),
(42, 'Oval3', 'nfts/CBxhsJxGusnqFoaaWgNfRJupM5vnI4-metaT3ZhbDMucG5n-.png', 'FOSMEG', '2024-02-08 11:40:36', '2024-02-08 11:40:36', 'Polygon', NULL, 'available', 0.0007, 'OVAL3 is the first Rugby Web3 game licensed by Ligue Nationale de Rugby.Win, play and collect official NFT player cards and use them in the most immersive fantasy rugby experience.'),
(43, 'Midnight Society Founders Access Pass', 'nfts/O4wNq5DrKcrLpiicsNGgo3vUvZpNtH-metaTWlkbmlnaHQgU29jaWV0eSBGb3VuZGVycyBBY2Nlc3MgUGFzcy5qcGVn-.jpg', '9S03B2', '2024-02-08 11:43:11', '2024-02-08 11:43:11', 'Polygon', NULL, 'available', 0.1791, 'This limited series of Midnight Society Access Passes grants the holder studio-specific perks including but not limited to: a one-of-a-kind \"Variant\" PFP (profile pic) with unique VisorCortex, Call Sign, and other attributes of various rarity. Founders are entitled to voting rights on game features, exclusive access to studio events, first dibs on merchandise, early access to the latest dev build, and more.'),
(44, 'EGGRYPTO Monsters', 'nfts/DbL2JuI2pvRg6rqpaRfhkfB6MPAe6x-metaRUdHUllQVE8gTW9uc3RlcnMucG5n-.png', '274UPW', '2024-02-08 11:44:52', '2024-02-08 11:44:52', 'Polygon', NULL, 'available', 0.0291, 'EGGRYPTO is a casual blockchain game using #NFT and a public decentralized network for securing virtual gaming items and monsters.'),
(45, ' Smart Cats', 'nfts/4BzEUZkwJD6Ht6tqOGmlZjHdA4qQcU-metaU21hcnQgQ2F0cy5qcGVn-.jpg', '01UTMQ', '2024-02-08 11:54:20', '2024-02-08 11:54:20', 'Polygon', NULL, 'available', 0.1589, ' Smart Cats are a TokenScript wrapped, fully on-chain derivative NFT that lives on the Polygon network. It connects on-chain rights with web2 rewards and functionality. Only available to Smart Layer pass holders. Get smart, get yours today.'),
(46, 'Frog Polygon', 'nfts/xZ2HHmgKGtaIZbumNx6BrTS3aN8sNw-metaRnJvZyBQb2x5Z29uLnBuZw==-.png', 'UL9SP3', '2024-02-08 12:00:15', '2024-02-08 12:00:15', 'Polygon', NULL, 'available', 0.7522, '#Total:2888 🔥Hold more than 15 Frog Polygon, you can share 1 USDT every day.*Hold more than 150 Frog Polygon, you can share 50 USDT every day.✅If you hold 10 Frog Polygon with a number containing \'8’, you can share 10 USDT every day. # The number of Frog Polygon releases is limited, with a total of 2888. Each Frog Polygon has a unique number and metadata. Based on Solana chain technology, Frog Polygon adopts ERC-721 standard, which means that each Frog Polygon is unique and irreplaceable. The issuance and trading of Frog Polygon are achieved through smart contracts, ensuring the security and transparency of transactions.'),
(47, 'Hazuko', 'nfts/5V4KuvWIsGNtUT7Gp5ns70Shvvi5Vr-metaSGF6dWtvLnBuZw==-.png', 'I50ARW', '2024-02-08 12:04:01', '2024-02-08 12:04:01', 'Polygon', NULL, 'available', 0.1589, 'Hazuko starts in polygon chain a character that I made as a Harajuku style character, which I presented in the form of an NFT item. hope you like it'),
(48, 'LinksDAO', 'nfts/msZv3hUq8OKKDeWQKiYE8Wu89Aeddr-metaTGlua3NEQU8uanBlZw==-.jpg', 'UTOX3I', '2024-02-08 12:09:06', '2024-02-08 12:09:06', 'Ethereum', NULL, 'available', 0.0765, ' LinksDAO is creating the modern golf & leisure club. A global community of thousands of enthusiasts has come together to create one of the world\'s greatest golf clubs - and reimagine the country club.\n\nLinksDAO NFTs are the key to unlocking membership at LinksDAO\'s first golf course, Spey Bay, and also allow for community access, governance, a wide variety of perks, and games.'),
(49, 'Pixel Vault Founder\'s DAO', 'nfts/Hbm9utgMkPSh1fIrB7QxeAfblrUl4S-metaUGl4ZWwgVmF1bHQgRm91bmRlcidzIERBTy5qcGVn-.jpg', 'EOX34F', '2024-02-08 12:22:25', '2024-02-08 12:22:25', 'Ethereum', NULL, 'available', 0.2251, ' Incubated by Pixel Vault, the Founder\'s DAO is a collective of distributed members represented by Founder\'s DAO tokens. The Founder’s DAO empowers community-driven investment, with a focus on discovering new opportunities while advancing the vision of Pixel Vault. The Founder’s DAO prioritizes transparency, accountability, and integrity in all it does. The Founder’s DAO, fully governed by its members, has the flexibility to operate in a decentralized and autonomous manner, and can engage in various business transactions from time to time as long as it conforms to the DAO’s mission and constitution.'),
(50, 'HeadDAO', 'nfts/4huzmX3nr2lrVwMKaNkHklLsH6NPXz-metaSGVhZERBTy5qcGVn-.jpg', 'S9EAFG', '2024-02-08 12:24:21', '2024-02-08 12:24:21', 'Ethereum', NULL, 'available', 0.0089, '10,000 nouns needing head on the Ethereum blockchain. Each Head grants access to the exclusive DAO community and voting rights over the DAO\'s assets. Currently, the owners statistic shown by OpenSea is inaccurate for this collection. The real number is nearly 5k. \n'),
(51, 'Monkey Bet DAO', 'nfts/3dy7ICIjzDPEMcMJxAXxJrzbUlRVfY-metaTW9ua2V5IGJldCBEQU8uanBlZw==-.jpg', 'LAE1IM', '2024-02-08 12:26:16', '2024-02-08 12:26:16', 'Ethereum', NULL, 'available', 0.0067, 'Decentralized gaming x NFT protocol. Created by Invariant Labs.'),
(52, 'Halos by N3ON', 'nfts/vcEVsnfkmkNUZlgS7a1RUAtHkRMf3m-metaSGFsb3MgYnkgTjNPTi5wbmc=-.png', 'KYJTL1', '2024-02-08 12:29:13', '2024-02-08 12:29:13', 'Ethereum', NULL, 'available', 0.0335, 'Introducing “Halos by N3ON” – an exquisite NFT collection where art meets vibrancy! Immerse yourself in a kaleidoscope of colors with our unique, limited edition halos. Each NFT is a masterpiece, a fusion of artistic brilliance and a spectrum of hues, making your digital collection truly stand out.'),
(53, 'Urban Punk Official', 'nfts/CDo4Zq1BKVWplF7zJwxrlH0v7OrCDZ-metaVXJiYW4gUHVuay53ZWJw-.webp', '8W7BS9', '2024-02-08 12:33:01', '2024-02-08 12:33:01', 'Ethereum', NULL, 'available', 0.0022, 'Urban Punk is an NFT collection on the Ethereum blockchain consisting of 10,000 collectible Urban Punks with commercial rights. Yes they are late and gate crashed the party.'),
(54, 'Terraforms by Mathcastles', 'nfts/Pf5Qiq6adwClkpLC5HumybPR5vO0I5-metaVGVycmFmb3JtcyBieSBNYXRoY2FzdGxlcy5qcGc=-.jpg', 'QG9JKR', '2024-02-08 12:38:13', '2024-02-08 12:38:13', 'Ethereum', NULL, 'available', 0.5101, 'Onchain land art from a dynamically generated onchain 3D world.'),
(55, ': Winds of Yawanawa by Yawanawa and Refik Anadol', 'nfts/u5ftUszTMz5PcUfduHgV0zc68UjZGx-metaV2luZHMgb2YgWWF3YW5hd2EgYnkgWWF3YW5hd2EgYW5kIFJlZmlrIEFuYWRvbC5qcGVn-.jpg', 'RFDW1N', '2024-02-08 12:47:55', '2024-02-08 12:47:55', 'Ethereum', NULL, 'available', 6.8001, ' A first-of-its-kind space of co-creation between the Brazilian Indigenous Yawanawa community and media artist Refik Anadol.Launching this historical collaboration, the Yawanawa community and Refik Anadol Studio have co-authored the Genesis collection \'Winds of Yawanawa\'. The collection of 1000 unique Data Paintings brings the nuances of Yawanawa art to the digital world with the aim of preserving the community’s rich culture.First and only official collaborative wallet of Refik Anadol, with Instituto Nixiwaka; representing the Yawanawa communities of Aldeia Sagrada and Nova Esperança.'),
(56, 'Pudgy Rods', 'nfts/ywS4BBJIwfsVFdPTkLXwbDNjllLbrC-metaUHVkZ3kgUm9kcy5wbmc=-.png', 'IX9D0O', '2024-02-08 12:49:32', '2024-02-08 12:49:32', 'Ethereum', NULL, 'available', 0.5286, 'It\'s rog season baby 🎣. What will you catch?'),
(57, 'The Memes by 6529', 'nfts/oX4HdN143lU2F6Dk9pbeosA5eReVAy-metaVGhlIE1lbWVzIGJ5IDY1MjkucG5n-.png', '2YR40L', '2024-02-08 12:55:30', '2024-02-08 12:55:30', 'Ethereum', NULL, 'available', 0.0259, ' The Memes Collection is focused on the fight for the open metaverse (decentralization, community, self-sovereignty) and spreading this message to many people, many wallets.It is a collection that is meant to be open and accessible. Edition sizes will generally be large and inexpensive, to spread the word and to avoid gas wars.We will try to have a good time along the way, make some fun art, do great collabs and just generally have a good time.'),
(58, 'alignDRAW', 'nfts/SjGgwU0B2CN0DxKZdjMfk1b7rIgtf4-metaYWxpZ25EUkFXLnBuZw==-.png', 'E495Q2', '2024-02-08 12:57:48', '2024-02-08 12:57:48', 'Ethereum', NULL, 'available', 0.1850, 'By early 2015, neural networks had mastered the art of \'image-to-text\' and could create natural language captions for images. Flipping this process, and turning text into image, was a much more complex challenge solved by 19-year old prodigy Elman Mansimov\'s alignDRAW model.Fellowship is pleased to present a special release of fully on-chain* NFTs of this historical artwork, containing all the original 32x32 pixel images created in 2015.“These images represent the birth of text prompt AI generated imagery.” - Darius Himes, Christie’s“alignDRAW images can be compared to the first fixed photographs taken by Niépce in 1826-1827.” - Dr Lev Manovich*We created an architecture that allows for the progressive on-chain storage of data and images, strategically addressing the challenge of high gas costs at launch through a phased roll-out that capitalizes on periods of lower gas prices.'),
(59, 'Rare Pepe (2016 - 2018)', 'nfts/ONVZHn4u0LkOFTyWEqojvzwjCbPRsv-metaUmFyZSBQZXBlICgyMDE2IC0gMjAxOCkuZ2lm-.gif', 'R8TZN5', '2024-02-08 13:00:23', '2024-02-08 13:00:23', 'Ethereum', NULL, 'available', 0.0152, 'Rare Pepes is a historic NFT collection of 1,774 unique cards with varying designs and rarities that were minted from 2016 to 2018. The collection was created using the Counterparty protocol on the Bitcoin blockchain and is the first decentralized community art project in the history of NFTs. More than 300 artists submitted cards that were approved by the Rare Pepe Scientists, who curated the completion of 36 series of 50 cards each (Series 36 ended with 24 cards). Emblem Vault offers cross-chain NFT solutions and powers this collection.'),
(60, 'THE 108 CIRCLE', 'nfts/IWaw6eENCK6lH9RK3bLwBpipK7e6Z8-metaVEhFIDEwOCBDSVJDTEUucG5n-.png', 'I6SGON', '2024-02-08 13:02:28', '2024-02-08 13:02:28', 'Ethereum', NULL, 'available', 0.1966, 'Energy is everything and everything is energy.. What energy are you holding today? The most auspicious and powerful number of all.. signifying completion and clearing space for new miracles to manifest into your life. 3 orbs of divine energies begin at THE CORE with GENESIS 108 tokens and completes on THE COLLECTIVE 10,008 tokens.\nToken holders will have lifetime membership to The 108 Circle with Himalayan Yogi Master Sri Akarshana. \n\nThis includes monthly calls, spiritual guidance and energy forecasts to expand your consciousness, raise your vibrations and keep you aligned with your manifestations. All owners will also receive early access to all future 108 drops to give more opportunities to manifest opportunities, wealth and abundance.'),
(61, 'Quatre', 'nfts/m2RGtzotJGwupzyydyq1D6mHDc3tVe-metaUXVhdHJlLnBuZw==-.png', '4RK725', '2024-02-08 13:04:04', '2024-02-08 13:04:04', 'Ethereum', NULL, 'available', 0.0388, 'Quatre is a generative collection comprised of hundreds of my individual illustrations randomly placed into different configurations (single panels and grids) with various color palettes, rotations and overlays.This project is an extension of my abstract collection, Carrés.'),
(62, 'LOSTPOETS', 'nfts/kvVnnzxCnKdunqIFnSnJZ9q4TNMRe6-metaTE9TVFBPRVRTLnBuZw==-.png', '0MLBKS', '2024-02-08 13:06:09', '2024-02-08 13:06:09', 'Ethereum', NULL, 'available', 0.0120, ' AB AETERNO'),
(63, 'COACHK - CLUB', 'nfts/epaUULrQ0b5Iy0bf5aWhxcmUzmUVi9-metaQ09BQ0hLIC0gQ0xVQi5qcGVn-.jpg', 'W826V7', '2024-02-08 13:08:05', '2024-02-08 13:08:05', 'Ethereum', NULL, 'available', 2.3001, 'Offering the most valuable services of all Crypto Communities. With our extensive Knowledge, Network and Experience we are able to offer you Insights you won\'t find anywhere else. Our goal is to to motivate, support and inspire you to make life-changing returns.'),
(64, 'Sprotoladys', 'nfts/V7c8cNbtMWUxLexOYqiWybYoqvrU8e-metaU3Byb3RvbGFkeXMucG5n-.png', 'BOFHC1', '2024-02-08 13:09:37', '2024-02-08 13:09:37', 'Ethereum', NULL, 'available', 0.0279, ' Sprotoladys are 4,444 companions emerged from the collision of Remilia and the egregore 🎒🌸 🟥🟨🟦.'),
(65, 'Everdome Genesis Collection', 'nfts/J06DHzfLgWiryRZzalmsl0kpram2nr-metaRXZlcmRvbWUgR2VuZXNpcyBDb2xsZWN0aW9uLmpwZWc=-.jpg', '3LWTD4', '2024-02-08 13:17:10', '2024-02-08 13:17:10', 'Ethereum', NULL, 'available', 0.0628, 'The Everdome Genesis NFT collection is here!Our Genesis collection will be at the core of association with Everdome, early access rights, and long term opportunities - unlocking massive rewards for those taking full advantage of our collection.Everdome is creating the most hyper-realistic #metaverse that will bring brands and people together - all with the purpose of building the most realistic web3 experience.Through the creation and facilitation of NFTs, land sales, marketplaces, and the highest quality avatars on the market, Everdome will define life in the virtual world, providing a place for brands and individuals to interact in the highest possible quality.Everdome\'s Genesis NFT collection will offer its holders a wide array of benefits both in the short and long term. Most notably holders of an Everdome Genesis NFT will hold a \'golden ticket\', acting as a right of early access to Everdome\'s launch facility & Space Port.'),
(66, 'JUUNI Grimoire', 'nfts/4XTXSXwKDskRBq0MzWa6ELSAaOzNGU-metaSlVVTkkgR3JpbW9pcmUuZ2lm-.gif', 'SE8TNG', '2024-02-08 13:26:26', '2024-02-08 13:26:26', 'Ethereum', NULL, 'available', 0.0099, 'Time to enter our world. Start a new experience.JUUNI is a Zodiac-inspired, hand-crafted collection of 4,670 characters by artist HEX.Grimoires are magical spell books that are part of the lore of JUUNI. You can choose to open Grimoires to reveal characters called Zodias, designed to bring forth a timeless collection of digital collectibles.'),
(67, 'Yogurt Verse', 'nfts/EwDbzsAzko02RPtciH2vX5XUSBsX1V-metaWW9ndXJ0IFZlcnNlLnBuZw==-.png', 'A2W3EM', '2024-02-08 13:29:27', '2024-02-08 13:29:27', 'Ethereum', NULL, 'available', 0.0901, 'Welcome to YogurtVerse.'),
(68, 'SchizoPosters', 'nfts/f7K8lcBHEebRMNOTX0BGTAwxUeFgKm-metaU2NoaXpvUG9zdGVycy5wbmc=-.png', '8HR3V2', '2024-02-08 13:32:59', '2024-02-08 13:32:59', 'Ethereum', NULL, 'available', 0.1001, ' I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE ANTICHRIST I HATE THE\n'),
(69, 'Banners NFT', 'nfts/mrNYG9c4MrIUCe4VgO03nLVCHVD7tB-metaQmFubmVycyBORlQucG5n-.png', 'EV6GL2', '2024-02-08 13:39:57', '2024-02-08 13:39:57', 'Ethereum', NULL, 'available', 0.1723, 'Banners is a generative NFT collection exploring a hypercitation of early 00\'s digital aesthetics with content organically sourced from performative posts made within the Milady Maker community.\n'),
(70, 'Impostors Genesis Pets', 'nfts/6kak3rTKK6YrL5wU5AWiA3BdBJ2s0K-metaSW1wb3N0b3JzIEdlbmVzaXMgUGV0cy5qcGVn-.jpg', '913QKD', '2024-02-08 13:42:48', '2024-02-08 13:42:48', 'Ethereum', NULL, 'available', 0.0909, 'Pets are a core component of the Impostors ecosystem and a required asset for Genesis Land. Pets have their own roadmap that will transpire in phases throughout the Impostors Genesis Season. Pet passes will give holders access to redeem their 3D generative Pets that will be used in the upcoming Impostors Metaverse pvp battle game mode.'),
(71, 'Khalifa Maker', 'nfts/3RWlbjQYCyzoX7ZQNyjMjVPuL7fyk4-metaS2hhbGlmYSBNYWtlci5wbmc=-.png', '627TXJ', '2024-02-08 13:47:28', '2024-02-08 13:47:28', '0.0190', NULL, 'available', 0.0190, 'Khalifa Maker is a collection of 666 generative neochibi aesthetic pfpNFT’s. Expansion on the Milady Maker incel #KHALIFAMAKER'),
(72, ' Angry Ape Army', 'nfts/Lk46D32fAQD60SCKEnl2bSjA4eoKRO-metaQW5ncnkgQXBlIEFybXkucG5n-.png', 'L87WSF', '2024-02-08 13:53:25', '2024-02-08 13:53:25', 'Ethereum', NULL, 'available', 0.0399, 'Join the 3333 Angry Apes living in the metaverse. 3333 original apes will be released in wave one. Breed, evolve, and upgrade your apes with an OG ape. Come play, mine, and earn rewards on Monkey Island. AAA holders will have access to exclusive events and limited seats in Monkey Island.'),
(73, 'The Saudis', 'nfts/oaGEAX0S84WlbxkntoQZAoZ5dliIH7-metaVGhlIFNhdWRpcy5qcGc=-.jpg', 'PFLA5B', '2024-02-08 13:56:17', '2024-02-08 13:56:17', 'Ethereum', NULL, 'available', 0.0509, '🇸🇦 5,555 Saudis are here to save your bags Alhamdulillah. #MAXBIDDING🎟 Each Saudi is your entry ticket into our great Kingdom.🏰 Join the Kingdom — the strongest community in crypto — and relish in all it has to offer.'),
(74, 'Muslim', 'nfts/JTDbAbrG3WxeK51kYnxuHI01m7PgYT-metaTXVzbGltLmpwZw==-.jpg', '93OFXI', '2024-02-08 13:57:58', '2024-02-08 13:57:58', 'Ethereum', NULL, 'available', 0.0301, 'Muslim women on murales.'),
(75, 'Quran', 'nfts/wxv2hIE3xKtjNkaBQ9UDBM7W5MXNqi-metaUXVyYW4ucG5n-.png', 'TAIHWE', '2024-02-08 14:02:55', '2024-02-08 14:02:55', 'Ethereum', NULL, 'available', 0.0101, ' Depictions of Quran and its messages in delightful images.'),
(76, ' Muhammad Ali | The Next Legends - Gym Bags', 'nfts/SYoHgYqaeAEwWoFp3EQQTuCqU8d0cE-metaTXVoYW1tYWQgQWxpIF8gVGhlIE5leHQgTGVnZW5kcyAtIEd5bSBCYWdzLnBuZw==-.png', '1WZY0K', '2024-02-08 14:07:42', '2024-02-08 14:07:42', 'Ethereum', NULL, 'available', 0.0140, 'Muhammad Ali — The Next Legends immerses you in the sport and culture of boxing as a coach and manager of your own artificially intelligent boxer. Your strategic choices both in-gym and ringside will determine whether your one-of-a-kind fighter becomes the next legend of the open metaverse.Each Gym Bag features an item from a limited-edition clothing set inspired by one of three eras of Muhammad Ali’s life. These rare items will give your Pro Boxer a special in-game boost, unlike common clothing items. Gym Bags also include other cosmetics and further in-game benefits. The Next Legends is brought to you by Altered State Machine in partnership with Non-Fungible Labs and ABG, IP rights holders of the Muhammad Ali Estate.'),
(77, 'The Greatest: Muhammad Ali x Zeblocks Mint Pass', 'nfts/pDNaEO5Oq8VlxsryNw7xRQoSnu2171-metaVGhlIEdyZWF0ZXN0XyBNdWhhbW1hZCBBbGkgeCBaZWJsb2NrcyBNaW50IFBhc3MucG5n-.png', 'VX2IHG', '2024-02-08 14:14:30', '2024-02-08 14:14:30', 'Ethereum', NULL, 'available', 0.0211, 'The mint pass for The Greatest: Muhammad Ali x Zeblocks, a generative art project.'),
(78, 'Aleph-0 by HACKATAO + Insigℏt', 'nfts/8pk4yeB600vUR21MfsAWDwK5LtZc76-metaQWxlcGgtMCBieSBIQUNLQVRBTyArIEluc2ln4oSPdC5qcGVn-.jpg', '03UYRA', '2024-02-08 14:16:21', '2024-02-08 14:16:21', 'Ethereum', NULL, 'available', 0.3005, ' Nil'),
(79, 'PUNKS Comic', 'nfts/Z1HpXC5u0GQn6iq9nflcZeLq5ZuEnm-metaUFVOS1MgQ29taWMucG5n-.png', '4MRF76', '2024-02-08 14:19:34', '2024-02-08 14:19:34', 'Ethereum', NULL, 'available', 0.0132, 'Meet the PUNKS! Everyone’s favorite misfit crew of collectors, rebels, and crypto degens from the metaverse. A project by Pixel Vault.'),
(80, ' FULL SEND METACARD NFT', 'nfts/VJMRw9LDVnl51XN1wRjcsy8pge87aG-metaRlVMTCBTRU5EIE1FVEFDQVJEIE5GVC5qcGVn-.jpg', 'DNC7L2', '2024-02-08 14:30:40', '2024-02-08 14:30:40', 'Ethereum', NULL, 'available', 0.2499, 'Built on the Ethereum Blockchain with a limited supply of 10,000 NFTs, the FULL SEND METACARD will give you access to the FULL SEND & NELK Empire.'),
(81, ' Creature World', 'nfts/vsMGKUxNXRkmoP4iGvQqpbJJPl8tI6-metaQ3JlYXR1cmUgV29ybGQuanBn-.jpg', '63BC4M', '2024-02-08 14:31:41', '2024-02-08 14:31:41', 'Ethereum', NULL, 'available', 0.0619, 'Creature World\'s self-titled collection of 10,000 unique digital artworks. Created with love by Danny Cole. www.creature.world Associated digital collections and gifts to Creature holders include Crowd, Traveling Creature Memories, Creature Playground, Danny’s Drawings, Creature Psychic, and Journey Artifacts.'),
(82, ' OCM Dessert', 'nfts/1zs7bfqU92LbynICcICDVxx6neyWCN-metaT0NNIERlc3NlcnQucG5n-.png', 'A7H1QM', '2024-02-08 14:32:57', '2024-02-08 14:32:57', 'Ethereum', NULL, 'available', 0.1421, 'Desserts can be eaten (burned) by OCM Genesis to create OCM Karma. Genesis and Karma are the historic collections of OnChain Monkey.'),
(83, 'Wonky Stonks', 'nfts/ehRVY4VvFreaMXjCDbmhTfTWVAfNuT-metaV29ua3kgU3RvbmtzLnBuZw==-.png', '2K9MP0', '2024-02-08 14:34:04', '2024-02-08 14:34:04', 'Ethereum', NULL, 'available', 0.0994, 'Wonky Stonks is the first of its kind; a fully generative, financially-inspired NFT collection for investors, traders, and quants alike.'),
(84, 'Beautiful Cities of the World', 'nfts/z4mYJURed0yxpLGBnoVc7imct94KA4-metaQmVhdXRpZnVsIENpdGllcyBvZiB0aGUgV29ybGQucG5n-.png', '7KDBO5', '2024-02-08 14:35:17', '2024-02-08 14:35:17', 'Ethereum', NULL, 'available', 0.1994, 'Trey Ratcliff is a Smithsonian featured fine artist who has sold millions in physical artwork to collectors including knights, sports heroes, and celebrities like Edward Norton and Leonardo DiCaprio. This collection comprises a selection of 50 images (some animated) from some of the greatest cities across the globe.'),
(85, 'Steamboat Willie Public Domain 2024', 'nfts/QuG9YeUZ5KCQ8Ag3xoYaV2u9dEfUiC-metaU3RlYW1ib2F0IFdpbGxpZSBQdWJsaWMgRG9tYWluIDIwMjQucG5n-.png', 'INQ3AB', '2024-02-08 14:36:37', '2024-02-08 14:36:37', 'Ethereum', NULL, 'available', 0.0749, 'Nil'),
(86, ' NFTFANS AI SHOP', 'nfts/U5rSA4Bk8agonw09fM0fCsTTEAHhZ6-metaTkZURkFOUyBBSSBTSE9QLnBuZw==-.png', '79R3PD', '2024-02-08 14:37:56', '2024-02-08 14:37:56', 'Polygon', NULL, 'available', 0.0991, 'Nil'),
(87, 'Nakamigos', 'nfts/W5Ppz94fk4Tel9dH2brfpGu7mQClls-metaTmFrYW1pZ29zLnBuZw==-.png', 'BK5MJC', '2024-02-08 14:38:49', '2024-02-08 14:38:49', 'Ethereum', NULL, 'available', 0.1800, '20,000 unique crypto investors on the blockchain with commercial rights. '),
(88, 'Otherdeed Expanded', 'nfts/gyNTnJtkm9lLLBc05jwLwELtnQ2CNv-metaT3RoZXJkZWVkIEV4cGFuZGVkLnBuZw==-.png', '5ZJ7MU', '2024-02-08 14:46:47', '2024-02-08 14:46:47', 'Ethereum', NULL, 'available', 0.3071, ' These evolved Otherdeeds enable holders to play future games in the Yuga Labs universe. Each possesses its own unique blend of environment and sediment. Some contain resources, and some are home to powerful artifacts.'),
(89, 'RENGA', 'nfts/GXAuJHnNJDXj7F8Q03MZy3af0F6f8B-metaUkVOR0EucG5n-.png', 'QIZWU0', '2024-02-08 14:47:49', '2024-02-08 14:47:49', 'Ethereum', NULL, 'available', 0.1894, 'A handcrafted collection of 10,000 characters developed by artist DirtyRobot. Each with their own identity to be discovered within the wider stories within RENGA. In its purest form, RENGA is the art of storytelling.'),
(90, 'The warmth of peace', 'nfts/Bpq2VS4UETqUUkOPWUDA4ZSUGFcs1b-metaVGhlIHdhcm10aCBvZiBwZWFjZS5wbmc=-.png', 'GVFCXE', '2024-02-08 14:49:12', '2024-02-08 14:49:12', 'Polygon', NULL, 'available', 0.0078, 'A stickerish collection,\nfull of sweetness and hot drinks.'),
(91, 'The Legandry Apes', 'nfts/cdFFJIZ6WgcUHPwLA7VLbP2aCPg3c6-metaVGhlIExlZ2FuZHJ5IEFwZXMuanBn-.jpg', 'W96KHX', '2024-02-08 14:50:29', '2024-02-08 14:50:29', 'Polygon', NULL, 'available', 0.0614, 'Consisting of 2222 pixel apes, each one is 1/1 special and unique. It is completely handmade and each accessory is more legendary than the other. Inspired by the most popular collections of NFTs, but our difference is our pixel quality.'),
(92, 'Bored Punks Snowboard Club', 'nfts/T2Nwh5CMn7EEhX6laKxoudc1zb9T2A-metaQm9yZWQgUHVua3MgU25vd2JvYXJkIENsdWIuanBlZw==-.jpg', 'KDAL70', '2024-02-08 14:51:59', '2024-02-08 14:51:59', 'Polygon', NULL, 'available', 0.2500, '9999 NFT. Minting Live 0.1 Matic Bored Punks Snowboard Club face left, because the other way just doesn\'t feel right. Not affiliated with Yuga Labs.'),
(93, ' Oozaru Ape', 'nfts/CszQnnXNiRP54G4h0YD33ezGGVZkKl-metaT296YXJ1IEFwZS5wbmc=-.png', 'UGKFV4', '2024-02-08 14:53:15', '2024-02-08 14:53:15', 'Polygon', NULL, 'available', 0.1234, 'Mint Live 10k Oozaru Ape.');

-- --------------------------------------------------------

--
-- Table structure for table `nft_swap_orders`
--

CREATE TABLE `nft_swap_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `nft_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `wallet_address` varchar(255) DEFAULT NULL,
  `payable_amount` decimal(15,4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nft_swap_orders`
--

INSERT INTO `nft_swap_orders` (`id`, `user_id`, `order_id`, `nft_id`, `status`, `wallet_address`, `payable_amount`, `created_at`, `updated_at`) VALUES
(25, 79, '6SS6E2M92d9xx5EO', 89, 'pending', NULL, 0.1897, '2024-09-30 11:29:57', '2024-09-30 11:29:57'),
(26, 79, 'i20b4HIJV8h6240e', 7, 'completed', NULL, 92.0831, '2024-10-03 12:18:45', '2024-10-03 12:24:59'),
(27, 82, '7A7K24H2E43J4202', 14, 'completed', NULL, 13.9425, '2024-10-03 12:43:32', '2024-10-03 12:44:59'),
(28, 82, '2h5kksU0429Ul242', 22, 'pending', NULL, 0.5603, '2024-10-03 12:54:41', '2024-10-03 12:54:41');

-- --------------------------------------------------------

--
-- Table structure for table `nft_swap_sessions`
--

CREATE TABLE `nft_swap_sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `restart_timer` varchar(255) NOT NULL,
  `number_of_response_left` int(11) NOT NULL,
  `total_responses` int(11) NOT NULL,
  `arbitrageable_nft` int(11) DEFAULT NULL,
  `error_json_chance` int(11) DEFAULT NULL,
  `error_data_chance` int(11) DEFAULT NULL,
  `unresponsive_chance` int(11) DEFAULT NULL,
  `responsive_chance` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nft_clicks_left` int(11) DEFAULT 0,
  `nft_profit_display_chance` int(11) DEFAULT 0,
  `nft_error_display_chance` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nft_swap_sessions`
--

INSERT INTO `nft_swap_sessions` (`id`, `user_id`, `restart_timer`, `number_of_response_left`, `total_responses`, `arbitrageable_nft`, `error_json_chance`, `error_data_chance`, `unresponsive_chance`, `responsive_chance`, `created_at`, `updated_at`, `nft_clicks_left`, `nft_profit_display_chance`, `nft_error_display_chance`) VALUES
(11, '79', '1728043898', 1, 7, 4, NULL, NULL, 0, 1, '2024-09-30 11:26:06', '2024-10-03 12:46:27', 7, 5, 1),
(12, '82', '1728045055', 1, 8, 2, NULL, NULL, 0, 1, '2024-10-03 12:30:55', '2024-10-03 12:53:58', 7, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `referral_earnings_requests`
--

CREATE TABLE `referral_earnings_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(100) DEFAULT 'pending',
  `usdt_address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `session_data` text NOT NULL,
  `timeout` varchar(255) DEFAULT NULL,
  `active_status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `session_data`, `timeout`, `active_status`, `created_at`, `updated_at`) VALUES
(71, '1061965251', '{\"step_name\":\"\",\"answered_questions\":[],\"active_command\":\"yes\",\"form_counter\":0,\"step\":\"check pair arbitrage\",\"active_status\":\"no\",\"session_data\":[]}', '1728279574', 'yes', '2024-09-28 21:22:07', '2024-10-07 04:39:34'),
(72, '7203076621', '{\"step_name\":\"\",\"answered_questions\":[],\"active_command\":\"yes\",\"form_counter\":0,\"step\":\"confirm swap\",\"from_asset\":\"busd\",\"to_asset\":\"usdt\",\"amount\":\"200\",\"amount_to_receive\":199.14000000000001,\"active_status\":\"no\",\"session_data\":[]}', '1727713281', 'yes', '2024-09-29 04:18:35', '2024-09-30 15:21:21'),
(73, '1324611645', '{\"step_name\":\"\",\"answered_questions\":[],\"active_command\":\"yes\",\"form_counter\":0,\"step\":\"check pair arbitrage\",\"active_status\":\"no\",\"session_data\":[]}', '1728242851', 'yes', '2024-09-30 11:37:47', '2024-10-06 18:27:31'),
(74, '6440807526', '{\"step_name\":\"LicenseService\",\"answered_questions\":[],\"active_command\":\"yes\",\"form_counter\":0,\"step\":\"store email\"}', '1728161683', 'yes', '2024-10-05 19:54:29', '2024-10-05 19:54:43');

-- --------------------------------------------------------

--
-- Table structure for table `swap_orders`
--

CREATE TABLE `swap_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `from_asset` varchar(255) NOT NULL,
  `to_asset` varchar(255) NOT NULL,
  `amount` decimal(15,4) NOT NULL,
  `amount_to_receive` decimal(15,4) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `swap_orders`
--

INSERT INTO `swap_orders` (`id`, `order_id`, `user_id`, `from_asset`, `to_asset`, `amount`, `amount_to_receive`, `status`, `created_at`, `updated_at`) VALUES
(38, 'z5c3Y8I5174S6G8k', 80, 'dai', 'busd', 500.0000, 526.4500, 'completed', '2024-09-30 11:46:58', '2024-09-30 14:31:56'),
(39, 'Cf6Zp972U5p2s2Q6', 79, 'usdt', 'dai', 500.0000, 484.4500, 'completed', '2024-09-30 14:33:35', '2024-09-30 14:34:02'),
(40, '7SLn1520Tm7f5U5e', 79, 'dai', 'usdt', 200.0000, 207.3400, 'completed', '2024-10-02 08:48:34', '2024-10-02 08:51:29'),
(41, '4lRA560Vu02yQk25', 82, 'dai', 'usdt', 50.0000, 51.6050, 'completed', '2024-10-02 12:05:10', '2024-10-02 14:12:05'),
(42, 'SH9h7tRr9fB03w90', 82, 'dai', 'usdt', 50.0000, 52.0850, 'completed', '2024-10-02 14:24:20', '2024-10-02 14:47:01'),
(43, '7e0V641pwzlOf21Z', 82, 'usdt', 'dai', 100.0000, 96.5100, 'completed', '2024-10-02 15:03:52', '2024-10-02 15:04:41'),
(44, 'AE38JHdyLMzyKo56', 79, 'dai', 'usdt', 600.0000, 620.5800, 'completed', '2024-10-03 12:00:07', '2024-10-03 12:04:39'),
(45, 'qvu6u4g7O7G711k2', 79, 'usdt', 'dai', 50.0000, 47.9300, 'cancelled', '2024-10-03 14:44:51', '2024-10-03 16:46:16'),
(46, '1253uXKf0LS365z7', 79, 'usdt', 'dai', 51.0000, 48.8886, 'completed', '2024-10-03 14:59:38', '2024-10-03 15:00:02'),
(47, 'y1uFoZ4920I2AI56', 79, 'usdt', 'busd', 67.0000, 67.0536, 'cancelled', '2024-10-04 08:17:54', '2024-10-04 10:18:17');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_logs`
--

CREATE TABLE `transaction_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `from_asset` varchar(255) NOT NULL,
  `to_asset` varchar(255) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `received_amount` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_logs`
--

INSERT INTO `transaction_logs` (`id`, `user_id`, `from_asset`, `to_asset`, `amount`, `received_amount`, `created_at`, `updated_at`) VALUES
(11, 80, 'dai', 'busd', 500.00, 526.45, '2024-09-30 14:31:56', '2024-09-30 14:31:56'),
(12, 79, 'usdt', 'dai', 500.00, 484.45, '2024-09-30 14:34:02', '2024-09-30 14:34:02'),
(13, 79, 'dai', 'usdt', 200.00, 207.34, '2024-10-02 08:51:29', '2024-10-02 08:51:29'),
(14, 82, 'dai', 'usdt', 50.00, 51.61, '2024-10-02 14:12:05', '2024-10-02 14:12:05'),
(15, 82, 'dai', 'usdt', 50.00, 52.09, '2024-10-02 14:27:26', '2024-10-02 14:27:26'),
(16, 82, 'dai', 'usdt', 50.00, 52.09, '2024-10-02 14:31:17', '2024-10-02 14:31:17'),
(17, 82, 'dai', 'usdt', 50.00, 52.09, '2024-10-02 14:47:01', '2024-10-02 14:47:01'),
(18, 82, 'usdt', 'dai', 100.00, 96.51, '2024-10-02 15:04:41', '2024-10-02 15:04:41'),
(19, 79, 'dai', 'usdt', 600.00, 620.58, '2024-10-03 12:04:39', '2024-10-03 12:04:39'),
(20, 79, 'usdt', 'dai', 51.00, 48.89, '2024-10-03 15:00:03', '2024-10-03 15:00:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tg_id` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `license` varchar(10) DEFAULT 'pending',
  `academy_access` varchar(11) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `referral_code` varchar(255) DEFAULT NULL,
  `referrer_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `tg_id`, `email`, `name`, `password`, `license`, `academy_access`, `created_at`, `updated_at`, `referral_code`, `referrer_id`) VALUES
(79, '1061965251', 'Dr.mikhaeldavid@gmail.com', NULL, NULL, 'active', 'pending', '2024-09-28 21:22:07', '2024-10-03 14:57:22', 'cBgv6PJXEb', NULL),
(80, '7203076621', 'Dr.mikhaeldavidpt@gmail.com', NULL, NULL, 'active', 'pending', '2024-09-29 04:18:35', '2024-09-30 11:35:19', 'BluTt4JgcG', NULL),
(81, NULL, 'korbitbotai@gmail.com', 'Korbit Admin', '$2y$10$K0aNLtEUsxd.sSXrZC8zf.hjl.xBo6e5ZeGgOKZSNUQyQkk.CULMu', 'pending', 'pending', '2023-11-14 02:20:28', '2023-11-14 02:20:28', NULL, NULL),
(82, '1324611645', 'whitemaxwell5@gmail.com', NULL, NULL, 'active', 'pending', '2024-09-30 11:37:49', '2024-09-30 14:16:52', 'HBOBVTElmE', NULL),
(83, '6440807526', NULL, NULL, NULL, 'pending', 'pending', '2024-10-05 19:54:29', '2024-10-05 19:54:29', 'jUZzD5sV1C', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `balance_busd` decimal(16,4) NOT NULL DEFAULT 0.0000,
  `balance_dai` decimal(16,4) NOT NULL DEFAULT 0.0000,
  `balance_usdt` decimal(16,4) NOT NULL DEFAULT 0.0000,
  `referral_balance` double(16,4) DEFAULT 0.0000,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `user_id`, `balance_busd`, `balance_dai`, `balance_usdt`, `referral_balance`, `created_at`, `updated_at`) VALUES
(55, 79, 0.0000, 533.3386, 827.9200, 0.0000, '2024-09-28 21:22:07', '2024-10-03 15:00:03'),
(56, 80, 526.4500, 0.0000, 0.0000, 0.0000, '2024-09-29 04:18:35', '2024-09-30 14:31:56'),
(57, 82, 0.0000, 96.5100, 207.8600, 0.0000, '2024-09-30 11:37:49', '2024-10-02 15:04:41'),
(58, 83, 0.0000, 0.0000, 0.0000, 0.0000, '2024-10-05 19:54:29', '2024-10-05 19:54:29');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_orders`
--

CREATE TABLE `withdraw_orders` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `wallet` varchar(255) DEFAULT NULL,
  `amount` decimal(16,4) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdraw_orders`
--

INSERT INTO `withdraw_orders` (`id`, `user_id`, `currency`, `wallet`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(2, 79, 'dai', '0xf6812f6a744b5318e2490610c5d76e036c4a511a', 484.4500, 'pending', '2024-09-30 14:35:48', '2024-09-30 14:35:48'),
(3, 79, 'usdt', '0x686146470fe3eb4b3a669f77a3acf586c5ff8369', 207.3400, 'pending', '2024-10-02 08:51:48', '2024-10-02 08:51:48'),
(4, 82, 'usdt', '0x931dfdd0d9393c5a2b2c29257411b14df11e07fd', 51.6050, 'pending', '2024-10-02 14:14:19', '2024-10-02 14:14:19'),
(5, 82, 'usdt', '0x87f555abd3037574e0f0aee40ff929205990e7df', 52.0850, 'pending', '2024-10-02 14:27:58', '2024-10-02 14:27:58'),
(6, 82, 'usdt', '0x87f555abd3037574e0f0aee40ff929205990e7df', 52.0850, 'pending', '2024-10-02 14:27:59', '2024-10-02 14:27:59'),
(7, 82, 'usdt', '0x87f555abd3037574e0f0aee40ff929205990e7df', 52.0850, 'pending', '2024-10-02 14:28:01', '2024-10-02 14:28:01'),
(8, 82, 'usdt', '0x87f555abd3037574e0f0aee40ff929205990e7df', 52.0850, 'pending', '2024-10-02 14:28:05', '2024-10-02 14:28:05'),
(9, 82, 'usdt', '0x87f555abd3037574e0f0aee40ff929205990e7df', 52.0850, 'pending', '2024-10-02 14:28:13', '2024-10-02 14:28:13'),
(10, 82, 'usdt', '0x87f555abd3037574e0f0aee40ff929205990e7df', 52.0850, 'pending', '2024-10-02 14:28:30', '2024-10-02 14:28:30'),
(11, 82, 'usdt', '0x87f555abd3037574e0f0aee40ff929205990e7df', 52.0850, 'pending', '2024-10-02 14:29:03', '2024-10-02 14:29:03'),
(12, 82, 'usdt', '0x87f555abd3037574e0f0aee40ff929205990e7df', 52.0850, 'pending', '2024-10-02 14:30:08', '2024-10-02 14:30:08'),
(13, 82, 'usdt', '0x87f555abd3037574e0f0aee40ff929205990e7df', 52.0850, 'pending', '2024-10-02 14:31:20', '2024-10-02 14:31:20'),
(14, 82, 'usdt', '0x87f555abd3037574e0f0aee40ff929205990e7df', 52.0850, 'pending', '2024-10-02 14:32:50', '2024-10-02 14:32:50'),
(15, 82, 'usdt', '0x87f555abd3037574e0f0aee40ff929205990e7df', 52.0850, 'pending', '2024-10-02 14:33:58', '2024-10-02 14:33:58'),
(16, 82, 'usdt', '0x87f555abd3037574e0f0aee40ff929205990e7df', 52.0850, 'pending', '2024-10-02 14:35:23', '2024-10-02 14:35:23'),
(17, 82, 'usdt', '0x87f555abd3037574e0f0aee40ff929205990e7df', 52.0850, 'pending', '2024-10-02 14:37:19', '2024-10-02 14:37:19'),
(18, 82, 'usdt', '0x87f555abd3037574e0f0aee40ff929205990e7df', 52.0850, 'pending', '2024-10-02 14:38:37', '2024-10-02 14:38:37'),
(19, 82, 'usdt', '0x87f555abd3037574e0f0aee40ff929205990e7df', 52.0850, 'pending', '2024-10-02 14:39:45', '2024-10-02 14:39:45'),
(20, 82, 'usdt', '0x87f555abd3037574e0f0aee40ff929205990e7df', 52.0850, 'pending', '2024-10-02 14:41:11', '2024-10-02 14:41:11'),
(21, 82, 'usdt', '0x87f555abd3037574e0f0aee40ff929205990e7df', 52.0850, 'pending', '2024-10-02 14:47:19', '2024-10-02 14:47:19'),
(22, 82, 'dai', '0xf9f565e5599118e3c50d055b73fcc1e5788a70fd', 96.5100, 'pending', '2024-10-02 15:05:15', '2024-10-02 15:05:15'),
(23, 79, 'usdt', '0x2577ca36a719c718356d887989c4bbbd8c7890ec', 620.5800, 'pending', '2024-10-03 12:06:54', '2024-10-03 12:06:54'),
(24, 79, 'dai', '0xbbc6bf34d76783eb6d69231783db6015fcc55de2', 48.8886, 'pending', '2024-10-03 15:00:12', '2024-10-03 15:00:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academy_orders`
--
ALTER TABLE `academy_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arbitrage_sessions`
--
ALTER TABLE `arbitrage_sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency_rates`
--
ALTER TABLE `currency_rates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `currency` (`currency`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `license_orders`
--
ALTER TABLE `license_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nfts`
--
ALTER TABLE `nfts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nft_swap_orders`
--
ALTER TABLE `nft_swap_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_id` (`order_id`);

--
-- Indexes for table `nft_swap_sessions`
--
ALTER TABLE `nft_swap_sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referral_earnings_requests`
--
ALTER TABLE `referral_earnings_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `swap_orders`
--
ALTER TABLE `swap_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_id` (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `transaction_logs`
--
ALTER TABLE `transaction_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_tg_id_unique` (`tg_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `referral_code` (`referral_code`),
  ADD KEY `fk_users_referrer_id` (`referrer_id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallets_user_id_foreign` (`user_id`);

--
-- Indexes for table `withdraw_orders`
--
ALTER TABLE `withdraw_orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academy_orders`
--
ALTER TABLE `academy_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `arbitrage_sessions`
--
ALTER TABLE `arbitrage_sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `currency_rates`
--
ALTER TABLE `currency_rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `license_orders`
--
ALTER TABLE `license_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nfts`
--
ALTER TABLE `nfts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `nft_swap_orders`
--
ALTER TABLE `nft_swap_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `nft_swap_sessions`
--
ALTER TABLE `nft_swap_sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `referral_earnings_requests`
--
ALTER TABLE `referral_earnings_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `swap_orders`
--
ALTER TABLE `swap_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `transaction_logs`
--
ALTER TABLE `transaction_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `withdraw_orders`
--
ALTER TABLE `withdraw_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `referral_earnings_requests`
--
ALTER TABLE `referral_earnings_requests`
  ADD CONSTRAINT `referral_earnings_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `swap_orders`
--
ALTER TABLE `swap_orders`
  ADD CONSTRAINT `swap_orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaction_logs`
--
ALTER TABLE `transaction_logs`
  ADD CONSTRAINT `transaction_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_referrer_id` FOREIGN KEY (`referrer_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `wallets`
--
ALTER TABLE `wallets`
  ADD CONSTRAINT `wallets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
