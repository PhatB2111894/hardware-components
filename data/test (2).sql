-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 28, 2024 lúc 03:26 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `test`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `flowers`
--

CREATE TABLE `flowers` (
  `id` int(11) NOT NULL,
  `flowerName` varchar(150) NOT NULL,
  `breed` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `price` int(12) NOT NULL,
  `status` int(1) DEFAULT NULL,
  `size` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `category` int(1) DEFAULT NULL CHECK (`category` = 0 or `category` = 1 or `category` = 2),
  `photoURLs` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`photoURLs`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `flowers`
--

INSERT INTO `flowers` (`id`, `flowerName`, `breed`, `color`, `price`, `status`, `size`, `description`, `category`, `photoURLs`, `created_at`, `update_at`) VALUES
(2, 'Cẩm Tú Cầu ( Hồng ) ', 'Cẩm Tú Cầu', 'Hồng', 800000, 1, 'Lớn', 'Nét đẹp dịu dàng thuần khiết từ những cành hoa cẩm tú cầu với thật nhiều sắc màu xanh thiên thanh, hồng ngọt ngào, tím mộng mơ cũng sẽ là lựa chọn hoa tươi hoàn hảo cho dịp Tốt Nghiệp của “hommies” nhà bạn. Cẩm tú cầu khoác lên mình lớp áo từ những cánh hoa tí hon xếp thành từng lớp nhịp nhàng, mang theo ý nghĩa về ước mong một cuộc sống bình an, đủ đầy và trọn vẹn tình yêu. Một bó hoa cẩm tú cầu tròn trĩnh yêu thương và đong đầy lời chúc sẽ là món quà giúp bạn thân hiểu được tấm chân tình của người tặng', 1, '{\"photo1\":\"..\\/picture\\/camtucauhong1avt.jpg\",\"photo2\":\"..\\/picture\\/camtucauhong2.jpg\",\"photo3\":\"..\\/picture\\/camtucauhong3.jpg\",\"photo4\":\"..\\/picture\\/camtucauhong4.jpg\"}', '2024-02-17 17:58:03', '2024-02-17 17:58:03'),
(113, 'Hoa Baby Trắng Siêu Xinh', 'Baby Trắng', 'Trắng', 1000000, NULL, 'Lớn', 'Bó hoa mang phong cách hiện đại cực hợp xu hướng sẽ là một món quà đầy tinh tế giúp bạn ghi điểm trong mắt người bạn đáng yêu ấy đó. Bó hoa trắng tinh khiết lại vô cùng ngọt ngào cùng tông giấy gói màu hồng thanh lịch, như một dải mây mộng mơ đầy sắc màu, hứa hẹn đem đến niềm vui và hạnh phúc cho người được nhận.', 1, '{\"photo1\":\"..\\/picture\\/babytrang1avt.jpg\",\"photo2\":\"..\\/picture\\/babytrang2.jpg\",\"photo3\":\"..\\/picture\\/babytrang3.jpg\",\"photo4\":\"..\\/picture\\/babytrang4.jpg\"}', '2024-02-17 17:41:56', '2024-02-17 17:41:56'),
(114, 'Cúc Họa Mi ', 'Hoa Cúc Họa Mi', 'Trắng, nhụy vàng', 700000, NULL, 'Trung Bình', 'Cúc họa mi là loài hoa mang nhiều ý nghĩa. Nhưng có lẽ ý nghĩa nổi bật nhất là sự bình dị, giản đơn nhưng chân thành trong cuộc sống. Lý do vì sao một loài hoa bình thường, gần gũi lại có sức hút đến như vậy? Hoa cúc là một trong những loài hoa gần gũi, quen thuộc nhất trong cuộc sống. Dù có quen thuộc như vậy nhưng những bông hoa nhỏ vẫn có sức cuốn hút lạ kỳ. Nó mang ý nghĩa rằng sự giản đơn, bình dị nhưng vẫn có dấu ấn riêng. Hoa cúc họa mi cũng tượng trưng cho những điều chân thành bình dị trong cuộc sống, trong tình yêu.', 1, '{\"photo1\":\"..\\/picture\\/cuchoami1avt.jpg\",\"photo2\":\"..\\/picture\\/cuchoami2.jpg\",\"photo3\":\"..\\/picture\\/cuchoami3.jpg\",\"photo4\":\"..\\/picture\\/cuchoami4.jpg\"}', '2024-02-17 17:48:13', '2024-02-17 17:48:13'),
(115, 'Sắc Hồng Đỏ ', 'Hoa Hồng Đỏ', 'Đỏ', 600000, NULL, 'Nhỏ', 'Hoa hồng đỏ là biểu tượng của sự lãng mạn trong tình yêu, niềm đam mê mãnh liệt. Màu sắc này thể hiện cho tình cảm sâu đậm mà bạn dành cho người ấy.\r\nĐể bày tỏ và thổ lộ tình cảm với đối phương thì đây quả là món quà ý nghĩa.', 1, '{\"photo1\":\"..\\/picture\\/hoahong1avt.png\",\"photo2\":\"..\\/picture\\/hoahong2.jpg\",\"photo3\":\"..\\/picture\\/hoahong3.jpg\",\"photo4\":\"..\\/picture\\/hoahong4.jpg\"}', '2024-02-17 17:53:23', '2024-02-17 17:53:23'),
(116, 'Hoa Hướng Dương Nhỏ Xinh ', 'Hoa Hướng Dương', 'Vàng', 400000, NULL, 'Nhỏ', 'Hoa hướng dương tượng trưng cho sự đáng yêu, trung thành và trường thọ. Phần lớn ý nghĩa của hoa hướng dương bắt nguồn từ chính cái tên của nó, chính là mặt trời - một biểu tượng mãnh liệt của sự sống.Ngoài ra, Hoa hướng dương được biết đến là loài hoa hạnh phúc đối với người Do Thái, làm cho chúng trở thành món quà hoàn hảo để mang lại niềm vui cho ngày đặc biệt của ai đó hoặc của chính bạn.', 1, '{\"photo1\":\"..\\/picture\\/hoahuongduong1avt.jpg\",\"photo2\":\"..\\/picture\\/hoahuongduong2.jpg\",\"photo3\":\"..\\/picture\\/hoahuongduong3.jpg\",\"photo4\":\"..\\/picture\\/hoahuongduong4.jpg\"}', '2024-02-17 17:56:57', '2024-02-17 17:56:57'),
(117, 'Hoa Sen Trắng', 'Hoa Sen', 'Trắng', 500000, NULL, 'Trung Bình', 'Hoa sen màu trắng : tượng trưng cho sự tinh khôi, thanh khiết và tịnh tâm trong tâm hồn con người. Ngoài ra, hoa sen trắng còn được biết đến với ý nghĩa chính là sự đức hạnh, bình dị và thanh cao trong tâm hồn phụ nữ.Những ngày hè tháng 6 với hoa sen thơm ngát. Dành tặng bó hoa sen trắng  riêng cho ai đó sinh nhật tháng 6 này bạn nhé! Còn gì ý nghĩa hơn một bó hoa sinh nhật mà đó lại là loài hoa đặc trưng của ngày tháng mình sinh ra.', 1, '{\"photo1\":\"..\\/picture\\/hoasen1avt.jpg\",\"photo2\":\"..\\/picture\\/hoasen2.jpg\",\"photo3\":\"..\\/picture\\/hoasen3.jpg\",\"photo4\":\"..\\/picture\\/hoasen4.jpg\"}', '2024-02-17 18:02:38', '2024-02-17 18:02:38'),
(118, 'Hoa Hồng Sáp Xanh', 'Hoa Hồng Sáp', 'Xanh Dương', 500000, NULL, 'Nhỏ', 'Hoa sáp màu xanh biển là một màu hoa lạ, được sinh ra từ truyền thuyết cổ xưa. Những cánh hoa hồng sáp màu xanh biển mang ý nghĩa về “tình yêu bất diệt” thay lời hứa bên nhau trọn đời trọn kiếp gửi gắm đến nửa kia của bạn, là quà tặng tỏ tình đầy sức mạnh và ý nghĩa.Hoa sáp màu xanh biển này còn mang ý nghĩa khen tặng cá tính đặc biệt mạnh mẽ của người nhận, sự ngưỡng mộ và đề cao những giấc mơ khó lòng thực hiện được cùng hương thơm nhẹ nhàng, thích hợp để tặng cho người thân, bạn bè, đồng nghiệp để thể hiện sự trân trọng, và quý mến của bạn', 1, '{\"photo1\":\"..\\/picture\\/hongsapxanh1avt.jpg\",\"photo2\":\"..\\/picture\\/hongsapxanh2.jpg\",\"photo3\":\"..\\/picture\\/hongsapxanh3.jpg\",\"photo4\":\"..\\/picture\\/hongsapxanh4.jpg\"}', '2024-02-17 18:05:08', '2024-02-17 18:05:08'),
(119, 'Hoa Mẫu Đơn Hồng', 'Mẫu Đơn', 'Hồng', 600000, NULL, 'Trung Bình', 'Mẫu đơn hồng như hiện thân của một thiếu nữ mới lớn. Đơn giản nhưng không kém phần duyên dáng. Nếu chọn hoa mẫu đơn hồng làm quà thì đó có nghĩa là người tặng công nhận vẻ đẹp của người họ yêu thương, trân trọng. \r\nNgoài ra hoa mẫu đơn còn là tình mẫu tử, sự bao dung của lòng mẹ. Dù con có trưởng thành, có gia đình thì trong lòng mẹ con vẫn là đứa con bé bỏng. Sự yêu thương và lo lắng của mẹ dành cho con không hề giảm mà càng ngày càng tăng lên khi nhìn con khôn lớn mỗi ngày.Hãy mua hoa tặng mẹ và người yêu bạn nhé!\r\n', 1, '{\"photo1\":\"..\\/picture\\/maudon4.jpg\",\"photo2\":\"..\\/picture\\/maudon1avt.jpg\",\"photo3\":\"..\\/picture\\/maudon2.jpg\",\"photo4\":\"..\\/picture\\/maudon3.jpg\"}', '2024-02-17 18:13:43', '2024-02-17 18:13:43'),
(120, 'Thạch Thảo Hồng', 'Cúc Thạch Thảo', 'Hồng', 450000, NULL, 'Lớn', ' Ý nghĩa hoa Thạch Thảo màu này tượng trưng cho sự may mắn, vui vẻ. Người Việt Nam mình thường hay chọn hoa hồng này vào dịp lễ tết trưng bày trong nhà để mang niềm vui, hạnh phúc, bình an về nhà.\r\nNgày phụ nữ Việt Nam mua hoa tặng cho mẹ, cho người yêu, cho chị gái đều phù hợp. Bạn có thể chọn hoa với màu sắc ý nghĩa riêng cho từng người, chẳng hạn hoa tím tặng người yêu, hoa màu hồng tặng người mẹ. Đính kèm theo bó hoa tươi là chiếc thiệp nhỏ ghi lời chúc vô cùng xinh xắn thì người nhận sẽ cảm động lắm.', 1, '{\"photo1\":\"..\\/picture\\/thachthao1avt.jpg\",\"photo2\":\"..\\/picture\\/thachthao2.jpg\",\"photo3\":\"..\\/picture\\/thachthao3.jpg\",\"photo4\":\"..\\/picture\\/thachthao4.jpg\"}', '2024-02-17 18:24:24', '2024-02-17 18:24:24'),
(121, 'Tulip Hồng Ngọt Ngào', 'Tulip', 'Hồng', 2000000, NULL, 'Nhỏ', 'Ý nghĩa hoa Tulip hồng đại diện cho tình yêu e ấp vừa mới chơm nở, tặng cho người con gái mình yêu một bó hoa Tulip hồng đẹp để thể hiện sự quan tâm cũng như mong muốn được ở bên cạnh chăm sóc cô ấy đến cuối đời.Hoa Tulip hồng giống như sợi tơ hồng kết nối những người có tâm hồn đồng điệu lại với nhau. Chúng đại diện cho sự nhiệt huyết và nồng nàn trong tình yêu, mong muốn có được hạnh phúc với người mình yêu khi cả hai đã cùng nhau trải qua những sóng gió trong cuộc đời. Chính vì thế, hoa Tulip hồng thường được sự dụng để trang trí tiệc và hoa cầm tay cô dâu với mong muốn có được hạnh phúc viên mãn.\r\nNgoài tình yêu thì ý nghĩa hoa Tulip hồng còn là một lời chúc tốt đẹp trong công việc. Tặng hoa Tulip hồng đẹp cho đồng nghiệp, bạn bè hay những người mà ta thân thiết mang ngụ ý chúc cho họ luôn may mắn và gặp được nhiều điều suôn sẻ trong cuộc sống. Hoa Tulip hồng rất được yêu thích để làm quà tặng vào ngày khai trương, lễ tốt nghiệp,…', 1, '{\"photo1\":\"..\\/picture\\/tulip1avt.jpg\",\"photo2\":\"..\\/picture\\/tulip2.jpg\",\"photo3\":\"..\\/picture\\/tulip3.jpg\",\"photo4\":\"..\\/picture\\/tulip4.jpg\"}', '2024-02-17 18:29:59', '2024-02-17 18:29:59'),
(122, 'Mùi Oải Hương (Lavender)', 'Oải hương', 'Tím', 550000, NULL, 'Nhỏ', 'Hoa oải hương là biểu tượng cho sự tinh khiết, duyên dáng, nhẹ nhàng và tận tâm.Hoa Lavender còn được gọi là herb of love (thảo dược tình yêu). Nó tượng trưng cho tình yêu son sắc, thuỷ chung.Mùa Oải Hương được thiết kế dựa trên cảm hứng từ những cánh đồng oải hương tím đầy thơ mộng và ngập tràn hương thơm. Giỏ hoa hương Lavender sẽ giúp bạn gửi tặng cả hương sắc của mùa hè châu Âu đầy thơ mộng tới một nửa của mình vào những dịp đặc biệt.', 1, '{\"photo1\":\"..\\/picture\\/oaihuong1avt.jpg\",\"photo2\":\"..\\/picture\\/oaihuong2.jpg\",\"photo3\":\"..\\/picture\\/oaihuong3.jpg\",\"photo4\":\"..\\/picture\\/oaihuong4.jpg\"}', '2024-02-17 18:35:55', '2024-02-17 18:35:55'),
(123, 'Hoa cưới baby', 'Hoa Baby', 'Hồng', 700000, NULL, 'Trung Bình', 'Hoa baby cưới cầm tay là một phần không thể thiếu trong ngày cưới của cặp đôi. Được thiết kế từ những bông hoa nhỏ nhắn và dễ thương, hoa baby cầm tay thường được sắp xếp cẩn thận và tinh tế trong từng cánh hoa. Sự nhẹ nhàng và dịu dàng của hoa baby cầm tay tạo ra một vẻ đẹp đặc biệt và tinh tế, góp phần làm nổi bật vẻ đẹp của cô dâu trong ngày trọng đại.\r\nHoa baby cầm tay thường được chọn lựa phù hợp với màu sắc và phong cách của bộ trang phục cô dâu. Đồng thời, chúng cũng được kết hợp với các loại hoa khác và phụ kiện trang trí như lá, dây ruy băng, hay phụ kiện kim loại để tạo ra một bó hoa hoàn hảo và độc đáo.\r\nNgoài việc làm đẹp cho cô dâu, hoa baby cầm tay cũng mang trong mình nhiều ý nghĩa tượng trưng về tình yêu, sự may mắn và hạnh phúc trong hôn nhân. Chính vì vậy, hoa baby cầm tay không chỉ là một món đồ trang trí mà còn là biểu tượng của sự tình cảm và ý nghĩa trong ngày cưới.', 0, '{\"photo1\":\"..\\/picture\\/babycuoi1avt.jpg\",\"photo2\":\"..\\/picture\\/babycuoi2.jpg\",\"photo3\":\"..\\/picture\\/cuoibaby3.jpg\",\"photo4\":\"..\\/picture\\/cuoibaby4.jpg\"}', '2024-02-27 17:09:29', '2024-02-27 17:09:29'),
(124, 'Hoa Cưới Cầm Tay Anemone', 'Hoa Anemone', 'Trắng', 1000000, NULL, 'Nhỏ', 'Hoa cưới cầm tay anemone là một biểu tượng của tình yêu và hạnh phúc trong ngày cưới. Anemone thường được coi là loài hoa biểu tượng cho tình yêu mạnh mẽ, đam mê và tinh tế. Dưới ánh sáng tự nhiên, những bông hoa anemone thường tỏa sáng, tạo nên một vẻ đẹp tinh khiết và lãng mạn.\r\nĐặc biệt, hoa anemone có một ý nghĩa sâu sắc trong nghệ thuật và văn hóa. Truyền thống phương Tây cho rằng anemone biểu trưng cho tình yêu trắng trong văn hóa Hy Lạp cổ điển, còn trong văn hóa phương Đông, anemone thường được coi là biểu tượng của sự may mắn và hạnh phúc.\r\nHoa cưới cầm tay anemone thường được sắp xếp cùng với các loại hoa khác và phụ kiện trang trí như lá, dây ruy băng, hay phụ kiện kim loại để tạo ra một bó hoa độc đáo và đẹp mắt. Việc chọn hoa anemone làm điểm nhấn cho bó hoa cưới không chỉ tạo nên một vẻ đẹp độc đáo mà còn mang theo ý nghĩa sâu sắc về tình yêu và hạnh phúc trong hôn nhân.', 0, '{\"photo1\":\"..\\/picture\\/anemone.jpg\",\"photo2\":\"..\\/picture\\/anemone1avt.jpg\",\"photo3\":\"..\\/picture\\/anemone3.jpg\",\"photo4\":\"..\\/picture\\/anemone4.jpg\"}', '2024-02-27 17:14:41', '2024-02-27 17:14:41'),
(125, 'Hoa Cưới Dạ Lan Hương', 'Dạ Lan Hương', 'Tím', 1100000, NULL, 'Nhỏ', 'Hoa cưới cầm tay dạ lan hương mang đến một tinh thần sang trọng và tươi mới cho ngày cưới. Với vẻ đẹp kiêng nhẫn và quý phái, dạ lan hương không chỉ làm cho buổi lễ trở nên trang trọng mà còn thể hiện sự mãnh liệt và sâu sắc của tình yêu. Sự hòa quyện giữa màu sắc nhẹ nhàng và hương thơm dịu dàng của dạ lan hương mang lại một không gian trong lành và lãng mạn cho cặp đôi.\r\nHoa cưới cầm tay dạ lan hương cũng là biểu tượng của sự tinh tế và nữ tính, thể hiện sự quyến rũ và đằm thắm của phụ nữ. Trong ngày trọng đại của cuộc đời, hoa dạ lan hương không chỉ làm cho cô dâu trở nên quý phái mà còn tôn lên vẻ đẹp tự nhiên và thuần khiết của người phụ nữ.\r\nBên cạnh đó, hoa cưới cầm tay dạ lan hương còn mang theo ý nghĩa về sự may mắn và hạnh phúc trong hôn nhân. Việc chọn hoa này cho buổi cưới thường được coi là một lời chúc phúc và lời chúc tốt đẹp cho cuộc sống hôn nhân của cặp đôi. Từ vẻ đẹp tinh khiết và sự quý phái của dạ lan hương, chúng ta có thể thấy được sức mạnh của tình yêu và sự bền vững của mối quan hệ.\r\nTrong tổ chức buổi cưới, việc sử dụng hoa cưới cầm tay dạ lan hương không chỉ làm cho không gian trở nên lãng mạn và sang trọng mà còn thể hiện sự tôn trọng và yêu thương đối với người phối ngẫu. Đó chính là lý do tại sao dạ lan hương luôn là một trong những lựa chọn phổ biến và đáng giá cho ngày trọng đại của mọi cặp đôi.', 0, '{\"photo1\":\"..\\/picture\\/dalanhuong1avt.jpg\",\"photo2\":\"..\\/picture\\/dalanhuong2.jpg\",\"photo3\":\"..\\/picture\\/dalanhuong3.jpg\",\"photo4\":\"..\\/picture\\/dalanhuong4.jpg\"}', '2024-02-27 17:19:47', '2024-02-27 17:19:47'),
(126, 'Hoa cưới cúc họa mi', 'Cúc Họa Mi', 'Trắng', 650000, NULL, 'Trung Bình', 'Với vẻ đẹp tinh khôi và dễ thương, hoa cúc họa mi thường được coi là biểu tượng của tình yêu trong sáng, sự thuần khiết và niềm hy vọng. Đặc điểm nổi bật của hoa cúc họa mi là những cánh hoa nhỏ trắng mịn, tinh khôi và nở rộ, tạo nên một bức tranh tự nhiên tươi mới.\r\nTrong ngày cưới, việc chọn hoa cúc họa mi cầm tay thường mang theo ý nghĩa của sự thuần khiết và trung thành trong tình yêu. Hoa cúc họa mi còn được coi là biểu tượng của sự may mắn và hạnh phúc, đồng thời thể hiện sự tươi mới và sự đổi mới trong cuộc sống mới của cặp đôi.\r\nBên cạnh đó, hoa cúc họa mi còn tượng trưng cho sự bền vững và kiên nhẫn, như những cánh hoa mở rộng từng ngày, từng cung bậc. Điều này gửi đi thông điệp về sự kiên định và lòng tin vào tương lai hạnh phúc của đôi uyên ương. Do đó, việc chọn hoa cúc họa mi cầm tay cho ngày cưới không chỉ làm cho không gian trở nên tươi mới và lãng mạn mà còn thể hiện sự ý nghĩa sâu sắc và đầy ý nghĩa của ngày trọng đại này.\r\n\r\n\r\n\r\n', 0, '{\"photo1\":\"..\\/picture\\/hoacuoicuc1avt.jpg\",\"photo2\":\"..\\/picture\\/hoacuoicuc2.jpg\",\"photo3\":\"..\\/picture\\/hoacuoicuc3.jpg\",\"photo4\":\"..\\/picture\\/hoacuoicuc4.jpg\"}', '2024-02-27 17:23:37', '2024-02-27 17:23:37'),
(127, 'Hoa Rum Cầm Tay Ngày Cưới', 'Hoa Rum', 'Trắng', 2100000, NULL, 'Nhỏ', 'Hoa rum cầm tay trong ngày cưới không chỉ mang lại vẻ đẹp lãng mạn mà còn chứa đựng nhiều ý nghĩa sâu sắc và đặc biệt. Đặc điểm nổi bật của hoa rum là hình dáng nhỏ xinh, cùng với sắc màu tươi sáng và mùi hương dịu dàng.\r\nHoa rum thường được coi là biểu tượng của tình yêu vĩnh cửu và sự đoàn kết. Những bông hoa nhỏ xinh trên cành rum biểu trưng cho tình yêu dịu dàng, tinh khôi và vững chắc, giống như tình yêu của đôi uyên ương sẽ mãi mãi đọng lại trong lòng nhau.\r\nNgoài ra, hoa rum còn mang ý nghĩa về sự tươi mới, may mắn và hạnh phúc. Bởi vẻ đẹp tươi mới của hoa rum khiến cho không gian trở nên rạng ngời và lấp lánh, tạo nên một bầu không khí lễ hội và vui tươi trong ngày trọng đại của đôi tân lang tân nương.\r\nHoa rum cũng thường được coi là biểu tượng của sự chân thành và sự may mắn trong tình yêu. Việc chọn hoa rum cầm tay trong ngày cưới không chỉ làm cho bó hoa trở nên đẹp mắt và sinh động mà còn truyền tải thông điệp về sự chân thành và hy vọng vào một tương lai hạnh phúc và viên mãn của đôi uyên ương.\r\n', 0, '{\"photo1\":\"..\\/picture\\/hoarum1avt.jpg\",\"photo2\":\"..\\/picture\\/hoarum2.jpg\",\"photo3\":\"..\\/picture\\/hoarum3.jpg\",\"photo4\":\"..\\/picture\\/hoarum4.jpg\"}', '2024-02-27 17:37:09', '2024-02-27 17:37:09'),
(128, 'Hoa Hồng Trắng Cầm Tay', 'Hoa Hồng Trắng', 'Trắng', 600000, NULL, 'Trung Bình', 'Hoa hồng trắng cầm tay trong ngày cưới mang đến một thông điệp đậm chất lãng mạn và tinh tế. Đây không chỉ là một biểu tượng của sự thuần khiết và trong sáng trong tình yêu, mà còn thể hiện sự kính trọng và tôn trọng của người trao gửi. Bó hoa hồng trắng như một lời thề nguyện của đôi uyên ương, với hy vọng về một cuộc sống hạnh phúc và an lành bên nhau.\r\nMỗi bông hoa hồng trắng như một hạt ngọc màu trắng thuần khiết, là biểu tượng của tình yêu đích thực và không gian thơm ngát mê hoặc. Trên hành trình mới bắt đầu của họ, đôi uyên ương cầm hoa hồng trắng cũng đang gửi đi những lời chúc tốt lành và may mắn cho tương lai hạnh phúc của mình.\r\nVới sự thanh lịch và tinh tế, hoa hồng trắng không chỉ tô điểm thêm cho ngày trọng đại của họ mà còn làm cho không gian trở nên tràn đầy cảm xúc và lãng mạn hơn bao giờ hết. Điều này chứng tỏ sự quan trọng và ý nghĩa của một tình yêu chân thành và bền vững, được xây dựng trên sự kính trọng và lòng tin.', 0, '{\"photo1\":\"..\\/picture\\/hongtrangcuoi1avt.jpg\",\"photo2\":\"..\\/picture\\/hongtrangcuoi2.jpg\",\"photo3\":\"..\\/picture\\/hongtrangcuoi3.jpg\",\"photo4\":\"..\\/picture\\/hongtrangcuoi4.jpg\"}', '2024-02-27 17:46:23', '2024-02-27 17:46:23'),
(129, 'Hoa Cưới Hoa Hồng Đỏ', 'Hoa Hồng Đỏ', 'Hoa Hồng Đỏ', 500000, NULL, 'Lớn', 'Hoa hồng đỏ cầm tay trong ngày cưới không chỉ là một biểu tượng của tình yêu mãnh liệt mà còn là sự tôn vinh của sự đam mê và lòng nhiệt huyết trong tình yêu. Màu đỏ rực rỡ của hoa hồng đỏ đại diện cho sự nồng nhiệt, sự tương phản, và sự sống động của tình yêu không giới hạn.\r\nKhi đôi uyên ương cầm những bông hoa hồng đỏ, họ đang chia sẻ thông điệp về tình yêu mãnh liệt, sự cam kết và lòng trung thành với nhau. Mỗi bông hoa hồng đỏ như một lời thề nguyện, cam kết về tình yêu bền vững và sự hạnh phúc mãi mãi.\r\nHoa hồng đỏ cũng biểu hiện sự kiêu hãnh và vinh quang trong tình yêu. Đó là biểu tượng của sức mạnh và đẳng cấp, thể hiện quyết tâm và lòng dũng cảm để vượt qua mọi khó khăn, mọi thách thức để bảo vệ và giữ gìn tình yêu của họ.\r\nCuối cùng, hoa hồng đỏ còn đại diện cho một tình yêu mãnh liệt và say đắm, với hy vọng về một cuộc sống đầy hạnh phúc và đam mê bên nhau. Đôi uyên ương cầm hoa hồng đỏ đang bày tỏ lòng trân trọng và sự biết ơn về mối quan hệ đặc biệt và ý nghĩa của họ.', 0, '{\"photo1\":\"..\\/picture\\/hongdo1avt.jpg\",\"photo2\":\"..\\/picture\\/hongdo2.jpg\",\"photo3\":\"..\\/picture\\/hongdo3.jpg\",\"photo4\":\"..\\/picture\\/hongdo4.jpg\"}', '2024-02-27 17:49:20', '2024-02-27 17:49:20'),
(130, 'Hoa Cưới Juliet', 'Hoa Juliet', 'Trắng - Cam', 1700000, NULL, 'Trung Bình', 'Hoa Juliet, với vẻ đẹp dịu dàng và thanh lịch, mang theo một thông điệp tinh tế và đầy ý nghĩa trong ngày cưới. Được biết đến với vẻ đẹp tinh khiết và sự dịu dàng, hoa Juliet thường được chọn để tôn vinh tình yêu ngọt ngào và tương tự như một biểu tượng của sự tinh khôi và tương thân thiện.\r\nKhi cầm hoa Juliet trong ngày cưới, đôi uyên ương đang truyền tải một thông điệp về tình yêu lãng mạn và lòng trung thành. Màu hồng nhẹ nhàng của hoa Juliet đại diện cho sự tình cảm, sự dịu dàng và lòng nhân từ, đồng thời cũng thể hiện sự mong chờ và hy vọng trong tương lai.\r\nHoa Juliet cũng biểu hiện sự tôn trọng và sự quý phái trong mối quan hệ, với việc chọn lựa một loại hoa mang đến sự tinh tế và thanh lịch. Đây là biểu tượng của một tình yêu đẹp đẽ, chân thành và bền vững, một cam kết về một cuộc sống hạnh phúc và ấm áp bên nhau.\r\nCuối cùng, hoa Juliet còn thể hiện sự biết ơn và lòng tri ân đối với mối quan hệ và những khoảnh khắc đáng nhớ của đôi uyên ương. Việc cầm hoa Juliet trong ngày cưới là một cách để thể hiện lòng biết ơn và sự trân trọng về tình yêu và hạnh phúc mà họ đã tìm thấy trong nhau.', 0, '{\"photo1\":\"..\\/picture\\/juletcuoi1avt.jpg\",\"photo2\":\"..\\/picture\\/juletcuoi2.jpg\",\"photo3\":\"..\\/picture\\/juletcuoi3.jpg\",\"photo4\":\"..\\/picture\\/juletcuoi4.jpg\"}', '2024-02-27 17:52:18', '2024-02-27 17:52:18'),
(131, 'Hoa Cưới Lan Hồ Điệp', 'Hoa Lan Hồ Điệp', 'Trắng', 900000, NULL, 'Trung Bình', 'Hoa lan hồ điệp, với vẻ đẹp kiêu sa và quý phái, không chỉ là một loài hoa lâu đời được yêu thích mà còn mang theo một thông điệp ý nghĩa trong ngày cưới. Với những bông hoa đẹp mê hồn và hương thơm dịu dàng, hoa lan hồ điệp thường được coi là biểu tượng của sự thanh cao, đẳng cấp và tình yêu trường tồn.\r\nKhi cầm hoa lan hồ điệp trong ngày cưới, cặp đôi đang truyền đạt một thông điệp về sự lãng mạn và sự tinh tế. Màu trắng tinh khôi của hoa lan hồ điệp thể hiện sự trong sáng và tinh khiết của tình yêu, đồng thời cũng tượng trưng cho sự thuần khiết và tương lai tươi sáng của mối quan hệ.\r\nHoa lan hồ điệp còn biểu hiện sự quý phái và tinh tế, với vẻ đẹp kiêu sa và sang trọng. Việc cầm hoa lan hồ điệp trong ngày cưới là một lựa chọn tôn vinh sự thanh lịch và đẳng cấp của tình yêu và cuộc sống hôn nhân.\r\nCuối cùng, hoa lan hồ điệp còn thể hiện sự kiêng nhẫn và lòng chung thủy trong tình yêu, bởi vì những bông hoa này thường mọc và nở rộ trong thời gian dài. Việc chọn hoa lan hồ điệp làm hoa cưới cầm tay là một biểu hiện của sự cam kết về một tình yêu vĩnh cửu và một cuộc sống hạnh phúc và bền vững.', 0, '{\"photo1\":\"..\\/picture\\/lanhodiep1avt.jpg\",\"photo2\":\"..\\/picture\\/lanhodiep2.jpg\",\"photo3\":\"..\\/picture\\/lanhodiep3.jpg\",\"photo4\":\"..\\/picture\\/lanhodiep4.jpg\"}', '2024-02-27 17:54:38', '2024-02-27 17:54:38'),
(132, 'Hoa Linh Lan (Hoa Cưới)', 'Hoa Linh Lan', 'Trắng', 2500000, NULL, 'Nhỏ', 'Hoa linh lan, với vẻ đẹp kiêu sa và quý phái, đem lại một thông điệp tinh tế và sâu sắc trong ngày cưới. Loài hoa này thường được chọn để thể hiện sự sang trọng, tinh tế và sự thanh lịch, làm tôn vinh cho một tình yêu cao quý và đầy ý nghĩa.\r\nKhi cầm hoa linh lan trong ngày cưới, đôi uyên ương đang gửi đi một thông điệp về sự quý phái và tinh túy. Màu trắng tinh khôi của hoa linh lan thường được xem như biểu tượng cho sự thuần khiết, trong trắng và sự hoàn hảo, đồng thời cũng thể hiện sự tinh tế và lịch lãm.\r\nHoa linh lan còn biểu hiện sự kiêu sa và đẳng cấp trong mối quan hệ, thể hiện sự tôn trọng và lòng trân trọng đối với đối tác của mình. Việc chọn lựa hoa linh lan là một cách để tôn vinh sự quý giá và đẳng cấp của mối quan hệ, đồng thời thể hiện sự mong muốn về một tương lai lấp lánh và hạnh phúc.\r\nCuối cùng, hoa linh lan cũng thể hiện sự biết ơn và lòng tri ân đối với những khoảnh khắc đẹp đẽ và ý nghĩa trong cuộc sống của đôi uyên ương. Việc cầm hoa linh lan trong ngày cưới là một cách để tỏ lòng biết ơn và sự trân trọng về một tình yêu cao quý và đầy ý nghĩa.', 0, '{\"photo1\":\"..\\/picture\\/linhlancuoi1avt.jpg\",\"photo2\":\"..\\/picture\\/linhlancuoi2.jpg\",\"photo3\":\"..\\/picture\\/linhlancuoi3.jpg\",\"photo4\":\"..\\/picture\\/linhlancuoi4.jpg\"}', '2024-02-27 17:57:32', '2024-02-27 17:57:32'),
(133, 'Hoa Sen (Hoa Cưới)', 'Hoa Sen', 'Trắng', 750000, NULL, 'Trung Bình', 'Hoa sen, với vẻ đẹp kiêu sa và tinh tế, đem lại một thông điệp sâu sắc và ý nghĩa trong ngày cưới. Loài hoa này thường được chọn để thể hiện sự thanh lịch, tinh tế và sự trường tồn của tình yêu.\r\nKhi cầm hoa sen trong ngày cưới, đôi uyên ương đang gửi đi một thông điệp về sự thuần khiết và sự tinh tế. Màu trắng tinh khôi của hoa sen thường được xem như biểu tượng cho sự trong sáng, thuần khiết và tinh túy của tình yêu, đồng thời cũng thể hiện sự thanh cao và quý phái.\r\nHoa sen còn biểu hiện sự bền vững và sức mạnh, thể hiện sự kiên trì và lòng tin vào tương lai của mối quan hệ. Việc chọn lựa hoa sen là một cách để thể hiện sự kiên định và sự cam kết vững chắc của đôi uyên ương với nhau.\r\nCuối cùng, hoa sen cũng thể hiện sự biết ơn và lòng tri ân đối với những khoảnh khắc đẹp đẽ và ý nghĩa trong cuộc sống của đôi uyên ương. Việc cầm hoa sen trong ngày cưới là một cách để tỏ lòng biết ơn và sự trân trọng về một tình yêu thuần khiết và vĩnh cửu.', 0, '{\"photo1\":\"..\\/picture\\/sencuoi1avt.jpg\",\"photo2\":\"..\\/picture\\/sencuoi2.jpg\",\"photo3\":\"..\\/picture\\/sencuoi3.jpg\",\"photo4\":\"..\\/picture\\/sencuoi4.jpg\"}', '2024-02-27 17:59:44', '2024-02-27 17:59:44'),
(134, 'Hoa Cưới Sen Đá', 'Sen Đá', 'Xanh', 800000, NULL, 'Trung Bình', 'Hoa sen đá màu xanh không chỉ đẹp mắt mà còn mang trong đó những ý nghĩa sâu sắc và tinh tế trong ngày cưới. Màu xanh của hoa sen đá thường được liên kết với sự tươi mới, sự sống và sự thanh bình.\r\nKhi cầm hoa sen đá màu xanh trong ngày cưới, đôi uyên ương đang gửi đi một thông điệp về sự tươi mới và sự bắt đầu mới của cuộc hành trình cùng nhau. Màu xanh thường được coi là biểu tượng của sự phát triển và sự tiến bộ, cho thấy sự mở cửa cho những cơ hội mới và những trải nghiệm mới trong tương lai.\r\nHoa sen đá cũng thể hiện sự bền vững và sức mạnh, nhưng đồng thời còn mang trong đó sự yếu đuối và mong manh của tình yêu. Màu xanh của hoa sen đá có thể đại diện cho sự ổn định và lòng tin vào một tương lai hạnh phúc và bền vững của mối quan hệ.\r\nCuối cùng, hoa sen đá màu xanh còn thể hiện sự hòa hợp và tình thân mật trong mối quan hệ, đồng thời thể hiện sự bình yên và hạnh phúc của đôi uyên ương. Việc chọn lựa hoa sen đá màu xanh là một cách để thể hiện sự hy vọng và niềm tin vào một tương lai đẹp đẽ và viên mãn cùng nhau.', 0, '{\"photo1\":\"..\\/picture\\/sendacuoi1avt.jpg\",\"photo2\":\"..\\/picture\\/sendacuoi2.jpg\",\"photo3\":\"..\\/picture\\/sendacuoi3.jpg\",\"photo4\":\"..\\/picture\\/sendacuoi4.jpg\"}', '2024-02-27 18:06:46', '2024-02-27 18:06:46'),
(135, 'Cẩm Tú Cầu ( Hoa Cưới ) ', 'Cẩm Tú Cầu', 'Hồng', 800000, NULL, 'Lớn', 'Cẩm Tú Cầu\" là một loại hoa lan có hình dáng đẹp mắt và màu sắc lôi cuốn, thường được sử dụng trong các sự kiện đặc biệt như đám cưới. Ý nghĩa của hoa \"Cẩm Tú Cầu\" thường được liên kết với sự may mắn, hạnh phúc và tình yêu.\r\nTrong ngôn ngữ hoa, \"Cẩm Tú Cầu\" thường biểu hiện sự may mắn và thành công trong tình yêu và cuộc sống. Việc sử dụng hoa này trong ngày cưới thường mang ý nghĩa muốn gửi đi lời chúc mừng và hy vọng cho cuộc hôn nhân được hạnh phúc, viên mãn và bền vững.\r\nNgoài ra, \"Cẩm Tú Cầu\" cũng thể hiện sự kiêng nể và tôn trọng. Việc cầm hoa này trong ngày cưới không chỉ là biểu tượng cho tình yêu và hạnh phúc mà còn là sự tôn trọng đối với truyền thống và giá trị gia đình.\r\nTóm lại, \"Cẩm Tú Cầu\" không chỉ là loài hoa đẹp mắt mà còn mang trong đó nhiều ý nghĩa tốt lành và may mắn, là biểu tượng cho một tương lai hạnh phúc và thành công cho đôi uyên ương.', 0, '{\"photo1\":\"..\\/picture\\/tucauhoacuoi1avt.jpg\",\"photo2\":\"..\\/picture\\/tucauhoacuoi2.jpg\",\"photo3\":\"..\\/picture\\/tucauhoacuoi3.jpg\",\"photo4\":\"..\\/picture\\/tucauhoacuoi4.jpg\"}', '2024-02-27 18:10:19', '2024-02-27 18:10:19'),
(136, 'Hoa Cưới TuLip ', 'Hoa TuLip', 'Trắng', 1300000, NULL, 'Nhỏ', 'Hoa tulip, với vẻ đẹp tinh tế và màu sắc rực rỡ, đã trở thành biểu tượng không thể thiếu trong ngày cưới. Ý nghĩa sâu sắc của hoa tulip không chỉ là về vẻ đẹp mà còn là về tình yêu và sự trung thành. Mỗi bông hoa tulip mang theo một thông điệp riêng, từ sự đam mê của màu đỏ đến sự trong sáng của màu trắng, từ lòng trung thành của màu hồng đến sự giàu có và hạnh phúc của màu vàng.\r\nTrên hết, hoa tulip thể hiện sự tươi mới và sự hạnh phúc. Khi cầm hoa tulip trong ngày cưới, đó không chỉ là việc trang trí, mà còn là cách để biểu hiện tình yêu và hy vọng vào một tương lai hạnh phúc, bền vững. Đó là lời chúc mừng và hy vọng được gửi đi cho cặp đôi, và cũng là sự tôn trọng và sự quý trọng dành cho mối quan hệ mà họ đã xây dựng.', 0, '{\"photo1\":\"..\\/picture\\/tulipcuoi1avt.jpg\",\"photo2\":\"..\\/picture\\/tulipcuoi2.jpg\",\"photo3\":\"..\\/picture\\/tulipcuoi3.jpg\",\"photo4\":\"..\\/picture\\/tulipcuoi4.jpg\"}', '2024-02-27 18:15:32', '2024-02-27 18:15:32'),
(137, 'Hoa Mi', 'mi', 'jij', 92029, NULL, 'Trung Bình', 'jsijkoskos', 0, '{\"photo1\":\"..\\/picture\\/thachthao1avt.jpg\",\"photo2\":\"..\\/picture\\/thachthao2.jpg\",\"photo3\":\"..\\/picture\\/thachthao3.jpg\",\"photo4\":\"..\\/picture\\/thachthao4.jpg\"}', '2024-02-27 18:47:41', '2024-02-27 18:47:41');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `flower_id` int(11) NOT NULL,
  `pice` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`id`, `flower_id`, `pice`, `num`, `total_price`, `user_id`, `create_at`, `status_order`) VALUES
(92, 127, 2100000, 1, 2100000, 45, '2024-02-27 18:16:01', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userName` varchar(150) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `photoURL` varchar(255) DEFAULT '../picture/member.png',
  `isAdmin` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `userName`, `password`, `phone`, `address`, `photoURL`, `isAdmin`) VALUES
(1, 'tinh123', '$2y$10$ZWkPJ7S.rnNMUUGgiEgcAu7/dxFr6g4v.U3G/O4J9YvXeuQGOUlOa', '359698247', 'TV', 'picture/admin.jpg', 1),
(34, 'tai', '$2y$10$C.Uamr273otMy/4Dvjtaa.oDNZFNnJQg1uCVupoWbHXJryxaIXkQ2', '0971831109', 'AG', 'picture/member.png', 1),
(35, 'duonghuutinh', '$2y$10$g38Ml6.jLw9aEpkfskHpZerHDJhfmvKq8fJpkxn7WhbFsS6PD9XWq', '0978914671', 'Thanh Sơn,Trà Cú,Trà Vinh', 'picture/61d183263a856e0004c6334a.png', 1),
(44, 'lam', '$2y$10$HtPxMNVHyYNNrUHPsRIOoepYtTT5jQaMQ/0Y6gnebUdp/V93QDvbG', '0971831109', 'AG', '../picture/member.png', 0),
(45, 'quyenadmin', '$2y$10$Mko6DVmL26awv1WscD35X.o9rmyAITXFeGUmzMPy/0b1EEDbiRgqK', '0395549131', 'b2105633', '../picture/admin1.jpg', 1),
(46, 'quyenactor', '$2y$10$/2WKm2t/HUl2yLZn7srcM.gLBQbf77xSzGMzZFRISoLlnlFOfrFn.', '0867788543', 'bhu yuhia q', '../picture/member.png', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `flowers`
--
ALTER TABLE `flowers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flower_id_ibfk_1` (`flower_id`),
  ADD KEY `user_id_ibfk_1` (`user_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userName` (`userName`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `flowers`
--
ALTER TABLE `flowers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `flower_id_ibfk_1` FOREIGN KEY (`flower_id`) REFERENCES `flowers` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_id_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
