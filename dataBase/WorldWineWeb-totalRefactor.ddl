-- *********************************************
-- * SQL MySQL generation
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.1
-- * Generator date: Dec  4 2018
-- * Generation date: Sat Jan  9 17:50:19 2021
-- * LUN file: C:\Users\Utente\Google Drive\00_UNVERSITA'\3°_anno_2020_2021\tecnologieWeb\progetto\worldwineweb\dataBase\WorldWineWeb.lun
-- * Schema: logic/logic-part2
-- *********************************************

-- Database Section
-- ________________
drop database if exists worldwineweb;

create database if not exists worldwineweb DEFAULT CHARACTER SET utf8;
use worldwineweb;


-- Tables Section
-- _____________

create table CANTINA (
     idCantina int not null auto_increment,
     nome varchar(50) not null,
     stato char(3) not null,
     constraint ID_ID primary key (idCantina),
     constraint FKCANTINA unique (nome, stato));

create table CARRELLO (
     idContenitore int not null,
     idEtichetta int not null,
     idCliente int not null,
     quantita int not null,
     constraint IDCARRELLO primary key (idCliente, idContenitore, idEtichetta));

create table CATEGORIA_NOTIFICA (
     idCategoria int not null auto_increment,
     nome char(20) not null,
     constraint ID_CATEGORIA primary key (idCategoria),
     constraint FK_CATEGORIA_NOTIFICA unique (nome));

create table CONTENITORE (
     idContenitore int not null auto_increment,
     capacita decimal(7,3) not null,
     tipologia char(20) not null,
     constraint ID primary key (idContenitore),
     constraint FKCONTENITORE_ID unique (capacita, tipologia));

create table ETICHETTA (
     idEtichetta int not null auto_increment,
     nome varchar(50) not null,
     descrizione varchar(500) not null,
     colore enum('Rosso','Bianco','Rosato') not null,
     titoloAlcolico decimal(4,2) not null,
     solfiti boolean not null,
     bio boolean not null,
     categoria enum('Vino','Spumante') not null,
     tenoreZuccherino enum('Secco','Abboccato','Amabile','Dolce','Brut Nature','Extra Brut','Brut','Extra Dry','Dry','Demi Sec') not null,
     temperaturaMinima decimal(4,2),
     temperaturaMassima decimal(4,2),
     classificazione enum('Generico','Varietale','IGP','IGT','DOC','DOCG','DOP'),
     gas enum('Fermo','Frizzante'),
     annata year(4),
     indicazioneGeografica varchar(100),
     specificazione char(20),
     vitigno int,
     menzione int,
     idCantina int not null,
     constraint ID primary key (idEtichetta),
     constraint FKETICHETTA unique (nome, annata, idCantina, menzione, specificazione));

create table FATTURA (
     idFattura int not null,
     data year not null,
     idOrdine int not null,
     constraint IDFATTURA primary key (idFattura, data),
     constraint FKRICHIESTA_ID unique (idOrdine));

create table INDIRIZZO (
     idIndirizzo int not null auto_increment,
     idCliente int not null,
     nome char(50) not null,
     via varchar(100) not null,
     civico int not null,
     citta varchar(80) not null,
     provincia varchar(80) not null,
     cap int not null,
     stato char(3) not null,
     constraint IDINDIRIZZO primary key (idIndirizzo));

create table MENZIONE (
     idMenzione int not null auto_increment,
     menzione char(100) not null,
     constraint IDMENZIONE primary key (idMenzione),
     constraint FKMENZIONE unique (menzione));

create table METODO_DI_PAGAMENTO (
     idCliente int not null,
     intestatario char(50) not null,
     numeroCarta bigint not null,
     scadenza date not null,
     cvv int not null,
     tipologiaCarta enum('VISA', 'V-PAY', 'Mastercard', 'Maestro') not null,
     constraint IDMETODO_DI_PAGAMENTO primary key (numeroCarta));

create table DETTAGLIO (
     idOrdine int not null,
     idContenitore int not null,
     idEtichetta int not null,
     quantita int not null,
     constraint IDDETTAGLIO primary key (idContenitore, idEtichetta, idOrdine));

create table GESTIONE_ORDINE (
     idOrdine int not null,
     idCollaboratore int not null,
     data date not null,
     stato char(20) not null,
     note varchar(500),
     constraint IDCOMANDA primary key (idOrdine, idCollaboratore, data));

create table MODIFICA_SCORTE (
     idContenitore int not null,
     idEtichetta int not null,
     idCollaboratore int not null,
     quantita int not null,
     data datetime not null,
     constraint IDMODIFICA_SCORTE primary key (idContenitore, idEtichetta, idCollaboratore, data));

create table NOTIFICA (
     idUtente int not null,
     idNotifica int not null,
     data date not null,
     messaggio varchar(500) not null,
     visualizzato char not null,
     categoria int not null,
     constraint IDNOTIFICA primary key (idUtente, idNotifica));

create table ORDINE (
     idOrdine int not null auto_increment,
     idCliente int not null,
     data datetime not null,
     statoDiAvanzamento char(20) not null,
     pagamentoIntestatario char(50) not null,
     pagamentoNumeroCarta bigint not null,
     pagamentoScadenza date not null,
     pagamentoCvv int not null,
     pagamentoTipologiaCarta varchar(20) not null,
     spedizioneNome char(50) not null,
     spedizioneVia varchar(100) not null,
     spedizioneCivico int not null,
     spedizioneCitta varchar(80) not null,
     spedizioneProvincia varchar(80) not null,
     spedizioneCap int not null,
     constraint IDORDINE primary key (idOrdine));

create table PREZZO (
     idContenitore int not null,
     idEtichetta int not null,
     data datetime not null,
     prezzo decimal(8,2) not null,
     iva decimal(4,2) not null,
     constraint IDPREZZO primary key (idContenitore, idEtichetta, data));

create table STATO (
     sigla char(3) not null,
     nome char(50) not null,
     constraint IDSTATO primary key (sigla));

create table PREFERENZA (
     idContenitore int not null,
     idEtichetta int not null,
     idCliente int not null,
     constraint IDPREFERENZA primary key (idCliente, idContenitore, idEtichetta));

create table RECENSIONE (
     idContenitore int not null,
     idEtichetta int not null,
     idCliente int not null,
     titolo varchar(100) not null,
     valutazione int not null,
     testo varchar(500) not null,
     constraint IDRECENSIONE primary key (idCliente, idContenitore, idEtichetta));

create table UTENTE (
     idUtente int not null auto_increment,
     email varchar(100) not null,
     password char(20) not null,
     ruolo enum('admin','client','collaborator') not null,
     nome char(20),
     cognome char(20),
     dataDiNascita date,
     cf char(16),
     partitaIva bigint(11),
     ragioneSociale char(100),
     attivo boolean not null default 1,
     constraint IDCLIENTE primary key (idUtente),
     constraint IDCLIENTE_1 unique (email),
     constraint IDCLIENTE_2 unique (cf),
     constraint IDUTENTE unique (partitaIva));

create table VINO_CONFEZIONATO (
     idContenitore int not null,
     idEtichetta int not null,
     scorteMagazzino int not null,
     mediaRecensioni decimal(4,3) not null,
     attivo boolean not null default 0,
     constraint IDVINO_CONFEZIONATO primary key (idContenitore, idEtichetta));

create table VITIGNO (
     idVitigno int not null auto_increment,
     coloreBacca char(10) not null,
     nomeSpecie char(50) not null,
     constraint ID_VITIGNO primary key (idVitigno),
     constraint VITIGNO_BACCA unique (coloreBacca, nomeSpecie));


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
     foreign key (idCliente)
     references UTENTE (idUtente);

alter table CARRELLO add constraint FKCAR_VIN
     foreign key (idContenitore, idEtichetta)
     references VINO_CONFEZIONATO (idContenitore, idEtichetta);

alter table ETICHETTA add constraint FKESTRAZIONE
     foreign key (vitigno)
     references VITIGNO (idVitigno);

alter table ETICHETTA add constraint FKSPECIFICA
     foreign key (menzione)
     references MENZIONE (idMenzione);

alter table ETICHETTA add constraint FKPRODUZIONE
     foreign key (idCantina)
     references CANTINA (idCantina);

alter table FATTURA add constraint FKRICHIESTA_FK
     foreign key (idOrdine)
     references ORDINE (idOrdine);

alter table INDIRIZZO add constraint FKPOSIZIONE
     foreign key (stato)
     references STATO (sigla);

alter table INDIRIZZO add constraint FKSPEDIZIONE
     foreign key (idCliente)
     references UTENTE (idUtente);

alter table METODO_DI_PAGAMENTO add constraint FKPAGAMENTO
     foreign key (idCliente)
     references UTENTE (idUtente);

alter table DETTAGLIO add constraint FKDET_VIN
     foreign key (idContenitore, idEtichetta)
     references VINO_CONFEZIONATO (idContenitore, idEtichetta);

alter table DETTAGLIO add constraint FKDET_ORD
     foreign key (idOrdine)
     references ORDINE (idOrdine);

alter table GESTIONE_ORDINE add constraint FKCOM_UTE
     foreign key (idCollaboratore)
     references UTENTE (idUtente);

alter table GESTIONE_ORDINE add constraint FKCOM_ORD
     foreign key (idOrdine)
     references ORDINE (idOrdine);

alter table MODIFICA_SCORTE add constraint FKMOD_UTE
     foreign key (idCollaboratore)
     references UTENTE (idUtente);

alter table MODIFICA_SCORTE add constraint FKMOD_VIN
     foreign key (idContenitore, idEtichetta)
     references VINO_CONFEZIONATO (idContenitore, idEtichetta);

alter table NOTIFICA add constraint FKREFERENZA
     foreign key (categoria)
     references CATEGORIA_NOTIFICA (idCategoria);

alter table NOTIFICA add constraint FKRICEZIONE
     foreign key (idUtente)
     references UTENTE (idUtente);

 alter table ORDINE add constraint FKEFFETTUAZIONE
      foreign key (idCliente)
      references UTENTE (idUtente);

alter table PREZZO add constraint FKVALUTAZIONE
     foreign key (idContenitore, idEtichetta)
     references VINO_CONFEZIONATO (idContenitore, idEtichetta);

alter table PREFERENZA add constraint FKPRE_UTE
     foreign key (idCliente)
     references UTENTE (idUtente);

alter table PREFERENZA add constraint FKPRE_VIN
     foreign key (idContenitore, idEtichetta)
     references VINO_CONFEZIONATO (idContenitore, idEtichetta);

alter table RECENSIONE add constraint FKREC_UTE
     foreign key (idCliente)
     references UTENTE (idUtente);

alter table RECENSIONE add constraint FKREC_VIN
     foreign key (idContenitore, idEtichetta)
     references VINO_CONFEZIONATO (idContenitore, idEtichetta);

alter table VINO_CONFEZIONATO add constraint FKRIF_ETICHETTA
     foreign key (idEtichetta)
     references ETICHETTA (idEtichetta);

alter table VINO_CONFEZIONATO add constraint FKRIF_CONTENITORE
     foreign key (idContenitore)
     references CONTENITORE (idContenitore);

-- Index Section
-- _____________


-- View Section
-- _____________
CREATE VIEW prezzo_recente AS SELECT v.idContenitore AS idContenitore, v.idEtichetta AS idEtichetta, p.prezzo AS prezzo, p.iva AS iva
FROM (prezzo p join vino_confezionato v on(v.idContenitore = p.idContenitore and v.idEtichetta = p.idEtichetta))
WHERE p.data = (select max(prezzo.data)
from prezzo
where v.idContenitore = prezzo.idContenitore AND v.idEtichetta = prezzo.idEtichetta);

CREATE VIEW totale_prezzo_prodotto AS SELECT d.idOrdine AS idOrdine, o.idCliente AS idCliente, d.idContenitore AS idContenitore, d.idEtichetta AS idEtichetta, d.quantita* pr.prezzo AS totaleProdotto, pr.iva AS iva FROM dettaglio d join prezzo_recente pr JOIN ordine o on(d.idContenitore = pr.idContenitore) and (d.idEtichetta = pr.idEtichetta) AND (d.idOrdine = o.idOrdine) ;

CREATE VIEW totale_ordine AS SELECT totale_prezzo_prodotto.idOrdine AS idOrdine, totale_prezzo_prodotto.idCliente AS idCliente, sum(totale_prezzo_prodotto.totaleProdotto) AS totaleOrdine FROM totale_prezzo_prodotto GROUP BY totale_prezzo_prodotto.idOrdine, totale_prezzo_prodotto.idCliente;

CREATE VIEW totale_prodotto_carrello AS SELECT c.idCliente AS idCliente, c.idContenitore AS idContenitore, c.idEtichetta AS idEtichetta, c.quantita* pr.prezzo AS totaleProdotto, pr.iva AS iva FROM carrello c join prezzo_recente pr on(c.idContenitore = pr.idContenitore) and (c.idEtichetta = pr.idEtichetta);
