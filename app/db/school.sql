-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2023 at 04:14 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendancies`
--

CREATE TABLE `attendancies` (
  `attendancyId` varchar(4) NOT NULL,
  `attendancyStudentId` varchar(4) NOT NULL,
  `attendancyReason` varchar(255) NOT NULL,
  `attendancyIsActive` tinyint(1) NOT NULL,
  `attendancyCreateDate` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `classId` varchar(4) NOT NULL,
  `classTeacherId` varchar(4) NOT NULL,
  `className` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `classhasteachers`
--

CREATE TABLE `classhasteachers` (
  `teacherId` varchar(4) NOT NULL,
  `classId` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `educations`
--

CREATE TABLE `educations` (
  `educationId` varchar(4) NOT NULL,
  `educationName` varchar(55) NOT NULL,
  `educationDuration` varchar(10) NOT NULL,
  `educationDescription` text DEFAULT NULL,
  `educationIsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `gradeId` varchar(4) NOT NULL,
  `gradeStudentId` varchar(4) NOT NULL,
  `gradeSubjectId` varchar(4) NOT NULL,
  `gradeGrade` varchar(3) NOT NULL,
  `gradeCreateDate` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `schoolhaseducations`
--

CREATE TABLE `schoolhaseducations` (
  `schoolId` varchar(4) NOT NULL,
  `educationId` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `schoolhassubjects`
--

CREATE TABLE `schoolhassubjects` (
  `schoolid` varchar(4) NOT NULL,
  `subjectId` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `schoolId` varchar(4) NOT NULL,
  `schoolName` varchar(150) NOT NULL,
  `schoolAdres` varchar(150) NOT NULL,
  `schoolIsActive` tinyint(1) NOT NULL,
  `schoolCreateDate` varchar(10) NOT NULL,
  `schoolDescription` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `studenthassubjects`
--

CREATE TABLE `studenthassubjects` (
  `studentId` varchar(4) NOT NULL,
  `subjectId` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `studentId` varchar(4) NOT NULL,
  `studentSchoolId` varchar(4) NOT NULL,
  `studentEducationId` varchar(4) NOT NULL,
  `studentClassId` varchar(4) NOT NULL,
  `studentFirstName` varchar(50) NOT NULL,
  `studentLastName` varchar(50) NOT NULL,
  `studentAdres` varchar(150) NOT NULL,
  `studentIsActive` tinyint(1) NOT NULL,
  `studentCreateDate` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subjectId` varchar(4) NOT NULL,
  `subjectName` varchar(255) NOT NULL,
  `subjectDescription` text DEFAULT NULL,
  `subjectIsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `teacherhassubjects`
--

CREATE TABLE `teacherhassubjects` (
  `teacherId` varchar(4) NOT NULL,
  `subjectId` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacherId` varchar(4) NOT NULL,
  `teacherSchoolId` varchar(4) NOT NULL,
  `teacherFirstName` varchar(50) NOT NULL,
  `teacherLastName` varchar(50) NOT NULL,
  `teacherAdres` varchar(150) NOT NULL,
  `teacherIsActive` tinyint(1) NOT NULL,
  `teacherCreateDate` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendancies`
--
ALTER TABLE `attendancies`
  ADD PRIMARY KEY (`attendancyId`),
  ADD KEY `attendancyStudentId` (`attendancyStudentId`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`classId`),
  ADD KEY `classTeacherId` (`classTeacherId`);

--
-- Indexes for table `classhasteachers`
--
ALTER TABLE `classhasteachers`
  ADD KEY `classId` (`classId`),
  ADD KEY `teacherId` (`teacherId`);

--
-- Indexes for table `educations`
--
ALTER TABLE `educations`
  ADD PRIMARY KEY (`educationId`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`gradeId`),
  ADD KEY `gradeStudentId` (`gradeStudentId`),
  ADD KEY `gradeSubjectId` (`gradeSubjectId`);

--
-- Indexes for table `schoolhaseducations`
--
ALTER TABLE `schoolhaseducations`
  ADD KEY `educationId` (`educationId`),
  ADD KEY `schoolId` (`schoolId`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`schoolId`);

--
-- Indexes for table `studenthassubjects`
--
ALTER TABLE `studenthassubjects`
  ADD KEY `subjectId` (`subjectId`),
  ADD KEY `studentId` (`studentId`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`studentId`),
  ADD KEY `studentClassId` (`studentClassId`),
  ADD KEY `studentEducationId` (`studentEducationId`),
  ADD KEY `studentSchoolId` (`studentSchoolId`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subjectId`);

--
-- Indexes for table `teacherhassubjects`
--
ALTER TABLE `teacherhassubjects`
  ADD KEY `subjectId` (`subjectId`),
  ADD KEY `teacherId` (`teacherId`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacherId`),
  ADD KEY `teacherSchoolId` (`teacherSchoolId`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendancies`
--
ALTER TABLE `attendancies`
  ADD CONSTRAINT `attendancies_ibfk_1` FOREIGN KEY (`attendancyStudentId`) REFERENCES `students` (`studentId`) ON UPDATE CASCADE;

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`classTeacherId`) REFERENCES `teachers` (`teacherId`) ON UPDATE CASCADE;

--
-- Constraints for table `classhasteachers`
--
ALTER TABLE `classhasteachers`
  ADD CONSTRAINT `classhasteachers_ibfk_1` FOREIGN KEY (`classId`) REFERENCES `classes` (`classId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `classhasteachers_ibfk_2` FOREIGN KEY (`teacherId`) REFERENCES `teachers` (`teacherId`) ON UPDATE CASCADE;

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`gradeStudentId`) REFERENCES `students` (`studentId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `grades_ibfk_2` FOREIGN KEY (`gradeSubjectId`) REFERENCES `subjects` (`subjectId`) ON UPDATE CASCADE;

--
-- Constraints for table `schoolhaseducations`
--
ALTER TABLE `schoolhaseducations`
  ADD CONSTRAINT `schoolhaseducations_ibfk_1` FOREIGN KEY (`educationId`) REFERENCES `educations` (`educationId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `schoolhaseducations_ibfk_2` FOREIGN KEY (`schoolId`) REFERENCES `schools` (`schoolId`) ON UPDATE CASCADE;

--
-- Constraints for table `studenthassubjects`
--
ALTER TABLE `studenthassubjects`
  ADD CONSTRAINT `studenthassubjects_ibfk_1` FOREIGN KEY (`subjectId`) REFERENCES `subjects` (`subjectId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `studenthassubjects_ibfk_2` FOREIGN KEY (`studentId`) REFERENCES `students` (`studentId`) ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`studentClassId`) REFERENCES `classes` (`classId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`studentEducationId`) REFERENCES `educations` (`educationId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `students_ibfk_3` FOREIGN KEY (`studentSchoolId`) REFERENCES `schools` (`schoolId`) ON UPDATE CASCADE;

--
-- Constraints for table `teacherhassubjects`
--
ALTER TABLE `teacherhassubjects`
  ADD CONSTRAINT `teacherhassubjects_ibfk_1` FOREIGN KEY (`subjectId`) REFERENCES `subjects` (`subjectId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `teacherhassubjects_ibfk_2` FOREIGN KEY (`teacherId`) REFERENCES `teachers` (`teacherId`) ON UPDATE CASCADE;

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`teacherSchoolId`) REFERENCES `schools` (`schoolId`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
