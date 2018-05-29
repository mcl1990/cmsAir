INSERT INTO users(name,email,password,perfil_id) VALUES
('Admin','admin@admin.com','$2y$10$bWVYJMRZgleJ5jcst8JI5OzqHsYmmOIY8/9N7Q6A0YNxT6/IgiQ3m',1),
('Editor','foo@bar.com','$2y$10$bWVYJMRZgleJ5jcst8JI5OzqHsYmmOIY8/9N7Q6A0YNxT6/IgiQ3m',2);
-- 
INSERT INTO audios(audio) VALUES
('MP3'),('AAC');
-- 
INSERT INTO categorias(categoria,icono,status)
VALUES
('Peliculas','movie',1);
-- 
INSERT INTO idiomas(idioma) VALUES
('Español Latino'),
('Español'),
('Castellano'),
('Inglés'),
('Frances'),
('Chino'),
('Japones');
-- 
INSERT INTO resoluciones(resolucion,calidad) VALUES
('1280x720','HD 720'),
('720x480','VGA'),
('BluScreen','BluScreen');
-- 
INSERT INTO perfiles(perfil) VALUES
('Super admin'),
('admin'),
('editor');
-- 
INSERT INTO servidores(servidor) VALUES
('mega'),
('openload');
-- 
INSERT INTO tamanos(tamano) VALUES
('MB'),
('GB'),
('TB');
-- 
INSERT INTO videos(video) VALUES
('MP4'),
('MPEG-4'),
('AVI'),
('MKV');
-- 
INSERT INTO tipos_notificaciones (id, tipo_notificacion, icono, style, user_id, created_at, updated_at, mensaje) VALUES 
(1, 'Mensaje Respondido', 'email', 'indigo', 1, '2018-05-25 15:18:51', '2018-05-25 15:19:11', 'Su mensaje fue respondido satisfactoriamente, para poder leer la respuesta, por favor ingrese a su menú contactenos. Muchas gracias por escribirnos, estamos a su orden.'),
(2, 'Aporte Eliminado', 'delete', 'red', 1, '2018-05-25 15:19:33', NULL, 'Su aporte ha sido eliminado por incumplimiento de normas y condiciones de posteo, recuerde que su cuenta puede llegar a ser suspendida y hasta eliminada por faltas recuerrentes, para mayor información y asistencia al momento de registras nuevos aportes, puede dirigirse a su menú Normas donde podra encontrar toda la información al respecto. Feliz día.'),
(3, 'Cuenta Inhabilitada', 'block', 'orange', 1, '2018-05-25 15:20:23', NULL, 'Su Cuenta ha sido Inabilitada por incumplimiento de las normas y condiciones de posteo, recuerde que su cuenta puede llegar a ser eliminada por faltas recuerrentes, para mayor información y asistencia al momento de registras nuevos aportes, puede dirigirse a su menú Normas donde podra encontrar toda la información al respecto. Feliz día.'),
(4, 'Nuevo Seguidor', 'person_add', 'green', 1, '2018-05-25 15:21:14', NULL, 'ha comenzado a seguirte!.'),
(5, 'Nuevo Aporte', 'create_new_folder', 'cyan', 1, '2018-05-25 15:23:58', NULL, 'ha registrado un nuevo aporte.'),
(6, 'Información', 'info', 'black', 1, '2018-05-25 15:26:43', NULL, NULL),
(7, 'Le gustó tu publicación', 'thumb_up', 'indigo', 1, '2018-05-25 15:26:43', NULL, NULL),
(8, 'No le gustó tu publicació', 'thumb_down', 'red', 1, '2018-05-25 15:26:43', NULL, NULL);
-- 
INSERT INTO sanciones (id, sancion, created_at, updated_at) VALUES 
(1, 'Contenido +18', '2018-05-25 20:27:04', NULL),
(2, 'Spam', '2018-05-25 20:28:34', NULL);

INSERT INTO motivos (id, motivo, created_at, updated_at) VALUES 
(1, 'Pregunta', '2018-05-25 15:55:54', NULL),
(2, 'Problema', '2018-05-25 15:56:05', NULL),
(3, 'Reclamo', '2018-05-25 15:56:15', NULL),
(4, 'Sugerencia', '2018-05-25 15:57:00', NULL);


INSERT INTO paises (id, pais, status) VALUES 
(1, 'AFGANISTÁN', 1),
(3, 'ALEMANIA', 1),
(4, 'ALBANIA', 1),
(5, 'ANDORRA', 1),
(6, 'ANGOLA', 1),
(7, 'ANGUILA', 1),
(8, 'ANTIGUA AND BARBUDA', 1),
(9, 'ANTILLAS HOLANDESAS', 1),
(10, 'ANTÁRTIDA', 1),
(11, 'ARABIA SAUDITA', 1),
(12, 'ARGELIA', 1),
(13, 'ARGENTINA', 1),
(14, 'ARMENIA', 1),
(15, 'ARUBA', 1),
(16, 'AUSTRALIA', 1),
(17, 'AUSTRIA', 1),
(18, 'AZERBAIYÁN', 1),
(19, 'BAHAMAS', 1),
(20, 'BAHRÉIN', 1),
(21, 'BANGLADESH', 1),
(22, 'BARBADOS', 1),
(23, 'BELICE', 1),
(24, 'BENÍN', 1),
(25, 'BERMUDA', 1),
(26, 'BIELORRUSIA', 1),
(27, 'BOLIVIA', 1),
(28, 'BOSNIA Y HERZEGOVINA', 1),
(29, 'BOTSUANA', 1),
(30, 'BOUVET ISLAND', 1),
(31, 'BRASIL', 1),
(32, 'BRITISH INDIA OCEAN TERRITORY', 1),
(33, 'BRUNEI DARUSSALAM', 1),
(34, 'BULGARIA', 1),
(35, 'BURKINA FASO', 1),
(36, 'BURUNDI', 1),
(37, 'BUTÁN', 1),
(38, 'BÉLGICA', 1),
(39, 'CABO VERDA', 1),
(40, 'CAMBOYA', 1),
(41, 'CAMERÚN', 1),
(42, 'CANADA', 1),
(43, 'CHAD', 1),
(44, 'CHILE', 1),
(45, 'CHINA', 1),
(46, 'CHIPRE', 1),
(47, 'COLOMBIA', 1),
(48, 'COMORES', 1),
(49, 'CONGO', 1),
(50, 'COREA DEL NORTE', 1),
(51, 'COREA DEL SUR', 1),
(52, 'COSTA RICA', 1),
(53, 'COTE D IVOIRE', 1),
(54, 'CROACIA', 1),
(55, 'CUBA', 1),
(56, 'DINAMARCA', 1),
(57, 'DJIBOUTI', 1),
(58, 'DOMINICA', 1),
(59, 'EAST TIMOR', 1),
(60, 'ECUADOR', 1),
(61, 'EGIPTO', 1),
(62, 'EL SALVADOR', 1),
(63, 'EL VATICANO', 1),
(64, 'EMIRATOS ARABES UNIDOS', 1),
(65, 'ERITREA', 1),
(66, 'ESLOVAQUIA', 1),
(67, 'ESLOVENIA', 1),
(68, 'ESPAÑA', 1),
(69, 'ESTADOS UNIDOS', 1),
(70, 'ESTONIA', 1),
(71, 'ETIOPIA', 1),
(72, 'FIJI', 1),
(73, 'FILIPINAS', 1),
(74, 'FINLANDIA', 1),
(75, 'FRANCIA', 1),
(76, 'FRENCH GUIANA', 1),
(77, 'FRENCH POLYNESIA', 1),
(78, 'FRENCH SOUTHERN TERRITORIES', 1),
(79, 'GABON', 1),
(80, 'GAMBIA', 1),
(81, 'GEORGIA', 1),
(82, 'GHANA', 1),
(83, 'GIBRALTAR', 1),
(84, 'GRANADA', 1),
(85, 'GRECIA', 1),
(86, 'GROENLANDIA', 1),
(87, 'GUADALUPE', 1),
(88, 'GUAM', 1),
(89, 'GUATEMALA', 1),
(90, 'GUINEA', 1),
(91, 'GUINEA ECUATORIAL', 1),
(92, 'GUINEA BISSAU', 1),
(93, 'GUYANA', 1),
(94, 'HAITÍ', 1),
(95, 'HEARD ISLAND AND MCDONALD ISLA', 1),
(96, 'HOLANDA', 1),
(97, 'HONDURAS', 1),
(98, 'HONG KONG', 1),
(99, 'HUNGRÍA', 1),
(100, 'INDIA', 1),
(101, 'INDONESIA', 1),
(102, 'IRAQ', 1),
(103, 'IRLANDA', 1),
(2, 'AMERICAN SAMOA', 2),
(104, 'ISLAS COCOS', 1),
(105, 'ISLA CHRISTMAS', 1),
(106, 'ISLANDIA', 1),
(107, 'ISLAS CAIMÁN', 1),
(108, 'ISLAS COOK', 1),
(109, 'ISLAS FEROE', 1),
(110, 'ISLAS MALVINAS', 1),
(111, 'ISLAS MARSHALL', 1),
(112, 'ISLAS MAURICIO', 1),
(113, 'ISLAS SALOMÓN', 1),
(114, 'ISLAS SÁNDWICH', 1),
(115, 'ISLAS TURKS Y CAICOS', 1),
(116, 'ISLAS WALLIS Y FUTUNA', 1),
(117, 'ISRAEL', 1),
(118, 'ITALIA', 1),
(119, 'JAMAICA', 1),
(120, 'JAPÓN', 1),
(121, 'JORDANIA', 1),
(122, 'KAZAKHSTAN', 1),
(123, 'KENIA', 1),
(124, 'KIRIBATI', 1),
(125, 'KUWAIT', 1),
(126, 'KYRGYZSTAN', 1),
(127, 'LAOS', 1),
(128, 'LATVIA', 1),
(129, 'LESOTO', 1),
(130, 'LIBERIA', 1),
(131, 'LIBIA', 1),
(132, 'LIECHTENSTEIN', 1),
(133, 'LITUANIA', 1),
(134, 'LUXEMBURGO', 1),
(135, 'LÍBANO', 1),
(136, 'MACAO', 1),
(137, 'MACEDONIA', 1),
(138, 'MADAGASCAR', 1),
(139, 'MALASIA', 1),
(140, 'MALAUI', 1),
(141, 'MALDIVAS', 1),
(142, 'MALTA', 1),
(143, 'MALI', 1),
(144, 'MARRUECOS', 1),
(145, 'MARTINIQUE', 1),
(146, 'MAURITANIA', 1),
(147, 'MAYOTTE', 1),
(148, 'MICRONESIA', 1),
(149, 'MOLDAVIA', 1),
(150, 'MONGOLIA', 1),
(151, 'MONTSERRAT', 1),
(152, 'MOZAMBIQUE', 1),
(153, 'MYANMAR', 1),
(154, 'MÉXICO', 1),
(155, 'MÓNACO', 1),
(156, 'NAMIBIA', 1),
(157, 'NAURU', 1),
(158, 'NEPAL', 1),
(159, 'NICARAGUA', 1),
(160, 'NIGERIA', 1),
(161, 'NIUE', 1),
(162, 'NORFOLK ISLAND', 1),
(163, 'NORTHERN MARIANA ISLANDS', 1),
(164, 'NORUEGA', 1),
(165, 'NUEVA CALEDONIA', 1),
(166, 'NUEVA ZELANDANIGER', 1),
(167, 'OMÁN', 1),
(168, 'PAKISTÁN', 1),
(169, 'PALAU', 1),
(170, 'PALESTINIAN TERRITORY', 1),
(171, 'PANAMÁ', 1),
(172, 'PAPUA NUEVA GUINEA', 1),
(173, 'PARAGUAY', 1),
(174, 'PERÚ', 1),
(175, 'PITCAIRN', 1),
(176, 'POLONIA', 1),
(177, 'PORTUGAL', 1),
(178, 'PUERTO RICO', 1),
(179, 'QATAR', 1),
(180, 'REINO UNIDO', 1),
(181, 'REPUBLICA CENTROAFRICANA', 1),
(182, 'REPUBLICA CHECA', 1),
(183, 'REPUBLICA DEMOCRÁTICA DEL CONG', 1),
(184, 'REPUBLICA DOMINICANA', 1),
(185, 'REPUBLICA ISLÁMICA DE IRÁN', 1),
(186, 'RUANDA', 1),
(187, 'RUMANIA', 1),
(188, 'RUSIAN', 1),
(189, 'SAINT KITTS AND NEVIS', 1),
(190, 'SAINT PIERRE Y MIQUELON', 1),
(191, 'SAMOA', 1),
(192, 'SAN MARINO', 1),
(193, 'SAN VICENTE Y LAS GRANADINAS', 1),
(194, 'SANTA ELENA', 1),
(195, 'SANTA LUCIA', 1),
(196, 'SAO TOME AND PRÍNCIPE', 1),
(197, 'SENEGAL', 1),
(198, 'SERBIA Y MONTENEGRO', 1),
(199, 'SEYCHELLES', 1),
(200, 'SIERRA LEONA', 1),
(201, 'SINGAPUR', 1),
(202, 'SIRIA', 1),
(203, 'SOMALIA', 1),
(204, 'SRI LANKA', 1),
(205, 'SUAZILANDIA', 1),
(206, 'SUDÁFRICA', 1),
(207, 'SUDAN', 1),
(208, 'SUECIA', 1),
(209, 'SUIZA', 1),
(210, 'SURINAM', 1),
(211, 'SALVAR AND JAN MAYEN', 1),
(212, 'TAILANDIA', 1),
(213, 'TAIWÁN', 1),
(214, 'TAJIKISTAN', 1),
(215, 'TANZANIA', 1),
(216, 'TOGO', 1),
(217, 'TONGA', 1),
(218, 'TOQUELAU', 1),
(219, 'TRINIDAD Y TOBAGO', 1),
(220, 'TURKMENISTAN', 1),
(221, 'TURQUÍA', 1),
(222, 'TUVALU', 1),
(223, 'TÚNEZ', 1),
(224, 'UCRANIA', 1),
(225, 'UGANDA', 1),
(226, 'UNITED STATES MINOR OUTLYING I', 1),
(227, 'URUGUAY', 1),
(228, 'UZBEKISTAN', 1),
(229, 'VANUATU', 1),
(230, 'VENEZUELA', 1),
(231, 'VIETNAM', 1),
(232, 'VIRGIN ISLANDS BRITISH', 1),
(233, 'VIRGIN ISLANDS U.S.', 1),
(234, 'WESTERN SAHARA', 1),
(235, 'YEMEN', 1),
(236, 'ZAIRE', 1),
(237, 'ZAMBIA', 1),
(238, 'ZIMBABUE', 1),
(239, 'OTRO PAÍS', 1);

