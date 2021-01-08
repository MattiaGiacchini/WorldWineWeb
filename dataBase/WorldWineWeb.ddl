-- *********************************************
-- * SQL MySQL generation
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.1
-- * Generator date: Dec  4 2018
-- * Generation date: Wed Jan  6 23:21:35 2021
-- * LUN file: C:\Users\magia\Documents\UNIVERSITA\3_ANNO\TecnologieWEB\Elaborato\worldwineweb\dataBase\WorldWineWeb.lun
-- * Schema: SchemaConcettuale_auto/10-1
-- *********************************************


-- Database Section
-- ________________

create database worldwineweb;
use worldwineweb;


-- Tables Section
-- _____________

create table CANTINA (
     idCantina int not null auto_increment,
     nome varchar(50) not null,
     stato char(3) not null,
     constraint ID_ID primary key (idCantina));

create table CARRELLO (
     idContenitore int not null,
     idEtichetta int not null,
     idCliente -- Compound attribute -- not null,
     quantita int not null,
     constraint IDCARRELLO primary key (idCliente -- Compound attribute --, idContenitore, idEtichetta));

create table CATEGORIA_NOTIFICA (
     nome date not null,
     constraint IDCATEGORIA primary key (nome));

create table UTENTE (
     idUtente -- Compound attribute -- not null,
     email varchar(100) not null,
     password char(20) not null,
     cf char(16),
     nome char(20),
     cognome char(20),
     dataDiNascita date,
     partitaIva bigint,
     ragioneSociale char(100),
     ruolo char(3) not null,
     constraint ID primary key (idUtente -- Compound attribute --),
     constraint IDCLIENTE unique (email),
     constraint IDCLIENTE_1 unique (cf),
     constraint IDCLIENTE_2 unique (partitaIva));

create table CONTENITORE (
     idContenitore int not null auto_increment,
     capacita decimal(7,4) not null,
     tipologia char(20) not null,
     constraint ID primary key (idContenitore));

create table ETICHETTA (
     idEtichetta int not null auto_increment,
     nome varchar(50) not null,
     descrizione varchar(500) not null,
     colore char(10) not null,
     titoloAlcolico decimal(4,2) not null,
     solfiti char not null,
     bio char not null,
     idCantina int not null,
     categoria char(1) not null,
     classificazione char(4) not null,
     tenoreZuccherino char(1) not null,
     gas char,
     annata date,
     indicazioneGeografica char(50),
     specificazione char(15),
     idVitigno char(20),
     idMenzione char(50),
     constraint ID primary key (idEtichetta));

create table FATTURA (
     idFattura int not null auto_increment,
     data date not null,
     constraint IDFATTURA_ID primary key (idFattura, data));

create table INDIRIZZO (
     idIndirizzo int not null auto_increment,
     idCliente -- Compound attribute -- not null,
     nome char(50) not null,
     via varchar(100) not null,
     civico int not null,
     citta varchar(80) not null,
     provincia varchar(80) not null,
     cap int not null,
     stato char(3) not null,
     constraint ID primary key (idIndirizzo),
     constraint IDINDIRIZZO unique (idCliente -- Compound attribute --, idIndirizzo));

create table MENZIONE (
     menzione char(50) not null,
     constraint IDMENZIONE primary key (menzione));

create table METODO_DI_PAGAMENTO (
     intestatario char(50) not null,
     numeroCarta bigint not null,
     idCliente -- Compound attribute -- not null,
     scadenza date not null,
     cvv int not null,
     tipologiaCarta varchar(20) not null,
     constraint IDMETODO_DI_PAGAMENTO primary key (numeroCarta),
     constraint IDMETODO_DI_PAGAMENTO_1 unique (idCliente -- Compound attribute --, numeroCarta));

create table DETTAGLIO_ORDINE (
     idCliente -- Compound attribute -- not null,
     idOrdine int not null,
     idContenitore int not null,
     idEtichetta int not null,
     quantita int not null,
     constraint IDDETTAGLIO primary key (idContenitore, idEtichetta, idCliente -- Compound attribute --, idOrdine));

create table GESTIONE_ORDINE (
     idCliente -- Compound attribute -- not null,
     idOrdine int not null,
     idCollaboratore -- Compound attribute -- not null,
     data date not null,
     stato char(20) not null,
     note varchar(500),
     constraint IDCOMANDA primary key (idCliente -- Compound attribute --, idOrdine, idCollaboratore -- Compound attribute --, data));

create table MODIFICA_SCORTE (
     idContenitore int not null,
     idEtichetta int not null,
     idCollaboratore -- Compound attribute -- not null,
     quantita int not null,
     data date not null,
     constraint IDMODIFICA_SCORTE primary key (idContenitore, idEtichetta, idCollaboratore -- Compound attribute --, data));

create table NOTIFICA (
     idNotifica int not null auto_increment,
     idCliente -- Compound attribute -- not null,
     data date not null,
     messaggio varchar(500) not null,
     visualizzato char not null,
     categoria date not null,
     constraint ID primary key (idNotifica),
     constraint IDNOTIFICA unique (idCliente -- Compound attribute --, idNotifica));

create table ORDINE (
     idCliente -- Compound attribute -- not null,
     idOrdine int not null auto_increment,
     idFattura int,
     dataFattura date,
     data date not null,
     statoDiAvanzamento char(20) not null,
     pagamento.intestatario char(50) not null,
     pagamento.numeroCarta bigint not null,
     pagamento.scadenza date not null,
     pagamento.cvv int not null,
     pagamento.tipologiaCarta varchar(20) not null,
     spedizione.nome char(50) not null,
     spedizione.via varchar(100) not null,
     spedizione.civico int not null,
     spedizione.citta varchar(80) not null,
     spedizione.provincia varchar(80) not null,
     spedizione.cap int not null,
     constraint IDORDINE primary key (idCliente -- Compound attribute --, idOrdine),
     constraint FKRICHIESTA_ID unique (idFattura, dataFattura));

create table PREFERENZA (
     idContenitore int not null,
     idEtichetta int not null,
     idCliente -- Compound attribute -- not null,
     constraint IDPREFERENZA primary key (idCliente -- Compound attribute --, idContenitore, idEtichetta));

create table PREZZO (
     idContenitore int not null,
     idEtichetta int not null,
     data date not null,
     prezzo decimal(8,2) not null,
     iva decimal(4,2) not null,
     constraint IDPREZZO primary key (idContenitore, idEtichetta, data));

create table RECENSIONE (
     idContenitore int not null,
     idEtichetta int not null,
     idCliente -- Compound attribute -- not null,
     titolo varchar(100) not null,
     valutazione int not null,
     testo varchar(500) not null,
     constraint IDRECENSIONE primary key (idCliente -- Compound attribute --, idContenitore, idEtichetta));

create table STATO (
     sigla char(3) not null,
     nome char(50) not null,
     constraint IDSTATO primary key (sigla));

create table VINO_CONFEZIONATO (
     idEtichetta int not null,
     idContenitore int not null,
     scorteMazzino int not null,
     mediaRecensioni decimal(4,3) not null,
     constraint IDVINO_CONFEZIONATO primary key (idContenitore, idEtichetta));

create table VITIGNO (
     coloreBacca char(10) not null,
     nomeSpecie char(20) not null,
     constraint IDVITIGNO primary key (nomeSpecie));


-- Constraints Section
-- ___________________

-- Not implemented
-- alter table CANTINA add constraint ID_CHK
--     check(exists(select * from ETICHETTA
--                  where ETICHETTA.idCantina = idCantina));

alter table CANTINA add constraint FKORIGINE
     foreign key (stato)
     references STATO (sigla);

alter table CARRELLO add constraint FKCAR_UTE
     foreign key (idCliente -- Compound attribute --)
     references UTENTE (idUtente -- Compound attribute --);

alter table CARRELLO add constraint FKCAR_VIN
     foreign key (idContenitore, idEtichetta)
     references VINO_CONFEZIONATO (idContenitore, idEtichetta);

alter table ETICHETTA add constraint FKPRODUZIONE
     foreign key (idCantina)
     references CANTINA (idCantina);

alter table ETICHETTA add constraint FKESTRAZIONE
     foreign key (idVitigno)
     references VITIGNO (nomeSpecie);

alter table ETICHETTA add constraint FKSPECIFICA
     foreign key (idMenzione)
     references MENZIONE (menzione);

-- Not implemented
-- alter table FATTURA add constraint IDFATTURA_CHK
--     check(exists(select * from ORDINE
--                  where ORDINE.idFattura = idFattura and ORDINE.dataFattura = data));

alter table INDIRIZZO add constraint FKPOSIZIONE
     foreign key (stato)
     references STATO (sigla);

alter table INDIRIZZO add constraint FKSPEDIZIONE
     foreign key (idCliente -- Compound attribute --)
     references UTENTE (idUtente -- Compound attribute --);

alter table METODO_DI_PAGAMENTO add constraint FKPAGAMENTO
     foreign key (idCliente -- Compound attribute --)
     references UTENTE (idUtente -- Compound attribute --);

alter table DETTAGLIO_ORDINE add constraint FKidVino
     foreign key (idContenitore, idEtichetta)
     references VINO_CONFEZIONATO (idContenitore, idEtichetta);

alter table DETTAGLIO_ORDINE add constraint FKidOrdine
     foreign key (idCliente -- Compound attribute --, idOrdine)
     references ORDINE (idCliente -- Compound attribute --, idOrdine);

alter table GESTIONE_ORDINE add constraint FKCOM_UTE
     foreign key (idCollaboratore -- Compound attribute --)
     references UTENTE (idUtente -- Compound attribute --);

alter table GESTIONE_ORDINE add constraint FKCOM_ORD
     foreign key (idCliente -- Compound attribute --, idOrdine)
     references ORDINE (idCliente -- Compound attribute --, idOrdine);

alter table MODIFICA_SCORTE add constraint FKMOD_UTE
     foreign key (idCollaboratore -- Compound attribute --)
     references UTENTE (idUtente -- Compound attribute --);

alter table MODIFICA_SCORTE add constraint FKMOD_VIN
     foreign key (idContenitore, idEtichetta)
     references VINO_CONFEZIONATO (idContenitore, idEtichetta);

alter table NOTIFICA add constraint FKREFERENZA
     foreign key (categoria)
     references CATEGORIA_NOTIFICA (nome);

alter table NOTIFICA add constraint FKRICEZIONE
     foreign key (idCliente -- Compound attribute --)
     references UTENTE (idUtente -- Compound attribute --);

alter table ORDINE add constraint FKRICHIESTA_FK
     foreign key (idFattura, dataFattura)
     references FATTURA (idFattura, data);

alter table ORDINE add constraint FKRICHIESTA_CHK
     check((idFattura is not null and dataFattura is not null)
           or (idFattura is null and dataFattura is null));

alter table ORDINE add constraint FKEFFETTUAZIONE
     foreign key (idCliente -- Compound attribute --)
     references UTENTE (idUtente -- Compound attribute --);

alter table PREFERENZA add constraint FKPRE_UTE
     foreign key (idCliente -- Compound attribute --)
     references UTENTE (idUtente -- Compound attribute --);

alter table PREFERENZA add constraint FKPRE_VIN
     foreign key (idContenitore, idEtichetta)
     references VINO_CONFEZIONATO (idContenitore, idEtichetta);

alter table PREZZO add constraint FKVALUTAZIONE
     foreign key (idContenitore, idEtichetta)
     references VINO_CONFEZIONATO (idContenitore, idEtichetta);

alter table RECENSIONE add constraint FKREC_UTE
     foreign key (idCliente -- Compound attribute --)
     references UTENTE (idUtente -- Compound attribute --);

alter table RECENSIONE add constraint FKREC_VIN
     foreign key (idContenitore, idEtichetta)
     references VINO_CONFEZIONATO (idContenitore, idEtichetta);

alter table VINO_CONFEZIONATO add constraint FKRIF_CONTENITORE
     foreign key (idContenitore)
     references CONTENITORE (idContenitore);

alter table VINO_CONFEZIONATO add constraint FKRIF_ETICHETTA
     foreign key (idEtichetta)
     references ETICHETTA (idEtichetta);


-- Index Section
-- _____________
