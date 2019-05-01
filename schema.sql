drop table Camara cascade;
drop table Video cascade;
drop table SegmentoVideo cascade;
drop table Local cascade;
drop table Vigia cascade;
drop table EventoEmergencia cascade;
drop table ProcessoSocorro cascade;
drop table EntidadeMeio cascade;
drop table Meio cascade;
drop table MeioCombate cascade;
drop table MeioApoio cascade;
drop table MeioSocorro cascade;
drop table Transporta cascade;
drop table Alocado cascade;
drop table Acciona cascade;
drop table Coordenador cascade;
drop table Audita cascade;
drop table Solicita cascade;
drop trigger chk_aloc on Alocado;
drop trigger chk_sol on Solicita;
drop index i1;
drop index i2;
drop index i3;
DROP TABLE IF EXISTS fact;
DROP TABLE IF EXISTS d_evento;
DROP TABLE IF EXISTS d_meio;
DROP TABLE IF EXISTS d_tempo;


create table Camara(
	numCamara integer,
	primary key(numCamara)
);

create table Video(
	dataHoraInicio timestamp,
	dataHoraFim timestamp not null,
	numCamara integer,
	primary key(dataHoraInicio, numCamara),
	foreign key(numCamara)
		references Camara(numCamara) ON DELETE CASCADE ON UPDATE CASCADE
);

create table SegmentoVideo(
	numSegmento integer,
	duracao interval not null,
	dataHoraInicio timestamp,
	numCamara integer,
	primary key(numSegmento, dataHoraInicio, numCamara),
	foreign key(dataHoraInicio, numCamara)
		references Video(dataHoraInicio, numCamara) ON DELETE CASCADE ON UPDATE CASCADE
);

create table Local(
	moradaLocal varchar(255),
	primary key(moradaLocal)
);

create table Vigia(
	moradaLocal varchar(255),
	numCamara integer,
	primary key(moradaLocal, numCamara),
	foreign key(moradaLocal)
		references Local(moradaLocal) ON DELETE CASCADE ON UPDATE CASCADE,
	foreign key (numCamara)
		references Camara(numCamara) ON DELETE CASCADE ON UPDATE CASCADE
);


create table ProcessoSocorro(
	numProcessoSocorro integer,
	primary key(numProcessoSocorro)
);

create table EventoEmergencia(
	numTelefone varchar(15),
	instanteChamada timestamp,
	nomePessoa varchar(80) not null,
	moradaLocal varchar(255) not null,
	numProcessoSocorro integer not null,
	primary key(numTelefone, instanteChamada),
	unique(numTelefone, nomePessoa),
	foreign key(moradaLocal)
		references Local(moradaLocal) ON DELETE CASCADE ON UPDATE CASCADE,
	foreign Key(numProcessoSocorro)
		references ProcessoSocorro(numProcessoSocorro) ON DELETE CASCADE ON UPDATE CASCADE
);

create table EntidadeMeio(
	nomeEntidade varchar(200),
	primary key(nomeEntidade)
);

create table Meio(
	numMeio integer,
	nomeMeio varchar(200),
	nomeEntidade varchar(200),
	primary key(numMeio, nomeEntidade),
	foreign key (nomeEntidade)
		references EntidadeMeio(nomeEntidade) ON DELETE CASCADE ON UPDATE CASCADE
);

create table MeioCombate(
	numMeio integer,
	nomeEntidade varchar(200),
	primary key(numMeio, nomeEntidade),
	foreign key (numMeio, nomeEntidade)
		references Meio(numMeio, nomeEntidade) ON DELETE CASCADE ON UPDATE CASCADE
);

create table MeioApoio(
	numMeio integer,
	nomeEntidade varchar(200),
	primary key(numMeio, nomeEntidade),
	foreign key (numMeio, nomeEntidade)
		references Meio(numMeio, nomeEntidade) ON DELETE CASCADE ON UPDATE CASCADE
);

create table MeioSocorro(
	numMeio integer,
	nomeEntidade varchar(200),
	primary key(numMeio, nomeEntidade),
	foreign key (numMeio, nomeEntidade)
		references Meio(numMeio, nomeEntidade) ON DELETE CASCADE ON UPDATE CASCADE
);

create table Transporta(
	numMeio integer,
	nomeEntidade varchar(200),
	numVitimas integer not null,
	numProcessoSocorro integer,
	primary key(numMeio, nomeEntidade, numProcessoSocorro),
	foreign key (numMeio, nomeEntidade)
		references MeioSocorro(numMeio, nomeEntidade) ON DELETE CASCADE ON UPDATE CASCADE,
	foreign Key(numProcessoSocorro)
		references ProcessoSocorro(numProcessoSocorro) ON DELETE CASCADE ON UPDATE CASCADE
);

create table Alocado(
	numMeio integer,
	nomeEntidade varchar(200),
	numVitimas integer not null,
	numProcessoSocorro integer,
	primary key(numMeio, nomeEntidade, numProcessoSocorro),
	foreign key (numMeio, nomeEntidade)
		references MeioApoio(numMeio, nomeEntidade) ON DELETE CASCADE ON UPDATE CASCADE,
	foreign Key(numProcessoSocorro)
		references ProcessoSocorro(numProcessoSocorro) ON DELETE CASCADE ON UPDATE CASCADE
);

create table Acciona(
	numMeio integer,
	nomeEntidade varchar(200),
	numProcessoSocorro integer,
	primary key(numMeio, nomeEntidade, numProcessoSocorro),
	foreign key (numMeio, nomeEntidade)
		references Meio(numMeio, nomeEntidade) ON DELETE CASCADE ON UPDATE CASCADE,
	foreign Key(numProcessoSocorro)
		references ProcessoSocorro(numProcessoSocorro) ON DELETE CASCADE ON UPDATE CASCADE
);

create table Coordenador(
	idCoordenador integer,
	primary key(idCoordenador)
);

create table Audita(
	idCoordenador integer,
	numMeio integer,
	nomeEntidade varchar(200),
	numProcessoSocorro integer,
	datahoraInicio timestamp not null,
	datahoraFim timestamp not null,
	dataAuditoria timestamp not null,
	texto varchar(200) not null,
	primary key(numMeio, nomeEntidade, numProcessoSocorro, idCoordenador),
	foreign key(numMeio, nomeEntidade, numProcessoSocorro)
		references Acciona(numMeio, nomeEntidade, numProcessoSocorro) ON DELETE CASCADE ON UPDATE CASCADE,
	foreign key(idCoordenador)
		references Coordenador(idCoordenador) ON DELETE CASCADE ON UPDATE CASCADE,
	check(datahoraInicio < datahoraFim),
	check(dataAuditoria <= clock_timestamp())
);

create table Solicita(
	idCoordenador integer,
	dataHoraInicioVideo timestamp,
	numCamara integer,
	dataHoraInicio timestamp not null,
	dataHoraFim timestamp not null,
	primary key(idCoordenador, dataHoraInicioVideo, numCamara),
	foreign key(idCoordenador)
		references Coordenador(idCoordenador) ON DELETE CASCADE ON UPDATE CASCADE,
	foreign key(dataHoraInicioVideo, numCamara)
		references Video(dataHoraInicio, numCamara) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE OR REPLACE FUNCTION chk_aloc()
	RETURNS TRIGGER AS $BODY$
	BEGIN
		IF (NEW.numMeio, NEW.numProcessoSocorro) NOT IN (
			SELECT numMeio, numProcessoSocorro
			FROM Acciona
			WHERE NEW.numMeio = numMeio AND NEW.numProcessoSocorro= numProcessoSocorro
			) THEN RAISE EXCEPTION 'MeioApoio alocado nao foi accionado';
		END IF;

	RETURN NEW;
	END;
$BODY$ LANGUAGE plpgsql;
CREATE TRIGGER chk_aloc BEFORE INSERT OR UPDATE ON Alocado
FOR EACH ROW EXECUTE PROCEDURE chk_aloc();

CREATE OR REPLACE FUNCTION chk_sol()
	RETURNS TRIGGER AS $BODY$
	BEGIN
		IF (NEW.idCoordenador, NEW.numCamara, NEW.dataHoraInicioVideo) NOT IN (
			SELECT t.idCoordenador, t.numCamara, t.dataHoraInicio
			FROM(
				SELECT ad.idCoordenador, v.numCamara, vd.dataHoraInicio
				FROM EventoEmergencia e
				INNER JOIN Acciona a ON a.numProcessoSocorro = e.numProcessoSocorro
				INNER JOIN Audita ad ON ad.numMeio = a.numMeio AND ad.nomeEntidade=a.nomeEntidade AND ad.numProcessoSocorro=a.numProcessoSocorro AND ad.numProcessoSocorro=e.numProcessoSocorro
				INNER JOIN Vigia v ON v.moradaLocal=e.moradaLocal
				INNER JOIN Video vd ON vd.numCamara = v.numCamara) AS t
			WHERE NEW.idCoordenador = t.idCoordenador AND NEW.numCamara= t.numCamara AND NEW.dataHoraInicioVideo = t.dataHoraInicio
			) THEN RAISE EXCEPTION 'Impossivel solicitar o video pretendido';
		END IF;

	RETURN NEW;
	END;
$BODY$ LANGUAGE plpgsql;
CREATE TRIGGER chk_sol BEFORE INSERT OR UPDATE ON Solicita
FOR EACH ROW EXECUTE PROCEDURE chk_sol();

ALTER TABLE Vigia DROP CONSTRAINT vigia_pkey CASCADE;
ALTER TABLE Video DROP CONSTRAINT video_pkey CASCADE;
ALTER TABLE EventoEmergencia DROP CONSTRAINT eventoemergencia_pkey CASCADE;
CREATE INDEX i1 ON Vigia USING BTREE(moradaLocal);
CREATE INDEX i2 ON Video USING BTREE(numCamara);
CREATE INDEX i3 ON EventoEmergencia USING BTREE(numTelefone, instanteChamada);

CREATE TABLE d_tempo( 
	tempo_id SERIAL,
	dia INTEGER NOT NULL,
	mes INTEGER NOT NULL,
	ano INTEGER NOT NULL,
	PRIMARY KEY(tempo_id));

CREATE TABLE d_meio(
	idMeio SERIAL,
	numMeio INTEGER NOT NULL,
	nomeMeio VARCHAR(200),
	nomeEntidade VARCHAR(200) NOT NULL,
	tipo VARCHAR(200) NOT NULL,
	PRIMARY KEY(idMeio));

CREATE TABLE d_evento(
	idEvento SERIAL,
	numTelefone VARCHAR(15) NOT NULL,
	instanteChamada TIMESTAMP NOT NULL,
	PRIMARY KEY(idEvento));

CREATE TABLE fact(
	fact_id SERIAL,
	tempo_id INTEGER NOT NULL,
	idMeio INTEGER NOT NULL,
	idEvento INTEGER NOT NULL,
	PRIMARY KEY(fact_id),
	FOREIGN KEY(tempo_id) REFERENCES d_tempo(tempo_id),
	FOREIGN KEY(idMeio) REFERENCES d_meio(idMeio),
	FOREIGN KEY(idEvento) REFERENCES d_evento(idEvento));