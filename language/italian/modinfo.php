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
 * @version        $Id: 1.0 modinfo.php 1 Mon 2018-03-19 10:04:52Z XOOPS Project (www.xoops.org) $
 */
require_once __DIR__ . '/common.php';

// ---------------- Admin Main ----------------
define('_MI_WGGALLERY_NAME', 'wgGallery');
define('_MI_WGGALLERY_DESC', 'Questo modulo è una galleria di immagini per XOOPS');
// ---------------- Admin Menu ----------------
define('_MI_WGGALLERY_ADMENU1', 'Cruscotto');
define('_MI_WGGALLERY_ADMENU2', 'Album');
define('_MI_WGGALLERY_ADMENU3', 'Immagini');
define('_MI_WGGALLERY_ADMENU4', 'Tipi di Galleria');
define('_MI_WGGALLERY_ADMENU5', 'Tipi di Album');
define('_MI_WGGALLERY_ADMENU7', 'Autorizzazioni');
define('_MI_WGGALLERY_ADMENU8', 'Manutenzione');
define('_MI_WGGALLERY_ADMENU9', 'Filigrane');
define('_MI_WGGALLERY_ADMENU10', 'Importazione');
define('_MI_WGGALLERY_ADMENU11', 'Categorie');
define('_MI_WGGALLERY_FEEDBACK', 'Feedback');
define('_MI_WGGALLERY_ABOUT', 'Riguardo');
// ---------------- Admin Nav ----------------
define('_MI_WGGALLERY_ADMIN_PAGER', 'Elenco elementi nelle pagine di amministrazione');
define('_MI_WGGALLERY_ADMIN_PAGER_DESC', 'Definire il numero di elementi elencati nell\'area di amministrazione');
// User
define('_MI_WGGALLERY_USER_PAGER', 'Elenco elementi nelle pagine utente');
define('_MI_WGGALLERY_USER_PAGER_DESC', 'Definire il numero di elementi elencati nell\'area utente');
// Submenu
define('_MI_WGGALLERY_SMNAME1', 'Pagina indice');
define('_MI_WGGALLERY_SMNAME2', 'Gestione Album');
define('_MI_WGGALLERY_SMNAME3', 'Crea nuovo Album');
define('_MI_WGGALLERY_SMNAME4', 'Carica immagini');
define('_MI_WGGALLERY_SMNAME5', 'Gestione Immagini');
define('_MI_WGGALLERY_SMNAME6', 'Cerca Immagini');
// Blocks
define('_MI_WGGALLERY_ALBUMS_BLOCK', 'Blocco Album');
define('_MI_WGGALLERY_ALBUMS_BLOCK_DESC', 'Mostra un blocco con album (l\'ordinamento può essere selezionato)');
define('_MI_WGGALLERY_IMAGES_BLOCK', 'Blocco Immagini');
define('_MI_WGGALLERY_IMAGES_BLOCK_DESC', 'Mostra un blocco con immagini (l\'ordinamento può essere selezionato)');
// Config
define('_MI_WGGALLERY_EDITOR', 'Editor');
define('_MI_WGGALLERY_EDITOR_DESC', 'Seleziona il pannello editor da usare');
define('_MI_WGGALLERY_KEYWORDS', 'Parole chiave');
define('_MI_WGGALLERY_KEYWORDS_DESC', 'Inserisci qui le parole chiave (separate da virgola)');
define('_MI_WGGALLERY_SIZE_MB', 'MB');
define('_MI_WGGALLERY_MAXSIZE', 'Dimensione Max.');
define('_MI_WGGALLERY_MAXSIZE_DESC', 'Imposta la dimensione massima del file nei caricamenti dei file');
define('_MI_WGGALLERY_FILEEXT', 'Estensione file autorizzata');
define('_MI_WGGALLERY_FILEEXT_DESC', 'Imposta la estensione del file consentita per il caricamento');
define('_MI_WGGALLERY_MAXWIDTH', 'Largezza massima di caricamento');
define('_MI_WGGALLERY_MAXWIDTH_DESC', 'Imposta la larghezza massima consentita per il caricamento delle immagini (in pixel)');
define('_MI_WGGALLERY_MAXHEIGHT', 'Altezza massima di caricamento');
define('_MI_WGGALLERY_MAXHEIGHT_DESC', 'Imposta la altezza massima consentita per il caricamento delle immagini (in pixel)');
define('_MI_WGGALLERY_MAXWIDTH_LARGE', 'Massima larghezza della immagine grande');
define('_MI_WGGALLERY_MAXWIDTH_LARGE_DESC', 'Imposta la larghezza massima in base alla quale le immagini caricate devono essere ridimensionate (in pixel) <br> 0 significa che le immagini di grandi dimensioni mantengono le dimensioni originali. <br> Se una immagine è inferiore al valore massimo, la immagine non verrà ingrandita, verrà salvata nella dimensione originale.');
define('_MI_WGGALLERY_MAXHEIGHT_LARGE', 'Altezza massima della immagine grande');
define('_MI_WGGALLERY_MAXHEIGHT_LARGE_DESC', 'Imposta la altezza massima in base alla quale le immagini caricate devono essere ridimensionate (in pixel) <br> 0 significa che le immagini di grandi dimensioni mantengono le dimensioni originali. <br> Se una immagine è inferiore al valore massimo, la immagine non verrà ingrandita, verrà salvata nella dimensione originale.');
define('_MI_WGGALLERY_MAXWIDTH_MEDIUM', 'Larghezza massima della immagine media');
define('_MI_WGGALLERY_MAXWIDTH_MEDIUM_DESC', 'Imposta la larghezza massima in base alla quale le immagini caricate verranno ridimensionate per la immagine media (in pixel) <br> Se la immagine grande/originale è più piccola, la immagine non verrà ingrandita (la immagine grande verrà copiata come media)');
define('_MI_WGGALLERY_MAXHEIGHT_MEDIUM', 'Massima altezza della immagine media');
define('_MI_WGGALLERY_MAXHEIGHT_MEDIUM_DESC', 'Imposta la altezza massima in base alla quale le immagini caricate devono essere ridimensionate per la immagine media (in pixel) <br> Se la immagine grande/originale è più piccola, la immagine non verrà ingrandita (la immagine grande verrà copiata come media)');
define('_MI_WGGALLERY_MAXWIDTH_THUMBS', 'Massima larghezza miniature');
define('_MI_WGGALLERY_MAXWIDTH_THUMBS_DESC', 'Imposta la larghezza massima in base alla quale le immagini caricate verranno ridimensionate come miniature (in pixel)');
define('_MI_WGGALLERY_MAXHEIGHT_THUMBS', 'Massima altezza miniature');
define('_MI_WGGALLERY_MAXHEIGHT_THUMBS_DESC', 'Imposta la altezza massima in base alla quale le immagini caricate devono essere ridimensionate come miniature (in pixel)');
define('_MI_WGGALLERY_MAXWIDTH_ALBIMAGE', 'Massima larghezza delle immagini album');
define('_MI_WGGALLERY_MAXWIDTH_ALBIMAGE_DESC', 'Imposta la larghezza massima in base alla quale le immagini caricate verranno ridimensionate per le immagini album (in pixel) <br> Se usi una immagine dell\'album stessa questa opzione non ha alcun effetto');
define('_MI_WGGALLERY_MAXHEIGHT_ALBIMAGE', 'Massima altezza della immagine album');
define('_MI_WGGALLERY_MAXHEIGHT_ALBIMAGE_DESC', 'Imposta la altezza massima in base alla quale le immagini caricate devono essere ridimensionate per le immagini album (in pixel) <br> Se usi una immagine dell\'album stessa questa opzione non ha alcun effetto');
define('_MI_WGGALLERY_GALLERY_TARGET', 'Destinazione per la Galleria');
define('_MI_WGGALLERY_GALLERY_TARGET_DESC', 'Seleziona dove aprire una Galleria');
define('_MI_WGGALLERY_LINK_TARGET_SELF', 'Stessa finestra/scheda');
define('_MI_WGGALLERY_LINK_TARGET_BLANK', 'Nuova finestra/scheda');
define('_MI_WGGALLERY_IMAGE_TARGET', 'Destinazione per singola immagine');
define('_MI_WGGALLERY_IMAGE_TARGET_DESC', 'Seleziona dove deve essere mostrata una singola immagine');
define('_MI_WGGALLERY_LINK_TARGET_MODAL', 'Mostra immagine come modale senza informazioni');
define('_MI_WGGALLERY_LINK_TARGET_MODALINFO', 'Mostra immagine come modale con le proprie informazioni dettagliate');
define('_MI_WGGALLERY_ADDJQUERY', 'Aggiungi libreria jquery');
define('_MI_WGGALLERY_ADDJQUERY_DESC', 'Se usi già jquery (ad es. Nel tuo tema), imposta su NO');
define('_MI_WGGALLERY_PANEL_TYPE', 'Tipo di Pannello');
define('_MI_WGGALLERY_PANEL_TYPE_DESC', 'Il tipo di pannello è il div html bootstrap.');
define('_MI_WGGALLERY_SHOWBCRUMBS', 'Mostra percorso di navigazione');
define('_MI_WGGALLERY_SHOWBCRUMBS_DESC', 'Il percorso di navigazione mostra il contesto della pagina corrente nella struttura del sito.');
define('_MI_WGGALLERY_SHOWBCRUMBS_MNAME', 'Mostra il nome del modulo');
define('_MI_WGGALLERY_SHOWBCRUMBS_MNAME_DESC', 'Mostra il nome del modulo nel percorso di navigazione');
define('_MI_WGGALLERY_SHOWCOPYRIGHT', 'Mostra copyright');
define('_MI_WGGALLERY_SHOWCOPYRIGHT_DESC', 'Puoi rimuovere il copyright dalla galleria, ma è previsto un backlink a www.wedega.com, ovunque sul tuo sito');
define('_MI_WGGALLERY_USE_CATS', 'Usa categorie');
define('_MI_WGGALLERY_USE_CATS_DESC', 'Definire se si desidera utilizzare le categorie per immagini e album');
define('_MI_WGGALLERY_USE_TAGS', 'Usa i tag');
define('_MI_WGGALLERY_USE_TAGS_DESC', 'Definire se si desidera utilizzare i tag per immagini e album');
define('_MI_WGGALLERY_STOREEXIF', 'Salva i meta dati (exif)');
define('_MI_WGGALLERY_STOREEXIF_DESC', 'Definire se si desidera salvare i metadati (exif) delle immagini');
define('_MI_WGGALLERY_EXIFTYPES', 'Dati Exif da mostrare');
define('_MI_WGGALLERY_EXIFTYPES_DESC', "Definire quali dati exif devono essere mostrati<br>La opzione '" . _MI_WGGALLERY_STOREEXIF . "' deve essere attivata");
define('_MI_WGGALLERY_EXIF_TAGS', 'Estrai i tag dei dati Exif');
define('_MI_WGGALLERY_EXIF_TAGS_DESC', "Definire quali dati exif devono essere estratti automaticamente ed aggiunti ad una immagine caricata, come tag<br>La opzione '" . _MI_WGGALLERY_USE_TAGS . "' deve essere attivata");
define('_MI_WGGALLERY_SHOWBUTTONTEXT', 'Mostra il titolo del pulsante');
define('_MI_WGGALLERY_SHOWBUTTONTEXT_DESC', 'Mostra il titolo del pulsante. Se NO, vengono visualizzate solo le immagini');
define('_MI_WGGALLERY_GROUP_UPLOAD', 'Opzioni per il caricamento della immagine');
define('_MI_WGGALLERY_GROUP_IMAGE', 'Opzioni per la elaborazione della immagine');
define('_MI_WGGALLERY_GROUP_DISPLAY', 'Opzioni per la visualizzazione');
define('_MI_WGGALLERY_GROUP_MISC', 'Opzioni varie');
// Notifications
define('_MI_WGGALLERY_GLOBAL_NOTIFY', 'Notifiche Globali');
define('_MI_WGGALLERY_GLOBAL_ALB_NEW_ALL_NOTIFY', 'Invia notifica quando è stato creato un nuovo album');
define('_MI_WGGALLERY_GLOBAL_ALB_NEW_ALL_NOTIFY_CAPTION', 'Inviami una notifica sul nuovo album');
define('_MI_WGGALLERY_GLOBAL_ALB_NEW_ALL_NOTIFY_SUBJECT', 'Notifica relativa a un nuovo album');
define('_MI_WGGALLERY_GLOBAL_ALB_MODIFY_ALL_NOTIFY', 'Invia notifica quando viene modificato un album');
define('_MI_WGGALLERY_GLOBAL_ALB_MODIFY_ALL_NOTIFY_CAPTION', 'Avvisami di qualsiasi album in modifica');
define('_MI_WGGALLERY_GLOBAL_ALB_MODIFY_ALL_NOTIFY_SUBJECT', 'Notifica relativa all\'album modificato');
define('_MI_WGGALLERY_GLOBAL_ALB_APPROVE_ALL_NOTIFY', 'Invia notifica quando un album è in attesa di approvazione');
define('_MI_WGGALLERY_GLOBAL_ALB_APPROVE_ALL_NOTIFY_CAPTION', 'Notificami sull\'album in attesa di approvazione');
define('_MI_WGGALLERY_GLOBAL_ALB_APPROVE_ALL_NOTIFY_SUBJECT', 'La notifica di un album che è in attesa di approvazione');
define('_MI_WGGALLERY_GLOBAL_ALB_DELETE_ALL_NOTIFY', 'Invia notifica quando un album è stato eliminato');
define('_MI_WGGALLERY_GLOBAL_ALB_DELETE_ALL_NOTIFY_CAPTION', 'Avvisami di qualsiasi album eliminato');
define('_MI_WGGALLERY_GLOBAL_ALB_DELETE_ALL_NOTIFY_SUBJECT', 'Notifica relativa alla cancellazione di qualsiasi album');
define('_MI_WGGALLERY_GLOBAL_IMG_NEW_ALL_NOTIFY', 'Invia notifica quando è stata caricata una nuova immagine');
define('_MI_WGGALLERY_GLOBAL_IMG_NEW_ALL_NOTIFY_CAPTION', 'Notificami di qualsiasi nuova immagine');
define('_MI_WGGALLERY_GLOBAL_IMG_NEW_ALL_NOTIFY_SUBJECT', 'Notifica di una nuova immagine');
define('_MI_WGGALLERY_GLOBAL_IMG_DELETE_ALL_NOTIFY', 'Invia notifica quando una immagine è stata eliminata da questo album');
define('_MI_WGGALLERY_GLOBAL_IMG_DELETE_ALL_NOTIFY_CAPTION', 'Avvisami sulla eliminazione della immagine da questo album');
define('_MI_WGGALLERY_GLOBAL_IMG_DELETE_ALL_NOTIFY_SUBJECT', 'Notifica della immagine eliminata');
define('_MI_WGGALLERY_ALBUMS_NOTIFY', 'Notifica degli album');
define('_MI_WGGALLERY_ALBUMS_ALB_MODIFY_NOTIFY', 'Invia notifica quando questo album è stato modificato');
define('_MI_WGGALLERY_ALBUMS_ALB_MODIFY_NOTIFY_CAPTION', 'Avvisami sulla modifica di questo album');
define('_MI_WGGALLERY_ALBUMS_ALB_MODIFY_NOTIFY_SUBJECT', 'Notifica relativa all\'album modificato');
define('_MI_WGGALLERY_ALBUMS_ALB_DELETE_NOTIFY', 'Invia notifica quando questo album è stato eliminato');
define('_MI_WGGALLERY_ALBUMS_ALB_DELETE_NOTIFY_CAPTION', 'Avvisami della eliminazione di questo album');
define('_MI_WGGALLERY_ALBUMS_ALB_DELETE_NOTIFY_SUBJECT', 'Notifica relativa all\'album eliminato');
define('_MI_WGGALLERY_ALBUMS_IMG_NEW_NOTIFY', 'Invia notifica quando una nuova immagine è stata caricata in questo album');
define('_MI_WGGALLERY_ALBUMS_IMG_NEW_NOTIFY_CAPTION', 'Notificami sulla nuova immagine in questo album');
define('_MI_WGGALLERY_ALBUMS_IMG_NEW_NOTIFY_SUBJECT', 'Notifica di una nuova immagine');
define('_MI_WGGALLERY_ALBUMS_IMG_APPROVE_NOTIFY', 'Invia notifica quando una immagine è in attesa di approvazione');
define('_MI_WGGALLERY_ALBUMS_IMG_APPROVE_NOTIFY_CAPTION', 'Notificami sulla immagine in attesa di approvazione');
define('_MI_WGGALLERY_ALBUMS_IMG_APPROVE_NOTIFY_SUBJECT', 'La notifica sulla immagine che è in attesa di approvazione');
define('_MI_WGGALLERY_ALBUMS_IMG_DELETE_NOTIFY', 'Invia notifica quando una nuova immagine è stata eliminata da questo album');
define('_MI_WGGALLERY_ALBUMS_IMG_DELETE_NOTIFY_CAPTION', 'Avvisami sulla eliminazione della immagine da questo album');
define('_MI_WGGALLERY_ALBUMS_IMG_DELETE_NOTIFY_SUBJECT', 'Notifica della immagine eliminata');
define('_MI_WGGALLERY_IMAGES_NOTIFY', 'Image notification');
define('_MI_WGGALLERY_IMAGES_IMG_COMMENT_NOTIFY', 'Notify me about new comments for this image');
define('_MI_WGGALLERY_IMAGES_IMG_COMMENT_NOTIFY_CAPTION', 'Notify me about comments for this image');
define('_MI_WGGALLERY_IMAGES_IMG_COMMENT_NOTIFY_SUBJECT', 'Notification about new comment for an image');

define('_MI_WGGALLERY_RATINGBARS', 'Autorizza valutazione');
define('_MI_WGGALLERY_RATINGBARS_DESC', 'Definire se la valutazione deve essere possibile e quale tipo di valutazione deve essere utilizzata');
define('_MI_WGGALLERY_RATINGBAR_GROUPS', 'Gruppi con diritto di valutazione');
define('_MI_WGGALLERY_RATINGBAR_GROUPS_DESC', 'Definire quali gruppi dovrebbero avere il diritto di votare');
define('_MI_WGGALLERY_RATING_NONE', 'Non utilizzare la valutazione');
define('_MI_WGGALLERY_RATING_5STARS', 'Valuta con 5 stelle');
define('_MI_WGGALLERY_RATING_10STARS', 'Valuta con 10 stelle');
define('_MI_WGGALLERY_RATING_LIKES', 'Valuta con i mipiace');
define('_MI_WGGALLERY_RATING_10NUM', 'Valuta con il punteggio fino a 10');

define('_MI_WGGALLERY_STORE_ORIGINAL', 'Memorizza immagine originale');
define('_MI_WGGALLERY_STORE_ORIGINAL_DESC', 'Definire se si desidera memorizzare la immagine originale.
                 <br> Vantaggio: tutte le immagini possono essere riprodotte in un secondo momento, incluse miniature
                 <br> Svantaggio: lo spazio del server utilizzato aumenterà in base alla dimensione del file di caricamento consentita');
