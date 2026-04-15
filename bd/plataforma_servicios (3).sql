-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-04-2026 a las 01:01:14
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `plataforma_servicios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `id_categoria_padre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre`, `id_categoria_padre`) VALUES
(1, 'Deporte', NULL),
(2, 'Bienestar', NULL),
(4, 'Escalada', 1),
(5, 'Senderismo', 1),
(6, 'Yoga', 2),
(7, 'Pilates', 1),
(8, 'Running', 1),
(9, 'Pádel', 1),
(10, 'Ciclismo', 1),
(11, 'Spa', 2),
(12, 'Masajes', 2),
(13, 'Meditación', 2),
(14, 'Aromaterapia', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_actividad`
--

CREATE TABLE `detalle_actividad` (
  `id` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `plazas_maximas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_actividad`
--

INSERT INTO `detalle_actividad` (`id`, `id_servicio`, `fecha`, `hora_inicio`, `hora_fin`, `plazas_maximas`) VALUES
(1, 1, '2026-04-10', '10:00:00', '12:00:00', 15),
(2, 1, '2026-04-11', '16:00:00', '18:00:00', 15),
(3, 2, '2026-04-12', '09:00:00', '11:00:00', 10),
(4, 3, '2026-04-13', '19:00:00', '20:30:00', 20),
(5, 4, '2026-04-20', '10:00:00', '12:00:00', 15),
(6, 5, '2026-04-20', '10:00:00', '12:00:00', 15),
(7, 6, '2026-04-20', '10:00:00', '12:00:00', 15),
(8, 7, '2026-04-20', '10:00:00', '12:00:00', 15),
(9, 8, '2026-04-20', '10:00:00', '12:00:00', 15),
(10, 9, '2026-04-20', '10:00:00', '12:00:00', 15),
(11, 10, '2026-04-20', '10:00:00', '12:00:00', 15),
(12, 11, '2026-04-20', '10:00:00', '12:00:00', 15),
(13, 12, '2026-04-20', '10:00:00', '12:00:00', 15),
(14, 13, '2026-04-20', '10:00:00', '12:00:00', 15),
(20, 4, '2026-04-21', '16:00:00', '18:00:00', 12),
(21, 5, '2026-04-21', '16:00:00', '18:00:00', 12),
(22, 6, '2026-04-21', '16:00:00', '18:00:00', 12),
(23, 7, '2026-04-21', '16:00:00', '18:00:00', 12),
(24, 8, '2026-04-21', '16:00:00', '18:00:00', 12),
(25, 9, '2026-04-21', '16:00:00', '18:00:00', 12),
(26, 10, '2026-04-21', '16:00:00', '18:00:00', 12),
(27, 11, '2026-04-21', '16:00:00', '18:00:00', 12),
(28, 12, '2026-04-21', '16:00:00', '18:00:00', 12),
(29, 13, '2026-04-21', '16:00:00', '18:00:00', 12),
(35, 4, '2026-04-22', '18:30:00', '20:00:00', 10),
(36, 5, '2026-04-22', '18:30:00', '20:00:00', 10),
(37, 6, '2026-04-22', '18:30:00', '20:00:00', 10),
(38, 7, '2026-04-22', '18:30:00', '20:00:00', 10),
(39, 8, '2026-04-22', '18:30:00', '20:00:00', 10),
(40, 9, '2026-04-22', '18:30:00', '20:00:00', 10),
(41, 10, '2026-04-22', '18:30:00', '20:00:00', 10),
(42, 11, '2026-04-22', '18:30:00', '20:00:00', 10),
(43, 12, '2026-04-22', '18:30:00', '20:00:00', 10),
(44, 13, '2026-04-22', '18:30:00', '20:00:00', 10),
(50, 2, '2026-05-01', '09:00:00', '11:00:00', 10),
(51, 2, '2026-05-03', '09:00:00', '11:00:00', 10),
(52, 2, '2026-05-05', '09:00:00', '11:00:00', 10),
(53, 2, '2026-05-07', '09:00:00', '11:00:00', 10),
(54, 2, '2026-05-09', '09:00:00', '11:00:00', 10),
(55, 2, '2026-05-11', '09:00:00', '11:00:00', 10),
(56, 2, '2026-05-13', '09:00:00', '11:00:00', 10),
(57, 2, '2026-05-15', '09:00:00', '11:00:00', 10),
(58, 2, '2026-05-17', '09:00:00', '11:00:00', 10),
(59, 2, '2026-05-19', '09:00:00', '11:00:00', 10),
(60, 2, '2026-05-01', '09:00:00', '11:00:00', 10),
(61, 2, '2026-05-01', '17:00:00', '19:00:00', 10),
(62, 2, '2026-05-03', '09:00:00', '11:00:00', 10),
(63, 2, '2026-05-03', '17:00:00', '19:00:00', 10),
(64, 2, '2026-05-05', '09:00:00', '11:00:00', 10),
(65, 2, '2026-05-05', '17:00:00', '19:00:00', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL,
  `nombre_empresa` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `nombre_empresa`, `email`, `contrasena`, `direccion`, `telefono`) VALUES
(1, 'empresa1', 'contacto@aventuramadrid.com', 'empresa1', 'Calle Mayor 10, Madrid', '910000111'),
(2, 'empresa2', 'info@natureescape.com', 'empresa2', 'Av. Sierra 45, Segovia', '910000222');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen_servicio`
--

CREATE TABLE `imagen_servicio` (
  `id_imagen` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `url_imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `imagen_servicio`
--

INSERT INTO `imagen_servicio` (`id_imagen`, `id_servicio`, `url_imagen`) VALUES
(1, 1, 'imagenes/senderismo1.jpg'),
(2, 1, 'imagenes/senderismo2.jpg'),
(3, 2, 'imagenes/escalada1.jpg'),
(4, 3, 'imagenes/yoga1.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resena`
--

CREATE TABLE `resena` (
  `id_resena` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `puntuacion` int(11) NOT NULL,
  `comentario` text DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `resena`
--

INSERT INTO `resena` (`id_resena`, `id_usuario`, `id_servicio`, `puntuacion`, `comentario`, `fecha`) VALUES
(3, 4, 2, 5, 'Los monitores explican muy bien.', '2026-04-12 13:30:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `id_reserva` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `estado` enum('pendiente','confirmada','cancelada') NOT NULL DEFAULT 'pendiente',
  `id_detalle_actividad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`id_reserva`, `id_usuario`, `id_servicio`, `fecha_hora`, `estado`, `id_detalle_actividad`) VALUES
(3, 4, 2, '2026-04-12 09:00:00', 'confirmada', 3),
(4, 12, 3, '2026-04-13 19:00:00', 'confirmada', 4),
(5, 12, 2, '2026-04-12 09:00:00', 'confirmada', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre`) VALUES
(3, 'administrador'),
(2, 'empresa'),
(1, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id_servicio` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `nombre_servicio` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `lugar` varchar(150) DEFAULT NULL,
  `id_categoria` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL DEFAULT 0.00,
  `duracion` varchar(50) DEFAULT NULL,
  `materiales` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id_servicio`, `id_empresa`, `nombre_servicio`, `descripcion`, `lugar`, `id_categoria`, `precio`, `duracion`, `materiales`) VALUES
(1, 1, 'Ruta guiada de senderismo', 'Excursión guiada por la sierra con monitor especializado', 'Sierra de Guadarrama', 5, 25.00, '4 horas', 'Calzado de montaña, agua y protección solar'),
(2, 1, 'Escalada para principiantes', 'Curso de iniciación a la escalada en roca', 'La Pedriza', 4, 40.00, '2 horas', 'Arnés, casco y pies de gato (incluidos)'),
(3, 2, 'Clase de Yoga al aire libre', 'Sesión de yoga para todos los niveles', 'Parque del Retiro', 6, 15.00, '1 hora', 'Esterilla, ropa cómoda y botella de agua'),
(4, 1, 'Ruta de senderismo al atardecer', 'Ruta guiada por montaña con vistas panorámicas al atardecer.', 'Cercedilla', 5, 30.00, '4 horas', 'Calzado de montaña, agua y protección solar'),
(5, 1, 'Senderismo en familia', 'Excursión de dificultad baja pensada para familias con niños.', 'Navacerrada', 5, 18.00, '4 horas', 'Calzado de montaña, agua y protección solar'),
(6, 1, 'Ruta de senderismo con picnic', 'Actividad de senderismo suave con parada para picnic incluido.', 'Sierra Norte de Madrid', 5, 35.00, '4 horas', 'Calzado de montaña, agua y protección solar'),
(7, 1, 'Escalada nivel intermedio', 'Sesión guiada para personas con conocimientos básicos de escalada.', 'La Pedriza', 4, 45.00, '2 horas', 'Arnés, casco y pies de gato (incluidos)'),
(8, 1, 'Escalada en rocódromo', 'Clase práctica de escalada en interior con monitor.', 'Madrid Centro', 4, 22.00, '2 horas', 'Arnés, casco y pies de gato (incluidos)'),
(9, 1, 'Bautismo de escalada', 'Primera toma de contacto con la escalada en entorno seguro.', 'Patones', 4, 38.00, '2 horas', 'Arnés, casco y pies de gato (incluidos)'),
(10, 2, 'Yoga relajante', 'Clase enfocada en respiración, estiramientos y relajación.', 'Parque del Retiro', 6, 12.00, '1 hora', 'Esterilla, ropa cómoda y botella de agua'),
(11, 2, 'Hatha Yoga', 'Sesión de yoga tradicional para mejorar flexibilidad y concentración.', 'Arganda del Rey', 6, 14.00, '1 hora', 'Esterilla, ropa cómoda y botella de agua'),
(12, 2, 'Yoga para principiantes', 'Clase suave para personas que quieren iniciarse en yoga.', 'Rivas-Vaciamadrid', 6, 13.50, '1 hora', 'Esterilla, ropa cómoda y botella de agua'),
(13, 2, 'Yoga al amanecer', 'Clase al aire libre en horario de mañana para empezar el día con calma.', 'Casa de Campo', 6, 16.00, '1 hora', 'Esterilla, ropa cómoda y botella de agua'),
(14, 2, 'Pilates suelo', 'Clase de pilates enfocada en fuerza, control corporal y flexibilidad.', 'Arganda del Rey', 7, 14.00, '1 hora', 'Esterilla y ropa cómoda'),
(15, 2, 'Pilates para principiantes', 'Sesión suave para personas que comienzan en pilates.', 'Rivas-Vaciamadrid', 7, 13.00, '1 hora', 'Esterilla y ropa cómoda'),
(16, 2, 'Pilates al aire libre', 'Clase guiada de pilates en un entorno natural.', 'Parque Juan Carlos I', 7, 16.00, '1 hora', 'Esterilla y ropa cómoda'),
(17, 1, 'Running iniciación', 'Entrenamiento guiado para empezar a correr de forma progresiva.', 'Madrid Río', 8, 12.00, '1 hora', 'Zapatillas deportivas y ropa cómoda'),
(18, 1, 'Grupo de running urbano', 'Sesión grupal para mejorar resistencia y técnica de carrera.', 'Retiro', 8, 15.00, '1 hora', 'Zapatillas deportivas y ropa cómoda'),
(19, 1, 'Running al amanecer', 'Actividad matinal para activar cuerpo y mente corriendo.', 'Casa de Campo', 8, 14.50, '1 hora', 'Zapatillas deportivas y ropa cómoda'),
(20, 1, 'Clases de pádel iniciación', 'Aprende los golpes básicos y la dinámica del juego.', 'Arganda Pádel Club', 9, 20.00, '1 hora y 30 minutos', 'Pala de pádel y ropa deportiva'),
(21, 1, 'Pádel nivel intermedio', 'Sesión orientada a mejorar técnica y táctica de juego.', 'Rivas Pádel Center', 9, 24.00, '1 hora y 30 minutos', 'Pala de pádel y ropa deportiva'),
(22, 1, 'Partido de pádel guiado', 'Partido supervisado con consejos de monitor.', 'Madrid Central Pádel', 9, 18.00, '1 hora y 30 minutos', 'Pala de pádel y ropa deportiva'),
(23, 1, 'Ruta ciclista de montaña', 'Salida en bicicleta por senderos de dificultad media.', 'Cercedilla', 10, 28.00, '3 horas', 'Bicicleta, casco y agua'),
(24, 1, 'Ciclismo urbano', 'Ruta guiada para descubrir la ciudad en bicicleta.', 'Madrid Centro', 10, 18.00, '3 horas', 'Bicicleta, casco y agua'),
(25, 1, 'Ciclismo familiar', 'Recorrido en bici adaptado para familias y principiantes.', 'Casa de Campo', 10, 16.00, '3 horas', 'Bicicleta, casco y agua'),
(26, 2, 'Circuito termal', 'Experiencia de spa con piscina activa, chorros y zona de relax.', 'Madrid Wellness Center', 11, 35.00, '2 horas', 'Bañador, chanclas y toalla'),
(27, 2, 'Spa con sauna', 'Sesión de bienestar con sauna y circuito de aguas.', 'Alcalá Spa Resort', 11, 40.00, '2 horas', 'Bañador, chanclas y toalla'),
(28, 2, 'Spa en pareja', 'Experiencia relajante para dos personas con acceso completo al spa.', 'Balneario del Jarama', 11, 65.00, '2 horas', 'Bañador, chanclas y toalla'),
(29, 2, 'Masaje relajante', 'Masaje corporal para aliviar tensión y favorecer el descanso.', 'Arganda Relax Studio', 12, 32.00, '45 minutos', 'No se requieren materiales'),
(30, 2, 'Masaje descontracturante', 'Tratamiento enfocado en zonas de tensión muscular.', 'Rivas Bienestar', 12, 38.00, '45 minutos', 'No se requieren materiales'),
(31, 2, 'Masaje con piedras calientes', 'Sesión de masaje combinada con calor terapéutico.', 'Madrid Zen Center', 12, 42.00, '45 minutos', 'No se requieren materiales'),
(32, 2, 'Meditación guiada', 'Sesión dirigida para reducir estrés y mejorar concentración.', 'Retiro', 13, 10.00, '45 minutos', 'Ropa cómoda'),
(33, 2, 'Mindfulness para principiantes', 'Introducción práctica a la atención plena.', 'Arganda del Rey', 13, 11.50, '45 minutos', 'Ropa cómoda'),
(34, 2, 'Meditación con cuencos', 'Sesión relajante acompañada de sonido de cuencos tibetanos.', 'Rivas-Vaciamadrid', 13, 18.00, '45 minutos', 'Ropa cómoda'),
(35, 2, 'Aromaterapia relajante', 'Sesión de bienestar con aceites esenciales calmantes.', 'Madrid Aroma Studio', 14, 22.00, '1 hora', 'No se requieren materiales'),
(36, 2, 'Ritual sensorial', 'Experiencia de aromaterapia centrada en relajación profunda.', 'Arganda Wellness Room', 14, 26.00, '1 hora', 'No se requieren materiales'),
(37, 2, 'Aromaterapia para dormir mejor', 'Sesión enfocada en descanso, calma y equilibrio.', 'Rivas Relax Center', 14, 24.00, '1 hora', 'No se requieren materiales'),
(38, 1, 'Escalada deportiva', 'Sesión guiada de escalada deportiva en roca para nivel básico e intermedio.', 'La Pedriza', 4, 42.00, '2 horas', 'Arnés, casco y pies de gato (incluidos)'),
(39, 1, 'Escalada en familia', 'Actividad de escalada adaptada para familias con monitor especializado.', 'Patones', 4, 36.00, '2 horas', 'Arnés, casco y pies de gato (incluidos)'),
(40, 1, 'Taller de técnica de escalada', 'Perfecciona agarres, apoyos y equilibrio en pared natural.', 'San Martín de Valdeiglesias', 4, 39.00, '2 horas', 'Arnés, casco y pies de gato (incluidos)'),
(41, 1, 'Ruta de senderismo entre pinares', 'Caminata guiada por senderos naturales rodeados de bosque.', 'Cercedilla', 5, 22.00, '4 horas', 'Calzado de montaña, agua y protección solar'),
(42, 1, 'Senderismo con interpretación ambiental', 'Ruta suave con explicaciones sobre flora, fauna y entorno.', 'Sierra Norte', 5, 20.00, '4 horas', 'Calzado de montaña, agua y protección solar'),
(43, 1, 'Senderismo de montaña', 'Actividad para amantes de la naturaleza con recorrido de dificultad media.', 'Navacerrada', 5, 27.00, '4 horas', 'Calzado de montaña, agua y protección solar'),
(44, 1, 'Ruta guiada en fin de semana', 'Excursión organizada para desconectar y hacer ejercicio al aire libre.', 'Rascafría', 5, 24.00, '4 horas', 'Calzado de montaña, agua y protección solar'),
(45, 2, 'Vinyasa Yoga', 'Clase dinámica de yoga con secuencias fluidas y respiración consciente.', 'Parque del Retiro', 6, 16.00, '1 hora', 'Esterilla, ropa cómoda y botella de agua'),
(46, 2, 'Yoga Flow', 'Sesión de yoga activo para mejorar movilidad, fuerza y equilibrio.', 'Arganda del Rey', 6, 15.00, '1 hora', 'Esterilla, ropa cómoda y botella de agua'),
(47, 2, 'Yoga Relax', 'Clase orientada a relajación profunda y liberación de tensión.', 'Rivas-Vaciamadrid', 6, 14.00, '1 hora', 'Esterilla, ropa cómoda y botella de agua'),
(48, 2, 'Yoga al atardecer', 'Experiencia de yoga suave al aire libre en horario de tarde.', 'Casa de Campo', 6, 17.00, '1 hora', 'Esterilla, ropa cómoda y botella de agua'),
(49, 2, 'Pilates core', 'Clase centrada en abdomen, control postural y estabilidad.', 'Arganda del Rey', 7, 15.00, '1 hora', 'Esterilla y ropa cómoda'),
(50, 2, 'Pilates equilibrio', 'Trabajo corporal enfocado en coordinación, fuerza y flexibilidad.', 'Rivas-Vaciamadrid', 7, 14.50, '1 hora', 'Esterilla y ropa cómoda'),
(51, 2, 'Pilates suave', 'Sesión tranquila ideal para comenzar o retomar actividad física.', 'Madrid Este', 7, 13.00, '1 hora', 'Esterilla y ropa cómoda'),
(52, 2, 'Pilates de mañana', 'Actividad de pilates para activar el cuerpo al empezar el día.', 'Coslada', 7, 14.00, '1 hora', 'Esterilla y ropa cómoda'),
(53, 1, 'Running resistencia', 'Entrenamiento guiado para mejorar fondo y capacidad aeróbica.', 'Madrid Río', 8, 14.00, '1 hora', 'Zapatillas deportivas y ropa cómoda'),
(54, 1, 'Running técnica de carrera', 'Sesión para trabajar postura, apoyo y eficiencia al correr.', 'Retiro', 8, 16.00, '1 hora', 'Zapatillas deportivas y ropa cómoda'),
(55, 1, 'Grupo running principiantes', 'Entrenamiento adaptado para quienes empiezan desde cero.', 'Arganda del Rey', 8, 11.00, '1 hora', 'Zapatillas deportivas y ropa cómoda'),
(56, 1, 'Running intervalos', 'Trabajo por series para mejorar velocidad y resistencia.', 'Rivas-Vaciamadrid', 8, 15.00, '1 hora', 'Zapatillas deportivas y ropa cómoda'),
(57, 1, 'Pádel para principiantes', 'Clase para aprender posiciones, golpes básicos y dinámica de juego.', 'Arganda Pádel Club', 9, 19.00, '1 hora y 30 minutos', 'Pala de pádel y ropa deportiva'),
(58, 1, 'Pádel perfeccionamiento', 'Sesión técnica para mejorar control, volea y bandeja.', 'Rivas Pádel Center', 9, 23.00, '1 hora y 30 minutos', 'Pala de pádel y ropa deportiva'),
(59, 1, 'Pádel en pareja', 'Entrenamiento compartido con ejercicios y partido guiado.', 'Madrid Central Pádel', 9, 21.00, '1 hora y 30 minutos', 'Pala de pádel y ropa deportiva'),
(60, 1, 'Pádel intensivo', 'Clase más exigente para trabajar táctica y ritmo de juego.', 'Getafe Indoor Pádel', 9, 26.00, '1 hora y 30 minutos', 'Pala de pádel y ropa deportiva'),
(61, 1, 'Ruta ciclista por vía verde', 'Recorrido guiado en bicicleta por un entorno natural accesible.', 'Morata de Tajuña', 10, 19.00, '3 horas', 'Bicicleta, casco y agua'),
(62, 1, 'Ciclismo de resistencia', 'Salida de media distancia para mejorar forma física y técnica.', 'Sierra de Madrid', 10, 29.00, '3 horas', 'Bicicleta, casco y agua'),
(63, 1, 'Ciclismo para principiantes', 'Ruta suave para personas que quieren empezar en bici.', 'Casa de Campo', 10, 15.00, '3 horas', 'Bicicleta, casco y agua'),
(64, 1, 'Ruta ciclista al amanecer', 'Experiencia en bici a primera hora con monitor y grupo reducido.', 'Madrid Río', 10, 21.00, '3 horas', 'Bicicleta, casco y agua'),
(65, 2, 'Spa premium', 'Acceso a zona termal premium con piscinas, sauna y relax.', 'Madrid Wellness Center', 11, 48.00, '2 horas', 'Bañador, chanclas y toalla'),
(66, 2, 'Balneario relax', 'Experiencia de bienestar con circuito completo y zona de descanso.', 'Balneario del Jarama', 11, 44.00, '2 horas', 'Bañador, chanclas y toalla'),
(67, 2, 'Spa urbano', 'Sesión de desconexión en un spa moderno en pleno entorno urbano.', 'Centro de Madrid', 11, 33.00, '2 horas', 'Bañador, chanclas y toalla'),
(68, 2, 'Spa con hidromasaje', 'Circuito de bienestar con jacuzzi, sauna y piscina activa.', 'Alcalá Spa Resort', 11, 39.00, '2 horas', 'Bañador, chanclas y toalla'),
(69, 2, 'Masaje de espalda y cuello', 'Masaje localizado para aliviar tensión acumulada en la parte superior.', 'Arganda Relax Studio', 12, 28.00, '45 minutos', 'No se requieren materiales'),
(70, 2, 'Masaje corporal completo', 'Sesión integral enfocada en descanso, circulación y bienestar.', 'Rivas Bienestar', 12, 40.00, '45 minutos', 'No se requieren materiales'),
(71, 2, 'Masaje aromático', 'Tratamiento relajante con aceites esenciales y ambiente sensorial.', 'Madrid Zen Center', 12, 35.00, '45 minutos', 'No se requieren materiales'),
(72, 2, 'Masaje facial relajante', 'Sesión suave para relajar la musculatura facial y descargar tensión.', 'Coslada Wellness', 12, 25.00, '45 minutos', 'No se requieren materiales'),
(73, 2, 'Meditación de mañanas conscientes', 'Sesión guiada para empezar el día con calma y claridad mental.', 'Parque del Retiro', 13, 9.50, '45 minutos', 'Ropa cómoda'),
(74, 2, 'Meditación antiestrés', 'Práctica orientada a reducir estrés, tensión y ruido mental.', 'Arganda del Rey', 13, 12.00, '45 minutos', 'Ropa cómoda'),
(75, 2, 'Meditación en grupo', 'Encuentro grupal para trabajar respiración, presencia y equilibrio.', 'Rivas-Vaciamadrid', 13, 10.50, '45 minutos', 'Ropa cómoda'),
(76, 2, 'Meditación al aire libre', 'Sesión de conexión y calma en entorno natural.', 'Casa de Campo', 13, 11.00, '45 minutos', 'Ropa cómoda'),
(77, 2, 'Aromaterapia calmante', 'Sesión centrada en relajación mediante aceites esenciales suaves.', 'Madrid Aroma Studio', 14, 21.00, '1 hora', 'No se requieren materiales'),
(78, 2, 'Aromaterapia energizante', 'Experiencia sensorial con fragancias cítricas y estimulantes.', 'Arganda Wellness Room', 14, 23.00, '1 hora', 'No se requieren materiales'),
(79, 2, 'Ritual de aceites esenciales', 'Tratamiento de bienestar con enfoque sensorial y relajante.', 'Rivas Relax Center', 14, 27.00, '1 hora', 'No se requieren materiales'),
(80, 2, 'Aromaterapia premium', 'Experiencia completa con aceites, ambiente guiado y descanso final.', 'Madrid Centro', 14, 29.00, '1 hora', 'No se requieren materiales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_empresa`
--

CREATE TABLE `solicitud_empresa` (
  `id_solicitud` int(11) NOT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `nombre` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `datos` text DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `estado` enum('pendiente','aprobada','rechazada') NOT NULL DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `solicitud_empresa`
--

INSERT INTO `solicitud_empresa` (`id_solicitud`, `id_empresa`, `nombre`, `email`, `datos`, `fecha`, `estado`) VALUES
(1, NULL, 'Aventuras Extremas', 'aventuras@email.com', 'Empresa especializada en rafting y barranquismo', '2026-03-05 10:00:00', 'pendiente'),
(2, 1, 'empresa1', 'contacto@aventuramadrid.com', 'Solicitud aprobada para publicar actividades', '2026-03-01 09:00:00', 'aprobada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `email` varchar(150) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `id_rol` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `intentos` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `email`, `contrasena`, `telefono`, `id_rol`, `fecha_registro`, `intentos`) VALUES
(4, 'Usuario1', '', 'user1@email.com', 'hash789', '600000000', 1, '2026-03-01 09:00:00', 0),
(6, 'Jonny', 'Mangas', 'Jonny@gmail.com', '$2y$10$fIn2ZYgWvTCt08v2TZT2JuhYc3xVQz6oHKLAcOxSt11rRY9xSKTcW', '666788900', 1, '2026-03-18 22:03:13', 0),
(7, 'Laura', 'Basurto', 'laura@gmail.com', '$2y$10$TFgCAQxgbCeLXLO1NBb11.rC7j4tAsBnZC7tsp/rO4BglsMfHOBXe', '657664762', 3, '2026-03-18 22:05:57', 0),
(8, 'Andrada', 'Robitu', 'andrada@gmail.com', '$2y$10$y9ywBfU28rrAMvkqvuQXfu7t9dfuqysoOBaJpz4l4YHc2yWcfWUSC', '787898876', 3, '2026-03-23 20:39:25', 0),
(9, 'Cris', 'Gonzalez', 'cris@gmail.com', '$2y$10$dMZF/s6KBhkFn20r2Qf2JuYohFPrG6vAYDnITilxDQ2w7E0sePF4u', '198345654', 3, '2026-03-23 20:41:18', 3),
(10, 'maria', 'perez', 'maria@gmail.com', '$2y$10$.YRpfY37pn/8Al3NG.4EU.bh43aq7UiMIsfPtPK5Er6t.o/tVXETy', '987876776', 1, '2026-03-23 20:54:59', 0),
(11, 'laura', 'bas', 'lau@gmail.com', '$2y$10$rjJa4NeRTpdx1jGrXwcj1ONNN3My.yvVTzPm3RO3tTyD9DcGVg3rO', '876879876', 3, '2026-03-27 14:11:09', 1),
(12, 'Cris', 'Gzlez', 'cris22@gmail.com', '$2y$10$9tspqlpKDHvVhEMzOeXY5u.0ER7M9sEGUz/2pexsfbwbtGxJOOuxK', '666666666', 1, '2026-04-14 23:04:22', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `fk_categoria_padre` (`id_categoria_padre`);

--
-- Indices de la tabla `detalle_actividad`
--
ALTER TABLE `detalle_actividad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_detalle_id_servicio` (`id_servicio`),
  ADD KEY `idx_detalle_fecha` (`fecha`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `imagen_servicio`
--
ALTER TABLE `imagen_servicio`
  ADD PRIMARY KEY (`id_imagen`),
  ADD KEY `idx_imagen_id_servicio` (`id_servicio`);

--
-- Indices de la tabla `resena`
--
ALTER TABLE `resena`
  ADD PRIMARY KEY (`id_resena`),
  ADD UNIQUE KEY `uq_resena_usuario_servicio` (`id_usuario`,`id_servicio`),
  ADD KEY `idx_resena_id_usuario` (`id_usuario`),
  ADD KEY `idx_resena_id_servicio` (`id_servicio`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `idx_reserva_id_usuario` (`id_usuario`),
  ADD KEY `idx_reserva_id_servicio` (`id_servicio`),
  ADD KEY `idx_reserva_id_detalle` (`id_detalle_actividad`),
  ADD KEY `idx_reserva_fecha_hora` (`fecha_hora`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id_servicio`),
  ADD KEY `idx_servicio_id_empresa` (`id_empresa`),
  ADD KEY `idx_servicio_id_categoria` (`id_categoria`);

--
-- Indices de la tabla `solicitud_empresa`
--
ALTER TABLE `solicitud_empresa`
  ADD PRIMARY KEY (`id_solicitud`),
  ADD KEY `idx_solicitud_id_empresa` (`id_empresa`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_usuario_id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `detalle_actividad`
--
ALTER TABLE `detalle_actividad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `imagen_servicio`
--
ALTER TABLE `imagen_servicio`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `resena`
--
ALTER TABLE `resena`
  MODIFY `id_resena` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de la tabla `solicitud_empresa`
--
ALTER TABLE `solicitud_empresa`
  MODIFY `id_solicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `fk_categoria_padre` FOREIGN KEY (`id_categoria_padre`) REFERENCES `categoria` (`id_categoria`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_actividad`
--
ALTER TABLE `detalle_actividad`
  ADD CONSTRAINT `fk_detalle_servicio` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `imagen_servicio`
--
ALTER TABLE `imagen_servicio`
  ADD CONSTRAINT `fk_imagen_servicio` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `resena`
--
ALTER TABLE `resena`
  ADD CONSTRAINT `fk_resena_servicio` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_resena_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `fk_reserva_detalle` FOREIGN KEY (`id_detalle_actividad`) REFERENCES `detalle_actividad` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reserva_servicio` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reserva_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD CONSTRAINT `fk_servicio_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_servicio_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id_empresa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `solicitud_empresa`
--
ALTER TABLE `solicitud_empresa`
  ADD CONSTRAINT `fk_solicitud_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id_empresa`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
