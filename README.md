# MovieRama App

Welcome to MovieRama, a simple movie review application created for an interview process.

## Overview

MovieRama allows users to browse and review movies. Users can like or dislike movies, and their votes are counted to determine the popularity of each movie.

## Prerequisites

Before running the application, make sure you have the following installed on your system:

- [PHPStorm](https://www.jetbrains.com/phpstorm/download/): Integrated Development Environment (IDE) for PHP.
- [MySQL](https://www.mysql.com/): Latest version of MySQL database.
- [Apache Server](https://httpd.apache.org/) or [XAMPP](https://www.apachefriends.org/index.html): Apache web server with PHP 8.2 or higher.
- [PHPUnit](https://phpunit.de/index.html): PHP testing framework for unit testing.

## Installation and Setup

Follow these steps to set up the MovieRama application:

1. **Clone the Repository**: Clone this repository to your local machine.

2. **Configure IDE**:
   - Open PHPStorm and configure it to listen to PHP or XAMPP in the `bin/php.exe` folder.
   - Install PHPUnit and set up the IDE according to the PHPUnit installation instructions.

3. **Database Setup**:
   - Create a MySQL database named `moviesDB`.
   - Execute the following SQL script to create the necessary tables:

```sql
CREATE TABLE `movies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `user_id` int NOT NULL,
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `likes` int DEFAULT '0',
  `hates` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `user_votes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `movie_id` int DEFAULT NULL,
  `vote` enum('like','hate') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `movie_id` (`movie_id`),
  CONSTRAINT `user_votes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `user_votes_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
