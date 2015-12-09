-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 12 月 09 日 18:41
-- 服务器版本: 5.5.40
-- PHP 版本: 5.3.29

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `class2nd`
--
CREATE DATABASE `class2nd` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `class2nd`;

-- --------------------------------------------------------

--
-- 表的结构 `nd_category`
--

CREATE TABLE IF NOT EXISTS `nd_category` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `nd_category`
--

INSERT INTO `nd_category` (`id`, `name`) VALUES
(1, '计算机'),
(2, '经济管理'),
(3, '艺术与设计'),
(4, '语言'),
(5, '人文'),
(6, '教育'),
(7, '社会科学'),
(8, '影视与音乐'),
(9, '数学与统计'),
(10, '电子'),
(11, '物理'),
(12, '化学'),
(13, '医药与健康'),
(14, '食品与营养'),
(15, '法律'),
(16, '环境与能源'),
(17, '其他');

-- --------------------------------------------------------

--
-- 表的结构 `nd_checkcode`
--

CREATE TABLE IF NOT EXISTS `nd_checkcode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(40) NOT NULL,
  `code` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `nd_checkcode`
--

INSERT INTO `nd_checkcode` (`id`, `email`, `code`) VALUES
(3, '1125185832@qq.com', 79315490);

-- --------------------------------------------------------

--
-- 表的结构 `nd_comment`
--

CREATE TABLE IF NOT EXISTS `nd_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `text` varchar(300) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `nd_comment`
--

INSERT INTO `nd_comment` (`id`, `cid`, `uid`, `username`, `text`, `time`) VALUES
(1, 20, 1, 'Round', '这个是课程评论测试1', 1449310825),
(2, 20, 2, 'zkw721249', '这是评论测试2', 1449310871),
(3, 15, 2, 'zkw721249', '这是评论测试3', 1449310810),
(4, 15, 1, 'Round', '这是评论测试4', 1449310000),
(5, 20, 4, 'hpf', '评论测试5', 1449311708),
(6, 20, 3, 'hupengfei', '评论测试6', 1449301708),
(7, 15, 3, 'hupengfei', '评论测试5', 1449311708),
(11, 10, 2, 'zkw721249', '测试评论', 1449386765),
(12, 9, 1, 'Round', '这是个评论3', 1449484397),
(13, 3, 1, 'Round', '评论测试4', 1449484425);

-- --------------------------------------------------------

--
-- 表的结构 `nd_course`
--

CREATE TABLE IF NOT EXISTS `nd_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL COMMENT '分类id',
  `uid` int(11) NOT NULL DEFAULT '1' COMMENT '课程创建人ID',
  `title` varchar(30) NOT NULL COMMENT '课程题目',
  `desc` varchar(300) NOT NULL COMMENT '描述',
  `img` varchar(50) NOT NULL COMMENT '课程图片',
  `score` int(11) NOT NULL DEFAULT '0' COMMENT '总评分',
  `score_num` int(11) NOT NULL DEFAULT '0' COMMENT '评分人数',
  `join_num` int(11) NOT NULL DEFAULT '0' COMMENT '参与人数',
  `time` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- 转存表中的数据 `nd_course`
--

INSERT INTO `nd_course` (`id`, `cid`, `uid`, `title`, `desc`, `img`, `score`, `score_num`, `join_num`, `time`) VALUES
(2, 1, 1, '数据库原理及其应用技术', '本课程的任务是使学生掌握SQL Server数据库系统应用维护的基本知识和初步的数据库设计、开发能力。包括SQL Server的体系结构，安全性管理、简单备份还原，Transact-SQL基础和C#开发等内容', '20151204/4324324444.png', 554, 77, 68, 1449226361),
(3, 1, 1, 'Java程序设计', '“Java程序设计”是理工类专业计算机教育的核心必修课程。通过本课程的学习，使学生理解面向对象程序设计的基本概念，掌握面向对象程序设计的基本思想和方法；具备初步的面向对象程序设计和调试能力，可以为学生进一步学习其他专业课程和今后从事软件开发工作打下坚实的基础。', '20151204/3456543245.png', 457, 57, 91, 1449226362),
(4, 1, 1, ' Android移动开发基础篇', '本课程将详细讲解Android的应用框架、用户界面、数据存储、多媒体开发等基础知识，课程的教学重点和难点在于如何能很好的理解Android移动开发过程的注意事项，掌握Android移动开发的技巧，并且在实际项目中得到应用；提高学生综合分析问题、解决问题的能力。', '20151204/9888773411.png', 856, 96, 63, 1449226311),
(5, 1, 1, 'C语言程序设计', '“C语言程序设计”是大学理工类专业计算机教育的核心、必修课程。通过本课程的学习，使学生理解程序设计的基本概念，掌握程序设计的基本思想和方法；具备初步的程序设计和调试能力，可以为学生进一步学习其他专业课程和今后从事软件开发工作打下坚实的基础。', '20151204/1234554321.png', 834, 105, 89, 1449226320),
(6, 1, 1, 'C++程序设计', '通过本课程的学习，掌握面向对象程序的基本概念、特点、结构、原理及设计方法。学习C++面向对象程序设计的相...', '20151204/1234567890.png', 755, 87, 86, 1449226369),
(7, 1, 1, '大学计算机基础', '《大学计算机基础》是新生的第一门计算机基础课程，也是大学生入学后首先接受的计算机相关知识与操作技能的导引性基础教育。课程内容注重计算思维能力培养为主导的计算机基础知识、计算机网络基础知识和实际操作计算机能力的培养。', '20151204/3333333323.png', 357, 58, 33, 1449226000),
(8, 1, 1, '数据结构', '本课程是是计算机科学与技术等工程信息类专业的主干基础课程，是一门专业技术 基础课，在相关专业的课程体系中始终处于核心地位，也是计算机科学与技术等相关专业考研的必考科目。目前也有许多学校将本课程列为理工科类专业的公共基础课，因其知识内容是计算机科学的关键基础，是操作系统、数据库原理、算法分析与设计、编译原理、图形图像处理、Web信息处理等后续课程以及为研制开发各种系统和应用软件的基石，是计算机软件设计的敲门砖，它对培养学习者的数据抽象能力和程序设计能力承载着非常巨大的重任', '20151204/3233124546.png', 844, 97, 75, 1449226361),
(9, 1, 1, ' Internet与网页设计', '本课程以HTML和CSS为蓝本，全面介绍与WEB及网页设计制作有关的知识，向学生阐明与互联网相关的一些基本概念及Web的基本工作机制，并使学生具有解决一般网页制作问题的能力。与此同时，通过对Web网页制作技术、制作工具及互联网常用工具的学习使用，使学生对于建立WEB站点所涉及的相关知识有一个全面的了解。', '20151204/3452231535.png', 953, 108, 103, 1449226309),
(10, 1, 1, 'C#程序设计', '《C#程序设计》是计算机相关专业的一门重要专业技术基础课程，也是一门实践性很强的课程。其主要任务是掌握C#.NET的基本知识和技能，使学生掌握利用C#.NET开发应用程序的能力。其前导课程有“C语言程序设计”，后续课程是“数据访问技术--ADO.NET(C# )”、“Windows应用开发(C# )”，“WEB应用开发-ASP.NET (C# )” 、 “软件测试”、“软件工程”等课程。', '20151204/1123333321.png', 159, 25, 101, 1449221361),
(11, 1, 1, '数据结构与算法', '《数据结构与算法》是计算机、电子等学科的重要基础课，它包括基础数据结构与常规算法设计技术两部分。基础数据结构主要介绍如何合理地组织数据、有效地存储和处理数据，并详细介绍相应实现算法的时间与空间渐进复杂度的分析方法；算法设计技术主要介绍基于基础数据结构的高级应用及各类常规算法设计实现技术。', '20151204/6748394493.png', 556, 67, 100, 1449206361),
(12, 1, 1, '软件项目管理', '《软件项目管理》是软件工程专业开设的专业课程，首次采用了SPOC教学模式，以培养软件项目管理能力为目的，本课程以路线图的形式讲述了软件项目管理的理论、方法以及技巧，包括项目初始、项目计划、项目执行控制、项目结束', '20151204/4444332222.png', 660, 86, 101, 1449210000),
(13, 1, 1, '大学计算机基础', '《大学计算机基础》是新生的第一门计算机基础课程，也是大学生入学后首先接受的计算机相关知识与操作技能的导引性基础教育。课程内容注重计算思维能力培养为主导的计算机基础知识、计算机网络基础知识和实际操作计算机能力的培养。', '20151204/3333333323.png', 954, 99, 115, 1449126362),
(14, 1, 1, '数据库应用——以Oracle为例', '本课程的任务是使学生掌握Oracle数据库系统的基本知识，为使用Oracle数据库进行程序设计打好基础。通过本课程学习，学生应了解Oracle的体系结构，掌握手动安装Oracle数据库并进行网络配置的方法，熟悉Oracle数据库关键文件的管理，能够使用数据字典查询数据库的各类信息，掌握数据库的用户权限指派和收回，并能进行简单的备份还原操作。', '20151204/9088199239.png', 855, 106, 122, 1449222361),
(15, 1, 1, '程序设计课程设计', '程序设计课程设计是一门基于C++、C、Java等语言程序设计的教学实践课。当前电子信息行业与IT的深度结合，培养程序设计思想、提高面向应用实现程序设计解决问题的能力至关重要。开设本课程，为了更好地适应电子信息类科学发展形势，适应计算机应用型人才的培养要求，与产业现状接轨，为后续课程的学习打下坚实的基础。', '20151204/2342432555.png', 961, 127, 155, 1449206361),
(16, 1, 1, '计算机与计算思维导论', '《大学计算机基础》是新生的第一门计算机基础课程，也是大学生入学后首先接受的计算机相关知识与操作技能的导引性基础教育。课程内容注重计算思维能力培养为主导的计算机基础知识、计算机网络基础知识和实际操作计算机能力的培养。', '20151204/5435516463.png', 355, 52, 73, 1449226310),
(17, 1, 1, ' WEB应用程序设计(.NET)', '本课程的任务是使学生全面掌握ASP.NET的基本知识，包括Visual Studio集成开发环境、ASP.NET应用程序生命周期、ASP.NET网页生命周期、Page类的内置对象、Web应用程序的异常处理、ASP.NET服务器控件、Web应用程序状态管理、页面外观设计与布局、站点导航技术、ADO.NET数据库访问技术、ASP.NET的数据绑定及绑定控件、安全管理、Web服务、Ajax技术和Web应用程序的部署等内容，并初步了解三层架构技术', '20151204/1235543522.png', 584, 75, 99, 1449226016),
(18, 1, 1, ' 计算机网络', '本课程的主要目标是培养学生： 1.系统地学习和掌握计算机网络的主要基础知识。 2.掌握计算机网络的体系结构及在Internet中各层协议的工作原理和功能。 3.掌握计算机网络的基础知识，计算机网络的体系结构，各层的功能及一般原理。 4.掌握计算机网络的基本理论和技术方法，网络协议的原理和分析方法。 5.学习并掌握互联网思维方法。', '20151204/1121212143.png', 859, 97, 112, 1449219361),
(19, 1, 1, 'R语言程序开发', '通过这门课，你将学习如何用R编程以及用R高效分析数据。你将学会如何安装和配置统计编程所需的软件环境，还有泛型程序语言的概念，毕竟程序是用高级统计语言开发的。本课涵盖统计计算中的实际问题，包括R语言编程、读取数据到R、访问R软件包、写R函数、调试、分析R源码以及整理和注释R源码。在统计数据分析的专题里会提供工作中的实用案例。', '20151204/3422321111.jpg', 1156, 127, 142, 1449222361),
(20, 1, 1, 'HTML5入门', '由于软件程序越来越多，似乎现在任何人都有能力创建一个网页。但是，如果你真的想了解网页到底是如何创建的，应该怎么办？学习网页设计的出色的教材和在线资源随处可见，但是这些资源大部分需要学习者有一定的背景知识。本课程的目的是帮助新手获得信心和知识。我们将探讨其中的理论方面（当你点击网页上的链接时，实际上发生了什么？），实用方面（我需要知道什么，才可以创建自己的网页？aaasdad', '20151208/1331638897.png', 1663, 184, 203, 1449126361),
(21, 1, 1, 'Ruby on Rails：概述', '在这门课程中，我们将探讨如何使用Ruby on Rails 这个Web应用程序框架构建Web应用程序，这个框架就是为了帮助你实现快速原型制作。是的，也就是说快速地创建！这门课程结束时，你将能够使用Heroku 的 PaaS（“平台即服务”）创建一个有意义的Web应用程序并将其部署到“云”端。最重要的是，你会觉得做到这些几乎毫不费力……真的！', '20151204/3399092220.jpg', 231, 26, 42, 1449226370),
(22, 2, 1, '企业财务概论', '本课程提供以现代金融理论基本原则为指导，分析金融决策的框架、概念和工具。您将学习企业金融和投资的用语和关键组件，包括计算现值、债券和股票估值、净现值规则、风险计量、资本预算和资本资产价格模型。学完本课程后，您将能够阅读、理解和解释企业金融管理和投资决策。', '20151204/6666554321.jpg', 356, 55, 80, 1449231740),
(23, 2, 1, '企业战略基础', '在这门课中，我们讲探索成功的商业战略背后的基本原理和知识框架。我们将教授你战略分析的工具以培养你的战略思维。战略分析用于分析企业面临的竞争环境，对企业如何给自身定位以及如何创造最大价值提出理性合理的建议。有抱负的经理人，企业家，社会创业者，分析师和顾问都会在掌握这些基础知识的过程中有所收获', '20151204/3343222333.gif', 276, 41, 63, 1449231892),
(29, 3, 1, '新增测试-修改', '描述测试i', '20151208/1059179666.jpg', 0, 0, 0, 1449570683);

-- --------------------------------------------------------

--
-- 表的结构 `nd_forum`
--

CREATE TABLE IF NOT EXISTS `nd_forum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `message` varchar(300) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `nd_forum`
--

INSERT INTO `nd_forum` (`id`, `vid`, `uid`, `message`, `time`) VALUES
(1, 6, 1, '这是留言测试', 1449638960),
(2, 6, 1, '这是留言测试2', 1449638972),
(3, 6, 2, '这是留言测试3', 1449638979),
(4, 6, 3, '这是留言测试4', 1449638986),
(5, 6, 3, '这是留言测试5', 1449638991),
(6, 6, 1, 'asdadasd', 1449641930),
(7, 6, 1, '阿诗丹顿', 1449642034),
(8, 6, 1, 'asdadsad', 1449645862);

-- --------------------------------------------------------

--
-- 表的结构 `nd_join`
--

CREATE TABLE IF NOT EXISTS `nd_join` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='课程参加记录' AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `nd_join`
--

INSERT INTO `nd_join` (`id`, `uid`, `cid`, `time`) VALUES
(1, 1, 20, 1449321636),
(2, 1, 15, 1449323270),
(3, 1, 19, 1449323430),
(4, 1, 14, 1449323508),
(5, 1, 13, 1449323773),
(6, 1, 11, 1449323912),
(9, 1, 17, 1449324070),
(10, 1, 18, 1449327885),
(11, 1, 9, 1449328055),
(12, 2, 20, 1449379934),
(13, 2, 19, 1449380014),
(14, 2, 17, 1449380476),
(15, 2, 18, 1449384863),
(16, 2, 10, 1449385064),
(17, 1, 3, 1449484412);

-- --------------------------------------------------------

--
-- 表的结构 `nd_score`
--

CREATE TABLE IF NOT EXISTS `nd_score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `score` tinyint(4) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `nd_score`
--

INSERT INTO `nd_score` (`id`, `uid`, `cid`, `score`, `time`) VALUES
(1, 1, 20, 8, 1449325877),
(2, 1, 15, 7, 1449327566),
(3, 1, 19, 9, 1449327646),
(4, 1, 18, 7, 1449327992),
(5, 1, 9, 8, 1449328062),
(6, 2, 20, 9, 1449379986),
(7, 2, 19, 7, 1449380022),
(8, 2, 17, 7, 1449380483);

-- --------------------------------------------------------

--
-- 表的结构 `nd_users`
--

CREATE TABLE IF NOT EXISTS `nd_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL COMMENT '用户名',
  `email` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `nd_users`
--

INSERT INTO `nd_users` (`id`, `username`, `email`, `password`) VALUES
(1, 'Round', 'hpf@betahouse.us', 'baae72b3efebdc19625269f895401e4f'),
(2, 'zkw721249', '1125185832@qq.com', 'baae72b3efebdc19625269f895401e4f'),
(3, 'hupengfei', 'hupengfei@betahouse.us', 'baae72b3efebdc19625269f895401e4f'),
(4, 'hpf', 'h@betahouse.us', 'baae72b3efebdc19625269f895401e4f');

-- --------------------------------------------------------

--
-- 表的结构 `nd_video`
--

CREATE TABLE IF NOT EXISTS `nd_video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL COMMENT '所属课程id',
  `title` varchar(30) NOT NULL COMMENT '视频标题',
  `link` varchar(300) NOT NULL COMMENT '视频链接',
  `sort` tinyint(4) NOT NULL COMMENT '顺序',
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `nd_video`
--

INSERT INTO `nd_video` (`id`, `cid`, `title`, `link`, `sort`, `time`) VALUES
(6, 20, 'HTML5零基础课程(1)-PHPChina学院视频教程', '<embed src="http://player.youku.com/player.php/sid/XNjkxNzAzNjYw/v.swf" allowFullScreen="true" quality="high" width="480" height="400" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash"></embed>', 1, 1449380853),
(4, 20, 'HTML5零基础课程(2)-PHPChina学院视频教程', '<embed src="http://player.youku.com/player.php/sid/XNjkxNzAxMzMy/v.swf" allowFullScreen="true" quality="high" width="480" height="400" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash"></embed>', 2, 1449381854),
(1, 20, 'HTML5入门视频教程（1）新Web设计标准HTML5的历史', '<embed src="http://player.youku.com/player.php/sid/XMzc1Mzc0NjYw/v.swf" allowFullScreen="true" quality="high" width="480" height="400" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash"></embed>', 3, 1449380053),
(9, 20, ' HTML5入门视频教程（2）新的页面组织标记', '<embed src="http://player.youku.com/player.php/sid/XMzc4OTI0OTY4/v.swf" allowFullScreen="true" quality="high" width="480" height="400" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash"></embed>', 4, 1449380300),
(2, 20, 'HTML5入门视频教程（3）智能表单设计', '<embed src="http://player.youku.com/player.php/sid/XMzc4OTI1NzY0/v.swf" allowFullScreen="true" quality="high" width="480" height="400" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash"></embed>', 5, 1449370853),
(11, 29, '测试asdadaddasdad', '<embed src="http://player.youku.com/player.php/sid/XNjkxNzAzNjYw/v.swf" allowFullScreen="true" quality="high" width="480" height="400" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash"></embed>', 2, 1449577243),
(16, 29, 'asda', 'asdasd', 6, 1449579408),
(14, 29, 'asdadasdasd', 'asddddddddddddddddddddddddads', 5, 1449578666);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
