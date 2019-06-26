-- SQL TABLE CREATION VALUES

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `avinus_db1_composersandbox`
--

-- --------------------------------------------------------

--
-- Table structure for table `syntaxseed_iplimiter`
--

CREATE TABLE IF NOT EXISTS `syntaxseed_iplimiter` (
  `ip` varchar(39) CHARACTER SET ascii NOT NULL,
  `category` varchar(128) NOT NULL,
  `attempts` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `lastattempt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ip`,`category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;





COMMIT;
