SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
CREATE DATABASE IF NOT EXISTS `orangetutor` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `orangetutor`;

CREATE TABLE `appointment` (
  `appointment_id` bigint(20) UNSIGNED NOT NULL,
  `appointment_starttime` datetime DEFAULT NULL,
  `appointment_endtime` datetime DEFAULT NULL,
  `tutor_user_id` mediumint(8) UNSIGNED DEFAULT NULL,
  `student_user_id` mediumint(8) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `group` (
  `group_id` int(10) UNSIGNED NOT NULL,
  `group_name` varchar(64) NOT NULL DEFAULT 'Unnamed Group'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `group` VALUES
(1, 'Administrators'),
(2, 'Tutors'),
(3, 'Students'),
(4, 'Parents');

CREATE TABLE `membership` (
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `membership_validfrom` datetime DEFAULT NULL,
  `membership_expiration` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `parent` (
  `parent_user_id` mediumint(9) NOT NULL,
  `child_user_id` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tutor_subject` (
  `tutor_subject_code` char(3) NOT NULL,
  `tutor_subject_name` varchar(34) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tutor_subject` VALUES
('AAA', 'Asian/Asian American Studies'),
('AAS', 'African American Studies'),
('ACC', 'Accounting'),
('ADV', 'Advertising'),
('AED', 'Art Education'),
('AEE', 'Aerospace Engineering'),
('AJP', 'Arts Journalism Program'),
('ALP', 'Arts Leadership Program'),
('AMC', 'Applied Music Classes'),
('ANT', 'Anthropology'),
('APH', 'Art Photography'),
('APM', 'Applied Mathematics'),
('ARB', 'Arabic'),
('ARC', 'Architecture'),
('ART', 'Art History'),
('ASC', 'Aerospace Studies'),
('ASL', 'American Sign Language'),
('AST', 'Astronomy'),
('BCM', 'Biochemistry'),
('BDJ', 'Broadcast and Digital Journali'),
('BEN', 'Bioengineering'),
('BIO', 'Biology'),
('BPE', 'Bioprocess Engineering'),
('BPS', 'Bachelor of Prof. Studies'),
('BSN', 'Bassoon Instruction'),
('BTB', 'Tuba Instruction'),
('BTC', 'Biotechnology'),
('BUA', 'Business Administration'),
('CAR', 'Computer Art'),
('CAS', 'College/Arts/Sci'),
('CCR', 'Composition & Cultural Rhetori'),
('CEN', 'Chemical Engineering'),
('CER', 'Ceramics'),
('CFE', 'Cultural Foundations/Education'),
('CFS', 'Child & Family Studies'),
('CHE', 'Chemistry'),
('CHI', 'Chinese'),
('CIE', 'Civil Engineering'),
('CIS', 'Computer & Info Science'),
('CLR', 'Clarinet Instruction'),
('CLS', 'College Learning Strategies'),
('CMD', 'Communication Design'),
('CME', 'Construction Mgmt &Engineering'),
('COM', 'Communications'),
('COU', 'Counseling'),
('CPS', 'Computational Science'),
('CRL', 'Creative Leadership'),
('CRS', 'Communication and Rhet Studies'),
('CSD', 'Communication Sci & Disorders'),
('CSE', 'Computer Engineering'),
('CTG', 'Conducting'),
('DBS', 'Double Bass Instruction'),
('DES', 'Design'),
('DFH', 'Documentary Film and History'),
('DRA', 'Drama'),
('DRD', 'Drama Design/Tech'),
('DRM', 'Drama Management'),
('DRS', 'Drumset'),
('DRW', 'Drawing'),
('DSP', 'Disability Studies Program'),
('DTS', 'Dance Technique Studio'),
('EAR', 'Earth Sciences'),
('ECN', 'Economics'),
('ECS', 'Engineering & Computer Science'),
('EDA', 'Educational Admin'),
('EDI', 'Environmental Design'),
('EDU', 'Education'),
('EED', 'Elementary Education'),
('EEE', 'Entrprnrshp & Emrging Entrprss'),
('EFB', 'Environmental & Forest Biology'),
('EHS', 'Environmental Health'),
('ELE', 'Electrical Engineering'),
('ELL', 'English Language Learners'),
('ENC', 'Chamber Music'),
('ENG', 'English'),
('ENI', 'Instrumental Ensembles'),
('ENL', 'English as a Second Language'),
('ENS', 'Environmental Science'),
('ENV', 'Vocal Ensembles'),
('ERE', 'Environmental & Resource Engr'),
('ESF', 'Environmental Science & Fsty'),
('EST', 'Environmental Studies'),
('ETS', 'English Textual Studies'),
('EUP', 'Euphonium Instruction'),
('EWP', 'Environmental Writing Program'),
('FAS', 'Fashion Design'),
('FCH', 'Forest Chemistry'),
('FHN', 'French Horn Instruction'),
('FIL', 'Film'),
('FIN', 'Finance'),
('FLL', 'Langs, Literatres & Linguistcs'),
('FLT', 'Flute Instruction'),
('FND', 'Foundation Program'),
('FOR', 'Forest Resources Management'),
('FRE', 'French'),
('FSC', 'Forensic Science'),
('FST', 'Food Studies'),
('GEO', 'Geography'),
('GER', 'German'),
('GET', 'Global Enterprise Technology'),
('GNE', 'General Engineering'),
('GRA', 'Graphic Arts'),
('GRD', 'Graduate School'),
('GRE', 'Greek'),
('GTR', 'Guitar Instruction'),
('HEA', 'Health Rec & Phys Ed'),
('HEB', 'Hebrew'),
('HED', 'Higher Education'),
('HIN', 'Hindi'),
('HNR', 'University Honors Program'),
('HOA', 'History of Art'),
('HOM', 'History of Music'),
('HPD', 'Harpsichord Instruction'),
('HRP', 'Harp Instruction'),
('HST', 'History'),
('HTW', 'Health and Wellness'),
('HUM', 'Humanities'),
('ICC', 'Interactive Communication Core'),
('IDE', 'Instrc Dsgn, Dvlpmnt & Evaltn'),
('IDS', 'Information Design, Technology'),
('ILL', 'Illustration'),
('INB', 'International Business'),
('IND', 'Industrial Design'),
('IRP', 'International Relations'),
('IST', 'Information Studies'),
('ITA', 'Italian'),
('JAM', 'Jewelry and Metalsmithing'),
('JPS', 'Japanese'),
('JSP', 'Judaic Studies Program'),
('KNM', 'Knowledge Management'),
('KOR', 'Korean'),
('LAS', 'Latino-Latin American Studies'),
('LAT', 'Latin'),
('LAW', 'Law'),
('LIN', 'Linguistics'),
('LIT', 'Literature'),
('LLM', 'Master of Laws'),
('LPP', 'Law & Public Policy'),
('LSA', 'Landscape Architecture'),
('M&E', 'Media & Education'),
('MAE', 'Mechanical & Aerospace Engineering'),
('MAG', 'Magazine'),
('MAR', 'Marketing'),
('MAS', 'Managerial Statistics'),
('MAT', 'Mathematics'),
('MAX', 'Maxwell School'),
('MBC', 'Master of Business Core'),
('MCR', 'Microscopy'),
('MEE', 'Mechanical Engineering'),
('MES', 'Middle Eastern Studies'),
('MFE', 'Manufacturing Engineering'),
('MFT', 'Marriage and Family Therapy'),
('MGT', 'Management'),
('MHL', 'Music History and Literature'),
('MIS', 'Management Information Systems'),
('MNO', 'Magazine, Newspaper & OL Journ'),
('MPD', 'Multimedia Photography and De'),
('MPH', 'Master of Public Health'),
('MSL', 'Military Science & Leadership'),
('MTC', 'Music Theory Concepts'),
('MTD', 'Mathematics Education'),
('MUE', 'Music Education'),
('MUI', 'Music Industry'),
('MUS', 'Museum Studies'),
('NAT', 'Native American Studies'),
('NEU', 'Neuroscience'),
('NEW', 'Newspaper'),
('NSD', 'Nutrition Science & Dietetics'),
('NUC', 'Nuclear Energy Track'),
('O&M', 'Organization and Management'),
('OBO', 'Oboe Instruction'),
('ORG', 'Organ Instruction'),
('PAF', 'Public Affairs'),
('PAI', 'Public Admin & Internatl Affrs'),
('PDG', 'Pedagogy of Music'),
('PED', 'Physical Education'),
('PER', 'Performance'),
('PHI', 'Philosophy'),
('PHO', 'Photography'),
('PHY', 'Physics'),
('PNO', 'Piano Instruction'),
('POR', 'Portuguese'),
('PPE', 'Professional Phys Ed'),
('PRC', 'Percussion Instruction'),
('PRL', 'Public Relations'),
('PRT', 'Printmaking'),
('PSC', 'Political Science'),
('PSE', 'Paper Science & Engineering'),
('PSY', 'Psychology'),
('PTG', 'Painting'),
('QSX', 'Queer Sexuality'),
('RAE', 'Recording and Allied Ent'),
('RED', 'Reading Education'),
('REL', 'Religion'),
('RES', 'Real Estate'),
('RMT', 'Retail Management'),
('RUS', 'Russian'),
('SAS', 'South Asian Studies'),
('SCE', 'Science Education'),
('SCI', 'Science'),
('SCM', 'Supply Chain Management'),
('SCU', 'Sculpture'),
('SED', 'Secondary Education'),
('SHR', 'Strategy and Human Resources'),
('SOC', 'Sociology'),
('SOL', 'Soling Program'),
('SOM', 'School of Management'),
('SOS', 'Social Science'),
('SPA', 'Spanish'),
('SPE', 'Special Education'),
('SPM', 'Sport Management'),
('SWK', 'Social Work'),
('SXP', 'Saxophone Instruction'),
('TDC', 'TED Center'),
('TRB', 'Trombone Instruction'),
('TRF', 'Television, Radio & Film'),
('TRK', 'Turkish'),
('TRM', 'TransMedia'),
('TRP', 'Trumpet Instruction'),
('TXT', 'Textiles'),
('URP', 'Undergraduate Research Program'),
('VCO', 'Violoncello Instruction'),
('VID', 'Art Video'),
('VLA', 'Viola Instruction'),
('VLN', 'Violin Instruction'),
('VOC', 'Voice'),
('WGS', 'Women\'s and Gender Studies'),
('WPE', 'Wood Products Engineering'),
('WRT', 'Writing Program');

CREATE TABLE `tutor_subject_mastery` (
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `tutor_subject_code` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `user` (
  `user_id` mediumint(8) UNSIGNED NOT NULL COMMENT 'User ID',
  `user_email` varchar(255) DEFAULT NULL COMMENT 'Email',
  `user_firstname` varchar(40) NOT NULL DEFAULT '' COMMENT 'First Name',
  `user_middlename` varchar(40) NOT NULL DEFAULT '' COMMENT 'Middle Name',
  `user_lastname` varchar(40) NOT NULL DEFAULT '' COMMENT 'Last Name',
  `user_enabled` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'User Activated',
  `user_password` varchar(256) DEFAULT NULL COMMENT 'Password'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `tutor_user_id` (`tutor_user_id`),
  ADD KEY `student_user_id` (`student_user_id`);

ALTER TABLE `group`
  ADD PRIMARY KEY (`group_id`);
ALTER TABLE `group` ADD FULLTEXT KEY `GROUP_NAME_INDEX` (`group_name`);

ALTER TABLE `membership`
  ADD PRIMARY KEY (`user_id`,`group_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `group_id` (`group_id`) USING BTREE;

ALTER TABLE `parent`
  ADD PRIMARY KEY (`parent_user_id`,`child_user_id`);

ALTER TABLE `tutor_subject`
  ADD PRIMARY KEY (`tutor_subject_code`);

ALTER TABLE `tutor_subject_mastery`
  ADD PRIMARY KEY (`user_id`,`tutor_subject_code`) USING BTREE;

ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `USER_EMAIL_INDEX` (`user_email`);
ALTER TABLE `user` ADD FULLTEXT KEY `USER_NAME_INDEX` (`user_firstname`,`user_lastname`);


ALTER TABLE `appointment`
  MODIFY `appointment_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
ALTER TABLE `group`
  MODIFY `group_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
ALTER TABLE `user`
  MODIFY `user_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'User ID', AUTO_INCREMENT=5;
