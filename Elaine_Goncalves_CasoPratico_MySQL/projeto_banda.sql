-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15/06/2026 às 12:29
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projeto_banda`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `user_id`) VALUES
(1, 'Anderson', 'anderson@email.com', '987987987', 3),
(2, 'Alice Maria', 'amaria@email.com', '987123096', NULL),
(3, 'Sineli', 'sineli@email.com', NULL, 2);

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `customer_sales_summary`
-- (Veja abaixo para a visão atual)
--
CREATE TABLE `customer_sales_summary` (
`customer_id` int(11)
,`customer_name` varchar(100)
,`number_of_tickets_purchased` bigint(21)
,`total_spent` decimal(32,2)
);

-- --------------------------------------------------------

--
-- Estrutura para tabela `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `event_date` datetime NOT NULL,
  `location` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `events`
--

INSERT INTO `events` (`id`, `event_name`, `event_date`, `location`, `description`, `capacity`) VALUES
(4, ' Eu Tive Um Sonho', '2026-06-19 20:30:00', 'MEO Arena', 'A turnê \"Eu Tive Um Sonho\" marca o grande retorno do Kid Abelha aos palcos, reunindo a formação clássica com Paula Toller nos vocais, Bruno Fortunato na guitarra e George Israel no sax. O espetáculo apresenta um \"setlist matador\" Volta de Kid Abelha aos palcos terá \'setlist matador\' e canções nunca tocadas em shows, diz Paula Toller, incluindo grandes clássicos que atravessam gerações e músicas que nunca haviam sido tocadas ao vivo.', 12500);

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `event_details`
-- (Veja abaixo para a visão atual)
--
CREATE TABLE `event_details` (
`event_id` int(11)
,`event_name` varchar(100)
,`description` text
,`date` date
,`time` time
,`venue` varchar(100)
,`capacity` int(11)
,`total_tickets` bigint(21)
,`sold_tickets` decimal(22,0)
,`available_tickets` decimal(22,0)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `event_sales_summary`
-- (Veja abaixo para a visão atual)
--
CREATE TABLE `event_sales_summary` (
`event_id` int(11)
,`event_name` varchar(100)
,`number_of_tickets_sold` bigint(21)
,`total_revenue` decimal(32,2)
);

-- --------------------------------------------------------

--
-- Estrutura para tabela `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','completed') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_date`, `status`) VALUES
(1, 1, '2026-06-02 14:50:28', 'pending'),
(2, 1, '2026-06-05 09:23:45', 'pending');

-- --------------------------------------------------------

--
-- Estrutura para tabela `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES
(1, 1, 1, 2),
(2, 1, 2, 3),
(3, 1, 3, 1),
(4, 2, 8, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `image`, `price`, `stock`, `category`) VALUES
(1, 'T-Shirt Clássica', 'T-shirt preta 100% algodão com o logótipo clássico da banda Kid Abelha.', 'imagens/1780671395_camiseta kid abelha.png', 20.00, 50, 'Merchandise'),
(2, 'Caneca Oficial', 'Caneca de cerâmica branca, perfeita para o teu café ao som de Fixação.', 'imagens/1780671380_caneca kid abelha.png', 12.00, 30, 'Merchandise'),
(3, 'CD Acústico MTV', 'O icónico álbum Acústico MTV gravado ao vivo com os maiores sucessos.', 'imagens/cd acustico mtv.jpeg', 15.00, 20, 'Albuns'),
(4, 'CD Educação Sentimental', 'Um dos álbuns mais clássicos de 1985 em formato físico.', 'imagens/Educação-Sentimental.jpg', 14.50, 15, 'Albuns'),
(5, 'CD Iê-Iê-Iê', 'Álbum de estúdio com a energia contagiante do pop rock brasileiro.', 'imagens/Iê-Iê-Iê.jpg', 14.00, 10, 'Albuns'),
(6, 'CD Pega Vida', 'A última produção de estúdio da banda.', 'imagens/Pega-Vida.jpg', 13.50, 25, 'Albuns'),
(7, 'Óculos de Sol Kid Abelha', 'Óculos de Sol retrô Anos 80 representando o bom gosto dos fãs do Kid Abelha.', 'imagens/1780671363_oculos_de_ sol.png', 45.00, 10, 'Merchandise'),
(8, 'Copo Personalizado', 'Copo térmico personalizado de 590ml para os amantes da boa música, ideal como presente para os fãs da banda Kid Abelha.', 'imagens/1780671348_1780651348_copo personalizado.png', 15.00, 14, 'Merchandise');

-- --------------------------------------------------------

--
-- Estrutura para tabela `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `ticket_id` int(11) DEFAULT NULL,
  `sale_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `sales`
--

INSERT INTO `sales` (`id`, `customer_id`, `ticket_id`, `sale_date`) VALUES
(2, 1, 3, '2026-06-12 12:55:28'),
(3, 1, 4, '2026-06-12 13:00:35'),
(4, 2, 3, '2026-06-12 13:50:53'),
(5, 3, 4, '2026-06-15 09:31:20');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `seat_number` varchar(10) DEFAULT NULL,
  `status` enum('Sold','Available') DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tickets`
--

INSERT INTO `tickets` (`id`, `event_id`, `price`, `seat_number`, `status`) VALUES
(3, 4, 80.00, '34', 'Sold'),
(4, 4, 80.00, '23', 'Sold'),
(5, 4, 80.00, '12', 'Available');

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `tickets_status`
-- (Veja abaixo para a visão atual)
--
CREATE TABLE `tickets_status` (
`ticket_id` int(11)
,`event_name` varchar(100)
,`price` decimal(10,2)
,`seat_number` varchar(10)
,`status` enum('Sold','Available')
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `tickets_view`
-- (Veja abaixo para a visão atual)
--
CREATE TABLE `tickets_view` (
`id` int(11)
,`event_id` int(11)
,`price` decimal(10,2)
,`seat_number` varchar(10)
,`status` enum('Sold','Available')
);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `profile_pic` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `profile_pic`, `phone`) VALUES
(1, 'Elaine Santos', 'eli@email.com', '$2y$10$PM0rrSXYk9XjqFAKA.D6eugNTbtAZ4mNRS3bRyOMDqxerO8PFKiXa', 'admin', 'imagens/perfil/1780671455_jovem-f-fotor-20251117141256.png', '969884455'),
(2, 'Sineli', 'sineli@email.com', '$2y$10$sxtS7Un78lcECNJzZcgWS.E8c9jzIRJlXWzHZ.eHuASgxZxgF5X5S', 'user', 'imagens/perfil/1780672612_WhatsApp Image 2026-06-03 at 17.45.27.jpeg', '123456789'),
(3, 'Anderson', 'anderson@email.com', '$2y$10$IrMJX.TxB4OGJCs2C6/ct.WBg6WQ3Xz2Xa7Nw9s6.65HyHsAR1RY2', 'user', 'imagens/perfil/1780674102_jovem-m-fotor-20251117141112.png', '987654321');

-- --------------------------------------------------------

--
-- Estrutura para view `customer_sales_summary`
--
DROP TABLE IF EXISTS `customer_sales_summary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `customer_sales_summary`  AS SELECT `c`.`id` AS `customer_id`, `c`.`name` AS `customer_name`, count(`s`.`id`) AS `number_of_tickets_purchased`, ifnull(sum(`t`.`price`),0) AS `total_spent` FROM ((`customers` `c` left join `sales` `s` on(`c`.`id` = `s`.`customer_id`)) left join `tickets` `t` on(`s`.`ticket_id` = `t`.`id`)) GROUP BY `c`.`id` ;

-- --------------------------------------------------------

--
-- Estrutura para view `event_details`
--
DROP TABLE IF EXISTS `event_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `event_details`  AS SELECT `e`.`id` AS `event_id`, `e`.`event_name` AS `event_name`, `e`.`description` AS `description`, cast(`e`.`event_date` as date) AS `date`, cast(`e`.`event_date` as time) AS `time`, `e`.`location` AS `venue`, `e`.`capacity` AS `capacity`, count(`t`.`id`) AS `total_tickets`, ifnull(sum(case when `t`.`status` = 'Sold' then 1 else 0 end),0) AS `sold_tickets`, ifnull(sum(case when `t`.`status` = 'Available' then 1 else 0 end),0) AS `available_tickets` FROM (`events` `e` left join `tickets` `t` on(`e`.`id` = `t`.`event_id`)) GROUP BY `e`.`id` ;

-- --------------------------------------------------------

--
-- Estrutura para view `event_sales_summary`
--
DROP TABLE IF EXISTS `event_sales_summary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `event_sales_summary`  AS SELECT `e`.`id` AS `event_id`, `e`.`event_name` AS `event_name`, count(`s`.`id`) AS `number_of_tickets_sold`, ifnull(sum(`t`.`price`),0) AS `total_revenue` FROM ((`events` `e` left join `tickets` `t` on(`e`.`id` = `t`.`event_id`)) left join `sales` `s` on(`t`.`id` = `s`.`ticket_id` and `s`.`ticket_id` is not null)) GROUP BY `e`.`id` ;

-- --------------------------------------------------------

--
-- Estrutura para view `tickets_status`
--
DROP TABLE IF EXISTS `tickets_status`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tickets_status`  AS SELECT `t`.`id` AS `ticket_id`, `e`.`event_name` AS `event_name`, `t`.`price` AS `price`, `t`.`seat_number` AS `seat_number`, `t`.`status` AS `status` FROM (`tickets` `t` join `events` `e` on(`t`.`event_id` = `e`.`id`)) ;

-- --------------------------------------------------------

--
-- Estrutura para view `tickets_view`
--
DROP TABLE IF EXISTS `tickets_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tickets_view`  AS SELECT `tickets`.`id` AS `id`, `tickets`.`event_id` AS `event_id`, `tickets`.`price` AS `price`, `tickets`.`seat_number` AS `seat_number`, `tickets`.`status` AS `status` FROM `tickets` ;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_customer_user` (`user_id`);

--
-- Índices de tabela `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Índices de tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `ticket_id` (`ticket_id`);

--
-- Índices de tabela `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `fk_customer_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Restrições para tabelas `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Restrições para tabelas `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Restrições para tabelas `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`);

--
-- Restrições para tabelas `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
