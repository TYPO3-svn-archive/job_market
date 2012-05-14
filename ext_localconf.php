<?php

  if (!defined ('TYPO3_MODE')) 
  {
    die ('Access denied.');
  }

  ///////////////////////////////////////
  // 
  // Extend tables with saveDocNew button
  
  t3lib_extMgm::addUserTSConfig('options.saveDocNew.tx_jobmarket_main=1');
  t3lib_extMgm::addUserTSConfig('options.saveDocNew.tx_jobmarket_region=1');
  t3lib_extMgm::addUserTSConfig('options.saveDocNew.tx_jobmarket_county=1');
  t3lib_extMgm::addUserTSConfig('options.saveDocNew.tx_jobmarket_sector=1');
  t3lib_extMgm::addUserTSConfig('options.saveDocNew.tx_jobmarket_sectorgroup=1');
  t3lib_extMgm::addUserTSConfig('options.saveDocNew.tx_jobmarket_type=1');
  // Extend tables with saveDocNew button


?>