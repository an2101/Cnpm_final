

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exam`
--

-- --------------------------------------------------------



-- Tạo bảng `admin`
CREATE TABLE `admin` (
  `si_no` int(25) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY (`si_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- Thêm tài khoản admin với mật khẩu 
INSERT INTO `admin` (`si_no`, `user_id`, `password`) VALUES 
(1, 'admin', 'admin');
-- --------------------------------------------------------


--
CREATE TABLE `time1` (
  `times` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE `time2` (
  `times` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE `time3` (
  `times` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE `code1` (
  `code` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE `code2` (
  `code` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE `code3` (
  `code` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE `q2` (
  `question_no` int(250) NOT NULL,
  `question` varchar(250) NOT NULL,
  `a` varchar(250) NOT NULL,
  `b` varchar(250) NOT NULL,
  `c` varchar(250) NOT NULL,
  `d` varchar(250) NOT NULL,
  `correct_answer` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `q3` (
  `question_no` int(250) NOT NULL,
  `question` varchar(250) NOT NULL,
  `a` varchar(250) NOT NULL,
  `b` varchar(250) NOT NULL,
  `c` varchar(250) NOT NULL,
  `d` varchar(250) NOT NULL,
  `correct_answer` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `q4` (
  `question_no` int(250) NOT NULL,
  `question` varchar(250) NOT NULL,
  `a` varchar(250) NOT NULL,
  `b` varchar(250) NOT NULL,
  `c` varchar(250) NOT NULL,
  `d` varchar(250) NOT NULL,
  `correct_answer` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------



CREATE TABLE `result` (
  `si_no` int(250) NOT NULL,
  `usn` varchar(250) NOT NULL,
  `attempted` varchar(250) NOT NULL,
  `correct_answers` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE `result2` (
  `si_no` int(250) NOT NULL,
  `usn` varchar(250) NOT NULL,
  `attempted` varchar(250) NOT NULL,
  `correct_answers` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE `result3` (
  `si_no` int(250) NOT NULL,
  `usn` varchar(250) NOT NULL,
  `attempted` varchar(250) NOT NULL,
  `correct_answers` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- --------------------------------------------------------



CREATE TABLE `student` (
  `si_no` int(250) NOT NULL,
  `usn` varchar(250) NOT NULL,
  `name` varchar(40) NOT NULL,
  `status` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






ALTER TABLE `q2`
  ADD PRIMARY KEY (`question_no`);

ALTER TABLE `q3`
  ADD PRIMARY KEY (`question_no`);

ALTER TABLE `q4`
  ADD PRIMARY KEY (`question_no`);
--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`si_no`);
ALTER TABLE `result2`
  ADD PRIMARY KEY (`si_no`);
ALTER TABLE `result3`
  ADD PRIMARY KEY (`si_no`);  
--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`si_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `q2`
--
ALTER TABLE `q2`
  MODIFY `question_no` int(250) NOT NULL AUTO_INCREMENT;
ALTER TABLE `q3`
  MODIFY `question_no` int(250) NOT NULL AUTO_INCREMENT;
ALTER TABLE `q4`
  MODIFY `question_no` int(250) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `si_no` int(250) NOT NULL AUTO_INCREMENT;
ALTER TABLE `result2`
  MODIFY `si_no` int(250) NOT NULL AUTO_INCREMENT;
ALTER TABLE `result3`
  MODIFY `si_no` int(250) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `si_no` int(250) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
