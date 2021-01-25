-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 25, 2021 alle 02:02
-- Versione del server: 10.4.16-MariaDB
-- Versione PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `worldwineweb`
--
use worldwineweb;

--
-- Dump dei dati per la tabella `cantina`
--

INSERT INTO `cantina` (`idCantina`, `nome`, `stato`) VALUES
(13, 'Bastianich', 'ITA'),
(6, 'Casa Sant\'Orsola', 'ITA'),
(2, 'Ca’ del Bosco', 'ITA'),
(12, 'Ceci', 'ITA'),
(10, 'Chablis Vititours', 'FRA'),
(14, 'Corbinie', 'ITA'),
(16, 'Kellerei Kaltern', 'ITA'),
(11, 'La Bodega Tinedo', 'ESP'),
(1, 'Menestrello', 'ITA'),
(4, 'Mionetto', 'ITA'),
(8, 'Santa Barbara', 'ITA'),
(9, 'Tenuta Coccapane', 'ITA'),
(7, 'Terre Forti', 'ITA'),
(17, 'Tramin', 'DEU'),
(3, 'Umani Ronchi', 'ITA'),
(5, 'Villa Bonaga', 'ITA'),
(15, 'Zenato', 'ITA');

--
-- Dump dei dati per la tabella `contenitore`
--

INSERT INTO `contenitore` (`idContenitore`, `capacita`, `tipologia`) VALUES
(1, '0.375', 'mezza bottiglia'),
(2, '0.750', 'standard'),
(3, '1.500', 'magnum'),
(4, '3.000', 'jeroboam'),
(5, '4.500', 'rehoboam'),
(6, '6.000', 'mathusalem'),
(7, '9.000', 'salmanazar'),
(8, '12.000', 'balthazar'),
(9, '15.000', 'nabuchodonosor'),
(10, '18.000', 'melchior'),
(11, '20.000', 'salomon'),
(12, '25.000', 'sovereign'),
(13, '27.000', 'goliath'),
(14, '30.000', 'melchizedec');

--
-- Dump dei dati per la tabella `dettaglio`
--

INSERT INTO `dettaglio` (`idOrdine`, `idContenitore`, `idEtichetta`, `quantita`) VALUES
(7, 2, 2, 3),
(9, 2, 2, 11),
(7, 2, 3, 3),
(7, 2, 6, 3),
(8, 2, 6, 5),
(7, 2, 7, 6),
(8, 2, 7, 2),
(11, 2, 7, 12),
(7, 2, 8, 1),
(10, 2, 8, 1),
(6, 2, 10, 4),
(8, 3, 5, 1);

--
-- Dump dei dati per la tabella `etichetta`
--

INSERT INTO `etichetta` (`idEtichetta`, `nome`, `descrizione`, `colore`, `titoloAlcolico`, `solfiti`, `bio`, `categoria`, `tenoreZuccherino`, `temperaturaMinima`, `temperaturaMassima`, `classificazione`, `gas`, `annata`, `indicazioneGeografica`, `specificazione`, `vitigno`, `menzione`, `idCantina`) VALUES
(2, 'Lambrusco Otello', 'A livello organolettico questo sensazionale vino emiliano si presenta con un colore rosso rubino con evidenti riflessi violacei, scuro ed impenetrabile, caratterizzato da un perlage fitto e persistente. Il profumo al naso lascia emergere tutte le note fruttate tipiche del lambrusco maestri, inserite in un contesto di grande intensità ed eleganza: fragole, more, lamponi. In bocca è abboccato, quasi dolce, sostenuto da una buona acidità e da un\'insospettabile tannicità.', 'Rosso', '11.00', 1, 0, 'Vino', 'Abboccato', '14.00', '14.00', 'IGP', 'Frizzante', 2015, 'Emilia Romagna', NULL, 48, NULL, 12),
(3, 'Refosco Dal Peduncolo', 'Vinificato puro al 100% con uve di Refosco dal Peduncolo Rosso. Vitigno autoctono del Friuli Venezia Giulia, si esprime con note di degustazione uniche: l\'impatto al sorso è morbido, con note di frutti di bosco maturi. I tannini sono molteplici e morbidi oltre ad essere dotati di spiccata rotondità e corposità, Nel finale si evince a pieno la persistenza al palato. Il retrogusto sorprende con nota di foglia di tabacco.', 'Rosso', '13.00', 1, 0, 'Vino', 'Abboccato', '18.00', '20.00', 'DOC', 'Frizzante', 2018, 'Friuli Venezia Giulia', 'Nessuna', 83, NULL, 13),
(4, 'Chianti Colli Senesi', 'Alla vista risulta di colore rosso intenso con piacevoli riflessi violacei. Al palato offre un gusto asciutto e continuo. All’olfatto rivela piacevoli sentori di frutta.', 'Rosso', '12.50', 1, 0, 'Vino', 'Amabile', '16.00', '18.00', 'DOCG', 'Frizzante', 2018, 'Toscana', 'Storica', 89, NULL, 14),
(5, 'Valpolicella ', 'All’esame organolettico questo particolare vino della tradizione veneta si presenta con un aspetto di colore rosso rubino carico. Il Profumo è intenso, fine e persistente, con sentori di amarena e prugna. Il gusto è armonico e vellutato, di buona struttura.', 'Rosso', '14.00', 1, 0, 'Vino', 'Abboccato', '18.00', '18.00', 'DOC', 'Fermo', 2016, 'Veneto', 'Storica', 29, 7, 15),
(6, 'Schiava Solos', 'All’esame organolettico questo particolare vino della tradizione veneta si presenta con un aspetto di colore rosso rubino carico. Il Profumo è intenso, fine e persistente, con sentori di amarena e prugna. Il gusto è armonico e vellutato, di buona struttura.', 'Rosso', '14.00', 1, 0, 'Vino', 'Abboccato', '15.00', '15.00', 'DOC', 'Fermo', 1980, 'Trentino Alto Adige', 'Nessuna', 90, NULL, 16),
(7, 'Ribolla', 'Le note di degustazione evidenziano uno stretto equilibrio di sentori minerali e agrumi, che col tempo si trasformano in una più densa sensazione di fiori selvatici, miele di trifoglio e pera matura. La sua struttura tannica e acida lo rende di impatto immediato, oltre a conferirgli longevità. Al naso appare maturo e strutturato, con profumi di mandarino, arancia, melone e pera.', 'Bianco', '12.50', 1, 0, 'Vino', 'Abboccato', '6.00', '8.00', 'DOC', 'Frizzante', 2019, 'Friuli Venezia Giulia', 'Classica', 172, NULL, 13),
(8, 'Gewurztraminer ', 'Da giovane può accompagnare i fritti o il pesce crudo, ma è anche fantastico con piatti molto piccanti e speziati (Indiano o Tailandese). Con il tempo diventa un magnifico abbinamento a formaggi teneri come Taleggio o robiola. Va assolutamente servito fresco, alla temperatura massima di 8° C in bicchieri tipo “Renano” alti ed affusolati.', 'Bianco', '13.50', 1, 0, 'Vino', 'Secco', '10.00', '12.00', 'DOC', 'Fermo', 2013, 'Germania', 'Storica', 187, NULL, 17),
(9, 'Franciacorta Cuvees Prestige ', 'All’esame organolettico questo vino Franciacorta si presenta con un aspetto rosa salmone con perlage fine e persistente. Il profumo è sorprendentemente ricco al naso, con una profondità sul floreale di rosa e peonia, e sul fruttato di melograno e fragola. Il gusto all’assaggio si conferma fruttato, ed è fresco con un’effervescenza sottile e delicata.', 'Rosato', '12.50', 1, 0, 'Vino', 'Amabile', '6.00', '6.00', 'DOC', 'Frizzante', 2014, 'Lombardia', 'Storica', 78, 8, 2),
(10, 'Franciacorta Brut Cuvees Prestige ', 'All’esame organolettico questo Spumante Franciacorta si presenta di colore giallo paglierino, lucente. Perlage fine e persistente. Il profumo all’olfatto, mostra sentori delicati di fiori bianchi e frutta a polpa gialla, con un bel sentore di pasticceria e un lieve rimando erbaceo. Il gusto è assolutamente piacevole, pulito e vivace, si distende armonicamente su una trama minerale spiccata e note di frutta esotica.', 'Bianco', '12.50', 1, 0, 'Spumante', 'Brut', '6.00', '6.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2);

--
-- Dump dei dati per la tabella `gestione_ordine`
--

INSERT INTO `gestione_ordine` (`idOrdine`, `idCollaboratore`, `data`, `stato`) VALUES
(1, 1, '2021-01-23 13:33:46', 'Annullato'),
(2, 3, '2021-01-23 13:34:47', 'Annullato'),
(3, 1, '2021-01-23 13:38:35', 'Annullato'),
(4, 1, '2021-01-23 20:44:42', 'Elaborazione'),
(4, 1, '2021-01-23 20:45:02', 'Spedito'),
(4, 1, '2021-01-23 20:46:00', 'Consegnato'),
(5, 3, '2021-01-24 00:24:24', 'Annullato'),
(6, 1, '2021-01-25 01:26:32', 'Elaborazione'),
(6, 1, '2021-01-25 01:26:33', 'Spedito'),
(6, 1, '2021-01-25 01:26:34', 'Consegnato'),
(7, 1, '2021-01-25 01:27:35', 'Elaborazione'),
(7, 1, '2021-01-25 01:27:37', 'Spedito'),
(8, 1, '2021-01-25 01:27:43', 'Annullato'),
(9, 1, '2021-01-25 01:26:41', 'Elaborazione'),
(9, 1, '2021-01-25 01:26:42', 'Spedito'),
(9, 1, '2021-01-25 01:26:43', 'Consegnato'),
(10, 1, '2021-01-25 01:31:27', 'Elaborazione'),
(10, 1, '2021-01-25 01:31:28', 'Spedito'),
(10, 1, '2021-01-25 01:31:29', 'Consegnato'),
(11, 1, '2021-01-25 01:34:46', 'Elaborazione'),
(11, 1, '2021-01-25 01:38:45', 'Spedito'),
(11, 1, '2021-01-25 01:39:14', 'Consegnato');

--
-- Dump dei dati per la tabella `indirizzo`
--

INSERT INTO `indirizzo` (`idIndirizzo`, `idCliente`, `nome`, `via`, `civico`, `citta`, `provincia`, `cap`, `stato`) VALUES
(1, 3, 'Alberto Franchi', 'Ragazzena', 147, 'Cervia', 'Ravenna', 48015, 'ITA'),
(2, 5, 'Martina Villa', 'Romagna', 245, 'Cervia', 'Ravenna', 48015, 'ITA');

--
-- Dump dei dati per la tabella `menzione`
--

INSERT INTO `menzione` (`idMenzione`, `menzione`) VALUES
(6, 'Gran Selezione'),
(5, 'Novello'),
(1, 'Passito'),
(2, 'Passito Liquoroso'),
(8, 'Prestige'),
(3, 'Riserva'),
(4, 'Riserva Superiore'),
(7, 'Superiore');

--
-- Dump dei dati per la tabella `metodo_di_pagamento`
--

INSERT INTO `metodo_di_pagamento` (`idCliente`, `intestatario`, `numeroCarta`, `scadenza`, `cvv`, `tipologiaCarta`) VALUES
(3, 'Giacomo Franchi', 4785478547854785, '2026-12-01', 785, 'Mastercard'),
(5, 'Villa Martina SRL', 4789652144478787, '2026-01-01', 785, 'V-PAY');

--
-- Dump dei dati per la tabella `modifica_scorte`
--

INSERT INTO `modifica_scorte` (`idContenitore`, `idEtichetta`, `idCollaboratore`, `quantita`, `data`) VALUES
(2, 2, 1, 500, '2021-01-25 00:50:55'),
(2, 3, 1, 100, '2021-01-25 00:51:03'),
(2, 6, 1, 20, '2021-01-25 00:51:32'),
(2, 7, 1, 150, '2021-01-25 00:51:41'),
(2, 7, 1, -50, '2021-01-25 00:51:42'),
(2, 7, 1, 100, '2021-01-25 00:51:44'),
(2, 8, 1, 10, '2021-01-25 00:51:25'),
(2, 9, 1, 65, '2021-01-25 00:50:42'),
(2, 9, 1, 25, '2021-01-25 00:50:43'),
(2, 9, 1, -5, '2021-01-25 00:50:45'),
(2, 10, 1, 50, '2021-01-25 00:50:33'),
(2, 10, 1, 10, '2021-01-25 00:50:34'),
(2, 10, 1, 100, '2021-01-25 00:50:36'),
(3, 4, 1, 20, '2021-01-25 00:50:04'),
(3, 4, 1, 10, '2021-01-25 00:50:05'),
(3, 4, 1, -5, '2021-01-25 00:50:24'),
(3, 5, 1, 10, '2021-01-25 00:51:56'),
(3, 5, 1, 10, '2021-01-25 00:51:57');

--
-- Dump dei dati per la tabella `notifica`
--

INSERT INTO `notifica` (`idUtente`, `idNotifica`, `data`, `messaggio`, `visualizzato`, `categoria`) VALUES
(3, 1, '2021-01-23 13:33:46', 'Gentile Grandi, il tuo ordine #1 è stato annullato', '0', 'Ordine'),
(3, 2, '2021-01-23 13:34:47', 'Gentile Grandi, il tuo ordine #2 è stato annullato', '1', 'Ordine'),
(3, 3, '2021-01-23 13:38:35', 'Gentile Grandi, il tuo ordine #3 è stato annullato', '0', 'Ordine'),
(3, 4, '2021-01-23 20:44:42', 'Gentile Grandi, il tuo ordine #4 è in fase di elaborazione', '1', 'Ordine'),
(3, 5, '2021-01-23 20:45:02', 'Gentile Grandi, il tuo ordine #4 è stato spedito', '1', 'Ordine'),
(3, 6, '2021-01-23 20:46:00', 'Gentile Grandi, il tuo ordine #4 è stato consegnato', '1', 'Ordine'),
(3, 7, '2021-01-24 00:24:24', 'Gentile Grandi, il tuo ordine #5 è stato annullato', '0', 'Ordine'),
(3, 8, '2021-01-25 01:26:32', 'Gentile Grandi, il tuo ordine #6 è in fase di elaborazione', '0', 'Ordine'),
(3, 9, '2021-01-25 01:26:33', 'Gentile Grandi, il tuo ordine #6 è stato spedito', '0', 'Ordine'),
(3, 10, '2021-01-25 01:26:34', 'Gentile Grandi, il tuo ordine #6 è stato consegnato', '0', 'Ordine'),
(5, 11, '2021-01-25 01:26:41', 'Gentile , il tuo ordine #9 è in fase di elaborazione', '0', 'Ordine'),
(5, 12, '2021-01-25 01:26:42', 'Gentile , il tuo ordine #9 è stato spedito', '0', 'Ordine'),
(5, 13, '2021-01-25 01:26:43', 'Gentile , il tuo ordine #9 è stato consegnato', '0', 'Ordine'),
(3, 14, '2021-01-25 01:27:35', 'Gentile Grandi, il tuo ordine #7 è in fase di elaborazione', '0', 'Ordine'),
(3, 15, '2021-01-25 01:27:37', 'Gentile Grandi, il tuo ordine #7 è stato spedito', '0', 'Ordine'),
(5, 16, '2021-01-25 01:27:43', 'Gentile , il tuo ordine #8 è stato annullato', '0', 'Ordine'),
(5, 17, '2021-01-25 01:31:27', 'Gentile , il tuo ordine #10 è in fase di elaborazione', '0', 'Ordine'),
(5, 18, '2021-01-25 01:31:28', 'Gentile , il tuo ordine #10 è stato spedito', '0', 'Ordine'),
(5, 19, '2021-01-25 01:31:29', 'Gentile , il tuo ordine #10 è stato consegnato', '0', 'Ordine'),
(5, 20, '2021-01-25 01:34:46', 'Gentile , il tuo ordine #11 è in fase di elaborazione', '0', 'Ordine'),
(5, 21, '2021-01-25 01:38:18', 'Gentile Villa Martina, il prodotto #9_2 Franciacorta Cuvees Prestige  ha subito un cambio di prezzo.', '0', 'Prodotto'),
(5, 22, '2021-01-25 01:38:45', 'Gentile , il tuo ordine #11 è stato spedito', '0', 'Ordine'),
(5, 23, '2021-01-25 01:39:14', 'Gentile Villa Martina, il tuo ordine #11 è stato consegnato', '0', 'Ordine');

--
-- Dump dei dati per la tabella `ordine`
--

INSERT INTO `ordine` (`idOrdine`, `idCliente`, `data`, `statoDiAvanzamento`, `pagamentoIntestatario`, `pagamentoNumeroCarta`, `pagamentoScadenza`, `pagamentoCvv`, `pagamentoTipologiaCarta`, `spedizioneNome`, `spedizioneVia`, `spedizioneCivico`, `spedizioneCitta`, `spedizioneProvincia`, `spedizioneCap`) VALUES
(1, 3, '2021-01-23 13:33:34', 'Annullato', 'Giacomo Franchi', 4785478547854785, '2026-12-01', 785, 'Mastercard', 'Alberto Franchi', 'Ragazzena', 147, 'Cervia', 'Ravenna', 48015),
(2, 3, '2021-01-23 13:34:37', 'Annullato', 'Giacomo Franchi', 4785478547854785, '2026-12-01', 785, 'Mastercard', 'Alberto Franchi', 'Ragazzena', 147, 'Cervia', 'Ravenna', 48015),
(3, 3, '2021-01-23 13:35:44', 'Annullato', 'Giacomo Franchi', 4785478547854785, '2026-12-01', 785, 'Mastercard', 'Alberto Franchi', 'Ragazzena', 147, 'Cervia', 'Ravenna', 48015),
(4, 3, '2021-01-23 20:44:22', 'Consegnato', 'Giacomo Franchi', 4785478547854785, '2026-12-01', 785, 'Mastercard', 'Alberto Franchi', 'Ragazzena', 147, 'Cervia', 'Ravenna', 48015),
(5, 3, '2021-01-24 00:23:41', 'Annullato', 'Giacomo Franchi', 4785478547854785, '2026-12-01', 785, 'Mastercard', 'Alberto Franchi', 'Ragazzena', 147, 'Cervia', 'Ravenna', 48015),
(6, 3, '2021-01-25 01:04:10', 'Consegnato', 'Giacomo Franchi', 4785478547854785, '2026-12-01', 785, 'Mastercard', 'Alberto Franchi', 'Ragazzena', 147, 'Cervia', 'Ravenna', 48015),
(7, 3, '2021-01-25 01:16:14', 'Spedito', 'Giacomo Franchi', 4785478547854785, '2026-12-01', 785, 'Mastercard', 'Alberto Franchi', 'Ragazzena', 147, 'Cervia', 'Ravenna', 48015),
(8, 5, '2021-01-25 01:22:38', 'Annullato', 'Villa Martina SRL', 4789652144478787, '2026-01-01', 785, 'V-PAY', 'Martina Villa', 'Romagna', 245, 'Cervia', 'Ravenna', 48015),
(9, 5, '2021-01-25 01:23:00', 'Consegnato', 'Villa Martina SRL', 4789652144478787, '2026-01-01', 785, 'V-PAY', 'Martina Villa', 'Romagna', 245, 'Cervia', 'Ravenna', 48015),
(10, 5, '2021-01-25 01:31:21', 'Consegnato', 'Villa Martina SRL', 4789652144478787, '2026-01-01', 785, 'V-PAY', 'Martina Villa', 'Romagna', 245, 'Cervia', 'Ravenna', 48015),
(11, 5, '2021-01-25 01:34:37', 'Consegnato', 'Villa Martina SRL', 4789652144478787, '2026-01-01', 785, 'V-PAY', 'Martina Villa', 'Romagna', 245, 'Cervia', 'Ravenna', 48015);

--
-- Dump dei dati per la tabella `preferenza`
--

INSERT INTO `preferenza` (`idContenitore`, `idEtichetta`, `idCliente`) VALUES
(2, 3, 3),
(2, 6, 3),
(2, 10, 3),
(3, 5, 3),
(2, 3, 5),
(2, 6, 5),
(2, 7, 5),
(2, 9, 5),
(3, 2, 5),
(3, 5, 5);

--
-- Dump dei dati per la tabella `prezzo`
--

INSERT INTO `prezzo` (`idContenitore`, `idEtichetta`, `data`, `prezzo`, `iva`) VALUES
(2, 2, '2021-01-24 23:50:10', '9.95', '10.00'),
(2, 3, '2021-01-24 23:54:56', '16.90', '10.00'),
(2, 6, '2021-01-25 00:05:26', '350.00', '10.00'),
(2, 7, '2021-01-25 00:15:15', '24.90', '10.00'),
(2, 8, '2021-01-25 00:18:03', '249.90', '10.00'),
(2, 9, '2021-01-25 00:22:43', '79.90', '10.00'),
(2, 9, '2021-01-25 01:38:18', '99.90', '10.00'),
(2, 10, '2021-01-25 00:33:30', '45.00', '10.00'),
(3, 2, '2021-01-24 23:51:16', '23.90', '10.00'),
(3, 4, '2021-01-24 23:59:03', '17.90', '10.00'),
(3, 5, '2021-01-25 00:02:18', '59.90', '10.00');

--
-- Dump dei dati per la tabella `recensione`
--

INSERT INTO `recensione` (`idContenitore`, `idEtichetta`, `idCliente`, `titolo`, `valutazione`, `testo`) VALUES
(2, 2, 3, 'Buono', 3, 'Rapporto qualità prezzo buona'),
(2, 7, 3, 'Il migliore', 5, 'Vino davvero buonissimo, delicato'),
(2, 8, 3, 'Discreto', 4, 'Visto il prezzo mi aspettavo qualcosa in più, ma comunque vino delizioso'),
(2, 9, 3, 'ECCEZIONALE', 5, 'Prodotto veramente eccezionale, da provare!'),
(2, 10, 3, 'ECCEZIONALE', 5, 'Prodotto veramente eccezionale, da provare!'),
(3, 4, 3, 'Pessimo', 1, 'Il rapporto qualità prezzo è anche accettabile, ma il sapore decisamente no'),
(2, 6, 5, 'Fenomenale', 3, 'Il vino è davvero eccellente, ma mi è costato un rene.\r\n'),
(2, 7, 5, 'Buono', 2, 'Buono ma il prezzo è troppo alto'),
(3, 5, 5, 'ECCEZIONALE', 4, 'Davvero buono');

--
-- Dump dei dati per la tabella `stato`
--

INSERT INTO `stato` (`sigla`, `nome`) VALUES
('ABW', 'Aruba'),
('AFG', 'Afghanistan'),
('AGO', 'Angola'),
('AIA', 'Anguilla'),
('ALA', 'Isole Åland'),
('ALB', 'Albania'),
('AND', 'Andorra'),
('ARE', 'Emirati Arabi Uniti'),
('ARG', 'Argentina'),
('ARM', 'Armenia'),
('ASM', 'Samoa Americane'),
('ATA', 'Antartide'),
('ATF', 'Terre australi e antartiche francesi'),
('ATG', 'Antigua e Barbuda'),
('AUS', 'Australia'),
('AUT', 'Austria'),
('AZE', 'Azerbaigian'),
('BDI', 'Burundi'),
('BEL', 'Belgio'),
('BEN', 'Benin'),
('BES', 'Isole BES'),
('BFA', 'Burkina Faso'),
('BGD', 'Bangladesh'),
('BGR', 'Bulgaria'),
('BHR', 'Bahrein'),
('BHS', 'Bahamas'),
('BIH', 'Bosnia ed Erzegovina'),
('BLM', 'Saint-Barthélemy'),
('BLR', 'Bielorussia'),
('BLZ', 'Belize'),
('BMU', 'Bermuda'),
('BOL', 'Bolivia'),
('BRA', 'Brasile'),
('BRB', 'Barbados'),
('BRN', 'Brunei'),
('BTN', 'Bhutan'),
('BVT', 'Isola Bouvet'),
('BWA', 'Botswana'),
('CAF', 'Rep. Centrafricana'),
('CAN', 'Canada'),
('CCK', 'Isole Cocos (Keeling)'),
('CHE', 'Svizzera'),
('CHL', 'Cile'),
('CHN', 'Cina'),
('CIV', 'Costa d\'Avorio'),
('CMR', 'Camerun'),
('COD', 'RD del Congo'),
('COG', 'Rep. del Congo'),
('COK', 'Isole Cook'),
('COL', 'Colombia'),
('COM', 'Comore'),
('CPV', 'Capo Verde'),
('CRI', 'Costa Rica'),
('CUB', 'Cuba'),
('CUW', 'Curaçao'),
('CXR', 'Isola di Natale'),
('CYM', 'Isole Cayman'),
('CYP', 'Cipro'),
('CZE', 'Rep. Ceca'),
('DEU', 'Germania'),
('DJI', 'Gibuti'),
('DMA', 'Dominica'),
('DNK', 'Danimarca'),
('DOM', 'Rep. Dominicana'),
('DZA', 'Algeria'),
('ECU', 'Ecuador'),
('EGY', 'Egitto'),
('ERI', 'Eritrea'),
('ESH', 'Sahara Occidentale'),
('ESP', 'Spagna'),
('EST', 'Estonia'),
('ETH', 'Etiopia'),
('FIN', 'Finlandia'),
('FJI', 'Figi'),
('FLK', 'Isole Falkland'),
('FRA', 'Francia'),
('FRO', 'Fær Øer'),
('FSM', 'Micronesia'),
('GAB', 'Gabon'),
('GBR', 'Regno Unito'),
('GEO', 'Georgia'),
('GGY', 'Guernsey'),
('GHA', 'Ghana'),
('GIB', 'Gibilterra'),
('GIN', 'Guinea'),
('GLP', 'Guadalupa'),
('GMB', 'Gambia'),
('GNB', 'Guinea-Bissau'),
('GNQ', 'Guinea Equatoriale'),
('GRC', 'Grecia'),
('GRD', 'Grenada'),
('GRL', 'Groenlandia'),
('GTM', 'Guatemala'),
('GUF', 'Guyana francese'),
('GUM', 'Guam'),
('GUY', 'Guyana'),
('HKG', 'Hong Kong'),
('HMD', 'Isole Heard e McDonald'),
('HND', 'Honduras'),
('HRV', 'Croazia'),
('HTI', 'Haiti'),
('HUN', 'Ungheria'),
('IDN', 'Indonesia'),
('IMN', 'Isola di Man'),
('IND', 'India'),
('IOT', 'Territorio britannico dell\'Oceano Indiano'),
('IRL', 'Irlanda'),
('IRN', 'Iran'),
('IRQ', 'Iraq'),
('ISL', 'Islanda'),
('ISR', 'Israele'),
('ITA', 'Italia'),
('JAM', 'Giamaica'),
('JEY', 'Jersey'),
('JOR', 'Giordania'),
('JPN', 'Giappone'),
('KAZ', 'Kazakistan'),
('KEN', 'Kenya'),
('KGZ', 'Kirghizistan'),
('KHM', 'Cambogia'),
('KIR', 'Kiribati'),
('KNA', 'Saint Kitts e Nevis'),
('KOR', 'Corea del Sud'),
('KWT', 'Kuwait'),
('LAO', 'Laos'),
('LBN', 'Libano'),
('LBR', 'Liberia'),
('LBY', 'Libia'),
('LCA', 'Saint Lucia'),
('LIE', 'Liechtenstein'),
('LKA', 'Sri Lanka'),
('LSO', 'Lesotho'),
('LTU', 'Lituania'),
('LUX', 'Lussemburgo'),
('LVA', 'Lettonia'),
('MAC', 'Macao'),
('MAF', 'Saint-Martin'),
('MAR', 'Marocco'),
('MCO', 'Monaco'),
('MDA', 'Moldavia'),
('MDG', 'Madagascar'),
('MDV', 'Maldive'),
('MEX', 'Messico'),
('MHL', 'Isole Marshall'),
('MKD', 'Macedonia del Nord'),
('MLI', 'Mali'),
('MLT', 'Malta'),
('MMR', 'Birmania'),
('MNE', 'Montenegro'),
('MNG', 'Mongolia'),
('MNP', 'Isole Marianne Settentrionali'),
('MOZ', 'Mozambico'),
('MRT', 'Mauritania'),
('MSR', 'Montserrat'),
('MTQ', 'Martinica'),
('MUS', 'Mauritius'),
('MWI', 'Malawi'),
('MYS', 'Malaysia'),
('MYT', 'Mayotte'),
('NAM', 'Namibia'),
('NCL', 'Nuova Caledonia'),
('NER', 'Niger'),
('NFK', 'Isola Norfolk'),
('NGA', 'Nigeria'),
('NIC', 'Nicaragua'),
('NIU', 'Niue'),
('NLD', 'Paesi Bassi'),
('NOR', 'Norvegia'),
('NPL', 'Nepal'),
('NRU', 'Nauru'),
('NZL', 'Nuova Zelanda'),
('OMN', 'Oman'),
('PAK', 'Pakistan'),
('PAN', 'Panama'),
('PCN', 'Isole Pitcairn'),
('PER', 'Perù'),
('PHL', 'Filippine'),
('PLW', 'Palau'),
('PNG', 'Papua Nuova Guinea'),
('POL', 'Polonia'),
('PRI', 'Porto Rico'),
('PRK', 'Corea del Nord'),
('PRT', 'Portogallo'),
('PRY', 'Paraguay'),
('PSE', 'Palestina'),
('PYF', 'Polinesia francese'),
('QAT', 'Qatar'),
('REU', 'Riunione'),
('ROU', 'Romania'),
('RUS', 'Russia'),
('RWA', 'Ruanda'),
('SAU', 'Arabia Saudita'),
('SDN', 'Sudan'),
('SEN', 'Senegal'),
('SGP', 'Singapore'),
('SGS', 'Georgia del Sud e Isole Sandwich Australi'),
('SHN', 'Sant\'Elena, Ascensione e Tristan da Cunha'),
('SJM', 'Svalbard e Jan Mayen'),
('SLB', 'Isole Salomone'),
('SLE', 'Sierra Leone'),
('SLV', 'El Salvador'),
('SMR', 'San Marino'),
('SOM', 'Somalia'),
('SPM', 'Saint-Pierre e Miquelon'),
('SRB', 'Serbia'),
('SSD', 'Sudan del Sud'),
('STP', 'São Tomé e Príncipe'),
('SUR', 'Suriname'),
('SVK', 'Slovacchia'),
('SVN', 'Slovenia'),
('SWE', 'Svezia'),
('SWZ', 'Swaziland'),
('SXM', 'Sint Maarten'),
('SYC', 'Seychelles'),
('SYR', 'Siria'),
('TCA', 'Turks e Caicos'),
('TCD', 'Ciad'),
('TGO', 'Togo'),
('THA', 'Thailandia'),
('TJK', 'Tagikistan'),
('TKL', 'Tokelau'),
('TKM', 'Turkmenistan'),
('TLS', 'Timor Est'),
('TON', 'Tonga'),
('TTO', 'Trinidad e Tobago'),
('TUN', 'Tunisia'),
('TUR', 'Turchia'),
('TUV', 'Tuvalu'),
('TWN', 'Taiwan'),
('TZA', 'Tanzania'),
('UGA', 'Uganda'),
('UKR', 'Ucraina'),
('UMI', 'Isole minori esterne degli Stati Uniti'),
('URY', 'Uruguay'),
('USA', 'Stati Uniti'),
('UZB', 'Uzbekistan'),
('VAT', 'Città del Vaticano'),
('VCT', 'Saint Vincent e Grenadine'),
('VEN', 'Venezuela'),
('VGB', 'Isole Vergini britanniche'),
('VIR', 'Isole Vergini americane'),
('VNM', 'Vietnam'),
('VUT', 'Vanuatu'),
('WLF', 'Wallis e Futuna'),
('WSM', 'Samoa'),
('YEM', 'Yemen'),
('ZAF', 'Sudafrica'),
('ZMB', 'Zambia'),
('ZWE', 'Zimbabwe');

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`idUtente`, `email`, `password`, `ruolo`, `nome`, `cognome`, `dataDiNascita`, `cf`, `partitaIva`, `ragioneSociale`, `attivo`) VALUES
(1, 'ma.giacchini99@gmail.com', 'a123', 'admin', 'Mattia', 'Giacchini', '1999-05-11', 'GCCMTT99E11H199X', NULL, NULL, 1),
(2, 'dani@gmail.com', '123456aA', 'admin', 'Daniele', 'Ercoles', '1992-10-19', 'RCLDNL88C22H777Z', NULL, NULL, 1),
(3, 'a@b.it', 'a123', 'client', 'Grandi', 'Filomeno', '1991-01-20', 'GRNFMN02T04A944S', NULL, NULL, 1),
(4, 'mario@biondi.com', '123456aA', 'collaborator', 'Mario', 'Biondi', '2002-02-02', 'abcabc15e11g198f', NULL, NULL, 0),
(5, 'info@villamartina.it', '123456aA', 'client', NULL, NULL, NULL, NULL, 11454785441, 'Villa Martina', 1);

--
-- Dump dei dati per la tabella `vino_confezionato`
--

INSERT INTO `vino_confezionato` (`idContenitore`, `idEtichetta`, `scorteMagazzino`, `mediaRecensioni`, `attivo`) VALUES
(2, 2, 486, '3.000', 1),
(2, 3, 97, '0.000', 1),
(2, 6, 17, '3.000', 1),
(2, 7, 182, '3.500', 1),
(2, 8, 8, '4.000', 1),
(2, 9, 85, '5.000', 1),
(2, 10, 156, '5.000', 1),
(3, 2, 0, '0.000', 1),
(3, 4, 25, '1.000', 1),
(3, 5, 20, '4.000', 1);

--
-- Dump dei dati per la tabella `vitigno`
--

INSERT INTO `vitigno` (`idVitigno`, `coloreBacca`, `nomeSpecie`) VALUES
(106, 'Chiara', 'Albana'),
(107, 'Chiara', 'Ansonica'),
(108, 'Chiara', 'Antiniello'),
(109, 'Chiara', 'Arneis'),
(110, 'Chiara', 'Arvisionadu'),
(111, 'Chiara', 'Asprinio'),
(112, 'Chiara', 'Baratuciat'),
(113, 'Chiara', 'Bellone'),
(114, 'Chiara', 'Biancame'),
(115, 'Chiara', 'Bianchello'),
(116, 'Chiara', 'Biancolella'),
(117, 'Chiara', 'Bombino bianco'),
(118, 'Chiara', 'Bosco'),
(119, 'Chiara', 'Bovale grande'),
(120, 'Chiara', 'Carricante'),
(121, 'Chiara', 'Catarratto'),
(122, 'Chiara', 'Chardonnay'),
(123, 'Chiara', 'Chasselas'),
(124, 'Chiara', 'Cividino'),
(125, 'Chiara', 'Cococciola'),
(126, 'Chiara', 'Coda di Volpe'),
(127, 'Chiara', 'Cortese'),
(128, 'Chiara', 'Durello'),
(129, 'Chiara', 'Erbaluce'),
(130, 'Chiara', 'Falanghina'),
(131, 'Chiara', 'Fiano'),
(132, 'Chiara', 'Forastera'),
(133, 'Chiara', 'Francavidda'),
(134, 'Chiara', 'Friulano'),
(135, 'Chiara', 'Garganega'),
(136, 'Chiara', 'Glera (prosecco)'),
(137, 'Chiara', 'Grecanico dorato'),
(138, 'Chiara', 'Grechetto'),
(139, 'Chiara', 'Greco'),
(140, 'Chiara', 'Greco bianco'),
(141, 'Chiara', 'Grillo'),
(142, 'Chiara', 'Guarnaccia'),
(143, 'Chiara', 'Impigno'),
(144, 'Chiara', 'Inzolia'),
(145, 'Chiara', 'Kerner'),
(146, 'Chiara', 'Lumassina'),
(147, 'Chiara', 'Malvasia'),
(148, 'Chiara', 'Marchione'),
(149, 'Chiara', 'Maruggio'),
(150, 'Chiara', 'Minutolo'),
(151, 'Chiara', 'Montonico'),
(152, 'Chiara', 'Montù'),
(154, 'Chiara', 'Moscatello selvatico'),
(153, 'Chiara', 'Moscato'),
(155, 'Chiara', 'Müller-Thurgau'),
(156, 'Chiara', 'Nasco'),
(157, 'Chiara', 'Nosiola'),
(158, 'Chiara', 'Nuragus'),
(159, 'Chiara', 'Ortrugo'),
(160, 'Chiara', 'Pampanuto'),
(161, 'Chiara', 'Passerina'),
(162, 'Chiara', 'Pecorino'),
(163, 'Chiara', 'Pepella'),
(164, 'Chiara', 'Picolit'),
(165, 'Chiara', 'Pigato'),
(166, 'Chiara', 'Pignoletto'),
(167, 'Chiara', 'Pinot bianco'),
(168, 'Chiara', 'Pinot grigio'),
(169, 'Chiara', 'Prié blanc'),
(170, 'Chiara', 'Prosecco'),
(171, 'Chiara', 'Ramandolo'),
(172, 'Chiara', 'Ribolla gialla'),
(173, 'Chiara', 'Riesling'),
(174, 'Chiara', 'Sauvignon'),
(175, 'Chiara', 'Sylvaner Veltiner'),
(176, 'Chiara', 'Torbato'),
(177, 'Chiara', 'Traminer aromatico'),
(178, 'Chiara', 'Trebbiano'),
(179, 'Chiara', 'Verdeca'),
(180, 'Chiara', 'Verdicchio'),
(181, 'Chiara', 'Verduzzo'),
(182, 'Chiara', 'Vermentino'),
(183, 'Chiara', 'Vernaccia'),
(184, 'Chiara', 'Viognier'),
(185, 'Chiara', 'Vitovska'),
(186, 'Chiara', 'Zibibbo'),
(1, 'Nera', 'Aglianico'),
(2, 'Nera', 'Aglianicone'),
(3, 'Nera', 'Albana Nera'),
(4, 'Nera', 'Aleatico'),
(5, 'Nera', 'Alicante'),
(6, 'Nera', 'Ancelotta'),
(7, 'Nera', 'Barbera'),
(8, 'Nera', 'Barbera dell\'Emilia'),
(9, 'Nera', 'Bombino nero'),
(10, 'Nera', 'Bonarda'),
(11, 'Nera', 'Bovale sardo'),
(12, 'Nera', 'Brachetto'),
(13, 'Nera', 'Cabernet franc'),
(14, 'Nera', 'Cabernet-Sauvignon'),
(15, 'Nera', 'Caddiu'),
(16, 'Nera', 'Cagnulari'),
(17, 'Nera', 'Calabrese'),
(18, 'Nera', 'Canaiolo'),
(19, 'Nera', 'Canina'),
(20, 'Nera', 'Cannonau'),
(21, 'Nera', 'Carignano'),
(22, 'Nera', 'Casetta'),
(23, 'Nera', 'Castiglione'),
(24, 'Nera', 'Centesimino'),
(25, 'Nera', 'Cesanese'),
(26, 'Nera', 'Ciliegiolo'),
(27, 'Nera', 'Clinton'),
(28, 'Nera', 'Colorino'),
(29, 'Nera', 'Corvina'),
(30, 'Nera', 'Corvinone'),
(31, 'Nera', 'Croatina'),
(32, 'Nera', 'Dolcetto'),
(33, 'Nera', 'Enantio'),
(34, 'Nera', 'Fortana'),
(35, 'Nera', 'Fragolino'),
(36, 'Nera', 'Franconia'),
(37, 'Nera', 'Frappato'),
(38, 'Nera', 'Freisa'),
(39, 'Nera', 'Fumin'),
(40, 'Nera', 'Gaglioppo'),
(41, 'Nera', 'Gamay'),
(187, 'Nera', 'Gewurztraminer'),
(42, 'Nera', 'Grappello Ruberti'),
(43, 'Nera', 'Greco nero'),
(44, 'Nera', 'Grignolino'),
(45, 'Nera', 'Groppello'),
(46, 'Nera', 'Lacrima'),
(47, 'Nera', 'Lagrein'),
(48, 'Nera', 'Lambrusco'),
(49, 'Nera', 'Longanesi'),
(50, 'Nera', 'Magliocco canino'),
(51, 'Nera', 'Malvasia di Casorzo'),
(52, 'Nera', 'Malvasia di Schierano'),
(53, 'Nera', 'Malvasia nera di Brindisi'),
(54, 'Nera', 'Malvasia nera di Lecce'),
(55, 'Nera', 'Mammolo'),
(56, 'Nera', 'Marzemino'),
(57, 'Nera', 'Merlot'),
(58, 'Nera', 'Molinara'),
(59, 'Nera', 'Monica'),
(60, 'Nera', 'Montepulciano'),
(61, 'Nera', 'Moscato di Scanzo'),
(62, 'Nera', 'Moscato rosa'),
(63, 'Nera', 'Nebbiolo'),
(64, 'Nera', 'Negrara'),
(65, 'Nera', 'Negrettino'),
(66, 'Nera', 'Negroamaro'),
(67, 'Nera', 'Nerello'),
(68, 'Nera', 'Nerello mascalese'),
(69, 'Nera', 'Nero Buono'),
(70, 'Nera', 'Nero d\'Avola'),
(71, 'Nera', 'Neyret'),
(72, 'Nera', 'Nieddera'),
(73, 'Nera', 'Nocera'),
(74, 'Nera', 'Notardomenico'),
(75, 'Nera', 'Ottavianello'),
(76, 'Nera', 'Perricone'),
(77, 'Nera', 'Pignolo'),
(78, 'Nera', 'Pinot nero'),
(79, 'Nera', 'Primitivo'),
(80, 'Nera', 'Prugnolo'),
(81, 'Nera', 'Raboso'),
(82, 'Nera', 'Rebo'),
(83, 'Nera', 'Refosco dal peduncolo rosso'),
(84, 'Nera', 'Rondinella'),
(85, 'Nera', 'Rossese'),
(86, 'Nera', 'Rossignola'),
(87, 'Nera', 'Ruchè'),
(88, 'Nera', 'Sagrantino'),
(89, 'Nera', 'Sangiovese'),
(90, 'Nera', 'Schiava'),
(91, 'Nera', 'Schioppettino'),
(92, 'Nera', 'Sciascinoso'),
(93, 'Nera', 'Susumaniello'),
(94, 'Nera', 'Syrah'),
(95, 'Nera', 'Teroldego'),
(96, 'Nera', 'Terrano del Carso Triestino'),
(97, 'Nera', 'Tintilia'),
(98, 'Nera', 'Tocai rosso'),
(99, 'Nera', 'Traminer aromatico'),
(100, 'Nera', 'Uva di Troia'),
(101, 'Nera', 'Uva Longanesi'),
(102, 'Nera', 'Uva rara'),
(103, 'Nera', 'Vernaccia'),
(104, 'Nera', 'Vespolina'),
(105, 'Nera', 'Vin de Nus');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
