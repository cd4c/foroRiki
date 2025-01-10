-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: mysql-db
-- Tiempo de generación: 03-12-2024 a las 19:51:17
-- Versión del servidor: 8.0.39
-- Versión de PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `foroplatos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int NOT NULL,
  `id_receta` int DEFAULT NULL,
  `id_usuario` int DEFAULT NULL,
  `contenido` text NOT NULL,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_respuesta` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `id_receta`, `id_usuario`, `contenido`, `fecha`, `id_respuesta`) VALUES
(1, 1, 2, '¡Me encantó esta receta! Muy fácil de seguir.', '2024-01-11 09:15:00', NULL),
(2, 2, 3, 'La ensalada quedó perfecta, gracias por la receta.', '2024-02-16 14:30:00', NULL),
(3, 3, 4, 'Sushi delicioso, aunque me costó un poco la preparación.', '2024-03-06 19:20:00', NULL),
(4, 4, 5, 'Tacos al pastor increíbles, súper auténticos.', '2024-04-13 16:45:00', NULL),
(5, 5, 6, 'Pad Thai quedó muy sabroso, gracias por los consejos.', '2024-05-23 20:10:00', NULL),
(6, 6, 7, 'La pizza salió crujiente y deliciosa.', '2024-06-19 21:05:00', NULL),
(7, 7, 8, 'El ramen fue un éxito en casa, muy reconfortante.', '2024-07-26 13:50:00', NULL),
(8, 8, 9, 'Falafel crujiente y hummus cremoso, perfecto.', '2024-08-31 12:25:00', NULL),
(9, 9, 11, 'La paella quedó espectacular, todo el mundo la amó.', '2024-09-11 18:00:00', NULL),
(10, 10, 12, 'Burritos fáciles de hacer y muy sabrosos.', '2024-10-06 17:30:00', NULL),
(11, 11, 13, 'El curry de pollo tiene un sabor increíble.', '2024-11-13 20:45:00', NULL),
(12, 12, 14, 'Tiramisu delicioso, perfecto para el postre.', '2024-12-02 22:10:00', NULL),
(13, 13, 15, 'Hamburguesa gourmet quedó espectacular, muy recomendable.', '2025-01-09 15:00:00', NULL),
(14, 14, 16, 'Crepes franceses suaves y deliciosos.', '2025-02-15 11:40:00', NULL),
(15, 15, 17, 'Gyozas llenas y sabrosas, muy fáciles de preparar.', '2025-03-21 19:35:00', NULL),
(16, 16, 18, 'Lasagna vegetariana quedó deliciosa y muy nutritiva.', '2025-04-26 13:20:00', NULL),
(17, 17, 19, 'Pho vietnamita con un caldo espectacular.', '2025-05-31 18:55:00', NULL),
(18, 18, 20, 'Bruschetta italiana simple pero muy sabrosa.', '2025-06-16 14:05:00', NULL),
(19, 19, 1, 'Dim Sum variado perfecto para compartir.', '2025-07-23 20:40:00', NULL),
(20, 20, 2, 'Mousse de chocolate ligero y delicioso.', '2025-08-11 21:15:00', NULL),
(21, 1, 3, '¡Gracias por tu comentario!', '2024-01-11 10:00:00', 1),
(22, 2, 4, 'Nos alegra que te haya gustado.', '2024-02-16 15:00:00', 2),
(23, 5, 7, '¡Gracias por tus comentarios!', '2024-05-23 21:00:00', 5),
(24, 10, 6, '¡Genial que te hayan gustado los burritos!', '2024-10-06 18:00:00', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingredientes`
--

CREATE TABLE `ingredientes` (
  `id_ingrediente` int NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ingredientes`
--

INSERT INTO `ingredientes` (`id_ingrediente`, `nombre`) VALUES
(4, 'Aceite de oliva'),
(3, 'Ajo'),
(13, 'Arroz'),
(14, 'Carne de res'),
(2, 'Cebolla'),
(17, 'Cilantro'),
(20, 'Harina'),
(11, 'Jengibre'),
(10, 'Lechuga'),
(18, 'Limón'),
(7, 'Pasta'),
(16, 'Pasta de curry'),
(6, 'Pimienta'),
(19, 'Pimienta roja'),
(15, 'Pimiento'),
(8, 'Pollo'),
(9, 'Queso'),
(5, 'Sal'),
(12, 'Soja'),
(1, 'Tomate');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recetas`
--

CREATE TABLE `recetas` (
  `id_receta` int NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` text,
  `tiempo_elaboracion` time DEFAULT NULL,
  `fecha_publicacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_admin` int DEFAULT NULL,
  `foto` varchar(255) NOT NULL DEFAULT 'default.png',
  `tipo` enum('tradicional','slow_food','freidora_aire') NOT NULL,
  `dificultad` enum('Fácil','Media','Difícil') NOT NULL DEFAULT 'Media'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `recetas`
--

INSERT INTO `recetas` (`id_receta`, `titulo`, `descripcion`, `tiempo_elaboracion`, `fecha_publicacion`, `id_admin`, `foto`, `tipo`, `dificultad`) VALUES
(1, 'Espaguetis a la Boloñesa', 'Para preparar unos deliciosos espaguetis a la boloñesa, comienza por calentar el aceite de oliva en una sartén grande a fuego medio. Añade la cebolla finamente picada y sofríe hasta que esté transparente. Incorpora el ajo picado y cocina por un minuto más. Agrega la carne de res molida, cocinando hasta que esté bien dorada, desmenuzándola con una cuchara de madera. Una vez la carne esté cocida, añade los tomates triturados y mezcla bien. Condimenta con sal y pimienta al gusto, y añade una pizca de azúcar si los tomates están muy ácidos. Reduce el fuego y deja que la salsa hierva a fuego lento durante unos 30 minutos, removiendo ocasionalmente. Mientras la salsa se cocina, hierve una olla grande con agua salada y cocina los espaguetis según las instrucciones del paquete hasta que estén al dente. Escurre la pasta y resérvala. Una vez la salsa esté espesa y rica en sabor, prueba y ajusta los condimentos si es necesario. Sirve los espaguetis en platos individuales, cubriéndolos generosamente con la salsa boloñesa. Decora con queso parmesano rallado y unas hojas de albahaca fresca para un toque final. ¡Disfruta de este clásico italiano lleno de sabor y tradición!', '00:45:00', '2024-01-10 10:00:00', 10, '1733255149_espagetis.png', 'tradicional', 'Media'),
(2, 'Ensalada César', 'Comienza preparando los ingredientes necesarios para una ensalada César fresca y deliciosa. Lava y seca bien una cabeza de lechuga romana, luego córtala en trozos medianos y colócala en una ensaladera grande. En una sartén, cocina las pechugas de pollo sazonadas con sal y pimienta hasta que estén completamente cocidas y doradas por fuera. Una vez listas, corta el pollo en tiras finas y resérvalo. En un tazón pequeño, mezcla jugo de limón, ajo picado, mostaza Dijon y anchoas trituradas para preparar el aderezo. Mientras mezclas, añade aceite de oliva en un hilo fino para emulsionar la salsa. Vierte el aderezo sobre la lechuga y mezcla bien para que todas las hojas queden cubiertas uniformemente. Añade las tiras de pollo a la ensalada y espolvorea queso parmesano recién rallado por encima. Para un toque crujiente, agrega croutons caseros o comprados. Si lo deseas, puedes añadir un poco de pimienta negra recién molida para realzar los sabores. Sirve inmediatamente para mantener la frescura de la lechuga y la textura crujiente de los croutons. Esta ensalada César es perfecta como entrante o como plato principal ligero y nutritivo.', '00:20:00', '2024-02-15 12:30:00', 10, '1733255181_ensalada.png', 'tradicional', 'Fácil'),
(3, 'Sushi de Salmón', 'Preparar sushi de salmón en casa puede ser una experiencia gratificante y deliciosa. Comienza por cocinar el arroz para sushi siguiendo las instrucciones del paquete. Una vez cocido, sazónalo con una mezcla de vinagre de arroz, azúcar y sal, y déjalo enfriar a temperatura ambiente. Mientras tanto, prepara el salmón fresco, asegurándote de que sea de calidad para consumo crudo. Corta el salmón en tiras finas y resérvalo. Prepara también otros ingredientes como aguacate, pepino y hojas de alga nori. Coloca una hoja de alga nori sobre una esterilla de bambú cubierta con film transparente. Extiende una capa fina de arroz sobre el alga, dejando un borde libre en la parte superior. Coloca las tiras de salmón y aguacate en el centro del arroz, añadiendo también tiras de pepino si lo deseas. Usa la esterilla para enrollar el sushi firmemente, asegurándote de que el rollo quede compacto. Humedece ligeramente el borde libre del alga con agua para sellar el rollo. Corta el rollo en piezas uniformes con un cuchillo afilado y húmedo para evitar que el arroz se pegue. Sirve el sushi de salmón acompañado de salsa de soja, wasabi y jengibre encurtido para una experiencia auténtica. Disfruta de este exquisito plato japonés lleno de frescura y sabor.', '01:30:00', '2024-03-05 18:45:00', 10, '1733255246_sushi.png', 'slow_food', 'Difícil'),
(4, 'Tacos al Pastor', 'Los tacos al pastor son un clásico de la cocina mexicana que combina sabores intensos y texturas jugosas. Comienza marinando la carne de cerdo en una mezcla de chiles guajillo y ancho previamente hidratados, achiote, jugo de piña, vinagre, ajo, comino, orégano, sal y pimienta. Deja que la carne repose en la marinada durante al menos 4 horas, preferiblemente toda la noche, para que absorba todos los sabores. Una vez marinada, ensarta la carne en un trompo (asador vertical) y cocina a fuego medio hasta que esté bien dorada y caramelizada en los bordes. Mientras la carne se cocina, prepara las piñas frescas, las cebollas picadas y el cilantro para acompañar. Calienta las tortillas de maíz en una sartén o comal hasta que estén suaves y ligeramente tostadas. Corta la carne en pequeños trozos una vez esté lista y distribúyela sobre las tortillas calientes. Añade un poco de piña, cebolla y cilantro al gusto. Si lo deseas, puedes agregar salsa al gusto, ya sea roja, verde o una combinación de ambas. Sirve los tacos al pastor inmediatamente, acompañados de rodajas de limón para exprimir encima. Estos tacos son perfectos para una comida informal, llenos de sabor y tradición mexicana.', '00:50:00', '2024-04-12 14:20:00', 10, '1733255269_tacos.png', 'tradicional', 'Media'),
(5, 'Pad Thai', 'El Pad Thai es un plato emblemático de la cocina tailandesa, conocido por su equilibrio de sabores y texturas. Comienza por remojar los fideos de arroz en agua caliente hasta que estén suaves pero aún firmes, luego escúrrelos y resérvalos. En un wok grande, calienta aceite vegetal a fuego medio-alto y saltea los camarones o el pollo cortado en tiras hasta que estén cocidos. Retira la proteína del wok y resérvala. En el mismo wok, añade más aceite si es necesario y sofríe ajo picado y chalotas hasta que estén fragantes. Agrega zanahorias en juliana y brotes de soja, salteando hasta que estén tiernos pero crujientes. Incorpora los fideos de arroz y la salsa de tamarindo, mezclando bien para que los fideos se impregnen de la salsa. Añade el azúcar de palma y la salsa de pescado, ajustando al gusto para lograr un equilibrio entre dulce, salado y ácido. Vuelve a poner la proteína en el wok y mezcla todo uniformemente. Agrega huevos batidos y remueve rápidamente para que se cocinen y se mezclen con los fideos. Una vez todo esté bien integrado, retira del fuego y sirve el Pad Thai caliente, adornado con cacahuates triturados, cilantro fresco y rodajas de lima. Puedes acompañarlo con más brotes de soja y una salsa picante al gusto. Este plato es una explosión de sabores que captura la esencia de la cocina tailandesa.', '00:40:00', '2024-05-22 19:10:00', 10, 'default.png', 'tradicional', 'Media'),
(6, 'Pizza Margherita', 'Preparar una auténtica Pizza Margherita en casa es sencillo y delicioso. Comienza por preparar la masa mezclando 500g de harina de trigo, 325ml de agua tibia, 10g de sal y 7g de levadura seca. Amasa hasta obtener una masa elástica y deja reposar en un lugar cálido durante aproximadamente 1 hora, hasta que doble su tamaño. Mientras la masa fermenta, prepara la salsa de tomate triturando tomates frescos y cocinándolos a fuego lento con ajo picado, sal, pimienta y un poco de orégano hasta que espese. Precalienta el horno a la máxima temperatura (idealmente 250°C) con una piedra para pizza si dispones de una. Una vez la masa haya levado, estírala sobre una superficie enharinada formando un círculo delgado. Coloca la masa en una pala para pizza o bandeja, unta la salsa de tomate de manera uniforme y añade rodajas de mozzarella fresca. Añade unas hojas de albahaca fresca y rocía con un chorrito de aceite de oliva extra virgen. Desliza la pizza en el horno caliente y hornea durante 10-12 minutos o hasta que la masa esté crujiente y el queso burbujeante y dorado. Retira del horno, añade un toque final de albahaca fresca y sirve inmediatamente para disfrutar de una auténtica Pizza Margherita llena de sabor y frescura.', '01:00:00', '2024-06-18 20:00:00', 10, 'default.png', 'tradicional', 'Media'),
(7, 'Ramen de Cerdo', 'El Ramen de Cerdo es una reconfortante sopa japonesa que combina caldo rico, fideos y tierna carne de cerdo. Comienza preparando el caldo: en una olla grande, coloca huesos de cerdo y cocina a fuego lento durante varias horas, añadiendo agua según sea necesario. Durante la cocción, retira la espuma y las impurezas para obtener un caldo claro y sabroso. Añade ingredientes aromáticos como jengibre, ajo, cebolla y salsa de soja para intensificar el sabor. Mientras el caldo se cocina, prepara la carne de cerdo chashu. Enrolla una pieza de lomo de cerdo, átala firmemente y cocínala en una mezcla de salsa de soja, mirin, sake y azúcar, ya sea en el horno o en una olla a fuego lento, hasta que esté tierna y jugosa. Cocina los fideos de ramen según las instrucciones del paquete y resérvalos. Para los toppings, prepara huevos cocidos a baja temperatura, corta finamente cebollino, prepara brotes de bambú y algas nori. Cuando el caldo esté listo, cuélalo y viértelo en tazones individuales. Coloca los fideos en el caldo caliente y añade las rodajas de chashu, el huevo cocido, los brotes de bambú, el cebollino y las algas nori. Sirve el ramen inmediatamente, permitiendo que cada comensal mezcle los ingredientes a su gusto. Este Ramen de Cerdo es una explosión de sabores umami que ofrece una experiencia auténtica y satisfactoria de la cocina japonesa.', '02:00:00', '2024-07-25 13:35:00', 10, 'default.png', 'slow_food', 'Difícil'),
(8, 'Falafel con Hummus', 'El Falafel con Hummus es un plato vegetariano delicioso y lleno de sabor. Comienza preparando el hummus mezclando en un procesador de alimentos 400g de garbanzos cocidos, 2 cucharadas de tahini, jugo de medio limón, 2 dientes de ajo, sal y un chorrito de aceite de oliva. Procesa hasta obtener una mezcla suave y cremosa, añadiendo un poco de agua si es necesario para alcanzar la consistencia deseada. Ajusta el sazón al gusto y reserva. Para los falafels, en un bol grande, combina 400g de garbanzos remojados durante al menos 8 horas, 1 cebolla picada, 3 dientes de ajo, un manojo de perejil fresco, cilantro, comino, cilantro molido, sal y pimienta. Procesa todos los ingredientes hasta obtener una masa gruesa. Forma pequeñas bolas o discos con la mezcla. Calienta abundante aceite vegetal en una sartén a fuego medio-alto y fríe los falafels hasta que estén dorados y crujientes por fuera. Escurre sobre papel absorbente para eliminar el exceso de aceite. Sirve los falafels calientes sobre una cama de hummus, acompañados de vegetales frescos como tomate, pepino y lechuga, y agrega un poco de salsa tahini o yogur si lo deseas. Puedes acompañar este plato con pan pita tibio para una experiencia completa y satisfactoria. Este Falafel con Hummus es perfecto como aperitivo, almuerzo ligero o cena nutritiva.', '00:35:00', '2024-08-30 11:15:00', 10, 'default.png', 'tradicional', 'Fácil'),
(9, 'Paella Valenciana', 'La Paella Valenciana es un emblemático plato español que combina arroz con mariscos, pollo y verduras. Comienza calentando aceite de oliva en una paellera a fuego medio. Añade trozos de pollo y conejo previamente sazonados con sal, y sofríelos hasta que estén dorados. Incorpora verduras tradicionales como judías verdes, garrofón (un tipo de alubia blanca) y tomate rallado. Cocina hasta que las verduras estén tiernas. Agrega el arroz de grano medio, distribuyéndolo uniformemente en la paellera. Vierte caldo de pollo caliente y añade azafrán para dar color y sabor característico. Evita remover el arroz para permitir que se forme el socarrat, la capa crujiente en el fondo. Añade mariscos como camarones, mejillones y calamares, distribuyéndolos de manera uniforme. Cocina a fuego medio-alto hasta que el arroz absorba el caldo y los mariscos estén cocidos. Ajusta la sal y la pimienta al gusto. Una vez el arroz esté en su punto y se haya formado el socarrat, retira la paellera del fuego y deja reposar la paella durante unos minutos. Decora con rodajas de limón y perejil fresco picado antes de servir. La Paella Valenciana es un festín para los sentidos, combinando colores vibrantes y una mezcla rica de sabores que reflejan la esencia de la cocina española.', '01:30:00', '2024-09-10 17:50:00', 10, 'default.png', 'tradicional', 'Difícil'),
(10, 'Burritos de Carne', 'Los Burritos de Carne son una opción deliciosa y versátil para una comida rápida y sabrosa. Comienza preparando la carne: en una sartén grande, calienta un poco de aceite y añade cebolla picada y ajo hasta que estén dorados. Agrega carne de res molida y cocina hasta que esté completamente dorada, desmenuzándola con una cuchara de madera. Incorpora condimentos como comino, pimentón, sal y pimienta, y mezcla bien. Añade frijoles negros o pintos previamente cocidos y cocina a fuego lento para que los sabores se integren. Mientras la carne se cocina, prepara los demás ingredientes: corta lechuga fresca, ralla queso cheddar, prepara guacamole y salsa de tu elección. Calienta las tortillas de harina en una sartén o microondas hasta que estén flexibles. Para ensamblar los burritos, coloca una porción de la mezcla de carne en el centro de cada tortilla, añade frijoles, lechuga, queso, guacamole y salsa al gusto. Dobla los extremos de la tortilla hacia el centro y luego enrolla firmemente desde abajo hacia arriba para formar un burrito bien cerrado. Puedes calentar los burritos en una sartén o parrilla para que queden ligeramente dorados y el queso se derrita. Sirve los Burritos de Carne acompañados de más salsa, crema agria y una guarnición de arroz si lo deseas. Estos burritos son perfectos para una comida completa y satisfactoria, llenos de sabores auténticos y texturas variadas.', '00:25:00', '2024-10-05 16:00:00', 10, 'default.png', 'tradicional', 'Fácil'),
(11, 'Curry de Pollo', 'Sabroso curry de pollo con especias aromáticas.', '01:15:00', '2024-11-12 19:25:00', 10, 'default.png', 'slow_food', 'Media'),
(12, 'Tiramisu', 'Clásico postre italiano con capas de café y mascarpone.', '00:50:00', '2024-12-01 21:40:00', 10, 'default.png', 'tradicional', 'Media'),
(13, 'Hamburguesa Gourmet', 'Hamburguesa de res con ingredientes premium.', '00:30:00', '2025-01-08 14:55:00', 10, 'default.png', 'slow_food', 'Fácil'),
(14, 'Crepes Franceses', 'Deliciosos crepes rellenos de frutas y crema.', '00:25:00', '2025-02-14 10:30:00', 10, 'default.png', 'tradicional', 'Fácil'),
(15, 'Gyozas de Verduras', 'Empanadillas japonesas rellenas de verduras.', '00:45:00', '2025-03-20 18:05:00', 10, 'default.png', 'tradicional', 'Media'),
(16, 'Lasagna Vegetariana', 'Lasagna con capas de vegetales y queso ricotta.', '01:20:00', '2025-04-25 12:45:00', 10, 'default.png', 'tradicional', 'Media'),
(17, 'Pho Vietnamita', 'Sopa vietnamita con fideos y carne de res.', '01:00:00', '2025-05-30 17:30:00', 10, 'default.png', 'slow_food', 'Difícil'),
(18, 'Bruschetta Italiana', 'Tostas crujientes con tomate y albahaca.', '00:15:00', '2025-06-15 13:10:00', 10, 'default.png', 'tradicional', 'Fácil'),
(19, 'Dim Sum Variado', 'Selección de dim sum al vapor con diferentes rellenos.', '01:45:00', '2025-07-22 19:55:00', 10, 'default.png', 'slow_food', 'Difícil'),
(20, 'Mousse de Chocolate', 'Ligero mousse de chocolate con crema batida.', '00:30:00', '2025-08-10 20:20:00', 10, 'default.png', 'tradicional', 'Fácil');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recetas_ingredientes`
--

CREATE TABLE `recetas_ingredientes` (
  `id_receta` int NOT NULL,
  `id_ingrediente` int NOT NULL,
  `cantidad` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `recetas_ingredientes`
--

INSERT INTO `recetas_ingredientes` (`id_receta`, `id_ingrediente`, `cantidad`) VALUES
(1, 1, '3 unidades'),
(1, 2, '1 unidad'),
(1, 3, '2 dientes'),
(1, 4, '50ml'),
(1, 7, '200g'),
(2, 4, '30ml'),
(2, 5, 'Al gusto'),
(2, 8, '150g'),
(2, 9, '50g'),
(2, 10, '1 cabeza'),
(3, 7, '250g'),
(3, 8, '100g'),
(3, 11, '1 cucharadita'),
(3, 12, '50ml'),
(4, 2, '1 unidad'),
(4, 5, 'Al gusto'),
(4, 14, '200g'),
(4, 19, '1 unidad'),
(5, 8, '100g'),
(5, 13, '150g'),
(5, 16, '2 cucharadas'),
(6, 1, '4 unidades'),
(6, 4, '50ml'),
(6, 7, '300g'),
(6, 9, '200g'),
(7, 3, '3 dientes'),
(7, 8, '150g'),
(7, 11, '2 cucharadas'),
(7, 13, '200g'),
(8, 2, '1 unidad'),
(8, 5, 'Al gusto'),
(8, 6, '1 cucharadita'),
(8, 20, '100g'),
(9, 2, '1 unidad'),
(9, 5, 'Al gusto'),
(9, 7, '250g'),
(9, 14, '200g'),
(10, 5, 'Al gusto'),
(10, 7, '200g'),
(10, 9, '100g'),
(10, 14, '150g'),
(11, 3, '2 dientes'),
(11, 8, '200g'),
(11, 16, '3 cucharadas'),
(11, 17, '1 cucharada'),
(12, 5, 'Al gusto'),
(12, 18, '2 unidades'),
(12, 20, '150g'),
(13, 5, 'Al gusto'),
(13, 7, '300g'),
(13, 9, '150g'),
(13, 14, '250g'),
(14, 1, '2 unidades'),
(14, 5, 'Al gusto'),
(14, 20, '100g'),
(15, 2, '1 unidad'),
(15, 5, 'Al gusto'),
(15, 20, '80g'),
(16, 5, 'Al gusto'),
(16, 7, '200g'),
(16, 10, '1 cabeza'),
(17, 13, '200g'),
(17, 14, '150g'),
(17, 18, '1 unidad'),
(18, 1, '2 unidades'),
(18, 4, '20ml'),
(18, 10, '1 hoja'),
(19, 2, '1 unidad'),
(19, 5, 'Al gusto'),
(19, 7, '150g'),
(20, 1, '2 unidades'),
(20, 5, 'Al gusto'),
(20, 9, '50g'),
(20, 20, '100g');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `experiencia` varchar(200) DEFAULT NULL,
  `rol` enum('usuario','usuario_registrado','administrador') DEFAULT 'usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `contrasena`, `nombre`, `apellidos`, `email`, `experiencia`, `rol`) VALUES
(1, 'jdoe', '$2y$10$sesY3Ye9q3jUfJJkMe0K4uEMsHVSoPHx4nLfzFtAYqy8qWkKyWiKq', 'Juan', 'Doe', 'juan.doe@example.com', 'Cocina italiana y pastelería', 'usuario_registrado'),
(2, 'asmith', '$2y$10$sesY3Ye9q3jUfJJkMe0K4uEMsHVSoPHx4nLfzFtAYqy8qWkKyWiKq', 'Ana', 'Smith', 'ana.smith@example.com', 'Cocina vegana', 'usuario_registrado'),
(3, 'bgarcia', '$2y$10$sesY3Ye9q3jUfJJkMe0K4uEMsHVSoPHx4nLfzFtAYqy8qWkKyWiKq', 'Bruno', 'García', 'bruno.garcia@example.com', 'Cocina mexicana', 'usuario_registrado'),
(4, 'cmartinez', '$2y$10$sesY3Ye9q3jUfJJkMe0K4uEMsHVSoPHx4nLfzFtAYqy8qWkKyWiKq', 'Carla', 'Martínez', 'carla.martinez@example.com', 'Repostería y panadería', 'usuario_registrado'),
(5, 'dlopez', '$2y$10$sesY3Ye9q3jUfJJkMe0K4uEMsHVSoPHx4nLfzFtAYqy8qWkKyWiKq', 'Daniel', 'López', 'daniel.lopez@example.com', 'Cocina asiática', 'administrador'),
(6, 'emartin', '$2y$10$sesY3Ye9q3jUfJJkMe0K4uEMsHVSoPHx4nLfzFtAYqy8qWkKyWiKq', 'Elena', 'Martín', 'elena.martin@example.com', 'Cocina saludable', 'usuario_registrado'),
(7, 'fjose', '$2y$10$sesY3Ye9q3jUfJJkMe0K4uEMsHVSoPHx4nLfzFtAYqy8qWkKyWiKq', 'Fernando', 'José', 'fernando.jose@example.com', 'Cocina rápida', 'usuario_registrado'),
(8, 'gmora', '$2y$10$sesY3Ye9q3jUfJJkMe0K4uEMsHVSoPHx4nLfzFtAYqy8qWkKyWiKq', 'Gabriela', 'Morales', 'gabriela.morales@example.com', 'Cocina gourmet', 'usuario_registrado'),
(9, 'hlara', '$2y$10$sesY3Ye9q3jUfJJkMe0K4uEMsHVSoPHx4nLfzFtAYqy8qWkKyWiKq', 'Héctor', 'Lara', 'hector.lara@example.com', 'Cocina tradicional', 'usuario_registrado'),
(10, 'administrador', '$2y$10$sesY3Ye9q3jUfJJkMe0K4uEMsHVSoPHx4nLfzFtAYqy8qWkKyWiKq', 'Admin', 'Istrador', 'admin@example.com', 'Usuario con privilegios de administrador', 'administrador'),
(11, 'ikim', '$2y$10$sesY3Ye9q3jUfJJkMe0K4uEMsHVSoPHx4nLfzFtAYqy8qWkKyWiKq', 'Isabel', 'Kim', 'isabel.kim@example.com', 'Cocina coreana', 'usuario_registrado'),
(12, 'jrodriguez', '$2y$10$sesY3Ye9q3jUfJJkMe0K4uEMsHVSoPHx4nLfzFtAYqy8qWkKyWiKq', 'Jorge', 'Rodríguez', 'jorge.rodriguez@example.com', 'Cocina brasileña', 'usuario_registrado'),
(13, 'lfernandez', '$2y$10$sesY3Ye9q3jUfJJkMe0K4uEMsHVSoPHx4nLfzFtAYqy8qWkKyWiKq', 'Laura', 'Fernández', 'laura.fernandez@example.com', 'Cocina francesa', 'usuario_registrado'),
(14, 'mmendez', '$2y$10$sesY3Ye9q3jUfJJkMe0K4uEMsHVSoPHx4nLfzFtAYqy8qWkKyWiKq', 'Miguel', 'Méndez', 'miguel.mendez@example.com', 'Cocina india', 'administrador'),
(15, 'nrojas', '$2y$10$sesY3Ye9q3jUfJJkMe0K4uEMsHVSoPHx4nLfzFtAYqy8qWkKyWiKq', 'Natalia', 'Rojas', 'natalia.rojas@example.com', 'Cocina mediterránea', 'usuario_registrado'),
(16, 'operez', '$2y$10$sesY3Ye9q3jUfJJkMe0K4uEMsHVSoPHx4nLfzFtAYqy8qWkKyWiKq', 'Oscar', 'Pérez', 'oscar.perez@example.com', 'Cocina tailandesa', 'usuario_registrado'),
(17, 'pramirez', '$2y$10$sesY3Ye9q3jUfJJkMe0K4uEMsHVSoPHx4nLfzFtAYqy8qWkKyWiKq', 'Paula', 'Ramírez', 'paula.ramirez@example.com', 'Cocina saludable', 'administrador'),
(18, 'qgomez', '$2y$10$sesY3Ye9q3jUfJJkMe0K4uEMsHVSoPHx4nLfzFtAYqy8qWkKyWiKq', 'Quentin', 'Gómez', 'quentin.gomez@example.com', 'Cocina vegetariana', 'usuario_registrado'),
(19, 'rgarcia', '$2y$10$sesY3Ye9q3jUfJJkMe0K4uEMsHVSoPHx4nLfzFtAYqy8qWkKyWiKq', 'Roberta', 'García', 'roberta.garcia@example.com', 'Cocina sin gluten', 'usuario_registrado'),
(20, 'ssanchez', '$2y$10$sesY3Ye9q3jUfJJkMe0K4uEMsHVSoPHx4nLfzFtAYqy8qWkKyWiKq', 'Sergio', 'Sánchez', 'sergio.sanchez@example.com', 'Cocina rápida', 'usuario_registrado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoraciones`
--

CREATE TABLE `valoraciones` (
  `id_valoracion` int NOT NULL,
  `id_receta` int DEFAULT NULL,
  `id_usuario` int DEFAULT NULL,
  `valor` int DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `valoraciones`
--

INSERT INTO `valoraciones` (`id_valoracion`, `id_receta`, `id_usuario`, `valor`) VALUES
(1, 1, 2, 5),
(2, 2, 3, 4),
(3, 3, 4, 3),
(4, 4, 5, 5),
(5, 5, 6, 4),
(6, 6, 7, 5),
(7, 7, 8, 4),
(8, 8, 9, 5),
(9, 9, 11, 5),
(10, 10, 12, 4),
(11, 11, 13, 5),
(12, 12, 14, 4),
(13, 13, 15, 5),
(14, 14, 16, 4),
(15, 15, 17, 5),
(16, 16, 18, 4),
(17, 17, 19, 5),
(18, 18, 20, 4),
(19, 19, 1, 5),
(20, 20, 2, 4),
(36, 1, 10, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_receta` (`id_receta`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_respuesta` (`id_respuesta`);

--
-- Indices de la tabla `ingredientes`
--
ALTER TABLE `ingredientes`
  ADD PRIMARY KEY (`id_ingrediente`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `recetas`
--
ALTER TABLE `recetas`
  ADD PRIMARY KEY (`id_receta`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indices de la tabla `recetas_ingredientes`
--
ALTER TABLE `recetas_ingredientes`
  ADD PRIMARY KEY (`id_receta`,`id_ingrediente`),
  ADD KEY `id_ingrediente` (`id_ingrediente`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD PRIMARY KEY (`id_valoracion`),
  ADD UNIQUE KEY `uc_valoraciones` (`id_receta`,`id_usuario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `ingredientes`
--
ALTER TABLE `ingredientes`
  MODIFY `id_ingrediente` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `recetas`
--
ALTER TABLE `recetas`
  MODIFY `id_receta` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  MODIFY `id_valoracion` int NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_receta`) REFERENCES `recetas` (`id_receta`) ON DELETE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_3` FOREIGN KEY (`id_respuesta`) REFERENCES `comentarios` (`id_comentario`) ON DELETE SET NULL;

--
-- Filtros para la tabla `recetas`
--
ALTER TABLE `recetas`
  ADD CONSTRAINT `recetas_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `recetas_ingredientes`
--
ALTER TABLE `recetas_ingredientes`
  ADD CONSTRAINT `recetas_ingredientes_ibfk_1` FOREIGN KEY (`id_receta`) REFERENCES `recetas` (`id_receta`) ON DELETE CASCADE,
  ADD CONSTRAINT `recetas_ingredientes_ibfk_2` FOREIGN KEY (`id_ingrediente`) REFERENCES `ingredientes` (`id_ingrediente`) ON DELETE CASCADE;

--
-- Filtros para la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD CONSTRAINT `valoraciones_ibfk_1` FOREIGN KEY (`id_receta`) REFERENCES `recetas` (`id_receta`) ON DELETE CASCADE,
  ADD CONSTRAINT `valoraciones_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
