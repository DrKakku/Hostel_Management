-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2020 at 04:30 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hostle_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `ID` int(11) NOT NULL,
  `Student_Student_ID` varchar(9) NOT NULL,
  `Attendence` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `grievances`
--

CREATE TABLE `grievances` (
  `Grievances_ID` int(11) NOT NULL,
  `Student_Student_ID` varchar(9) NOT NULL,
  `Grievances` varchar(200) NOT NULL,
  `Report_Date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hostel_block`
--

CREATE TABLE `hostel_block` (
  `Block_name` varchar(10) NOT NULL,
  `Student_Student_id` varchar(9) NOT NULL,
  `Staff_Staff_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `Shifts_ID` int(11) NOT NULL,
  `Staff_Staff_ID` int(11) NOT NULL,
  `Entry_Time` datetime DEFAULT NULL,
  `Exit_Time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `Staff_ID` int(11) NOT NULL,
  `First_Name` varchar(45) NOT NULL,
  `Last_Name` varchar(45) NOT NULL,
  `Mobile_number` int(11) DEFAULT NULL,
  `Type` varchar(45) NOT NULL,
  `Date_Of_Joining` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `Student_ID` varchar(9) NOT NULL,
  `First_Name` varchar(50) NOT NULL,
  `Last_Name` varchar(45) NOT NULL,
  `Room_Number` varchar(10) NOT NULL,
  `Block` varchar(45) NOT NULL,
  `Room_Type` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student_leave`
--

CREATE TABLE `student_leave` (
  `Leave_ID` int(11) NOT NULL,
  `Student_ID` varchar(9) NOT NULL,
  `Leave_Date` date NOT NULL,
  `Return_Date` date NOT NULL,
  `Reason` varchar(250) NOT NULL,
  `destination` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `timestamps`
--

CREATE TABLE `timestamps` (
  `create_time` datetime DEFAULT current_timestamp(),
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `Visitor_ID` int(11) NOT NULL,
  `Student_ID` varchar(9) NOT NULL,
  `Visitor_Name` varchar(50) NOT NULL,
  `Visit_Date` datetime NOT NULL DEFAULT current_timestamp(),
  `Purpose` varchar(215) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_Attendance_Student1_idx` (`Student_Student_ID`);

--
-- Indexes for table `grievances`
--
ALTER TABLE `grievances`
  ADD PRIMARY KEY (`Grievances_ID`),
  ADD KEY `fk_Grievances_Student1_idx` (`Student_Student_ID`);

--
-- Indexes for table `hostel_block`
--
ALTER TABLE `hostel_block`
  ADD PRIMARY KEY (`Block_name`),
  ADD UNIQUE KEY `Block_name_UNIQUE` (`Block_name`),
  ADD KEY `fk_Hostel_Block_Student_idx` (`Student_Student_id`),
  ADD KEY `fk_Hostel_Block_Staff1_idx` (`Staff_Staff_ID`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`Shifts_ID`,`Staff_Staff_ID`),
  ADD KEY `fk_Shifts_Staff1_idx` (`Staff_Staff_ID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`Staff_ID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`Student_ID`),
  ADD UNIQUE KEY `Student_id_UNIQUE` (`Student_ID`);

--
-- Indexes for table `student_leave`
--
ALTER TABLE `student_leave`
  ADD PRIMARY KEY (`Leave_ID`),
  ADD KEY `fk_Leave_Student1_idx` (`Student_ID`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`Visitor_ID`),
  ADD KEY `student_id` (`Student_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grievances`
--
ALTER TABLE `grievances`
  MODIFY `Grievances_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `Shifts_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_leave`
--
ALTER TABLE `student_leave`
  MODIFY `Leave_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `Visitor_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `fk_Attendance_Student1` FOREIGN KEY (`Student_Student_ID`) REFERENCES `student` (`Student_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `grievances`
--
ALTER TABLE `grievances`
  ADD CONSTRAINT `fk_Grievances_Student1` FOREIGN KEY (`Student_Student_ID`) REFERENCES `student` (`Student_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `hostel_block`
--
ALTER TABLE `hostel_block`
  ADD CONSTRAINT `fk_Hostel_Block_Staff1` FOREIGN KEY (`Staff_Staff_ID`) REFERENCES `staff` (`Staff_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Hostel_Block_Student` FOREIGN KEY (`Student_Student_id`) REFERENCES `student` (`Student_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `shifts`
--
ALTER TABLE `shifts`
  ADD CONSTRAINT `fk_Shifts_Staff1` FOREIGN KEY (`Staff_Staff_ID`) REFERENCES `staff` (`Staff_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `student_leave`
--
ALTER TABLE `student_leave`
  ADD CONSTRAINT `fk_Leave_Student1` FOREIGN KEY (`Student_ID`) REFERENCES `student` (`Student_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
