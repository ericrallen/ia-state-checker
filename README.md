ia-state-checker v0.1
=====================

A simple PHP class for checking a user-entered state value and converting it to a 2-letter postal code.

It's for situations where you are using something like Gravity Forms (with wordpress) and need to allow international dates, and also ensure valid USPS addresses, so you can't just stick a dropdown in the state field.

I chose to do this one in PHP because I could more easily tie it into all the various places where someone's address can be updated in the system where it was implemented.

To Do
======

Code needs to be refactored in some places:

 * Use regular expression for slug function
 * Find a better way to store and updated the arrays

Planned Features

 * Basic spell-checking to increase likelihood of matches (maybe only check common mis-spellings)
 * Possibly other stuff I think about as I go along