-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql207.byetcluster.com
-- Generation Time: Dec 03, 2024 at 12:43 PM
-- Server version: 10.6.19-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cpfr_35824691_phase3`
--

-- --------------------------------------------------------

--
-- Table structure for table `Building`
--

CREATE TABLE `Building` (
  `Building_ID` int(11) NOT NULL,
  `Building_Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Building`
--

INSERT INTO `Building` (`Building_ID`, `Building_Name`) VALUES
(1, 'Main Building'),
(2, 'Library'),
(3, 'Science Block'),
(4, 'Admin Block'),
(5, 'naka'),
(7, 'student center'),
(10, 'Engineering Building'),
(11, 'Health Services'),
(18, 'middlebush'),
(19, '.memorial Union'),
(20, 'Switzer Hall');

-- --------------------------------------------------------

--
-- Table structure for table `Claim`
--

CREATE TABLE `Claim` (
  `Claim_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Item_ID` int(11) NOT NULL,
  `Date_Claimed` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Claim`
--

INSERT INTO `Claim` (`Claim_ID`, `User_ID`, `Item_ID`, `Date_Claimed`) VALUES
(1, 1, 2, '2024-02-01'),
(2, 3, 3, '2024-02-02'),
(16, 30, 8, '2024-11-29'),
(17, 31, 8, '2024-11-29'),
(18, 32, 8, '2024-11-29'),
(19, 33, 8, '2024-11-29'),
(44, 81, 21, '2024-12-01');

-- --------------------------------------------------------

--
-- Table structure for table `Found_Item`
--

CREATE TABLE `Found_Item` (
  `Item_ID` int(11) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Date_Found` date NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Location_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Found_Item`
--

INSERT INTO `Found_Item` (`Item_ID`, `Description`, `Date_Found`, `User_ID`, `Location_ID`) VALUES
(4, 'laptop', '2024-11-22', 6, 9),
(21, 'Keybord', '2024-11-28', 78, 22),
(23, 'pizza', '2024-12-02', 83, 24),
(24, 'Jacket', '2024-12-03', 84, 25),
(25, 'firewall', '2024-12-03', 85, 26);

-- --------------------------------------------------------

--
-- Table structure for table `Location`
--

CREATE TABLE `Location` (
  `Location_ID` int(11) NOT NULL,
  `Building_ID` int(11) NOT NULL,
  `Room_Number` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Location`
--

INSERT INTO `Location` (`Location_ID`, `Building_ID`, `Room_Number`) VALUES
(1, 1, '101'),
(2, 1, '102'),
(3, 2, 'L1'),
(4, 2, 'L2'),
(5, 3, 'S101'),
(6, 3, 'S102'),
(7, 4, 'A1'),
(8, 4, 'A2'),
(9, 5, '316'),
(11, 7, '121'),
(22, 5, '112'),
(23, 7, '9'),
(24, 18, '123'),
(25, 19, '203 B'),
(26, 20, '101');

-- --------------------------------------------------------

--
-- Table structure for table `Lost_Item`
--

CREATE TABLE `Lost_Item` (
  `Item_ID` int(11) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Date_Lost` date NOT NULL,
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Lost_Item`
--

INSERT INTO `Lost_Item` (`Item_ID`, `Description`, `Date_Lost`, `User_ID`) VALUES
(1, 'Blue Backpack', '2024-01-15', 1),
(2, 'iPhone 13', '2024-01-16', 2),
(3, 'Calculator', '2024-01-17', 3),
(4, 'phone', '2024-11-21', 7),
(5, 'Phone', '2024-11-21', 8),
(6, 'jet', '2024-11-05', 9),
(8, 'Shirt', '2024-11-25', 12),
(20, 'Yatch', '2024-11-07', 80),
(21, 'Tablet', '2024-11-07', 81),
(22, 'Ball', '2024-11-15', 82);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `User_ID` int(11) NOT NULL,
  `First_Name` varchar(50) NOT NULL,
  `Last_Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`User_ID`, `First_Name`, `Last_Name`) VALUES
(1, 'John', 'Doe'),
(2, 'Jane', 'Smith'),
(3, 'Bob', 'Johnson'),
(6, 'krishna', 'karra'),
(7, 'sam', 'santhi'),
(8, 'Issac', 'R'),
(9, 'ben', 'ten'),
(12, 'Suyog', 'Pawar'),
(13, 'Krishna', 'Ruthwik'),
(78, 'James', 'Kartn'),
(79, 'Jordan', 'Rode'),
(80, 'Derick', 'Dane'),
(81, 'Kris', ''),
(82, 'Rohit', 'M'),
(83, 'jhon', 'cena'),
(84, 'Suyog.', 'Pawar'),
(85, 'Tyler', 'Graber');

-- --------------------------------------------------------

--
-- Table structure for table `User_Contact`
--

CREATE TABLE `User_Contact` (
  `Contact_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Contact_Info` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `User_Contact`
--

INSERT INTO `User_Contact` (`Contact_ID`, `User_ID`, `Contact_Info`) VALUES
(1, 1, 'john.doe@email.com'),
(2, 2, 'jane.smith@email.com'),
(3, 3, 'bob.johnson@email.com'),
(73, 78, 'Jam@gmail.com'),
(74, 79, 'Jordon@gmail.com'),
(75, 80, 'Drer@gmail.com'),
(76, 81, 'K@k.com'),
(77, 82, 'Rohi@hm.in'),
(78, 83, 'jhon@j.com'),
(79, 84, '573 530 2807'),
(80, 85, 'email');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Building`
--
ALTER TABLE `Building`
  ADD PRIMARY KEY (`Building_ID`);

--
-- Indexes for table `Claim`
--
ALTER TABLE `Claim`
  ADD PRIMARY KEY (`Claim_ID`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `Item_ID` (`Item_ID`);

--
-- Indexes for table `Found_Item`
--
ALTER TABLE `Found_Item`
  ADD PRIMARY KEY (`Item_ID`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `Location_ID` (`Location_ID`);

--
-- Indexes for table `Location`
--
ALTER TABLE `Location`
  ADD PRIMARY KEY (`Location_ID`),
  ADD KEY `Building_ID` (`Building_ID`);

--
-- Indexes for table `Lost_Item`
--
ALTER TABLE `Lost_Item`
  ADD PRIMARY KEY (`Item_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`User_ID`);

--
-- Indexes for table `User_Contact`
--
ALTER TABLE `User_Contact`
  ADD PRIMARY KEY (`Contact_ID`),
  ADD UNIQUE KEY `User_ID` (`User_ID`,`Contact_Info`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Building`
--
ALTER TABLE `Building`
  MODIFY `Building_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `Claim`
--
ALTER TABLE `Claim`
  MODIFY `Claim_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `Found_Item`
--
ALTER TABLE `Found_Item`
  MODIFY `Item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `Location`
--
ALTER TABLE `Location`
  MODIFY `Location_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `Lost_Item`
--
ALTER TABLE `Lost_Item`
  MODIFY `Item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `User_Contact`
--
ALTER TABLE `User_Contact`
  MODIFY `Contact_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Claim`
--
ALTER TABLE `Claim`
  ADD CONSTRAINT `Claim_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `User` (`User_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `Claim_ibfk_2` FOREIGN KEY (`Item_ID`) REFERENCES `Lost_Item` (`Item_ID`) ON DELETE CASCADE;

--
-- Constraints for table `Found_Item`
--
ALTER TABLE `Found_Item`
  ADD CONSTRAINT `Found_Item_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `User` (`User_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `Found_Item_ibfk_2` FOREIGN KEY (`Location_ID`) REFERENCES `Location` (`Location_ID`) ON DELETE CASCADE;

--
-- Constraints for table `Location`
--
ALTER TABLE `Location`
  ADD CONSTRAINT `Location_ibfk_1` FOREIGN KEY (`Building_ID`) REFERENCES `Building` (`Building_ID`) ON DELETE CASCADE;

--
-- Constraints for table `Lost_Item`
--
ALTER TABLE `Lost_Item`
  ADD CONSTRAINT `Lost_Item_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `User` (`User_ID`) ON DELETE CASCADE;

--
-- Constraints for table `User_Contact`
--
ALTER TABLE `User_Contact`
  ADD CONSTRAINT `User_Contact_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `User` (`User_ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
