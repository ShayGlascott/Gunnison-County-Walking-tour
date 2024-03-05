-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 19, 2023 at 02:59 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tour_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `historic_sites`
--

CREATE TABLE IF NOT EXISTS `historic_sites`  (
  `id` int(11) NOT NULL,
  `img1_fname` text NOT NULL,
  `img1_altText` text NOT NULL,
  `img1_caption` text NOT NULL,
  `img2_fname` text NOT NULL,
  `img2_altText` text NOT NULL,
  `img2_caption` text NOT NULL,
  `title` text NOT NULL,
  `text1` text NOT NULL,
  `text2` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='table for the templates';




--
-- Dumping data for table `historic_sites`
--

-- INSERT INTO `historic_sites` (`id`, `img1_fname`, `img1_altText`, `img1_caption`, `img2_fname`, `img2_altText`, `img2_caption`, `title`, `text1`, `text2`) VALUES
-- (1, 'gunnisonArtCenterBefore.png', 'gunnison Art Center Old', 'Gunnison Art Center ****', 'gunnisonArtCenterCurrent.png', 'gunnison Art Center New', 'Gunnison Art Center ****', 'Gunnison Arts Center', '<p>Originally built in 1882, the Gunnison Arts Center is one of the most important and visually historic buildings in Gunnison, located at 102 South Main Street. The building has served many purposes over the years. It started as offices for the Rio Grande railroad system, and as a hotel on the second floor. In 1888, the building became a hardware store and even though it changed owners three times, the building remained a hardware store until it became a ski and sports store in 1971. The building even served as a restaurant and bar for a few years. In 1989, the building became the Gunnison Arts Center and, shortly after, was restored into the historical landmark that is present today.</p>', '<ul> <li>The Gunnison Arts Center (GAC) was constructed in 1882 and is listed on the Colorado State Historic Register as one of the most important and visible historic structures on the south end of the Gunnison Valley. This building is on the State Register of historic landmarks.</li> <li>Originally, the Gunnison Arts Center’s building was financed by Mary Mechling, for whom the original building was named after. Mechling purchased the lot in 1880 and two years later had the building constructed by Fredrick Zugelder, a highly respected local master stonemason and stonecutter, and his partner Thomas D. Russell. Upon its completion, the first floor became the rail freight offices for the Denver & Rio Grande Railway. At the same time, the second floor served as private rooms for the European Hotel. According to local lore, many people believed the hotel also operated as a brothel, but these stories are not confirmed.</li> <li>In 1888, Mechling sold the building to F.D. Steel, who owned the Gunnison Hardware Company, and used the building as their new storefront.</li> <li>The Steel family ran their business out of the building until 1931, when W.J. Diog bought the property and continued to use the building as a hardware store. </li> <li>Sometime between 1940 and 1951, Alex Campbell took charge of the building’s title, and continued to operate a hardware store out of the building.</li> <li>In 1960 the hardware store changed hands once again, this time to Clayton Hansen. Hansen continued the hardware store, adding motor repair to the services offered, and manufactured his own Hansen Weather ports as well.</li> <li>In 1971, Leo and Judy Klinker purchased the building and changed it from the hardware store to their Klinkerhaus Ski and Sports store. Klinkerhaus Ski and Sports closed its doors in Gunnison, and the Klinkers rented the building to Three Thieves restaurant for a couple of years. When the Three Thieves restaurant folded around 1979, the Klinker family started their own restaurant and bar called Klink’s Place. Klink’s Place operated in the building from 1980-1988, until the building fell into bank receivership.</li> <li>In 1989 the Gunnison Council for the Arts entered into a lease/purchase option agreement with the First National Bank of Gunnison. The Council immediately began using the building as its arts center without making any physical changes. After a fundraising campaign in 1992, the council was able to purchase the building outright, and the Gunnison Arts Center was established. In the mid to late 90s the building got funding to restore the building to its original façade as seen today.</li> <li>The history of the Art Center Building reflects economic and cultural trends in Gunnison’s history. First, created and used by the Denver and Rio Grande Railroad, the building reflects the progressive beginnings of the town as it emerged from a dusty settlement to an economic transportation hub for the mineral rich area. Secondly, used as a hardware store for decades, the building’s usage demonstrates the need for hardware goods to enable Gunnison residents to build and fix their homes, ranches, and businesses, transforming Gunnison from a transport hub to a town. As a ski shop and restaurant, the building’s usage reflects the growing tourism boom of the mid to late twentieth century that grew with the newly developed Crested Butte Mountain Ski Resort and Blue Mesa Reservoir. Under ownership by the Gunnison Art Center, the building reflects Gunnison’s growing arts scene, which is important to the cultural development of the Gunnison Valley.</li> </ul>'),
-- (2, 'gunnisonCityHallOld.png', 'gunnison City Hall Old', 'Gunnison City Hall ****', 'gunnisonCityHallNew.png', 'gunnison City Hall New', 'Gunnison City Hall ****', 'Gunnison City Hall', ' <p>Introduction: The Gunnison City Hall, located at 201 West Virginia Avenue, finished construction in under a year in 1932. It has been the primary location for the Gunnison city government for nearly a century, and very little has changed to the original design. This unique building is an example of Art Deco, an architecture style that is rare on the western slope. The Denver architecture firm, Mountjoy and Frewen, is responsible for designing the building and it has been on the State Register of Historic Landmarks since 1998.</p> ', '        <ul>\r\n            <li>The Town Council of Gunnison appropriated $25,000 for construction of the Town Hall in April 1931 and work began in June of that year. The building at the time housed the hose house and fire station, jail, marshal\'s office, council room, vaults, private offices, treasurer\'s office and a municipal store selling light and water equipment. The second-floor use was not determined at the time it was built.</li>\r\n            <li>Members of the community volunteered to begin excavation for the building\'s foundation, which was later completed by Danielson and Son, a construction firm from Denver. Construction was completed in February of 1932 and the town offices took occupancy.</li>\r\n            <li>The original details and Art Deco style have been maintained throughout the years with minor renovations. The most significant alterations to the exterior of the building were undertaken in 1967: the fire prevention function of the building was relocated, and the facility was remodeled to accommodate office space.</li>\r\n            <li>Other minor renovations occurred in the 1970s, including the addition of aluminum storm windows, new aluminum entrance doors on the north and east facades, and a small concrete masonry building on the southwest corner of the building to house the City\'s emergency generator.</li>\r\n            <li>The roof was replaced in 1987 with an adhered single ply EPDM roof.</li>\r\n            <li>The exterior of the building has been painted several times over the years with colors similar to the original paint.</li>\r\n            <li>The Gunnison Municipal Building is an architecturally significant historic structure because of its 1930s Art Deco style and detailing that has remained intact over the past sixty years. It also represents a rare western slope example of Art Deco period architecture applied to a governmental structure in which the building has maintained its original character.</li>\r\n        </ul>'),
-- (3, 'johnsonBuildingOld.png', 'johnson Building Old', 'Johnson Building ****, 'johnsonBuildingNew.png', 'johnson Building New', 'Johnson Building ****', 'Johnson Building', ' <p>Introduction: The Johnson Building located at 124 Main St. Gunnison finished construction in 1881. This building has had many different purposes it is the oldest intact commercial building in Gunnison. In 1881 the building was bought for $250 dollars and then was sold very soon after for $800 dollars. The building had different purposes from 1881 to 1901 like a lunchroom and bakery. In 1901 it was sold and became a restaurant and the top floor a living space the restaurant was called the royal cafe. Shortly after in 1904 the restaurant was traded hand and leased out to the Johnson family becoming the Johnson restaurant. The building continued to be a restaurant for over 80 years staying in the Johnson family. In the 1990's the building was sold and restored and now runs as a gallery on the first floor and offices on the second.</p>', ' <p>The property on which the Johnson Building was built changed hands seven times in 1880 with the price fluctuating from $20 to $275. Then in 1881 the building was built on the property and Mary Thomas bought it for $250, immediately selling it for $800. Walker Burkett bought the building and the property in 1901, and when Effie Jane Lashbrook arrived in Gunnison with her sick husband and children in 1901, she took over the empty building. She turned the lower floor into a restaurant and made living quarters for her family upstairs and named the restaurant the Royal Cafe. Burnett leased the building to Sam and Anna Francis (Frankie) Johnson for their restaurant in 1904 and at that time, it became the Johnson Restaurant. Johnson\'s bought the building on October 20, 1920. Sam and Frankie (after Sam\'s death in 1923) continued the restaurant until Frankie died in 1942. Their daughter Sarah Trine and her husband Harry bought her brother\'s share. Sarah continued to operate the restaurant (summers only in later years) until 1985. In 1996, the Tredway family bought the Johnson Building from Sarah Trine. They have restored and renovated both floors of the building. The lower floor is now a Gallery where many of the original antiques are on display. The upper floors are offices.</p>'),
-- (4, 'gunnisonHotelOld.png', 'gunnison Hotel Old', 'Gunnison Hotel ****', 'gunnisonHotelNew.png', 'gunnison Hotel New', 'Gunnison Hotel ****, 'Gunnison Hotel', '<p>The Gunnison Hotel has become a landmark building in Gunnison since its construction in 1882 located in the center of town at 229 N. Main St., Gunnison. When constructed it was one of the tallest buildings and the most elaborate in town with three stories and beautiful bay windows and built of red brick. The building stared as a masonry company named shilling and company the first floor being the retail store and then the other floors being living space and storage spaces. The building was sold in 1889 to Herman Webster an influential man in town who was involved in Gunnison politics being mayor for a year. This building has had many different uses such as a hotel, restaurant, barbershop, and now even a pet shop. </p>', '<ul>\r\n  <li>The Gunnison Hotel building was originally built to be a dry Goods store on Main Street. It was constructed by Milo D. Mattison, in 1882.</li>\r\n  <li>The building was first used in 1882 as a dry goods store by Shilling & Company. It was advertised in the Gunnison Daily Review-Press during 1883, 1884 and early 1885. The store sold dry goods, carpets, millinery, ladies\' and children’s\' shoes, Butterwick patterns, gloves and hosiery, and tea and spices.</li>\r\n  <li>In May 1889 Mattison sold the building to Herman Merrett Webster and E. P. Shov, who owned it jointly until August 1894, when Shov sold-out to Webster. Herman Webster came to Gunnison in 1882 to start a dry goods business. Webster became one of the town builders in Gunnison and was a successful merchant. In 1885 a lady from Illinois, May E. Smith came to Gunnison to marry Webster.</li>\r\n  <li>Webster had made enough profits during the 1880\'s in Gunnison to buy the building for his business. He previously had a store on Main Street which rivalled Shilling & Company.</li>\r\n  <li>Webster did well at his new location in the Mattison building (Gunnison Hotel) which came to be known as the Webster house.</li>\r\n  <li>The dry goods store occupied the first floor The store was well kept and well supplied, with anything from linens to marbles. The Webster family lived on the second floor of the building. Their apartment was nicely furnished and well kept. The front of it, looking out onto Main Street, was a large living room. The third floor was used for Oddfellow\'s and Mason\'s meetings, recitals, and for a convention hall.</li>\r\n  <li>Herman Webster operated his business until his death in 1920. During the years before his death, he served one year as mayor several years as a councilmen and director of the first National Bank in Gunnison.</li>\r\n  <li>After his death Herman\'s wife, May E. sold the building to B. Russell and E. Anna Wightman in April 1921. Wightman and one Mrs. Carmen Johnson, converted it into a hotel in the early 1920\'s. It was called the Gunnison Hotel and had eight rooms on each of the second and third stories. Carmen Johnson had a tearoom on the first floor, and an apartment in the rear.</li>\r\n  <li>During Wightman\'s ownership of the building, it was leased by one Mrs. Esther Johnson. She was not related to Carmen. She managed the hotel from 1929 and had a Swedish home cooking restaurant on the main floor. It was known as the \"Commercial Hotel\" because it was geared to the travelling salesman.</li>\r\n  <li>The hotel never had a liquor license, probably because of May Webster’s strict ways. She wanted nothing to do with alcohol-drinking.</li>\r\n  <li>In July 1932 Wightman’s sold out to three women. They were Laura Allen, Mary Duncan, and Lory M. Lowery. Laura Allen converted part of the main floor into a barbershop. She did not change the hotel rooms on the second and third floors.</li>\r\n  <li>In August 1939 Badger A. and Ruby N. Willson bought the Gunnison Hotel, which was still referred to as the \"commercial Hotel\". The main floor no longer held a restaurant. The Willsons converted It into a hotel office and barbershop, with their apartment in the rear of the building. </li>\r\n<li>The next owners were two sisters, 21 Millie Hauck and Anna Walter. They ran it as a hotel only and owned it from July 1953 to 1972. Donald M. and Betty Jane Peterson leased and managed the Hotel from July 1955 to 1960. In September 1963 Virgil and Helen T. Stan leased the building from Walter and Hauck. Later, in September 1965, Donald R. Edsall leased It, also from Walter and Hauck. </li>\r\n<li>In April 1972 the two sisters sold the building to Robert C. Overton and Richard Dudley. Records and information on the ownership and management of the hotel building are quite unclear after this time. The new owners changed the hotel into an apartment house with the original rooms remaining.</li>\r\n<li>Clifford R. Runge leased the building from April 1972 and started the Crystal Ice Cream Parlor on the main floor. The second and third floors remained unchanged as apartments. The Crystal Ice Cream parlor was changed to be Tin Pot Annie\'s in the early 1970\'. Patrick and Pattie Zielke ran It as a restaurant-ice cream parlor, from November 1975 for about two years.</li>\r\n<li>The J.M.P. Construction Co. bought the building in March 1978, and later renamed their company the Gunnison Hotel Co. </li>\r\n<li>The name of the restaurant was changed to \"Brothers\" in November 1978 and lasted until August 1979. Mike Grazier, a part owner of Tinpot in 1978 currently runs it alone. In August 1979 Grazier closed \"Brothers\" for remodeling. The building was restored, and the upstairs rooms were leased to students of WCU at the time in the 1980’s.</li>\r\n<li>In 1984 the building was listed on the National Register of Historic Places. This building has a deep and interesting history with many different owners and uses of the building. It is known for its commercial use throughout its history and is currently being used as a pet shop. </li>'),
-- (5, 'hartmanBlockOld.png', 'hartman Block Old', 'Hartman Block 1882', 'hartmanBlockNew.png', 'hartman Block New ', 'Hartman Block 2021', 'Hartman Block', '<p>One of the original buildings built in the commercial district of Gunnison located at 107 N. Main St. and built in 1881 by Alonzo Hartman. This building has had many different purposes over time shortly after construction this building was home of the Gunnison post office then a saloon and changing hands many different times throughout the years. It is now named the Corner Cupboard. This building known for its Italianate style has been a part of Gunnison Main Street since the beginning. </p>', '<ul>\r\n  <li>A two-story brick structure was built in 1881 by Alonzo Hartman, for $4,500.00, and is one of the oldest, of the original Commercial District buildings built by Hartman.</li>\r\n  <li>Its Italianate style is evident in the brick cornice, arch windows, and lintels along the second story façade.</li>\r\n  <li>This building once housed the U.S. Post Office from 1881-1901.</li>\r\n  <li>Bookstore, a saloon from 1902-1910.</li>\r\n  <li>1926 is when Physician J.D. Walker opened \'Walker\'s Drugstore\".</li>\r\n  <li>\"Martin\'s Drugstore\", owned by Clyde Martin from 1930 to 1951.</li>\r\n  <li>Max Fleetwood started working for Clyde in 1940, then bought the drugstore in 1951, but kept Martin\'s name on the store.</li>\r\n  <li>Fleetwood then moved across the street to 100 N Main, opening Fleetwood\'s Rexall Drugstore In 1957.</li>\r\n  <li>\"Western Furniture &amp; Supply Company\", was at this address, then in 1961, George Wright opened \"Wright\'s Fashion.</li>\r\n  <li>In 1972, \"Mr. Robert\'s\" gift store was here.</li>\r\n  <li>\"Melodie Records and Tapes\" in 1977.</li>\r\n  <li>\"Cottage Industries\", owned by Patricia Greene, \"Gunnison Rockery\" in 1991.</li>\r\n  <li>Now the building is the home of \"Corner Cupboard\".</li>\r\n</ul>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `home`
--

CREATE TABLE IF NOT EXISTS `slideShowImages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oldImage_fname` text NOT NULL,
  `oldImage_caption` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `slideShowImages` (`oldImage_fname`, `oldImage_caption`) VALUES 
  ('gunnisonArtCenterBefore.png', 'Gunnison Art Center'),
  ('gunnisonCityHallOld.png', 'Gunnison City Hall'),
  ('gunnisonHotelOld.png', 'Gunnison Hotel'),
  ('hartmanBlockOld.png', 'Hartman Block'),
  ('johnsonBuildingOld.png', 'Johnson Building');

CREATE TABLE IF NOT EXISTS `home` (
  `intro_heading_text` text NOT NULL,
  `intro_text` text NOT NULL,
  `map_fname` text NOT NULL,
  `how_to_text` text NOT NULL,
  `address` text NOT NULL,
  `city_state_zip` text NOT NULL,
  `phone_number` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home`
--

INSERT INTO `home` (`intro_heading_text`, `intro_text`, `map_fname`, `how_to_text`, `address`, `city_state_zip`, `phone_number`, `email`) VALUES
('Information', '        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', 'mapMaterials/map.jpg', '        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Erat imperdiet sed euismod nisi porta. Eget magna fermentum iaculis eu non diam phasellus vestibulum lorem. </p>\r\n', '123 Main Street', 'City, State ZIP', '123-456-7890', 'info@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `uName` text NOT NULL,
  `passwd` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uName`, `passwd`) VALUES
(0, 'admin', '$2y$10$i0UgAcazocOrpgs8LT3W4eaD0dhIj.aubc/t0pvfY3jqmF1t8n4Q.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `historic_sites`
--
ALTER TABLE `historic_sites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `historic_sites`
--
ALTER TABLE `historic_sites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
