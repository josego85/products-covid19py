<!DOCTYPE html> 
<html> 
    <head> 
        <title>Laravel | CSRF Protection</title> 
    </head> 
    <body> 
        <section> 
            <h1>CSRF Protected HTML Form</h1> 
            <form method="POST"> 
                @csrf 
                  
                <input type="text" name="username" 
                                            placeholder="Username"> 
                <input type="password" name="password" 
                                            placeholder="Password"> 
                <input type="submit" name="submit" value="Submit"> 
            </form> 
        </section> 
    </body> 
</html> 
