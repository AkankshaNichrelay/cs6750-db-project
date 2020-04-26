-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2020 at 09:06 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `musifi`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`wzl7zb`@`%` PROCEDURE `deleteViolatingAlbumArt` (IN `violatingID` INT(64))  NO SQL
UPDATE Album
SET CoverArt = 'https://i.kym-cdn.com/photos/images/facebook/001/250/498/dd3.png'
WHERE AlbumID = violatingID$$

CREATE DEFINER=`wzl7zb`@`%` PROCEDURE `deleteViolatingSong` (IN `violatingID` INT(64))  NO SQL
DELETE Song, ArtistOwnsSong
FROM Song
INNER JOIN ArtistOwnsSong ON Song.SongID = ArtistOwnsSong.SongID
WHERE Song.SongID = violatingID$$

CREATE DEFINER=`wzl7zb`@`%` PROCEDURE `deleteViolatingSongFromPlaylists` (IN `violatingID` INT(64))  NO SQL
DELETE FROM PlaylistContainsSong
WHERE SongID = violatingID$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `AlbumID` int(64) NOT NULL,
  `ArtistID` int(64) NOT NULL,
  `AlbumName` varchar(64) NOT NULL,
  `CoverArt` varchar(128) NOT NULL COMMENT 'Link to image file'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`AlbumID`, `ArtistID`, `AlbumName`, `CoverArt`) VALUES
(1, 1, '1989', 'https://i.kym-cdn.com/photos/images/facebook/001/250/498/dd3.png'),
(1, 3, 'thank you, next', 'https://i.kym-cdn.com/photos/images/facebook/001/250/498/dd3.png'),
(1, 33, 'If You\'re Reading This It\'s Too Late', 'https://i.kym-cdn.com/photos/images/facebook/001/250/498/dd3.png'),
(1, 102, 'Falling into You', 'https://i.kym-cdn.com/photos/images/facebook/001/250/498/dd3.png'),
(2, 1, 'Lover', 'https://upload.wikimedia.org/wikipedia/en/c/cd/Taylor_Swift_-_Lover.png'),
(2, 3, 'My Everything', 'https://upload.wikimedia.org/wikipedia/en/d/d5/Ariana_Grande_My_Everything_2014_album_artwork.png'),
(3, 1, 'Reputation', 'https://upload.wikimedia.org/wikipedia/en/f/f2/Taylor_Swift_-_Reputation.png'),
(3, 3, 'Dangerous Woman', 'https://upload.wikimedia.org/wikipedia/en/4/4b/Ariana_Grande_-_Dangerous_Woman_%28Official_Album_Cover%29.png'),
(4, 1, 'Red', 'https://upload.wikimedia.org/wikipedia/en/e/e8/Taylor_Swift_-_Red.png'),
(4, 3, 'Sweetner', 'https://upload.wikimedia.org/wikipedia/en/7/7a/Sweetener_album_cover.png'),
(5, 1, 'Speak Now', 'https://upload.wikimedia.org/wikipedia/en/8/8f/Taylor_Swift_-_Speak_Now_cover.png'),
(5, 3, 'Yours Truly', 'https://upload.wikimedia.org/wikipedia/en/c/cb/Ariana_Grande_-_Yours_Truly.png'),
(6, 1, 'Taylor Swift', 'https://upload.wikimedia.org/wikipedia/en/1/1f/Taylor_Swift_-_Taylor_Swift.png'),
(7, 1, 'Fearless', 'https://upload.wikimedia.org/wikipedia/en/8/86/Taylor_Swift_-_Fearless.png'),
(8, 103, 'Hybrid Theory', 'https://en.wikipedia.org/wiki/Hybrid_Theory#/media/File:Linkin_Park_Hybrid_Theory_Album_Cover.jpg'),
(10, 105, 'Doob', 'https://en.wikipedia.org/wiki/Doob_(album)#/media/File:Doob.jpg'),
(11, 105, 'Hok Kolorob', 'https://en.wikipedia.org/wiki/Hok_Kolorob#/media/File:Hok_Kolorob_-_Arnab_album_cover.jpg'),
(12, 106, 'Amar Prithibi', 'https://en.wikipedia.org/wiki/Amar_Prithibi#/media/File:4_AmarPrithibi.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE `artist` (
  `ArtistID` int(64) NOT NULL,
  `ArtistName` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`ArtistID`, `ArtistName`) VALUES
(1, 'Taylor Swift'),
(2, 'John Mayer'),
(3, 'Ariana Grande'),
(4, 'Coldplay'),
(5, 'Beyonce'),
(6, 'Rihanna'),
(7, 'Harry Styles'),
(8, 'Lady Gaga'),
(9, 'Billie Eilish'),
(10, 'Lana Del Rey'),
(11, 'Sia'),
(12, 'Miley Cyrus'),
(13, 'Lizzo'),
(14, 'Cardi B'),
(15, 'Selena Gomez'),
(16, 'Lil Nas X'),
(17, 'Jonas Brothers'),
(18, 'Shawn Mendes'),
(19, 'Ed Sheeran'),
(20, 'Dua Lipa'),
(21, 'Khalid'),
(22, 'Katy Perry'),
(23, 'Charlie Puth'),
(24, 'Sam Smith'),
(25, 'Bruno Mars'),
(26, 'Post Malone'),
(27, 'John Legend'),
(28, 'Troye Sivan'),
(29, 'The Weeknd'),
(30, 'The 1975'),
(31, 'Justin Bieber'),
(32, 'Vance Joy'),
(33, 'Drake'),
(34, 'Maroon 5'),
(35, 'Bad Bunny'),
(36, 'Bazzi'),
(37, 'Big Sean'),
(38, 'Jason Derulo'),
(39, 'Jason Mraz'),
(40, 'Gregory Alan Isakov'),
(41, 'Ray LaMontagne'),
(42, 'Kanye West'),
(75, 'Travis Scott'),
(76, 'Luke Bryan'),
(77, 'Kacey Musgrave'),
(78, 'Blake Shelton'),
(79, 'Kenny Rogers'),
(80, 'Bon Iver'),
(81, 'Jack Johnson'),
(82, 'Hobo Johnson'),
(83, 'Panic! At The Disco'),
(84, 'Fall Out Boy'),
(85, 'My Chemical Romance'),
(86, 'Paramore'),
(87, 'The All-American Rejects'),
(88, 'Evanescence'),
(89, 'The Beach Boys'),
(90, 'The Beatles'),
(91, 'Jersey Boys'),
(92, 'Shakira'),
(93, 'Solange'),
(94, 'Erika Badhu'),
(95, 'Childish Gambino'),
(96, 'Hozier'),
(97, 'BTS'),
(98, 'BIGBANG'),
(99, 'Dolly Parton'),
(100, 'Fleetwood Mac'),
(101, 'Frank Sinatra'),
(102, 'Celine Dion'),
(103, 'Linkin Park'),
(105, 'Arnob'),
(106, 'Tahsan');

-- --------------------------------------------------------

--
-- Table structure for table `artistownssong`
--

CREATE TABLE `artistownssong` (
  `ArtistID` int(64) NOT NULL,
  `SongID` int(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artistownssong`
--

INSERT INTO `artistownssong` (`ArtistID`, `SongID`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(102, 14),
(102, 15),
(102, 16),
(102, 17),
(102, 18),
(102, 19),
(102, 20),
(102, 21),
(102, 22),
(102, 23),
(102, 24),
(102, 27),
(102, 28),
(102, 29),
(102, 30),
(103, 31),
(103, 32),
(103, 33),
(103, 34),
(105, 36),
(105, 37),
(105, 38),
(105, 39),
(105, 40),
(105, 41),
(105, 42),
(105, 43),
(105, 44);

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `PlaylistID` int(64) NOT NULL,
  `PlaylistOwnerID` int(64) NOT NULL,
  `PlaylistName` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`PlaylistID`, `PlaylistOwnerID`, `PlaylistName`) VALUES
(1, 2, 'Quarantine Jams'),
(2, 1, 'Running'),
(3, 1, 'Studying'),
(4, 3, 'Karaoke Night'),
(5, 3, 'Roadtrip Sing Along');

-- --------------------------------------------------------

--
-- Table structure for table `playlistcontainsalbum`
--

CREATE TABLE `playlistcontainsalbum` (
  `PlaylistID` int(64) NOT NULL,
  `AlbumID` int(64) NOT NULL,
  `ArtistID` int(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `playlistcontainsalbum`
--

INSERT INTO `playlistcontainsalbum` (`PlaylistID`, `AlbumID`, `ArtistID`) VALUES
(1, 1, 33),
(2, 1, 3),
(2, 3, 1),
(4, 1, 1),
(5, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `playlistcontainssong`
--

CREATE TABLE `playlistcontainssong` (
  `PlaylistID` int(64) NOT NULL,
  `SongID` int(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `playlistcontainssong`
--

INSERT INTO `playlistcontainssong` (`PlaylistID`, `SongID`) VALUES
(1, 5),
(1, 19),
(5, 31),
(5, 33);

-- --------------------------------------------------------

--
-- Table structure for table `song`
--

CREATE TABLE `song` (
  `SongID` int(64) NOT NULL,
  `SongTitle` varchar(64) NOT NULL,
  `genre` varchar(64) NOT NULL,
  `language` varchar(64) NOT NULL,
  `year` int(64) NOT NULL,
  `AlbumID` int(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `song`
--

INSERT INTO `song` (`SongID`, `SongTitle`, `genre`, `language`, `year`, `AlbumID`) VALUES
(1, 'Welcome To New York', 'Pop', 'English', 2014, 1),
(2, 'Blank Space', 'Pop', 'English', 2014, 1),
(3, 'Style', 'Pop', 'English', 2014, 1),
(4, 'Out of the Woods', 'Pop', 'English', 2014, 1),
(5, 'All You Had To Do Was Stay', 'Pop', 'English', 2014, 1),
(6, 'Shake It Off', 'Pop', 'English', 2014, 1),
(7, 'I Wish You Would', 'Pop', 'English', 2014, 1),
(8, 'Bad Blood', 'Pop', 'English', 2014, 1),
(9, 'Wildest Dreams', 'Pop', 'English', 2014, 1),
(10, 'How You Get the Girl', 'Pop', 'English', 2014, 1),
(11, 'This Love', 'Pop', 'English', 2014, 1),
(12, 'I Know Places', 'Pop', 'English', 2014, 1),
(13, 'Clean', 'Pop', 'English', 2014, 1),
(14, 'It\'s All Coming Back to Me Now', 'Pop', 'English', 1996, 1),
(15, 'Because You Loved Me (Theme from \"Up Close and Personal\")', 'Pop', 'English', 1996, 1),
(16, 'Falling Into You', 'Pop', 'English', 1996, 1),
(17, 'Make You Happy', 'Pop', 'English', 1996, 1),
(18, 'Seduces Me', 'Pop', 'English', 1996, 1),
(19, 'All By Myself', 'Pop', 'English', 1996, 1),
(20, 'Declaration Of Love', 'Pop', 'English', 1996, 1),
(21, 'It\'s All Coming Back to Me Now', 'Pop', 'English', 1996, 1),
(22, '(You Make Me Feel Like) A Natural Woman', 'Pop', 'English', 1996, 1),
(23, 'Dreamin\' of You', 'Pop', 'English', 1996, 1),
(24, 'I Love You', 'Pop', 'English', 1996, 1),
(27, 'River Deep, Mountain High', 'Pop', 'English', 1996, 2),
(28, 'Your Light', 'Pop', 'English', 1996, 1),
(29, 'Call the Man', 'Pop', 'English', 1996, 1),
(30, 'Fly', 'Pop', 'English', 1996, 1),
(31, 'In the End', 'Rock', 'English', 2000, 8),
(32, 'One Step Closer', 'Rock', 'English', 2000, 8),
(33, 'Crawling', 'Rock', 'English', 2000, 8),
(34, 'Paper Cut', 'Rock', 'English', 2000, 8),
(36, 'Dhushor Megh', 'Rock', 'Bangla', 2008, 10),
(37, 'Adhkana', 'Folk', 'Bangla', 2008, 10),
(38, 'Shopno Debe Doob', 'Rock', 'Bangla', 2008, 10),
(39, 'Tomar Jonyo', 'Folk', 'Bangla', 2006, 11),
(40, 'Hok Kolorob', 'Folk', 'Bangla', 2006, 11),
(41, 'Bhalobasha Tar Por', 'Folk', 'Bangla', 2006, 11),
(42, 'Tui Ki Janisna 1', 'Folk', 'Bangla', 2006, 11),
(43, 'Bakshe Bakshe', 'Folk', 'Bangla', 2006, 11),
(44, 'Prarthonad', 'Rock', 'Bangla', 2002, 12);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(64) NOT NULL,
  `Username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `Username`, `password`, `email`) VALUES
(1, 'Emily Camacho', 'LongPasswordIsHard2Guess', 'ec8ukf@virginia.edu'),
(2, 'John Smith', 'GenPasswordsReZ', 'johnsmith@gmail.com'),
(3, 'Jane Doe', 'ShortPasswordIsEZ', 'janedoe@gmail.com'),
(4, 'Farzana Siddique', 'passpass', 'fas9nw@virginia.edu'),
(5, 'Slim Jim', 'abcd', 'slim@jim.com');

-- --------------------------------------------------------

--
-- Table structure for table `userfollowsartist`
--

CREATE TABLE `userfollowsartist` (
  `UserID` int(64) NOT NULL,
  `ArtistID` int(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userfollowsartist`
--

INSERT INTO `userfollowsartist` (`UserID`, `ArtistID`) VALUES
(1, 1),
(1, 2),
(1, 7),
(1, 12),
(1, 15),
(1, 35),
(1, 40),
(1, 41),
(1, 80),
(1, 81),
(2, 3),
(2, 4),
(2, 5),
(2, 9),
(2, 11),
(2, 12),
(2, 14),
(2, 19),
(2, 20),
(3, 5),
(3, 19),
(3, 25),
(3, 29),
(3, 30),
(3, 83),
(3, 92),
(3, 101);

-- --------------------------------------------------------

--
-- Table structure for table `userfollowsplaylist`
--

CREATE TABLE `userfollowsplaylist` (
  `UserID` int(64) NOT NULL,
  `PlaylistID` int(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userfollowsplaylist`
--

INSERT INTO `userfollowsplaylist` (`UserID`, `PlaylistID`) VALUES
(1, 1),
(2, 2),
(2, 4),
(3, 1),
(5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `userfollowsuser`
--

CREATE TABLE `userfollowsuser` (
  `UserID1` int(64) NOT NULL,
  `UserID2` int(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userfollowsuser`
--

INSERT INTO `userfollowsuser` (`UserID1`, `UserID2`) VALUES
(1, 3),
(2, 1),
(2, 5),
(3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `userownsplaylist`
--

CREATE TABLE `userownsplaylist` (
  `UserID` int(64) NOT NULL,
  `PlaylistID` int(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userownsplaylist`
--

INSERT INTO `userownsplaylist` (`UserID`, `PlaylistID`) VALUES
(2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`AlbumID`,`ArtistID`);

--
-- Indexes for table `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`ArtistID`),
  ADD UNIQUE KEY `ArtistID` (`ArtistID`);

--
-- Indexes for table `artistownssong`
--
ALTER TABLE `artistownssong`
  ADD PRIMARY KEY (`ArtistID`,`SongID`),
  ADD KEY `ArtistOwnsSong_ibfk_2` (`SongID`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`PlaylistID`),
  ADD UNIQUE KEY `PlaylistID` (`PlaylistID`);

--
-- Indexes for table `playlistcontainsalbum`
--
ALTER TABLE `playlistcontainsalbum`
  ADD PRIMARY KEY (`PlaylistID`,`AlbumID`,`ArtistID`);

--
-- Indexes for table `playlistcontainssong`
--
ALTER TABLE `playlistcontainssong`
  ADD PRIMARY KEY (`PlaylistID`,`SongID`);

--
-- Indexes for table `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`SongID`),
  ADD UNIQUE KEY `SongID` (`SongID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `UserID` (`UserID`);

--
-- Indexes for table `userfollowsartist`
--
ALTER TABLE `userfollowsartist`
  ADD PRIMARY KEY (`UserID`,`ArtistID`);

--
-- Indexes for table `userfollowsplaylist`
--
ALTER TABLE `userfollowsplaylist`
  ADD PRIMARY KEY (`UserID`,`PlaylistID`);

--
-- Indexes for table `userfollowsuser`
--
ALTER TABLE `userfollowsuser`
  ADD PRIMARY KEY (`UserID1`,`UserID2`);

--
-- Indexes for table `userownsplaylist`
--
ALTER TABLE `userownsplaylist`
  ADD PRIMARY KEY (`UserID`,`PlaylistID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `AlbumID` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `artist`
--
ALTER TABLE `artist`
  MODIFY `ArtistID` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `PlaylistID` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `song`
--
ALTER TABLE `song`
  MODIFY `SongID` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artistownssong`
--
ALTER TABLE `artistownssong`
  ADD CONSTRAINT `ArtistOwnsSong_ibfk_1` FOREIGN KEY (`ArtistID`) REFERENCES `artist` (`ArtistID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ArtistOwnsSong_ibfk_2` FOREIGN KEY (`SongID`) REFERENCES `song` (`SongID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
