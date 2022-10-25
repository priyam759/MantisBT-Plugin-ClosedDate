# MantisBT-Plugin-ClosedDate

Currently in Mantis, there is no field for 'Closed Date' of a ticket, for when a ticket's status is marked as 'closed'. This plugin will create a column that you can then add in View Issues, reports, etc. that will show the value. If a ticket is closed more than once, the script will take the most recent closed date. This plugin also makes sure date_closed is only filled when the current status is also 'closed', so re-opened tickets do not show a value. 

To install:
Add ClosedDate folder containing the .php file in C:/[MantisDirectory]/plugins/
Upon having the correct permissions, you can then go to Manage -> Manage Plugins and install the plugin
The plugin will then appear in available columns in Manage -> Manage Configuration -> Manage Columns
