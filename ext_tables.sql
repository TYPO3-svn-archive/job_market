#
# Table structure for table 'tx_jobmarket_main'
#
CREATE TABLE tx_jobmarket_main (
  uid int(11) NOT NULL auto_increment,
  pid int(11) DEFAULT '0' NOT NULL,
  tstamp int(11) DEFAULT '0' NOT NULL,
  crdate int(11) DEFAULT '0' NOT NULL,
  cruser_id int(11) DEFAULT '0' NOT NULL,
  sys_language_uid int(11) DEFAULT '0' NOT NULL,
  l10n_parent int(11) DEFAULT '0' NOT NULL,
  l10n_diffsource mediumtext,
  deleted tinyint(4) DEFAULT '0' NOT NULL,
  hidden tinyint(4) DEFAULT '0' NOT NULL,
  starttime int(11) DEFAULT '0' NOT NULL,
  endtime int(11) DEFAULT '0' NOT NULL,
  title tinytext,
  reference_number tinytext,
  quantity tinytext,
  type tinytext,
  short text,
  note text,
  description text,
  specification text,
  sector tinytext,
  sectorgroup tinytext,
  region tinytext,
  county tinytext,
  location tinytext,
  contractor tinytext,
  fe_user tinytext,
  image text,
  imagecaption text,
  imagealttext text,
  imagetitletext text,
  documents text,
  thirdparty_id tinytext,
  
  PRIMARY KEY (uid),
  KEY parent (pid)
);



#
# Table structure for table 'tx_jobmarket_contractor'
#
CREATE TABLE tx_jobmarket_contractor (
  uid int(11) NOT NULL auto_increment,
  pid int(11) DEFAULT '0' NOT NULL,
  tstamp int(11) DEFAULT '0' NOT NULL,
  crdate int(11) DEFAULT '0' NOT NULL,
  cruser_id int(11) DEFAULT '0' NOT NULL,
  deleted tinyint(4) DEFAULT '0' NOT NULL,
  hidden tinyint(4) DEFAULT '0' NOT NULL,
  title tinytext,
  title_lang_ol tinytext,
  company tinytext,
  company_lang_ol tinytext,
  contact_person tinytext,
  contact_person_lang_ol tinytext,
  address text,
  address_lang_ol text,
  email tinytext,
  email_lang_ol tinytext,
  url tinytext,
  url_lang_ol tinytext,
  image text,
  imagecaption text,
  imagecaption_lang_ol text,
  imagealttext text,
  imagealttext_lang_ol text,
  imagetitletext text,
  imagetitletext_lang_ol text,
  thirdparty_id tinytext,
  
  PRIMARY KEY (uid),
  KEY parent (pid)
);






#
# Table structure for table 'tx_jobmarket_county'
#
CREATE TABLE tx_jobmarket_county (
  uid int(11) NOT NULL auto_increment,
  pid int(11) DEFAULT '0' NOT NULL,
  tstamp int(11) DEFAULT '0' NOT NULL,
  crdate int(11) DEFAULT '0' NOT NULL,
  cruser_id int(11) DEFAULT '0' NOT NULL,
  deleted tinyint(4) DEFAULT '0' NOT NULL,
  hidden tinyint(4) DEFAULT '0' NOT NULL,
  title tinytext,
  title_lang_ol tinytext,
  image text,
  imagecaption text,
  imagecaption_lang_ol text,
  imagealttext text,
  imagealttext_lang_ol text,
  imagetitletext text,
  imagetitletext_lang_ol text,
  thirdparty_id tinytext,
  
  PRIMARY KEY (uid),
  KEY parent (pid)
);



#
# Table structure for table 'tx_jobmarket_region'
#
CREATE TABLE tx_jobmarket_region (
  uid int(11) NOT NULL auto_increment,
  pid int(11) DEFAULT '0' NOT NULL,
  tstamp int(11) DEFAULT '0' NOT NULL,
  crdate int(11) DEFAULT '0' NOT NULL,
  cruser_id int(11) DEFAULT '0' NOT NULL,
  deleted tinyint(4) DEFAULT '0' NOT NULL,
  hidden tinyint(4) DEFAULT '0' NOT NULL,
  title tinytext,
  title_lang_ol tinytext,
  image text,
  imagecaption text,
  imagecaption_lang_ol text,
  imagealttext text,
  imagealttext_lang_ol text,
  imagetitletext text,
  imagetitletext_lang_ol text,
  thirdparty_id tinytext,
  
  PRIMARY KEY (uid),
  KEY parent (pid)
);



#
# Table structure for table 'tx_jobmarket_sector'
#
CREATE TABLE tx_jobmarket_sector (
  uid int(11) NOT NULL auto_increment,
  pid int(11) DEFAULT '0' NOT NULL,
  tstamp int(11) DEFAULT '0' NOT NULL,
  crdate int(11) DEFAULT '0' NOT NULL,
  cruser_id int(11) DEFAULT '0' NOT NULL,
  deleted tinyint(4) DEFAULT '0' NOT NULL,
  hidden tinyint(4) DEFAULT '0' NOT NULL,
  title tinytext,
  title_lang_ol tinytext,
  image text,
  imagecaption text,
  imagecaption_lang_ol text,
  imagealttext text,
  imagealttext_lang_ol text,
  imagetitletext text,
  imagetitletext_lang_ol text,
  thirdparty_id tinytext,
  
  PRIMARY KEY (uid),
  KEY parent (pid)
);



#
# Table structure for table 'tx_jobmarket_sectorgroup'
#
CREATE TABLE tx_jobmarket_sectorgroup (
  uid int(11) NOT NULL auto_increment,
  pid int(11) DEFAULT '0' NOT NULL,
  tstamp int(11) DEFAULT '0' NOT NULL,
  crdate int(11) DEFAULT '0' NOT NULL,
  cruser_id int(11) DEFAULT '0' NOT NULL,
  deleted tinyint(4) DEFAULT '0' NOT NULL,
  hidden tinyint(4) DEFAULT '0' NOT NULL,
  title tinytext,
  title_lang_ol tinytext,
  image text,
  imagecaption text,
  imagecaption_lang_ol text,
  imagealttext text,
  imagealttext_lang_ol text,
  imagetitletext text,
  imagetitletext_lang_ol text,
  thirdparty_id tinytext,
  
  PRIMARY KEY (uid),
  KEY parent (pid)
);



#
# Table structure for table 'tx_jobmarket_type'
#
CREATE TABLE tx_jobmarket_type (
  uid int(11) NOT NULL auto_increment,
  pid int(11) DEFAULT '0' NOT NULL,
  tstamp int(11) DEFAULT '0' NOT NULL,
  crdate int(11) DEFAULT '0' NOT NULL,
  cruser_id int(11) DEFAULT '0' NOT NULL,
  deleted tinyint(4) DEFAULT '0' NOT NULL,
  hidden tinyint(4) DEFAULT '0' NOT NULL,
  title tinytext,
  title_lang_ol tinytext,
  image text,
  imagecaption text,
  imagecaption_lang_ol text,
  imagealttext text,
  imagealttext_lang_ol text,
  imagetitletext text,
  imagetitletext_lang_ol text,
  thirdparty_id tinytext,
  
  PRIMARY KEY (uid),
  KEY parent (pid)
);