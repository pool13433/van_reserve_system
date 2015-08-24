-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2015 at 08:29 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`c_id`, `c_name`, `c_onwer`, `c_address`, `c_mobile`, `c_updatedate`, `c_updateby`) VALUES
(1, 'สายเดินรถเจ้เกียว', 'เจ้เกียว', 'ดอนเมือง', '0800000000', '2015-06-09', 1),
(2, 'สมบัติ ทัวร์', 'สมบัติ', 'ลาดพร้าว', '0801111111', '2015-06-07', 1),
(3, 'สายเดินรถ เจ้เล้ง', 'สายเดินรถ เจ้เล้ง', 'ดอนดมือง', 'สายเดินรถ ', '2015-06-18', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

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
(13, '', 'CUS580003', 'thailand', 'thailand', 'thailand', '1234', 'thailand', 'thailand', 'thailand', '2015-06-11', 1, 3),
(14, '', 'EMP580002', 'ADminstrtor', 'ADminstrtor', 'ADminstrtor', '1234', '000000000000', '0800000000', 'ADminstrtor@gmail.com', '2015-06-18', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE IF NOT EXISTS `province` (
  `pv_id` int(11) NOT NULL,
  `pv_name` varchar(150) COLLATE utf8_bin NOT NULL,
  `pv_updatedate` date NOT NULL,
  `pv_updateby` int(5) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
(77, 'บึงกาฬ', '0000-00-00', 0),
(80, 'dsdsdsd', '2015-08-22', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

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
(10, 'อำเภอเมือง', 17, '2015-06-07', 1),
(11, 'วัฒนานคร', 18, '2015-06-13', 1),
(12, 'ฟาร์มช้าง', 5, '2015-06-13', 1),
(13, 'เกาะเสม็ค', 12, '2015-06-13', 1),
(14, 'ลือเสาะ', 75, '2015-06-14', 1),
(15, 'แหลมแม่พิมพ์', 12, '2015-06-18', 1),
(16, 'ดอยอินทนน', 38, '2015-06-18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reserve`
--

CREATE TABLE IF NOT EXISTS `reserve` (
  `rs_id` int(11) NOT NULL,
  `cus_id` int(11) NOT NULL COMMENT 'รหัสลูกค้า',
  `v_id` int(11) NOT NULL COMMENT 'รหัสรถตู้ที่จอง',
  `rs_price` int(11) NOT NULL COMMENT 'ราคาต้องชำระ',
  `rs_usabledate` date NOT NULL COMMENT 'วันที่ใช้งาน',
  `vp_idstart` int(11) NOT NULL COMMENT 'สถานที่ขึ้้น',
  `vp_idend` int(11) NOT NULL COMMENT 'สสถานที่ลง',
  `rs_createdate` datetime NOT NULL,
  `rs_updateby` int(11) NOT NULL,
  `rs_status` int(2) NOT NULL COMMENT 'สถานะการจอง  ''0'' => ''จองเรียบร้อย'',         ''1'' => ''จ่ายเงินเรียบร้อย'',         ''2'' => ''ยกเลิกการจอง'',         ''3'' => ''เกินระยะเวลาการชำระเงิน'''
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='ตารางเก็บข้อมูลการจอง';

--
-- Dumping data for table `reserve`
--

INSERT INTO `reserve` (`rs_id`, `cus_id`, `v_id`, `rs_price`, `rs_usabledate`, `vp_idstart`, `vp_idend`, `rs_createdate`, `rs_updateby`, `rs_status`) VALUES
(2, 13, 39, 600, '2015-06-18', 10, 12, '2015-06-16 00:09:22', 1, 0),
(3, 13, 41, 500, '2015-06-17', 37, 39, '2015-06-18 21:53:47', 1, 0),
(4, 13, 41, 500, '2015-06-15', 37, 39, '2015-06-18 22:36:32', 1, 0),
(5, 13, 41, 500, '2015-06-16', 37, 39, '2015-06-18 22:43:39', 1, 0),
(6, 5, 40, 120, '2015-07-10', 35, 36, '2015-07-09 20:27:25', 1, 0),
(7, 5, 42, 0, '2015-08-23', 40, 43, '2015-08-22 12:00:25', 1, 0),
(8, 5, 39, 0, '2015-08-20', 28, 29, '2015-08-22 13:07:52', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reserve_chair`
--

CREATE TABLE IF NOT EXISTS `reserve_chair` (
  `rsc_id` int(11) NOT NULL,
  `vc_id` int(11) NOT NULL COMMENT 'รหัสที่นั่ง',
  `rs_id` int(11) NOT NULL COMMENT 'รหัสจอง',
  `rsc_usabledate` date NOT NULL COMMENT 'วันที่ใช้งาน'
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reserve_chair`
--

INSERT INTO `reserve_chair` (`rsc_id`, `vc_id`, `rs_id`, `rsc_usabledate`) VALUES
(1, 7, 2, '2015-06-18'),
(2, 10, 2, '2015-06-18'),
(3, 13, 2, '2015-06-18'),
(4, 16, 2, '2015-06-18'),
(5, 75, 3, '2015-06-17'),
(6, 76, 3, '2015-06-17'),
(7, 78, 3, '2015-06-17'),
(8, 81, 3, '2015-06-17'),
(9, 84, 3, '2015-06-17'),
(10, 88, 3, '2015-06-17'),
(11, 77, 4, '2015-06-15'),
(12, 79, 4, '2015-06-15'),
(13, 80, 4, '2015-06-15'),
(14, 83, 4, '2015-06-15'),
(15, 85, 4, '2015-06-15'),
(16, 86, 4, '2015-06-15'),
(17, 87, 4, '2015-06-15'),
(18, 89, 4, '2015-06-15'),
(19, 75, 5, '2015-06-16'),
(20, 76, 5, '2015-06-16'),
(21, 77, 5, '2015-06-16'),
(22, 78, 5, '2015-06-16'),
(23, 79, 5, '2015-06-16'),
(24, 80, 5, '2015-06-16'),
(25, 81, 5, '2015-06-16'),
(26, 82, 5, '2015-06-16'),
(27, 83, 5, '2015-06-16'),
(28, 84, 5, '2015-06-16'),
(29, 85, 5, '2015-06-16'),
(30, 86, 5, '2015-06-16'),
(31, 87, 5, '2015-06-16'),
(32, 88, 5, '2015-06-16'),
(33, 89, 5, '2015-06-16'),
(34, 71, 6, '2015-07-10'),
(35, 90, 7, '2015-08-23'),
(36, 29, 8, '2015-08-20');

-- --------------------------------------------------------

--
-- Table structure for table `reserve_pay`
--

CREATE TABLE IF NOT EXISTS `reserve_pay` (
  `vpay_id` int(11) NOT NULL,
  `rs_id` int(11) NOT NULL,
  `vp_paydate` date NOT NULL,
  `vp_paytime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `vp_paymoney` int(11) NOT NULL,
  `vp_createdate` date NOT NULL,
  `vp_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `van`
--

INSERT INTO `van` (`v_id`, `v_name`, `v_detail`, `v_company`, `v_driver`, `v_chair`, `v_roadlength`, `v_drivestart`, `v_driveend`, `v_updatedate`, `v_updateby`) VALUES
(39, 'กรุงเทพ - สระแก้ว', 'กรุงเทพ - สระแก้ว', 1, 6, 2, 11111, '00:00:00', '10:50:00', '2015-06-17', 1),
(40, 'ระยอง - จันทบุรี', 'จาก ระยอง ไป จันทบุรี', 2, 6, 15, 60, '21:55:00', '12:00:00', '2015-06-17', 1),
(41, 'จาก กรุงเทพ -ไป เชียงใหม่', 'จาก กรุงเทพ -ไป เชียงใหม่', 3, 12, 15, 100, '12:00:00', '03:15:00', '2015-06-18', 1),
(42, 'aaa', 'aaa', 1, 12, 2, 200, '12:05:00', '03:15:00', '2015-08-22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `van_chair`
--

CREATE TABLE IF NOT EXISTS `van_chair` (
  `vc_id` int(11) NOT NULL,
  `vc_x` int(2) NOT NULL,
  `vc_y` int(2) NOT NULL,
  `vc_label` varchar(15) NOT NULL,
  `v_id` int(11) NOT NULL COMMENT 'รหัสรถตู้'
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `van_chair`
--

INSERT INTO `van_chair` (`vc_id`, `vc_x`, `vc_y`, `vc_label`, `v_id`) VALUES
(29, 3, 0, 'A', 39),
(30, 3, 1, 'B', 39),
(60, 2, 0, 'A1', 40),
(61, 3, 0, 'A2', 40),
(62, 1, 1, 'B1', 40),
(63, 3, 1, 'B2', 40),
(64, 4, 1, 'B3', 40),
(65, 1, 2, 'C1', 40),
(66, 3, 2, 'C2', 40),
(67, 4, 2, 'C3', 40),
(68, 1, 3, 'D1', 40),
(69, 3, 3, 'D2', 40),
(70, 4, 3, 'D3', 40),
(71, 1, 4, 'E1', 40),
(72, 2, 4, 'E2', 40),
(73, 3, 4, 'E3', 40),
(74, 4, 4, 'E4', 40),
(75, 2, 0, 'A1', 41),
(76, 3, 0, 'A2', 41),
(77, 1, 1, 'B1', 41),
(78, 3, 1, 'B2', 41),
(79, 4, 1, 'B3', 41),
(80, 1, 2, 'D1', 41),
(81, 3, 2, 'D2', 41),
(82, 4, 2, 'D3', 41),
(83, 1, 3, 'E1', 41),
(84, 3, 3, 'E2', 41),
(85, 4, 3, 'E3', 41),
(86, 1, 4, 'F1', 41),
(87, 2, 4, 'F2', 41),
(88, 3, 4, 'F3', 41),
(89, 4, 4, 'F4', 41),
(90, 1, 0, '1', 42),
(91, 2, 0, '2', 42);

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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `van_place`
--

INSERT INTO `van_place` (`vp_id`, `vp_hierarchy`, `vp_kilomate`, `pvp_id`, `v_id`, `vp_updatedate`, `pvp_updateby`) VALUES
(28, 1, 0, 7, 39, '2015-06-17', 1),
(29, 2, 0, 8, 39, '2015-06-17', 1),
(30, 3, 0, 2, 39, '2015-06-17', 1),
(35, 1, 0, 13, 40, '2015-06-17', 1),
(36, 2, 60, 3, 40, '2015-06-17', 1),
(37, 1, 0, 8, 41, '2015-06-18', 1),
(38, 2, 150, 6, 41, '2015-06-18', 1),
(39, 3, 250, 16, 41, '2015-06-18', 1),
(40, 1, 0, 8, 42, '2015-08-22', 1),
(41, 2, 0, 3, 42, '2015-08-22', 1),
(42, 3, 0, 11, 42, '2015-08-22', 1),
(43, 4, 0, 7, 42, '2015-08-22', 1);

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
-- Indexes for table `reserve_chair`
--
ALTER TABLE `reserve_chair`
  ADD PRIMARY KEY (`rsc_id`);

--
-- Indexes for table `reserve_pay`
--
ALTER TABLE `reserve_pay`
  ADD PRIMARY KEY (`vpay_id`);

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
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส',AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `province`
--
ALTER TABLE `province`
  MODIFY `pv_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `province_place`
--
ALTER TABLE `province_place`
  MODIFY `pvp_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `reserve`
--
ALTER TABLE `reserve`
  MODIFY `rs_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `reserve_chair`
--
ALTER TABLE `reserve_chair`
  MODIFY `rsc_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `reserve_pay`
--
ALTER TABLE `reserve_pay`
  MODIFY `vpay_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `van`
--
ALTER TABLE `van`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสรถตู้',AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `van_chair`
--
ALTER TABLE `van_chair`
  MODIFY `vc_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=92;
--
-- AUTO_INCREMENT for table `van_place`
--
ALTER TABLE `van_place`
  MODIFY `vp_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `van_setting`
--
ALTER TABLE `van_setting`
  MODIFY `vs_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
