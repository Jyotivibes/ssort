-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 04, 2017 at 12:08 PM
-- Server version: 5.6.33
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `MISMTC`
--

-- --------------------------------------------------------

--
-- Table structure for table `eesort_role`
--

CREATE TABLE `eesort_role` (
  `id` int(8) NOT NULL,
  `role_name` varchar(150) NOT NULL,
  `role_code` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eesort_role`
--

INSERT INTO `eesort_role` (`id`, `role_name`, `role_code`) VALUES
(1, 'Teacher', 'Teacher'),
(2, 'Principal', 'Principal'),
(3, 'Parent', 'Parent'),
(4, 'Chairman', 'Chairman'),
(5, 'Accountant', 'Accountant'),
(6, 'Fee', 'Fee'),
(7, 'Others', 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `essort_application_family_info`
--

CREATE TABLE `essort_application_family_info` (
  `parent_id` int(11) NOT NULL,
  `usr_application_id` int(11) NOT NULL,
  `usr_relation` varchar(150) NOT NULL,
  `usr_r_initial` varchar(150) NOT NULL,
  `usr_r_name` varchar(150) NOT NULL,
  `usr_r_mname` varchar(150) NOT NULL,
  `usr_r_lname` varchar(150) NOT NULL,
  `usr_r_age` varchar(150) NOT NULL,
  `usr_school_name` varchar(150) NOT NULL,
  `usr_r_qualification` varchar(150) NOT NULL,
  `usr_r_occupatrion` varchar(150) NOT NULL,
  `usr_r_designation` varchar(150) NOT NULL,
  `usr_r_org_name` varchar(150) NOT NULL,
  `usr_r_office_address` varchar(150) NOT NULL,
  `usr_r_offc_area` varchar(150) NOT NULL,
  `usr_r_offc_city` varchar(150) NOT NULL,
  `usr_r_offc_state` varchar(150) NOT NULL,
  `usr_r_office_timings` varchar(150) NOT NULL,
  `usr_r_email` varchar(150) NOT NULL,
  `usr_r_office_contact_no` varchar(150) NOT NULL,
  `usr_r_contact_no` varchar(150) NOT NULL,
  `usr_r_monthly_income` varchar(150) NOT NULL,
  `usr_r_primary_contact` varchar(150) NOT NULL,
  `usr_r_alter_contact` varchar(150) NOT NULL,
  `usr_r_role` varchar(150) NOT NULL,
  `usr_r_mother_tounge` varchar(150) NOT NULL,
  `usr_r_image` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `essort_application_family_info`
--

INSERT INTO `essort_application_family_info` (`parent_id`, `usr_application_id`, `usr_relation`, `usr_r_initial`, `usr_r_name`, `usr_r_mname`, `usr_r_lname`, `usr_r_age`, `usr_school_name`, `usr_r_qualification`, `usr_r_occupatrion`, `usr_r_designation`, `usr_r_org_name`, `usr_r_office_address`, `usr_r_offc_area`, `usr_r_offc_city`, `usr_r_offc_state`, `usr_r_office_timings`, `usr_r_email`, `usr_r_office_contact_no`, `usr_r_contact_no`, `usr_r_monthly_income`, `usr_r_primary_contact`, `usr_r_alter_contact`, `usr_r_role`, `usr_r_mother_tounge`, `usr_r_image`) VALUES
(1, 1, 'father', 'Mr', 'Rajeev', 'K', 'Singh', '67', '', 'B Tech', 'Engineer', 'Senior Engineer', 'Mass Pvt Ltd', 'E-22 sec 8 ', 'Noida', 'Noida', 'UP', '09:00', 'rajeevsingh@mismtc.in', '7418529620', '741852960', '200000', '741852960', '9638527410', 'Father', 'Hindi', 'icon-img.png'),
(2, 1, 'mother', 'Mrs', 'Anjali', 'Kr ', 'Singh', '45', '', 'MCA', 'HR', 'HR', 'Mass Pvt Ltd', 'E22 Sec 8', 'NOida', 'Noida', 'UP', '09:00', 'anjali@mismtc.in', '7418529620', '7532890794', '20000', '7532890794', '7532890794', 'Mother', 'Hindi', ''),
(3, 1, 'guardian', 'Mr', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `essort_application_header`
--

CREATE TABLE `essort_application_header` (
  `parent_id` int(8) NOT NULL,
  `usr_application_no` varchar(150) NOT NULL,
  `usr_fname` varchar(150) NOT NULL,
  `usr_mname` varchar(150) NOT NULL,
  `usr_lname` varchar(150) NOT NULL,
  `usr_email` varchar(150) NOT NULL,
  `usr_dob` varchar(150) NOT NULL,
  `usr_birth_place` varchar(150) NOT NULL,
  `usr_class_id` varchar(150) NOT NULL,
  `usr_gender` varchar(150) NOT NULL,
  `usr_photo` varchar(150) NOT NULL,
  `usr_religion` varchar(150) NOT NULL,
  `usr_present_school` varchar(150) NOT NULL,
  `usr_mother_tounge` varchar(150) NOT NULL,
  `user_resident_local_address` varchar(150) NOT NULL,
  `user_resident_area_address` varchar(150) NOT NULL,
  `user_resident_city` varchar(150) NOT NULL,
  `user_resident_state` varchar(150) NOT NULL,
  `user_resident_pin` varchar(150) NOT NULL,
  `user_resident_country` varchar(150) NOT NULL,
  `user_resident_contact_no` varchar(150) NOT NULL,
  `user_comm_local_address` varchar(150) NOT NULL,
  `user_comm_area_address` varchar(150) NOT NULL,
  `user_comm_city` varchar(150) NOT NULL,
  `user_comm_state` varchar(150) NOT NULL,
  `user_comm_pin` varchar(150) NOT NULL,
  `user_comm_country` varchar(150) NOT NULL,
  `user_comm_contact_no` varchar(150) NOT NULL,
  `user_blood_group` varchar(150) NOT NULL,
  `user_height` varchar(150) NOT NULL,
  `user_weight` varchar(150) NOT NULL,
  `user_allergies` varchar(150) NOT NULL,
  `user_Illness` varchar(150) NOT NULL,
  `user_emergency_treatment` varchar(150) NOT NULL,
  `user_medication` varchar(150) NOT NULL,
  `usr_application_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `essort_application_header`
--

INSERT INTO `essort_application_header` (`parent_id`, `usr_application_no`, `usr_fname`, `usr_mname`, `usr_lname`, `usr_email`, `usr_dob`, `usr_birth_place`, `usr_class_id`, `usr_gender`, `usr_photo`, `usr_religion`, `usr_present_school`, `usr_mother_tounge`, `user_resident_local_address`, `user_resident_area_address`, `user_resident_city`, `user_resident_state`, `user_resident_pin`, `user_resident_country`, `user_resident_contact_no`, `user_comm_local_address`, `user_comm_area_address`, `user_comm_city`, `user_comm_state`, `user_comm_pin`, `user_comm_country`, `user_comm_contact_no`, `user_blood_group`, `user_height`, `user_weight`, `user_allergies`, `user_Illness`, `user_emergency_treatment`, `user_medication`, `usr_application_id`) VALUES
(0, 'APP000001', 'Padmabhu', 'K', 'Singh', 'padmabhu@testmail.com', '05/12/1997', 'Agra', '1', 'Male', 'download.jpg', 'Hindu', '', 'Hindi', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `essort_circular_activities`
--

CREATE TABLE `essort_circular_activities` (
  `id` int(8) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `attachment` varchar(200) NOT NULL,
  `date` varchar(150) NOT NULL,
  `valid_till` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `essort_circular_activities`
--

INSERT INTO `essort_circular_activities` (`id`, `subject`, `message`, `attachment`, `date`, `valid_till`) VALUES
(1, 'Test Circular', 'Test Circular. ', 'Untitled.png', '2017-03-29', '2017-04-06'),
(2, 'Test Circular 2', 'Test Circular 2', 'mis logo - Copy.jpg', '2017-03-29', '2017-04-08');

-- --------------------------------------------------------

--
-- Table structure for table `essort_classes`
--

CREATE TABLE `essort_classes` (
  `class_id` int(8) NOT NULL,
  `class_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `essort_classes`
--

INSERT INTO `essort_classes` (`class_id`, `class_name`) VALUES
(1, '1'),
(2, '2'),
(3, '3'),
(4, '4'),
(5, '5'),
(6, '6'),
(7, '7'),
(8, '8'),
(9, '9'),
(10, '10'),
(11, 'NURSERY'),
(12, 'PREP');

-- --------------------------------------------------------

--
-- Table structure for table `essort_class_attendence`
--

CREATE TABLE `essort_class_attendence` (
  `attendence_id` int(8) NOT NULL,
  `stu_id` varchar(8) NOT NULL,
  `stu_role` varchar(150) NOT NULL,
  `att_in_time` varchar(150) NOT NULL,
  `attout_time` varchar(150) NOT NULL,
  `att_date` date NOT NULL,
  `att_session` varchar(150) NOT NULL,
  `att_status` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `essort_class_attendence`
--

INSERT INTO `essort_class_attendence` (`attendence_id`, `stu_id`, `stu_role`, `att_in_time`, `attout_time`, `att_date`, `att_session`, `att_status`) VALUES
(1, '00000016', '', '09:30', '18:30', '2017-03-28', '2016-2017', 'P'),
(4, '00000016', '', '09:30', '18:30', '2017-03-29', '2016-2017', 'P'),
(6, '00000017', '', '09:30', '18:30', '2017-03-29', '2016-2017', 'P');

-- --------------------------------------------------------

--
-- Table structure for table `essort_fee`
--

CREATE TABLE `essort_fee` (
  `id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `sec_id` int(11) NOT NULL,
  `fee_amount` varchar(150) NOT NULL,
  `fee_date` varchar(150) NOT NULL,
  `fee_for_month` varchar(150) NOT NULL,
  `fee_for_year` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `essort_fee_detail`
--

CREATE TABLE `essort_fee_detail` (
  `fee_id` int(8) NOT NULL,
  `fee_elem_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `essort_fee_detail`
--

INSERT INTO `essort_fee_detail` (`fee_id`, `fee_elem_name`) VALUES
(1, 'Addmission Fee'),
(2, 'Orientation Fee'),
(3, 'Caution Money (Refundable)'),
(4, 'Annual Charges'),
(5, 'Activity Charges'),
(6, 'School Magazine'),
(7, 'Educational Tour'),
(8, 'Tuition Fee'),
(9, 'Development Fee'),
(10, 'Computer Fee'),
(11, 'Contingency Fee'),
(12, 'Smart Board Fee'),
(13, 'Sports fee 1'),
(14, 'Games Fee'),
(15, 'New Addmission Fee'),
(16, 'Sports fee'),
(17, 'Sports fee');

-- --------------------------------------------------------

--
-- Table structure for table `essort_fee_discount`
--

CREATE TABLE `essort_fee_discount` (
  `discount_id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL,
  `discount_type` varchar(50) NOT NULL DEFAULT 'quarterly',
  `discount_quarter` varchar(50) NOT NULL,
  `discount_percent` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `essort_fee_late_payment`
--

CREATE TABLE `essort_fee_late_payment` (
  `id` int(8) NOT NULL,
  `fee_id` int(8) NOT NULL,
  `class_id` int(8) NOT NULL,
  `sch_id` int(8) NOT NULL,
  `fee_late_payment_charges` varchar(150) NOT NULL,
  `fee_charges_type` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `essort_fee_pay_type`
--

CREATE TABLE `essort_fee_pay_type` (
  `type_id` int(8) NOT NULL,
  `fee_type_name` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `essort_fee_pay_type`
--

INSERT INTO `essort_fee_pay_type` (`type_id`, `fee_type_name`) VALUES
(1, 'Quarterly'),
(2, 'Monthly'),
(5, 'One TIme');

-- --------------------------------------------------------

--
-- Table structure for table `essort_fee_structure`
--

CREATE TABLE `essort_fee_structure` (
  `fee_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `sec_id` int(11) NOT NULL,
  `fee_elem_id` int(11) NOT NULL,
  `fee_elem_amount` varchar(150) NOT NULL,
  `fee_elem_type` varchar(150) NOT NULL,
  `fee_elem_month` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `essort_fee_structure`
--

INSERT INTO `essort_fee_structure` (`fee_id`, `class_id`, `sec_id`, `fee_elem_id`, `fee_elem_amount`, `fee_elem_type`, `fee_elem_month`) VALUES
(1, 1, 1, 1, '15000', 'One', 'April,July,October,January,April,July,October,January,'),
(2, 1, 1, 2, '5000', 'One', 'April,July,October,January,April,July,October,January,'),
(3, 1, 1, 3, '5000', 'One', 'April,July,October,January,April,July,October,January,'),
(4, 1, 1, 4, '8000', 'One', 'April,July,October,January,April,July,October,January,'),
(5, 1, 1, 5, '2000', 'Quarterly', 'April,July,October,January,April,July,October,January,'),
(6, 1, 1, 6, '500', 'Quarterly', 'April,July,October,January,April,July,October,January,'),
(7, 1, 1, 7, '7000', 'One', 'April,July,October,January,April,July,October,January,'),
(8, 1, 1, 8, '2000', 'Monthly', 'April,July,October,January,April,July,October,January,'),
(9, 1, 1, 9, '500', 'Monthly', 'April,July,October,January,April,July,October,January,'),
(10, 1, 1, 10, '500', 'Monthly', 'April,July,October,January,April,July,October,January,'),
(11, 1, 1, 11, '250', 'Monthly', 'April,July,October,January,April,July,October,January,'),
(12, 1, 1, 12, '300', 'Monthly', 'April,July,October,January,April,July,October,January,'),
(13, 1, 2, 1, '15000', 'One', 'April,July,October,January,April,July,October,January,'),
(14, 1, 2, 2, '5000', 'One', 'April,July,October,January,April,July,October,January,'),
(15, 1, 2, 3, '5000', 'One', 'April,July,October,January,April,July,October,January,'),
(16, 1, 2, 4, '8000', 'One', 'April,July,October,January,April,July,October,January,'),
(17, 1, 2, 5, '2000', 'Quarterly', 'April,July,October,January,April,July,October,January,'),
(18, 1, 2, 6, '500', 'Quarterly', 'April,July,October,January,April,July,October,January,'),
(19, 1, 2, 7, '7000', 'One', 'April,July,October,January,April,July,October,January,'),
(20, 1, 2, 8, '2000', 'Monthly', 'April,July,October,January,April,July,October,January,'),
(21, 1, 2, 9, '500', 'Monthly', 'April,July,October,January,April,July,October,January,'),
(22, 1, 2, 10, '500', 'Monthly', 'April,July,October,January,April,July,October,January,'),
(23, 1, 2, 11, '250', 'Monthly', 'April,July,October,January,April,July,October,January,'),
(24, 1, 2, 12, '300', 'Monthly', 'April,July,October,January,April,July,October,January,'),
(25, 1, 3, 1, '15000', 'One', 'April,July,October,January,April,July,October,January,'),
(26, 1, 3, 2, '5000', 'One', 'April,July,October,January,April,July,October,January,'),
(27, 1, 3, 3, '5000', 'One', 'April,July,October,January,April,July,October,January,'),
(28, 1, 3, 4, '8000', 'One', 'April,July,October,January,April,July,October,January,'),
(29, 1, 3, 5, '2000', 'Quarterly', 'April,July,October,January,April,July,October,January,'),
(30, 1, 3, 6, '500', 'Quarterly', 'April,July,October,January,April,July,October,January,'),
(31, 1, 3, 7, '7000', 'One', 'April,July,October,January,April,July,October,January,'),
(32, 1, 3, 8, '2000', 'Monthly', 'April,July,October,January,April,July,October,January,'),
(33, 1, 3, 9, '500', 'Monthly', 'April,July,October,January,April,July,October,January,'),
(34, 1, 3, 10, '500', 'Monthly', 'April,July,October,January,April,July,October,January,'),
(35, 1, 3, 11, '250', 'Monthly', 'April,July,October,January,April,July,October,January,'),
(36, 1, 3, 12, '300', 'Monthly', 'April,July,October,January,April,July,October,January,'),
(37, 1, 4, 1, '15000', 'One', 'April,July,October,January,April,July,October,January,'),
(38, 1, 4, 2, '5000', 'One', 'April,July,October,January,April,July,October,January,'),
(39, 1, 4, 3, '5000', 'One', 'April,July,October,January,April,July,October,January,'),
(40, 1, 4, 4, '8000', 'One', 'April,July,October,January,April,July,October,January,'),
(41, 1, 4, 5, '2000', 'Quarterly', 'April,July,October,January,April,July,October,January,'),
(42, 1, 4, 6, '500', 'Quarterly', 'April,July,October,January,April,July,October,January,'),
(43, 1, 4, 7, '7000', 'One', 'April,July,October,January,April,July,October,January,'),
(44, 1, 4, 8, '2000', 'Monthly', 'April,July,October,January,April,July,October,January,'),
(45, 1, 4, 9, '500', 'Monthly', 'April,July,October,January,April,July,October,January,'),
(46, 1, 4, 10, '500', 'Monthly', 'April,July,October,January,April,July,October,January,'),
(47, 1, 4, 11, '250', 'Monthly', 'April,July,October,January,April,July,October,January,'),
(48, 1, 4, 12, '300', 'Monthly', 'April,July,October,January,April,July,October,January,'),
(49, 1, 20, 1, '15000', 'One', 'April,July,October,January,April,July,October,January,'),
(50, 1, 20, 2, '5000', 'One', 'April,July,October,January,April,July,October,January,'),
(51, 1, 20, 3, '5000', 'One', 'April,July,October,January,April,July,October,January,'),
(52, 1, 20, 4, '8000', 'One', 'April,July,October,January,April,July,October,January,'),
(53, 1, 20, 5, '2000', 'Quarterly', 'April,July,October,January,April,July,October,January,'),
(54, 1, 20, 6, '500', 'Quarterly', 'April,July,October,January,April,July,October,January,'),
(55, 1, 20, 7, '7000', 'One', 'April,July,October,January,April,July,October,January,'),
(56, 1, 20, 8, '2000', 'Monthly', 'April,July,October,January,April,July,October,January,'),
(57, 1, 20, 9, '500', 'Monthly', 'April,July,October,January,April,July,October,January,'),
(58, 1, 20, 10, '500', 'Monthly', 'April,July,October,January,April,July,October,January,'),
(59, 1, 20, 11, '250', 'Monthly', 'April,July,October,January,April,July,October,January,'),
(60, 1, 20, 12, '300', 'Monthly', 'April,July,October,January,April,July,October,January,');

-- --------------------------------------------------------

--
-- Table structure for table `essort_fee_timeline`
--

CREATE TABLE `essort_fee_timeline` (
  `ftime_id` int(11) NOT NULL,
  `ftime_sdate` date NOT NULL,
  `ftime_edate` date NOT NULL,
  `ftime_equarter` varchar(150) NOT NULL,
  `fpenality_type` varchar(150) NOT NULL,
  `fpenality` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `essort_fee_timeline`
--

INSERT INTO `essort_fee_timeline` (`ftime_id`, `ftime_sdate`, `ftime_edate`, `ftime_equarter`, `fpenality_type`, `fpenality`) VALUES
(1, '2017-01-01', '2017-01-10', 'fourth', 'Fixed', '10');

-- --------------------------------------------------------

--
-- Table structure for table `essort_fee_transaction`
--

CREATE TABLE `essort_fee_transaction` (
  `trans_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fee_quarter` varchar(150) NOT NULL,
  `fee_created_on` date NOT NULL,
  `payment_amount_by_user` varchar(150) NOT NULL,
  `discount_by_school` varchar(150) NOT NULL,
  `penality` varchar(150) NOT NULL,
  `previous_amount` varchar(150) NOT NULL,
  `balance_till_date` date NOT NULL,
  `payment_mode` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `cheque_no` varchar(50) NOT NULL,
  `micr_code` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `essort_holidays`
--

CREATE TABLE `essort_holidays` (
  `id` int(8) NOT NULL,
  `usr_id` int(11) NOT NULL,
  `usr_role` varchar(150) NOT NULL,
  `occassion_type` varchar(150) NOT NULL,
  `off_day` varchar(150) NOT NULL,
  `occassion` varchar(150) NOT NULL,
  `additional_info` text NOT NULL,
  `status` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `essort_holidays`
--

INSERT INTO `essort_holidays` (`id`, `usr_id`, `usr_role`, `occassion_type`, `off_day`, `occassion`, `additional_info`, `status`) VALUES
(1, 1, 'Admin', 'Event', '2017-03-29', 'EventSubject', 'EventSubjectDesc', 1),
(2, 1, 'Admin', 'Event', '2017-03-30', 'EventSubject', 'EventSubjectDesc', 1),
(3, 1, 'Admin', 'Event', '2017-03-31', 'EventSubject', 'EventSubjectDesc', 1),
(4, 1, 'Admin', 'Holiday', '2017-04-05', 'Ram Navami', 'Ram Navami', 1),
(5, 1, 'Admin', 'Holiday', '2017-04-14', 'Good Friday', 'Good Friday', 1),
(6, 1, 'Admin', 'Holiday', '2017-04-09', 'Mahavir Jayanti', 'Mahavir Jayanti', 0),
(7, 2, 'Principal', 'Event', '2017-04-16', 'Parents meeting', 'Parents meeting', 0);

-- --------------------------------------------------------

--
-- Table structure for table `essort_message_master`
--

CREATE TABLE `essort_message_master` (
  `message_id` int(11) NOT NULL,
  `from_id` varchar(50) NOT NULL,
  `from_role` varchar(50) NOT NULL,
  `to_id` varchar(50) NOT NULL,
  `to_role` varchar(50) NOT NULL,
  `message_status` tinyint(1) NOT NULL DEFAULT '2' COMMENT '0:delete,1:read,2:unread',
  `delete_status` tinyint(1) NOT NULL DEFAULT '0',
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `attachment` varchar(50) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `essort_message_master`
--

INSERT INTO `essort_message_master` (`message_id`, `from_id`, `from_role`, `to_id`, `to_role`, `message_status`, `delete_status`, `subject`, `message`, `attachment`, `date`) VALUES
(1, '2', 'Principal', '1', 'Admin', 1, 1, 'Test', 'Test', '', '2017-03-28 11:13:00'),
(2, '1', 'Admin', '2', 'Principal', 1, 1, 'hii principal', 'hii principal msg', '', '2017-03-28 11:20:43'),
(3, '2', 'Principal', '1', 'Admin', 1, 1, 'hi Admin', 'hii Admin', '', '2017-03-28 11:21:04'),
(4, '2', 'Principal', '1', 'Admin', 1, 1, 'new year Fest', 'hello', '', '2017-03-28 12:02:10'),
(5, '2', 'Principal', '1', 'Admin', 1, 0, 'Biology', 'ppoooooooooooooooooooooooooooooooooooooooooooooooooooooooo', '', '2017-03-28 12:04:00'),
(6, '2', 'Principal', '1', 'Admin', 1, 1, 'Admin Subbbbbbb', 'Admin msg', '', '2017-03-28 12:05:27'),
(7, '2', 'Principal', '1', 'Admin', 1, 1, 'new year Fest', 'Messages                    ', '', '2017-03-28 12:13:19'),
(9, '2', 'Principal', '1', 'Admin', 1, 0, 'English', 'dsfsdfdsfsdfsdfsdfdsfsdfsdf', '', '2017-03-28 12:15:08'),
(10, '1', 'Admin', '2', 'Principal', 1, 0, 'Test', 'Test msg to Principal', '', '2017-03-29 11:26:24'),
(11, '1', 'Admin', '2', 'Principal', 1, 0, 'Biology', 'yesssss', '', '2017-03-29 15:00:32'),
(12, '1', 'Admin', '2', 'Principal', 1, 0, 'Logo of school', 'logo of school', 'mis logo - Copy.jpg', '2017-03-30 11:33:57'),
(13, '2', 'Principal', '1', 'Admin', 1, 0, 'hii principal mam', 'hii how r u?', '', '2017-03-30 12:32:31'),
(14, '1', 'Admin', '2', 'Principal', 1, 0, 'hii principal mam', 'hello', '', '2017-03-30 13:59:42'),
(15, '1', 'Admin', '2', 'Principal', 1, 0, 'hii principal mam', 'hello again', '', '2017-03-30 14:00:10'),
(16, '1', 'Admin', '2', 'Principal', 1, 0, 'hii princ', 'sub princ', '', '2017-03-30 14:34:45'),
(17, '2', 'Principal', '1', 'Admin', 1, 1, 'Test', 'test again', '', '2017-03-30 14:47:22'),
(18, '2', 'Principal', '1', 'Admin', 1, 0, 'School fee', 'hello', '', '2017-04-04 11:53:28'),
(19, '1', 'Admin', '2', 'Principal', 2, 0, 'School fee', 'ok', '', '2017-04-04 11:58:05');

-- --------------------------------------------------------

--
-- Table structure for table `essort_section`
--

CREATE TABLE `essort_section` (
  `section_id` int(11) NOT NULL,
  `class_id` int(8) NOT NULL,
  `section_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `essort_section`
--

INSERT INTO `essort_section` (`section_id`, `class_id`, `section_name`) VALUES
(1, 1, 'A'),
(2, 1, 'B'),
(3, 2, 'A'),
(4, 2, 'B'),
(5, 3, 'A'),
(6, 4, 'A'),
(7, 5, 'A'),
(8, 6, 'A'),
(9, 7, 'A'),
(10, 8, 'A'),
(11, 9, 'A'),
(12, 10, 'A'),
(13, 11, 'A'),
(14, 12, 'A'),
(15, 3, 'B');

-- --------------------------------------------------------

--
-- Table structure for table `essort_staff_salary`
--

CREATE TABLE `essort_staff_salary` (
  `sal_info_id` int(11) NOT NULL,
  `emp_id` varchar(150) NOT NULL,
  `salary_year` varchar(150) NOT NULL,
  `salary_month` varchar(150) NOT NULL,
  `salary_amount` varchar(150) NOT NULL,
  `salary_status` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `essort_staff_salary`
--

INSERT INTO `essort_staff_salary` (`sal_info_id`, `emp_id`, `salary_year`, `salary_month`, `salary_amount`, `salary_status`) VALUES
(1, 'EMP000003', '2017-2018', 'March', '5000', 'Confirmed'),
(2, 'EMP000004', '2017-2018', 'March', '6000', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `essort_student_leave_info`
--

CREATE TABLE `essort_student_leave_info` (
  `leave_id` int(8) NOT NULL,
  `usr_id` int(8) NOT NULL,
  `leave_apply_by` varchar(150) NOT NULL,
  `leave_date` date NOT NULL,
  `is_half_day` int(11) NOT NULL,
  `submit_date` date NOT NULL,
  `approval_date` date NOT NULL,
  `leave_status` varchar(150) NOT NULL,
  `leave_reason` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `essort_subject_allocation`
--

CREATE TABLE `essort_subject_allocation` (
  `allocation_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `essort_subject_allocation`
--

INSERT INTO `essort_subject_allocation` (`allocation_id`, `section_id`, `sub_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3),
(4, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `essort_subject_master`
--

CREATE TABLE `essort_subject_master` (
  `sub_id` int(11) NOT NULL,
  `sub_name` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `essort_subject_master`
--

INSERT INTO `essort_subject_master` (`sub_id`, `sub_name`) VALUES
(1, 'English'),
(2, 'Hindi'),
(3, 'Maths'),
(4, 'Arts'),
(5, 'Environmental Studies'),
(6, 'Sanskrit'),
(7, 'General Science'),
(8, 'Social Science'),
(9, 'Science');

-- --------------------------------------------------------

--
-- Table structure for table `essort_teacher_class`
--

CREATE TABLE `essort_teacher_class` (
  `id` int(11) NOT NULL,
  `staff_id` int(8) NOT NULL,
  `class_id` int(8) NOT NULL,
  `section_id` int(8) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `is_assign` varchar(150) NOT NULL,
  `assigned_by` varchar(150) NOT NULL,
  `valid_till` date NOT NULL,
  `access_type` varchar(150) NOT NULL,
  `is_classteacher` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `essort_teacher_class`
--

INSERT INTO `essort_teacher_class` (`id`, `staff_id`, `class_id`, `section_id`, `subject_id`, `is_assign`, `assigned_by`, `valid_till`, `access_type`, `is_classteacher`) VALUES
(4, 2, 0, 0, 0, '', '', '0000-00-00', '', ''),
(5, 3, 1, 1, 1, '', '', '0000-00-00', '', '1'),
(6, 4, 2, 3, 2, '', '', '0000-00-00', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `essort_teacher_leave_info`
--

CREATE TABLE `essort_teacher_leave_info` (
  `leave_id` int(8) NOT NULL,
  `usr_id` int(8) NOT NULL,
  `leave_apply_by` varchar(150) NOT NULL,
  `leave_date` date NOT NULL,
  `is_half_day` int(11) NOT NULL,
  `submit_date` date NOT NULL,
  `approval_date` date NOT NULL,
  `leave_status` varchar(150) NOT NULL,
  `leave_reason` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `essort_user_details`
--

CREATE TABLE `essort_user_details` (
  `id` int(11) NOT NULL,
  `usr_id` int(8) NOT NULL,
  `education` varchar(150) NOT NULL,
  `usr_address` varchar(150) NOT NULL,
  `exp_yr` varchar(150) NOT NULL,
  `exp_detail` varchar(150) NOT NULL,
  `usr_marital_status` varchar(150) NOT NULL,
  `usr_designation` varchar(150) NOT NULL,
  `photo` varchar(150) NOT NULL,
  `graduation` varchar(150) NOT NULL,
  `dept_name` varchar(150) NOT NULL,
  `master_graduation` varchar(150) NOT NULL,
  `usr_salary` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `essort_user_details`
--

INSERT INTO `essort_user_details` (`id`, `usr_id`, `education`, `usr_address`, `exp_yr`, `exp_detail`, `usr_marital_status`, `usr_designation`, `photo`, `graduation`, `dept_name`, `master_graduation`, `usr_salary`) VALUES
(1, 1, '', '', '', '', '', '', '', '', '', '', 0),
(2, 2, 'M.A , B.ED.', 'E- 121-DREAM CITY , KANKER KHERA ,MEERUT', '10', 'K.K PUBLIC SCHOOL AS A PRINCIPAL', 'Married', 'Principal', '', ' B.ED.', 'Principal', 'M.A', 45000),
(3, 3, '', '', '', '', '', 'Teacher', '', '', 'Teaching', '', 42000),
(4, 4, '', '', '', '', '', '', '', '', 'Teacher', '', 25000),
(5, 5, '', '', '', '', '', '', '', '', 'Father', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `essort_user_header`
--

CREATE TABLE `essort_user_header` (
  `usr_id` int(8) NOT NULL,
  `usr_role` varchar(150) NOT NULL,
  `usr_fname` varchar(150) NOT NULL,
  `usr_mname` varchar(150) NOT NULL,
  `usr_lname` varchar(150) NOT NULL,
  `usr_pic` varchar(150) NOT NULL,
  `usr_gender` varchar(150) NOT NULL,
  `usr_dob` varchar(150) NOT NULL,
  `usr_phone` varchar(20) NOT NULL,
  `usr_mobile` varchar(12) NOT NULL,
  `usr_status` int(8) NOT NULL,
  `usr_email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `usr_pass_code` varchar(150) NOT NULL,
  `att_ref_id` varchar(150) NOT NULL,
  `emp_id` varchar(150) NOT NULL,
  `valid_till` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `essort_user_header`
--

INSERT INTO `essort_user_header` (`usr_id`, `usr_role`, `usr_fname`, `usr_mname`, `usr_lname`, `usr_pic`, `usr_gender`, `usr_dob`, `usr_phone`, `usr_mobile`, `usr_status`, `usr_email`, `password`, `usr_pass_code`, `att_ref_id`, `emp_id`, `valid_till`) VALUES
(1, 'SAD', 'Admin', '', '', '', '', '', '', '', 1, 'admin@mismti.in', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '0000-00-00'),
(2, 'Principal', 'Naresh', 'Kumar', 'Singh', '', 'Male', '1969-01-07', '', '8979994488', 1, 'principalmis3@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '883350', '', 'EMP000002', '0000-00-00'),
(3, 'Teacher', 'Test Teacher 1', 'K', 'Singh', '', '', '', '', '9638527410', 1, 'jyoti.sharma@vibescom.in', 'e10adc3949ba59abbe56e057f20f883e', '854165', '00000016', 'EMP000003', '0000-00-00'),
(4, 'Teacher', 'Test Teacher 2', 'k', 'Singh', '', '', '', '', '8750752333', 1, 'abhay.yadav@vibescom.in', '5fbcf70d27063b784f44cac35923997b', '', '00000017', 'EMP000004', '0000-00-00'),
(5, 'Parent', 'Rajeev', 'K', 'Singh', '', '', '', '', '741852960', 1, 'rajeevsingh@mismtc.in', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `essort_user_relation`
--

CREATE TABLE `essort_user_relation` (
  `id` int(8) NOT NULL,
  `class_id` varchar(150) NOT NULL,
  `sec_id` varchar(150) NOT NULL,
  `stu_id` int(150) NOT NULL,
  `parent_id` int(150) NOT NULL,
  `att_ref_id` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `essort_user_relation`
--

INSERT INTO `essort_user_relation` (`id`, `class_id`, `sec_id`, `stu_id`, `parent_id`, `att_ref_id`) VALUES
(1, '1', '1', 1, 5, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eesort_role`
--
ALTER TABLE `eesort_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `essort_application_family_info`
--
ALTER TABLE `essort_application_family_info`
  ADD PRIMARY KEY (`parent_id`);

--
-- Indexes for table `essort_application_header`
--
ALTER TABLE `essort_application_header`
  ADD PRIMARY KEY (`usr_application_id`);

--
-- Indexes for table `essort_circular_activities`
--
ALTER TABLE `essort_circular_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `essort_classes`
--
ALTER TABLE `essort_classes`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `essort_class_attendence`
--
ALTER TABLE `essort_class_attendence`
  ADD PRIMARY KEY (`attendence_id`);

--
-- Indexes for table `essort_fee`
--
ALTER TABLE `essort_fee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `essort_fee_detail`
--
ALTER TABLE `essort_fee_detail`
  ADD PRIMARY KEY (`fee_id`);

--
-- Indexes for table `essort_fee_discount`
--
ALTER TABLE `essort_fee_discount`
  ADD PRIMARY KEY (`discount_id`);

--
-- Indexes for table `essort_fee_late_payment`
--
ALTER TABLE `essort_fee_late_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `essort_fee_pay_type`
--
ALTER TABLE `essort_fee_pay_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `essort_fee_structure`
--
ALTER TABLE `essort_fee_structure`
  ADD PRIMARY KEY (`fee_id`);

--
-- Indexes for table `essort_fee_timeline`
--
ALTER TABLE `essort_fee_timeline`
  ADD PRIMARY KEY (`ftime_id`);

--
-- Indexes for table `essort_fee_transaction`
--
ALTER TABLE `essort_fee_transaction`
  ADD PRIMARY KEY (`trans_id`);

--
-- Indexes for table `essort_holidays`
--
ALTER TABLE `essort_holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `essort_message_master`
--
ALTER TABLE `essort_message_master`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `essort_section`
--
ALTER TABLE `essort_section`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `essort_staff_salary`
--
ALTER TABLE `essort_staff_salary`
  ADD PRIMARY KEY (`sal_info_id`);

--
-- Indexes for table `essort_student_leave_info`
--
ALTER TABLE `essort_student_leave_info`
  ADD PRIMARY KEY (`leave_id`);

--
-- Indexes for table `essort_subject_allocation`
--
ALTER TABLE `essort_subject_allocation`
  ADD PRIMARY KEY (`allocation_id`);

--
-- Indexes for table `essort_subject_master`
--
ALTER TABLE `essort_subject_master`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `essort_teacher_class`
--
ALTER TABLE `essort_teacher_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `essort_teacher_leave_info`
--
ALTER TABLE `essort_teacher_leave_info`
  ADD PRIMARY KEY (`leave_id`);

--
-- Indexes for table `essort_user_details`
--
ALTER TABLE `essort_user_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `essort_user_header`
--
ALTER TABLE `essort_user_header`
  ADD UNIQUE KEY `usr_id` (`usr_id`);

--
-- Indexes for table `essort_user_relation`
--
ALTER TABLE `essort_user_relation`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eesort_role`
--
ALTER TABLE `eesort_role`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `essort_application_family_info`
--
ALTER TABLE `essort_application_family_info`
  MODIFY `parent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `essort_application_header`
--
ALTER TABLE `essort_application_header`
  MODIFY `usr_application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `essort_circular_activities`
--
ALTER TABLE `essort_circular_activities`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `essort_classes`
--
ALTER TABLE `essort_classes`
  MODIFY `class_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `essort_class_attendence`
--
ALTER TABLE `essort_class_attendence`
  MODIFY `attendence_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `essort_fee`
--
ALTER TABLE `essort_fee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `essort_fee_detail`
--
ALTER TABLE `essort_fee_detail`
  MODIFY `fee_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `essort_fee_late_payment`
--
ALTER TABLE `essort_fee_late_payment`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `essort_fee_pay_type`
--
ALTER TABLE `essort_fee_pay_type`
  MODIFY `type_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `essort_fee_structure`
--
ALTER TABLE `essort_fee_structure`
  MODIFY `fee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `essort_fee_timeline`
--
ALTER TABLE `essort_fee_timeline`
  MODIFY `ftime_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `essort_fee_transaction`
--
ALTER TABLE `essort_fee_transaction`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `essort_holidays`
--
ALTER TABLE `essort_holidays`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `essort_message_master`
--
ALTER TABLE `essort_message_master`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `essort_section`
--
ALTER TABLE `essort_section`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `essort_staff_salary`
--
ALTER TABLE `essort_staff_salary`
  MODIFY `sal_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `essort_student_leave_info`
--
ALTER TABLE `essort_student_leave_info`
  MODIFY `leave_id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `essort_subject_allocation`
--
ALTER TABLE `essort_subject_allocation`
  MODIFY `allocation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `essort_subject_master`
--
ALTER TABLE `essort_subject_master`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `essort_teacher_class`
--
ALTER TABLE `essort_teacher_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `essort_teacher_leave_info`
--
ALTER TABLE `essort_teacher_leave_info`
  MODIFY `leave_id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `essort_user_details`
--
ALTER TABLE `essort_user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `essort_user_header`
--
ALTER TABLE `essort_user_header`
  MODIFY `usr_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `essort_user_relation`
--
ALTER TABLE `essort_user_relation`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
