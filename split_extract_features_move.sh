python splitter.py "./raw_files" "./split_files"
python feature_extractor.py "./split_files" "features.csv"
sudo cp features.csv /var/www/html/emodash
sudo cp ./split_files/*.* /var/www/html/emodash/input
