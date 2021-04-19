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
 * @copyright module for xoops
 * @license   GPL 2.0 or later
 * @package   wggallery
 * @since     1.0
 * @min_xoops 2.5.7
 * @author    Wedega - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 * @version   $Id: 1.0 main.php 1 Mon 2018-03-19 10:04:56Z XOOPS Project (www.xoops.org) $
 */

// defines for state
\define('_CO_WGGALLERY_STATE_OFFLINE', 'Noninlinea');
\define('_CO_WGGALLERY_STATE_ONLINE', 'Inlinea');
\define('_CO_WGGALLERY_STATE_APPROVAL', 'In attesa di approvazione');
// General
\define('_CO_WGGALLERY_NONE', 'Nessuno');
\define('_CO_WGGALLERY_BACK', 'Indietro');
\define('_CO_WGGALLERY_ALL', 'Tutti');
\define('_CO_WGGALLERY_UPDATE', 'Aggiorna');
\define('_CO_WGGALLERY_EXEC', 'Esegui');
\define('_CO_WGGALLERY_DOWNLOAD', 'Scarica');
\define('_CO_WGGALLERY_DOWNLOAD_ALB', 'Scarica Album');
\define('_CO_WGGALLERY_DATE', 'Data');
\define('_CO_WGGALLERY_SUBMITTER', 'Mittente');
\define('_CO_WGGALLERY_WEIGHT', 'Peso');
\define('_CO_WGGALLERY_COMMENT', 'commento');
\define('_CO_WGGALLERY_COMMENTS', 'commenti');
\define('_CO_WGGALLERY_VIEWS', 'Visualizzazioni');
\define('_CO_WGGALLERY_RATING', 'Valutazione');
\define('_CO_WGGALLERY_MB', 'MB');
// Forms
\define('_CO_WGGALLERY_FORM_UPLOAD', 'Carica file');
\define('_CO_WGGALLERY_FORM_IMAGE_PATH', 'File in %s ');
\define('_CO_WGGALLERY_FORM_ACTION', 'Azione');
\define('_CO_WGGALLERY_FORM_EDIT', 'Modifica');
\define('_CO_WGGALLERY_FORM_TOGGLE_SELECT', 'seleziona/deseleziona tutti');
\define('_CO_WGGALLERY_FORM_IMAGEPICKER', 'Seleziona una immagine');
\define('_CO_WGGALLERY_FORM_SUBMIT_SUBMITUPLOAD', 'Invia e vai al caricamento immagini');
\define('_CO_WGGALLERY_FORM_SUBMIT_WMTEST', 'Invia e mostra il testo immagine');
\define('_CO_WGGALLERY_FORM_ERROR_INVALIDID', 'Id non valido');
\define('_CO_WGGALLERY_FORM_OK', 'Salvato correttamente');
\define('_CO_WGGALLERY_FORM_DELETE_OK', 'Cancellato correttamente');
\define('_CO_WGGALLERY_FORM_SURE_DELETE', "Sei sicuro di voler cancellare: <b><span style='color : Red;'>%s </span></b>"); //default xoops confirm
\define('_CO_WGGALLERY_FORM_SURE_RENEW', "Sei sicuro di voler aggiornare: <b><span style='color : Red;'>%s </span></b>");
\define('_CO_WGGALLERY_FORM_DELETE', 'Cancella'); //wggallery xoops confirm
\define('_CO_WGGALLERY_FORM_DELETE_SURE', 'Sei veramente sicuro di cancellare?'); //wggallery xoops confirm
\define('_CO_WGGALLERY_FORM_ERROR_RESETUSAGE1', 'Errore durante il ripristino dell\'utilizzo di una filigrana');
\define('_CO_WGGALLERY_FORM_ERROR_RESETUSAGE2', 'Errore durante il ripristino dell\'utilizzo della filigrana negli album');
\define('_CO_WGGALLERY_FORM_ERROR_ALBPID', 'Errore: album principali non trovati');
\define('_CO_WGGALLERY_FORM_OK_APPROVE', 'Album salvato correttamente. Verrai inoltrato per approvare le immagini');
// There aren't
\define('_CO_WGGALLERY_THEREARENT_ALBUMS', 'Attualmente non ci sono album disponibili');
\define('_CO_WGGALLERY_THEREARENT_IMAGES', 'Attualmente non ci sono immagini disponibili');
// fine uploader
\define('_CO_WGGALLERY_FU_SUBMIT', 'Invio immagine: ');
\define('_CO_WGGALLERY_FU_SUBMITTED', 'Immagine verificata correttamente, si prega di caricare');
\define('_CO_WGGALLERY_FU_UPLOAD', 'Caricamento delle immagini: ');
\define('_CO_WGGALLERY_FU_FAILED', 'Si sono verificati errori durante il caricamento delle immagini');
\define('_CO_WGGALLERY_FU_SUCCEEDED', 'Caricate correttamente tutte le immagini');
// Album buttons
\define('_CO_WGGALLERY_ALBUM_ADD', 'Aggiungi Album');
\define('_CO_WGGALLERY_ALBUM_EDIT', 'Modifica Album');
// Elements of collections
\define('_CO_WGGALLERY_COLL_TITLE', 'Collezioni disponibili');
\define('_CO_WGGALLERY_COLL_ALBUMS', 'Mostra sotto-Album');
// Elements of Album
\define('_CO_WGGALLERY_ALBUMS_TITLE', 'Galleria di Album');
\define('_CO_WGGALLERY_ALBUMS_COUNT', 'Numero di Album');
\define('_CO_WGGALLERY_ALBUM', 'Album');
\define('_CO_WGGALLERY_ALBUMS', 'Albums');
\define('_CO_WGGALLERY_ALBUMS_DESC', 'wgGallery is a XOOPS module for presenting images in albums and categories');
\define('_CO_WGGALLERY_ALBUM_COLL', 'Collection');
\define('_CO_WGGALLERY_ALBUM_NB_COLL', 'album(s) in this collection');
\define('_CO_WGGALLERY_ALBUM_NB_IMAGES', 'image(s) in this album');
\define('_CO_WGGALLERY_ALBUM_NO_IMAGES', 'L\'album non contiene immagini');
\define('_CO_WGGALLERY_ALBUM_ID', 'Id');
\define('_CO_WGGALLERY_ALBUM_PID', 'Collezione principale');
\define('_CO_WGGALLERY_ALBUM_ISCOLL', 'L\'Album è Collezione');
\define('_CO_WGGALLERY_ALBUM_NAME', 'Nome');
\define('_CO_WGGALLERY_ALBUM_DESC', 'Descrizione');
\define('_CO_WGGALLERY_ALBUM_IMAGE', 'Immagine Album');
\define('_CO_WGGALLERY_ALBUM_IMGTYPE', 'Provenienza per immagine Album');
\define('_CO_WGGALLERY_ALBUM_USE_EXIST', 'Usa una immagine dell\'album come immagine Album');
\define('_CO_WGGALLERY_ALBUM_IMGID', 'Immagini esistenti in questo album');
\define('_CO_WGGALLERY_ALBUM_USE_UPLOADED', 'Usa una immagine caricata come immagine Album');
\define('_CO_WGGALLERY_ALBUM_CREATE_GRID', 'Crea una Griglia');
\define('_CO_WGGALLERY_ALBUM_CROP_IMAGE', 'Ritaglia immagine');
\define('_CO_WGGALLERY_ALBUM_FORM_UPLOAD_IMAGE', 'Carica una nuova immagine');
\define('_CO_WGGALLERY_ALBUM_STATE', 'Stato');
\define('_CO_WGGALLERY_ALBUM_DELETE_DESC', 'Attenzione: verranno eliminate anche tutte le immagini collegate a questo album');
\define('_CO_WGGALLERY_ALBUM_SELECT', 'Seleziona album');
\define('_CO_WGGALLERY_ALBUM_SELECT_DESC', 'Seleziona l\'album per il caricamento delle immagini');
\define('_CO_WGGALLERY_ALBUMS_SHOW', 'Mostra tutti gli album');
\define('_CO_WGGALLERY_ALBUMS_SORT', 'Ordinamento degli album');
\define('_CO_WGGALLERY_ALBUM_SORT_SHOWHIDE', 'Fare clic per mostrare/nascondere i sotto-elementi');
\define('_CO_WGGALLERY_ALBUM_IMAGE_ERRORNOTFOUND', 'Errore: immagine Album non trovata');
\define('_CO_WGGALLERY_ALBUMS_ERRNOTFOUND', 'Errore: immagine non trovata (ID Immagine %s)');
// album image handler
\define('_CO_WGGALLERY_ALBUM_IH_APPLY', 'Applica');
\define('_CO_WGGALLERY_ALBUM_IH_IMAGE_EDIT', 'Modifica la immagine Album');
\define('_CO_WGGALLERY_ALBUM_IH_CURRENT', 'Attuale');
\define('_CO_WGGALLERY_ALBUM_IH_GRID4', 'Usa 4 immmagini');
\define('_CO_WGGALLERY_ALBUM_IH_GRID6', 'Usa 6 immagini');
\define('_CO_WGGALLERY_ALBUM_IH_GRID_SRC1', 'Seleziona immagine 1');
\define('_CO_WGGALLERY_ALBUM_IH_GRID_SRC2', 'Seleziona immagine 2');
\define('_CO_WGGALLERY_ALBUM_IH_GRID_SRC3', 'Seleziona immagine 3');
\define('_CO_WGGALLERY_ALBUM_IH_GRID_SRC4', 'Seleziona immagine 4');
\define('_CO_WGGALLERY_ALBUM_IH_GRID_SRC5', 'Seleziona immagine 5');
\define('_CO_WGGALLERY_ALBUM_IH_GRID_SRC6', 'Seleziona immagine 6');
\define('_CO_WGGALLERY_ALBUM_IH_GRID_CREATE', 'Crea griglia');
\define('_CO_WGGALLERY_ALBUM_IH_CROP_CREATE', 'Crea immagine');
\define('_CO_WGGALLERY_ALBUM_IH_CROP_MOVE', 'Sposta');
\define('_CO_WGGALLERY_ALBUM_IH_CROP_ZOOMIN', 'Avvicina');
\define('_CO_WGGALLERY_ALBUM_IH_CROP_ZOOMOUT', 'Allontana');
\define('_CO_WGGALLERY_ALBUM_IH_CROP_MOVE_LEFT', 'Sposta a sinistra');
\define('_CO_WGGALLERY_ALBUM_IH_CROP_MOVE_RIGHT', 'Sposta a destra');
\define('_CO_WGGALLERY_ALBUM_IH_CROP_MOVE_UP', 'Sposta sù');
\define('_CO_WGGALLERY_ALBUM_IH_CROP_MOVE_DOWN', 'Sposta giù');
\define('_CO_WGGALLERY_ALBUM_IH_CROP_FLIP_HORIZONTAL', 'Capovolgi orizzontalmente');
\define('_CO_WGGALLERY_ALBUM_IH_CROP_FLIP_VERTICAL', 'Capovolgi verticalmente');
\define('_CO_WGGALLERY_ALBUM_IH_CROP_ASPECTRATIO', 'Proporzioni');
\define('_CO_WGGALLERY_ALBUM_IH_CROP_ASPECTRATIO_FREE', 'Libero');
// Image add/edit/show
\define('_CO_WGGALLERY_IMAGE_ADD', 'Aggiungi immagine');
\define('_CO_WGGALLERY_IMAGE_EDIT', 'Modifica immagine');
\define('_CO_WGGALLERY_IMAGE_SHOW', 'Mostra immagine');
// Elements of Image
\define('_CO_WGGALLERY_IMAGE', 'Immagine');
\define('_CO_WGGALLERY_IMAGES', 'Immagini');
\define('_CO_WGGALLERY_IMAGES_TITLE', 'Galleria di immagini di ');
\define('_CO_WGGALLERY_IMAGES_COUNT', 'Numero di immagini');
\define('_CO_WGGALLERY_IMAGES_ALBUMSHOW', 'Mostra Album');
\define('_CO_WGGALLERY_IMAGES_INDEX', 'Mostra Indice delle immagini');
\define('_CO_WGGALLERY_IMAGES_UPLOAD', 'Carica immagini');
\define('_CO_WGGALLERY_IMAGE_MANAGE', 'Gestisci immagini');
\define('_CO_WGGALLERY_IMAGE_MANAGE_DESC', 'Riordina le tue immagini trascinandole');
\define('_CO_WGGALLERY_IMAGE_ID', 'Id');
\define('_CO_WGGALLERY_IMAGE_TITLE', 'Titolo');
\define('_CO_WGGALLERY_IMAGE_DESC', 'Descrizione');
\define('_CO_WGGALLERY_IMAGE_NAME', 'Nome');
\define('_CO_WGGALLERY_IMAGE_NAMEORIG', 'Nome originale');
\define('_CO_WGGALLERY_IMAGE_NAMELARGE', 'Nome della immagine grande');
\define('_CO_WGGALLERY_IMAGE_MIMETYPE', 'Tipo MIME');
\define('_CO_WGGALLERY_IMAGE_SIZE', 'Dimensione');
\define('_CO_WGGALLERY_IMAGE_RES', 'Risoluzione');
\define('_CO_WGGALLERY_IMAGE_RESX', 'Risx');
\define('_CO_WGGALLERY_IMAGE_RESY', 'Risy');
\define('_CO_WGGALLERY_IMAGE_DOWNLOADS', 'Scaricamenti');
\define('_CO_WGGALLERY_IMAGE_RATINGLIKES', 'Valutazioni/Mipiace');
\define('_CO_WGGALLERY_IMAGE_VOTES', 'Voti');
\define('_CO_WGGALLERY_IMAGE_ALBID', 'Album');
\define('_CO_WGGALLERY_IMAGE_STATE', 'Stato');
\define('_CO_WGGALLERY_IMAGE_IP', 'Ip');
\define('_CO_WGGALLERY_IMAGE_RESIZE', 'Ridimensiona immagine alle seguenti dimensioni:');
\define('_CO_WGGALLERY_IMAGE_THUMB', 'Immagine miniatura');
\define('_CO_WGGALLERY_IMAGE_MEDIUM', 'Immagine media');
\define('_CO_WGGALLERY_IMAGE_LARGE', 'Immagine grande');
\define('_CO_WGGALLERY_IMAGE_ALL', 'Tutte le immagini');
\define('_CO_WGGALLERY_IMAGE_EXIF', 'Dati Exif');
\define('_CO_WGGALLERY_IMAGE_ROTATE_LEFT', 'Ruota a sinistra');
\define('_CO_WGGALLERY_IMAGE_ROTATE_RIGHT', 'Ruota a destra');
\define('_CO_WGGALLERY_IMAGE_ROTATED', 'Immagine ruotata correttamente');
\define('_CO_WGGALLERY_IMAGE_ROTATE_ERROR', 'Errore durante la rotazione della immagine');
\define('_CO_WGGALLERY_IMAGE_ERRORUNLINK', 'Errore durante la eliminazione della immagine: la immagine è stata eliminata nel database, ma si è verificato un errore durante la cancellazione della immagine');
// Watermark add/edit
\define('_CO_WGGALLERY_WATERMARK_ADD', 'Aggiungi Filigrana');
\define('_CO_WGGALLERY_WATERMARK_EDIT', 'Modifica Filigrana');
// Elements of Watermark
\define('_CO_WGGALLERY_WATERMARK', 'Filigrana');
\define('_CO_WGGALLERY_WATERMARKS', 'Filigrane');
\define('_CO_WGGALLERY_WATERMARK_ID', 'Id');
\define('_CO_WGGALLERY_WATERMARK_PREVIEW', 'Anteprima');
\define('_CO_WGGALLERY_WATERMARK_NAME', 'Nome');
\define('_CO_WGGALLERY_WATERMARK_TYPE', 'Tipo');
\define('_CO_WGGALLERY_WATERMARK_TYPETEXT', 'Usa testo');
\define('_CO_WGGALLERY_WATERMARK_TYPEIMAGE', 'Usa una immagine');
\define('_CO_WGGALLERY_WATERMARK_POSITION', 'Posizione');
\define('_CO_WGGALLERY_WATERMARK_POSTOPLEFT', 'In alto a sinistra');
\define('_CO_WGGALLERY_WATERMARK_POSTOPRIGHT', 'In alto a destra');
\define('_CO_WGGALLERY_WATERMARK_POSTOPCENTER', 'In alto al centro');
\define('_CO_WGGALLERY_WATERMARK_POSMIDDLELEFT', 'In mezzo a sinistra');
\define('_CO_WGGALLERY_WATERMARK_POSMIDDLERIGHT', 'In mezzo a destra');
\define('_CO_WGGALLERY_WATERMARK_POSMIDDLECENTER', 'In mezzo al centro');
\define('_CO_WGGALLERY_WATERMARK_POSBOTTOMLEFT', 'In basso a sinistra');
\define('_CO_WGGALLERY_WATERMARK_POSBOTTOMRIGHT', 'In basso a destra');
\define('_CO_WGGALLERY_WATERMARK_POSBOTTOMCENTER', 'In basso al centro');
\define('_CO_WGGALLERY_WATERMARK_USAGENONE', 'Attualmente non usata');
\define('_CO_WGGALLERY_WATERMARK_USAGEALL', 'Usa in tutti gli album');
\define('_CO_WGGALLERY_WATERMARK_USAGESINGLE', 'Definito in ogni album separatamente');
\define('_CO_WGGALLERY_WATERMARK_MARGIN', 'Margine');
\define('_CO_WGGALLERY_WATERMARK_MARGINLR', 'Sinistra/destra');
\define('_CO_WGGALLERY_WATERMARK_MARGINTB', 'Alto/basso');
\define('_CO_WGGALLERY_WATERMARK_IMAGE', 'Immagine');
\define('_CO_WGGALLERY_FORM_UPLOAD_IMAGE_WATERMARKS', 'Immagine in Caricamenti immagini');
\define('_CO_WGGALLERY_WATERMARK_TEXT', 'Testo');
\define('_CO_WGGALLERY_WATERMARK_FONT', 'Font');
\define('_CO_WGGALLERY_WATERMARK_FONTFAMILY', 'Famiglia di Font');
\define('_CO_WGGALLERY_WATERMARK_FONTSIZE', 'Dimensioni del Font');
\define('_CO_WGGALLERY_WATERMARK_COLOR', 'Colore');
\define('_CO_WGGALLERY_WATERMARK_USAGE', 'Uso');
\define('_CO_WGGALLERY_WATERMARK_TARGET', 'Tipo di immagini per aggiunta di filigrana');
\define('_CO_WGGALLERY_WATERMARK_TARGET_A', 'Aggiungi a tutte');
\define('_CO_WGGALLERY_WATERMARK_TARGET_M', 'Aggiungi alle medie');
\define('_CO_WGGALLERY_WATERMARK_TARGET_L', 'Aggiungi alle grandi');
// Elements of categories
\define('_CO_WGGALLERY_CAT', 'Categoria');
\define('_CO_WGGALLERY_CATS', 'Categorie');
\define('_CO_WGGALLERY_CATS_SELECT', 'Seleziona categorie');
// Elements of Tags
\define('_CO_WGGALLERY_TAG', 'Tag');
\define('_CO_WGGALLERY_TAGS', 'Tag');
\define('_CO_WGGALLERY_TAGS_ENTER', 'Inserisci tag (usa #)');
// Permissions
\define('_CO_WGGALLERY_PERMS_GLOBAL', 'Permessi globali');
\define('_CO_WGGALLERY_PERMS_GLOBAL_USECOLL', 'Permessi Globali per l\'uso di Collezioni di Album');
\define('_CO_WGGALLERY_PERMS_GLOBAL_USECOLL_DESC', "<ul><li>L'utente è autorizzato a raggruppare più album in una Collezione di album</li></ul>");
\define('_CO_WGGALLERY_PERMS_GLOBAL_SUBMITALL', 'Autorizzazioni globali per creare/modificare tutti gli album');
\define('_CO_WGGALLERY_PERMS_GLOBAL_SUBMITALL_DESC', 'Gruppi che hanno i permessi di  <ul><li>creare album</li><li>modificare tutti gli album</li><li>approvare tutti gli album</li><li>caricare le immagini in tutti gli album</li><li>approvare tutte le immagini</li></ul>');
\define('_CO_WGGALLERY_PERMS_GLOBAL_SUBMITOWN', 'Autorizzazioni globali per creare/modificare i propri album senza approvazione');
\define('_CO_WGGALLERY_PERMS_GLOBAL_SUBMITOWN_DESC', 'Gruppi che hanno i permessi di <ul><li>creare album</li><li>modificare i propri album</li><li>caricare immagini nei propri album</li></ul>');
\define('_CO_WGGALLERY_PERMS_GLOBAL_SUBMITAPPR', 'Autorizzazioni globali per creare/modificare i propri album solo con approvazione');
\define('_CO_WGGALLERY_PERMS_GLOBAL_SUBMITAPPR_DESC', 'Gruppi che hanno i permessi di <ul><li>creare albums</li><li>modificare i propri album</li><li>caricare immagini nei propri album</li></ul>');
\define('_CO_WGGALLERY_PERMS_GLOBAL_DESC', '<ul>
                                                <li>' . \_CO_WGGALLERY_PERMS_GLOBAL_USECOLL . ': ' . \_CO_WGGALLERY_PERMS_GLOBAL_USECOLL_DESC . '<br></li>
                                                <li>' . \_CO_WGGALLERY_PERMS_GLOBAL_SUBMITALL . ': ' . \_CO_WGGALLERY_PERMS_GLOBAL_SUBMITALL_DESC . '<br></li>
                                                <li>' . \_CO_WGGALLERY_PERMS_GLOBAL_SUBMITOWN . ': ' . \_CO_WGGALLERY_PERMS_GLOBAL_SUBMITOWN_DESC . '<br></li>
                                                <li>' . \_CO_WGGALLERY_PERMS_GLOBAL_SUBMITAPPR . ': ' . \_CO_WGGALLERY_PERMS_GLOBAL_SUBMITAPPR_DESC . '<br></li>
                                           </ul>');
\define('_CO_WGGALLERY_PERMS_ALB_VIEW', 'Autorizzazioni per visualizzare');
\define('_CO_WGGALLERY_PERMS_ALB_VIEW_DESC', 'Gruppi autorizzati a visualizzare un album');
\define('_CO_WGGALLERY_PERMS_ALB_DLFULLALB', 'Autorizzazioni per il download dell\'album completo');
\define('_CO_WGGALLERY_PERMS_ALB_DLFULLALB_DESC', 'Gruppi autorizzati a scaricare l\'intero album in una volta');
\define('_CO_WGGALLERY_PERMS_ALB_DLIMAGE_LARGE', 'Autorizzazioni per visualizzare/scaricare immagini grandi');
\define('_CO_WGGALLERY_PERMS_ALB_DLIMAGE_LARGE_DESC', 'Gruppi autorizzati a visualizzare e scaricare immagini grandi');
\define('_CO_WGGALLERY_PERMS_ALB_DLIMAGE_MEDIUM', 'Autorizzazioni per visualizzare/scaricare immagini medie');
\define('_CO_WGGALLERY_PERMS_ALB_DLIMAGE_MEDIUM_DESC', 'Gruppi autorizzati a visualizzare e scaricare immagini medie');
\define('_CO_WGGALLERY_PERMS_NOTSET', 'Nessuna autorizzazione impostata');
\define('_CO_WGGALLERY_PERMS_NODOWNLOAD', 'Non sei autorizzato a scaricare');
// exif
\define('_CO_WGGALLERY_EXIF', 'File originale dei dati Exif');
\define('_CO_WGGALLERY_EXIF_ALL', 'Mostra tutto');
\define('_CO_WGGALLERY_EXIF_FILENAME', 'Nome del file');
\define('_CO_WGGALLERY_EXIF_FILEDATETIME', 'Data del file');
\define('_CO_WGGALLERY_EXIF_FILESIZE', 'Dimensioni del file');
\define('_CO_WGGALLERY_EXIF_MIMETYPE', 'Tipo MIME');
\define('_CO_WGGALLERY_EXIF_CAMERA', 'Marchio fotocamera');
\define('_CO_WGGALLERY_EXIF_MODEL', 'Modello');
\define('_CO_WGGALLERY_EXIF_EXPTIME', 'Tempo di esposizione');
\define('_CO_WGGALLERY_EXIF_FOCALLENGTH', 'Lunghezza focale');
\define('_CO_WGGALLERY_EXIF_DATETIMEORIG', 'Data e ora originali');
\define('_CO_WGGALLERY_EXIF_ISO', 'Velocità ISO');
\define('_CO_WGGALLERY_EXIF_LENSMAKE', 'Marchio obiettivo');
\define('_CO_WGGALLERY_EXIF_LENSMODEL', 'Modello obiettivo');
// ---------------- Misc ----------------
\define('_CO_WGGALLERY_MAINTAINEDBY', 'Manutenzionato da');
\define('_CO_WGGALLERY_MAINTAINEDBY_DESC', 'Consenti URL del sito di supporto o della community');

$moduleDirName      = \basename(\dirname(\dirname(__DIR__)));
$moduleDirNameUpper = \mb_strtoupper($moduleDirName);

//Sample Data
\define('CO_' . $moduleDirNameUpper . '_' . 'ADD_SAMPLEDATA', 'Importa dati campione (eliminerà TUTTI i dati correnti)');
\define('CO_' . $moduleDirNameUpper . '_' . 'SAMPLEDATA_SUCCESS', 'Data ESEMPIO caricata correttamente');
\define('CO_' . $moduleDirNameUpper . '_' . 'SAVE_SAMPLEDATA', 'Esporta tabelle in YAML');
\define('CO_' . $moduleDirNameUpper . '_' . 'SHOW_SAMPLE_BUTTON', 'Mostra il pulsante ESEMPIO?');
\define('CO_' . $moduleDirNameUpper . '_' . 'SHOW_SAMPLE_BUTTON_DESC', 'In caso affermativo, il pulsante "Aggiungi dati di esempio" sarà visibile all\'amministratore. È Sì come predefinito per la prima installazione.');
\define('CO_' . $moduleDirNameUpper . '_' . 'EXPORT_SCHEMA', 'Esporta schema DB in YAML');
\define('CO_' . $moduleDirNameUpper . '_' . 'EXPORT_SCHEMA_SUCCESS', 'L\'esportazione dello Schema DB in YAML è avvenuta correttamente');
\define('CO_' . $moduleDirNameUpper . '_' . 'EXPORT_SCHEMA_ERROR', 'ERRORE: l\'esportazione dello schema DB in YAML non è riuscita');

//Menu
\define('CO_' . $moduleDirNameUpper . '_' . 'ADMENU_MIGRATE', 'Migrare');
\define('CO_' . $moduleDirNameUpper . '_' . 'FOLDER_YES', 'La cartella "%s" esiste');
\define('CO_' . $moduleDirNameUpper . '_' . 'FOLDER_NO', 'La cartella "%s" non esiste. Creare la cartella specificata con CHMOD 777.');
\define('CO_' . $moduleDirNameUpper . '_' . 'SHOW_DEV_TOOLS', 'Mostra il pulsante Strumenti di sviluppo?');
\define('CO_' . $moduleDirNameUpper . '_' . 'SHOW_DEV_TOOLS_DESC', 'In caso affermativo, la scheda "Migrare" e altri strumenti di sviluppo saranno visibili agli amministratori.');
\define('CO_' . $moduleDirNameUpper . '_' . 'ADMENU_FEEDBACK', 'Feedback');

//Latest Version Check
\define('CO_' . $moduleDirNameUpper . '_' . 'NEW_VERSION', 'Nuova versione: ');
\define('CO_' . $moduleDirNameUpper . '_' . 'ERROR_BAD_XOOPS', 'Necessita la versione minima %s (la tua versione attuale è %s)');
\define('CO_' . $moduleDirNameUpper . '_' . 'ERROR_BAD_PHP', 'Necessita la versione minima %s (la tua versione attuale è %s)');