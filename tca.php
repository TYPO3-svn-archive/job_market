<?php

if (!defined ('TYPO3_MODE'))
{
  die ('Access denied.');
}


  ///////////////////////////////////////
  // 
  // Localization support
  
$bool_LL = FALSE;
$confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['job_market']);
if (strtolower(substr($confArr['LLsupport'], 0, strlen('yes'))) == 'yes')
{
  $bool_LL = TRUE;
}
  // Localization support


  ///////////////////////////////////////
  // 
  // TCA Main
  
  // Non localized
$TCA['tx_jobmarket_main'] = array (
  'ctrl' => $TCA['tx_jobmarket_main']['ctrl'],
  'interface' => array (
    'showRecordFieldList' => 'hidden,starttime,endtime,title,reference_number,quantity,type,short,note,description,specification,fe_user,sector,sectorgroup,region,county,location,contractor,image,imagecaption,imagealttext,imagetitletext,documents',
  ),
  'feInterface' => $TCA['tx_jobmarket_main']['feInterface'],
  'columns' => array (
    'hidden' => array (
      'exclude' => 1,
      'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
      'config'  => array (
        'type'    => 'check',
        'default' => '0'
      )
    ),
    'starttime' => array (
      'exclude' => 1,
      'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
      'config'  => array (
        'type'     => 'input',
        'size'     => '8',
        'max'      => '20',
        'eval'     => 'date',
        'default'  => '0',
        'checkbox' => '0'
      )
    ),
    'endtime' => array (
      'exclude' => 1,
      'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
      'config'  => array (
        'type'     => 'input',
        'size'     => '8',
        'max'      => '20',
        'eval'     => 'date',
        'checkbox' => '0',
        'default'  => '0',
        'range'    => array (
          'upper' => mktime(3, 14, 7, 1, 19, 2038),
          'lower' => mktime(0, 0, 0, date('m')-1, date('d'), date('Y'))
        )
      )
    ),
    'title' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.title',
      'l10n_mode' => 'prefixLangTitle',
      'config' => array (
        'type' => 'input',
        'size' => '30',
        'eval' => 'required',
      )
    ),
    'reference_number' => array (
      'l10n_mode' => 'exclude',
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.reference_number',
      'config' => array (
        'type' => 'input',
        'size' => '30',
      )
    ),
    'quantity' => array (
      'l10n_mode' => 'exclude',
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.quantity',
      'config' => array (
        'type' => 'input',
        'size' => '3',
        'eval' => 'required,integer',
        'default' => '1'
      )
    ),
    'type' => array (
      'l10n_mode' => 'exclude',
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.type',
      'config' => array (
        'type' => 'select', 
        'size' => 1, 
        'minitems' => 0,
        'maxitems' => 1,
        'foreign_table' => 'tx_jobmarket_type',
        'foreign_table_where' => 'AND tx_jobmarket_type.pid=###CURRENT_PID### ORDER BY tx_jobmarket_type.title',
        'items' => array(
          '0' => array(
            '0' => '---',
            '1' => '',
          ),
        ),
        'wizards' => array(
          '_PADDING'  => 2,
          '_VERTICAL' => 0,
          'add' => array(
            'type'   => 'script',
            'title'  => 'LLL:EXT:job_market/locallang_db.xml:wizard.type.add',
            'icon'   => 'add.gif',
            'params' => array(
              'table'    => 'tx_jobmarket_type',
              'pid'      => '###CURRENT_PID###',
              'setValue' => 'prepend'
            ),
            'script' => 'wizard_add.php',
          ),
          'list' => array(
            'type'   => 'script',
            'title'  => 'LLL:EXT:job_market/locallang_db.xml:wizard.type.list',
            'icon'   => 'list.gif',
            'params' => array(
              'table' => 'tx_jobmarket_type',
              'pid'   => '###CURRENT_PID###',
            ),
            'script' => 'wizard_list.php',
          ),
          'edit' => array(
            'type'                     => 'popup',
            'title'  => 'LLL:EXT:job_market/locallang_db.xml:wizard.type.edit',
            'script'                   => 'wizard_edit.php',
            'popup_onlyOpenIfSelected' => 1,
            'icon'                     => 'edit2.gif',
            'JSopenParams'             => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
          ),
        ),
      )
    ),
    'short' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.short',
      'config' => array (
        'type' => 'text',
        'cols' => '30', 
        'rows' => '5',
      )
    ),
    'note' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.note',
      'config' => array (
        'type' => 'text',
        'cols' => '30', 
        'rows' => '5',
      )
    ),
    'description' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.description',
      'config' => array (
        'type' => 'text',
        'cols' => '30',
        'rows' => '5',
        'wizards' => array(
          '_PADDING' => 2,
          'RTE' => array(
            'notNewRecords' => 1,
            'RTEonly'       => 1,
            'type'          => 'script',
            'title'         => 'LLL:EXT:job_market/locallang_db.xml:wizard.rte.fullscreen',
            'icon'          => 'wizard_rte2.gif',
            'script'        => 'wizard_rte.php',
          ),
        ),
      )
    ),
    'specification' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.specification',
      'config' => array (
        'type' => 'text',
        'cols' => '30',
        'rows' => '5',
        'wizards' => array(
          '_PADDING' => 2,
          'RTE' => array(
            'notNewRecords' => 1,
            'RTEonly'       => 1,
            'type'          => 'script',
            'title'         => 'LLL:EXT:job_market/locallang_db.xml:wizard.rte.fullscreen',
            'icon'          => 'wizard_rte2.gif',
            'script'        => 'wizard_rte.php',
          ),
        ),
      )
    ),
    'fe_user' => array (
      'l10n_mode' => 'exclude',
      'exclude' => 0,
      'l10n_mode' => 'exclude',
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.fe_user', 
      'config' => array (
        'type' => 'select', 
        'foreign_table' => 'fe_users',
        'foreign_table_where' => 'AND fe_users.pid=###STORAGE_PID### ORDER BY fe_users.name',
        'size' => 1, 
        'minitems' => 0,
        'maxitems' => 1,  
        'items' => array(
          '0' => array(
            '0' => '---',
            '1' => '',
          ),
        ),
      )
    ),
    'sector' => array (
      'l10n_mode' => 'exclude',
      'exclude' => 0,
      'l10n_mode' => 'exclude',
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.sector', 
      'config' => array (
        'type' => 'select', 
        'foreign_table' => 'tx_jobmarket_sector',
        'foreign_table_where' => 'AND tx_jobmarket_sector.pid=###CURRENT_PID### ORDER BY tx_jobmarket_sector.title',
        'size' => 1, 
        'minitems' => 0,
        'maxitems' => 1,  
        'items' => array(
          '0' => array(
            '0' => '---',
            '1' => '',
          ),
        ),
        'wizards' => array(
          '_PADDING'  => 2,
          '_VERTICAL' => 0,
          'add' => array(
            'type'   => 'script',
            'title'  => 'LLL:EXT:job_market/locallang_db.xml:wizard.sector.add',
            'icon'   => 'add.gif',
            'params' => array(
              'table'    => 'tx_jobmarket_sector',
              'pid'      => '###CURRENT_PID###',
              'setValue' => 'prepend'
            ),
            'script' => 'wizard_add.php',
          ),
          'list' => array(
            'type'   => 'script',
            'title'  => 'LLL:EXT:job_market/locallang_db.xml:wizard.sector.list',
            'icon'   => 'list.gif',
            'params' => array(
              'table' => 'tx_jobmarket_sector',
              'pid'   => '###CURRENT_PID###',
            ),
            'script' => 'wizard_list.php',
          ),
          'edit' => array(
            'type'                     => 'popup',
            'title'                    => 'LLL:EXT:job_market/locallang_db.xml:wizard.sector.edit',
            'script'                   => 'wizard_edit.php',
            'popup_onlyOpenIfSelected' => 1,
            'icon'                     => 'edit2.gif',
            'JSopenParams'             => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
          ),
        ),
      )
    ),
    'sectorgroup' => array (
      'l10n_mode' => 'exclude',
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.sectorgroup', 
      'config' => array (
        'type' => 'select', 
        'foreign_table' => 'tx_jobmarket_sectorgroup',
        'foreign_table_where' => 'AND tx_jobmarket_sectorgroup.pid=###CURRENT_PID### ORDER BY tx_jobmarket_sectorgroup.title',
        'size' => 1, 
        'minitems' => 0,
        'maxitems' => 1,  
        'items' => array(
          '0' => array(
            '0' => '---',
            '1' => '',
          ),
        ),
        'wizards' => array(
          '_PADDING'  => 2,
          '_VERTICAL' => 0,
          'add' => array(
            'type'   => 'script',
            'title'  => 'LLL:EXT:job_market/locallang_db.xml:wizard.sectorgroup.add',
            'icon'   => 'add.gif',
            'params' => array(
              'table'    => 'tx_jobmarket_sectorgroup',
              'pid'      => '###CURRENT_PID###',
              'setValue' => 'prepend'
            ),
            'script' => 'wizard_add.php',
          ),
          'list' => array(
            'type'   => 'script',
            'title'  => 'LLL:EXT:job_market/locallang_db.xml:wizard.sectorgroup.list',
            'icon'   => 'list.gif',
            'params' => array(
              'table' => 'tx_jobmarket_sectorgroup',
              'pid'   => '###CURRENT_PID###',
            ),
            'script' => 'wizard_list.php',
          ),
          'edit' => array(
            'type'                     => 'popup',
            'title'                    => 'LLL:EXT:job_market/locallang_db.xml:wizard.sectorgroup.edit',
            'script'                   => 'wizard_edit.php',
            'popup_onlyOpenIfSelected' => 1,
            'icon'                     => 'edit2.gif',
            'JSopenParams'             => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
          ),
        ),
      )
    ),
    'region' => array (
      'l10n_mode' => 'exclude',
      'exclude' => 0,
      'l10n_mode' => 'exclude',
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.region', 
      'config' => array (
        'type' => 'select', 
        'foreign_table' => 'tx_jobmarket_region',
        'foreign_table_where' => 'AND tx_jobmarket_region.pid=###CURRENT_PID### ORDER BY tx_jobmarket_region.title',
        'size' => 1, 
        'minitems' => 0,
        'maxitems' => 1,  
        'items' => array(
          '0' => array(
            '0' => '---',
            '1' => '',
          ),
        ),
        'wizards' => array(
          '_PADDING'  => 2,
          '_VERTICAL' => 0,
          'add' => array(
            'type'   => 'script',
            'title'  => 'LLL:EXT:job_market/locallang_db.xml:wizard.region.add',
            'icon'   => 'add.gif',
            'params' => array(
              'table'    => 'tx_jobmarket_region',
              'pid'      => '###CURRENT_PID###',
              'setValue' => 'prepend'
            ),
            'script' => 'wizard_add.php',
          ),
          'list' => array(
            'type'   => 'script',
            'title'  => 'LLL:EXT:job_market/locallang_db.xml:wizard.region.list',
            'icon'   => 'list.gif',
            'params' => array(
              'table' => 'tx_jobmarket_region',
              'pid'   => '###CURRENT_PID###',
            ),
            'script' => 'wizard_list.php',
          ),
          'edit' => array(
            'type'                     => 'popup',
            'title'                    => 'LLL:EXT:job_market/locallang_db.xml:wizard.region.edit',
            'script'                   => 'wizard_edit.php',
            'popup_onlyOpenIfSelected' => 1,
            'icon'                     => 'edit2.gif',
            'JSopenParams'             => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
          ),
        ),
      )
    ),
    'county' => array (
      'l10n_mode' => 'exclude',
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.county', 
      'config' => array (
        'type' => 'select', 
        'foreign_table' => 'tx_jobmarket_county',
        'foreign_table_where' => 'AND tx_jobmarket_county.pid=###CURRENT_PID### ORDER BY tx_jobmarket_county.title',
        'size' => 1, 
        'minitems' => 0,
        'maxitems' => 1,  
        'items' => array(
          '0' => array(
            '0' => '---',
            '1' => '',
          ),
        ),
        'wizards' => array(
          '_PADDING'  => 2,
          '_VERTICAL' => 0,
          'add' => array(
            'type'   => 'script',
            'title'  => 'LLL:EXT:job_market/locallang_db.xml:wizard.county.add',
            'icon'   => 'add.gif',
            'params' => array(
              'table'    => 'tx_jobmarket_county',
              'pid'      => '###CURRENT_PID###',
              'setValue' => 'prepend'
            ),
            'script' => 'wizard_add.php',
          ),
          'list' => array(
            'type'   => 'script',
            'title'  => 'LLL:EXT:job_market/locallang_db.xml:wizard.county.list',
            'icon'   => 'list.gif',
            'params' => array(
              'table' => 'tx_jobmarket_county',
              'pid'   => '###CURRENT_PID###',
            ),
            'script' => 'wizard_list.php',
          ),
          'edit' => array(
            'type'                     => 'popup',
            'title'                    => 'LLL:EXT:job_market/locallang_db.xml:wizard.county.edit',
            'script'                   => 'wizard_edit.php',
            'popup_onlyOpenIfSelected' => 1,
            'icon'                     => 'edit2.gif',
            'JSopenParams'             => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
          ),
        ),
      )
    ),
    'contractor' => array (
      'l10n_mode' => 'exclude',
      'exclude' => 0,
      'l10n_mode' => 'exclude',
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.contractor', 
      'config' => array (
        'type' => 'select', 
        'foreign_table' => 'tx_jobmarket_contractor',
        'foreign_table_where' => 'AND tx_jobmarket_contractor.pid=###CURRENT_PID### ORDER BY tx_jobmarket_contractor.title',
        'size' => 1, 
        'minitems' => 0,
        'maxitems' => 1,  
        'items' => array(
          '0' => array(
            '0' => '---',
            '1' => '',
          ),
        ),
        'wizards' => array(
          '_PADDING'  => 2,
          '_VERTICAL' => 0,
          'add' => array(
            'type'   => 'script',
            'title'  => 'LLL:EXT:job_market/locallang_db.xml:wizard.contractor.add',
            'icon'   => 'add.gif',
            'params' => array(
              'table'    => 'tx_jobmarket_contractor',
              'pid'      => '###CURRENT_PID###',
              'setValue' => 'prepend'
            ),
            'script' => 'wizard_add.php',
          ),
          'list' => array(
            'type'   => 'script',
            'title'  => 'LLL:EXT:job_market/locallang_db.xml:wizard.contractor.list',
            'icon'   => 'list.gif',
            'params' => array(
              'table' => 'tx_jobmarket_contractor',
              'pid'   => '###CURRENT_PID###',
            ),
            'script' => 'wizard_list.php',
          ),
          'edit' => array(
            'type'                     => 'popup',
            'title'                    => 'LLL:EXT:job_market/locallang_db.xml:wizard.contractor.edit',
            'script'                   => 'wizard_edit.php',
            'popup_onlyOpenIfSelected' => 1,
            'icon'                     => 'edit2.gif',
            'JSopenParams'             => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
          ),
        ),
      )
    ),
    'location' => array (
      'l10n_mode' => 'exclude',
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.location',
      'config' => array (
        'type' => 'input',
        'size' => '30',
      )
    ),
    'image' => array (
      'l10n_mode' => 'exclude',
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.image',
      'config' => array (
        'type' => 'group',
        'internal_type' => 'file',
        'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'], 
        'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'], 
        'uploadfolder' => 'uploads/tx_jobmarket',
        'show_thumbs' => 1, 
        'size' => 3,  
        'minitems' => 0,
        'maxitems' => 10,
      )
    ),
    'imagecaption' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.imagecaption',
      'config' => array (
        'type' => 'text',
        'cols' => '30', 
        'rows' => '5',
      )
    ),
    'imagealttext' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.imagealttext',
      'config' => array (
        'type' => 'text',
        'cols' => '30', 
        'rows' => '5',
      )
    ),
    'imagetitletext' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.imagetitletext',
      'config' => array (
        'type' => 'text',
        'cols' => '30', 
        'rows' => '5',
      )
    ),
    'documents' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.documents',
      'config' => array (
        'type' => 'group',
        'internal_type' => 'file',
        'allowed' => '',
        'disallowed' => 'php,php3', 
        'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'], 
        'uploadfolder' => 'uploads/tx_jobmarket',
        'size' => 3,  
        'minitems' => 0,
        'maxitems' => 10,
      )
    ),
  ),
  'types' => array (
    '0' => array('showitem' => '--div--;LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.div_control,  sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1,'.
                               '--div--;LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.div_job, title;;2;;2-2-2, reference_number;;;;3-3-3,quantity,type,fe_user;;;;5-5-5,contractor;;;;4-4-4,'.
                               '--div--;LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.div_description, description;;;richtext[]:rte_transform[mode=ts],specification;;;richtext[]:rte_transform[mode=ts];3-3-3,'.
                               '--div--;LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.div_miscellaneous,sector;;3,region;;;;4-4-4,county,location,'.
                               '--div--;LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.div_docs,image;;;;1-1-1,imagecaption;;4,documents;;;;6-6-6'),
  ),
  'palettes' => array (
    '1' => array('showitem' => 'starttime, endtime'),
    '2' => array('showitem' => 'short,note'),
    '3' => array('showitem' => 'sectorgroup'),
    '4' => array('showitem' => 'imagealttext,imagetitletext'),
  )
);
  // Non localized

  // Localization support
if($bool_LL)
{
  // Add language overlay fields to showRecordFieldList
  $showRecordFieldList = $TCA['tx_jobmarket_main']['interface']['showRecordFieldList'];
  $TCA['tx_jobmarket_sectorgroup']['interface']['tx_jobmarket_main'] = $showRecordFieldList.',sys_language_uid,l10n_parent,l10n_diffsource';
  // Add language overlay fields to showRecordFieldList

  // Add localization fields to columns array
  $TCA['tx_jobmarket_main']['columns']['sys_language_uid'] = array
  (
    'l10n_mode' => 'exclude',
    'exclude' => 1,
    'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
    'config' => array (
      'type'                => 'select',
      'foreign_table'       => 'sys_language',
      'foreign_table_where' => 'ORDER BY sys_language.title',
      'items' => array(
        array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
        array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
      )
    )
  );
  $TCA['tx_jobmarket_main']['columns']['l10n_parent'] = array
  (
    'l10n_mode' => 'exclude',
    'displayCond' => 'FIELD:sys_language_uid:>:0',
    'exclude'     => 1,
    'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
    'config'      => array (
      'type'  => 'select',
      'items' => array (
        array('', 0),
      ),
      'foreign_table'       => 'tx_jobmarket_main',
      'foreign_table_where' => 'AND tx_jobmarket_main.pid=###CURRENT_PID### AND tx_jobmarket_main.sys_language_uid IN (-1,0)',
    )
  );
  $TCA['tx_jobmarket_main']['columns']['l10n_diffsource'] = array
  (
    'config' => array (
      'type' => 'passthrough'
    )
  );
  // Add localization fields to columns array
}
  // Localization support
  // TCA Main



  ///////////////////////////////////////
  // 
  // TCA Contractor
  
  // Non localized
$TCA['tx_jobmarket_contractor'] = array (
  'ctrl' => $TCA['tx_jobmarket_contractor']['ctrl'],
  'interface' => array (
    'showRecordFieldList' => 'hidden,title,company,contact_person,address,email,url,image,imagecaption,imagealttext,imagetitletext'
  ),
  'feInterface' => $TCA['tx_jobmarket_contractor']['feInterface'],
  'columns' => array (
    'hidden' => array (
      'exclude' => 1,
      'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
      'config'  => array (
        'type'    => 'check',
        'default' => '0'
      )
    ),
    'title' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_contractor.title',
      'config' => array (
        'type' => 'input',
        'size' => '30',
        'eval' => 'required',
      )
    ),
    'company' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_contractor.company',
      'config' => array (
        'type' => 'input',
        'size' => '30',
        'eval' => 'trim',
      )
    ),
    'contact_person' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_contractor.contact_person',
      'config' => array (
        'type' => 'input',
        'size' => '30',
        'eval' => 'trim',
      )
    ),
    'address' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_contractor.address',
      'config' => array (
        'type' => 'text',
        'cols' => '30', 
        'rows' => '5',
      )
    ),
    'email' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_contractor.email',
      'config' => array (
        'type' => 'input',
        'size' => '30',
        'eval' => 'trim,nospace,lower',
      )
    ),
    'url' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_contractor.url',
      'config' => array (
        'type'     => 'input',
        'size'     => '15',
        'max'      => '256',
        'checkbox' => '',
        'eval'     => 'trim',
        'wizards' => array (
          '_PADDING' => '2',
          'link'     => array (
            'type'         => 'popup',
            'title'        => 'Link',
            'icon'         => 'link_popup.gif',
            'script'       => 'browse_links.php?mode=wizard',
            'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1',
          ),
        ),
        'softref' => 'typolink',
      )
    ),
    'image' => array (
      'exclude' => 0,
      'l10n_mode' => 'exclude',
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.image',
      'config' => array (
        'type' => 'group',
        'internal_type' => 'file',
        'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'], 
        'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'], 
        'uploadfolder' => 'uploads/tx_jobmarket',
        'show_thumbs' => 1, 
        'size' => 3,  
        'minitems' => 0,
        'maxitems' => 10,
      )
    ),
    'imagecaption' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.imagecaption',
      'config' => array (
        'type' => 'text',
        'cols' => '30', 
        'rows' => '5',
      )
    ),
    'imagealttext' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.imagealttext',
      'config' => array (
        'type' => 'text',
        'cols' => '30', 
        'rows' => '5',
      )
    ),
    'imagetitletext' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.imagetitletext',
      'config' => array (
        'type' => 'text',
        'cols' => '30', 
        'rows' => '5',
      )
    ),
  ),
  'types' => array (
    '0' => array('showitem' => '--div--;LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_contractor.div_control,    hidden;;1;;1-1-1,'.
                               '--div--;LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_contractor.div_contractor, title;;%2%;;2-2-2,company;;;;3-3-3,contact_person,address,email,url,'.
                               '--div--;LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_contractor.div_docs,       image;;;;3-3-3,imagecaption;;%3%;;,imagealttext;;%4%;;,imagetitletext;;%5%;;')
  ),
  'palettes' => array (
    '1' => array('showitem' => ''),
    '2' => array('showitem' => '%title_lang_ol%'),
    '3' => array('showitem' => '%imagecaption_lang_ol%'),
    '4' => array('showitem' => '%imagealttext_lang_ol%'),
    '5' => array('showitem' => '%imagetitletext_lang_ol%'),
  )
);
  // Non localized

  // Localization support
if($bool_LL)
{
  // Add language overlay fields to showRecordFieldList
  $showRecordFieldList = $TCA['tx_jobmarket_contractor']['interface']['showRecordFieldList'];
  $TCA['tx_jobmarket_contractor']['interface']['showRecordFieldList'] = $showRecordFieldList.',title_lang_ol,imagecaption_lang_ol,imagealttext_lang_ol,imagetitletext_lang_ol';
  // Add language overlay fields to showRecordFieldList
  // Add language overlay fields to type
  $showitem = $TCA['tx_jobmarket_contractor']['types']['0']['showitem'];
  $showitem = str_replace('%2%', '2', $showitem);
  $showitem = str_replace('%3%', '3', $showitem);
  $showitem = str_replace('%4%', '4', $showitem);
  $showitem = str_replace('%5%', '5', $showitem);
  $TCA['tx_jobmarket_contractor']['types']['0']['showitem'] = $showitem;
  // Add language overlay fields to type
  // Add language overlay fields to palettes
  $showitem = $TCA['tx_jobmarket_contractor']['palettes']['2']['showitem'];
  $TCA['tx_jobmarket_contractor']['palettes']['2']['showitem'] = str_replace('%title_lang_ol%', 'title_lang_ol', $showitem);
  $showitem = $TCA['tx_jobmarket_contractor']['palettes']['3']['showitem'];
  $TCA['tx_jobmarket_contractor']['palettes']['3']['showitem'] = str_replace('%imagecaption_lang_ol%', 'imagecaption_lang_ol', $showitem);
  $showitem = $TCA['tx_jobmarket_contractor']['palettes']['4']['showitem'];
  $TCA['tx_jobmarket_contractor']['palettes']['4']['showitem'] = str_replace('%imagealttext_lang_ol%', 'imagealttext_lang_ol', $showitem);
  $showitem = $TCA['tx_jobmarket_contractor']['palettes']['5']['showitem'];
  $TCA['tx_jobmarket_contractor']['palettes']['5']['showitem'] = str_replace('%imagetitletext_lang_ol%', 'imagetitletext_lang_ol', $showitem);
  // Add language overlay fields to palettes
  // Add language overlay fields to columns array
  $TCA['tx_jobmarket_contractor']['columns']['title_lang_ol'] = array
  (
    'exclude' => 0,
    'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_contractor.title_lang_ol',
    'config' => array (
      'type' => 'input',
      'size' => '30',
    )
  );
  $TCA['tx_jobmarket_contractor']['columns']['imagecaption_lang_ol'] = array
  (
    'exclude' => 0,
    'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_contractor.title_lang_ol',
    'config' => array (
      'type' => 'text',
      'cols' => '30', 
      'rows' => '5',
    )
  );
  $TCA['tx_jobmarket_contractor']['columns']['imagealttext_lang_ol'] = array
  (
    'exclude' => 0,
    'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_contractor.title_lang_ol',
    'config' => array (
      'type' => 'text',
      'cols' => '30', 
      'rows' => '5',
    )
  );
  $TCA['tx_jobmarket_contractor']['columns']['imagetitletext_lang_ol'] = array
  (
    'exclude' => 0,
    'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_contractor.title_lang_ol',
    'config' => array (
      'type' => 'text',
      'cols' => '30', 
      'rows' => '5',
    )
  );
  // Add language overlay fields to columns array
}
if(!$bool_LL)
{
  // Remove language overlay fields from type
  $showitem = $TCA['tx_jobmarket_contractor']['types']['0']['showitem'];
  $showitem = str_replace('%2%', '', $showitem);
  $showitem = str_replace('%3%', '', $showitem);
  $showitem = str_replace('%4%', '', $showitem);
  $showitem = str_replace('%5%', '', $showitem);
  $TCA['tx_jobmarket_contractor']['types']['0']['showitem'] = $showitem;
  // Remove language overlay fields from type
  // Remove language overlay fields from palettes
  $showitem = $TCA['tx_jobmarket_contractor']['palettes']['2']['showitem'];
  $TCA['tx_jobmarket_contractor']['palettes']['2']['showitem'] = str_replace('%title_lang_ol%', '', $showitem);
  $showitem = $TCA['tx_jobmarket_contractor']['palettes']['3']['showitem'];
  $TCA['tx_jobmarket_contractor']['palettes']['3']['showitem'] = str_replace('%imagecaption_lang_ol%', '', $showitem);
  $showitem = $TCA['tx_jobmarket_contractor']['palettes']['4']['showitem'];
  $TCA['tx_jobmarket_contractor']['palettes']['4']['showitem'] = str_replace('%imagealttext_lang_ol%', '', $showitem);
  $showitem = $TCA['tx_jobmarket_contractor']['palettes']['5']['showitem'];
  $TCA['tx_jobmarket_contractor']['palettes']['5']['showitem'] = str_replace('%imagetitletext_lang_ol%', '', $showitem);
  // Remove language overlay fields from palettes
}
  // Localization support
  // TCA Contractor



  ///////////////////////////////////////
  // 
  // TCA Region
  
  // Non localized
$TCA['tx_jobmarket_region'] = array (
  'ctrl' => $TCA['tx_jobmarket_region']['ctrl'],
  'interface' => array (
    'showRecordFieldList' => 'hidden,title,image,imagecaption,imagealttext,imagetitletext'
  ),
  'feInterface' => $TCA['tx_jobmarket_region']['feInterface'],
  'columns' => array (
    'hidden' => array (
      'exclude' => 1,
      'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
      'config'  => array (
        'type'    => 'check',
        'default' => '0'
      )
    ),
    'title' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_region.title',
      'config' => array (
        'type' => 'input',
        'size' => '30',
        'eval' => 'required',
      )
    ),
    'title_lang_ol' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_region.title_lang_ol',
      'config' => array (
        'type' => 'input',
        'size' => '30',
      )
    ),
    'image' => array (
      'exclude' => 0,
      'l10n_mode' => 'exclude',
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.image',
      'config' => array (
        'type' => 'group',
        'internal_type' => 'file',
        'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'], 
        'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'], 
        'uploadfolder' => 'uploads/tx_jobmarket',
        'show_thumbs' => 1, 
        'size' => 3,  
        'minitems' => 0,
        'maxitems' => 10,
      )
    ),
    'imagecaption' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.imagecaption',
      'config' => array (
        'type' => 'text',
        'cols' => '30', 
        'rows' => '5',
      )
    ),
    'imagealttext' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.imagealttext',
      'config' => array (
        'type' => 'text',
        'cols' => '30', 
        'rows' => '5',
      )
    ),
    'imagetitletext' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.imagetitletext',
      'config' => array (
        'type' => 'text',
        'cols' => '30', 
        'rows' => '5',
      )
    ),
  ),
  'types' => array (
    '0' => array('showitem' => 'hidden;;1;;1-1-1, title;;%2%;;2-2-2,image;;;;3-3-3,imagecaption;;%3%;;,imagealttext;;%4%;;,imagetitletext;;%5%;;')
  ),
  'palettes' => array (
    '1' => array('showitem' => ''),
    '2' => array('showitem' => '%title_lang_ol%'),
    '3' => array('showitem' => '%imagecaption_lang_ol%'),
    '4' => array('showitem' => '%imagealttext_lang_ol%'),
    '5' => array('showitem' => '%imagetitletext_lang_ol%'),
  )
);
  // Non localized

  // Localization support
if($bool_LL)
{
  // Add language overlay fields to showRecordFieldList
  $showRecordFieldList = $TCA['tx_jobmarket_region']['interface']['showRecordFieldList'];
  $TCA['tx_jobmarket_region']['interface']['showRecordFieldList'] = $showRecordFieldList.',title_lang_ol,imagecaption_lang_ol,imagealttext_lang_ol,imagetitletext_lang_ol';
  // Add language overlay fields to showRecordFieldList
  // Add language overlay fields to type
  $showitem = $TCA['tx_jobmarket_region']['types']['0']['showitem'];
  $showitem = str_replace('%2%', '2', $showitem);
  $showitem = str_replace('%3%', '3', $showitem);
  $showitem = str_replace('%4%', '4', $showitem);
  $showitem = str_replace('%5%', '5', $showitem);
  $TCA['tx_jobmarket_region']['types']['0']['showitem'] = $showitem;
  // Add language overlay fields to type
  // Add language overlay fields to palettes
  $showitem = $TCA['tx_jobmarket_region']['palettes']['2']['showitem'];
  $TCA['tx_jobmarket_region']['palettes']['2']['showitem'] = str_replace('%title_lang_ol%', 'title_lang_ol', $showitem);
  $showitem = $TCA['tx_jobmarket_region']['palettes']['3']['showitem'];
  $TCA['tx_jobmarket_region']['palettes']['3']['showitem'] = str_replace('%imagecaption_lang_ol%', 'imagecaption_lang_ol', $showitem);
  $showitem = $TCA['tx_jobmarket_region']['palettes']['4']['showitem'];
  $TCA['tx_jobmarket_region']['palettes']['4']['showitem'] = str_replace('%imagealttext_lang_ol%', 'imagealttext_lang_ol', $showitem);
  $showitem = $TCA['tx_jobmarket_region']['palettes']['5']['showitem'];
  $TCA['tx_jobmarket_region']['palettes']['5']['showitem'] = str_replace('%imagetitletext_lang_ol%', 'imagetitletext_lang_ol', $showitem);
  // Add language overlay fields to palettes
  // Add language overlay fields to columns array
  $TCA['tx_jobmarket_region']['columns']['title_lang_ol'] = array
  (
    'exclude' => 0,
    'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_region.title_lang_ol',
    'config' => array (
      'type' => 'input',
      'size' => '30',
    )
  );
  $TCA['tx_jobmarket_region']['columns']['imagecaption_lang_ol'] = array
  (
    'exclude' => 0,
    'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_region.title_lang_ol',
    'config' => array (
      'type' => 'text',
      'cols' => '30', 
      'rows' => '5',
    )
  );
  $TCA['tx_jobmarket_region']['columns']['imagealttext_lang_ol'] = array
  (
    'exclude' => 0,
    'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_region.title_lang_ol',
    'config' => array (
      'type' => 'text',
      'cols' => '30', 
      'rows' => '5',
    )
  );
  $TCA['tx_jobmarket_region']['columns']['imagetitletext_lang_ol'] = array
  (
    'exclude' => 0,
    'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_region.title_lang_ol',
    'config' => array (
      'type' => 'text',
      'cols' => '30', 
      'rows' => '5',
    )
  );
  // Add language overlay fields to columns array
}
if(!$bool_LL)
{
  // Remove language overlay fields from type
  $showitem = $TCA['tx_jobmarket_region']['types']['0']['showitem'];
  $showitem = str_replace('%2%', '', $showitem);
  $showitem = str_replace('%3%', '', $showitem);
  $showitem = str_replace('%4%', '', $showitem);
  $showitem = str_replace('%5%', '', $showitem);
  $TCA['tx_jobmarket_region']['types']['0']['showitem'] = $showitem;
  // Remove language overlay fields from type
  // Remove language overlay fields from palettes
  $showitem = $TCA['tx_jobmarket_region']['palettes']['2']['showitem'];
  $TCA['tx_jobmarket_region']['palettes']['2']['showitem'] = str_replace('%title_lang_ol%', '', $showitem);
  $showitem = $TCA['tx_jobmarket_region']['palettes']['3']['showitem'];
  $TCA['tx_jobmarket_region']['palettes']['3']['showitem'] = str_replace('%imagecaption_lang_ol%', '', $showitem);
  $showitem = $TCA['tx_jobmarket_region']['palettes']['4']['showitem'];
  $TCA['tx_jobmarket_region']['palettes']['4']['showitem'] = str_replace('%imagealttext_lang_ol%', '', $showitem);
  $showitem = $TCA['tx_jobmarket_region']['palettes']['5']['showitem'];
  $TCA['tx_jobmarket_region']['palettes']['5']['showitem'] = str_replace('%imagetitletext_lang_ol%', '', $showitem);
  // Remove language overlay fields from palettes
}
  // Localization support
  // TCA Region



  ///////////////////////////////////////
  // 
  // TCA County
  
  // Non localized
$TCA['tx_jobmarket_county'] = array (
  'ctrl' => $TCA['tx_jobmarket_county']['ctrl'],
  'interface' => array (
    'showRecordFieldList' => 'hidden,title,image,imagecaption,imagealttext,imagetitletext'
  ),
  'feInterface' => $TCA['tx_jobmarket_county']['feInterface'],
  'columns' => array (
    'hidden' => array (
      'exclude' => 1,
      'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
      'config'  => array (
        'type'    => 'check',
        'default' => '0'
      )
    ),
    'title' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_county.title',
      'config' => array (
        'type' => 'input',
        'size' => '30',
        'eval' => 'required',
      )
    ),
    'image' => array (
      'exclude' => 0,
      'l10n_mode' => 'exclude',
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.image',
      'config' => array (
        'type' => 'group',
        'internal_type' => 'file',
        'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'], 
        'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'], 
        'uploadfolder' => 'uploads/tx_jobmarket',
        'show_thumbs' => 1, 
        'size' => 3,  
        'minitems' => 0,
        'maxitems' => 10,
      )
    ),
    'imagecaption' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.imagecaption',
      'config' => array (
        'type' => 'text',
        'cols' => '30', 
        'rows' => '5',
      )
    ),
    'imagealttext' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.imagealttext',
      'config' => array (
        'type' => 'text',
        'cols' => '30', 
        'rows' => '5',
      )
    ),
    'imagetitletext' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.imagetitletext',
      'config' => array (
        'type' => 'text',
        'cols' => '30', 
        'rows' => '5',
      )
    ),
  ),
  'types' => array (
    '0' => array('showitem' => 'hidden;;1;;1-1-1, title;;%2%;;2-2-2,image;;;;3-3-3,imagecaption;;%3%;;,imagealttext;;%4%;;,imagetitletext;;%5%;;')
  ),
  'palettes' => array (
    '1' => array('showitem' => ''),
    '2' => array('showitem' => '%title_lang_ol%'),
    '3' => array('showitem' => '%imagecaption_lang_ol%'),
    '4' => array('showitem' => '%imagealttext_lang_ol%'),
    '5' => array('showitem' => '%imagetitletext_lang_ol%'),
  )
);
  // Non localized

  // Localization support
if($bool_LL)
{
  // Add language overlay fields to showRecordFieldList
  $showRecordFieldList = $TCA['tx_jobmarket_county']['interface']['showRecordFieldList'];
  $TCA['tx_jobmarket_county']['interface']['showRecordFieldList'] = $showRecordFieldList.',title_lang_ol,imagecaption_lang_ol,imagealttext_lang_ol,imagetitletext_lang_ol';
  // Add language overlay fields to showRecordFieldList
  // Add language overlay fields to type
  $showitem = $TCA['tx_jobmarket_county']['types']['0']['showitem'];
  $showitem = str_replace('%2%', '2', $showitem);
  $showitem = str_replace('%3%', '3', $showitem);
  $showitem = str_replace('%4%', '4', $showitem);
  $showitem = str_replace('%5%', '5', $showitem);
  $TCA['tx_jobmarket_county']['types']['0']['showitem'] = $showitem;
  // Add language overlay fields to type
  // Add language overlay fields to palettes
  $showitem = $TCA['tx_jobmarket_county']['palettes']['2']['showitem'];
  $TCA['tx_jobmarket_county']['palettes']['2']['showitem'] = str_replace('%title_lang_ol%', 'title_lang_ol', $showitem);
  $showitem = $TCA['tx_jobmarket_county']['palettes']['3']['showitem'];
  $TCA['tx_jobmarket_county']['palettes']['3']['showitem'] = str_replace('%imagecaption_lang_ol%', 'imagecaption_lang_ol', $showitem);
  $showitem = $TCA['tx_jobmarket_county']['palettes']['4']['showitem'];
  $TCA['tx_jobmarket_county']['palettes']['4']['showitem'] = str_replace('%imagealttext_lang_ol%', 'imagealttext_lang_ol', $showitem);
  $showitem = $TCA['tx_jobmarket_county']['palettes']['5']['showitem'];
  $TCA['tx_jobmarket_county']['palettes']['5']['showitem'] = str_replace('%imagetitletext_lang_ol%', 'imagetitletext_lang_ol', $showitem);
  // Add language overlay fields to palettes
  // Add language overlay fields to columns array
  $TCA['tx_jobmarket_county']['columns']['title_lang_ol'] = array
  (
    'exclude' => 0,
    'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_county.title_lang_ol',
    'config' => array (
      'type' => 'input',
      'size' => '30',
    )
  );
  $TCA['tx_jobmarket_county']['columns']['imagecaption_lang_ol'] = array
  (
    'exclude' => 0,
    'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_county.title_lang_ol',
    'config' => array (
      'type' => 'text',
      'cols' => '30', 
      'rows' => '5',
    )
  );
  $TCA['tx_jobmarket_county']['columns']['imagealttext_lang_ol'] = array
  (
    'exclude' => 0,
    'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_county.title_lang_ol',
    'config' => array (
      'type' => 'text',
      'cols' => '30', 
      'rows' => '5',
    )
  );
  $TCA['tx_jobmarket_county']['columns']['imagetitletext_lang_ol'] = array
  (
    'exclude' => 0,
    'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_county.title_lang_ol',
    'config' => array (
      'type' => 'text',
      'cols' => '30', 
      'rows' => '5',
    )
  );
  // Add language overlay fields to columns array
}
if(!$bool_LL)
{
  // Remove language overlay fields from type
  $showitem = $TCA['tx_jobmarket_county']['types']['0']['showitem'];
  $showitem = str_replace('%2%', '', $showitem);
  $showitem = str_replace('%3%', '', $showitem);
  $showitem = str_replace('%4%', '', $showitem);
  $showitem = str_replace('%5%', '', $showitem);
  $TCA['tx_jobmarket_county']['types']['0']['showitem'] = $showitem;
  // Remove language overlay fields from type
  // Remove language overlay fields from palettes
  $showitem = $TCA['tx_jobmarket_county']['palettes']['2']['showitem'];
  $TCA['tx_jobmarket_county']['palettes']['2']['showitem'] = str_replace('%title_lang_ol%', '', $showitem);
  $showitem = $TCA['tx_jobmarket_county']['palettes']['3']['showitem'];
  $TCA['tx_jobmarket_county']['palettes']['3']['showitem'] = str_replace('%imagecaption_lang_ol%', '', $showitem);
  $showitem = $TCA['tx_jobmarket_county']['palettes']['4']['showitem'];
  $TCA['tx_jobmarket_county']['palettes']['4']['showitem'] = str_replace('%imagealttext_lang_ol%', '', $showitem);
  $showitem = $TCA['tx_jobmarket_county']['palettes']['5']['showitem'];
  $TCA['tx_jobmarket_county']['palettes']['5']['showitem'] = str_replace('%imagetitletext_lang_ol%', '', $showitem);
  // Remove language overlay fields from palettes
}
  // Localization support
  // TCA County



  ///////////////////////////////////////
  // 
  // TCA Sector
  
  // Non localized
$TCA['tx_jobmarket_sector'] = array (
  'ctrl' => $TCA['tx_jobmarket_sector']['ctrl'],
  'interface' => array (
    'showRecordFieldList' => 'hidden,title,image,imagecaption,imagealttext,imagetitletext'
  ),
  'feInterface' => $TCA['tx_jobmarket_sector']['feInterface'],
  'columns' => array (
    'hidden' => array (
      'exclude' => 1,
      'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
      'config'  => array (
        'type'    => 'check',
        'default' => '0'
      )
    ),
    'title' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_sector.title',
      'config' => array (
        'type' => 'input',
        'size' => '30',
        'eval' => 'required',
      )
    ),
    'image' => array (
      'exclude' => 0,
      'l10n_mode' => 'exclude',
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.image',
      'config' => array (
        'type' => 'group',
        'internal_type' => 'file',
        'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'], 
        'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'], 
        'uploadfolder' => 'uploads/tx_jobmarket',
        'show_thumbs' => 1, 
        'size' => 3,  
        'minitems' => 0,
        'maxitems' => 10,
      )
    ),
    'imagecaption' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.imagecaption',
      'config' => array (
        'type' => 'text',
        'cols' => '30', 
        'rows' => '5',
      )
    ),
    'imagealttext' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.imagealttext',
      'config' => array (
        'type' => 'text',
        'cols' => '30', 
        'rows' => '5',
      )
    ),
    'imagetitletext' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.imagetitletext',
      'config' => array (
        'type' => 'text',
        'cols' => '30', 
        'rows' => '5',
      )
    ),
  ),
  'types' => array (
    '0' => array('showitem' => 'hidden;;1;;1-1-1, title;;%2%;;2-2-2,image;;;;3-3-3,imagecaption;;%3%;;,imagealttext;;%4%;;,imagetitletext;;%5%;;')
  ),
  'palettes' => array (
    '1' => array('showitem' => ''),
    '2' => array('showitem' => '%title_lang_ol%'),
    '3' => array('showitem' => '%imagecaption_lang_ol%'),
    '4' => array('showitem' => '%imagealttext_lang_ol%'),
    '5' => array('showitem' => '%imagetitletext_lang_ol%'),
  )
);
  // Non localized

  // Localization support
if($bool_LL)
{
  // Add language overlay fields to showRecordFieldList
  $showRecordFieldList = $TCA['tx_jobmarket_sector']['interface']['showRecordFieldList'];
  $TCA['tx_jobmarket_sector']['interface']['showRecordFieldList'] = $showRecordFieldList.',title_lang_ol,imagecaption_lang_ol,imagealttext_lang_ol,imagetitletext_lang_ol';
  // Add language overlay fields to showRecordFieldList
  // Add language overlay fields to type
  $showitem = $TCA['tx_jobmarket_sector']['types']['0']['showitem'];
  $showitem = str_replace('%2%', '2', $showitem);
  $showitem = str_replace('%3%', '3', $showitem);
  $showitem = str_replace('%4%', '4', $showitem);
  $showitem = str_replace('%5%', '5', $showitem);
  $TCA['tx_jobmarket_sector']['types']['0']['showitem'] = $showitem;
  // Add language overlay fields to type
  // Add language overlay fields to palettes
  $showitem = $TCA['tx_jobmarket_sector']['palettes']['2']['showitem'];
  $TCA['tx_jobmarket_sector']['palettes']['2']['showitem'] = str_replace('%title_lang_ol%', 'title_lang_ol', $showitem);
  $showitem = $TCA['tx_jobmarket_sector']['palettes']['3']['showitem'];
  $TCA['tx_jobmarket_sector']['palettes']['3']['showitem'] = str_replace('%imagecaption_lang_ol%', 'imagecaption_lang_ol', $showitem);
  $showitem = $TCA['tx_jobmarket_sector']['palettes']['4']['showitem'];
  $TCA['tx_jobmarket_sector']['palettes']['4']['showitem'] = str_replace('%imagealttext_lang_ol%', 'imagealttext_lang_ol', $showitem);
  $showitem = $TCA['tx_jobmarket_sector']['palettes']['5']['showitem'];
  $TCA['tx_jobmarket_sector']['palettes']['5']['showitem'] = str_replace('%imagetitletext_lang_ol%', 'imagetitletext_lang_ol', $showitem);
  // Add language overlay fields to palettes
  // Add language overlay fields to columns array
  $TCA['tx_jobmarket_sector']['columns']['title_lang_ol'] = array
  (
    'exclude' => 0,
    'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_sector.title_lang_ol',
    'config' => array (
      'type' => 'input',
      'size' => '30',
    )
  );
  $TCA['tx_jobmarket_sector']['columns']['imagecaption_lang_ol'] = array
  (
    'exclude' => 0,
    'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_sector.title_lang_ol',
    'config' => array (
      'type' => 'text',
      'cols' => '30', 
      'rows' => '5',
    )
  );
  $TCA['tx_jobmarket_sector']['columns']['imagealttext_lang_ol'] = array
  (
    'exclude' => 0,
    'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_sector.title_lang_ol',
    'config' => array (
      'type' => 'text',
      'cols' => '30', 
      'rows' => '5',
    )
  );
  $TCA['tx_jobmarket_sector']['columns']['imagetitletext_lang_ol'] = array
  (
    'exclude' => 0,
    'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_sector.title_lang_ol',
    'config' => array (
      'type' => 'text',
      'cols' => '30', 
      'rows' => '5',
    )
  );
  // Add language overlay fields to columns array
}
if(!$bool_LL)
{
  // Remove language overlay fields from type
  $showitem = $TCA['tx_jobmarket_sector']['types']['0']['showitem'];
  $showitem = str_replace('%2%', '', $showitem);
  $showitem = str_replace('%3%', '', $showitem);
  $showitem = str_replace('%4%', '', $showitem);
  $showitem = str_replace('%5%', '', $showitem);
  $TCA['tx_jobmarket_sector']['types']['0']['showitem'] = $showitem;
  // Remove language overlay fields from type
  // Remove language overlay fields from palettes
  $showitem = $TCA['tx_jobmarket_sector']['palettes']['2']['showitem'];
  $TCA['tx_jobmarket_sector']['palettes']['2']['showitem'] = str_replace('%title_lang_ol%', '', $showitem);
  $showitem = $TCA['tx_jobmarket_sector']['palettes']['3']['showitem'];
  $TCA['tx_jobmarket_sector']['palettes']['3']['showitem'] = str_replace('%imagecaption_lang_ol%', '', $showitem);
  $showitem = $TCA['tx_jobmarket_sector']['palettes']['4']['showitem'];
  $TCA['tx_jobmarket_sector']['palettes']['4']['showitem'] = str_replace('%imagealttext_lang_ol%', '', $showitem);
  $showitem = $TCA['tx_jobmarket_sector']['palettes']['5']['showitem'];
  $TCA['tx_jobmarket_sector']['palettes']['5']['showitem'] = str_replace('%imagetitletext_lang_ol%', '', $showitem);
  // Remove language overlay fields from palettes
}
  // Localization support
  // TCA sector



  ///////////////////////////////////////
  // 
  // TCA Sectorgroup
  
  // Non localized
$TCA['tx_jobmarket_sectorgroup'] = array (
  'ctrl' => $TCA['tx_jobmarket_sectorgroup']['ctrl'],
  'interface' => array (
    'showRecordFieldList' => 'hidden,title,image,imagecaption,imagealttext,imagetitletext'
  ),
  'feInterface' => $TCA['tx_jobmarket_sectorgroup']['feInterface'],
  'columns' => array (
    'hidden' => array (
      'exclude' => 1,
      'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
      'config'  => array (
        'type'    => 'check',
        'default' => '0'
      )
    ),
    'title' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_sectorgroup.title',
      'config' => array (
        'type' => 'input',
        'size' => '30',
        'eval' => 'required',
      )
    ),
    'image' => array (
      'exclude' => 0,
      'l10n_mode' => 'exclude',
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.image',
      'config' => array (
        'type' => 'group',
        'internal_type' => 'file',
        'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'], 
        'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'], 
        'uploadfolder' => 'uploads/tx_jobmarket',
        'show_thumbs' => 1, 
        'size' => 3,  
        'minitems' => 0,
        'maxitems' => 10,
      )
    ),
    'imagecaption' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.imagecaption',
      'config' => array (
        'type' => 'text',
        'cols' => '30', 
        'rows' => '5',
      )
    ),
    'imagealttext' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.imagealttext',
      'config' => array (
        'type' => 'text',
        'cols' => '30', 
        'rows' => '5',
      )
    ),
    'imagetitletext' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.imagetitletext',
      'config' => array (
        'type' => 'text',
        'cols' => '30', 
        'rows' => '5',
      )
    ),
  ),
  'types' => array (
    '0' => array('showitem' => 'hidden;;1;;1-1-1, title;;%2%;;2-2-2,image;;;;3-3-3,imagecaption;;%3%;;,imagealttext;;%4%;;,imagetitletext;;%5%;;')
  ),
  'palettes' => array (
    '1' => array('showitem' => ''),
    '2' => array('showitem' => '%title_lang_ol%'),
    '3' => array('showitem' => '%imagecaption_lang_ol%'),
    '4' => array('showitem' => '%imagealttext_lang_ol%'),
    '5' => array('showitem' => '%imagetitletext_lang_ol%'),
  )
);
  // Non localized

  // Localization support
if($bool_LL)
{
  // Add language overlay fields to showRecordFieldList
  $showRecordFieldList = $TCA['tx_jobmarket_sectorgroup']['interface']['showRecordFieldList'];
  $TCA['tx_jobmarket_sectorgroup']['interface']['showRecordFieldList'] = $showRecordFieldList.',title_lang_ol,imagecaption_lang_ol,imagealttext_lang_ol,imagetitletext_lang_ol';
  // Add language overlay fields to showRecordFieldList
  // Add language overlay fields to type
  $showitem = $TCA['tx_jobmarket_sectorgroup']['types']['0']['showitem'];
  $showitem = str_replace('%2%', '2', $showitem);
  $showitem = str_replace('%3%', '3', $showitem);
  $showitem = str_replace('%4%', '4', $showitem);
  $showitem = str_replace('%5%', '5', $showitem);
  $TCA['tx_jobmarket_sectorgroup']['types']['0']['showitem'] = $showitem;
  // Add language overlay fields to type
  // Add language overlay fields to palettes
  $showitem = $TCA['tx_jobmarket_sectorgroup']['palettes']['2']['showitem'];
  $TCA['tx_jobmarket_sectorgroup']['palettes']['2']['showitem'] = str_replace('%title_lang_ol%', 'title_lang_ol', $showitem);
  $showitem = $TCA['tx_jobmarket_sectorgroup']['palettes']['3']['showitem'];
  $TCA['tx_jobmarket_sectorgroup']['palettes']['3']['showitem'] = str_replace('%imagecaption_lang_ol%', 'imagecaption_lang_ol', $showitem);
  $showitem = $TCA['tx_jobmarket_sectorgroup']['palettes']['4']['showitem'];
  $TCA['tx_jobmarket_sectorgroup']['palettes']['4']['showitem'] = str_replace('%imagealttext_lang_ol%', 'imagealttext_lang_ol', $showitem);
  $showitem = $TCA['tx_jobmarket_sectorgroup']['palettes']['5']['showitem'];
  $TCA['tx_jobmarket_sectorgroup']['palettes']['5']['showitem'] = str_replace('%imagetitletext_lang_ol%', 'imagetitletext_lang_ol', $showitem);
  // Add language overlay fields to palettes
  // Add language overlay fields to columns array
  $TCA['tx_jobmarket_sectorgroup']['columns']['title_lang_ol'] = array
  (
    'exclude' => 0,
    'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_sectorgroup.title_lang_ol',
    'config' => array (
      'type' => 'input',
      'size' => '30',
    )
  );
  $TCA['tx_jobmarket_sectorgroup']['columns']['imagecaption_lang_ol'] = array
  (
    'exclude' => 0,
    'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_sectorgroup.title_lang_ol',
    'config' => array (
      'type' => 'text',
      'cols' => '30', 
      'rows' => '5',
    )
  );
  $TCA['tx_jobmarket_sectorgroup']['columns']['imagealttext_lang_ol'] = array
  (
    'exclude' => 0,
    'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_sectorgroup.title_lang_ol',
    'config' => array (
      'type' => 'text',
      'cols' => '30', 
      'rows' => '5',
    )
  );
  $TCA['tx_jobmarket_sectorgroup']['columns']['imagetitletext_lang_ol'] = array
  (
    'exclude' => 0,
    'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_sectorgroup.title_lang_ol',
    'config' => array (
      'type' => 'text',
      'cols' => '30', 
      'rows' => '5',
    )
  );
  // Add language overlay fields to columns array
}
if(!$bool_LL)
{
  // Remove language overlay fields from type
  $showitem = $TCA['tx_jobmarket_sectorgroup']['types']['0']['showitem'];
  $showitem = str_replace('%2%', '', $showitem);
  $showitem = str_replace('%3%', '', $showitem);
  $showitem = str_replace('%4%', '', $showitem);
  $showitem = str_replace('%5%', '', $showitem);
  $TCA['tx_jobmarket_sectorgroup']['types']['0']['showitem'] = $showitem;
  // Remove language overlay fields from type
  // Remove language overlay fields from palettes
  $showitem = $TCA['tx_jobmarket_sectorgroup']['palettes']['2']['showitem'];
  $TCA['tx_jobmarket_sectorgroup']['palettes']['2']['showitem'] = str_replace('%title_lang_ol%', '', $showitem);
  $showitem = $TCA['tx_jobmarket_sectorgroup']['palettes']['3']['showitem'];
  $TCA['tx_jobmarket_sectorgroup']['palettes']['3']['showitem'] = str_replace('%imagecaption_lang_ol%', '', $showitem);
  $showitem = $TCA['tx_jobmarket_sectorgroup']['palettes']['4']['showitem'];
  $TCA['tx_jobmarket_sectorgroup']['palettes']['4']['showitem'] = str_replace('%imagealttext_lang_ol%', '', $showitem);
  $showitem = $TCA['tx_jobmarket_sectorgroup']['palettes']['5']['showitem'];
  $TCA['tx_jobmarket_sectorgroup']['palettes']['5']['showitem'] = str_replace('%imagetitletext_lang_ol%', '', $showitem);
  // Remove language overlay fields from palettes
}
  // Localization support
  // TCA Sectorgroup



  ///////////////////////////////////////
  // 
  // TCA Type
  
  // Non localized
$TCA['tx_jobmarket_type'] = array (
  'ctrl' => $TCA['tx_jobmarket_type']['ctrl'],
  'interface' => array (
    'showRecordFieldList' => 'hidden,title,image,imagecaption,imagealttext,imagetitletext'
  ),
  'feInterface' => $TCA['tx_jobmarket_type']['feInterface'],
  'columns' => array (
    'hidden' => array (
      'exclude' => 1,
      'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
      'config'  => array (
        'type'    => 'check',
        'default' => '0'
      )
    ),
    'title' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_type.title',
      'config' => array (
        'type' => 'input',
        'size' => '30',
        'eval' => 'required',
      )
    ),
    'image' => array (
      'exclude' => 0,
      'l10n_mode' => 'exclude',
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.image',
      'config' => array (
        'type' => 'group',
        'internal_type' => 'file',
        'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'], 
        'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'], 
        'uploadfolder' => 'uploads/tx_jobmarket',
        'show_thumbs' => 1, 
        'size' => 3,  
        'minitems' => 0,
        'maxitems' => 10,
      )
    ),
    'imagecaption' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.imagecaption',
      'config' => array (
        'type' => 'text',
        'cols' => '30', 
        'rows' => '5',
      )
    ),
    'imagealttext' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.imagealttext',
      'config' => array (
        'type' => 'text',
        'cols' => '30', 
        'rows' => '5',
      )
    ),
    'imagetitletext' => array (
      'exclude' => 0,
      'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_main.imagetitletext',
      'config' => array (
        'type' => 'text',
        'cols' => '30', 
        'rows' => '5',
      )
    ),
  ),
  'types' => array (
    '0' => array('showitem' => 'hidden;;1;;1-1-1, title;;%2%;;2-2-2,image;;;;3-3-3,imagecaption;;%3%;;,imagealttext;;%4%;;,imagetitletext;;%5%;;')
  ),
  'palettes' => array (
    '1' => array('showitem' => ''),
    '2' => array('showitem' => '%title_lang_ol%'),
    '3' => array('showitem' => '%imagecaption_lang_ol%'),
    '4' => array('showitem' => '%imagealttext_lang_ol%'),
    '5' => array('showitem' => '%imagetitletext_lang_ol%'),
  )
);
  // Non localized

  // Localization support
if($bool_LL)
{
  // Add language overlay fields to showRecordFieldList
  $showRecordFieldList = $TCA['tx_jobmarket_type']['interface']['showRecordFieldList'];
  $TCA['tx_jobmarket_type']['interface']['showRecordFieldList'] = $showRecordFieldList.',title_lang_ol,imagecaption_lang_ol,imagealttext_lang_ol,imagetitletext_lang_ol';
  // Add language overlay fields to showRecordFieldList
  // Add language overlay fields to type
  $showitem = $TCA['tx_jobmarket_type']['types']['0']['showitem'];
  $showitem = str_replace('%2%', '2', $showitem);
  $showitem = str_replace('%3%', '3', $showitem);
  $showitem = str_replace('%4%', '4', $showitem);
  $showitem = str_replace('%5%', '5', $showitem);
  $TCA['tx_jobmarket_type']['types']['0']['showitem'] = $showitem;
  // Add language overlay fields to type
  // Add language overlay fields to palettes
  $showitem = $TCA['tx_jobmarket_type']['palettes']['2']['showitem'];
  $TCA['tx_jobmarket_type']['palettes']['2']['showitem'] = str_replace('%title_lang_ol%', 'title_lang_ol', $showitem);
  $showitem = $TCA['tx_jobmarket_type']['palettes']['3']['showitem'];
  $TCA['tx_jobmarket_type']['palettes']['3']['showitem'] = str_replace('%imagecaption_lang_ol%', 'imagecaption_lang_ol', $showitem);
  $showitem = $TCA['tx_jobmarket_type']['palettes']['4']['showitem'];
  $TCA['tx_jobmarket_type']['palettes']['4']['showitem'] = str_replace('%imagealttext_lang_ol%', 'imagealttext_lang_ol', $showitem);
  $showitem = $TCA['tx_jobmarket_type']['palettes']['5']['showitem'];
  $TCA['tx_jobmarket_type']['palettes']['5']['showitem'] = str_replace('%imagetitletext_lang_ol%', 'imagetitletext_lang_ol', $showitem);
  // Add language overlay fields to palettes
  // Add language overlay fields to columns array
  $TCA['tx_jobmarket_type']['columns']['title_lang_ol'] = array
  (
    'exclude' => 0,
    'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_type.title_lang_ol',
    'config' => array (
      'type' => 'input',
      'size' => '30',
    )
  );
  $TCA['tx_jobmarket_type']['columns']['imagecaption_lang_ol'] = array
  (
    'exclude' => 0,
    'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_type.title_lang_ol',
    'config' => array (
      'type' => 'text',
      'cols' => '30', 
      'rows' => '5',
    )
  );
  $TCA['tx_jobmarket_type']['columns']['imagealttext_lang_ol'] = array
  (
    'exclude' => 0,
    'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_type.title_lang_ol',
    'config' => array (
      'type' => 'text',
      'cols' => '30', 
      'rows' => '5',
    )
  );
  $TCA['tx_jobmarket_type']['columns']['imagetitletext_lang_ol'] = array
  (
    'exclude' => 0,
    'label' => 'LLL:EXT:job_market/locallang_db.xml:tx_jobmarket_type.title_lang_ol',
    'config' => array (
      'type' => 'text',
      'cols' => '30', 
      'rows' => '5',
    )
  );
  // Add language overlay fields to columns array
}
if(!$bool_LL)
{
  // Remove language overlay fields from type
  $showitem = $TCA['tx_jobmarket_type']['types']['0']['showitem'];
  $showitem = str_replace('%2%', '', $showitem);
  $showitem = str_replace('%3%', '', $showitem);
  $showitem = str_replace('%4%', '', $showitem);
  $showitem = str_replace('%5%', '', $showitem);
  $TCA['tx_jobmarket_type']['types']['0']['showitem'] = $showitem;
  // Remove language overlay fields from type
  // Remove language overlay fields from palettes
  $showitem = $TCA['tx_jobmarket_type']['palettes']['2']['showitem'];
  $TCA['tx_jobmarket_type']['palettes']['2']['showitem'] = str_replace('%title_lang_ol%', '', $showitem);
  $showitem = $TCA['tx_jobmarket_type']['palettes']['3']['showitem'];
  $TCA['tx_jobmarket_type']['palettes']['3']['showitem'] = str_replace('%imagecaption_lang_ol%', '', $showitem);
  $showitem = $TCA['tx_jobmarket_type']['palettes']['4']['showitem'];
  $TCA['tx_jobmarket_type']['palettes']['4']['showitem'] = str_replace('%imagealttext_lang_ol%', '', $showitem);
  $showitem = $TCA['tx_jobmarket_type']['palettes']['5']['showitem'];
  $TCA['tx_jobmarket_type']['palettes']['5']['showitem'] = str_replace('%imagetitletext_lang_ol%', '', $showitem);
  // Remove language overlay fields from palettes
}
  // Localization support
  // TCA Type



?>