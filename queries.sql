--1
SELECT numProcessoSocorro
FROM acciona
GROUP BY numProcessoSocorro
HAVING COUNT(DISTINCT numMeio)>=ALL(
	SELECT COUNT(DISTINCT numMeio)
	FROM acciona
	GROUP BY numProcessoSocorro
	)

--2
SELECT nomeEntidade
FROM acciona natural inner join EventoEmergencia
WHERE DATE(instanteChamada) >= '2018-06-21 00:00:00'
	AND DATE(instanteChamada) < '2018-09-24 00:00:00'
GROUP BY nomeEntidade
HAVING COUNT(DISTINCT numProcessoSocorro)>=ALL(
	SELECT COUNT(DISTINCT numProcessoSocorro)
	FROM acciona natural inner join EventoEmergencia
	WHERE DATE(instanteChamada) >= '2018-06-21 00:00:00'
		AND DATE(instanteChamada) < '2018-09-24 00:00:00'
	GROUP BY nomeEntidade
	)

--3 
SELECT DISTINCT numProcessoSocorro
FROM EventoEmergencia natural inner join Acciona
WHERE moradaLocal = 'Oliveira do Hospital'
	AND DATE(instanteChamada) >= '2018-01-01 00:00:00'
	AND DATE(instanteChamada) < '2019-01-01 00:00:00'
	AND numProcessoSocorro NOT IN(
		SELECT numProcessoSocorro FROM audita)

--4
SELECT COUNT(DISTINCT numSegmento)
FROM SegmentoVideo natural inner join Vigia
WHERE duracao > '60 seconds' AND moradaLocal = 'Monchique'
	AND DATE(dataHoraInicio) < '2018-09-01 00:00:00'
	AND DATE(dataHoraInicio) >= '2018-08-01 00:00:00'

--5
SELECT numMeio, nomeEntidade
FROM MeioCombate natural inner join acciona
WHERE (numMeio, nomeEntidade) NOT IN(
	SELECT numMeio, nomeEntidade
	FROM MeioApoio natural inner join alocado)

--6
SELECT nomeEntidade
FROM MeioCombate m
WHERE NOT EXISTS(
	SELECT numProcessoSocorro
	FROM acciona
	EXCEPT
	SELECT numProcessoSocorro
	FROM acciona a
	WHERE a.nomeEntidade = m.nomeEntidade
	);