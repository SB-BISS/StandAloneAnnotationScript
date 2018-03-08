import os
from flask import Flask, request, render_template, redirect, send_from_directory
from werkzeug.utils import secure_filename
from pyAudioAnalysis import audioBasicIO
from pyAudioAnalysis import audioFeatureExtraction
from pyAudioAnalysis import audioBasicIO
import numpy as np
import csv
from sklearn.externals import joblib
from pydub import AudioSegment
import sys



def extract_all(filepath="./",filename="./features.csv"):
    filenames = [os.path.join(filepath,name) for name in os.listdir(filepath) if not name == '.DS_Store' and name.__contains__(".wav")]
    only_names = [name for name in os.listdir(filepath) if not name == '.DS_Store' and name.__contains__(".wav")]

    for i in filenames:
        features= featureExtraction(i)
        features = np.asarray(features).reshape(len(features), -1)
        with open(filename, 'a') as f:
            w_f = csv.writer(f)

            line_to_write = [i.replace(filepath,"")[1:]]
            #print np.shape(features)
            for k in range(len(features)):
                for j in range(0,34):
                    line_to_write.append(features[k,j])

            w_f.writerow(line_to_write)

def featureExtraction(file_path):
    print file_path
    [Fs, x] = audioBasicIO.readAudioFile(file_path)
    #print x
    features = audioFeatureExtraction.stFeatureExtraction(x, Fs, 0.05 * Fs, 0.025 * Fs)
    if (len(features) == 0 or features.shape[1] < 50):
        features = 'none'
    else:
        #features = np.mean(features, axis=1)
        features = np.asarray(features).reshape(len(features), -1).transpose()

    return features

if __name__ == "__main__":
    if sys.argv[1]==None:
        extract_all()
    elif sys.argv[1]!=None and sys.argv[2]==None:
        extract_all(sys.argv[1])
    else:
        print "Starting Extraction"
        extract_all(sys.argv[1], sys.argv[2])