<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodingDung | Profile Template</title>
    <link rel="stylesheet" href="userpage.css">
</head>

<body>
    <div class="container">
        <fieldset class="field">
            <legend>
                <h1>User Profile</h1>
            </legend>

            <div class="content">
                <div class="image">
                    <img src="https://i.pinimg.com/564x/e8/7a/b0/e87ab0a15b2b65662020e614f7e05ef1.jpg" alt="profile photo" class="img">
                    <br>
                    <button type="button" class="button1">
                        <p>change profile picture: </p><input class="file" type="file" placeholder="change profile picture">
                    </button>
                    <br>
                    <button type="button" class="button">Saved Recipe</button>
                    <br>
                    <a href="addrecipe.php"><button type="button" class="button">Add Recipe</button></a>
                </div>

                <div class="details">
                    <form action="" method="post">
                        <fieldset>
                            <p class="de">
                                <label for=""> First Name: </label>
                                <input class="data" type="text" placeholder="First Name">
                            </p>
                            <p class="de">
                                <label for=""> Last Name: </label>
                                <input class="data" type="text" placeholder="Last Name">
                            </p>
                            <p class="de">
                                <label for=""> Email: </label>
                                <input class="data" type="text" placeholder="Email">
                            </p>
                            <p class="de">
                                <label for=""> Phone No: </label>
                                <input class="data" type="text" placeholder="Phone No">
                            </p>
                            <p class="de">
                                <label for=""> Birthday: </label>
                                <input class="data" type="text" placeholder="Birthday">
                            </p>
                            <p class="de">
                                <label for=""> Last Name: </label>
                                <input class="data" type="text" placeholder="Last Name">
                            </p>
                        </fieldset>

                    </form>


                </div>
            </div>
        </fieldset>
    </div>
</body>

</html>