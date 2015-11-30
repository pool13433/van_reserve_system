-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2015 at 05:31 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`c_id`, `c_name`, `c_onwer`, `c_address`, `c_mobile`, `c_updatedate`, `c_updateby`) VALUES
(1, 'สายเดินรถเจ้เกียว', 'เจ้เกียว', 'df', '0800000000', '2015-11-29', 1),
(2, 'สมบัติ ทัวร์', 'สมบัติ', 'ลาดพร้าว', '0801111111', '2015-06-07', 1),
(3, 'สายเดินรถ เจ้เล้ง', 'สายเดินรถ เจ้เล้ง', 'ดอนดมือง', 'สายเดินรถ ', '2015-06-18', 1),
(4, 'บูรพา ทัว', 'บูรพา ทัว', 'สระแก้ว', '0800000000', '2015-08-24', 1),
(5, 'เชิดชัย ทัวร์', 'เชิดชัย ทัวร์', 'เชิดชัย ทัวร์', '0800000000', '2015-09-05', 1),
(6, 'นครชันแอร์', 'นครชันแอร์', 'นครชันแอร์', '0800000000', '2015-11-28', 1);

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
  `address` text NOT NULL,
  `updatedate` date NOT NULL COMMENT 'วันที่สร้าง',
  `updateby` int(11) NOT NULL,
  `status` int(2) NOT NULL COMMENT 'สถานะ EMPLOYEE_ID=>1,ONWER_ID=>2,CUSTOMER_ID=>3 ,DRIVER_ID => 4,GENARAL_ID => 0,5=MANAGER'
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`id`, `fb_id`, `code`, `fname`, `lname`, `username`, `password`, `idcard`, `mobile`, `email`, `address`, `updatedate`, `updateby`, `status`) VALUES
(1, '', 'EMP560001', 'administrtor', 'administrtor', 'admin', '1234', '0800000000', '0800000000', 'poon_mp@hotmail.com', 'sdsdsd', '2015-11-29', 1, 1),
(4, '', 'DRI560001', 'jajaja1234', 'jajaja1234', 'ยินดี ปรีดา', '1234', '0000000000000', 'jajaja1234', 'jartam4545@gmail.com', '', '2015-09-05', 1, 4),
(5, '', 'CUS560001', 'user', 'user', 'user', '1234', '', '52410017', '52410017@gmail.com', '', '2015-03-22', 0, 3),
(6, '', 'DRI560002', 'admoy1234', 'admoy1234', 'admoy', 'admoy1234', '0000000000000', 'admoy1234', 'admoy1234@gmail.com', '', '2015-09-05', 1, 4),
(7, '', 'DRI560003', 'jajaja1234', 'jajaja1234', 'jajaja1234', 'jajaja1234', '1219800120650', 'jajaja1234', 'jajaja1234@gmail.com', '', '2015-03-23', 0, 2),
(8, '', 'CUS560002', 'student1234', 'student1234', 'student', 'student1234', '0000000000000', 'student1234', 'student1234@gmail.com', '', '2015-03-23', 0, 3),
(9, '', 'EMP560002', '1111111aaaaaaq', '1111111aaaaaaq', '111111111111', '1111111aaaaaaq', '1219800120650', '1111111aaaaaaq', '1111111aaaaaaq@gmail.com', '', '2015-03-23', 1, 2),
(10, '', 'DRI560004', 'sommai', 'sommai', 'sommai', 'sommai', '1234567812345', '0878356866', 'sommai@gmail.com', '', '2015-06-07', 1, 0),
(11, '', 'DRI560006', 'suprecha', 'suprecha', 'suprecha', 'suprecha', '0000000000000', '0800000000', 'suprecha@gmail.com', '', '2015-09-05', 1, 4),
(13, '', 'CUS580003', 'thailand', 'thailand', 'thailand', '1234', 'thailand', 'thailand', 'thailand', '', '2015-06-11', 1, 3),
(14, '', 'EMP580002', 'ADminstrtor', 'ADminstrtor', 'ADminstrtor', '1234', '000000000000', '0800000000', 'ADminstrtor@gmail.com', '', '2015-06-18', 1, 1),
(15, '', 'EMP580003', 'TEST', 'TEST', 'TEST', 'TEST', '1234567891011', '0800000000', 'TEST@gmail.com', '', '2015-08-24', 1, 1),
(16, '', 'DRI580007', 'INDY', 'INDY', 'INDY', 'INDY', '1111111111111', '1111111111', 'INDY@hotmail.com', '', '2015-09-05', 1, 4),
(17, '', 'DRI580008', '0000000000000', '0000000000000', 'ยินดี ปรีดา', '0000000000000', '0000000000000', '0000000000', '0000000000000@hotmail.com', '', '2015-09-05', 1, 4),
(18, '', 'CUS580004', 'ลูกค้าชั้นยอด', 'user', 'user', '1234', '1111111111111', '1111111111', 'user@gmail.com', '', '2015-09-05', 1, 3),
(20, '', 'EMP580004', 'EMP0001', 'EMP0001', 'EMP0001', '1234', '00000000000', '0000000000', 'as@gmail.com', '', '2015-11-29', 1, 1),
(21, '10205034426891482', '', 'Poolsawat', 'Poolsawat', '', '', '', '', '', '', '2015-11-29', 1, 3),
(22, NULL, 'MAN560001', 'MAN560001', 'MAN560001', 'MAN560001', 'MAN560001', 'MAN560001', '0000000000', 'MAN560001@hotmail.com', 'MAN560001', '2015-11-29', 1, 2),
(23, '', 'MAN580001', 'MANAGER', 'MANAGER', 'MANAGER', 'MANAGER', '0000000000000', '0000000000', 'MANAGER@gmail.com', '', '2015-11-29', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE IF NOT EXISTS `province` (
  `pv_id` int(11) NOT NULL,
  `pv_name` varchar(150) COLLATE utf8_bin NOT NULL,
  `pv_updatedate` date NOT NULL,
  `pv_updateby` int(5) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=85 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`pv_id`, `pv_name`, `pv_updatedate`, `pv_updateby`) VALUES
(1, 'กรุงเทพมหานคร   ', '0000-00-00', 0),
(2, 'สมุทรปราการ   ', '0000-00-00', 0),
(3, 'นนทบุรี   ', '0000-00-00', 0),
(4, 'ปทุมธานี   ', '0000-00-00', 0),
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
(83, 'จังหวัดที่ 80', '2015-11-28', 1),
(84, 'ปราจีนบุรี', '2015-11-28', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `province_place`
--

INSERT INTO `province_place` (`pvp_id`, `pvp_name`, `pv_id`, `pvp_updatedate`, `pvp_updateby`) VALUES
(3, 'แหลมแม่พิมพ์', 12, '2015-08-25', 1),
(6, 'รังสิต', 4, '2015-08-25', 1),
(7, 'อรัญประเทศ', 18, '2015-06-07', 1),
(8, 'ดอนเมือง', 1, '2015-06-07', 1),
(9, 'ฟิวเจอร์ ปาร์ครังสิต', 4, '2015-06-07', 1),
(11, 'วัฒนานคร', 18, '2015-06-13', 1),
(13, 'เกาะเสม็ค', 12, '2015-06-13', 1),
(14, 'ลือเสาะ', 75, '2015-06-14', 1),
(16, 'ดอยอินทนน', 38, '2015-06-18', 1),
(18, 'สุนทรภู่ พระอภัยมณี', 12, '2015-08-24', 1),
(19, 'ท่าใหม่', 13, '2015-08-25', 1),
(20, 'เจ้าหลาว', 13, '2015-08-25', 1),
(21, 'กบินบุรี', 84, '2015-11-28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reserve`
--

CREATE TABLE IF NOT EXISTS `reserve` (
  `rs_id` int(11) NOT NULL,
  `rs_code` varchar(10) NOT NULL,
  `cus_id` int(11) NOT NULL COMMENT 'รหัสลูกค้า',
  `v_id` int(11) NOT NULL COMMENT 'รหัสรถตู้ที่จอง',
  `rs_price` int(11) NOT NULL COMMENT 'ราคาต้องชำระ',
  `rs_usabledate` date NOT NULL COMMENT 'วันที่ใช้งาน',
  `vp_idstart` int(11) NOT NULL COMMENT 'สถานที่ขึ้้น',
  `vp_idend` int(11) NOT NULL COMMENT 'สสถานที่ลง',
  `vt_id` int(11) NOT NULL,
  `rs_createdate` datetime NOT NULL,
  `rs_updateby` int(11) NOT NULL,
  `rs_status` int(2) NOT NULL COMMENT 'สถานะการจอง  ''0'' => ''จองเรียบร้อย'',         ''1'' => ''จ่ายเงินเรียบร้อย'',         ''2'' => ''ยกเลิกการจอง'',         ''3'' => ''เกินระยะเวลาการชำระเงิน'''
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COMMENT='ตารางเก็บข้อมูลการจอง';

--
-- Dumping data for table `reserve`
--

INSERT INTO `reserve` (`rs_id`, `rs_code`, `cus_id`, `v_id`, `rs_price`, `rs_usabledate`, `vp_idstart`, `vp_idend`, `vt_id`, `rs_createdate`, `rs_updateby`, `rs_status`) VALUES
(1, 'RES0000001', 7, 41, 1000, '2015-09-06', 11, 8, 3, '2015-09-06 07:20:00', 1, 2),
(2, 'RES0000000', 5, 48, 200, '2015-09-07', 6, 7, 3, '2015-09-07 19:43:11', 1, 2),
(3, 'RES0000003', 5, 48, 200, '2015-09-07', 7, 8, 3, '2015-09-07 19:52:57', 1, 2),
(25, 'RES0000013', 5, 39, 800, '2015-09-08', 7, 45, 12, '2015-09-08 22:09:13', 1, 0),
(26, 'RES0000014', 5, 39, 800, '2015-09-08', 7, 6, 12, '2015-09-08 22:11:25', 1, 0),
(27, 'RES0000015', 5, 39, 1400, '2015-09-08', 8, 6, 16, '2015-09-08 22:12:04', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reserve_chair`
--

CREATE TABLE IF NOT EXISTS `reserve_chair` (
  `rsc_id` int(11) NOT NULL,
  `vc_id` int(11) NOT NULL COMMENT 'รหัสที่นั่ง',
  `rs_id` int(11) NOT NULL COMMENT 'รหัสจอง',
  `rsc_usabledate` date NOT NULL COMMENT 'วันที่ใช้งาน'
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reserve_chair`
--

INSERT INTO `reserve_chair` (`rsc_id`, `vc_id`, `rs_id`, `rsc_usabledate`) VALUES
(1, 196, 2, '2015-09-07'),
(2, 197, 3, '2015-09-07'),
(25, 246, 25, '2015-09-08'),
(26, 239, 26, '2015-09-08'),
(27, 243, 26, '2015-09-08'),
(28, 232, 27, '2015-09-08');

-- --------------------------------------------------------

--
-- Table structure for table `reserve_pay`
--

CREATE TABLE IF NOT EXISTS `reserve_pay` (
  `vpay_id` int(11) NOT NULL,
  `rs_id` int(11) NOT NULL,
  `vp_paydate` date NOT NULL,
  `vp_paytime` varchar(10) NOT NULL,
  `vp_paymoney` int(11) NOT NULL,
  `vp_filename` varchar(255) NOT NULL,
  `vp_createdate` date NOT NULL,
  `vp_status` int(1) NOT NULL COMMENT 'สถานะการำระเงิน 1 = ผ่าน ,0 = ไม่ผ่าน'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reserve_pay`
--

INSERT INTO `reserve_pay` (`vpay_id`, `rs_id`, `vp_paydate`, `vp_paytime`, `vp_paymoney`, `vp_filename`, `vp_createdate`, `vp_status`) VALUES
(1, 2, '2015-10-27', '0000-00-00', 2000, 'C:\\xampp\\tmp\\php7D47.tmp', '2015-11-29', 1),
(2, 2, '0000-00-00', '11:11', 2000, '../uploads/sample-1.jpg', '2015-11-29', 1),
(3, 2, '0000-00-00', '11:11', 2000, '17-11-03sample-1.jpg', '2015-11-29', 1),
(4, 2, '2015-11-11', '12:00', 2000, '17-03-28sample-1.jpg', '2015-11-29', 1),
(5, 2, '2015-10-27', '11.00', 19999, '17-07-44_sample-1.jpg', '2015-11-29', 1),
(6, 2, '2015-10-28', '11.00', 9999, '17-08-54_sample-1.jpg', '2015-11-29', 1),
(7, 2, '2015-11-04', '11.00', 9999, '17-15-31_sample-1.jpg', '2015-11-29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `van`
--

CREATE TABLE IF NOT EXISTS `van` (
  `v_id` int(11) NOT NULL COMMENT 'รหัสรถตู้',
  `v_name` varchar(255) NOT NULL COMMENT 'ชื่อสายรถตู้',
  `v_detail` text NOT NULL COMMENT 'รายละเอียด',
  `v_company` int(11) NOT NULL COMMENT 'บริษัท',
  `v_chair` int(2) NOT NULL,
  `v_roadlength` int(11) NOT NULL DEFAULT '0' COMMENT 'ระยะทาง',
  `v_updatedate` date NOT NULL,
  `v_updateby` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `van`
--

INSERT INTO `van` (`v_id`, `v_name`, `v_detail`, `v_company`, `v_chair`, `v_roadlength`, `v_updatedate`, `v_updateby`) VALUES
(39, 'กรุงเทพ - สระแก้ว1111', 'กรุงเทพ - สระแก้ว', 1, 35, 11111, '2015-09-07', 1),
(40, 'ระยอง - จันทบุรี', 'จาก ระยอง ไป จันทบุรี', 2, 2, 60, '2015-09-09', 1),
(41, 'จาก กรุงเทพ -ไป เชียงใหม่', 'จาก กรุงเทพ -ไป เชียงใหม่', 1, 3, 100, '2015-09-09', 1),
(44, 'สายรถตู้ ระยอง - กรุงเทพ', 'สายรถตู้ ระยอง - กรุงเทพ', 2, 3, 250, '2015-09-09', 1),
(45, 'TEST ASC', 'TEST ASC', 1, 2, 1111, '2015-08-25', 1),
(46, 'TEST', 'TEST', 1, 2, 10000, '2015-09-05', 1),
(47, 'รถตู้ ยะลา - เชียงใหม่', 'รถตู้ ยะลา - เชียงใหม่', 4, 3, 10000, '2015-09-05', 1),
(48, 'TEST CREATE VAN', 'TEST CREATE VAN', 5, 2, 1000, '2015-09-07', 1),
(49, 'สายรถทัว ระยอง จันทร์', 'สายรถทัว ระยอง จันทร์', 2, 5, 1000, '2015-09-09', 1),
(50, 'กรุงเทพ ปัตตานี', 'กรุงเทพ ปัตตานี', 6, 2, 300, '2015-11-28', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=276 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `van_chair`
--

INSERT INTO `van_chair` (`vc_id`, `vc_x`, `vc_y`, `vc_label`, `v_id`) VALUES
(196, 1, 1, 'AA', 48),
(197, 2, 1, 'BB', 48),
(223, 1, 0, 'CC', 39),
(224, 2, 0, 'DD', 39),
(225, 3, 0, 'EE', 39),
(226, 1, 1, 'TT', 39),
(227, 2, 1, 'RR', 39),
(228, 3, 1, 'WW', 39),
(229, 4, 1, 'TT', 39),
(230, 1, 2, 'GG', 39),
(231, 2, 2, 'HH', 39),
(232, 3, 2, 'DD', 39),
(233, 4, 2, 'RR', 39),
(234, 1, 3, 'ZZ', 39),
(235, 2, 3, 'XX', 39),
(236, 3, 3, 'QQ', 39),
(237, 4, 3, 'PP', 39),
(238, 1, 4, 'SS', 39),
(239, 2, 4, 'DD', 39),
(240, 3, 4, 'MM', 39),
(241, 4, 4, 'OO', 39),
(242, 1, 5, 'UU', 39),
(243, 2, 5, 'YY', 39),
(244, 3, 5, 'VV', 39),
(245, 4, 5, 'LL', 39),
(246, 1, 6, 'II', 39),
(247, 2, 6, 'II', 39),
(248, 3, 6, 'AA', 39),
(249, 4, 6, 'KK', 39),
(250, 1, 7, 'FF', 39),
(251, 2, 7, 'SS', 39),
(252, 3, 7, 'DD', 39),
(253, 4, 7, 'JJ', 39),
(254, 1, 8, 'AAA', 39),
(255, 2, 8, 'BBB', 39),
(256, 3, 8, 'VV', 39),
(257, 4, 8, 'NN', 39),
(258, 1, 0, 'AA', 40),
(259, 2, 0, 'BB', 40),
(263, 1, 0, 'VV', 41),
(264, 2, 0, 'AA', 41),
(265, 3, 0, 'VV', 41),
(266, 1, 1, 'AA', 49),
(267, 2, 1, 'BB', 49),
(268, 3, 1, 'CC', 49),
(269, 4, 1, 'DD', 49),
(270, 2, 2, 'CC', 49),
(271, 1, 0, 'AA', 44),
(272, 2, 0, 'BB', 44),
(273, 3, 0, 'DD', 44),
(274, 1, 0, 'a1', 50),
(275, 2, 0, 'a2', 50);

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
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `van_place`
--

INSERT INTO `van_place` (`vp_id`, `vp_hierarchy`, `vp_kilomate`, `pvp_id`, `v_id`, `vp_updatedate`, `pvp_updateby`) VALUES
(6, 1, 0, 11, 48, '2015-09-07', 1),
(7, 2, 100, 20, 48, '2015-09-07', 1),
(8, 3, 200, 8, 48, '2015-09-07', 1),
(42, 1, 0, 8, 39, '2015-09-07', 1),
(43, 2, 100, 11, 39, '2015-09-07', 1),
(44, 3, 300, 7, 39, '2015-09-07', 1),
(45, 4, 700, 6, 39, '2015-09-07', 1),
(46, 1, 0, 8, 40, '2015-09-09', 1),
(47, 2, 0, 20, 40, '2015-09-09', 1),
(48, 3, 0, 19, 40, '2015-09-09', 1),
(52, 1, 0, 8, 41, '2015-09-09', 1),
(53, 2, 0, 9, 41, '2015-09-09', 1),
(54, 3, 0, 20, 41, '2015-09-09', 1),
(55, 1, 0, 3, 49, '2015-09-09', 1),
(56, 2, 0, 18, 49, '2015-09-09', 1),
(57, 3, 0, 13, 49, '2015-09-09', 1),
(58, 4, 0, 19, 49, '2015-09-09', 1),
(59, 5, 0, 20, 49, '2015-09-09', 1),
(60, 1, 0, 8, 44, '2015-09-09', 1),
(61, 2, 0, 20, 44, '2015-09-09', 1),
(62, 1, 0, 8, 50, '2015-11-28', 1),
(63, 2, 0, 14, 50, '2015-11-28', 1);

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
(1, 'van_price', 'ราคาค่าบริการรถตู้ ต่อ 1 กม', '3', '2015-11-29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `van_time`
--

CREATE TABLE IF NOT EXISTS `van_time` (
  `vt_id` int(11) NOT NULL,
  `v_id` int(11) NOT NULL,
  `vt_drivestart` time NOT NULL,
  `vt_driveend` time NOT NULL,
  `vt_driver` int(11) NOT NULL,
  `vt_updatedate` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `van_time`
--

INSERT INTO `van_time` (`vt_id`, `v_id`, `vt_drivestart`, `vt_driveend`, `vt_driver`, `vt_updatedate`) VALUES
(3, 41, '09:00:00', '20:00:00', 1, '2015-09-02'),
(4, 45, '23:00:00', '15:00:00', 1, '2015-09-02'),
(10, 39, '11:05:00', '23:58:00', 16, '2015-09-05'),
(11, 39, '05:25:00', '23:58:00', 16, '2015-09-06'),
(12, 39, '00:00:00', '07:55:00', 11, '2015-09-09'),
(13, 44, '00:00:00', '01:05:00', 6, '2015-09-05'),
(14, 44, '23:55:00', '11:00:00', 16, '2015-09-05'),
(15, 46, '00:00:00', '06:00:00', 6, '2015-09-05'),
(16, 39, '11:00:00', '11:55:00', 6, '2015-09-06'),
(17, 47, '00:00:00', '06:30:00', 11, '2015-09-05'),
(18, 39, '01:05:00', '18:30:00', 17, '2015-09-06'),
(19, 47, '12:00:00', '12:55:00', 16, '2015-09-06'),
(20, 48, '08:20:00', '09:40:00', 6, '2015-09-07'),
(21, 48, '10:50:00', '10:55:00', 6, '2015-09-07'),
(22, 48, '05:25:00', '23:55:00', 17, '2015-09-07'),
(24, 48, '11:55:00', '23:55:00', 17, '2015-09-07'),
(25, 48, '13:05:00', '11:55:00', 11, '2015-09-07'),
(26, 39, '00:55:00', '08:40:00', 16, '2015-09-08'),
(27, 49, '00:00:00', '18:00:00', 16, '2015-11-28');

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
  ADD PRIMARY KEY (`pv_id`), ADD KEY `pv_id` (`pv_id`);

--
-- Indexes for table `province_place`
--
ALTER TABLE `province_place`
  ADD PRIMARY KEY (`pvp_id`), ADD KEY `pv_id` (`pv_id`), ADD KEY `pv_id_2` (`pv_id`);

--
-- Indexes for table `reserve`
--
ALTER TABLE `reserve`
  ADD PRIMARY KEY (`rs_id`), ADD UNIQUE KEY `rs_code` (`rs_code`), ADD KEY `cus_id` (`cus_id`), ADD KEY `v_id` (`v_id`), ADD KEY `vp_idstart` (`vp_idstart`), ADD KEY `vp_idend` (`vp_idend`), ADD KEY `vt_time` (`vt_id`);

--
-- Indexes for table `reserve_chair`
--
ALTER TABLE `reserve_chair`
  ADD PRIMARY KEY (`rsc_id`), ADD KEY `vc_id` (`vc_id`), ADD KEY `rs_id` (`rs_id`);

--
-- Indexes for table `reserve_pay`
--
ALTER TABLE `reserve_pay`
  ADD PRIMARY KEY (`vpay_id`), ADD KEY `rs_id` (`rs_id`);

--
-- Indexes for table `van`
--
ALTER TABLE `van`
  ADD PRIMARY KEY (`v_id`);

--
-- Indexes for table `van_chair`
--
ALTER TABLE `van_chair`
  ADD PRIMARY KEY (`vc_id`), ADD KEY `v_id` (`v_id`);

--
-- Indexes for table `van_place`
--
ALTER TABLE `van_place`
  ADD PRIMARY KEY (`vp_id`), ADD KEY `pvp_id` (`pvp_id`), ADD KEY `v_id` (`v_id`);

--
-- Indexes for table `van_setting`
--
ALTER TABLE `van_setting`
  ADD PRIMARY KEY (`vs_id`);

--
-- Indexes for table `van_time`
--
ALTER TABLE `van_time`
  ADD PRIMARY KEY (`vt_id`), ADD KEY `v_id` (`v_id`), ADD KEY `vt_driver` (`vt_driver`), ADD KEY `vt_driver_2` (`vt_driver`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส',AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `province`
--
ALTER TABLE `province`
  MODIFY `pv_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT for table `province_place`
--
ALTER TABLE `province_place`
  MODIFY `pvp_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `reserve`
--
ALTER TABLE `reserve`
  MODIFY `rs_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `reserve_chair`
--
ALTER TABLE `reserve_chair`
  MODIFY `rsc_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `reserve_pay`
--
ALTER TABLE `reserve_pay`
  MODIFY `vpay_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `van`
--
ALTER TABLE `van`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสรถตู้',AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `van_chair`
--
ALTER TABLE `van_chair`
  MODIFY `vc_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=276;
--
-- AUTO_INCREMENT for table `van_place`
--
ALTER TABLE `van_place`
  MODIFY `vp_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `van_setting`
--
ALTER TABLE `van_setting`
  MODIFY `vs_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `van_time`
--
ALTER TABLE `van_time`
  MODIFY `vt_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `reserve`
--
ALTER TABLE `reserve`
ADD CONSTRAINT `reserve_ibfk_1` FOREIGN KEY (`cus_id`) REFERENCES `person` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `reserve_ibfk_2` FOREIGN KEY (`v_id`) REFERENCES `van` (`v_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `reserve_ibfk_5` FOREIGN KEY (`vt_id`) REFERENCES `van_time` (`vt_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reserve_chair`
--
ALTER TABLE `reserve_chair`
ADD CONSTRAINT `reserve_chair_ibfk_1` FOREIGN KEY (`vc_id`) REFERENCES `van_chair` (`vc_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `reserve_chair_ibfk_2` FOREIGN KEY (`rs_id`) REFERENCES `reserve` (`rs_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reserve_pay`
--
ALTER TABLE `reserve_pay`
ADD CONSTRAINT `reserve_pay_ibfk_1` FOREIGN KEY (`rs_id`) REFERENCES `reserve` (`rs_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `van_chair`
--
ALTER TABLE `van_chair`
ADD CONSTRAINT `van_chair_ibfk_1` FOREIGN KEY (`v_id`) REFERENCES `van` (`v_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `van_place`
--
ALTER TABLE `van_place`
ADD CONSTRAINT `van_place_ibfk_1` FOREIGN KEY (`pvp_id`) REFERENCES `province_place` (`pvp_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `van_place_ibfk_2` FOREIGN KEY (`v_id`) REFERENCES `van` (`v_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `van_time`
--
ALTER TABLE `van_time`
ADD CONSTRAINT `van_time_ibfk_1` FOREIGN KEY (`v_id`) REFERENCES `van` (`v_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `van_time_ibfk_2` FOREIGN KEY (`vt_driver`) REFERENCES `person` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
