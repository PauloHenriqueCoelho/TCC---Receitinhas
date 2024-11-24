-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/11/2024 às 19:25
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
-- Banco de dados: `user_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `recipes`
--

CREATE TABLE `recipes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ingredients` text NOT NULL,
  `preparation_time` varchar(50) NOT NULL,
  `steps` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `dificuldade` varchar(50) NOT NULL,
  `custo` varchar(50) NOT NULL,
  `serves` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `recipes`
--

INSERT INTO `recipes` (`id`, `user_id`, `name`, `ingredients`, `preparation_time`, `steps`, `created_at`, `image`, `tipo`, `dificuldade`, `custo`, `serves`) VALUES
(25, 7, 'Cuscuz Paulista', '1/2 xícara (chá) de azeite\r\n1 lata ou caixa de molho de tomate\r\n1 lata de ervilha\r\n1 pimentão\r\ncheiro-verde a gosto\r\n1 tablete de caldo de legumes ou do seu sabor preferido\r\n3 ovos cozidos\r\n1 cebola picada\r\n2 copos de água 250ml\r\n1 lata de milho verde\r\n2 latas de sardinha ou atum\r\nsal e temperos a gosto\r\n3 xícaras de farinha de milho grossa\r\ntomate para decorar', '30', '1-Refogue no azeite, a cebola, o pimentão, as azeitonas, a ervilha, o milho verde, o molho de tomate, o cheiro-verde, a sardinha, os temperos e o tablete de caldo\r\n2-Coloque a água, deixe ferver, coloque a farinha de milho e cozinhe.\r\n3-Unte a forma com azeite, e coloque os ovos, os tomates e a sardinha por baixo.\r\n4-Coloque a massa na forma, deixe esfriar e desenforme.', '2024-11-20 02:58:35', 'imagens/CuscuzPaulista.png', 'Salgada', 'Média', 'Médio', 8),
(26, 7, 'Miojo Nissin', '1 pacote de miojo nissin\r\nmussarela\r\n4 colheres de sopa de ketchup\r\n2 colheres de chá de molho de pimenta', '5', '1-Coloque o fogo para ferver.\r\n2-Em seguida coloque as 4 colheres de catchup e mexa.\r\n3-Depois quando a água estiver fervendo ponhe o miojo.\r\n4-Em seguida coloque o tempero e as colheres de pimenta.\r\n5-Depois rale a mussarela em cima do miojo.', '2024-11-20 03:00:13', 'imagens/Miojo.png', 'Salgada', 'Fácil', 'Baixo', 2),
(27, 7, 'Pudim', '6 colheres de sopa de açúcar\r\n1 lata de leite condensado\r\n1 lata de leite, use a mesma medida do leite condensado\r\n3 ovos', '50', '1-Numa forma para pudim, de 20 centímetros de diâmetro, coloque 6 colheres de sopa de açúcar e leve ao fogo médio até virar uma calda caramelada, por mais ou menos 3 minutos.\r\n2-Retire do fogo e vá virando a fôrma, de modo que a calda forre todo o fundo e lateral da mesma. Reserve.\r\n3-Num liquidificador coloque uma lata de leite condensado, uma lata de leite, a mesma medida da lata de leite condensado, e 3 ovos e bata bem por mais ou menos 1 minuto.\r\n4-Desligue o liquidificador e deixe a mistura descansar por 15 minutos.\r\n5-Com esta espera a espuma fica sobre a superfície, o pudim fica sem furinhos, mas macio.\r\n6-Com a ajuda de uma colher segure a espuma que está na superfície e despeje o conteúdo do liquidificador, com cuidado, na fôrma caramelada reservada acima e leve ao forno médio, em banho-maria, a 180 graus Celsius por uma hora e meia.\r\n7-Retire do forno, deixe esfriar e leve à geladeira por mais ou menos duas horas. Desenforme e sirva em seguida.', '2024-11-20 03:01:42', 'imagens/Pudim.png', 'Doce', 'Fácil', 'Baixo', 8),
(28, 7, 'Bolo de fubá', '3 ovos\r\n2 xícaras (chá) de fubá\r\n1/2 copo (americano) de óleo\r\n1 colher (sopa) de fermento em pó\r\n2 xícaras (chá) de açúcar\r\n3 colheres (sopa) rasas de farinha de trigo\r\n1 copo de leite', '45', '1-Bata todos os ingredientes no liquidificador.\r\n2-Coloque em uma forma untada e enfarinhada.\r\n3-Leve ao forno preaquecido e deixe assar, por cerca de 40 minutos.', '2024-11-20 03:02:57', 'imagens/Bolodefuba.png', 'Doce', 'Fácil', 'Baixo', 10),
(29, 7, 'Misto Quente', '2 fatias de presunto magro\r\n2 fatias de pão de forma\r\n2 fatias de queijo prato\r\n2 colheres (chá) de margarina', '15', '1-Passe a margarina em ambas as fatias de pão, recheie com presunto e queijo.\r\n2-Se quiser, use o tostex ou sanduicheira.\r\n3-Coloque no forno, em uma assadeira, até que o queijo esteja derretido.', '2024-11-20 03:06:57', 'imagens/Mistoquente.png', 'Salgada', 'Fácil', 'Baixo', 1),
(30, 7, 'Escondidinho', '1 kg de batata\r\n200 g de queijo mussarela\r\n1 cebola\r\nsal a gosto\r\ncheiro-verde a gosto\r\n2 colheres de manteiga\r\n500 g de carne moída\r\nazeite\r\n1 dente de alho amassado\r\npimenta branca a gosto\r\n1/2 copo de leite', '60', '1-Descasque as batatas, corte ao meio e cozinhe com água e sal.\r\n2-Depois de cozidas, amasse as batatas, adicione o leite e a manteiga, mexa bem até formar um purê e reserve.\r\n3-Em uma panela, adicione 1 fio de azeite, a cebola, o alho e refogue a carne moída.\r\n4-Tempere com sal, pimenta branca, cheiro-verde e cozinhe até secar a água que se formar na panela.\r\n5-Forre um refratário com a metade do purê de batatas.\r\n6-Acrescente uma camada de queijo e uma camada de carne moída.\r\n7-Repita o processo e finalize com queijo ralado por cima.\r\n8-Leve ao forno por 40 minutos.', '2024-11-20 03:09:05', 'imagens/Escondidinho.png', 'Salgada', 'Média', 'Médio', 7),
(31, 7, 'Arroz Carreteiro', '3 copos de arroz\r\n200 g de bacon fatiado\r\n1 tomate grande bem maduro\r\nPimenta calabresa\r\nSal\r\n500 g de carne seca\r\n200 g de calabresa\r\n1 cebola grande\r\nSalsa', '60', '1-Cozinhe a carne seca em panela de pressão, retire, espera esfriar e desfie.\r\n1-Reserve.\r\n2-Retire a pele da calabresa e corte em cubos juntamente com o bacon.\r\n3-Corte o tomate em cubos pequenos sem as sementes bem como a cebola.\r\n4-Reserve.\r\n5-Refogue o bacon e a calabresa até ficar bem dourada, acrescentando depois a cebola, tomate, pimenta calabresa e a carne desfiada.\r\n6-Após acrescente o arroz, afogue bem, adicione a água corrigindo o sal se necessário e abaixe o fogo aguardando secar.\r\n7-Quando pronto, colocar a salsa em cima.', '2024-11-20 03:10:12', 'imagens/Arrozcarretero.png', 'Salgada', 'Fácil', 'Médio', 4),
(32, 7, 'Pastel', '1 massa de pastel de sua preferência\r\n1/2 cebola bem picadinha\r\n400 g de carne moída\r\n1 caldo de carne\r\n1 pimentão verde picadinho\r\n200 g de Bacon\r\nsalsinha sal a gosto\r\n2 tomates picados sem semente', '30', '1-Frite bem o bacon, depois coloque a cebola, pimentão e frite bem novamente.\r\n2-Coloque a carne e refogue, quando ela estiver quase refogada coloque o tomate e o caldo de carne e deixe secar bem água que forma da carne.\r\n3-Se precisar coloque sal, termine de refogar a carne, desligue o fogo.\r\n4-Coloque a salsinha.\r\n5-Deixe esfriar e recheie o pastel.', '2024-11-20 03:11:08', 'imagens/Pastel.png', 'Salgada', 'Fácil', 'Baixo', 5),
(33, 7, 'Bauru', '1 pão francês fresco\r\n1 fatia de queijo\r\n5 fatias de rosbife\r\n2 rodelas de tomate\r\nPicles', '5', '1-Corte o pão ao meio no sentido vertical, tire um pouco do miolo. Ponha o rosbife, algumas fatias de pepino em conserva e o tomate.\r\n2-Derreta o queijo: numa frigideira antiaderente, ponha uma camada finíssima de água no fundo. Leve ao fogo até a água ferver (é bem rápido). Coloque as fatias de queijo na água, aos poucos, espere dois ou três segundos e o queijo começa a derreter. Usando uma pinça longa, mexa o queijo rapidamente e, assim que derreter completamente, tire da panela, coloque direto no sanduíche e feche.', '2024-11-20 03:12:21', 'imagens/Bauru.png', 'Salgada', 'Fácil', 'Baixo', 2),
(34, 7, 'Galinhada', '1 frango, cortado em pedaços\r\nSuco de meio limão\r\n1 cebola média ralada\r\n2 colheres (sopa) de extrato de tomate\r\n1 colher (sopa) de salsa picada\r\n2 tabletes de caldo de galinha\r\n2 colheres (sopa) de azeite\r\n2 xícaras (chá) de arroz lavado\r\n1 pimentão verde cortado em cubinhos', '30', '1-Lave os pedaços de frango, tempere-os com os tabletes de caldo de galinha e o suco de limão e deixe tomar gosto.\r\n2-Em uma panela grande, aqueça o azeite e doure os pedaços de frango. Adicione a cebola e deixe refogar ligeiramente. Junte o arroz, o extrato de tomate, o pimentão e 4 xícaras e 1/2 (chá) de água, mexendo bem.\r\n3-Tampe a panela e, assim que iniar fervura, baixe o fogo e cozinhe por cerca de 15 minutos, até que o arroz fique cremoso e úmido. Se necessário, pingue mais água. Retire do fogo e passe para uma travessa.\r\n4-Polvilhe a salsa e sirva a seguir.', '2024-11-20 03:13:39', 'imagens/Galinhada.png', 'Salgada', 'Média', 'Médio', 5),
(35, 7, 'Brigadeiro', '1 caixa de leite condensado\r\n7 colheres (sopa) de achocolatado ou 4 colheres (sopa) de chocolate em pó\r\n1 colher (sopa) de margarina sem sal\r\nChocolate granulado', '25', '1-Em uma panela funda, acrescente o leite condensado, a margarina e o chocolate em pó.\r\n2-Cozinhe em fogo médio e mexa até que o brigadeiro comece a desgrudar da panela.\r\n3-Deixe esfriar e faça pequenas bolas com a mão passando a massa no chocolate granulado.', '2024-11-20 03:14:46', 'imagens/Brigadeiro.png', 'Doce', 'Fácil', 'Baixo', 20),
(36, 7, 'Feijoada', '1 Kg de feijão preto\r\n70 g de orelha de porco\r\n70 g de pé de porco\r\n50 g de lombo de porco\r\n150 g de lingüiça portuguesa\r\n100 g de carne seca\r\n70 g de rabo de porco\r\n100 g de costelinha de porco\r\n100 g de paio\r\n2 cebolas grandes picadinhas\r\n3 folhas de louro\r\nPimenta do reino a gosto\r\n40 ml de de pinga\r\n1 maço de cebolinha verde picadinha\r\n6 dentes de alho\r\n1 ou 2 laranjas\r\nSal se precisar', '140', '1-Coloque as carnes de molho por 36 horas ou mais, vá trocando a água várias vezes, se for ambiente quente ou verão, coloque gelo por cima ou em camadas frias.\r\n2-Coloque para cozinhar passo a passo: as carnes duras, em seguida as carnes moles.\r\n3-Quando estiver mole coloque o feijão, e retire as carnes.\r\n4-Finalmente tempere o feijão.\r\n5-Couve, arroz branco, laranja, bistecas, farofa, quibebe de abóbora, baião de dois, bacon, torresmo, lingüicinha e caldinho temperado - copinhos.', '2024-11-20 03:16:34', 'imagens/Feijoada.png', 'Salgada', 'Difícil', 'Médio', 10),
(37, 7, 'Rocambole', '6 ovos\r\n6 colheres (sopa) de farinha de trigo\r\n1 xícara (chá) de açúcar\r\n1 colher (sopa) fermento em pó\r\n1 lata de leite condensado cozida', '45', '1-Bata as claras em neve deixando-as bem firmes. Desligue a batedeira. Acrescente as gemas e mexa delicadamente, de preferência com um fuê.\r\n2-Em seguida acrescente o açúcar sempre mexendo delicadamente.\r\n3-Por último, a farinha e o fermento. Unte uma forma retangular de 40x22 cm aproximadamente.\r\n4-O importante é que a forma seja grande para que a massa não fique tão alta. Leve ao forno preaquecido por aproximadamente 20 minutos.\r\n5-Depois de assado coloque a massa em um pano de prato seco corte as beiradas, espalhe o recheio e enrole com a ajuda do pano de prato.\r\n6-lata de leite condensado por 20 minutos depois da pressão, cozido ou outro de sua preferência.', '2024-11-20 03:17:34', 'imagens/Rocambole.png', 'Doce', 'Média', 'Baixo', 10),
(38, 7, 'Maria Mole', '1 pacote de gelatina em pó sem sabor\r\n1 copo de água fervente\r\n1/2 kg de açúcar (dois copos de requeijão)\r\n100 g de coco ralado', '50', '1-Colocar a gelatina para reidratar com 1/2 xícara de café de água fria, dentro da tigela da batedeira.\r\n2-A parte, coloque a água para esquentar até ferver.\r\n3-Coloque na tigela da batedeira o açúcar, despeja a água fervente e bata na velocidade máxima por 15 minutos, até que fique em ponto de merengue.\r\n4-Unte levemente o fundo e as laterais de um tabuleiro de, mais ou menos 32 cm X 25 cm, com margarina e polvilhe com um pouquinho do coco.\r\n5-Despeje o conteúdo da batedeira no tabuleiro e leve a geladeira por, aproximadamente, 30 minutos.\r\n6-Após esse tempo, corte em quadradinhos de tamanho médio e passe no coco ralado.\r\n7-Está pronta uma sobremesa deliciosa e que agrada muito as crianças e adultos claro.', '2024-11-20 03:19:48', 'imagens/mariamole.png', 'Doce', 'Média', 'Médio', 8),
(39, 7, 'Pão de Queijo', '500 g de polvilho doce\r\n250 ml de leite integral\r\n1 colher/sopa rasa de sal\r\n1 prato cheio (350 g) de queijo meia cura e/ou mussarela ralado no ralador (quanto mais queijo, mais gostoso o pão vai ficar)\r\n1 ou 2 ovos\r\n1/2 copo de óleo\r\n1 pacote de queijo ralado parmesão', '60', '1-Primeiro, coloque o leite e o óleo em uma panela pra esquentar, desligue o fogo imediatamente assim que começar a ferver (você verá umas bolinhas do leite subindo).\r\n2-Em uma tigela grande, coloque o polvilho e o sal, e misture bem, logo em seguida, despeje o conteúdo da panela ainda quente, misture bem, primeiro com uma colher e depois com a mão.\r\n3-Em seguida coloque o queijo ralado e um pouco do queijo do prato e também 1 ovo, continue misturando bem.\r\n4-Coloque o resto do queijo e verifique se a massa esta com uma textura boa, nem muito oleosa e nem muito seca.\r\n5-Se você sentir que está muito seca, coloque outro ovo, se ela ficar oleosa, coloque mais um pouco de polvilho.\r\n6-Essa massa deverá soltar da tigela e também da sua mão.\r\n7-Experimente a massa e veja se esta boa de sal, algumas pessoas gostam de colocar um pouco mais de sal.\r\n8-Agora é só fazer bolinhas e colocar na assadeira, deixando um pequeno espaço entre um pão e o outro.\r\n9-Não é necessário untar a assadeira.\r\n10-Deixe no forno em temperatura média (230°) até dourar um pouco.', '2024-11-20 03:20:51', 'imagens/pãodequeijo.png', 'Salgada', 'Média', 'Médio', 30),
(40, 7, 'Bolinho de Chuva', '2 ovos\r\n1 xícara (chá) de leite\r\n1 colher (sopa) de fermento em pó\r\n1 colher (sopa) de canela para polvilhar\r\n1 xícara de açúcar\r\n2 e 1/2 xícaras de farinha de trigo\r\n3 colheres (sopa) de açúcar para polvilhar\r\n1 litro de óleo para fritar', '30', '1-Misture todos os ingredientes até obter uma massa cremosa e homogênea.\r\n2-Deixe aquecer uma panela com bastante óleo para que os bolinhos possam boiar.\r\n3-Quando o óleo estiver bem quente (180º C), com uma colher, comece a colocar pequenas quantidades de massa, e frite até que dourem por inteiro.\r\n4-Coloque os bolinhos sobre papel absorvente e depois passe-os no açúcar com canela', '2024-11-20 03:21:34', 'imagens/bolodechuva.png', 'Doce', 'Fácil', 'Baixo', 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `user_form`
--

CREATE TABLE `user_form` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` enum('ativo','banido') DEFAULT 'ativo',
  `verification_code` varchar(255) NOT NULL,
  `verified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `user_form`
--

INSERT INTO `user_form` (`id`, `name`, `email`, `password`, `image`, `status`, `verification_code`, `verified`) VALUES
(4, 'Ana', 'beazinha@gmail.com', 'a9d3468415c5df6f21bd3561555afbc3', '', 'ativo', '', 0),
(5, 'paulo', 'klausdaguerra@gmail.com', 'a9d3468415c5df6f21bd3561555afbc3', '', 'ativo', '', 0),
(6, 'Guaraci', 'guaracipaques@uol.com.br', 'a9d3468415c5df6f21bd3561555afbc3', '', 'ativo', '', 0),
(7, 'Receitinhas Oficial', 'receitinhas@gmail.com', 'a9d3468415c5df6f21bd3561555afbc3', '', 'ativo', '', 1),
(31, 'Pauloteste', 'caracmermaoa@gmail.com', 'a9d3468415c5df6f21bd3561555afbc3', '54537423803_REDACAO_ENEM2023.JPG', 'ativo', '745530', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Índices de tabela `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de tabela `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user_form` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
