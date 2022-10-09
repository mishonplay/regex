<?php
    /*
        Author: Tue Texo
        Course: CS-4910-001
        Term:   Spring 2020

        This program demonstrates how HTML can be parsed using regex.  For visability,
        the regex patterns used are stored in variables for reference.  To run the program,
        uncomment 1 of the provided 3 HTML files of Texas State CS faculty.  Save the file,
        then input the following on a linux command line;

        ~$ php mini.php
        
        The program will parse the uncommented HTML file and output results to 
        'output.txt' in the same repository.
    */
    
    // Uncomment ONLY 1 of the following 3 filenames, then save the file
    $filename = "bg.html";
    //$filename = "aq.html";
    //$filename = "mb.html";
    
    // The selected HTML file is read as a string to $html for parsing
    $handle = fopen($filename, "r");
    $html = fread($handle, filesize($filename));
    fclose($handle);

    // Regular expression variables used to parse $html
    $nameRegex = '/([a-zA-Z]|[[:space:]]|[Dr.])*(?=<\/title>)/';
    $eduRegex = '/([a-zA-Z]|;|[[:space:]]|,)*(?=<\/p><\/div>)/';
    $researchRegex = '/([a-zA-Z]|[[:space:]]|,|;)*(?=<\/p><\/div>)/';
    $emailRegex = '/[[:space:]]([a-zA-Z]*)@([a-zA-Z]*)\.(com|edu|net)/';
    $webRegex = '/(https:\/\/cs.txstate.edu\/accounts\/profiles\/[a-z0-9]*)/';

    // Parsing $html for each of the mini project requirements
    $name = getMatches($html, $nameRegex);
    $education = getMatches($html, $eduRegex);
    $research = getMatches($html, $researchRegex);
    $email = getMatches($html, $emailRegex);
    $webpage = getMatches($html, $webRegex);

    // Store each match in a string container in specified format
    $name_out = "Name:" . $name[0] . PHP_EOL;
    $education_out = "Education: " . $education[2] . PHP_EOL;
    $research_out = "Research interests: " . $research[0] . PHP_EOL;
    $email_out = "Email:" . $email[0] . PHP_EOL;
    $webpage_out = "Webpage: " . $webpage[0] . PHP_EOL;

    // Combine all match strings into one string for output
    $output = $name_out . $education_out . $research_out . $email_out . $webpage_out;

    // Send output to 'output.txt'    
    file_put_contents('output.txt', $output);

    // A function to parse $html and return matches
    function getMatches ($string, $regex) {
        preg_match_all($regex, $string, $array);
        return $array[0];
    }
?>
