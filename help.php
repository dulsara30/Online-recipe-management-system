<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How We Can Help You?</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <h1>Food Recipe Management System</h1>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="recipes.html">Recipes</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="contact.html">Contact Us</a></li>
            </ul>
        </nav>
    </header>

    <section class="hero">

    	
        <div class="container">
            <h2> <mark> How can we help you?</mark></h2>
            <section class="faq-search">
    <div class="container">
        <h3>Search FAQs</h3>
        <form id="faq-search-form">
            <input type="text" id="faq-search-input" placeholder="Search...">
            <button type="submit">Search</button>
        </form>
    </div>
</section>
        </div>

    </section>

    <section class="feedback">
        <div class="container">
            <h3>Share Your Feedback</h3>
            <form>
                <label for="name">Your Name:</label>
                <input type="text" id="name" name="name" required><br><br>
                
                <label for="email">Your Email:</label>
                <input type="email" id="email" name="email" required><br><br>
                
                <label for="message">Your Message:</label><br>
                <textarea id="message" name="message" rows="4" required></textarea><br><br>
                
                <button type="submit">Submit</button>
            </form>
        </div>
    </section>
     <section class="faq">
        <div class="container">
            <h3>Frequently Asked Questions</h3>
            <div class="faq-item">
                <h4>How do I add a recipe to my collection?</h4>
                <p>To add a recipe to your collection, simply navigate to the recipe page and click on the "Add to Collection" button below the recipe.</p>
            </div>
            <div class="faq-item">
                <h4>Can I share my recipes with others?</h4>
                <p>Yes, you can share your recipes with others by clicking on the "Share" button next to the recipe and selecting the sharing option you prefer.</p>
            </div>
            <div class="faq-item">
                <h4>How do I search for a specific recipe?</h4>
                <p>You can search for a specific recipe using the search bar located at the top of the recipes page. Simply enter the name or keywords related to the recipe you're looking for.</p>
            </div>
        </div>
    </section>

    <link rel="stylesheet" type="text/css" href="css.css">
</body>
</html>
