#!/bin/bash

rm -f boostrz-wordpress.zip

cd ..
zip -r -9 boostrz-wordpress.zip boostrz-wordpress -x "*/.DS_Store" -x "boostrz-wordpress/.git/*" -x "*/.gitignore" -x "boostrz-wordpress/zip-up.sh"
mv boostrz-wordpress.zip boostrz-wordpress/
cd boostrz-wordpress
