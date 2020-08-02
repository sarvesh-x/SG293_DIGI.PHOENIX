CREATE TABLE `chat_master` (
  `chat_id` int(100) NOT NULL AUTO_INCREMENT,
  `s_id` int(100) NOT NULL,
  `r_id` int(100) NOT NULL,
  `message` varchar(500) NOT NULL,
  `status` int(5) NOT NULL,
  `date_time` datetime(5) NOT NULL,
  `file` varchar(100) NOT NULL,
  PRIMARY KEY (`chat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1; 

CREATE TABLE `company` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE `notification` (
  `n_id` int(100) NOT NULL AUTO_INCREMENT,
  `t_id` int(100) NOT NULL,
  `date` datetime(5) NOT NULL,
  `message` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE `old_project` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `project` int(50) NOT NULL,
  `year` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1; 

CREATE TABLE `on_sider_allocation` (
  `os_id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `t_id` int(100) NOT NULL,
  PRIMARY KEY (`os_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE `onworksiteimages` (
  `ts_id` int(15) NOT NULL,
  `image_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `lat_long` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=REDUNDANT; 

CREATE TABLE `tender_master` (
  `t_id` int(100) NOT NULL AUTO_INCREMENT,
  `t_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `t_issue_date` date NOT NULL,
  `t_due_date` date NOT NULL,
  `t_budget` float NOT NULL,
  `t_details` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `t_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `t_image` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user.png',
  `t_o_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `exp_budget` float NOT NULL,
  `exp_budget_desc` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `approval_exp_budget` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lat_long` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `r` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `vp` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `image` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`t_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=REDUNDANT; 

CREATE TABLE `tender_status` (
  `ts_id` int(100) NOT NULL AUTO_INCREMENT,
  `t_id` int(100) NOT NULL,
  `date` date NOT NULL,
  `today_work` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `total_emp` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `emp_present` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `daily_wages` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `daily_expense` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `reson_late` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `other` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `work_completed` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `invoice_file` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lat_long` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lab_report` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ts_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=REDUNDANT; 

CREATE TABLE `thirdpartyfeedback` (
  `t_id` int(10) NOT NULL,
  `date` date NOT NULL,
  `feedback` varchar(1000) NOT NULL,
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `tp_id` int(100) NOT NULL,
  `lat_long` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1; 

CREATE TABLE `thirdpartyimages` (
  `th_id` int(10) NOT NULL AUTO_INCREMENT,
  `t_id` int(10) NOT NULL,
  `image_name` varchar(75) NOT NULL,
  `lat_long` varchar(75) NOT NULL,
  PRIMARY KEY (`th_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1; 

CREATE TABLE `user_master` (
  `user_id` int(100) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `cmp_code` int(100) NOT NULL,
  `t_id` int(100) NOT NULL,
  `image` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE `users` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(80) NOT NULL,
  `t_id` int(100) NOT NULL,
  `dob` varchar(12) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `address` varchar(250) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1; 
 
 


INSERT INTO `company` ( `id`, `name`, `mobile`, `logo`, `address`, `email`) VALUES 
('1', 'RHCMS', '12345690', 'IMG_20200723_194041.jpg', '', 'rhcms@gmail.com');  


INSERT INTO `notification` ( `n_id`, `t_id`, `date`, `message`, `status`, `subject`) VALUES 
('6', '1', '2020-08-01 14:15:28.00000', 'Dear Sir Your tender  active', 'Send', 'Tender Notification '), 
('7', '11', '2020-08-03 01:03:19.00000', 'Lab Report is Required for 01-08-2020.', 'Pending', 'Lab Report');  


INSERT INTO `old_project` ( `id`, `project`, `year`) VALUES 
('1', '100', '2010'), 
('2', '150', '2011'), 
('3', '250', '2012'), 
('4', '220', '2013'), 
('5', '118', '2014'), 
('6', '140', '2015'), 
('7', '100', '2016'), 
('8', '90', '2017'), 
('9', '250', '2018'), 
('10', '260', '2019'), 
('11', '50', '2020');  


INSERT INTO `on_sider_allocation` ( `os_id`, `user_id`, `t_id`) VALUES 
('1', '4', '7'), 
('2', '5', '15');  


INSERT INTO `onworksiteimages` ( `ts_id`, `image_name`, `id`, `lat_long`) VALUES 
('0', 'ABC Building _03-08-2020_00:35:47', '1', '26.959605000000003,75.71793333333333');  


INSERT INTO `tender_master` ( `t_id`, `t_name`, `t_issue_date`, `t_due_date`, `t_budget`, `t_details`, `t_type`, `t_image`, `t_o_name`, `exp_budget`, `exp_budget_desc`, `approval_exp_budget`, `lat_long`, `r`, `vp`, `image`) VALUES 
('11', 'ABC Building ', '2020-08-01', '2020-08-01', '250000', 'House Building ', 'Current Tender', 'user.png', 'ABC', '0', '', '', '26.959605000000003,75.71793333333333', '1', 'Yes', 'ABC Building _03-08-2020_00:42:42'), 
('15', 'A', '2013-08-01', '2018-08-02', '5000000', 'This is a rural housing scheme.', 'Current Tender', 'user.png', 'Kalyan', '0', '', '', '', '100', 'No', ''), 
('16', 'd', '2020-08-06', '2023-06-07', '500', 'hiii', 'Current Tender', 'user.png', 'jdhjkdjks', '0', '', '', '', '20', 'No', '');  


INSERT INTO `tender_status` ( `ts_id`, `t_id`, `date`, `today_work`, `total_emp`, `emp_present`, `daily_wages`, `daily_expense`, `reson_late`, `other`, `work_completed`, `invoice_file`, `lat_long`, `lab_report`) VALUES 
('1', '11', '2020-08-02', 'Room First and Second Wall ', '100', '99', '100', '500', 'no', 'No', '10', 'abc.pdf', '', ''), 
('2', '11', '2020-08-02', 'Floor', '25', '22', '26700', '29800', 'NA', 'NA', '90', '', '', '');  


INSERT INTO `thirdpartyfeedback` ( `t_id`, `date`, `feedback`, `id`, `tp_id`, `lat_long`) VALUES 
('15', '2020-08-02', 'Good', '1', '5', '');  


INSERT INTO `thirdpartyimages` ( `th_id`, `t_id`, `image_name`, `lat_long`) VALUES 
('1', '1', 'bUNDI_28-07-2020_18:03:17.png', ''), 
('2', '1', 'bUNDI_28-07-2020_13:13:46.png', '');  


INSERT INTO `user_master` ( `user_id`, `username`, `email`, `password`, `type`, `cmp_code`, `t_id`, `image`) VALUES 
('3', 'Deepak Sharma', 'admin@gmail.com', '123', 'Admin', '1', '0', ''), 
('5', 'Rohit Jain', 'rohit@gmail.com', '123', 'Third Party', '1', '0', 'cat_1596386268.jpg');  


INSERT INTO `users` ( `id`, `name`, `email`, `password`, `t_id`, `dob`, `mobile`, `address`, `status`) VALUES 
('30', 'ABC Building ', 'sarvesh.tecarte@gmail.com', '12345', '11', '09-06-2001', '9998887776', 'Jaipur', 'Active'), 
('31', 'a', 'jnu123', '123@hnf73452', '0', '', '', '', 'Active'), 
('32', 'A', '123', '16616hyish', '15', '', '', '', 'Active'), 
('33', 'd', 'shyam@123', '123456789', '16', '', '', '', 'Active'); 