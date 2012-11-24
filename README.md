Webradio
========

Simple PHP Script to play control streaming radio on Raspberry PI

I hacked this together quickly to enable me to control streaming audio stations via a web browser on my home network.  My Raspberry PI is connected to the sound system, so effectively, its a headless audio player.

Installation
============

This simple script is intended to run on a Raspberry PI, but could run on basically any Linux box with a little fiddling.

For starters you will need Apache and PHP installed and running.  I won't go into details of how to set that up, heaps of
info on the web to help you through that process.

Secondly you need to add the www-data user - which is what Apache runs as - to the audio group and video group.

There are proper ways to do this, but because I am lazy I edited the file /etc/group with this command
sudo vi /etc/group
and added 'www-data' as follows.

audio:x:29:pi,www-data

I restarted the box ofter that, but again, you could probably restart Apache and Alsa to achieve something similar, but for now a restart did it.

Adding Stations
===============

To add your own stations, you need to edit the index.php file and simply add your station Name and URL to the array at the top of the file.  The examples in the file should be simple enough to follow, but for your sake, here is a simple example with two stations...

$stations = array( "My Station Name" => "http://www.example.com/funkystation1.mp3",
		   "My Second station" => "http://www.example.com/secondnotsofunkystation.wma" );

Other than that, enjoy your listening experence.  Email me via Github if you need some help or want to contribute.

