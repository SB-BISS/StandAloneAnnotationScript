# StandAloneAnnotationScript
Stand Alone Annotation Script for EMODASH

Usage:

first execute the splitter as follows:

python splitter.py "some_dir_name_input" "some_dir_name_output"

When it splits the files, execute the following for feature extraction

python feature_extractor.py "./dir_files_to_analyse" "name_of_a_file.cvs"