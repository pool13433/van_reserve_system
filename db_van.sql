-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2015 at 07:18 PM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_van`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
`c_id` int(11) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `c_onwer` varchar(255) NOT NULL,
  `c_address` text NOT NULL,
  `c_mobile` varchar(10) NOT NULL,
  `c_updatedate` date NOT NULL,
  `c_updateby` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`c_id`, `c_name`, `c_onwer`, `c_address`, `c_mobile`, `c_updatedate`, `c_updateby`) VALUES
(1, 'สายเดินรถเจ้เกียว', 'เจ้เกียว', 'ดอนเมือง', '0800000000', '2015-06-09', 1),
(2, 'สมบัติ ทัวร์', 'สมบัติ', 'ลาดพร้าว', '0801111111', '2015-06-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE IF NOT EXISTS `person` (
`id` int(11) NOT NULL COMMENT 'รหัส',
  `fb_id` varchar(20) DEFAULT NULL COMMENT 'รหัสเฟสบุ๊ค',
  `code` varchar(9) NOT NULL COMMENT 'รหัสพนักงาน คนขับรถตู้ ',
  `fname` varchar(100) NOT NULL COMMENT 'ชื่อ',
  `lname` varchar(100) NOT NULL COMMENT 'สกุล',
  `username` varchar(50) NOT NULL COMMENT 'username',
  `password` varchar(50) NOT NULL COMMENT 'password',
  `idcard` varchar(13) NOT NULL,
  `mobile` varchar(15) NOT NULL COMMENT 'โทรศัพท์',
  `email` varchar(50) NOT NULL COMMENT 'อีเมลล์',
  `updatedate` date NOT NULL COMMENT 'วันที่สร้าง',
  `updateby` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT 'สถานะ EMPLOYEE_ID=>1,ONWER_ID=>2,CUSTOMER_ID=>3 ,DRIVER_ID => 4,GENARAL_ID => 0,'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`id`, `fb_id`, `code`, `fname`, `lname`, `username`, `password`, `idcard`, `mobile`, `email`, `updatedate`, `updateby`, `status`) VALUES
(1, '', 'EMP560001', 'admin', '1234', 'admin', '1234', '', '0800000000', 'poon_mp@hotmail.com', '0000-00-00', 0, 1),
(4, '', 'DRI560001', 'jajaja1234', 'jajaja1234', 'ja', '1234', '', 'jajaja1234', 'jartam4545@gmail.com', '2015-03-22', 0, 4),
(5, '', 'CUS560001', 'user', 'user', 'user', '1234', '', '52410017', '52410017@gmail.com', '2015-03-22', 0, 3),
(6, '', 'DRI560002', 'admoy1234', 'admoy1234', 'admoy', 'admoy1234', '', 'admoy1234', 'admoy1234@gmail.com', '2015-03-23', 0, 4),
(7, '', 'DRI560003', 'jajaja1234', 'jajaja1234', 'jajaja1234', 'jajaja1234', '1219800120650', 'jajaja1234', 'jajaja1234@gmail.com', '2015-03-23', 0, 2),
(8, '', 'CUS560002', 'student1234', 'student1234', 'student', 'student1234', '0000000000000', 'student1234', 'student1234@gmail.com', '2015-03-23', 0, 3),
(9, '', 'EMP560002', '1111111aaaaaaq', '1111111aaaaaaq', '111111111111', '1111111aaaaaaq', '1219800120650', '1111111aaaaaaq', '1111111aaaaaaq@gmail.com', '2015-03-23', 1, 2),
(10, '', 'DRI560004', 'sommai', 'sommai', 'sommai', 'sommai', '1234567812345', '0878356866', 'sommai@gmail.com', '2015-06-07', 1, 0),
(11, '', 'DRI560006', 'suprecha', 'suprecha', 'suprecha', 'suprecha', 'suprecha', '0800000000', 'suprecha@gmail.com', '2015-06-07', 1, 4),
(12, '', 'DRI560005', 'areeee', 'areeee', 'areeee', 'areeee', 'areeee', '0800000000', 'areeee@gmail.com', '2015-06-07', 1, 4),
(13, '', 'CUS580003', 'thailand', 'thailand', 'thailand', '1234', 'thailand', 'thailand', 'thailand', '2015-06-11', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE IF NOT EXISTS `province` (
`pv_id` int(11) NOT NULL,
  `pv_name` varchar(150) COLLATE utf8_bin NOT NULL,
  `pv_updatedate` date NOT NULL,
  `pv_updateby` int(5) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=80 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`pv_id`, `pv_name`, `pv_updatedate`, `pv_updateby`) VALUES
(1, 'กรุงเทพมหานคร   ', '0000-00-00', 0),
(2, 'สมุทรปราการ   ', '0000-00-00', 0),
(3, 'นนทบุรี   ', '0000-00-00', 0),
(4, 'ปทุมธานี   ', '0000-00-00', 0),
(5, 'พระนครศรีอยุธยา   ', '0000-00-00', 0),
(6, 'อ่างทอง   ', '0000-00-00', 0),
(7, 'ลพบุรี   ', '2015-06-06', 1),
(8, 'สิงห์บุรี   ', '0000-00-00', 0),
(9, 'ชัยนาท   ', '0000-00-00', 0),
(10, 'สระบุรี', '0000-00-00', 0),
(11, 'ชลบุรี   ', '0000-00-00', 0),
(12, 'ระยอง   ', '0000-00-00', 0),
(13, 'จันทบุรี   ', '0000-00-00', 0),
(14, 'ตราด   ', '0000-00-00', 0),
(15, 'ฉะเชิงเทรา   ', '0000-00-00', 0),
(16, 'ปราจีนบุรี   ', '0000-00-00', 0),
(17, 'นครนายก   ', '0000-00-00', 0),
(18, 'สระแก้ว   ', '0000-00-00', 0),
(19, 'นครราชสีมา   ', '0000-00-00', 0),
(20, 'บุรีรัมย์   ', '0000-00-00', 0),
(21, 'สุรินทร์   ', '0000-00-00', 0),
(22, 'ศรีสะเกษ   ', '0000-00-00', 0),
(23, 'อุบลราชธานี   ', '0000-00-00', 0),
(24, 'ยโสธร   ', '0000-00-00', 0),
(25, 'ชัยภูมิ   ', '0000-00-00', 0),
(26, 'อำนาจเจริญ   ', '0000-00-00', 0),
(27, 'หนองบัวลำภู   ', '0000-00-00', 0),
(28, 'ขอนแก่น   ', '0000-00-00', 0),
(29, 'อุดรธานี   ', '0000-00-00', 0),
(30, 'เลย   ', '0000-00-00', 0),
(31, 'หนองคาย   ', '0000-00-00', 0),
(32, 'มหาสารคาม   ', '0000-00-00', 0),
(33, 'ร้อยเอ็ด   ', '0000-00-00', 0),
(34, 'กาฬสินธุ์   ', '0000-00-00', 0),
(35, 'สกลนคร   ', '0000-00-00', 0),
(36, 'นครพนม   ', '0000-00-00', 0),
(37, 'มุกดาหาร   ', '0000-00-00', 0),
(38, 'เชียงใหม่   ', '0000-00-00', 0),
(39, 'ลำพูน   ', '0000-00-00', 0),
(40, 'ลำปาง   ', '0000-00-00', 0),
(41, 'อุตรดิตถ์   ', '0000-00-00', 0),
(42, 'แพร่   ', '0000-00-00', 0),
(43, 'น่าน   ', '0000-00-00', 0),
(44, 'พะเยา   ', '0000-00-00', 0),
(45, 'เชียงราย   ', '0000-00-00', 0),
(46, 'แม่ฮ่องสอน   ', '0000-00-00', 0),
(47, 'นครสวรรค์   ', '0000-00-00', 0),
(48, 'อุทัยธานี   ', '0000-00-00', 0),
(49, 'กำแพงเพชร   ', '0000-00-00', 0),
(50, 'ตาก   ', '0000-00-00', 0),
(51, 'สุโขทัย   ', '0000-00-00', 0),
(52, 'พิษณุโลก   ', '0000-00-00', 0),
(53, 'พิจิตร   ', '0000-00-00', 0),
(54, 'เพชรบูรณ์   ', '0000-00-00', 0),
(55, 'ราชบุรี   ', '0000-00-00', 0),
(56, 'กาญจนบุรี   ', '0000-00-00', 0),
(57, 'สุพรรณบุรี   ', '0000-00-00', 0),
(58, 'นครปฐม   ', '0000-00-00', 0),
(59, 'สมุทรสาคร   ', '0000-00-00', 0),
(60, 'สมุทรสงคราม   ', '0000-00-00', 0),
(61, 'เพชรบุรี   ', '0000-00-00', 0),
(62, 'ประจวบคีรีขันธ์   ', '0000-00-00', 0),
(63, 'นครศรีธรรมราช   ', '0000-00-00', 0),
(64, 'กระบี่   ', '0000-00-00', 0),
(65, 'พังงา   ', '0000-00-00', 0),
(66, 'ภูเก็ต   ', '0000-00-00', 0),
(67, 'สุราษฎร์ธานี   ', '0000-00-00', 0),
(68, 'ระนอง   ', '0000-00-00', 0),
(69, 'ชุมพร   ', '0000-00-00', 0),
(70, 'สงขลา   ', '0000-00-00', 0),
(71, 'สตูล   ', '0000-00-00', 0),
(72, 'ตรัง   ', '0000-00-00', 0),
(73, 'พัทลุง   ', '0000-00-00', 0),
(74, 'ปัตตานี   ', '0000-00-00', 0),
(75, 'ยะลา   ', '0000-00-00', 0),
(76, 'นราธิวาส   ', '0000-00-00', 0),
(77, 'บึงกาฬ', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `province_place`
--

CREATE TABLE IF NOT EXISTS `province_place` (
`pvp_id` int(11) NOT NULL,
  `pvp_name` varchar(255) NOT NULL,
  `pv_id` int(11) NOT NULL COMMENT 'รหัสจังหวัด',
  `pvp_updatedate` date NOT NULL,
  `pvp_updateby` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `province_place`
--

INSERT INTO `province_place` (`pvp_id`, `pvp_name`, `pv_id`, `pvp_updatedate`, `pvp_updateby`) VALUES
(2, 'แหลมพรหมเทพ', 64, '2015-06-09', 1),
(3, 'แหลมแม่พิมพ์', 64, '2015-06-09', 1),
(5, 'สวน', 49, '2015-06-06', 1),
(6, 'รังสิต', 1, '2015-06-06', 1),
(7, 'อรัญประเทศ', 18, '2015-06-07', 1),
(8, 'ดอนเมือง', 1, '2015-06-07', 1),
(9, 'ฟิวเจอร์ ปาร์ครังสิต', 4, '2015-06-07', 1),
(10, 'อำเภอเมือง', 17, '2015-06-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reserve`
--

CREATE TABLE IF NOT EXISTS `reserve` (
`rs_id` int(11) NOT NULL,
  `cus_id` int(11) NOT NULL COMMENT 'รหัสลูกค้า',
  `v_id` int(11) NOT NULL COMMENT 'รหัสรถตู้ที่จอง',
  `rs_price` int(11) NOT NULL COMMENT 'ราคาต้องชำระ',
  `vp_idstart` int(11) NOT NULL COMMENT 'สถานที่ขึ้้น',
  `vp_idend` int(11) NOT NULL COMMENT 'สสถานที่ลง',
  `rs_createdate` datetime NOT NULL,
  `rs_updateby` int(11) NOT NULL,
  `rs_status` int(2) NOT NULL COMMENT 'สถานะการจอง  ''0'' => ''จองเรียบร้อย'',         ''1'' => ''จ่ายเงินเรียบร้อย'',         ''2'' => ''ยกเลิกการจอง'',         ''3'' => ''เกินระยะเวลาการชำระเงิน'''
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='ตารางเก็บข้อมูลการจอง';

--
-- Dumping data for table `reserve`
--

INSERT INTO `reserve` (`rs_id`, `cus_id`, `v_id`, `rs_price`, `vp_idstart`, `vp_idend`, `rs_createdate`, `rs_updateby`, `rs_status`) VALUES
(3, 13, 31, 0, 109, 112, '2015-06-12 22:55:02', 1, 0),
(4, 13, 33, 200, 93, 94, '2015-06-12 22:55:58', 1, 0),
(5, 13, 33, 200, 93, 94, '2015-06-12 23:13:02', 1, 0),
(6, 13, 33, 200, 93, 94, '2015-06-12 23:19:13', 1, 0),
(7, 13, 33, 200, 93, 94, '2015-06-12 23:19:39', 1, 0),
(8, 13, 31, 0, 109, 112, '2015-06-12 23:28:41', 1, 0),
(9, 13, 31, 0, 109, 112, '2015-06-12 23:55:31', 1, 0),
(10, 13, 36, 0, 69, 73, '2015-06-12 23:56:03', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `van`
--

CREATE TABLE IF NOT EXISTS `van` (
`v_id` int(11) NOT NULL COMMENT 'รหัสรถตู้',
  `v_name` varchar(255) NOT NULL COMMENT 'ชื่อสายรถตู้',
  `v_detail` text NOT NULL COMMENT 'รายละเอียด',
  `v_company` int(11) NOT NULL COMMENT 'บริษัท',
  `v_driver` int(11) NOT NULL COMMENT 'รหัสพนักงานขับรถ',
  `v_chair` int(2) NOT NULL,
  `v_roadlength` int(11) NOT NULL DEFAULT '0' COMMENT 'ระยะทาง',
  `v_drivestart` time NOT NULL,
  `v_driveend` time NOT NULL,
  `v_updatedate` date NOT NULL,
  `v_updateby` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `van`
--

INSERT INTO `van` (`v_id`, `v_name`, `v_detail`, `v_company`, `v_driver`, `v_chair`, `v_roadlength`, `v_drivestart`, `v_driveend`, `v_updatedate`, `v_updateby`) VALUES
(31, 'ระยอง - เชียงใหม่', 'ระยอง - เชียงใหม่', 1, 6, 15, 1000, '00:00:00', '00:00:00', '2015-06-11', 1),
(32, 'ยะลา - ระยอง', 'ยะลา - ระยอง', 1, 6, 5, 250, '11:22:00', '11:22:00', '2015-06-11', 1),
(33, 'กรุงเทพ - ยะลา', 'กรุงเทพ - ยะลา', 1, 6, 3, 300, '11:22:00', '22:11:00', '2015-06-11', 1),
(34, 'ระยอง - กรุงเทพ', 'ระยอง - กรุงเทพ รถบัส', 1, 6, 32, 1000, '22:22:00', '11:11:00', '2015-06-11', 1),
(36, 'รถเมย์รถเมย์รถเมย์', 'รถเมย์รถเมย์รถเมย์', 1, 6, 15, 0, '22:22:00', '22:22:00', '2015-06-10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `van_chair`
--

CREATE TABLE IF NOT EXISTS `van_chair` (
`vc_id` int(11) NOT NULL,
  `vc_x` int(2) NOT NULL,
  `vc_y` int(2) NOT NULL,
  `vc_label` varchar(15) NOT NULL,
  `v_id` int(11) NOT NULL COMMENT 'รหัสรถตู้',
  `vc_status` int(1) NOT NULL DEFAULT '0' COMMENT '0 = ว่าง , 1 = ไม่ว่าง',
  `vc_cusid` varchar(3) NOT NULL COMMENT 'รหัสลูกค้า'
) ENGINE=InnoDB AUTO_INCREMENT=367 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `van_chair`
--

INSERT INTO `van_chair` (`vc_id`, `vc_x`, `vc_y`, `vc_label`, `v_id`, `vc_status`, `vc_cusid`) VALUES
(102, 0, 0, 'A2', 26, 1, ''),
(103, 0, 1, 'A2', 26, 0, ''),
(104, 0, 0, 'A1', 27, 1, ''),
(105, 0, 1, 'A2', 27, 0, ''),
(106, 0, 0, 'A1', 28, 0, ''),
(107, 0, 1, 'A2', 28, 0, ''),
(108, 1, 0, 'B1', 29, 0, ''),
(109, 1, 1, 'B2', 29, 1, ''),
(110, 2, 0, 'C1', 29, 0, ''),
(111, 3, 0, 'D1', 29, 0, ''),
(112, 0, 0, 'A1', 30, 1, ''),
(113, 1, 0, 'A2', 30, 0, ''),
(114, 0, 1, 'B1', 30, 0, ''),
(115, 1, 1, 'B2', 30, 1, ''),
(125, 2, 0, '1', 35, 0, ''),
(126, 3, 0, '2', 35, 0, ''),
(127, 1, 1, '3', 35, 1, ''),
(128, 3, 1, '4', 35, 1, ''),
(129, 4, 1, '5', 35, 0, ''),
(130, 1, 2, '6', 35, 0, ''),
(131, 3, 2, '7', 35, 1, ''),
(132, 4, 2, '8', 35, 0, ''),
(133, 1, 3, '9', 35, 0, ''),
(134, 3, 3, '10', 35, 1, ''),
(135, 4, 3, '11', 35, 1, ''),
(136, 1, 4, '12', 35, 0, ''),
(137, 2, 4, '13', 35, 0, ''),
(138, 3, 4, '14', 35, 0, ''),
(139, 4, 4, '15', 35, 0, ''),
(203, 2, 0, 'A1', 36, 0, '13'),
(204, 3, 0, 'A2', 36, 0, '13'),
(205, 1, 1, 'B1', 36, 0, ''),
(206, 3, 1, 'B2', 36, 0, '13'),
(207, 4, 1, 'B3', 36, 0, '13'),
(208, 1, 2, 'C1', 36, 0, ''),
(209, 3, 2, 'C2', 36, 0, ''),
(210, 4, 2, 'C3', 36, 0, '13'),
(211, 1, 3, 'D1', 36, 0, ''),
(212, 3, 3, 'D2', 36, 0, ''),
(213, 4, 3, 'D3', 36, 0, ''),
(214, 1, 4, 'E1', 36, 0, ''),
(215, 2, 4, 'E2', 36, 0, ''),
(216, 3, 4, 'E3', 36, 0, ''),
(217, 4, 4, 'E4', 36, 0, ''),
(267, 0, 0, 'A1', 32, 0, ''),
(268, 1, 0, 'A', 32, 0, ''),
(269, 2, 0, 'S', 32, 0, ''),
(270, 3, 0, 'D', 32, 0, ''),
(271, 0, 1, 'A2', 32, 0, ''),
(272, 0, 0, 'A', 33, 0, '13'),
(273, 1, 0, 'A2', 33, 0, '13'),
(274, 2, 0, 'A1', 33, 0, '13'),
(290, 0, 1, 'A1', 34, 0, ''),
(291, 1, 1, 'A1', 34, 0, ''),
(292, 3, 1, 'A1', 34, 0, ''),
(293, 4, 1, 'A1', 34, 0, ''),
(294, 0, 2, 'B1', 34, 0, ''),
(295, 1, 2, 'B1', 34, 0, ''),
(296, 3, 2, 'B1', 34, 0, ''),
(297, 4, 2, 'B1', 34, 0, ''),
(298, 0, 3, 'C1', 34, 0, ''),
(299, 1, 3, 'C1', 34, 0, ''),
(300, 3, 3, 'C1', 34, 0, ''),
(301, 4, 3, 'C1', 34, 0, ''),
(302, 0, 4, 'D1', 34, 0, ''),
(303, 1, 4, 'D1', 34, 0, ''),
(304, 3, 4, 'D1', 34, 0, ''),
(305, 4, 4, 'D1', 34, 0, ''),
(306, 0, 5, 'E1', 34, 0, ''),
(307, 1, 5, 'E1', 34, 0, ''),
(308, 3, 5, 'E1', 34, 0, ''),
(309, 4, 5, 'E1', 34, 0, ''),
(310, 0, 6, 'F1', 34, 0, ''),
(311, 1, 6, 'F1', 34, 0, ''),
(312, 3, 6, 'F1', 34, 0, ''),
(313, 4, 6, 'F1', 34, 0, ''),
(314, 0, 7, 'G1', 34, 0, ''),
(315, 1, 7, 'G1', 34, 0, ''),
(316, 3, 7, 'G1', 34, 0, ''),
(317, 4, 7, 'G1', 34, 0, ''),
(318, 0, 8, 'H1', 34, 0, ''),
(319, 1, 8, 'H1', 34, 0, ''),
(320, 3, 8, 'H1', 34, 0, ''),
(321, 4, 8, 'H1', 34, 0, ''),
(352, 2, 0, 'A1', 31, 0, '13'),
(353, 3, 0, 'A2', 31, 0, '13'),
(354, 1, 1, 'B1', 31, 0, ''),
(355, 3, 1, 'B2', 31, 0, '13'),
(356, 4, 1, 'B3', 31, 0, ''),
(357, 1, 2, 'C1', 31, 0, '13'),
(358, 3, 2, 'C2', 31, 0, '13'),
(359, 4, 2, 'C3', 31, 0, ''),
(360, 1, 3, 'D1', 31, 0, '13'),
(361, 3, 3, 'D2', 31, 0, '13'),
(362, 4, 3, 'D3', 31, 0, ''),
(363, 1, 4, 'E1', 31, 0, ''),
(364, 2, 4, 'E2', 31, 0, ''),
(365, 3, 4, 'E3', 31, 0, '13'),
(366, 4, 4, 'E4', 31, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `van_place`
--

CREATE TABLE IF NOT EXISTS `van_place` (
`vp_id` int(11) NOT NULL,
  `vp_hierarchy` int(11) NOT NULL,
  `vp_kilomate` int(11) NOT NULL,
  `pvp_id` int(11) NOT NULL COMMENT 'รหัสสถานที่',
  `v_id` int(11) NOT NULL COMMENT 'รหัสรถตู้',
  `vp_updatedate` date NOT NULL,
  `pvp_updateby` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `van_place`
--

INSERT INTO `van_place` (`vp_id`, `vp_hierarchy`, `vp_kilomate`, `pvp_id`, `v_id`, `vp_updatedate`, `pvp_updateby`) VALUES
(18, 1, 0, 8, 26, '2015-06-09', 1),
(19, 2, 0, 6, 26, '2015-06-09', 1),
(20, 1, 0, 8, 27, '2015-06-09', 1),
(21, 2, 0, 6, 27, '2015-06-09', 1),
(22, 1, 0, 2, 28, '2015-06-09', 1),
(23, 2, 0, 3, 28, '2015-06-09', 1),
(24, 1, 0, 10, 29, '2015-06-09', 1),
(25, 2, 0, 9, 29, '2015-06-09', 1),
(26, 1, 0, 10, 30, '2015-06-09', 1),
(27, 2, 0, 9, 30, '2015-06-09', 1),
(36, 1, 0, 8, 35, '2015-06-09', 1),
(37, 2, 0, 6, 35, '2015-06-09', 1),
(69, 1, 0, 8, 36, '2015-06-10', 1),
(70, 2, 0, 6, 36, '2015-06-10', 1),
(71, 3, 0, 5, 36, '2015-06-10', 1),
(72, 4, 0, 10, 36, '2015-06-10', 1),
(73, 5, 0, 9, 36, '2015-06-10', 1),
(74, 6, 0, 7, 36, '2015-06-10', 1),
(91, 1, 0, 2, 32, '2015-06-11', 1),
(92, 2, 0, 3, 32, '2015-06-11', 1),
(93, 1, 40, 8, 33, '2015-06-11', 1),
(94, 2, 100, 6, 33, '2015-06-11', 1),
(99, 1, 0, 2, 34, '2015-06-11', 1),
(100, 2, 0, 3, 34, '2015-06-11', 1),
(109, 1, 0, 3, 31, '2015-06-11', 1),
(110, 2, 0, 8, 31, '2015-06-11', 1),
(111, 3, 0, 5, 31, '2015-06-11', 1),
(112, 4, 0, 10, 31, '2015-06-11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `van_setting`
--

CREATE TABLE IF NOT EXISTS `van_setting` (
`vs_id` int(11) NOT NULL,
  `vs_name` varchar(255) NOT NULL,
  `vs_desc` text NOT NULL,
  `vs_value` varchar(5) NOT NULL,
  `vs_updatedate` date NOT NULL,
  `vs_updateby` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `van_setting`
--

INSERT INTO `van_setting` (`vs_id`, `vs_name`, `vs_desc`, `vs_value`, `vs_updatedate`, `vs_updateby`) VALUES
(1, 'van_price', 'ราคาค่าบริการรถตู้ ต่อ 1 กม', '2', '2015-06-11', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
 ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `province`
--
ALTER TABLE `province`
 ADD PRIMARY KEY (`pv_id`);

--
-- Indexes for table `province_place`
--
ALTER TABLE `province_place`
 ADD PRIMARY KEY (`pvp_id`);

--
-- Indexes for table `reserve`
--
ALTER TABLE `reserve`
 ADD PRIMARY KEY (`rs_id`);

--
-- Indexes for table `van`
--
ALTER TABLE `van`
 ADD PRIMARY KEY (`v_id`);

--
-- Indexes for table `van_chair`
--
ALTER TABLE `van_chair`
 ADD PRIMARY KEY (`vc_id`);

--
-- Indexes for table `van_place`
--
ALTER TABLE `van_place`
 ADD PRIMARY KEY (`vp_id`);

--
-- Indexes for table `van_setting`
--
ALTER TABLE `van_setting`
 ADD PRIMARY KEY (`vs_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส',AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `province`
--
ALTER TABLE `province`
MODIFY `pv_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=80;
--
-- AUTO_INCREMENT for table `province_place`
--
ALTER TABLE `province_place`
MODIFY `pvp_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `reserve`
--
ALTER TABLE `reserve`
MODIFY `rs_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `van`
--
ALTER TABLE `van`
MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสรถตู้',AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `van_chair`
--
ALTER TABLE `van_chair`
MODIFY `vc_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=367;
--
-- AUTO_INCREMENT for table `van_place`
--
ALTER TABLE `van_place`
MODIFY `vp_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=113;
--
-- AUTO_INCREMENT for table `van_setting`
--
ALTER TABLE `van_setting`
MODIFY `vs_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
