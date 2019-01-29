SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Databáze: `navd00`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `players`
--

CREATE TABLE IF NOT EXISTS `players` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `surname` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `description` varchar(350) COLLATE utf8_czech_ci NOT NULL,
  `age` int(11) NOT NULL,
  `team` BIGINT(20) UNSIGNED,
  `last_updated_at` TIMESTAMP,
  `last_edit_starts_at` TIMESTAMP,
  `last_edit_starts_by_id` BIGINT(20) UNSIGNED,
  `goals` BIGINT(20) UNSIGNED DEFAULT 0,
	
  PRIMARY KEY (`id`),
  KEY `last_edit_starts_by_id` (last_edit_starts_by_id),
  KEY `team` (`team`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='Tabulka obsahující hráče v CMS' AUTO_INCREMENT=6 ;

--
-- Vypisuji data pro tabulku `players`
--

INSERT INTO `players` (`id`, `firstname`, `surname`, `city`, `description`, `age`, `team`, `last_updated_at`, `last_edit_starts_at`, `last_edit_starts_by_id`) VALUES
(1, 'Luigio', 'Marius Antonius', 'Turin','<p>Skvělý střelec, umí se trefit do balónu jak levou, tak i pravou částí hlavy\r\n</p>', 29, 1, '2017-06-03 22:00:00', '2017-06-03 22:00:00', '1'),
(2, 'Filipino', 'Ross Andres', 'Hondolulu','<p>Legendární žonglér a atlet v jednom. Velmi obou i protisměrný hráč.\r\n</p>', 22, 1, '2017-06-03 22:00:00', '2017-06-03 22:00:00', '1'),
(3, 'Richard', 'Rustelbjorn', 'Helsinki','<p>Často si zdobí helmu rohama.\r\n</p>', 33, 1, '2017-06-03 22:00:00', '2017-06-03 22:00:00', '1'),
(4, 'Juznal', 'Svaty', 'Jeruzalem','<p>Pověstný svou všudypřítomnou biblí.\r\n</p>', 19, 1, '2017-06-03 22:00:00', '2017-06-03 22:00:00', '1'),
(5, 'Ukteron', 'Dragobijec', 'Stockholm','<p>Hvězdný hráč pověstný svou nečitelnou střelou zpoda nečekaných překážek.\r\n</p>', 25, 2, '2017-06-03 22:00:00', '2017-06-03 22:00:00', '1'),
(6, 'Vilitron', 'Tamburin', 'Manchester','<p>Veterán zralý na důchod.\r\n</p>', 38, 2, '2017-06-03 22:00:00', '2017-06-03 22:00:00', '1'),
(7, 'Oktar', 'Velkydzban', 'Berlin','<p>Pověstný svým výstředním vkusem\r\n</p>', 26, 2, '2017-06-03 22:00:00', '2017-06-03 22:00:00', '1'),
(8, 'Petr', 'Svetr', 'Praha','<p>Český talent, který se nebojí opřít nejenom do míče, ale i do nepří-protihráčů.\r\n</p>', 21, 3, '2017-06-03 22:00:00', '2017-06-03 22:00:00', '1'),
(9, 'Tulen', 'Obecny', 'Mozambik','<p>No k tomu není co říct.\r\n</p>', 20, 3, '2017-06-03 22:00:00', '2017-06-03 22:00:00', '1'),
(10, 'Chun', 'Yum Raadu', 'Vietnamský záliv','<p>Mrštný asiat.\r\n</p>', 29, 3, '2017-06-03 22:00:00', '2017-06-03 22:00:00', '1'),
(11, 'Tahoun', 'Kapitan', 'California','<p>Bohužel není kapitán.\r\n</p>', 35, 4, '2017-06-03 22:00:00', '2017-06-03 22:00:00', '1'),
(12, 'Goal', 'Guardian', 'Gyros','<p>Řecký hvězdný brankář. Bohužel ho ještě nikdo nezná.\r\n</p>', 20, 4, '2017-06-03 22:00:00', '2017-06-03 22:00:00', '1'),
(13, 'Bubba', 'Cumberbench', 'London','<p>Britská hvězda, pověstný svými účesy.\r\n</p>', 25, 3, '2017-06-03 22:00:00', '2017-06-03 22:00:00', '1'),
(14, 'Fuzzy', 'Beartongue', 'New Jersey','<p>Americký talent. Jeho vázání tkaniček nemá obdob.\r\n</p>', 20, 4, '2017-06-03 22:00:00', '2017-06-03 22:00:00', '1'),
(15, 'Fabio', 'Gondola', 'Parma','<p>Belgický specialista.\r\n</p>', 20, 4, '2017-06-03 22:00:00', '2017-06-03 22:00:00', '1'),
(16, 'Hooch', 'Young', 'Dortmund','<p>Německý brankář pověstvý svojí mrštnostní při penaltách.\r\n</p>', 20, 4, '2017-06-03 22:00:00', '2017-06-03 22:00:00', '1');

-- --------------------------------------------------------

--
-- Struktura tabulky `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_czech_ci NOT NULL UNIQUE,
  `acronym` varchar(5) COLLATE utf8_czech_ci NOT NULL UNIQUE,
  `nationality` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `numOfPlayers` int(11) NOT NULL DEFAULT 0,
  `since` DATE,
--`last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_updated_at` TIMESTAMP,
  `last_edit_starts_at` TIMESTAMP,
  `last_edit_starts_by_id` BIGINT(20) UNSIGNED,
	
  PRIMARY KEY (`id`),
  KEY `last_edit_starts_by_id`(`last_edit_starts_by_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='Tabulka obsahující týmy v CMS' AUTO_INCREMENT=6 ;

--
-- Vypisuji data pro tabulku `teams`
--

INSERT INTO `teams` (`id`, `name`, `acronym`, `nationality`, `since`, `last_updated_at`, `last_edit_starts_at`, `last_edit_starts_by_id`) VALUES
(1, 'FC Zakopávači', 'ZAKOP', 'Czech Republic','2010-06-03', '2017-06-03 22:00:00', '2017-06-03 22:00:00', '1'),
(2, 'FC Vidlečovice', 'VIDLE', 'Czech Republic','2012-07-07', '2017-06-03 22:00:00', '2017-06-03 22:00:00', '1'),
(3, 'AC Stromjarl', 'STROM', 'Sweden','2011-11-11', '2017-06-03 22:00:00', '2017-06-03 22:00:00', '1'),
(4, 'FC Rotrdam', 'ROTOR', 'Netherland','2011-01-01', '2017-06-03 22:00:00', '2017-06-03 22:00:00', '1'),
(5, 'AC Bohemia', 'BOHEM', 'Czech Republic','2010-07-06', '2017-06-03 22:00:00', '2017-06-03 22:00:00', '1'),
(6, 'FC Glassbowl', 'GLASS', 'United Kingdoms','2010-01-01', '2017-06-03 22:00:00', '2017-06-03 22:00:00', '1');


-- --------------------------------------------------------


--
-- Struktura tabulky `playerposition`
--

CREATE TABLE IF NOT EXISTS `playerposition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player` BIGINT(20) UNSIGNED,
  `position` BIGINT(20) UNSIGNED,
  
  PRIMARY KEY (`id`),
  KEY `player` (`player`),
  KEY `position` (`position`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='Tabulka obsahující týmy v CMS' AUTO_INCREMENT=6 ;

--
-- Vypisuji data pro tabulku `playerposition`
--

INSERT INTO `playerposition` (`player`, `position`) VALUES
(1,2),(1,3),(1,4),(1,8),
(2,5),(2,6),(2,7),
(3,1),
(4,11),(4,12),(4,13),
(5,11),(5,12),(5,13),
(6,3),(6,4),(6,8),
(7,5),(7,7),(7,8),
(8,1),
(9,12),
(10,12), (10,13),
(11,10),(11,11),
(12,9), (12,10),
(13,8),
(13,2),(13,9),
(14,1),(15,1),
(16,5),(16,7),(16,8);


ALTER TABLE playerposition
ADD CONSTRAINT pp_const UNIQUE (player, position);

-- --------------------------------------------------------


--
-- Struktura tabulky `matches`
--

CREATE TABLE IF NOT EXISTS `matches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team1` int(11) NOT NULL DEFAULT 0,
  `team2` int(11) NOT NULL DEFAULT 0,
  `t1score` int(3),
  `t2score` int(3),
  `matchdate` DATE,
  `matchtime` TIME,
  `last_updated_at` TIMESTAMP,
  `last_edit_starts_at` TIMESTAMP,
  `last_edit_starts_by_id` BIGINT(20) UNSIGNED,
	
  PRIMARY KEY (`id`),
  FOREIGN KEY (`team1`) REFERENCES teams(`id`),
  FOREIGN KEY (`team2`) REFERENCES teams(`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='Tabulka obsahující zapasy v CMS' AUTO_INCREMENT=6 ;

--
-- Vypisuji data pro tabulku `matches`
--

INSERT INTO `matches` (`team1`, `team2`, `last_updated_at`, `matchdate`, `matchtime`, `last_edit_starts_at`, `last_edit_starts_by_id`, `t1score`, `t2score`) VALUES
(1,2, '2017-06-03 16:00:00', '2017-06-03', '22:00:00', '2017-06-03 22:00:00', 9, 1, 0),
(3,4, '2017-06-03 16:00:00', '2017-06-03', '22:00:00', '2017-06-03 22:00:00', 9, 0, 0),
(5,4, '2017-06-03 16:00:00', '2017-06-03', '22:00:00', '2017-06-03 22:00:00', 9, 0, 3),
(6,1, '2017-06-03 16:00:00', '2017-06-03', '22:00:00', '2017-06-03 22:00:00', 9, 3, 3),
(3,6,"2014-12-14 19:48:29","2016-05-10", "23:35:37","2017-06-03 22:00:00",9,5,8),
(1,4,"2010-10-19 06:25:45","2016-09-13", "07:16:04","2017-06-03 22:00:00",10,8,7),
(2,6,"2014-09-07 00:47:14","2015-08-16", "23:53:23","2017-06-03 22:00:00",9,1,1),
(2,4,"2015-08-14 03:11:01","2016-09-18", "00:54:37","2017-06-03 22:00:00",9,10,7),
(1,6,"2012-11-12 05:27:43","2016-02-14", "09:03:36","2017-06-03 22:00:00",10,9,3),
(3,4,"2011-10-21 06:50:53","2016-08-28", "19:13:45","2017-06-03 22:00:00",9,4,2),
(3,6,"2012-06-27 00:09:36","2014-02-23", "19:59:04","2017-06-03 22:00:00",10,0,4),
(3,6,"2010-01-30 07:01:09","2013-04-16", "20:42:30","2017-06-03 22:00:00",9,0,2),
(1,6,"2012-03-15 18:08:51","2012-05-10", "15:09:29","2017-06-03 22:00:00",9,0,1),
(2,6,"2013-03-19 20:37:20","2016-02-11", "21:54:39","2017-06-03 22:00:00",10,1,4),
(1,6,"2016-04-01 00:01:47","2017-11-19", "06:48:31","2017-06-03 22:00:00",10,9,1),
(2,5,"2013-04-22 15:51:51","2017-01-01", "22:24:50","2017-06-03 22:00:00",9,3,6),
(1,6,"2013-07-26 05:17:30","2016-12-31", "21:02:12","2017-06-03 22:00:00",9,7,10),
(2,5,"2016-11-21 03:54:35","2016-02-17", "13:44:39","2017-06-03 22:00:00",9,2,7),
(1,5,"2011-07-08 23:06:53","2017-04-29", "18:05:18","2017-06-03 22:00:00",10,6,4),
(2,5,"2011-02-20 21:40:26","2017-04-14", "15:42:08","2016-11-15 00:28:23",9,2,6),
(1,6,"2010-04-08 00:08:58","2017-02-10", "22:04:08","2016-09-23 19:00:49",9,8,0),
(3,6,"2015-04-03 17:36:08","2017-02-17", "00:48:02","2017-06-03 22:00:00",10,2,1),
(3,6,"2011-06-30 14:58:28","2016-12-21", "22:38:39","2017-01-22 15:53:44",9,4,3),
(1,6,"2016-08-31 10:05:31","2016-06-24", "05:49:36","2016-12-14 12:36:07",10,0,0),
(3,5,"2010-01-07 07:06:23","2016-12-13", "02:00:24","2017-06-03 22:00:00",9,7,6),
(1,6,"2016-04-01 11:52:01","2017-03-30", "15:10:16","2017-02-22 02:41:12",10,9,10),
(2,5,"2016-09-26 16:19:27","2016-03-14", "07:32:48","2017-01-30 07:43:16",9,3,2),
(3,5,"2012-12-07 00:31:51","2015-04-02", "07:51:28","2017-03-21 23:20:16",9,0,10),
(2,4,"2011-11-20 20:01:11","2016-07-05", "15:11:24","2017-03-20 03:04:56",10,6,0),
(1,6,"2014-05-05 12:17:23","2017-02-27", "11:35:05","2016-11-25 00:46:20",10,7,7),
(1,4,"2016-10-24 18:42:10","2016-10-05", "16:46:51","2017-03-02 06:49:33",10,5,10),
(2,4,"2016-01-17 10:25:02","2015-06-17", "03:56:46","2016-10-22 02:20:20",10,8,2),
(1,6,"2015-07-31 15:41:38","2016-11-03", "01:36:15","2015-03-03 08:28:33",10,3,1),
(3,4,"2010-08-04 09:14:32","2017-01-01", "19:43:50","2016-04-13 01:20:09",9,5,7);


-- --------------------------------------------------------


--
-- Struktura tabulky `tournaments`
--

CREATE TABLE IF NOT EXISTS `tournaments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `prizemoney` int(25) NOT NULL DEFAULT 0,
  `numOfTeams` int(11) NOT NULL DEFAULT 0,
  `last_updated_at` TIMESTAMP,
  `last_edit_starts_at` TIMESTAMP,
  `last_edit_starts_by_id` BIGINT(20) UNSIGNED,
	
  PRIMARY KEY (`id`),
  KEY `last_edit_starts_by_id`(`last_edit_starts_by_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='Tabulka obsahující turnaje v CMS' AUTO_INCREMENT=6 ;

--
-- Vypisuji data pro tabulku `tournaments`
--

INSERT INTO `tournaments` (`id`, `name`, `prizemoney`, `last_updated_at`, `last_edit_starts_at`, `last_edit_starts_by_id`) VALUES
(1, 'Okresní přebor 2016', 1000, '2017-06-03 22:00:00', '2017-06-03 22:00:00', '1'),
(2, 'Okresní přebor 2017', 1000, '2017-06-03 22:00:00', '2017-06-03 22:00:00', '1'),
(3, 'Liga mistrů (pouliční edice) 2016', 2000, '2017-06-03 22:00:00', '2017-06-03 22:00:00', '1'),
(4, 'Liga mistrů (školní hriště edice) 2017', 500, '2017-06-03 22:00:00', '2017-06-03 22:00:00', '1');


-- --------------------------------------------------------


--
-- Struktura tabulky `positions`
--

CREATE TABLE IF NOT EXISTS `positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `acronym` varchar(5) COLLATE utf8_czech_ci NOT NULL,
  `role` varchar(25) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='Tabulka obsahující přehled pozic' AUTO_INCREMENT=4 ;

--
-- Vypisuji data pro tabulku `positions`
--

INSERT INTO `positions` (`id`, `name`, `acronym`, `role`) VALUES
(1, 'Goalkepeer', 'GK', 'Goalkeeper'),
(2, 'Left wing', 'LW', 'Midfielder'),
(3, 'Left back', 'LB', 'Defender'),
(4, 'Left wing back', 'LWB', 'Defender'),
(5, 'Right back', 'RB', 'Defender'),
(6, 'Right wing', 'RW', 'Midfielder'),
(7, 'Right wing back', 'RWB', 'Defender'),
(8, 'Center back', 'CB', 'Defender'),
(9, 'Defending midfielder', 'DM', 'Midfielder'),
(10, 'Central midfielder', 'CM', 'Midfielder'),
(11, 'Attacking midfielder', 'AM', 'Midfielder'),
(12, 'Center forward', 'CF', 'Forward'),
(13, 'Withdrawn forward', 'WF', 'Forward');


-- --------------------------------------------------------


--
-- Struktura tabulky `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `content` varchar(1000) COLLATE utf8_czech_ci NOT NULL,
  `posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `author` BIGINT(20) UNSIGNED,
    
  PRIMARY KEY (`id`),
  KEY `author`(`author`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='Tabulka obsahující přehled pozic' AUTO_INCREMENT=4 ;


--
-- Vypisuji data pro tabulku `articles`
--

INSERT INTO `articles` (`title`, `content`, `posted`, `author`) VALUES
('Welcome here!', 'Welcome on this website, that was created as a project for 4IZ278. This app was created by Daniel Navrátil and uses source codes provided by our great lecturers.', CURRENT_TIMESTAMP , 11),
('This is a second news!', 'Seems like everything is working just fine! Well, kind of!', CURRENT_TIMESTAMP , 11);


-- --------------------------------------------------------


--
-- Struktura tabulky `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_czech_ci,
  `fbid` BIGINT(20) UNSIGNED,
  `role` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `role` (`role`)  
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='Tabulka obsahující uživatelské účty' AUTO_INCREMENT=11 ;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`email`, `password`, `role`) VALUES
('xname@vse.cz', '$2y$10$Jp2.VQ.ecpwQk7Rs6O20Nuad2uLQ.delHfCgToDCy9oLVMARckzEm', 'registered'),
('xadmin@vse.cz', '$2y$10$7y1iNg56lD57m0zXc9tq4eedcxp3HBUjvHihagr0cIwQ394Bg/D7G', 'admin');


-- --------------------------------------------------------

--
-- Struktura tabulky `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  `parent_id` varchar(20) COLLATE utf8_czech_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_role` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='Tabulka obsahující přehled podporovaných rolí';

--
-- Vypisuji data pro tabulku `roles`
--

INSERT INTO `roles` (`id`, `parent_id`) VALUES
('guest', NULL),
('admin', 'editor'),
('registered', 'guest'),
('editor', 'registered');

  
-- --------------------------------------------------------

--
-- Omezení pro exportované tabulky
--

UPDATE teams 
SET numOfPlayers = (SELECT COUNT(*) FROM players WHERE team=teams.id) ON UPDATE CASCADE;


--
-- Omezení pro tabulku `players`
--
ALTER TABLE `players`
  ADD CONSTRAINT `playerTeam` FOREIGN KEY (`team`) REFERENCES `teams` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `last_edit_starts_by_id` FOREIGN KEY (`last_edit_starts_by_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
  
--
-- Omezení pro tabulku `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `firstTeam` FOREIGN KEY (`team1`) REFERENCES `teams` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `secondTeam` FOREIGN KEY (`team2`) REFERENCES `teams` (`id`) ON UPDATE CASCADE;
  
--
-- Omezení pro tabulku `roles`
--

ALTER TABLE `roles`
  ADD CONSTRAINT `parentRole` FOREIGN KEY (`parent_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE;

  

