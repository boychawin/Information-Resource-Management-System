-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 25, 2020 at 05:55 PM
-- Server version: 10.4.12-MariaDB
-- PHP Version: 7.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `boychawi_irms`
--

-- --------------------------------------------------------

--
-- Table structure for table `accepted_booking`
--

CREATE TABLE `accepted_booking` (
  `id` int(11) NOT NULL,
  `booking_id` bigint(20) NOT NULL,
  `staff_id` bigint(20) NOT NULL,
  `booking_type` varchar(250) NOT NULL,
  `num_days` int(11) NOT NULL,
  `date_accepted` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `admin_id` bigint(20) NOT NULL,
  `title` varchar(20) NOT NULL,
  `fname` varchar(150) NOT NULL,
  `lname` varchar(150) NOT NULL,
  `username` varchar(70) NOT NULL,
  `password` varchar(250) NOT NULL,
  `position` varchar(100) NOT NULL,
  `location` varchar(255) NOT NULL,
  `Faculty` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` int(10) UNSIGNED NOT NULL,
  `date_registered` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_id`, `title`, `fname`, `lname`, `username`, `password`, `position`, `location`, `Faculty`, `email`, `phone`, `date_registered`) VALUES
(1, 152122333134, 'Mr', 'วิศิษฎ์', 'ปวงศรี', 'admin', '$2y$10$wShqqf2bfVHo98.k19TLXOdnZU76YPee3dZIz5ClkpZPIRC12YpI.', 'นักวิชาการคอมพิวเตอร์', 'อาคารบรรณราชนครินทร์ (ห้องสมุด)', 'มหาวิทยาลัยราชภัฏสกลนคร', 'asnru0298@gmail.com', 928898946, '2020-05-22');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `booking_id` bigint(20) NOT NULL,
  `booking_type` varchar(100) NOT NULL,
  `Room_number` int(10) NOT NULL,
  `Capacity_person` int(100) NOT NULL,
  `Room_details` varchar(250) NOT NULL,
  `Room_type` varchar(100) NOT NULL,
  `building` varchar(100) NOT NULL,
  `class` int(10) NOT NULL,
  `allowed_days` varchar(100) NOT NULL,
  `current_days` varchar(110) NOT NULL,
  `allowed_monthly_days` varchar(100) NOT NULL,
  `for_staff_level` varchar(200) NOT NULL,
  `auto_update` bigint(20) NOT NULL,
  `photo` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `booking_id`, `booking_type`, `Room_number`, `Capacity_person`, `Room_details`, `Room_type`, `building`, `class`, `allowed_days`, `current_days`, `allowed_monthly_days`, `for_staff_level`, `auto_update`, `photo`) VALUES
(1, 1, '-', 0, 0, '', '', '', 1, '15', '15', '20200615', 'non-supervisor', 1594801807, '20200615_8.jpg'),
(2, 1011, 'โต๊ะหน้าอาคารบรรณราชนครินทร์', 1, 6, 'พัดลม มีจำนวน 5 ตัว หลอดไฟ มีจำนวน 8 หลอด กล่อง wifi มีจำนวน 2 กล่อง (true และ ais)', 'นั่งทำงาน', 'บรรณราชนครินทร์', 1, '15', '15', '20200615', 'supervisor', 1594802418, '20200620_7.jpg'),
(3, 1012, 'โต๊ะหน้าอาคารบรรณราชนครินทร์', 2, 6, 'พัดลม มีจำนวน 5 ตัว หลอดไฟ มีจำนวน 8 หลอด กล่อง wifi มีจำนวน 2 กล่อง (true และ ais)', 'นั่งทำงาน', 'บรรณราชนครินทร์', 1, '11', '11', '20200611', 'supervisor', 1594466076, '20200611_3.jpg'),
(4, 1013, 'โต๊ะหน้าอาคารบรรณราชนครินทร์', 3, 5, 'อุปกรณ์สนับสนุนการใช้บริการทรัพยากรสารสนเทศ เช่น พัดลม มีจำนวน 5 ตัว หลอดไฟ มีจำนวน 8 หลอด กล่อง wifi มีจำนวน 2 กล่อง (true และ ais) โต๊ะมีจำนวน 5 ตัว', 'นั่งทำงาน', 'บรรณราชนครินทร์', 1, '11', '11', '20200611', 'non-supervisor', 1594467592, '20200611_1.jpg'),
(5, 1014, 'โต๊ะหน้าอาคารบรรณราชนครินทร์', 4, 6, 'อุปกรณ์สนับสนุนการใช้บริการทรัพยากรสารสนเทศ เช่น พัดลม มีจำนวน 5 ตัว หลอดไฟ มีจำนวน 8 หลอด กล่อง wifi มีจำนวน 2 กล่อง (true และ ais) โต๊ะมีจำนวน 5 ตัว', 'นั่งทำงาน', 'บรรณราชนครินทร์', 1, '15', '15', '20200615', 'supervisor', 1594801954, '20200615_9.jpg'),
(6, 1015, 'โต๊ะหน้าอาคารบรรณราชนครินทร์', 5, 6, 'อุปกรณ์สนับสนุนการใช้บริการทรัพยากรสารสนเทศ เช่น พัดลม มีจำนวน 5 ตัว หลอดไฟ มีจำนวน 8 หลอด กล่อง wifi มีจำนวน 2 กล่อง (true และ ais) โต๊ะมีจำนวน 5 ตัว', 'นั่งทำงาน', 'บรรณราชนครินทร์', 1, '15', '15', '20200615', 'supervisor', 1594802035, '20200615_7.jpg'),
(7, 1016, 'โต๊ะหน้าอาคารบรรณราชนครินทร์', 6, 6, 'อุปกรณ์สนับสนุนการใช้บริการทรัพยากรสารสนเทศ เช่น พัดลม มีจำนวน 5 ตัว หลอดไฟ มีจำนวน 8 หลอด กล่อง wifi มีจำนวน 2 กล่อง (true และ ais) โต๊ะมีจำนวน 5 ตัว', 'นั่งทำงาน', 'บรรณราชนครินทร์', 1, '15', '15', '20200615', 'supervisor', 1594802059, '20200615_10.jpg'),
(8, 1041, 'ห้องสมุดสร้างสุข', 1, 30, 'อุปกรณ์สนับสนุนการใช้บริการทรัพยากรสารสนเทศ เช่น\r\nพัดลม \r\nหลอดไฟ \r\nกล่อง wifi มีจำนวน 2 กล่อง (true และ ais)\r\nโต๊ะ-เก้าอี้ ', 'ห้องประชุมสัมมนา เชิงบรรยาย', 'บรรณราชนครินทร์', 4, '0', '0', '20200515', 'non-supervisor', 1592108681, '20200515_11.jpg'),
(9, 1042, 'ห้องสืบค้นส่วนบุคคล', 1, 2, 'สำหรับนักศึกอาจารย์ค้นคว้าอ่านหนังสือส่วนบุคคล ', 'ห้องค้นคว้า', 'บรรณราชนครินทร์', 4, '15', '15', '20200515', 'non-supervisor', 1592130482, '20200812_17.jpg'),
(10, 1043, 'ห้องสืบค้นส่วนบุคคล', 2, 2, 'สำหรับนักศึกอาจารย์ค้นคว้าอ่านหนังสือส่วนบุคคล ', 'ห้องค้นคว้า', 'บรรณราชนครินทร์', 4, '15', '15', '20200515', 'non-supervisor', 1592136444, '20200812_17.jpg'),
(11, 1044, 'ห้องสืบค้นส่วนบุคคล', 3, 2, 'สำหรับนักศึกอาจารย์ค้นคว้าอ่านหนังสือส่วนบุคคล ', 'ห้องค้นคว้า', 'บรรณราชนครินทร์', 4, '15', '15', '20200515', 'supervisor', 1592136916, '20200812_17.jpg'),
(12, 1045, 'ห้องสืบค้นส่วนบุคคล', 4, 2, 'สำหรับนักศึกอาจารย์ค้นคว้าอ่านหนังสือส่วนบุคคล  ', 'ห้องค้นคว้า', 'บรรณราชนครินทร์', 4, '15', '15', '20200615', 'non-supervisor', 1594801807, '20200812_17.jpg'),
(13, 1046, 'ห้องสืบค้นส่วนบุคคล', 5, 2, 'สำหรับนักศึกอาจารย์ค้นคว้าอ่านหนังสือส่วนบุคคล ', 'ห้องค้นคว้า', 'บรรณราชนครินทร์', 4, '15', '15', '20200615', 'non-supervisor', 1594802418, '20200812_17.jpg'),
(14, 1047, 'ห้องสืบค้นส่วนบุคคล', 6, 2, 'สำหรับนักศึกอาจารย์ค้นคว้าอ่านหนังสือส่วนบุคคล ', 'ห้องค้นคว้า', 'บรรณราชนครินทร์', 4, '15', '15', '20200615', 'supervisor', 1594466076, '20200812_17.jpg'),
(15, 1048, 'ห้องสืบค้นส่วนบุคคล', 7, 2, 'สำหรับนักศึกอาจารย์ค้นคว้าอ่านหนังสือส่วนบุคคล ', 'ห้องค้นคว้า', 'บรรณราชนครินทร์', 4, '15', '15', '20200615', 'non-supervisor', 1594467592, '20200812_17.jpg'),
(16, 1049, 'ห้องสืบค้นกลุ่มย่อย', 1, 10, 'สำหรับนักศึกอาจารย์ค้นคว้าอ่านหนังสือกลุ่ม ', 'ห้องค้นคว้า', 'บรรณราชนครินทร์', 4, '15', '15', '20200615', 'non-supervisor', 1594801954, '20200812_14.jpg'),
(17, 10410, 'ห้องสืบค้นกลุ่มย่อย', 2, 10, 'สำหรับนักศึกอาจารย์ค้นคว้าอ่านหนังสือกลุ่ม ', 'ห้องค้นคว้า', 'บรรณราชนครินทร์', 4, '15', '15', '20200615', 'non-supervisor', 1594802035, '20200812_15.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `booking_applications`
--

CREATE TABLE `booking_applications` (
  `id` int(11) NOT NULL,
  `booking_id` bigint(20) NOT NULL,
  `staff_id` bigint(20) NOT NULL,
  `staff_name` varchar(100) NOT NULL,
  `booking_type` varchar(250) NOT NULL,
  `booking_start_date` datetime NOT NULL,
  `booking_end_date` datetime NOT NULL,
  `action` enum('accept','reject') DEFAULT NULL,
  `status` enum('accept','reject','Suspend') DEFAULT NULL,
  `date_requested` datetime NOT NULL,
  `numberp` varchar(100) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `Faculty_b` varchar(100) NOT NULL,
  `startime` varchar(100) NOT NULL,
  `endtime` varchar(100) NOT NULL,
  `reason_reject` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking_applications`
--

INSERT INTO `booking_applications` (`id`, `booking_id`, `staff_id`, `staff_name`, `booking_type`, `booking_start_date`, `booking_end_date`, `action`, `status`, `date_requested`, `numberp`, `purpose`, `Faculty_b`, `startime`, `endtime`, `reason_reject`) VALUES
(1, 1014, 1471200375194, 'ชวิน หิตะคุณ ', 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 4 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', '2020-09-19 21:44:00', '2020-09-19 22:47:00', 'accept', 'accept', '2020-09-19 21:43:54', '1', 'ทำงาน', 'วิทยาศาสตร์และเทคโนโลยี ', '2020-09-19T21:44', '2020-09-19T22:47', NULL),
(2, 1011, 1471200375194, 'ชวิน หิตะคุณ ', 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 1 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', '2020-09-20 11:50:00', '2020-09-20 12:49:00', 'accept', 'accept', '2020-09-20 10:49:53', '6', 'ทำงาน', 'วิทยาศาสตร์และเทคโนโลยี ', '2020-09-20T11:50', '2020-09-20T12:49', NULL),
(3, 1011, 3201821131600, 'วีระ กงลีมา ', 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 1 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', '2020-09-20 12:55:00', '2020-09-20 13:56:00', 'accept', 'accept', '2020-09-20 10:53:38', '4', 'ทำงาน', 'สำนักวิทยบริการและเทคโนโลยีสารสนเทศ ', '2020-09-20T12:55', '2020-09-20T13:56', NULL),
(4, 1012, 3201821131600, 'วีระ กงลีมา ', 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 2 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', '2020-09-20 10:54:00', '2020-09-20 11:53:00', 'accept', 'accept', '2020-09-20 10:53:51', '6', 'ทำงาน', 'สำนักวิทยบริการและเทคโนโลยีสารสนเทศ ', '2020-09-20T10:54', '2020-09-20T11:53', NULL),
(5, 1012, 3201821131600, 'วีระ กงลีมา ', 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 2 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', '2020-09-20 12:53:00', '2020-09-20 14:53:00', 'accept', 'accept', '2020-09-20 10:54:10', '3', 'ทำงาน', 'สำนักวิทยบริการและเทคโนโลยีสารสนเทศ ', '2020-09-20T12:53', '2020-09-20T14:53', NULL),
(6, 1013, 3201821131600, 'วีระ กงลีมา ', 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 3 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 5 คน', '2020-09-20 11:54:00', '2020-09-20 12:54:00', 'accept', 'accept', '2020-09-20 10:54:32', '3', 'ทำงาน', 'สำนักวิทยบริการและเทคโนโลยีสารสนเทศ ', '2020-09-20T11:54', '2020-09-20T12:54', NULL),
(7, 1014, 3201821131600, 'วีระ กงลีมา ', 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 4 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', '2020-09-20 11:54:00', '2020-09-20 12:54:00', 'accept', 'accept', '2020-09-20 10:54:50', '1', 'ทำงาน', 'สำนักวิทยบริการและเทคโนโลยีสารสนเทศ ', '2020-09-20T11:54', '2020-09-20T12:54', NULL),
(8, 1015, 3201821131600, 'วีระ กงลีมา ', 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 5 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', '2020-09-20 11:54:00', '2020-09-20 12:54:00', 'accept', 'accept', '2020-09-20 10:55:12', '5', 'ทำงาน', 'สำนักวิทยบริการและเทคโนโลยีสารสนเทศ ', '2020-09-20T11:54', '2020-09-20T12:54', NULL),
(9, 1016, 3201821131600, 'วีระ กงลีมา ', 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 6 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', '2020-09-20 11:55:00', '2020-09-20 12:55:00', 'accept', 'accept', '2020-09-20 10:55:31', '1', 'ทำงาน', 'สำนักวิทยบริการและเทคโนโลยีสารสนเทศ ', '2020-09-20T11:55', '2020-09-20T12:55', NULL),
(10, 1016, 3201821131600, 'วีระ กงลีมา ', 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 6 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', '2020-09-20 13:55:00', '2020-09-20 16:55:00', 'accept', 'accept', '2020-09-20 10:55:57', '4', 'ทำงาน', 'สำนักวิทยบริการและเทคโนโลยีสารสนเทศ ', '2020-09-20T13:55', '2020-09-20T16:55', NULL),
(11, 1015, 3201821131600, 'วีระ กงลีมา ', 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 5 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', '2020-09-20 13:56:00', '2020-09-20 16:56:00', 'accept', 'accept', '2020-09-20 10:56:35', '3', 'ทำงาน', 'สำนักวิทยบริการและเทคโนโลยีสารสนเทศ ', '2020-09-20T13:56', '2020-09-20T16:56', NULL),
(12, 1014, 3201821131600, 'วีระ กงลีมา ', 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 4 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', '2020-09-20 14:57:00', '2020-09-20 16:57:00', 'accept', 'accept', '2020-09-20 10:57:37', '6', 'ทำงาน', 'สำนักวิทยบริการและเทคโนโลยีสารสนเทศ ', '2020-09-20T14:57', '2020-09-20T16:57', NULL),
(13, 1013, 3201821131600, 'วีระ กงลีมา ', 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 3 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 5 คน', '2020-09-20 15:02:00', '2020-09-20 17:02:00', 'accept', 'accept', '2020-09-20 11:02:40', '1', 'ทำงาน', 'สำนักวิทยบริการและเทคโนโลยีสารสนเทศ ', '2020-09-20T15:02', '2020-09-20T17:02', NULL),
(14, 1012, 3201821131600, 'วีระ กงลีมา ', 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 2 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', '2020-09-20 16:03:00', '2020-09-20 18:03:00', 'accept', 'accept', '2020-09-20 11:04:05', '4', 'ทำงาน', 'สำนักวิทยบริการและเทคโนโลยีสารสนเทศ ', '2020-09-20T16:03', '2020-09-20T18:03', NULL),
(15, 1041, 3201821131600, 'วีระ กงลีมา ', 'ห้องสมุดสร้างสุข ลำดับที่ 1 ตึก บรรณราชนครินทร์ ชั้น 4 ที่นั่ง 30 คน', '2020-09-20 14:42:00', '2020-09-20 15:41:00', 'reject', NULL, '2020-09-20 13:41:43', '4', 'ทำงาน', 'สำนักวิทยบริการและเทคโนโลยีสารสนเทศ ', '2020-09-20T14:42', '2020-09-20T15:41', 'วันนี้ปิด'),
(16, 1042, 1471200375194, 'ชวิน หิตะคุณ ', 'ห้องสืบค้นส่วนบุคคล ลำดับที่ 1 ตึก บรรณราชนครินทร์ ชั้น 4 ที่นั่ง 2 คน', '2020-09-20 14:50:00', '2020-09-20 15:49:00', 'accept', 'accept', '2020-09-20 14:49:25', '1', 'ทำงาน', 'วิทยาศาสตร์และเทคโนโลยี ', '2020-09-20T14:50', '2020-09-20T15:49', NULL),
(17, 1043, 1471200375194, 'ชวิน หิตะคุณ ', 'ห้องสืบค้นส่วนบุคคล ลำดับที่ 2 ตึก บรรณราชนครินทร์ ชั้น 4 ที่นั่ง 2 คน', '2020-09-20 14:50:00', '2020-09-20 15:49:00', 'accept', 'accept', '2020-09-20 14:49:35', '1', 'ทำงาน', 'วิทยาศาสตร์และเทคโนโลยี ', '2020-09-20T14:50', '2020-09-20T15:49', NULL),
(18, 1044, 1471200375194, 'ชวิน หิตะคุณ ', 'ห้องสืบค้นส่วนบุคคล ลำดับที่ 3 ตึก บรรณราชนครินทร์ ชั้น 4 ที่นั่ง 2 คน', '2020-09-20 14:51:00', '2020-09-20 15:50:00', 'accept', 'accept', '2020-09-20 14:50:22', '1', 'ทำงาน', 'วิทยาศาสตร์และเทคโนโลยี ', '2020-09-20T14:51', '2020-09-20T15:50', NULL),
(19, 1045, 1471200375194, 'ชวิน หิตะคุณ ', 'ห้องสืบค้นส่วนบุคคล ลำดับที่ 4 ตึก บรรณราชนครินทร์ ชั้น 4 ที่นั่ง 2 คน', '2020-09-20 14:51:00', '2020-09-20 15:50:00', 'accept', 'accept', '2020-09-20 14:50:31', '1', 'ทำงาน', 'วิทยาศาสตร์และเทคโนโลยี ', '2020-09-20T14:51', '2020-09-20T15:50', NULL),
(20, 1046, 1471200375194, 'ชวิน หิตะคุณ ', 'ห้องสืบค้นส่วนบุคคล ลำดับที่ 5 ตึก บรรณราชนครินทร์ ชั้น 4 ที่นั่ง 2 คน', '2020-09-20 14:51:00', '2020-09-20 15:50:00', 'accept', 'reject', '2020-09-20 14:50:42', '1', 'ทำงาน', 'วิทยาศาสตร์และเทคโนโลยี ', '2020-09-20T14:51', '2020-09-20T15:50', NULL),
(21, 1047, 1471200375194, 'ชวิน หิตะคุณ ', 'ห้องสืบค้นส่วนบุคคล ลำดับที่ 6 ตึก บรรณราชนครินทร์ ชั้น 4 ที่นั่ง 2 คน', '2020-09-20 14:51:00', '2020-09-20 15:50:00', 'accept', 'reject', '2020-09-20 14:50:57', '1', 'ทำงาน', 'วิทยาศาสตร์และเทคโนโลยี ', '2020-09-20T14:51', '2020-09-20T15:50', NULL),
(22, 1048, 1471200375194, 'ชวิน หิตะคุณ ', 'ห้องสืบค้นส่วนบุคคล ลำดับที่ 7 ตึก บรรณราชนครินทร์ ชั้น 4 ที่นั่ง 2 คน', '2020-09-20 14:52:00', '2020-09-20 15:51:00', 'reject', NULL, '2020-09-20 14:51:27', '1', 'ทำงาน', 'วิทยาศาสตร์และเทคโนโลยี ', '2020-09-20T14:52', '2020-09-20T15:51', NULL),
(23, 1049, 1471200375194, 'ชวิน หิตะคุณ ', 'ห้องสืบค้นกลุ่มย่อย ลำดับที่ 1 ตึก บรรณราชนครินทร์ ชั้น 4 ที่นั่ง 10 คน', '2020-09-20 14:53:00', '2020-09-20 15:51:00', 'reject', NULL, '2020-09-20 14:51:44', '1', 'ทำงาน', 'วิทยาศาสตร์และเทคโนโลยี ', '2020-09-20T14:53', '2020-09-20T15:51', NULL),
(24, 10410, 1471200375194, 'ชวิน หิตะคุณ ', 'ห้องสืบค้นกลุ่มย่อย ลำดับที่ 2 ตึก บรรณราชนครินทร์ ชั้น 4 ที่นั่ง 10 คน', '2020-09-20 14:54:00', '2020-09-20 15:51:00', 'reject', NULL, '2020-09-20 14:51:57', '3', 'ทำงาน', 'วิทยาศาสตร์และเทคโนโลยี ', '2020-09-20T14:54', '2020-09-20T15:51', NULL),
(25, 1016, 3201821131600, 'วีระ กงลีมา ', 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 6 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', '2020-09-20 17:08:00', '2020-09-20 18:08:00', 'accept', 'accept', '2020-09-20 16:08:30', '1', 'ทำงาน', 'สำนักวิทยบริการและเทคโนโลยีสารสนเทศ ', '2020-09-20T17:08', '2020-09-20T18:08', NULL),
(26, 1016, 3201821131600, 'วีระ กงลีมา ', 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 6 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', '2020-09-20 18:50:00', '2020-09-20 20:50:00', 'reject', NULL, '2020-09-20 16:50:44', '4', 'ทำงาน', 'สำนักวิทยบริการและเทคโนโลยีสารสนเทศ ', '2020-09-20T18:50', '2020-09-20T20:50', ''),
(27, 1016, 1471200375194, 'ชวิน หิตะคุณ ', 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 6 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', '2020-09-21 17:24:00', '2020-09-21 18:24:00', 'accept', NULL, '2020-09-21 15:24:55', '4', 'ทำงาน', 'วิทยาศาสตร์และเทคโนโลยี ', '2020-09-21T17:24', '2020-09-21T18:24', NULL),
(28, 1011, 1471200375194, 'ชวิน หิตะคุณ ', 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 1 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', '2020-09-23 12:17:00', '2020-09-23 15:17:00', 'accept', NULL, '2020-09-23 11:19:26', '4', 'ทำงาน', 'วิทยาศาสตร์และเทคโนโลยี ', '2020-09-23T12:17', '2020-09-23T15:17', NULL),
(29, 1011, 1471200375194, 'ชวิน หิตะคุณ ', 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 1 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', '2020-11-08 17:40:00', '2020-11-08 18:41:00', NULL, NULL, '2020-11-08 16:41:29', '6', 'ทำงาน', 'วิทยาศาสตร์และเทคโนโลยี ', '2020-11-08T17:40', '2020-11-08T18:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `staff_id` bigint(20) NOT NULL,
  `title` varchar(20) NOT NULL,
  `fname` varchar(150) NOT NULL,
  `lname` varchar(150) NOT NULL,
  `username` varchar(70) NOT NULL,
  `password` varchar(250) NOT NULL,
  `position` varchar(100) NOT NULL,
  `location` varchar(255) NOT NULL,
  `ins` varchar(100) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `country_code` varchar(100) NOT NULL,
  `phone` int(10) NOT NULL,
  `Faculty` varchar(100) NOT NULL,
  `field_study` varchar(255) DEFAULT NULL,
  `supervisor` varchar(200) DEFAULT NULL,
  `staff_level` enum('supervisor','non-supervisor','non','noadmin') DEFAULT NULL,
  `date_registered` date NOT NULL,
  `total_reject` varchar(100) NOT NULL,
  `day_reject` varchar(100) NOT NULL,
  `day_rejectend` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `staff_id`, `title`, `fname`, `lname`, `username`, `password`, `position`, `location`, `ins`, `email`, `country_code`, `phone`, `Faculty`, `field_study`, `supervisor`, `staff_level`, `date_registered`, `total_reject`, `day_reject`, `day_rejectend`) VALUES
(1, 3201821131600, 'Mr', 'วีระ', 'กงลีมา', 'staff', '$2y$10$H3GeyzVxk0ISY5CGF5ItG.6vkvHY59QXhj07DBHyxsXa40U1NPgGG', 'เจ้าหน้าที่', 'สำนักวิทยบริการและเทคโนโลยีสารสนเทศ\r\nมหาวิทยาลัยราชภัฏสกลนคร\r\nเลขที่ 680 ตำบลธาตุเชิงชุม อำเภอเมืองสกลนคร\r\nจังหวัดสกลนคร รหัสไปรษณีย์ 47000', NULL, 'chawinhita112233@gmail.com', 'AIS', 933357010, 'สำนักวิทยบริการและเทคโนโลยีสารสนเทศ', NULL, 'N/A', 'supervisor', '2020-04-01', '9', '12-06-2020', '12-06-2020'),
(2, 1471200375194, 'Mr', 'ชวิน', 'หิตะคุณ', 'user', '$2y$10$k/FOS9czHy3PR9N.8.gjwuChrmYZ3mw2m.1GEoTMTcNy3grCupLSq', 'นักศึกษา', '37/6 สกลนคร', NULL, 'chawinhita1122@gmail.com', 'AIS', 902289893, 'วิทยาศาสตร์และเทคโนโลยี', NULL, 'N/A', 'non-supervisor', '2020-04-01', '0', '', ''),
(3, 1471200378943, 'นาย', 'ธีระ', 'หิตะคุณ', 'user1122', '$2y$10$EdMgsfU4FdveUQax./IzQ.aND2j7nNvFL7/X9UmVx16jePmP5Xb4K', 'นักศึกษา', '38', '', 'chawintrips@gmail.com', 'AIS', 902289656, 'คณะวิทยาการจัดการ', '', NULL, NULL, '2020-09-23', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `job_description`
--

CREATE TABLE `job_description` (
  `id` int(11) NOT NULL,
  `staff_id` bigint(20) NOT NULL,
  `staff_level` enum('supervisor','non-supervisor') NOT NULL,
  `salary_level` decimal(45,2) NOT NULL,
  `date_joined` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `job_description`
--

INSERT INTO `job_description` (`id`, `staff_id`, `staff_level`, `salary_level`, `date_joined`) VALUES
(1, 3201821131600, 'supervisor', '1500.00', '2017-10-30'),
(2, 4201804045945, 'non-supervisor', '5000.00', '2018-03-05');

-- --------------------------------------------------------

--
-- Table structure for table `password_recovery_meta`
--

CREATE TABLE `password_recovery_meta` (
  `id` int(11) NOT NULL,
  `token` varchar(2000) NOT NULL,
  `expiry` bigint(20) DEFAULT NULL,
  `email` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `password_recovery_meta`
--

INSERT INTO `password_recovery_meta` (`id`, `token`, `expiry`, `email`) VALUES
(1, '12345', 123, 'chawin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `picture_place`
--

CREATE TABLE `picture_place` (
  `id` int(2) NOT NULL,
  `name` varchar(100) NOT NULL,
  `photo` varchar(500) NOT NULL,
  `details` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `picture_place`
--

INSERT INTO `picture_place` (`id`, `name`, `photo`, `details`) VALUES
(1, 'โต๊ะหน้าอาคารบรรณราชนครินทร์  ', '20200507_3.jpg', 'อุปกรณ์สนับสนุนการใช้บริการทรัพยากรสารสนเทศ เช่น \r\nพัดลม มีจำนวน 5 ตัว\r\nหลอดไฟ มีจำนวน   8 หลอด\r\nกล่อง wifi มีจำนวน 2 กล่อง (true และ ais)\r\nโต๊ ะมีจำนวน 5 ตัว '),
(2, 'ห้องสืบค้นเดียว ชัน 4 ', '20200507_17.jpg', 'อุปกรณ์สนับสนุนการใช้บริการทรัพยากรสารสนเทศ เช่น\r\nพัดลม \r\nหลอดไฟ \r\nกล่อง wifi มีจำนวน 2 กล่อง (true และ ais)\r\nโต๊ะ-เก้าอี้'),
(3, 'ห้องสืบค้นกลุ่ม ชั้น 4', '20200507_14.jpg', 'อุปกรณ์สนับสนุนการใช้บริการทรัพยากรสารสนเทศ เช่น\r\nพัดลม \r\nหลอดไฟ \r\nกล่อง wifi มีจำนวน 2 กล่อง (true และ ais)\r\nโต๊ะ-เก้าอี้'),
(4, 'ห้องประชุมสร้างสุข ชั้น 4', '20200507_11.jpg', 'อุปกรณ์สนับสนุนการใช้บริการทรัพยากรสารสนเทศ เช่น\r\nพัดลม \r\nหลอดไฟ \r\nกล่อง wifi มีจำนวน 2 กล่อง (true และ ais)\r\nโต๊ะ-เก้าอี้');

-- --------------------------------------------------------

--
-- Table structure for table `recommended_booking`
--

CREATE TABLE `recommended_booking` (
  `id` int(11) NOT NULL,
  `booking_id` bigint(20) NOT NULL,
  `booking_type` varchar(250) NOT NULL,
  `staff_id` bigint(20) NOT NULL,
  `recommended_by` varchar(250) NOT NULL,
  `num_days` int(11) NOT NULL,
  `why_recommend` varchar(1000) NOT NULL,
  `date_recommended` varchar(25) NOT NULL,
  `status` enum('accepted','rejected') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recommended_booking`
--

INSERT INTO `recommended_booking` (`id`, `booking_id`, `booking_type`, `staff_id`, `recommended_by`, `num_days`, `why_recommend`, `date_recommended`, `status`) VALUES
(1, 1014, 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 4 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', 1471200375194, 'staff', 0, '', '20-09-2020', NULL),
(2, 1014, 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 4 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', 1471200375194, 'staff', 0, '', '20-09-2020', NULL),
(3, 1011, 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 1 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', 1471200375194, 'staff', 0, '', '20-09-2020', NULL),
(4, 1011, 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 1 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', 3201821131600, 'staff', 0, '', '20-09-2020', NULL),
(5, 1012, 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 2 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', 3201821131600, 'staff', 0, '', '20-09-2020', NULL),
(6, 1012, 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 2 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', 3201821131600, 'staff', 0, '', '20-09-2020', NULL),
(7, 1013, 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 3 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 5 คน', 3201821131600, 'staff', 0, '', '20-09-2020', NULL),
(8, 1014, 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 4 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', 3201821131600, 'staff', 0, '', '20-09-2020', NULL),
(9, 1015, 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 5 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', 3201821131600, 'staff', 0, '', '20-09-2020', NULL),
(10, 1016, 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 6 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', 3201821131600, 'staff', 0, '', '20-09-2020', NULL),
(11, 1016, 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 6 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', 3201821131600, 'staff', 0, '', '20-09-2020', NULL),
(12, 1014, 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 4 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', 3201821131600, 'staff', 0, '', '20-09-2020', NULL),
(13, 1015, 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 5 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', 3201821131600, 'staff', 0, '', '20-09-2020', NULL),
(14, 1013, 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 3 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 5 คน', 3201821131600, 'staff', 0, '', '20-09-2020', NULL),
(15, 1012, 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 2 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', 3201821131600, 'staff', 0, '', '20-09-2020', NULL),
(16, 1011, 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 1 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', 1471200375194, 'staff', 0, '', '20-09-2020', NULL),
(17, 1011, 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 1 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', 3201821131600, 'staff', 0, '', '20-09-2020', NULL),
(18, 1012, 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 2 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', 3201821131600, 'staff', 0, '', '20-09-2020', NULL),
(19, 1012, 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 2 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', 3201821131600, 'staff', 0, '', '20-09-2020', NULL),
(20, 1013, 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 3 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 5 คน', 3201821131600, 'staff', 0, '', '20-09-2020', NULL),
(21, 1014, 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 4 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', 3201821131600, 'staff', 0, '', '20-09-2020', NULL),
(22, 1015, 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 5 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', 3201821131600, 'staff', 0, '', '20-09-2020', NULL),
(23, 1016, 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 6 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', 3201821131600, 'staff', 0, '', '20-09-2020', NULL),
(24, 1016, 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 6 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', 3201821131600, 'staff', 0, '', '20-09-2020', NULL),
(25, 1013, 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 3 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 5 คน', 3201821131600, 'staff', 0, '', '20-09-2020', NULL),
(26, 1014, 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 4 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', 3201821131600, 'staff', 0, '', '20-09-2020', NULL),
(27, 1015, 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 5 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', 3201821131600, 'staff', 0, '', '20-09-2020', NULL),
(28, 1012, 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 2 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', 3201821131600, 'staff', 0, '', '20-09-2020', NULL),
(29, 1042, 'ห้องสืบค้นส่วนบุคคล ลำดับที่ 1 ตึก บรรณราชนครินทร์ ชั้น 4 ที่นั่ง 2 คน', 1471200375194, 'staff', 0, '', '20-09-2020', NULL),
(30, 1043, 'ห้องสืบค้นส่วนบุคคล ลำดับที่ 2 ตึก บรรณราชนครินทร์ ชั้น 4 ที่นั่ง 2 คน', 1471200375194, 'staff', 0, '', '20-09-2020', NULL),
(31, 1044, 'ห้องสืบค้นส่วนบุคคล ลำดับที่ 3 ตึก บรรณราชนครินทร์ ชั้น 4 ที่นั่ง 2 คน', 1471200375194, 'staff', 0, '', '20-09-2020', NULL),
(32, 1045, 'ห้องสืบค้นส่วนบุคคล ลำดับที่ 4 ตึก บรรณราชนครินทร์ ชั้น 4 ที่นั่ง 2 คน', 1471200375194, 'staff', 0, '', '20-09-2020', NULL),
(33, 1046, 'ห้องสืบค้นส่วนบุคคล ลำดับที่ 5 ตึก บรรณราชนครินทร์ ชั้น 4 ที่นั่ง 2 คน', 1471200375194, 'staff', 0, '', '20-09-2020', NULL),
(34, 1047, 'ห้องสืบค้นส่วนบุคคล ลำดับที่ 6 ตึก บรรณราชนครินทร์ ชั้น 4 ที่นั่ง 2 คน', 1471200375194, 'staff', 0, '', '20-09-2020', NULL),
(35, 1048, 'ห้องสืบค้นส่วนบุคคล ลำดับที่ 7 ตึก บรรณราชนครินทร์ ชั้น 4 ที่นั่ง 2 คน', 1471200375194, 'staff', 0, '', '20-09-2020', NULL),
(36, 1049, 'ห้องสืบค้นกลุ่มย่อย ลำดับที่ 1 ตึก บรรณราชนครินทร์ ชั้น 4 ที่นั่ง 10 คน', 1471200375194, 'staff', 0, '', '20-09-2020', NULL),
(37, 10410, 'ห้องสืบค้นกลุ่มย่อย ลำดับที่ 2 ตึก บรรณราชนครินทร์ ชั้น 4 ที่นั่ง 10 คน', 1471200375194, 'staff', 0, '', '20-09-2020', NULL),
(38, 1042, 'ห้องสืบค้นส่วนบุคคล ลำดับที่ 1 ตึก บรรณราชนครินทร์ ชั้น 4 ที่นั่ง 2 คน', 1471200375194, 'user', 0, '', '20-09-2020', NULL),
(39, 1044, 'ห้องสืบค้นส่วนบุคคล ลำดับที่ 3 ตึก บรรณราชนครินทร์ ชั้น 4 ที่นั่ง 2 คน', 1471200375194, 'user', 0, '', '20-09-2020', NULL),
(40, 10410, 'ห้องสืบค้นกลุ่มย่อย ลำดับที่ 2 ตึก บรรณราชนครินทร์ ชั้น 4 ที่นั่ง 10 คน', 1471200375194, 'user', 0, '', '20-09-2020', NULL),
(41, 1045, 'ห้องสืบค้นส่วนบุคคล ลำดับที่ 4 ตึก บรรณราชนครินทร์ ชั้น 4 ที่นั่ง 2 คน', 1471200375194, 'user', 0, '', '20-09-2020', NULL),
(42, 1046, 'ห้องสืบค้นส่วนบุคคล ลำดับที่ 5 ตึก บรรณราชนครินทร์ ชั้น 4 ที่นั่ง 2 คน', 1471200375194, 'user', 0, '', '20-09-2020', NULL),
(43, 1048, 'ห้องสืบค้นส่วนบุคคล ลำดับที่ 7 ตึก บรรณราชนครินทร์ ชั้น 4 ที่นั่ง 2 คน', 1471200375194, 'user', 0, '', '20-09-2020', NULL),
(44, 1047, 'ห้องสืบค้นส่วนบุคคล ลำดับที่ 6 ตึก บรรณราชนครินทร์ ชั้น 4 ที่นั่ง 2 คน', 1471200375194, 'user', 0, '', '20-09-2020', NULL),
(45, 1043, 'ห้องสืบค้นส่วนบุคคล ลำดับที่ 2 ตึก บรรณราชนครินทร์ ชั้น 4 ที่นั่ง 2 คน', 1471200375194, 'user', 0, '', '20-09-2020', NULL),
(46, 1049, 'ห้องสืบค้นกลุ่มย่อย ลำดับที่ 1 ตึก บรรณราชนครินทร์ ชั้น 4 ที่นั่ง 10 คน', 1471200375194, 'user', 0, '', '20-09-2020', NULL),
(47, 1016, 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 6 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', 3201821131600, 'staff', 0, '', '20-09-2020', NULL),
(48, 1011, 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 1 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', 1471200378989, 'staff', 0, '', '20-09-2020', NULL),
(49, 1041, 'ห้องสมุดสร้างสุข ลำดับที่ 1 ตึก บรรณราชนครินทร์ ชั้น 4 ที่นั่ง 30 คน', 1471200378989, 'staff', 0, '', '21-09-2020', NULL),
(50, 1016, 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 6 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', 1471200375194, 'staff', 0, '', '21-09-2020', NULL),
(51, 1011, 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 1 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', 1471200375194, 'staff', 0, '', '23-09-2020', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rejected_booking`
--

CREATE TABLE `rejected_booking` (
  `id` int(11) NOT NULL,
  `booking_id` bigint(20) NOT NULL,
  `staff_id` bigint(20) NOT NULL,
  `booking_type` varchar(250) NOT NULL,
  `reason_reject` varchar(1000) DEFAULT NULL,
  `date_rejected` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rejected_booking`
--

INSERT INTO `rejected_booking` (`id`, `booking_id`, `staff_id`, `booking_type`, `reason_reject`, `date_rejected`) VALUES
(1, 1041, 3201821131600, 'ห้องสมุดสร้างสุข ลำดับที่ 1 ตึก บรรณราชนครินทร์ ชั้น 4 ที่นั่ง 30 คน', 'วันนี้ปิด', '20-09-2020'),
(2, 1016, 3201821131600, 'โต๊ะหน้าอาคารบรรณราชนครินทร์ ลำดับที่ 6 ตึก บรรณราชนครินทร์ ชั้น 1 ที่นั่ง 6 คน', '', '20-09-2020');

-- --------------------------------------------------------

--
-- Table structure for table `tblmessage`
--

CREATE TABLE `tblmessage` (
  `MessageID` int(11) NOT NULL,
  `Category` varchar(100) NOT NULL,
  `MessageText` text NOT NULL,
  `MessageCODE` varchar(90) NOT NULL,
  `ACCOUNT_USERNAME` varchar(90) NOT NULL,
  `IDNO` varchar(90) NOT NULL,
  `Email` varchar(90) NOT NULL,
  `Mstatus` varchar(100) NOT NULL,
  `Mimage` varchar(255) NOT NULL,
  `date_no` date NOT NULL,
  `date_receive` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblmessage`
--

INSERT INTO `tblmessage` (`MessageID`, `Category`, `MessageText`, `MessageCODE`, `ACCOUNT_USERNAME`, `IDNO`, `Email`, `Mstatus`, `Mimage`, `date_no`, `date_receive`) VALUES
(1, 'แจ้งมีคนลืมของ', 'เจอหูฟังที่ โต๊ะหน้า ห้องสมุด', 'หูฟังไร้สาย', 'user', '60102105104', 'chawinhita1122@gmail.com', 'รับของแล้ว', '20200807_F841676F-63B3-4940-B892-13BAB3D36F9C.jpeg', '2020-08-07', '2020-08-07'),
(2, 'แจ้งมีคนลืมของ', 'เจอกุญแจ ที่ห้องสมุด', 'กุญแจ', 'boychawin', '4202012081122', '1@gmail.com', 'รับของแล้ว', '20200807_88D3A118-D52B-4156-8C7A-941FF714C31D.jpeg', '2020-08-07', '2020-08-07'),
(3, 'แจ้งมีคนลืมของ', 'โต๊ะหน้าห้องสมุด	', 'แจ้งมีคนลืมของ', 'staff', '3201821131600', 'chawinhita1122@gmail.co', 'รอตรวจสอบ', '20200830_1111.jpeg', '2020-08-30', '2020-09-01'),
(4, 'แจ้งอุปกรณ์ไม่สะอาด', 'หน้าหน้าห้องสมุดไม่สะอาด', 'หน้าหน้าห้องสมุดไม่สะอาด', 'user', '1471200375194', 'chawinhita1122@gmail.com', 'แก้ไขแล้ว', '20200921_81599.jpg', '2020-09-21', '2020-09-21'),
(5, 'แจ้งอุปกรณ์ชำรุด', 'เก้าอี้ ห้องสร้างสุขพัง', 'เก้าอี้ ห้องสร้างสุขพัง', 'user', '1471200375194', 'chawinhita1122@gmail.com', 'รอตรวจสอบ', '20200923_11.jpg', '2020-09-23', '2020-09-23');

-- --------------------------------------------------------

--
-- Table structure for table `tb_faculty`
--

CREATE TABLE `tb_faculty` (
  `id` int(10) NOT NULL,
  `Faculty` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_faculty`
--

INSERT INTO `tb_faculty` (`id`, `Faculty`) VALUES
(1, 'คณะครุศาสตร์'),
(2, 'คณะเทคโนโลยีการเกษตร'),
(3, 'คณะเทคโนโลยีอุตสาหกรรม'),
(4, 'คณะวิทยาการจัดการ'),
(5, 'คณะมนุษยศาสตร์และสังคมศาสตร์'),
(6, 'คณะวิทยาศาสตร์และเทคโนโลยี'),
(7, 'สำนักงานอธิการบดี'),
(8, 'สำนักงานบัณฑิตวิทยาลัย'),
(9, 'สำนักวิทยบริการและเทคโนโลยีสารสนเทศ'),
(10, 'สถาบันภาษา ศิลปะและวัฒนธรรม'),
(11, 'สำนักส่งเสริมวิชาการและงานทะเบียน'),
(12, 'สถาบันวิจัยและพัฒนา'),
(13, 'อื่นๆ');

-- --------------------------------------------------------

--
-- Table structure for table `tb_field_study`
--

CREATE TABLE `tb_field_study` (
  `id` int(100) NOT NULL,
  `field_study` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_field_study`
--

INSERT INTO `tb_field_study` (`id`, `field_study`) VALUES
(1, 'วิทยาการคอมพิวเตอร์');

-- --------------------------------------------------------

--
-- Table structure for table `terms_use`
--

CREATE TABLE `terms_use` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `terms_use`
--

INSERT INTO `terms_use` (`id`, `name`, `photo`, `details`) VALUES
(1, '5 ขั้นตอนการทำงานของระบบจองห้อง ', 'images/3.jpg', '1. ผู้ขององห้อง ข้สู่ระบบจองห้อง ตรางสอบห้อง วันที่องห้องว่มีการจองห้องก่อนแล้วหรือไม่ \r\n2. จองห้องโดยการลือกห้องลือกวันและเวลา กรอกรายละอียคการจองให้ครบถ้วน (ควรจองก่อนล่างหน้ำอย่างน้อย3 วัน) \r\n3. มื่อเจ้าหน้ที่ผู้รับผิดชบที่ศูนย์คอมตรางสอบการจองห้องพื่ออนุมัติไม่อนุมัติ ระบบจะส่งผลการตรางสอบ ไปยังอิมลของท่าน \r\n4. ผู้ใช้สารมารถตราสอบผลการอนุมัติหรือไม่อนุมัติได้ที่ Websile htp/tsarvesnac. หรืออีผลของท่าน \r\nร. ออกจากระบบ ถือกมน อองกรบบ มื่อผู้ใช้ต้องการออกจากระบบจองห้อง');

-- --------------------------------------------------------

--
-- Table structure for table `user_booking_metadata`
--

CREATE TABLE `user_booking_metadata` (
  `id` int(11) NOT NULL,
  `staff_level` varchar(200) NOT NULL,
  `total_yr_booking_count` bigint(20) NOT NULL,
  `total_month_booking_count` bigint(20) NOT NULL,
  `current_days` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_booking_metadata`
--

INSERT INTO `user_booking_metadata` (`id`, `staff_level`, `total_yr_booking_count`, `total_month_booking_count`, `current_days`) VALUES
(1, 'non-supervisor', 300, 25, 300),
(2, 'supervisor', 320, 30, 320);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accepted_booking`
--
ALTER TABLE `accepted_booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_id` (`admin_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_applications`
--
ALTER TABLE `booking_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staff_id` (`staff_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `job_description`
--
ALTER TABLE `job_description`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_recovery_meta`
--
ALTER TABLE `password_recovery_meta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `picture_place`
--
ALTER TABLE `picture_place`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recommended_booking`
--
ALTER TABLE `recommended_booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rejected_booking`
--
ALTER TABLE `rejected_booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblmessage`
--
ALTER TABLE `tblmessage`
  ADD PRIMARY KEY (`MessageID`);

--
-- Indexes for table `tb_faculty`
--
ALTER TABLE `tb_faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_field_study`
--
ALTER TABLE `tb_field_study`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms_use`
--
ALTER TABLE `terms_use`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_booking_metadata`
--
ALTER TABLE `user_booking_metadata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accepted_booking`
--
ALTER TABLE `accepted_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `booking_applications`
--
ALTER TABLE `booking_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `job_description`
--
ALTER TABLE `job_description`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `password_recovery_meta`
--
ALTER TABLE `password_recovery_meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `picture_place`
--
ALTER TABLE `picture_place`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `recommended_booking`
--
ALTER TABLE `recommended_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `rejected_booking`
--
ALTER TABLE `rejected_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblmessage`
--
ALTER TABLE `tblmessage`
  MODIFY `MessageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_faculty`
--
ALTER TABLE `tb_faculty`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_field_study`
--
ALTER TABLE `tb_field_study`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `terms_use`
--
ALTER TABLE `terms_use`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_booking_metadata`
--
ALTER TABLE `user_booking_metadata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
