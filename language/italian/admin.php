<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * wgGallery module for xoops
 *
 * @copyright      module for xoops
 * @license        GPL 2.0 or later
 * @package        wggallery
 * @since          1.0
 * @min_xoops      2.5.9
 * @author         Wedega - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 * @version        $Id: 1.0 admin.php 1 Mon 2018-03-19 10:04:52Z XOOPS Project (www.xoops.org) $
 */
require_once __DIR__ . '/common.php';

// ---------------- Admin Index ----------------
define('_AM_WGGALLERY_STATISTICS', 'Statistics');
// There are
define('_AM_WGGALLERY_THEREARE_ALBUMS', "Ci sono <span class='bold'>%s</span> album nel database");
define('_AM_WGGALLERY_THEREARE_IMAGES', "Ci sono <span class='bold'>%s</span> immagini nel database");
define('_AM_WGGALLERY_THEREARE_GALLERYTYPES', "Ci sono <span class='bold'>%s</span> tipi di gallerie nel database");
define('_AM_WGGALLERY_THEREARE_ALBUMTYPES', "Ci sono <span class='bold'>%s</span> tipi di album nel database");
define('_AM_WGGALLERY_THEREARE_WATERMARKS', "Ci sono <span class='bold'>%s</span> filigrane nel database");
define('_AM_WGGALLERY_THEREARE_CATEGORIES', "Ci sono <span class='bold'>%s</span> categorie nel database");
// There aren't
define('_AM_WGGALLERY_THEREARENT_GALLERYTYPES', "Non ci sono tipi di gallerie! Per la inizializzazione/ripristino vai a  'Manutenzione' => 'Manutenzione Tipi di gallerie' e clicca sul tasto 'Fissa impostazioni predefinite'");
define('_AM_WGGALLERY_THEREARENT_ALBUMTYPES', "Non ci sono tipi di album! Per la inizializzazione/ripristino vai a  'Manutenzione' => 'Manutenzione Tipi di album' e clicca sul tasto 'Fissa impostazioni predefinite'");
define('_AM_WGGALLERY_THEREARENT_WATERMARKS', 'Attualmente non ci sono filigrane definite!');
define('_AM_WGGALLERY_THEREARENT_CATEGORIES', 'Non ci sono categorie!');
// ---------------- Admin Files ----------------
// Buttons
define('_AM_WGGALLERY_ADD_ALBUM', 'Aggiungi nuovo Album');
define('_AM_WGGALLERY_ADD_IMAGE', 'Aggiungi nuova immagine');
define('_AM_WGGALLERY_ADD_GALLERYTYPE', 'Aggiungi nuovo tipo di Galleria');
define('_AM_WGGALLERY_ADD_ALBUMTYPE', 'Aggiungi nuovo tipo di Album');
define('_AM_WGGALLERY_ADD_CATEGORY', 'Aggiungi nuova Categoria');
// Lists
define('_AM_WGGALLERY_ALBUMS_LIST', 'Elenco Album');
define('_AM_WGGALLERY_ALBUMS_APPROVE', 'Album in attesa di approvazione');
define('_AM_WGGALLERY_IMAGES_LIST', 'Elenco immagini');
define('_AM_WGGALLERY_IMAGES_APPROVE', 'Imamagini in attesa di approvazione');
define('_AM_WGGALLERY_GALLERYTYPES_LIST', 'Elenco tipi di Gallerie');
define('_AM_WGGALLERY_ALBUMTYPES_LIST', 'Elenco tipi di Album');
define('_AM_WGGALLERY_WATERMARKS_LIST', 'Elenco Filigrane');
define('_AM_WGGALLERY_CATEGORIES_LIST', 'Elenco Categorie');
// Album
define('_AM_WGGALLERY_ALBUM_IMGNAME', "Nome della immagine Album (se '" . _CO_WGGALLERY_ALBUM_USE_UPLOADED . "')");
define('_AM_WGGALLERY_ALBUM_IMGID', "ID immagine Album (se '" . _CO_WGGALLERY_ALBUM_IMGID . "')");
//Categories
define('_AM_WGGALLERY_EDIT_CATEGORY', 'Modifica Categoria');
define('_AM_WGGALLERY_CAT_ID', 'Id');
define('_AM_WGGALLERY_CAT_TEXT', 'Testo Categoria');
//define('_AM_WGGALLERY_CAT_EXIF', 'Exif name for category');
define('_AM_WGGALLERY_CAT_ALBUM', 'Usa la categoria negli album');
define('_AM_WGGALLERY_CAT_IMAGE', 'Usa la categoria nelle immagini');
define('_AM_WGGALLERY_CAT_SEARCH', 'Usa la categoria nel cerca');
define('_AM_WGGALLERY_CAT_ERROR_CHANGE', 'Errore cambiando opzione');
// Elements of Gallerytype
define('_AM_WGGALLERY_GT_AT_ID', 'Id');
define('_AM_WGGALLERY_GT_AT_PRIMARY', 'Principale');
define('_AM_WGGALLERY_GT_AT_PRIMARY_1', 'Attualmente principale');
define('_AM_WGGALLERY_GT_AT_PRIMARY_0', 'Attualmente non principale');
define('_AM_WGGALLERY_GT_AT_PRIMARY_SET', 'Fissa come principale');
define('_AM_WGGALLERY_GT_AT_NAME', 'Nome');
define('_AM_WGGALLERY_GT_AT_CREDITS', 'Credits');
define('_AM_WGGALLERY_GT_AT_TEMPLATE', 'Template');
define('_AM_WGGALLERY_GT_AT_OPTIONS', 'Opzione');
define('_AM_WGGALLERY_GT_AT_DATE', 'Data');
// Gallerytype add/edit
define('_AM_WGGALLERY_GALLERYTYPE_ADD', 'Aggiungi Tipo Galleria');
define('_AM_WGGALLERY_GALLERYTYPE_EDIT', 'Modifica Tipo Galleria');
// Elements of Gallery options
define('_AM_WGGALLERY_OPTION_GT_SET', 'Fissa opzioni per il Tipo Galleria selezionato');
define('_AM_WGGALLERY_OPTION_GT_SOURCE', 'Provenienza Presentazione');
define('_AM_WGGALLERY_OPTION_GT_SOURCE_DESC',
       "Fai attenzione: se l'utente non deve scaricare immagini di grandi dimensioni, la origine verrà automaticamente ridotta a media per questo utente al fine di evitare il download non consentito con il tasto destro del mouse. <br> L'utente con diritto di scaricare immagini di grandi dimensioni vedrà anche immagini di grandi dimensioni , se hai selezionato 'grande'.");
define('_AM_WGGALLERY_OPTION_GT_SOURCE_PREVIEW', 'Provenienza Anteprima');
define('_AM_WGGALLERY_OPTION_GT_SOURCE_LARGE', 'immagini grandi');
define('_AM_WGGALLERY_OPTION_GT_SOURCE_MEDIUM', 'immagini medie');
define('_AM_WGGALLERY_OPTION_GT_SOURCE_THUMB', 'miniature');
// jssor
define('_AM_WGGALLERY_OPTION_GT_ARROWS', 'Tipo di frecce');
define('_AM_WGGALLERY_OPTION_GT_BULLETS', 'Tipo di punti elenco');
define('_AM_WGGALLERY_OPTION_GT_BULLETS_DESC', 'Non usare punti elenco con le miniature');
define('_AM_WGGALLERY_OPTION_GT_THUMBNAILS', 'Tipo di elenco miniature');
define('_AM_WGGALLERY_OPTION_GT_LOADINGS', 'Tipo di simbolo di caricamento');
define('_AM_WGGALLERY_OPTION_GT_AUTOPLAY', 'Riproduzione automatica');
define('_AM_WGGALLERY_OPTION_GT_PLAYOPTIONS', 'Opzioni di Riproduzione');
define('_AM_WGGALLERY_OPTION_GT_PLAYOPTION_1', 'Riproduci continuamente');
define('_AM_WGGALLERY_OPTION_GT_PLAYOPTION_2', 'Fermati alla ultima diapositiva');
define('_AM_WGGALLERY_OPTION_GT_PLAYOPTION_4', 'Ferma al clic');
define('_AM_WGGALLERY_OPTION_GT_PLAYOPTION_8', 'Ferma la navigazione dell\'utente (fare clic sulla freccia/punto elenco/miniatura, scorrere la diapositiva, premere la tastiera a sinistra, il tasto freccia a destra)');
// premere la tastiera a sinistra ???????????????
define('_AM_WGGALLERY_OPTION_GT_PLAYOPTION_12', 'Ferma con clic o navigazione utente');
define('_AM_WGGALLERY_OPTION_GT_FILLMODE', 'Opzioni per modalità riempimento');
define('_AM_WGGALLERY_OPTION_GT_FILLMODE_0', 'estende');
define('_AM_WGGALLERY_OPTION_GT_FILLMODE_1', 'contiene (mantenere le proporzioni e inserire tutto all\'interno della diapositiva)');
define('_AM_WGGALLERY_OPTION_GT_FILLMODE_2', 'copre (mantenere le proporzioni e coprire la intera diapositiva)');
define('_AM_WGGALLERY_OPTION_GT_FILLMODE_4', 'dimensione reale');
define('_AM_WGGALLERY_OPTION_GT_FILLMODE_5', 'contenere per immagini grandi e dimensioni effettive per immagini piccole');
define('_AM_WGGALLERY_OPTION_GT_SLIDERTYPE', 'Tipo di presentazione');
define('_AM_WGGALLERY_OPTION_GT_SLIDERTYPE_1', 'Dimensione definita');
define('_AM_WGGALLERY_OPTION_GT_SLIDERTYPE_2', 'Larghezza del modello intero');
// define('_AM_WGGALLERY_OPTION_GT_SLIDERTYPE_3', 'Full window');
define('_AM_WGGALLERY_OPTION_GT_MAXWIDTH', 'Massima larghezza immagine');
define('_AM_WGGALLERY_OPTION_GT_MAXWIDTH_DESC', "Definisce la larghezza massima immagine per il contenitore di immagini in pixel. Non valido per'" . _AM_WGGALLERY_OPTION_GT_SLIDERTYPE_2 . "'");
define('_AM_WGGALLERY_OPTION_GT_MAXHEIGHT', 'Massima altezza immagine');
define('_AM_WGGALLERY_OPTION_GT_MAXHEIGHT_DESC', "Definisce altezza massima immagine per il contenitore di immagini in pixel. Non valido per '" . _AM_WGGALLERY_OPTION_GT_SLIDERTYPE_2 . "'");
define('_AM_WGGALLERY_OPTION_GT_ORIENTATION', 'Orientamento');
define('_AM_WGGALLERY_OPTION_GT_ORIENTATION_H', 'Orizzontale');
define('_AM_WGGALLERY_OPTION_GT_ORIENTATION_V', 'Verticale');
define('_AM_WGGALLERY_OPTION_GT_TRANSORDER', 'Ordine di transizione');
define('_AM_WGGALLERY_OPTION_GT_TRANSORDER_RANDOM', 'Casuale');
define('_AM_WGGALLERY_OPTION_GT_TRANSORDER_INORDER', 'In ordine di elenco');
define('_AM_WGGALLERY_OPTION_GT_SHOWTHUMBSDOTS', 'Mostra miniature o punti');
define('_AM_WGGALLERY_OPTION_GT_SHOWTHUMBS', 'Mostra miniature');
define('_AM_WGGALLERY_OPTION_GT_SHOWDOTS', 'Mostra punti');
define('_AM_WGGALLERY_OPTION_GT_SLIDESHOWSPEED', 'Velocità di presentazione');
define('_AM_WGGALLERY_OPTION_GT_SLIDESHOWSPEED_DESC', 'Intervallo in millisecondi prima di visualizzare la immagine successiva');
define('_AM_WGGALLERY_OPTION_GT_PLAYOPTION_DESC', 'Avvia automaticamente la presentazione quando viene aperta');
define('_AM_WGGALLERY_OPTION_GT_ROWHEIGHT', 'Altezza riga');
define('_AM_WGGALLERY_OPTION_GT_LASTROW', 'Ultima riga');
define('_AM_WGGALLERY_OPTION_GT_LASTROW_DESC', 'L\'ultima riga deve essere giustificata per la intera larghezza');
define('_AM_WGGALLERY_OPTION_GT_MARGINS', 'Margine tra le immagini');
define('_AM_WGGALLERY_OPTION_GT_OUTERBORDER', 'Margine esterno del contenitore di immagini');
define('_AM_WGGALLERY_OPTION_GT_RANDOMIZE', 'Mostra Immagini in ordine casuale');
define('_AM_WGGALLERY_OPTION_GT_SLIDESHOW', 'Mostra presentazione');
define('_AM_WGGALLERY_OPTION_GT_SLIDESHOW_OPTIONS', 'Opzioni presentazione (non tutte le opzioni si applicano a ogni stile colorbox):');
define('_AM_WGGALLERY_OPTION_GT_COLORBOXSTYLE', 'Stile Colorbox');
define('_AM_WGGALLERY_OPTION_GT_TRANSEFFECT', 'Effetto Transizione');
define('_AM_WGGALLERY_OPTION_GT_SPEEDOPEN', 'Velocità di apertura della presentazione');
define('_AM_WGGALLERY_OPTION_GT_AUTOOPEN', 'Apre automaticamente la presentazione modale');
define('_AM_WGGALLERY_OPTION_GT_SLIDESHOWTYPE', 'Tipo di presentazione');
define('_AM_WGGALLERY_OPTION_GT_BUTTTONCLOSE', 'Mostra il pulsante di chiusura');
define('_AM_WGGALLERY_OPTION_GT_NAVBAR', 'Mostra barra di navigazione con le miniature');
define('_AM_WGGALLERY_OPTION_GT_SHOW_1', 'Mostra sempre');
define('_AM_WGGALLERY_OPTION_GT_SHOW_2', 'Mostra la barra di navigazione solo quando la larghezza dello schermo è superiore a 768 pixel');
define('_AM_WGGALLERY_OPTION_GT_SHOW_3', 'Mostra la barra di navigazione solo quando la larghezza dello schermo è superiore a 992 pixel');
define('_AM_WGGALLERY_OPTION_GT_SHOW_4', 'Mostra la barra di navigazione solo quando la larghezza dello schermo è superiore a 1200 pixel');
define('_AM_WGGALLERY_OPTION_GT_TOOLBAR', 'Mostra barra strumenti');
define('_AM_WGGALLERY_OPTION_GT_TOOLBARZOOM', 'Mostra i pulsanti di zoom nella barra degli strumenti');
define('_AM_WGGALLERY_OPTION_GT_TOOLBARDOWNLOAD', 'Mostra i pulsanti di scaricamento nella barra degli strumenti');
define('_AM_WGGALLERY_OPTION_GT_TOOLBARDOWNLOAD_DESC', 'Se abiliti questa opzione, verrà sempre scaricato il file sorgente. Presta attenzione: questo ignora le autorizzazioni fissate nelle impostazioni album.');
define('_AM_WGGALLERY_OPTION_GT_FULLSCREEN', 'Passa a schermo intero all\'avvio della presentazione');
define('_AM_WGGALLERY_OPTION_GT_TRANSDURATION', 'Velocità di transizione');
define('_AM_WGGALLERY_OPTION_GT_TRANSDURATION_DESC', 'Periodo di animazione in millisecondi tra 2 immagini');
define('_AM_WGGALLERY_OPTION_GT_INDEXIMG', 'Tipo di immagine nella pagina indice');
define('_AM_WGGALLERY_OPTION_GT_INDEXIMGHEIGHT', 'Altezza immagine');
define('_AM_WGGALLERY_OPTION_GT_SHOWLABEL', 'Mostra indice immagine (Immagine {current} di {total}%)');
define('_AM_WGGALLERY_OPTION_GT_LCLSKIN', 'Comandi di stile');
define('_AM_WGGALLERY_OPTION_GT_ANIMTIME', 'Velocità di animazione');
define('_AM_WGGALLERY_OPTION_GT_ANIMTIME_DESC', 'Tempo di animazione (ad es. Ridimensionamento immagine) tra due immagini in millisecondi');
define('_AM_WGGALLERY_OPTION_GT_LCLCOUNTER', 'Mostra contatore');
define('_AM_WGGALLERY_OPTION_GT_LCLPROGRESSBAR', 'Mostra barra progressi');
define('_AM_WGGALLERY_OPTION_GT_LCLMAXWIDTH', 'Massima larghezza Galleria (in % di finestra)');
define('_AM_WGGALLERY_OPTION_GT_LCLMAXHEIGTH', 'Massima altezza Galleria (in % di finestra)');
define('_AM_WGGALLERY_OPTION_GT_BACKGROUND', 'Sfondo');
define('_AM_WGGALLERY_OPTION_GT_BACKHEIGHT', 'Altezza sfondo');
define('_AM_WGGALLERY_OPTION_GT_BORDER', 'Bordo');
define('_AM_WGGALLERY_OPTION_GT_BORDERWIDTH', 'Larghezza');
define('_AM_WGGALLERY_OPTION_GT_BORDERCOLOR', 'Colore');
define('_AM_WGGALLERY_OPTION_GT_BORDERPADDING', 'Contorno');
define('_AM_WGGALLERY_OPTION_GT_BORDERRADIUS', 'Raggio');
define('_AM_WGGALLERY_OPTION_GT_SHADOW', 'Mostra ombra');
define('_AM_WGGALLERY_OPTION_GT_LCLDATAPOSITION', 'Posizione della data');
define('_AM_WGGALLERY_OPTION_GT_LCLDATAPOSITION_UNDER', 'Sotto');
define('_AM_WGGALLERY_OPTION_GT_LCLDATAPOSITION_OVER', 'Sopra');
define('_AM_WGGALLERY_OPTION_GT_LCLDATAPOSITION_RSIDE', 'Lato destro');
define('_AM_WGGALLERY_OPTION_GT_LCLDATAPOSITION_LSIDE', 'Lato sinistro');
define('_AM_WGGALLERY_OPTION_GT_LCLDATAPOSITION_DESC', "Nota che lightbox utilizza un sistema intelligente passando automaticamente a '" . _AM_WGGALLERY_OPTION_GT_LCLDATAPOSITION_OVER . "' Non appena l'elemento diventa troppo piccolo a causa di testi lunghi o di una finestra minuscola.");
define('_AM_WGGALLERY_OPTION_GT_LCLCMDPOSITION', 'Posizione comando');
define('_AM_WGGALLERY_OPTION_GT_LCLCMDPOSITION_INNER', 'Interno');
define('_AM_WGGALLERY_OPTION_GT_LCLCMDPOSITION_OUTER', 'Esterno');
define('_AM_WGGALLERY_OPTION_GT_LCLCMDPOSITION_DESC', "Nota che lightbox passerà automaticamente a '" . _AM_WGGALLERY_OPTION_GT_LCLCMDPOSITION_OUTER . "' se i comandi interni sono troppo ampi per l'elemento rappresentato");
define('_AM_WGGALLERY_OPTION_GT_LCLTHUMBSWIDTH', 'Larghezza miniatura (in pixel)');
define('_AM_WGGALLERY_OPTION_GT_LCLTHUMBSHEIGTH', 'Altezza miniatura (in pixel)');
define('_AM_WGGALLERY_OPTION_GT_LCLFULLSCREEN', "Mostra comando 'Schermo Intero'");
define('_AM_WGGALLERY_OPTION_GT_LCLFSIMGBEHAVIOUR', 'Comportamento della immagine a schermo intero');
define('_AM_WGGALLERY_OPTION_GT_LCLFSIMGBEHAVIOUR_FIT', 'adatta: la immagine sarà completamente visibile (eventualmente lasciando spazi sui bordi)');
define('_AM_WGGALLERY_OPTION_GT_LCLFSIMGBEHAVIOUR_FILL', 'riempi - la immagine riempirà sempre lo schermo (una parte potrebbe essere eventualmente nascosta)');
define('_AM_WGGALLERY_OPTION_GT_LCLFSIMGBEHAVIOUR_SMART', "intelligente - LC Lightbox utilizza la modalità 'adatta' e passa al 'riempimento' solo se le proporzioni delle immagini sono simili allo spazio disponibile");
define('_AM_WGGALLERY_OPTION_GT_LCLSOCIALS', "Mostra comando 'Social'");
define('_AM_WGGALLERY_OPTION_GT_LCLSOCIALS_FB', 'ID App Facebook');
define('_AM_WGGALLERY_OPTION_GT_LCLSOCIALS_FB_DESC', 'Ricorda di aggiungere Facebook SDK nel tuo sito web');
define('_AM_WGGALLERY_OPTION_GT_LCLDOWNLOAD', "Mostra comando 'Scarica'");
define('_AM_WGGALLERY_OPTION_GT_LCLRCLICK', 'Disabilita clic destro del mouse');
define('_AM_WGGALLERY_OPTION_GT_LCLTOGGLETXT', "Mostra comando di commutazione 'Testo'");
define('_AM_WGGALLERY_OPTION_GT_LCLNAVBTNPOS', 'Posizione dei pulsanti di navigazione');
define('_AM_WGGALLERY_OPTION_GT_LCLNAVBTNPOS_N', 'Normale');
define('_AM_WGGALLERY_OPTION_GT_LCLNAVBTNPOS_M', 'Medio');
define('_AM_WGGALLERY_OPTION_GT_LCLSLIDESHOW', "Mostra comando 'Riproduci'");

// Albumtype add/edit
define('_AM_WGGALLERY_ALBUMTYPE_ADD', 'Aggiungi Tipo Album');
define('_AM_WGGALLERY_ALBUMTYPE_EDIT', 'Modifica Tipo Album');
// options  of Albumtypes
define('_AM_WGGALLERY_OPTION_AT_SET', 'Fissa opzioni per il tipo di Album selezionato');
define('_AM_WGGALLERY_OPTION_AT_SETINFO', 'Le impostazioni per i tipi di album verranno utilizzate per la pagina indice ed i blocchi album');
define('_AM_WGGALLERY_OPTION_AT_HOVER', 'Effetto Hover');
define('_AM_WGGALLERY_OPTION_AT_NB_COLS_ALB', 'Numero di colonne per l\'elenco degli album');
define('_AM_WGGALLERY_OPTION_AT_NB_COLS_CAT', 'Numero di colonne per l\'elenco delle categorie');
// common options
define('_AM_WGGALLERY_OPTION_OPACITIY', 'Opacità');
define('_AM_WGGALLERY_OPTION_SHOWTITLE', 'Mostra titolo');
define('_AM_WGGALLERY_OPTION_SHOWDESCR', 'Mostra descrizione');
define('_AM_WGGALLERY_OPTION_CSS', 'Seleziona css per lo stile');
define('_AM_WGGALLERY_OPTION_SHOWSUBMITTER', 'Mostra mittente');
// Maintenance
define('_AM_WGGALLERY_MAINTENANCE_ALBUM_SELECT', 'Seleziona album');
define('_AM_WGGALLERY_MAINTENANCE_EXECUTE_DR', 'Cancella e ripristina');
define('_AM_WGGALLERY_MAINTENANCE_EXECUTE_R', 'Fissa le impostazioni predefinite');
define('_AM_WGGALLERY_MAINTENANCE_EXECUTE_RIL', 'Ridimensiona tutte le immagini grandi');
define('_AM_WGGALLERY_MAINTENANCE_EXECUTE_RIM', 'Ridimensiona tutte le immagini grandi');
define('_AM_WGGALLERY_MAINTENANCE_EXECUTE_RIT', 'Ridimensiona tutte le miniature');
define('_AM_WGGALLERY_MAINTENANCE_EXECUTE_DUI', 'Elimina immagini inutilizzate');
define('_AM_WGGALLERY_MAINTENANCE_EXECUTE_DUI_SHOW', 'Mostra elenco di immagini non utilizzate');
define('_AM_WGGALLERY_MAINTENANCE_SUCCESS_RESET', 'Ripristino riuscito: ');
define('_AM_WGGALLERY_MAINTENANCE_SUCCESS_CREATE', 'Creato correttamente: ');
define('_AM_WGGALLERY_MAINTENANCE_SUCCESS_RESIZE', 'Ridimensionato correttamente: %s volte ridimensionato per %t immagini');
define('_AM_WGGALLERY_MAINTENANCE_SUCCESS_DELETE', 'Eliminato correttamente: ');
define('_AM_WGGALLERY_MAINTENANCE_ERROR_RESET', 'Errore durante il ripristino: ');
define('_AM_WGGALLERY_MAINTENANCE_ERROR_CREATE', 'Errore durante la creazione: ');
define('_AM_WGGALLERY_MAINTENANCE_ERROR_DELETE', 'Errore durante la cancellazione: ');
define('_AM_WGGALLERY_MAINTENANCE_ERROR_RESIZE', 'Errore durante il ridimensionamento: ');
define('_AM_WGGALLERY_MAINTENANCE_ERROR_READDIR', 'Errore durante la lettura della directory: ');
define('_AM_WGGALLERY_MAINTENANCE_TYP', 'Tipo di manutenzione');
define('_AM_WGGALLERY_MAINTENANCE_DESC', 'Descrizione');
define('_AM_WGGALLERY_MAINTENANCE_RESULTS', 'Risultati');
define('_AM_WGGALLERY_MAINTENANCE_GT', 'Manutenzione tipi Gallerie');
define('_AM_WGGALLERY_MAINTENANCE_GT_DESC', 'Elimina i tipi di galleria non più supportati e / o ripristina tutti i tipi di galleria sui valori predefiniti');
define('_AM_WGGALLERY_MAINTENANCE_GT_SURERESET', 'Tutte le impostazioni della galleria esistenti verranno aggiornate alle impostazioni predefinite. Vuoi continuare?');
define('_AM_WGGALLERY_MAINTENANCE_GT_SUREDELETE', 'Tutti i tipi di galleria esistenti (impostazioni incluse) verranno eliminati e sostituiti dai tipi di galleria attuali. Vuoi continuare?');
define('_AM_WGGALLERY_MAINTENANCE_AT', 'Manutenzione tipi di album');
define('_AM_WGGALLERY_MAINTENANCE_AT_DESC', 'Elimina i tipi di album non più supportati e / o ripristina tutti i tipi di album ai valori predefiniti');
define('_AM_WGGALLERY_MAINTENANCE_AT_SURERESET', 'Tutte le impostazioni degli album esistenti verranno aggiornate ai tipi di album predefiniti. Vuoi continuare?');
define('_AM_WGGALLERY_MAINTENANCE_AT_SUREDELETE', 'Tutti i tipi di album esistenti (impostazioni incluse) verranno eliminati e sostituiti dai tipi di album attuali. Vuoi continuare?');
define('_AM_WGGALLERY_MAINTENANCE_RESIZE', 'Ridimensiona immagini');
define('_AM_WGGALLERY_MAINTENANCE_RESIZE_DESC', 'Ridimensiona le immagini o le miniature alla altezza massima delle preferenze del modulo corrispondente. <br> Impostazioni correnti: <ul>
<li>grandi: max larghezza %lw px / max altezza %lh px</li>
<li>medie: max larghezza %mw px / max altezza %mh px</li>
<li>miniature: max larghezza %tw px / max altezza %th px</li>
</ul>');
define('_AM_WGGALLERY_MAINTENANCE_RESIZE_INFO', 'Il ridimensionamento di "immagini di grandi dimensioni" è possibile solo se è disponibile la immagine originale!');
define('_AM_WGGALLERY_MAINTENANCE_RESIZE_SELECT', 'Seleziona il tipo di immagini per il ridimensionamento');
define('_AM_WGGALLERY_MAINTENANCE_DELETE_UNUSED', 'Pulisci directory immagine');
define('_AM_WGGALLERY_MAINTENANCE_DELETE_UNUSED_DESC', 'Tutte le immagini attualmente inutilizzate delle seguenti directory verranno eliminate:<ul>
<li>%p/albums/</li>
<li>%p/large/</li>
<li>%p/medium/</li>
<li>%p/thumbs/</li>
<li>%p/temp/</li>
</ul>');
define('_AM_WGGALLERY_MAINTENANCE_DELETE_INVALID', "Elimina gli elementi non validi nella tabella 'images'");
define('_AM_WGGALLERY_MAINTENANCE_DELETE_INVALID_DESC', "Elimina gli elementi non validi nella tabella 'images', per esempio. l'elemento è stato creato, ma qualcosa è andato storto durante il caricamento");
define('_AM_WGGALLERY_MAINTENANCE_DELETE_INVALID_IMG', 'Elemento non valido: img_id ');
define('_AM_WGGALLERY_MAINTENANCE_DELETE_UNUSED_NONE', 'Nessuna immagine non utilizzata trovata');
define('_AM_WGGALLERY_MAINTENANCE_DUI_SUREDELETE', 'Tutte le immagini degli album attualmente inutilizzate verranno eliminate! Vuoi continuare?');
define('_AM_WGGALLERY_MAINTENANCE_WATERMARK', 'Aggiungi filigrane ad un album successivamente');
define('_AM_WGGALLERY_MAINTENANCE_WATERMARK_DESC', 'Aggiungi filigrane all\'album selezionato. <br> Attenzione: le filigrane esistenti non verranno rimosse. <br> Se sono già presenti filigrane, verrà aggiunta una filigrana aggiuntiva alle immagini.');
define('_AM_WGGALLERY_MAINTENANCE_IMGDIR', 'Immagine di elementi rotti nella directory');
define('_AM_WGGALLERY_MAINTENANCE_IMGDIR_DESC', 'Vengono cercati gli elementi delle immagini della tabella, dove la immagine non si trova nella directory di caricamento.');
define('_AM_WGGALLERY_MAINTENANCE_IMGALB', 'Immagine di elementi rotti sugli album');
define('_AM_WGGALLERY_MAINTENANCE_IMGALB_DESC', 'Vengono cercati gli elementi delle immagini della tabella, dove l\'album principale non esiste (più).');
define('_AM_WGGALLERY_MAINTENANCE_ITEM_SEARCH', 'Cerca elementi');
define('_AM_WGGALLERY_MAINTENANCE_IMG_SEARCHOK', 'Non è stata trovata alcuna immagine di elementi rotti');
define('_AM_WGGALLERY_MAINTENANCE_IMG_CLEAN', 'Cancella elementi non validi');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_SYSTEM', 'Controlli di sistema');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_SYSTEMDESC', 'Verifica se le impostazioni php sono compatibili con le impostazioni del tuo modulo');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_RESULTS', 'Risultato dei controlli di sistema');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_TYPE', "Controlla impostazioni PHP '%s'");
define('_AM_WGGALLERY_MAINTENANCE_CHECK_MS_DESC', 'Le impostazioni del modulo consentono %s Bytes');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_PMS_INFO', 'Imposta la dimensione massima consentita per i dati di messaggio');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_PMS_DESC', 'Dimensione massima del file per messaggio: %s (%b Bytes)');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_FU_INFO', 'Se consentire o meno il caricamento di file HTTP');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_FU_DESC', 'Caricamento file consente: ');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_UMF_INFO', 'Imposta la dimensione massima per il caricamento del file');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_UMF_DESC', 'Dimensione massima del file per il caricamento del file: %s (%b Bytes)');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_ML_INFO1', 'Imposta la quantità massima di memoria in byte che uno script può allocare');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_ML_INFO2', 'Se hai problemi con il caricamento di immagini di grandi dimensioni, aumenta questo valore');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_ML_DESC', 'Limite massimo di memoria: %s (%b Bytes)');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_MS_ERROR1', 'Riduci le impostazioni del modulo o aumenta le impostazione php');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_MS_ERROR2', 'Attiva le impostazioni php');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_MS_ERROR3', 'memory_limit deve essere maggiore di upload_max_filesize e superiore a post_max_size');
define('_AM_WGGALLERY_MAINTENANCE_READ_EXIF', 'Leggi i dati Exif');
define('_AM_WGGALLERY_MAINTENANCE_READ_EXIF_DESC', 'Leggi e salva i dati exif per tutte le immagini ancora una volta');
define('_AM_WGGALLERY_MAINTENANCE_READ_EXIF_READ', 'Leggi i dati exif mancanti');
define('_AM_WGGALLERY_MAINTENANCE_READ_EXIF_READALL', 'Leggi di nuovo tutti i dati exif');
define('_AM_WGGALLERY_MAINTENANCE_READ_EXIF_SUCCESS', 'Dati Exif letti correttamente');
define('_AM_WGGALLERY_MAINTENANCE_READ_EXIF_ERROR', 'Errore durante la lettura dei dati exif');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_SPACE', 'Controlla lo spazio utilizzato nella directory di upload');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_SPACE_DESC', 'Le seguenti directory di caricamento verranno controllate per rilevare spazio utilizzato:<ul>
<li>%p/albums/</li>
<li>%p/large/</li>
<li>%p/medium/</li>
<li>%p/thumbs/</li>
<li>%p/temp/</li>
</ul>');
define('_AM_WGGALLERY_MAINTENANCE_ERROR_SOURCE', 'Errore - file sorgente necessario non trovato: ');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_MT', 'Controlla i tipi MIME');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_MT_DESC', 'Controlla la tabella immagini per:<ul>
<li>tipi MIME non validi</li>
<li>tipi MIME non consentiti in base alle preferenze del modulo</li>
</ul>');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_MT_SEARCH', 'Cerca tipi MIME non validi');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_MT_CLEAN', 'Cancella tipi MIME non validi');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_MT_SUCCESS', '%s tipi MIME di %t sono validi');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_MT_SUCCESSOK', 'Tipo MIME valido');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_MT_ERROR', 'Tipo MIME non valido');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_MT_SAVESUCCESS', 'Tipo MIME modificato correttamente');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_MT_SAVEERROR', 'Errore durante il salvataggio del tipo MIME');
define('_AM_WGGALLERY_MAINTENANCE_INVALIDRATE', 'Cancellazione valutazioni/mipiace');
define('_AM_WGGALLERY_MAINTENANCE_INVALIDRATE_DESC', 'Elimina voti/Mipiace, dove la immagine non esiste più');
define('_AM_WGGALLERY_MAINTENANCE_INVALIDRATE_NUM', '%e di %s voti non sono validi');
define('_AM_WGGALLERY_MAINTENANCE_INVALIDRATE_RESULT', '%s di %t voti cancellati');
define('_AM_WGGALLERY_MAINTENANCE_INVALIDCATS', 'Pulizia delle categorie utilizzate');
define('_AM_WGGALLERY_MAINTENANCE_INVALIDCATS_DESC', 'Elimina la categoria in album e immagini, se la categoria non esiste più');
define('_AM_WGGALLERY_MAINTENANCE_INVALIDCATS_RESULT', '%t elementi sono stati cancellati');
// Import
define('_AM_WGGALLERY_IMPORT', 'Importa dati e file da altri moduli galleria');
define('_AM_WGGALLERY_IMPORT_LIST', 'Elenco dei moduli supportati');
define('_AM_WGGALLERY_IMPORT_SUPPORT', 'Moduli supportati per la importazione');
define('_AM_WGGALLERY_IMPORT_SUP_INSTALLED', 'il modulo è installato');
define('_AM_WGGALLERY_IMPORT_SUP_NOTINSTALLED', 'il modulo non è installato');
define('_AM_WGGALLERY_IMPORT_FOUND', 'Risultato della ricerca');
define('_AM_WGGALLERY_IMPORT_READ', 'Leggi i dati del modulo');
define('_AM_WGGALLERY_IMPORT_EXEC', 'Importa dati e file');
define('_AM_WGGALLERY_IMPORT_NUMALB', 'Numero di album');
define('_AM_WGGALLERY_IMPORT_NUMIMG', 'Numero di immagini');
define('_AM_WGGALLERY_IMPORT_INFO_SIZE', 'Attenzione: le immagini non verranno ridimensionate in base alle preferenze del modulo. Se si desidera ridimensionare, utilizzare "Manutenzione" dopo la importazione.');
define('_AM_WGGALLERY_IMPORT_ERR', 'L\'importazione dei dati è possibile solo quando le tabelle di album e immagini sono vuote');
define('_AM_WGGALLERY_IMPORT_ERR_ALBEXIST', 'Esistono già album');
define('_AM_WGGALLERY_IMPORT_ERR_IMGEXIST', 'Esistono già immagini');
define('_AM_WGGALLERY_IMPORT_SUCCESS', '%a album e %i immagini importati correttamente');
define('_AM_WGGALLERY_IMPORT_ERROR', 'Si è verificato un errore durante l\'importazione');
define('_AM_WGGALLERY_MAINTENANCE_DELETE_EXIF', 'Cancella i dati EXIF');
define('_AM_WGGALLERY_MAINTENANCE_EXIF_CURRENT', 'Dati EXIF attualmente mancanti: %c di %t immagini');
define('_AM_WGGALLERY_MAINTENANCE_DELETE_EXIF_SUCCESS', 'Dati EXIF cancellati correttamente');
define('_AM_WGGALLERY_MAINTENANCE_DELETE_EXIF_ERROR', 'Errore durante la cancellazione dei dati EXIF');

define('_AM_WGGALLERY_PERMS_ALBDEFAULT', 'Autorizzazioni predefinite per un nuovo album');
define('_AM_WGGALLERY_PERMS_ALBDEFAULT_DESC', 'Definire le autorizzazioni predefinite per la creazione di un nuovo album');
