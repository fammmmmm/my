# Host: localhost  (Version: 5.5.53)
# Date: 2020-04-24 16:02:33
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "manager"
#

DROP TABLE IF EXISTS `manager`;
CREATE TABLE `manager` (
  `m_Id` int(11) NOT NULL AUTO_INCREMENT,
  `m_name` varchar(255) DEFAULT NULL COMMENT '姓名',
  `m_jurisdiction` int(1) DEFAULT NULL COMMENT '1.为特别管理拥有所有权限2.为普通管理可添加用户、可拉黑用户、可对用户的数据进行管理',
  PRIMARY KEY (`m_Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='管理员';

#
# Data for table "manager"
#

/*!40000 ALTER TABLE `manager` DISABLE KEYS */;
/*!40000 ALTER TABLE `manager` ENABLE KEYS */;

#
# Structure for table "user"
#

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_Id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) DEFAULT NULL COMMENT '姓名',
  `user_sex` int(1) DEFAULT '1' COMMENT '1.男 2.女',
  `user_brith` datetime DEFAULT NULL COMMENT '出生日期',
  `user_education` int(1) DEFAULT '2' COMMENT '1.高中2.学士3.硕士4.博士5.其它',
  `user_native` varchar(255) DEFAULT NULL COMMENT '籍贯',
  `user_address` varchar(30) DEFAULT NULL COMMENT '地址',
  `user_phone` varchar(20) DEFAULT NULL COMMENT '手机号码',
  `user_seniority` int(2) DEFAULT NULL COMMENT '工龄',
  `user_wages` int(11) DEFAULT NULL COMMENT '基本工资',
  PRIMARY KEY (`user_Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户';

#
# Data for table "user"
#

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
