CREATE TABLE IF NOT EXISTS `login_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` char(32) NOT NULL,
  `duration` varchar(32) NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT '0',
  `expires` datetime NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS `static_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` text CHARACTER SET utf8,
  `url_name` text CHARACTER SET utf8,
  `page_content` text CHARACTER SET utf8,
  `page_title` text CHARACTER SET utf8,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_group_id` varchar(256) DEFAULT NULL,
  `username` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `first_name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `last_name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `gender` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `bday` date DEFAULT NULL,
  `active` int(1) DEFAULT '0',
  `email_verified` int(1) NOT NULL DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`username`),
  KEY `mail` (`email`),
  KEY `users_FKIndex1` (`user_group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


INSERT INTO `users` (`id`, `user_group_id`, `username`, `password`, `email`, `first_name`, `last_name`, `gender`, `photo`, `bday`, `active`, `email_verified`, `last_login`, `ip_address`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(1, '1', 'admin', '$2y$10$.dezXbhZdar0R0YWE45R3.NshUKQn6OXXqlWdcJe1tevJSWo469ei', 'admin@admin.com', 'Admin', '', NULL, NULL, NULL, 1, 1, NULL, NULL, now(), now(), NULL, NULL);


CREATE TABLE IF NOT EXISTS `user_activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `useragent` varchar(256) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `last_action` int(11) NOT NULL,
  `last_url` text,
  `user_browser` text,
  `ip_address` varchar(50) DEFAULT NULL,
  `logout` int(11) NOT NULL DEFAULT '0',
  `deleted` int(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `user_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `requirement` text CHARACTER SET utf8,
  `reply_message` text CHARACTER SET utf8,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `user_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `location` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `cellphone` varchar(15) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


INSERT INTO `user_details` (`id`, `user_id`, `location`, `cellphone`, `created`, `modified`) VALUES
(1, 1, NULL, NULL, now(), now());


CREATE TABLE IF NOT EXISTS `user_emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) DEFAULT NULL,
  `user_group_id` varchar(256) DEFAULT NULL,
  `cc_to` text,
  `from_name` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `from_email` varchar(200) DEFAULT NULL,
  `subject` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `message` text CHARACTER SET utf8,
  `sent_by` int(11) DEFAULT NULL COMMENT 'user_id',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `user_email_recipients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `email_address` varchar(100) NOT NULL,
  `is_email_sent` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `user_email_signatures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `signature_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `signature` text CHARACTER SET utf8,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `user_email_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `template_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `header` text CHARACTER SET utf8,
  `footer` text CHARACTER SET utf8,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `description` text CHARACTER SET utf8,
  `registration_allowed` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;


INSERT INTO `user_groups` (`id`, `parent_id`, `name`, `description`, `registration_allowed`, `created`, `modified`) VALUES
(1, 0, 'Admin', NULL, 0, now(), now()),
(2, 0, 'User', NULL, 1, now(), now()),
(3, 0, 'Guest', NULL, 0, now(), now());


CREATE TABLE IF NOT EXISTS `user_group_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_group_id` int(11) NOT NULL,
  `plugin` varchar(50) DEFAULT NULL,
  `controller` varchar(50) NOT NULL,
  `action` varchar(100) NOT NULL,
  `allowed` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=97 ;


INSERT INTO `user_group_permissions` (`id`, `user_group_id`, `plugin`, `controller`, `action`, `allowed`) VALUES
(1, 1, NULL, 'Pages', 'display', 1),
(2, 2, NULL, 'Pages', 'display', 1),
(3, 3, NULL, 'Pages', 'display', 1),
(4, 1, 'Usermgmt', 'Autocomplete', 'fetch', 1),
(5, 2, 'Usermgmt', 'Autocomplete', 'fetch', 0),
(6, 1, 'Usermgmt', 'StaticPages', 'index', 1),
(7, 1, 'Usermgmt', 'StaticPages', 'add', 1),
(8, 1, 'Usermgmt', 'StaticPages', 'edit', 1),
(9, 1, 'Usermgmt', 'StaticPages', 'view', 1),
(10, 1, 'Usermgmt', 'StaticPages', 'delete', 1),
(11, 1, 'Usermgmt', 'StaticPages', 'preview', 1),
(12, 1, 'Usermgmt', 'UserContacts', 'index', 1),
(13, 1, 'Usermgmt', 'UserContacts', 'contactUs', 1),
(14, 2, 'Usermgmt', 'UserContacts', 'contactUs', 1),
(15, 3, 'Usermgmt', 'UserContacts', 'contactUs', 1),
(16, 1, 'Usermgmt', 'UserContacts', 'sendReply', 1),
(17, 2, 'Usermgmt', 'StaticPages', 'preview', 1),
(18, 3, 'Usermgmt', 'StaticPages', 'preview', 1),
(19, 1, 'Usermgmt', 'UserEmails', 'index', 1),
(20, 1, 'Usermgmt', 'UserEmails', 'send', 1),
(21, 1, 'Usermgmt', 'UserEmails', 'sendToUser', 1),
(22, 1, 'Usermgmt', 'UserEmails', 'view', 1),
(23, 1, 'Usermgmt', 'UserEmails', 'searchEmails', 1),
(24, 1, 'Usermgmt', 'UserEmailSignatures', 'index', 1),
(25, 1, 'Usermgmt', 'UserEmailSignatures', 'add', 1),
(26, 1, 'Usermgmt', 'UserEmailSignatures', 'edit', 1),
(27, 1, 'Usermgmt', 'UserEmailSignatures', 'delete', 1),
(28, 1, 'Usermgmt', 'UserEmailTemplates', 'index', 1),
(29, 1, 'Usermgmt', 'UserEmailTemplates', 'add', 1),
(30, 1, 'Usermgmt', 'UserEmailTemplates', 'edit', 1),
(31, 1, 'Usermgmt', 'UserEmailTemplates', 'delete', 1),
(32, 1, 'Usermgmt', 'UserGroupPermissions', 'permissionGroupMatrix', 1),
(33, 1, 'Usermgmt', 'UserGroupPermissions', 'permissionSubGroupMatrix', 1),
(34, 1, 'Usermgmt', 'UserGroupPermissions', 'changePermission', 1),
(35, 1, 'Usermgmt', 'UserGroupPermissions', 'getPermissions', 1),
(36, 2, 'Usermgmt', 'UserGroupPermissions', 'getPermissions', 0),
(37, 3, 'Usermgmt', 'UserGroupPermissions', 'getPermissions', 0),
(38, 1, 'Usermgmt', 'UserGroups', 'index', 1),
(39, 1, 'Usermgmt', 'UserGroups', 'add', 1),
(40, 1, 'Usermgmt', 'UserGroups', 'edit', 1),
(41, 1, 'Usermgmt', 'UserGroups', 'delete', 1),
(42, 1, 'Usermgmt', 'Users', 'dashboard', 1),
(43, 2, 'Usermgmt', 'Users', 'dashboard', 1),
(44, 1, 'Usermgmt', 'Users', 'index', 1),
(45, 1, 'Usermgmt', 'Users', 'indexSearch', 1),
(46, 1, 'Usermgmt', 'Users', 'online', 1),
(47, 1, 'Usermgmt', 'Users', 'addUser', 1),
(48, 1, 'Usermgmt', 'Users', 'editUser', 1),
(49, 1, 'Usermgmt', 'Users', 'viewUser', 1),
(50, 1, 'Usermgmt', 'Users', 'deleteUser', 1),
(51, 1, 'Usermgmt', 'Users', 'setActive', 1),
(52, 1, 'Usermgmt', 'Users', 'setInactive', 1),
(53, 1, 'Usermgmt', 'Users', 'verifyEmail', 1),
(54, 1, 'Usermgmt', 'Users', 'changeUserPassword', 1),
(55, 1, 'Usermgmt', 'Users', 'logoutUser', 1),
(56, 1, 'Usermgmt', 'Users', 'viewUserPermissions', 1),
(57, 1, 'Usermgmt', 'Users', 'uploadCsv', 1),
(58, 1, 'Usermgmt', 'Users', 'addMultipleUsers', 1),
(59, 1, 'Usermgmt', 'Users', 'accessDenied', 1),
(60, 2, 'Usermgmt', 'Users', 'accessDenied', 1),
(61, 1, 'Usermgmt', 'Users', 'login', 1),
(62, 2, 'Usermgmt', 'Users', 'login', 1),
(63, 3, 'Usermgmt', 'Users', 'login', 1),
(64, 1, 'Usermgmt', 'Users', 'logout', 1),
(65, 2, 'Usermgmt', 'Users', 'logout', 1),
(66, 3, 'Usermgmt', 'Users', 'logout', 1),
(67, 1, 'Usermgmt', 'Users', 'register', 1),
(68, 2, 'Usermgmt', 'Users', 'register', 1),
(69, 3, 'Usermgmt', 'Users', 'register', 1),
(70, 1, 'Usermgmt', 'Users', 'myprofile', 1),
(71, 2, 'Usermgmt', 'Users', 'myprofile', 1),
(72, 1, 'Usermgmt', 'Users', 'editProfile', 1),
(73, 2, 'Usermgmt', 'Users', 'editProfile', 1),
(74, 1, 'Usermgmt', 'Users', 'changePassword', 1),
(75, 2, 'Usermgmt', 'Users', 'changePassword', 1),
(76, 1, 'Usermgmt', 'Users', 'deleteAccount', 1),
(77, 2, 'Usermgmt', 'Users', 'deleteAccount', 1),
(78, 1, 'Usermgmt', 'Users', 'forgotPassword', 1),
(79, 2, 'Usermgmt', 'Users', 'forgotPassword', 1),
(80, 3, 'Usermgmt', 'Users', 'forgotPassword', 1),
(81, 1, 'Usermgmt', 'Users', 'activatePassword', 1),
(82, 2, 'Usermgmt', 'Users', 'activatePassword', 1),
(83, 3, 'Usermgmt', 'Users', 'activatePassword', 1),
(84, 1, 'Usermgmt', 'Users', 'emailVerification', 1),
(85, 2, 'Usermgmt', 'Users', 'emailVerification', 1),
(86, 3, 'Usermgmt', 'Users', 'emailVerification', 1),
(87, 1, 'Usermgmt', 'Users', 'userVerification', 1),
(88, 2, 'Usermgmt', 'Users', 'userVerification', 1),
(89, 3, 'Usermgmt', 'Users', 'userVerification', 1),
(90, 1, 'Usermgmt', 'Users', 'deleteCache', 1),
(91, 1, 'Usermgmt', 'UserSettings', 'index', 1),
(92, 1, 'Usermgmt', 'UserSettings', 'editSetting', 1),
(93, 1, 'Usermgmt', 'UserSettings', 'cakelog', 1),
(94, 1, 'Usermgmt', 'UserSettings', 'cakelogbackup', 1),
(95, 1, 'Usermgmt', 'UserSettings', 'cakelogdelete', 1),
(96, 1, 'Usermgmt', 'UserSettings', 'cakelogempty', 1);


CREATE TABLE IF NOT EXISTS `user_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `display_name` varchar(1024) CHARACTER SET utf8 DEFAULT NULL,
  `value` text CHARACTER SET utf8,
  `type` varchar(50) DEFAULT NULL,
  `category` varchar(20) DEFAULT 'OTHER',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;


INSERT INTO `user_settings` (`id`, `name`, `display_name`, `value`, `type`, `category`) VALUES
(1, 'defaultTimeZone', 'Enter default time zone identifier for e.g. America/New_York', 'America/New_York', 'input', 'SITE'),
(2, 'siteName', 'Enter Your Full Site Name', 'User Management Plugin', 'input', 'SITE'),
(3, 'siteName', 'Enter Your Short Site Name', 'UMP', 'input', 'SITE'),
(4, 'loginRedirectUrl', 'Enter URL where user will be redirected after login', '/dashboard', 'input', 'SITE'),
(5, 'logoutRedirectUrl', 'Enter URL where user will be redirected after logout', '/login', 'input', 'SITE'),
(6, 'loginCookieName', 'Please enter login cookie name for your site which is used to login user automatically for remember me functionality', 'UMPremiumCookie', 'input', 'SITE'),
(7, 'useHttps', 'Do you want to use HTTPS for whole site?', '0', 'checkbox', 'SITE'),
(8, 'httpsUrls', 'You can enter selected urls for HTTPS, If URL belongs to any plugin then prepend plugin name in URL, if you want to allow all actions of controller on HTTPS then use controllername/* (e.g. usermgmt/users/login, usermgmt/users/register, products/cart, payments/*)', NULL, 'input', 'SITE'),
(9, 'defaultGroupId', 'Enter default group id for user registration', '2', 'input', 'GROUP'),
(10, 'adminGroupId', 'Enter Admin Group Id', '1', 'input', 'GROUP'),
(11, 'guestGroupId', 'Enter Guest Group Id', '3', 'input', 'GROUP'),
(12, 'siteRegistration', 'Do you want to allow new registrations?', '1', 'checkbox', 'USER'),
(13, 'emailVerification', 'Do you want user to verify his/her email address during registration?', '1', 'checkbox', 'EMAIL'),
(14, 'allowDeleteAccount', 'Do you want to allow users to delete their account', '0', 'checkbox', 'USER'),
(15, 'allowChangeUsername', 'Do you want to allow users to change their username?', '0', 'checkbox', 'USER'),
(16, 'bannedUsernames', 'Enter banned usernames comma separated(no space, no quotes)', 'Administrator, SuperAdmin', 'input', 'USER'),
(17, 'permissions', 'Do you want to check permissions for users?', '1', 'checkbox', 'PERMISSION'),
(18, 'adminPermissions', 'Do you want to check permissions for Admin?', '0', 'checkbox', 'PERMISSION'),
(19, 'allowUserMultipleLogin', 'Do you want to allow multiple logins with same user account for users(not admin)?', '1', 'checkbox', 'USER'),
(20, 'allowAdminMultipleLogin', 'Do you want to allow multiple logins with same user account for admin(not users)?', '1', 'checkbox', 'USER'),
(21, 'loginIdleTime', 'Set max idle time in minutes for user. This idle time will be used when multiple logins are not allowed for same user account. If max idle time reached since user last activity on the site then anyone can login with same account in other browser and idle user will be logged out.', '10', 'input', 'USER'),
(22, 'viewOnlineUserTime', 'You can view online users and guest from last few minutes, set time in minutes ', '30', 'input', 'USER'),
(23, 'imgDir', 'Enter Image directory name where users profile photos will be uploaded. This directory should be in webroot/library directory', 'umphotos', 'input', 'USER'),
(24, 'QRDN', 'Increase this number by 1 every time if you made any changes in CSS or JS file, If you delete cache from admin then it increases automatically', '123456790', 'input', 'SITE'),
(25, 'useRememberMe', 'Do you want to show remember me feature on login page?', '1', 'checkbox', 'USER'),
(26, 'emailFromAddress', 'Enter From Email Address to send emails', 'test@test.com', 'input', 'EMAIL'),
(27, 'emailFromName', 'Enter From Email Name', 'User Management Plugin', 'input', 'EMAIL'),
(28, 'adminEmailAddress', 'Enter Admin Email Address to receive emails for e.g. contact enquiries', NULL, 'input', 'EMAIL'),
(29, 'sendRegistrationMail', 'Do you want to send welcome registration email to user after registration', '0', 'checkbox', 'EMAIL'),
(30, 'sendPasswordChangeMail', 'Do you want to send password change email if users change their password', '0', 'checkbox', 'EMAIL'),
(31, 'privateKeyFromRecaptcha', 'Enter private key for Recaptcha from google', NULL, 'input', 'RECAPTCHA'),
(32, 'publicKeyFromRecaptcha', 'Enter public key for recaptcha from google', NULL, 'input', 'RECAPTCHA'),
(33, 'useRecaptchaOnLogin', 'Do you want to add captcha support on login form?', '0', 'checkbox', 'RECAPTCHA'),
(34, 'useRecaptchaOnBadLogin', 'Do you want to add captcha support on bad login? if user tried bad login credentials then after specifed bad login count recaptcha will be added on login form', '0', 'checkbox', 'RECAPTCHA'),
(35, 'badLoginAllowCount', 'Enter bad login count to add captcha on login. for e.g. 5 or 10', '5', 'input', 'RECAPTCHA'),
(36, 'useRecaptchaOnRegistration', 'Do you want to add captcha support on registration form? ', '0', 'checkbox', 'RECAPTCHA'),
(37, 'useRecaptchaOnForgotPassword', 'Do you want to add captcha support on forgot password page? ', '0', 'checkbox', 'RECAPTCHA'),
(38, 'useRecaptchaOnEmailVerification', 'Do you want to add captcha support on email verification page? ', '0', 'checkbox', 'RECAPTCHA'),
(39, 'useFacebookLogin', 'Do you want to use Facebook Connect on your site?', '0', 'checkbox', 'FACEBOOK'),
(40, 'facebookAppId', 'Enter Facebook Application Id', NULL, 'input', 'FACEBOOK'),
(41, 'facebookSecret', 'Enter Facebook Application Secret Code', NULL, 'input', 'FACEBOOK'),
(42, 'facebookScope', 'Enter Facebook Permissions', 'email', 'input', 'FACEBOOK'),
(43, 'useTwitterLogin', 'Want to use Twitter Connect on your site?', '0', 'checkbox', 'TWITTER'),
(44, 'twitterConsumerKey', 'Enter Twitter Consumer Key', NULL, 'input', 'TWITTER'),
(45, 'twitterConsumerSecret', 'Enter Twitter Consumer Secret', NULL, 'input', 'TWITTER'),
(46, 'useGmailLogin', 'Do you want to use Google Connect on your site?', '0', 'checkbox', 'GOOGLE'),
(47, 'gmailApiKey', 'Enter Google Api Key', NULL, 'input', 'GOOGLE'),
(48, 'gmailClientId', 'Enter Google Client Id', NULL, 'input', 'GOOGLE'),
(49, 'gmailClientSecret', 'Enter Google Client Secret', NULL, 'input', 'GOOGLE'),
(50, 'useYahooLogin', 'Do you want to use Yahoo Connect on your site?', '0', 'checkbox', 'YAHOO'),
(51, 'useLinkedinLogin', 'Do you want to use Linkedin Connect on your site?', '0', 'checkbox', 'LINKEDIN'),
(52, 'linkedinApiKey', 'Enter Linkedin Api Key', NULL, 'input', 'LINKEDIN'),
(53, 'linkedinSecretKey', 'Enter Linkedin Secret Key', NULL, 'input', 'LINKEDIN'),
(54, 'useFoursquareLogin', 'Do you want to use Foursquare Connect on your site?', '0', 'checkbox', 'FOURSQUARE'),
(55, 'foursquareClientId', 'Enter Foursquare Client Id', NULL, 'input', 'FOURSQUARE'),
(56, 'foursquareClientSecret', 'Enter Foursquare Client Secret', NULL, 'input', 'FOURSQUARE');


CREATE TABLE IF NOT EXISTS `user_socials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` varchar(20) DEFAULT NULL,
  `socialid` varchar(100) DEFAULT NULL,
  `access_token` text,
  `access_secret` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
