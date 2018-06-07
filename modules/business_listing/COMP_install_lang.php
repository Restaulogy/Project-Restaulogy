<?PHP
/*
Copyright (c) 2005-2008, Wagon Trader (an Oregon USA business)
All rights reserved.

Redistribution and use in source and binary forms, with or without modification, 
are permitted provided that the following conditions are met:

Redistributions of source code must retain the above copyright notice, 
this list of conditions and the following disclaimer. 

Redistributions in binary form must reproduce the above copyright notice, 
this list of conditions and the following disclaimer in the documentation 
and/or other materials provided with the distribution.

All pages generated from the use of phpDirectorySource must contain the statement
"Powered by: phpDirectorySource" with an active link to http://www.phpdirectorysource.com,
unless a waiver is granted by the copyright holder.

Neither the name of Wagon Trader nor the names of its contributors may be used to endorse 
or promote products derived from this software without specific prior written permission. 

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS 
OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY 
AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR 
CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL 
DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, 
DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER 
IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT 
OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*/

// Configuration Settings
include ("configs/config.php");

// Database Connection Module
include ("modules/connect.php");

//************************************
// Days (day)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','day','day',10,'');") or die(mysql_error());
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','day','jour',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','day','día',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('day','en','1','Sunday',1,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('day','fr','1','Dimanche',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('day','sp','1','Domingo',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('day','en','2','Monday',2,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('day','fr','2','Lundi',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('day','sp','2','Lunes',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('day','en','3','Tuesday',3,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('day','fr','3','Mardi',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('day','sp','3','Martes',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('day','en','4','Wednesday',4,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('day','fr','4','Mercredi',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('day','sp','4','Miércoles',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('day','en','5','Thursday',5,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('day','fr','5','Jeudi',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('day','sp','5','Jueves',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('day','en','6','Friday',6,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('day','fr','6','Vendredi',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('day','sp','6','Viernes',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('day','en','7','Saturday',7,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('day','fr','7','Samedi',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('day','sp','7','Sábado',0,'');");


//************************************
// Months (month)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','month','month',10,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','month','mois',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','month','mes',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('month','en','1','January',1,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('month','fr','1','Janvier',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('month','sp','1','Enero',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('month','en','2','February',2,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('month','fr','2','Février',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('month','sp','2','Febrero',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('month','en','3','March',3,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('month','fr','3','Mars',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('month','sp','3','Marcha',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('month','en','4','April',4,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('month','fr','4','Avril',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('month','sp','4','Abril',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('month','en','5','May',5,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('month','fr','5','Mai',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('month','sp','5','Mayo',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('month','en','6','June',6,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('month','fr','6','Juin',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('month','sp','6','Junio',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('month','en','7','July',7,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('month','fr','7','Juillet',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('month','sp','7','Julio',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('month','en','8','August',8,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('month','fr','8','Août',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('month','sp','8','Agosto',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('month','en','9','September',9,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('month','fr','9','Septembre',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('month','sp','9','Septiembre',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('month','en','10','October',10,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('month','fr','10','Octobre',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('month','sp','10','Octubre',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('month','en','11','November',11,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('month','fr','11','Novembre',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('month','sp','11','Noviembre',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('month','en','12','December',12,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('month','fr','12','Décembre',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('month','sp','12','Diciembre',0,'');");

//************************************
//Site text (site_text)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','site_text','Site Text',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','site_text','Texte D\'Emplacement',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','site_text','Texto Del Sitio',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','en','charset','iso-8859-1',-1,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','fr','charset','iso-8859-1',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','sp','charset','iso-8859-1',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','en','main_title','Business Directory',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','fr','main_title','Annuaire commercial',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','sp','main_title','Directorio De Negocio',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','en','bread_home_link','Business Directory',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','fr','bread_home_link','Annuaire commercial',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','sp','bread_home_link','Directorio De Negocio',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','en','bread_img_alt','Home',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','fr','bread_img_alt','À la maison',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','sp','bread_img_alt','Casero',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','en','menu_title','Main Menu',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','fr','menu_title','Menu Principal',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','sp','menu_title','Menú Principal',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','en','site_logo1_alt','Your online business directory source',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','fr','site_logo1_alt','Votre source en ligne d\'annuaire commercial',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','sp','site_logo1_alt','Su fuente en línea del directorio de negocio',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','en','site_logo2_alt','phpMyDirectorySource - When the source matters',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','fr','site_logo2_alt','phpMyDirectorySource - Quand la source importe',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','sp','site_logo2_alt','phpMyDirectorySource - Cuando importa la fuente',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','en','site_copyright','Copyright 2005-2006 <font color=0066CC>php</font><font color=FFCC00>Directory</font><font color=0066CC>Source</font>&#8482;, all rights reserved',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','fr','site_copyright','Copyright 2005-2006 <font color=0066CC>php</font><font color=FFCC00>Directory</font><font color=0066CC>Source</font>&#8482;, tous droits réservés',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','sp','site_copyright','Copyright 2005-2006 <font color=0066CC>php</font><font color=FFCC00>Directory</font><font color=0066CC>Source</font>&#8482;, todos los derechos reservados',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','en','main_content_head','Welcome to the Business Directory',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','fr','main_content_head','Bienvenue à l\'annuaire commercial',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','sp','main_content_head','Recepción al directorio de negocio',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','en','main_content_foot','Let your keyboard do the walking',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','fr','main_content_foot','Laissez votre clavier faire la marche',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','sp','main_content_foot','Deje su teclado hacer caminar',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','en','login','Login',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','fr','login','Ouverture',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','sp','login','Conexión',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','en','password','Password',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','fr','password','Mot de passe',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','sp','password','Contraseña',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','en','parent','Parent',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','fr','parent','Parent',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','sp','parent','Padre',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','en','children','Children',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','fr','children','Enfants',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','sp','children','Niños',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','en','add','Add',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','fr','add','Ajoutez',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','sp','add','agregue',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','en','rename','Rename',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','fr','rename','Retitrez',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','sp','rename','Retitule',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','en','delete','Delete',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','fr','delete','Effacement',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','sp','delete','Cancelación',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','en','loc_level','Children are location level',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','fr','loc_level','Les enfants sont niveau d\'endroit',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','sp','loc_level','Los niños son nivel de la localización',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','en','reg_title','New User Registration',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','fr','reg_title','Nouvel Enregistrement D\'Utilisateur',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','sp','reg_title','Coloque su listado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','en','update','Update',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','fr','update','Mise à jour',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','sp','update','Actualización',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','en','pds_source','Powered by <a href=\"http://www.phpdirectorysource.com\">phpDirectorySource</a>',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','fr','pds_source','Actionné près <a href=\"http://www.phpdirectorysource.com\">phpDirectorySource</a>',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','sp','pds_source','Accionado cerca <a href=\"http://www.phpdirectorysource.com\">phpDirectorySource</a>',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','en','btn_statistics','Statistics',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','fr','btn_statistics','Statistiques',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','sp','btn_statistics','Estadística',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','en','btn_edit','Edit',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','fr','btn_edit','Éditez',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','sp','btn_edit','Corrija',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','en','terms_link','Terms of Use',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','fr','terms_link','Limites d\'utilisation',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','sp','terms_link','Términos del uso',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','en','privacy_link','Privacy Policy',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','fr','privacy_link','Politique D\'Intimité',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','sp','privacy_link','Política De Aislamiento',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','en','paypal_error','There was a problem with the Paypal payment',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','fr','paypal_error','Il y avait un problème avec le paiement de Paypal',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','sp','paypal_error','Había un problema con el pago de Paypal',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','en','next','Next',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','fr','next','Après',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','sp','next','Después',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','en','previous','Previous',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','fr','previous','Précédent',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','sp','previous','Anterior',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','en','first','First',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','fr','first','D\'abord',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','sp','first','Primero',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','en','last','Last',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','fr','last','Bout',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','sp','last','Último',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','en','select_language','Language',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','fr','select_language','Langue',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','sp','select_language','Lengua',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','en','select_template','Template',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','fr','select_template','Calibre',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','sp','select_template','Plantilla',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','en','no_list_found','No listings found in this category',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','fr','no_list_found','Liste n\'a pas trouvé dans cette catégorie',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('site_text','sp','no_list_found','Ningunos listados encontraron en esta categoría',0,'');");


//************************************
//Site Search (sitesearch)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','sitesearch','Site Search Text',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','sitesearch','Texte De Recherche D\'Emplacement',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','sitesearch','Texto De la Búsqueda Del Sitio',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitesearch','en','search_all','Search All Keywords',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitesearch','fr','search_all','Recherchez Tous les Mots-clés',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitesearch','sp','search_all','Busque Todas las Palabras claves',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitesearch','en','btn_go','Go',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitesearch','fr','btn_go','Allez',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitesearch','sp','btn_go','Vaya',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitesearch','en','keyword','Search Keyword(s)',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitesearch','fr','keyword','Mot-clé De Recherche',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitesearch','sp','keyword','Palabra clave De la Búsqueda',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitesearch','en','search_any','Search Any Keywords',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitesearch','fr','search_any','Recherchez Tous les Mots-clés',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitesearch','sp','search_any','Busque Cualquier Palabra clave',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitesearch','en','limit_range','Only show results',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitesearch','fr','limit_range','Montrez seulement les résultats',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitesearch','sp','limit_range','Demuestre solamente los resultados',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitesearch','en','within','within',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitesearch','fr','within','dans',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitesearch','sp','within','dentro',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitesearch','en','search_zip','miles of zip code',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitesearch','fr','search_zip','milles de code postal',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitesearch','sp','search_zip','millas del código postal',0,'');");


//************************************
//User Page (user)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','user','User Contol Panel',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','user','Panneau De Contol D\'Utilisateur',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','user','Panel De Contol Del Usuario',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','en','need_acct','Need an account?',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','fr','need_acct','Ayez besoin d\'un compte ?',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','sp','need_acct','¿Necesite una cuenta?',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','en','title_tag','User Control Panel',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','fr','title_tag','Panneau De Commande D\'Utilisateur',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','sp','title_tag','Panel De Control Del Usuario',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','en','breadcrumb','Control Panel',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','fr','breadcrumb','Panneau De Commande',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','sp','breadcrumb','Panel De Control',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','en','title','Login to your account',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','fr','title','Ouverture à votre compte',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','sp','title','Conexión a su cuenta',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','en','btn_login','Login',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','fr','btn_login','Ouverture',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','sp','btn_login','Conexión',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','en','btn_stats','Statistics',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','fr','btn_stats','Statistiques',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','sp','btn_stats','Estadística',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','en','btn_edit','Edit',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','fr','btn_edit','Éditez',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','sp','btn_edit','Corrija',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','en','btn_upgrade','Membership',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','fr','btn_upgrade','Adhésion',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','sp','btn_upgrade','Calidad de miembro',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','en','bad_login','The login or password provided is invalid',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','fr','bad_login','L\'ouverture ou le mot de passe fourni est inadmissible',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','sp','bad_login','La conexión o la contraseña proporcionada es inválida',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','en','reg_here','Register Here',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','fr','reg_here','Registre Ici',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','sp','reg_here','Registro Aquí',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','en','pass_changed','Your password has been changed',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','fr','pass_changed','Votre mot de passe a été changé',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','sp','pass_changed','Se ha cambiado su contraseña',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','en','reset_mail_sent','Your new password has been sent to your e-mail address',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','fr','reset_mail_sent','Votre nouveau mot de passe a été envoyé à votre adresse de E-mail',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','sp','reset_mail_sent','Su nueva contraseña se ha enviado a su dirección del E-mail',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','en','reset_bad_user','The login you supplied is incorrect',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','fr','reset_bad_user','L\'ouverture que vous avez fournie est incorrecte',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','sp','reset_bad_user','La conexión que usted proveió es incorrecta',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','en','reset_no_user','You must supply your login name',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','fr','reset_no_user','Vous devez fournir votre nom d\'ouverture',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','sp','reset_no_user','Usted debe proveer su nombre de la conexión',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','en','btn_pass_reset','Forgot password? Reset it',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','fr','btn_pass_reset','A oublié le mot de passe ? Remettez- à zérole',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','sp','btn_pass_reset','¿Se olvidó de contraseña? Reajústela',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','en','pw_title','Change Password',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','fr','pw_title','Changez Le Mot de passe',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','sp','pw_title','Cambie La Contraseña',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','en','c_pass','Current Password',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','fr','c_pass','Mot de passe Courant',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','sp','c_pass','Contraseña Actual',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','en','new_pass','New Password',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','fr','new_pass','Nouveau Mot de passe',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','sp','new_pass','Nueva Contraseña',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','en','v_pass','Verify New Password',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','fr','v_pass','Vérifiez Le Nouveau Mot de passe',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','sp','v_pass','Verifique La Nueva Contraseña',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','en','btn_change_pw','Change Password',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','fr','btn_change_pw','Changez Le Mot de passe',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','sp','btn_change_pw','Cambie La Contraseña',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','en','change_pass','Change Password',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','fr','change_pass','Changez Le Mot de passe',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','sp','change_pass','Cambie La Contraseña',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','en','no_list_found','No listings found',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','fr','no_list_found','Aucunes listes trouvées',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('user','sp','no_list_found','Ningunos listados encontrados',0,'');");


//************************************
//Edit User Page (eduser)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','eduser','Edit User',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','eduser','Éditez L\'Utilisateur',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','eduser','Corrija A Usuario',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('eduser','en','title','Edit User',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('eduser','fr','title','Éditez L\'Utilisateur',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('eduser','sp','title','Corrija A Usuario',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('eduser','en','title_tag','User List',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('eduser','fr','title_tag','Liste utilisateurs',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('eduser','sp','title_tag','Lista De Usuario',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('eduser','en','breadcrumb','User List',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('eduser','fr','breadcrumb','Liste utilisateurs',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('eduser','sp','breadcrumb','Lista De Usuario',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('eduser','en','title_view','View User Listings',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('eduser','fr','title_view','Listes D\'Utilisateur De Vue',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('eduser','sp','title_view','Listados Del Usuario De la Visión',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('eduser','en','joined','Joined',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('eduser','fr','joined','Jointif',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('eduser','sp','joined','Ensamblado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('eduser','en','total_list','Number of Listings',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('eduser','fr','total_list','Nombre de listes',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('eduser','sp','total_list','Número de listados',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('eduser','en','btn_change','Change',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('eduser','fr','btn_change','Changement',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('eduser','sp','btn_change','Cambio',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('eduser','en','btn_delete','Delete',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('eduser','fr','btn_delete','Effacement',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('eduser','sp','btn_delete','Quite',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('eduser','en','btn_add','Add',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('eduser','fr','btn_add','Ajoutez',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('eduser','sp','btn_add','Agregue',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('eduser','en','btn_new','New',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('eduser','fr','btn_new','Nouveau',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('eduser','sp','btn_new','Nuevo',0,'');");


//************************************
//Admin Page (admin)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','admin','Admin Control Panel',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','admin','Panneau De Commande D\'Admin',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','admin','Panel De Control Del Admin',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','en','stat_list_sub','Listings Submitted',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','fr','stat_list_sub','Listes Soumises',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','sp','stat_list_sub','Los Listados Sometieron',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','en','stat_list_act','Listings Active',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','fr','stat_list_act','Listes Actives',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','sp','stat_list_act','Listados Activos',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','en','title','Admin Control Panel',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','fr','title','Panneau De Commande D\'Admin',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','sp','title','Panel De Control Del Admin',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','en','stats','Statistics',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','fr','stats','Statistiques',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','sp','stats','Estadística',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','en','page_title','Admin Control Panel',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','fr','page_title','Panneau De Commande D\'Admin',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','sp','page_title','Panel De Control Del Admin',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','en','btn_login','Login',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','fr','btn_login','Ouverture',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','sp','btn_login','Conexión',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','en','login_title','Admin Login',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','sp','login_title','Conexión Del Admin',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','fr','login_title','Ouverture D\'Admin',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','en','stat_cat_tot','Total Categories',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','fr','stat_cat_tot','Catégories Totales',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','sp','stat_cat_tot','Categorías Totales',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','en','stat_cat_on','Categories With Listings',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','fr','stat_cat_on','Catégories Avec Des Listes',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','sp','stat_cat_on','Categorías Con Los Listados',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','en','stat_list_del','Listings Deleted',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','fr','stat_list_del','Listes Supprimées',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','sp','stat_list_del','Listados Suprimidos',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','en','stat_user','Total Users',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','fr','stat_user','Utilisateurs Totaux',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','sp','stat_user','Usuarios Totales',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','en','breadcrumb','Admin Control Panel',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','fr','breadcrumb','Panneau De Commande D\'Admin',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','sp','breadcrumb','Panel De Control Del Admin',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','en','stat_cat_off','Categories Without Listings',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','fr','stat_cat_off','Catégories Sans Listes',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','sp','stat_cat_off','Categorías Sin Los Listados',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','en','bad_login','The login or password provided is invalid',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','fr','bad_login','L\'ouverture ou le mot de passe fourni est inadmissible',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','sp','bad_login','La conexión o la contraseña proporcionada es inválida',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','en','mods','Modules',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','fr','mods','Modules',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','sp','mods','Módulos',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','en','version','Ver.',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','fr','version','Ver.',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','sp','version','Ver.',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','en','installed','installed on',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','fr','installed','installé dessus',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','sp','installed','instalado encendido',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','en','installed_by','by',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','fr','installed_by','par',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','sp','installed_by','por',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','en','pass_changed','Your password has been changed',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','fr','pass_changed','Votre mot de passe a été changé',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','sp','pass_changed','Se ha cambiado su contraseña',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','en','pw_title','Change Password',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','fr','pw_title','Changez Le Mot de passe',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','sp','pw_title','Cambie La Contraseña',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','en','c_pass','Current Password',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','fr','c_pass','Mot de passe Courant',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','sp','c_pass','Contraseña Actual',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','en','new_pass','New Password',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','fr','new_pass','Nouveau Mot de passe',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','sp','new_pass','Nueva Contraseña',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','en','v_pass','Verify New Password',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','fr','v_pass','Vérifiez Le Nouveau Mot de passe',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','sp','v_pass','Verifique La Nueva Contraseña',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','en','btn_change_pw','Change Password',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','fr','btn_change_pw','Changez Le Mot de passe',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','sp','btn_change_pw','Cambie La Contraseña',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','en','change_pass','Change Password',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','fr','change_pass','Changez Le Mot de passe',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('admin','sp','change_pass','Cambie La Contraseña',0,'');");


//************************************
//Listings Table (pds_list)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','pds_list','Listing Fields',1,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','pds_list','Champs De Liste',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','pds_list','Campos Del Listado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','en','d_upgrade','Date Upgraded',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','fr','d_upgrade','Date Améliorée',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','sp','d_upgrade','La Fecha Aumentó',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','en','d_update','Date Updated',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','fr','d_update','Date Mise à jour',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','sp','d_update','Fecha Puesta al día',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','en','d_review','Date Reviewed',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','fr','d_review','Date Passée en revue',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','sp','d_review','Fecha Repasada',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','en','review_by','Reviewed By',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','fr','review_by','Passé en revue Près',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','sp','review_by','Repasado Cerca',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','en','d_submit','Date Submitted',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','fr','d_submit','La Date A soumis',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','sp','d_submit','La Fecha Sometió',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','en','email','E-mail',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','fr','email','E-mail',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','sp','email','E-mail',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','en','description','Description',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','fr','description','Description',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','sp','description','Descripción',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','en','mobile','Mobile',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','fr','mobile','Mobile',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','sp','mobile','Móvil',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','en','fax','Fax',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','fr','fax','Fax',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','sp','fax','Fax',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','en','phone','Phone',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','fr','phone','Téléphone',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','sp','phone','Teléfono',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','en','contact','Contact',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','fr','contact','Contact',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','sp','contact','Contacto',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','en','zip','Postal Code',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','fr','zip','Code postal',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','sp','zip','Código postal',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','en','location','Location',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','fr','location','Endroit',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','sp','location','Localización',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','en','address2','Address Line 2',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','fr','address2','Ligne 2 D\'Adresse',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','sp','address2','Línea 2 De la Dirección',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','en','address1','Mailing Address',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','fr','address1','Adresse D\'Expédition',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','sp','address1','Dirección Que envía',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','en','address','Address',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','fr','address','Adresse',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','sp','address','Dirección',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','en','firm','Firmname',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','fr','firm','Firmname',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','sp','firm','Firmname',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','en','level','Membership Level',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','fr','level','Niveau D\'Adhésion',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','sp','level','Nivel De la Calidad de miembro',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','en','state','Listing State',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','fr','state','État De Liste',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','sp','state','Estado Del Listado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','en','userid','User ID',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','fr','userid','Identification de l\'utilisateur',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','sp','userid','Identificación del usuario',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','en','id','ID',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','fr','id','Identification',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','sp','id','Identificación',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','en','xtra_1','Extra Field One',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','fr','xtra_1','Champ Supplémentaire Un',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','sp','xtra_1','Campo Adicional Uno',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','en','xtra_2','Extra Field Two',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','fr','xtra_2','Champ Supplémentaire Deux',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','sp','xtra_2','Campo Adicional Dos',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','en','xtra_3','Extra Field Three',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','fr','xtra_3','Champ Supplémentaire Trois',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','sp','xtra_3','Campo Adicional Tres',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','en','xtra_4','Extra Field Four',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','fr','xtra_4','Champ Supplémentaire Quatre',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','sp','xtra_4','Campo Adicional Cuatro',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','en','xtra_5','Extra Field Five',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','fr','xtra_5','Champ Supplémentaire Cinq',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','sp','xtra_5','Campo Adicional Cinco',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','en','xtra_6','Extra Field Six',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','fr','xtra_6','Champ Supplémentaire Six',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','sp','xtra_6','Campo Adicional Seises',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','en','website','Website',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','fr','website','Site Web',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','sp','website','Website',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','en','loc1','Street Address',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','fr','loc1','Adresse De Rue',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','sp','loc1','Dirección De la Calle',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','en','premium','Premium',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','fr','premium','De la meilleure qualité',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','sp','premium','Superior',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','en','loc_sel','Location Select',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','fr','loc_sel','Endroit Choisi',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_list','sp','loc_sel','Localización Selecta',0,'');");


//************************************
//Listings Category Table (pds_listcat)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','pds_listcat','Listings in Category Table',1,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','pds_listcat','Listes dans le Tableau de catégorie',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','pds_listcat','Listados en tabla de la categoría',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_listcat','en','list_id','Listing ID',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_listcat','fr','list_id','Identification De Liste',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_listcat','sp','list_id','Identificación Del Listado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_listcat','en','cat_id','Category ID',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_listcat','fr','cat_id','Identification De Catégorie',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_listcat','sp','cat_id','Identificación De la Categoría',0,'');");


//************************************
//Manage Listings Page (manlist)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','manlist','Manage Listings Text',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','manlist','Contrôlez Le Texte De Listes',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','manlist','Maneje El Texto De los Listados',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','en','title','Manage Listings',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','fr','title','Contrôlez Les Listes',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','sp','title','Maneje Los Listados',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','en','breadcrumb','Manage Listings',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','fr','breadcrumb','Contrôlez Les Listes',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','sp','breadcrumb','Maneje Los Listados',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','en','btn_go','Go',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','fr','btn_go','Allez',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','sp','btn_go','Vaya',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','en','radio_state','Listing State',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','fr','radio_state','État De Liste',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','sp','radio_state','Estado Del Listado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','en','radio_apr','Approved',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','fr','radio_apr','Approuvé',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','sp','radio_apr','Aprobado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','en','radio_upd','Updated',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','fr','radio_upd','Mis à jour',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','sp','radio_upd','Actualizado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','en','radio_sub','Submitted',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','fr','radio_sub','Soumis',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','sp','radio_sub','Sometido',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','en','radio_del','Deleted',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','fr','radio_del','Supprimé',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','sp','radio_del','Suprimido',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','en','btn_approve','Approve',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','fr','btn_approve','Approuvez',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','sp','btn_approve','Apruebe',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','en','btn_disapprove','Disapprove',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','fr','btn_disapprove','Désapprouvez',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','sp','btn_disapprove','Desapruebe',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','en','btn_remove','Remove',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','fr','btn_remove','Enlevez',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','sp','btn_remove','Quite',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','en','btn_edit','Edit',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','fr','btn_edit','Éditez',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','sp','btn_edit','Corrija',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','en','title_tag','Manage Listings',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','fr','title_tag','Contrôlez Les Listes',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','sp','title_tag','Maneje Los Listados',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','en','btn_level','Update Membership',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','fr','btn_level','Adhésion De Mise à jour',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','sp','btn_level','Calidad de miembro De la Actualización',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','en','any_state','Any State',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','fr','any_state','Toute condition',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','sp','any_state','Cualquie condición',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','en','any_level','Any Level',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','fr','any_level','Tout niveau',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','sp','any_level','Cualquie nivel',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','en','any_user','Any User',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','fr','any_user','Tout utilisateur',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','sp','any_user','Cualquie usuario',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','en','btn_search','Find',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','fr','btn_search','Trouvaille',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','sp','btn_search','Hallazgo',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','en','s_firm','Firm',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','fr','s_firm','Nom de compagnie',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','sp','s_firm','Nombre de compañía',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','en','s_id','Listing ID',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','fr','s_id','Identification de liste',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('manlist','sp','s_id','Identificación del listado',0,'');");


//************************************
//Site Images (image)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','image','Image',3,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','image','Image',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','image','Imagen',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('image','en','logo1','logo1.gif',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('image','fr','logo1','logo1fr.gif',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('image','sp','logo1','logo1sp.gif',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('image','en','logo2','logo2.gif',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('image','fr','logo2','logo2fr.gif',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('image','sp','logo2','logo2sp.gif',0,'');");


//************************************
//Category Content (cat_content)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','cat_content','Category Content',2,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','cat_content','Contenu De Catégorie',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','cat_content','Contenido De la Categoría',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('cat_content','en','cat1h','This is a special header for category one:',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('cat_content','fr','cat1h','C\'est un en-tête spécial pour la catégorie une :',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('cat_content','sp','cat1h','Esto es un jefe especial para la categoría una:',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('cat_content','en','cat1f','This is a special footer for category one',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('cat_content','fr','cat1f','C\'est un titre de bas de page spécial pour la catégorie une',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('cat_content','sp','cat1f','Esto es un pie especial para la categoría una',0,'');");


//************************************
//Admin Menu (adminmenu)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','adminmenu','Admin Menu',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','adminmenu','Menu D\'Admin',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','adminmenu','Menú Del Admin',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('adminmenu','en','edexp','Expiration Periods',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('adminmenu','fr','edexp','Périodes D\'Expiration',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('adminmenu','sp','edexp','Períodos De la Expiración',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('adminmenu','en','eduser','User List',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('adminmenu','fr','eduser','Liste utilisateurs',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('adminmenu','sp','eduser','Lista De Usuario',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('adminmenu','en','edlevel','Membership Levels',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('adminmenu','fr','edlevel','Niveaux D\'Adhésion',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('adminmenu','sp','edlevel','Niveles De la Calidad de miembro',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('adminmenu','en','title','Admin Menu',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('adminmenu','fr','title','Menu D\'Admin',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('adminmenu','sp','title','Menú Del Admin',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('adminmenu','en','home','Home',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('adminmenu','fr','home','À la maison',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('adminmenu','sp','home','Casero',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('adminmenu','en','edcat','Categories',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('adminmenu','fr','edcat','Catégories',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('adminmenu','sp','edcat','Categorías',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('adminmenu','en','edloc','Location Selects',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('adminmenu','fr','edloc','L\'Endroit Choisit',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('adminmenu','sp','edloc','La Localización Selecciona',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('adminmenu','en','edlang','Language Panel',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('adminmenu','fr','edlang','Panneau De Langue',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('adminmenu','sp','edlang','Panel De la Lengua',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('adminmenu','en','admin','Admin Panel',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('adminmenu','fr','admin','Panneau D\'Admin',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('adminmenu','sp','admin','Panel Del Admin',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('adminmenu','en','logout','logout',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('adminmenu','fr','logout','déconnexion',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('adminmenu','sp','logout','registro de estado de la máquina',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('adminmenu','en','manlist','Manage Listings',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('adminmenu','fr','manlist','Contrôlez Les Listes',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('adminmenu','sp','manlist','Maneje Los Listados',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('adminmenu','en','import','Import',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('adminmenu','fr','import','Importation',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('adminmenu','sp','import','Importación',0,'');");


//************************************
//Location Slave Set (location)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','location','Location',9,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','location','Endroit',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','location','Localización',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_admin','en','location','slave=1',0,'');");


//************************************
//Site Menu (sitemenu)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','sitemenu','Site Menu',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','sitemenu','Menu D\'Emplacement',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','sitemenu','Menú Del Sitio',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitemenu','en','title','Main Menu',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitemenu','fr','title','Menu Principal',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitemenu','sp','title','Menú Principal',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitemenu','en','home','Home',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitemenu','fr','home','À la maison',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitemenu','sp','home','Casero',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitemenu','en','user','User Panel',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitemenu','fr','user','Panneau D\'Utilisateur',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitemenu','sp','user','Panel Del Usuario',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitemenu','en','register','Add your listing',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitemenu','fr','register','Ajoutez votre liste',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitemenu','sp','register','Agregue su listado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitemenu','en','compare','Compare Memberships',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitemenu','fr','compare','Comparez Les Adhésions',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitemenu','sp','compare','Compare Las Calidades de miembro',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitemenu','en','admin','Admin Panel',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitemenu','fr','admin','Panneau D\'Admin',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitemenu','sp','admin','Panel Del Admin',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitemenu','en','logout','logout',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitemenu','fr','logout','déconnexion',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitemenu','sp','logout','registro de estado de la máquina',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitemenu','en','contact','Contact Us',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitemenu','fr','contact','Contactez-Nous',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('sitemenu','sp','contact','Éntrenos en contacto con',0,'');");


//************************************
//Edit Membership Level page (edlevel)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','edlevel','Edit Level Text',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','edlevel','Éditez Le Texte De niveau',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','edlevel','Corrija El Texto Llano',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','en','add_title','Add Membership Level',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','fr','add_title','Ajoutez Le Niveau D\'Adhésion',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','sp','add_title','Agregue El Nivel De la Calidad de miembro',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','en','btn_add','Add',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','fr','btn_add','Ajoutez',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','sp','btn_add','Agregue',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','en','btn_delete','Delete',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','fr','btn_delete','Effacement',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','sp','btn_delete','Quite',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','en','btn_change','Change',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','fr','btn_change','Changement',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','sp','btn_change','Cambio',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','en','breadcrumb','Membership Levels',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','fr','breadcrumb','Niveaux D\'Adhésion',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','sp','breadcrumb','Niveles De la Calidad de miembro',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','en','title_tag','Membership Levels',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','fr','title_tag','Niveaux D\'Adhésion',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','sp','title_tag','Niveles De la Calidad de miembro',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','en','change_title','Change Membership Level',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','fr','change_title','Changez Le Niveau D\'Adhésion',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','sp','change_title','Cambie El Nivel De la Calidad de miembro',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','en','delete_confirm','Please confirm deleting membership level',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','fr','delete_confirm','Veuillez confirmer supprimer le niveau d\'adhésion',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','sp','delete_confirm','Confirme por favor suprimir el nivel de la calidad de miembro',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','en','btn_confirm','Confirm',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','fr','btn_confirm','Confirmez',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','sp','btn_confirm','Confirme',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','en','btn_cancel','Cancel',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','fr','btn_cancel','Annulation',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','sp','btn_cancel','Cancelación',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','en','error_level','Please specify membership level',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','fr','error_level','Veuillez indiquer le niveau d\'adhésion',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','sp','error_level','Especifique por favor el nivel de la calidad de miembro',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','en','error_title','Please specify membership title',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','fr','error_title','Veuillez indiquer le titre d\'adhésion',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','sp','error_title','Especifique por favor el título de la calidad de miembro',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','en','level_added','Membership Level Added',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','fr','level_added','Le Niveau D\'Adhésion S\'est ajouté',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','sp','level_added','Nivel De la Calidad de miembro Agregado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','en','level_changed','Membership Level Changed',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','fr','level_changed','Niveau D\'Adhésion Changé',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','sp','level_changed','Nivel De la Calidad de miembro Cambiante',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','en','level_deleted','Membership Level Deleted',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','fr','level_deleted','Niveau D\'Adhésion Supprimé',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','sp','level_deleted','Nivel De la Calidad de miembro Suprimido',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','en','btn_new','New',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','fr','btn_new','Nouveau',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlevel','sp','btn_new','Nuevo',0,'');");


//************************************
//Location Level (loc_level)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','loc_level','Location Level',9,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','loc_level','Niveau D\'Endroit',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','loc_level','Nivel De la Localización',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('loc_level','en','0','None',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('loc_level','fr','0','Aucun',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('loc_level','sp','0','Ninguno',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('loc_level','en','1','Country',1,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('loc_level','fr','1','Pays',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('loc_level','sp','1','País',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('loc_level','en','2','State',2,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('loc_level','fr','2','État',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('loc_level','sp','2','Estado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('loc_level','en','3','County',3,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('loc_level','fr','3','Comté',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('loc_level','sp','3','Condado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('loc_level','en','4','City',4,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('loc_level','fr','4','Ville',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('loc_level','sp','4','Ciudad',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('loc_level','en','5','Community',5,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('loc_level','fr','5','La Communauté',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('loc_level','sp','5','Comunidad',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('loc_level','en','6','Postal Code',6,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('loc_level','fr','6','Code Postal',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('loc_level','sp','6','Código Postal',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('loc_level','en','7','Territory',7,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('loc_level','fr','7','Territoire',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('loc_level','sp','7','Territorio',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('loc_level','en','8','Region',8,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('loc_level','fr','8','Région',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('loc_level','sp','8','Región',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('loc_level','en','9','Province',9,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('loc_level','fr','9','Province',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('loc_level','sp','9','Provincia',0,'');");

// new ver 1.1
//************************************
//Error Text (error_text)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','error_text','Error Messages',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','error_text','Messages D\'Erreur',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','error_text','Mensajes De Error',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_no_from','Your e-mail address is empty',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_no_from','Votre adresse de E-mail est vide',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_no_from','Su dirección del E-mail es vacía',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_no_addr','Mailing address is empty',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_no_addr','L\'adresse d\'expédition est vide',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_no_addr','La dirección que envía es vacía',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_no_firm','Firm name is empty',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_no_firm','Le nom ferme est vide',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_no_firm','El nombre firme es vacío',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_user_used','Login already in use, please select another',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_user_used','L\'ouverture déjà en service, choisissent svp des autres',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_user_used','La conexión ya en uso, selecciona por favor otro',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_user_spaces','Login can not contain spaces',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_user_spaces','L\'ouverture ne peut pas contenir les espaces',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_user_spaces','La conexión no puede contener espacios',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_user_squotes','Login can not contain single quotes',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_user_squotes','L\'ouverture ne peut pas contenir des citations simples',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_user_squotes','La conexión no puede contener apóstrofes',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_user_dquotes','Login can not contain double quotes',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_user_dquotes','L\'ouverture ne peut pas contenir de doubles citations',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_user_dquotes','La conexión no puede contener cotizaciones dobles',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_user_commas','Login can not contain commas',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_user_commas','L\'ouverture ne peut pas contenir des virgules',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_user_commas','La conexión no puede contener comas',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_pass_empty','Password is empty',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_pass_empty','Le mot de passe est vide',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_pass_empty','La contraseña es vacía',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_pass_short','Password must contain at least 4 characters',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_pass_short','Le mot de passe doit contenir au moins 4 caractères',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_pass_short','La contraseña debe contener por lo menos 4 caracteres',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_pass_spaces','Password can not contain spaces',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_pass_spaces','Le mot de passe ne peut pas contenir les espaces',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_pass_spaces','La contraseña no puede contener espacios',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_pass_squotes','Password can not contain single quotes',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_pass_squotes','Le mot de passe ne peut pas contenir des citations simples',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_pass_squotes','La contraseña no puede contener apóstrofes',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_pass_dquotes','Password can not contain double quotes',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_pass_dquotes','Le mot de passe ne peut pas contenir de doubles citations',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_pass_dquotes','La contraseña no puede contener cotizaciones dobles',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_pass_commas','Password can not contain commas',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_pass_commas','Le mot de passe ne peut pas contenir des virgules',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_pass_commas','La contraseña no puede contener comas',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_pass_mismatch','Verification password does not match',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_pass_mismatch','Le mot de passe de vérification ne s\'assortit pas',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_pass_mismatch','La contraseña de la verificación no empareja',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_mail_empty','E-mail address is empty',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_mail_empty','L\'adresse de E-mail est vide',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_mail_empty','La dirección del E-mail es vacía',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_no_xtra6','Extra six is empty',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_no_xtra6','Six supplémentaires est vide',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_no_xtra6','Seises adicionales es vacíos',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_no_xtra4','Extra four is empty',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_no_xtra4','Quatre supplémentaires est vide',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_no_xtra4','Cuatro adicionales es vacíos',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_no_xtra2','Extra two is empty',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_no_xtra2','Deux supplémentaires est vide',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_no_xtra2','Dos adicionales es vacíos',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_no_mail','Listing e-mail is empty',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_no_mail','Le E-mail de liste est vide',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_no_mail','El E-mail del listado es vacío',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_no_fax','Fax is empty',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_no_fax','Le fax est vide',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_no_fax','El fax es vacío',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_no_zip','Postal Code is empty',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_no_zip','Le code postal est vide',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_no_zip','El código postal es vacío',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_no_cont','Contact is empty',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_no_cont','Le contact est vide',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_no_cont','El contacto es vacío',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_no_web','Website is empty',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_no_web','L\'emplacement de Web est vide',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_no_web','El sitio del Web es vacío',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_no_cat','No categories selected',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_no_cat','Aucunes catégories choisies',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_no_cat','Ningunas categorías seleccionaron',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_mail_bad','Supplied e-mail address is not valid',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_mail_bad','L\'adresse fournie de E-mail est inadmissible',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_mail_bad','La dirección provista del E-mail es inválida',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_user_short','Login must be at lease 4 characters',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_user_short','L\'ouverture doit être aux caractères du bail 4',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_user_short','La conexión debe estar en los caracteres del arriendo 4',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_no_message','Message is empty',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_no_message','Le message est vide',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_no_message','El mensaje es vacío',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_no_subject','Subject is empty',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_no_subject','Le sujet est vide',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_no_subject','El tema es vacío',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_no_xtra5','Extra five is empty',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_no_xtra5','Cinq supplémentaires est vide',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_no_xtra5','Cinco adicionales es vacíos',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_no_xtra3','Extra three is empty',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_no_xtra3','Trois supplémentaires est vide',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_no_xtra3','Tres adicionales es vacíos',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_no_xtra1','Extra One is empty',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_no_xtra1','L\'supplémentaire est vide',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_no_xtra1','El adicional es vacío',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_no_mob','Mobile phone is empty',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_no_mob','Le mobilophone est vide',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_no_mob','El teléfono móvil es vacío',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_no_phone','Phone number is empty',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_no_phone','Le numéro de téléphone est vide',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_no_phone','El número de teléfono es vacío',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_no_loc1','Street Address is empty',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_no_loc1','L\'adresse de rue est vide',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_no_loc1','La dirección de la calle es vacía',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_no_desc','Description is empty',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_no_desc','La description est vide',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_no_desc','La descripción es vacía',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_sel_level','Please select a membership level',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_sel_level','Veuillez choisir un niveau d\'adhésion',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_sel_level','Seleccione por favor un nivel de la calidad de miembro',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_no_agree','You must read and agree to the terms of use',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_no_agree','Vous devez lire et être d\'accord sur les limites de l\'utilisation',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_no_agree','Usted debe leer y convenir los términos del uso',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_mail_used','E-mail address already used, please select another',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_mail_used','L\'adresse de E-mail déjà utilisée, choisissent svp des autres',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_mail_used','La dirección del E-mail usada ya, selecciona por favor otra',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_user_empty','Login is empty',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_user_empty','L\'ouverture est vide',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_user_empty','La conexión es vacía',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_bad_cpass','Current password is incorrect',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_bad_cpass','Le mot de passe courant est incorrect',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_bad_cpass','La contraseña actual es incorrecta',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_bad_from','Your e-mail address is not valid',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_bad_from','Votre adresse de E-mail est inadmissible',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_bad_from','Su dirección del E-mail es inválida',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_no_refer','Your friends e-mail address is empty',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_no_refer','Votre adresse de E-mail d\'amis est vide',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_no_refer','Su dirección del E-mail de los amigos es vacía',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','en','error_bad_refer','Your friends e-mail address is not valid',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','fr','error_bad_refer','Votre adresse de E-mail d\'amis est inadmissible',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('error_text','sp','error_bad_refer','Su dirección del E-mail de los amigos es inválida',0,'');");
//end new ver 1.1

//************************************
//Membership Level Table (pds_level)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','pds_level','Level Table Fields',1,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','pds_level','Gisements De niveau De Tableau',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','pds_level','Campos Llanos De la Tabla',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','en','loc1','Directions',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','fr','loc1','Directions',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','sp','loc1','Direcciones',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','en','level','Level',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','fr','level','Niveau',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','sp','level','Nivel',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','en','title','Title',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','fr','title','Titre',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','sp','title','Título',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','en','cost','Cost',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','fr','cost','Coût',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','sp','cost','Coste',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','en','expire','Expiration',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','fr','expire','Expiration',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','sp','expire','Expiración',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','en','expire_period','Expiration Period',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','fr','expire_period','Période D\'Expiration',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','sp','expire_period','Período De la Expiración',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','en','description','Description',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','fr','description','Description',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','sp','description','Descripción',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','en','address','Address',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','fr','address','Adresse',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','sp','address','Dirección',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','en','addr1','Address Line One',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','fr','addr1','Ligne Une D\'Adresse',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','sp','addr1','Línea Una De la Dirección',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','en','addr2','Address Line Two',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','fr','addr2','Ligne Deux D\'Adresse',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','sp','addr2','Línea Dos De la Dirección',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','en','zip','Zipcode',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','fr','zip','Code postal',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','sp','zip','Código postal',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','en','contact','Contact',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','fr','contact','Contact',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','sp','contact','Contacto',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','en','phone','Phone',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','fr','phone','Téléphone',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','sp','phone','Teléfono',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','en','fax','Fax',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','fr','fax','Fax',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','sp','fax','Fax',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','en','mobile','Mobile',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','fr','mobile','Mobile',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','sp','mobile','Móvil',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','en','listmail','E-mail',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','fr','listmail','E-mail',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','sp','listmail','E-mail',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','en','cats','Categories',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','fr','cats','Catégories',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','sp','cats','Categorías',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','en','xtra_1','Extra One',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','fr','xtra_1','L\'Supplémentaire',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','sp','xtra_1','El Adicional',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','en','xtra_2','Extra Two',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','fr','xtra_2','Deux Supplémentaires',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','sp','xtra_2','Dos Adicionales',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','en','xtra_3','Extra Three',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','fr','xtra_3','Trois Supplémentaires',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','sp','xtra_3','Tres Adicionales',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','en','xtra_4','Extra Four',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','fr','xtra_4','Quatre Supplémentaires',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','sp','xtra_4','Cuatro Adicionales',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','en','xtra_5','Extra Five',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','fr','xtra_5','Cinq Supplémentaires',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','sp','xtra_5','Cinco Adicionales',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','en','xtra_6','Extra Six',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','fr','xtra_6','Six Supplémentaires',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','sp','xtra_6','Seises Adicionales',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','en','logo','Logo',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','fr','logo','Logo',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','sp','logo','Insignia',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','en','website','Website',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','fr','website','Site Web',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','sp','website','Website',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','en','premium','Premium',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','fr','premium','De la meilleure qualité',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','sp','premium','Superior',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','en','custom_1','Custom One',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','fr','custom_1','Coutume Une',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','sp','custom_1','Costumbre Uno',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','en','custom_2','Custom Two',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','fr','custom_2','Coutume Deux',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','sp','custom_2','Costumbre Dos',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','en','custom_3','Custom Three',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','fr','custom_3','Coutume Trois',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','sp','custom_3','Costumbre Tres',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','en','custom_4','Custom Four',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','fr','custom_4','Coutume Quatre',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','sp','custom_4','Costumbre Cuatro',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','en','custom_5','Custom Five',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','fr','custom_5','Coutume Cinq',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','sp','custom_5','Costumbre Cinco',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','en','custom_6','Custom Six',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','fr','custom_6','Coutume Six',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_level','sp','custom_6','Costumbre Seises',0,'');");


//************************************
//Register page (register)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','register','Registration Text',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','register','Texte D\'Enregistrement',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','register','Texto Del Registro',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','en','register','Register',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','fr','register','Registre',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','sp','register','Registro',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','en','step_reg','Registration Step',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','fr','step_reg','Étape D\'Enregistrement',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','sp','step_reg','Paso Del Registro',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','en','vpass','Verify Password',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','fr','vpass','Vérifiez Le Mot de passe',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','sp','vpass','Verifique La Contraseña',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','en','step_level','Select Listing Level Step',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','fr','step_level','Choisissez L\'Étape De niveau De Liste',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','sp','step_level','Seleccione El Paso Llano Del Listado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','en','btn_reg','Submit Registration',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','fr','btn_reg','Soumettez L\'Enregistrement',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','sp','btn_reg','Someta El Registro',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','en','btn_go','Go',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','fr','btn_go','Allez',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','sp','btn_go','Vaya',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','en','step_details','Listing Details',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','fr','step_details','Détails De Liste',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','sp','step_details','Detalles Del Listado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','en','cat_list','Category List',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','fr','cat_list','Liste De Catégorie',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','sp','cat_list','Lista De la Categoría',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','en','btn_rem_cat','Remove from list',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','fr','btn_rem_cat','Enlevez de la liste',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','sp','btn_rem_cat','Quite de lista',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','en','sel_cat','Select Category',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','fr','sel_cat','Choisissez La Catégorie',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','sp','sel_cat','Seleccione La Categoría',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','en','btn_submit','Submit Listing',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','fr','btn_submit','Soumettez La Liste',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','sp','btn_submit','Someta El Listado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','en','step_pay','Get Payment',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','fr','step_pay','Obtenez Le Paiement',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','sp','step_pay','Consiga El Pago',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','en','step_complete','Registration Complete',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','fr','step_complete','Enregistrement Complet',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','sp','step_complete','Registro Completo',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','en','already_reg','Already registered?',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','fr','already_reg','Déjà enregistré ?',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','sp','already_reg','¿Colocado ya?',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','en','btn_add_cat','Add To Category',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','fr','btn_add_cat','Ajoutez À la Catégorie',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','sp','btn_add_cat','Agregue A la Categoría',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','en','title_tag','Register',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','fr','title_tag','Registre',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','sp','title_tag','Registro',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','en','breadcrumb','Register',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','fr','breadcrumb','Registre',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','sp','breadcrumb','Registro',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','en','sign_in','Sign in here',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','fr','sign_in','Signe dedans ici',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','sp','sign_in','Muestra adentro aquí',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','en','total','Total',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','fr','total','Total',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','sp','total','Total',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','en','agree_terms','I have read and agree to the',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','fr','agree_terms','J\'ai lu et suis d\'accord sur',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','sp','agree_terms','He leído y convengo',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','en','terms_link','Terms of Use',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','fr','terms_link','Limites d\'utilisation',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','sp','terms_link','Términos del uso',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','en','cats_left','Categories Left',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','fr','cats_left','Catégories Laissées',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','sp','cats_left','Categorías Dejadas',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','en','btn_paypal','Paypal',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','fr','btn_paypal','Paypal',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','sp','btn_paypal','Paypal',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','en','btn_billing','Bill Me',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','fr','btn_billing','Affichez-Moi',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('register','sp','btn_billing','Mándeme la cuenta',0,'');");


//************************************
//Expiration Periods slave set (exp_pd)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','exp_pd','Expire Periods',9,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','exp_pd','Expirent Les Périodes',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','exp_pd','Expiran Los Períodos',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_admin','en','exp_pd','slave=1',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('exp_pd','en','1','Day(s)',1,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('exp_pd','fr','1','Jours',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('exp_pd','sp','1','Días',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('exp_pd','en','2','Month(s)',2,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('exp_pd','fr','2','Mois',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('exp_pd','sp','2','Meses',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('exp_pd','en','3','Year(s)',3,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('exp_pd','fr','3','Années',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('exp_pd','sp','3','Años',0,'');");


//************************************
//Membership Level slave set (mem_level)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','mem_level','Membership Level',9,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','mem_level','Niveau D\'Adhésion',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','mem_level','Nivel De la Calidad de miembro',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_admin','en','mem_level','slave=1',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('mem_level','en','1','Free',1,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('mem_level','fr','1','Libre',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('mem_level','sp','1','Libre',0,'');");

//new ver 1.1
//************************************
//Full Page multi-line text (full_page)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','full_page','Full Page Text',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','full_page','Texte De Pleine Page',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','full_page','Texto De la Página Llena',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_admin','en','full_page','multi=1',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('full_page','en','term_of_use','<div align=\"center\">\r\n  <p align=\"left\">** This is a sample document and does not represent legal advice. Please consult an attorney in your State for applicable laws. <em>[coin]</em> stands for company identifier, such as initials. ***</p>\r\n  <p><strong>Website Terms of Use</strong></p>\r\n</div>\r\n<p>Welcome to <em>[your website]</em> (the &quot;Website&quot;)owned and operated by <em>[your company]</em> (<em>&quot;[con]&quot;</em>). Please read these Terms of Use and the accompanying Privacy Policy carefully before using this Website and/or submitting any personal information that could identify you (including but not limited to name, address, telephone number and email address). By using this Website, you signify your agreement to these Terms of Use and the Privacy Policy. If you do not agree to these Terms of Use and/or the Privacy Policy, do not use this Website.</p>\r\n<p> <strong>Copyright and Trademarks:</strong> The names and marks <em>[trademark]</em>, <em>[trademark]</em> and\r\n  <em>[trademark]</em> are the trademarks of <em>[coin]</em> and are owned or licensed to <em>[coin]</em>. All materials, including but not limited to images, audio and video clips, animation, diagrams, photographs and any and all information of any kind in any form (the &quot;Materials&quot;), incorporated into, published or otherwise exhibited on this Website are protected by copyright or other intellectual property rights and are owned and controlled by <em>[coin]</em> or third parties who have licensed <em>[coin]</em> the right to include the Materials in this Website. Any copying, reproducing, republishing, uploading, posting, modifying or transmission or distribution of any Materials is strictly prohibited and\r\n will be considered a violation of <em>[coin]</em>&#8217;s intellectual property rights and could result in legal liability and/or criminal sanction.</p>\r\n<p><strong>Disclaimer:</strong> The Material provided on this Website are for informational, educational and/or entertainment purposes only. [coin] makes no warranties regarding the reliability, truthfulness, accuracy or completeness of any Materials. Unless otherwise stated\r\n  expressly, any opinion, view or idea expressed in any article, review or story, or any content contributed or published by visitors in chat rooms or on bulletin boards\r\n or otherwise disseminated or sent to <em>[coin]</em> or others on or via this Website (&quot;Visitor Content&quot;) is the author&#8217;s own and does not reflect the views of <em>[coin]</em> or its affiliated and related entities, or its partners, sponsors, advertisers or content providers.\r\n  Neither <em>[coin]</em>, its affiliated and related entities, partners, advertisers, sponsors or content\r\n  providers are liable to any person or entity whatsoever for any loss, damage, injury, liability, claim or any other cause of action of any kind arising from the use, dissemination of or reliance on any Materials or Visitor Content provided on this Website. You agree to use this\r\n  Website entirely at your own risk. <em>[coin]</em> and its affiliated and related entities, its partners, advertisers, sponsors and content providers disclaim all warranties, express or implied, including but not limited to implied warranties of merchantability and/or fitness  for a particular purpose or that the Website will function error free or uninterrupted or that this Website or the servers that make it available for use are free of viruses  or defects. <em>[coin]</em> and its affiliated and related entities, its partners, advertisers, sponsors and content providers shall not be held liable for any information, services or products that are provided or offered by website\'s that are linked to this Website. The links to other website\'s are provided only as a convenience to you and do not constitute any endorsement of the linked website\'s or any information, services or products that are provided or offered by the linked website\'s You agree that you use any linked website\'s entirely at your own risk.</p>\r\n<p><strong>Visitor Content and Indemnification:</strong> Any Visitor Content provided by you to <em>[coin]</em> on  its billboards, chat rooms or other means shall become the property of <em>[coin]</em> throughout the universe in perpetuity and <em>[coin]</em> shall have the right to publish, reproduce, disseminate, exhibit or otherwise distribute and use the Visitor Content in all media now  known or hereafter devised. By submitting Visitor Content to the Website, you agree to represent and warrant that such Visitor Content shall not contain any libelous, defamatory, obscene, illegal, threatening or abusive materials and shall not infringe any intellectual property right or any other right of any person or entity and shall not breach any law. By visiting and using this Website, you signify your agreement to save <em>[coin]</em>, it&#8217;s affiliated and related entities, its officers, directors and employees harmless from any and all damages, legal actions or causes of action that may now or hereinafter arise as a result of your use of the Website and your breach of these Terms of Use and/or any representations and warranties related to the Visitor Content. <em>[coin]</em> monitors the use of its billboards, chat rooms and any posted materials and reserves the right to remove any  Visitor Content and block access to any visitor for any reason at its sole discretion.\r\nJurisdiction: This Website is owned and controlled by <em>[coin]</em>, a company incorporated under the laws of the State of <em>[your state]</em> and whose head office\r\nis located in the City of <em>[your city]</em>.</p>\r\n<p>This Website is presented solely for informational, educational and entertainment purposes. Neither <em>[coin]</em> nor its affiliated or related entities make any representation, express or implied, that this Website will be available for use in or comply with the law of any country other than the United States of America. By using this Website, you agree that these Website Terms of Use and Privacy Policy shall be governed, construed and enforced in accordance with the laws of the State of <em>[your state]</em> as it is applied to contracts entered into and performed entirely within such province and you submit to the jurisdiction of the courts of such State.</p>',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('full_page','fr','term_of_use','<div align=\"center\">\r\n  <p align=\"left\">** C\'est un document témoin et ne représente pas le conseil légal. Veuillez consulter un mandataire dans votre état pour des lois applicables. <em>[coin]</em> représente la marque de compagnie, telle que des initiales. ***</p>\r\n  <p><strong>Limites de site Web d\'utilisation</strong>\r\n    </p>\r\n</div>\r\n<p>Bienvenue à <em>[votre site Web]</em> (le &quot;site Web&quot;)\r\n  possédé et fonctionné près <em>[votre compagnie]</em> (<em>&quot;[coin]&quot;</em>).\r\n  Veuillez lire ces limites d\'utilisation et de la politique d\'intimité d\'accompagnement soigneusement avant d\'employer ce site Web et/ou soumettre n\'importe quelle information personnelle qui pourrait vous identifier (y compris mais non limité pour appeler, adresser, numéro de téléphone et email address). En employant ce site Web, vous signifiez votre accord à ces limites d\'utilisation et de la politique d\'intimité. Si vous n\'êtes pas d\'accord sur ces limites d\'utilisation et/ou de la politique d\'intimité, n\'employez pas ce site Web.</p>\r\n<p> <strong>Copyright et marques déposées:</strong> Les noms et les marques <em>[marque déposée]</em>, <em>[marque déposée]</em> et\r\n  <em>[marque déposée]</em> sont les marques déposées de <em>[coin]</em> et sont possédés ou autorisés à\r\n  <em>[coin]</em>. Tous les matériaux, incluant mais non limités aux images, les agrafes d\'acoustique et de vidéo, l\'animation, les diagrammes, les photographies et et toute l\'information de sorte sous toute forme\r\n  (the &quot;Matériaux&quot;), incorporated dans, édité ou autrement exhibé sur ce site Web sont protégés par copyright ou d\'autres droites de propriété intellectuelle et sont possédés et commandés près<em>[coin]</em> ou tiers qui ont autorisé <em>[coin]</em> la droite d\'inclure les matériaux dans ce site Web. copiant, se reproduisant, republiant, téléchargeant, signalant, modifiant ou transmission ou distribution de tous les matériaux est strictement interdit et sera considéré une violation de <em>[coin]</em>&#8217;s les droites de propriété intellectuelle et ont pu avoir comme conséquence la responsabilité légale et/ou la sanction criminelle.</p>\r\n<p><strong>Déni:</strong> Le matériel fourni sur ce site Web sont pour des buts informationnels, éducatifs et/ou de divertissement seulement. [coin] marques aucunes garanties concernant la fiabilité, l\'exactitude, l\'exactitude ou la perfection de tous matériaux. Sauf indication contraire expressément, n\'importe quelle opinion, opinion ou idée exprimée en n\'importe quel article, revue ou histoire, ou n\'importe quel contenu ont contribué ou ont édité par des visiteurs dans des chambres de causerie ou sur des tableaux d\'affichage ou ont autrement disséminé ou ont envoyé à <em>[coin]</em> ou d\'autres sur ou par l\'intermédiaire de ce site Web (&quot;Visiteur Contenu&quot;) is the authorest propre de l\'auteur et ne reflète pas les vues de <em>[coin]</em> ou ses entités filiales et relatives, ou ses associés, commanditaires, annonceurs ou fournisseurs de contenu. Ni l\'un ni l\'autre <em>[coin]</em>,\r\n  ses entités filiales et relatives, associés, annonceurs, commanditaires ou fournisseurs de contenu sont exposés à toute personne ou entité quelque pour n\'importe quelle perte, dommages, dommages, responsabilité, réclamation ou toute autre cause d\'action de résulter aimable de l\'utilisation, diffusion de ou confiance dans n\'importe quels matériaux ou contenu de visiteur fournis sur ce site Web. Vous acceptez d\'employer ce site Web entièrement à votre propre risque. <em>[coin]</em> et ses entités filiales et relatives, ses associés, annonceurs, commanditaires et fournisseurs de contenu démentent toutes les garanties, exprès ou impliquée, incluant mais non limitée aux garanties implicites de la valeur marchande et/ou de la forme physique pour un but particulier ou que le site Web fonctionnera erreur librement ou non interrompu ou que ce site Web ou les serveurs qui le rendent disponible pour l\'usage sont exempts de virus ou de défauts.\r\n  <em>[coin]</em> et ses entités filiales et relatives, ses associés, annonceurs, commanditaires et fournisseurs de contenu ne seront pas jugés responsables de l\'aucuns information, services ou produit qui sont fournis ou offerts par le site Web qui sont liés à ce site Web. Les liens à l\'autre site Web sont fournis seulement comme convenance vous et ne constituent pas n\'importe quelle approbation du site Web lié ou l\'aucuns information, services ou produit qui sont fournis ou offerts par vous du site Web lié conviennent que vous employez n\'importe quel site Web lié entièrement à votre propre risque.</p>\r\n<p><strong>Contenu et indemnification de visiteur:</strong> N\'importe quel contenu de visiteur a fourni par vous à <em>[coin]</em> sur son les panneaux-réclame, les salles de causerie ou d\'autres moyens deviendront la propriété de <em>[coin]</em> dans tout univers dans la perpétuation et <em>[coin]</em> aura le droit d\'éditer, reproduire, disséminer, exhiber ou autrement distribuer et employer le contenu de visiteur dans tous les médias maintenant connus ou ci-après conçus. En soumettant le contenu de visiteur au site Web, vous acceptez de représenter et justifier qu\'un tel contenu de visiteur ne contiendra pas libelous, diffamatoire, obscène, illégal, menacer ou matériaux abusifs et ne violerez pas n\'importe quelle droite de propriété intellectuelle ou n\'importe quelle autre droite de toute personne ou d\'entité et n\'ouvrirez pas une brèche n\'importe quelle loi. En visitant et en employant ce site Web, vous signifiez votre accord de sauver <em>[coin]</em>,\r\n  c\'est les entités filiales et relatives, ses officiers, les directeurs et les employés inoffensifs de n\'importe quelle partie et toutes les dommages, actions judiciaires ou causes d\'action qui peut maintenant ou ci-après surgir en raison de votre utilisation du site Web et votre infraction de ces limites de l\'utilisation et/ou toutes représentations et garanties liées au contenu de visiteur. <em>[coin]</em> moniteurs l\'utilisation de ses panneaux-réclame, salles de causerie et tous matériaux et réservations signalés la droite d\'enlever tout contenu de visiteur et de bloquer l\'accès à tout visiteur pour toute raison à son discrétion unique.\r\n  Juridiction : Ce site Web est possédé et commandé près <em>[coin]</em>, une compagnie a incorporé en vertu des lois de l\'état de <em>[votre état]</em> et du dont le siège social est situé dans la ville <em>[votre ville]</em>.</p>\r\n<p>Ce site Web est présenté seulement pour des buts informationnels, éducatifs et de divertissement. Ni l\'un ni l\'autre <em>[coin]</em> ni ses entités filiales ou relatives font n\'importe quelle représentation, l\'expriment ou l\'ont impliqué, que ce site Web sera disponible pour l\'usage dedans ou sera conforme à la loi de n\'importe quel pays autre que les Etats-Unis d\'Amérique. En employant ce site Web, vous convenez que ces limites de site Web de la politique d\'utilisation et d\'intimité seront régies, interprétées et imposées selon les lois de l\'état de <em>[votre état]</em> As il est appliqué aux contrats écrits dans et exécuté entièrement chez un tel province et vous soumettez à la juridiction des cours d\'un tel état.</p>',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('full_page','sp','term_of_use','<div align=\"center\">\r\n  <p align=\"left\">** Esto es un documento de la muestra y no representa asesoramiento jurídico. Consulte por favor a abogado en su estado para los leyes aplicables. <em>[coin]</em> representa el identificador de la compañía, tal como iniciales. ***</p>\r\n  <p><strong>Términos del Web site del uso</strong>\r\n    </p>\r\n</div>\r\n<p>Recepción a <em>[su Web site]</em> (el &quot;Web site&quot;)\r\n  poseído y funcionado cerca <em>[su compañía]</em> (<em>&quot;[coin]&quot;</em>).\r\n  Lea por favor estos términos del uso y de la política de aislamiento de acompañamiento cuidadosamente antes de usar este Web site y/o de someter cualquier información personal que podría identificarle (incluyendo pero no limitado para nombrar, para tratar, número de teléfono y email address). Usando este Web site, usted significa su acuerdo a estos términos del uso y de la política de aislamiento. Si usted no conviene estos términos del uso y/o de la política de aislamiento, no utilice este Web site.</p>\r\n<p> <strong>Copyright y marcas registradas:</strong> Los nombres y las marcas <em>[marca registrada]</em>, <em>[marca registrada]</em> y\r\n  <em>[marca registrada]</em> son las marcas registradas de <em>[coin]</em> y se poseen o se licencian a\r\n  <em>[coin]</em>. Todos los materiales, incluyendo pero no limitados a las imágenes, clips del audio y del vídeo, animación, diagramas, fotografías y y toda la información de la clase en cualquier forma\r\n  (the &quot;ateriales&quot;), incorporado en, publicado o exhibido de otra manera en este Web site son protegidos por el copyright u otras derechas de característica intelectual y poseídos y controlados cerca <em>[coin]</em> o terceros que han licenciado <em>[coin]</em> la derecha de incluir los materiales en este Web site. copiando, reproduciéndose, republicando, uploading, fijando, modificándose o transmisión o distribución de cualquier material terminantemente se prohíbe y será considerado una violación de <em>[coin]</em>&#8217;s las derechas de característica intelectual y podían dar lugar a responsabilidad legal y/o a la sanción criminal.</p>\r\n<p><strong>Negación:</strong> El material proporcionó en este Web site está para los propósitos informativos, educativos y/o de la hospitalidad solamente. [coin] marcas ningunas garantías con respecto la confiabilidad, la verdad, la exactitud o a lo completo de cualquieres materiales. A menos que estuvo indicada de otra manera expreso, cualquier opinión, opinión o idea expresada en cualquier artículo, revisión o historia, o cualquier contenido contribuyeran o publicaran por los visitantes en cuartos de la charla o en tablones de anuncios o de otra manera se diseminaran o enviaran a <em>[coin]</em> u otros en o vía este Web site (&quot;Visitante Contenido&quot;) es el propio del autor y no refleja las vistas a<em>[coin]</em> o sus entidades afiliadas y relacionadas, o sus socios, patrocinadores, publicistas o abastecedores contentos. Ni unos ni otros <em>[coin]</em>,\r\n  sus entidades afiliadas y relacionadas, socios, publicistas, patrocinadores o abastecedores contentos son obligados a cualquier persona o entidad cualesquiera para cualquier pérdida, el daños, lesión, responsabilidad, demanda o cualquier otra causa de la acción de presentarse bueno del uso, difusión de o confianza en cualesquiera materiales o contenido del visitante proporcionados en este Web site. Usted acuerda utilizar este Web site enteramente en su propio riesgo. <em>[coin]</em> y sus entidades afiliadas y relacionadas, sus socios, publicistas, patrocinadores y los abastecedores contentos niegan todas las garantías, expresos o haber implicado, incluyendo pero no haber limitado a las garantías implicadas del merchantability y/o de la aptitud para un propósito particular o que funcionará el Web site error libremente o ininterrumpido o que este Web site o los servidores que hacen disponible para el uso está libres de virus o de defectos.\r\n  <em>[coin]</em> y no sostendrán sus entidades afiliadas y relacionadas, a sus socios, publicistas, patrocinadores y a los abastecedores contentos obligados para ninguna información, servicios o productos que son proporcionados u ofrecidos por el Web site que se liga a este Web site. Los acoplamientos al otro Web site se proporcionan solamente como conveniencia usted y no constituyen ningún endoso del Web site ligado o ninguna información, servicios o productos que sean proporcionados u ofrecidos por usted del Web site ligado convienen que usted utiliza cualquier Web site ligado enteramente en su propio riesgo</p>\r\n<p><strong>Contenido e indemnización del visitante:</strong> Cualquier contenido del visitante proporcionó por usted a <em>[coin]</em> en su las carteleras, los cuartos de la charla u otros medios se convertirán en la característica de <em>[coin]</em> a través de universo en perpetuidad y<em>[coin]</em> tendrá la derecha de publicar, de reproducir, de diseminar, de exhibir o de otra manera de distribuir y de utilizar el contenido del visitante en todos los medios ahora sabidos o de aquí en adelante ideados. Sometiendo el contenido del visitante al Web site, usted acuerda representar y autorizar que tal contenido del visitante no contendrá libelous, difamatorio, obscene, ilegal, el amenazar o los materiales abusivos y no infringirá la ninguna derecha de característica intelectual o la ninguna otra derecha de ninguna persona o de la entidad y no practicará una abertura ninguna ley. Visitando y usando este Web site, usted significa su acuerdo de ahorrar <em>[coin]</em>,\r\n  es entidades afiliadas y relacionadas, sus oficiales, directores y empleados inofensivos de cualquiera y todos los daños, demandas legales o causas de la acción que pueda ahora o más abajo presentarse como resultado de su uso del Web site y su abertura de estos términos del uso y/o cualquieres representaciones y garantías relacionados con el contenido del visitante. <em>[coin]</em> monitores el uso de sus carteleras, cuartos de la charla y cualquieres materiales y reservas fijados la derecha de quitar cualquier contenido del visitante y de bloquear el acceso a cualquier visitante por cualquier razón en su discreción única.\r\n  Jurisdicción: Este Web site se posee y se controla cerca <em>[coin]</em>, una compañía incorporó bajo leyes del estado de <em>[su estado]</em> y del que oficina central está situada en la ciudad <em>[su ciudad]</em>.</p>\r\n<p>Este Web site se presenta solamente para los propósitos informativos, educativos y de la hospitalidad. Ni unos ni otros <em>[coin]</em> ni sus entidades afiliadas o relacionadas hacen cualquier representación, la expresan o la implicaron, que este Web site estará disponible para el uso adentro o se conformará con la ley de cualquier país con excepción de los Estados Unidos de América. Usando este Web site, usted conviene que estos términos del Web site de la política del uso y de aislamiento serán gobernados, interpretados y hechos cumplir de acuerdo con los leyes del estado de <em>[su estado]</em> como se aplica a los contratos incorporados en y realizado enteramente dentro de tal provincia y usted someta a la jurisdicción de las cortes de tal estado.</p>',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('full_page','en','privacy_policy','<p>** This is a sample document and does not represent legal advice. Please consult an attorney in your State for applicable laws. <em>[coin]</em> stands for company identifier, such as initials. ***</p>\r\n<p align=\"center\"><strong>WEBSITE PRIVACY POLICY</strong></p>\r\n<p><em>[your company]</em> (&quot;<em>[coin]</em>&quot;) is committed to respecting the privacy concerns of its visitors to <em>[your website]</em> (&quot;the Website&quot;). <em>[coin]</em> has created this privacy policy (the &quot;Policy&quot;) to establish guidelines that will govern the collection, use, protection and disclosure of the personal and non-personal information of  its visitors. <em>[coin]</em> collects three kinds of information from this Website: (1) your voluntarily provided personal information; (2) anonymous non-personal information; and (3) &quot;cookie&quot; based information. </p>\r\n<p><strong>(1) Personal Information:</strong> <em>[coin]</em> does not automatically collect personal information,  such as name, address, phone number, email address and other personally identifiable information, from its visitors (&quot;Personal Information&quot;). From time to time, <em>[coin]</em> will collect Personal Information that is voluntarily provided by its visitors in filling out contest entry forms and subscribing to newsletters and other activities carried out on the Website. <em>[coin]</em> will only collect and use such Personal Information solely for the purpose(s) disclosed by <em>[coin]</em> at the time of collection and only after the visitor has voluntarily agreed to such collection and use, by checking &quot;I agree&quot; on the online form or in writing if  entering via faxed or mailed form. <em>[coin]</em> also sometimes use email addresses that have been voluntarily provided by its visitors to respond to visitors who communicate with us, to inform winners of contests or to subscribe to newsletters. All emails from <em>[coin]</em> to its visitors include instructions on how to discontinue receipt of emails, newsletters and other communication from <em>[coin]</em> and visitors can discontinue such  communication at any time. Email addresses from visitors who wish to discontinue receipt of <em>[coin]</em>&#8217;s<br> emails will be removed from <em>[coin]</em>&#8217;s distribution list and data bases. All Personal Information that may identify a visitor and has been collected with the visitor&#8217;s consent by <em>[coin]</em> is not disclosed in any identifiable form to any other party outside the company except for the fulfillment of the specific purpose identified to the visitor at the time of collection. However <em>[coin]</em> may disclose such information in anonymous, aggregated and non-personally identifiable form to other parties for marketing, advertising or other purposes and to better understand visitor&#8217;s use of the Website. At any  time, a visitor may send an email to <em>[privacy issues e-mail address]</em> to request that Personal Information be changed, removed or updated in <em>[coin]</em>&#8217;s databases. Visitors should exercise caution when they disclosed personally identifiable information on bulletin boards or chat rooms on this Website or any other website. Such areas are accessible by anyone and may result in the visitor receiving unsolicited messages from other people and/or companies. Although <em>[coin]</em> is committed to protecting the Personal Information provided to it by its visitors in compliance with this Privacy Policy, it cannot  guarantee the security of information, whether personal or otherwise, that visitors disclose online to publicly accessible bulletin boards or chat rooms.</p>\r\n<p><strong>(2) Anonymous Non-Personal Information:</strong> When visitors visit the Website, anonymous, non personal information about their visit is automatically collected. Such information may include the length and date of the visit, how the visitor navigated the Website, what pages the visitor viewed, the type of browser being used by the visitor, the type of operating system used by the visitor and the domain name of the visitor&#8217;s Internet  service provider. <em>[coin]</em> uses this Anonymous Non-Personal information to track the success of its Website with its visitors and to better tailor the Website to  visitors&#8217; needs and interests. This Anonymous Non-Personal Information may be shared with other parties, such as broadcasters, advertisers, sponsors and partners.</p>\r\n<p><strong>(3) Cookie-based Information:</strong> <em>[coin]</em> may use cookies on its Website. &quot;Cookies&quot; are pieces of information that a website transfers to a visitor&#8217;s hard drive for record keeping and identification purposes. Cookies are used to make the visitor&#8217;s use of a website easier by saving visitor preferences and passwords and to identify which areas of the Website are popular and which areas need improvement and how to target certain advertising to its visitors. <em>[coin]</em> does not use cookies to collect personally identifiable information except in connection with a password protected online registration for a<br> contest or newsletter or other service and only with the visitor&#8217;s informed consent. Visitors may visit the Website with its cookies turned off to avoid the collection\r\nof Cookie-based Information.</p>\r\n<p><strong>Protection of Visitors&#8217; Personal Information:</strong> <em>[coin]</em> protects the Personal Information it\r\n  collects with appropriate technological, physical and administrative safeguards to protect if from unauthorized disclosure or use. Access to Personal Information collected by <em>[coin]</em> is limited to authorized individuals and stored on its databases, which are protected by firewall\'s and are password-secured. <em>[coin]</em> retains the  Personal Information only for as long as is required for the purposes identified at the time of its collection and consented to by the visitor providing it or as otherwise required by law. Once Personal Information is no longer necessary for the purposes consented to by the visitor, it is <em>[coin]</em>&#8217;s practice to delete it from its data bases or systems or make it anonymous.</p>\r\n<p><strong>Linked Website\'s:</strong> This Website may be linked to other website\'s. These linked website\'s are not under the control of <em>[coin]</em> and are required to have their own privacy policies. Visitors should ensure that they read and understand how their Personal Information may be collected, used, and disclosed by the linked website\'s as <em>[coin]</em> is not responsible  for and shall not be held liable for any procedures, policies or activities of any website\'s linked to the Website.</p>\r\n<p><strong>Visitor&#8217;s Consent to Privacy Policy:</strong> By visiting and using this website, the visitor agrees to the Privacy Policy and the terms of use (&quot;Terms of Use&quot;) linked to this Privacy Policy.  If you do not agree to the Privacy Policy do not use this Website or provide Personal Information to <em>[coin]</em>. If you wish to amend, update or remove the Personal Information already provided, contact <em>[privacy issues e-mail address]</em>.</p>\r\n<p><strong>Accountability:</strong> <em>[coin]</em> takes its commitment to securing privacy very seriously. From  time to time, <em>[coin]</em> may amend or update this Privacy Policy to comply with visitor concerns, best practices and/or the law. <em>[coin]</em> has appointed a member of its management team to act as <em>[coin]</em>&#8217;s Privacy Officer and who is responsible for  reviewing, approving and administering this Privacy Policy and <em>[coin]</em>&#8217;s commitments hereunder. If you have any questions, concerns or comments, feel free to contact the Privacy Officer at <em>[privacy issues e-mail address]</em> or by telephone at <em>[privacy issue phone number]</em> or in writing at: <em>[privacy issues physical\r\naddress]</em>.</p>',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('full_page','fr','privacy_policy','<p>** C\'est un document témoin et ne représente pas le conseil légal. Veuillez consulter un mandataire dans votre état pour des lois applicables. <em>[coin]</em> représente la marque de compagnie, telle que des initiales. ***</p>\r\n<p align=\"center\"><strong>POLITIQUE D\'INTIMITÉ DE SITE WEB</strong></p>\r\n<p><em>[votre compagnie]</em> (&quot;<em>[coin]</em>&quot;) est commis à respecter les soucis d\'intimité de ses visiteurs à <em>[votre site Web]</em> (\"le site Web\"). <em>[coin]</em> a créé cette politique d\'intimité (l\'\"politique\") pour établir les directives qui régiront la collecte, l\'utilisation, la protection et la révélation d\'information personnelle et non-personal de ses visiteurs. <em>[coin]</em> rassemble trois genres d\'information de ce site Web : (1) vos informations personnelles volontairement fournies ; (2) l\'information non-personal anonyme ; et (3) \"le cookie\" a basé l\'information. </p>\r\n<p><strong>(1) L\'Information Personnelle:</strong> <em>[coin]</em> ne rassemble pas automatiquement l\'information personnelle, telle que le nom, l\'adresse, le numéro de téléphone, le email address et toute autre information personnellement identifiable, de ses visiteurs (\"l\'information personnelle\"). De temps en temps, <em>[coin]</em> rassemblera les informations personnelles qui sont volontairement fournies par ses visiteurs en remplissant hors des formes d\'entrée de concours et la souscription aux bulletins et à d\'autres activités effectués sur le site Web. <em>[coin]</em> la volonté seulement rassemblent et emploient une telle information personnelle seulement pour le but révélé près <em>[coin]</em> à l\'heure de la collection et seulement après le visiteur a volontairement été d\'accord sur une telle collection et utilisation, vérifiant d\'\"moi conviens\" sur la forme en ligne ou dans l\'écriture si entrant par l\'intermédiaire de la forme envoyée ou expédiée par fax. <em>[coin]</em> également parfois adresses d\'email d\'utilisation qui ont été volontairement fournies par ses visiteurs pour répondre aux visiteurs qui communiquent avec nous, pour informer des gagnants des concours ou pour souscrire aux bulletins. Tous les email de <em>[coin]</em> à ses visiteurs incluez les instructions sur la façon dont discontinuer la réception de email, bulletins et toute autre communication de <em>[coin]</em>et les visiteurs peuvent discontinuer une telle communication à tout moment. Adresses d\'email des visiteurs souhaitez discontinuer dont la réception <em>[coin]</em>\'s des email seront enlevés de <em>[coin]</em>\'s liste et bases de données de distribution. Toute l\'information personnelle qui peut identifier un visiteur et a été rassemblée avec le consentement de visiteurs près <em>[coin]</em> n\'est révélé sous aucune forme identifiable à aucune autre partie en dehors de la compagnie excepté la réalisation du but spécifique identifié au visiteur à l\'heure de la collection. Cependant <em>[coin]</em> peut révéler une telle information sous la forme anonyme, agrégée et non-personally identifiable à d\'autres parties pour buts de vente, de la publicité ou autre et mieux comprendre l\'utilisation de visiteurs du site Web. À tout moment, un visiteur peut envoyer un email à <em>[l\'intimité publie l\'adresse de E-mail]</em> pour demander que l\'information personnelle soit changée, enlevée ou mise à jour dedans <em>[coin]</em>\'s bases de données. Les visiteurs devraient exercer l\'attention quand ils ont révélé personnellement l\'information identifiable sur des tableaux d\'affichage ou des salles de causerie sur ce site Web ou n\'importe quel autre site Web. De tels secteurs sont accessibles par n\'importe qui et peuvent avoir comme conséquence le visiteur recevant les messages non sollicités d\'autres et/ou de compagnies. Bien que <em>[coin]</em> est commis à protéger les informations personnelles fournies à elles par ses visiteurs conformément à cette politique d\'intimité, il ne peut pas garantir la sécurité d\'information, si personnel ou autrement, que les visiteurs révèlent en ligne aux tableaux d\'affichage publiquement accessibles ou causent des salles.</p>\r\n<p><strong>(2) L\'Information Non-Personal Anonyme:</strong> Quand les visiteurs visitent le site Web, anonyme, des informations non personnelles sur leur visite sont automatiquement rassemblées. Une telle information peut inclure la longueur et date de la visite, comment le visiteur a dirigé le site Web, quelles pages le visiteur a regardé, le type de navigateur employé par le visiteur, le type de logiciel d\'exploitation a employé par le visiteur et le Domain Name du Internet Service Provider de visiteurs. <em>[coin]</em> emploie cette information non-Personal anonyme pour dépister le succès de son site Web avec ses visiteurs et améliorer le tailleur que le site Web aux visiteurs a besoin et intéresse. Cette information non-Personal anonyme peut être partagée avec d\'autres parties, telles que des radiodiffuseurs, annonceurs, commanditaires et associés.</p>\r\n<p><strong>(3) L\'Information Cookie-basée:</strong> <em>[coin]</em> peut employer des cookies sur son site Web. les \"Cookies\" sont des informations qu\'un site Web transfère à une commande dure de visiteurs pour le disque gardant et des Cookies de buts d\'identification sont employés pour faciliter les visiteurs l\'utilisation d\'un site Web en sauvant des préférences et des mots de passe de visiteur et pour identifier quels secteurs du site Web sont populaires et quels secteurs ont besoin d\'amélioration et comment viser certaine publicité à ses visiteurs. <em>[coin]</em> n\'emploie pas des cookies pour rassembler personnellement l\'information identifiable à moins qu\'en liaison avec un mot de passe ait protégé l\'enregistrement en ligne pour un concours ou le bulletin ou tout autre service et seulement avec les visiteurs a informé le consentement. Les visiteurs peuvent visiter le site Web avec ses biscuits arrêtés pour éviter la collecte de l\'information Cookie-basée.</p>\r\n<p><strong>Protection d\'information personnelle de visiteurs:</strong> <em>[coin]</em> protège les sauvegardes de l\'information qu\'il se rassemble avec technologique approprié, physiques et administratives personnelles pour se protéger si de la révélation ou de l\'utilisation non autorisée. Accédez à l\'information personnelle rassemblée près <em>[coin]</em> est limité aux individus autorisés et stocké sur ses bases de données, qui sont protégées par le mur à l\'épreuve du feu et mot de passe-sont fixées. <em>[coin]</em> maintient l\'information personnelle seulement pour aussi longtemps qu\'est exigé pour les buts identifiés à l\'heure de sa collection et consentis à par le visiteur la fournir ou comme autrement exigé par loi. Une fois que l\'information personnelle n\'est plus nécessaire pour les buts consentis à par le visiteur, elle est <em>[coin]</em>\'s pratique de la supprimer de ses bases de données ou systèmes ou de la rendre anonyme.</p>\r\n<p><strong>Site Web Lié:</strong> Ce site Web peut être lié à l\'autre site Web. Ceux-ci le site Web lié ne sont pas sous la commande de <em>[coin]</em> et sont priés d\'avoir leurs propres politiques d\'intimité. Les visiteurs devraient s\'assurer qu\'ils lisent et comprennent comment leur information personnelle peut être rassemblée, employée, et révélée par le site Web lié As <em>[coin]</em> n\'est pas responsable de et ne sera pas jugé responsable d\'aucunes procédures, politiques ou activité d\'aucun site Web lié au site Web.</p>\r\n<p><strong>Consentement de visiteurs à la politique d\'intimité:</strong> En visitant et en employant ce site Web, le visiteur est d\'accord sur la politique d\'intimité et les limites de l\'utilisation (\"limites de l\'utilisation\") liées à cette politique d\'intimité. Si vous n\'êtes pas d\'accord sur la politique d\'intimité n\'employez pas ce site Web ou ne fournissez pas les informations personnelles à<em>[coin]</em>. Si vous souhaitez modifier, mettre à jour ou enlever les informations personnelles déjà fournies, contact <em>[l\'intimité publie l\'adresse de E-mail]</em>.</p>\r\n<p><strong>Responsabilité:</strong> <em>[coin]</em> prend son engagement à fixer l\'intimité très sérieusement. De temps en temps, <em>[coin]</em> peut modifier ou mettre à jour cette politique d\'intimité pour se conformer aux soucis de visiteur, aux meilleures pratiques et/ou à la loi. <em>[coin]</em> a nommé un membre de sa équipe de gestion pour agir en tant que <em>[coin]</em>\'s L\'officier d\'intimité et qui est responsable de passer en revue, approuvant et administrant cette politique d\'intimité et<em>[coin]</em\'s engagements ci-dessous. Si vous avez n\'importe quels questions, soucis ou commentaires, sentez-vous libre pour contacter l\'officier d\'intimité à <em>[l\'intimité publie l\'adresse de E-mail]</em> ou par téléphone à <em>[numéro de téléphone d\'issue d\'intimité]</em> ou par écrit à: <em>[l\'intimité publie l\'adresse physique]</em>.</p>',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('full_page','sp','privacy_policy','<p>** This is a sample document and does not represent legal advice. Please consult an attorney in your State for applicable laws. <em>[coin]</em> stands for company identifier, such as initials. ***</p>\r\n<p align=\"center\"><strong>WEBSITE PRIVACY POLICY</strong></p>\r\n<p><em>[your company]</em> (&quot;<em>[coin]</em>&quot;) is committed to respecting the privacy concerns of its visitors to <em>[your website]</em> (&quot;the Website&quot;). <em>[coin]</em> has created this privacy policy (the &quot;Policy&quot;) to establish guidelines that will govern the collection, use, protection and disclosure of the personal and non-personal information of  its visitors. <em>[coin]</em> collects three kinds of information from this Website: (1) your voluntarily provided personal information; (2) anonymous non-personal information; and (3) &quot;cookie&quot; based information. </p>\r\n<p><strong>(1) Personal Information:</strong> <em>[coin]</em> does not automatically collect personal information,  such as name, address, phone number, email address and other personally identifiable information, from its visitors (&quot;Personal Information&quot;). From time to time, <em>[coin]</em> will collect Personal Information that is voluntarily provided by its visitors in filling out contest entry forms and subscribing to newsletters and other activities carried out on the Website. <em>[coin]</em> will only collect and use such Personal Information solely for the purpose(s) disclosed by <em>[coin]</em> at the time of collection and only after the visitor has voluntarily agreed to such collection and use, by checking &quot;I agree&quot; on the online form or in writing if  entering via faxed or mailed form. <em>[coin]</em> also sometimes use email addresses that have been voluntarily provided by its visitors to respond to visitors who communicate with us, to inform winners of contests or to subscribe to newsletters. All emails from <em>[coin]</em> to its visitors include instructions on how to discontinue receipt of emails, newsletters and other communication from <em>[coin]</em> and visitors can discontinue such  communication at any time. Email addresses from visitors who wish to discontinue receipt of <em>[coin]</em>&#8217;s<br> emails will be removed from <em>[coin]</em>&#8217;s distribution list and data bases. All Personal Information that may identify a visitor and has been collected with the visitor&#8217;s consent by <em>[coin]</em> is not disclosed in any identifiable form to any other party outside the company except for the fulfillment of the specific purpose identified to the visitor at the time of collection. However <em>[coin]</em> may disclose such information in anonymous, aggregated and non-personally identifiable form to other parties for marketing, advertising or other purposes and to better understand visitor&#8217;s use of the Website. At any  time, a visitor may send an email to <em>[privacy issues e-mail address]</em> to request that Personal Information be changed, removed or updated in <em>[coin]</em>&#8217;s databases. Visitors should exercise caution when they disclosed personally identifiable information on bulletin boards or chat rooms on this Website or any other website. Such areas are accessible by anyone and may result in the visitor receiving unsolicited messages from other people and/or companies. Although <em>[coin]</em> is committed to protecting the Personal Information provided to it by its visitors in compliance with this Privacy Policy, it cannot  guarantee the security of information, whether personal or otherwise, that visitors disclose online to publicly accessible bulletin boards or chat rooms.</p>\r\n<p><strong>(2) Anonymous Non-Personal Information:</strong> When visitors visit the Website, anonymous, non personal information about their visit is automatically collected. Such information may include the length and date of the visit, how the visitor navigated the Website, what pages the visitor viewed, the type of browser being used by the visitor, the type of operating system used by the visitor and the domain name of the visitor&#8217;s Internet  service provider. <em>[coin]</em> uses this Anonymous Non-Personal information to track the success of its Website with its visitors and to better tailor the Website to  visitors&#8217; needs and interests. This Anonymous Non-Personal Information may be shared with other parties, such as broadcasters, advertisers, sponsors and partners.</p>\r\n<p><strong>(3) Cookie-based Information:</strong> <em>[coin]</em> may use cookies on its Website. &quot;Cookies&quot; are pieces of information that a website transfers to a visitor&#8217;s hard drive for record keeping and identification purposes. Cookies are used to make the visitor&#8217;s use of a website easier by saving visitor preferences and passwords and to identify which areas of the Website are popular and which areas need improvement and how to target certain advertising to its visitors. <em>[coin]</em> does not use cookies to collect personally identifiable information except in connection with a password protected online registration for a<br> contest or newsletter or other service and only with the visitor&#8217;s informed consent. Visitors may visit the Website with its cookies turned off to avoid the collection\r\nof Cookie-based Information.</p>\r\n<p><strong>Protection of Visitors&#8217; Personal Information:</strong> <em>[coin]</em> protects the Personal Information it\r\n  collects with appropriate technological, physical and administrative safeguards to protect if from unauthorized disclosure or use. Access to Personal Information collected by <em>[coin]</em> is limited to authorized individuals and stored on its databases, which are protected by firewall\'s and are password-secured. <em>[coin]</em> retains the  Personal Information only for as long as is required for the purposes identified at the time of its collection and consented to by the visitor providing it or as otherwise required by law. Once Personal Information is no longer necessary for the purposes consented to by the visitor, it is <em>[coin]</em>&#8217;s practice to delete it from its data bases or systems or make it anonymous.</p>\r\n<p><strong>Linked Website\'s:</strong> This Website may be linked to other website\'s. These linked website\'s are not under the control of <em>[coin]</em> and are required to have their own privacy policies. Visitors should ensure that they read and understand how their Personal Information may be collected, used, and disclosed by the linked website\'s as <em>[coin]</em> is not responsible  for and shall not be held liable for any procedures, policies or activities of any website\'s linked to the Website.</p>\r\n<p><strong>Visitor&#8217;s Consent to Privacy Policy:</strong> By visiting and using this website, the visitor agrees to the Privacy Policy and the terms of use (&quot;Terms of Use&quot;) linked to this Privacy Policy.  If you do not agree to the Privacy Policy do not use this Website or provide Personal Information to <em>[coin]</em>. If you wish to amend, update or remove the Personal Information already provided, contact <em>[privacy issues e-mail address]</em>.</p>\r\n<p><strong>Accountability:</strong> <em>[coin]</em> takes its commitment to securing privacy very seriously. From  time to time, <em>[coin]</em> may amend or update this Privacy Policy to comply with visitor concerns, best practices and/or the law. <em>[coin]</em> has appointed a member of its management team to act as <em>[coin]</em>&#8217;s Privacy Officer and who is responsible for  reviewing, approving and administering this Privacy Policy and <em>[coin]</em>&#8217;s commitments hereunder. If you have any questions, concerns or comments, feel free to contact the Privacy Officer at <em>[privacy issues e-mail address]</em> or by telephone at <em>[privacy issue phone number]</em> or in writing at: <em>[privacy issues physical\r\naddress]</em>.</p>',0,'');");
// end new ver 1.1

//************************************
//Expiration Perdiods table (pds_exp)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','pds_exp','Expiration Period Table',1,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','pds_exp','Tableau De Période D\'Expiration',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','pds_exp','Tabla Del Período De la Expiración',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_exp','en','id','ID',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_exp','fr','id','Identification',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_exp','sp','id','Identificación',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_exp','en','title','Title',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_exp','fr','title','Titre',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_exp','sp','title','Título',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_exp','en','days','Days',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_exp','fr','days','Jours',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_exp','sp','days','Días',0,'');");


//************************************
//Edit Expiration Perdiods page (edexp)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','edexp','Edit Expiration Periods',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','edexp','Éditez Les Périodes D\'Expiration',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','edexp','Corrija Los Períodos De la Expiración',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','en','btn_change','Change',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','fr','btn_change','Changement',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','sp','btn_change','Cambio',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','en','btn_delete','Delete',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','fr','btn_delete','Effacement',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','sp','btn_delete','Quite',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','en','btn_new','New',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','fr','btn_new','Nouveau',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','sp','btn_new','Nuevo',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','en','add_title','Add Expiration Period',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','fr','add_title','Ajoutez La Période D\'Expiration',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','sp','add_title','Agregue El Período De la Expiración',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','en','change_title','Change Expiration Period',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','fr','change_title','Changez La Période D\'Expiration',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','sp','change_title','Cambie El Período De la Expiración',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','en','btn_add','Add',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','fr','btn_add','Ajoutez',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','sp','btn_add','Agregue',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','en','delete_confirm','Please confirm delete of expiration period',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','fr','delete_confirm','Veuillez confirmer l\'effacement de la période d\'expiration',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','sp','delete_confirm','Confirme por favor la cancelación del período de la expiración',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','en','btn_confirm','Confirm',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','fr','btn_confirm','Confirmez',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','sp','btn_confirm','Confirme',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','en','btn_cancel','Cancel',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','fr','btn_cancel','Annulation',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','sp','btn_cancel','Cancelación',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','en','error_exp','Please specify expiration period',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','fr','error_exp','Veuillez indiquer la période d\'expiration',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','sp','error_exp','Especifique por favor el período de la expiración',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','en','error_title','Please specify title',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','fr','error_title','Veuillez indiquer le titre',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','sp','error_title','Especifique por favor el título',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','en','error_days','Please specify the number of days',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','fr','error_days','Veuillez indiquer le nombre de jours',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','sp','error_days','Especifique por favor el número de días',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','en','exp_added','Expiration Period Added',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','fr','exp_added','Période D\'Expiration Supplémentaire',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','sp','exp_added','Período De la Expiración Agregado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','en','exp_changed','Expiration Period Changed',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','fr','exp_changed','Période D\'Expiration Changée',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','sp','exp_changed','Período De la Expiración Cambiante',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','en','exp_deleted','Expiration Period Deleted',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','fr','exp_deleted','La Période D\'Expiration A supprimé',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','sp','exp_deleted','El Período De la Expiración Suprimió',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','sp','title_tag','Períodos De la Expiración',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','en','title_tag','Expiration Periods',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','fr','title_tag','Périodes D\'Expiration',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','en','breadcrumb','Expiration Periods',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','fr','breadcrumb','Périodes D\'Expiration',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edexp','sp','breadcrumb','Períodos De la Expiración',0,'');");


//************************************
//Admin table (pds_admin)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','pds_admin','Admin Table',1,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','pds_admin','Tableau D\'Admin',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','pds_admin','Tabla Del Admin',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_admin','en','login','Login',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_admin','fr','login','Ouverture',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_admin','sp','login','Conexión',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_admin','en','pass','Password',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_admin','fr','pass','Mot de passe',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_admin','sp','pass','Contraseña',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_admin','en','f_full','Full Access',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_admin','fr','f_full','Plein Accès',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_admin','sp','f_full','Acceso Completo',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_admin','en','f_user','User',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_admin','fr','f_user','Utilisateur',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_admin','sp','f_user','Usuario',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_admin','en','f_list','Listings',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_admin','fr','f_list','Listes',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_admin','sp','f_list','Listados',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_admin','en','f_category','Categories',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_admin','fr','f_category','Catégories',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_admin','sp','f_category','Categorías',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_admin','en','f_level','Membership Levels',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_admin','fr','f_level','Niveaux D\'Adhésion',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_admin','sp','f_level','Niveles De la Calidad de miembro',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_admin','en','f_exp','Expiration Periods',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_admin','fr','f_exp','Périodes D\'Expiration',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_admin','sp','f_exp','Períodos De la Expiración',0,'');");


//************************************
//Category table (pds_category)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','pds_category','Category Table',1,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','pds_category','Tableau De Catégorie',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','pds_category','Tabla De la Categoría',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_category','en','id','ID',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_category','fr','id','Identification',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_category','sp','id','Identificación',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_category','en','title','Title',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_category','fr','title','Titre',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_category','sp','title','Título',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_category','en','p','Parent',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_category','fr','p','Parent',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_category','sp','p','Padre',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_category','en','f_mt','Empty Flag',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_category','fr','f_mt','Drapeau Vide',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_category','sp','f_mt','Bandera Vacía',0,'');");



//************************************
//Listing Statistics table (pds_liststats)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','pds_liststats','Listing Statistics Table',1,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','pds_liststats','Tableau De Statistiques De Liste',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','pds_liststats','Tabla De la Estadística Del Listado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_liststats','en','list_id','Listing ID',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_liststats','fr','list_id','Identification De Liste',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_liststats','sp','list_id','Identificación Del Listado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_liststats','en','page_views','Page Views',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_liststats','fr','page_views','Vues De Page',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_liststats','sp','page_views','página de la visión',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_liststats','en','sub_views','Sub Listing Views',0,'');");
//**mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_liststats','fr','sub_views','Clic Secondaire De Liste À travers',0,'');");
//**mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_liststats','sp','sub_views','Tecleo Secundario Del Listado A través',0,'');");


//************************************
//Location Selects table (pds_locsel)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','pds_locsel','Location Select Table',1,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','pds_locsel','Tableau Choisi D\'Endroit',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','pds_locsel','Tabla Selecta De la Localización',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_locsel','en','id','ID',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_locsel','fr','id','Identification',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_locsel','sp','id','Identificación',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_locsel','en','title','Title',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_locsel','fr','title','Titre',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_locsel','sp','title','Título',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_locsel','en','p','Parent',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_locsel','fr','p','Parent',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_locsel','sp','p','Padre',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_locsel','en','level','Location Level',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_locsel','fr','level','Niveau D\'Endroit',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_locsel','sp','level','Nivel De la Localización',0,'');");


//************************************
//Location Text table (pds_loctxt)
//************************************
//**Set not valid?
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','pds_loctxt','Location Text Table',1,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','pds_loctxt','Tableau Des Textes D\'Endroit',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','pds_loctxt','Tabla Del Texto De la Localización',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_loctxt','en','list_id','Listing ID',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_loctxt','fr','list_id','Identification De Liste',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_loctxt','sp','list_id','Identificación Del Listado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_loctxt','en','loc1','Location One',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_loctxt','fr','loc1','Endroit Un',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_loctxt','sp','loc1','Localización Una',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_loctxt','en','loc2','Location Two',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_loctxt','fr','loc2','Endroit Deux',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_loctxt','sp','loc2','Localización Dos',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_loctxt','en','loc3','Location Three',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_loctxt','fr','loc3','Endroit Trois',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_loctxt','sp','loc3','Localización Tres',0,'');");


//************************************
//User table (pds_user)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','pds_user','User Table',1,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','pds_user','Tableau D\'Utilisateur',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','pds_user','Tabla De Usuario',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_user','en','id','ID',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_user','fr','id','Identification',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_user','sp','id','Identificación',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_user','en','login','Login',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_user','fr','login','Ouverture',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_user','sp','login','Conexión',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_user','en','pass','Password',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_user','fr','pass','Mot de passe',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_user','sp','pass','Contraseña',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_user','en','usermail','E-mail',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_user','fr','usermail','E-mail',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_user','sp','usermail','E-mail',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_user','en','joindate','Date Joined',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_user','fr','joindate','Date Jointive',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_user','sp','joindate','Fecha Unida',0,'');");


//************************************
//Edit Categories page (edcat)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','edcat','Edit Categories',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','edcat','Éditez Les Catégories',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','edcat','Corrija Las Categorías',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edcat','en','title_tag','Edit Categories',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edcat','fr','title_tag','Éditez Les Catégories',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edcat','sp','title_tag','Corrija Las Categorías',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edcat','en','breadcrumb','Edit Categories',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edcat','fr','breadcrumb','Éditez Les Catégories',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edcat','sp','breadcrumb','Corrija Las Categorías',0,'');");


//************************************
//Edit Locations page (edloc)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','edloc','Edit Location Selects',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','edloc','Éditez L\'Endroit Choisit',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','edloc','Corrija La Localización Selecciona',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edloc','en','title_tag','Edit Location Selects',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edloc','fr','title_tag','Éditez L\'Endroit Choisit',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edloc','sp','title_tag','Corrija La Localización Selecciona',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edloc','en','breadcrumb','Edit Location Selects',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edloc','fr','breadcrumb','Éditez L\'Endroit Choisit',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edloc','sp','breadcrumb','Corrija La Localización Selecciona',0,'');");


//************************************
//Show Page (showpage)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','showpage','Show Pages',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','showpage','Montrez Les Pages',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','showpage','Demuestre Las Páginas',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('showpage','en','compare','Comparison Chart',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('showpage','fr','compare','Tableau',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('showpage','sp','compare','Carta De Comparación',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('showpage','en','terms','Terms of Use',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('showpage','fr','terms','Limites d\'utilisation',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('showpage','sp','terms','Términos del uso',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('showpage','en','privacy','Privacy Policy',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('showpage','fr','privacy','Politique D\'Intimité',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('showpage','sp','privacy','Política De Aislamiento',0,'');");


//************************************
//Comparison Chart (compare)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','compare','Comparison Chart',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','compare','Tableau',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','compare','Carta De Comparación',0,'');");

//** Valid?
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('compare','en','title','Membership Comparison Chart',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('compare','fr','title','Tableau D\'Adhésion',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('compare','sp','title','Carta De Comparación De la Calidad de miembro',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('compare','en','expire','Expiration',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('compare','fr','expire','Expiration',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('compare','sp','expire','Expiración',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('compare','en','cats','Categories',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('compare','fr','cats','Catégories',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('compare','sp','cats','Categorías',0,'');");


//************************************
//Show Listings (show)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','show','Show Page Text',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','show','Montrez Le Texte De Page',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','show','Demuestre El Texto De la Página',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('show','en','title_tag','View Listing',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('show','fr','title_tag','Liste De Vue',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('show','sp','title_tag','Listado De la Visión',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('show','en','breadcrumb','Listing',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('show','fr','breadcrumb','Liste',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('show','sp','breadcrumb','Listado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('show','en','cat_path','Listed in these categories',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('show','fr','cat_path','Énuméré dans ces catégories',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('show','sp','cat_path','Enumerado en estas categorías',0,'');");


//************************************
//Edit Language page (edlang)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','edlang','Language Panel Text',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','edlang','Texte De Panneau De Langue',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','edlang','Texto Del Panel De la Lengua',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlang','en','title_tag','Language Panel',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlang','fr','title_tag','Panneau De Langue',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlang','sp','title_tag','Panel De la Lengua',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlang','en','breadcrumb','Language Panel',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlang','fr','breadcrumb','Panneau De Langue',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlang','sp','breadcrumb','Panel De la Lengua',0,'');");


//************************************
//Search Results page (search)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','search','Search Text',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','search','Texte De Recherche',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','search','Texto De la Búsqueda',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('search','en','title_tag','Search',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('search','fr','title_tag','Recherche',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('search','sp','title_tag','Búsqueda',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('search','en','breadcrumb','Search Results',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('search','fr','breadcrumb','Résultats De Recherche',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('search','sp','breadcrumb','Resultados De la Búsqueda',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('search','en','search','Search',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('search','fr','search','Recherche',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('search','sp','search','Búsqueda',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('search','en','any','Any',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('search','fr','any','Quels',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('search','sp','any','Cualesquiera',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('search','en','all','All',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('search','fr','all','Tous',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('search','sp','all','Todos',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('search','en','keyword','Keyword(s)',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('search','fr','keyword','Mot-clé',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('search','sp','keyword','Palabra clave',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('search','en','result','Results Found',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('search','fr','result','Résultats Trouvés',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('search','sp','result','Resultados Encontrados',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('search','en','not_found','No records found, please try again',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('search','fr','not_found','Disque n\'a pas trouvé, satisfait l\'essai encore',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('search','sp','not_found','Ningunos expedientes encontraron, satisfacen intento otra vez',0,'');");


//************************************
//Search Results page (import)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','import','Import Text',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','import','Texte D\'Importation',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','import','Texto De la Importación',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','en','breadcrumb','Import Records',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','fr','breadcrumb','Disques D\'Importation',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','sp','breadcrumb','Expedientes De la Importación',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','en','import_title','Import Data',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','fr','import_title','Données D\'Importation',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','sp','import_title','Datos De la Importación',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','en','import_type','File Type',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','fr','import_type','Type De Dossier',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','sp','import_type','Tipo Del Archivo',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','en','import_list','Listing Data',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','fr','import_list','Données De Liste',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','sp','import_list','Datos Del Listado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','en','import_file','Filename',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','fr','import_file','Nom de fichier',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','sp','import_file','Nombre de fichero',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','en','import_action','Action',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','fr','import_action','Action',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','sp','import_action','Acción',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','en','action_update','Update',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','fr','action_update','Mise à jour',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','sp','action_update','Actualización',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','en','action_new','New',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','fr','action_new','Nouveau',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','sp','action_new','Nuevo',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','en','warn_new','Warning... selecting new will erase current data',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','fr','warn_new','Avertir... choisissant la nouvelle volonté effacent des données courantes',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','sp','warn_new','El cuidado... seleccionando nueva voluntad borra datos actuales',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','en','delim','Delimiter',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','fr','delim','Délimiteur',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','sp','delim','Delimitador',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','en','assign_list','Listing Data Order',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','fr','assign_list','Ordre De Données De Liste',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','sp','assign_list','Orden De los Datos Del Listado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','en','title_tag','Import Records',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','fr','title_tag','Disques D\'Importation',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','sp','title_tag','Expedientes De la Importación',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','en','import_zip','Postal Code Data',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','fr','import_zip','Données Postales De Code',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','sp','import_zip','Datos Postales Del Código',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','en','assign_zip','Postal Code Data Order',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','fr','assign_zip','Ordre Postal De Données De Code',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','sp','assign_zip','Orden Postal De los Datos Del Código',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','en','btn_import','Import',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','fr','btn_import','Importation',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','sp','btn_import','Importación',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','en','empty_table','Table emptied',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','fr','empty_table','Tableau vidé',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','sp','empty_table','Tabla vaciada',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','en','data_done','Data import complete',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','fr','data_done','Les données importent complet',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','sp','data_done','Los datos importan completo',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','en','error_no_data','No data found',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','fr','error_no_data','Aucunes données trouvées',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','sp','error_no_data','Ningunos datos encontraron',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','en','error_bad_order','Specified order not correct',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','fr','error_bad_order','Ordre spécifique non correct',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','sp','error_bad_order','Orden especificada no correcta',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','en','error_no_table','Table not found',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','fr','error_no_table','Tableau non trouvé',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('import','sp','error_no_table','Tabla no encontrada',0,'');");


//************************************
//Category slave set (category)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','category','Category',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','category','Category',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','category','Category',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_admin','en','category','slave=1',0,'');");


//************************************
//Alpha Search (alpha_list)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','alpha_list','Alpha Search',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','alpha_list','Recherche D\'Alpha',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','alpha_list','Búsqueda De la Alfa',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('alpha_list','en','search_alpha','Show firms starting with',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('alpha_list','fr','search_alpha','Montrez les sociétés commençant par',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('alpha_list','sp','search_alpha','Demuestre las firmas comenzando con',0,'');");


//************************************
//Edit Listings Page (edlist)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','edlist','Edit Listing Text',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','edlist','Éditez Le Texte De Liste',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','edlist','Corrija El Texto Del Listado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlist','en','title_tag','Edit Listing',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlist','fr','title_tag','Éditez La Liste',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlist','sp','title_tag','Corrija El Listado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlist','en','breadcrumb','Edit Listing',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlist','fr','breadcrumb','Éditez La Liste',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlist','sp','breadcrumb','Corrija El Listado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlist','en','btn_add_cat','Add',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlist','fr','btn_add_cat','Ajoutez',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlist','sp','btn_add_cat','Agregue',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlist','en','btn_rem_cat','Remove',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlist','fr','btn_rem_cat','Enlevez',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlist','sp','btn_rem_cat','Quite',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlist','en','step_details','Details Step',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlist','fr','step_details','Étape détaillée',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlist','sp','step_details','Paso De Detalles',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlist','en','cat_list','Listed in categories',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlist','fr','cat_list','Énuméré dans les catégories',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlist','sp','cat_list','Enumerado en categorías',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlist','en','sel_cat','Select Category',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlist','fr','sel_cat','Choisissez La Catégorie',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlist','sp','sel_cat','Seleccione La Categoría',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlist','en','btn_submit','Submit',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlist','fr','btn_submit','Soumettez',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlist','sp','btn_submit','Someta',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlist','en','btn_upload','Upload',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlist','fr','btn_upload','Téléchargement',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlist','sp','btn_upload','Upload',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlist','en','cats_left','Categories Left',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlist','fr','cats_left','Catégories Laissées',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlist','sp','cats_left','Las Categorías Se fueron',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlist','en','total','Total',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlist','fr','total','Total',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('edlist','sp','total','Total',0,'');");


//************************************
//Listings State page (liststate)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','liststate','Listing State',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','liststate','État De Liste',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','liststate','Estado Del Listado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('liststate','en','sub','Submitted',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('liststate','fr','sub','Soumis',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('liststate','sp','sub','Sometido',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('liststate','en','del','Deleted',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('liststate','fr','del','Supprimé',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('liststate','sp','del','Suprimido',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('liststate','en','apr','Approved',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('liststate','fr','apr','Approuvé',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('liststate','sp','apr','Aprobado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('liststate','en','upd','Updated',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('liststate','fr','upd','Mis à jour',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('liststate','sp','upd','Actualizado',0,'');");


//************************************
//Listing Statistics page (liststats)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','liststats','Listing Statistics Text',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','liststats','Texte De Statistiques De Liste',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','liststats','Texto De la Estadística Del Listado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('liststats','en','title_tag','Listing Statistics',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('liststats','fr','title_tag','Statistiques De Liste',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('liststats','sp','title_tag','Estadística Del Listado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('liststats','en','breadcrumb','Listing Statistics',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('liststats','fr','breadcrumb','Statistiques De Liste',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('liststats','sp','breadcrumb','Estadística Del Listado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('liststats','en','title','Listing Statistics',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('liststats','fr','title','Statistiques De Liste',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('liststats','sp','title','Estadística Del Listado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('liststats','en','stat_subviews','Sub Listing Views',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('liststats','fr','stat_subviews','Vues Secondaires De Liste',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('liststats','sp','stat_subviews','Opiniones Secundarias Del Listado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('liststats','en','stat_pageviews','Page Views',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('liststats','fr','stat_pageviews','Vues De Page',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('liststats','sp','stat_pageviews','Opiniones De la Página',0,'');");


//************************************
//Contact page (contact)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','contact','Contact Form Text',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','contact','Texte De Forme De Contact',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','contact','Texto De la Forma Del Contacto',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','en','step','Send Message',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','fr','step','Envoyez Le Message',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','sp','step','Envíe El Mensaje',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','en','from_title','Name',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','fr','from_title','Nom',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','sp','from_title','Nombre',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','en','from','E-mail',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','fr','from','E-mail',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','sp','from','E-mail',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','en','subject','Subject',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','fr','subject','Sujet',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','sp','subject','Tema',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','en','message','Message',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','fr','message','Message',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','sp','message','Mensaje',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','en','btn_send','Send',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','fr','btn_send','Envoyez',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','sp','btn_send','Envíe',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','en','sent_msg','Your message has been sent',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','fr','sent_msg','Votre message a été envoyé',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','sp','sent_msg','Se ha enviado su mensaje',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','en','web_link','Visit Website',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','fr','web_link','Site Web De Visite',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','sp','web_link','Web site De la Visita',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','en','refer_link','Refer a friend',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','fr','refer_link','Référez-vous un ami',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','sp','refer_link','Refiera a amigo',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','en','contact_link','Send Message',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','fr','contact_link','Envoyez Le Message',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','sp','contact_link','Envíe El Mensaje',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','en','title_tag','Send Message',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','fr','title_tag','Envoyez Le Message',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','sp','title_tag','Envíe El Mensaje',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','en','breadcrumb','Send Message',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','fr','breadcrumb','Envoyez Le Message',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','sp','breadcrumb','Envíe El Mensaje',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','en','map_link','Directions',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','fr','map_link','Directions',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','sp','map_link','Direcciones',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','en','refer_to','Friends E-mail',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','fr','refer_to','E-mail D\'Amis',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('contact','sp','refer_to','E-mail De los Amigos',0,'');");


//************************************
//Upgrade Membership page (upgrade)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','upgrade','Membership Upgrade Text',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','upgrade','Texte De Mise à niveau D\'Adhésion',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','upgrade','Texto De la Mejora De la Calidad de miembro',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','en','title_tag','Change Membership',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','fr','title_tag','Changez L\'Adhésion',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','sp','title_tag','Cambie La Calidad de miembro',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','en','breadcrumb','Change Membership',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','fr','breadcrumb','Changez L\'Adhésion',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','sp','breadcrumb','Cambie La Calidad de miembro',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','en','never_expire','Never Expires',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','fr','never_expire','N\'expire jamais',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','sp','never_expire','Nunca Expira',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','en','current_level','Current Level',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','fr','current_level','Niveau Courant',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','sp','current_level','Nivel Actual',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','en','days_left','Days Left',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','fr','days_left','Les Jours Sont partis',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','sp','days_left','Días Dejados',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','en','value_left','Value remaining',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','fr','value_left','Valeur restante',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','sp','value_left','Valor restante',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','en','same_level','Add more time to current membership level',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','fr','same_level','Ajoutez plus de temps au niveau courant d\'adhésion',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','sp','same_level','Agregue más tiempo al nivel actual de la calidad de miembro',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','en','same_exp','Upgrade/Downgrade listing',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','fr','same_exp','Améliorez/Descendez La Liste',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','sp','same_exp','Aumente/Retroceda El Listado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','en','dif_exp','Upgrade/Downgrade Listing',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','fr','dif_exp','Améliorez/Descendez La Liste',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','sp','dif_exp','Aumente/Retroceda El Listado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','en','no_exp','Upgrade/Downgrade Listing',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','fr','no_exp','Améliorez/Descendez La Liste',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','sp','no_exp','Aumente/Retroceda El Listado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','en','btn_paypal','Paypal',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','fr','btn_paypal','Paypal',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','sp','btn_paypal','Paypal',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','en','btn_change','Change',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','fr','btn_change','Changement',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','sp','btn_change','Cambio',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','en','new_level','Level',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','fr','new_level','Niveau',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','sp','new_level','Nivel',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','en','new_cost','Cost',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','fr','new_cost','Coût',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','sp','new_cost','Coste',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','en','new_exp','New Expiration',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','fr','new_exp','Nouvelle Expiration',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','sp','new_exp','Nueva Expiración',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','en','btn_billing','Bill Me',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','fr','btn_billing','Affichez-Moi',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','sp','btn_billing','Mándeme la cuenta',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','en','list_upgraded','Your listing has been upgraded',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','fr','list_upgraded','Votre liste a été améliorée',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','sp','list_upgraded','Se ha aumentado su listado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','en','list_changed','Your listing has been changed',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','fr','list_changed','Votre liste a été changée',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','sp','list_changed','Se ha cambiado su listado',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','en','bill_sent','Your billing request has been sent',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','fr','bill_sent','Votre demande de facturation a été envoyée',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('upgrade','sp','bill_sent','Se ha enviado su petición de la facturación',0,'');");


//************************************
//Template Sets (template)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','template','Template Sets',-2,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','template','Ensembles De Calibre',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','template','Sistemas De la Plantilla',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('template','en','default','Default',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('template','fr','default','Défaut',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('template','sp','default','Defecto',0,'');");


//************************************
//Location Relations (pds_locrelate)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','pds_locrelate','Location Relation Table',1,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','pds_locrelate','Tableau De Relation D\'Endroit',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','pds_locrelate','Tabla De la Relación De la Localización',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_locrelate','en','zip','Postal Code',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_locrelate','fr','zip','Code Postal',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_locrelate','sp','zip','Código Postal',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_locrelate','en','loc_prim','Primary Location',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_locrelate','fr','loc_prim','Endroit Primaire',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_locrelate','sp','loc_prim','Localización Primaria',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_locrelate','en','loc_sec','Secondary Location',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_locrelate','fr','loc_sec','Endroit Secondaire',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_locrelate','sp','loc_sec','Localización Secundaria',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_locrelate','en','lat','Latitude',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_locrelate','fr','lat','Latitude',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_locrelate','sp','lat','Latitud',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_locrelate','en','lon','Longitude',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_locrelate','fr','lon','Longitude',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('pds_locrelate','sp','lon','Longitud',0,'');");

echo 'Language file updated';
?>