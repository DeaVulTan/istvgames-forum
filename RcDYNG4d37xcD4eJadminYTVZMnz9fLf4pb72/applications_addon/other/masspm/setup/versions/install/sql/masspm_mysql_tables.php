<?php


// Tables
$TABLE[] = "CREATE TABLE masspms (
  p_id int(10) NOT NULL AUTO_INCREMENT,
  p_title text NOT NULL,
  p_settings text NOT NULL,
  p_text text NOT NULL,
  p_send tinyint(3) NOT NULL,
  p_tsend int(10) NOT NULL,
  p_dateadded varchar(255) NOT NULL,
  p_dateupdated varchar(255) NOT NULL,
  PRIMARY KEY (p_id)
)";