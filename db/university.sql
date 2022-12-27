-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1
-- Χρόνος δημιουργίας: 16 Ιουν 2022 στις 10:23:04
-- Έκδοση διακομιστή: 10.4.21-MariaDB
-- Έκδοση PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `university`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `lessons`
--

CREATE TABLE `lessons` (
  `lesson_id` int(11) NOT NULL,
  `lesson_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `lessons`
--

INSERT INTO `lessons` (`lesson_id`, `lesson_name`) VALUES
(3, 'pliroforiki'),
(4, 'mathimatika'),
(6, 'gewmetria'),
(7, 'fusikh'),
(9, 'diktua');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `professor_lesson`
--

CREATE TABLE `professor_lesson` (
  `id` int(11) NOT NULL,
  `professor_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `professor_lesson`
--

INSERT INTO `professor_lesson` (`id`, `professor_id`, `lesson_id`) VALUES
(1, 4, 3),
(4, 4, 4);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `student_email` varchar(100) NOT NULL,
  `student_password` varchar(100) NOT NULL,
  `student_permission` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `students`
--

INSERT INTO `students` (`student_id`, `student_name`, `student_email`, `student_password`, `student_permission`) VALUES
(1, 'student1', 'student1@gmail.com', '202cb962ac59075b964b07152d234b70', 'Student'),
(2, 'student23', 'student2@gmail.com', '202cb962ac59075b964b07152d234b70', 'Student'),
(5, 'student3', 'student3@gmail.com', '202cb962ac59075b964b07152d234b70', 'Student');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `student_lesson`
--

CREATE TABLE `student_lesson` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `student_lesson`
--

INSERT INTO `student_lesson` (`id`, `student_id`, `lesson_id`) VALUES
(1, 1, 4),
(2, 1, 3),
(3, 2, 4),
(4, 1, 6),
(5, 3, 3);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `permission` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `permission`) VALUES
(4, 'professor1', 'professor1@gmail.com', '202cb962ac59075b964b07152d234b70', 'Professor'),
(5, 'professor2', 'professor2@gmail.com', '202cb962ac59075b964b07152d234b70', 'Professor'),
(7, 'admin', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', 'Admin'),
(8, 'admin2', 'admin2@gmail.com', '202cb962ac59075b964b07152d234b70', 'Admin'),
(14, 'professor3', 'professor3@gmail.com', '202cb962ac59075b964b07152d234b70', 'Professor');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`lesson_id`);

--
-- Ευρετήρια για πίνακα `professor_lesson`
--
ALTER TABLE `professor_lesson`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Ευρετήρια για πίνακα `student_lesson`
--
ALTER TABLE `student_lesson`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `lessons`
--
ALTER TABLE `lessons`
  MODIFY `lesson_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT για πίνακα `professor_lesson`
--
ALTER TABLE `professor_lesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT για πίνακα `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT για πίνακα `student_lesson`
--
ALTER TABLE `student_lesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
