import os
from flask import Flask, request, render_template, redirect, send_from_directory
from werkzeug.utils import secure_filename
from pyAudioAnalysis import audioBasicIO
from pyAudioAnalysis import audioFeatureExtraction
import numpy as np
import csv
from sklearn.externals import joblib
from pydub import AudioSegment
import sys
from scipy.io.wavfile  import write as write_wav_file


############SPLIT FILES FUNCTION##################
def splitAudioFiles(raw_files_directory, window_storage_directory):
    print "Splitting"
    filenames = [name for name in os.listdir(raw_files_directory) if not name == '.DS_Store' and name.__contains__(".wav")]

    print filenames
    for filename in filenames:
        audiofile = None
        Freq = None
        [Fs, x] = audioBasicIO.readAudioFile(raw_files_directory+"/"+filename)
        print Fs
        print len(x)
        x = audioBasicIO.stereo2mono(x)  # necessary conversion for pyaudio analysis
        print len(x)
        Freq = Fs
        audiofile = x
        duration = len(audiofile)/Freq
        mystep = len(audiofile)/int(duration)
        print duration
        window_index = np.arange(start=0, stop=duration * Freq, step=mystep*3)
        cntr = 0

        for i in range(0, int(np.ceil(duration / 3))):
            cntr = cntr + 1
            if i == int(np.ceil(duration / 3) - 1.0):
                window = audiofile[window_index[i]:]
                filepath = os.path.join(window_storage_directory, filename + '_window_' + str(cntr) + '.wav')
                write_wav_file(filepath, Fs, window)
                break

            window = audiofile[window_index[i]:window_index[i + 1]]
            filepath = os.path.join(window_storage_directory, filename + '_window_' + str(cntr) + '.wav')
            write_wav_file(filepath, Fs, window)
    print "Finished with Splitting"

if __name__ == "__main__":
     #if len(sys.argv)==2:

         #import os

         #cwd = os.getcwd()
         #print cwd

         print "USAGE: first argument is the file directory, second argument is the outputdirectory"
         #quit(1)
         print sys.argv[1]
         print sys.argv[2]
     #try:
         splitAudioFiles(sys.argv[1], sys.argv[2])
     #except Exception:

         #print "USAGE: first argument is the file directory, second argument is the outputdirectory"