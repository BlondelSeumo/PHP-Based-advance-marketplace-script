-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2020 at 06:54 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `slippaup`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ads`
--

CREATE TABLE `tbl_ads` (
  `id` int(11) NOT NULL,
  `homepage_banner_720x90` text NOT NULL,
  `webpage_banner_720x90` text NOT NULL,
  `blog_page_720x90` text NOT NULL,
  `blog_300x250` text NOT NULL,
  `blog__post_page_720x90` text NOT NULL,
  `blog__post_page_300x250` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ads`
--

INSERT INTO `tbl_ads` (`id`, `homepage_banner_720x90`, `webpage_banner_720x90`, `blog_page_720x90`, `blog_300x250`, `blog__post_page_720x90`, `blog__post_page_300x250`) VALUES
(1, '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_announcement`
--

CREATE TABLE `tbl_announcement` (
  `id` int(11) NOT NULL,
  `announcement_heading` varchar(250) NOT NULL,
  `announcement` text NOT NULL,
  `announcement_type` varchar(250) NOT NULL,
  `group_id` varchar(250) NOT NULL,
  `date` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_announcement`
--

INSERT INTO `tbl_announcement` (`id`, `announcement_heading`, `announcement`, `announcement_type`, `group_id`, `date`, `status`) VALUES
(2, 'Hello', '11111111', 'alert-warning', '1', '2020-03-31 05:16:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bids`
--

CREATE TABLE `tbl_bids` (
  `id` int(11) NOT NULL,
  `listing_id` int(11) NOT NULL,
  `listing_type` varchar(250) NOT NULL,
  `bidder_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `bid_amount` float NOT NULL,
  `bid_status` int(11) NOT NULL COMMENT '0=inactive,1=approved by the owner,2=rejected by the owner,3=,Won the auction,4=automatically rejected,5= bid closed,6= contract opened',
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blog`
--

CREATE TABLE `tbl_blog` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `slug` text NOT NULL,
  `metadescription` text NOT NULL,
  `metakeywords` text NOT NULL,
  `blog_post` text NOT NULL,
  `blog_tags` text NOT NULL,
  `thumbnail` text,
  `date` datetime NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=disabled,1=enabled',
  `views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_blog`
--

INSERT INTO `tbl_blog` (`id`, `title`, `slug`, `metadescription`, `metakeywords`, `blog_post`, `blog_tags`, `thumbnail`, `date`, `status`, `views`) VALUES
(20, 'Where can I get some?', 'where-can-i-get-some', ' here are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by in                         ', '[\"wr3\",\"4t34\",\"lore                          \"]', '<span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"><b>There are many variations of passages of Lorem Ipsum available,</b> but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</span>                          ', '[\"hello\",\"mellow.testing\",\"123                          \"]', 'bn2.jpg', '2020-04-10 05:42:00', 1, 0),
(21, 'Where can I get some?', 'where-can-i-get-some-20', ' 3wqr34t34ty                         ', '[\"34wt34ty3y35\"]', '34ty3y35y35y35y', '[\"tr4t3\",\"34645                          \"]', 'banner-10.jpg', '2019-08-06 13:00:10', 1, 0),
(22, 'Where can I get some?', 'where-can-i-get-some-22', ' 3wqr34t34ty                         ', '[\"34wt34ty3y35\"]', '34ty3y35y35y35y', '[\"tr4t3\",\"34645                          \"]', 'banner-10.jpg', '2019-08-06 13:00:10', 1, 0),
(23, 'Where can I get some?', 'where-can-i-get-some-23', ' 3wqr34t34ty                         ', '[\"34wt34ty3y35\"]', '34ty3y35y35y35y', '[\"tr4t3\",\"34645                          \"]', 'banner-10.jpg', '2019-08-06 13:00:10', 1, 0),
(24, 'Where can I get some?', 'where-can-i-get-some-24', ' here are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by in                         ', '[\"wr3\",\"4t34\",\"lore                          \"]', '<span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"><b>There are many variations of passages of Lorem Ipsum available,</b> but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</span>                          ', '[\"hello\",\"mellow.testing\",\"123                          \"]', 'banner-10.jpg', '2019-08-06 13:48:08', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `id` int(11) NOT NULL,
  `c_name` varchar(250) NOT NULL,
  `c_description` varchar(250) NOT NULL,
  `c_keywords` text NOT NULL,
  `c_thumb` varchar(250) NOT NULL,
  `c_level` int(2) NOT NULL,
  `url_slug` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`id`, `c_name`, `c_description`, `c_keywords`, `c_thumb`, `c_level`, `url_slug`) VALUES
(2, 'Cars & Vehicles', 'Software Engineer, Web / Mobile Developer & More', '[\"he\",\"lol\"]', '11.png', 0, 'cars-vehicles'),
(3, 'Electric & Gadgetss', 'Electric & Gadgets / Tools', '[\"Electric \",\"Gadgets \"]', '22.png', 0, 'electric-gadgets'),
(4, 'Real Estate', 'Real Estate / Properties', '[\"Real Estate\"]', '31.png', 0, ''),
(5, 'Sports & Games', 'Sports & Games / Video Games', '[\"Sports & Games\"]', '4.png', 0, ''),
(6, 'Fashion & Beauty', 'Fashion & Beauty & More', '[\"Fshion & Beauty\"]', '5.png', 0, ''),
(7, 'Pets & Animals', 'Pets & Animals', '[\"Pets & Animals\"]', '6.png', 0, ''),
(8, 'Home Appliances', 'Home Appliances', '[\"Home Appliances\"]', '7.png', 0, ''),
(9, 'Matrimony Services', 'Matrimony Services', '[\"Matrimony Services\"]', '8.png', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comments`
--

CREATE TABLE `tbl_comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `listing_id` int(11) NOT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1',
  `author_comment` int(11) NOT NULL DEFAULT '0',
  `section` varchar(20) NOT NULL DEFAULT 'listing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contracts`
--

CREATE TABLE `tbl_contracts` (
  `id` int(11) NOT NULL,
  `user_id` varchar(250) NOT NULL,
  `domain_id` varchar(250) NOT NULL,
  `listing_id` varchar(250) NOT NULL,
  `invoice_id` varchar(250) NOT NULL,
  `contract_id` varchar(250) NOT NULL,
  `amount` float NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_coupons`
--

CREATE TABLE `tbl_coupons` (
  `id` int(11) NOT NULL,
  `discount_type` int(11) NOT NULL DEFAULT '0' COMMENT '0-percentage,1=amount',
  `amount` int(11) NOT NULL,
  `discount_code` varchar(250) NOT NULL,
  `valid_from` date NOT NULL,
  `valid_till` date NOT NULL,
  `valid_listings` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0=disabled,1=on',
  `created_date` date NOT NULL,
  `created_user` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cron`
--

CREATE TABLE `tbl_cron` (
  `id` int(11) NOT NULL,
  `cron_job` varchar(250) DEFAULT NULL,
  `cron_Minute` varchar(250) DEFAULT NULL,
  `cron_Hour` varchar(250) DEFAULT NULL,
  `cron_day` varchar(250) DEFAULT NULL,
  `cron_month` varchar(250) DEFAULT NULL,
  `cron_weekday` varchar(250) DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_disputes`
--

CREATE TABLE `tbl_disputes` (
  `id` int(11) NOT NULL,
  `contract_id` varchar(250) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=open,1=closed',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_domains`
--

CREATE TABLE `tbl_domains` (
  `id` int(11) NOT NULL,
  `domain` varchar(250) NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=unverified,1=verified,2=blacklisted',
  `token` text NOT NULL,
  `google_token` text NOT NULL,
  `google_anastatus` int(11) NOT NULL COMMENT '1=verified,0=unverified',
  `date` datetime NOT NULL,
  `acc_id` varchar(250) NOT NULL,
  `prop_id` varchar(250) NOT NULL,
  `view_id` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_domain_purchases`
--

CREATE TABLE `tbl_domain_purchases` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `domain_id` int(11) NOT NULL,
  `listing_id` int(11) NOT NULL,
  `invoice_id` varchar(250) NOT NULL,
  `amount` float NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_email_settings`
--

CREATE TABLE `tbl_email_settings` (
  `id` int(11) NOT NULL DEFAULT '1',
  `site_email` varchar(250) NOT NULL,
  `site_email_name` varchar(250) NOT NULL,
  `mail_sending_option` varchar(250) NOT NULL,
  `mail_smtp_server` varchar(250) NOT NULL,
  `mail_smtp_user` varchar(250) NOT NULL,
  `mail_smtp_password` varchar(250) NOT NULL,
  `mail_smtp_port` varchar(250) NOT NULL,
  `mail_smtp_encryption` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_email_settings`
--

INSERT INTO `tbl_email_settings` (`id`, `site_email`, `site_email_name`, `mail_sending_option`, `mail_smtp_server`, `mail_smtp_user`, `mail_smtp_password`, `mail_smtp_port`, `mail_smtp_encryption`) VALUES
(1, 'otdomains@gmail.com', 'Slippa', 'php', 'localhost', 'otdomains@gmail.com', 'Ganeendra642', '25', 'ssl');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_history`
--

CREATE TABLE `tbl_history` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `contract_id` varchar(250) NOT NULL,
  `remarks` text,
  `uploads` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoices`
--

CREATE TABLE `tbl_invoices` (
  `id` int(11) NOT NULL,
  `invoice_id` varchar(250) NOT NULL,
  `paid_by` varchar(250) NOT NULL,
  `paid_to` varchar(250) NOT NULL,
  `gross_amount` float NOT NULL,
  `processing_fee` float NOT NULL,
  `success_fee` float NOT NULL,
  `withdraw_amount` float NOT NULL,
  `listing_id` varchar(250) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=paid by buyer,0=pending for buyer,3=canceled and reversed,4=cleared for seller,5= waiting to clear,6=withdrawn,7=on hold',
  `invoice_type` int(11) NOT NULL DEFAULT '1' COMMENT '1=credit,0=debit',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_languages`
--

CREATE TABLE `tbl_languages` (
  `id` int(11) NOT NULL,
  `language_code` varchar(250) DEFAULT NULL,
  `language` varchar(250) DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `default_status` int(1) DEFAULT '0',
  `icon` varchar(250) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_languages`
--

INSERT INTO `tbl_languages` (`id`, `language_code`, `language`, `status`, `default_status`, `icon`) VALUES
(9, 'en', 'english', 1, 1, 'flag-icon-us'),
(30, 'fr', 'french', 1, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lastseen`
--

CREATE TABLE `tbl_lastseen` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_listings`
--

CREATE TABLE `tbl_listings` (
  `id` int(11) NOT NULL,
  `domain_id` int(250) NOT NULL,
  `listing_type` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL,
  `website_BusinessName` varchar(250) NOT NULL,
  `extension` varchar(250) NOT NULL,
  `business_registeredCountry` varchar(11) NOT NULL,
  `website_industry` int(11) NOT NULL,
  `monetization_methods` mediumtext NOT NULL,
  `last12_monthsrevenue` varchar(250) NOT NULL,
  `last12_monthsexpenses` varchar(250) NOT NULL,
  `annual_profit` varchar(250) DEFAULT NULL,
  `financial_uploadVisual` varchar(250) DEFAULT NULL,
  `financial_uploadProfitLoss` varchar(250) DEFAULT NULL,
  `website_tagline` mediumtext NOT NULL,
  `website_metadescription` mediumtext NOT NULL,
  `website_metakeywords` text NOT NULL,
  `description` mediumtext NOT NULL,
  `website_age` int(10) NOT NULL,
  `website_how_make_money` mediumtext,
  `website_purchasing_fulfilment` mediumtext,
  `website_whyselling` mediumtext,
  `website_suitsfor` mediumtext,
  `website_facebook` varchar(250) DEFAULT NULL,
  `website_twitter` varchar(250) DEFAULT NULL,
  `website_instagram` varchar(250) DEFAULT NULL,
  `alexa_rank` int(2) NOT NULL DEFAULT '1',
  `google_verified` int(11) NOT NULL DEFAULT '0' COMMENT '1=0n,0=off',
  `status` int(11) NOT NULL COMMENT '0=inactive,1=active,2=suspended,4=expired,5=unverified,6=deleted',
  `sold_status` int(11) NOT NULL DEFAULT '0' COMMENT '0=available,1=sold',
  `deliver_in` int(11) NOT NULL,
  `website_thumbnail` mediumtext,
  `website_cover` mediumtext,
  `listing_option` varchar(250) NOT NULL,
  `website_startingprice` varchar(250) DEFAULT '0',
  `website_reserveprice` varchar(250) DEFAULT '0',
  `website_minimumoffer` varchar(250) DEFAULT '0',
  `website_buynowprice` varchar(250) DEFAULT '0',
  `Included_assets` varchar(250) NOT NULL,
  `token` mediumtext NOT NULL,
  `user_ip` varchar(250) NOT NULL,
  `date` datetime NOT NULL,
  `views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_listing_header`
--

CREATE TABLE `tbl_listing_header` (
  `listing_id` int(11) NOT NULL,
  `listing_name` varchar(250) DEFAULT NULL,
  `listing_description` varchar(250) NOT NULL,
  `listing_price` varchar(250) NOT NULL,
  `listing_duration` varchar(250) NOT NULL,
  `listing_type` varchar(250) NOT NULL,
  `listing_icon` text NOT NULL,
  `status` int(1) NOT NULL COMMENT '0=off,1=on'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_listing_header`
--

INSERT INTO `tbl_listing_header` (`listing_id`, `listing_name`, `listing_description`, `listing_price`, `listing_duration`, `listing_type`, `listing_icon`, `status`) VALUES
(1, 'Regular Listing', 'Sell-Domains', '120', '122', 'domain', 'domains.svg', 1),
(2, 'Ad Listing Silver', 'Sell-Domains', '200', '200', 'domain', 'domains.svg', 1),
(3, 'Ad Listing Silver', 'Sell-Websites', '200', '200', 'website', 'domains.svg', 1),
(4, 'Regular Listing', 'Sell-Websites', '120', '122', 'website', 'domains.svg', 1),
(5, 'Sponsor Listing 30 days', 'Sponsor Listing  for 30 days', '30', '30', 'sponsored', 'sponsor.svg', 1),
(6, 'Regular Listing', 'Sell-Websites', '0', '7', 'website', 'domains.svg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_message`
--

CREATE TABLE `tbl_message` (
  `id` bigint(20) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `view_status` int(11) NOT NULL COMMENT '1=viewed,0=not viewed',
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_months`
--

CREATE TABLE `tbl_months` (
  `id` int(11) NOT NULL,
  `mon` varchar(250) NOT NULL,
  `month` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_months`
--

INSERT INTO `tbl_months` (`id`, `mon`, `month`) VALUES
(1, 'Jan', 'January'),
(2, 'Feb', 'February'),
(3, 'Mar', 'March'),
(4, 'Apr', 'April'),
(5, 'May', 'May'),
(6, 'Jun', 'June'),
(7, 'Jul', 'July'),
(8, 'Aug', 'August'),
(9, 'Sep', 'September'),
(10, 'Oct', 'October'),
(11, 'Nov', 'November'),
(12, 'Dec', 'December');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notifications`
--

CREATE TABLE `tbl_notifications` (
  `id` int(11) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `notification` text NOT NULL,
  `url` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL,
  `view_status` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_offers`
--

CREATE TABLE `tbl_offers` (
  `id` int(11) NOT NULL,
  `listing_id` int(11) NOT NULL,
  `listing_type` varchar(250) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `offer_amount` float NOT NULL,
  `offer_msg` text NOT NULL,
  `offer_status` int(11) NOT NULL COMMENT '0=pending,1=rejected,2=approved,3=canceled,6=contract opened',
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_opens`
--

CREATE TABLE `tbl_opens` (
  `id` int(11) NOT NULL,
  `contract_id` varchar(250) NOT NULL,
  `listing_id` int(11) NOT NULL,
  `bid_id` varchar(250) NOT NULL COMMENT 'was int',
  `type` varchar(30) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `delivery_time` datetime NOT NULL,
  `delivery` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=pending,1=paid,2=support,3=canceled,4=done,5=delivered,6=revision,7=accept cancel by seller,8=reject cancel request by seller,9=raised a dispute',
  `remarks` text,
  `date` datetime NOT NULL,
  `percentage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pages`
--

CREATE TABLE `tbl_pages` (
  `page_id` int(11) NOT NULL,
  `txt_page_title` varchar(250) NOT NULL,
  `txt_page_meta_description` varchar(250) NOT NULL,
  `txt_page_meta_keywords` text NOT NULL,
  `txt_page_url_slug` varchar(250) NOT NULL,
  `txt_page_description` longtext NOT NULL,
  `page_visibility_group` varchar(250) NOT NULL,
  `page_visibility_status` int(2) NOT NULL COMMENT '1=active,0=inactive',
  `date` datetime NOT NULL,
  `p_status` int(11) NOT NULL DEFAULT '0' COMMENT '1=permanent,0=dynamic '
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pages`
--

INSERT INTO `tbl_pages` (`page_id`, `txt_page_title`, `txt_page_meta_description`, `txt_page_meta_keywords`, `txt_page_url_slug`, `txt_page_description`, `page_visibility_group`, `page_visibility_status`, `date`, `p_status`) VALUES
(5, 'What is Lorem Ipsum?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dumm                          ', '[\"Lorem Ipsum\",\" dummy                         \"]', 'what-is-lorem-ipsum', '<p><strong style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p><p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"><br></span></p><h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; line-height: 24px; font-family: DauphinPlain; font-size: 24px; color: rgb(0, 0, 0);\">Where does it come from?</h2><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><p>                          </p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\"><br></p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.<br></p>', 'all', 1, '2020-03-29 07:59:11', 0),
(6, 'Terms of service', 'Welcome to www.lorem-ipsum.info. This site is provided as a service to our visitors and may be used for informational purpos                          ', '[\"terms of services\"]', 'terms-of-service', '<h1 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; text-align: start; font-weight: bold !important;\">Terms and Conditions</h1><h1 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; text-align: start; font-weight: bold !important;\">General Site Usage</h1><p style=\"font-family: &quot;Times New Roman&quot;; font-size: medium;\">Last Revised: December 16, 2013</p><p style=\"font-family: &quot;Times New Roman&quot;; font-size: medium;\">Welcome to www.lorem-ipsum.info. This site is provided as a service to our visitors and may be used for informational purposes only. Because the Terms and Conditions contain legal obligations, please read them carefully.</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; font-weight: bold !important;\">1. YOUR AGREEMENT</h2><p style=\"font-family: &quot;Times New Roman&quot;; font-size: medium;\">By using this Site, you agree to be bound by, and to comply with, these Terms and Conditions. If you do not agree to these Terms and Conditions, please do not use this site.</p><blockquote style=\"font-family: &quot;Times New Roman&quot;; font-size: medium;\">PLEASE NOTE: We reserve the right, at our sole discretion, to change, modify or otherwise alter these Terms and Conditions at any time. Unless otherwise indicated, amendments will become effective immediately. Please review these Terms and Conditions periodically. Your continued use of the Site following the posting of changes and/or modifications will constitute your acceptance of the revised Terms and Conditions and the reasonableness of these standards for notice of changes. For your information, this page was last updated as of the date at the top of these terms and conditions.</blockquote><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; font-weight: bold !important;\">2. PRIVACY</h2><p style=\"font-family: &quot;Times New Roman&quot;; font-size: medium;\">Please review our Privacy Policy, which also governs your visit to this Site, to understand our practices.</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; font-weight: bold !important;\">3. LINKED SITES</h2><p style=\"font-family: &quot;Times New Roman&quot;; font-size: medium;\">This Site may contain links to other independent third-party Web sites (\"Linked Sites”). These Linked Sites are provided solely as a convenience to our visitors. Such Linked Sites are not under our control, and we are not responsible for and does not endorse the content of such Linked Sites, including any information or materials contained on such Linked Sites. You will need to make your own independent judgment regarding your interaction with these Linked Sites.</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; font-weight: bold !important;\">4. FORWARD LOOKING STATEMENTS</h2><p style=\"font-family: &quot;Times New Roman&quot;; font-size: medium;\">All materials reproduced on this site speak as of the original date of publication or filing. The fact that a document is available on this site does not mean that the information contained in such document has not been modified or superseded by events or by a subsequent document or filing. We have no duty or policy to update any information or statements contained on this site and, therefore, such information or statements should not be relied upon as being current as of the date you access this site.</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; font-weight: bold !important;\">5. DISCLAIMER OF WARRANTIES AND LIMITATION OF LIABILITY</h2><p style=\"font-family: &quot;Times New Roman&quot;; font-size: medium;\">A. THIS SITE MAY CONTAIN INACCURACIES AND TYPOGRAPHICAL ERRORS. WE DOES NOT WARRANT THE ACCURACY OR COMPLETENESS OF THE MATERIALS OR THE RELIABILITY OF ANY ADVICE, OPINION, STATEMENT OR OTHER INFORMATION DISPLAYED OR DISTRIBUTED THROUGH THE SITE. YOU EXPRESSLY UNDERSTAND AND AGREE THAT: (i) YOUR USE OF THE SITE, INCLUDING ANY RELIANCE ON ANY SUCH OPINION, ADVICE, STATEMENT, MEMORANDUM, OR INFORMATION CONTAINED HEREIN, SHALL BE AT YOUR SOLE RISK; (ii) THE SITE IS PROVIDED ON AN \"AS IS\" AND \"AS AVAILABLE\" BASIS; (iii) EXCEPT AS EXPRESSLY PROVIDED HEREIN WE DISCLAIM ALL WARRANTIES OF ANY KIND, WHETHER EXPRESS OR IMPLIED, INCLUDING, BUT NOT LIMITED TO IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, WORKMANLIKE EFFORT, TITLE AND NON-INFRINGEMENT; (iv) WE MAKE NO WARRANTY WITH RESPECT TO THE RESULTS THAT MAY BE OBTAINED FROM THIS SITE, THE PRODUCTS OR SERVICES ADVERTISED OR OFFERED OR MERCHANTS INVOLVED; (v) ANY MATERIAL DOWNLOADED OR OTHERWISE OBTAINED THROUGH THE USE OF THE SITE IS DONE AT YOUR OWN DISCRETION AND RISK; and (vi) YOU WILL BE SOLELY RESPONSIBLE FOR ANY DAMAGE TO YOUR COMPUTER SYSTEM OR FOR ANY LOSS OF DATA THAT RESULTS FROM THE DOWNLOAD OF ANY SUCH MATERIAL.</p><p style=\"font-family: &quot;Times New Roman&quot;; font-size: medium;\">B. YOU UNDERSTAND AND AGREE THAT UNDER NO CIRCUMSTANCES, INCLUDING, BUT NOT LIMITED TO, NEGLIGENCE, SHALL WE BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, PUNITIVE OR CONSEQUENTIAL DAMAGES THAT RESULT FROM THE USE OF, OR THE INABILITY TO USE, ANY OF OUR SITES OR MATERIALS OR FUNCTIONS ON ANY SUCH SITE, EVEN IF WE HAVE BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. THE FOREGOING LIMITATIONS SHALL APPLY NOTWITHSTANDING ANY FAILURE OF ESSENTIAL PURPOSE OF ANY LIMITED REMEDY.</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; font-weight: bold !important;\">6. EXCLUSIONS AND LIMITATIONS</h2><p style=\"font-family: &quot;Times New Roman&quot;; font-size: medium;\">SOME JURISDICTIONS DO NOT ALLOW THE EXCLUSION OF CERTAIN WARRANTIES OR THE LIMITATION OR EXCLUSION OF LIABILITY FOR INCIDENTAL OR CONSEQUENTIAL DAMAGES. ACCORDINGLY, OUR LIABILITY IN SUCH JURISDICTION SHALL BE LIMITED TO THE MAXIMUM EXTENT PERMITTED BY LAW.</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; font-weight: bold !important;\">7. OUR PROPRIETARY RIGHTS</h2><p style=\"font-family: &quot;Times New Roman&quot;; font-size: medium;\">This Site and all its Contents are intended solely for personal, non-commercial use. Except as expressly provided, nothing within the Site shall be construed as conferring any license under our or any third party\'s intellectual property rights, whether by estoppel, implication, waiver, or otherwise. Without limiting the generality of the foregoing, you acknowledge and agree that all content available through and used to operate the Site and its services is protected by copyright, trademark, patent, or other proprietary rights. You agree not to: (a) modify, alter, or deface any of the trademarks, service marks, trade dress (collectively \"Trademarks\") or other intellectual property made available by us in connection with the Site; (b) hold yourself out as in any way sponsored by, affiliated with, or endorsed by us, or any of our affiliates or service providers; (c) use any of the Trademarks or other content accessible through the Site for any purpose other than the purpose for which we have made it available to you; (d) defame or disparage us, our Trademarks, or any aspect of the Site; and (e) adapt, translate, modify, decompile, disassemble, or reverse engineer the Site or any software or programs used in connection with it or its products and services.</p><p style=\"font-family: &quot;Times New Roman&quot;; font-size: medium;\">The framing, mirroring, scraping or data mining of the Site or any of its content in any form and by any method is expressly prohibited.</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; font-weight: bold !important;\">8. INDEMNITY</h2><p style=\"font-family: &quot;Times New Roman&quot;; font-size: medium;\">By using the Site web sites you agree to indemnify us and affiliated entities (collectively \"Indemnities\") and hold them harmless from any and all claims and expenses, including (without limitation) attorney\'s fees, arising from your use of the Site web sites, your use of the Products and Services, or your submission of ideas and/or related materials to us or from any person\'s use of any ID, membership or password you maintain with any portion of the Site, regardless of whether such use is authorized by you.</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; font-weight: bold !important;\">9. COPYRIGHT AND TRADEMARK NOTICE</h2><p style=\"font-family: &quot;Times New Roman&quot;; font-size: medium;\">Except our generated dummy copy, which is free to use for private and commercial use, all other text is copyrighted. generator.lorem-ipsum.info © 2013, all rights reserved</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; font-weight: bold !important;\">10. INTELLECTUAL PROPERTY INFRINGEMENT CLAIMS</h2><p style=\"font-family: &quot;Times New Roman&quot;; font-size: medium;\">It is our policy to respond expeditiously to claims of intellectual property infringement. We will promptly process and investigate notices of alleged infringement and will take appropriate actions under the Digital Millennium Copyright Act (\"DMCA\") and other applicable intellectual property laws. Notices of claimed infringement should be directed to:</p><p style=\"font-family: &quot;Times New Roman&quot;; font-size: medium;\">generator.lorem-ipsum.info</p><p style=\"font-family: &quot;Times New Roman&quot;; font-size: medium;\">126 Electricov St.</p><p style=\"font-family: &quot;Times New Roman&quot;; font-size: medium;\">Kiev, Kiev 04176</p><p style=\"font-family: &quot;Times New Roman&quot;; font-size: medium;\">Ukraine</p><p style=\"font-family: &quot;Times New Roman&quot;; font-size: medium;\">contact@lorem-ipsum.info</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; font-weight: bold !important;\">11. PLACE OF PERFORMANCE</h2><p style=\"font-family: &quot;Times New Roman&quot;; font-size: medium;\">This Site is controlled, operated and administered by us from our office in Kiev, Ukraine. We make no representation that materials at this site are appropriate or available for use at other locations outside of the Ukraine and access to them from territories where their contents are illegal is prohibited. If you access this Site from a location outside of the Ukraine, you are responsible for compliance with all local laws.</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; font-weight: bold !important;\">12. GENERAL</h2><p style=\"font-family: &quot;Times New Roman&quot;; font-size: medium;\">A. If any provision of these Terms and Conditions is held to be invalid or unenforceable, the provision shall be removed (or interpreted, if possible, in a manner as to be enforceable), and the remaining provisions shall be enforced. Headings are for reference purposes only and in no way define, limit, construe or describe the scope or extent of such section. Our failure to act with respect to a breach by you or others does not waive our right to act with respect to subsequent or similar breaches. These Terms and Conditions set forth the entire understanding and agreement between us with respect to the subject matter contained herein and supersede any other agreement, proposals and communications, written or oral, between our representatives and you with respect to the subject matter hereof, including any terms and conditions on any of customer\'s documents or purchase orders.</p><p style=\"font-family: &quot;Times New Roman&quot;; font-size: medium;\">B. No Joint Venture, No Derogation of Rights. You agree that no joint venture, partnership, employment, or agency relationship exists between you and us as a result of these Terms and Conditions or your use of the Site. Our performance of these Terms and Conditions is subject to existing laws and legal process, and nothing contained herein is in derogation of our right to comply with governmental, court and law enforcement requests or requirements relating to your use of the Site or information provided to or gathered by us with respect to such use.</p>                          ', 'all', 1, '2020-03-29 07:46:49', 1),
(7, 'Privacy Policy', 'Privacy Policy', '[\"    DMCA                       \"]', 'privacy-policy', '<h2 style=\"margin: 10px 0px 15px; font-family: Arial, Helvetica, sans-serif; line-height: 40px; color: rgb(119, 119, 119); text-rendering: optimizelegibility; background-color: rgb(253, 253, 253); font-size: 12px !important;\">Sample Copyright Complaint Steps</h2><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; font-size: 1.1em; line-height: 1.5em; color: rgb(119, 119, 119); font-family: Arial, Helvetica, sans-serif; background-color: rgb(253, 253, 253);\">Dummy Solutions requires DMCA notices to be filed via fax or letter. The complaint must include full contact information in the complaint (including phone number). We will call and verify. Email (unless digitally signed by a verified and trusted third party) is not an acceptable medium for legal complaints. This ticket system has received what appears to be a possible DMCA complaint, but one or more of the following are missing: (a) the complaint does not contain sufficient information (b) the format of the complaint is inconsistent with the requirements of the DMCA (c) the complaint has been submitted via email without proper authentication (d) full contact information is missing. We will need you to re-submit your claim, using the proper format, including sufficient details, via postal mail or fax. Instructions on how to do so follow.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; font-size: 1.1em; line-height: 1.5em; color: rgb(119, 119, 119); font-family: Arial, Helvetica, sans-serif; background-color: rgb(253, 253, 253);\">It is our policy to respond to clear notices of alleged copyright infringement. This response describes the information that should be present in these notices. It is designed to make submitting notices of alleged infringement to us as straightforward as possible while reducing the number of notices that we receive that are fraudulent or difficult to understand or verify. The form of notice specified below is consistent with the form suggested by the United States Digital Millennium Copyright Act (the text of which can be found at the U.S. Copyright Office Web Site,&nbsp;<a href=\"http://www.copyright.gov/\" style=\"color: rgb(35, 99, 144);\">http://www.copyright.gov</a>) but we will respond to notices of this form from other jurisdictions as well.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; font-size: 1.1em; line-height: 1.5em; color: rgb(119, 119, 119); font-family: Arial, Helvetica, sans-serif; background-color: rgb(253, 253, 253);\">To&nbsp;file a notice of infringement&nbsp;with us, you must provide a written communication that sets forth the items specified below. Please note that you will be liable for damages (including costs and attorneys’ fees) if you materially misrepresent that a product or activity is infringing your copyrights. Accordingly, if you are not sure whether material available online infringes your copyright, we suggest that you first contact an attorney.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; font-size: 1.1em; line-height: 1.5em; color: rgb(119, 119, 119); font-family: Arial, Helvetica, sans-serif; background-color: rgb(253, 253, 253);\">Identify in sufficient detail the copyrighted work that you believe has been infringed upon (for example, “The copyrighted work at issue is the text that appears on&nbsp;<a href=\"https://www.dummysolutions.com/terms-of-service/\" style=\"color: rgb(35, 99, 144);\">https://www.dummysolutions.com/<strong style=\"font-weight: bold;\">terms-of-service</strong>/</a>“) or other information sufficient to specify the copyrighted work being infringed (for example, “The copyrighted work at issue is ‘Intellectual Property: Valuation, Exploitation, and Infringement Damages’ by Gordon V. Smith, published by Wiley, ISBN #047168323X”).</p><ol style=\"padding: 0px; margin-right: 0px; margin-bottom: 25px; margin-left: 2.9em; list-style-position: inside; color: rgb(119, 119, 119); font-family: Arial, Helvetica, sans-serif; font-size: 14px; background-color: rgb(253, 253, 253);\"><li style=\"line-height: 20px;\">Identify the material that you claim is infringing the copyrighted work listed in item #1 above. You must identify each web page that allegedly contains infringing material. This requires you to provide the URL for each allegedly infringing result, document, or item.</li></ol><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; font-size: 1.1em; line-height: 1.5em; color: rgb(119, 119, 119); font-family: Arial, Helvetica, sans-serif; background-color: rgb(253, 253, 253);\">An example:<br>Infringing Web Pages:<br>http://www.thewebsite.com/directory/<br>http://www.thewebsite.com/something/blah.html</p><ol start=\"2\" style=\"padding: 0px; margin-right: 0px; margin-bottom: 25px; margin-left: 2.9em; list-style-position: inside; color: rgb(119, 119, 119); font-family: Arial, Helvetica, sans-serif; font-size: 14px; background-color: rgb(253, 253, 253);\"><li style=\"line-height: 20px;\">Provide information reasonably sufficient to permit us to contact you.</li><li style=\"line-height: 20px;\">Provide information, if possible, sufficient to permit us to notify the owner/administrator of the allegedly infringing webpage or other content (email address is preferred).</li><li style=\"line-height: 20px;\">Include the following statement: I have a good faith belief that use of the copyrighted materials described above as allegedly infringing is not authorized by the copyright owner, its agent, or the law.</li><li style=\"line-height: 20px;\">Include the following statement: I swear, under penalty of perjury, that the information in the notification is accurate and that I am the copyright owner or am authorized to act on behalf of the owner of an exclusive right that is allegedly infringed.</li><li style=\"line-height: 20px;\">Sign the paper.</li><li style=\"line-height: 20px;\">For the fastest processing and response, we ask that DMCA complaints be submitted through our online form at</li></ol><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; font-size: 1.1em; line-height: 1.5em; color: rgb(119, 119, 119); font-family: Arial, Helvetica, sans-serif; background-color: rgb(253, 253, 253);\">Please allow routing and scanning time for mailed DMCA complaints.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; font-size: 1.1em; line-height: 1.5em; color: rgb(119, 119, 119); font-family: Arial, Helvetica, sans-serif; background-color: rgb(253, 253, 253);\">Regardless of whether we may be liable for such infringement under local country law or United States law, we may respond to these notices by removing or disabling access to material claimed to infringe and/or terminating users of our services. If we remove or disable access in response to such a notice, we will make a good-faith attempt to contact the owner or administrator of the affected site or content so that the owner or administrator may make a counter notification.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; font-size: 1.1em; line-height: 1.5em; color: rgb(119, 119, 119); font-family: Arial, Helvetica, sans-serif; background-color: rgb(253, 253, 253);\">We may also document notices of alleged infringement on which we act. As with all legal notices, a copy of the notice may be made available to the public and sent to one or more third parties who may make it available to the public.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; font-size: 1.1em; line-height: 1.5em; color: rgb(119, 119, 119); font-family: Arial, Helvetica, sans-serif; background-color: rgb(253, 253, 253);\">In order to ensure that copyright owners do not wrongly insist on the removal of materials that actually do not infringe their copyrights, the safe harbor provisions require service providers to notify the subscribers if their materials have been removed and to provide them with an opportunity to send a written notice to the service provider stating that the material has been wrongly removed. [512(g)]</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; font-size: 1.1em; line-height: 1.5em; color: rgb(119, 119, 119); font-family: Arial, Helvetica, sans-serif; background-color: rgb(253, 253, 253);\">If a subscriber provides a proper “counter-notice” claiming that the material does not infringe copyrights, the service provider must then promptly notify the claiming party of the individual’s objection. [512(g)(2)] If the copyright owner does not bring a lawsuit in district court within 14 days, the service provider is then required to restore the material to its location on its network. [512(g)(2)(C)]</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; font-size: 1.1em; line-height: 1.5em; color: rgb(119, 119, 119); font-family: Arial, Helvetica, sans-serif; background-color: rgb(253, 253, 253);\">If it is determined that the copyright holder misrepresented its claim regarding the infringing material, the copyright holder then becomes liable to the OSP for any damages that resulted from the improper removal of the material. [512(f)]</p>                          ', '\"all\"', 1, '2019-09-20 06:52:36', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payments`
--

CREATE TABLE `tbl_payments` (
  `ID` int(11) NOT NULL,
  `PAYMENT_ID` varchar(250) NOT NULL,
  `AMOUNT` varchar(250) NOT NULL,
  `METHOD` varchar(250) NOT NULL,
  `ACK` varchar(250) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `TIMESTAMP` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `PLAN_ID` int(11) NOT NULL,
  `TOKEN` text NOT NULL,
  `PAYMENTINFO_0_TRANSACTIONID` text NOT NULL,
  `CORRELATIONID` text NOT NULL,
  `PAYER_ID` text NOT NULL,
  `PAYMENTINFO_0_TRANSACTIONTYPE` varchar(250) NOT NULL,
  `PAYMENTINFO_0_FEEAMT` varchar(250) NOT NULL,
  `PAYMENTINFO_0_PAYMENTTYPE` varchar(250) NOT NULL,
  `PAYMENTINFO_0_TAXAMT` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_settings`
--

CREATE TABLE `tbl_payment_settings` (
  `id` int(11) NOT NULL,
  `paymentgateway_id` varchar(250) NOT NULL,
  `method` varchar(250) NOT NULL,
  `payment_currency` varchar(4) NOT NULL DEFAULT 'USD',
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `signature` text NOT NULL,
  `icon_url` text NOT NULL,
  `sandbox` varchar(20) NOT NULL DEFAULT 'false',
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '0=inactive,1=active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_payment_settings`
--

INSERT INTO `tbl_payment_settings` (`id`, `paymentgateway_id`, `method`, `payment_currency`, `username`, `password`, `signature`, `icon_url`, `sandbox`, `status`) VALUES
(1, 'PayPal_Express', 'PAYPAL EXPRESS', 'USD', 'ganeendra2_api1.gmail.com', 'BKXE2ZDRQ7DLAME5', 'AGdDhbqLhOGuxL72HCkHfEcIDjyXAXADfzAF4LbU2rzMR8T8XjKvwo1V', 'https://i.imgur.com/ApBxkXU.png', 'true', 1),
(2, 'PayPal_Pro', 'PAYPAL PRO', 'USD', 'ganeendra2-1_api1.gmail.com', 'HP4HSJE9WWPTFW4A', 'AS65SPuCW7w3RM8ztW6KCiOQGW-YANesDwxBtovWxhbbvhg1CbZERHP4', 'https://i.imgur.com/IHEKLgm.png', 'true', 1),
(3, 'Stripe', 'STRIPE', 'USD', '', '', 'sk_test_sdSeeTpG7rRBWYdtwBzeHWY0009XfIiYmw', 'https://img.favpng.com/4/21/2/stripe-logo-computer-icons-payment-png-favpng-Xv9idVp1sbtXNBadUeuNFaQW5.jpg', 'true', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_platforms`
--

CREATE TABLE `tbl_platforms` (
  `id` int(11) NOT NULL,
  `platform` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `type` varchar(250) NOT NULL,
  `icon` text NOT NULL,
  `version` varchar(250) NOT NULL,
  `radio` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_platforms`
--

INSERT INTO `tbl_platforms` (`id`, `platform`, `name`, `type`, `icon`, `version`, `radio`, `description`, `status`, `updated`) VALUES
(1, 'domain', 'Domain', 'listing', 'domains.svg', 'v1.2', 'Sell-Domains', 'Domain names that are undeveloped or parked. (Only the domain)', 1, '2020-05-25 03:19:34'),
(2, 'website', 'Websites', 'listing', 'website.svg', 'v1.2', 'Sell-Websites', 'Which are currently trading and is generating revenue.', 1, '2020-05-27 16:54:08'),
(3, 'auction', 'Auction', 'option', 'auction.svg', 'v1.2', 'auction', 'Post the ad and let buyers places the Bids.', 1, '2020-05-25 03:19:58'),
(4, 'classified', 'Classified', 'option', 'classified.svg', 'v1.2', 'classified', 'Post the ad and let people make offers', 1, '2020-05-27 16:54:11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchases`
--

CREATE TABLE `tbl_purchases` (
  `id` int(11) NOT NULL,
  `invoice_id` varchar(250) NOT NULL,
  `user_id` varchar(250) NOT NULL,
  `plan_id` varchar(25) NOT NULL,
  `plan_header` int(11) NOT NULL,
  `listing_type` varchar(250) NOT NULL,
  `purchase_date` datetime NOT NULL,
  `expire_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reports`
--

CREATE TABLE `tbl_reports` (
  `id` int(11) NOT NULL,
  `listing_id` int(11) NOT NULL,
  `reporter` int(11) NOT NULL,
  `reason` text NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=pending,1=approved,2=rejected',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reviews`
--

CREATE TABLE `tbl_reviews` (
  `id` int(11) NOT NULL,
  `reviewer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review` text NOT NULL,
  `ratings` int(11) NOT NULL,
  `type` varchar(250) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=on,0=off',
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `id` int(11) NOT NULL DEFAULT '1',
  `user_email_activation` int(11) NOT NULL DEFAULT '0' COMMENT '1=active,0=inactive',
  `admin_email` varchar(250) NOT NULL,
  `admin_email_copy` varchar(250) NOT NULL,
  `json_key_file` text NOT NULL,
  `title` varchar(250) NOT NULL,
  `site_meta_keywords` text NOT NULL,
  `site_meta_description` varchar(250) NOT NULL,
  `ssl_enable` int(11) NOT NULL DEFAULT '0',
  `user_facebook` varchar(250) NOT NULL DEFAULT '',
  `user_twitter` varchar(250) NOT NULL DEFAULT '',
  `user_Instagram` varchar(250) NOT NULL DEFAULT '',
  `user_github` varchar(250) NOT NULL DEFAULT '',
  `user_google` varchar(250) NOT NULL DEFAULT '',
  `user_youtube` varchar(250) NOT NULL DEFAULT '',
  `blacklisted_domains` text NOT NULL,
  `commission_based` int(2) NOT NULL COMMENT '1=0n,0=direct',
  `withdrawal_options` text NOT NULL,
  `default_currency` varchar(4) NOT NULL,
  `show_expired_records` int(11) NOT NULL COMMENT '1=0n,0=off',
  `activate_one_listing_per_domain` int(11) NOT NULL DEFAULT '1' COMMENT '1=0n,0=off',
  `monetization_methods` text NOT NULL,
  `auction_period` int(30) NOT NULL,
  `bid_value_gap` int(4) NOT NULL,
  `hold_bidding_until_approval` int(11) NOT NULL DEFAULT '1' COMMENT '1=0n,0=off',
  `allow_approvedbidder_tobid` int(11) NOT NULL COMMENT '1=0n,0=off',
  `allow_multiple_bidding` int(11) NOT NULL COMMENT '1=0n,0=off',
  `hide_useremail` int(2) NOT NULL COMMENT '1=0n,0=off',
  `sale_commission` varchar(250) NOT NULL,
  `processing_fee` float NOT NULL,
  `mark_as_completed` int(2) NOT NULL,
  `image_thumbnails` int(11) NOT NULL COMMENT '1=on,0=off',
  `office_add1` varchar(250) NOT NULL DEFAULT '',
  `office_add2` varchar(250) NOT NULL DEFAULT '',
  `office_tel` varchar(250) NOT NULL DEFAULT '',
  `office_email` varchar(250) NOT NULL DEFAULT '',
  `google_analytics` text NOT NULL,
  `email_notifications` int(11) NOT NULL COMMENT '1=active,0=inactive',
  `active_domain_verification` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `user_email_activation`, `admin_email`, `admin_email_copy`, `json_key_file`, `title`, `site_meta_keywords`, `site_meta_description`, `ssl_enable`, `user_facebook`, `user_twitter`, `user_Instagram`, `user_github`, `user_google`, `user_youtube`, `blacklisted_domains`, `commission_based`, `withdrawal_options`, `default_currency`, `show_expired_records`, `activate_one_listing_per_domain`, `monetization_methods`, `auction_period`, `bid_value_gap`, `hold_bidding_until_approval`, `allow_approvedbidder_tobid`, `allow_multiple_bidding`, `hide_useremail`, `sale_commission`, `processing_fee`, `mark_as_completed`, `image_thumbnails`, `office_add1`, `office_add2`, `office_tel`, `office_email`, `google_analytics`, `email_notifications`, `active_domain_verification`) VALUES
(1, 1, 'ganeendra1@gmail.com', '', 'client_secret_342164653196-q2g1t2og71vrj55mfk87r1dvhh1plb3g.apps.googleusercontent.com.json', 'slippa', '', '', 0, '111', '1111', '111', '111', '111', '1111', '[\"google.com\"]', 0, '[\"Paypal\",\"Payoneer\",\"Escrow\",\"Wire\"]', 'USD', 0, 0, '{\"0\":{\"name\":\"ad sense\",\"value\":\"ads\"},\"1\":{\"name\":\"subscriptions\",\"value\":\"subscribe\"}}', 14, 50, 1, 1, 1, 0, '20', 2, 3, 0, 'No 139, High Level Road, Nugegoda', 'Sri Lanka', '0779252642', 'ganeendra1@gmail.com', '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_siteimages`
--

CREATE TABLE `tbl_siteimages` (
  `id` int(11) NOT NULL DEFAULT '1',
  `sitelogo` varchar(250) NOT NULL,
  `favicon` varchar(250) NOT NULL,
  `homepage` varchar(250) NOT NULL,
  `mainback` varchar(250) NOT NULL,
  `invoice_logo` varchar(250) NOT NULL,
  `loader` text NOT NULL,
  `backgrounds` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_siteimages`
--

INSERT INTO `tbl_siteimages` (`id`, `sitelogo`, `favicon`, `homepage`, `mainback`, `invoice_logo`, `loader`, `backgrounds`) VALUES
(1, 'Logo_-small.png', 'Thumbnail.png', 'breadcump-img-red-dark.png', 'bn2.jpg', 'Logo-color.png', 'loadingimage.gif', 'breadcump-img-red-dark-2.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `thumbnail` varchar(250) NOT NULL,
  `cover_pic` varchar(250) NOT NULL,
  `user_country` varchar(10) NOT NULL,
  `user_review` int(11) NOT NULL,
  `password` text NOT NULL,
  `user_membership_id` varchar(250) NOT NULL,
  `user_membership_timestamp` datetime NOT NULL,
  `user_membership_timestamp_expiry` datetime NOT NULL,
  `user_ip` varchar(250) NOT NULL,
  `user_status` int(11) NOT NULL DEFAULT '1' COMMENT '1=created,2=activated,3=banned,4=deactivated',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hour_started` int(11) NOT NULL DEFAULT '0',
  `token` text NOT NULL,
  `user_level` int(11) NOT NULL DEFAULT '1' COMMENT '0=admin,1=user',
  `social_twitter` varchar(250) NOT NULL,
  `social_github` varchar(250) NOT NULL,
  `social_facebook` varchar(250) NOT NULL,
  `social_youtube` varchar(250) NOT NULL,
  `user_metadescription` varchar(250) NOT NULL,
  `user_description` text NOT NULL,
  `online` int(11) NOT NULL,
  `paypal` text,
  `payoneer` text,
  `bank_transfer` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `username`, `firstname`, `lastname`, `email`, `thumbnail`, `cover_pic`, `user_country`, `user_review`, `password`, `user_membership_id`, `user_membership_timestamp`, `user_membership_timestamp_expiry`, `user_ip`, `user_status`, `date`, `hour_started`, `token`, `user_level`, `social_twitter`, `social_github`, `social_facebook`, `social_youtube`, `user_metadescription`, `user_description`, `online`, `paypal`, `payoneer`, `bank_transfer`) VALUES
(1, 'admin', 'Admin', '', 'ganeendra1@gmail.com', 'user.png', '', '', 0, '92629907af09a161adc065b74562a4a6', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '::1', 2, '2020-05-27 16:50:39', 0, 'kww0408o008kc0swokc4osgkw0cco04ow8wgckws', 0, '', '', '', '', '', '', 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_ip`
--

CREATE TABLE `tbl_user_ip` (
  `id` int(11) NOT NULL,
  `user_ip` text NOT NULL,
  `count` int(11) NOT NULL,
  `datetime` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_withdrawals`
--

CREATE TABLE `tbl_withdrawals` (
  `id` int(11) NOT NULL,
  `withdrawal_id` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL,
  `amount` float NOT NULL,
  `fee` float NOT NULL,
  `final_amount` float NOT NULL,
  `method` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=pending,1=approved,2=paid,3=rejected'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_withdrawal_methods`
--

CREATE TABLE `tbl_withdrawal_methods` (
  `id` int(11) NOT NULL,
  `method` varchar(250) NOT NULL,
  `threshold` float NOT NULL,
  `fee` float NOT NULL,
  `cal_meth` int(11) NOT NULL COMMENT '1=percentage,0=amount',
  `status` int(11) NOT NULL COMMENT '1=on,0=off'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_withdrawal_methods`
--

INSERT INTO `tbl_withdrawal_methods` (`id`, `method`, `threshold`, `fee`, `cal_meth`, `status`) VALUES
(1, 'Paypal', 20, 1, 0, 1),
(2, 'Payoneer', 50, 5, 1, 1),
(3, 'Bank Transfer', 200, 30, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_ads`
--
ALTER TABLE `tbl_ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_announcement`
--
ALTER TABLE `tbl_announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_bids`
--
ALTER TABLE `tbl_bids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_blog`
--
ALTER TABLE `tbl_blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_contracts`
--
ALTER TABLE `tbl_contracts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_coupons`
--
ALTER TABLE `tbl_coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_cron`
--
ALTER TABLE `tbl_cron`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_disputes`
--
ALTER TABLE `tbl_disputes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_domains`
--
ALTER TABLE `tbl_domains`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_domain_purchases`
--
ALTER TABLE `tbl_domain_purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_history`
--
ALTER TABLE `tbl_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_invoices`
--
ALTER TABLE `tbl_invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_languages`
--
ALTER TABLE `tbl_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_listings`
--
ALTER TABLE `tbl_listings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_listing_header`
--
ALTER TABLE `tbl_listing_header`
  ADD PRIMARY KEY (`listing_id`);

--
-- Indexes for table `tbl_message`
--
ALTER TABLE `tbl_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_months`
--
ALTER TABLE `tbl_months`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_offers`
--
ALTER TABLE `tbl_offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_opens`
--
ALTER TABLE `tbl_opens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pages`
--
ALTER TABLE `tbl_pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_payment_settings`
--
ALTER TABLE `tbl_payment_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_platforms`
--
ALTER TABLE `tbl_platforms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_purchases`
--
ALTER TABLE `tbl_purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reports`
--
ALTER TABLE `tbl_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reviews`
--
ALTER TABLE `tbl_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_siteimages`
--
ALTER TABLE `tbl_siteimages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_user_ip`
--
ALTER TABLE `tbl_user_ip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_withdrawals`
--
ALTER TABLE `tbl_withdrawals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_withdrawal_methods`
--
ALTER TABLE `tbl_withdrawal_methods`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_ads`
--
ALTER TABLE `tbl_ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_announcement`
--
ALTER TABLE `tbl_announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_bids`
--
ALTER TABLE `tbl_bids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_blog`
--
ALTER TABLE `tbl_blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_contracts`
--
ALTER TABLE `tbl_contracts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tbl_coupons`
--
ALTER TABLE `tbl_coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_cron`
--
ALTER TABLE `tbl_cron`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_disputes`
--
ALTER TABLE `tbl_disputes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_domains`
--
ALTER TABLE `tbl_domains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_domain_purchases`
--
ALTER TABLE `tbl_domain_purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_history`
--
ALTER TABLE `tbl_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_invoices`
--
ALTER TABLE `tbl_invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_languages`
--
ALTER TABLE `tbl_languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_listings`
--
ALTER TABLE `tbl_listings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_listing_header`
--
ALTER TABLE `tbl_listing_header`
  MODIFY `listing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_message`
--
ALTER TABLE `tbl_message`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_offers`
--
ALTER TABLE `tbl_offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_opens`
--
ALTER TABLE `tbl_opens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_pages`
--
ALTER TABLE `tbl_pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `tbl_payment_settings`
--
ALTER TABLE `tbl_payment_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_platforms`
--
ALTER TABLE `tbl_platforms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_purchases`
--
ALTER TABLE `tbl_purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_reports`
--
ALTER TABLE `tbl_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_reviews`
--
ALTER TABLE `tbl_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_user_ip`
--
ALTER TABLE `tbl_user_ip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_withdrawals`
--
ALTER TABLE `tbl_withdrawals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_withdrawal_methods`
--
ALTER TABLE `tbl_withdrawal_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
