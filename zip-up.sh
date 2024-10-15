#!/bin/bash

rm -f boostrz-wordpress.zip

cd ..
zip boostrz-wordpress.zip -r boostrz-wordpress -x .DS_Store -x .git -x .gitignore -x zip-up.sh
mv boostrz-wordpress.zip boostrz-wordpress/
cd boostrz-wordpress
