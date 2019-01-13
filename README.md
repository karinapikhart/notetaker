# Overview
This is intended to be a quick prototype of a bash script for using a hashtag organization system for my notetaking. First draft of requirements: what I'd like to be able to do is:
1. Use hashtags to identify topics/themes in my own notes/docs.
1. Use a script to get a list of all my hashtags/topics
1. Use a script to find all files containing that hashtag, or even the line of the file.
1. Easily browse the search results to find what interests me or look for themes.

# Time boxing:
* 6:15p - Start work
* 7:15p - Going to stop work
* Got the 2 key proof of concept tasks done in 30 minutes! (#2 and 3 above)
* 7:30pm - feel motivated to keep going to a little bit more. Going to try 1-2 more microtasks
* 9:15pm - STOP. got a few buttons and forms on my page. It's not quite functional. Need to tie it together.

# Agile Dev; Constantly Evolving/grooming Backlog; Sandbox [Priority]
[x] TODO: [High] Use a script to get a list of all my hashtags/topics (15 mins)
[x] TODO: [High] Use a script to find all files containing a hashtag, or even the full line of the file. (15 mins)
[x] TODO: [High] Make script runnable from a little HTML page/file - e.g. https://stackoverflow.com/questions/6235785/run-a-shell-script-with-an-html-button (45 mins)
[x] TODO: [High] Clean up php's rendering of html output
[x] TODO: [High] Put a text box into the php file to accept an input
# [x] TODO: [High] HTML page is dysfunctional. Need to unblock a lot of different things. Get tutored.
# [x] TODO: [Med] Better understand bash script output to eliminate stout=0 coming as an ouput
# [x] TODO: [Low] Can evolve script to take multiple inputs and do an "OR" search for all of them
# [ ] TODO: [Med] Get Code Review
# [ ] TODO: [Med] Remove absolute file paths from .sh and .php files
# [ ] TODO: [Med] Persist checkbox state
# [ ] TODO: [Med] Add a "check all" option
# [ ] TODO: [Med] Keep an eye on what has been exluded (e.g. hashtags with numbers, hyphens, other chars, etc)
# [ ] TODO: [Med] Find todos - e.g. [ ] or [x] or [X]
# [ ] TODO: [Low] Write results to a file?
# [ ] TODO: [Vague] Easily browse the search results to find what interests me or look for themes.
# [ ] TODO: [] Learn what Apache / XAMPP is. Learn what built in webserver is. Learn what local host / local port is. Learn about index.php/index.html files. 
# [ ] TODO: []
# [ ] TODO: []
# [ ] TODO: []
# [ ] TODO: []

############################################################################

## PROTOTYPING

#######################
## Find all hashtags ##
#######################

# Do a grep for all hashtags found in this directory: /Users/Karina/Dropbox/Notes/Journal/

# man grep
# grep homework /Users/Karina/Dropbox/Notes/Journal/
# grep -r homework /Users/Karina/Dropbox/Notes/Journal/
# grep -r "#homework" /Users/Karina/Dropbox/Notes/Journal/
# grep -r "#homework" /Users/Karina/Dropbox/Notes/Journal
# grep -r "#[[:alnum:]]" /Users/Karina/Dropbox/Notes/Journal
# grep -r "#[[:alpha:]]" /Users/Karina/Dropbox/Notes/Journal
# grep -r "#[a-zA-Z]" /Users/Karina/Dropbox/Notes/Journal
# 
# # count to make sure you're getting the same number of results both ways:
# 
# grep -r "#[a-zA-Z]" /Users/Karina/Dropbox/Notes/Journal | wc -l
#        7
# grep -r "#[[:alpha:]]" /Users/Karina/Dropbox/Notes/Journal | wc -l
#        7
# 
# # Trim down to just the hastag itself
# 
# grep -or "#[a-zA-Z]" /Users/Karina/Dropbox/Notes/Journal
# grep -or "#[a-zA-Z]*" /Users/Karina/Dropbox/Notes/Journal
# grep -or "#[a-zA-Z][a-zA-Z]*" /Users/Karina/Dropbox/Notes/Journal
# grep -hor "#[a-zA-Z][a-zA-Z]*" /Users/Karina/Dropbox/Notes/Journal
# 
# # Remove dupes
# 
# man sort
# grep -hor "#[a-zA-Z][a-zA-Z]*" /Users/Karina/Dropbox/Notes/Journal | sort
# grep -hor "#[a-zA-Z][a-zA-Z]*" /Users/Karina/Dropbox/Notes/Journal | sort -u


##################################################
## Get all lines/filenames with specific hastag ##
##################################################

# grep -r "#homework" /Users/Karina/Dropbox/Notes/Journal | sort -u

############################################################################


############################################################################

######################
## Running PHP file ##
######################

# in Terminal

# cd ~/Dropbox/Projects/software/Notetaker/ (wherever the index.php file is)
# php -S localhost:8000 (Starts built-in web server on the given local address and port)
# built in web server means you dont need apache/xampp

# in Browser

# http://localhost:8000/ (go here -- looks for an index.php or index.html file, i think?)

## JAVASCRIPT DUMP ##

  <script>
  function helloworld() {
    alert("hello world!")
  }
  
  function hellocheckbox() {
    itemList = document.getElementsByName("checkbox"); // a NodeList
    alert(itemList);
    alert(itemList.length);
    alert(itemList[2]);
    alert(itemList[2].value);
    alert(itemList[2].checked);
    alert(itemList[3].value);
    alert(itemList[3].checked);
    console.log(itemList);
    console.log(itemList.length);
  }
  
  function hashtagsearch() {
    let itemList = document.getElementsByName("checkbox"); // a NodeList
    let outputBox = document.getElementById("hashtagsearchresults");    
    //let collection = itemList.selectedOptions;
    let output = "";
    let boxchecked = false;

    for (let i=0; i<itemList.length; i++) {
      if (itemList[i].checked) {
        boxchecked = true;
        if (output === "") {
          output = "Here are the hashtags you selected: ";
        }
        hashtag = itemList[i].value;
        output += hashtag + ", ";
      }
    }
    if (output === "") {
      output = "You didn't select any hashtags!";
    }
  }
  </script>
