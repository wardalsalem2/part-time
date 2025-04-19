-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2025 at 09:33 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `part_time`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `industry` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `num_employees` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `user_id`, `name`, `description`, `industry`, `website`, `phone`, `email`, `address`, `city`, `num_employees`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'Sara Tech Solutions', 'A tech startup based in Amman, Jordan specializing in mobile apps.', 'Technology', 'https://saratech.jo', '0791112233', 'contact@saratech.jo', 'Shmeisani, Amman', 'Amman', 15, 1, '2025-04-16 04:58:14', '2025-04-16 04:58:14', NULL),
(2, 3, 'Ali Marketing Co.', 'Digital marketing company based in Irbid, Jordan.', 'Marketing', 'https://alimarketing.jo', '0785556677', 'info@alimarketing.jo', 'Wasfi Al-Tal St, Irbid', 'Irbid', 10, 1, '2025-04-16 04:58:14', '2025-04-16 04:58:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Ahmad Alhussein', 'ahmad@example.com', 'Job Inquiry', 'Hello, I am interested in the Web Developer position. Could you provide more details about the job requirements and responsibilities?', '2025-04-16 04:58:14', '2025-04-16 04:58:14'),
(2, 'Sara AlZoubi', 'sara@example.com', 'Product Feedback', 'I recently purchased a product from your store, and I wanted to share my feedback. The quality was great, but the delivery took longer than expected.', '2025-04-16 04:58:14', '2025-04-16 04:58:14'),
(3, 'Rami AlOmar', 'rami@example.com', 'Service Issue', 'I am facing an issue with the mobile app login. Could you assist me in fixing it?', '2025-04-16 04:58:14', '2025-04-16 04:58:14'),
(4, 'Muna AlShammari', 'muna@example.com', 'Event Registration', 'I would like to register for the upcoming event. Can you please send me the registration details and process?', '2025-04-16 04:58:14', '2025-04-16 04:58:14'),
(5, 'Jad AlJadid', 'jad@example.com', 'Collaboration Opportunity', 'I am looking for potential collaboration opportunities with your company. Would you be interested in discussing this further?', '2025-04-16 04:58:14', '2025-04-16 04:58:14'),
(6, 'Huda Kassem', 'huda@example.com', 'Invoice Request', 'Can you please send me the invoice for my recent purchase? I need it for my records.', '2025-04-16 04:58:14', '2025-04-16 04:58:14'),
(7, 'Khaled Abed', 'khaled@example.com', 'Support Request', 'I am having trouble with my account. Please assist me in resetting my password or recovering my account.', '2025-04-16 04:58:14', '2025-04-16 04:58:14'),
(8, 'Nour AlBashir', 'nour@example.com', 'Product Inquiry', 'I am interested in buying a new laptop from your store. Can you recommend the best models within my budget of $1000?', '2025-04-16 04:58:14', '2025-04-16 04:58:14'),
(9, 'Ali ElTayeb', 'ali@example.com', 'Delivery Issue', 'My order arrived damaged, and I would like to request a replacement or refund. Please assist me with this issue.', '2025-04-16 04:58:14', '2025-04-16 04:58:14'),
(10, 'Lama Issa', 'lama@example.com', 'Website Feedback', 'I visited your website, and I think the design could be improved for better navigation. I suggest adding a search feature and clearer product categories.', '2025-04-16 04:58:14', '2025-04-16 04:58:14');

-- --------------------------------------------------------

--
-- Table structure for table `favorite_jobs`
--

CREATE TABLE `favorite_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `job_offer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favorite_jobs`
--

INSERT INTO `favorite_jobs` (`id`, `user_id`, `job_offer_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2025-04-17 08:14:14', '2025-04-17 08:14:14'),
(2, 1, 3, '2025-04-17 08:14:34', '2025-04-17 08:14:34');

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

CREATE TABLE `job_applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profile_id` bigint(20) UNSIGNED NOT NULL,
  `job_offer_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('applied','pending','accepted','rejected') NOT NULL DEFAULT 'applied',
  `cover_letter` text DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_applications`
--

INSERT INTO `job_applications` (`id`, `profile_id`, `job_offer_id`, `status`, `cover_letter`, `resume`, `created_at`, `updated_at`) VALUES
(4, 6, 7, 'applied', 'srdtfyghkjlkchfd', 'resumes/b8M8HjAWGG8k1P2rCtJXLaqg6DSi28bkNpb4uzlB.pdf', '2025-04-16 09:20:57', '2025-04-16 09:20:57'),
(11, 9, 1, 'rejected', 'test', 'resumes/Z2wTdwb7DkLCCoUflKdHdy5LbpzP8GIomqliFr7o.pdf', '2025-04-18 14:54:20', '2025-04-18 15:36:26');

-- --------------------------------------------------------

--
-- Table structure for table `job_offers`
--

CREATE TABLE `job_offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `work_hours` int(11) NOT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `requirements` varchar(255) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `category` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_offers`
--

INSERT INTO `job_offers` (`id`, `company_id`, `title`, `description`, `work_hours`, `salary`, `location`, `requirements`, `deadline`, `is_active`, `category`, `created_at`, `updated_at`) VALUES
(1, 1, 'Web Developer', 'A web developer is needed to work on front-end and back-end development using technologies like PHP, Laravel, JavaScript, and MySQL. The candidate should have a strong understanding of HTML, CSS, and responsive design.', 40, 900.00, 'Amman', 'Experience with Laravel and JavaScript frameworks is required. A portfolio of previous web development projects will be preferred.', '2025-06-30', 1, 'IT', '2025-04-16 04:58:14', '2025-04-16 04:58:14'),
(2, 1, 'Software Engineer', 'We are looking for a passionate software engineer with strong problem-solving skills and experience in backend development, working with Java, Python, or C++.', 40, 950.00, 'Amman', 'Minimum 2 years of experience in software engineering with Java or Python. Understanding of algorithms and data structures is a must.', '2025-07-15', 0, 'IT', '2025-04-16 04:58:14', '2025-04-16 09:31:39'),
(3, 1, 'Mobile App Developer', 'Develop mobile applications for both iOS and Android platforms. Experience with React Native or Flutter is a plus. The candidate should have strong problem-solving and debugging skills.', 35, 850.00, 'Amman', 'Experience in mobile app development, particularly with cross-platform technologies like React Native or Flutter. Portfolio required.', '2025-05-20', 1, 'IT', '2025-04-16 04:58:14', '2025-04-16 04:58:14'),
(4, 1, 'IT Support Specialist', 'We are seeking an IT Support Specialist who will provide technical support to internal teams, troubleshoot hardware and software issues, and maintain the company’s IT infrastructure.', 40, 700.00, 'Irbid', 'Strong knowledge of network and server management, with experience in providing IT support in an office environment.', '2025-06-05', 1, 'IT', '2025-04-16 04:58:14', '2025-04-16 04:58:14'),
(5, 1, 'UX/UI Designer', 'Looking for a creative UX/UI Designer to design user-friendly interfaces and ensure a seamless user experience across web and mobile platforms. Proficiency in design tools like Adobe XD and Figma is required.', 40, 800.00, 'Amman', 'Experience with UX/UI design principles. Portfolio with previous design work is mandatory.', '2025-08-01', 1, 'Design', '2025-04-16 04:58:14', '2025-04-16 04:58:14'),
(6, 1, 'Frontend Developer', 'We need a frontend developer who is proficient in HTML, CSS, JavaScript, and React. The candidate should have a strong understanding of web design principles and the ability to build responsive websites.', 40, 850.00, 'Amman', 'Proven experience in front-end development with React. Strong knowledge of JavaScript and CSS frameworks.', '2025-07-12', 1, 'IT', '2025-04-16 04:58:14', '2025-04-16 04:58:14'),
(7, 1, 'Data Scientist', 'We are hiring a Data Scientist to work on analyzing complex datasets, building predictive models, and using machine learning to drive business insights. Strong programming skills are required in Python or R.', 40, 1000.00, 'Amman', 'At least 2 years of experience in data science or related fields. Experience with data visualization tools like Tableau or PowerBI is a plus.', '2025-07-30', 1, 'IT', '2025-04-16 04:58:14', '2025-04-16 04:58:14'),
(8, 1, 'Product Manager', 'We need a Product Manager who will be responsible for the development and management of our product roadmap, and work closely with engineering and design teams to launch successful products.', 40, 1100.00, 'Amman', 'Experience in product management or project management. Strong communication skills are required.', '2025-06-10', 1, 'Design', '2025-04-16 04:58:14', '2025-04-16 04:58:14'),
(9, 1, 'SEO Specialist', 'We are looking for an SEO Specialist to optimize website content and improve search engine rankings using the latest SEO strategies. A solid understanding of Google Analytics and SEO tools is a must.', 35, 750.00, 'Amman', 'At least 1 year of experience in SEO and online marketing. Familiarity with tools such as Google Analytics, SEMrush, or Ahrefs.', '2025-05-15', 1, 'Marketing', '2025-04-16 04:58:14', '2025-04-16 04:58:14'),
(10, 2, 'Graphic Designer', 'Looking for a talented Graphic Designer to create visually appealing designs for print and digital media. Experience with Adobe Creative Suite required.', 40, 800.00, 'Amman', 'Experience with Adobe Photoshop, Illustrator, and InDesign. Portfolio of previous designs required.', '2025-07-20', 1, 'Design', '2025-04-16 04:58:14', '2025-04-16 04:58:14'),
(11, 2, 'Content Writer', 'A creative and detail-oriented Content Writer is needed to write blogs, articles, and marketing materials for various platforms.', 35, 650.00, 'Amman', 'Strong writing skills and the ability to create engaging content. Experience in writing for digital marketing is a plus.', '2025-06-25', 1, 'Marketing', '2025-04-16 04:58:14', '2025-04-16 04:58:14'),
(12, 2, 'Social Media Manager', 'We are hiring a Social Media Manager to handle our online presence across multiple social media platforms. The ideal candidate should have experience with social media analytics and content creation.', 38, 700.00, 'Amman', 'Proven track record of social media growth. Familiarity with Facebook Ads and Instagram is a must.', '2025-08-05', 1, 'Marketing', '2025-04-16 04:58:14', '2025-04-16 04:58:14'),
(13, 2, 'Accountant', 'A skilled Accountant is needed to manage financial records, prepare reports, and ensure tax compliance. Experience with accounting software like QuickBooks or Xero is preferred.', 40, 750.00, 'Amman', 'At least 2 years of accounting experience. Strong knowledge of financial reporting and tax laws.', '2025-06-15', 1, 'Marketing', '2025-04-16 04:58:14', '2025-04-16 04:58:14'),
(14, 2, 'Sales Manager', 'We are looking for an experienced Sales Manager to lead our sales team, set targets, and create sales strategies to achieve business goals.', 40, 950.00, 'Amman', 'At least 3 years of experience in sales management. Strong leadership and negotiation skills.', '2025-07-01', 1, 'Marketing', '2025-04-16 04:58:14', '2025-04-16 04:58:14'),
(15, 2, 'HR Specialist', 'An HR Specialist is needed to manage recruitment, employee relations, and performance management within the company. Excellent communication skills are required.', 40, 850.00, 'Amman', 'Experience in HR management. Knowledge of labor laws and hiring processes.', '2025-06-30', 1, 'Marketing', '2025-04-16 04:58:14', '2025-04-16 04:58:14'),
(16, 2, 'Project Manager', 'Looking for a Project Manager to oversee various projects, ensuring they are completed on time and within budget. Strong leadership and organizational skills are essential.', 40, 1100.00, 'Amman', 'At least 2 years of project management experience. Strong knowledge of project management tools.', '2025-07-10', 1, 'Design', '2025-04-16 04:58:14', '2025-04-16 04:58:14'),
(17, 2, 'Marketing Coordinator', 'We need a Marketing Coordinator to assist with the execution of marketing strategies, manage events, and help with campaigns. Experience in event planning is a plus.', 40, 700.00, 'Amman', 'Experience in marketing and event coordination. Strong communication and organizational skills.', '2025-06-20', 1, 'Marketing', '2025-04-16 04:58:14', '2025-04-16 04:58:14'),
(18, 2, 'Customer Support Specialist', 'Hiring a Customer Support Specialist to provide assistance and resolve issues for our clients. Excellent communication skills and problem-solving ability are required.', 40, 600.00, 'Amman', 'Experience in customer support. Strong phone and email communication skills.', '2025-08-01', 1, 'Design', '2025-04-16 04:58:14', '2025-04-16 04:58:14'),
(19, 2, 'Business Development Manager', 'We are looking for a Business Development Manager to identify new business opportunities, negotiate contracts, and build strong relationships with clients.', 40, 1200.00, 'Amman', 'At least 3 years of experience in business development. Strong negotiation and communication skills.', '2025-07-25', 1, 'Marketing', '2025-04-16 04:58:14', '2025-04-16 04:58:14');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(17, '2025_04_05_190147_update_status_column_in_job_applications_table', 1),
(20, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(21, '2025_02_18_175515_create_roles_table', 2),
(22, '2025_02_18_175614_create_users_table', 2),
(23, '2025_02_18_175802_create_profiles_table', 2),
(24, '2025_02_18_180705_create_companies_table', 2),
(25, '2025_02_18_181054_create_job_offers_table', 2),
(26, '2025_02_18_181334_create_job_applications_table', 2),
(27, '2025_02_18_181653_create_contacts_table', 2),
(28, '2025_04_10_085410_add_deleted_at_to_companies_table', 2),
(29, '2025_04_14_192840_create_favorite_jobs_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `hourly_rate` decimal(8,2) DEFAULT NULL,
  `available_hours` int(11) DEFAULT NULL,
  `skills` text DEFAULT NULL,
  `experience` text DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `cv_path` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `phone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `job_title`, `hourly_rate`, `available_hours`, `skills`, `experience`, `city`, `country`, `cv_path`, `image_path`, `is_active`, `phone`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', 12.00, 12, 'HTML, CSS, Laravel, Photoshop', '2+ years experience in the field.', 'Amman', 'Jordan', 'cv_files/aVPKhI4vdLZDzsF8QQe4kML6Qj6idzAXGjuNcZUt.pdf', 'profile_images/vQ9O1RC2BiBVTmI64dS7JEdf9YbNbCY2I8HrVyvh.jpg', 1, '0790000000', '2025-04-16 04:58:14', '2025-04-17 08:47:04'),
(2, 2, 'Company Rep', NULL, NULL, 'HTML, CSS, Laravel, Photoshop', '2+ years experience in the field.', 'Amman', 'Jordan', NULL, NULL, 1, '0790000000', '2025-04-16 04:58:14', '2025-04-16 04:58:14'),
(3, 3, 'Manager', NULL, NULL, 'HTML, CSS, Laravel, Photoshop', '2+ years experience in the field.', 'Amman', 'Jordan', NULL, NULL, 1, '0790000000', '2025-04-16 04:58:14', '2025-04-16 04:58:14'),
(4, 4, 'Graphic Designer', NULL, NULL, NULL, NULL, 'Amman', 'Jordan', 'cv_files/dLfxfggoYXtUfT6SRyNgPlDDuSob8e9bL7tUVfnr.pdf', 'profile_images/fIBXvjHO7g3PIeus7mNkhWMjelNeQste6MnxSpEp.jpg', 1, '0790000000', '2025-04-16 04:58:14', '2025-04-17 08:49:31'),
(5, 5, 'Web Developer', 18.50, 25, 'HTML, CSS, Laravel, Photoshop', '2+ years experience in the field.', 'Amman', 'Jordan', NULL, NULL, 1, '0790000000', '2025-04-16 04:58:14', '2025-04-16 04:58:14'),
(6, 6, 'Marketing Specialist', 20.00, 30, 'HTML, CSS, Laravel, Photoshop', '2+ years experience in the field.', 'Amman', 'Jordan', 'cv_files/WsyB4cWaOoCb2XE4doUXxeZtOzLJ3Wscmn0JFbzo.pdf', 'profile_images/On07xp5TpSboHthpPQt3oC6v37iYkqLRz8uhyx8t.jpg', 1, '0790000000', '2025-04-16 04:58:14', '2025-04-16 09:20:18'),
(7, 7, 'Content Writer', 12.75, 15, 'HTML, CSS, Laravel, Photoshop', '2+ years experience in the field.', 'Amman', 'Jordan', NULL, NULL, 1, '0790000000', '2025-04-16 04:58:14', '2025-04-16 04:58:14'),
(8, 8, 'UI/UX Designer', 22.00, 10, 'HTML, CSS, Laravel, Photoshop', '2+ years experience in the field.', 'Amman', 'Jordan', NULL, NULL, 1, '0790000000', '2025-04-16 04:58:14', '2025-04-16 04:58:14'),
(9, 9, 'developer', 20.00, 22, 'developer', 'test test test', 'amman', 'Jordan', 'cv_files/UcP1VmTbcj4XGhpyAZ8ymstJ9bJvoCGN8pDEhqL0.pdf', 'profile_images/ay6Cb2eAPoQ6UhEkfeRGpFVXZqx56HNVZsqbZeXv.jpg', 1, '0790000000', '2025-04-18 14:07:48', '2025-04-18 14:08:35');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'user', NULL, NULL),
(2, 'company', NULL, NULL),
(3, 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role_id`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ahmad', 1, 'ahmad@example.com', '$2y$12$H0rYrHxczMVs7b0aIE3SVeYJDLlFTwBBJg2PWMmmCn9mPF/IN0rGu', NULL, '2025-04-16 04:58:12', '2025-04-16 04:58:12'),
(2, 'SaraCompany', 2, 'sara@company.com', '$2y$12$3vUgcVYHXy0gs2UXbMVfteVbFnmxjTssytJ.XVA3QvxR6YJ12qcya', NULL, '2025-04-16 04:58:12', '2025-04-16 04:58:12'),
(3, 'AliCompany', 2, 'ali@company.com', '$2y$12$8A3uYwji/bbnB7UBj4Q9WeAJ0hsSXeSSsrpzQgdOsCBajAdr9vfVm', NULL, '2025-04-16 04:58:13', '2025-04-16 04:58:13'),
(4, 'Khaled', 3, 'khaled@example.com', '$2y$12$dEoNre/p/mBQSScxrzPpwegnweMi/PoFXbcMEaZcsHJ5oZxJ0/8SS', NULL, '2025-04-16 04:58:13', '2025-04-16 04:58:13'),
(5, 'Mona', 1, 'mona@example.com', '$2y$12$o1p8IW0Oaz1n9PyehCxa5ersyNflMSklgO0ToVtc9OOUaEJkUGx0q', NULL, '2025-04-16 04:58:13', '2025-04-16 04:58:13'),
(6, 'Yousef', 1, 'yousef@example.com', '$2y$12$jW4jUNqhSft6uHAuakUyteHsUdY5u.sJerdnHlkvV.KvHe8tlcI8S', NULL, '2025-04-16 04:58:13', '2025-04-16 04:58:13'),
(7, 'Lina', 1, 'lina@example.com', '$2y$12$95wZ17bTd/QXCKQaW8PereJHXSiwi2e1N2texAVlo1VDv228EmbSq', NULL, '2025-04-16 04:58:13', '2025-04-16 04:58:13'),
(8, 'Omar', 1, 'omar@example.com', '$2y$12$FQb9yRTYPtR2gI1Ecvsgu.5OM/tGPK0W5QyAKo.sI1AunSeMNFrYm', NULL, '2025-04-16 04:58:14', '2025-04-16 04:58:14'),
(9, 'ward', 1, 'wardgh444@gmail.com', '$2y$12$7iPCoBbsIf8.F2ZfMtGVVOGwXnZQr87.bRadtKL8Xz6eKx6dPTVIm', NULL, '2025-04-18 14:07:37', '2025-04-18 14:07:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `companies_user_id_unique` (`user_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorite_jobs`
--
ALTER TABLE `favorite_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `favorite_jobs_user_id_job_offer_id_unique` (`user_id`,`job_offer_id`),
  ADD KEY `favorite_jobs_job_offer_id_foreign` (`job_offer_id`);

--
-- Indexes for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_applications_profile_id_foreign` (`profile_id`),
  ADD KEY `job_applications_job_offer_id_foreign` (`job_offer_id`);

--
-- Indexes for table `job_offers`
--
ALTER TABLE `job_offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_offers_company_id_foreign` (`company_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `profiles_user_id_unique` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `favorite_jobs`
--
ALTER TABLE `favorite_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `job_offers`
--
ALTER TABLE `job_offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `companies`
--
ALTER TABLE `companies`
  ADD CONSTRAINT `companies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `favorite_jobs`
--
ALTER TABLE `favorite_jobs`
  ADD CONSTRAINT `favorite_jobs_job_offer_id_foreign` FOREIGN KEY (`job_offer_id`) REFERENCES `job_offers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorite_jobs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD CONSTRAINT `job_applications_job_offer_id_foreign` FOREIGN KEY (`job_offer_id`) REFERENCES `job_offers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_applications_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_offers`
--
ALTER TABLE `job_offers`
  ADD CONSTRAINT `job_offers_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
