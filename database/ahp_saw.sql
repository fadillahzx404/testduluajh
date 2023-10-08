-- Adminer 4.8.1 MySQL 8.0.30 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `ahp_saw` /*!40100 DEFAULT CHARACTER SET latin1 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ahp_saw`;

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `tb_alternatif`;
CREATE TABLE `tb_alternatif` (
  `kode_alternatif` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_alternatif` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `keterangan` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `total` double DEFAULT NULL,
  `rank` int DEFAULT NULL,
  PRIMARY KEY (`kode_alternatif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tb_alternatif` (`kode_alternatif`, `nama_alternatif`, `keterangan`, `total`, `rank`) VALUES
('A01',	'Fauzi Ahmad, S.Pd',	'Guru Matematika',	0.92157587004016,	10),
('A02',	'Neneng Sukaesih, S. Pd',	'Guru Produktif Perkantoran',	0.96306990045512,	4),
('A03',	'Ayu Ningsih Eka Putri, S. Pd',	'Guru Bahasa Inggris',	0.92422095092001,	8),
('A04',	'Adam Syahputra, S.Kom M.Kom',	'Guru Produktif Multimedia',	0.9731197247457,	2),
('A05',	'Tiar Trisnawati, S. Pd',	'Guru Seni Budaya',	0.94872355768855,	5),
('A06',	'Erwan Sumiyanto, S. Pd',	'Guru Bahasa Inggris\r\n',	0.93781433701239,	6),
('A07',	'Widiono Susanto, S. Kom',	'Guru Produktif Multimedia',	0.98655986237285,	1),
('A08',	'Indri Puspita, S. Pd, MM',	'Guru Produktif Akutansi',	0.92422095092001,	9),
('A09',	'Ulfa Maylinda Sari, A. Md',	'Guru Produktif Multimedia',	0.96988868476316,	3),
('A10',	'Dra.Nurmailis',	'Guru Bahasa Indonesia',	0.93027828191081,	7),
('A11',	'Drs.Mukmin',	'Guru Agama Islam',	0.87144940916027,	13),
('A12',	'Drs.Hasan Muntasier, MM',	'Guru Produktif Perkantoran',	0.8592876294499,	15),
('A13',	'H.Said Khudri S. Ag',	'Guru Agama Islam',	0.86017575992423,	14),
('A14',	'Herta Silalahi, S. Pd',	'Guru Produktif Perkantoran',	0.88450194557566,	12),
('A15',	'Samuji.SE.MM',	'Guru Produktif Perkantoran',	0.91195273149825,	11)
ON DUPLICATE KEY UPDATE `kode_alternatif` = VALUES(`kode_alternatif`), `nama_alternatif` = VALUES(`nama_alternatif`), `keterangan` = VALUES(`keterangan`), `total` = VALUES(`total`), `rank` = VALUES(`rank`);

DROP TABLE IF EXISTS `tb_kriteria`;
CREATE TABLE `tb_kriteria` (
  `kode_kriteria` varchar(16) NOT NULL,
  `nama_kriteria` varchar(256) NOT NULL,
  `atribut` varchar(256) NOT NULL DEFAULT 'benefit',
  PRIMARY KEY (`kode_kriteria`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `tb_kriteria` (`kode_kriteria`, `nama_kriteria`, `atribut`) VALUES
('C04',	'Kecakapan Profesional',	'benefit'),
('C03',	'Kecakapan Sosial',	'benefit'),
('C02',	'Kecakapan Pribadi',	'benefit'),
('C01',	'Kecakapan Pedagogik',	'benefit')
ON DUPLICATE KEY UPDATE `kode_kriteria` = VALUES(`kode_kriteria`), `nama_kriteria` = VALUES(`nama_kriteria`), `atribut` = VALUES(`atribut`);

DROP TABLE IF EXISTS `tb_kuisioner`;
CREATE TABLE `tb_kuisioner` (
  `kode_kuisioner` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kode_guru` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kode_kriteria` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nilai_kriteria` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`kode_kuisioner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tb_kuisioner` (`kode_kuisioner`, `nama`, `kode_guru`, `kode_kriteria`, `nilai_kriteria`) VALUES
(457,	'bilal',	'A01',	'C01',	'80'),
(458,	'bilal',	'A01',	'C02',	'83'),
(459,	'bilal',	'A01',	'C03',	'80'),
(460,	'bilal',	'A01',	'C04',	'82'),
(461,	'bilal',	'A02',	'C01',	'76'),
(462,	'bilal',	'A02',	'C02',	'89'),
(463,	'bilal',	'A02',	'C03',	'86'),
(464,	'bilal',	'A02',	'C04',	'89'),
(465,	'bilal',	'A03',	'C01',	'82'),
(466,	'bilal',	'A03',	'C02',	'79'),
(467,	'bilal',	'A03',	'C03',	'80'),
(468,	'bilal',	'A03',	'C04',	'82'),
(469,	'bilal',	'A04',	'C01',	'87'),
(470,	'bilal',	'A04',	'C02',	'85'),
(471,	'bilal',	'A04',	'C03',	'87'),
(472,	'bilal',	'A04',	'C04',	'85'),
(473,	'bilal',	'A05',	'C01',	'84'),
(474,	'bilal',	'A05',	'C02',	'80'),
(475,	'bilal',	'A05',	'C03',	'84'),
(476,	'bilal',	'A05',	'C04',	'84'),
(477,	'bilal',	'A06',	'C01',	'79'),
(478,	'bilal',	'A06',	'C02',	'78'),
(479,	'bilal',	'A06',	'C03',	'85'),
(480,	'bilal',	'A06',	'C04',	'85'),
(481,	'bilal',	'A07',	'C01',	'87'),
(482,	'bilal',	'A07',	'C02',	'87'),
(483,	'bilal',	'A07',	'C03',	'87'),
(484,	'bilal',	'A07',	'C04',	'87'),
(485,	'bilal',	'A08',	'C01',	'82'),
(486,	'bilal',	'A08',	'C02',	'79'),
(487,	'bilal',	'A08',	'C03',	'80'),
(488,	'bilal',	'A08',	'C04',	'82'),
(489,	'bilal',	'A09',	'C01',	'86'),
(490,	'bilal',	'A09',	'C02',	'85'),
(491,	'bilal',	'A09',	'C03',	'87'),
(492,	'bilal',	'A09',	'C04',	'85'),
(493,	'bilal',	'A10',	'C01',	'87'),
(494,	'bilal',	'A10',	'C02',	'88'),
(495,	'bilal',	'A10',	'C03',	'79'),
(496,	'bilal',	'A10',	'C04',	'79'),
(497,	'bilal',	'A11',	'C01',	'80'),
(498,	'bilal',	'A11',	'C02',	'74'),
(499,	'bilal',	'A11',	'C03',	'75'),
(500,	'bilal',	'A11',	'C04',	'76'),
(501,	'bilal',	'A12',	'C01',	'77'),
(502,	'bilal',	'A12',	'C02',	'76'),
(503,	'bilal',	'A12',	'C03',	'76'),
(504,	'bilal',	'A12',	'C04',	'75'),
(505,	'bilal',	'A13',	'C01',	'78'),
(506,	'bilal',	'A13',	'C02',	'75'),
(507,	'bilal',	'A13',	'C03',	'75'),
(508,	'bilal',	'A13',	'C04',	'75'),
(509,	'bilal',	'A14',	'C01',	'78'),
(510,	'bilal',	'A14',	'C02',	'78'),
(511,	'bilal',	'A14',	'C03',	'78'),
(512,	'bilal',	'A14',	'C04',	'78'),
(513,	'bilal',	'A15',	'C01',	'80'),
(514,	'bilal',	'A15',	'C02',	'85'),
(515,	'bilal',	'A15',	'C03',	'80'),
(516,	'bilal',	'A15',	'C04',	'80')
ON DUPLICATE KEY UPDATE `kode_kuisioner` = VALUES(`kode_kuisioner`), `nama` = VALUES(`nama`), `kode_guru` = VALUES(`kode_guru`), `kode_kriteria` = VALUES(`kode_kriteria`), `nilai_kriteria` = VALUES(`nilai_kriteria`);

DROP TABLE IF EXISTS `tb_rel_alternatif`;
CREATE TABLE `tb_rel_alternatif` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `kode_alternatif` varchar(16) DEFAULT NULL,
  `kode_kriteria` varchar(16) DEFAULT NULL,
  `nilai` double DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `tb_rel_alternatif` (`ID`, `kode_alternatif`, `kode_kriteria`, `nilai`) VALUES
(23,	'A02',	'C04',	89),
(22,	'A02',	'C03',	86),
(21,	'A02',	'C02',	89),
(20,	'A02',	'C01',	76),
(26,	'A03',	'C03',	80),
(25,	'A03',	'C02',	79),
(24,	'A03',	'C01',	82),
(19,	'A01',	'C04',	82),
(18,	'A01',	'C03',	80),
(17,	'A01',	'C02',	83),
(16,	'A01',	'C01',	80),
(27,	'A03',	'C04',	82),
(28,	'A04',	'C01',	87),
(29,	'A04',	'C02',	85),
(30,	'A04',	'C03',	87),
(31,	'A04',	'C04',	85),
(32,	'A05',	'C01',	84),
(33,	'A05',	'C02',	80),
(34,	'A05',	'C03',	84),
(35,	'A05',	'C04',	84),
(36,	'A06',	'C01',	79),
(37,	'A06',	'C02',	78),
(38,	'A06',	'C03',	85),
(39,	'A06',	'C04',	85),
(47,	'A07',	'C04',	87),
(46,	'A07',	'C03',	87),
(45,	'A07',	'C02',	87),
(44,	'A07',	'C01',	87),
(48,	'A08',	'C01',	82),
(49,	'A08',	'C02',	79),
(50,	'A08',	'C03',	80),
(51,	'A08',	'C04',	82),
(52,	'A09',	'C01',	86),
(53,	'A09',	'C02',	85),
(54,	'A09',	'C03',	87),
(55,	'A09',	'C04',	85),
(56,	'A10',	'C01',	87),
(57,	'A10',	'C02',	88),
(58,	'A10',	'C03',	79),
(59,	'A10',	'C04',	79),
(60,	'A11',	'C01',	80),
(61,	'A11',	'C02',	74),
(62,	'A11',	'C03',	75),
(63,	'A11',	'C04',	76),
(64,	'A12',	'C01',	77),
(65,	'A12',	'C02',	76),
(66,	'A12',	'C03',	76),
(67,	'A12',	'C04',	75),
(68,	'A13',	'C01',	78),
(69,	'A13',	'C02',	75),
(70,	'A13',	'C03',	75),
(71,	'A13',	'C04',	75),
(72,	'A14',	'C01',	78),
(73,	'A14',	'C02',	78),
(74,	'A14',	'C03',	78),
(75,	'A14',	'C04',	78),
(76,	'A15',	'C01',	80),
(77,	'A15',	'C02',	85),
(78,	'A15',	'C03',	80),
(79,	'A15',	'C04',	80)
ON DUPLICATE KEY UPDATE `ID` = VALUES(`ID`), `kode_alternatif` = VALUES(`kode_alternatif`), `kode_kriteria` = VALUES(`kode_kriteria`), `nilai` = VALUES(`nilai`);

DROP TABLE IF EXISTS `tb_rel_kriteria`;
CREATE TABLE `tb_rel_kriteria` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `ID1` varchar(16) DEFAULT NULL,
  `ID2` varchar(16) DEFAULT NULL,
  `nilai` double DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `tb_rel_kriteria` (`ID`, `ID1`, `ID2`, `nilai`) VALUES
(2,	'C03',	'C01',	0.333333333),
(3,	'C03',	'C04',	0.2),
(4,	'C01',	'C03',	3),
(5,	'C01',	'C04',	0.5),
(6,	'C02',	'C04',	0.2),
(7,	'C03',	'C03',	1),
(8,	'C02',	'C03',	0.5),
(9,	'C03',	'C02',	2),
(10,	'C02',	'C02',	1),
(11,	'C01',	'C02',	3),
(12,	'C01',	'C01',	1),
(13,	'C02',	'C01',	0.333333333),
(14,	'C04',	'C04',	1),
(15,	'C04',	'C03',	5),
(16,	'C04',	'C02',	5),
(17,	'C04',	'C01',	2)
ON DUPLICATE KEY UPDATE `ID` = VALUES(`ID`), `ID1` = VALUES(`ID1`), `ID2` = VALUES(`ID2`), `nilai` = VALUES(`nilai`);

DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user` (
  `kode_user` varchar(16) DEFAULT NULL,
  `nama_user` varchar(255) DEFAULT NULL,
  `user` varchar(16) DEFAULT NULL,
  `pass` varchar(16) DEFAULT NULL,
  `level` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tb_user` (`kode_user`, `nama_user`, `user`, `pass`, `level`) VALUES
('U001',	'Administrator',	'admin',	'admin',	'admin'),
('U002',	'User',	'user',	'user',	'user')
ON DUPLICATE KEY UPDATE `kode_user` = VALUES(`kode_user`), `nama_user` = VALUES(`nama_user`), `user` = VALUES(`user`), `pass` = VALUES(`pass`), `level` = VALUES(`level`);

-- 2023-09-25 11:42:44
