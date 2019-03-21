/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : portal

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-12-28 17:14:34
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for db_cate
-- ----------------------------
DROP TABLE IF EXISTS `db_cate`;
CREATE TABLE `db_cate` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '分类名',
  `icon` varchar(255) DEFAULT NULL COMMENT '图标',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='分类大类表';

-- ----------------------------
-- Records of db_cate
-- ----------------------------
INSERT INTO `db_cate` VALUES ('1', '内部网站', '#icon-neibuzhanghaoguanli', null, null, null);
INSERT INTO `db_cate` VALUES ('2', '对外展示', '#icon-waibulianjie', null, null, null);
INSERT INTO `db_cate` VALUES ('3', '前端', '#icon-qianduan', null, null, null);
INSERT INTO `db_cate` VALUES ('4', '后端', '#icon-houduanicon', null, null, null);
INSERT INTO `db_cate` VALUES ('5', '数据分析', '#icon-shujufenxi', null, null, null);
INSERT INTO `db_cate` VALUES ('6', '数据库', '#icon-shujuku1', null, null, null);
INSERT INTO `db_cate` VALUES ('7', 'VueJS', '#icon-vuejs', null, null, null);
INSERT INTO `db_cate` VALUES ('8', 'Java', '#icon-java1', null, null, null);
INSERT INTO `db_cate` VALUES ('9', 'Python', '#icon-python', null, null, null);
INSERT INTO `db_cate` VALUES ('10', 'Linux', '#icon-linux', null, null, null);
INSERT INTO `db_cate` VALUES ('11', '微信', '#icon-weixin', null, null, null);
INSERT INTO `db_cate` VALUES ('12', 'QQ', '#icon-weixin', '1544779037', null, '1544779079');

-- ----------------------------
-- Table structure for db_company
-- ----------------------------
DROP TABLE IF EXISTS `db_company`;
CREATE TABLE `db_company` (
  `id` int(5) NOT NULL DEFAULT '1',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '公司名称',
  `industry` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '所属行业',
  `features` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '公司性质',
  `regmoney` int(20) DEFAULT NULL COMMENT '注册资金',
  `staffnum` int(10) DEFAULT NULL COMMENT '员工人数',
  `introduce` text COLLATE utf8mb4_unicode_ci COMMENT '公司简介',
  `contact` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '联系人',
  `phonenum` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '联系人电话',
  `adress` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '公司地址',
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '公司邮箱',
  `mainpage` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '公司主页',
  `create_time` int(15) DEFAULT NULL,
  `update_time` int(15) DEFAULT NULL,
  `delete_time` int(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of db_company
-- ----------------------------
INSERT INTO `db_company` VALUES ('1', 'TD', 'IT', '数据挖掘', '100000000', '10000', 'Teradata天睿公司（纽交所代码：TDC），是美国前十大上市软件公司之一。经过逾30 年的发展，Teradata天睿公司已经成为全球最大的专注于大数据分析、数据仓库和整合营销管理解决方案的供应商之一。\n数量庞大、增长迅猛、种类多样的数据已经成为企业在大数据时代发展不得不面临的现实境况。这是挑战，也是机遇。对此，Teradata天睿公司基于客户需求，提供领先、全面、有效的解决方案，帮助企业获取商业洞察力，并且将之转化为行动力，创造商业价值。', '林小姐', '16575559898', '广州市天河区林和西路161号中泰国际广场B座2303 Teradata（地铁广州东站B2出口）', 'teradata@123.com', 'https://www.teradata.com.cn', '1545963121', '1545963121', null);

-- ----------------------------
-- Table structure for db_item
-- ----------------------------
DROP TABLE IF EXISTS `db_item`;
CREATE TABLE `db_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cate_id` int(5) DEFAULT NULL COMMENT '分类ID',
  `name` varchar(255) DEFAULT NULL COMMENT '网站名',
  `url` varchar(255) DEFAULT NULL COMMENT '网站链接',
  `desc` varchar(255) DEFAULT NULL COMMENT '描述',
  `tags` varchar(255) DEFAULT NULL COMMENT '标签',
  `icon` varchar(255) DEFAULT NULL COMMENT '图标链接',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COMMENT='链接表';

-- ----------------------------
-- Records of db_item
-- ----------------------------
INSERT INTO `db_item` VALUES ('1', '1', 'C006-SVN后台', 'http://c006.jwdsk.cn/svnadmin', 'SVN后台', 'C006,SVN', 'http://c006.jwdsk.cn/svnadmin/templates/images/logo.png', null, null, null);
INSERT INTO `db_item` VALUES ('2', '1', 'C005-showdoc后台', 'http://c005.jwdsk.cn/showdoc', 'API接口文档制作工具', 'C005,showdoc', 'http://c005.jwdsk.cn/showdoc/web/static/logo/b_64.png', null, null, null);
INSERT INTO `db_item` VALUES ('3', '1', 'C006-owncloud私有云', 'http://c006.jwdsk.cn/owncloud', 'owncloud私有云', 'C006,owncloud', 'http://c006.jwdsk.cn/owncloud/core/img/favicon.ico', null, null, null);
INSERT INTO `db_item` VALUES ('4', '1', '阿里云-SVN网页后台', 'https://120.76.221.145', 'SVN网页后台', '阿里云,SVN', 'https://120.76.221.145/favicon.ico', null, null, null);
INSERT INTO `db_item` VALUES ('5', '1', 'C004-geoserver网页后台(https)', 'https://c004.jwdsk.cn:8443/geoserver/web', 'geoserver网页后台', 'C004,geoserver', 'https://c004.jwdsk.cn:8443/geoserver/web/wicket/resource/org.geoserver.web.GeoServerBasePage/favicon-ver-CD7C91844A87FE589C62DFE238A2ACA7.ico', null, null, null);
INSERT INTO `db_item` VALUES ('6', '1', 'C004-geoserver网页后台(http)', 'http://c004.jwdsk.cn:8080/geoserver/web', 'geoserver网页后台', 'C004,geoserver', 'http://c004.jwdsk.cn:8080/geoserver/web/wicket/resource/org.geoserver.web.GeoServerBasePage/favicon-ver-CD7C91844A87FE589C62DFE238A2ACA7.ico', null, null, null);
INSERT INTO `db_item` VALUES ('7', '1', 'C003-geoserver网页后台(http)', 'http://c003.jwdsk.cn:8080/geoserver/web', 'geoserver网页后台', 'C003,geoserver', 'http://c003.jwdsk.cn:8080/geoserver/web/wicket/resource/org.geoserver.web.GeoServerBasePage/favicon-ver-CD7C91844A87FE589C62DFE238A2ACA7.ico', null, null, null);
INSERT INTO `db_item` VALUES ('8', '1', '阿里云-geoserver网页后台', 'http://120.76.221.145:8080/geoserver/web', 'geoserver网页后台', '阿里云,geoserver', 'http://120.76.221.145:8080/geoserver/web/wicket/resource/org.geoserver.web.GeoServerBasePage/favicon-ver-CD7C91844A87FE589C62DFE238A2ACA7.ico', null, null, null);
INSERT INTO `db_item` VALUES ('9', '1', '微查岗后台', 'http://c006.jwdsk.cn/shareLoc-backstage', '微查岗后台', 'C006,微查岗', 'http://c006.jwdsk.cn/shareLoc-backstage/Project/Home/View/Public/img/100/2.gif', null, null, null);
INSERT INTO `db_item` VALUES ('10', '1', '工作量填写', 'https://docs.qq.com/sheet/DV1pkYkV3d0hhS2NR', '工作量填写', '工作', 'https://sqimg.qq.com/qq_product_operations/tencent-doc/title-icon/title/excel_32x32.png', null, null, null);
INSERT INTO `db_item` VALUES ('11', '2', '阿里云-渠道选址平台', 'http://120.76.221.145/herogis/chanelLocation', '渠道选址平台', '阿里云,选址', 'http://120.76.221.145/herogis/chanelLocation/dist/icon.png', null, null, null);
INSERT INTO `db_item` VALUES ('25', '2', '小程序网页版', 'https://tdbd.pub', '小程序网页版', '小程序', 'https://tdbd.pub/dist/icon.png', '1542967136', null, null);
INSERT INTO `db_item` VALUES ('26', '2', '招聘网页', 'https://tdbd.pub/recruitment', '招聘网站', '招聘', '', '1542967231', null, null);
INSERT INTO `db_item` VALUES ('27', '2', 'C004-渠道选址平台', 'https://c004.jwdsk.cn:8443/ChannelAidedLocationSystem/home.action#/index', '渠道选址平台', 'C004,渠道选址平台', 'https://c004.jwdsk.cn:8443/ChannelAidedLocationSystem/dist/icon.png', '1542967296', null, null);
INSERT INTO `db_item` VALUES ('28', '2', 'C001-渠道选址平台', 'http://c001.jwdsk.cn/ChannelAidedLocationSystem/home.action#/index', '渠道选址平台', 'C001,渠道选址平台', 'http://c001.jwdsk.cn/ChannelAidedLocationSystem/dist/icon.png', '1542967328', null, null);
INSERT INTO `db_item` VALUES ('29', '2', '阿里云-经济地图', 'http://120.76.221.145/econMap/#/', '经济地图', '阿里云,经济地图', 'http://120.76.221.145/econMap/static/city.png', '1542967388', null, null);
INSERT INTO `db_item` VALUES ('30', '2', '阿里云-点石成金', 'http://120.76.221.145/locPlatform/#/', '点石成金', '阿里云,点石成金', 'http://120.76.221.145/locPlatform/static/icon.png', '1542967429', null, null);
INSERT INTO `db_item` VALUES ('31', '2', '阿里云-合理性分析', 'http://120.76.221.145/herogis/blockChanelLocation/#/index', '合理性分析', '阿里云,合理性分析', 'http://120.76.221.145/herogis/blockChanelLocation/dist/icon.png', '1542967463', null, null);
INSERT INTO `db_item` VALUES ('34', '1', '全景后台', 'http://120.76.221.145:8081/VR/index.html', '全景后台', '全景', 'http://120.76.221.145:8081/tomcat.png', '1543305898', null, null);
INSERT INTO `db_item` VALUES ('35', '7', 'vuex', 'https://vuex.vuejs.org/', '', '', '', '1544518354', null, '1544778874');

-- ----------------------------
-- Table structure for db_jobs
-- ----------------------------
DROP TABLE IF EXISTS `db_jobs`;
CREATE TABLE `db_jobs` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `job_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '岗位名称',
  `job_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '岗位属性',
  `job_skills` text COLLATE utf8mb4_unicode_ci COMMENT '岗位职能',
  `create_time` int(15) DEFAULT NULL,
  `update_time` int(15) DEFAULT NULL,
  `delete_time` int(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of db_jobs
-- ----------------------------
INSERT INTO `db_jobs` VALUES ('1', '微信运营员', '运营岗', '1、 参加基于大数据平台的数据分析、挖掘项目工作；\n2、 负责数据模型建立、数据处理与挖掘工作支撑；\n3、负责数据挖掘算法的验证与测试工。\n任职资格：\n1、  熟练Unix/Linux操作系统，熟悉掌握常用Shell/Python/Perl等脚本工具；\n2、  熟练掌握Unix/Linux C、C++语言编程，精通Java开发语言更佳；\n3、  熟悉Hadoop、Hive、MapReduce、Spark等大数据技术；\n4、  熟练掌握SQL语言查询及优化，熟练使用SPSS  clementine、SAS、R语言等常用挖掘工具，熟悉常用经典的等数据挖掘算法；\n5、  具备通信行业背景及相关知识优先，具备中国移动（电信、联通）经分/BI、金融及其他行业数据挖掘项目经验者优先；\n6、  计算机、通信、应用数学相关专业本科及以上毕业。', '1545880259', '1545881634', null);
INSERT INTO `db_jobs` VALUES ('3', '数据挖掘', '运营岗', '1、 参加基于大数据平台的数据分析、挖掘项目工作；\n2、 负责数据模型建立、数据处理与挖掘工作支撑；\n3、负责数据挖掘算法的验证与测试工。\n任职资格：\n1、  熟练Unix/Linux操作系统，熟悉掌握常用Shell/Python/Perl等脚本工具；\n2、  熟练掌握Unix/Linux C、C++语言编程，精通Java开发语言更佳；\n3、  熟悉Hadoop、Hive、MapReduce、Spark等大数据技术；\n4、  熟练掌握SQL语言查询及优化，熟练使用SPSS  clementine、SAS、R语言等常用挖掘工具，熟悉常用经典的等数据挖掘算法；\n5、  具备通信行业背景及相关知识优先，具备中国移动（电信、联通）经分/BI、金融及其他行业数据挖掘项目经验者优先；\n6、  计算机、通信、应用数学相关专业本科及以上毕业。', '1545906472', '1545906472', null);
INSERT INTO `db_jobs` VALUES ('4', '数据挖掘工程师', '技术岗', '1、 参加基于大数据平台的数据分析、挖掘项目工作；\n2、 负责数据模型建立、数据处理与挖掘工作支撑；\n3、负责数据挖掘算法的验证与测试工。\n任职资格：\n1、  熟练Unix/Linux操作系统，熟悉掌握常用Shell/Python/Perl等脚本工具；\n2、  熟练掌握Unix/Linux C、C++语言编程，精通Java开发语言更佳；\n3、  熟悉Hadoop、Hive、MapReduce、Spark等大数据技术；\n4、  熟练掌握SQL语言查询及优化，熟练使用SPSS  clementine、SAS、R语言等常用挖掘工具，熟悉常用经典的等数据挖掘算法；\n5、  具备通信行业背景及相关知识优先，具备中国移动（电信、联通）经分/BI、金融及其他行业数据挖掘项目经验者优先；\n6、  计算机、通信、应用数学相关专业本科及以上毕业。', '1545965734', '1545965734', null);

-- ----------------------------
-- Table structure for db_recruitment
-- ----------------------------
DROP TABLE IF EXISTS `db_recruitment`;
CREATE TABLE `db_recruitment` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '招聘岗位ID',
  `companyid` int(5) DEFAULT NULL COMMENT '公司ID',
  `education` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '学历要求',
  `treatment` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '工资待遇',
  `jobid` int(5) DEFAULT NULL COMMENT '岗位ID',
  `number` int(10) DEFAULT NULL COMMENT '招聘人数',
  `workarea` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '工作地点',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '招聘标题',
  `imgs` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '图片',
  `essay` text COLLATE utf8mb4_unicode_ci COMMENT '招聘短文',
  `sendemail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '简历投递邮箱',
  `age` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '年龄要求',
  `create_time` int(15) DEFAULT NULL,
  `delete_time` int(15) DEFAULT NULL,
  `update_time` int(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of db_recruitment
-- ----------------------------
INSERT INTO `db_recruitment` VALUES ('10', '1', '研究生', '5000+', '1', '10', '广州越秀区', 'teratata校招啦', '/uploads/20181228/c4b303701dee4dfc108a62502fb016b1.jpg', '大声道撒大撒多付', '45454524545@qq.com', '30以内', '1545985080', null, '1545985080');
INSERT INTO `db_recruitment` VALUES ('11', '1', '研究生', '5000+', '2', '10', '广州越秀区', 'teratata校招啦', '/uploads/20181228/3dd19453c69d7dac0b6cbb674a17ffec.jpg,/uploads/20181228/1951193fe2017d1207e4d642ba51b9b6.jpg,/uploads/20181228/60871dfa3852bab4b4cbaac2b334daa7.jpg', '大声道撒大撒多付', '45454524545@qq.com', '30以内', '1545985123', null, '1545986493');

-- ----------------------------
-- Table structure for db_staff
-- ----------------------------
DROP TABLE IF EXISTS `db_staff`;
CREATE TABLE `db_staff` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '姓名',
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '头像',
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '公司',
  `itemgroup` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '项目小组',
  `position` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '职位',
  `school` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '毕业学校',
  `major` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '专业',
  `keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '关键词',
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '联系方式',
  `education` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '学历',
  `jointime` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '入职时间',
  `leavetime` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '离职时间',
  `create_time` int(15) DEFAULT NULL,
  `update_time` int(15) DEFAULT NULL,
  `delete_time` int(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of db_staff
-- ----------------------------
INSERT INTO `db_staff` VALUES ('2', '大大', '/uploads/img/moren.jpg', 'teradata', 'CMCC', '前端工程师', '广工', '软件工程', '大方美丽善良可爱', '13537116097', '本科', '2018/12/03', null, '1544769076', null, null);
INSERT INTO `db_staff` VALUES ('21', '大xiao', '/uploads/img/moren.jpg', 'teradata', 'CMCC', '前端工程师', '广工', '软件工程', '大方美丽善良可爱', '13537116097', '本科', '2018/12/03', null, '1545881337', '1545881337', null);
INSERT INTO `db_staff` VALUES ('3', '大大', '/uploads/img/moren.jpg', 'teradata', 'CMCC', '前端工程师', '广工', '软件工程', '大方美丽善良可爱', '13537116097', '本科', '2018/12/03', null, '1544770756', null, null);
INSERT INTO `db_staff` VALUES ('4', '大xiao', '/uploads/img/moren.jpg', 'teradata', 'CMCC', '前端工程师', '广工', '软件工程', '大方美丽善良可爱', '13537116097', '本科', '2018/12/03', null, '1544770756', '1544780235', null);
INSERT INTO `db_staff` VALUES ('5', '大大', '/uploads/img/moren.jpg', 'teradata', 'CMCC', '前端工程师', '广工', '软件工程', '大方美丽善良可爱', '13537116097', '本科', '2018/12/03', null, '1544770757', null, '1544772496');
INSERT INTO `db_staff` VALUES ('6', '大大', '/uploads/img/moren.jpg', 'teradata', 'CMCC', '前端工程师', '广工', '软件工程', '大方美丽善良可爱', '13537116097', '本科', '2018/12/03', null, '1544770754', null, '1544772466');

-- ----------------------------
-- Table structure for db_user
-- ----------------------------
DROP TABLE IF EXISTS `db_user`;
CREATE TABLE `db_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `username` varchar(100) DEFAULT NULL COMMENT '管理后台账号',
  `password` varchar(100) DEFAULT NULL COMMENT '管理后台密码',
  `remark` varchar(100) DEFAULT NULL COMMENT '用户备注',
  `create_time` int(11) DEFAULT NULL,
  `realname` varchar(100) DEFAULT NULL COMMENT '真实姓名',
  `structure_id` int(11) DEFAULT NULL COMMENT '部门',
  `post_id` int(11) DEFAULT NULL COMMENT '岗位',
  `status` tinyint(3) DEFAULT NULL COMMENT '状态,1启用0禁用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_user
-- ----------------------------
INSERT INTO `db_user` VALUES ('1', '见闻', '0ed9a50281e0b5f49ceacebde948cc24', '', '1543214996', '超级管理员', '1', '1', '1');
INSERT INTO `db_user` VALUES ('2', '王星宇', '0ed9a50281e0b5f49ceacebde948cc24', null, '1543214996', '王星宇', null, null, '1');
INSERT INTO `db_user` VALUES ('6', 'jiang', '14fc9fa1826e16baeda6832ecbaafa2c', '1', '1544779190', 'jiang', '1', '1', '1');
