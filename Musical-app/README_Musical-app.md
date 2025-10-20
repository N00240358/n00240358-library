# Musical App

## Overview
The Musical app is a Laravel-based CRUD web application that allows users to create, view, update, and delete musical entries. Each musical includes a title, description, director, duration, premiere date, image, and YouTube trailer.

---

## Week 1
Before I started, I made an ERD for this project to show how each table should link to the others.

I focused on setting up the Laravel project and creating the structure for the application.

I began by creating the project using the console and ensuring that the MySQL database was linked to it correctly. I then built the migration for the musical table using the make:model function in the console. This function created the Musical model, migration, controller, and seeder. I then created the views using the make:view function. The views I made were index, create, show, and edit.

In the create musical file, I added the database columns to the Schema::create. The columns I added were: id, title, image, description, duration, director, premiere_date, video, and timestamps. I then filled the seeder with some sample data to test that everything was working correctly.

I created a folder for images (public/images/musicals) for the seeder and to store future images after new musicals have been added to the database. After everything was set up, I ran the migration and then seeded the database, confirming in phpMyAdmin that everything was working correctly.

Next, I added a link to the navigation bar titled View All Musicals, which leads to the musical index.
In web.php, I added seven routes: index, create, show, store, edit, update, and destroy. I also ensured that the controller was imported into web.php.

In the controller, I added code so that the index function pulls all musicals from the database and compacts them into an array before returning them to the view where they were requested.

In index.blade.php, I added the layout and styling, along with a foreach loop that pulls each musical from the array and displays them on a card with the desired information.

I then created a component using the make:component function called MusicalCard. Inside musical-card.blade.php, I first imported the data/properties I wanted to show, then wrote out the structure and styling of the card that the index view would use.

I then ran tests to confirm that everything was working and displaying correctly.

---

## Week 2
I made the create and show functions so that users can add musicals to the database and view more information about a particular musical by clicking on it.

In the controller, I added code to the show function that opens a page with more details about the musical.

Using the console and the make:component function, I made a component called Musical Details, which is used for the show function. I edited this component to import the properties and define the structure and styling, along with pulling the relevant information from the database. Then, in show.blade.php, I added structure and styling and passed in the data I wanted the user to see.

After entering everything, I tested it to confirm that the information was displayed correctly.

I then moved on to the create function. First, I added a link to the navigation bar, the same way I did for the “All Musicals” link. Then, in the controller, I added the path in the create function to get to the musicals.create file from the routes.

Next, I created the Form for adding musicals. This is a general form, as I planned to reuse it for the edit function later. Using make:component, I made the Musical Form component, then edited it to include the properties I would use, along with inputs for each property to be added to the database.

In musical/create.blade.php, I added styling and laid out the form, then called the form component, setting it to POST to the store function upon successful submission.

Inside the controller’s store function, I added validation to ensure that users could not input incorrect data. I added code to check if an image was uploaded, renamed it with a timestamp, and moved it into the images folder. After this, Musical::create is run, which creates a new record in the database. An alert message is then sent to the index page confirming that a record was created successfully.

For the alert message, I made a component using the console called Alert Success, which displays a green bar at the top of the screen.

Once all the code was complete, I tested it to ensure everything worked correctly and that data was being saved properly.

---

## Week 3
This week, I focused on finishing all the CRUD functions — with Update and Delete being the final ones to complete.

Inside the index, I added an Edit button to each musical card. In the controller, I added similar code to the show function, but using edit instead. In edit.blade.php, I reused the create form but changed the route so it would update existing entries. This allows all the information to be pre-filled with data from the database.

Inside the controller, I updated the update function code. It is similar to the store function but also checks if a new image was uploaded. If an image already exists, it deletes the old image from both the database and the images folder before saving the new one.

For the delete functionality, I added a Delete button to the index page in the same way as the Edit button, but implemented it as a form so the function would work properly. In the destroy function of the controller, when triggered, it deletes the record from the database along with the associated image file.

I also added a Cancel button to the form to allow users to return to the index page.

Additionally, I added a script to the Alert component that uses a timeout function so the alert disappears after 10 seconds. Previously, it would stay on screen until the page was reloaded. The alert component code was added to the index page so that it appears when triggered.


---

## Week 4
This week, I made several styling changes to give the app the look of an old theatre. This styling was applied to all the views, as well as the card, details, and form components, to ensure consistency. I also changed the button colours throughout the project and restyled the “Choose File” button in the form.

The colour scheme is designed to resemble a theatre stage — dark backgrounds representing the theatre, with gold and red accents symbolising curtains, lighting, and stage trim.

I added my own logo of the twin theatre masks to the navbar. I also removed the dashboard link from the navbar so that, when logged in, users are taken directly to the index page.

Inside the index, I changed the delete confirmation so that, instead of a dropdown appearing, it is now centred on the card of the musical you wish to delete. This makes it easier to confirm that you are deleting the correct entry.

Finally, I added an embedded YouTube video of the musical’s trailer. The code converts the standard YouTube URL into an embedded format, and using Alpine.js, I made the image and video overlap, showing only one at a time. When the image is clicked, it hides itself and reveals the video, which plays automatically on mute. When the video finishes, it switches back to the image. This is all displayed on a large black background, with the image confined to its original dimensions so it does not appear stretched, while the video is more horizontal to avoid looking squashed.

<!-- This was written by myself, and then using AI(chatgpt) correcting for spelling, grammer and punctuation -->
