#!/bin/bash

rm -f boostrz-tag-manager.zip

cd ..
zip -r -9 boostrz-tag-manager.zip boostrz-wordpress -x "*/.DS_Store" -x "boostrz-wordpress/.git/*" -x "*/.gitignore" -x "boostrz-wordpress/zip-up.sh"
mv boostrz-tag-manager.zip boostrz-wordpress/
cd boostrz-wordpress
