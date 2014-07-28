-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2014 at 09:20 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tests`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE IF NOT EXISTS `answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `answer` text NOT NULL,
  `questionId` int(11) NOT NULL,
  `bool` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `nameUa` varchar(255) NOT NULL,
  `partId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `nameUa`, `partId`, `userId`) VALUES
(1, 'Категория 1', 'Категорія 1', 2, 3),
(2, 'Категория 2', 'Категорія 2', 2, 3),
(3, 'Категория 3', 'Категорія 3', 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `nameUa` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `nameUa`) VALUES
(2, 'Группа №2', 'Група №2'),
(3, 'Группа №1', 'Група №1'),
(4, 'Группа №3', 'Група №3'),
(5, 'Группа №5', 'Група №5');

-- --------------------------------------------------------

--
-- Table structure for table `homework`
--

CREATE TABLE IF NOT EXISTS `homework` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nameUa` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `file` text NOT NULL,
  `test` text NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `homework`
--

INSERT INTO `homework` (`id`, `userId`, `name`, `nameUa`, `text`, `file`, `test`, `date`) VALUES
(3, 3, 'Домашнее задание №2', 'Домашнє завдання № 2', '', '/uploads/18-07-2014/homework114359.png', '', 1405673039),
(5, 3, 'Домашнее задание №1', 'Домашнє завдання № 1', '', '/uploads/18-07-2014/homework115202.pdf', '', 1405673522),
(6, 3, 'Домашнее задание №3', 'Домашнє завдання № 3', '', '/uploads/18-07-2014/homework115324.xlsx', '', 1405673604),
(7, 3, 'Домашнее задание №4', 'Домашнє завдання № 4', '', '', '/test/question/test/2/question/1', 1405946735),
(8, 3, 'Домашнее задание №5', 'Домашнє завдання № 5', '', '', '/test/question/test/1/question/1', 1406015918),
(9, 3, 'Домашнее задание №6', 'Домашнє завдання № 6', '<h1>\r\n	Домашнее задание №6</h1>\r\n<p>\r\n	Список</p>\r\n<ul>\r\n	<li>\r\n		Элемент 1</li>\r\n	<li>\r\n		Элемент 2</li>\r\n	<li>\r\n		Элемент 3</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n', '', '/test/question/test/1/question/1', 1406016222);

-- --------------------------------------------------------

--
-- Table structure for table `messege`
--

CREATE TABLE IF NOT EXISTS `messege` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `userIdTo` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `homeworkId` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `messege`
--

INSERT INTO `messege` (`id`, `userId`, `userIdTo`, `date`, `homeworkId`, `status`) VALUES
(5, 3, 3, 1405948459, 7, 0),
(6, 3, 8, 1405948459, 7, 0),
(7, 3, 3, 1405956952, 6, 0),
(8, 3, 8, 1405956952, 6, 1),
(9, 3, 3, 1406015928, 8, 0),
(10, 3, 8, 1406015929, 8, 1),
(11, 3, 3, 1406016243, 9, 0),
(12, 3, 8, 1406016243, 9, 1),
(13, 3, 3, 1406043562, 5, 0),
(14, 3, 8, 1406043562, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `part`
--

CREATE TABLE IF NOT EXISTS `part` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `nameUa` varchar(255) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `part`
--

INSERT INTO `part` (`id`, `name`, `nameUa`, `userId`) VALUES
(2, 'Раздел 1', 'Розділ 1', 3),
(3, 'Раздел 2', 'Розділ 2', 3),
(4, 'Раздел 3', 'Розділ 3', 3);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partId` int(11) NOT NULL,
  `part` varchar(255) NOT NULL,
  `partUa` varchar(255) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `categoryUa` varchar(255) NOT NULL,
  `subcategoryId` int(11) NOT NULL,
  `subcategory` varchar(255) NOT NULL,
  `subcategoryUa` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `titleUa` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `descriptionUa` text NOT NULL,
  `userId` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `date` int(11) NOT NULL,
  `body` text NOT NULL,
  `bodyUa` text NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `partId`, `part`, `partUa`, `categoryId`, `category`, `categoryUa`, `subcategoryId`, `subcategory`, `subcategoryUa`, `title`, `titleUa`, `description`, `descriptionUa`, `userId`, `user`, `date`, `body`, `bodyUa`, `icon`) VALUES
(1, 0, '', '', 1, 'Категория 1', 'Категорія 1', 0, '', '', 'Lorem ipsum dolor sit amet', 'Багато програм верстування та веб-дизайну', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada neque sed posuere aliquam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Integer ac neque eu nisi porttitor bibendum. Suspendisse rhoncus, ligula id tincidunt fringilla, mi nibh molestie turpis, vel ultricies quam lacus at diam. Proin iaculis libero purus, at scelerisque nisi scelerisque eget. Nam molestie nisl enim, nec ultricies felis eleifend ac. Praesent ultrices, mi ut faucibus convallis, leo nisi consequat lorem, id suscipit massa eros eget massa. Etiam id magna libero. Fusce placerat porttitor porta. Aenean sit amet lacus commodo, pulvinar felis quis, tincidunt quam.', 'На відміну від поширеної думки Lorem Ipsum не є випадковим набором літер. Він походить з уривку класичної латинської літератури 45 року до н.е., тобто має більш як 2000-річну історію. Річард Макклінток, професор латини з коледжу Хемпдін-Сидні, що у Вірджінії, вивчав одне з найменш зрозумілих латинських слів - consectetur - з уривку Lorem Ipsum, і у пошуку цього слова в класичній літературі знайшов безсумнівне джерело. Lorem Ipsum походить з розділів 1.10.32 та 1.10.33 цицеронівського "de Finibus Bonorum et Malorum" ("Про межі добра і зла"), написаного у 45 році до н.е. Цей трактат з теорії етики був дуже популярним в епоху Відродження. Перший рядок Lorem Ipsum, "Lorem ipsum dolor sit amet..." походить з одного з рядків розділу 1.10.32.\r\n\r\nКласичний текст, використовуваний з XVI сторіччя, наведено нижче для всіх зацікавлених. Також точно за оригіналом наведено розділи 1.10.32 та 1.10.33 цицеронівського "de Finibus Bonorum et Malorum" разом із перекладом англійською, виконаним 1914 року Х.Рекемом.', 3, 'mladi', 1406199058, '<p>\r\n	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada neque sed posuere aliquam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Integer ac neque eu nisi porttitor bibendum. Suspendisse rhoncus, ligula id tincidunt fringilla, mi nibh molestie turpis, vel ultricies quam lacus at diam. Proin iaculis libero purus, at scelerisque nisi scelerisque eget. Nam molestie nisl enim, nec ultricies felis eleifend ac. Praesent ultrices, mi ut faucibus convallis, leo nisi consequat lorem, id suscipit massa eros eget massa. Etiam id magna libero. Fusce placerat porttitor porta. Aenean sit amet lacus commodo, pulvinar felis quis, tincidunt quam.</p>\r\n<p>\r\n	Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus pellentesque ut justo in accumsan. Etiam non enim id lectus sodales consectetur. Nunc ultrices metus sit amet arcu sagittis rhoncus. Morbi eget nibh ut sem aliquam commodo vel non neque. Curabitur nec facilisis dolor, in elementum sem. Integer consequat adipiscing massa scelerisque sollicitudin. Mauris mi sapien, gravida vitae lorem eu, imperdiet venenatis erat. Mauris adipiscing vitae libero ut fermentum. Cras at est felis. Nunc interdum pellentesque arcu et imperdiet. Phasellus fringilla velit ac diam aliquet feugiat. Quisque tristique, orci a gravida rutrum, dui nulla ullamcorper quam, vel porta quam felis nec ligula.</p>\r\n<p>\r\n	In elementum mauris massa. Nulla sed ligula vitae lacus malesuada tempus. Cras lacus augue, posuere commodo scelerisque sit amet, suscipit vitae erat. Nunc molestie leo metus, quis aliquet ligula porttitor tristique. Ut nec nulla id odio tempus congue eget vel ligula. Fusce suscipit tempor velit sed vulputate. Phasellus lorem erat, lobortis sit amet pharetra in, commodo at metus. Ut rhoncus viverra diam, sit amet commodo lacus.</p>\r\n<p>\r\n	Maecenas porttitor aliquet odio non eleifend. Curabitur mollis nibh at justo euismod, non volutpat dolor commodo. Sed porttitor est non nulla aliquet, sit amet sagittis est cursus. Aliquam ornare rhoncus turpis, sit amet varius massa adipiscing at. Ut nibh est, faucibus id posuere vel, euismod id nunc. Sed ultricies, enim eu blandit blandit, elit enim placerat neque, et sagittis urna lectus at sapien. Vestibulum blandit purus ut nisi euismod ultrices. Etiam vehicula lobortis tellus eu placerat. Curabitur hendrerit dui lectus, in ornare dui congue nec. Nulla porttitor, massa et imperdiet volutpat, justo ante tempus arcu, vitae faucibus est elit eu ante. Vestibulum pretium purus sed felis accumsan ullamcorper. In nec blandit augue, sit amet luctus nunc.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<iframe width="560" height="315" src="//www.youtube.com/embed/WebslGIybOQ" frameborder="0" allowfullscreen></iframe>', '<p>\r\n	На відміну від поширеної думки Lorem Ipsum не є випадковим набором літер. Він походить з уривку класичної латинської літератури 45 року до н.е., тобто має більш як 2000-річну історію. Річард Макклінток, професор латини з коледжу Хемпдін-Сидні, що у Вірджінії, вивчав одне з найменш зрозумілих латинських слів - consectetur - з уривку Lorem Ipsum, і у пошуку цього слова в класичній літературі знайшов безсумнівне джерело. Lorem Ipsum походить з розділів 1.10.32 та 1.10.33 цицеронівського &quot;de Finibus Bonorum et Malorum&quot; (&quot;Про межі добра і зла&quot;), написаного у 45 році до н.е. Цей трактат з теорії етики був дуже популярним в епоху Відродження. Перший рядок Lorem Ipsum, &quot;Lorem ipsum dolor sit amet...&quot; походить з одного з рядків розділу 1.10.32. Класичний текст, використовуваний з XVI сторіччя, наведено нижче для всіх зацікавлених. Також точно за оригіналом наведено розділи 1.10.32 та 1.10.33 цицеронівського &quot;de Finibus Bonorum et Malorum&quot; разом із перекладом англійською, виконаним 1914 року Х.Рекемом.</p>\r\n<p>\r\n<iframe width="560" height="315" src="//www.youtube.com/embed/WebslGIybOQ" frameborder="0" allowfullscreen></iframe>', 'http://www.hqoboi.com/img/other/internet-kartinka-007.jpg'),
(2, 0, '', '', 1, 'Категория 1', 'Категорія 1', 0, '', '', 'Etiam id magna libero', 'Багато програм верстування та веб-дизайну', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada neque sed posuere aliquam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Integer ac neque eu nisi porttitor bibendum. Suspendisse rhoncus, ligula id tincidunt fringilla, mi nibh molestie turpis, vel ultricies quam lacus at diam. Proin iaculis libero purus, at scelerisque nisi scelerisque eget. Nam molestie nisl enim, nec ultricies felis eleifend ac. Praesent ultrices, mi ut faucibus convallis, leo nisi consequat lorem, id suscipit massa eros eget massa. Etiam id magna libero. Fusce placerat porttitor porta. Aenean sit amet lacus commodo, pulvinar felis quis, tincidunt quam.', 'На відміну від поширеної думки Lorem Ipsum не є випадковим набором літер. Він походить з уривку класичної латинської літератури 45 року до н.е., тобто має більш як 2000-річну історію. Річард Макклінток, професор латини з коледжу Хемпдін-Сидні, що у Вірджінії, вивчав одне з найменш зрозумілих латинських слів - consectetur - з уривку Lorem Ipsum, і у пошуку цього слова в класичній літературі знайшов безсумнівне джерело. Lorem Ipsum походить з розділів 1.10.32 та 1.10.33 цицеронівського "de Finibus Bonorum et Malorum" ("Про межі добра і зла"), написаного у 45 році до н.е. Цей трактат з теорії етики був дуже популярним в епоху Відродження. Перший рядок Lorem Ipsum, "Lorem ipsum dolor sit amet..." походить з одного з рядків розділу 1.10.32.\n\nКласичний текст, використовуваний з XVI сторіччя, наведено нижче для всіх зацікавлених. Також точно за оригіналом наведено розділи 1.10.32 та 1.10.33 цицеронівського "de Finibus Bonorum et Malorum" разом із перекладом англійською, виконаним 1914 року Х.Рекемом.', 3, 'mladi', 1404995734, '<p>\r\n	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada neque sed posuere aliquam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Integer ac neque eu nisi porttitor bibendum. Suspendisse rhoncus, ligula id tincidunt fringilla, mi nibh molestie turpis, vel ultricies quam lacus at diam. Proin iaculis libero purus, at scelerisque nisi scelerisque eget. Nam molestie nisl enim, nec ultricies felis eleifend ac. Praesent ultrices, mi ut faucibus convallis, leo nisi consequat lorem, id suscipit massa eros eget massa. Etiam id magna libero. Fusce placerat porttitor porta. Aenean sit amet lacus commodo, pulvinar felis quis, tincidunt quam.</p>\r\n<p>\r\n	Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus pellentesque ut justo in accumsan. Etiam non enim id lectus sodales consectetur. Nunc ultrices metus sit amet arcu sagittis rhoncus. Morbi eget nibh ut sem aliquam commodo vel non neque. Curabitur nec facilisis dolor, in elementum sem. Integer consequat adipiscing massa scelerisque sollicitudin. Mauris mi sapien, gravida vitae lorem eu, imperdiet venenatis erat. Mauris adipiscing vitae libero ut fermentum. Cras at est felis. Nunc interdum pellentesque arcu et imperdiet. Phasellus fringilla velit ac diam aliquet feugiat. Quisque tristique, orci a gravida rutrum, dui nulla ullamcorper quam, vel porta quam felis nec ligula.</p>\r\n<p>\r\n	In elementum mauris massa. Nulla sed ligula vitae lacus malesuada tempus. Cras lacus augue, posuere commodo scelerisque sit amet, suscipit vitae erat. Nunc molestie leo metus, quis aliquet ligula porttitor tristique. Ut nec nulla id odio tempus congue eget vel ligula. Fusce suscipit tempor velit sed vulputate. Phasellus lorem erat, lobortis sit amet pharetra in, commodo at metus. Ut rhoncus viverra diam, sit amet commodo lacus.</p>\r\n<p>\r\n	Maecenas porttitor aliquet odio non eleifend. Curabitur mollis nibh at justo euismod, non volutpat dolor commodo. Sed porttitor est non nulla aliquet, sit amet sagittis est cursus. Aliquam ornare rhoncus turpis, sit amet varius massa adipiscing at. Ut nibh est, faucibus id posuere vel, euismod id nunc. Sed ultricies, enim eu blandit blandit, elit enim placerat neque, et sagittis urna lectus at sapien. Vestibulum blandit purus ut nisi euismod ultrices. Etiam vehicula lobortis tellus eu placerat. Curabitur hendrerit dui lectus, in ornare dui congue nec. Nulla porttitor, massa et imperdiet volutpat, justo ante tempus arcu, vitae faucibus est elit eu ante. Vestibulum pretium purus sed felis accumsan ullamcorper. In nec blandit augue, sit amet luctus nunc.</p>\r\n<p>\r\n	Nullam fermentum neque vitae lacinia auctor. Suspendisse quis lacus sed arcu viverra malesuada. Nullam id urna id arcu tempor vulputate sit amet eget arcu. Sed dignissim est sem, vitae pharetra nisl tristique eleifend. Suspendisse vehicula consectetur tellus eu congue. Fusce porta lacus sed blandit laoreet. Suspendisse consequat consectetur urna quis viverra. Morbi rutrum eros sed nibh sodales molestie.</p>\r\n<p>\r\n	Sed urna lectus, dapibus ut ante vel, ultrices interdum metus. Morbi id nulla ante. Vivamus vel cursus lacus, id vestibulum mauris. Nulla sed velit neque. Suspendisse et libero sollicitudin, interdum magna ut, blandit nulla. In id metus at neque ultricies aliquet. Cras ultricies vel diam eu consequat. Curabitur vitae pellentesque nibh. Nullam eu congue risus, sit amet lobortis neque. Etiam vehicula eu justo interdum consectetur. Morbi dolor enim, venenatis eu porta vel, bibendum facilisis quam.</p>', '', 'http://www.hqoboi.com/img/other/internet-kartinka-007.jpg'),
(3, 0, '', '', 1, 'Категория 1', 'Категорія 1', 0, '', '', 'In elementum mauris massa.', 'Багато програм верстування та веб-дизайну', 'Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus pellentesque ut justo in accumsan. Etiam non enim id lectus sodales consectetur. Nunc ultrices metus sit amet arcu sagittis rhoncus. Morbi eget nibh ut sem aliquam commodo vel non neque. Curabitur nec facilisis dolor, in elementum sem. Integer consequat adipiscing massa scelerisque sollicitudin. Mauris mi sapien, gravida vitae lorem eu, imperdiet venenatis erat. Mauris adipiscing vitae libero ut fermentum. Cras at est felis. Nunc interdum pellentesque arcu et imperdiet. Phasellus fringilla velit ac diam aliquet feugiat. Quisque tristique, orci a gravida rutrum, dui nulla ullamcorper quam, vel porta quam felis nec ligula.', 'На відміну від поширеної думки Lorem Ipsum не є випадковим набором літер. Він походить з уривку класичної латинської літератури 45 року до н.е., тобто має більш як 2000-річну історію. Річард Макклінток, професор латини з коледжу Хемпдін-Сидні, що у Вірджінії, вивчав одне з найменш зрозумілих латинських слів - consectetur - з уривку Lorem Ipsum, і у пошуку цього слова в класичній літературі знайшов безсумнівне джерело. Lorem Ipsum походить з розділів 1.10.32 та 1.10.33 цицеронівського "de Finibus Bonorum et Malorum" ("Про межі добра і зла"), написаного у 45 році до н.е. Цей трактат з теорії етики був дуже популярним в епоху Відродження. Перший рядок Lorem Ipsum, "Lorem ipsum dolor sit amet..." походить з одного з рядків розділу 1.10.32.\n\nКласичний текст, використовуваний з XVI сторіччя, наведено нижче для всіх зацікавлених. Також точно за оригіналом наведено розділи 1.10.32 та 1.10.33 цицеронівського "de Finibus Bonorum et Malorum" разом із перекладом англійською, виконаним 1914 року Х.Рекемом.', 3, 'mladi', 1404995719, '<p>\r\n	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada neque sed posuere aliquam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Integer ac neque eu nisi porttitor bibendum. Suspendisse rhoncus, ligula id tincidunt fringilla, mi nibh molestie turpis, vel ultricies quam lacus at diam. Proin iaculis libero purus, at scelerisque nisi scelerisque eget. Nam molestie nisl enim, nec ultricies felis eleifend ac. Praesent ultrices, mi ut faucibus convallis, leo nisi consequat lorem, id suscipit massa eros eget massa. Etiam id magna libero. Fusce placerat porttitor porta. Aenean sit amet lacus commodo, pulvinar felis quis, tincidunt quam.</p>\r\n<p>\r\n	Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus pellentesque ut justo in accumsan. Etiam non enim id lectus sodales consectetur. Nunc ultrices metus sit amet arcu sagittis rhoncus. Morbi eget nibh ut sem aliquam commodo vel non neque. Curabitur nec facilisis dolor, in elementum sem. Integer consequat adipiscing massa scelerisque sollicitudin. Mauris mi sapien, gravida vitae lorem eu, imperdiet venenatis erat. Mauris adipiscing vitae libero ut fermentum. Cras at est felis. Nunc interdum pellentesque arcu et imperdiet. Phasellus fringilla velit ac diam aliquet feugiat. Quisque tristique, orci a gravida rutrum, dui nulla ullamcorper quam, vel porta quam felis nec ligula.</p>\r\n<p>\r\n	In elementum mauris massa. Nulla sed ligula vitae lacus malesuada tempus. Cras lacus augue, posuere commodo scelerisque sit amet, suscipit vitae erat. Nunc molestie leo metus, quis aliquet ligula porttitor tristique. Ut nec nulla id odio tempus congue eget vel ligula. Fusce suscipit tempor velit sed vulputate. Phasellus lorem erat, lobortis sit amet pharetra in, commodo at metus. Ut rhoncus viverra diam, sit amet commodo lacus.</p>', '', 'http://www.hqoboi.com/img/other/internet-kartinka-007.jpg'),
(4, 0, '', '', 2, 'Категория 2', 'Категорія 2', 0, '', '', 'In elementum mauris massa', 'Багато програм верстування та веб-дизайну', 'In elementum mauris massa. Nulla sed ligula vitae lacus malesuada tempus. Cras lacus augue, posuere commodo scelerisque sit amet, suscipit vitae erat. Nunc molestie leo metus, quis aliquet ligula porttitor tristique. Ut nec nulla id odio tempus congue eget vel ligula. Fusce suscipit tempor velit sed vulputate. Phasellus lorem erat, lobortis sit amet pharetra in, commodo at metus. Ut rhoncus viverra diam, sit amet commodo lacus.', 'На відміну від поширеної думки Lorem Ipsum не є випадковим набором літер. Він походить з уривку класичної латинської літератури 45 року до н.е., тобто має більш як 2000-річну історію. Річард Макклінток, професор латини з коледжу Хемпдін-Сидні, що у Вірджінії, вивчав одне з найменш зрозумілих латинських слів - consectetur - з уривку Lorem Ipsum, і у пошуку цього слова в класичній літературі знайшов безсумнівне джерело. Lorem Ipsum походить з розділів 1.10.32 та 1.10.33 цицеронівського "de Finibus Bonorum et Malorum" ("Про межі добра і зла"), написаного у 45 році до н.е. Цей трактат з теорії етики був дуже популярним в епоху Відродження. Перший рядок Lorem Ipsum, "Lorem ipsum dolor sit amet..." походить з одного з рядків розділу 1.10.32.\n\nКласичний текст, використовуваний з XVI сторіччя, наведено нижче для всіх зацікавлених. Також точно за оригіналом наведено розділи 1.10.32 та 1.10.33 цицеронівського "de Finibus Bonorum et Malorum" разом із перекладом англійською, виконаним 1914 року Х.Рекемом.', 3, 'mladi', 1404996880, '<p>\r\n	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada neque sed posuere aliquam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Integer ac neque eu nisi porttitor bibendum. Suspendisse rhoncus, ligula id tincidunt fringilla, mi nibh molestie turpis, vel ultricies quam lacus at diam. Proin iaculis libero purus, at scelerisque nisi scelerisque eget. Nam molestie nisl enim, nec ultricies felis eleifend ac. Praesent ultrices, mi ut faucibus convallis, leo nisi consequat lorem, id suscipit massa eros eget massa. Etiam id magna libero. Fusce placerat porttitor porta. Aenean sit amet lacus commodo, pulvinar felis quis, tincidunt quam.</p>\r\n<p>\r\n	Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus pellentesque ut justo in accumsan. Etiam non enim id lectus sodales consectetur. Nunc ultrices metus sit amet arcu sagittis rhoncus. Morbi eget nibh ut sem aliquam commodo vel non neque. Curabitur nec facilisis dolor, in elementum sem. Integer consequat adipiscing massa scelerisque sollicitudin. Mauris mi sapien, gravida vitae lorem eu, imperdiet venenatis erat. Mauris adipiscing vitae libero ut fermentum. Cras at est felis. Nunc interdum pellentesque arcu et imperdiet. Phasellus fringilla velit ac diam aliquet feugiat. Quisque tristique, orci a gravida rutrum, dui nulla ullamcorper quam, vel porta quam felis nec ligula.</p>\r\n<p>\r\n	In elementum mauris massa. Nulla sed ligula vitae lacus malesuada tempus. Cras lacus augue, posuere commodo scelerisque sit amet, suscipit vitae erat. Nunc molestie leo metus, quis aliquet ligula porttitor tristique. Ut nec nulla id odio tempus congue eget vel ligula. Fusce suscipit tempor velit sed vulputate. Phasellus lorem erat, lobortis sit amet pharetra in, commodo at metus. Ut rhoncus viverra diam, sit amet commodo lacus.</p>\r\n<p>\r\n	Maecenas porttitor aliquet odio non eleifend. Curabitur mollis nibh at justo euismod, non volutpat dolor commodo. Sed porttitor est non nulla aliquet, sit amet sagittis est cursus. Aliquam ornare rhoncus turpis, sit amet varius massa adipiscing at. Ut nibh est, faucibus id posuere vel, euismod id nunc. Sed ultricies, enim eu blandit blandit, elit enim placerat neque, et sagittis urna lectus at sapien. Vestibulum blandit purus ut nisi euismod ultrices. Etiam vehicula lobortis tellus eu placerat. Curabitur hendrerit dui lectus, in ornare dui congue nec. Nulla porttitor, massa et imperdiet volutpat, justo ante tempus arcu, vitae faucibus est elit eu ante. Vestibulum pretium purus sed felis accumsan ullamcorper. In nec blandit augue, sit amet luctus nunc.</p>', '', 'http://www.hqoboi.com/img/other/internet-kartinka-007.jpg'),
(5, 0, '', '', 2, 'Категория 2', 'Категорія 2', 0, '', '', 'Class aptent taciti sociosqu', 'Багато програм верстування та веб-дизайну', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada neque sed posuere aliquam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Integer ac neque eu nisi porttitor bibendum. Suspendisse rhoncus, ligula id tincidunt fringilla, mi nibh molestie turpis, vel ultricies quam lacus at diam. Proin iaculis libero purus, at scelerisque nisi scelerisque eget. Nam molestie nisl enim, nec ultricies felis eleifend ac. Praesent ultrices, mi ut faucibus convallis, leo nisi consequat lorem, id suscipit massa eros eget massa. Etiam id magna libero. Fusce placerat porttitor porta. Aenean sit amet lacus commodo, pulvinar felis quis, tincidunt quam.\r\n\r\nClass aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus pellentesque ut justo in accumsan. Etiam non enim id lectus sodales consectetur. Nunc ultrices metus sit amet arcu sagittis rhoncus. Morbi eget nibh ut sem aliquam commodo vel non neque. Curabitur nec facilisis dolor, in elementum sem. Integer consequat adipiscing massa scelerisque sollicitudin. Mauris mi sapien, gravida vitae lorem eu, imperdiet venenatis erat. Mauris adipiscing vitae libero ut fermentum. Cras at est felis. Nunc interdum pellentesque arcu et imperdiet. Phasellus fringilla velit ac diam aliquet feugiat. Quisque tristique, orci a gravida rutrum, dui nulla ullamcorper quam, vel porta quam felis nec ligula.', 'На відміну від поширеної думки Lorem Ipsum не є випадковим набором літер. Він походить з уривку класичної латинської літератури 45 року до н.е., тобто має більш як 2000-річну історію. Річард Макклінток, професор латини з коледжу Хемпдін-Сидні, що у Вірджінії, вивчав одне з найменш зрозумілих латинських слів - consectetur - з уривку Lorem Ipsum, і у пошуку цього слова в класичній літературі знайшов безсумнівне джерело. Lorem Ipsum походить з розділів 1.10.32 та 1.10.33 цицеронівського "de Finibus Bonorum et Malorum" ("Про межі добра і зла"), написаного у 45 році до н.е. Цей трактат з теорії етики був дуже популярним в епоху Відродження. Перший рядок Lorem Ipsum, "Lorem ipsum dolor sit amet..." походить з одного з рядків розділу 1.10.32.\n\nКласичний текст, використовуваний з XVI сторіччя, наведено нижче для всіх зацікавлених. Також точно за оригіналом наведено розділи 1.10.32 та 1.10.33 цицеронівського "de Finibus Bonorum et Malorum" разом із перекладом англійською, виконаним 1914 року Х.Рекемом.', 3, 'mladi', 1404997655, '<p>\r\n	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada neque sed posuere aliquam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Integer ac neque eu nisi porttitor bibendum. Suspendisse rhoncus, ligula id tincidunt fringilla, mi nibh molestie turpis, vel ultricies quam lacus at diam. Proin iaculis libero purus, at scelerisque nisi scelerisque eget. Nam molestie nisl enim, nec ultricies felis eleifend ac. Praesent ultrices, mi ut faucibus convallis, leo nisi consequat lorem, id suscipit massa eros eget massa. Etiam id magna libero. Fusce placerat porttitor porta. Aenean sit amet lacus commodo, pulvinar felis quis, tincidunt quam.</p>\r\n<p>\r\n	Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus pellentesque ut justo in accumsan. Etiam non enim id lectus sodales consectetur. Nunc ultrices metus sit amet arcu sagittis rhoncus. Morbi eget nibh ut sem aliquam commodo vel non neque. Curabitur nec facilisis dolor, in elementum sem. Integer consequat adipiscing massa scelerisque sollicitudin. Mauris mi sapien, gravida vitae lorem eu, imperdiet venenatis erat. Mauris adipiscing vitae libero ut fermentum. Cras at est felis. Nunc interdum pellentesque arcu et imperdiet. Phasellus fringilla velit ac diam aliquet feugiat. Quisque tristique, orci a gravida rutrum, dui nulla ullamcorper quam, vel porta quam felis nec ligula.</p>\r\n<p>\r\n	In elementum mauris massa. Nulla sed ligula vitae lacus malesuada tempus. Cras lacus augue, posuere commodo scelerisque sit amet, suscipit vitae erat. Nunc molestie leo metus, quis aliquet ligula porttitor tristique. Ut nec nulla id odio tempus congue eget vel ligula. Fusce suscipit tempor velit sed vulputate. Phasellus lorem erat, lobortis sit amet pharetra in, commodo at metus. Ut rhoncus viverra diam, sit amet commodo lacus.</p>\r\n<p>\r\n	Maecenas porttitor aliquet odio non eleifend. Curabitur mollis nibh at justo euismod, non volutpat dolor commodo. Sed porttitor est non nulla aliquet, sit amet sagittis est cursus. Aliquam ornare rhoncus turpis, sit amet varius massa adipiscing at. Ut nibh est, faucibus id posuere vel, euismod id nunc. Sed ultricies, enim eu blandit blandit, elit enim placerat neque, et sagittis urna lectus at sapien. Vestibulum blandit purus ut nisi euismod ultrices. Etiam vehicula lobortis tellus eu placerat. Curabitur hendrerit dui lectus, in ornare dui congue nec. Nulla porttitor, massa et imperdiet volutpat, justo ante tempus arcu, vitae faucibus est elit eu ante. Vestibulum pretium purus sed felis accumsan ullamcorper. In nec blandit augue, sit amet luctus nunc.</p>', '', 'http://www.hqoboi.com/img/other/internet-kartinka-007.jpg'),
(6, 0, '', '', 2, 'Категория 2', 'Категорія 2', 0, '', '', 'Sed urna lectus', 'Багато програм верстування та веб-дизайну', 'Nullam fermentum neque vitae lacinia auctor. Suspendisse quis lacus sed arcu viverra malesuada. Nullam id urna id arcu tempor vulputate sit amet eget arcu. Sed dignissim est sem, vitae pharetra nisl tristique eleifend. Suspendisse vehicula consectetur tellus eu congue. Fusce porta lacus sed blandit laoreet. Suspendisse consequat consectetur urna quis viverra. Morbi rutrum eros sed nibh sodales molestie.', 'На відміну від поширеної думки Lorem Ipsum не є випадковим набором літер. Він походить з уривку класичної латинської літератури 45 року до н.е., тобто має більш як 2000-річну історію. Річард Макклінток, професор латини з коледжу Хемпдін-Сидні, що у Вірджінії, вивчав одне з найменш зрозумілих латинських слів - consectetur - з уривку Lorem Ipsum, і у пошуку цього слова в класичній літературі знайшов безсумнівне джерело. Lorem Ipsum походить з розділів 1.10.32 та 1.10.33 цицеронівського "de Finibus Bonorum et Malorum" ("Про межі добра і зла"), написаного у 45 році до н.е. Цей трактат з теорії етики був дуже популярним в епоху Відродження. Перший рядок Lorem Ipsum, "Lorem ipsum dolor sit amet..." походить з одного з рядків розділу 1.10.32.\n\nКласичний текст, використовуваний з XVI сторіччя, наведено нижче для всіх зацікавлених. Також точно за оригіналом наведено розділи 1.10.32 та 1.10.33 цицеронівського "de Finibus Bonorum et Malorum" разом із перекладом англійською, виконаним 1914 року Х.Рекемом.', 3, 'mladi', 1404997712, '<p>\r\n	Nullam fermentum neque vitae lacinia auctor. Suspendisse quis lacus sed arcu viverra malesuada. Nullam id urna id arcu tempor vulputate sit amet eget arcu. Sed dignissim est sem, vitae pharetra nisl tristique eleifend. Suspendisse vehicula consectetur tellus eu congue. Fusce porta lacus sed blandit laoreet. Suspendisse consequat consectetur urna quis viverra. Morbi rutrum eros sed nibh sodales molestie.</p>\r\n<p>\r\n	Sed urna lectus, dapibus ut ante vel, ultrices interdum metus. Morbi id nulla ante. Vivamus vel cursus lacus, id vestibulum mauris. Nulla sed velit neque. Suspendisse et libero sollicitudin, interdum magna ut, blandit nulla. In id metus at neque ultricies aliquet. Cras ultricies vel diam eu consequat. Curabitur vitae pellentesque nibh. Nullam eu congue risus, sit amet lobortis neque. Etiam vehicula eu justo interdum consectetur. Morbi dolor enim, venenatis eu porta vel, bibendum facilisis quam.</p>\r\n<p>\r\n	Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Proin in urna vitae velit auctor cursus id nec metus. Nunc interdum ultricies rutrum. Donec lorem purus, suscipit in cursus nec, venenatis eget quam. Aliquam eget consectetur metus. Proin dictum tristique risus, quis vestibulum enim elementum sit amet. Morbi convallis orci purus, at gravida elit dignissim eget. Cras molestie scelerisque ipsum, at eleifend risus eleifend non. Aenean vel dui a sem iaculis feugiat. Curabitur venenatis nulla ac velit vehicula, gravida porta nibh tincidunt.</p>\r\n<p>\r\n	Maecenas laoreet metus rhoncus condimentum tristique. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec ullamcorper eu orci ut interdum. Donec eros quam, suscipit ac lacus ac, suscipit condimentum nibh. Phasellus rutrum accumsan ante, eget malesuada metus dapibus vitae. Fusce at magna non dui viverra pharetra vitae sed mi. Sed vehicula, neque at tempor blandit, nunc tellus consequat ante, et lobortis sapien nunc vitae sem.</p>\r\n<p>\r\n	Aliquam tincidunt ligula sed nulla pellentesque, eu porta augue posuere. Nullam eu lobortis mi. Cras imperdiet libero eu ultricies viverra. Suspendisse auctor nisl ut lacus iaculis posuere sit amet a orci. Curabitur urna lacus, porttitor tempus egestas at, gravida et nisi. Maecenas eget aliquet mauris. Nam bibendum sodales tortor non tincidunt.</p>', '', 'http://www.hqoboi.com/img/other/internet-kartinka-007.jpg'),
(7, 2, 'Раздел 1', 'Розділ 1', 1, 'Категория 1', 'Категорія 1', 0, 'Без подкатегории', 'Без підкатегорії', '1111', '1', '1', '1', 3, 'mladi', 1406212424, '<p>\r\n	1</p>', '<p>\r\n	1</p>', '1'),
(8, 3, 'Раздел 2', 'Розділ 2', 0, 'Без категории', 'Без категорії', 0, 'Без подкатегории', 'Без підкатегорії', '1', '1', '1', '1', 3, 'mladi', 1406212795, '<p>\r\n	1</p>', '<p>\r\n	1</p>', '1');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `nameUa` text NOT NULL,
  `capture` varchar(255) DEFAULT NULL,
  `answers` text NOT NULL,
  `answersUa` text NOT NULL,
  `type` int(2) NOT NULL,
  `topicId` int(3) NOT NULL,
  `answerRight` varchar(255) NOT NULL,
  `cost` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=62 ;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `name`, `nameUa`, `capture`, `answers`, `answersUa`, `type`, `topicId`, `answerRight`, `cost`) VALUES
(1, 'От которого полуострова отправились в плавание корабли экспедиций под командованием Х. Колумба и Ф. Магеллана?', 'Від якого півострова вирушили у плавання кораблі експедицій під командуванням Х. Колумба і Ф. Магеллана?', '', 'a:4:{i:0;s:27:"Cкандинавского";i:1;s:24:"Пиренейского";i:2;s:24:"Апеннинского";i:3;s:22:"Балканского";}', 'a:4:{i:0;s:30:"Скандинавського";i:1;s:26:"Піренейського";i:2;s:26:"Апеннінського";i:3;s:24:"Балканського";}', 0, 1, '0', 1),
(2, 'Буквой обозначено место Земли на орбите в то время, когда в Украине наименьшая продолжительность светового дня?', 'Якою буквою позначено місце Землі на орбіті в той час, коли в Україні найменша тривалість світлового дня?', 'http://zno-online.com/test/geo/img/test2013main1/task2.gif', 'a:4:{i:0;s:1:"A";i:1;s:2:"Б";i:2;s:2:"В";i:3;s:2:"Г";}', 'a:4:{i:0;s:2:"А";i:1;s:2:"Б";i:2;s:2:"В";i:3;s:2:"Г";}', 0, 1, '0', 1),
(3, 'Установите соответствие между группой отраслей хозяйства и их месту в экономике Соединенных Штатов Америки.', 'Установіть відповідність між групою галузей господарства та їхнім місцем в економіці Сполучених Штатів Америки.', '', 'a:9:{i:1;s:47:"торговля, банковское дело";s:1:"A";s:105:"старые отрасли экономики, традиционно играют важную роль";i:2;s:71:"маркетинг, высокие технологии (хай-тек)";s:1:"B";s:104:"отрасли, обеспечивающие страну продовольствием и сырьем";i:3;s:78:"черная металлургия, легкая промышленность";s:1:"C";s:125:"новые отрасли промышленности, которые сосредоточены в технополисах";i:4;s:85:"электронное и авиакосмическое машиностроения";s:1:"D";s:61:"традиционные отрасли сферы услуг";s:1:"E";s:109:"новые отрасли сферы услуг, активно развиваются с конца ХХ в.";}', 'a:9:{i:1;s:51:"торгівля, банківська справа";s:1:"A";s:114:"старі галузі економіки, що традиційно відіграють важливу роль";i:2;s:69:"маркетинг, високі технології (хай-тек)";s:1:"B";s:107:"галузі, що забезпечують країну продовольством і сировиною";i:3;s:70:"чорна металургія, легка промисловість";s:1:"C";s:111:"новітні галузі промисловості, що зосереджені в технополісах";i:4;s:81:"електронне та авіакосмічне машинобудування";s:1:"D";s:57:"традиційні галузі сфери послуг";s:1:"E";s:116:"нові галузі сфери послуг, що активно розвиваються з кінця ХХ ст.";}', 2, 1, 'a:4:{i:1;s:1:"0";i:2;s:1:"1";i:3;s:1:"2";i:4;s:1:"3";}', 2),
(4, 'В одном из районов условной страны является город М - многоотраслевой промышленный узел, а рядом с ним - значительно меньше по величине город N, в котором функционирует предприятие тяжелого машиностроения. Основная продукция этого предприятия - представляет, крупногабаритное горношахтное оборудование. Проанализируйте изображенную на рисунке схему территориальной структуры промышленности этого района. Специализацию машиностроительного предприятия обусловлено тем, что город N расположено', 'В одному з районів умовної країни є місто М – багатогалузевий промисловий вузол, а поряд з ним – значно менше за кількістю населення місто N, у якому функціонує підприємство важкого машинобудування. Основна продукція цього підприємства – нескладне, великогабаритне гірничошахтне устаткування. Проаналізуйте зображену на рисунку схему територіальної структури промисловості цього району. Спеціалізацію машинобудівного підприємства зумовлено тим, що місто N розташоване', 'http://zno-online.com/test/geo/img/test2013main1/task52.gif', 'a:6:{i:1;s:158:"в районе с высокой концентрацией предприятий угольной и железорудной промышленности.";i:2;s:82:"у реки - основного источника водных ресурсов.";i:3;s:135:"близко к центру черной металлургии, где производится чугун, сталь, прокат.";i:4;s:198:"с возможностью кооперации с металлообрабатывающим и тракторостроительные предприятиями соседнего города.";i:5;s:119:"на значительном расстоянии от мощных источников электроэнергии.";i:6;s:72:"на трассе магистрального нефтепровода.";}', 'a:6:{i:1;s:160:"у районі з високою концентрацією підприємств вугільної та залізорудної промисловості.";i:2;s:88:"біля річки – основного джерела водних ресурсів.";i:3;s:135:"близько до центру чорної металургії, де виробляється чавун, сталь, прокат.";i:4;s:178:"з можливістю кооперування з металообробним і тракторобудівним підприємствами сусіднього міста.";i:5;s:103:"на значній відстані від потужних джерел електроенергії.";i:6;s:70:"на трасі магістрального нафтопроводу.";}', 3, 1, '1,2,3', 1),
(5, 'В таблице представлена ​​информация о среднемесячной температуры воздуха на одной из метеорологических станций. Определите годовую амплитуду колебаний температуры воздуха.', 'У таблиці подано інформацію про середньомісячну температуру повітря на одній з метеорологічних станцій. Визначте річну амплітуду коливань температури повітря.', 'http://zno-online.com/test/geo/img/test2013main1/task56.gif', '', '', 4, 1, '1', 2),
(42, 'Вопрос на русском', 'Питання росiйською', 'http://zno-online.com/test/geo/img/test2013main1/task2.gif', 'a:4:{i:0;s:32:"Ответ на русском 1";i:1;s:32:"Ответ на русском 2";i:2;s:32:"Ответ на русском 3";i:3;s:33:"Ответ на русском 4 ";}', 'a:4:{i:0;s:38:"Вiдповiдь росiйською 1";i:1;s:38:"Вiдповiдь росiйською 2";i:2;s:38:"Вiдповiдь росiйською 3";i:3;s:38:"Вiдповiдь росiйською 4";}', 0, 1, '0', 1),
(43, 'Вопрос на русском 2', 'Питання росiйською 2 ', 'http://zno-online.com/test/geo/img/test2013main1/task2.gif', 'a:4:{i:0;s:32:"Ответ на русском 1";i:1;s:32:"Ответ на русском 2";i:2;s:32:"Ответ на русском 3";i:3;s:33:"Ответ на русском 4 ";}', 'a:4:{i:0;s:38:"Вiдповiдь росiйською 1";i:1;s:38:"Вiдповiдь росiйською 2";i:2;s:38:"Вiдповiдь росiйською 3";i:3;s:38:"Вiдповiдь росiйською 4";}', 0, 1, '0', 1),
(44, 'Вопрос на русском 3', 'Питання росiйською 3', '', 'a:4:{i:0;s:32:"Ответ на русском 1";i:1;s:32:"Ответ на русском 2";i:2;s:32:"Ответ на русском 3";i:3;s:33:"Ответ на русском 4 ";}', 'a:4:{i:0;s:38:"Вiдповiдь росiйською 1";i:1;s:38:"Вiдповiдь росiйською 2";i:2;s:38:"Вiдповiдь росiйською 3";i:3;s:38:"Вiдповiдь росiйською 4";}', 0, 1, '0', 1),
(45, 'Вопрос на русском 4', 'Питання росiйською 4', '', 'a:4:{i:0;s:32:"Ответ на русском 1";i:1;s:32:"Ответ на русском 2";i:2;s:32:"Ответ на русском 3";i:3;s:33:"Ответ на русском 4 ";}', 'a:4:{i:0;s:38:"Вiдповiдь росiйською 1";i:1;s:38:"Вiдповiдь росiйською 2";i:2;s:38:"Вiдповiдь росiйською 3";i:3;s:38:"Вiдповiдь росiйською 4";}', 0, 1, '0', 1),
(46, 'Вопрос на русском средний уровень', 'Питання росiйською середній рівень', '', 'a:9:{i:1;s:12:"Номер 1";i:2;s:12:"Номер 2";i:3;s:12:"Номер 3";i:4;s:13:"Номер 4 ";s:1:"A";s:17:"Вариант А";s:1:"B";s:17:"Вариант Б";s:1:"C";s:17:"Вариант В";s:1:"D";s:17:"Вариант Г";s:1:"E";s:17:"Вариант Д";}', 'a:9:{i:1;s:19:"номер 1 укр";i:2;s:19:"номер 2 укр";i:3;s:19:"номер 3 укр";i:4;s:19:"номер 4 укр";s:1:"A";s:17:"варіант А";s:1:"B";s:17:"варіант Б";s:1:"C";s:17:"варіант В";s:1:"D";s:17:"варіант Г";s:1:"E";s:17:"варіант Д";}', 2, 1, 'a:4:{i:1;d:0;i:2;d:1;i:3;d:2;i:4;d:3;}', 1),
(47, 'Вопрос на русском 2 средний уровень', 'Питання росiйською 2  середній рівень', '', 'a:9:{i:1;s:12:"Номер 1";i:2;s:12:"Номер 2";i:3;s:12:"Номер 3";i:4;s:13:"Номер 4 ";s:1:"A";s:17:"Вариант А";s:1:"B";s:17:"Вариант Б";s:1:"C";s:17:"Вариант В";s:1:"D";s:17:"Вариант Г";s:1:"E";s:17:"Вариант Д";}', 'a:9:{i:1;s:19:"номер 1 укр";i:2;s:19:"номер 2 укр";i:3;s:19:"номер 3 укр";i:4;s:19:"номер 4 укр";s:1:"A";s:17:"варіант А";s:1:"B";s:17:"варіант Б";s:1:"C";s:17:"варіант В";s:1:"D";s:17:"варіант Г";s:1:"E";s:17:"варіант Д";}', 2, 1, 'a:4:{i:1;d:0;i:2;d:1;i:3;d:2;i:4;d:3;}', 1),
(48, 'Вопрос на русском 3 средний уровень', 'Питання росiйською 3 середній рівень', '', 'a:9:{i:1;s:12:"Номер 1";i:2;s:12:"Номер 2";i:3;s:12:"Номер 3";i:4;s:13:"Номер 4 ";s:1:"A";s:17:"Вариант А";s:1:"B";s:17:"Вариант Б";s:1:"C";s:17:"Вариант В";s:1:"D";s:17:"Вариант Г";s:1:"E";s:17:"Вариант Д";}', 'a:9:{i:1;s:19:"номер 1 укр";i:2;s:19:"номер 2 укр";i:3;s:19:"номер 3 укр";i:4;s:19:"номер 4 укр";s:1:"A";s:17:"варіант А";s:1:"B";s:17:"варіант Б";s:1:"C";s:17:"варіант В";s:1:"D";s:17:"варіант Г";s:1:"E";s:17:"варіант Д";}', 2, 1, 'a:4:{i:1;d:0;i:2;d:1;i:3;d:2;i:4;d:3;}', 1),
(49, 'Вопрос на русском 4 средний уровень', 'Питання росiйською 4 середній рівень', '', 'a:9:{i:1;s:12:"Номер 1";i:2;s:12:"Номер 2";i:3;s:12:"Номер 3";i:4;s:13:"Номер 4 ";s:1:"A";s:17:"Вариант А";s:1:"B";s:17:"Вариант Б";s:1:"C";s:17:"Вариант В";s:1:"D";s:17:"Вариант Г";s:1:"E";s:17:"Вариант Д";}', 'a:9:{i:1;s:19:"номер 1 укр";i:2;s:19:"номер 2 укр";i:3;s:19:"номер 3 укр";i:4;s:19:"номер 4 укр";s:1:"A";s:17:"варіант А";s:1:"B";s:17:"варіант Б";s:1:"C";s:17:"варіант В";s:1:"D";s:17:"варіант Г";s:1:"E";s:17:"варіант Д";}', 2, 1, 'a:4:{i:1;d:0;i:2;d:1;i:3;d:2;i:4;d:3;}', 1),
(54, 'Вопрос на русском тяжелый уровень', 'Питання росiйською \nважкий рівень', 'http://zno-online.com/test/geo/img/test2013main1/task2.gif', 'a:6:{i:1;s:12:"Номер 1";i:2;s:12:"Номер 2";i:3;s:12:"Номер 3";i:4;s:12:"Номер 4";i:5;s:12:"Номер 5";i:6;s:12:"Номер 6";}', 'a:6:{i:1;s:19:"Номер 1 укр";i:2;s:19:"Номер 2 укр";i:3;s:18:"Номер3 укр";i:4;s:19:"Номер 4 укр";i:5;s:19:"Номер 5 укр";i:6;s:19:"Номер 6 укр";}', 3, 1, '1,2,3', 1),
(55, 'Вопрос на русском 2 тяжелый уровень', 'Питання росiйською 2  \nважкий рівень', 'http://zno-online.com/test/geo/img/test2013main1/task2.gif', 'a:6:{i:1;s:12:"Номер 1";i:2;s:12:"Номер 2";i:3;s:12:"Номер 3";i:4;s:12:"Номер 4";i:5;s:12:"Номер 5";i:6;s:12:"Номер 6";}', 'a:6:{i:1;s:19:"Номер 1 укр";i:2;s:19:"Номер 2 укр";i:3;s:18:"Номер3 укр";i:4;s:19:"Номер 4 укр";i:5;s:19:"Номер 5 укр";i:6;s:19:"Номер 6 укр";}', 3, 1, '1,2,3', 1),
(56, 'Вопрос на русском 3 тяжелый уровень', 'Питання росiйською 3 \nважкий рівень', '', 'a:6:{i:1;s:12:"Номер 1";i:2;s:12:"Номер 2";i:3;s:12:"Номер 3";i:4;s:12:"Номер 4";i:5;s:12:"Номер 5";i:6;s:12:"Номер 6";}', 'a:6:{i:1;s:19:"Номер 1 укр";i:2;s:19:"Номер 2 укр";i:3;s:18:"Номер3 укр";i:4;s:19:"Номер 4 укр";i:5;s:19:"Номер 5 укр";i:6;s:19:"Номер 6 укр";}', 3, 1, '1,2,3', 1),
(57, 'Вопрос на русском 4 тяжелый уровень', 'Питання росiйською 4 \nважкий рівень', '', 'a:6:{i:1;s:12:"Номер 1";i:2;s:12:"Номер 2";i:3;s:12:"Номер 3";i:4;s:12:"Номер 4";i:5;s:12:"Номер 5";i:6;s:12:"Номер 6";}', 'a:6:{i:1;s:19:"Номер 1 укр";i:2;s:19:"Номер 2 укр";i:3;s:18:"Номер3 укр";i:4;s:19:"Номер 4 укр";i:5;s:19:"Номер 5 укр";i:6;s:19:"Номер 6 укр";}', 3, 1, '1,2,3', 1),
(58, 'Вопрос на русском Задача', 'Питання росiйською  Задача', 'http://zno-online.com/test/geo/img/test2013main1/task2.gif', '', '', 4, 1, '1', 1),
(59, 'Вопрос на русском 2  Задача', 'Питання росiйською 2   Задача', 'http://zno-online.com/test/geo/img/test2013main1/task2.gif', '', '', 4, 1, '1', 1),
(60, 'Вопрос на русском 3  Задача', 'Питання росiйською 3  Задача', '', '', '', 4, 1, '1', 1),
(61, 'Вопрос на русском 4  Задача', 'Питання росiйською 4  Задача', '', '', '', 4, 1, '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE IF NOT EXISTS `result` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `userId` int(10) NOT NULL,
  `test` varchar(255) NOT NULL,
  `testUa` varchar(255) NOT NULL,
  `testId` int(10) NOT NULL,
  `result` varchar(255) NOT NULL,
  `date` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `group` varchar(255) NOT NULL,
  `groupUa` varchar(255) NOT NULL,
  `groupId` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`id`, `user`, `userId`, `test`, `testUa`, `testId`, `result`, `date`, `time`, `group`, `groupUa`, `groupId`, `type`) VALUES
(1, 'mladi', 3, 'Тест №3', 'Тест №3', 3, '2', 1406295789, 6, 'Группа №2', 'Група №2', 2, 'rating'),
(3, 'mladi', 3, 'Тест №5', 'Тест №5', 4, '2', 1406295948, 6, 'Группа №2', 'Група №2', 2, 'rating'),
(4, 'mladi2', 8, 'Тест №3', 'Тест №3', 3, '2', 1406296060, 5, 'Группа №2', 'Група №2', 2, 'rating'),
(5, 'mladi2', 8, 'Тест №5', 'Тест №5', 4, '1', 1406296081, 6, 'Группа №2', 'Група №2', 2, 'rating'),
(6, 'mladi', 3, 'Тест №6', 'Тест №6', 5, '4', 1406297300, 8, 'Группа №2', 'Група №2', 2, 'rating');

-- --------------------------------------------------------

--
-- Table structure for table `resulttest`
--

CREATE TABLE IF NOT EXISTS `resulttest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `bool` int(2) NOT NULL,
  `testId` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE IF NOT EXISTS `subcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `nameUa` varchar(255) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `name`, `nameUa`, `categoryId`, `userId`) VALUES
(1, 'Подкатегория 1', 'Подкатегория 1 укр', 1, 3),
(2, 'Подкатегория 2', 'Подкатегория 2 укр', 1, 3),
(3, 'Подкатегория 3', 'Подкатегория 3 укр', 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `int` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `nameUa` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `userId` int(11) NOT NULL,
  `topicId` int(11) NOT NULL,
  `comments` varchar(255) NOT NULL,
  PRIMARY KEY (`int`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`int`, `name`, `nameUa`, `author`, `userId`, `topicId`, `comments`) VALUES
(1, 'Тест №1', 'Тест №2', 'mladi', 3, 1, 'ррррр'),
(2, 'Тест №2', 'Тест №2', 'mladi', 3, 1, 'ывсы'),
(3, 'Тест №3', 'Тест №3', 'mladi', 3, 0, 'й'),
(4, 'Тест №5', 'Тест №5', 'mladi', 3, 0, 'q'),
(5, 'Тест №6', 'Тест №6', 'mladi', 3, 0, 'в');

-- --------------------------------------------------------

--
-- Table structure for table `testquestionrel`
--

CREATE TABLE IF NOT EXISTS `testquestionrel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `testId` int(11) NOT NULL,
  `questionId` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `testquestionrel`
--

INSERT INTO `testquestionrel` (`id`, `testId`, `questionId`, `number`) VALUES
(1, 1, 1, 1),
(2, 1, 4, 2),
(3, 1, 5, 3),
(4, 2, 1, 1),
(5, 2, 2, 2),
(6, 2, 3, 3),
(7, 3, 1, 1),
(8, 3, 2, 2),
(9, 4, 1, 1),
(10, 4, 2, 2),
(11, 5, 1, 1),
(12, 5, 2, 2),
(13, 5, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE IF NOT EXISTS `topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `nameUa` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`id`, `name`, `nameUa`) VALUES
(0, 'Итоговый тест', 'Підсумковий тест'),
(1, 'Домашнее задание', 'Домашнє завдання'),
(6, '6 класс', '6 клас'),
(7, '7 класс', '7 клас'),
(8, '8 класс', '8 клас'),
(9, '9 класс', '9 клас'),
(10, '10 класс', '10 клас'),
(11, '11 класс', '11 клас');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `class` varchar(255) DEFAULT NULL,
  `letter` varchar(255) DEFAULT NULL,
  `result` int(11) DEFAULT NULL,
  `group` varchar(255) DEFAULT NULL,
  `groupId` int(11) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `photo` text,
  `date_birth` int(11) DEFAULT NULL,
  `date_reg` int(11) DEFAULT NULL,
  `date_log` int(11) DEFAULT NULL,
  `role` varchar(40) DEFAULT NULL,
  `vk` int(11) DEFAULT NULL,
  `fc` int(11) DEFAULT NULL,
  `tw` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `class`, `letter`, `result`, `group`, `groupId`, `gender`, `photo`, `date_birth`, `date_reg`, `date_log`, `role`, `vk`, `fc`, `tw`) VALUES
(3, 'mladi', 'd1c07866d71dc3a09b3b692d0a2086b4', 'dda@ndas.ue', '', '', 8, 'Группа №2', 2, 'Female', 'https://cdn1.iconfinder.com/data/icons/pretty-office-10/128/Teacher-female-128.png', NULL, 1404724479, NULL, 'admin', 100474397, 2147483647, 371868455),
(7, 'admin', 'b59c67bf196a4758191e42f76670ceba', 'mladi2010@yandex.ru', '', '', NULL, 'Группа №1', 3, 'Male', '', NULL, 1405409245, NULL, 'guest', 0, 0, 0),
(8, 'mladi2', 'b59c67bf196a4758191e42f76670ceba', 'mladi2010@yandex.ru', '', '', 3, 'Группа №2', 2, 'Male', '', NULL, 1405948296, NULL, 'guest', 0, 0, 0),
(9, 'mladi3', 'b59c67bf196a4758191e42f76670ceba', 'mladi2010@yandex.ru', '7', 'В', NULL, NULL, NULL, 'Female', '', NULL, 1406291658, NULL, 'guest', 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
