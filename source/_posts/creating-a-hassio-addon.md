---
extends: _layouts.post
section: content
title: Creating a Hassio Addon
author: Robert Dunne
date: 2020-02-05
description: A Tutorial on how I build an addon for Hassio
featured: true
categories: [iot, hassio]
cover-image:
---

So I will preface this with, I am by no means an expert on this subject and I have had a lot of help from the community
when I have ran into little niggles, mainly on the [Discord](https://discord.gg/kBfQAs) server.

You can find all of my addons at [here](https://github.com/sabuto/hassio-repo) (I only have two at the moment.)

I want to walk you through why i built the addon, what frustrations i had and hopefully help others (all whilst being a bit interesting at the same time).

So my first hassio addon was [Telegraf](https://www.influxdata.com/time-series-platform/telegraf/) Which in itself is an aggregator of data. It collects information and sends it on (to multiple places). It works by adding outputs and inputs in the config
file and then spinning up the instance. There are official Docker containers for this and can be spun up quite easily. I created this addon so people could have it all in one place
i.e Home Assistant, It can integrate with the community addon influxdb (this means it send all of the data to influxdb). I then use Grafana to consume the information but it can be consumed however you would like.

The [Docs](https://developers.home-assistant.io/docs/en/hassio_addon_index.html) are great at explaining how to get set up, and how to get started.

Addon's are there to provide a service, in the case of my addon it provides a way to gather data about the machine that is running. The addon can be written in any language and you can even write your own!

To get started there are two options, either the local way as described [here](https://developers.home-assistant.io/docs/en/hassio_addon_tutorial.html) or I prefer to do it via github.
What i like to do is create a repo on github(or similar) and make it a dev repo, I like to name mine the same as what the public facing repo will be but dev at the end so for example my main repo 
for my hassio addon is hassio-telegraf and my dev is hassio-telegraf-dev.

The reason why i like to do it this way is because i can leverage github Actions to build and lint my files for me instead of using the host computer (which if it is a raspberry pi may not be powerfull enough to build the images).

So in your repo in order to be able to set it up you need at least the following:
* a folder within your repo with the name of the addon
* within that folder you need:
* Dockerfile - This is what the builder will use in order to make the addon
* config.json - This is where we tell the addon what it needs access to and what options we want available
* run.sh - I use this to do the processing and starting of the addon (you don't have to do it this way i just find it the easiest)

Here is what i have:
[![Github-Dev](https://i.imgur.com/UMTOp5T.png)](https://i.imgur.com/UMTOp5T.png)

The two additional items are:
* build.json - I use this to use base images that are different from the default (more on that later)
* telegraf.conf - This is the configuration file for the main addon

For now don't worry about the other items i will get into them later on.

Now that you have this repo set up you need to create one more repo (I know I Know!) and this will be the container repo so i call mine hassio-repo-dev
In this you need:
* repository.json
* Folder where the addon config will live
* In that folder you need:
* config.json (This is actually the exact same file as the one in the previous repo.)

Here is what mine looks like.
[![Github-Dev-Repo](https://i.imgur.com/r5VbB3v.png)](https://i.imgur.com/r5VbB3v.png)
I have:
* CHANGELOG.md - I add a brief summary of changes here and link it to the release page for that tag, This enables it so when an update is available in Hassio a button appears next to update called Changelog and people can see what changes are made easily.
* README.md - A Readme for how to use the addon, at the moment i have it exactly the same as the README in the main hassio-telegraf-dev repo but I want to shorten it down to a condensed version and then link to the main one.

And Finally my addon repo folder looks like this:
[![Github-dev-mainrepo](https://i.imgur.com/agQnfk4.png)](https://i.imgur.com/agQnfk4.png)

I will walk through each item so you can see what i use it for and then we will go in depth on how i use each file to make the addon work for me.

* .gitignore - This file is used to exclude files and folders from git when you are pushing from local - i used it to ignore .idea folder
* ISSUE_TEMPLATE.md - This file is ussed as a template when someone opens an issue, I use this so everything is uniform
* PULL_REQUEST_TEMPLATE.md - Same as above but for pull requests
* LICENSE.md - This is just a generic MIT license
* README.md - same as the readme in the above section
* renovate.json - This is the configuration for my renovate bot, it will suggest upping the dependancy version when needed.

## Setting up a hello world example
After you have created your repo - github.com/yourusername/hello-world-hassio create the following files:
