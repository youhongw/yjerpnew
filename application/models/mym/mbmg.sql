/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50141
Source Host           : 192.168.1.8:3306
Source Database       : mbmg

Target Server Type    : MYSQL
Target Server Version : 50141
File Encoding         : 65001   MyISAM

Date: 2010-11-15 16:59:01
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT '表ID',
  `uname` varchar(50) DEFAULT NULL COMMENT '用户名',
  `usex` varchar(4) DEFAULT NULL COMMENT '性别',
  `utel` varchar(20) DEFAULT NULL COMMENT '电话',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '白虎', '男', '10001');
INSERT INTO `users` VALUES ('2', '月女', '男', '10002');
INSERT INTO `users` VALUES ('3', '老牛', '男', '10003');
INSERT INTO `users` VALUES ('4', '流浪', '男', '10004');
INSERT INTO `users` VALUES ('5', '赏金猎人', '男', '10005');
INSERT INTO `users` VALUES ('6', '火女', '女', '10006');
INSERT INTO `users` VALUES ('7', '冰女', '女', '10007');
INSERT INTO `users` VALUES ('8', '巫妖', '女', '10008');
INSERT INTO `users` VALUES ('9', '潮汐猎人', '男', '10009');
INSERT INTO `users` VALUES ('10', '兔子', '女', '10010');
INSERT INTO `users` VALUES ('11', '末日使者', '男', '10011');
INSERT INTO `users` VALUES ('12', '幽鬼', '男', '10012');
INSERT INTO `users` VALUES ('13', '奥巴马', '男', '10013');
INSERT INTO `users` VALUES ('14', 'qwe1213', '男', '10014');
INSERT INTO `users` VALUES ('15', 'du', '女', '10015');
INSERT INTO `users` VALUES ('16', '娃娃狗', '女', '10016');
