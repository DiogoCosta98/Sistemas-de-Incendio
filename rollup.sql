SELECT tipo, ano, mes, COUNT (*)
FROM (fact NATURAL JOIN d_tempo NATURAL JOIN d_meio) AS a
WHERE a.idEvento = 15
GROUP BY tipo, ROLLUP(ano, mes);