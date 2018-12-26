
![img](https://github.com/chrisrb32/Pitstream-Live/blob/master/pslogo.png)

Use your GoPro Hero 7 to stream to Facebook Pages and Groups!

## What is Pitstream Live ? ##
Pitstream Live is a Web App using the Facebook PHP SDK and Facebook Live API to retreive RTMP Links for Livestreaming to Facebook Pages and Groups. 



## Why Pitstream Live ? 
The Hero 7 Black is the first GoPro model to allow direct Livestreaming from the camera to streaming servers/platforms.
The official GoPro App initially only offered to stream to personal Facebook profiles or a manually specified RTMP endpoints. Streaming to YouTube has now been implemented, but Facebook Pages and Groups are still supported by manually pasting a RTMP Link from Facebook into the GoPro app.

The page to generate RTMP Links (https://www.facebook.com/live/create) is currently disabled/incompatible with smartphone browsers and therefore a PC / Laptop / Windows-Tablet would always be required to setup a Stream to FB Pages and Groups.



## Main Features ##

- Retreival for RTMP and RTMPS links for livestreaming to Facebook Profiles, Pages and Groups
- **Smartphone compatible**
- RTMP Links can be used with any video encoding device/app


## Known issues & limitations ##
- Persistent Stream Keys cannot be retreived by Pitstream Live as this feature seems to require additional whitelisting by Facebook.
- The total number of calls a Facebook app can make per hour is 200 times the number of users.
- Livestreams are being published automatically as soon as video signal is received. This behaviour is different to https://www.facebook.com/live/create where streams need to be published manually always.
- The Facebook Live API offers many more options that have not been implemented (yet) e.g. comment and error handling, stream previews, streaming to events. Please refer to https://developers.facebook.com/docs/live-video-api/


