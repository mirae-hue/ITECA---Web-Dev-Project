-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql310.infinityfree.com
-- Generation Time: Jan 18, 2026 at 03:01 PM
-- Server version: 11.4.9-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_40911087_dragonstone_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`) VALUES
(1, 'Cleaning & Household Supplies', NULL, '2025-11-13 11:01:20'),
(2, 'Kitchen & Dining', NULL, '2025-11-13 11:01:58'),
(3, 'Home Décor & Living', NULL, '2025-11-13 11:02:17'),
(4, 'Bathroom & Personal Care', NULL, '2025-11-13 11:02:29'),
(5, 'Lifestyle & Wellness', NULL, '2025-11-13 11:02:45'),
(6, 'Kids & Pets', NULL, '2025-11-13 11:03:02'),
(7, 'Outdoor & Garden', NULL, '2025-11-13 11:03:14');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'this is great!', '2026-01-18 11:38:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','confirmed','delivered','closed') NOT NULL DEFAULT 'pending',
  `subtotal` decimal(10,2) NOT NULL,
  `delivery_fee` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `carbon_score` int(11) DEFAULT 0,
  `ecopoints_earned` int(11) DEFAULT 0,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_date`, `status`, `subtotal`, `delivery_fee`, `total`, `carbon_score`, `ecopoints_earned`, `address`) VALUES
(1, 2, '2026-01-12 13:12:57', 'confirmed', '89.99', '60.00', '149.99', 10, 10, '16 Willow street, Comms Park, Western Cape');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_each` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price_each`) VALUES
(1, 1, 11, 1, '89.99');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `likes_count` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `content`, `likes_count`, `created_at`, `updated_at`) VALUES
(1, 2, '🌱Composting 101', '                                              The quick start guide\r\n\r\nWhen leaves, animal droppings and organic matter fall to the ground, they naturally break down and enrich the soil. Similarly, if you simply pile organic material up, you will eventually get compost. By applying the following steps, we aim to speed up the decomposition process and enhance the quality of the final compost.\r\n\r\nThe following steps can be applied to either a compost pile or a compost bin. You don’t need to follow every step to get compost – but the more you follow, the better the results will be. If you’re short on time, I’ve included an ‘impact factor’ for each step to help you decide which ones to prioritize.\r\n\r\n1. Start with a layer of sticks, twigs or branches.\r\n\r\nTwigs, sticks and branches help airflow and create air pockets in the compost, which helps speed up the composting process. An alternative is to use something like a pallet, which also traps air, but for a quick start I find sticks are quicker and easier. \r\n\r\nDon’t lay them on too thick – all you’re aiming to do is create some air pockets, and a thick layer can harder to remove the finished compost. \r\n\r\nImpact factor: 2/5 \r\n\r\n\r\n2. Add brown and green materials in layers.\r\n\r\nBrown materials are those high in carbon, such as straw and leaves. Green materials are those high in nitrogen, such as grass and vegetable peelings. See materials further down this post for more detail. \r\n\r\nIf you alternate layers of these, your compost will break down faster and be less likely to turn into a slimy mess. Ideally you want one part green to one or two parts brown, but don’t worry about being exact. You can also mix green and browns together before adding them to the compost pile. While this works well, I find it is too much trouble when you are composting larger amounts. \r\n\r\nImpact factor: 5/5\r\n\r\n\r\n3. Add bulking materials to trap air in the pile\r\n\r\nBulking materials help trap air in the compost pile, and can help absorb excess moisture too. They aren’t talked about much by amateur composters, but they are one of the best ways to speed up the composting process. I often use sawdust, but you can also use materials like woodchops (ideally semi-decomposed). \r\n\r\nBulking materials also count as a brown material.\r\n\r\nImpact factor: 5/5\r\n\r\n\r\n4. Monitor moisture levels\r\n\r\nToo much moisture will drive air out of the compost pile. Too little, and the bacteria that works best in compost will stop functioning. Ideally, you want your compost to feel like a wrung out sponge. You can check the moisture levels by moving some compost aside, removing a handful and squeezing it – but be careful if your compost is hot!\r\n\r\nIf your climate is wet, consider covering the compost with a tarpaulin to stop rain. Covering your compost in dry climates can also help retain moisture. \r\n\r\nImpact factor: 5/5\r\n\r\n\r\n5. Turn if possible\r\nTurning is not strictly necessary if you have used bulking materials, but I find that even a single turn can dramatically improve the speed and quality of the compost. \r\n\r\nThe common reason for turning is to introduce more air into compost, but I also find it a useful way to monitor the moisture levels throughout the compost. If it’s dry, I give each layer a spray with the hosepipe. I don’t usually worry if it’s a little wet, as I find the turn increases microbial activity and helps dry the compost out. \r\n\r\nIf you have the time and energy to turn your compost more often, it will speed the process up even further. \r\n\r\nImpact factor: 3/5\r\n\r\n\r\n6. Leave the compost to mature\r\n\r\nCompost needs to be left to mature before it can be used for the first time. Don’t skip this step – when I started gardening, I had extremely bad results when using fresh, immature compost from a municipal composting center. I now give mine at least 6 months after it has cooled down before using it. \r\n\r\nImpact factor: 5/5\r\n\r\n\r\n7. Compost bin or pile?\r\n\r\nDIY pallet bin next to a insulated compost bin. \r\nMy insulated compost bin next to a DIY pallet bin.\r\n\r\n\r\nOur quick start guide gave you the essential principles of composting – but should you just start a pile or should you use a compost bin? Let’s compare: \r\n\r\n- Compost pile?\r\n\r\nA compost pile is easy to set up, and requires no building or upfront cost. However, it’s difficult to maintain the shape of the compost – I find they tend to sprawl. What’s more, if you want your compost to get hot, you need quite a lot of material. \r\n\r\n\r\n- Compost bin?\r\n\r\nCompost bins either have to be built or purchased. On the other hand, even the cheapest compost bin helps maintain the shape of the compost. The best compost bin facilitates airflow and provides insulation, which helps improve the speed of composting and can eliminate the need for turning. \r\n\r\nMy verdict\r\nMy personal preference is for compost bins. However, if you just want to give composting a go for the first time, and don’t want to invest time or money, I’d suggest using a compost pile. ', 0, '2026-01-18 06:49:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_likes`
--

CREATE TABLE `post_likes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` int(11) NOT NULL,
  `stock_quantity` int(11) DEFAULT 0,
  `carbon_score` float DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category_id`, `stock_quantity`, `carbon_score`, `image`, `created_at`, `updated_at`) VALUES
(2, 'Plant-Based Laundry Detergent Sheets', '16 Sheets, gentle on fabrics, tough on stains. Biodegradable and refillable.', '129.99', 1, 20, 4, 'prod_6916c4f9c11425.93526356.jpeg', '2025-11-14 05:58:17', '2026-01-12 02:59:35'),
(3, 'Refillable Glass Spray Bottles', 'Durable, reusable, and perfect for eco-friendly cleaning.', '99.98', 1, 20, 3, 'prod_6916c64be3aa44.34900095.jpeg', '2025-11-14 06:03:55', '2026-01-11 15:07:36'),
(4, 'All-Purpose Cleaner', 'Non-toxic formula with citrus oils. Safe for kids and pets.', '74.50', 1, 20, 4, 'prod_6916c6836b09f0.80560763.png', '2025-11-14 06:04:51', '2026-01-11 15:07:53'),
(5, 'Wool dryer balls', 'Reusable alternative to dryer sheets. Softens clothes naturally and reduces drying time.', '89.99', 1, 20, 2, 'prod_6916c6bc16cd22.58162046.png', '2025-11-14 06:05:48', '2026-01-11 15:08:17'),
(6, 'Biodegradable trash bags', '20 Durable, leak-resistant bags made from plant-based materials. Break down naturally in compost.', '59.50', 1, 20, 7, 'prod_6916c6febb2209.31061693.jpeg', '2025-11-14 06:06:54', '2026-01-12 02:48:37'),
(7, 'Charcoal Air Purifying Bags', 'Eliminate odors and moisture with activated bamboo charcoal. Ideal for closets, cars, and shoes.', '69.99', 1, 20, 5, 'prod_6916c73f2210e4.37982127.jpeg', '2025-11-14 06:07:59', '2026-01-11 15:35:45'),
(8, 'Bamboo kitchen utensils and cutting boards', 'Crafted from sustainably harvested bamboo, these durable kitchen tools are naturally antibacterial and gentle on cookware.', '129.99', 2, 20, 3, 'prod_6916c7b8848c65.86302092.jpeg', '2025-11-14 06:10:00', '2026-01-11 15:36:01'),
(9, 'Reusable silicone food storage bags', 'Flexible, leak-proof, and endlessly reusable - these BPA-free silicone bags replace single-use plastics for snacks, produce, and leftovers.', '89.99', 2, 20, 6, 'prod_6916c7f5c59453.49082518.jpeg', '2025-11-14 06:11:01', '2026-01-11 15:36:30'),
(10, 'Beeswax food wraps', 'Wrap sandwiches, fruits, and bowls with breathable beeswax-coated cotton. A reusable, compostable alternative to cling film.', '74.50', 2, 20, 3, 'prod_6916c86eb14056.58755317.jpeg', '2025-11-14 06:13:02', '2026-01-11 15:39:34'),
(11, 'Compostable dish sponges', '3 sponges made from plant-based cellulose loofahs, these sponges scrub effectively and break down naturally after use.', '89.99', 1, 20, 1, 'prod_6916c8ce58f292.80333195.png', '2025-11-14 06:14:38', '2026-01-12 03:01:55'),
(12, 'Stainless steel straws and straw cleaners', 'Say goodbye to plastic straws. This set includes rust-resistant steel straws and a reusable brush for easy cleaning.', '59.50', 2, 20, 3, 'prod_6916c9112fbf92.43575571.png', '2025-11-14 06:15:45', '2026-01-11 15:37:25'),
(13, 'Recycled glass storage jars', 'Store dry goods, herbs, or pantry staples in these elegant jars made from post-consumer recycled glass.', '69.00', 2, 20, 3, 'prod_6916c951c0cc66.72193236.png', '2025-11-14 06:16:49', '2026-01-11 15:36:56'),
(14, 'Organic cotton dish towels', 'Soft, absorbent, and machine washable - these GOTS-certified cotton towels are perfect for drying dishes and wiping surfaces.', '69.00', 2, 20, 5, 'prod_6916c9894738d9.24009104.png', '2025-11-14 06:17:45', '2026-01-11 15:33:46'),
(15, 'Recycled Glass Vases & Candle Holders', 'Handblown from post-consumer glass, these elegant pieces add charm and reduce landfill waste', '149.00', 3, 149, 4, 'prod_6916ca05bd0994.79658588.jpeg', '2025-11-14 06:19:49', '2026-01-11 15:33:21'),
(16, 'Upcycled wood wall art and shelving', 'Crafted from reclaimed timber, each piece is unique and adds rustic warmth to your home.', '299.99', 3, 20, 3, 'prod_6916ca6c9e9423.49990240.jpeg', '2025-11-14 06:21:32', '2026-01-11 15:32:39'),
(17, 'Organic Cotton Throws & Cushions', 'Soft, breathable, and GOTS-certified. These textiles bring cozy comfort with a clean conscience.', '189.00', 3, 20, 6, 'prod_6916caa8cca5f4.61630013.png', '2025-11-14 06:22:32', '2026-01-11 15:32:56'),
(18, 'Soy Wax Candles with Essential Oils', 'Clean-burning candles infused with lavender, eucalyptus, or citrus oils. No paraffin, no toxins.', '99.00', 3, 20, 4, 'prod_6916cae5cd4ae9.85747907.png', '2025-11-14 06:23:33', '2026-01-11 15:31:57'),
(19, 'Indoor plants with biodegradable pots', 'Air-purifying greenery in compostable pots made from coconut coir and rice husk blends', '129.00', 3, 20, 1, 'prod_6916cb1cade5f4.32922498.png', '2025-11-14 06:24:28', '2026-01-11 15:31:29'),
(20, 'Eco-friendly paint', 'Low-VOC, plant-based paints in partnership with sustainable brands. Safe for your home and planet.', '249.00', 3, 20, 7, 'prod_6916cb60e57bc9.61996491.png', '2025-11-14 06:25:36', '2025-11-14 06:25:36'),
(21, 'Refillable Shampoo & Conditioner Bottles', 'Elegant glass or aluminum bottles designed for reuse. Pair with our bulk refills for zero waste.', '89.00', 4, 20, 3, 'prod_6916cbf2de2682.99408933.png', '2025-11-14 06:28:02', '2026-01-11 15:29:13'),
(22, 'Bamboo toothbrushes and holders', 'Biodegradable handles and sleek holders made from sustainably harvested bamboo.', '50.00', 4, 20, 3, 'prod_6916cc2273c665.07874572.png', '2025-11-14 06:28:50', '2026-01-11 15:27:49'),
(23, 'Compostable floss and packaging', 'Plant-based floss in refillable glass vials. Packaging breaks down naturally in home compost.', '39.00', 4, 20, 3, 'prod_6916cc546b98c5.32277916.png', '2025-11-14 06:29:40', '2026-01-11 15:26:51'),
(25, 'Natural Loofahs Mitts', 'Made from dried gourds and organic cotton. Gentle exfoliation for radiant, healthy skin.', '59.00', 4, 20, 2, 'prod_6916cce4d50152.31569294.png', '2025-11-14 06:32:04', '2026-01-12 00:48:13'),
(26, 'Organic cotton towels and bathrobes', 'Luxuriously soft and GOTS-certified. Available in calming earth tones and minimalist textures.', '249.00', 4, 20, 5, 'prod_6916cd303f67f0.78742818.png', '2025-11-14 06:33:20', '2026-01-11 15:25:33'),
(27, 'Plastic-free deodorant', 'Aluminum-free deodorants and nourishing skincare in compostable or refillable packaging.', '69.99', 4, 20, 5, 'prod_6916cd77bdb0e3.27984497.png', '2025-11-14 06:34:31', '2026-01-12 00:47:13'),
(28, 'Reusable Water Bottles', 'Durable bottles crafted from recycled stainless steel and BPA-free plastics. Stay hydrated sustainably.', '159.99', 5, 20, 7, 'prod_6916cdc76648c2.73476243.png', '2025-11-14 06:35:51', '2026-01-11 15:24:40'),
(29, 'Eco-friendly yoga mats and accessories', 'Non-toxic mats made from natural rubber and cork. Includes straps.', '299.00', 5, 20, 4, 'prod_6916ce77354561.43864489.png', '2025-11-14 06:38:47', '2026-01-11 15:24:02'),
(30, 'Sustainable journals', 'Crafted from recycled paper and printed with vegetable-based inks. A sustainable journal designed for mindful writing and creative reflection.', '89.00', 5, 20, 3, 'prod_6916cf268a6483.81201599.png', '2025-11-14 06:41:42', '2026-01-11 15:23:42'),
(31, 'Solar-powered lanterns', 'Harness the sun with portable lighting. Ideal for travel, camping, or off-grid living.', '199.00', 5, 20, 7, 'prod_6916cf6c646c33.35071877.png', '2025-11-14 06:42:52', '2026-01-11 15:23:03'),
(32, 'Compostable tea + bags', '20 Soothing blends of chamomile, rooibos, and peppermint. Packed in fully compostable tea bags for a zero-waste brew.', '69.00', 5, 20, 2, 'prod_6916cff43f0a80.96453288.png', '2025-11-14 06:45:08', '2026-01-12 03:17:39'),
(33, 'Mindfulness Kits', 'Includes naturally made incense, breathing guides, and meditation prompts. Ethically sourced and beautifully packaged.', '119.00', 5, 20, 4, 'prod_6916d03bd18ab9.73651145.png', '2025-11-14 06:46:19', '2026-01-11 15:22:18'),
(34, 'Wooden toys', 'Crafted from FSC-certified wood and finished with non-toxic paints. Safe, durable, and timeless.', '179.90', 6, 20, 3, 'prod_6916d095be4a81.48547269.png', '2025-11-14 06:47:49', '2026-01-11 15:21:40'),
(35, 'Organic cotton baby clothes & blanket', 'Soft, breathable, and GOTS-certified. Gentle on sensitive skin and kind to the planet.', '219.99', 6, 20, 3, 'prod_6916d0f43922b7.45273559.png', '2025-11-14 06:49:24', '2026-01-11 15:21:23'),
(36, 'Reusable cloth diapers', '12 Adjustable, leak-proof, and washable. Made with organic cotton and waterproof liners.', '195.00', 6, 20, 4, 'prod_6916d136d5b5c8.99185956.png', '2025-11-14 06:50:30', '2026-01-12 03:29:57'),
(37, 'Natural pet grooming products', 'Shampoos and balms made with organic oils and botanicals. Gentle on fur and skin.', '99.00', 6, 20, 4, 'prod_6916d16765f0a2.90064853.png', '2025-11-14 06:51:19', '2026-01-11 15:20:32'),
(38, 'Eco-friendly pet toys', 'Soft, durable pet toys made from natural cotton. Gentle on paws and perfect for sustainable playtime.', '69.00', 6, 20, 4, 'prod_6916d21a5f24e8.78768270.png', '2025-11-14 06:54:18', '2026-01-11 15:06:45'),
(39, 'Compost bins and worm farms', 'Turn kitchen scraps into nutrient-rich soil with odor-free bins and thriving worm habitats.', '299.00', 7, 20, 2, 'prod_6916d260482bc5.88870845.png', '2025-11-14 06:55:28', '2026-01-11 15:06:18'),
(40, 'Rainwater Harvesting Kits', 'Capture and reuse rainwater with easy-install barrels and filtration systems. Reduce your water footprint.', '349.00', 7, 20, 4, 'prod_6916d29eb632f7.43808034.png', '2025-11-14 06:56:30', '2026-01-11 15:06:01'),
(41, 'Seed starter kits with heirloom seeds', 'Grow your own herbs and veggies with heirloom seeds, biodegradable pots, and organic soil blends.', '129.00', 7, 20, 1, 'prod_6916d2e65c2b13.87723203.png', '2025-11-14 06:57:42', '2026-01-11 15:05:41'),
(42, 'Solar-powered garden lights', 'Illuminate pathways and patios with energy-efficient lights powered entirely by the sun.', '99.00', 7, 20, 8, 'prod_6916d328f221f5.08881393.png', '2025-11-14 06:58:48', '2026-01-11 15:05:22'),
(43, 'Recycled plastic planters', 'Stylish and sturdy containers made from post-consumer plastics. UV-resistant and built to last.', '89.00', 7, 20, 6, 'prod_6916d3628a5780.18061369.png', '2025-11-14 06:59:46', '2026-01-11 15:05:00'),
(44, 'Organic fertilisers', 'Boost plant health and deter pests naturally with composted nutrients and botanical sprays.', '119.00', 7, 20, 4, 'prod_6916d3b6267971.32679187.png', '2025-11-14 07:01:10', '2026-01-11 15:04:36');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` int(1) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `start_date` date NOT NULL,
  `renewal_period_days` int(11) DEFAULT 30,
  `max_instances` int(11) DEFAULT NULL,
  `instances_completed` int(11) DEFAULT 0,
  `total_value` decimal(10,2) DEFAULT 0.00,
  `status` enum('active','inactive','cancelled','expired') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `user_id`, `name`, `description`, `image`, `price`, `start_date`, `renewal_period_days`, `max_instances`, `instances_completed`, `total_value`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Cleaning Supplies', 'A curated monthly collection of low‑waste home essentials designed to elevate everyday cleaning. Each delivery includes compostable dish sponges, compostable trash bags, wool dryer balls, an all‑purpose cleaner, and plant‑based laundry detergent sheets. Thoughtfully selected to reduce plastic waste, simplify your routine, and keep your home fresh the eco‑friendly way.', 'sub_69647eb35499a2.67310197.jpeg', '315.00', '2026-01-01', 30, 12, 0, '0.00', 'active', '2026-01-12 03:03:41', '2026-01-12 04:55:15'),
(2, 1, 'Bathroom & Personal Care', 'A sustainable self‑care ritual delivered to your door. This subscription features natural deodorant, exfoliating loofah mitts, compostable floss, and a bamboo toothbrush - all crafted to replace plastic-heavy bathroom items with clean, biodegradable alternatives. A simple, elegant way to make your daily routine more planet‑aligned.', 'sub_69647e39c44c65.58627393.jpeg', '196.00', '2026-01-01', 90, 4, 0, '0.00', 'active', '2026-01-12 03:12:52', '2026-01-12 04:53:13'),
(3, 1, 'Wellness Kit', 'A calming, restorative monthly ritual designed to support mindful living. Each kit includes premium herbal tea and a curated mindfulness set, helping you slow down, reset, and reconnect. Ideal for customers seeking a gentle, eco‑conscious approach to wellness.', 'sub_69647db945fcb3.33292341.png', '160.00', '2026-01-01', 30, 12, 0, '0.00', 'active', '2026-01-12 03:14:29', '2026-01-12 05:07:33'),
(4, 1, 'Baby Essentials', 'A soft, safe, and sustainable bundle designed specifically for newborns as they grow through their first year. Each delivery includes eco‑friendly diapers, breathable baby clothing, and a cozy blanket - all crafted for comfort, durability, and minimal environmental impact. The clothing and diapers are one‑size‑fits‑all but highly adjustable, expanding gently with your baby’s growth. ', 'sub_69647df4535c65.59554260.png', '373.00', '2026-01-01', 90, 4, 0, '0.00', 'active', '2026-01-12 03:35:12', '2026-01-12 04:52:04');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_items`
--

CREATE TABLE `subscription_items` (
  `id` int(11) NOT NULL,
  `subscription_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `item_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscription_items`
--

INSERT INTO `subscription_items` (`id`, `subscription_id`, `product_id`, `quantity`, `item_price`) VALUES
(25, 4, 35, 1, '198.00'),
(26, 4, 36, 1, '175.50'),
(27, 2, 27, 3, '63.00'),
(28, 2, 25, 1, '53.00'),
(29, 2, 23, 1, '35.00'),
(30, 2, 22, 1, '45.00'),
(31, 1, 11, 1, '80.99'),
(32, 1, 6, 1, '53.55'),
(33, 1, 4, 1, '67.05'),
(34, 1, 2, 1, '116.99'),
(35, 3, 32, 1, '60.00'),
(36, 3, 33, 1, '100.00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `status` enum('active','inactive','banned','pending') DEFAULT 'active',
  `is_verified` tinyint(1) DEFAULT 0,
  `verification_code` varchar(100) DEFAULT NULL,
  `reset_token` varchar(100) DEFAULT NULL,
  `reset_token_expiry` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_login` datetime DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `eco_points` int(11) DEFAULT 0,
  `carbon_score` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role`, `status`, `is_verified`, `verification_code`, `reset_token`, `reset_token_expiry`, `created_at`, `updated_at`, `last_login`, `profile_image`, `eco_points`, `carbon_score`) VALUES
(1, 'Katy', 'Liu', 'admin123@gmail.com', '12345', 'admin', 'active', 0, NULL, NULL, NULL, '2025-11-05 13:26:39', '2026-01-18 18:06:54', NULL, NULL, 0, 0),
(2, 'Mimi', 'San', '123email@gmail.com', '$2y$10$u1GVkaJhblWXOcF48Y5jp.A59vYnb0qJvrb7.6y1V5COcGfTtXqy.', 'user', 'active', 0, NULL, NULL, NULL, '2025-11-14 08:36:38', '2026-01-12 11:12:57', NULL, NULL, 10, 0),
(4, 'K', 'J', '123@email.com', '$2y$10$QKx3.j4jsGr/Cgx3MaDeZOtAsK76K1jO97b.LAgWCHbEftjxn3lYe', 'user', 'active', 0, NULL, NULL, NULL, '2026-01-18 15:45:21', '2026-01-18 15:45:21', NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_subscriptions`
--

CREATE TABLE `user_subscriptions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subscription_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `next_renewal_date` date NOT NULL,
  `renewal_period_days` int(11) NOT NULL,
  `status` enum('active','paused','cancelled') DEFAULT 'active',
  `total_price` decimal(10,2) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_subscriptions`
--

INSERT INTO `user_subscriptions` (`id`, `user_id`, `subscription_id`, `start_date`, `next_renewal_date`, `renewal_period_days`, `status`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2026-01-12', '2026-02-11', 30, 'cancelled', '315.00', '2026-01-12 10:15:35', '2026-01-12 10:28:01');

-- --------------------------------------------------------

--
-- Table structure for table `user_subscription_items`
--

CREATE TABLE `user_subscription_items` (
  `id` int(11) NOT NULL,
  `user_subscription_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `item_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_subscription_items`
--

INSERT INTO `user_subscription_items` (`id`, `user_subscription_id`, `product_id`, `quantity`, `item_price`) VALUES
(1, 1, 11, 1, '80.99'),
(2, 1, 6, 1, '53.55'),
(3, 1, 4, 1, '67.05'),
(4, 1, 2, 1, '116.99');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_like` (`post_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `subscription_items`
--
ALTER TABLE `subscription_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscription_id` (`subscription_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `subscription_id` (`subscription_id`);

--
-- Indexes for table `user_subscription_items`
--
ALTER TABLE `user_subscription_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_subscription_id` (`user_subscription_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscription_items`
--
ALTER TABLE `subscription_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_subscription_items`
--
ALTER TABLE `user_subscription_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD CONSTRAINT `post_likes_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `post_likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subscription_items`
--
ALTER TABLE `subscription_items`
  ADD CONSTRAINT `subscription_items_ibfk_1` FOREIGN KEY (`subscription_id`) REFERENCES `subscriptions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subscription_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  ADD CONSTRAINT `user_subscriptions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_subscriptions_ibfk_2` FOREIGN KEY (`subscription_id`) REFERENCES `subscriptions` (`id`);

--
-- Constraints for table `user_subscription_items`
--
ALTER TABLE `user_subscription_items`
  ADD CONSTRAINT `user_subscription_items_ibfk_1` FOREIGN KEY (`user_subscription_id`) REFERENCES `user_subscriptions` (`id`),
  ADD CONSTRAINT `user_subscription_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
