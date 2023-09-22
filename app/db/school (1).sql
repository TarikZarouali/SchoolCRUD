-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2023 at 03:21 PM
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

--
-- Dumping data for table `attendancies`
--

INSERT INTO `attendancies` (`attendancyId`, `attendancyStudentId`, `attendancyReason`, `attendancyIsActive`, `attendancyCreateDate`) VALUES
('1234', 'T3dJ', 'ziek', 0, 'dsds'),
('3231', '1231', '333', 0, '444'),
('c3Ua', 'GOQV', 'a', 0, '1695383695'),
('k0bd', 'GOQV', 'aaa', 0, '1695383732'),
('Mpd1', 'GOQV', 'aa', 0, '1695383681'),
('pOax', 'T3dJ', 'aa', 0, '1695305277'),
('R4t3', 'GOQV', 'aaaaa', 0, '1695383712'),
('tJFj', 'GOQV', 'sicks', 1, '1695383655');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `classId` varchar(4) NOT NULL,
  `classTeacherId` varchar(4) NOT NULL,
  `className` varchar(10) NOT NULL,
  `classIsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`classId`, `classTeacherId`, `className`, `classIsActive`) VALUES
('2323', 'QuNI', 'eeee', 0),
('2341', 'QuNI', 'dfsfds', 0),
('3GC8', 'v2Q7', 'sss', 0),
('3qgR', 'QuNI', 'SD1B', 0),
('6oPJ', 'v2Q7', 'SD1B', 0),
('Bniy', 'QuNI', 'sss', 0),
('Br8Z', 'QuNI', 'SD1A', 1),
('I3dF', 'v2Q7', 'SD1A', 1),
('qiXs', '8rGF', 'd', 1);

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

--
-- Dumping data for table `educations`
--

INSERT INTO `educations` (`educationId`, `educationName`, `educationDuration`, `educationDescription`, `educationIsActive`) VALUES
('0KG4', 'd', 'd', 'd', 0),
('7lpo', 'it systems and devices', '3', 'Ben jij niet bang voor (complexe) computerproblemen en zie je het als een uitdaging om deze op te lossen? Houd je ervan om samen te werken en mensen verder te helpen als ze een ICT-vraag hebben? Dan is de opleiding Expert IT systems and devices misschien wel wat voor jou!', 0),
('bLwr', '2', '2', '2', 0),
('DbiT', 'Software Developer', '4', 'Hou je van programmeren? Droom je ervan om mee te werken aan het bouwen van websites, apps of games en daar later je beroep van te maken? Dat kan! Meld je aan bij de opleiding Softwaredeveloper bij MBO Utrecht.', 0),
('EVGR', '2', '2', '2', 0),
('ftUg', 'it systems and devices', '3', 'dsdds', 0),
('gl3S', 'it systems and devices', '3', 'lol', 1),
('hdCr', 'it systems and devices', '5', 'hhh', 0),
('HVaC', 'w', 'w', 'w', 0),
('LVxu', 'w', 'w', 'w', 0),
('ouW3', 'j', 'ja', 'j', 0),
('pLBx', 'zorg', '3', 'Voor deze opleiding kan je je alleen nog aanmelden voor de wachtlijst. Na je aanmelding nemen we contact met je op.\r\n\r\nBen jij sociaal, stressbestendig, sta je sterk in je schoenen en wil je graag leren zorgen voor mensen die door ziekte of een beperking niet voor zichzelf kunnen zorgen? Vind je het niet erg om &rsquo;s avonds, &rsquo;s nachts of in het weekend te werken? Dan is de opleiding Verpleegkundige bij MBO Utrecht iets voor jou!', 0),
('pZ81', 'we', 'ew', 'ew', 0),
('Qex7', 'ousassim academie', 'ousassim a', 'ouassim academie\r\n', 1),
('qoaD', '22', '22', '22', 0),
('r0cf', 'it systems and devices', '3', 'w', 1),
('RKWR', 'ouassim', 'ouassim2', '22', 0),
('u7Eh', 's', 's', 's', 0),
('uEa4', 'it systems and devices', '3', 'Ben jij niet bang voor (complexe) computerproblemen en zie je het als een uitdaging om deze op te lossen? Houd je ervan om samen te werken en mensen verder te helpen als ze een ICT-vraag hebben? Dan is de opleiding Expert IT systems and devices misschien wel wat voor jou!', 0),
('V58X', 's', 's', 's', 0),
('VtJ0', '22', '22', '22', 0),
('YOT5', '2222', '22', '22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `gradeId` varchar(4) NOT NULL,
  `gradeStudentId` varchar(4) NOT NULL,
  `gradeName` varchar(150) NOT NULL,
  `gradeGrade` varchar(3) NOT NULL,
  `gradeCreateDate` varchar(10) NOT NULL,
  `gradeIsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`gradeId`, `gradeStudentId`, `gradeName`, `gradeGrade`, `gradeCreateDate`, `gradeIsActive`) VALUES
('0yso', 'T3dJ', 'qq', 'qq', '1695302611', 0),
('1234', 'T3dJ', '', '8', '1111', 0),
('2vpx', 'T3dJ', 'hellos', 'aaa', '1695303164', 1),
('51V2', 'T3dJ', 'aa', 'aa', '1695302579', 0),
('kvoC', '3j14', 'a', 'a', '1695369533', 1),
('tbvT', 'GOQV', 'aa', 'a', '1695383144', 0),
('Twhg', 'GOQV', 'a', 'a', '1695383184', 0),
('vc7z', 'GOQV', 'hello', '1', '1695383414', 0),
('VWiq', 'GOQV', 'aa', 'aa', '1695383563', 0),
('xrLv', 'T3dJ', 'hello', '2', '1695302307', 0);

-- --------------------------------------------------------

--
-- Table structure for table `schoolhaseducations`
--

CREATE TABLE `schoolhaseducations` (
  `schoolId` varchar(4) NOT NULL,
  `educationId` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schoolhaseducations`
--

INSERT INTO `schoolhaseducations` (`schoolId`, `educationId`) VALUES
('ELDL', 'gl3S'),
('IO7O', 'pLBx'),
('ONa3', '0KG4'),
('ONa3', 'DbiT'),
('ONa3', 'EVGR'),
('ONa3', 'hdCr'),
('ONa3', 'HVaC'),
('ONa3', 'LVxu'),
('ONa3', 'ouW3'),
('ONa3', 'pZ81'),
('ONa3', 'Qex7'),
('ONa3', 'RKWR'),
('ONa3', 'u7Eh'),
('sXkA', '7lpo'),
('sXkA', 'bLwr'),
('sXkA', 'ftUg'),
('sXkA', 'qoaD'),
('sXkA', 'r0cf'),
('sXkA', 'uEa4'),
('sXkA', 'VtJ0'),
('sXkA', 'YOT5'),
('zzb5', 'V58X');

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

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`schoolId`, `schoolName`, `schoolAdres`, `schoolIsActive`, `schoolCreateDate`, `schoolDescription`) VALUES
('1Mgy', 'MBO Bouw', 'daltonlaan', 1, '1695388709', 'jdjdj'),
('962c', 'MBO Bouw', 'daltonlaan', 1, '1695388668', 'jdjdj'),
('caOd', 'zorg', 'driebergen', 0, '1695041367', 'dit is een zorg school'),
('ELDL', 'ICT Academia', ' Australi&euml;laan 25', 1, '1695384443', 'ffa'),
('gsMP', 'MBO BOUW2', 'daltonlaan 100', 0, '1695291003', 'dit is een bouw school'),
('IO7O', 'zorg', ' Australi&euml;laan 26', 1, '1695042438', 'zorg school'),
('iw4D', ']]', ']]', 0, '1695384473', ']]'),
('MS2U', 'ff', 'aaa', 0, '1695384448', 'ff'),
('nORc', 'MBO Bouw', 'daltonlaan', 1, '1695388692', 'jdjdj'),
('o0o1', 'vv', 'vv', 0, '1695384454', 'vv'),
('oCIz', 'MBO Bouw', 'daltonlaan', 1, '1695388683', 'jdjdj'),
('ONa3', 'ICT Academie', ' Australi&euml;laan 25', 0, '1695045136', 'Op deze academie leer je hoe je ICT-systemen, computers en netwerken beheert of hoe je applicaties, media of games ontwikkelt. Je hebt ervaring met programmeren of wil dit graag leren. Tijdens de opleiding ga je aan de slag met het technisch realiseren van gems, het programmeren van websites of het ontwikkelen van softwareproducten voor kantoor- en industri&euml;le automatisering. Ook integreer je animaties, grafische, audiovisuele en functionele componenten. Je leert programmeren voor Androidtelefoons en -tablets. De ICT Academie is Cisco gecertificeerd.'),
('RhQ9', 'ICT Academia', ' Australi&euml;laan 25', 0, '1694705890', 'Op deze academie leer je hoe je ICT-systemen, computers en netwerken beheert of hoe je applicaties, media of games ontwikkelt. Je hebt ervaring met programmeren of wil dit graag leren. Tijdens de opleiding ga je aan de slag met het technisch realiseren van gems, het programmeren van websites of het ontwikkelen van softwareproducten voor kantoor- en industri&euml;le automatisering. Ook integreer je animaties, grafische, audiovisuele en functionele componenten. Je leert programmeren voor Androidtelefoons en -tablets. De ICT Academie is Cisco gecertificeerd.'),
('SnPi', 'MBO Bouw', 'daltonlaan', 1, '1695388713', 'jdjdj'),
('sXkA', 'ICT Academia', ' Australi&euml;laan 25', 0, '1695041455', 'Op deze academie leer je hoe je ICT-systemen, computers en netwerken beheert of hoe je applicaties, media of games ontwikkelt. Je hebt ervaring met programmeren of wil dit graag leren. Tijdens de opleiding ga je aan de slag met het technisch realiseren van gems, het programmeren van websites of het ontwikkelen van softwareproducten voor kantoor- en industri&euml;le automatisering. Ook integreer je animaties, grafische, audiovisuele en functionele componenten. Je leert programmeren voor Androidtelefoons en -tablets. De ICT Academie is Cisco gecertificeerd.\r\n\r\n'),
('UFkO', 'aa', 'aa', 0, '1695384477', 'aa'),
('VUci', 'MBO Bouw', 'daltonlaan', 1, '1695388718', 'jdjdj'),
('xbGo', 'MBO Bouw', 'daltonlaan', 1, '1695388706', 'jdjdj'),
('zzb5', 's', 'ff', 0, '1695109603', 'ss');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `studentId` varchar(4) NOT NULL,
  `studentClassId` varchar(4) NOT NULL,
  `studentFirstName` varchar(50) NOT NULL,
  `studentLastName` varchar(50) NOT NULL,
  `studentAdres` varchar(150) NOT NULL,
  `studentIsActive` tinyint(1) NOT NULL,
  `studentCreateDate` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`studentId`, `studentClassId`, `studentFirstName`, `studentLastName`, `studentAdres`, `studentIsActive`, `studentCreateDate`) VALUES
('1231', 'Br8Z', 'tt1a', 'tt', 'tt', 0, 'qqqqqqqqq'),
('3j14', 'qiXs', 's', 's', 's', 1, '1695369526'),
('bYf8', 'I3dF', 'tt1', 'tta', 'jgaaa', 0, '1695382484'),
('g4dJ', 'Br8Z', 'aa', 'aa', 'aa', 0, '1695294251'),
('GOQV', 'I3dF', 'Tarik ', 'Zarouali', 'jsijadas', 1, '1695383077'),
('JYFt', 'I3dF', 'a', 'a', 'a', 0, '1695383058'),
('T3dJ', 'Br8Z', 'Tarik', 'Zarouali', 'kievit 57', 1, '1695297570');

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

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subjectId`, `subjectName`, `subjectDescription`, `subjectIsActive`) VALUES
('1', 'Math', 'Mathematics subject description', 1),
('4j3O', 'aaaaa', 'assss', 1),
('7uJh', 'ffffffff', 'ffffffffffffffffffffffff', 0),
('CLk9', 'gregre', 'gregre', 0),
('comM', 'gregre', 'gregre', 1),
('DbiT', 'FRONTEND', 'jk', 1),
('g2Ex', 'sss', 'ma', 0),
('KK1N', 'Backend', 'dit is backend', 0),
('KUic', 'FRONTEND', 'Front End Development includes creating a user interface website or application. It involves designing and implementing the visual elements, layout and features that users see and interact with. Front-end developers primarily use HTML, CSS, and JavaScript to structure the content.', 1),
('orXC', 's', 's', 0),
('yYKu', 'FRONTEND4343', '234234', 0);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacherId` varchar(4) NOT NULL,
  `teacherFirstName` varchar(50) NOT NULL,
  `teacherLastName` varchar(50) NOT NULL,
  `teacherAdres` varchar(150) NOT NULL,
  `teacherIsActive` tinyint(1) NOT NULL,
  `teacherCreateDate` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacherId`, `teacherFirstName`, `teacherLastName`, `teacherAdres`, `teacherIsActive`, `teacherCreateDate`) VALUES
('1', '1', '1', '1', 0, '1'),
('8rGF', 's', 's', 's', 0, '1695369510'),
('GiWB', 'aaqq11', 'aa', 'aa', 1, '1695134466'),
('hdhd', 'dddd', 'dddd', 'ddddd', 0, '212'),
('QuNI', 'Mazin', 'Jamil', 'daltonlaan', 1, '1695282209'),
('SUhu', 'aa', 'aa', 'aa', 0, '1695133961'),
('v2Q7', 'Mazinz', 'Jamils', 'hsdjhasd', 0, '1695370734');

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
-- Indexes for table `educations`
--
ALTER TABLE `educations`
  ADD PRIMARY KEY (`educationId`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`gradeId`),
  ADD KEY `gradeStudentId` (`gradeStudentId`);

--
-- Indexes for table `schoolhaseducations`
--
ALTER TABLE `schoolhaseducations`
  ADD PRIMARY KEY (`schoolId`,`educationId`),
  ADD KEY `educationId` (`educationId`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`schoolId`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`studentId`),
  ADD KEY `studentClassId` (`studentClassId`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subjectId`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacherId`);

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
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`gradeStudentId`) REFERENCES `students` (`studentId`) ON UPDATE CASCADE;

--
-- Constraints for table `schoolhaseducations`
--
ALTER TABLE `schoolhaseducations`
  ADD CONSTRAINT `schoolhaseducations_ibfk_1` FOREIGN KEY (`educationId`) REFERENCES `educations` (`educationId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `schoolhaseducations_ibfk_2` FOREIGN KEY (`schoolId`) REFERENCES `schools` (`schoolId`) ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`studentClassId`) REFERENCES `classes` (`classId`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
