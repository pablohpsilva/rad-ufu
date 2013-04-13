INSERT INTO categoria (categoria_nome) VALUES ('Ensino');
INSERT INTO categoria (categoria_nome) VALUES ('Orientação');
INSERT INTO categoria (categoria_nome) VALUES ('Produção Bibliográfica e Divulgação');
INSERT INTO categoria (categoria_nome) VALUES ('Produção Artística');
INSERT INTO categoria (categoria_nome) VALUES ('Produção Técnica');
INSERT INTO categoria (categoria_nome) VALUES ('Pesquisa');
INSERT INTO categoria (categoria_nome) VALUES ('Extensão e Prestação de Serviços');
INSERT INTO categoria (categoria_nome) VALUES ('Licenças, Situações Especiais e Qualificação');
INSERT INTO categoria (categoria_nome) VALUES ('Administrativas e Representações');
INSERT INTO categoria (categoria_nome) VALUES ('Outras');

INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/semestre por aula dada semanalmente');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/aula dada/semana');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/disciplina');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('ponto para cada grupo completo de 5 alunos acima de 45');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('ponto para cada grupo completo de 4 alunos acima de 12');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('ponto para cada grupo completo de 3 alunos acima de 9');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('ponto para cada grupo completo de 2 alunos acima de 6');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('ponto para cada grupo completo de 3 alunos acima de 8');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('ponto para cada aluno por aula dada/semana');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/aluno');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/orientação');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/evento');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/semestre');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/trabalho');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/resumo');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/publicação');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/tema');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/tema limitado a 20 pontos/semestre');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/premiação/trabalho ou evento');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/publicação limitado a um por ano');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/publicação limitado em 120 pontos/ano');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/obra');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/capítulo ou artigo');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/exposição');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/direção');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/autoria');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/adaptação ou trabalho');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/ópera ou musical');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/hora - máx. de 30 horas/obra');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/maquete');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/participação');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/parecer');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/registro');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/patente');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/relatório');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('ponto/hora-aula; limite de 40 pontos por semestre');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('1/180 da pontuação de referência  por dia de afastamento');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('1/180 da pontuação de referência  por dia de readaptação');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('100% da pontuação de referência');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('50% da pontuação de referência');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('100% pontuação referência/semestre');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('70% pontuação referência/semestre');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('50% pontuação referência/semestre');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('40% pontuação referência/semestre');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('60% pontuação referência/semestre');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/coordenadoria-curadoria/semestre');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/coordenação/semestre');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/Curso');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/semestre/projeto');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/comissão/semestre');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/participação/semestre');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/representação/semestre');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/Conselho/semestre');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/presidência');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('1/180 da pontuação do cargo/dia/semestre');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('pontos/aula dada/semana/semestre');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('ponto para cada grupo de 3 alunos acima de 8');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('ponto/hora-aula; limite de 30 pontos');
INSERT INTO multiplicador (multiplicador_nome) VALUES ('ponto/hora; limite de 30 pontos');

--ATIVIDADES DE ENSINO
--1
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (1,10,1,'Aula teórica ou prática de disciplinas ministradas na Educação Básica, na Educação Profissional, em cursos de graduação ou pós-graduação stricto e lato sensu da UFU, sem remuneração complementar, aprovadas pelo Conselho da Unidade. Para disciplinas ministradas por mais de um docente, a pontuação deverá ser atribuída ao docente de acordo com a carga horária ministrada pelo mesmo. Turmas adicionais da mesma disciplina ministradas pelo docente serão pontuadas nos itens 02 e 03.');
--2
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (1,10,2,'Aula teórica ou prática para turmas adicionais da mesma disciplina, enquadrada na Situação 1 (ver OBS.), ou ministrada pelo mesmo docente para Cursos oferecidos em turnos distintos.');
--3
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (1,5,2,'Aula teórica ou prática para turmas adicionais da mesma disciplina, ministrada pelo mesmo docente, e no mesmo Curso, enquadrada na Situação 2 (ver OBS.).');
--4
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (1,10,3,'Aula de graduação oferecida em regime especial, aprovado pelo Conselho da Unidade.');
--5
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (1,1,4,'Aula teórica para turmas com mais de 45 alunos, equivalente à turma padrão para este item.');
--6
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (1,1,5,'Aula prática de Ciências Humanas, Ciências Sociais Aplicadas, Letras e Lingüística para turmas com mais de 12 alunos (exceto Música), equivalente à turma padrão para este item.');
--7
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (1,1,6,'Aula prática de Ciências Exatas e da Terra, Ciências Agrárias, Ciências Biológicas, Engenharias e Ciências da Saúde (exceto Medicina, Enfermagem e Odontologia) para turmas com mais de 9 alunos, equivalente à turma padrão para este item.');
--8
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (1,1,7,'Aula prática de Medicina, Enfermagem, Odontologia, Música, mestrado e doutorado para turmas com mais de 6 alunos, equivalente à turma padrão para este item.');
--9
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (1,1,8,'Aula prática de cursos de pós-graduação lato sensu, sem remuneração suplementar, para turmas com mais de 8 alunos, equivalente à turma padrão para este item.');
--10
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (1,0.05,9,'Número de alunos por disciplina incluída no item 01.');

--ATIVIDADES DE ORIENTAÇÃO
--11
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (2,4,10,'Orientação de alunos de graduação e da educação profissional em atividades curriculares de ensino (Estágio Supervisionado, Estágio Profissionalizante, Ensino Vivenciado, Monografia de Graduação, Assistência Judiciária e similares). A comprovação deverá ser fornecida pela Coordenação do Curso na qual o aluno encontra-se matriculado. É permitida a contagem até o limite de quatro semestres de orientação a um mesmo aluno. Somente serão pontuadas as atividades de orientação com duração superior a três meses.');
--12
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (2,4,10,'Orientação de alunos da Educação Básica, da Educação Profissional ou da graduação em projetos de ensino, pesquisa e extensão com bolsa de Iniciação Científica (PIBEG, PEIC, PET e similares). A comprovação deverá ser pelo órgão de fomento do qual o aluno é bolsista. Somente serão pontuadas as atividades de orientação com duração superior a três meses.');
--13
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (2,3,10,'Orientação de alunos da Educação Básica, da Educação Profissional ou da graduação em projetos de ensino, pesquisa e extensão sem bolsa de Iniciação Científica (projetos sem bolsa registrados na Unidade Administrativa em questão e similares). A comprovação deverá ser fornecida pelas Diretorias competentes da UFU. Somente serão pontuadas as atividades de orientação com duração superior a três meses.');
--14
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (2,10,10,'Orientação de Dissertação de Mestrado. É permitida a contagem até o limite de quatro semestres de orientação a um mesmo aluno. A comprovação deverá ser feita pela Coordenação do Programa de Pós-graduação no qual o aluno encontra-se matriculado.');
--15
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (2,5,10,'Co-orientação de Dissertação de Mestrado. É permitida a contagem até o limite de quatro semestres de co-orientação a um mesmo aluno. A comprovação deverá ser feita pela Coordenação do Programa de Pós-graduação no qual o aluno encontra-se matriculado.');
--16
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (2,15,10,'Orientação de Tese de Doutorado. É permitida a contagem até o limite de oito semestres de orientação a um mesmo aluno. A comprovação deverá ser feita pela Coordenação do Programa de Pós-graduação no qual o aluno encontra-se matriculado.');
--17
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (2,10,10,'Co-orientação de Tese de Doutorado. É permitida a contagem até o limite de oito semestres de co-orientação a um mesmo aluno. A comprovação deverá ser feita pela Coordenação do Programa de Pós-graduação no qual o aluno encontra-se matriculado.');
--18
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (2,5,11,'Orientação de graduados em Cursos de Educação profissional ou permanente. As atividades deverão ser comprovadas pela Pró-Reitoria de Pesquisa e Pósgraduação – PROPP. Somente serão pontuadas as atividades de orientação com duração superior a quatro meses.');
--19
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (2,5,10,'Orientação de Monografia de Curso de Especialização. Somente serão pontuadas as atividades de orientação com duração superior a quatro meses. A atividade será comprovada por declaração do Coordenador de Curso ou do Diretor da Unidade.');
--20
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (2,2,10,'Orientação de Monitores. É permitida a contagem até o limite de quatro semestres de orientação a um mesmo aluno. A monitoria deverá ser oficializada pelos órgãos competentes da UFU e aprovada pelo Conselho da Unidade. Somente serão pontuadas as atividades de orientação com duração igual ou superior a quatro meses.');
--21
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (2,4,12,'Orientação ou supervisão de alunos da educação básica e profissional, em exposições, congressos, seminários e encontros. Serão pontuadas as atividades aprovadas pelo Conselho da Unidade Especial de Ensino e comprovadas por declaração do Diretor.');
--22
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (2,4,13,'Orientação educacional na educação básica, em atividades de recreio orientado. Serão pontuadas as atividades comprovadas por meio de Portaria de nomeação do docente.');

--PRODUÇÃO BIBLIOGRÁFICA E DIVULGAÇÃO
--23
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (3,120,14,'Artigo técnico-científico publicado em periódico indexado internacional. Serão pontuadas as publicações com número de páginas superior a dois, comprovadas por cópia da folha de rosto do meio de divulgação do artigo e da primeira página do mesmo. Publicações com número de páginas inferior a três serão pontuadas desde que o periódico seja classificado como QUALIS A ou B.');
--24
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (3,100,14,'Artigo técnico-científico publicado em periódico indexado nacional. Serão pontuadas as publicações com número de páginas superior a dois, comprovadas por cópia da folha de rosto do meio de divulgação do artigo e da primeira página do mesmo. Publicações com número de páginas inferior a três serão pontuadas desde que o periódico seja classificado como QUALIS A ou B.');
--25
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (3,40,14,'Artigo técnico-científico publicado em periódico não-indexado, com corpo de revisores. Serão pontuadas as publicações com número de páginas superior a dois, comprovadas por cópia da folha de rosto do meio de divulgação do artigo e da primeira página do mesmo.');
--26
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (3,60,14,'Publicação de trabalho completo em anais de reunião científica internacional, com corpo de revisores. Reuniões científicas internacionais realizadas em território nacional poderão ser pontuadas. Serão pontuadas as publicações com número de páginas superior a dois, comprovadas por cópia da folha de rosto do meio de divulgação do artigo e da primeira página do mesmo.');
--27
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (3,40,14,'Publicação de trabalho completo em anais de reunião científica nacional, com corpo de revisores. Serão pontuadas as publicações com número de páginas superior a dois, comprovadas por cópia da folha de rosto do meio de divulgação do artigo e da primeira página do mesmo.');
--28
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (3,10,14,'Publicação de resumo em anais de reunião científica internacional. Reuniões científicas internacionais realizadas em território nacional poderão ser pontuadas. Serão pontuadas as publicações comprovadas por cópia do resumo e da folha de rosto do meio de divulgação do resumo.');
--29
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (3,5,15,'Publicação de resumo em anais de reunião científica nacional, periódico ou boletim técnico. Serão pontuadas as publicações comprovadas por cópia do resumo e da folha de rosto do meio de divulgação do resumo.');
--30
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (3,5,16,'Publicação individual de crítica, prefácio de obras especializadas, espetáculos ou exposições. Serão pontuadas aquelas comprovadas por cópia da publicação ou folha de rosto do meio de divulgação.');
--31
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (3,10,16,'Publicação individual de resenha. Serão pontuadas as publicações comprovadas por cópia da folha de rosto do meio de divulgação e da primeira página da publicação.');
--32
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (3,10,14,'Apresentação de trabalho ou mostra documental em reunião científica internacional. Serão pontuados apenas os trabalhos apresentados pelo docente, comprovados por certificado assinado pelo Coordenador ou pelo Presidente do evento científico. Reuniões científicas internacionais realizadas em território nacional poderão ser pontuadas.');
--33
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (3,5,14,'Apresentação de trabalho ou mostra documental em reunião científica nacional. Serão pontuados apenas os trabalhos apresentados pelo docente, comprovados por certificado assinado pelo Coordenador ou pelo Presidente do evento científico.');
--34
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (3,15,17,'Palestras e conferências proferidas, minicursos ministrados, participação em painéis de debate ou mesas redondas em reuniões científicas promovidas por associações ou sociedades científicas ou associações esportivas nacionais e internacionais. Somente serão pontuadas as participações devidamente comprovadas por certificado do evento científico.');
--35
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (3,5,18,'Palestras e conferências proferidas, minicursos ministrados, participação em mesas redondas ou em painéis de debate em reuniões científicas não promovidas por associações ou sociedades científicas. Somente serão pontuadas as participações devidamente comprovadas por certificado do evento científico.');
--36
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (3,5,18,'Palestras e conferências proferidas, minicursos ministrados, participação em mesas redondas ou em painéis de debate em eventos acadêmicos isolados e eventos sem apresentação de trabalho. Somente serão pontuadas as participações devidamente comprovadas por certificado do evento.');
--37
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (3,30,19,'Premiação ou menção honrosa de trabalhos artísticos, arquitetônicos, científicos, literários em eventos científicos, esportivos e culturais. O trabalho deverá ser pontuado uma única vez e a premiação ou menção honrosa deverá ser comprovada.');
--38
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (3,20,20,'Monografia defendida em curso de especialização. A comprovação será feita por declaração da Coordenação do Curso de Especialização.');
--39
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (3,40,20,'Dissertação de Mestrado defendida pelo docente. A comprovação será feita por declaração da Coordenação do Programa de Pósgraduação no qual o docente encontra-se matriculado.');
--40
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (3,80,20,'Tese de Doutorado ou Livre Docência defendida pelo docente. A comprovação será feita por declaração da Coordenação do Programa de Pósgraduação no qual o docente encontra-se matriculado.');
--41
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (3,120,21,'Publicação de livro cultural ou técnico no exterior. Só serão aceitos livros publicados por Editora com Conselho Editorial. Serão pontuadas as publicações comprovadas por cópia da folha de rosto do meio de divulgação e da ficha catalográfica.');
--42
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (3,100,21,'Publicação de livro cultural ou técnico no país. Só serão aceitos livros publicados por Editora com Conselho Editorial. Serão pontuadas as publicações comprovadas por cópia da folha de rosto do meio de divulgação e da ficha catalográfica.');
--43
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (3,40,22,'Publicação de capítulo de livro cultural ou técnico no exterior, desde que não inserido em anais de congressos ou eventos. Só serão aceitos livros publicados por Editora com Conselho Editorial. Serão pontuadas as publicações comprovadas por cópia da folha de rosto do meio de divulgação e da ficha catalográfica.');
--44
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (3,30,22,'Publicação de capítulo de livro cultural ou técnico no País, desde que não inserido em anais de congressos ou eventos. Só serão aceitos livros publicados por Editora com Conselho Editorial. Serão pontuadas as publicações comprovadas por cópia da folha de rosto do meio de divulgação e da ficha catalográfica.');
--45
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (3,30,23,'Editoração de livros, de anais de eventos, coleções, periódicos ou dossiês de periódicos. Serão pontuadas as publicações comprovadas por cópia da folha de rosto do meio de divulgação e da ficha catalográfica.');
--46
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (3,30,23,'Tradução de peças teatrais, de óperas encenadas ou livros. A autoria de cada trabalho deverá ser devidamente comprovada. Caso o trabalho tenha sido publicado, pontuar apenas os itens relativos a publicações; no caso da obra ter sido publicada e apresentada, considerar somente a publicação. Serão pontuadas as traduções comprovadas por cópia da folha de rosto do meio de divulgação e das primeiras páginas da mesma.');
--47
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (3,10,24,'Tradução de capítulo de livros ou artigos em periódicos. Serão pontuadas as traduções comprovadas por cópia da folha de rosto do meio de divulgação e das primeiras páginas da publicação.');

--PRODUÇÃO ARTÍSTICA
--48
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (4,100,25,'Exposição artística nacional individual de obras artísticas inéditas. Serão pontuadas as exposições devidamente comprovadas por meio de catálogos. Cada exposição será pontuada uma única vez, desde que autorizada e comprovada pela Unidade.');
--49
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (4,40,25,'Exposição artística nacional coletiva de obras artísticas inéditas. Serão pontuadas as exposições devidamente comprovadas por meio de catálogos. Cada exposição será pontuada uma única vez, desde que autorizada e comprovada pela Unidade.');
--50
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (4,120,25,'Exposição artística internacional individual de obras artísticas inéditas. Serão pontuadas as exposições devidamente comprovadas por meio de catálogos. Cada exposição será pontuada uma única vez, desde que autorizada e comprovada pela Unidade.');
--51
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (4,60,25,'Exposição artística internacional coletiva de obras artísticas inéditas. Serão pontuadas as exposições devidamente comprovadas por meio de catálogos. Cada exposição será pontuada uma única vez, desde que autorizada e comprovada pela Unidade.');
--52
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (4,60,23,'Participação como solista em concertos, recitais ou gravações. A participação será pontuada uma única vez, independente do número de apresentações, desde que autorizada e comprovada pela Unidade.');
--53
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (4,20,23,'Participação como não solista em concertos, recitais ou gravações. A participação será pontuada uma única vez, independente do número de apresentações, desde que autorizada e comprovada pela Unidade.');
--54
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (4,120,26,'Direção de filmes, vídeos, peças teatrais, óperas e espetáculos de dança realizados e/ou encenados em eventos artístico-culturais nacionais ou internacionais. A participação será pontuada uma única vez, independente do número de apresentações, desde que autorizada e comprovada pela Unidade.');
--55
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (4,90,27,'Autoria de peças teatrais, roteiros, óperas, concertos, composições musicais, trilha sonora, cenografia, figurino, iluminação e/ou coreografias integrais apresentadas e/ou gravadas. Os trabalhos artísticos poderão ser pontuados uma única vez, independente do número de apresentações, desde que autorizados e comprovados pela Unidade.');
--56
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (4,20,28,'Adaptação de peça teatral e/ou ópera encenada e/ou autoria de trabalho na área de comunicação visual publicada. Os trabalhos artísticos poderão ser pontuados uma única vez, independente do número de apresentações, desde que autorizados e comprovados pela Unidade.');
--57
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (4,60,29,'Regência de ópera ou espetáculo musical em eventos artístico-culturais nacionais ou internacionais. Cada trabalho poderá ser pontuado uma única vez, independente do número de apresentações, desde que aprovado e comprovado pela Unidade.');
--58
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (4,20,23,'Transcrição e/ou arranjo de obras musicais gravadas ou publicadas. Cada trabalho poderá ser pontuado uma única vez, independente do número de apresentações ou execuções, desde que aprovadas e comprovadas pela Unidade.');
--59
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (4,30,23,'Interpretação de papéis centrais em óperas, espetáculos teatrais ou de dança. A participação será pontuada uma única vez, independente do número de apresentações, desde que aprovada e comprovada pela Unidade.');
--60
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (4,10,23,'Interpretações de papéis secundários em óperas, espetáculos teatrais ou de dança. A participação será pontuada uma única vez, independente do número de apresentações, desde que aprovada e comprovada pela Unidade.');
--61
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (4,2,30,'Restauração de obras artísticas de comprovado valor histórico. Será pontuada a atividade aprovada e comprovada pela Unidade.');
--622
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (4,40,26,'Direção de leitura dramática ou de peça radiofônica. A participação será pontuada uma única vez, independente do número de apresentações desde que aprovada e comprovada pela Unidade.');
--63
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (4,2,12,'Apresentações artístico-culturais em eventos isolados. Será pontuada a atividade aprovada e comprovada pela Unidade.');
--64
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (4,20,31,'Maquetes físicas ou digitais. Cada maquete poderá ser pontuada uma única vez, desde que aprovada e comprovada pela Unidade.');

--PRODUÇÃO TÉCNICA
--65
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (5,10,32,'Membro de Comissão Julgadora de eventos científicos, artísticos, culturais, esportivos, técnicos e de banca de qualificação para o exercício profissional. Serão pontuadas as participações comprovadas com certificado do evento.');
--66
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (5,10,13,'Membro de Comissão Organizadora de reuniões científicas, artísticas, culturais, técnicas e esportivas. Serão pontuadas as participações comprovadas por declaração do Coordenador da Comissão Organizadora ou do Diretor da Unidade responsável pela organização do evento.');
--67
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (5,5,33,'Parecer ad hoc prestado a editoras, revistas especializadas e órgãos de fomento, comprovado por declaração da instituição solicitante, resguardado o sigilo e demais considerações éticas associadas a pareceres ad hoc.');
--68
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (5,15,13,'Coordenação de Comissão Organizadora de reuniões científicas, artísticas, culturais, técnicas e esportivas, promovidas por associações ou sociedades científicas ou artístico-culturais, comprovada por declaração da instituição solicitante.');
--69
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (5,20,13,'Diretor-geral ou Editor Chefe de revista científica ou artística. Serão pontuadas as participações devidamente comprovadas pela Revista.');
--70
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (5,10,13,'Membro de Conselho ou Corpo Editorial de revista científica, artística ou de Editoras. Este item não contempla Conselho Editorial composto pelos consultores ad hoc, pois essa atividade já está contemplada em outro item. Serão pontuadas as participações devidamente comprovadas pela Revista ou Editora.');
--71
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (5,4,32,'Membro titular de banca de defesa de projetos, estágio supervisionado e de monografias de graduação. Serão pontuadas as participações comprovadas por meio de declaração fornecida pelo Coordenador de Curso de Graduação ou pelo Diretor da Unidade.');
--72
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (5,5,32,'Membro titular de banca de defesa de Monografia de Pós-graduação lato sensu. Serão pontuadas as participações comprovadas por declaração fornecida pelo Coordenador de Curso de Pós-graduação.');
--73
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (5,10,32,'Membro titular de banca de exame de qualificação de Mestrado ou Doutorado. Serão pontuadas as participações comprovadas por declaração fornecida pelo Coordenador de Curso de Pós-graduação.');
--74
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (5,15,32,'Membro titular de banca de Dissertação de Mestrado. Serão pontuadas as participações comprovadas por declaração fornecida pelo Coordenador de Curso de Pós-graduação.');
--75
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (5,20,32,'Membro titular de banca de Tese de Doutorado. Serão pontuadas as participações comprovadas por declaração fornecida pelo Coordenador de Curso de Pós-graduação.');
--76
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (5,80,34,'Patente ou cultivar com pedido de registro comprovado (com titularidade ou co-titularidade da UFU).');
--77
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (5,150,35,'Patente ou cultivar transferida (com titularidade ou co-titularidade da UFU).');
--78
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (5,40,34,'Programa de computador com registro no INPI (com titularidade ou cotitularidade da UFU).');
--79
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (5,60,34,'Programa de computador transferido (com titularidade ou co-titularidade da UFU).');
--80
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (5,40,34,'Desenho industrial com registro no INPI (com titularidade ou co-titularidade da UFU).');
--81
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (5,60,34,'Desenho industrial transferido (com titularidade ou co-titularidade da UFU).');
--82
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (5,20,36,'Relatório final de pesquisa com financiamento externo ou interno. Os relatórios elaborados pelos discentes não deverão ser pontuados. Serão pontuados os relatórios comprovadamente submetidos e aprovados pelo órgão de fomento.');
--83
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (5,10,36,'Relatório final de pesquisa sem financiamento, com registro na PROPP. Os relatórios elaborados pelos discentes não deverão ser pontuados. Serão pontuados os relatórios comprovadamente submetidos e aprovados pela PROPP.');

--ATIVIDADES DE PESQUISA
--84
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (6,30,13,'Coordenação de projetos de ensino ou pesquisa com financiamento externo. Serão pontuadas as coordenações, comprovadas por documento de aprovação do projeto pelo órgão de fomento.');
--85
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (6,15,13,'Coordenação de projetos de ensino ou pesquisa com financiamento interno e registrado na PROPP.');
--86
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (6,10,13,'Coordenação de projetos de ensino ou pesquisa sem financiamento e registrado na PROPP.');
--87
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (6,5,13,'Membro de equipe de projetos de ensino ou pesquisa com financiamento externo ou interno. Serão pontuadas as participações comprovadas por declaração do Coordenador do projeto ou Diretor da Unidade Acadêmica ou por documento específico do órgão financiador.');
--88
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (6,3,13,'Membro de equipe de projetos de ensino ou pesquisa sem financiamento e registrado na PROPP. Serão pontuadas as participações comprovadas por declaração do Coordenador do projeto ou Diretor da Unidade Acadêmica.');

--ATIVIDADES DE EXTENSÃO E PRESTAÇÃO DE SERVIÇOS
--89
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (7,1,37,'Curso de extensão ministrado com aprovação do Conselho da Unidade e registrado na Pró-Reitoria de Extensão, Cultura e Assuntos Estudantis – PROEX, sem remuneração complementar.');
--90
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (7,0.5,37,'Consultoria, assessoria, perícia ou sindicância realizada e aprovada pela Unidade, sem remuneração complementar.');
--91
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (7,30,13,'Coordenação de projetos de extensão com financiamento externo e sem remuneração complementar. Serão pontuadas as coordenações com duração igual ou superior a seis meses, comprovadas por documento de aprovação do projeto pelo órgão de fomento.');
--92
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (7,15,13,'Coordenação de projetos de extensão com financiamento interno, registrado na PROEX e sem remuneração complementar. Serão pontuadas as coordenações com duração igual ou superior a três meses.');
--93
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (7,10,13,'Coordenação de projetos de extensão sem financiamento, registrado na PROEX e sem remuneração complementar. Serão pontuadas as coordenações com duração igual ou superior a três meses.');
--94
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (7,5,13,'Membro de equipe de projetos de extensão com financiamento externo ou interno e sem remuneração complementar. Serão pontuadas as participações comprovadas por declaração do Coordenador do projeto ou Diretor da Unidade Acadêmica.');
--95
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (7,3,15,'Membro de equipe de projetos de extensão sem financiamento, registrados na PROEX e sem remuneração complementar. Serão pontuadas as participações comprovadas por declaração do Coordenador do projeto ou Diretor da Unidade Acadêmica.');
--96
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (7,20,13,'Atuação na Assistência Judiciária. A atividade deverá ser autorizada pelo Conselho da Unidade, comprovada por declaração da Assistência Judiciária com o acordo do Diretor e deverá ter duração mínima de três meses.');

--LICENÇAS, SITUAÇÕES ESPECIAIS E QUALIFICAÇÃO ****
--97
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_pontuacaoreferencia, tipo_multiplicador, tipo_descricao) VALUES (8,0,0.005,38,'Licenças de concessão obrigatória (prêmio, gestante, saúde e outras) ou capacitação. A comprovação da licença será feita por declaração dos órgãos competentes da UFU.');
--98
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_pontuacaoreferencia, tipo_multiplicador, tipo_descricao) VALUES (8,0,0.005,39,'Readaptação funcional. A comprovação será feita por declaração dos órgãos competentes da UFU.');
--99
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_pontuacaoreferencia, tipo_multiplicador, tipo_descricao) VALUES (8,0,0.005,38,'Situação especial para o docente servidor cedido para exercício de cargo de natureza especial; DAS 6, 5 ou 4, ou cargo equivalente na Administração Pública. A comprovação da situação especial será feita por declaração dos órgãos competentes da UFU.');
--100
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_pontuacaoreferencia, tipo_multiplicador, tipo_descricao) VALUES (8,0,1,40,'Afastamento integral para cursar pós-graduação em nível de Mestrado, Doutorado e Pós-doutorado, aprovado pelo Conselho da Unidade e comprovado por ata da reunião que concedeu o afastamento ou declaração do Diretor e relatório aprovado pelo Conselho da Unidade.');
--101
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_pontuacaoreferencia, tipo_multiplicador, tipo_descricao) VALUES (8,0,0.5,41,'Afastamento parcial para cursar pós-graduação em nível de Mestrado, Doutorado e Pós-doutorado. Aprovado pela Unidade e comprovado por ata da reunião que concedeu o afastamento ou declaração do Diretor e relatório aprovado pelo Conselho da Unidade.');
--102
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_pontuacaoreferencia, tipo_multiplicador, tipo_descricao) VALUES (8,0,0.005,38,'Afastamento temporário, inferior a 120 dias, para estágio técnico, aperfeiçoamento ou missão de trabalho. Aprovado pela Unidade e comprovado por ata da reunião que concedeu o afastamento ou declaração do Diretor e relatório aprovado pelo Conselho da Unidade.');

--ATIVIDADES ADMINISTRATIVAS E REPRESENTAÇÕES
--103
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_pontuacaoreferencia, tipo_multiplicador, tipo_descricao) VALUES (9,0,1,42,'Reitor. Serão pontuadas as atividades administrativas com duração superior a três meses, comprovadas por documento de homologação do cargo.');
--104
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_pontuacaoreferencia, tipo_multiplicador, tipo_descricao) VALUES (9,0,1,42,'Vice-Reitor. Serão pontuadas as atividades administrativas com duração superior a três meses, comprovadas por documento de homologação do cargo.');
--105
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_pontuacaoreferencia, tipo_multiplicador, tipo_descricao) VALUES (9,0,0.7,43,'Pró-Reitor. Serão pontuadas as atividades administrativas com duração superior a três meses, comprovadas por documento de homologação do cargo.');
--106
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_pontuacaoreferencia, tipo_multiplicador, tipo_descricao) VALUES (9,0,0.7,43,'Diretor de Unidade. Serão pontuadas as atividades administrativas com duração superior a três meses, comprovadas por documento de homologação do cargo.');
--107
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_pontuacaoreferencia, tipo_multiplicador, tipo_descricao) VALUES (9,0,0.5,44,'Coordenador ou Chefe de Departamento que recebe função gratificada. Serão pontuadas as atividades administrativas com duração superior a três meses, comprovadas por documento de homologação do cargo.');
--108
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_pontuacaoreferencia, tipo_multiplicador, tipo_descricao) VALUES (9,0,0.7,43,'Coordenador de Curso de Graduação ou de Curso de Pós-graduação stricto sensu ou da Educação Profissional. Serão pontuadas as atividades administrativas com duração superior a três meses, comprovadas por documento de homologação do cargo.');
--109
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_pontuacaoreferencia, tipo_multiplicador, tipo_descricao) VALUES (9,0,0.4,45,'Coordenação de Curso de Pós-graduação lato sensu, sem remuneração complementar. A atividade será pontuada se devidamente comprovada por declaração do Diretor ou ata da reunião do Conselho da Unidade. Serão pontuadas as atividades com duração mínima de três meses.');
--110
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_pontuacaoreferencia, tipo_multiplicador, tipo_descricao) VALUES (9,0,0.6,46,'Coordenação pedagógica de áreas de conhecimento de Unidade Especial de Ensino. Serão pontuadas as atividades com duração superior a três meses e comprovadas por Portaria do Reitor.');
--111
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_pontuacaoreferencia, tipo_multiplicador, tipo_descricao) VALUES (9,0,0.5,44,'Diretor de Comunicação Social. Serão pontuadas as atividades administrativas com duração superior a três meses, comprovadas por documento de homologação do cargo.');
--112
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_pontuacaoreferencia, tipo_multiplicador, tipo_descricao) VALUES (9,0,0.5,44,'Chefe de Gabinete do Reitor. Serão pontuadas as atividades administrativas com duração superior a três meses, comprovadas por documento de homologação do cargo.');
--113
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_pontuacaoreferencia, tipo_multiplicador, tipo_descricao) VALUES (9,0,0.7,43,'Diretor Executivo das Fundações Universitárias. Serão pontuadas as atividades administrativas com duração superior a três meses, comprovadas por documento de homologação do cargo.');
--114
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_pontuacaoreferencia, tipo_multiplicador, tipo_descricao) VALUES (9,0,0.7,43,'Diretor de Hospital de Clínicas ou de Hospital Veterinário ou de Hospital Odontológico. Serão pontuadas as atividades administrativas com duração superior a três meses, comprovadas por documento de homologação do cargo.');
--115
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_pontuacaoreferencia, tipo_multiplicador, tipo_descricao) VALUES (9,0,0.5,44,'Diretor de Pró-Reitoria. Serão pontuadas as atividades administrativas com duração superior a três meses, comprovadas por documento de homologação do cargo.');
--116
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_pontuacaoreferencia, tipo_multiplicador, tipo_descricao) VALUES (9,0,0.5,44,'Assessor (CD, FG1, FG2). Serão pontuadas as atividades administrativas com duração superior a três meses, comprovadas por documento de homologação do cargo.');
--117
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_pontuacaoreferencia, tipo_multiplicador, tipo_descricao) VALUES (9,0,0.6,46,'Assessor de Unidade Especial de Ensino (CD, FG1, FG2). Serão pontuadas as atividades administrativas com duração superior a três meses, comprovadas por documento de homologação do cargo.');

--OUTRAS ATIVIDADES
--118
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (10,10,13,'Membro de diretoria de órgãos de classe, de organizações de fomento e de organizações não governamentais de expressão reconhecida, desde que esteja relacionado à sua atividade profissional e cuja participação seja aprovada pelo Conselho da Unidade. Serão pontuadas as participações com duração mínima de três meses, comprovadas por ata da reunião de aprovação no Conselho da Unidade.');
--119
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (10,5,13,'Representante oficial da Unidade junto à Biblioteca, em efetivo exercício. Serão pontuadas as atividades de representação com duração mínima de três meses, comprovadas por documento de homologação da representação ou por declaração da Biblioteca.');
--120
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (10,10,32,'Participação como curador de exposições artísticas locais e regionais. Serão pontuadas as participações devidamente aprovadas pela Unidade e comprovadas pela organização do evento.');
--121
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (10,20,32,'Participação como curador de exposições artísticas nacionais. Serão pontuadas as participações devidamente aprovadas pela Unidade e comprovadas pela organização do evento.');
--122
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (10,30,32,'Participação como curador de exposições artísticas internacionais. Serão pontuadas as participações devidamente aprovadas pela Unidade e comprovadas pela organização do evento.');
--123
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (10,10,32,'Participação, em evento de nível local ou regional, como chefe de delegação, membro de comissões técnicas e membro de comissões de avaliações e classificação de equipes esportivas. Serão pontuadas as participações devidamente aprovadas pela Unidade e comprovadas por documento oficial da instituição promotora e participante do Sistema Nacional de Esporte.');
--124
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (10,20,32,'Participação, em evento de nível nacional, como chefe de delegação, membro de comissões técnicas e membro de comissões de avaliações e classificação de equipes esportivas. Serão pontuadas as participações devidamente aprovadas pela Unidade e comprovadas por documento oficial da instituição promotora e participante do Sistema Nacional de Esporte.');
--125
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (10,30,32,'Participação, em evento de nível internacional, como chefe de delegação, membro de comissões técnicas e membro de comissões de avaliações e classificação de equipes esportivas. Serão pontuadas as participações devidamente aprovadas pela Unidade e comprovadas por documento oficial da instituição promotora e participante do Sistema Nacional de Esporte.');
--126
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (10,20,32,'Banca de Concursos Públicos. A atividade de membro efetivo será comprovada por documentação emitida pelo Diretor da Unidade ou pela Instituição Pública.');
--127
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (10,10,32,'Banca de Processos Seletivos. Serão pontuadas as participações em processos seletivos de docentes com contrato temporário de trabalho de Universidades, de funcionários de Fundações Universitárias Públicas. A atividade será comprovada por documentação emitida pelo Diretor da Unidade ou pela Instituição Pública.');
--128
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (10,5,32,'Banca de Processos Seletivos de alunos para pós-graduação stricto sensu e de alunos transferidos de outras instituições para a UFU. A atividade será comprovada por documentação emitida pelo Diretor da Unidade ou pela Instituição Pública.');
--129
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (10,10,47,'Coordenação de laboratórios, Núcleos de Pesquisa, da Clínica Psicológica, da Clínica Odontológica, do Setor de Prática Desportiva e do Setor de Oficina Mecânica. Serão pontuadas as coordenações oficializadas por Ordem de Serviço ou Portaria do Diretor da Unidade, com duração superior a três meses.');
--130
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (10,30,48,'Coordenação de Estágio Supervisionado, de atividade prática curricular profissionalizante e/ou Prática de Ensino e Coordenação geral de Internato. Serão pontuadas as atividades com duração superior a três meses, nomeadas pelo Diretor da Unidade. (Somente um docente por Curso)');
--131
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (10,30,13,'Tutoria do PET.');
--132
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (10,5,49,'Conclusão de curso de aperfeiçoamento. Serão pontuados os Cursos com o mínimo de 180 horas, comprovado por declaração do Coordenador do Curso de Aperfeiçoamento.');
--133
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (10,5,13,'Horário de atendimento semanal às famílias de alunos da Educação Básica. Serão pontuados os docentes que comprovarem a presença em pelo menos 75% dos dias previstos no semestre, por meio de lista de presença organizada pela Direção da Escola e acompanhada pelas Áreas de Ensino, comprovadas por declaração do Diretor.');
--134
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (10,2,32,'Participação em Conselhos de Avaliação Discente (Conselho de Classe) das Unidades Especiais de Ensino, comprovada por meio de Declaração da Direção da U.E.E.');
--135
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (10,20,13,'Gerente. Serão pontuadas as atividades administrativas com duração superior a três meses e comprovadas por documentos de homologação do cargo.');
--136
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (10,15,13,'Chefe de setor e de serviço médico-odontológico. Serão pontuadas as atividades administrativas com duração superior a três meses e comprovadas por documentos de homologação do cargo.');
--137
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (10,20,13,'Coordenação de órgão complementar. Serão pontuadas as atividades administrativas com duração superior a três meses e comprovadas por documentos de nomeação para o cargo.');
--138
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (10,40,13,'Coordenação da Residência Médica. Serão pontuadas as atividades administrativas com duração superior a três meses e comprovadas por documentos de homologação do cargo.');
--139
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (10,20,13,'Coordenação de Programa de Educação Continuada. Serão pontuadas as atividades administrativas com duração superior a três meses e comprovadas por documentos de homologação do cargo.');
--140
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (10,5,50,'Coordenador de Projeto de Intercâmbio Internacional, nomeado por Portaria. Serão pontuadas as atividades administrativas com duração superior a três meses e comprovadas por documentos de homologação do cargo.');
--141
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (10,10,51,'Membro de Comissão Permanente da UFU. Serão pontuadas as atividades administrativas nomeadas pelo Reitor, com duração superior a três meses.');
--142
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (10,10,51,'Membro de comissões de ética, de infecção hospitalar, de residência médica (COREME) e padronização de medicamentos permanente da UFU. Serão pontuadas as atividades administrativas com duração superior a três meses.');
--143
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (10,5,13,'Representante de Unidade Acadêmica ou de Unidade Especial de Ensino em Associação Docente (ADUFU). Serão pontuadas as atividades de representação com duração superior a três meses e comprovadas por Portaria de nomeação do Diretor da Unidade.');
--144
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (10,10,52,'Membro de comissões externas à Unidade, nomeadas pela Administração Superior da UFU ou por órgãos da administração pública. Serão consideradas as comissões nomeadas por Portarias das Pró-Reitorias, Reitoria e da administração pública.');
--145
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (10,10,52,'Membro de comitê assessor de agência de fomento. Serão pontuadas as participações comprovadas por documento de nomeação ou declaração da presidência do comitê.');
--146
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (10,10,53,'Coordenação de estruturas criadas na Unidade, de acordo com o Regimento Interno da mesma. Serão pontuadas as atividades com duração superior a três meses e comprovadas por documento de homologação do cargo ou declaração do Diretor da Unidade. Serão limitadas as participações em até três cargos por semestre.');
--147
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (10,5,54,'Membro de Conselhos na UFU. Serão pontuadas as atividades com duração superior a três meses, comprovadas por documento de homologação do cargo ou por declaração do Diretor. A participação como membro de Conselho com cargos de CD ou FG não deve ser pontuada neste item.');
--148
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (10,5,13,'Membro de Comissão Permanente da Unidade. Serão consideradas as comissões nomeadas pelo Diretor da Unidade e comprovadas por Portaria. Serão pontuadas as atividades com duração superior a três meses, comprovadas por documento de nomeação da comissão pelo Diretor da Unidade.');
--149
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (10,5,13,'Membro de Colegiado das Unidades Especiais de Ensino, de Curso de Graduação ou de Programa de Pós-graduação. Serão pontuadas as atividades administrativas com duração superior a três meses, comprovadas por documento de homologação do cargo ou por declaração do Diretor da Unidade.');
--150
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (10,10,55,'Presidente, em efetivo exercício, de diretoria de associação científica relacionada à sua área profissional. A pontuação deve ser comprovada por documento de homologação do cargo.');
--151
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (10,5,32,'Membro, em efetivo exercício, de diretoria de associação científica relacionada à sua área profissional. A pontuação deve ser comprovada por documento de homologação do cargo.');
--152
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (10,2,51,'Membro de comissões internas da Unidade Acadêmica. O docente poderá pontuar sua participação em até quatro comissões por semestre, oficializadas por Ordem de Serviço ou Portaria.');
--153
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_pontuacaoreferencia, tipo_multiplicador, tipo_descricao) VALUES (10,0,0.0055,56,'Substituições de docentes com cargo de direção, comprovadas por Portaria.');

-- ATIVIDADES DE ENSINO REMUNERADAS

--154
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (1,10,57,'Aula teórica ou prática de disciplinas ministradas em cursos de pós-graduação lato sensu da UFU, com remuneração complementar, aprovadas pelo Conselho da Unidade.');
--155
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (1,1,58,'Aula prática de cursos de pós-graduação lato sensu, com remuneração suplementar, para turmas com mais de 8 alunos, equivalente à turma padrão para este item.');

-- ATIVIDADES DE EXTENSÃO E PRESTAÇÃO DE SERVIÇOS REMUNERADAS
--156
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (7,1,59,'Curso de extensão ministrado com aprovação do Conselho da Unidade e registrado na PROEX, com remuneração complementar.');
--157
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (7,0.5,60,'Consultoria, assessoria, perícia ou sindicância realizadas e aprovadas pela Unidade, com remuneração complementar.');
--158
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (7,15,13,'Coordenação de Curso de Pós-graduação lato sensu, com remuneração complementar. A atividade será pontuada se devidamente comprovada por declaração do Diretor ou ata da reunião do Conselho da Unidade. Serão pontuadas as atividades com duração mínima de três meses.');
--159
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (7,30,13,'Coordenação de projetos de extensão com financiamento externo e com remuneração complementar. Serão pontuadas as coordenações com duração igual ou superior a seis meses, comprovadas por documento de aprovação do projeto pelo órgão de fomento.');
--160
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (7,15,13,'Coordenação de projetos de extensão com financiamento interno e registrado na PROEX e com remuneração complementar. Serão pontuadas as coordenações com duração igual ou superior a três meses.');
--161
INSERT INTO tipo (tipo_categoria, tipo_pontuacao, tipo_multiplicador, tipo_descricao) VALUES (7,5,13,'Membro de equipe de projetos de extensão com financiamento externo ou interno e com remuneração complementar. Serão pontuadas as participações comprovadas por declaração do Coordenador do projeto ou Diretor da Unidade Acadêmica.');