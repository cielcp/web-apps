<?php
    /**
     * Homework 4 - PHP Introduction
     *
     * Computing ID: ccp7gcp
     * Resources used: PHP Documentation, CodeAcademy, W3 Schools, Stack Overflow
     */
    

    // Problem 1: Compute the Grade
    function calculateGrade($scores, $drop) {
        // calculate the total scored and total max points, as well as the percentage for each score
        $totalScored = 0;
        $totalMaxPoints = 0;
        $percentages = [];
        foreach ($scores as $score) {
            $totalScored += $score['score'];
            $totalMaxPoints += $score['max_points'];
            $percentage = 100 * ($score['score'] / $score['max_points']);
            $percentages[] = $percentage;
        }

        // if drop is true, find the lowest score and drop it from the total
        if ($drop) {
            $minIndex = array_search(min($percentages), $percentages);
            $totalScored -= $scores[$minIndex]['score'];;
            $totalMaxPoints -= $scores[$minIndex]['max_points'];
        }
    
        // return the overall average of the project scores rounded to three decimal places.
        if ($totalMaxPoints > 0) {
            $average = round(100 * ($totalScored / $totalMaxPoints), 3);
            return $average;
        }
        
        return 0;
        
    }


    // Problem 2: Gridding
    function gridCubbies($width, $height) {
        // If there are no tiles to be printed, return an empty string.
        if ($width == 0 || $height == 0) {
            return '';
        }
        // If the grid doesn’t have a width or height of at least two, the function should return the ordered tiles of all the edges. 
        if ($width < 2 || $height < 2) {
            $tiles = range(1, max($width, $height));
            return implode(', ', $tiles);
        }

        // calculate total number of tiles
        $totalTiles = $width * $height;
        
        // find the tile number in each corner
        // $bottom_left = 1;
        $top_left = $height;
        $top_right = $totalTiles;
        $bottom_right = $totalTiles  - $height + 1;

        $tiles = [];

        // bottom left cubby
        $tiles[] = 1;
        $tiles[] = 2;
        $tiles[] = $height + 1;
        $tiles[] = $height + 2;

        // top left cubby
        $tiles[] = $top_left;
        $tiles[] = $top_left - 1;
        $tiles[] = $top_left + $height;
        $tiles[] = $top_left + $height - 1;

        // top right cubby
        $tiles[] = $top_right;
        $tiles[] = $top_right - 1;
        $tiles[] = $top_right - $height;
        $tiles[] = $top_right - $height - 1;

        // bottom right cubby
        $tiles[] = $bottom_right;
        $tiles[] = $bottom_right + 1;
        $tiles[] = $bottom_right - $height;
        $tiles[] = $bottom_right - $height + 1;

        // sort and remove duplicates
        sort($tiles);
        $tiles = array_unique($tiles);
        return implode(', ', $tiles);
    }


    // Problem 3: Combining Address Books
    function combineAddressBooks(...$address_books) {
        $merged_address_book = [];
    
        foreach ($address_books as $book) {
            foreach ($book as $name => $contact) {
                // if person already exists in merged book
                if (isset($merged_address_book[$name])) {
                    // if contact is not already in merged book, append to person
                    if (!in_array($contact, $merged_address_book[$name])) {
                        $merged_address_book[$name][] = $contact;
                    }
                } 
                else {
                    // if new person, add them and contact
                    $merged_address_book[$name] = [$contact];
                }
            }
        }
    
        return $merged_address_book;
    }


    // Problem 4: Acronym Summary
    function acronymSummary($acronyms, $searchString) {
        // If either parameter string is empty or the wrong type, the function should return an empty array.
        if (empty($acronyms) || empty($searchString) || !is_string($acronyms) || !is_string($searchString)) {
            return [];
        }
    
        // split acronyms string and search string into arrays
        $acronymArray = explode(" ", $acronyms);
        $searchArray = explode(" ", strtolower($searchString));
        
        // get the first letter of each word in the search string 
        $firstLetters = "";
        foreach ($searchArray as $word) {
            $firstLetters .= $word[0];
        }

        // loop through each acronym and count number of occurances in first letters string
        $acronymSummary = [];
        foreach ($acronymArray as $acronym) {
            $count = 0;
            // loop through each substring of the first letters string to get overlapping occurances
            $acroLen = strlen($acronym);
            $searchLen = strlen($firstLetters);
            $i = 0;
            while ($i + $acroLen <= $searchLen) {
                $currSub = substr($firstLetters, $i, $acroLen);
                if ($currSub == strtolower($acronym)) {
                    $count += 1;
                }
                $i++;
            }
            //$count = substr_count($firstLetters, strtolower($acronym));

            // store the count in the acronym summary array
            $acronymSummary[$acronym] = $count;
        }
    
        return $acronymSummary;
    }