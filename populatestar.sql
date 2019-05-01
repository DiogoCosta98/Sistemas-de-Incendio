INSERT INTO d_tempo(dia, mes, ano)
SELECT DISTINCT
date_part('day',instanteChamada) AS dia,
date_part('month',instanteChamada)AS mes,
date_part('year',instanteChamada) AS ano
FROM EventoEmergencia;

INSERT INTO d_meio(numMeio, nomeMeio, nomeEntidade, tipo)
SELECT numMeio, nomeMeio,nomeEntidade, 'Meio de Apoio'
FROM MeioApoio NATURAL JOIN Meio;

INSERT INTO d_meio(numMeio, nomeMeio, nomeEntidade, tipo)
SELECT numMeio, nomeMeio,nomeEntidade, 'Meio de Combate'
FROM MeioCombate NATURAL JOIN Meio;

INSERT INTO d_meio(numMeio, nomeMeio, nomeEntidade, tipo)
SELECT numMeio, nomeMeio,nomeEntidade, 'Meio de Socorro'
FROM MeioSocorro NATURAL JOIN Meio;

INSERT INTO d_evento(numTelefone, instanteChamada)
SELECT numTelefone, instanteChamada
FROM EventoEmergencia;

INSERT INTO fact(tempo_id, idMeio, idEvento)
SELECT tempo_id, idMeio, idEvento
FROM(
	SELECT *
	FROM Acciona
	INNER JOIN EventoEmergencia ON Acciona.numProcessoSocorro=EventoEmergencia.numProcessoSocorro) AS t
LEFT JOIN d_evento ON t.numTelefone=d_evento.numTelefone AND t.instanteChamada=d_evento.instanteChamada
LEFT JOIN d_meio ON t.numMeio=d_meio.numMeio AND t.nomeEntidade=d_meio.nomeEntidade 
LEFT JOIN d_tempo ON date_part('day',t.instanteChamada) = d_tempo.dia AND date_part('month',t.instanteChamada) = d_tempo.mes AND date_part('year',t.instanteChamada) = d_tempo.ano;