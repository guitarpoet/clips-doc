# Clips Doc, The Document Presentation Framework Using Clips Tool

## Introduction

This project is the documentation presentation framework project for [Clips Tool](http://github.com/guitarpoet/clips-tool/).

You can create a document project by using this command:
	
	composer create-project -s dev guitarpoet/clips-web

And you can use this framework just by setting the path of the document git repository in the configuration.

# Getting started

1. You can get the project just using this command (composer must be installed first).

	composer create-project -s dev guitarpoet/clips-web

2. Get the browser capacities database(this is used by the framework to match the user agent to detail browser information, to let framework and you to do the browser hack on purpose).

	./vendor/bin/clips get bcap

3. Fix the folder permission or ownership of folder application/cache. ** Note: This is very important since all the thing that needs cache(css, image, smarty compiled files) ** will be place here, if no write permission for your web application server(apache, for example), the web request will get failed

There you go.
