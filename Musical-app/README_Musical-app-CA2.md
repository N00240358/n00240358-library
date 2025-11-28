# Musical App

## Overview
The Musical app is a Laravel-based CRUD web application that allows users to create, view, update, and delete musical entries. Musicals, Songs, Actors, Tickets and Users are the tables that we primarily use. Musicals has a one-to-many relationship with Songs and a many-to-many relationship with actors (using a pivot table called actor_musical). Users have a one-to-many relationship with tickets, with tickets having a many-to-one relationship with Musical. Roles added to allow admin and regular users.

---

## Week 1

I started by adding the role management into the CRUD by adding admin and regular user into the user controller for a dropdown (which is added in the creation of users), where it would then be saved into the user table. Added a column to the user table and added a seeder for both an admin and user account. Added authentication for things like create and edit. Anything that a user cannot do is not displayed; only admins can see everything.

---

## Week 2

During this week I made the Song table and controller along with its seeder and model. I first just had the song creation in the musical show but later moved everything into a form called Song-form. This form can handle both creation and editing of the songs. A one-to-many relationship was added to the musical model to link it to each song. Copied styling from other forms along with the musical show.

Using Laravel commands added Actor migration and seeder along with the controller and model. Updated musical controller for a many-to-many relationship. Actor form, details and card components were also added. The navigation bar was also updated, adding 'actor' to it. This makes it so that you can control all the relative tables with the website instead of using phpMyAdmin.

Web.php was also updated to add the correct routes for both the Actors and Songs tables.

---

## Week 3

This week focused on authentication and seeders. I added separate login functionality for users and admins and created seeders for songs and actors to populate the database. The actor form was improved by replacing checkboxes with a search-and-click interface for easier actor selection, improving usability and allowing smoother management of many-to-many relationships between musicals and actors.

I replaced the checkboxes in the actor form with a search interface to allow easier management, as there can be between 40 or so to around 60-plus actors in each musical, making the checkboxes inefficient. Plans to redo the search, as at the moment it adds it to the search box, and to add a search from the musical side to add actors.

---

## Week 4 

I changed the search interface in the actor form to Tom Select; this is a fork of selectize.js for searching and multi-selection searches. This library is called and also styled to appear in both the actor and musical forms, allowing them to be added and removed from both forms.

I added Laravel Cashier with Stripe integration; I linked each payment to a musical, and using Stripe, I could process false payments (testing API keys). There was no way to view which musical and which user bought a ticket. This caused me to add my Ticket table that stored an id of the ticket itself and the user's id and the musical's id. An index page was then added to view any tickets that a user purchased. Authentication was added to this, making it so that only the user that shares the same user ID sees their own tickets. Payment code is added in web.php, using it partially as a create for the ticket and to link it to the stripe API iteself.

Lastly, I added a .yml file to call my Stripe API keys that are kept in GitHub secrets, as GitHub does not allow you to store API keys in their repo without disabling safeties. My .env file was added to .gitignore, as my own API keys are stored there. The .yml gives an .env.example file that, when you pull, you can then copy into an .env file and add your own Stripe API keys