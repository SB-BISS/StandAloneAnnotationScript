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
            w_f.writerow([i.replace(filepath,"")[1:], features[0, 0], features[0, 1], features[0, 2], features[0, 3], features[0, 4],
                          features[0, 5], features[0, 6], features[0, 7]
                             , features[0, 8], features[0, 9], features[0, 10], features[0, 11], features[0, 12],
                          features[0, 13], features[0, 14], features[0, 15], features[0, 16],
                          features[0, 17], features[0, 18], features[0, 19], features[0, 20], features[0, 21],
                          features[0, 22], features[0, 23], features[0, 24], features[0, 25],
                          features[0, 26], features[0, 27], features[0, 28], features[0, 29], features[0, 30],
                          features[0, 31], features[0, 32], features[0, 33]])


def featureExtraction(file_path):
    print file_path
    [Fs, x] = audioBasicIO.readAudioFile(file_path)
    print x
    features = audioFeatureExtraction.stFeatureExtraction(x, Fs, 0.05 * Fs, 0.025 * Fs)
    if (len(features) == 0 or features.shape[1] < 50):
        features = 'none'
    else:
        features = np.mean(features, axis=1)
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