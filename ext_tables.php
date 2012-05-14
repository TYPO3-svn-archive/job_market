<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');



    ///////////////////////////////////////////////////////////
    //
    // INDEX
    
    // Enables the Include Static Template
    // TCA



    ///////////////////////////////////////
    // 
    // Enables the Include Static Template

t3lib_extMgm::addStaticFile($_EXTKEY,'static/','Job Market');
t3lib_extMgm::addStaticFile($_EXTKEY,'static/rss/','+Job Market - RSS');
    // Enables the Include Static Template



    ///////////////////////////////////////
    // 
    // TCA

$TCA['tx_jobmarket_main'] = array (
  'ctrl' => array (
    'title'     => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main',
    'label'     => 'title',
    'tstamp'    => 'tstamp',
    'crdate'    => 'crdate',
    'cruser_id' => 'cruser_id',
    'languageField'            => 'sys_language_uid',
    'transOrigPointerField'    => 'l10n_parent',
    'transOrigDiffSourceField' => 'l10n_diffsource',
    'default_sortby' => 'ORDER BY title',
    'delete' => 'deleted',
    'enablecolumns' => array (
      'disabled' => 'hidden',
      'starttime' => 'starttime',
      'endtime' => 'endtime',
    ),
    'dividers2tabs'     => TRUE,
    'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
    'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'ext_icon.gif',
  ),
);

$TCA['tx_jobmarket_contractor'] = array (
  'ctrl' => array (
    'title'     => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_contractor',
    'label'     => 'title',
    'tstamp'    => 'tstamp',
    'crdate'    => 'crdate',
    'cruser_id' => 'cruser_id',
    'default_sortby' => 'ORDER BY title',
    'delete' => 'deleted',
    'enablecolumns' => array (
      'disabled' => 'hidden',
    ),
    'dividers2tabs'     => TRUE,
    'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
    'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'ext_icon.gif',
  ),
);

$TCA['tx_jobmarket_region'] = array (
  'ctrl' => array (
    'title'     => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_region',
    'label'     => 'title',
    'tstamp'    => 'tstamp',
    'crdate'    => 'crdate',
    'cruser_id' => 'cruser_id',
    'default_sortby' => 'ORDER BY title',
    'delete' => 'deleted',
    'enablecolumns' => array (
      'disabled' => 'hidden',
    ),
    'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
    'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'ext_icon.gif',
  ),
);

$TCA['tx_jobmarket_county'] = array (
  'ctrl' => array (
    'title'     => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_county',
    'label'     => 'title',
    'tstamp'    => 'tstamp',
    'crdate'    => 'crdate',
    'cruser_id' => 'cruser_id',
    'default_sortby' => 'ORDER BY title',
    'delete' => 'deleted',
    'enablecolumns' => array (
      'disabled' => 'hidden',
    ),
    'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
    'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'ext_icon.gif',
  ),
);

$TCA['tx_jobmarket_sector'] = array (
  'ctrl' => array (
    'title'     => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_sector',
    'label'     => 'title',
    'tstamp'    => 'tstamp',
    'crdate'    => 'crdate',
    'cruser_id' => 'cruser_id',
    'default_sortby' => 'ORDER BY title',
    'delete' => 'deleted',
    'enablecolumns' => array (
      'disabled' => 'hidden',
    ),
    'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
    'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'ext_icon.gif',
  ),
);

$TCA['tx_jobmarket_sectorgroup'] = array (
  'ctrl' => array (
    'title'     => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_sectorgroup',
    'label'     => 'title',
    'tstamp'    => 'tstamp',
    'crdate'    => 'crdate',
    'cruser_id' => 'cruser_id',
    'default_sortby' => 'ORDER BY title',
    'delete' => 'deleted',
    'enablecolumns' => array (
      'disabled' => 'hidden',
    ),
    'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
    'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'ext_icon.gif',
  ),
);

$TCA['tx_jobmarket_type'] = array (
  'ctrl' => array (
    'title'     => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_type',
    'label'     => 'title',
    'tstamp'    => 'tstamp',
    'crdate'    => 'crdate',
    'cruser_id' => 'cruser_id',
    'default_sortby' => 'ORDER BY title',
    'delete' => 'deleted',
    'enablecolumns' => array (
      'disabled' => 'hidden',
    ),
    'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
    'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'ext_icon.gif',
  ),
);
    // TCA

?>