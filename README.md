# About this repo
This repo consists of three parts: server side code app code, server side DB, and and Android app. The DB portion is not required if you statically define the dataset.

# App Code
This is a simple PHP one page website that generates a globe. 

It will pull data from the data.txt if available. You can hardcode this in an array of format [lat,long,magnitude,lat,long,magnitude] or if not present it will generate it from the DB.

Third party work:
* [Three.js](http://threejs.org/)
* [WebGL Globe](https://www.chromeexperiments.com/experiment/globe-viewer)

# DB Code
Load into XAMPP if you want to dynamically generate the dataset. Data formats are from OpenFlights. The DB structure is in the directory.

Third party work:
* Trip flight data exported from TripIt into [OpenFlights](http://openflights.org/) which I can then export into a CSV and import that into the DB.
* Airport GPS coordinates from [OpenFlights](http://openflights.org/data.html)

# Android
Based of a standard template in Android Studio 2.2, this will just use the Amazon libraries which support WebGL rendering to load the above app data in an iframe.

Third party work:
* [Amazon WebView](https://developer.amazon.com/public/solutions/platforms/android-fireos/docs/building-and-testing-your-hybrid-app)