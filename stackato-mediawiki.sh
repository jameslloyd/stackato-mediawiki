#!/bin/bash
FS=$STACKTO_FILESYSTEM
MEDIAWIKIVER=$MEDIAWIKIVERSION

if [ -e $FS/mediawiki-$MEDIAWIKIVER.tar.gz ]
  then
    echo "file exists"
  else
    echo "getting MediaWiki Version: $MEDIAWIKIVER"
    cd $FS
    curl -O https://releases.wikimedia.org/mediawiki/1.26/mediawiki-$MEDIAWIKIVER.tar.gz
    tar xf $FS/mediawiki-$MEDIAWIKIVER.tar.gz
fi
if  [ -e $FS/mediawiki-$MEDIAWIKIVER/LocalSettings.php ]
  then
    echo "Config already in place"
  else
    echo "Installing LocalSettings.php ..."
    cp LocalSettings-Stackato.php $FS/mediawiki-$MEDIAWIKIVER/LocalSettings.php
fi
#php stackato-builddb.php
