-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2020 at 04:44 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.1.22

--
-- AUTO_INCREMENT for table `tbl_platforms`
--
ALTER TABLE `tbl_settings`
ADD `active_domain_verification` int(11) NOT NULL DEFAULT '0';

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
(1, 'domain', 'Domain', 'listing', 'domains.svg', 'v1.2', 'Sell-Domains', 'Domain names that are undeveloped or parked. (Only the domain)', 1, '2020-05-25 08:49:34'),
(2, 'website', 'Websites', 'listing', 'website.svg', 'v1.2', 'Sell-Websites', 'Which are currently trading and is generating revenue.', 1, '2020-05-25 08:49:34'),
(3, 'auction', 'Auction', 'option', 'auction.svg', 'v1.2', 'auction', 'Post the ad and let buyers places the Bids.', 1, '2020-05-25 08:49:58'),
(4, 'classified', 'Classified', 'option', 'classified.svg', 'v1.2', 'classified', 'Post the ad and let people make offers', 1, '2020-05-25 08:49:58');

-- --------------------------------------------------------

--
-- Indexes for table `tbl_platforms`
--
ALTER TABLE `tbl_platforms`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `tbl_platforms`
--
ALTER TABLE `tbl_platforms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;


