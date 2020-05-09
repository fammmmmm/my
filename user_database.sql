# Host: localhost  (Version: 5.5.53)
# Date: 2020-05-09 19:51:32
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "user"
#

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_Id` int(11) NOT NULL AUTO_INCREMENT,
  `user_account` varchar(255) DEFAULT NULL COMMENT '账号',
  `user_password` varchar(255) DEFAULT NULL COMMENT '密码 MD5加密',
  `user_name` varchar(255) DEFAULT NULL COMMENT '姓名',
  `user_sex` int(1) DEFAULT '1' COMMENT '1.男 2.女',
  `user_brith` date DEFAULT NULL COMMENT '出生日期',
  `user_education` int(1) DEFAULT '2' COMMENT '1.高中2.学士3.硕士4.博士5.其它',
  `user_native` varchar(255) DEFAULT NULL COMMENT '籍贯',
  `user_address` varchar(30) DEFAULT NULL COMMENT '地址',
  `user_phone` varchar(20) DEFAULT NULL COMMENT '手机号码',
  `user_seniority` int(2) DEFAULT NULL COMMENT '工龄',
  `user_wages` int(11) DEFAULT NULL COMMENT '基本工资',
  `user_manager` int(1) DEFAULT '0' COMMENT '0为非管理 1为管理 2为特权管理',
  PRIMARY KEY (`user_Id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='用户';

#
# Data for table "user"
#

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'xiaoa','25d55ad283aa400af464c76d713c07ad','叶淋潮',1,'1999-07-24',2,'1','zj','17326082311',5,20000,0),(2,'xiaob','25d55ad283aa400af464c76d713c07ad','a',2,'1999-07-24',2,'1','zj','17326082312',2,10000,0),(3,'xiaoc','25d55ad283aa400af464c76d713c07ad','b',2,'1999-07-24',2,'1','zj','17326082313',1,2000,0),(4,'xiaod','25d55ad283aa400af464c76d713c07ad','c',2,'1999-07-24',2,'1','zj','17326082314',7,50000,0),(5,'xiaoe','25d55ad283aa400af464c76d713c07ad','d',1,'1999-07-24',2,'1','zj','17326082315',1,5000,1),(6,'xiaof','25d55ad283aa400af464c76d713c07ad','e',2,'1999-07-24',2,'1','zj','17326082316',10,100000,0),(7,'xiaog','25d55ad283aa400af464c76d713c07ad','f',1,'1999-07-24',2,'1','zj','17326082317',2,4000,1),(8,'xiaoh','25d55ad283aa400af464c76d713c07ad','g',2,'1999-07-24',1,'北京','台州','17326082111',5,36000,2),(9,'xiaoj','25d55ad283aa400af464c76d713c07ad','h',2,'1999-07-24',2,'1','zj','17326082319',3,15000,0),(10,'xiaok','25d55ad283aa400af464c76d713c07ad','i',1,'1999-07-24',2,'1','zj','17326082310',3,12000,0),(11,'aabbbb','25d55ad283aa400af464c76d713c07ad','xiaoaaa',2,'2017-05-01',4,'山西','杭州','13858151973',2,15000,1),(12,'xiaoaaa11123','25d55ad283aa400af464c76d713c07ad','高原宁',1,'2019-12-18',3,'台州','温岭','17326082311',2,14000,0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
