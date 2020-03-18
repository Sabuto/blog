---
extends: _layouts.post
section: content
title: Hello World
author: Robert Dunne
date: 2020-02-01
description: My first blog post
featured: true
categories: [general]
cover_image: https://i.imgur.com/xl3CQDT.png
---

I guess i should introduce myself, I'm [Rob](https://github.com/sabuto), I have been interested in lots of different things. This blog will mainly be about iot, home servers and [Home Assistant](https://www.home-assistant.io/)

I have experience writing code in different languages but mainly PHP. I am a backend developer at heart!

I like to contribute to open source but i haven't really done much in regards to actual contributes, I have created a few [addons](https://github.com/sabuto/hassio-repo) for Hassio.

Anyway this was a brief introduction i will leave you with my current stack of Docker containers on my homelab server:
[![My Stack](https://i.imgur.com/xl3CQDT.png)](https://i.imgur.com/xl3CQDT.png)

So in this stack we have:

## Media Stack
[![Media Stack](https://imgur.com/CgvlN8d.png)](https://imgur.com/CgvlN8d.png)
In the Media Stack I have:
* my plex for streaming media 
* Radarr and Sonarr: for finding my media
* Jackett for those parsing problems!
* Portainer, This helps me manage my docker containers via a gui. This is not nessaserily a media item per se but I had this in the docker compose file.
* Heimdall this is meant to be used so you can have everything in one place 

## Home Assistant Stack
[![My Home Assistant Stack](https://i.imgur.com/DjboqEt.png)](https://i.imgur.com/DjboqEt.png)
Now this is my main stack and why i set up this server, This stack is for my home assistant setup (hassio). I run hassio because i like docker and i like the ease of setting up the addons.

So within this i have:

* ESP Home: in order to control my esps!
* Node Red for all of my automations
* Wireguard for a vpm for home.
* nginx for a reverse proxy so i can access my things easier.
* hassio google addon, this allows me to backup my home assistant data to google drive at a frequency i decide (every day at 1am)
* influxDB, this allows me to store certain data in an influxDB instance
* vsCode, this is for editing my files in the browser
* ssh so i can ssh into hassio
* grafana to display my metrics from the influxDB
* samba so i can explore the files remotely
* Zigbee2mqtt so i can use the zigbee devices in my home with HomeAssistant Locally
* DuckDNS so i can access my instance outside of my home
* Hassio Telegraf so i can use Telegraf to report data from my server to the influxDB instance (I have two running because i am developing an update for it)
* Mosquitto so I can have a mqtt instance on my server
* Pi-Home so i can have my own dns for ad filtering etc
* hassio_dns hassio's internal dns
* homeassistant this is the main docker container for hassio
* hassio_supervisor this is responsible for starting the different containers for hassio and making sure that everything is running smoothly.

I also have a Shinobi container that is inactive at the moment, I have this because I was playing around with having some cctv camera's set up at home but never got around to installing them.

I plan to add more and take some away, I have developed some addon's for Home Assistant myself which i expect will be the focus of a couple of blog posts.