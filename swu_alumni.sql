-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2025 at 07:41 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `swu_alumni`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_ID` int(13) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fullname` text NOT NULL,
  `surname` text NOT NULL,
  `phone` text NOT NULL,
  `role` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_ID`, `username`, `password`, `fullname`, `surname`, `phone`, `role`) VALUES
(1, 'admin286', 'milk286', 'วราลี', 'จั่นมณี', '0876937780', ''),
(2, 'admin077', 'beauty077', 'กมลนิตย์', 'ธิการ', '0123456789', '');

-- --------------------------------------------------------

--
-- Table structure for table `adress`
--

CREATE TABLE `adress` (
  `Adress_ID` int(11) NOT NULL,
  `st_ID` int(11) NOT NULL,
  `H_number` varchar(50) NOT NULL,
  `road` varchar(50) NOT NULL,
  `county` varchar(50) NOT NULL,
  `area` varchar(50) NOT NULL,
  `Postal` varchar(50) NOT NULL,
  `district` varchar(50) NOT NULL,
  `Province` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `alumni`
--

CREATE TABLE `alumni` (
  `Alu_id` int(11) NOT NULL,
  `st_IDcard` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alumni`
--

INSERT INTO `alumni` (`Alu_id`, `st_IDcard`) VALUES
(2, '1112221222111'),
(1, '1234567891234'),
(13, '12565655755'),
(12, '125656557553'),
(5, '4'),
(6, '5'),
(11, '52'),
(7, '88'),
(8, '888'),
(9, '8884'),
(10, '88845');

-- --------------------------------------------------------

--
-- Table structure for table `alumni_education`
--

CREATE TABLE `alumni_education` (
  `edu_id` int(11) NOT NULL,
  `Alu_id` int(11) NOT NULL,
  `st_ID` int(11) NOT NULL,
  `Qu_id` int(11) NOT NULL,
  `enrollment_year` year(4) NOT NULL,
  `grad_year` year(4) NOT NULL,
  `edu_status` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `CRdate` datetime DEFAULT NULL COMMENT 'CrateDate',
  `CrID` int(11) DEFAULT NULL,
  `Eddate` datetime DEFAULT NULL COMMENT 'EditDate',
  `EdID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alumni_education`
--

INSERT INTO `alumni_education` (`edu_id`, `Alu_id`, `st_ID`, `Qu_id`, `enrollment_year`, `grad_year`, `edu_status`, `CRdate`, `CrID`, `Eddate`, `EdID`) VALUES
(1, 1, 0, 2, '2021', '2024', 'actived', NULL, 0, '2025-05-04 18:48:02', 0),
(6, 1, 9, 2, '2000', '0000', 'unactived', '2025-04-10 11:01:33', 8, '2025-04-27 01:26:00', 0),
(13, 5, 0, 7, '0000', '0000', 'unactived', NULL, 0, '2025-05-04 18:46:06', 0),
(14, 5, 22, 0, '0000', '0000', '', NULL, 0, NULL, 0),
(15, 7, 31, 0, '0000', '0000', '', NULL, 0, NULL, 0),
(16, 8, 32, 0, '0000', '0000', '', NULL, 0, NULL, 0),
(17, 8, 33, 0, '0000', '0000', '', NULL, 0, NULL, 0),
(18, 9, 34, 0, '0000', '0000', '', NULL, 0, NULL, 0),
(20, 19, 35, 0, '0000', '0000', '', NULL, 0, NULL, 0),
(22, 21, 36, 0, '0000', '0000', '', NULL, 0, NULL, 0),
(23, 10, 37, 0, '0000', '0000', '', '2025-05-04 15:16:01', 0, NULL, 0),
(24, 10, 38, 0, '0000', '0000', '', '2025-05-04 15:16:35', 0, NULL, 0),
(25, 10, 39, 0, '0000', '0000', '', '2025-05-04 15:24:06', 5, NULL, 0),
(26, 5, 40, 0, '0000', '0000', '', '2025-05-04 21:07:01', 5, NULL, 0),
(27, 11, 41, 0, '0000', '0000', '', '2025-05-04 21:10:00', 5, NULL, 0),
(28, 5, 42, 0, '0000', '0000', '', '2025-05-04 21:17:35', 5, NULL, 0),
(29, 5, 43, 0, '0000', '0000', '', '2025-05-04 21:19:47', 5, NULL, 0),
(30, 12, 44, 0, '0000', '0000', '', '2025-05-04 21:37:37', 0, NULL, 0),
(31, 13, 45, 0, '0000', '0000', '', '2025-05-05 13:54:20', 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `alumni_qualification`
--

CREATE TABLE `alumni_qualification` (
  `Qu_id` int(11) NOT NULL,
  `Qu_name_TH` varchar(90) NOT NULL,
  `Qu_name_EN` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alumni_qualification`
--

INSERT INTO `alumni_qualification` (`Qu_id`, `Qu_name_TH`, `Qu_name_EN`) VALUES
(1, 'ไม่ระบุ', ''),
(2, 'ปริญญาตรี', 'Bachelor Degree'),
(3, 'ปริญญาโท', 'Master Degree'),
(4, 'ปริญญาเอก', 'Doctoral Degree'),
(5, 'ปวช.', 'Vocational Certificate'),
(6, 'ปวส.', 'High Vocational Certificate'),
(7, 'มัธยมศึกษาตอนปลาย', 'Senior High School'),
(8, 'มัธยมศึกษาตอนต้น', 'Junior High School');

-- --------------------------------------------------------

--
-- Table structure for table `award`
--

CREATE TABLE `award` (
  `Award_ID` int(11) NOT NULL,
  `Award_NameTH` varchar(100) NOT NULL,
  `Award_Info` text NOT NULL,
  `Award_Day` date NOT NULL,
  `Award_Picture` varchar(255) NOT NULL,
  `Award_Created` timestamp NOT NULL DEFAULT current_timestamp(),
  `Award_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `award`
--

INSERT INTO `award` (`Award_ID`, `Award_NameTH`, `Award_Info`, `Award_Day`, `Award_Picture`, `Award_Created`, `Award_updated`) VALUES
(3, 'คนไม่เก่ง', 'dsadasd', '2025-05-01', 'Uploaded_Award/1746423957_2025_02_26_22_37_02_1391934.jpeg', '2025-05-05 05:45:57', '2025-05-05 05:45:57'),
(4, 'รางวัลไรนะคะ', 'ไม่รู้เหมือนกันค่ะ', '2025-05-28', 'Uploaded_Award/1746424080_2025_04_30_02_50_09_2226143.jpeg', '2025-05-05 05:48:00', '2025-05-05 05:48:00'),
(5, 'f', 'f', '2025-04-29', 'Uploaded_Award/1746427149_280-2809779_spongebob-spongebobsquarepants-patrick-patrickstar-pinhead-patrick.png', '2025-05-05 06:39:09', '2025-05-05 06:39:09');

-- --------------------------------------------------------

--
-- Table structure for table `btype`
--

CREATE TABLE `btype` (
  `BType_ID` int(11) NOT NULL,
  `BType_NameTH` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `btype`
--

INSERT INTO `btype` (`BType_ID`, `BType_NameTH`) VALUES
(1, 'วิชาเอกเดี่ยว'),
(2, 'วิชาเอกคู่');

-- --------------------------------------------------------

--
-- Table structure for table `expertise`
--

CREATE TABLE `expertise` (
  `expertise_id` int(11) NOT NULL,
  `expertise_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expertise`
--

INSERT INTO `expertise` (`expertise_id`, `expertise_name`, `description`) VALUES
(142596, 'การวิจัยทางการศึกษา', 'เชี่ยวชาญในการออกแบบและวิเคราะห์งานวิจัยเชิงคุณภาพและเชิงปริมาณในด้านการศึกษา'),
(147852, 'การสอนสำหรับผู้เรียนที่มีความต้องการพิเศษ', 'มีความรู้เฉพาะด้านในการจัดการเรียนรู้สำหรับเด็กที่มีความบกพร่องทางการเรียนรู้'),
(147853, 'เทคโนโลยีการศึกษา', 'เชี่ยวชาญด้านสื่อและการเรียนรู้ดิจิทัล');

-- --------------------------------------------------------

--
-- Table structure for table `gender_type`
--

CREATE TABLE `gender_type` (
  `gen_id` int(11) NOT NULL,
  `gen_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `gender_type`
--

INSERT INTO `gender_type` (`gen_id`, `gen_name`) VALUES
(1, 'ชาย'),
(2, 'หญิง'),
(3, 'อื่นๆ');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `Ntype_ID` int(11) NOT NULL,
  `N_title` varchar(200) NOT NULL,
  `N_content` varchar(200) NOT NULL,
  `N_image` int(120) DEFAULT NULL,
  `cra_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ntype`
--

CREATE TABLE `ntype` (
  `Ntype_ID` int(11) NOT NULL,
  `nameNT_TH` varchar(100) NOT NULL,
  `nameNT_EN` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE `province` (
  `province_id` int(10) NOT NULL,
  `province_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`province_id`, `province_name`) VALUES
(1, 'เชียงใหม่'),
(2, 'นครราชสีมา'),
(3, 'กาญจนบุรี'),
(4, 'อุบลราชธานี'),
(5, 'ตาก'),
(6, 'สุราษฎร์ธานี'),
(7, 'ชัยภูมิ'),
(8, 'แม่ฮ่องสอน'),
(9, 'เพชรบูรณ์'),
(10, 'ลำปาง'),
(11, 'อุดรธานี'),
(12, 'เชียงราย'),
(13, 'น่าน'),
(14, 'เลย'),
(15, 'ขอนแก่น'),
(16, 'พิษณุโลก'),
(17, 'บุรีรัมย์'),
(18, 'นครศรีธรรมราช'),
(19, 'สกลนคร'),
(20, 'นครสวรรค์'),
(21, 'ศรีสะเกษ'),
(22, 'กำแพงเพชร'),
(23, 'ร้อยเอ็ด'),
(24, 'สุรินทร์'),
(25, 'อุตรดิตถ์'),
(26, 'สงขลา'),
(27, 'สระแก้ว'),
(28, 'กาฬสินธุ์'),
(29, 'อุทัยธานี'),
(30, 'สุโขทัย'),
(31, 'แพร่'),
(32, 'ประจวบคีรีขันธ์'),
(33, 'จันทบุรี'),
(34, 'พะเยา'),
(35, 'เพชรบุรี'),
(36, 'ลพบุรี'),
(37, 'ชุมพร'),
(38, 'นครพนม'),
(39, 'สุพรรณบุรี'),
(40, 'มหาสารคาม'),
(41, 'ฉะเชิงเทรา'),
(42, 'ราชบุรี'),
(43, 'ตรัง'),
(44, 'ปราจีนบุรี'),
(45, 'กระบี่'),
(46, 'พิจิตร'),
(47, 'ยะลา'),
(48, 'ลำพูน'),
(49, 'นราธิวาส'),
(50, 'ชลบุรี'),
(51, 'มุกดาหาร'),
(52, 'บึงกาฬ'),
(53, 'พังงา'),
(54, 'ยโสธร'),
(55, 'หนองบัวลำภู'),
(56, 'สระบุรี'),
(57, 'ระยอง'),
(58, 'พัทลุง'),
(59, 'ระนอง'),
(60, 'อำนาจเจริญ'),
(61, 'หนองคาย'),
(62, 'ตราด'),
(63, 'พระนครศรีอยุธยา'),
(64, 'สตูล'),
(65, 'ชัยนาท'),
(66, 'นครปฐม'),
(67, 'นครนายก'),
(68, 'ปัตตานี'),
(69, 'กรุงเทพมหานคร'),
(70, 'ปทุมธานี'),
(71, 'สมุทรปราการ'),
(72, 'อ่างทอง'),
(73, 'สมุทรสาคร'),
(74, 'สิงห์บุรี'),
(75, 'นนทบุรี'),
(76, 'ภูเก็ต'),
(77, 'สมุทรสงคราม');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_ID` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_ID`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Student'),
(3, 'Teacher');

-- --------------------------------------------------------

--
-- Table structure for table `scholarships`
--

CREATE TABLE `scholarships` (
  `Scholar_ID` int(11) NOT NULL,
  `Scho_NameTH` varchar(255) NOT NULL,
  `Scho_Info` text NOT NULL,
  `Scho_Start` date NOT NULL,
  `Scho_End` date NOT NULL,
  `Scho_Number_Student` int(11) NOT NULL,
  `Scho_Contact` int(11) NOT NULL,
  `Scho_Picture` varchar(255) NOT NULL,
  `Scho_Created` timestamp NOT NULL DEFAULT current_timestamp(),
  `Scho_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scholarships`
--

INSERT INTO `scholarships` (`Scholar_ID`, `Scho_NameTH`, `Scho_Info`, `Scho_Start`, `Scho_End`, `Scho_Number_Student`, `Scho_Contact`, `Scho_Picture`, `Scho_Created`, `Scho_updated`) VALUES
(2, 'เพชรในตม', 'เป็นครูหลังเรียนจบ แต่มีข้อแม้ต้องอยู่เป็นครูให้ครบ10ปี', '2025-05-01', '2025-05-06', 15, 2147483647, 'Uploaded_Scholarship/1746409196_e41dc53a45384ac63ea0b2a6fb98f8c2.jpg', '2025-05-05 01:39:56', '2025-05-05 03:43:46'),
(3, 'มหาบัณฑิต huh?', 'ดหกดหกดกด', '2025-05-01', '2025-05-22', 50, 644524242, 'Uploaded_Scholarship/1746410410_330px-Tenn_Kujo_(La’Stiara).webp', '2025-05-05 02:00:10', '2025-05-05 03:43:51'),
(5, 'ทุนเก่า', 'ฟหกฟหกฟหกฟห', '2020-02-01', '2023-02-05', 50, 2000785422, 'Uploaded_Scholarship/1746411802_2801e34317748119a48fff2580af01a4.jpg', '2025-05-05 02:23:22', '2025-05-05 03:43:35');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `st_ID` int(11) NOT NULL,
  `st_IDcard` varchar(13) NOT NULL,
  `B_ID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL,
  `st_name_th` varchar(50) NOT NULL,
  `st_nickname` varchar(50) NOT NULL,
  `st_name_en` varchar(50) NOT NULL,
  `gen_id` int(11) NOT NULL,
  `st_brith` date NOT NULL,
  `st_Email` varchar(50) NOT NULL,
  `teacher_ID` int(11) NOT NULL,
  `st_phone_parent` varchar(50) NOT NULL,
  `st_phone` varchar(50) NOT NULL,
  `st_pic` varchar(100) DEFAULT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`st_ID`, `st_IDcard`, `B_ID`, `username`, `password`, `st_name_th`, `st_nickname`, `st_name_en`, `gen_id`, `st_brith`, `st_Email`, `teacher_ID`, `st_phone_parent`, `st_phone`, `st_pic`, `role`) VALUES
(45, '12565655755', 9, 'bo', '$2y$10$3YiEZuXXvQ70ANcmPMOVZeyEaF9bUM/c9hAfKau61oLNpuv.ei/xu', 'หนูท่อจ้า', 'aaa', 'aaaa', 2, '2025-05-02', '', 7895231, '042546354', '05637254', 'patrick-star-logo-png_seeklogo-320105.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_01`
--

CREATE TABLE `teacher_01` (
  `teacher_id` int(11) NOT NULL,
  `firstname_TH` varchar(50) NOT NULL,
  `firstname_EN` varchar(50) NOT NULL,
  `lastname_TH` varchar(50) NOT NULL,
  `lastname_EN` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `Workplace` varchar(50) NOT NULL,
  `phone_number` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_01`
--

INSERT INTO `teacher_01` (`teacher_id`, `firstname_TH`, `firstname_EN`, `lastname_TH`, `lastname_EN`, `Email`, `position`, `department`, `Workplace`, `phone_number`) VALUES
(123456, 'ธิริศา', 'Tirisa', 'เฮงสิริไพศาล', 'Hengsiripaisan', 'tirisa5@gmail.com', 'อาจารย์', 'การศึกษาพิเศษ', 'ประสานมิตร', '99999999'),
(7895231, 'สมาน', 'S̄man', 'ย่างก้าว', 'Yang kaw', 'ํYang147@gmail.com', 'เจ้าหน้าที่', 'เทคโนโลยีและคอมพิวเตอร์', 'ประสานมิตร', '14789632'),
(12541254, 'ก้องเกียรติ', ' Kongkiat', 'เกียรติก้อง', 'Kiatkong', 'eM125@gmail..com', 'เจ้าหน้าที่', 'การศึกษาพิเศษ', 'ประสานมิตร', '141414142'),
(159753258, 'ธนบูรณ์', ' Thanabun', 'มอขอ', 'Makham', 'Makham@gmail.com', 'อาจารย์', 'เทคโนโลยีและคอมพิวเตอร์', 'ประสานมิตร', '258741321'),
(1789324565, 'สมชาย', 'Somchai', 'สุขใจ', 'Sukjai', 'somchai@university.ac.th', 'อาจารย์', 'ครุศาสตร์', 'มหาวิทยาลัยตัวอย่าง', '0999999999'),
(1789324566, 'สุภาวดี', 'Supawadee', 'มีบุญ', 'Meeboon', 'supawadee@university.ac.th', 'ผู้ช่วยศาสตราจารย์', 'ศึกษาศาสตร์', 'มหาวิทยาลัยตัวอย่าง', '0898765432'),
(1789324567, 'อนันต์', 'Anan', 'ทองดี', 'Thongdee', 'anan@university.ac.th', 'รองศาสตราจารย์', 'วิศวกรรมศาสตร์', 'มหาวิทยาลัยตัวอย่าง', '0823456789'),
(1789324568, 'จิราภรณ์', 'Jiraporn', 'แก้วใส', 'Kaewsai', 'jiraporn@university.ac.th', 'อาจารย์', 'วิทยาการคอมพิวเตอร์', 'มหาวิทยาลัยตัวอย่าง', '0834567890'),
(1789324569, 'ปกรณ์', 'Pakorn', 'มั่นคง', 'Munkhong', 'pakorn@university.ac.th', 'ศาสตราจารย์', 'บริหารธุรกิจ', 'มหาวิทยาลัยตัวอย่าง', '0845678901'),
(1789324570, 'ธีรภัทร', 'Teeraphat', 'ใจดี', 'Jaidee', 'teeraphat@university.ac.th', 'อาจารย์', 'ครุศาสตร์', 'มหาวิทยาลัยตัวอย่าง', '0811223344'),
(1789324571, 'ณิชาภา', 'Nichapa', 'เก่งกาจ', 'Kengkat', 'nichapa@university.ac.th', 'ผู้ช่วยศาสตราจารย์', 'วิทยาศาสตร์', 'มหาวิทยาลัยตัวอย่าง', '0899988776');

-- --------------------------------------------------------

--
-- Table structure for table `user_branch`
--

CREATE TABLE `user_branch` (
  `B_ID` int(11) NOT NULL,
  `B_NameTH` varchar(100) NOT NULL,
  `B_NameEN` varchar(100) NOT NULL,
  `BType_ID` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_branch`
--

INSERT INTO `user_branch` (`B_ID`, `B_NameTH`, `B_NameEN`, `BType_ID`) VALUES
(1, 'วิชาเอกการศึกษาปฐมวัย', 'Early Childhood Education', '1'),
(2, 'วิชาเอกการศึกษาตลอดชีวิต', 'Lifelong Education', '1'),
(3, 'วิชาเอกการประถมศึกษา', 'Elementary Education', '1'),
(4, 'วิชาเอกจิตวิทยาและการแนะแนว', 'Psychology and Guidance', '1'),
(5, 'วิชาเอกเทคโนโลยีการศึกษาและคอมพิวเตอร์', 'Educational Technology and Computer', '1'),
(6, 'วิชาเอกการสอนภาษาไทยและการสอนภาษาอังกฤษ', 'Teaching Thai and Teaching English', '2'),
(7, 'วิชาเอกการสอนภาษาอังกฤษและการสอนสังคมศึกษา', 'Teaching English and Teaching Social Studies', '2'),
(8, 'วิชาเอกการสอนสังคมศึกษาและการสอนภาษาไทย', 'Teaching Social Studies and Teaching Thai', '2'),
(9, 'วิชาเอกการสอนวิทยาศาสตร์และการสอนคณิตศาสตร์', 'Teaching Science and Teaching Mathematics', '2'),
(10, 'การศึกษาพิเศษและการสอนคณิตศาสตร์', 'Special Education and Teaching Mathematics', '2'),
(11, 'การศึกษาพิเศษและการสอนภาษาไทย', 'Special Education and Teaching Thai', '2'),
(12, 'การศึกษาพิเศษและการสอนวิทยาศาสตร์', 'Special Education and Teaching Science', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `adress`
--
ALTER TABLE `adress`
  ADD PRIMARY KEY (`Adress_ID`);

--
-- Indexes for table `alumni`
--
ALTER TABLE `alumni`
  ADD PRIMARY KEY (`Alu_id`),
  ADD UNIQUE KEY `st_IDcard` (`st_IDcard`);

--
-- Indexes for table `alumni_education`
--
ALTER TABLE `alumni_education`
  ADD PRIMARY KEY (`edu_id`);

--
-- Indexes for table `alumni_qualification`
--
ALTER TABLE `alumni_qualification`
  ADD PRIMARY KEY (`Qu_id`);

--
-- Indexes for table `award`
--
ALTER TABLE `award`
  ADD PRIMARY KEY (`Award_ID`);

--
-- Indexes for table `btype`
--
ALTER TABLE `btype`
  ADD PRIMARY KEY (`BType_ID`);

--
-- Indexes for table `expertise`
--
ALTER TABLE `expertise`
  ADD PRIMARY KEY (`expertise_id`);

--
-- Indexes for table `gender_type`
--
ALTER TABLE `gender_type`
  ADD PRIMARY KEY (`gen_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `ntype`
--
ALTER TABLE `ntype`
  ADD PRIMARY KEY (`Ntype_ID`);

--
-- Indexes for table `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`province_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_ID`);

--
-- Indexes for table `scholarships`
--
ALTER TABLE `scholarships`
  ADD PRIMARY KEY (`Scholar_ID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`st_ID`);

--
-- Indexes for table `teacher_01`
--
ALTER TABLE `teacher_01`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Indexes for table `user_branch`
--
ALTER TABLE `user_branch`
  ADD PRIMARY KEY (`B_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_ID` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `adress`
--
ALTER TABLE `adress`
  MODIFY `Adress_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `alumni`
--
ALTER TABLE `alumni`
  MODIFY `Alu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `alumni_education`
--
ALTER TABLE `alumni_education`
  MODIFY `edu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `alumni_qualification`
--
ALTER TABLE `alumni_qualification`
  MODIFY `Qu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `award`
--
ALTER TABLE `award`
  MODIFY `Award_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `btype`
--
ALTER TABLE `btype`
  MODIFY `BType_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expertise`
--
ALTER TABLE `expertise`
  MODIFY `expertise_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147855;

--
-- AUTO_INCREMENT for table `gender_type`
--
ALTER TABLE `gender_type`
  MODIFY `gen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ntype`
--
ALTER TABLE `ntype`
  MODIFY `Ntype_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `province`
--
ALTER TABLE `province`
  MODIFY `province_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `scholarships`
--
ALTER TABLE `scholarships`
  MODIFY `Scholar_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `st_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `teacher_01`
--
ALTER TABLE `teacher_01`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1789324572;

--
-- AUTO_INCREMENT for table `user_branch`
--
ALTER TABLE `user_branch`
  MODIFY `B_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
