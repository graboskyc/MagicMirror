# About this repo
This repo consists of three parts: server side app code, server side DB, and and Android app. The DB portion is not required if you statically define the dataset.

The initial idea comes from [Magic Mirror](https://magicmirror.builders/) platform but I wanted it lighter weight and within my control. This gets extended [here](http://michaelteeuw.nl/post/150349424992/mirror-mirror-on-the-wall-who-has-the-biggest-of).

# Components

## App Code
This is a simple PHP one page website that generates a globe. 

It will pull data from the data.txt if available. You can hardcode this in an array of format [lat,long,magnitude,lat,long,magnitude] or if not present it will generate it from the DB.

Third party work:
* [Three.js](http://threejs.org/)
* [WebGL Globe](https://www.chromeexperiments.com/experiment/globe-viewer)
* [Metro Studio icons](https://www.syncfusion.com/downloads/metrostudio)
* [Weather Underground weather API](https://www.wunderground.com/weather/api/d/docs)

## DB Code
Load into XAMPP if you want to dynamically generate the dataset. Data formats are from OpenFlights. The DB structure is in the directory.

Third party work:
* Trip flight data exported from TripIt into [OpenFlights](http://openflights.org/) which I can then export into a CSV and import that into the DB.
* Airport GPS coordinates from [OpenFlights](http://openflights.org/data.html)

## Android
Based of a standard template in Android Studio 2.2, this will just use the Amazon libraries which support WebGL rendering to load the above app data in an iframe. 

While an Android App, it is technically an Amazon Fire TV Hybrid HTML5 app. It will not work on non-Fire devices. The Amazon libraries are required as the standard Android WebView will not support OpenGL natively.

Third party work:
* [Amazon WebView](https://developer.amazon.com/public/solutions/platforms/android-fireos/docs/building-and-testing-your-hybrid-app)